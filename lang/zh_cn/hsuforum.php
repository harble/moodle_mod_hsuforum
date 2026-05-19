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
 * Strings for component 'hsuforum', language 'en', branch 'MOODLE_20_STABLE'
 *
 * @package   mod_hsuforum
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright Copyright (c) 2012 Open LMS (https://www.openlms.net)
 * @author    Mark Nielsen
 */

$string['activityoverview'] = '有新的论坛帖子';
$string['addanewdiscussion'] = '添加新讨论主题';
$string['addanewtopic'] = '添加新讨论';
$string['advancedsearch'] = '高级搜索';
$string['allforums'] = '所有论坛';
$string['allowdiscussions'] = '{$a} 可以在此论坛发帖吗？';
$string['allowsallsubscribe'] = '此论坛允许所有人自行选择是否订阅';
$string['allowsdiscussions'] = '此论坛允许每人开启一个讨论主题。';
$string['allsubscribe'] = '订阅所有论坛';
$string['allunsubscribe'] = '取消订阅所有论坛';
$string['alreadyfirstpost'] = '这已经是讨论中的第一条帖子';
$string['anyfile'] = '任意文件';
$string['areapost'] = '消息';
$string['attachment'] = '附件';
$string['attachment_help'] = '您可以选择在论坛帖子中附加一个或多个文件。如果附加图片，将在消息后显示。';
$string['attachmentnopost'] = '没有帖子 ID，无法导出附件';
$string['attachments'] = '附件';
$string['blockafter'] = '触发屏蔽的发帖阈值';
$string['blockafter_help'] = '此设置指定用户在指定时间段内可发布的最大帖子数。具有 mod/hsuforum:postwithoutthrottling 权限的用户不受此限制。';
$string['blockperiod'] = '屏蔽的时间段';
$string['blockperiod_help'] = '可限制学生在指定时间段内发帖数量。具有 mod/hsuforum:postwithoutthrottling 权限的用户不受此限制。';
$string['blockperioddisabled'] = '不限制';
$string['blogforum'] = '以博客形式显示的标准论坛';
$string['bynameondate'] = '由 {$a->name} 发布于 {$a->date}';
$string['cannotadd'] = '无法在此论坛添加讨论';
$string['cannotadddiscussion'] = '在此论坛发起讨论需要属于某个小组。';
$string['cannotadddiscussionall'] = '你无权为所有参与者添加新讨论主题。';
$string['cannotadddiscussiongroup'] = '你不是任何小组成员，因此无法创建讨论。';
$string['cannotaddsubscriber'] = '无法将 ID 为 {$a} 的用户添加为此论坛的订阅者！';
$string['cannotaddteacherforumto'] = '无法将转换后的教师论坛实例添加到课程第 0 节';
$string['cannotcreatediscussion'] = '无法创建新讨论';
$string['cannotcreateinstanceforteacher'] = '无法为教师论坛创建新的课程模块实例';
$string['cannotdeletepost'] = '您无法删除此帖子！';
$string['cannoteditposts'] = '您无法编辑他人的帖子！';
$string['cannotfinddiscussion'] = '在此论坛中找不到该讨论';
$string['cannotfindfirstpost'] = '在此论坛中找不到第一条帖子';
$string['cannotfindorcreateforum'] = '无法找到或创建站点主公告论坛';
$string['cannotfindparentpost'] = '找不到帖子 {$a} 的顶层父帖';
$string['cannotmovefromsingleforum'] = '无法从单一简单讨论论坛移动讨论';
$string['cannotmovenotvisible'] = '论坛不可见';
$string['cannotmovetonotexist'] = '无法移动到该论坛——该论坛不存在！';
$string['cannotmovetonotfound'] = '在此课程中未找到目标论坛。';
$string['cannotmovetosingleforum'] = '无法将讨论移动到单一简单讨论论坛';
$string['cannotpurgecachedrss'] = '无法清除源论坛或目标论坛的 RSS 缓存——请检查文件权限';
$string['cannotremovesubscriber'] = '无法从此论坛移除 ID 为 {$a} 的订阅者！';
$string['cannotreply'] = '你不能回复此帖子';
$string['cannotsplit'] = '此论坛的讨论无法拆分';
$string['cannotsubscribe'] = '抱歉，您必须是组成员才能订阅。';
$string['cannottrack'] = '无法停止追踪该论坛';
$string['cannotunsubscribe'] = '无法为您取消订阅该论坛';
$string['cannotupdatepost'] = '你无法更新此帖子';
$string['cannotviewpostyet'] = '由于您尚未发帖，目前无法查看其他学生在此讨论中的问题';
$string['cannotviewusersposts'] = '此用户没有您可查看的帖子。';
$string['cleanreadtime'] = '标记旧帖为已读的时刻';
$string['completiondetail:discussions'] = '发起讨论：{$a}';
$string['completiondetail:replies'] = '发表回复：{$a}';
$string['completiondetail:posts'] = '发表论坛帖子：{$a}';
$string['completiondiscussions'] = '学生必须发起讨论：';
$string['completiondiscussionsdesc'] = '学生至少需要发起 {$a} 个讨论';
$string['completiondiscussionsgroup'] = '要求发起讨论';
$string['completiondiscussionshelp'] = '需要发起讨论才能完成';
$string['completionposts'] = '学生必须发表讨论或回复：';
$string['completionpostsdesc'] = '学生至少需要发表 {$a} 个讨论或回复';
$string['completionpostsgroup'] = '要求发帖';
$string['completionpostshelp'] = '需要发起讨论或回复才能完成';
$string['completionreplies'] = '学生必须发表回复：';
$string['completionrepliesdesc'] = '学生至少需要发表 {$a} 条回复';
$string['completionrepliesgroup'] = '要求回复';
$string['completionreplieshelp'] = '需要回复才能完成';
$string['configcleanreadtime'] = '每天清理"已读"表中旧帖子的时间（小时）。';
$string['configdigestmailtime'] = '选择以摘要形式接收邮件的用户将每天收到摘要邮件。此设置控制每天发送摘要邮件的时间（该时间之后运行的下一个定时任务将发送邮件）。';
$string['configenablerssfeeds'] = '此开关将启用所有论坛的 RSS 订阅功能。您仍需在每个论坛的设置中手动开启订阅。';
$string['configenabletimedposts'] = '设置为"是"以允许在发布新论坛讨论时设置展示时间段。';
$string['configlongpost'] = '超过此长度（不含 HTML 的字符数）的帖子视为长帖。显示在网站首页、社交格式课程页面或用户个人资料的帖子将在 hsuforum_shortpost 和 hsuforum_longpost 值之间的自然断点处缩短。';
$string['configmanydiscussions'] = '每页显示的最大讨论数';
$string['configmaxattachments'] = '每帖默认最大附件数。';
$string['configmaxbytes'] = '网站所有论坛附件的默认最大大小（受课程限制和其他本地设置影响）';
$string['configoldpostdays'] = '帖子被视为已读的天数。';
$string['configreplytouser'] = '当论坛帖子通过邮件发送时，是否包含用户的电子邮件地址以便收件人直接回复？即使设置为"是"，用户也可在个人资料中选择隐藏邮件地址。';
$string['configrsstypedefault'] = '如果启用了 RSS 订阅，则设置默认活动类型。';
$string['configrssarticlesdefault'] = '如果启用了 RSS 订阅，则设置默认文章数量（讨论或帖子）。';
$string['configsubscriptiontype'] = '订阅模式的默认设置。';
$string['configshortpost'] = '低于此长度（不含 HTML 的字符数）的帖子视为短帖（见下文）。';
$string['configusermarksread'] = '设置为"是"时，用户需手动将帖子标记为已读；设置为"否"时，帖子被查看后自动标记为已读。';
$string['confirmsubscribe'] = '你确定要订阅论坛“{$a}”吗？';
$string['confirmunsubscribe'] = '你确定要取消订阅论坛“{$a}”吗？';
$string['couldnotadd'] = '因未知错误无法发布你的帖子';
$string['couldnotdeletereplies'] = '抱歉，由于已有人回复，无法删除该帖子';
$string['couldnotupdate'] = '因未知错误无法更新你的帖子';
$string['crontask'] = '开放论坛邮件发送与维护任务';
$string['delete'] = '删除';
$string['deleteddiscussion'] = '该讨论主题已删除';
$string['deletedpost'] = '该帖子已被删除';
$string['deletedposts'] = '这些帖子已被删除';
$string['deletesure'] = '确定要删除此帖子吗？';
$string['deletesureplural'] = '确定要删除此帖子及所有回复吗？（共 {$a} 条帖子）';
$string['digestmailheader'] = '这是您来自 {$a->sitename} 论坛的每日新帖摘要。如需更改默认论坛邮件偏好，请前往 {$a->userprefs}。';
$string['digestmailpost'] = '更改论坛摘要偏好';
$string['digestmailpostlink'] = '更改论坛摘要偏好：{$a}';
$string['digestmailprefs'] = '你的用户资料';
$string['digestmailsubject'] = '{$a}：论坛摘要';
$string['digestmailtime'] = '发送摘要邮件的时刻';
$string['digestsentusers'] = '已成功向 {$a} 位用户发送摘要邮件。';
$string['disallowsubscribe'] = '不允许订阅';
$string['disallowsubscribeteacher'] = '不允许订阅（教师除外）';
$string['discussion'] = '讨论';
$string['discussionforum'] = '{$a} 主题的讨论';
$string['discussionlocked'] = '此讨论已被锁定，你无法再回复。';
$string['discussionlockingheader'] = '讨论锁定';
$string['discussionlockingdisabled'] = '不锁定讨论';
$string['discussionmoved'] = '此讨论已移至: {$a}。';
$string['discussionmovedpost'] = '此讨论已移至论坛 <a href="{$a->forumhref}">{$a->forumname}</a> 中的<a href="{$a->discusshref}">此处</a>';
$string['discussionname'] = '讨论名称';
$string['discussionpin'] = '置顶';
$string['discussionpinned'] = '已置顶';
$string['discussionpinned_help'] = '置顶的讨论将显示在论坛顶部。';
$string['discussionsplit'] = '讨论已被拆分';
$string['discussions'] = '讨论';
$string['discussionsstartedby'] = '{$a} 发起的讨论';
$string['discussionsstartedbyrecent'] = '{$a} 最近发起的讨论';
$string['discussionsstartedbyuserincourse'] = '{$a->fullname} 在 {$a->coursename} 中发起的讨论';
$string['discussionunpin'] = '取消置顶';
$string['discussthistopic'] = '讨论此主题';
$string['displayend'] = '显示结束时间';
$string['displayend_help'] = '此设置指定论坛帖子是否在特定日期后隐藏。注意：管理员始终可以查看论坛帖子。';
$string['displayperiod'] = '显示时间段';
$string['displaystart'] = '显示开始时间';
$string['displaystart_help'] = '此设置指定论坛帖子是否从特定日期起显示。注意：管理员始终可以查看论坛帖子。';
$string['displaywordcount'] = '显示字数统计';
$string['displaywordcount_help'] = '此设置指定是否显示每篇帖子的字数统计。';
$string['eachuserforum'] = '每人发起一个讨论';
$string['edit'] = '编辑';
$string['editedby'] = '由 {$a->name} 编辑 - 原始提交时间：{$a->date}';
$string['editedpostupdated'] = '{$a}\'s post was updated';
$string['editing'] = '编辑中';
$string['eventcoursesearched'] = '课程搜索';
$string['eventdiscussioncreated'] = '讨论已创建';
$string['eventdiscussionupdated'] = '讨论已更新';
$string['eventdiscussiondeleted'] = '讨论已删除';
$string['eventdiscussionmoved'] = '讨论已移动';
$string['eventdiscussionviewed'] = '讨论已查看';
$string['eventuserreportviewed'] = '用户报告已查看';
$string['eventdiscussionpinned'] = '讨论已置顶';
$string['eventdiscussionunpinned'] = '讨论已取消置顶';
$string['eventpostcreated'] = '帖子已创建';
$string['eventpostdeleted'] = '帖子已删除';
$string['eventpostupdated'] = '帖子已更新';
$string['eventreadtrackingdisabled'] = '阅读追踪已禁用';
$string['eventreadtrackingenabled'] = '阅读追踪已启用';
$string['eventsubscribersviewed'] = '订阅者已查看';
$string['eventsubscriptioncreated'] = '订阅已创建';
$string['eventsubscriptiondeleted'] = '订阅已删除';
$string['eventdiscussionsubscriptioncreated'] = '讨论订阅已创建';
$string['eventdiscussionsubscriptiondeleted'] = '讨论订阅已删除';
$string['emaildigestcompleteshort'] = '完整帖子';
$string['emaildigestdefault'] = '默认（{$a}）';
$string['emaildigestoffshort'] = '不使用摘要';
$string['emaildigestsubjectsshort'] = '仅主题';
$string['emaildigesttype'] = '邮件摘要选项';
$string['emaildigesttype_help'] = '你将为每个论坛接收的通知类型。

* 默认 - 使用你在个人资料中的摘要设置。如果你更新了个人资料，此处也会同步更新；
* 不使用摘要 - 每有一条论坛帖子，你都会收到一封邮件；
* 摘要 - 完整帖子 - 你每天会收到一封摘要邮件，包含每条论坛帖子的完整内容；
* 摘要 - 仅主题 - 你每天会收到一封摘要邮件，只包含每条论坛帖子的主题。
';
$string['emaildigestupdated'] = '论坛 \'{$a->forum}\' 的邮件摘要选项已更改为 \'{$a->maildigesttitle}\'。{$a->maildigestdescription}';
$string['emaildigestupdated_default'] = '您的默认设置 \'{$a->maildigesttitle}\' 已用于论坛 \'{$a->forum}\'。{$a->maildigestdescription}。';
$string['emaildigest_0'] = '每条帖子将向你发送一封邮件。';
$string['emaildigest_1'] = '每天向你发送一封包含所有帖子完整内容的摘要邮件。';
$string['emaildigest_2'] = '每天向你发送一封仅包含帖子主题的摘要邮件。';
$string['emptymessage'] = '您的帖子存在问题。可能是内容为空或附件太大。您的更改未被保存。';
$string['erroremptymessage'] = '帖子内容不能为空';
$string['erroremptysubject'] = '帖子主题不能为空。';
$string['errorenrolmentrequired'] = '你必须注册此课程才能访问此内容';
$string['errorwhiledelete'] = '删除记录时发生错误。';
$string['errortimestartgreater'] = '开始时间不能晚于结束时间。';
$string['eventassessableuploaded'] = '已发布一些内容。';
$string['everyonecanchoose'] = '所有人可自行选择是否订阅';
$string['everyonecannowchoose'] = '现在所有人可自行选择是否订阅';
$string['everyoneisnowsubscribed'] = '所有人现在均已订阅此论坛';
$string['everyoneissubscribed'] = '所有人均已订阅此论坛';
$string['existingsubscribers'] = '现有订阅者';
$string['exportdiscussion'] = '将整个讨论导出到作品集';
$string['forcessubscribe'] = '此论坛强制所有人订阅';
$string['forum'] = '论坛';
$string['from'] = '发件人';
$string['gradingmethodpreview'] = '评分标准';
$string['hsuforum:addinstance'] = '添加新论坛';
$string['hsuforum:allowforcesubscribe'] = '允许强制订阅';
$string['forumauthorhidden'] = '作者（已隐藏）';
$string['forumblockingalmosttoomanyposts'] = '您即将达到发帖上限。您在过去 {$a->blockperiod} 内已发帖 {$a->numposts} 次，上限为 {$a->blockafter} 条。';
$string['forumbodyhidden'] = '您无法查看此帖子，可能是因为您尚未在讨论中发帖、最大编辑时间尚未过去、讨论尚未开始或讨论已过期。';
$string['forumintro'] = '描述';
$string['hsuforum:canposttomygroups'] = '可向您有权访问的所有组发帖';
$string['hsuforum:createattachment'] = '创建附件';
$string['hsuforum:deleteanypost'] = '删除任意帖子（任何时间）';
$string['hsuforum:deleteownpost'] = '删除自己的帖子（在截止期内）';
$string['hsuforum:editanypost'] = '编辑任意帖子';
$string['hsuforum:exportdiscussion'] = '导出整个讨论';
$string['hsuforum:exportownpost'] = '导出自己的帖子';
$string['hsuforum:exportpost'] = '导出帖子';
$string['hsuforum:managesubscriptions'] = '管理订阅者';
$string['hsuforum:movediscussions'] = '移动讨论';
$string['hsuforum:pindiscussions'] = '置顶讨论';
$string['hsuforum:postwithoutthrottling'] = '豁免发帖上限';
$string['forumname'] = '论坛名称';
$string['forumposts'] = '论坛帖子';
$string['hsuforum:addnews'] = '添加公告';
$string['hsuforum:addquestion'] = '添加问题';
$string['hsuforum:canoverridediscussionlock'] = '回复已锁定的讨论';
$string['hsuforum:rate'] = '对帖子评分';
$string['hsuforum:replynews'] = '回复公告';
$string['hsuforum:replypost'] = '回复帖子';
$string['forums'] = '论坛';
$string['hsuforum:splitdiscussions'] = '拆分讨论';
$string['hsuforum:startdiscussion'] = '发起新讨论';
$string['forumsubjecthidden'] = '主题（已隐藏）';
$string['forumtracked'] = '正在追踪未读帖子';
$string['forumtrackednot'] = '未追踪未读帖子';
$string['forumtype'] = '论坛类型';
$string['forumtype_help'] = 'There are 5 forum types:

* A single simple discussion - A single discussion topic to which everyone can reply (cannot be used with separate groups)
* Each person posts one discussion - Each student can post exactly one new discussion topic, to which everyone can then reply
* Q and A forum - Students must first post their perspectives before viewing other students\' posts
* Standard forum displayed in a blog-like format - An open forum where anyone can start a new discussion at any time, and in which discussion topics are displayed on one page with "Discuss this topic" links
* Standard forum for general use - An open forum where anyone can start a new discussion at any time';
$string['hsuforum:viewallratings'] = '查看个人给出的所有原始评分';
$string['hsuforum:viewanyrating'] = '查看任何人收到的总评分';
$string['hsuforum:viewdiscussion'] = '查看讨论';
$string['hsuforum:viewhiddentimedposts'] = '查看隐藏的定时帖子';
$string['hsuforum:viewqandawithoutposting'] = '始终查看问答帖子';
$string['hsuforum:viewrating'] = '查看您收到的总评分';
$string['hsuforum:viewsubscribers'] = '查看订阅者';
$string['hsuforum:viewposters'] = '查看论坛发帖者';
$string['hsuforum:allowprivate'] = '允许用户私下回复';
$string['generalforum'] = '通用标准论坛';
$string['generalforums'] = '通用论坛';
$string['hiddenforumpost'] = '隐藏的论坛帖子';
$string['indicator:cognitivedepth'] = '论坛认知深度';
$string['indicator:cognitivedepth_help'] = '此指标基于学生在论坛活动中达到的认知深度。';
$string['indicator:socialbreadth'] = '论坛社交广度';
$string['indicator:socialbreadth_help'] = '此指标基于学生在论坛活动中达到的社交广度。';
$string['inforum'] = '在 {$a} 中';
$string['introblog'] = '此论坛中的帖子是从本课程用户的博客自动复制而来的，因为那些博客条目已不再可用';
$string['intronews'] = '一般新闻与公告';
$string['introsocial'] = '一个可以畅谈任何话题的开放式论坛';
$string['introteacher'] = '仅供教师记录和讨论的论坛';
$string['invalidaccess'] = '此页面访问方式不正确';
$string['invaliddiscussionid'] = '讨论 ID 不正确或已不存在';
$string['invaliddigestsetting'] = '提供了无效的邮件摘要设置';
$string['invalidforcesubscribe'] = '无效的强制订阅模式';
$string['invalidforumid'] = '论坛 ID 不正确';
$string['invalidparentpostid'] = '父帖 ID 不正确';
$string['invalidpostid'] = '无效的帖子 ID：{$a}';
$string['lastposttimeago'] = '最后发帖于 {$a}';
$string['learningforums'] = '学习论坛';
$string['lockdiscussionafter'] = '在一段不活跃时间后锁定讨论';
$string['lockdiscussionafter_help'] = 'Discussions may be automatically locked after a specified time has elapsed since the last reply.

Users with the capability to reply to locked discussions can unlock a discussion by replying to it.';
$string['longpost'] = '长帖';
$string['mailnow'] = '立即发送邮件通知（不等待编辑时间）';
$string['manydiscussions'] = '每页显示的讨论数';
$string['managesubscriptionsoff'] = '完成订阅管理';
$string['managesubscriptionson'] = '管理订阅者';
$string['markalldread'] = '将此讨论中的所有帖子标记为已读。';
$string['markallread'] = '将此论坛中的所有帖子标记为已读。';
$string['markasreadonnotification'] = '发送论坛帖子通知时';
$string['markasreadonnotificationno'] = '不将帖子标记为已读';
$string['markasreadonnotificationyes'] = '将帖子标记为已读';
$string['markasreadonnotification_help'] = '当您收到论坛帖子通知时，可以选择是否将该帖子标记为已读（用于论坛追踪）。';
$string['markread'] = '标记为已读';
$string['markreadbutton'] = '标记为<br />已读';
$string['markunread'] = '标记为未读';
$string['markunreadbutton'] = '标记为<br />未读';
$string['maxattachments'] = '最大附件数量';
$string['maxattachments_help'] = '此设置指定论坛帖子可附加的最大文件数。';
$string['maxattachmentsize'] = '最大附件大小';
$string['maxattachmentsize_help'] = '此设置指定论坛帖子中可附加的最大文件大小。';
$string['maxtimehaspassed'] = '抱歉，编辑此帖子的最长时间（{$a}）已过！';
$string['message'] = '消息';
$string['messageinboundattachmentdisallowed'] = '无法发布您的回复，因为其中包含附件，而该论坛不允许附件。';
$string['messageinboundfilecountexceeded'] = '无法发布您的回复，因为附件数量超过了论坛允许的最大数量（{$a->forum->maxattachments}）。';
$string['messageinboundfilesizeexceeded'] = '无法发布您的回复，因为附件总大小（{$a->filesize}）超过了论坛允许的最大大小（{$a->maxbytes}）。';
$string['messageinboundforumhidden'] = '无法发布您的回复，因为论坛目前不可用。';
$string['messageinboundnopostforum'] = '无法发布您的回复，因为您没有在 {$a->forum->name} 论坛发帖的权限。';
$string['messageinboundthresholdhit'] = '无法发布您的回复。您已超过该论坛设定的发帖上限';
$string['messageprovider:digests'] = '已订阅的开放论坛摘要';
$string['messageprovider:posts'] = '已订阅的开放论坛帖子';
$string['missingsearchterms'] = '以下搜索词仅出现在此消息的 HTML 标记中：';
$string['modeflatnewestfirst'] = '平铺显示回复，最新的在前';
$string['modeflatoldestfirst'] = '平铺显示回复，最旧的在前';
$string['modenested'] = '以嵌套形式显示回复';
$string['modethreaded'] = '以线程形式显示回复';
$string['modulename'] = '开放论坛';
$string['modulename_help'] = 'The Open Forum activity module enables participants to have asynchronous discussions,
i.e., discussions that take place over an extended period of time.

There are several forum types to choose from, such as a standard forum where anyone can start a new discussion at any time; a forum where each student can post exactly one discussion; or a question and answer forum where students must first post before being able to view other students\' posts. A teacher can allow files to be attached to forum posts. Attached images are displayed in the forum post.

Participants can subscribe to a forum to receive notifications of new forum posts. A teacher can set the subscription mode to optional, forced or auto, or prevent subscription completely. If required, students can be blocked from posting more than a given number of posts in a given time period; this can prevent individuals from dominating discussions.

Forum posts can be rated by teachers or students (peer evaluation). Ratings can be aggregated to form a final grade which is recorded in the gradebook.

Forums have many uses, such as:

* A social space for students to get to know each other
* For course announcements (using a news forum with forced subscription)
* For discussing course content or reading materials
* For continuing online an issue raised previously in a face-to-face session
* For teacher-only discussions (using a hidden forum)
* A help centre where tutors and students can give advice
* A one-on-one support area for private student-teacher communications (using a forum with separate groups and with one student per group)
* For extension activities, for example ‘brain teasers’ for students to ponder and suggest solutions';
$string['modulename_link'] = 'mod/hsuforum/view';
$string['modulenameplural'] = '开放论坛';
$string['more'] = '更多';
$string['movedmarker'] = '已移动';
$string['movethisdiscussionto'] = '将此讨论移至...';
$string['mustprovidediscussionorpost'] = '您必须提供讨论 ID 或帖子 ID 才能导出';
$string['myprofileownpost'] = '我的开放论坛帖子';
$string['myprofileowndis'] = '我的开放论坛讨论';
$string['myprofileotherpost'] = '开放论坛帖子';
$string['myprofileotherdis'] = '开放论坛讨论';
$string['namenews'] = '公告';
$string['namenews_help'] = '课程公告论坛是专门用于发布公告的特殊论坛，在创建课程时自动创建。一个课程只能有一个公告论坛。只有教师和管理员可以发布公告。"最新公告"区块将显示最近的公告。';
$string['namesocial'] = '社交论坛';
$string['newforumposts'] = '最新论坛帖子';
$string['nextdiscussion'] = '更新的讨论';
$string['noattachments'] = '此帖子没有附件';
$string['nodiscussionsstartedby'] = '{$a} 尚未发起任何讨论';
$string['nodiscussionsstartedbyyou'] = '您尚未发起任何讨论';
$string['noguestpost'] = '抱歉，访客不允许发帖。';
$string['noguesttracking'] = '抱歉，访客不允许设置追踪选项。';
$string['nomorepostscontaining'] = '未找到更多包含 \'{$a}\' 的帖子';
$string['nonews'] = '尚未发布任何公告。';
$string['noonecansubscribenow'] = '订阅已被禁止';
$string['nopermissiontosubscribe'] = '你没有查看论坛订阅者的权限';
$string['nopermissiontoview'] = '你没有查看此帖子的权限';
$string['nopostforum'] = '抱歉，您不被允许在此论坛发帖';
$string['noposts'] = '暂无帖子';
$string['nopostsmadebyuser'] = '{$a} has made no posts';
$string['nopostsmadebyyou'] = '您尚未发布任何帖子';
$string['nosubscribers'] = '此论坛尚无订阅者';
$string['notexists'] = '讨论已不存在';
$string['nothingnew'] = '{$a} 没有新内容';
$string['notingroup'] = '抱歉，您需要成为某个组的成员才能查看此论坛。';
$string['notinstalled'] = '论坛模块未安装';
$string['notpartofdiscussion'] = '此帖子不属于任何讨论！';
$string['notrackforum'] = '不追踪未读帖子';
$string['noviewdiscussionspermission'] = '你没有查看此论坛讨论的权限';
$string['nowallsubscribed'] = '你已订阅 {$a} 中的所有论坛。';
$string['nowallunsubscribed'] = '你已取消订阅 {$a} 中的所有论坛。';
$string['nownotsubscribed'] = '{$a->name} 不会再收到论坛“{$a->forum}”的新帖通知';
$string['nownottracking'] = '{$a->name} is no longer tracking \'{$a->forum}\'.';
$string['nowsubscribed'] = '{$a->name} 将收到论坛“{$a->forum}”的新帖通知';
$string['nowtracking'] = '{$a->name} is now tracking \'{$a->forum}\'.';
$string['numposts'] = '{$a} 条帖子';
$string['olderdiscussions'] = '更旧的讨论';
$string['oldertopics'] = '更旧的主题';
$string['oldpostdays'] = '多少天后视为已读';
$string['openmode0'] = '无讨论，无回复';
$string['openmode1'] = '无讨论，但允许回复';
$string['openmode2'] = '允许讨论和回复';
$string['overviewnumpostssince'] = '自上次登录以来有 {$a} 条帖子';
$string['overviewnumunread'] = '共 {$a} 条未读';
$string['page-mod-hsuforum-x'] = '任何论坛模块页面';
$string['page-mod-hsuforum-view'] = '论坛模块主页';
$string['page-mod-hsuforum-discuss'] = '论坛模块讨论主题页';
$string['parent'] = '显示父帖';
$string['parentofthispost'] = '此帖的父帖';
$string['pluginadministration'] = '论坛管理';
$string['pluginname'] = '开放论坛';
$string['postadded'] = '<p>Your post was successfully added.</p> <p>如果您想进行更改，还有 {$a} 的时间可以编辑。</p>';
$string['postaddedsuccess'] = '你的帖子已成功发布。';
$string['postaddedtimeleft'] = '如果您想进行更改，还有 {$a} 的时间可以编辑。';
$string['postbymailsuccess'] = '恭喜，您以主题"{$a->subject}"发布的论坛帖子已成功添加。您可以在 {$a->discussionurl} 查看它。';
$string['postbymailsuccess_html'] = '恭喜，您以主题"{$a->subject}"发布的<a href="{$a->discussionurl}">论坛帖子</a>已成功发布。';
$string['postbyuser'] = '{$a->post}（由 {$a->user} 发布）';
$string['postincontext'] = '在上下文中查看此帖子';
$string['postmailinfolink'] = 'This is a copy of a message posted in {$a->coursename}.

To reply click on this link: {$a->replylink}';
$string['postmailnow'] = '<p>This post will be mailed out immediately to all forum subscribers.</p>';
$string['postmailsubject'] = '{$a->courseshortname}: {$a->subject}';
$string['postrating1'] = '以独立知识为主';
$string['postrating2'] = '独立与联系知识不分伯仲';
$string['postrating3'] = '以联系知识为主';
$string['posts'] = '帖子';
$string['postsmadebyuser'] = '{$a} 发表的帖子';
$string['postsmadebyuserincourse'] = '{$a->fullname} 在 {$a->coursename} 中发表的帖子';
$string['postoptions'] = '帖子选项';
$string['posttoforum'] = '发布到论坛';
$string['posttomygroups'] = '向所有组发送一份副本';
$string['posttomygroups_help'] = '此消息将向您有权访问的所有组发送副本。您无权访问的组中的参与者将看不到此帖子';
$string['postupdated'] = '你的帖子已更新';
$string['potentialsubscribers'] = '可订阅用户';
$string['previousdiscussion'] = '更旧的讨论';

$string['privacy:digesttypepreference'] = '您已选择接收以下论坛摘要类型：{$a->type}。';
$string['privacy:discussionsubscriptionpreference'] = '您已为此论坛选择以下讨论订阅偏好：{$a->preference}';

$string['privacy:metadata:hsuforum_digests'] = '每个开放论坛的摘要偏好信息。';
$string['privacy:metadata:hsuforum_digests:hsuforum'] = '已订阅的开放论坛。';
$string['privacy:metadata:hsuforum_digests:maildigest'] = '摘要偏好。';
$string['privacy:metadata:hsuforum_digests:userid'] = '具有摘要偏好的用户 ID。';
$string['privacy:metadata:hsuforum_discussion_subs'] = '个别论坛讨论的订阅信息。';
$string['privacy:metadata:hsuforum_discussions:name'] = '由作者设置的讨论名称。';
$string['privacy:metadata:hsuforum_discussions:userid'] = '创建讨论的用户 ID';
$string['privacy:metadata:hsuforum_discussions:assessed'] = '讨论的评分类型';
$string['privacy:metadata:hsuforum_discussions:timemodified'] = '讨论最后修改的时间。';
$string['privacy:metadata:hsuforum_discussions:usermodified'] = '以某种方式最后修改讨论的用户 ID。';
$string['privacy:metadata:hsuforum_discussions'] = '关于用户创建的各个论坛讨论的信息。';

$string['privacy:metadata:hsuforum_queue:userid'] = '将被通知的用户 ID。';
$string['privacy:metadata:hsuforum_queue:discussionid'] = '讨论 ID。';
$string['privacy:metadata:hsuforum_queue:postid'] = '帖子 ID。';
$string['privacy:metadata:hsuforum_queue:timemodified'] = '原始帖子的修改时间。';
$string['privacy:metadata:hsuforum_queue'] = '用于追踪将被邮件发送的帖子的信息。';


$string['privacy:metadata:hsuforum_posts:discussion'] = '帖子所在的讨论。';
$string['privacy:metadata:hsuforum_posts:parent'] = '被回复的父帖子。';
$string['privacy:metadata:hsuforum_posts:created'] = '帖子创建的时间。';
$string['privacy:metadata:hsuforum_posts:modified'] = '帖子最后修改的时间。';
$string['privacy:metadata:hsuforum_posts:subject'] = '开放论坛帖子的主题。';
$string['privacy:metadata:hsuforum_posts:message'] = '开放论坛帖子的内容。';
$string['privacy:metadata:hsuforum_posts:userid'] = '撰写开放论坛帖子的用户 ID。';
$string['privacy:metadata:hsuforum_posts'] = '关于开放论坛帖子的数据。';

$string['privacy:metadata:hsuforum_subscriptions_disc:discussion'] = '已订阅的讨论 ID。';
$string['privacy:metadata:hsuforum_subscriptions_disc:userid'] = '具有讨论订阅的用户 ID。';
$string['privacy:metadata:hsuforum_subscriptions_disc'] = '个别开放论坛讨论的订阅信息。';

$string['privacy:metadata:hsuforum_read:userid'] = '此记录所关联的用户 ID。';
$string['privacy:metadata:hsuforum_read:discussionid'] = '帖子所在的讨论。';
$string['privacy:metadata:hsuforum_read:postid'] = '已读的帖子。';
$string['privacy:metadata:hsuforum_read:firstread'] = '帖子首次被阅读的时间。';
$string['privacy:metadata:hsuforum_read:lastread'] = '帖子最近一次被阅读的时间。';
$string['privacy:metadata:hsuforum_read'] = '关于用户已读帖子的信息。';

$string['privacy:metadata:hsuforum_subscriptions:userid'] = '此开放论坛订阅所关联的用户 ID。';
$string['privacy:metadata:hsuforum_subscriptions:forum'] = '已订阅的论坛。';
$string['privacy:metadata:hsuforum_subscriptions'] = '关于用户已订阅的开放论坛的信息。';

$string['privacy:metadata:hsuforum_track_prefs:userid'] = '此开放论坛追踪偏好所关联的用户 ID。';
$string['privacy:metadata:hsuforum_track_prefs:forumid'] = '已启用阅读追踪的开放论坛。';
$string['privacy:metadata:hsuforum_track_prefs'] = '关于用户选择追踪帖子阅读情况的论坛信息。';

$string['privacy:metadata:hsuforum_discussion_subs:discussionid'] = '已订阅的讨论 ID。';
$string['privacy:metadata:hsuforum_discussion_subs:preference'] = '订阅的开始时间。';
$string['privacy:metadata:hsuforum_discussion_subs:userid'] = '具有讨论订阅的用户 ID。';
$string['privacy:metadata:hsuforum_discussion_subs'] = '个别论坛讨论的订阅信息';

$string['privacy:metadata:hsuforum_grades:forum'] = '被评分的论坛';
$string['privacy:metadata:hsuforum_grades:grade'] = '授予的成绩';
$string['privacy:metadata:hsuforum_grades:userid'] = '被评分的用户';
$string['privacy:metadata:hsuforum_grades'] = '论坛的成绩数据';

$string['privacy:metadata:core_tag'] = '开放论坛利用标签子系统支持对帖子进行标记。';
$string['privacy:metadata:core_rating'] = '开放论坛利用评分子系统支持对帖子进行评分。';


$string['privacy:metadata:preference:autosubscribe'] = '在回复帖子时是否订阅相关讨论。';
$string['privacy:metadata:preference:maildigest'] = '全站邮件摘要偏好。';
$string['privacy:metadata:preference:markasreadonnotification'] = '将论坛帖子作为消息接收时是否标记为已读。';
$string['privacy:metadata:preference:trackforums'] = '是否启用阅读追踪。';

$string['privacy:subscribedtoforum'] = '您已订阅此论坛。';
$string['privacy:readtrackingdisabled'] = '您已选择不追踪在此论坛中已读的帖子。';
$string['privacy:postwasread'] = '此帖子于 {$a->firstread} 首次被阅读，最近一次阅读于 {$a->lastread}';

$string['privacy:request:delete:post:message'] = '此帖子的内容应作者要求已被删除。';
$string['privacy:request:delete:post:subject'] = '应作者要求删除';
$string['privacy:request:delete:discussion:name'] = '应作者要求删除';
$string['processingdigest'] = '正在处理用户 {$a} 的邮件摘要';
$string['processingpost'] = '处理帖子 {$a}';
$string['prune'] = '拆分';
$string['prunedpost'] = '已从该帖子创建了新讨论';
$string['pruneheading'] = '拆分讨论并将此帖子移至新讨论';
$string['qandaforum'] = '问答论坛';
$string['qandanotify'] = '这是一个问答论坛。要查看其他人对这些问题的回答，您必须先发布您的答案';
$string['re'] = '回复：';
$string['readtherest'] = '阅读该主题其余内容';
$string['removeallforumtags'] = '移除所有论坛标签';
$string['replies'] = '回复';
$string['repliesmany'] = '目前共有 {$a} 条回复';
$string['repliesone'] = '目前共有 {$a} 条回复';
$string['reply'] = '回复';
$string['replyforum'] = '回复论坛';
$string['replytopostbyemail'] = '你可以通过电子邮件回复此帖。';
$string['replytouser'] = '在回复中使用电子邮件地址';
$string['reply_handler'] = '通过电子邮件回复开放论坛帖子';
$string['reply_handler_name'] = '回复开放论坛帖子';
$string['resetforums'] = '删除帖子来自';
$string['resetforumsall'] = '删除所有帖子';
$string['resetdigests'] = '删除所有用户论坛摘要偏好';
$string['resetsubscriptions'] = '删除所有论坛订阅';
$string['resettrackprefs'] = '删除所有论坛躺读偏好';
$string['rsssubscriberssdiscussions'] = '讨论的 RSS 订阅';
$string['rsssubscriberssposts'] = '帖子的 RSS 订阅';
$string['rssarticles'] = 'RSS 最新文章条数';
$string['rssarticles_help'] = '此设置指定 RSS 订阅中包含的文章数量（讨论或帖子）。通常 5 到 20 条可接受。';
$string['rsstype'] = '此活动的 RSS 订阅';
$string['rsstype_help'] = '要启用此活动的 RSS 订阅，请选择在订阅中包含讨论或帖子。';
$string['rsstypedefault'] = 'RSS 订阅类型';
$string['search'] = '搜索';
$string['search:post'] = '开放论坛 - 帖子';
$string['search:activity'] = '开放论坛 - 活动信息';
$string['searchdatefrom'] = '帖子日期必须新于此';
$string['searchdateto'] = '帖子日期必须旧于此';
$string['searchforumintro'] = '请在以下一个或多个字段中输入搜索条件：';
$string['searchforums'] = '搜索';
$string['searchfullwords'] = '这些词应以完整单词形式出现';
$string['searchnotwords'] = '这些词不应包含在内';
$string['searcholderposts'] = '搜索较早的帖子...';
$string['searchphrase'] = '帖子中必须包含此确切短语';
$string['searchresults'] = '搜索结果';
$string['searchsubject'] = '这些词应在主题中';
$string['searchtags'] = '标签包含';
$string['searchuser'] = '此名称应与作者匹配';
$string['searchuserid'] = '作者的 Moodle ID';
$string['searchwhichforums'] = '选择要搜索的论坛';
$string['searchwords'] = '这些词用于全文搜索';
$string['seeallposts'] = '查看该用户发布的所有帖子';
$string['shortpost'] = '短帖';
$string['showsubscribers'] = '查看/编辑论坛订阅者';
$string['showrecent'] = '在课程页面显示近期帖子';
$string['showrecent_help'] = '开启后，将在课程页面显示最近的帖子。';
$string['showsubstantive'] = '允许标记为加精';
$string['showsubstantive_help'] = '开启后，教师可标记具有实质价值的帖子（加精）。';
$string['showsubstantivedisabledglobally'] = '加精功能已在插件全局端禁用。';
$string['showbookmark'] = '允许收藏帖子';
$string['showbookmark_help'] = '开启后，用户可以收藏论坛帖子。';
$string['showbookmarkdisabledglobally'] = '收藏功能已在插件全局端禁用。';
$string['singleforum'] = '单个简单讨论';
$string['smallmessage'] = '{$a->user} posted in {$a->forumname}';
$string['smallmessagedigest'] = '包含 {$a} 条消息的论坛摘要';
$string['startedby'] = '发起者';
$string['subject'] = '主题';
$string['subscribe'] = '订阅此论坛';
$string['subscribeshort'] = '订阅';
$string['subscribeall'] = '为所有人订阅此论坛';
$string['subscribeenrolledonly'] = '对不起，只有已选课的用户才能订阅论坛帖子通知。';
$string['subscribed'] = '已订阅';
$string['subscribenone'] = '取消所有人对此论坛的订阅';
$string['subscribers'] = '订阅者';
$string['subscriberstowithcount'] = '"{$a->name}"的订阅者（{$a->count}）';
$string['subscribestart'] = '接收此论坛新帖通知';
$string['subscribestop'] = '不再接收此论坛新帖通知';
$string['subscription'] = '订阅';
$string['subscription_help'] = '如果您已订阅论坛，则您将收到新帖子的通知。通常您可以选择是否订阅，但有时订阅是强制性的，所有人都会收到通知。';
$string['subscriptionmode'] = '订阅模式';
$string['subscriptionmode_help'] = '当参与者订阅了论坛，他们将收到论坛帖子通知。有 4 种订阅模式：

* 可选订阅 - 参与者可自行选择是否订阅
* 强制订阅 - 所有人都已订阅且无法取消
* 自动订阅 - 所有人默认订阅，但可随时取消
* 订阅禁用 - 不允许订阅';
$string['subscriptionoptional'] = '可选订阅';
$string['subscriptionforced'] = '强制订阅';
$string['subscriptionauto'] = '自动订阅';
$string['subscriptiondisabled'] = '订阅已禁用';
$string['subscriptions'] = '订阅';
$string['tagarea_hsuforum_posts'] = '论坛帖子';
$string['tagsdeleted'] = '论坛标签已删除';
$string['thisforumisthrottled'] = '此论坛限制了您在指定时间段内的发帖数量，当前限制为在 {$a->blockperiod} 内发帖 {$a->blockafter} 条';
$string['timedhidden'] = '定时状态：对学生隐藏';
$string['timedposts'] = '定时帖子';
$string['timedvisible'] = '定时状态：对所有用户可见';
$string['timestartenderror'] = '展示结束日期不能早于开始日期';
$string['to'] = '收件人';
$string['trackforum'] = '躺读未读帖子';
$string['trackreadposts_header'] = '论坛躺读';
$string['unread'] = '未读';
$string['unreadposts'] = '未读';
$string['unreadpostsnumber'] = '{$a} 条未读帖子';
$string['unreadpostsone'] = '1 条未读帖子';
$string['unsubscribe'] = '取消订阅此论坛';
$string['unsubscribelink'] = '取消订阅此论坛：{$a}';
$string['unsubscribediscussion'] = '取消订阅此讨论';
$string['unsubscribediscussionlink'] = '取消订阅此讨论：{$a}';
$string['unsubscribeall'] = '取消订阅所有论坛';
$string['unsubscribeallconfirm'] = '您当前已订阅 {$a} 个论坛。确定要取消所有论坛订阅并禁用自动订阅吗？';
$string['unsubscribealldone'] = '所有可选论坛订阅已删除。强制订阅的论坛通知仍将发送。如需管理论坛通知，请前往个人资料设置中的消息中心。';
$string['unsubscribeallempty'] = '您尚未订阅任何论坛。如需关闭所有通知，请前往个人资料设置中的消息中心。';
$string['unsubscribed'] = '已取消订阅';
$string['unsubscribeshort'] = '取消订阅';
$string['usermarksread'] = '手动消息已读标记';
$string['viewalldiscussions'] = '查看所有讨论';
$string['viewthediscussion'] = '查看讨论';
$string['warnafter'] = '论坛唻圆警告';
$string['warnafter_help'] = '当学生接近指定时间段内允许的最大发帖数时，系统会向他们发出警告。此设置指定在多少条帖子后发出警告。具有 mod/hsuforum:postwithoutthrottling 权限的用户不受此限制。';
$string['warnformorepost'] = '警告！此论坛中有多个讨论——将使用最新的一个';
$string['yournewquestion'] = '你的新问题';
$string['yournewtopic'] = '你的新主题';
$string['yourreply'] = '你的回复';

$string['allowanonymous'] = '允许匿名发帖';
$string['allowanonymous_help'] = '如果勾选，查看论坛时每条帖子的作者姓名将被隐藏。';
$string['anonymousfirstname'] = '匿名';
$string['anonymouslastname'] = '用户';
$string['anonymousfirstnamephonetic'] = '匿名';
$string['anonymouslastnamephonetic'] = '用户';
$string['anonymousmiddlename'] = '';
$string['anonymousalternatename'] = '匿名';
$string['reveal'] = '在此帖中显示我的姓名';
$string['reveal_help'] = '勾选后，你的姓名将显示在帖子中，不再匿名。';
$string['hsuforum:revealpost'] = '在匿名论坛中显示自己的身份';
$string['hsuforum:viewflags'] = '查看帖子标记';
$string['hsuforum:canoverridecutoff'] = '在截止日期后发布帖子';
$string['hsuforum:cantogglefavourite'] = '收藏讨论';
$string['hsuforum:grade'] = '评分论坛';
$string['hsuforum:postprivatereply'] = '私密回复帖子';
$string['hsuforum:readprivatereplies'] = '查看私密回复';
$string['viewposters'] = '查看发帖者';
$string['substantive'] = '加精';
$string['toggle:bookmark'] = '收藏';
$string['toggle:subscribe'] = '订阅';
$string['toggle:substantive'] = '加精';
$string['toggled:bookmark'] = '已收藏';
$string['toggled:subscribe'] = '已订阅';
$string['toggled:substantive'] = '已加精';
$string['jsondecodeerror'] = '响应解析失败，请重试。';
$string['ajaxrequesterror'] = '请求未完成，请重试。';
$string['default'] = '默认';
$string['tree'] = '树状';
$string['discussiondisplay'] = '讨论显示方式';
$string['javascriptdisableddisplayformat'] = '您的浏览器已禁用 Javascript。请启用 Javascript 后刷新页面，或选择其他讨论显示方式。';
$string['cansubscribediscerror'] = '你不被允许订阅此讨论。';
$string['unsubscribedisc'] = '取消订阅此讨论';
$string['subscribedisc'] = '订阅此讨论';
$string['showdiscussionsubscribers'] = '显示/编辑讨论订阅者';
$string['discussionsubscribers'] = '讨论订阅者';
$string['privatereply'] = '私密回复';
$string['privatereply_help'] = '勾选后，此帖子仅对你所回复的用户可见，且其他人无法回复此帖。';
$string['privatereplies'] = '允许私密回复';
$string['privatereplies_help'] = 'With this feature, instructors can send a private reply to a forum post. This reply is only viewable by the student that made the original post or reply and invisible to the rest of the students.
';
$string['privaterepliesdisabledglobally'] = '私密回复已全局禁用。';
$string['discussionsortkey:lastreply'] = '最近';
$string['discussionsortkey:created'] = '创建日期';
$string['discussionsortkey:replies'] = '最活跃';
$string['discussionsortkey:subscribe'] = '已订阅';

$string['nextdiscussionx'] = '（{$a}）下一个 >';
$string['prevdiscussionx'] = '< 上一个（{$a}）';
$string['modeflatfirstname'] = '平铺显示回复，按用户名字排序';
$string['modeflatlastname'] = '平铺显示回复，按用户姓氏排序';
$string['nested'] = '嵌套形式';
$string['startedbyx'] = '{$a} 发起';
$string['startedbyxgroupx'] = '{$a->name}（小组：{$a->group}）发起';
$string['lastpostbyx'] = '{$a->name} 于 {$a->time} 发起的最后帖子';
$string['repliesx'] = '回复：{$a}';
$string['unreadx'] = '未读：{$a}';
$string['clicktoexpand'] = '点击显示帖子内容及所有回复';
$string['clicktocollapse'] = '点击隐藏帖子内容及所有回复';
$string['createdbynameondate'] = '{$a->name} 于 {$a->date} 创建';
$string['expandall'] = '展开全部';
$string['collapseall'] = '收起全部';
$string['gradetypenone'] = '无评分';
$string['gradetypemanual'] = '手动评分';
$string['gradetyperating'] = '评分';
$string['gradetype'] = '成绩类型';
$string['gradetype_help'] = '成绩类型用于确定评分方法。

* 无：论坛不进行评分。
* 手动：教师需通过成绩单手动评分。
* 评分：使用评分生成成绩。';
$string['totalsubstantive'] = '加精帖子：{$a}';
$string['totalreplies'] = '回复：{$a}';
$string['totaldiscussions'] = '帖子：{$a}';
$string['totalpostsanddiscussions'] = '帖子总数：{$a}';
$string['totalrating'] = '评分：{$a}';
$string['grade'] = '成绩';
$string['thisisanonymous'] = '该论坛为匿名论坛。';
$string['anonymouswarning'] = '移动此讨论可能会暴露匿名信息，确定要这样做吗？';
$string['totalposts'] = '帖子总数';
$string['completionusegradeerror'] = '无法要求成绩，因为此论坛未启用评分。请删除此完成条件或启用评分。';
$string['splitprivatewarning'] = '你正在拆分一个私密回复。拆分后该帖子将不再保持私密。';
$string['manualwarning'] = '活动评分暂不支持。评分仅可通过课程成绩单获得。';
$string['sortdiscussions'] = '排序讨论';
$string['sortdiscussionsby'] = '排序';
$string['sortdiscussionsbysronlytext'] = '激活排序按钮将导致页面内容更新。';
$string['orderdiscussionsby'] = '排序依据';
$string['displaydiscussionreplies'] = '显示讨论回复数';
$string['discussionsummary'] = '{$a} 的所有论坛讨论列表。标题中的姓名栏是用户名字、姓氏和头像的组合。';
$string['export'] = '导出';
$string['discussion:x'] = '讨论：{$a}';
$string['subjectbyuserondate'] = '{$a->subject}——{$a->author} 于 {$a->date}';
$string['subjectbyprivateuserondate'] = '{$a->subject}（私密）——{$a->author} 于 {$a->date}';
$string['attachments:x'] = '附件：{$a}';
$string['general'] = '一般';
$string['postsfor'] = '帖子列表';
$string['exportformat'] = '导出格式';
$string['csv'] = 'CSV';
$string['print'] = '打印';
$string['plaintext'] = '纯文本';
$string['exportattachments'] = '导出附件';
$string['all'] = '全部';
$string['participants'] = '参与者';
$string['author'] = '作者';
$string['date'] = '日期';
$string['byx'] = '由 {$a}';
$string['postbyx'] = '{$a} 的帖子';
$string['xreplies'] = '{$a} 条回复';
$string['onereply'] = '1 条回复';
$string['xdiscussions'] = '{$a} 个讨论';
$string['onediscussion'] = '1 个讨论';
$string['loadmorediscussions'] = '加载更多讨论';
$string['validationerrorx'] = '提交时出现错误：{$a}';
$string['validationerrorsx'] = '提交时出现 {$a->count} 个错误：{$a->errors}';
$string['messageisrequired'] = '消息内容不能为空';
$string['subjectisrequired'] = '主题不能为空';
$string['replytox'] = '回复 {$a}';
$string['addareply'] = '添加你的回复';
$string['submit'] = '提交';
$string['useadvancededitor'] = '使用高级编辑器及更多选项';
$string['accessible'] = '无障碍访问';
$string['addyourdiscussion'] = '添加你的讨论';
$string['subjectplaceholder'] = '你的主题';
$string['messageplaceholder'] = '输入你的帖子内容';
$string['notuploadedfile'] = '文件上传出现问题，请重试';
$string['trackingoptions'] = '躺读选项';
$string['xunread'] = '{$a} 条新内容';
$string['replybuttontitle'] = '回复 {$a}';
$string['replybyx'] = '{$a} 的回复';
$string['postbyxinreplytox'] = '{$a->parentpost} Reply to {$a->parent} from {$a->author}';
$string['privatereplybyx'] = '私密回复 by {$a}';
$string['postbyxinprivatereplytox'] = '私密回复 to {$a->parent} from {$a->author} ';
$string['inreplyto'] = '回复于';
$string['inprivatereplyto'] = '私密回复于';
$string['options'] = '选项';
$string['articledateformat'] = '%l:%M%P %b %e, %Y';
$string['userdateformat'] = '%l:%M%P %b %e, %Y';
$string['postdeleted'] = '帖子已删除';
$string['postcreated'] = '帖子已创建';
$string['cannnotdeletesinglediscussion'] = '对不起，你无权删除该讨论！';
$string['cannotmakeprivatereplies'] = '对不起，你无权对此论坛进行私密回复';
$string['editingpost'] = '编辑帖子';
$string['deleteattachmentx'] = '删除 {$a}';
$string['deleteattachments'] = '删除附件';
$string['postwasupdated'] = '帖子已更新';
$string['id'] = 'id';
$string['switchtoaccessible'] = '切换到无障碍访问视图';
$string['anonymousrecentactivity'] = '此论坛可能有近期活动，但由于论坛为匿名模式，无法显示详情。';
$string['manageforumsubscriptions'] = '管理论坛订阅';
$string['nonanonymous'] = '非匿名方式';
$string['hiderecentposts'] = '隐藏近期帖子';
$string['confighiderecentposts'] = '设置为是以停止在课程页面显示最近的论坛帖子。';
$string['forumsubjectdeleted'] = '此论坛帖子已被删除';
$string['forumbodydeleted'] = '此论坛帖子的内容已被删除，无法再访问。';
$string['gradeitem:posts'] = '帖子成绩';
// Replacements for deprecated core completion strings of Moodle 4.3+.
$string['completionview'] = '要求查看';
$string['completionusegrade'] = '需要评分才能完成';
$string['completionusegrade_desc'] = '获得成绩';
$string['completionusegrade_help'] = '启用后，当学生获得成绩时活动即视为完成。如果设置了活动及格成绩，则活动完成报告中会显示及格/不及格图标。';











