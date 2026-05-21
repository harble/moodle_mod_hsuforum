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
 * Embedded discussion page for mapping mod_data entry -> hsuforum discussion.
 *
 * URL params:
 * - iid: mod_data record id (data_records.id)
 * - fid: hsuforum activity instance id (hsuforum.id)
 *
 * @package   mod_hsuforum
 * @copyright 1999 onwards Martin Dougiamas
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_hsuforum\local;

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/mod/hsuforum/lib.php');

$iid = required_param('iid', PARAM_INT);
$fid = required_param('fid', PARAM_INT);

$url = new \core\url('/mod/hsuforum/discuss_embed.php', ['iid' => $iid, 'fid' => $fid]);
$PAGE->set_url($url);

$record = $DB->get_record('data_records', ['id' => $iid], '*', MUST_EXIST);
$data = $DB->get_record('data', ['id' => $record->dataid], '*', MUST_EXIST);

$forum = $DB->get_record('hsuforum', ['id' => $fid], '*', MUST_EXIST);
$course = $DB->get_record('course', ['id' => $forum->course], '*', MUST_EXIST);
$cm = get_coursemodule_from_instance('hsuforum', $forum->id, $course->id, false, MUST_EXIST);
$forumcontext = context_module::instance($cm->id);

require_course_login($course, true, $cm);
require_capability('mod/hsuforum:viewdiscussion', $forumcontext);

$datacm = get_coursemodule_from_instance('data', $data->id, $data->course, false, MUST_EXIST);
$datacontext = context_module::instance($datacm->id);
require_capability('mod/data:viewentry', $datacontext);

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

$subject = core_text::substr($subject, 0, 255);
$message = '欢迎在此讨论区咨询或评论';

$creatorid = (int)$record->userid;
if (!$DB->record_exists('user', ['id' => $creatorid])) {
    $creatorid = $USER->id;
}

$discussionid = null;
$timenow = time();

$transaction = $DB->start_delegated_transaction();
$map = $DB->get_record('hsuforum_data_discussion_map', ['iid' => $record->id, 'fid' => $forum->id]);

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

if (empty($discussionid)) {
    $discussion = new stdClass();
    $discussion->course = $forum->course;
    $discussion->forum = $forum->id;
    $discussion->name = $subject;
    $discussion->message = $message;
    $discussion->messageformat = FORMAT_HTML;
    $discussion->messagetrust = 0;
    $discussion->mailnow = 0;
    $discussion->reveal = 0;
    $discussion->groupid = !empty($record->groupid) ? (int)$record->groupid : -1;
    $discussion->timestart = 0;
    $discussion->timeend = 0;
    $discussion->pinned = 0;

    $discussionid = (int)hsuforum_add_discussion($discussion, null, null, $creatorid);

    if (empty($map)) {
        $map = new stdClass();
        $map->iid = $record->id;
        $map->fid = $forum->id;
        $map->discussionid = $discussionid;
        $map->timecreated = $timenow;
        $map->timemodified = $timenow;
        $DB->insert_record('hsuforum_data_discussion_map', $map);
    } else {
        $map->discussionid = $discussionid;
        $map->timemodified = $timenow;
        $DB->update_record('hsuforum_data_discussion_map', $map);
    }
}

$transaction->allow_commit();

$discussion = $DB->get_record('hsuforum_discussions', ['id' => $discussionid], '*', MUST_EXIST);
$post = hsuforum_get_post_full($discussion->firstpost);

if (!$post) {
    throw new \core\exception\moodle_exception('notexists', 'hsuforum', new \core\url('/mod/hsuforum/view.php', ['id' => $cm->id]));
}

if (!hsuforum_user_can_see_post($forum, $discussion, $post, null, $cm, false)) {
    throw new \core\exception\moodle_exception('noviewdiscussionspermission', 'hsuforum');
}

hsuforum_discussion_view($forumcontext, $forum, $discussion);

$PAGE->set_context($forumcontext);
$PAGE->set_cm($cm, $course);
$PAGE->set_pagelayout('embedded');
$PAGE->set_title(format_string($subject));
$PAGE->set_heading($course->fullname);
$PAGE->add_body_class('forumtype-' . $forum->type);

$renderer = $PAGE->get_renderer('mod_hsuforum');
$PAGE->requires->js_init_call('M.mod_hsuforum.init', null, false, $renderer->get_js_module());

echo $OUTPUT->header();
echo $renderer->svg_sprite();

$canreply = hsuforum_user_can_post($forum, $discussion, $USER, $cm, $course, $forumcontext);
if (!$canreply && $forum->type !== 'news') {
    if (isguestuser() || !isloggedin()) {
        $canreply = true;
    }
    if (!is_enrolled($forumcontext) && !is_viewing($forumcontext)) {
        $canreply = enrol_selfenrol_available($course->id);
    }
}

$canrate = local::cached_has_capability('mod/hsuforum:rate', $forumcontext);
hsuforum_print_discussion($course, $cm, $forum, $discussion, $post, $canreply, $canrate);

echo $OUTPUT->footer();
