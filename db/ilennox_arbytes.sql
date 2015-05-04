-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2015 at 06:05 PM
-- Server version: 5.5.42-37.1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ilennox_arbytes`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE IF NOT EXISTS `bookmarks` (
  `user_id` int(7) NOT NULL,
  `post_id` int(7) NOT NULL,
  `is_group_post` int(1) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='if is_group_post : find posts from posts table: else find from status table';

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`user_id`, `post_id`, `is_group_post`, `id`) VALUES
(91, 16, 0, 21),
(91, 71, 1, 15),
(91, 70, 1, 24),
(91, 1, 0, 20);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(7) NOT NULL,
  `author` int(7) NOT NULL,
  `datetime` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(900) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `datetime`, `content`) VALUES
(1, 61, 91, 'February 25, 2015 a	 11:04am', 'thanks'),
(2, 69, 105, 'February 28, 2015 a	 5:54pm', 'You must be the mermaid who took Neptune for a ride'),
(3, 71, 91, 'March 1, 2015 a	 8:34pm', 'Comment'),
(4, 67, 106, 'March 4, 2015 a	 3:33pm', 'alert("hello!");');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`user_id`, `contact_id`) VALUES
(91, 87),
(91, 93),
(91, 102),
(91, 105),
(91, 106),
(97, 98),
(102, 105),
(106, 91),
(106, 105);

-- --------------------------------------------------------

--
-- Table structure for table `file_comments`
--

CREATE TABLE IF NOT EXISTS `file_comments` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `datetime` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(999) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `file_comments`
--

INSERT INTO `file_comments` (`id`, `file_id`, `author`, `datetime`, `content`) VALUES
(3, 6, 81, 'February 5, 2015 a	 2:45pm', 'USB hub!'),
(2, 7, 81, 'February 5, 2015 a	 2:06pm', 'Nice Hours'),
(4, 9, 87, 'February 5, 2015 a	 10:39pm', 'my bae'),
(5, 12, 91, 'February 7, 2015 a	 4:53pm', 'Rosemary''s baby'),
(6, 14, 91, 'February 8, 2015 a	 3:18pm', 'dumb.'),
(7, 14, 91, 'February 8, 2015 a	 3:23pm', 'it''s not even transparent'),
(12, 41, 101, 'February 19, 2015 a	 5:04pm', 'I remember this showing up on an episode of Ally McBeal!'),
(9, 43, 95, 'February 15, 2015 a	 3:24am', 'I completely didn''t realize this was a screenshot version of the in-progress image');

-- --------------------------------------------------------

--
-- Table structure for table `following_status`
--

CREATE TABLE IF NOT EXISTS `following_status` (
  `you` int(7) NOT NULL,
  `following` int(7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `following_status`
--

INSERT INTO `following_status` (`you`, `following`) VALUES
(5, 4),
(91, 93),
(91, 102),
(104, 87),
(104, 91),
(105, 105),
(105, 91),
(91, 91),
(102, 91),
(91, 106),
(106, 91);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(60) NOT NULL,
  `profile_content` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `profile_content`) VALUES
(37, 'CTEC Hackers', 'A place to discuss web development!'),
(38, 'Shades Of Pale', '<em>The lover speaks about the monsters: \r\n\r\nI used to have demons in my room at night</em>');

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

CREATE TABLE IF NOT EXISTS `help` (
  `id` int(11) NOT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(9999) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`id`, `title`, `content`) VALUES
(2, 'Create A Post/Note', 'Companies have Notes, and Groups have Posts. Both posts and notes are the same thing, and are created the same way.<br/><br/>\r\nPosts and Notes are internal updates that only the company or group you belong to can read. You can think of these like status updates, or announcements, or idea sharing --  depending on how your group would like to work together.<br/><br/>\r\nTo create a post, you will navigate to the ''Posts'' or ''Notes'' link on the side navigation. There, yo will see all of your teams posts/notes. Above the posts/notes is a button that reads, "Create a New (Post/Note)".<br/><br/>\r\nGroup View (left) and Company view (right):<br/> \r\n<img src="img/help/create_post.PNG" /><br/><br/>\r\nHere you will see a dropdown that will allow you to insert the title and the content:<br/><br/>\r\n<img src="img/help/add_post.PNG"/><br/><br/>\r\nWhen You click "create" your post will be submitted!'),
(3, 'Upload a Document or Image to Group Files', '<img src="img/help/files.PNG"/><br/><br/>\r\n\r\nUploading Documents and Images into the group files is similar to <a href="#">uploading a post</a>.<br/> <br/><br/>\r\nTo navigate to your group files, you will select "files" from your side menu.<br/><br/>\r\nDepending on whether your logged in with a company or a group, yor view will look slightly different:<br/><br/>\r\n<br/> \r\n<img src="img/help/upload_files.PNG" title="Company vs Group View" /><br/><br/><br/> \r\nHowever, in both views the file upload process is exactly the same. When inside of group files, you will see all of your company/group files and an option to upload an image living above the uploaded files list. When clicked on, a dropdown will slide out offering an upload button and input for a title.\r\n<br/><br/> \r\nAccepted file types are: .png, .PNG, .gif, .jpeg, .jpg, .txt, .docx, .rtf, .csv, .css, .php, and .html.\r\n<br/><br/>\r\nIf there is ever an error uploading a file type that is listed, please contact support with a screenshot of the error with the URL in the capture.\r\n<br/><br/>\r\ncontact@isobellennox.com'),
(4, 'Invite Members to a Group', '<p>If your team is a Group, your group will have members. (A company will have employees)</p>\r\n<p>When a group is first created, only the admin who created it will be in the group. For others to join the group they will need to be invited by email. You can do this by Selecting:</p>\r\n<p>Members > Invite Member</p><br/>\r\n<img src="img/help/members.PNG" title="members list" />\r\n<br/><p>Here, you will be asked to provide the email address for the member you would like to invite. They will then receive a link to join the group!</p>\r\n<br/><p>If your team is a Company, see: <a href="http://arbytes.isobellennox.com/help_single.php?article_id=6">How to Add Employees To Your Company</a></p>'),
(6, 'How to Add Employees To Your Company', '<p>In Company view you can add an employee to your company if you are an Admin.</p>\r\n\r\n<p>To Add an Employee, navigate to:</p>\r\n\r\n<p>Employees > Create Employee Account</p>\r\n\r\n<img src="img/help/employees.PNG" title="employee account" /><br/>\r\n\r\n<p>To prevent unwanted members joining your company, you will create the account for them:</p>\r\n\r\n<img src="img/help/create_employee.PNG" title="employee account" /><br/>\r\n\r\n<p>You can choose to make this employee an admin or note. Admin have the ability to edit and delete posts, notes, articles, and file uploads that are not their own, as well as other employees.</p>\r\n\r\n</p> After the new employee logs in, they can change their username, password, name and email.</p>\r\n\r\n<br/><Br/>\r\n<p>If your team is a group, see: <a href="http://arbytes.isobellennox.com/help_single.php?article_id=4">Invite Members To A Group</a></p>'),
(9, 'What is Arbytes', 'Arbytes is a content management system(CMS) and networking tool that has two different views. Having two views allows for different uses of the site depending on a team''s needs.\r\n<br/><br/>\r\n<h2>Types of views</h2>\r\n<br/><br/>\r\nThe two views when creating a team account on Arbytes are <em>Company</em> and <em>Group</em>.<br/><br/>\r\n\r\nFunctions of each view differ in a few ways, which are drawn out in:\r\n\r\n<a href="http://arbytes.isobellennox.com/help_single.php?article_id=5">What are the differences between Company and Group View?</a>\r\n\r\n<br/><br/>\r\nYou can also walk through each view in:<br/>\r\n<a href="http://arbytes.isobellennox.com/help_single.php?article_id=10">Company View Basics</a><br/>\r\n<a href="http://arbytes.isobellennox.com/help_single.php?article_id=11">Group View Basics</a>\r\n\r\n<br/><br/>\r\nIn both views, a team is able to collaborate using <a href="http://arbytes.isobellennox.com/help_single.php?article_id=3">file uploads</a>, and <a href="http://arbytes.isobellennox.com/help_single.php?article_id=2">writing notes</a> (called ''posts'' in a group).\r\n<br/><br/>\r\nBoth views also offer a blog feature. You can learn more about how the blog feature work by reading ''<a href="http://arbytes.isobellennox.com/help_single.php?article_id=15">Blog Basics</a>''.\r\n\r\n<br/><br/>\r\nIn the settings, you are able to <a href="http://arbytes.isobellennox.com/help_single.php?article_id=14">change and upload themes</a> as well as change account information such as your username, email address, full name and password.\r\n\r\n<br/><br/>\r\nArbytes was created by Isobel Lennox in 2015 as a project in College but also as a personal project in attempts to make an easier-to-use and closer knit social community, as well as a tool for companies that use a ticketing system, all while improving skills in PHP and SQL, which is what the site is built with.\r\n\r\n<br/><br/>'),
(10, 'Company View Basics', '<div><img style="float:left; margin:30px;" src="img/help/company.PNG" title="Company View Navigation" /></div>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt turpis sed dolor vulputate, vel iaculis odio sollicitudin. Cras est neque, cursus non dui sed, viverra luctus risus. Aliquam ultricies nisl felis, iaculis congue nunc posuere id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eget enim a arcu maximus faucibus vel ut magna. Praesent at odio at sem tempor gravida sit amet non justo. Morbi a maximus mauris. Cras at ornare tellus.\r\n\r\nInteger congue vulputate dui, vel consectetur arcu mollis sit amet. Pellentesque id ullamcorper mauris. Curabitur vitae hendrerit lectus. Cras ex tellus, posuere aliquam nisl eu, ullamcorper maximus arcu. Sed fermentum ipsum non bibendum commodo. Sed elementum mattis tristique. Duis ullamcorper quam nibh. Vestibulum tellus nisl, convallis at rhoncus ac, cursus tempus magna. Fusce rhoncus lacus vitae mauris molestie, sed finibus orci placerat.\r\n\r\n\r\n<div style="margin-bottom:900px;"></div>'),
(11, 'Group View Basics', ' \r\n\r\n<div><img style="float:left; margin:30px;" src="img/help/group.PNG" title="Group View Navigation" /></div>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt turpis sed dolor vulputate, vel iaculis odio sollicitudin. Cras est neque, cursus non dui sed, viverra luctus risus. Aliquam ultricies nisl felis, iaculis congue nunc posuere id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eget enim a arcu maximus faucibus vel ut magna. Praesent at odio at sem tempor gravida sit amet non justo. Morbi a maximus mauris. Cras at ornare tellus.\r\n\r\nInteger congue vulputate dui, vel consectetur arcu mollis sit amet. Pellentesque id ullamcorper mauris. Curabitur vitae hendrerit lectus. Cras ex tellus, posuere aliquam nisl eu, ullamcorper maximus arcu. Sed fermentum ipsum non bibendum commodo. Sed elementum mattis tristique. Duis ullamcorper quam nibh. Vestibulum tellus nisl, convallis at rhoncus ac, cursus tempus magna. Fusce rhoncus lacus vitae mauris molestie, sed finibus orci placerat.\r\n\r\n\r\n<div style="margin-bottom:900px;"></div>'),
(13, 'Messages and Notifications', '<img src="img/help/notifications_icons.PNG" title="location of msg/notif" /><br/>\r\n<p>Messages and Notifications are your way of interacting with your team!.<p>\r\n<br/>\r\n<ul>\r\n<li><a href="#check">Checking Messages</a></li>\r\n<li><a href="#create">Create Message</a></li>\r\n<li><a href="#notifications">Notifications</a></li>\r\n</ul>\r\n<br/>\r\n<h2 id="check">Checking and Sending Messages</h2>\r\n<p>To send a message or check messages, you will click on the envelope icon in the upper right corner of the page. This will take you to your messages page:</p>\r\n<img src="img/help/messages.PNG" title="messages page" />\r\n<br/>\r\n<p>Here you will see your conversations, if any and a link to compose a message.</p>\r\n<h3 id="create">Compose Message With Someone New</h3>\r\n<p>To compose a message with someone not listed in your conversations, you will select the "compose message" link. Here, you will be directed to a list of your contacts:</p>\r\n<img src="img/help/select_contact.PNG" title="select contact" /><br/>\r\n<p>By clicking on a contact''s name, you will receive a box to send a message to them. When the message is written, click "SEND" and they will now appear as a conversation in your messages!</p>\r\n<br/><br/>\r\n<h3 id="notifications">Notifications</h3>\r\n<p>Notifications are alerts for new activity within your company or directly with you. To check your notifications, you can click on the bell icon in the upper right hand corner of the page.</p>\r\n<p>You will receive a notification when: </p>\r\n<ul>\r\n<li>A new Note or Post is created</li>\r\n<li>A new article is created (not a feature in groups)</li>\r\n<li>A new file or document is uploaded</li>\r\n<li>A new comment is made on your post, note, article, or file/document upload</li>\r\n<li>A new ticket or invoice is created (not a feature in groups)</li>\r\n<li>You have been added as a client or vendor (not a feature in groups)</li>\r\n<li>Someone has collected your contact information (not a feature in groups)</li>\r\n</ul>\r\n'),
(14, 'Change and Upload Themes', 'To Change and Upload Themes, you will first navigate to <strong>Settings > Colors</strong><br/><Br/>\r\n\r\n<img src="img/help/themes.PNG" title="colors" /><br/><br/>\r\n\r\nWhen you are here you can select a theme by its name to change themes.\r\n<br/><br/>\r\nYou may also select the ''download'' icon to view the code or <strong>right-click>save link as..</strong> to download the theme CSS.<br/><br/>\r\nThis can be useful when you want to use a theme as a template to create your own theme. When you hav created a theme, you may then upload it by selecting "Upload Theme".  You cannot upload a theme that already exists, so you will want to either rename your CSS file, or - if you have been testin gyour theme - Delete the old theme before re-uploading it!');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `profile` varchar(1000) NOT NULL,
  `theme` int(7) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `profile`, `theme`) VALUES
(87, 'Isobel', 'Lennox', 'iso', '$2y$10$nP9OOkzp.dBvV6AyL3jFA.CyMrwt5mkZiYcZx0mm5G97bm3Rma74i', 'isolennox@gmail.com', '', 3),
(91, 'Zora', 'Faulconer', 'admin', '$2y$10$aLB6T13D13Rrg74AyZBfiuD3AL21UX5wRRLJd2Qb2kagnHfn5btsC', 'i.lennox@students.clark.edu', 'Chocolate rain.', 2),
(92, 'Rosemary', 'Perkins', 'rperkins', '$2y$10$TTXr2ls.hPMKNhjZ0kbsKe1XCc6t3qgPAsHKEvKp3liKxSY37EOXS', 'perkinsrosemaryl@gmail.com', 'I have a happy face tattoo on my hand because I''m edgy.  I have a PHP friends with benefits...not quite a boyfriend and no baby yet.', 1),
(93, 'Bette', 'Davis', 'bette', '$2y$10$X3AOuw3aFgn1g2yuseS3ZefNed3Ca23C6bXbdkJwRuIy.vsjPGzm.', 'isolennox@gmail.com', '', 0),
(94, 'LaRhea', 'Phillips', 'l.phillips', '$2y$10$rSnb5BsP6XHajMvW3i84kuKfFg0K/8wO0kB0yC0tuhgb7BgotHLuO', 'larhea.phillips@yahoo.com', '', 1),
(95, 'CassieRose', 'Wangerin', 'SassyCassie', '$2y$10$H2RhVJRSUmAcHTeyQJC7SOjopRv9XpfuZ6QfMIhvowEc/Ta0Y/q8C', 'cascas2693@gmail.com', 'I am Cassie! Hear Me Roar!', 30),
(97, 'Zora', 'Faulconer', 'zora2', '$2y$10$yT7GDbsBh3dErcH.tVZwn.MhqC62Bvov4n1OQU6I8IOTSRNkrabPO', 'i.lennox@students.clark.edu', 'Chocolate rain.', 3),
(98, 'Nina', 'Simone', 'nina', '$2y$10$.8QdusKnn/9dzMKll4e5o.wYqF7uV0jaeuq.qBoDZlFgX4BEwr3Ia', 'none', '', 1),
(99, 'Doobie', 'Bros', 'doobiebros69', '$2y$10$295iZkwnjkiKqtVsvuMR0eO4ozQlGUjH7orieKBffwdjZwFIdW.ye', 'sheesh@ravemail.com', '', 0),
(100, 'Doobie', 'Bros', 'doobiebros', '$2y$10$qxMpXiODdsvJAgLPVh6Yh.Ictto01r8xfuUqZu9w8HNzU1n6qFLzy', 'sheesh@ravemail.com', '', 0),
(101, 'Mona', 'Cody', 'rcody', '$2y$10$6H4OX7OWTATiy56kVArN8.bO5ZXzbqcrBEqP1YrZr8hvLApudkTNO', 'r.cody@students.clark.edu', 'Hacking is one of the great skills that is now being formally taught. \r\n\r\nSome pretty exciting things are coming our way...maybe new game shows on Hacking.\r\n\r\nMaybe....Tic Hack Dough...', 11),
(102, 'Roy', 'Orbison', 'roy', '$2y$10$mnPZTDlO6fbwx5Tcu2MeOuGuWELJG0YWgH/JQsGnKj7Z9gSFUARE2', 'isolennox@gmail.com', 'A candy colored clown they call the sandman tiptoes to my room every night.', 3),
(103, 'Brucie', 'Elgort', 'brucie', '$2y$10$rRnoA6R/UArZfjW0vMlHLOmAXbeXHiMQYzb4o/kBcJ.aN9RdaWibu', 'isolennox@gmail.com', '', 0),
(104, 'Kenny', 'Scott', 'PseudoCool', '$2y$10$6YCI8Bkgux541kctYAxx0.ZxJTt24sQXefWAEfrfEXq1wTzdTdpiO', 'kenny@design-ninja.net', '', 0),
(105, 'Annie', 'Lennox', 'teapot', '$2y$10$NcCDde5yF461t9nWnpgCY.8nfROENcK1HqrZeq.Uunc3H1wEUFDju', 'me@g.com', '', 0),
(106, 'Brent', 'Spiner', 'data', '$2y$10$z1tiMehPgFINFYr7phi7WO6p4FXw8XuMgT5Y9GrPCi.wvsvFX/wga', 'spot@enterprise.us', '<img src="https://sites.google.com/a/cjmitchell.net/www/spotdata4ur.jpg" /><br/>Felis Cattus, is your taxonomic nomenclature, <br/>\r\nan endothermic quadruped carnivorous by nature? <br/>\r\nYour visual, olfactory and auditory senses <br/>\r\ncontribute to your hunting skills, and natural defenses.<br/>\r\n<br/><br/>\r\nI find myself intrigued by your subvocal oscillations, <br/>\r\na singular development of cat communications <br/>\r\nthat obviates your basic hedonistic predilection <br/>\r\nfor a rhythmic stroking of your fur, to demonstrate affection.<br/>\r\n<br/><br/>\r\nA tail is quite essential for your acrobatic talents; <br/>\r\nyou would not be so agile if you lacked its counterbalance.<br/> \r\nAnd when not being utilized to aide in locomotion, <br/>\r\nit often serves to illustrate the state of your emotion.<br/>\r\n<br/><br/>\r\nO Spot, the complex levels of behaviour you display <br/>\r\nconnote a fairly well-developed cognitive array. <br/>\r\nAnd though you are not sentient, Spot, and do not comprehend', 31);

-- --------------------------------------------------------

--
-- Table structure for table `members_groups`
--

CREATE TABLE IF NOT EXISTS `members_groups` (
  `member_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `is_admin` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members_groups`
--

INSERT INTO `members_groups` (`member_id`, `group_id`, `is_admin`) VALUES
(91, 38, 0),
(105, 38, 1),
(105, 37, 0),
(91, 37, 1),
(91, 39, 1),
(102, 38, 0),
(106, 37, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `sent_by` int(11) NOT NULL,
  `sent_to` int(11) NOT NULL,
  `content` varchar(999) NOT NULL,
  `datetime` varchar(60) NOT NULL,
  `sent_to_keep` int(1) NOT NULL,
  `sent_from_keep` int(1) NOT NULL,
  `opened` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `thread_id`, `sent_by`, `sent_to`, `content`, `datetime`, `sent_to_keep`, `sent_from_keep`, `opened`) VALUES
(140, 13, 91, 92, 'YAY! You joined', 'February 7, 2015 a	 3:41pm', 1, 1, 1),
(141, 13, 92, 91, 'Check thy emails...I''m having profile picture struggles.', 'February 7, 2015 a	 3:47pm', 1, 1, 1),
(142, 13, 92, 91, 'Is that feature not functional yet?', 'February 7, 2015 a	 3:47pm', 1, 1, 1),
(143, 13, 91, 92, 'that''s what im working on right now.  I still have a lot to do.', 'February 7, 2015 a	 4:03pm', 1, 1, 1),
(144, 13, 91, 92, 'you can now upload them, but im working on displaying them', 'February 7, 2015 a	 4:03pm', 1, 1, 1),
(145, 13, 92, 91, 'Ah, makes sense.  I guess the internet doesn''t get to see my beautiful face just yet.', 'February 7, 2015 a	 4:04pm', 1, 1, 1),
(146, 13, 91, 92, 'The messaging thing works pretty good though!! This is cool.', 'February 7, 2015 a	 4:05pm', 1, 1, 1),
(147, 13, 92, 91, 'And there are several exciting themes to choose from!', 'February 7, 2015 a	 4:08pm', 1, 1, 1),
(148, 13, 91, 92, 'LOL.  I''m going to work on figuring out how to get a theme builder working, so group members can create themes to share', 'February 7, 2015 a	 4:09pm', 1, 1, 1),
(149, 13, 92, 91, 'I want these people sitting near me to go away. ', 'February 7, 2015 a	 5:04pm', 1, 1, 1),
(150, 13, 91, 92, 'They are awfully close. I''m hungry.', 'February 7, 2015 a	 5:05pm', 1, 1, 1),
(151, 13, 92, 91, 'They''re being loud too.  I''m trying to PHP.\r\n\r\nI''m taking the exercise thing we did in class this past week and turning it into a bunch of functions in an include...', 'February 7, 2015 a	 5:06pm', 1, 1, 1),
(152, 13, 91, 92, 'almost done with profile images. on delete/add as profile image now', 'February 7, 2015 a	 5:13pm', 1, 1, 1),
(153, 13, 92, 91, 'God these people are so fucking annoying.', 'February 7, 2015 a	 5:23pm', 1, 1, 1),
(154, 14, 93, 91, 'Hello', 'February 8, 2015 a	 12:53pm', 1, 1, 1),
(155, 15, 87, 92, 'Okay. I Sorry about all of the bunk messages. I think it''s really ready for alpha testing this time.', 'February 8, 2015 a	 5:15pm', 1, 1, 1),
(156, 16, 87, 95, 'HI!', 'February 8, 2015 a	 6:16pm', 1, 1, 1),
(157, 16, 87, 95, 'So, this message box doesn''t auto refresh when a new message is sent.. i''m still working on that.\r\nbut use the website and let me know what you think... how it can improve, or whatever!', 'February 8, 2015 a	 6:17pm', 1, 1, 1),
(158, 15, 92, 87, 'Spiffy. I''m using it on my phone.', 'February 8, 2015 a	 6:29pm', 1, 1, 1),
(159, 15, 87, 92, 'cool!  my message counter didnt work for some reason though.. ughhh. BUT! I''m working on a theme uploader. should be done soon.', 'February 8, 2015 a	 6:30pm', 1, 1, 1),
(160, 15, 92, 87, 'Can I make a magenta, red, and yellow theme?', 'February 8, 2015 a	 6:31pm', 1, 1, 1),
(161, 15, 87, 92, 'sure, Ronald mcDonald, go for it.', 'February 8, 2015 a	 6:32pm', 1, 1, 1),
(162, 15, 92, 87, 'Time to go dye my hair bright red.', 'February 8, 2015 a	 6:33pm', 1, 1, 1),
(163, 16, 95, 87, 'Alright, will do', 'February 8, 2015 a	 6:34pm', 1, 1, 1),
(164, 15, 87, 92, 'Get you some yellow overalls, and nifty red shoes.', 'February 8, 2015 a	 6:34pm', 1, 1, 1),
(165, 15, 92, 87, 'Sounds like a plan.', 'February 8, 2015 a	 6:36pm', 1, 1, 1),
(166, 15, 87, 92, 'check out themes!! everything works great now.\r\ni got files to delete from the directory, too!\r\n', 'February 9, 2015 a	 12:37pm', 1, 1, 1),
(167, 16, 87, 95, 'hey, try out my theme uploader!!\r\nalso, did you still want to come over friday?', 'February 9, 2015 a	 12:43pm', 1, 1, 1),
(168, 17, 87, 94, 'Try out my theme uploader!!', 'February 9, 2015 a	 12:43pm', 1, 1, 0),
(169, 15, 95, 92, 'Hi, I see you~!', 'February 12, 2015 a	 9:06pm', 1, 1, 1),
(170, 16, 92, 95, 'Message container...  :(', 'February 12, 2015 a	 9:07pm', 1, 1, 1),
(175, 13, 91, 94, 'dss', 'February 13, 2015 a	 7:02pm', 1, 1, 0),
(181, 15, 91, 87, 'fsdf', 'February 13, 2015 a	 7:23pm', 1, 1, 1),
(182, 15, 91, 87, 'dsfd', 'February 13, 2015 a	 7:27pm', 1, 1, 1),
(183, 14, 91, 93, 'dfgd', 'February 13, 2015 a	 7:28pm', 1, 1, 0),
(184, 18, 91, 87, 'dfg', 'February 13, 2015 a	 7:39pm', 1, 1, 1),
(185, 15, 92, 87, 'I do as heeee-eeeelll', 'February 13, 2015 a	 7:39pm', 1, 1, 1),
(186, 13, 92, 91, 'So.  fucking.  annoying.  as.  heee==eelll', 'February 13, 2015 a	 7:40pm', 1, 1, 1),
(187, 19, 91, 101, 'Hey! Nice to see you here!', 'February 13, 2015 a	 9:05pm', 1, 1, 0),
(188, 20, 102, 91, 'Howdy', 'February 14, 2015 a	 5:14pm', 1, 1, 1),
(189, 20, 102, 91, 'hey', 'February 14, 2015 a	 5:16pm', 1, 1, 1),
(190, 20, 102, 91, 'hey', 'February 14, 2015 a	 5:18pm', 1, 1, 1),
(191, 18, 102, 91, 'gdf', 'February 14, 2015 a	 5:19pm', 1, 1, 1),
(192, 18, 102, 91, 'howdee', 'February 14, 2015 a	 5:21pm', 1, 1, 1),
(193, 20, 102, 91, 'How are you', 'February 14, 2015 a	 5:40pm', 1, 1, 1),
(194, 18, 91, 87, '?', 'February 14, 2015 a	 5:43pm', 1, 1, 1),
(195, 20, 102, 91, 'wierd\r\n', 'February 14, 2015 a	 5:44pm', 1, 1, 1),
(196, 20, 102, 91, 'okay..', 'February 14, 2015 a	 5:44pm', 1, 1, 1),
(197, 20, 91, 102, 'refreshing?\r\n', 'February 14, 2015 a	 5:54pm', 1, 1, 1),
(198, 20, 91, 102, 'cant tell', 'February 14, 2015 a	 5:57pm', 1, 1, 1),
(199, 20, 102, 91, 'neat!!', 'February 14, 2015 a	 5:57pm', 1, 1, 1),
(200, 20, 102, 91, 'refresh!', 'February 14, 2015 a	 6:19pm', 1, 1, 1),
(201, 20, 102, 91, 'I get it.', 'February 14, 2015 a	 6:24pm', 1, 1, 1),
(202, 20, 91, 102, 'neat', 'February 14, 2015 a	 6:31pm', 1, 1, 1),
(203, 20, 91, 102, 'no go.', 'February 14, 2015 a	 6:36pm', 1, 1, 1),
(204, 20, 91, 102, 'how rude', 'February 14, 2015 a	 6:37pm', 1, 1, 1),
(205, 20, 91, 102, 'honestly.', 'February 14, 2015 a	 6:47pm', 1, 1, 1),
(206, 20, 102, 91, 'we', 'February 14, 2015 a	 6:48pm', 1, 1, 1),
(207, 20, 102, 91, 'Okay.', 'February 14, 2015 a	 7:50pm', 1, 1, 1),
(208, 20, 91, 102, 'sure.', 'February 14, 2015 a	 7:51pm', 1, 1, 1),
(209, 15, 92, 87, 'Does it do as hell?', 'February 14, 2015 a	 7:51pm', 1, 1, 1),
(210, 13, 92, 91, 'It works?', 'February 14, 2015 a	 7:52pm', 1, 1, 1),
(211, 13, 91, 92, 'I DO AS HEELLLLLLL', 'February 14, 2015 a	 7:52pm', 1, 1, 1),
(212, 13, 92, 91, 'Blink', 'February 14, 2015 a	 7:52pm', 1, 1, 1),
(213, 13, 91, 92, 'It does!', 'February 14, 2015 a	 7:52pm', 1, 1, 1),
(214, 13, 92, 91, 'Blink blink', 'February 14, 2015 a	 7:52pm', 1, 1, 1),
(215, 13, 92, 91, 'Blink', 'February 14, 2015 a	 7:53pm', 1, 1, 1),
(216, 13, 91, 92, 'I wish I could figure out how to make is stop blinking... but.. atleast it works!', 'February 14, 2015 a	 7:53pm', 1, 1, 1),
(217, 13, 92, 91, 'I didn''t have to refresh.  Ah-mazing.', 'February 14, 2015 a	 7:53pm', 1, 1, 1),
(218, 13, 91, 92, '::nods::', 'February 14, 2015 a	 7:54pm', 1, 1, 1),
(219, 13, 92, 91, 'Blink', 'February 14, 2015 a	 7:54pm', 1, 1, 1),
(220, 13, 92, 91, 'I.  Can''t.  Stop.  Blinking.', 'February 14, 2015 a	 7:54pm', 1, 1, 1),
(221, 13, 91, 92, 'Inn firefox it doesn''t blink.', 'February 14, 2015 a	 7:54pm', 1, 1, 1),
(222, 13, 92, 91, 'Fuck firefox.', 'February 14, 2015 a	 7:54pm', 1, 1, 1),
(223, 13, 91, 92, 'it IS valentines Day', 'February 14, 2015 a	 7:54pm', 1, 1, 1),
(224, 13, 92, 91, '....excellent point.', 'February 14, 2015 a	 7:55pm', 1, 1, 1),
(225, 13, 92, 91, 'Blink.', 'February 14, 2015 a	 7:55pm', 1, 1, 1),
(226, 13, 91, 92, 'I''m googling the blinking thing now. next step? TAB NOTIFICATION!', 'February 14, 2015 a	 7:55pm', 1, 1, 1),
(227, 13, 92, 91, 'So the whole page can blink and I''ll get a seizure.  i''m gonna sue.', 'February 14, 2015 a	 7:56pm', 1, 1, 1),
(228, 20, 91, 102, 'Hey!', 'February 14, 2015 a	 8:54pm', 1, 1, 1),
(229, 20, 91, 102, 'How are you', 'February 14, 2015 a	 8:55pm', 1, 1, 1),
(230, 20, 102, 91, 'fine.', 'February 14, 2015 a	 8:59pm', 1, 1, 1),
(231, 13, 92, 91, 'Your notification bar shows  new notifications for messages already viewed by blinking.  It said I had seven.', 'February 14, 2015 a	 9:08pm', 1, 1, 1),
(232, 13, 92, 91, 'Also, I made icons with webdings.  ', 'February 14, 2015 a	 9:08pm', 1, 1, 1),
(233, 13, 91, 92, 'webwingdings', 'February 14, 2015 a	 9:18pm', 1, 1, 1),
(234, 13, 92, 91, 'http://speakingppt.com/wp-content/uploads/2011/10/webdings-wingdings-character-map-speakingppt.png', 'February 14, 2015 a	 9:39pm', 1, 1, 1),
(235, 15, 102, 92, 'I''m making a blog feature!', 'February 14, 2015 a	 10:27pm', 1, 1, 0),
(236, 13, 91, 92, 'I''m making a blog feature!', 'February 14, 2015 a	 10:29pm', 1, 1, 1),
(237, 13, 92, 91, 'Blogging...Lorelle on arBYTES.', 'February 14, 2015 a	 10:38pm', 1, 1, 1),
(238, 13, 91, 92, 'Lol, that''ll be the day', 'February 15, 2015 a	 2:47pm', 1, 1, 0),
(239, 21, 91, 104, 'WHADDUP HOMEZ.. So.. messages are stil alittle flakey... just a warning', 'February 21, 2015 a	 6:14pm', 1, 1, 1),
(240, 18, 104, 87, '^_^  sweeeeeeet!', 'February 21, 2015 a	 6:52pm', 1, 1, 1),
(241, 18, 91, 87, 'Hey hot mama!', 'February 24, 2015 a	 5:03pm', 1, 1, 1),
(242, 15, 91, 92, 'Woah ', 'March 1, 2015 a	 11:12pm', 1, 1, 0),
(243, 22, 106, 91, 'Hello\r\n', 'March 4, 2015 a	 2:50pm', 1, 1, 1),
(244, 22, 91, 106, 'Hello, Mr. Spiner', 'March 4, 2015 a	 2:50pm', 1, 1, 1),
(245, 22, 91, 106, 'How are you', 'March 4, 2015 a	 2:51pm', 1, 1, 1),
(246, 22, 106, 91, 'Very well, I thank you.', 'March 4, 2015 a	 2:51pm', 1, 1, 1),
(247, 20, 91, 102, 'OKay', 'March 5, 2015 a	 7:31pm', 1, 1, 0),
(248, 23, 91, 105, 'gbadf\r\n', 'March 11, 2015 a	 3:47pm', 1, 1, 0),
(249, 23, 91, 105, 'retrewt\r\n', 'March 11, 2015 a	 3:48pm', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `msg_count`
--

CREATE TABLE IF NOT EXISTS `msg_count` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msg_count`
--

INSERT INTO `msg_count` (`id`, `user_id`, `count`) VALUES
(14, 87, 0),
(18, 91, 0),
(19, 92, 0),
(20, 93, 0),
(21, 94, 0),
(22, 95, 0),
(24, 98, 0),
(25, 99, 0),
(26, 100, 0),
(27, 101, 0),
(28, 102, 1),
(29, 103, 0),
(30, 104, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime` varchar(60) NOT NULL,
  `content` varchar(900) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=801 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `datetime`, `content`) VALUES
(508, 92, 'February 7, 2015 a	 6:43pm', '<img src="img/icons/tiny-comments.png" />  New note: ''<a href="note_single.php?note_id=36">Emails</a>'' '),
(512, 92, 'February 8, 2015 a	 12:18pm', '<img src="img/icons/tiny-comments.png" />  New note: ''<a href="note_single.php?note_id=38">WTF</a>'' '),
(519, 92, 'February 8, 2015 a	 12:27pm', '<img src="img/icons/tiny-comments.png" />  New note: ''<a href="note_single.php?note_id=40">Them some nice articles</a>'' '),
(528, 92, 'February 8, 2015 a	 12:30pm', '<img src="img/icons/tiny-comments.png" />  New note: ''<a href="note_single.php?note_id=43">wait.</a>'' '),
(531, 92, 'February 8, 2015 a	 12:32pm', '<img src="img/icons/tiny-comments.png" />  New note: ''<a href="note_single.php?note_id=44">Post Notifications</a>'' '),
(549, 92, 'February 8, 2015 a	 2:10pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=45">Double checking</a>'' '),
(550, 93, 'February 8, 2015 a	 2:10pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=45">Double checking</a>'' '),
(563, 92, 'February 8, 2015 a	 4:33pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=92">yellow!</a>''!'),
(564, 93, 'February 8, 2015 a	 4:33pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=93">yellow!</a>''!'),
(568, 92, 'February 8, 2015 a	 6:23pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=35">Ghostbusters Theme</a>''!'),
(569, 93, 'February 8, 2015 a	 6:23pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=35">Ghostbusters Theme</a>''!'),
(570, 94, 'February 8, 2015 a	 6:23pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=35">Ghostbusters Theme</a>''!'),
(574, 92, 'February 8, 2015 a	 6:35pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=36">Untitled</a>''!'),
(575, 93, 'February 8, 2015 a	 6:35pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=36">Untitled</a>''!'),
(576, 94, 'February 8, 2015 a	 6:35pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=36">Untitled</a>''!'),
(580, 92, 'February 8, 2015 a	 7:37pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=47">Themes</a>'' '),
(581, 93, 'February 8, 2015 a	 7:37pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=47">Themes</a>'' '),
(582, 94, 'February 8, 2015 a	 7:37pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=47">Themes</a>'' '),
(586, 92, 'February 8, 2015 a	 7:44pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=37">template.css</a>''!'),
(587, 93, 'February 8, 2015 a	 7:44pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=37">template.css</a>''!'),
(588, 94, 'February 8, 2015 a	 7:44pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=37">template.css</a>''!'),
(592, 92, 'February 9, 2015 a	 12:30pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=38">delete test</a>''!'),
(593, 93, 'February 9, 2015 a	 12:30pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=38">delete test</a>''!'),
(594, 94, 'February 9, 2015 a	 12:30pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=38">delete test</a>''!'),
(598, 92, 'February 9, 2015 a	 12:31pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=39">upload test</a>''!'),
(599, 93, 'February 9, 2015 a	 12:31pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=39">upload test</a>''!'),
(600, 94, 'February 9, 2015 a	 12:31pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=39">upload test</a>''!'),
(602, 92, 'February 9, 2015 a	 12:37pm', '<a href="read_message.php?thread_id=15&with_id=87"><img src="img/icons/tiny-messages.png" />  New message from Isobel Lennox </a> '),
(604, 94, 'February 9, 2015 a	 12:43pm', '<a href="read_message.php?thread_id=17&with_id=87"><img src="img/icons/tiny-messages.png" />  New message from Isobel Lennox </a> '),
(608, 87, 'February 9, 2015 a	 10:29pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=49">Welcome To CTEC Hackers</a>'' '),
(610, 92, 'February 9, 2015 a	 10:29pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=49">Welcome To CTEC Hackers</a>'' '),
(611, 93, 'February 9, 2015 a	 10:29pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=49">Welcome To CTEC Hackers</a>'' '),
(612, 94, 'February 9, 2015 a	 10:29pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=49">Welcome To CTEC Hackers</a>'' '),
(614, 87, 'February 10, 2015 a	 12:22pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=50">Themes</a>'' '),
(616, 92, 'February 10, 2015 a	 12:22pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=50">Themes</a>'' '),
(617, 93, 'February 10, 2015 a	 12:22pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=50">Themes</a>'' '),
(618, 94, 'February 10, 2015 a	 12:22pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=50">Themes</a>'' '),
(620, 97, 'February 10, 2015 a	 12:26pm', '<img src="img/icons/tiny-newpost.png" />  New Article <a href="kb_single.php?article_id=80">How to fix a printer.</a> created!'),
(621, 98, 'February 10, 2015 a	 12:28pm', '<img src="img/icons/add-contacts.png" />  <a href="employee_profile.php?user_id=97">Zora Faulconer</a> has added you a Contact!  '),
(622, 87, 'February 10, 2015 a	 11:05pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=41">Dancing Baby</a>''!'),
(624, 92, 'February 10, 2015 a	 11:05pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=41">Dancing Baby</a>''!'),
(625, 93, 'February 10, 2015 a	 11:05pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=41">Dancing Baby</a>''!'),
(626, 94, 'February 10, 2015 a	 11:05pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=41">Dancing Baby</a>''!'),
(628, 87, 'February 11, 2015 a	 1:15am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=51">UX Testing List</a>'' '),
(630, 92, 'February 11, 2015 a	 1:15am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=51">UX Testing List</a>'' '),
(631, 93, 'February 11, 2015 a	 1:15am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=51">UX Testing List</a>'' '),
(632, 94, 'February 11, 2015 a	 1:15am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=51">UX Testing List</a>'' '),
(634, 97, 'February 12, 2015 a	 12:04pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=42">Green</a>''!'),
(635, 98, 'February 12, 2015 a	 12:04pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=42">Green</a>''!'),
(636, 87, 'February 12, 2015 a	 2:58pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=52">Group Meeting at 3pm</a>'' '),
(638, 92, 'February 12, 2015 a	 2:58pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=52">Group Meeting at 3pm</a>'' '),
(639, 93, 'February 12, 2015 a	 2:58pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=52">Group Meeting at 3pm</a>'' '),
(640, 94, 'February 12, 2015 a	 2:58pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=52">Group Meeting at 3pm</a>'' '),
(642, 99, 'February 12, 2015 a	 2:58pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=52">Group Meeting at 3pm</a>'' '),
(643, 100, 'February 12, 2015 a	 2:58pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=52">Group Meeting at 3pm</a>'' '),
(644, 87, 'February 12, 2015 a	 8:54pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=53">Isobel Made Me Do It</a>'' '),
(646, 92, 'February 12, 2015 a	 8:54pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=53">Isobel Made Me Do It</a>'' '),
(647, 93, 'February 12, 2015 a	 8:54pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=53">Isobel Made Me Do It</a>'' '),
(648, 94, 'February 12, 2015 a	 8:54pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=53">Isobel Made Me Do It</a>'' '),
(650, 99, 'February 12, 2015 a	 8:54pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=53">Isobel Made Me Do It</a>'' '),
(651, 100, 'February 12, 2015 a	 8:54pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=53">Isobel Made Me Do It</a>'' '),
(653, 87, 'February 12, 2015 a	 9:00pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=43">Clark WP Header</a>''!'),
(655, 92, 'February 12, 2015 a	 9:00pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=43">Clark WP Header</a>''!'),
(656, 93, 'February 12, 2015 a	 9:00pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=43">Clark WP Header</a>''!'),
(657, 94, 'February 12, 2015 a	 9:00pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=43">Clark WP Header</a>''!'),
(659, 99, 'February 12, 2015 a	 9:00pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=43">Clark WP Header</a>''!'),
(660, 100, 'February 12, 2015 a	 9:00pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=43">Clark WP Header</a>''!'),
(661, 87, 'February 12, 2015 a	 9:01pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=44">Graphic Design Portfolio Page</a>''!'),
(663, 92, 'February 12, 2015 a	 9:01pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=44">Graphic Design Portfolio Page</a>''!'),
(664, 93, 'February 12, 2015 a	 9:01pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=44">Graphic Design Portfolio Page</a>''!'),
(665, 94, 'February 12, 2015 a	 9:01pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=44">Graphic Design Portfolio Page</a>''!'),
(667, 99, 'February 12, 2015 a	 9:01pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=44">Graphic Design Portfolio Page</a>''!'),
(668, 100, 'February 12, 2015 a	 9:01pm', '<img src="img/icons/tiny-comments.png" />  New File Upload: ''<a href="file_single.php?file_id=44">Graphic Design Portfolio Page</a>''!'),
(669, 92, 'February 12, 2015 a	 9:06pm', '<a href="read_message.php?thread_id=16&with_id=95"><img src="img/icons/tiny-messages.png" />  New message from CassieRose Wangerin </a> '),
(670, 94, 'February 13, 2015 a	 6:11pm', '<a href="read_message.php?thread_id=14&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(671, 94, 'February 13, 2015 a	 6:46pm', '<a href="read_message.php?thread_id=14&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(672, 94, 'February 13, 2015 a	 6:59pm', '<a href="read_message.php?thread_id=14&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(673, 94, 'February 13, 2015 a	 7:01pm', '<a href="read_message.php?thread_id=14&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(674, 94, 'February 13, 2015 a	 7:02pm', '<a href="read_message.php?thread_id=13&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(675, 94, 'February 13, 2015 a	 7:05pm', '<a href="read_message.php?thread_id=17&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(676, 94, 'February 13, 2015 a	 7:08pm', '<a href="read_message.php?thread_id=17&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(677, 87, 'February 13, 2015 a	 7:09pm', '<a href="read_message.php?thread_id=14&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(678, 87, 'February 13, 2015 a	 7:18pm', '<a href="read_message.php?thread_id=14&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(679, 87, 'February 13, 2015 a	 7:20pm', '<a href="read_message.php?thread_id=14&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(680, 87, 'February 13, 2015 a	 7:23pm', '<a href="read_message.php?thread_id=14&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(681, 87, 'February 13, 2015 a	 7:27pm', '<a href="read_message.php?thread_id=14&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(682, 93, 'February 13, 2015 a	 7:28pm', '<a href="read_message.php?thread_id=14&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(683, 101, 'February 13, 2015 a	 9:05pm', '<a href="read_message.php?thread_id=19&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(684, 87, '', '<img src="img/icons/tiny-contacts.png" />  New Member! ''<a href="employee_profile.php?user_id=102">RoyOrbison</a>'' '),
(688, 87, 'February 14, 2015 a	 9:43pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=54">In dreams you\\''re mine all the time</a>'' '),
(690, 92, 'February 14, 2015 a	 9:43pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=54">In dreams you\\''re mine all the time</a>'' '),
(691, 93, 'February 14, 2015 a	 9:43pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=54">In dreams you\\''re mine all the time</a>'' '),
(692, 94, 'February 14, 2015 a	 9:43pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=54">In dreams you\\''re mine all the time</a>'' '),
(694, 99, 'February 14, 2015 a	 9:43pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=54">In dreams you\\''re mine all the time</a>'' '),
(695, 100, 'February 14, 2015 a	 9:43pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=54">In dreams you\\''re mine all the time</a>'' '),
(696, 101, 'February 14, 2015 a	 9:43pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=54">In dreams you\\''re mine all the time</a>'' '),
(697, 102, 'February 14, 2015 a	 9:43pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=54">In dreams you\\''re mine all the time</a>'' '),
(698, 87, 'February 14, 2015 a	 10:03pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=55">Today I saw a woman</a>'' '),
(700, 92, 'February 14, 2015 a	 10:03pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=55">Today I saw a woman</a>'' '),
(701, 93, 'February 14, 2015 a	 10:03pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=55">Today I saw a woman</a>'' '),
(702, 94, 'February 14, 2015 a	 10:03pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=55">Today I saw a woman</a>'' '),
(704, 99, 'February 14, 2015 a	 10:03pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=55">Today I saw a woman</a>'' '),
(705, 100, 'February 14, 2015 a	 10:03pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=55">Today I saw a woman</a>'' '),
(706, 101, 'February 14, 2015 a	 10:03pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=55">Today I saw a woman</a>'' '),
(708, 92, 'February 14, 2015 a	 10:27pm', '<a href="read_message.php?thread_id=20&with_id=102"><img src="img/icons/tiny-messages.png" />  New message from Roy Orbison </a> '),
(710, 87, 'February 15, 2015 a	 4:47pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=56">Private Post Test</a>'' '),
(712, 92, 'February 15, 2015 a	 4:47pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=56">Private Post Test</a>'' '),
(713, 93, 'February 15, 2015 a	 4:47pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=56">Private Post Test</a>'' '),
(714, 94, 'February 15, 2015 a	 4:47pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=56">Private Post Test</a>'' '),
(715, 95, 'February 15, 2015 a	 4:47pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=56">Private Post Test</a>'' '),
(716, 99, 'February 15, 2015 a	 4:47pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=56">Private Post Test</a>'' '),
(717, 100, 'February 15, 2015 a	 4:47pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=56">Private Post Test</a>'' '),
(718, 101, 'February 15, 2015 a	 4:47pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=56">Private Post Test</a>'' '),
(719, 102, 'February 15, 2015 a	 4:47pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=56">Private Post Test</a>'' '),
(720, 87, 'February 16, 2015 a	 2:54pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=57">New Blog Feature</a>'' '),
(722, 92, 'February 16, 2015 a	 2:54pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=57">New Blog Feature</a>'' '),
(723, 93, 'February 16, 2015 a	 2:54pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=57">New Blog Feature</a>'' '),
(724, 94, 'February 16, 2015 a	 2:54pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=57">New Blog Feature</a>'' '),
(725, 95, 'February 16, 2015 a	 2:54pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=57">New Blog Feature</a>'' '),
(726, 99, 'February 16, 2015 a	 2:54pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=57">New Blog Feature</a>'' '),
(727, 100, 'February 16, 2015 a	 2:54pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=57">New Blog Feature</a>'' '),
(728, 101, 'February 16, 2015 a	 2:54pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=57">New Blog Feature</a>'' '),
(729, 102, 'February 16, 2015 a	 2:54pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=57">New Blog Feature</a>'' '),
(732, 87, 'February 18, 2015 a	 7:29pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=58">Creating A Tour!</a>'' '),
(734, 92, 'February 18, 2015 a	 7:29pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=58">Creating A Tour!</a>'' '),
(735, 93, 'February 18, 2015 a	 7:29pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=58">Creating A Tour!</a>'' '),
(736, 94, 'February 18, 2015 a	 7:29pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=58">Creating A Tour!</a>'' '),
(737, 95, 'February 18, 2015 a	 7:29pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=58">Creating A Tour!</a>'' '),
(738, 99, 'February 18, 2015 a	 7:29pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=58">Creating A Tour!</a>'' '),
(739, 100, 'February 18, 2015 a	 7:29pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=58">Creating A Tour!</a>'' '),
(740, 101, 'February 18, 2015 a	 7:29pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=58">Creating A Tour!</a>'' '),
(741, 102, 'February 18, 2015 a	 7:29pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=58">Creating A Tour!</a>'' '),
(743, 87, '', '<img src="img/icons/tiny-contacts.png" />  New Member! ''<a href="employee_profile.php?user_id=104">KennyScott</a>'' '),
(744, 104, 'February 21, 2015 a	 6:14pm', '<a href="read_message.php?thread_id=21&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(745, 87, 'February 21, 2015 a	 6:52pm', '<a href="read_message.php?thread_id=21&with_id=104"><img src="img/icons/tiny-messages.png" />  New message from Kenny Scott </a> '),
(746, 87, 'February 24, 2015 a	 5:03pm', '<a href="read_message.php?thread_id=18&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(747, 92, 'February 24, 2015 a	 6:13pm', '<img src="img/icons/add-contacts.png" />  <a href="employee_profile.php?user_id=91">Zora Faulconer</a> has added you a Contact!  '),
(748, 87, 'February 24, 2015 a	 9:33pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=59">Website undergoing major reconstruction</a>'' '),
(750, 92, 'February 24, 2015 a	 9:33pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=59">Website undergoing major reconstruction</a>'' '),
(751, 93, 'February 24, 2015 a	 9:33pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=59">Website undergoing major reconstruction</a>'' '),
(752, 94, 'February 24, 2015 a	 9:33pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=59">Website undergoing major reconstruction</a>'' '),
(753, 95, 'February 24, 2015 a	 9:33pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=59">Website undergoing major reconstruction</a>'' '),
(754, 99, 'February 24, 2015 a	 9:33pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=59">Website undergoing major reconstruction</a>'' '),
(755, 100, 'February 24, 2015 a	 9:33pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=59">Website undergoing major reconstruction</a>'' '),
(756, 101, 'February 24, 2015 a	 9:33pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=59">Website undergoing major reconstruction</a>'' '),
(757, 102, 'February 24, 2015 a	 9:33pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=59">Website undergoing major reconstruction</a>'' '),
(758, 104, 'February 24, 2015 a	 9:33pm', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="note_single.php?note_id=59">Website undergoing major reconstruction</a>'' '),
(759, 87, 'February 25, 2015 a	 10:55am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Welcome</a>'' '),
(761, 92, 'February 25, 2015 a	 10:55am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Welcome</a>'' '),
(762, 93, 'February 25, 2015 a	 10:55am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Welcome</a>'' '),
(763, 94, 'February 25, 2015 a	 10:55am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Welcome</a>'' '),
(764, 95, 'February 25, 2015 a	 10:55am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Welcome</a>'' '),
(765, 99, 'February 25, 2015 a	 10:55am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Welcome</a>'' '),
(766, 100, 'February 25, 2015 a	 10:55am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Welcome</a>'' '),
(767, 101, 'February 25, 2015 a	 10:55am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Welcome</a>'' '),
(768, 102, 'February 25, 2015 a	 10:55am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Welcome</a>'' '),
(769, 104, 'February 25, 2015 a	 10:55am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Welcome</a>'' '),
(770, 87, 'February 25, 2015 a	 11:00am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Them some nice articles</a>'' '),
(772, 92, 'February 25, 2015 a	 11:00am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Them some nice articles</a>'' '),
(773, 93, 'February 25, 2015 a	 11:00am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Them some nice articles</a>'' '),
(774, 94, 'February 25, 2015 a	 11:00am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Them some nice articles</a>'' '),
(775, 95, 'February 25, 2015 a	 11:00am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Them some nice articles</a>'' '),
(776, 99, 'February 25, 2015 a	 11:00am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Them some nice articles</a>'' '),
(777, 100, 'February 25, 2015 a	 11:00am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Them some nice articles</a>'' '),
(778, 101, 'February 25, 2015 a	 11:00am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Them some nice articles</a>'' '),
(779, 102, 'February 25, 2015 a	 11:00am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Them some nice articles</a>'' '),
(780, 104, 'February 25, 2015 a	 11:00am', '<img src="img/icons/tiny-comments.png" />  New Post: ''<a href="post_single.php?post_id=59">Them some nice articles</a>'' '),
(782, 104, 'February 25, 2015 a	 3:49pm', '<img src="img/icons/add-contacts.png" />  <a href="member_profile.php?user_id=91">Zora Faulconer</a> has added you a Contact!  '),
(783, 93, 'February 25, 2015 a	 10:58pm', '<img src="img/icons/add-contacts.png" />  <a href="member_profile.php?user_id=91">Zora Faulconer</a> has added you a Contact!  '),
(784, 105, 'February 28, 2015 a	 5:54pm', '<img src="img/icons/tiny-comments.png" />  New comment on your post: ''<a href="post_single.php?post_id=69">Lyrics</a>''!'),
(786, 91, 'March 1, 2015 a	 8:34pm', '<i class="fa fa-comments"></i>  New comment on your post: ''<a href="post_single.php?post_id=71">New Icons</a>''!'),
(787, 91, 'March 1, 2015 a	 8:36pm', '<i class="fa fa-user-plus"></i>  <a href="member_profile.php?user_id=105">Annie Lennox</a> has added you a Contact!  '),
(788, 92, 'March 1, 2015 a	 11:12pm', '<a href="read_message.php?thread_id=18&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(789, 105, 'March 3, 2015 a	 11:23am', '<i class="fa fa-user-plus"></i>  <a href="member_profile.php?user_id=102">Roy Orbison</a> has added you a Contact!  '),
(794, 106, 'March 4, 2015 a	 2:51pm', '<i class="fa fa-user-plus"></i>  <a href="member_profile.php?user_id=91">Zora Faulconer</a> has added you a Contact!  '),
(795, 106, 'March 4, 2015 a	 2:51pm', '<a href="read_message.php?thread_id=18&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> '),
(797, 105, 'March 4, 2015 a	 4:58pm', '<i class="fa fa-user-plus"></i>  <a href="member_profile.php?user_id=106">Brent Spiner</a> has added you a Contact!  '),
(798, 102, 'March 5, 2015 a	 7:15pm', '<i class="fa fa-user-plus"></i>  <a href="member_profile.php?user_id=91">Zora Faulconer</a> has added you a Contact!  '),
(799, 105, 'March 5, 2015 a	 7:21pm', '<i class="fa fa-user-plus"></i>  <a href="member_profile.php?user_id=91">Zora Faulconer</a> has added you a Contact!  '),
(800, 105, 'March 11, 2015 a	 3:47pm', '<a href="read_message.php?thread_id=23&with_id=91"><img src="img/icons/tiny-messages.png" />  New message from Zora Faulconer </a> ');

-- --------------------------------------------------------

--
-- Table structure for table `notify_count`
--

CREATE TABLE IF NOT EXISTS `notify_count` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notify_count`
--

INSERT INTO `notify_count` (`id`, `user_id`, `count`) VALUES
(9, 87, 0),
(13, 91, 0),
(14, 92, 6),
(15, 93, 23),
(16, 94, 18),
(17, 95, 5),
(19, 98, 0),
(20, 99, 12),
(21, 100, 12),
(22, 101, 3),
(23, 102, 7),
(24, 103, 0),
(25, 104, 4);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `author` int(11) NOT NULL COMMENT 'session stored name',
  `datetime` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `content` varchar(900) NOT NULL,
  `is_file` int(1) NOT NULL,
  `file_type` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `group_id`, `author`, `datetime`, `title`, `content`, `is_file`, `file_type`) VALUES
(67, 37, 91, 'February 25, 2015 a	 10:52pm', 'Welcome To CTEC Hackers', 'I am currently working on :\r\n<br/>\r\n-file uploads being formatted for img vs document<br/>\r\n-delete group and admin rights<br/>\r\n-a directory of all files in the group<bb>\r\n-search within the group', 0, 0),
(68, 38, 105, 'February 28, 2015 a	 5:11pm', 'Procol Harum', 'uploads/105/procol-harum-695-l.jpg', 1, 0),
(69, 38, 105, 'February 28, 2015 a	 5:39pm', 'Lyrics', 'uploads/105/lyrics.txt', 1, 1),
(70, 38, 105, 'February 28, 2015 a	 6:13pm', 'What a beautiful day for Toffles!', 'uploads/105/100_6642.jpg', 1, 0),
(71, 38, 91, 'March 1, 2015 a	 8:34pm', 'New Icons', 'Checking notification icons.', 0, 0),
(72, 37, 106, 'March 4, 2015 a	 4:22pm', 'Poetry', 'Would you like to hear some poetry?', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile_img`
--

CREATE TABLE IF NOT EXISTS `profile_img` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filepath` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `current` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_img`
--

INSERT INTO `profile_img` (`id`, `user_id`, `filepath`, `current`) VALUES
(18, 91, 'uploads/91/isobel.png', 0),
(2, 92, 'uploads/92/Capture2Small.jpg', 1),
(20, 105, 'uploads/105/Annie-Lennox-annie-lennox-30368049-500-544.jpg', 1),
(19, 91, 'uploads/91/romulan.png', 1),
(5, 93, 'uploads/93/bette.jpg', 1),
(6, 87, 'uploads/87/Screenshot_2015-01-22-22-26-53.png', 1),
(7, 95, 'uploads/95/image.jpg', 1),
(8, 98, 'uploads/98/arton2544.jpg', 1),
(16, 101, 'uploads/101/newneighbors.jpg', 1),
(10, 95, 'uploads/95/7-F1kKPm.jpeg', 0),
(17, 102, 'uploads/102/roy_orbison[1].jpg', 1),
(13, 95, 'uploads/95/us.jpg', 0),
(22, 106, 'uploads/106/BS.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL,
  `user_id` int(7) NOT NULL,
  `title` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(9999) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_private` int(1) NOT NULL,
  `is_file` int(1) NOT NULL,
  `file_type` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `user_id`, `title`, `content`, `datetime`, `is_private`, `is_file`, `file_type`) VALUES
(1, 102, 'Today I saw a woman', 'She was a pretty woman.', 'February 14, 2015   10:05pm', 0, 0, 0),
(4, 91, 'Private Post Test', 'Shhhh, I like ketchup on hotdogs!', 'February 15, 2015   4:50pm', 1, 0, 0),
(3, 91, 'What a beautiful day for Toffles!', 'Wine and cigarettes', 'February 15, 2015   4:29pm', 0, 0, 0),
(6, 91, 'Mr. Big', 'I like Turtles.', 'February 24, 2015   5:01pm', 0, 0, 0),
(7, 91, 'Im private', 'Give me a little privacy, will ya?', 'February 26, 2015   11:53am', 1, 0, 0),
(8, 105, 'What a beautiful day for Toffles!', 'lorem Pilumb', 'February 28, 2015   6:15pm', 1, 0, 0),
(9, 105, 'Them some nice articles', 'hey', 'February 28, 2015   6:29pm', 0, 0, 0),
(12, 105, 'Best Friends', 'uploads/105/best-friends.gif', 'February 28, 2015 a	 6:44pm', 0, 1, 0),
(13, 91, 'A Good Song', 'uploads/91/song.PNG', 'March 1, 2015 a	 9:37pm', 0, 1, 0),
(14, 102, 'Dennis Hopper', 'My biggest fan!', 'March 3, 2015   10:27am', 0, 0, 0),
(15, 91, 'Private Post Test', 'Delete me', 'March 3, 2015   12:05pm', 1, 0, 0),
(16, 91, 'Green', 'uploads/91/green.png', 'March 3, 2015 a	 12:57pm', 0, 1, 0),
(19, 106, 'Helloalert("hello!!");', 'JS INJECT TEST', 'March 4, 2015   3:37pm', 0, 0, 0),
(20, 91, 'test', 'uploads/91/canvas_login.png', 'March 11, 2015 a	 3:38pm', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status_comments`
--

CREATE TABLE IF NOT EXISTS `status_comments` (
  `id` int(11) NOT NULL,
  `post_id` int(7) NOT NULL,
  `author` int(7) NOT NULL,
  `datetime` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(999) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE IF NOT EXISTS `themes` (
  `id` int(11) NOT NULL,
  `filepath` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(7) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `filepath`, `title`, `author_id`) VALUES
(1, 'themes/87/ghostbusters.css', 'Ghostbusters Theme', 87),
(2, 'themes/87/coffee.css', 'Coffee Theme', 87),
(3, 'themes/87/grey.css', 'Grey Theme', 87),
(11, 'themes/91/purple.css', 'Purple', 91),
(30, 'themes/95/PinkGrayBlack.css', 'Pink, Gray & Black', 95),
(31, 'themes/91/white.css', 'White Theme (Default)', 91);

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`id`, `user1`, `user2`) VALUES
(18, 87, 91),
(14, 91, 93),
(20, 91, 102),
(22, 91, 106),
(15, 92, 87),
(13, 92, 91),
(17, 94, 87),
(16, 95, 87),
(19, 101, 91),
(21, 104, 91),
(23, 105, 91);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD KEY `user_id` (`user_id`,`contact_id`), ADD KEY `contact_id` (`contact_id`);

--
-- Indexes for table `file_comments`
--
ALTER TABLE `file_comments`
  ADD PRIMARY KEY (`id`), ADD KEY `file_id` (`file_id`,`author`);

--
-- Indexes for table `following_status`
--
ALTER TABLE `following_status`
  ADD KEY `you` (`you`), ADD KEY `following` (`following`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help`
--
ALTER TABLE `help`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`), ADD KEY `thread_id` (`thread_id`,`sent_by`,`sent_to`), ADD KEY `sent_by` (`sent_by`), ADD KEY `sent_to` (`sent_to`);

--
-- Indexes for table `msg_count`
--
ALTER TABLE `msg_count`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`,`count`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notify_count`
--
ALTER TABLE `notify_count`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_img`
--
ALTER TABLE `profile_img`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_comments`
--
ALTER TABLE `status_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`id`), ADD KEY `user1` (`user1`,`user2`), ADD KEY `user2` (`user2`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `file_comments`
--
ALTER TABLE `file_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `help`
--
ALTER TABLE `help`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=250;
--
-- AUTO_INCREMENT for table `msg_count`
--
ALTER TABLE `msg_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=801;
--
-- AUTO_INCREMENT for table `notify_count`
--
ALTER TABLE `notify_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `profile_img`
--
ALTER TABLE `profile_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `status_comments`
--
ALTER TABLE `status_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `contacts_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sent_by`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`sent_to`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `msg_count`
--
ALTER TABLE `msg_count`
ADD CONSTRAINT `msg_count_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notify_count`
--
ALTER TABLE `notify_count`
ADD CONSTRAINT `notify_count_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thread`
--
ALTER TABLE `thread`
ADD CONSTRAINT `thread_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `thread_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
