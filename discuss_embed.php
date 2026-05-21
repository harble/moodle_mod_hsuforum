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

require_course_login($course, true, $cm);
require_capability('mod/hsuforum:viewdiscussion', $forumcontext);

$message = get_string('discussembedwelcomemessage', 'hsuforum');
$subject = '';
$creatorid = (int)$USER->id;
$mappingtable = '';
$mappingkey = [];
$discussiongroupid = -1;

if ($usecidmode) {
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

    $creatorid = mod_hsuforum_discuss_embed_resolve_course_creatorid($sourcecourse);
    $mappingtable = 'hsuforum_course_discussion_map';
    $mappingkey = ['cid' => $sourcecourse->id, 'fid' => $forum->id];
} else {
    $record = $DB->get_record('data_records', ['id' => $iid], '*', MUST_EXIST);
    $data = $DB->get_record('data', ['id' => $record->dataid], '*', MUST_EXIST);

    $datacm = get_coursemodule_from_instance('data', $data->id, $data->course, false, MUST_EXIST);
    $datacontext = context_module::instance($datacm->id);
    require_capability('mod/data:viewentry', $datacontext);

    if (!empty($data->approval) && empty($record->approved)) {
        mod_hsuforum_discuss_embed_notice(get_string('discussembedrequiresapproval', 'hsuforum'));
    }

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
    $mappingtable = 'hsuforum_data_discussion_map';
    $mappingkey = ['iid' => $record->id, 'fid' => $forum->id];
    $discussiongroupid = !empty($record->groupid) ? (int)$record->groupid : -1;
}

$subject = core_text::substr($subject, 0, 255);

$discussionid = null;
$timenow = time();

// Keep map lookup/create/update in one transaction for consistency.
$transaction = $DB->start_delegated_transaction();
$map = $DB->get_record($mappingtable, $mappingkey);

// Reuse previously mapped discussion when possible and sync title if it changed.
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
        $DB->update_record('hsuforum_data_discussion_map', $map);
    }
}

// Create a new discussion if no valid mapped discussion exists.
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

// Hand off final rendering to discuss.php in embed mode.
$targeturl = new \core\url('/mod/hsuforum/discuss.php', ['d' => $discussionid, 'embed' => 1]);
redirect($targeturl);
