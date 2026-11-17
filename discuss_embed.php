<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Embedded discussion page for mapping source object -> hsuforum discussion.
 *
 * URL params:
 * - fid: hsuforum activity instance id (hsuforum.id) [required]
 * - cid: source course id (course.id) [optional, priority over iid]
 * - iid: source mod_data record id (data_records.id) [optional]
 *
 * Mapping priority:
 * - If cid and iid are both provided, cid mode is used.
 * - If only iid is provided, iid mode is used.
 *
 * @package   mod_hsuforum
 * @copyright 1999 onwards Martin Dougiamas
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/mod/hsuforum/lib.php');

/**
 * Output a minimal, iframe-friendly notice page without Moodle header/footer.
 *
 * @param string $message Localized message to display.
 * @return void
 */
function mod_hsuforum_discuss_embed_notice(string $message): void {
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<title>' . s(get_string('discussion', 'hsuforum')) . '</title>';
    echo '<style>
        html, body {
            margin: 0;
            padding: 0;
            background: #fff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        .discuss-embed-notice {
            margin: 16px;
            padding: 12px 14px;
            border: 1px solid #e5e7eb;
            border-left: 4px solid #f59e0b;
            border-radius: 8px;
            background: #fffbeb;
            color: #374151;
            line-height: 1.5;
            font-size: 14px;
        }
    </style></head><body>';
    echo '<div class="discuss-embed-notice">' . s($message) . '</div>';
    echo '</body></html>';
    exit;
}

/**
 * Build seed data for course mode (cid + fid).
 *
 * @param int $cid Source course id.
 * @param stdClass $forum Target forum record.
 * @return array
 */
function mod_hsuforum_discuss_embed_prepare_cid_seed(int $cid, stdClass $forum): array {
    global $DB;

    $sourcecourse = $DB->get_record('course', ['id' => $cid], '*', MUST_EXIST);
    $sourcecategory = $DB->get_record('course_categories', ['id' => $sourcecourse->category], '*', IGNORE_MISSING);

    $subjectparts = [];
    if (!empty($sourcecategory->name)) {
        $subjectparts[] = trim(strip_tags((string)$sourcecategory->name));
    }
    if (!empty($sourcecourse->fullname)) {
        $subjectparts[] = trim(strip_tags((string)$sourcecourse->fullname));
    }

    $subject = implode(' / ', array_filter($subjectparts));
    if ($subject === '') {
        $subject = get_string('discussion', 'hsuforum') . ' #' . $sourcecourse->id;
    }

    return [
        'subject' => core_text::substr($subject, 0, 255),
        'creatorid' => mod_hsuforum_discuss_embed_resolve_course_creatorid($sourcecourse),
        'sourcelink' => new \core\url('/course/view.php', ['id' => $sourcecourse->id]),
        'mappingtable' => 'hsuforum_course_discussion_map',
        'mappingkey' => ['cid' => $sourcecourse->id, 'fid' => $forum->id],
        'discussiongroupid' => -1,
    ];
}

/**
 * Build seed data for data-record mode (iid + fid).
 *
 * @param int $iid Source data record id.
 * @param stdClass $forum Target forum record.
 * @return array
 */
function mod_hsuforum_discuss_embed_prepare_iid_seed(int $iid, stdClass $forum): array {
    global $DB, $USER;

    $record = $DB->get_record('data_records', ['id' => $iid], '*', MUST_EXIST);
    $data = $DB->get_record('data', ['id' => $record->dataid], '*', MUST_EXIST);

    // Keep data entry permission checks in iid mode only.
    $datacm = get_coursemodule_from_instance('data', $data->id, $data->course, false, MUST_EXIST);
    $datacontext = context_module::instance($datacm->id);
    require_capability('mod/data:viewentry', $datacontext);

    // If approval is enabled and record not approved, show minimal iframe notice.
    if (!empty($data->approval) && empty($record->approved)) {
        mod_hsuforum_discuss_embed_notice(get_string('discussembedrequiresapproval', 'hsuforum'));
    }

    // Prefer field name "subject" as title source.
    $subject = '';
    $subjectrecord = $DB->get_record_sql(
        "SELECT dc.content
           FROM {data_content} dc
           JOIN {data_fields} df ON df.id = dc.fieldid
          WHERE dc.recordid = :recordid
            AND df.dataid = :dataid
            AND " . $DB->sql_compare_text('df.name') . " = :subjectname",
        [
            'recordid' => $record->id,
            'dataid' => $data->id,
            'subjectname' => 'subject',
        ]
    );

    if (!empty($subjectrecord->content)) {
        $subject = trim(strip_tags((string)$subjectrecord->content));
    }

    // Fallback to first non-empty content.
    if ($subject === '') {
        $firstcontent = $DB->get_record_sql(
            "SELECT dc.content
               FROM {data_content} dc
               JOIN {data_fields} df ON df.id = dc.fieldid
              WHERE dc.recordid = :recordid
                AND df.dataid = :dataid
                AND dc.content IS NOT NULL
                AND dc.content <> ''
           ORDER BY dc.id ASC",
            [
                'recordid' => $record->id,
                'dataid' => $data->id,
            ]
        );

        if (!empty($firstcontent->content)) {
            $subject = trim(strip_tags((string)$firstcontent->content));
        }
    }

    if ($subject === '') {
        $subject = get_string('discussion', 'hsuforum') . ' #' . $record->id;
    }

    $creatorid = (int)$record->userid;
    if (!$DB->record_exists('user', ['id' => $creatorid])) {
        $creatorid = (int)$USER->id;
    }

    return [
        'subject' => core_text::substr($subject, 0, 255),
        'creatorid' => $creatorid,
        'sourcelink' => new \core\url('/mod/data/view.php', [
            'd' => (int)$data->id,
            'advanced' => 0,
            'paging' => 1,
            'page' => 0,
            'rid' => (int)$record->id,
            'filter' => 1,
        ]),
        'mappingtable' => 'hsuforum_data_discussion_map',
        'mappingkey' => ['iid' => $record->id, 'fid' => $forum->id],
        'discussiongroupid' => !empty($record->groupid) ? (int)$record->groupid : -1,
    ];
}

/**
 * Create or update mapped discussion and return discussion id.
 *
 * @param stdClass $forum Target forum record.
 * @param array $seed Prepared seed data from mode-specific builder.
 * @param bool $iscidmode True when called from cid mapping mode.
 * @return int
 */
function mod_hsuforum_discuss_embed_resolve_discussionid(stdClass $forum, array $seed, bool $iscidmode = false): int {
    global $DB, $USER;

    $mappingtable = $seed['mappingtable'];
    $mappingkey = $seed['mappingkey'];
    $subject = $seed['subject'];
    $creatorid = (int)$seed['creatorid'];
    $discussiongroupid = (int)$seed['discussiongroupid'];
    $sourcelink = $seed['sourcelink'] ?? null;
    if ($sourcelink instanceof \moodle_url) {
        $contentlink = html_writer::link($sourcelink, '本处内容', [
            'target' => '_blank',
            'rel' => 'noopener noreferrer',
        ]);
        $message = '欢迎在此讨论区对' . $contentlink . '进行咨询或评论';
    } else {
        $message = '欢迎在此讨论区对本处内容进行咨询或评论';
    }

    $discussionid = null;
    $timenow = time();

    // Keep map lookup/create/update in one transaction for consistency.
    $transaction = $DB->start_delegated_transaction();
    $map = $DB->get_record($mappingtable, $mappingkey);

    // Reuse previously mapped discussion when possible and sync title if changed.
    if (!empty($map)) {
        $existingdiscussion = $DB->get_record('hsuforum_discussions', ['id' => $map->discussionid, 'forum' => $forum->id]);

        if (!empty($existingdiscussion)) {
            $discussionid = (int)$existingdiscussion->id;

            if (trim((string)$existingdiscussion->name) !== $subject) {
                $existingdiscussion->name = $subject;
                $existingdiscussion->timemodified = $timenow;
                $existingdiscussion->usermodified = $USER->id;
                $DB->update_record('hsuforum_discussions', $existingdiscussion);

                if (!empty($existingdiscussion->firstpost)) {
                    $firstpost = $DB->get_record('hsuforum_posts', ['id' => $existingdiscussion->firstpost]);
                    if (!empty($firstpost)) {
                        $firstpost->subject = $subject;
                        $firstpost->modified = $timenow;
                        $DB->update_record('hsuforum_posts', $firstpost);
                    }
                }
            }

            $map->timemodified = $timenow;
            $DB->update_record($mappingtable, $map);
        }
    }

    // Create discussion when map is empty or points to missing discussion.
    if (empty($discussionid)) {
        $discussion = new stdClass();
        $discussion->course = $forum->course;
        $discussion->forum = $forum->id;
        $discussion->name = $subject;
        $discussion->message = $message;
        $discussion->messageformat = FORMAT_HTML;
        $discussion->messagetrust = 0;
        $discussion->mailnow = 0;
        $discussion->reveal = 1;
        $discussion->groupid = $discussiongroupid;
        $discussion->timestart = 0;
        $discussion->timeend = 0;
        $discussion->pinned = 0;

        $discussionid = (int)hsuforum_add_discussion($discussion, null, null, $creatorid);

        $skipdiscussionsubscribe = $iscidmode && is_siteadmin($creatorid);
        if (!$skipdiscussionsubscribe) {
            require_once(__DIR__ . '/repository/discussion.php');
            $discussionrepo = new hsuforum_repository_discussion();
            $discussionrepo->subscribe($discussionid, $creatorid);
        }

        if (empty($map)) {
            $map = new stdClass();
            foreach ($mappingkey as $field => $value) {
                $map->{$field} = $value;
            }
            $map->discussionid = $discussionid;
            $map->timecreated = $timenow;
            $map->timemodified = $timenow;
            $DB->insert_record($mappingtable, $map);
        } else {
            $map->discussionid = $discussionid;
            $map->timemodified = $timenow;
            $DB->update_record($mappingtable, $map);
        }
    }

    $transaction->allow_commit();

    return $discussionid;
}

/**
 * Resolve the creator user id for a course discussion seed.
 *
 * @param stdClass $course
 * @return int
 */
function mod_hsuforum_discuss_embed_resolve_course_creatorid(stdClass $course): int {
    global $DB, $USER;

    if (property_exists($course, 'createdby') && !empty($course->createdby)
            && $DB->record_exists('user', ['id' => (int)$course->createdby])) {
        return (int)$course->createdby;
    }

    $dbman = $DB->get_manager();
    $logtable = new xmldb_table('logstore_standard_log');
    if ($dbman->table_exists($logtable)) {
        $creatorlog = $DB->get_record_sql(
            "SELECT l.userid
               FROM {logstore_standard_log} l
              WHERE l.courseid = :courseid
                AND l.eventname = :eventname
                AND l.userid > 0
           ORDER BY l.timecreated ASC, l.id ASC",
            [
                'courseid' => $course->id,
                'eventname' => '\\core\\event\\course_created',
            ],
            IGNORE_MULTIPLE
        );

        if (!empty($creatorlog->userid) && $DB->record_exists('user', ['id' => (int)$creatorlog->userid])) {
            return (int)$creatorlog->userid;
        }
    }

    return (int)$USER->id;
}

/**
 * Auto-enrol the current logged-in, non-guest user into a course when they
 * are not yet enrolled (e.g. an external integration opens this page before
 * the user completes the enrolment flow). Gives them the student role.
 *
 * Uses a password-less self enrolment instance when available, falling back
 * to a manual enrolment instance. If enrolment succeeds the request is
 * redirected so the page is re-loaded fresh in the next request (the enrolment
 * flow locks the theme for the current request, which would otherwise clash
 * with require_course_login()).
 *
 * @param int $courseid Course to ensure enrolment for.
 * @return void
 */
function mod_hsuforum_discuss_embed_auto_enrol_course(int $courseid): void {
    global $USER, $DB, $PAGE;

    $coursecontext = \context_course::instance($courseid);

    if (!isloggedin() || isguestuser()
            || is_enrolled($coursecontext)
            || has_capability('moodle/course:view', $coursecontext)) {
        return;
    }

    // Prefer a password-less self enrolment instance, as vitrina does.
    $selfinstance = $DB->get_record('enrol', [
        'courseid' => $courseid,
        'enrol' => 'self',
        'status' => ENROL_INSTANCE_ENABLED,
    ], '*', IGNORE_MULTIPLE);

    if ($selfinstance && empty($selfinstance->password)) {
        $selfplugin = enrol_get_plugin('self');
        if ($selfplugin) {
            $selfplugin->enrol_self($selfinstance);
        }
    }

    // Fall back to a manual enrolment instance when no self enrolment applies.
    if (!is_enrolled($coursecontext)) {
        $manualinstance = $DB->get_record('enrol', [
            'courseid' => $courseid,
            'enrol' => 'manual',
            'status' => ENROL_INSTANCE_ENABLED,
        ], '*', IGNORE_MULTIPLE);

        if ($manualinstance && !empty($manualinstance->roleid)) {
            $manualplugin = enrol_get_plugin('manual');
            if ($manualplugin) {
                $manualplugin->enrol_user($manualinstance, $USER->id, (int)$manualinstance->roleid);
            }
        }
    }

    // The enrolment flow triggers notifications/events that initialise the page
    // output and lock the theme for the current request. Continuing here would
    // make require_course_login() call $PAGE->set_course() after the theme was
    // already set up, which throws a coding_exception. Redirect back to the
    // same page so the now-enrolled user loads it fresh in the next request.
    if (is_enrolled($coursecontext)) {
        redirect($PAGE->url);
    }
}

/**
 * Normalize a channel/path string: unify slashes and strip all whitespace.
 *
 * Mirrors the matching logic used by the local mention plugin's
 * reviewer resolution.
 *
 * @param string $value Raw channel value.
 * @return string
 */
function mod_hsuforum_discuss_embed_normalize_channel(string $value): string {
    $value = str_replace(['\\', '／', '＼'], '/', $value);
    return (string)preg_replace('/\s+/', '', $value);
}

/**
 * Extract the list of channels set on a data record.
 *
 * Channels are stored in a data field whose description is literally
 * "channels"; the field value is a "##"-separated list.
 *
 * @param stdClass $data mod_data activity record.
 * @param stdClass $record data record.
 * @return array List of original (trimmed) channel names.
 */
function mod_hsuforum_discuss_embed_get_record_channels(stdClass $data, stdClass $record): array {
    global $DB;

    if (empty($data->id) || empty($record->id)) {
        return [];
    }

    // Prefer a field whose description is literally "channels"; fall back to a
    // field literally named "channels" for setups that identify it by name.
    $channelsfield = $DB->get_record_sql(
        "SELECT id FROM {data_fields} WHERE dataid = :dataid AND " . $DB->sql_compare_text('description') . " = :channels",
        ['dataid' => (int)$data->id, 'channels' => 'channels']
    );
    if (!$channelsfield) {
        $channelsfield = $DB->get_record('data_fields', ['dataid' => (int)$data->id, 'name' => 'channels'], 'id', IGNORE_MISSING);
    }
    if (!$channelsfield) {
        return [];
    }

    $value = $DB->get_field('data_content', 'content', [
        'recordid' => (int)$record->id,
        'fieldid' => (int)$channelsfield->id,
    ]);
    if (empty($value)) {
        return [];
    }

    return array_values(array_filter(array_map('trim', preg_split('/##/', (string)$value))));
}

/**
 * Resolve the first user configured to review a matching channel via the
 * "<database name>审批" additional profile field (located in the "配置项"
 * category). Mirrors the local mention plugin's matching logic.
 *
 * @param stdClass $data mod_data activity record (its name forms the field name).
 * @param string $channel Normalized channel to match.
 * @return int|null First matching user id, or null when none configured.
 */
function mod_hsuforum_discuss_embed_resolve_channel_reviewer(stdClass $data, string $channel): ?int {
    global $DB;

    if (empty($data->id) || empty($data->name)) {
        return null;
    }

    $fieldname = $data->name . '审批';
    $userfield = $DB->get_record_sql(
        "SELECT id FROM {user_info_field} WHERE " . $DB->sql_compare_text('name', 255) . " = :name",
        ['name' => $fieldname]
    );
    if (!$userfield) {
        return null;
    }

    $userdatas = $DB->get_records('user_info_data', ['fieldid' => (int)$userfield->id]);
    foreach ($userdatas as $userdata) {
        $raw = (string)$userdata->data;
        if ((int)$userdata->dataformat === 1) {
            $raw = preg_replace('/<br\s*\/?>/i', "\n", $raw);
            $raw = preg_replace('/<\/(p|div|li|h[1-6]|tr)>/i', "\n", $raw);
            $raw = strip_tags($raw);
        }
        $lines = array_values(array_filter(array_map('trim', preg_split('/\r?\n/', $raw))));
        foreach ($lines as $line) {
            if (mod_hsuforum_discuss_embed_normalize_channel($line) === $channel) {
                return (int)$userdata->userid;
            }
        }
    }

    return null;
}

/**
 * Ensure a "咨询专家" discussion exists in the consultant forum for a
 * channel, reusing the previously created one when available.
 *
 * Reuse key: (forum id, creator id, title). The reviewer matched for the
 * channel is set as the discussion creator.
 *
 * @param int $forumid hsuforum instance id to create the discussion in.
 * @param string $channel Original channel name used as discussion title.
 * @param int $creatorid User set as discussion creator (matched reviewer).
 * @return int Discussion id, or 0 when the forum is unavailable.
 */
function mod_hsuforum_discuss_embed_ensure_channel_discussion(int $forumid, string $channel, int $creatorid): int {
    global $DB;

    if ($forumid <= 0 || $channel === '' || $creatorid <= 0) {
        return 0;
    }

    $existingid = $DB->get_field(
        'hsuforum_discussions',
        'id',
        ['forum' => $forumid, 'userid' => $creatorid, 'name' => $channel],
        IGNORE_MULTIPLE
    );
    if ($existingid) {
        return (int)$existingid;
    }

    $forum = $DB->get_record('hsuforum', ['id' => $forumid], '*', IGNORE_MISSING);
    if (!$forum) {
        return 0;
    }

    $discussion = new stdClass();
    $discussion->course = (int)$forum->course;
    $discussion->forum = (int)$forum->id;
    $discussion->name = $channel;
    $discussion->message = get_string('tab_consultant_message', 'hsuforum', $channel);
    $discussion->messageformat = FORMAT_HTML;
    $discussion->messagetrust = 0;
    $discussion->mailnow = 0;
    $discussion->reveal = 1;
    $discussion->groupid = -1;
    $discussion->timestart = 0;
    $discussion->timeend = 0;
    $discussion->pinned = 0;

    return (int)hsuforum_add_discussion($discussion, null, null, $creatorid);
}

/**
 * Render a standalone, iframe-friendly multi-tab page (comment + consultant
 * expert tabs). Used when type=1 with an iid mode data record.
 *
 * @param stdClass $forum Target forum of the comment mode (fid param).
 * @param stdClass $data mod_data activity record.
 * @param stdClass $record data record.
 * @param int $commentdiscussionid Resolved comment-mode discussion id.
 * @return void
 */
function mod_hsuforum_discuss_embed_render_tabs_page(stdClass $forum, stdClass $data, stdClass $record, int $commentdiscussionid): void {
    global $DB;

    // The consultant forum instance that hosts the "咨询专家" discussions.
    // The value is the course-module id of that forum (as seen in
    // /mod/hsuforum/view.php?id=N). Configurable in hsuforum's global plugin
    // settings; defaults to 138 when not configured.
    $consultforumcmid = (int)get_config('hsuforum', 'consultforumcmid');
    if (empty($consultforumcmid)) {
        $consultforumcmid = 138;
    }

    // Resolve the course-module id to its hsuforum instance.
    $consultforum = null;
    $consultforumcm = get_coursemodule_from_id('hsuforum', $consultforumcmid, 0, false, MUST_EXIST);
    if ($consultforumcm && !empty($consultforumcm->instance)) {
        $consultforum = $DB->get_record('hsuforum', ['id' => (int)$consultforumcm->instance], '*', IGNORE_MISSING);
    }

    // Ensure the current user is enrolled in the consultant forum's course too,
    // otherwise they could not view the embedded consultant discussions.
    if ($consultforum) {
        mod_hsuforum_discuss_embed_auto_enrol_course((int)$consultforum->course);
    }

    header('Content-Type: text/html; charset=utf-8');

    // Comment tab re-uses the original iid-mode result.
    $tabs = [];
    $commenturl = new \core\url('/mod/hsuforum/discuss.php', ['d' => $commentdiscussionid, 'embed' => 1, 'embed_type' => 'comment']);
    $tabs[] = [
        'key' => 'comment',
        'main' => get_string('tab_comment', 'hsuforum'),
        'sub' => get_string('tab_comment_sub', 'hsuforum'),
        'url' => $commenturl->out(false),
        'icon' => 'comment',
    ];

    // Consultant expert tabs: one per channel with a matched reviewer.
    if ($consultforum) {
        $channels = mod_hsuforum_discuss_embed_get_record_channels($data, $record);
        $consulttabs = [];
        $n = 0;
        foreach ($channels as $channel) {
            $reviewerid = mod_hsuforum_discuss_embed_resolve_channel_reviewer(
                $data,
                mod_hsuforum_discuss_embed_normalize_channel($channel)
            );
            if (!$reviewerid) {
                continue;
            }
            $discussionid = mod_hsuforum_discuss_embed_ensure_channel_discussion($consultforum->id, $channel, $reviewerid);
            if (!$discussionid) {
                continue;
            }
            $n++;
            $consulttabs[] = [
                'key' => 'consult-' . $n,
                'main' => get_string('tab_consultant', 'hsuforum'),
                'channel' => $channel,
                'url' => (new \core\url('/mod/hsuforum/discuss.php', ['d' => $discussionid, 'embed' => 1, 'embed_type' => 'consult']))->out(false),
                'icon' => 'consult',
            ];
        }
        // When there is only one consultant tab, keep the subtitle fixed instead
        // of showing the channel name.
        $usesinglesub = count($consulttabs) === 1;
        foreach ($consulttabs as $ctab) {
            $ctab['sub'] = $usesinglesub
                ? get_string('tab_consultant_single', 'hsuforum')
                : get_string('tab_consultant_channel', 'hsuforum', $ctab['channel']);
            $tabs[] = $ctab;
        }
    }

    $iconcomment = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" '
        . 'stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>';
    $iconconsult = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" '
        . 'stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>'
        . '<path d="M10 9a2 2 0 1 1 4 0c0 1.5-2 2-2 3.5"/><line x1="12" y1="17" x2="12" y2="17.01"/></svg>';

    $tabhtml = '';
    $panelhtml = '';
    foreach ($tabs as $tab) {
        $icon = $tab['icon'] === 'consult' ? $iconconsult : $iconcomment;
        $tabhtml .= '<button type="button" class="dc-tab" data-panel="' . s($tab['key']) . '">'
            . '<span class="dc-tab-text">'
            . '<span class="dc-tab-main">' . s($tab['main']) . '</span>'
            . '<span class="dc-tab-sub">' . s($tab['sub']) . '</span>'
            . '</span>'
            . '<span class="dc-tab-icon">' . $icon . '</span>'
            . '</button>';
        $panelhtml .= '<div class="dc-panel" id="' . s($tab['key']) . '">'
            . '<iframe data-src="' . s($tab['url']) . '" title="' . s($tab['main']) . '"></iframe>'
            . '</div>';
    }

    $first = $tabs[0]['key'] ?? '';
    echo '<!DOCTYPE html><html lang="zh-cn"><head><meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<title>' . s(get_string('discussion', 'hsuforum')) . '</title>';
    echo '<style>
        html, body { margin: 0; padding: 0; background: #f6f7f9; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; }
        .dc-tabs-scroll { position: sticky; top: 0; z-index: 20; overflow-x: auto; overflow-y: hidden; background: #fff; border-bottom: 1px solid #e5e7eb; scrollbar-width: thin; }
        .dc-tabs { display: flex; gap: 8px; padding: 10px 12px; min-width: max-content; }
        .dc-tab { display: flex; align-items: center; justify-content: space-between; column-gap: 16px;
            border: 1px solid #e5e7eb; background: #f9fafb; color: #374151; border-radius: 8px;
            padding: 8px 12px; cursor: pointer; text-align: left; transition: all .15s ease; }
        .dc-tab:hover { border-color: #c7d2fe; }
        .dc-tab.active { border-color: #4f46e5; background: #eef2ff; box-shadow: 0 1px 2px rgba(79,70,229,.15); }
        .dc-tab-text { display: flex; flex-direction: column; align-items: flex-start; }
        .dc-tab-main { font-size: 15px; font-weight: 600; line-height: 1.2; color: #111827; }
        .dc-tab.active .dc-tab-main { color: #4338ca; }
        .dc-tab-sub { font-size: 13px; line-height: 1.3; color: #6b7280; margin-top: 3px; }
        .dc-tab-icon { color: #9ca3af; flex-shrink: 0; }
        .dc-tab.active .dc-tab-icon { color: #4f46e5; }
        .dc-panel { display: none; }
        .dc-panel.active { display: block; }
        .dc-panel iframe { display: block; width: 100%; border: 0; min-height: 360px; }
    </style>';
    echo '</head><body>';
    echo '<div class="dc-tabs-scroll"><div class="dc-tabs" role="tablist">' . $tabhtml . '</div></div>';
    echo '<div class="dc-panels">' . $panelhtml . '</div>';
    echo '<script data-first="' . s($first) . '">
(function() {
    var first = document.currentScript.getAttribute("data-first");
    var tabs = Array.prototype.slice.call(document.querySelectorAll(".dc-tab"));
    var panels = Array.prototype.slice.call(document.querySelectorAll(".dc-panel"));
    var iframes = panels.map(function(p) { return p.querySelector("iframe"); });
    function autosize(frame) {
        if (!frame) { return; }
        try {
            var doc = frame.contentDocument;
            if (!doc) { return; }
            var body = doc.body, html = doc.documentElement;
            var h = Math.max(
                body.scrollHeight || 0, html.scrollHeight || 0,
                body.offsetHeight || 0, html.offsetHeight || 0
            );
            if (h > 0) {
                // The inner page often fills (tracks) the iframe viewport, so
                // measuring its height returns the current frame height. Growing
                // every tick would then feed back into itself and grow forever.
                // Once the content fits or fills the current height, hold steady;
                // only grow when it genuinely overflows the current height.
                var cur = parseInt(frame.style.height, 10) || 0;
                if (cur > 0 && h <= cur) {
                    frame.style.height = cur + "px";
                } else {
                    frame.style.height = (h + 12) + "px";
                }
            }
        } catch (e) { /* cross-origin */ }
    }
    function activate(key) {
        tabs.forEach(function(t) { t.classList.toggle("active", t.getAttribute("data-panel") === key); });
        panels.forEach(function(p) {
            var on = p.id === key;
            p.classList.toggle("active", on);
            var frame = p.querySelector("iframe");
            if (on && frame) {
                if (!frame.getAttribute("src") && frame.getAttribute("data-src")) {
                    frame.setAttribute("src", frame.getAttribute("data-src"));
                } else if (frame.contentDocument && frame.contentDocument.readyState === "complete") {
                    autosize(frame);
                }
            }
        });
        var activeTab = tabs.filter(function(t) { return t.getAttribute("data-panel") === key; })[0];
        if (activeTab && activeTab.scrollIntoView) {
            activeTab.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "nearest" });
        }
    }
    tabs.forEach(function(t) {
        t.addEventListener("click", function() { activate(t.getAttribute("data-panel")); });
    });
    iframes.forEach(function(frame) {
        if (frame) {
            frame.addEventListener("load", function() { autosize(frame); });
        }
    });
    // Keep the active embedded page height fresh when the reply form expands.
    setInterval(function() {
        var active = document.querySelector(".dc-panel.active iframe");
        if (active) { autosize(active); }
    }, 600);
    if (first) { activate(first); }
})();
</script>';
    echo '</body></html>';
    exit;
}

$type = optional_param('type', 0, PARAM_INT);

$iid = optional_param('iid', 0, PARAM_INT);
$cid = optional_param('cid', 0, PARAM_INT);
$fid = required_param('fid', PARAM_INT);

if (empty($cid) && empty($iid)) {
    throw new \core\exception\moodle_exception('missingparameter');
}

$usecidmode = !empty($cid);

$urlparams = ['fid' => $fid];
if (!empty($cid)) {
    $urlparams['cid'] = $cid;
}
if (!empty($iid)) {
    $urlparams['iid'] = $iid;
}

$url = new \core\url('/mod/hsuforum/discuss_embed.php', $urlparams);
$PAGE->set_url($url);

$forum = $DB->get_record('hsuforum', ['id' => $fid], '*', MUST_EXIST);
$course = $DB->get_record('course', ['id' => $forum->course], '*', MUST_EXIST);
$cm = get_coursemodule_from_instance('hsuforum', $forum->id, $course->id, false, MUST_EXIST);
$forumcontext = context_module::instance($cm->id);

// Auto-enrol the current logged-in, non-guest user into the forum's course when
// they are not yet enrolled (e.g. an external integration that opens this page
// before the user completes the enrolment flow). This gives them the student
// role, without which they would not be allowed to post in the forum.
// Guests and anonymous visitors are left for require_course_login() to handle.
mod_hsuforum_discuss_embed_auto_enrol_course((int)$course->id);

require_course_login($course, true, $cm);
require_capability('mod/hsuforum:viewdiscussion', $forumcontext);

// Build mode-specific seed data.
$seed = $usecidmode
    ? mod_hsuforum_discuss_embed_prepare_cid_seed($cid, $forum)
    : mod_hsuforum_discuss_embed_prepare_iid_seed($iid, $forum);

$discussionid = mod_hsuforum_discuss_embed_resolve_discussionid($forum, $seed, $usecidmode);

// Target page: when type=1 with an iid-mode data record, render the multi-tab
// page (comment + consultant expert tabs) instead of redirecting.
if ($type === 1 && !$usecidmode && !empty($iid)) {
    $record = $DB->get_record('data_records', ['id' => $iid], '*', MUST_EXIST);
    $data = $DB->get_record('data', ['id' => $record->dataid], '*', MUST_EXIST);
    mod_hsuforum_discuss_embed_render_tabs_page($forum, $data, $record, (int)$discussionid);
    // mod_hsuforum_discuss_embed_render_tabs_page() echoes the page and exits.
}

// Hand off final rendering to discuss.php in embed mode.
$targeturl = new \core\url('/mod/hsuforum/discuss.php', ['d' => $discussionid, 'embed' => 1]);
redirect($targeturl);