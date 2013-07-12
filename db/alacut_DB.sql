# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.5.24-log
# Server OS:                    Win64
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2013-04-12 15:31:49
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping database structure for alacut
CREATE DATABASE IF NOT EXISTS `alacut` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `alacut`;


# Dumping structure for table alacut.alacut_member
CREATE TABLE IF NOT EXISTS `alacut_member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(128) DEFAULT NULL,
  `middle_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `full_name` varchar(364) DEFAULT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL,
  `login_user_name` varchar(255) DEFAULT NULL,
  `hash` varchar(255) NOT NULL,
  `active` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '''0''-inactive,''1''-active,''2''-delete',
  `deleted_by` int(11) NOT NULL,
  `job` varchar(50) NOT NULL,
  `education` varchar(75) NOT NULL,
  `address` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `state_region` int(11) DEFAULT NULL,
  `county_region` int(11) DEFAULT NULL,
  `pin_code` int(50) DEFAULT NULL,
  `relationship` enum('S','E','M') NOT NULL DEFAULT 'S',
  `married_to` varchar(128) NOT NULL,
  `profile_photo_name` varchar(255) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `handle` enum('I','E') NOT NULL DEFAULT 'I',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isAdmin` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

# Dumping data for table alacut.alacut_member: ~22 rows (approximately)
/*!40000 ALTER TABLE `alacut_member` DISABLE KEYS */;
INSERT INTO `alacut_member` (`member_id`, `first_name`, `middle_name`, `last_name`, `full_name`, `email`, `password`, `login_user_name`, `hash`, `active`, `deleted_by`, `job`, `education`, `address`, `city`, `state_region`, `county_region`, `pin_code`, `relationship`, `married_to`, `profile_photo_name`, `url`, `handle`, `create_date`, `isAdmin`) VALUES
	(1, 'admin', NULL, NULL, 'admin', 'admin@alacut.com', 'admin', 'admin', '', '1', 0, '', '', '', '', NULL, NULL, NULL, 'S', '', NULL, NULL, 'I', '2013-01-28 11:58:51', '1'),
	(21, 'Apurb', NULL, 'Meher', 'Apurb Meher', 'apurb.meher@aabsys.com', '2015', 'apurb', '', '1', 1, 'C', 'Graduate', 'Bhubaneswar', '', NULL, NULL, NULL, 'S', '', '141220121533.JPG', 'apurb', 'I', '2013-03-07 12:00:15', '0'),
	(22, 'Rajesh', 'Kumar', 'Khatei', 'Rajesh Khatei', 'rajesh.khatei@aabsys.com', '2015', 'raj', '', '1', 0, 'B.tech', 'B.tech', 'Patia,Bhubaneswar', '', NULL, NULL, NULL, 'M', 'Ms. --------', 'd41d8cd98f00b204e9800998ecf8427eferri.jpg', 'rajesh', 'I', '2013-02-22 14:41:16', '0'),
	(23, 'Anshuman', NULL, 'Nayak', 'Anshuman Nayak', 'anshuman.nayak@aabsys.com', '2015', 'anshuman', '', '1', 0, 'x', 'MCA PG', 'Bhubaneswar,Orissa', '', NULL, NULL, NULL, 'S', '', 'd41d8cd98f00b204e9800998ecf8427e141220121535.jpg', 'anshu', 'E', '2013-02-22 14:41:13', '0'),
	(24, 'Bikram', NULL, NULL, 'Bikram Sahu', 'bikram.sahoo@aabsys.com', 'biki', 'vicky', '', '1', 0, 'y', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, 'S', 'Ms. Mishra', 'd41d8cd98f00b204e9800998ecf8427eP1010685.JPG', 'funky', 'E', '2013-04-11 14:58:34', '0'),
	(29, 'Supriya', NULL, NULL, 'Supriya Sahoo', 'supriya.sahu@aabsys.com', '2014', 'supy', '', '1', 0, 'z', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, 'S', '', 'P1010683.JPG', '', 'E', '2013-02-05 18:17:09', '0'),
	(30, 'Harika', NULL, NULL, 'K.Harika', 'k.harika@aabsys.com', '2013', 'harika', '', '1', 0, 'z', 'B.tech', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1020468.JPG', NULL, 'I', '2013-02-05 18:18:40', '0'),
	(31, 'Prabhat', NULL, NULL, 'Prabhat Sahoo', 'prabhat.sahoo@aabsys.com', '2013', 'prabhat', '', '1', 0, 'C', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'd41d8cd98f00b204e9800998ecf8427eP1010685.JPG', NULL, 'I', '2013-02-05 18:18:12', '0'),
	(36, 'Nibedita', NULL, NULL, 'Nibedita Panda', 'nibedita.panda@aabsys.com', '2013', 'nibu', '', '1', 0, 'C', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1010683.JPG', NULL, 'I', '2013-02-05 18:18:27', '0'),
	(38, 'Little', NULL, NULL, 'Little Sahu', 'little.sahoo@aabsys.com', '2013', 'welly', '', '0', 0, 'x', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'it group.JPG', NULL, 'I', '2013-02-05 18:17:01', '0'),
	(41, 'Sibashish', NULL, NULL, 'Sibasis Mohanty', 'shibashish.mohanty@aabsys.com', '2013', 'sibu', '', '1', 0, 'A', 'B.tech', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'd41d8cd98f00b204e9800998ecf8427eRaj AABSyS Party.JPG', NULL, 'I', '2013-02-05 18:18:05', '0'),
	(51, 'AABSyS GIS', NULL, NULL, 'AABSyS GIS', 'a@gmail.com', '2013', 'aaa', '', '1', 51, 'y', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1020582.JPG', NULL, 'I', '2013-03-04 11:04:20', '0'),
	(55, 'AABSyS CAD', NULL, NULL, 'AABSyS CAD', 'abc@yahoo.com', '2013', 'abcd', '', '1', 0, 'z', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1020505.JPG', NULL, 'I', '2013-02-05 20:18:41', '0'),
	(56, 'Dinesh', NULL, NULL, 'Dinesh Bisoyi', 'dinesh.bisoyi@aabsys.com', '2013', 'Arjun', '', '1', 1, 'z', 'B.tech', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1020602.JPG', NULL, 'I', '2013-02-05 18:18:41', '0'),
	(59, 'Lalit', NULL, NULL, 'Lalit Tyagi', 'lalit.tyagi@aabsys.com', '2013', 'lalit', '', '1', 1, 'z', 'B.tech', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1020590.JPG', NULL, 'I', '2013-03-07 12:53:52', '0'),
	(69, 'AABSyS IT', NULL, NULL, 'AABSyS IT', 'aabsys@gmail.com', '2013', 'aabsys', '', '1', 69, 'y', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1020577.JPG', NULL, 'I', '2013-03-06 10:32:55', '0'),
	(74, 'Dilip', NULL, NULL, 'Dilip Rath', 'dilip.rath@aabsys.com', '2013', 'dilip', '', '1', 1, 'x', 'B.tech', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1020590.JPG', NULL, 'I', '2013-03-06 10:34:05', '0'),
	(85, 'Raj', NULL, NULL, 'Rajesh Kumar', 'rajeshkukhatei@gmail.com', '123', 'abc', '', '1', 0, 'x', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, 'S', '', 'P1020514.JPG', NULL, 'I', '2013-02-27 10:15:19', '0'),
	(86, NULL, NULL, NULL, 'r', 'aabsys.rajesh@gmail.com', '1', 'fdff', 'c9f0f895fb98ab9159f51fd0297e236d', '1', 0, '', '', '', '', NULL, NULL, NULL, 'S', '', NULL, NULL, 'I', '2013-02-04 14:53:04', '0'),
	(87, NULL, NULL, NULL, 'sbc', 'acd@gmail.com', '546', 'raj', 'sdsdsd4343', '0', 0, '', '', '', '', NULL, NULL, NULL, 'S', '', NULL, NULL, 'I', '2013-02-07 16:36:03', '0'),
	(88, 'r', NULL, NULL, 'raj', 'aabsys.rajesh@gmail.com', '1', 'w', '1be3bc32e6564055d5ca3e5a354acbef', '0', 0, '', '', '', '', NULL, NULL, NULL, 'S', '', NULL, NULL, 'I', '2013-02-01 14:51:23', '0'),
	(90, 'Rajesh Kumar', NULL, 'Khatei', 'Rajesh Ku Khatei', 'biki@gmail.com', '2015', 'biki', '9232fe81225bcaef853ae32870a2b0fe', '1', 0, '', '', '', '', NULL, NULL, NULL, 'S', '', '5114e5960c080_profile.jpeg', '', 'I', '2013-02-22 14:46:29', '0');
/*!40000 ALTER TABLE `alacut_member` ENABLE KEYS */;


# Dumping structure for table alacut.friend
CREATE TABLE IF NOT EXISTS `friend` (
  `friend_id` int(11) NOT NULL AUTO_INCREMENT,
  `frnd_req_from_id` int(11) NOT NULL,
  `frnd_req_to_id` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('P','C','R','U') NOT NULL DEFAULT 'P',
  `view` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`friend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

# Dumping data for table alacut.friend: ~40 rows (approximately)
/*!40000 ALTER TABLE `friend` DISABLE KEYS */;
INSERT INTO `friend` (`friend_id`, `frnd_req_from_id`, `frnd_req_to_id`, `date_time`, `status`, `view`) VALUES
	(1, 24, 23, '2013-01-02 15:56:10', 'C', '0'),
	(2, 24, 22, '2013-01-02 15:57:56', 'U', '0'),
	(3, 29, 22, '2013-01-02 15:57:56', 'C', '0'),
	(5, 22, 24, '2013-01-02 18:14:47', 'C', '0'),
	(6, 22, 36, '2013-01-02 18:48:26', 'C', '0'),
	(7, 22, 55, '2013-01-03 14:07:57', 'C', '0'),
	(8, 22, 41, '2013-01-03 14:08:00', 'P', '0'),
	(9, 36, 23, '2013-01-03 14:08:35', 'C', '0'),
	(10, 36, 24, '2013-01-03 14:08:40', 'C', '0'),
	(11, 36, 22, '2013-01-03 14:08:44', 'R', '0'),
	(12, 36, 41, '2013-01-03 14:08:46', 'P', '0'),
	(13, 41, 22, '2013-01-03 14:10:29', 'C', '0'),
	(14, 41, 24, '2013-01-03 14:10:39', 'C', '0'),
	(15, 41, 23, '2013-01-03 14:10:41', 'C', '0'),
	(16, 41, 55, '2013-01-03 14:10:44', 'R', '0'),
	(17, 69, 41, '2013-01-03 14:10:46', 'C', '0'),
	(19, 23, 85, '2013-01-04 15:11:06', 'P', '0'),
	(21, 23, 69, '2013-01-04 15:27:20', 'C', '0'),
	(22, 69, 22, '2013-01-04 15:28:53', 'C', '0'),
	(23, 24, 21, '2013-01-05 16:25:47', 'C', '0'),
	(24, 23, 22, '2013-01-05 16:28:27', 'C', '0'),
	(25, 22, 30, '2013-01-05 16:32:03', 'C', '0'),
	(26, 23, 85, '2013-01-07 11:08:19', 'C', '0'),
	(29, 23, 69, '2013-01-07 12:47:48', 'C', '0'),
	(31, 24, 36, '2013-01-07 12:57:52', 'P', '0'),
	(32, 24, 41, '2013-01-07 13:00:03', 'P', '0'),
	(33, 22, 30, '2013-01-31 11:53:09', 'C', '0'),
	(34, 22, 30, '2013-01-31 11:54:05', 'C', '0'),
	(35, 22, 24, '2013-02-10 12:41:50', 'C', '0'),
	(36, 22, 41, '2013-02-10 12:49:31', 'P', '0'),
	(40, 22, 23, '2013-02-14 16:56:58', 'C', '0'),
	(41, 0, 24, '2013-02-15 23:59:17', 'P', '0'),
	(42, 0, 69, '2013-02-16 00:03:53', 'P', '0'),
	(43, 0, 88, '2013-02-20 09:14:28', 'P', '0'),
	(44, 22, 30, '2013-03-01 12:12:50', 'P', '0'),
	(45, 24, 85, '2013-03-04 14:23:50', 'P', '0'),
	(46, 24, 87, '2013-03-04 14:24:58', 'P', '0'),
	(48, 22, 29, '2013-03-06 19:33:29', 'C', '0'),
	(49, 24, 36, '2013-04-09 16:49:34', 'C', '0'),
	(50, 24, 36, '2013-04-09 16:49:39', 'C', '0'),
	(51, 55, 22, '2013-04-12 12:08:27', 'C', '0'),
	(52, 55, 22, '2013-04-12 12:11:03', 'C', '0');
/*!40000 ALTER TABLE `friend` ENABLE KEYS */;


# Dumping structure for table alacut.message
CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_from_id` int(11) NOT NULL,
  `message_to_id` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message_content` varchar(440) NOT NULL,
  `reply_id` int(11) NOT NULL DEFAULT '0',
  `status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '''0''-Not read,''1''-Read,''2''-delete',
  `active` enum('0','1') NOT NULL DEFAULT '1' COMMENT '''1''-approve ,''0''-not Approve',
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

# Dumping data for table alacut.message: ~12 rows (approximately)
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` (`message_id`, `message_from_id`, `message_to_id`, `date_time`, `message_content`, `reply_id`, `status`, `active`) VALUES
	(1, 24, 23, '2013-02-11 12:23:40', '1.HI', 0, '1', '1'),
	(3, 23, 24, '2013-02-11 12:18:18', '1.Anshuman sir', 0, '1', '1'),
	(6, 24, 23, '2013-02-11 13:56:11', 'hello', 1, '1', '1'),
	(7, 23, 24, '2013-02-11 12:28:08', 'Well done', 1, '1', '1'),
	(8, 23, 24, '2013-02-11 13:57:47', 'enjoying', 1, '1', '1'),
	(9, 24, 23, '2013-02-11 13:57:52', 'yes', 1, '1', '1'),
	(10, 23, 24, '2013-02-11 13:58:57', 'doing your work?', 1, '1', '1'),
	(11, 23, 24, '2013-02-11 14:00:19', 'have fun', 1, '1', '1'),
	(12, 23, 24, '2013-02-11 14:01:15', 'hi', 1, '1', '0'),
	(13, 23, 24, '2013-02-11 14:02:41', 'hi', 1, '1', '1'),
	(14, 23, 24, '2013-02-11 14:03:32', 'ghgfh', 1, '1', '0'),
	(15, 22, 24, '2013-02-26 11:09:17', 'hghg', 0, '1', '1'),
	(16, 24, 23, '2013-04-12 09:14:51', 'hiiiiii', 1, '0', '1'),
	(17, 24, 23, '2013-04-12 11:00:15', 'hii anshuman', 1, '0', '1'),
	(18, 24, 22, '2013-04-12 11:27:46', 'hii', 0, '0', '1'),
	(19, 24, 22, '2013-04-12 11:29:43', 'hii', 0, '0', '1');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;


# Dumping structure for table alacut.post_comments
CREATE TABLE IF NOT EXISTS `post_comments` (
  `post_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `videoID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` varchar(140) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '''0''-not read,''1''-read,''2''-delete',
  `active` enum('0','1') NOT NULL DEFAULT '1' COMMENT '''1''-approve ,''0''-not Approve',
  PRIMARY KEY (`post_comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

# Dumping data for table alacut.post_comments: ~40 rows (approximately)
/*!40000 ALTER TABLE `post_comments` DISABLE KEYS */;
INSERT INTO `post_comments` (`post_comment_id`, `videoID`, `memberID`, `date_time`, `comment`, `post_type`, `status`, `active`) VALUES
	(1, 3, 22, '2013-02-15 22:17:30', 'NIce post', '', '1', '1'),
	(2, 19, 23, '2013-02-05 16:26:20', 'Great', '', '0', '1'),
	(3, 14, 24, '2013-02-05 16:26:21', 'Keep it up', '', '0', '1'),
	(4, 22, 24, '2013-02-05 15:54:20', 'Nice car', '', '0', '1'),
	(5, 11, 24, '2013-02-05 16:20:48', 'Good movie', '', '0', '1'),
	(6, 12, 24, '2013-02-05 16:27:15', 'nice movie', '', '0', '1'),
	(7, 11, 24, '2013-02-05 16:28:21', 'good job', '', '0', '1'),
	(8, 11, 24, '2013-02-05 16:30:41', 'wahoo', '', '0', '0'),
	(9, 22, 24, '2013-02-05 16:31:14', 'really fantastic', '', '0', '1'),
	(10, 12, 24, '2013-02-05 16:35:59', 'xyz', '', '0', '1'),
	(27, 14, 24, '2013-02-05 16:47:16', 'good', '', '0', '1'),
	(28, 11, 24, '2013-02-06 10:02:09', 'keep it up vicky', '', '0', '1'),
	(29, 3, 24, '2013-02-06 10:21:56', 'Well done Raj', '', '0', '0'),
	(30, 16, 24, '2013-02-06 10:22:37', 'I love animated movie', '', '0', '1'),
	(31, 18, 22, '2013-02-07 12:37:00', 'Nice\n', '', '1', '1'),
	(32, 18, 22, '2013-02-07 16:15:09', 'Good', '', '1', '1'),
	(33, 19, 23, '2013-02-09 11:42:58', 'waoo', '', '0', '1'),
	(34, 5, 22, '2013-02-09 21:42:59', 'x', '', '2', '1'),
	(35, 5, 22, '2013-02-09 21:48:17', 'nice', '', '1', '0'),
	(36, 7, 22, '2013-02-10 09:23:11', 'What s up dude', '', '0', '1'),
	(37, 10, 22, '2013-02-10 09:24:08', 'What s dance', '', '1', '0'),
	(38, 24, 22, '2013-02-10 10:20:22', 'What s this', '', '1', '1'),
	(39, 14, 22, '2013-02-10 12:28:34', 'nice post', '', '0', '1'),
	(40, 29, 22, '2013-02-15 22:17:42', 'HI', '', '1', '1'),
	(41, 41, 22, '2013-03-04 17:19:29', 'What a shot', '', '0', '1'),
	(42, 41, 22, '2013-03-07 00:09:32', 'Sachin.....', '', '0', '1'),
	(43, 41, 22, '2013-03-07 00:12:11', 'i love cricket', '', '0', '1'),
	(45, 154, 22, '2013-03-07 12:11:09', 'Once more', '', '0', '1'),
	(46, 14, 24, '2013-04-10 09:43:32', 'nice one', '', '0', '1'),
	(47, 14, 24, '2013-04-10 09:58:35', 'testing', '', '0', '1'),
	(48, 14, 24, '2013-04-10 10:01:36', 'another comment', '', '0', '1'),
	(49, 14, 24, '2013-04-10 10:03:25', 'action 1', '', '0', '1'),
	(50, 22, 24, '2013-04-10 10:03:36', 'action 2', '', '0', '1'),
	(51, 175, 24, '2013-04-10 12:15:54', 'hii', '', '0', '1'),
	(52, 178, 24, '2013-04-10 12:54:49', 'hello', '', '0', '1'),
	(53, 180, 24, '2013-04-10 13:49:27', 'nice', '', '0', '1'),
	(54, 14, 24, '2013-04-11 14:59:20', 'test comments', '', '0', '1'),
	(55, 14, 24, '2013-04-11 14:59:30', 'testing', '', '0', '1'),
	(56, 177, 24, '2013-04-11 17:33:45', 'testing', '', '0', '1'),
	(57, 174, 24, '2013-04-11 19:34:04', 'hii', '', '0', '1'),
	(58, 14, 24, '2013-04-12 10:00:26', 'nothing happen', '', '0', '1'),
	(59, 14, 24, '2013-04-12 10:37:21', 'hii shreyankar chora', '', '0', '1'),
	(60, 198, 55, '2013-04-12 12:30:13', 'hello', '', '0', '1'),
	(61, 199, 55, '2013-04-12 12:30:22', 'o balma', '', '0', '1'),
	(62, 200, 55, '2013-04-12 12:30:59', 'hii', '', '0', '1'),
	(63, 14, 24, '2013-04-12 12:32:03', 'hjghg', '', '0', '1'),
	(64, 0, 24, '2013-04-12 12:51:43', 'nice song', '', '0', '1'),
	(65, 16, 24, '2013-04-12 14:25:44', 'comment plz', '', '0', '1');
/*!40000 ALTER TABLE `post_comments` ENABLE KEYS */;


# Dumping structure for table alacut.upload_image
CREATE TABLE IF NOT EXISTS `upload_image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `img_upload_by` int(11) NOT NULL,
  `image_name` varchar(30) NOT NULL,
  `image_url` varchar(128) NOT NULL,
  `image_desc` varchar(500) NOT NULL,
  `uploaded_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

# Dumping data for table alacut.upload_image: ~8 rows (approximately)
/*!40000 ALTER TABLE `upload_image` DISABLE KEYS */;
INSERT INTO `upload_image` (`image_id`, `img_upload_by`, `image_name`, `image_url`, `image_desc`, `uploaded_date`, `status`) VALUES
	(1, 24, 'Animated', 'http://animated-desktop-background.com/wp-content/uploads/2012/06/free-animated-nature-backgrounds.jpg', 'Good snap', '2013-02-05 09:59:05', '2'),
	(2, 22, 'Nature', 'http://cdn.hdwallpaperspics.com/uploads/2012/11/free-animated-desktop-wallpaper-for-mac.jpg', 'What a picture', '2013-02-05 10:31:55', '2'),
	(4, 22, '', '51307afd2c6f3.jpeg', '', '2013-03-01 15:25:09', '2'),
	(5, 22, '', '51307b536e5c9.jpeg', '', '2013-03-01 15:26:35', '2'),
	(6, 22, '', '51318590c039b.jpeg', '', '2013-03-02 10:22:32', '0'),
	(7, 22, '', '5131859626953.jpeg', '', '2013-03-02 10:22:38', '2'),
	(8, 22, '', '51318599a4159.jpeg', '', '2013-03-02 10:22:41', '0'),
	(9, 22, '', '5131859c036fd.jpeg', '', '2013-03-02 10:22:44', '2');
/*!40000 ALTER TABLE `upload_image` ENABLE KEYS */;


# Dumping structure for table alacut.upload_video
CREATE TABLE IF NOT EXISTS `upload_video` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_upload_by` int(11) NOT NULL,
  `video_name` varchar(30) DEFAULT NULL,
  `video_url` varchar(256) NOT NULL,
  `video_object` varchar(128) NOT NULL,
  `video_desc` varchar(4540) DEFAULT NULL,
  `video_image` varchar(255) DEFAULT NULL,
  `video_type` varchar(20) NOT NULL,
  `uploaded_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '''0''-not View,''1''-''View'',''2''-''deleted''',
  `like` int(30) NOT NULL DEFAULT '0',
  `dislike` int(30) NOT NULL DEFAULT '0',
  `visit` int(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=latin1;

# Dumping data for table alacut.upload_video: ~56 rows (approximately)
/*!40000 ALTER TABLE `upload_video` DISABLE KEYS */;
INSERT INTO `upload_video` (`video_id`, `video_upload_by`, `video_name`, `video_url`, `video_object`, `video_desc`, `video_image`, `video_type`, `uploaded_date`, `status`, `like`, `dislike`, `visit`) VALUES
	(1, 23, 'Skyfall Official Trailer #2 (2', 'http://www.youtube.com/watch?feature=player_embedded&v=iGng9NLo37Y', 'iGng9NLo37Y', 'Subscribe to TRAILERS: http://bit.ly/sxaw6h<br/>Subscribe to COMING SOON: http://bit.ly/H2vZUn<br/>Skyfall Official Trailer #2 (2012) - James Bond Movie HD<br/><br/><br/>Bond\'s loyalty to M is tested as her past comes back to haunt her. <br/><br/><br/>"skyfall trailer" "Daniel Craig" "Helen McCrory" "Javier Bardem" "John Logan" "Ian Fleming" "Ralph Fiennes" "Judi Dench" "Naomie Harris" "Albert Finney" "Ben Whishaw" "Berenice Marlohe" "james bond" 007 "behind the scenes" "video Blog" movieclips movie clips movieclipsDOTcom popuptrailer movieclipstrailer shanghai istanbul turkey "production design" "teaser for the trailer" "new skyfall trailer" "james bond new trailer" "skyfall international trailer" DCoscarelli', 'http://i1.ytimg.com/vi/iGng9NLo37Y/mqdefault.jpg', 'youtube', '2013-02-07 10:34:48', '2', 0, 0, 0),
	(2, 23, '2012. 366 days. 366 seconds.', 'http://vimeo.com/56599373', '56599373', 'I filmed one second every day of 2012.<br />\r\n<br />\r\nThe music is "Thunder Clatter" by Wild Cub.<br />\r\nhttp://wildcub.bandcamp.com/track/thunder-clatter<br />\r\n<br />\r\nwww.jonathanbritnell.com<br />\r\ntwitter.com/jrbritnell<br />\r\n<br />\r\nUPDATE: Thanks to everyone for watching! Here are a few more details about the video:<br />\r\n<br />\r\nIt really is, in chronological order, 1 second from every single day of 2012.<br />\r\n<br />\r\nIt was shot on a Canon 7D and a few shots on a GoPro Hero2.<br />\r\n<br />\r\nI edited with Final Cut Pro 7 and graded with Magic Bullet Looks.<br />\r\n<br />\r\nAlmost all the shots of people are either my wife Jessica or my brother Jimmy.<br />\r\n<br />\r\nBONUS: if you look very closely at 2:25 you can see me wipe out in the distance on a long board. It hurt.', 'http://b.vimeocdn.com/ts/391/956/391956613_200.jpg', 'vimeo', '2013-02-09 14:15:49', '0', 1, 0, 64),
	(3, 22, 'Titanic 3D - Trailer', 'http://www.youtube.com/watch?v=tXsyGFXjzcY', 'tXsyGFXjzcY', 'Titanic is a 1997 American epic romance and disaster film directed, written, co-produced, and co-edited by James Cameron. A fictionalized account of the sinking of the RMS Titanic, it stars Leonardo DiCaprio as Jack Dawson, Kate Winslet as Rose DeWitt Bukater and Billy Zane as Rose\'s fiancÃ©, Cal Hockley. Jack and Rose are members of different social classes who fall in love aboard the ship during its ill-fated maiden voyage. Revisit the movie in 3D this time.<br/><br/><br/>For more Updates, <br/>visit http://www.youtube.com/foxstarindia<br/><br/>For More Titanic Updates, Like us on Facebook http://www.facebook.com/titanicmovieindia<br/><br/>"LIKE" our Facebook page https://www.facebook.com/FoxStarIndia', 'http://i1.ytimg.com/vi/tXsyGFXjzcY/mqdefault.jpg', 'youtube', '2013-02-09 15:02:41', '2', 1, 0, 68),
	(4, 22, '2012 BIFA  // 15 Years', 'https://vimeo.com/56654321', '56654321', 'Created for the 2012 MoÃ«t British Independent Film Awards (in collaboration with Intermission Film). A mashup of the past 14 award winners: Tyrannosaur, The King s Speech, Moon, Slumdog Millionaire, Control, This Is England, The Constant Gardner, Vera Drake, Dirty Pretty Things, Sweet Sixteen, Sexy Beast, Billy Elliot, Wonderland, and My Name is Joe. The 15th winner (awarded that night) was Broken.<br />\r\n<br />\r\nMusic: Welcome to Lunar Industries by Clint Mansell', 'http://b.vimeocdn.com/ts/392/307/392307658_200.jpg', 'vimeo', '2013-02-09 15:56:21', '0', 1, 0, 239),
	(7, 22, 'Skyfall Official Trailer #2 (2', 'http://www.youtube.com/watch?feature=player_embedded&v=iGng9NLo37Y', 'iGng9NLo37Y', 'Subscribe to TRAILERS: http://bit.ly/sxaw6h<br/>Subscribe to COMING SOON: http://bit.ly/H2vZUn<br/>Skyfall Official Trailer #2 (2012) - James Bond Movie HD<br/><br/><br/>Bond\'s loyalty to M is tested as her past comes back to haunt her. <br/><br/><br/>"skyfall trailer" "Daniel Craig" "Helen McCrory" "Javier Bardem" "John Logan" "Ian Fleming" "Ralph Fiennes" "Judi Dench" "Naomie Harris" "Albert Finney" "Ben Whishaw" "Berenice Marlohe" "james bond" 007 "behind the scenes" "video Blog" movieclips movie clips movieclipsDOTcom popuptrailer movieclipstrailer shanghai istanbul turkey "production design" "teaser for the trailer" "new skyfall trailer" "james bond new trailer" "skyfall international trailer" DCoscarelli', 'http://i1.ytimg.com/vi/iGng9NLo37Y/mqdefault.jpg', 'youtube', '2013-02-09 15:02:48', '0', 0, 2, 205),
	(12, 24, 'Krrish 3 | Hindi Movie | Offic', 'http://www.youtube.com/watch?v=qRDUb5MZRRQ', 'qRDUb5MZRRQ', 'Krrish 3 | Hindi Movie | Official Trailer | 2013 New , Krish Full Movie<br/><br/>www.risemusic.in', 'http://i1.ytimg.com/vi/qRDUb5MZRRQ/mqdefault.jpg', 'youtube', '2013-02-09 10:52:29', '2', 1, 0, 33),
	(13, 22, 'Brave Trailer 2 Official 2012 ', 'http://www.youtube.com/watch?feature=player_embedded', '1_GeQmhxc6g', 'http://bit.ly/clevvermovies - Click to Subscribe!\r<br/>http://Facebook.com/ClevverMovies - Become a Fan!\r<br/>http://Twitter.com/ClevverMovies - Follow Us!\r<br/>\r<br/>Brave hits theaters on June 22nd, 2012.\r<br/>\r<br/>Cast: Kelly Macdonald, Billy Connolly, Craig Ferguson, Emma Thompson, Julie Walters, Kevin McKidd, Robbie Coltrane\r<br/>\r<br/>Since ancient times, stories of epic battles and mystical legends have been passed through the generations across the rugged and mysterious Highlands of Scotland. In "Brave," a new tale joins the lore when the courageous Merida (voice of Kelly Macdonald) confronts tradition, destiny and the fiercest of beasts.\r<br/>\r<br/>Merida is a skilled archer and impetuous daughter of King Fergus (voice of Billy Connolly) and Queen Elinor (voice of Emma Thompson). Determined to carve her own path in life, Merida defies an age-old custom sacred to the uproarious lords of the land: massive Lord MacGuffin (voice of Kevin McKidd), surly Lord Macintosh (voice of Craig Ferguson) and cantankerous Lord Dingwall (voice of Robbie Coltrane). Merida\'s actions inadvertently unleash chaos and fury in the kingdom, and when she turns to an eccentric old Witch (voice of Julie Walters) for help, she is granted an ill-fated wish. The ensuing peril forces Merida to discover the meaning of true bravery in order to undo a beastly curse before it\'s too late.\r<br/>\r<br/>Brave trailer courtesy Walt Disney Pictures.', 'http://i1.ytimg.com/vi/1_GeQmhxc6g/mqdefault.jpg', 'youtube', '2013-02-07 10:34:48', '2', 0, 0, 0),
	(14, 24, 'Oblivion Trailer (2013)', 'http://www.youtube.com/watch?v=vGpjlfCfe2Y', 'vGpjlfCfe2Y', 'Earth is a memory worth fighting for... Watch new Trailer here : http://www.youtube.com/watch?v=FH7MM3c8mJI The first Oblivion Trailer starring Tom Cruise. An original and groundbreaking cinematic event from the director of TRON: Legacy and the producer of Rise of the Planet of the Apes.', 'http://i1.ytimg.com/vi/vGpjlfCfe2Y/mqdefault.jpg', 'youtube', '2013-02-09 15:48:14', '', 2, 3, 190),
	(16, 23, 'EPIC Trailer 2013', 'http://www.youtube.com/watch?v=j6Nwdpa5PcU', 'j6Nwdpa5PcU', 'Epic Trailer 2013 Movie - Official 2012 trailer in HD - Animated Adventure-Comedy starring Colin Farrell, Amanda Seyfried, Josh Hutcherson, and Beyonce Knowles - directed by Chris Wedge - a 3D CG movie that reveals a hidden world unlike any other\n\nEpic movie hits theaters on May 17, 2013.\n\nEPIC tells the story of an ongoing battle deep in the forest between the forces of good and the forces of evil.  When a teen age girl finds herself magically transported into this secret universe, she must band together with a rag-tag team of fun and whimsical characters in order to save their world...and ours. Epic movie trailer 2013 is presented in full HD 1080p high resolution. \n\nEPIC 2013 Movie\nDirector: Chris Wedge\nWriters: Tom J. Astle, Matt Ember\nStars: Colin Farrell, Amanda Seyfried, Josh Hutcherson and Beyonce Knowles.\n\nEpic official movie trailer courtesy 20th Century Fox.\n\nCieon Movies is your daily dose of "everything movies", a mainstream channel with wider coverage from G-rated to R-rated movies and includes both theatrical and DVD releases, with an extended selection of officially licensed movie trailers and movie clips.\n\nTags: "epic trailer" "epic 2013" epic trailer 2013 official hd movie 2012 "epic trailer 2013" "epic trailer 2012" "epic movie" "epic movie trailer" "epic 2013 movie" "epic 2013 trailer" "colin farrell" "amanda seyfried" "josh hutcherson" "beyonce knowles" "chris wedge" colin farrell amanda seyfried hutcherson beyonce knowles chris wedge movies trailers film films today this week month year new "official trailer" "movie trailer" "film trailer" "trailer 2013" "trailer 2012"', 'http://i1.ytimg.com/vi/j6Nwdpa5PcU/mqdefault.jpg', 'youtube', '2013-02-09 10:10:34', '0', 2, 0, 594),
	(17, 23, 'Jurassic Park 3D', 'http://www.youtube.com/watch?v=bc-fZaLbyJM', 'bc-fZaLbyJM', 'Jurassic Park  3D - Official Trailer (2013)\r\n\r\n\r\nGenre : Science Fiction\r\nOfficial Site : http://www.jurassicpark.com\r\nDirector:Steven Spielberg\r\nCast:Sam Neill, Laura Dern, Jeff Goldblum, Richard AttenboroughWriters:David Koepp, Michael Crichton\r\n\r\nSynopsis\r\nUniversal Pictures will release Steven Spielberg groundbreaking masterpiece JURASSIC PARK in 3D on April 5, 2013. With his remastering of the epic into a state-of-the-art 3D format, Spielberg introduces the three-time Academy AwardÂ®-winning blockbuster to a new generation of moviegoers and allows longtime fans to experience the world he envisioned in a way that was unimaginable during the film original release. Starring Sam Neill, Laura Dern, Jeff Goldblum, Samuel L. Jackson and Richard Attenborough, the film based on the novel by Michael Crichton is produced by Kathleen Kennedy and Gerald R. Molen.', 'http://i1.ytimg.com/vi/bc-fZaLbyJM/mqdefault.jpg', 'youtube', '2013-02-09 14:15:44', '0', 1, 0, 41),
	(18, 22, 'Jurassic Park 3D', 'http://www.youtube.com/watch?feature=player_embedded', 'bc-fZaLbyJM', 'Jurassic Park  3D - Official Trailer (2013)\n\n\nGenre : Science Fiction\nOfficial Site : http://www.jurassicpark.com\nDirector:Steven Spielberg\nCast:Sam Neill, Laura Dern, Jeff Goldblum, Richard AttenboroughWriters:David Koepp, Michael Crichton\n\nSynopsis\nUniversal Pictures will release Steven Spielberg s groundbreaking masterpiece JURASSIC PARK in 3D on April 5, 2013. With his remastering of the epic into a state-of-the-art 3D format, Spielberg introduces the three-time Academy AwardÂ®-winning blockbuster to a new generation of moviegoers and allows longtime fans to experience the world he envisioned in a way that was unimaginable during the film s original release. Starring Sam Neill, Laura Dern, Jeff Goldblum, Samuel L. Jackson and Richard Attenborough, the film based on the novel by Michael Crichton is produced by Kathleen Kennedy and Gerald R. Molen.', 'http://i1.ytimg.com/vi/bc-fZaLbyJM/mqdefault.jpg', 'youtube', '2013-02-09 15:54:30', '2', 1, 0, 53),
	(19, 23, 'Oblivion Trailer (2013)', 'http://www.youtube.com/watch?v=vGpjlfCfe2Y', 'vGpjlfCfe2Y', 'Earth is a memory worth fighting for...  Watch the first Oblivion Trailer starring Tom Cruise. An original and groundbreaking cinematic event from the director of TRON: Legacy and the producer of Rise of the Planet of the Apes. On a spectacular future Earth that has evolved beyond recognition, one man s confrontation with the past will lead him on a journey of redemption and discovery as he battles to save mankind. ack Harper (Cruise) is one of the last few drone repairmen stationed on Earth. Part of a massive operation to extract vital resources after decades of war with a terrifying threat known as the Scavs, Jack s mission is nearly complete.\n\nLiving in and patrolling the breathtaking skies from thousands of feet above, his soaring existence is brought crashing down when he rescues a beautiful stranger from a downed spacecraft. Her arrival triggers a chain of events that forces him to question everything he knows and puts the fate of humanity in his hands.\n\nOblivion was shot in stunning digital 4K resolution on location across the United States and Iceland.\n\nOblivion Official Trailer. Join us on Facebook http://facebook.com/FreshMovieTrailers & http://twitter.com/mytrailerisrich and subscribe now to get the best and the latest movie trailers, clips and videos !', 'http://i1.ytimg.com/vi/vGpjlfCfe2Y/mqdefault.jpg', 'youtube', '2013-02-09 14:01:05', '0', 1, 1, 60),
	(20, 24, '[HD] Audi R8 goes up in flames', 'http://www.youtube.com/watch?v=KjIuFsk1hgQ', 'KjIuFsk1hgQ', '27/01/2013\n\nAs a fan of these cars, this hurt to watch.\nA silver grey Audi R8 caught fire on the Bandra-Worli sealink today morning. \n(video taken from several sources, same incident)\n\nAudi R8 up in Flames in Mumbai at the Parx Supercar Rally 2013\nExclusive video Audi R8 up in Flames in Mumbai at the Parx Supercar Rally 2013', 'http://i1.ytimg.com/vi/KjIuFsk1hgQ/mqdefault.jpg', 'youtube', '2013-02-07 10:34:48', '2', 0, 0, 0),
	(21, 24, 'Earring Studs movie', 'http://www.youtube.com/user/realeyez3d?v=tmL9uUwjesA', 'tmL9uUwjesA', 'Beautiful pair of earring studs, all in 3d.', 'http://i1.ytimg.com/vi/tmL9uUwjesA/mqdefault.jpg', 'youtube', '2013-02-07 10:34:48', '2', 0, 0, 0),
	(22, 24, 'Tata Manza -  A class apart', 'http://www.youtube.com/watch?v=tyTRR2vT0Qk', 'tyTRR2vT0Qk', 'Introducing the all new Tata Manza. With exteriors detailed in chrome and interiors dressed in beige and burgundy, the Manza makes a bold statement. \n\nTest Drive it today', 'http://i1.ytimg.com/vi/tyTRR2vT0Qk/mqdefault.jpg', 'youtube', '2013-02-09 14:00:49', '', 1, 1, 97),
	(23, 22, 'Fast & Furious 6 - Extended', 'http://www.youtube.com/watch?v=p1QgNF6J1h0', 'p1QgNF6J1h0', 'Official Website: http://thefastandthefurious.com\n\nVin Diesel, Paul Walker and Dwayne Johnson lead the returning cast of all-stars as the global blockbuster franchise built on speed races to its next continent in Fast & Furious 6.  Reuniting for their most high-stakes adventure yet, fan favorites Jordana Brewster, Michelle Rodriguez, Tyrese Gibson, Sung Kang, Gal Gadot, Chris "Ludacris" Bridges and Elsa Pataky are joined by badass series newcomers Luke Evans and Gina Carano.\n\nSince Dom (Diesel) and Brian s (Walker) Rio heist toppled a kingpin s empire and left their crew with $100 million, our heroes have scattered across the globe.  But their inability to return home and living forever on the lam have left their lives incomplete.  \n\nMeanwhile, Hobbs (Johnson) has been tracking an organization of lethally skilled mercenary drivers across 12 countries, whose mastermind (Evans) is aided by a ruthless second-in-command revealed to be the love Dom thought was dead, Letty (Rodriguez).  The only way to stop the criminal outfit is to outmatch them at street level, so Hobbs asks Dom to assemble his elite team in London.  Payment?  Full pardons for all of them so they can return home and make their families whole again.  \n\nBuilding on the worldwide blockbuster success of Fast Five and taking the action, stunts and narrative to even greater heights, Fast & Furious 6 sees director Justin Lin back behind the camera for the fourth time.  He is supported by longtime producers Neal H. Moritz and Vin Diesel, who welcome producer Clayton Townsend back to the series.', 'http://i1.ytimg.com/vi/p1QgNF6J1h0/mqdefault.jpg', 'youtube', '2013-02-09 15:56:14', '2', 0, 1, 2),
	(24, 22, 'FASHION FILM', 'http://vimeo.com/58933055', '58933055', 'Lizzy Caplan for Viva Vena!', 'http://b.vimeocdn.com/ts/409/313/409313663_200.jpg', 'vimeo', '2013-02-09 16:15:15', '0', 1, 0, 91),
	(25, 24, '50 Cent - You Should Be Dead', 'http://www.youtube.com/watch?v=UL1XLzec2vM', 'UL1XLzec2vM', 'www.Thisis50.com - IF IT S HOT IT S HERE', 'http://i1.ytimg.com/vi/UL1XLzec2vM/mqdefault.jpg', 'youtube', '2013-02-09 17:21:32', '2', 1, 0, 4),
	(29, 22, 'Dave', 'http://vimeo.com/58450445', '58450445', 'Dave is trying all kinds of way to get to work on time. Will he make it?', 'http://b.vimeocdn.com/ts/405/674/405674235_200.jpg', 'vimeo', '2013-02-10 09:52:21', '2', 1, 0, 16),
	(31, 22, 'Drake - Started From The Botto', 'http://www.youtube.com/watch?v=NZOKgL_OjLk', 'NZOKgL_OjLk', 'Drake s latest single "Started From The Bottom" is now available on iTunes. Purchase it here: http://itun.es/i6J29Xz\n\nFollow my fan account! - @ItsJustDrake -  www.twitter.com/ItsJustDrake\n\nWiz Khalifa - Started From The Bottom Wiz Khalifa - Started From The Bottom\nWiz Khalifa - Started From The Bottom Wiz Khalifa - Started From The Bottom\nWiz Khalifa - Started From The Bottom Wiz Khalifa - Started From The Bottom\nWiz Khalifa - Started From The Bottom Wiz Khalifa - Started From The Bottom Wiz Khalifa - Started From The Bottom\nWiz Khalifa - Started From The Bottom Wiz Khalifa - Started From The Bottom\nWiz Khalifa - Started From The Bottom Wiz Khalifa - Started From The Bottom\nWiz Khalifa - Started From The Bottom\n\nMusic video by Drake performing Started From The Bottom. \n(C) 2013 Cash Money Records Inc\n\nDrake - Started From The Bottom \nDrake - Started From The Bottom \nDrake - Started From The Bottom \nDrake - Started From The Bottom \nDrake - Started From The Bottom \nDrake - Started From The Bottom \nWiz Khalifa ft. Drake - Started From The Bottom \nWiz Khalifa ft. Drake - Started From The Bottom \nWiz Khalifa ft. Drake - Started From The Bottom \nWiz Khalifa ft. Drake - Started From The Bottom \nWiz Khalifa ft. Drake - Started From The Bottom \n\nDrake New Song 2013 Official Video\nDrake New Song 2013 Official Video\nDrake New Song 2013 Official Video\nDrake New Song 2013 Official Video\nDrake New Song 2013 Official Video', 'http://i1.ytimg.com/vi/NZOKgL_OjLk/mqdefault.jpg', 'youtube', '2013-02-10 13:22:51', '2', 0, 0, 5),
	(32, 22, 'The Chipettes- Tik Tok', 'http://www.youtube.com/watch?v=xTSxYvOaJXc', 'xTSxYvOaJXc', 'Brittany- We Singing Tik Tok ( Enjoy)', 'http://i1.ytimg.com/vi/xTSxYvOaJXc/mqdefault.jpg', 'youtube', '2013-02-10 13:28:02', '0', 1, 1, 510),
	(41, 22, 'Tendulkar\'s Reply To Sreesanth', 'http://www.youtube.com/watch?v=2jtOBWSko_E', '2jtOBWSko_E', 'raj\'s', 'http://i1.ytimg.com/vi/2jtOBWSko_E/mqdefault.jpg', 'youtube', '2013-02-12 07:29:15', '0', 2, 0, 400),
	(45, 85, 'The Undertaker returns at WWE ', 'http://www.youtube.com/watch?v=aH5wz_gi76Q', 'aH5wz_gi76Q', 'The Undertaker made a surprised return to WWE on Saturday night at a Smackdown house show in Waco, Texas, teaming with Sheamus to defeat Damien Sandow and Wade Barrett.\n\nThis was the first time Undertaker has appeared in a WWE ring since RAW 1000 back in July. This is a good sign that he ll be wrestling at WrestleMania 29.\n\n\nTriple H, Shawn Michaels, Brock Lesnar, Rob Van Dam, Mick Foley, Randy Orton, Mr Kennedy, Eddie Guerrero, Edge, John Cena, Rey Mysterio, Chris Jericho, Tazz, Matt Hardy, The Big Show, Sabu, Terry Funk, Jeff Hardy, Batista, Chris Benoit, Kurt Angle, Psicosis, Stone Cold Steve Austin, Eric Bischoff, JBL, The Undertaker, Tajiri, Ric Flair, Kane, Goldberg, Cactus Jack, The Sandman, Spike Dudley and Bubba Ray Dudley,Shawn Michaels, Triple H, Hulk Hogan, Andre the Giant, Eddie Guerrero, Razor Ramon, Batista, Kane, Macho Man Randy Savage, Ric Flair, Bret Hart, Goldberg, The Undertaker, Rob Van Dam, Brock Lesnar, John Cena, Kevin Nash, Jeff Jarrett, Scott Hall, Kurt Angle, Chris Benoit, Chris Jericho, Edge, Stone Cold Steve Austin, Cactus Jack, Randy Orton, Mr Perfect, Crash Holly, The Hardy Boyz, Sting, Ken Shamrock, Shane McMahon, Rey Mysterio and Tazz, Stone Cold Steve Austin, Mick Foley, Ric Flair, Eddie Guerrero, Bret Hart, Sgt Slaughter, The Undertaker, Hulk Hogan, The Ultimate Warrior, Kane, Mankind, the nWo, Scott Hall, Kevin Nash, Mr Perfect, Shawn Michaels, Cactus Jack, Andre The Giant, Demolition, The Legion of Doom, Diamond Dallas Page, Razor Ramon, Chris Benoit, Kurt Angle, Triple H, Sting and The Rock\nY2J Chris Jericho TNA Wrestling John Morrison, Chavo, The Rock,The Undertaker,Kurt Angle,nWo,The Miz cashed in Money in the Bank Brifecase\nJohn Cena joins the Nexus, Heel turn\nBragging Rights 2010 ( Official Results )\nWorld Heavyweight Champion Kane def. The Undertaker in a Buried Alive Match\nWade Barrett (with John Cena) def. WWE Champion Randy Orton by Disqualification\nTeam SmackDown def. Team Raw in a 7-on-7 Tag Team Elimination Match\nU.S. Champion Daniel Bryan def. Intercontinental Champion Dolph Ziggler in a Non-Title Match\nJohn Cena & David Otunga def. WWE Tag Team Champions "Dashing" Cody Rhodes & Drew McIntyre\nSelf-professed "Co-Divas Champion" Layla def. Natalya\nTed DiBiase def. Goldust\nBret Hart Vs Shawn Michaels Survivor Series 1997 *Montreal Screwjob*\nThe Rock Return 2010 Wrestling Torrents Smackdown vs Raw 2007-2008-2009-2010\nTNA Impact Jeff Hardy Rob Van Dam RVD Ric Flair Shannon Moore Mr Kennedy \nwrestlemania 29,26,27,28,25,24,23,22,21,20\nAnderson Hulk Hogan Return\nSmackdown ECW RAW January Royal Rumble 1988\nFebruary Elimination Chamber 2010\nMarch/April WrestleMania 1985\nApril Extreme Rules 2005 ECW One Night Stand (2005-2006),\nWWE One Night Stand (2007-2008)\nMay Over the Limit 2010\nJune Fatal Four Way 2010\nJuly Money in the Bank 2010\nAugust SummerSlam credits to KiLLuMiNaTiiX 1988\nSeptember Night of Champions 2001 Vengeance (2001-2006),\nVengeance: Night of Champions (20012)\nHell in a Cell 20012\nBragging Rights 2009\nNovember TBA TBA\nDecember TLC: Tables, Ladders & Chairs 2009\nChris Jericho Return 2011 summerslam\nmoney in the bank\ncena vs punk promo\nrandy orton WWE freestyle tribute', 'http://i1.ytimg.com/vi/aH5wz_gi76Q/mqdefault.jpg', 'youtube', '2013-02-27 10:23:19', '2', 0, 0, 2),
	(46, 85, 'Greeku Veerudu Official Traile', 'http://www.youtube.com/watch?v=cEPbouuFrnE', 'cEPbouuFrnE', 'Cast : King Nagarjuna, Nayantara, Meera Chopra, Brahmanandam, MS Narayana, K Viswanath, Raghubabu, Kasi Viswanth, Kota Srinivasa Rao, Bharath Reddy, Sudha, Geetanjali, Asish Vidyarthi, Nagineedu, Vennela Kishore, Tagubothu Ramesh\n\n\nStory-Screenplay-Direction : Dasarath\nProducer : D.Siva Prasad Reddy\nMusic : SS Thaman\nCinematography :Anil Bhandari\nDialogues :Dasarath\nEditing :Marthad K Venkatesh\nArt :S Ravinder\nStunts :Vijay\n\n\nFor more updates login - http://www.kamakshimovies.com', 'http://i1.ytimg.com/vi/cEPbouuFrnE/mqdefault.jpg', 'youtube', '2013-02-27 10:25:30', '2', 0, 0, 2),
	(47, 85, 'Greeku Veerudu Official Traile', 'http://www.youtube.com/watch?v=cEPbouuFrnE', 'cEPbouuFrnE', 'Cast : King Nagarjuna, Nayantara, Meera Chopra, Brahmanandam, MS Narayana, K Viswanath, Raghubabu, Kasi Viswanth, Kota Srinivasa Rao, Bharath Reddy, Sudha, Geetanjali, Asish Vidyarthi, Nagineedu, Vennela Kishore, Tagubothu Ramesh\n\n\nStory-Screenplay-Direction : Dasarath\nProducer : D.Siva Prasad Reddy\nMusic : SS Thaman\nCinematography :Anil Bhandari\nDialogues :Dasarath\nEditing :Marthad K Venkatesh\nArt :S Ravinder\nStunts :Vijay\n\n\nFor more updates login - http://www.kamakshimovies.com', 'http://i1.ytimg.com/vi/cEPbouuFrnE/mqdefault.jpg', 'youtube', '2013-02-27 10:32:01', '2', 0, 0, 1),
	(48, 85, 'Greeku Veerudu Official Traile', 'http://www.youtube.com/watch?v=cEPbouuFrnE', 'cEPbouuFrnE', 'Cast : King Nagarjuna, Nayantara, Meera Chopra, Brahmanandam, MS Narayana, K Viswanath, Raghubabu, Kasi Viswanth, Kota Srinivasa Rao, Bharath Reddy, Sudha, Geetanjali, Asish Vidyarthi, Nagineedu, Vennela Kishore, Tagubothu Ramesh\n\n\nStory-Screenplay-Direction : Dasarath\nProducer : D.Siva Prasad Reddy\nMusic : SS Thaman\nCinematography :Anil Bhandari\nDialogues :Dasarath\nEditing :Marthad K Venkatesh\nArt :S Ravinder\nStunts :Vijay\n\n\nFor more updates login - http://www.kamakshimovies.com', 'http://i1.ytimg.com/vi/cEPbouuFrnE/mqdefault.jpg', 'youtube', '2013-02-27 10:37:48', '2', 0, 0, 2),
	(82, 69, 'Mark Zuckerberg gets hot under', 'http://www.youtube.com/watch?v=o3hu3iG8B2g', 'o3hu3iG8B2g', 'Zuckerberg rambles on during video excerpts from the interview, watch the young CEO collapse under intense questioning and sweat over your privacy issues ?\n\nDon t forget about your Mobile Phone Facebook, which will Log All Your Personal Phone Calls, SMS Messages, Phone Book, GPS Locations, Who you Spoke to and for how long you spoke to them for to also be RECORDED FOREVER.', 'http://i1.ytimg.com/vi/o3hu3iG8B2g/mqdefault.jpg', 'youtube', '2013-03-04 12:13:49', '2', 0, 0, 3),
	(83, 69, 'David Blaine - Best trick ever', 'http://www.youtube.com/watch?v=cb4Dd9itgzo', 'cb4Dd9itgzo', 'http://www.youtube.com/watch?v=vPZjkeKX6OM', 'http://i1.ytimg.com/vi/cb4Dd9itgzo/mqdefault.jpg', 'youtube', '2013-03-04 12:19:46', '2', 0, 0, 12),
	(84, 69, 'Steve Jobs Funniest Joke. Even', 'http://www.youtube.com/watch?v=Qv1pvRDFFqs', 'Qv1pvRDFFqs', 'Steve Jobs funniest joke was said at the D5 conference.  Apple is like a ship with a hole in the bottom, leaking water and my job is to get the ship pointed in the right direction . The joke is in reference to Gil Amelio, the previous CEO of Apple.', 'http://i1.ytimg.com/vi/Qv1pvRDFFqs/mqdefault.jpg', 'youtube', '2013-03-04 12:23:46', '2', 0, 0, 0),
	(85, 69, '"Who Wants to be a Millionaire', 'http://www.youtube.com/watch?v=nRsaExGcx5A', 'nRsaExGcx5A', '"Finger on Uranus"', 'http://i1.ytimg.com/vi/nRsaExGcx5A/mqdefault.jpg', 'youtube', '2013-03-04 12:26:51', '0', 0, 0, 0),
	(89, 23, 'Steven Wilson - The Raven that', 'http://vimeo.com/59053482', '59053482', 'The Raven That Refused To Sing (and other stories) will be released on 25th February 2013, for more info visit http://www.kscopemusic.com/stevenwilson or http://www.stevenwilsonhq.com<br />\r\n<br />\r\nFor more info on Steven Wilson s albums on Kscope, visit: http://www.kscopemusic.com/stevenwilson<br />\r\nFor Steven Wilson videos: https://vimeo.com/channels/stevenwilson<br />\r\n<br />\r\nPromo video for The Raven that Refused to Sing, from The Raven that Refused to Sing (and other stories), the new album by Steven Wilson, to be released on Kscope on 25th February. <br />\r\n<br />\r\nDirected by Jessica Cope & Simon Cartwright<br />\r\nProduced by John Cope & Tom Kaye<br />\r\nAnimated by Jessica Cope<br />\r\nEditing and special effects - Topher Holland<br />\r\nAdditional animation - Simon Cartwright & William Powell<br />\r\nStoryboard - Simon Cartwright<br />\r\nPuppets & sets - Jessica Cope<br />\r\nAdditional artwork & puppets - Simon Cartwright, Beth Jupe, Paul Davies, Alison Cross, Louise Smurthwaite<br />\r\nBased on a story by Steven Wilson & Hajo MÃ¼ller<br />\r\nSpecial thanks to - Mackinnon & Saunders, Steven Wilson, Hajo MÃ¼ller<br />\r\n<br />\r\n<br />\r\nThe album was written between January-July and recorded in Los Angeles in September with Steven s current band line up of Guthrie Govan - lead guitar, Nick Beggs - bass guitar, Marco Minnemann - drums, Adam Holzman - keyboards, Theo Travis - saxophone / flute, and engineered by legendary producer/engineer Alan Parsons. The 6 tracks on the album are all based on stories of the supernatural, and the deluxe 4 disc edition comes in the form of a 128 page hardback book containing lyrics and ghost stories illustrated by Hajo Mueller. In addition to the deluxe edition there will be regular CD, CD/DVDV media book, Blu-Ray and 2LP vinyl editions, with the DVDV and Blu-ray editions featuring a 5.1 mix of the album and other bonus material.<br />\r\n<br />\r\nPre-order date for the limited deluxe edition will be announced soon. The tour to promote the album starts on 1st March in Europe, and will continue throughout the rest of the year visiting many other countries, see confirmed dates on Steven s website.<br />\r\n<br />\r\nTrack listing: <br />\r\n1. Luminol (12.10)<br />\r\n2. Drive Home (7.37)<br />\r\n3. The Holy Drinker (10.13)<br />\r\n4. The Pin Drop (5.03)<br />\r\n5. The Watchmaker (11.43)<br />\r\n6. The Raven that Refused to Sing (7.57)<br />\r\n<br />\r\nOrder your copy from the Kscope store: https://www.burningshed.com/store/kscope/<br />\r\n<br />\r\nSteven and his band hit the road touring in support of the new record from March 1, kicking off in the UK and moving into Europe. The tour will continue throughout the rest of 2013, visiting many other countries for which the dates are yet to be revealed. Shows are currently announced in the UK, Germany, Italy, France, Switzerland, Norway, Denmark, Sweden, Belgium, and the Netherlands.<br />\r\n<br />\r\n01/03/13 -- Manchester Academy 2 <br />\r\n02/03/13 -- Glasgow ABC <br />\r\n04/03/13 -- London Royal Festival Hall <br />\r\n08/03/13 -- Paris Le Trianon <br />\r\n10/03/13 -- Cologne Live Music Hall <br />\r\n11/03/13 -- Amsterdam Rabizaal <br />\r\n12/03/13 -- Antwerp Arenbergshouwburg <br />\r\n14/03/13 -- Hamburg CCH (Saal 2) <br />\r\n16/03/13 -- Stockholm Filadelfiakyrkan <br />\r\n18/03/13 -- Oslo Sentrum Scene <br />\r\n19/03/13 -- Copenhagen VEGA (main hall) <br />\r\n21/03/13 -- Berlin Huxley s <br />\r\n22/03/13 -- Essen Colosseum <br />\r\n23/03/13 -- Frankfurt Hugenotthalle <br />\r\n25/03/13 -- Stuttgart Theatrehaus <br />\r\n26/03/13 -- Munich Alte Kongresshalle <br />\r\n27/03/13 -- Zurich Volkhaus <br />\r\n28/03/13 -- Milan Teatro Della Luna<br />\r\n16/04/13 -- Tampa, Florida - The State Theater <br />\r\n17/04/13 -- Atlanta, Georgia - The Variety Playhouse <br />\r\n19/04/13 -- Glenside, Philadelphia - Keswick Theatre <br />\r\n20/04/13 -- Washington, Washington D.C. - Howard Theatre <br />\r\n21/04/13 -- Buffalo, New York - Town Ballroom <br />\r\n23/04/13 -- Toronto, Ontario - Phoenix Concert Theatre <br />\r\n25/04/13 -- Montreal, Quebec - Club-Soda <br />\r\n26/04/13 -- New York City, New York - Best Buy Theater <br />\r\n27/04/13 -- Boston, Massachusetts - Berklee Performance Center <br />\r\n28/04/13 -- New York, Albany, Upstate Concert Hall *with OPETH and KATATONIA<br />\r\n30/04/13 -- Pittsburgh, Philadelphia - Mr Small s <br />\r\n02/05/13 -- Cleveland, Ohio - House of Blues Cleveland <br />\r\n03/05/13 -- Chicago, Illinois - Park West <br />\r\n04/05/13 -- Minneapolis, Minnesota - The Fine Line <br />\r\n06/05/13 -- Boulder, Colorado ', 'http://b.vimeocdn.com/ts/410/203/410203139_200.jpg', 'vimeo', '2013-03-04 14:53:20', '0', 1, 0, 19),
	(90, 23, 'Pepsi Oh Yes Abhi Cricket TV C', 'http://www.youtube.com/watch?v=QuXuxc3AlYo', 'QuXuxc3AlYo', 'As Unmukt tries to grab a Pepsi from the seniors  locker room, he is confronted by Dhoni, Raina and Kohli. See what happens next in the turn of events.', 'http://i1.ytimg.com/vi/QuXuxc3AlYo/mqdefault.jpg', 'youtube', '2013-03-04 14:54:34', '2', 0, 1, 1),
	(91, 23, 'Basanti gets her BadTameez Dan', 'http://www.youtube.com/watch?v=55E2ZzWJSf8', '55E2ZzWJSf8', 'Ab Basanti naachegi.... Umpires ke saamne.... Bowlers ke saamne.... T20 ke saamne....\n\nCreate your own BadTameez Dancer and keep track of live scores for the ICC World T20 at http://dancer.pepsichangethegame.com', 'http://i1.ytimg.com/vi/55E2ZzWJSf8/mqdefault.jpg', 'youtube', '2013-03-04 15:04:12', '2', 0, 0, 2),
	(92, 23, 'THIS IS MY COURT', 'http://vimeo.com/60576409', '60576409', 'An ode to streetball culture, narrated by Michael Kenneth Williams (of Omar/Chalky White infamy).<br />\r\n<br />\r\nCONCEPT / DIRECTOR:  TWiN (Jonathan & Josh Baker)<br />\r\nWRITER:  Elizabeth Nolan<br />\r\nPRODUCER:  Gillian Marr<br />\r\nDP:  Nicolas Karakatsanis<br />\r\nPROD DESIGNER:  Pete Zumba<br />\r\nEDITOR:  Ben Suenaga<br />\r\nSOUND DESIGN:  Joseph Fraioli @ Jafbox Sound<br />\r\nMUSIC:  Big Noble (Daniel Kessler & Joseph Fraioli)<br />\r\nCOLORIST:  Tom Poole @ Co3<br />\r\nNARRATOR:  Michael K. Williams<br />\r\n<br />\r\nSpecial thanks to Rabbit.', 'http://b.vimeocdn.com/ts/421/436/421436574_200.jpg', 'vimeo', '2013-03-04 15:09:52', '0', 0, 0, 1),
	(100, 22, 'Rouge By Carte Noire - Michael', 'http://vimeo.com/58987388', '58987388', 'Directors: Michael & Philippe', 'http://b.vimeocdn.com/ts/409/702/409702172_200.jpg', 'vimeo', '2013-03-05 11:24:57', '2', 0, 0, 2),
	(103, 22, 'Any Body Can Dance (ABCD) - Sa', 'http://www.youtube.com/watch?v=yVHviEAZ1xg', 'yVHviEAZ1xg', 'Sadda Dil Vi Tu (Ga Ga Ga Ganpati) - Official New HD Full Song Video from India s first 3D Dance Film, ABCD - Any Body Can Dance.\n\nSong : Sadda Dil Vi Tu (Ga Ga Ga Ganpati)\nSingers : Hard Kaur\nComposer : Sachin Jigar\nLyricist : Mayur Puri\nCast : Prabhu Deva, Ganesh Acharya, Salman Yusuff Khan, Dharmesh Yelande, Noorin Sha, Lauren Gottlieb\nDirected By : Remo D Souza\nProduced by : UTV Spotboy\n\n\nTo know more about ABCD - Any Body Can Dance:\nLike us: https://www.facebook.com/SonyMusicIndia \nFollow us: https://www.twitter.com/india_sonymusic\n\nAirtel & Idea users Dial 543213555 to listen to full tracks\n\nFor more Exclusive Song Video subscribe to our channel http://www.youtube.com/SonyMusicIndiaSME', 'http://i1.ytimg.com/vi/yVHviEAZ1xg/mqdefault.jpg', 'youtube', '2013-03-05 12:26:50', '2', 0, 0, 2),
	(134, 74, 'Iron Man 3 Teaser Trailer UK -', 'http://www.youtube.com/watch?v=5EjG-1U3wqA', '5EjG-1U3wqA', 'Watch the official Iron Man 3 trailer. Marvel s Iron Man 3 - coming to UK cinemas April 26th 2013, starring Robert Downey Jr.<br/><br/>In Marvel s "Iron Man 3", brash-but-brilliant industrialist Tony Stark/Iron Man played by Robert Downey Jr., is pitted against an enemy whose reach knows no bounds. When Stark finds his personal world destroyed at his enemy s hands, he embarks on a harrowing quest to find those responsible. This journey, at every turn, will test his mettle. With his back against the wall, Stark is left to survive by his own devices, relying on his ingenuity and instincts to protect those closest to him. As he fights his way back, Stark discovers the answer to the question that has secretly haunted him: does the man make the suit or does the suit make the man?<br/> <br/>Iron Man 3 continues the epic adventures of "Iron Man" and "Iron Man 2", starring Robert Downey Jr., Gwyneth Paltrow, Don Cheadle, Guy Pearce, Rebecca Hall, Stephanie Szostak, James Badge Dale with Jon Favreau and Ben Kingsley, "Iron Man 3" is directed by Shane Black from a screenplay by Drew Pearce and Shane Black and is based on Marvel s iconic Super Hero Iron Man, who first appeared on the pages of "Tales of Suspense" (#39) in 1963 and had his solo comic book debut with "The Invincible Iron Man" (#1) in May of 1968. "Iron Man 3" arrives in UK cinemas on April 26th 2013.', 'http://i1.ytimg.com/vi/5EjG-1U3wqA/mqdefault.jpg', 'youtube', '2013-03-06 12:57:14', '2', 0, 0, 16),
	(135, 74, 'Jet Li VS Wu Shu Master', 'http://www.youtube.com/watch?v=QLL9plgz0pg', 'QLL9plgz0pg', 'Click here the Last Fight Scene http://www.youtube.com/watch?v=9T_UL6GlsnE<br/><br/>Over the next few days, word of Chen s victory against Akutagawa spreads and Chen becomes a local celebrity in Shanghai. Jingwu s students begin to look up to Chen as their new instructor and that incurs the jealousy of Huo Ting en. <br/><br/>Ting en and the senior Jingwu members demand that Chen either leaves Mitsuko or the school, and Huo uses the opportunity to settle his personal vendetta against Chen, by challenging Chen to a fight. Chen defeats Huo eventually, with much reluctance and leaves with Mitsuko.<br/><br/>Huo Ting en is humiliated by his defeat and gives up his position as master of Jingwu before leaving to join his prostitute lover. Jingwu s members eventually discover Huo Ting en s relationship with the prostitute and reprimand him. Huo learns his lesson and returns to Jingwu.', 'http://i1.ytimg.com/vi/QLL9plgz0pg/mqdefault.jpg', 'youtube', '2013-03-06 13:00:25', '2', 0, 0, 13),
	(141, 74, 'Motivational Video', 'http://www.youtube.com/watch?v=e-mewxxGUVM', 'e-mewxxGUVM', 'businessdreamweaver.com', 'http://i1.ytimg.com/vi/e-mewxxGUVM/mqdefault.jpg', 'youtube', '2013-03-06 15:11:13', '0', 0, 0, 2),
	(142, 74, 'Motivational Video', 'http://www.youtube.com/watch?v=e-mewxxGUVM', 'e-mewxxGUVM', 'businessdreamweaver.com', 'http://i1.ytimg.com/vi/e-mewxxGUVM/mqdefault.jpg', 'youtube', '2013-03-06 15:12:46', '2', 0, 0, 1),
	(143, 74, 'Iron Man 3 report from San Die', 'http://www.youtube.com/watch?v=TJdx1nUO7Z4', 'TJdx1nUO7Z4', 'Iron Man 3 video report from San Diego Comic-Con 2012 - including the Iron Man 3 panel with actors Robert Downey Jr., Don Cheadle and Jon Favreau as well as director Shane Black and producer Kevin Feige. Iron Man 3 is scheduled for UK release May 2013.<br/><br/>"Iron Man 3" continues the epic, big-screen adventures of the world s favorite billionaire inventor/Super Hero, Tony Stark aka "Iron Man."  Marvel Studios  President Kevin Feige is producing the film.  Executive producers on the project include Jon Favreau, Louis D Esposito, Alan Fine, Stan Lee, Charles Newirth, Victoria Alonso, Stephen Broussard and Dan Mintz.<br/><br/>Based on the ever-popular Marvel comic book series, first published in 1963, "Iron Man 3" returns Robert Downey Jr. ("Iron Man," "Marvel s The Avengers") as the iconic Super Hero character Tony Stark/Iron Man along with Gwyneth Paltrow ("Iron Man," "Iron Man 2,") as Pepper Potts, Don Cheadle ("Iron Man 2") as James "Rhodey" Rhodes and Jon Favreau ("Iron Man," "Iron Man 2") as Happy Hogan. Iron Man 3 is scheduled for UK release May 2013.', 'http://i1.ytimg.com/vi/TJdx1nUO7Z4/mqdefault.jpg', 'youtube', '2013-03-06 15:13:30', '0', 0, 0, 9),
	(152, 22, 'Rouge By Carte Noire - Michael', 'http://vimeo.com/58987388', '58987388', 'Directors: Michael & Philippe', 'http://b.vimeocdn.com/ts/409/702/409702172_200.jpg', 'vimeo', '2013-03-06 18:42:42', '2', 0, 0, 0),
	(171, 22, 'Sorry Sorry - Any Body Can Dan', 'http://www.youtube.com/watch?feature=player_embedded', '4ttoq1nqxUE', 'Sorry Sorry - Official New HD Full Song Video from India\'s first 3D Dance Film, ABCD - Any Body Can Dance.<br/><br/>Song : Sorry Sorry<br/>Singers : Jigar Saraiya<br/>Composer : Sachin Jigar<br/>Lyricist : Mayur Puri<br/>Cast : Prabhu Deva, Ganesh Acharya, Salman Yusuff Khan, Dharmesh Yelande, Noorin Sha, Lauren Gottlieb<br/>Directed By : Remo D\'Souza<br/>Produced by : UTV Spotboy<br/><br/><br/>To know more about ABCD - Any Body Can Dance:<br/>Like us: https://www.facebook.com/SonyMusicIndia <br/>Follow us: https://www.twitter.com/india_sonymusic<br/><br/>Airtel ', 'http://i1.ytimg.com/vi/4ttoq1nqxUE/mqdefault.jpg', 'youtube', '2013-03-08 15:35:37', '0', 0, 0, 78),
	(172, 24, 'The Metalsmith', 'http://vimeo.com/63070434', '63070434', 'Facing blindness, metalsmith Andy Cooperman renews his commitment to making things worth seeing.<br />\r\n<br />\r\nView Andy s work at http://www.andycooperman.com<br />\r\nMusic: Reflux by In The Nursery (licensed via Vimeo)<br />\r\nProduced by Visual Contact http://www.visualcontact.com<br />\r\n<br />\r\nBTS info about how this video was lit: http://www.danmccomb.com/posts/2800/the-metalsmith/', 'http://b.vimeocdn.com/ts/433/322/433322418_200.jpg', 'vimeo', '2013-04-10 11:32:09', '0', 0, 0, 4),
	(173, 24, 'Real Ones - Separation Blues', 'http://vimeo.com/63649144', '63649144', 'Official music video for "Separation Blues" by Real Ones.<br />\r\n<br />\r\nDirector: AndrÃ© Chocron <br />\r\nProducer: Andrea Berentsen Ottmar<br />\r\n<br />\r\n// FROKOST FILM<br />\r\n<br />\r\nCinematographer: Audun Gjelsvik MagnÃ¦s<br />\r\nProduction designer: Ragnhild Juliane Sletta<br />\r\nGaffer / first assistant camera: Stian Thilert<br />\r\nDIT: Lasse Selvli<br />\r\nMake up artist: Rita DalsbÃ¸<br />\r\nActors: David Chelsom Vogt & Linn Greni<br />\r\nAssistants: Ida Rydeng, Iver Innset, Marte Ã˜slebÃ¸ Knutsen, Ingvild Stray, Elisabeth Skatvedt, Mari EllefsÃ¦ter.<br />\r\nColorist: Camilla Holst Vea / Storyline Studios<br />\r\n<br />\r\nThanks to: Runar Eggesvik, Kristin Kausland, Mari Boine, Ellen Ottmar, David Chocron, (Stemor), Trykk24, Dagslys, Storyline, Motion Blur.<br />\r\n<br />\r\nIf you enjoyed this film and want to see more stuff like it in the future, please consider leaving a small tip in the jar! Every small contribution will help fund our future projects.<br />\r\n<br />\r\nhttp://realones.no<br />\r\nhttp://frokostfilm.no<br />\r\nhttp://andrechocron.no', 'http://b.vimeocdn.com/ts/433/997/433997390_200.jpg', 'vimeo', '2013-04-10 11:55:33', '0', 0, 0, 11),
	(174, 24, 'Secrets From The Potato Chip F', 'https://vimeo.com/62709769', '62709769', 'Americans spend less money on groceries than we did a few decades ago. That s partly because of new machines and technology that have made it much cheaper to produce food.<br />\r\n<br />\r\nWe went to Herr s potato chip factory to see some of this food-making technology in action. <br />\r\n<br />\r\nSee explanatory animated GIFs on our blog: http://n.pr/14Q7Ws2', 'http://b.vimeocdn.com/ts/433/544/433544989_200.jpg', 'vimeo', '2013-04-10 12:00:43', '0', 0, 0, 4),
	(175, 24, 'Secrets From The Potato Chip F', 'https://vimeo.com/62709769', '62709769', 'Americans spend less money on groceries than we did a few decades ago. That s partly because of new machines and technology that have made it much cheaper to produce food.<br />\r\n<br />\r\nWe went to Herr s potato chip factory to see some of this food-making technology in action. <br />\r\n<br />\r\nSee explanatory animated GIFs on our blog: http://n.pr/14Q7Ws2', 'http://b.vimeocdn.com/ts/433/544/433544989_200.jpg', 'vimeo', '2013-04-10 12:03:04', '0', 0, 0, 2),
	(176, 24, 'Bitcoin Explained', 'https://vimeo.com/63502573', '63502573', 'A short video looking at  Bitcoin , a decentralized digital currency.<br />\r\n<br />\r\nDirected, Designed and Animated by Duncan Elms - www.duncanelms.com<br />\r\n<br />\r\nWritten and Voiced by Marc Fennell - www.marcfennell.com<br />\r\n<br />\r\nThis is a personal project done between other jobs. Therefore some of the stats are not up to date. For more info please see http://en.wikipedia.org/wiki/Bitcoin<br />\r\n<br />\r\nIf you would like to make a Bitcoin donation for the video, please do so to 1P9wrpA2UQ2GEmMpt81Ch3Wt4poq5LhpiW', 'http://b.vimeocdn.com/ts/433/873/433873663_200.jpg', 'vimeo', '2013-04-10 12:05:00', '0', 0, 0, 6),
	(177, 24, 'Parker Trailer (2013)', 'http://www.youtube.com/watch?v=KgYaiLcByRo', 'KgYaiLcByRo', 'Parker Movie Trailer, starring Jason Statham, Jennifer Lopez ', 'http://i1.ytimg.com/vi/KgYaiLcByRo/mqdefault.jpg', 'youtube', '2013-04-10 12:33:09', '0', 0, 0, 11),
	(178, 24, 'Iddarammayilatho Official Firs', 'http://www.youtube.com/watch?v=M-xx80pSfy8', 'M-xx80pSfy8', 'My Official Website :http://www.purijagan.com<br/>Follow me on twitter at https://twitter.com/purijagan<br/>Follow me on facebook at https://www.facebook.com/Purijagannadh<br/><br/>Puri Jagannadh ( Badri, Itlu Sravani Subramanyam, Idiot, Amma Nanna O Tamila Ammayi, Shivamani, Desamuduru, Pokiri, Chirutha ,Bbuddah Hoga Tera Baap,Business Man,Cameraman Ganga Tho Rambabu,neninthe,Bujjigadu,Ek Niranjan,Super, Iddarammayilatho ,Tapori )<br/><br/><br/>Directed : Puri Jagannadh<br/>Produced : Bandla Ganesh<br/>Written : Puri Jagannadh<br/>Screenplay : Puri Jagannadh<br/>Starring : Allu Arjun,Amala Paul,Catherine Tresa<br/>Music : Devi Sri Prasad<br/>Studio : Parameswara Arts<br/>Release : May 10, 2013<br/>Country : India<br/>Language : Telugu<br/><br/>Iddarammayilatho (Telugu : à°‡à°¦à±à°¦à°°à°®à±à°®à°¾à°¯à°¿à°²à°¤à±‹ ) is an upcoming Telugu Film directed by Puri Jagannadh starring Allu Arjun, Amala Paul and Catherine Tresa in the lead roles. Bandla Ganesh is producing this film under the banner Parameswara Arts.<br/><br/>Watch upcoming Telugu movie Iddarammayilatho theatrical trailer / Iddarammayilatho song trailer / Iddarammayilatho song trailers/ Iddarammayilatho songs trailer / Iddarammayilatho video songs trailer / Iddarammayilatho trailer / Iddarammayilatho teaser / Iddarammayilatho press meet / iddaru ammayilatho trailer / iddaru ammayilatho teaser / iddaru ammayilatho press meet, starring Stylish Star Allu Arjun ( Yevadu, Julayi, Vedam, Badrinath, Varudu, Aarya 2, Parugu, Desamuduru, Bunny, Happy, Aarya, Gangotri etc ) Amala Paul ( Naayak, Janda Pai Kapiraju, Love Failure, Bejawada, Deiva Thirumagal, Mynaa) in lead roles and Catherine Tresa ( Paisa, Chammak challo, Iddarammayilatho ). Directed by Puri Jagannadh (Cameraman Ganga Tho Rambabu, Devudu Chesina Manushulu, Businessman, Nenu Naa Rakshasi, Golimaar, Pokiri, Chirutha, Ek Niranjan, Badri, Bujjigadu, Idiot, etc.) and music composed by Devi Sri Prasad (Damarukam, Julayi, Gabbar Singh, Oosaravelli, Dhada, 100% Love, Mr. Perfect, Namo Venkatesa, Adurs, Arya 2, Mallana, King, Jalsa, Bommarillu, Shankar Dada MBBS, Manmadhudu etc). Produced by Bandla Ganesh (Gabbar Singh, Teen Maar, Anjaneyulu).<br/>The muhurat was attended by Rana Daggubati (Ongaram, Department, Naa Ishtam, Nenu Naa Rakshasi, Dum Maaro Dum and Leader), Srinu Vaitla (Baadshah, Dookudu, Namo Vekatesa, Ready, Dubai Seenu, Venky, Dhee, Anandam, Andarivadu etc ) Nagendra Babu and others.', 'http://i1.ytimg.com/vi/M-xx80pSfy8/mqdefault.jpg', 'youtube', '2013-04-10 12:46:30', '0', 0, 0, 2),
	(179, 24, 'Jet Li - The Sorcerer and the ', 'http://www.youtube.com/watch?v=hPovrwqaErs', 'hPovrwqaErs', 'A Spectacular Trailer for The Sorcerer and the White Snake movie starring Jet Li. Available on Itunes January 3rd, 2013 and in Theatres February 8th. Join here : http://www.facebook.com/SorcererAndTheWhiteSnake<br/><br/>Action director Ching Siu-Tung helms this fantasy film based on an old Chinese legend about an herbalist who falls in love with a thousand-year-old White Snake disguised as a woman. Jet Li stars as a sorcerer who discovers her true identity and battles to save the man\'s soul.<br/><br/>The Sorcerer and the White Snake Trailer (Jet Li - 2013). Subscribe now to get the best and the latest movie trailers, clips and videos !', 'http://i1.ytimg.com/vi/hPovrwqaErs/mqdefault.jpg', 'youtube', '2013-04-10 12:59:31', '0', 0, 0, 0),
	(180, 24, 'Jamie N Commons - Lead Me Home', 'https://vimeo.com/63115838', '63115838', 'Director/Editor: Jordan Bahat<br />\r\nProducer: Taylor Vandegrift<br />\r\nCinematographer: Andrew Wheeler<br />\r\nArt Direction: Tyler Jensen<br />\r\nColor: Paul Byrne @ Coyote Post<br />\r\nCommissioner: Michelle An<br />\r\nLabel: Interscope / KIDinaKORNER', 'http://b.vimeocdn.com/ts/433/255/433255466_200.jpg', 'vimeo', '2013-04-10 13:47:40', '0', 0, 0, 2),
	(181, 24, 'Ricky Ponting catch in IPL 201', 'http://www.youtube.com/watch?v=cFDpQn55BdY', 'cFDpQn55BdY', 'Ricky Ponting\'s acrobatic catch in IPL 2013. This flying old man is sure competition for sir Jadeja.', 'http://i1.ytimg.com/vi/cFDpQn55BdY/mqdefault.jpg', 'youtube', '2013-04-11 15:37:13', '0', 0, 0, 5),
	(182, 24, 'Vodafone Zoozoos 2013 - Get Ce', 'http://www.youtube.com/watch?v=FlNjvyrQpvo', 'FlNjvyrQpvo', 'Psst... watch our new TVC to see how Vodafone Internet brings all the latest gossip from Bollywood straight to your phone. Enjoy it on the move, anytime. anywhere', 'http://i1.ytimg.com/vi/FlNjvyrQpvo/mqdefault.jpg', 'youtube', '2013-04-11 15:40:34', '0', 0, 0, 0),
	(183, 24, 'THE FREE STORE (where everythi', 'http://www.youtube.com/watch?v=Mtg9xYtUlh0', 'Mtg9xYtUlh0', 'Welcome to THE FREE STORE, where EVERYTHING you see is for FREE! <br/><br/>Fevicol wanted to reinforce their position as India\'s most reliable glue so they conducted this activity in one of Mumbai\'s many malls. Mumbaikars of all shapes and sizes, young and old, tried to seize this opportunity and walk away with any of the beautiful wooden items on display...<br/><br/>But they all got a good laugh instead, as everything from the smallest spoon to the flowers in the vase, was glued down by Fevicol.<br/><br/>Agency: Ogilvy  Mather, Mumbai<br/>National Creative Director: Abhijit Avasthi<br/>Group Creative Director: Kainaz Karmakar, Harshad Rajadhyaksha<br/>Creative Team: Hazel Mehta, Ankita Gupta<br/>Account Management: Vivek Verma, Ramanathan Sridhar  Bindi Kanakia', 'http://i1.ytimg.com/vi/Mtg9xYtUlh0/mqdefault.jpg', 'youtube', '2013-04-11 15:43:57', '0', 0, 0, 0),
	(184, 24, '"Balam Pichkari" Song (Officia', 'http://www.youtube.com/watch?v=Hxy8BZGQ5Jo', 'Hxy8BZGQ5Jo', 'After doing some Badtameezi on dance floor, its time to get wet with "Balam Pichkari"  in voice of prolific singers Vishal Dadlani, Shalmali Kholgade from upcoming hindi movie Yeh Jawaani Hai Deewani directed by Ayan Mukerji.<br/><br/>Badtameez Dil Video â–º http://youtu.be/fVkRKY2PhTQ<br/><br/>Song: Balam Pichkari<br/>Music: Pritam Chakraborty<br/>Singer: Vishal Dadlani, Shalmali Kholgade <br/>Movie: Yeh Jawaani Hai Deewani (2013)<br/>Director: Ayan Mukerji<br/>Cast: Ranbir Kapoor, Deepika Padukone, Aditya Roy Kapoor, Kalki Koechlin<br/>Producer: Karan Johar<br/>Music on T-Series<br/>Release Date: May 31st 2013<br/><br/>Enjoy and stay connected with us!! <br/><br/>SUBSCRIBE T-Series channel for unlimited entertainment<br/>http://www.youtube.com/tseries<br/><br/>Circle us on G  <br/>http://www.google.com/ tseriesmusic<br/><br/>Like us on Facebook<br/>http://www.facebook.com/tseriesmusic<br/><br/>Follow us<br/>http://www.twitter.com/_Tseries', 'http://i1.ytimg.com/vi/Hxy8BZGQ5Jo/mqdefault.jpg', 'youtube', '2013-04-11 15:46:45', '0', 0, 0, 0),
	(185, 24, '"Balam Pichkari" Song (Officia', 'http://www.youtube.com/watch?v=Hxy8BZGQ5Jo', 'Hxy8BZGQ5Jo', 'After doing some Badtameezi on dance floor, its time to get wet with "Balam Pichkari"  in voice of prolific singers Vishal Dadlani, Shalmali Kholgade from upcoming hindi movie Yeh Jawaani Hai Deewani directed by Ayan Mukerji.<br/><br/>Badtameez Dil Video â–º http://youtu.be/fVkRKY2PhTQ<br/><br/>Song: Balam Pichkari<br/>Music: Pritam Chakraborty<br/>Singer: Vishal Dadlani, Shalmali Kholgade <br/>Movie: Yeh Jawaani Hai Deewani (2013)<br/>Director: Ayan Mukerji<br/>Cast: Ranbir Kapoor, Deepika Padukone, Aditya Roy Kapoor, Kalki Koechlin<br/>Producer: Karan Johar<br/>Music on T-Series<br/>Release Date: May 31st 2013<br/><br/>Enjoy and stay connected with us!! <br/><br/>SUBSCRIBE T-Series channel for unlimited entertainment<br/>http://www.youtube.com/tseries<br/><br/>Circle us on G  <br/>http://www.google.com/ tseriesmusic<br/><br/>Like us on Facebook<br/>http://www.facebook.com/tseriesmusic<br/><br/>Follow us<br/>http://www.twitter.com/_Tseries', 'http://i1.ytimg.com/vi/Hxy8BZGQ5Jo/mqdefault.jpg', 'youtube', '2013-04-11 15:47:08', '0', 0, 0, 0),
	(186, 24, 'ELYSIUM - Official Trailer - I', 'http://www.youtube.com/watch?v=oIBtePb-dGY', 'oIBtePb-dGY', 'Visit http://itsbetterupthere.com for more information', 'http://i1.ytimg.com/vi/oIBtePb-dGY/mqdefault.jpg', 'youtube', '2013-04-11 15:53:18', '0', 0, 0, 0),
	(187, 24, 'ELYSIUM - Official Trailer - I', 'http://www.youtube.com/watch?v=oIBtePb-dGY', 'oIBtePb-dGY', 'Visit http://itsbetterupthere.com for more information', 'http://i1.ytimg.com/vi/oIBtePb-dGY/mqdefault.jpg', 'youtube', '2013-04-11 15:56:10', '0', 0, 0, 0),
	(191, 24, 'Balam Pichkari - Yeh Jawaani H', 'http://www.youtube.com/watch?v=4hoiwi3tE6w', '4hoiwi3tE6w', 'Seedhi saadi Naina has also become Sharabi with Balam\'s Pichkari. Join Bunny, Naina, Avi  Aditi as they celebrate love with colors.<br/><br/>Here\'s presenting the new song from Yeh Jawaani Hai Deewani, BALAM PICHKARI.<br/><br/>Directed By: Ayan Mukerji<br/>Produced By: Dharma Productions<br/>Starring: Ranbir Kapoor, Deepika Padukone, Kalki Koechlin  Aditya Roy Kapur<br/><br/>Music By: Pritam Chakraborty<br/><br/>For more updates:<br/><br/>Like: https://facebook.com/YehJawaaniHaiDeewani<br/>Follow: https://twitter.com/YJHDofficial', 'http://i1.ytimg.com/vi/4hoiwi3tE6w/mqdefault.jpg', 'youtube', '2013-04-11 16:06:33', '0', 0, 0, 0),
	(192, 24, '"Badtameez Dil" Yeh Jawaani Ha', 'http://www.youtube.com/watch?v=fVkRKY2PhTQ', 'fVkRKY2PhTQ', 'Buy from iTunes : https://itunes.apple.com/in/album/badtameez-dil-from-yeh-jawani/id633431797?ls=1<br/><br/>Here\'s bringing to you "Badtameez Dil" song from Ranbir Kapoor, Deepika Padukone most anticipated movie of 2013 "Yeh Jawaani Hai Deewani" directed by Ayan Mukherji. The music is composed by Pritam Chakraborty.<br/><br/>Song: Badtameez Dil <br/>Singer: Benny Dayal<br/>Music Director: Pritam Chakraborty<br/>Lyricist: Amitabh Bhattacharya<br/>Movie: Yeh Jawaani Hai Deewani (2013)<br/>Director: Ayan Mukerji<br/>Cast: Ranbir Kapoor, Deepika Padukone, Aditya Roy Kapoor, Kalki Koechlin<br/>Producer: Karan Johar<br/>Release Date: May 31st 2013<br/><br/>Enjoy and stay connected with us!! <br/><br/>SUBSCRIBE T-Series channel for unlimited entertainment<br/>http://www.youtube.com/tseries<br/><br/>Circle us on G  <br/>http://www.google.com/ tseriesmusic<br/><br/>Like us on Facebook<br/>http://www.facebook.com/tseriesmusic<br/><br/>Follow us<br/>http://www.twitter.com/_Tseries', 'http://i1.ytimg.com/vi/fVkRKY2PhTQ/mqdefault.jpg', 'youtube', '2013-04-11 17:32:28', '0', 0, 0, 0),
	(193, 24, 'Tum Hi Ho Song Aashiqui 2 | Mu', 'http://www.youtube.com/watch?v=NUo8CKI34o4', 'NUo8CKI34o4', 'Watch the first video song "Tumhi Ho" of "Aashiqui 2", a movie produced by T-Series Films  Vishesh Films. The movie is a musical journey of two lovers who go through love and hate, twists and turbulence, success and failure in their lives. The music of this movie is composed by Mithoon, Jeet Ganguli and Ankit Tiwari. <br/><br/>Movie Releasing APRIL 26, 2013<br/><br/>Buy from iTunes - https://itunes.apple.com/in/album/aashiqui-2-original-motion/id630590910?ls=1<br/><br/>Song: Tum Hi Ho<br/>Movie: Aashiqui 2<br/>Singer: Arijit Singh<br/>Music: Mithoon<br/>Assistant Mix Engineer - Michael Edwin Pillai<br/>Mixed and Mastered by Eric Pillai( Future Sound Of Bombay)<br/>Producer: Bhushan Kumar Krishan Kumar  Producer: Mukesh Bhatt  <br/>Director: Mohit Suri<br/>Music Label: T-Series<br/><br/>Enjoy  stay connected with us!! <br/><br/>SUBSCRIBE T-Series channel for unlimited entertainment<br/>http://www.youtube.com/tseries<br/><br/>Circle us on G  <br/>http://www.google.com/ tseriesmusic<br/><br/>Like us on Facebook<br/>http://www.facebook.com/tseriesmusic<br/><br/>Follow us<br/>http://www.twitter.com/_Tseries', 'http://i1.ytimg.com/vi/NUo8CKI34o4/mqdefault.jpg', 'youtube', '2013-04-11 17:44:07', '0', 0, 0, 0),
	(194, 24, 'Naino Mein Sapna | HIMMATWALA ', 'http://www.youtube.com/watch?v=-UKivKSxo0A', '-UKivKSxo0A', 'Check out Himmatwala\'s most awaited Song of the year \'\'Naino Mein Sapna\'\' featuring Ajay Devgn  Tamannaah Bhatia. Himmatwala is an upcoming Bollywood action-romance film directed by Sajid Khan and jointly produced by UTV Motion Pictures and Vashu Bhagnani. The film is Sajid\'s take on the 80\'s smash hit flick and is set to release on 29th March 2013<br/><br/>\'\'SMS HMM to 56161 For Mobile Downloads\'\'<br/><br/><br/>Buy "Himmatwala" [2013] Movie Songs available on iTunes:<br/>https://itunes.apple.com/in/album/himmatwala-2013-original-motion/id602649022<br/><br/><br/><br/>Follow us on Facebook:<br/>http://www.facebook.com/Saregama<br/><br/>Follow us on Twitter:<br/>http://twitter.com/Saregamaindia<br/><br/>For more Himmatwala Videos Log on  Subscribe to our Channel<br/>http://www.youtube.com/SaregamaIndia', 'http://i1.ytimg.com/vi/-UKivKSxo0A/mqdefault.jpg', 'youtube', '2013-04-11 17:45:23', '0', 0, 0, 0),
	(195, 24, 'The Holi War | Jazzy B | Bappi', 'http://www.youtube.com/watch?v=KgH1l4EFNr8', 'KgH1l4EFNr8', 'Click Here To Share On Facebook - http://on.fb.me/ZLa4uO<br/>SMS HW to 56060 for Caller Tune Activation (India Only)<br/>iTunes - https://itunes.apple.com/album/the-holi-war-single/id619145795<br/>Amazon - http://www.amazon.com/The-Holi-War/dp/B00BU8EVXS<br/>Official Music Video of \'The Holi War\'  ft Bappi Lahiri  Jazzy B - First Non-Film Single from Anubhav Sinha\'s BENARAS BEAT, specially created for this Holi.  Groove drenched in the eclectic psychedelia of colors this season. Look out for many more collaborations in future.<br/>Vocals : Jazzy B, Bappi Lahiri<br/>Music : Sharib Toshi<br/>Lyrics : Kumaar<br/>Music Producer : Abhijit Vagani<br/>Sound Engineer : Aftab Khan<br/>Produced by : Anubhav Sinha<br/>Directed by : Anubhav Sinha', 'http://i1.ytimg.com/vi/KgH1l4EFNr8/mqdefault.jpg', 'youtube', '2013-04-11 17:48:01', '0', 0, 0, 17),
	(196, 24, 'Ethir Neechal Theme Music -  A', 'http://www.youtube.com/watch?v=88oJ8j62xr4', '88oJ8j62xr4', 'Check out Anirudh\'s latest work - Ethir Neechal\'s theme music - Rise against the tide', 'http://i1.ytimg.com/vi/88oJ8j62xr4/mqdefault.jpg', 'youtube', '2013-04-12 10:35:15', '0', 0, 0, 0),
	(197, 24, 'Kula Vadu, Yuga Yugadi', 'http://www.youtube.com/watch?v=T3O211xkJ8o', 'T3O211xkJ8o', 'Yuga Yugadi Kaledaru', 'http://i1.ytimg.com/vi/T3O211xkJ8o/mqdefault.jpg', 'youtube', '2013-04-12 10:35:45', '0', 0, 0, 0),
	(198, 55, 'Priyanka Chopra - In My City f', 'http://www.youtube.com/watch?v=Zjgq6-5uDtY', 'Zjgq6-5uDtY', 'Music video by Priyanka Chopra performing In My City. Â© 2013 Interscope', 'http://i1.ytimg.com/vi/Zjgq6-5uDtY/mqdefault.jpg', 'youtube', '2013-04-12 12:14:29', '0', 0, 0, 3),
	(199, 55, 'Ethir Neechal Theme Music -  A', 'http://www.youtube.com/watch?v=88oJ8j62xr4', '88oJ8j62xr4', 'Check out Anirudh\'s latest work - Ethir Neechal\'s theme music - Rise against the tide', 'http://i1.ytimg.com/vi/88oJ8j62xr4/mqdefault.jpg', 'youtube', '2013-04-12 12:19:06', '0', 0, 0, 4),
	(200, 55, 'Vengaboys - We\'re Going to Ibi', 'http://www.youtube.com/watch?v=MXXRHpVed3M', 'MXXRHpVed3M', 'Vengaboys - We\'re Going To Ibiza!<br/><br/>Download the single now: http://itunes.apple.com/album/were-going-to-ibiza-single/id363380140<br/><br/>http://www.vengaboys.com<br/>http://www.twitter.com/vengaboys<br/>http://www.facebook.com/vengaboys', 'http://i1.ytimg.com/vi/MXXRHpVed3M/mqdefault.jpg', 'youtube', '2013-04-12 12:30:51', '0', 0, 0, 0),
	(201, 24, 'Folded-shortfilm documentary', 'https://vimeo.com/63626357', '63626357', 'Do you remember your first love when you were young ? In that documentary shortfilm, Melanie is talking about her first love when she was in the middle school in the south of France: A young boy who loved origami.<br />\r\n<br />\r\nWith MÃ©lanie Zadeh<br />\r\nDirected, filmed, edited by Kendy Ty<br />\r\n<br />\r\nCanon 550d/Rode Videomic Pro', 'http://b.vimeocdn.com/ts/434/013/434013322_200.jpg', 'vimeo', '2013-04-12 12:59:02', '0', 0, 0, 0);
/*!40000 ALTER TABLE `upload_video` ENABLE KEYS */;


# Dumping structure for table alacut.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(70) NOT NULL,
  `oauth_uid` varchar(200) NOT NULL,
  `oauth_provider` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `twitter_oauth_token` varchar(200) NOT NULL,
  `twitter_oauth_token_secret` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

# Dumping data for table alacut.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `oauth_uid`, `oauth_provider`, `username`, `twitter_oauth_token`, `twitter_oauth_token_secret`) VALUES
	(1, '', '786352064', 'twitter', 'Rajesh Kumar Khatei', '', '');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


# Dumping structure for table alacut.video_like
CREATE TABLE IF NOT EXISTS `video_like` (
  `like_id` int(20) NOT NULL AUTO_INCREMENT,
  `videoID` int(20) NOT NULL,
  `memberID` int(20) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

# Dumping data for table alacut.video_like: ~36 rows (approximately)
/*!40000 ALTER TABLE `video_like` DISABLE KEYS */;
INSERT INTO `video_like` (`like_id`, `videoID`, `memberID`, `status`) VALUES
	(1, 10, 22, 'dislike'),
	(2, 3, 22, 'like'),
	(3, 4, 22, 'like'),
	(4, 19, 22, 'dislike'),
	(5, 2, 22, 'dislike'),
	(6, 19, 23, 'like'),
	(7, 22, 24, 'like'),
	(8, 5, 22, 'like'),
	(9, 23, 22, 'dislike'),
	(10, 26, 22, 'like'),
	(11, 24, 22, 'like'),
	(12, 7, 22, 'like'),
	(13, 27, 22, 'like'),
	(14, 18, 22, 'like'),
	(15, 15, 22, 'dislike'),
	(16, 28, 22, 'like'),
	(17, 16, 22, 'like'),
	(18, 17, 22, 'like'),
	(19, 22, 22, 'dislike'),
	(20, 11, 22, 'like'),
	(21, 25, 22, 'like'),
	(22, 12, 22, 'like'),
	(23, 14, 22, 'like'),
	(24, 29, 22, 'like'),
	(25, 41, 22, 'like'),
	(26, 32, 0, 'like'),
	(27, 32, 22, 'dislike'),
	(28, 7, 1, 'dislike'),
	(29, 27, 1, 'like'),
	(30, 41, 1, 'like'),
	(31, 16, 1, 'like'),
	(32, 69, 85, 'like'),
	(33, 89, 23, 'like'),
	(34, 90, 23, 'dislike'),
	(35, 155, 21, 'like'),
	(36, 14, 24, 'like');
/*!40000 ALTER TABLE `video_like` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
