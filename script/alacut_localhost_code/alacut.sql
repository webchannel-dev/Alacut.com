-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2013 at 12:38 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alacut`
--

-- --------------------------------------------------------

--
-- Table structure for table `alacut_member`
--

CREATE TABLE `alacut_member` (
  `member_id` int(11) NOT NULL auto_increment,
  `first_name` varchar(128) default NULL,
  `middle_name` varchar(128) default NULL,
  `last_name` varchar(128) default NULL,
  `full_name` varchar(364) default NULL,
  `email` varchar(255) NOT NULL default '',
  `password` varchar(255) NOT NULL,
  `login_user_name` varchar(255) default NULL,
  `hash` varchar(255) NOT NULL,
  `active` enum('0','1','2') NOT NULL default '0' COMMENT '''0''-inactive,''1''-active,''2''-delete',
  `deleted_by` int(11) NOT NULL,
  `job` varchar(50) NOT NULL,
  `education` varchar(75) NOT NULL,
  `address` varchar(255) NOT NULL default '',
  `city` varchar(255) NOT NULL default '',
  `state_region` int(11) default NULL,
  `county_region` int(11) default NULL,
  `pin_code` int(50) default NULL,
  `relationship` enum('S','E','M') NOT NULL default 'S',
  `married_to` varchar(128) NOT NULL,
  `profile_photo_name` varchar(255) default NULL,
  `url` varchar(128) default NULL,
  `handle` enum('I','E') NOT NULL default 'I',
  `create_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `isAdmin` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `alacut_member`
--

INSERT INTO `alacut_member` (`member_id`, `first_name`, `middle_name`, `last_name`, `full_name`, `email`, `password`, `login_user_name`, `hash`, `active`, `deleted_by`, `job`, `education`, `address`, `city`, `state_region`, `county_region`, `pin_code`, `relationship`, `married_to`, `profile_photo_name`, `url`, `handle`, `create_date`, `isAdmin`) VALUES
(1, 'admin', NULL, NULL, 'admin', 'admin@alacut.com', 'admin', 'admin', '', '1', 0, '', '', '', '', NULL, NULL, NULL, 'S', '', NULL, NULL, 'I', '2013-01-28 11:58:51', '1'),
(21, 'Apurb', NULL, 'Meher', 'Apurb Meher', 'apurb.meher@aabsys.com', '2015', 'apurb', '', '2', 1, 'C', 'Graduate', 'Bhubaneswar', '', NULL, NULL, NULL, 'S', '', '141220121533.JPG', 'apurb', 'I', '2013-02-05 18:18:29', '0'),
(22, 'Rajesh', 'Kumar', 'Khatei', 'Rajesh Khatei', 'rajesh.khatei@aabsys.com', '2015', 'raj', '', '1', 0, 'B.tech', 'B.tech', 'Patia,Bhubaneswar', '', NULL, NULL, NULL, 'M', 'Ms. --------', 'd41d8cd98f00b204e9800998ecf8427eferri.jpg', 'rajesh', 'I', '2013-02-22 14:41:16', '0'),
(23, 'Anshuman', NULL, 'Nayak', 'Anshuman Nayak', 'anshuman.nayak@aabsys.com', '2015', 'anshuman', '', '1', 0, 'x', 'MCA PG', 'Bhubaneswar,Orissa', '', NULL, NULL, NULL, 'S', '', 'd41d8cd98f00b204e9800998ecf8427e141220121535.jpg', 'anshu', 'E', '2013-02-22 14:41:13', '0'),
(24, 'Bikram', NULL, NULL, 'Bikram Sahu', 'bikram.sahu@aabsys.com', '2015', 'vicky', '', '1', 0, 'y', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, 'S', 'Ms. Mishra', 'd41d8cd98f00b204e9800998ecf8427eP1010685.JPG', 'funky', 'E', '2013-02-22 14:41:40', '0'),
(29, 'Supriya', NULL, NULL, 'Supriya Sahoo', 'supriya.sahu@aabsys.com', '2014', 'supy', '', '1', 0, 'z', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, 'S', '', 'P1010683.JPG', '', 'E', '2013-02-05 18:17:09', '0'),
(30, 'Harika', NULL, NULL, 'K.Harika', 'k.harika@aabsys.com', '2013', 'harika', '', '1', 0, 'z', 'B.tech', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1020468.JPG', NULL, 'I', '2013-02-05 18:18:40', '0'),
(31, 'Prabhat', NULL, NULL, 'Prabhat Sahoo', 'prabhat.sahoo@aabsys.com', '2013', 'prabhat', '', '1', 0, 'C', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'd41d8cd98f00b204e9800998ecf8427eP1010685.JPG', NULL, 'I', '2013-02-05 18:18:12', '0'),
(36, 'Nibedita', NULL, NULL, 'Nibedita Panda', 'nibedita.panda@aabsys.com', '2013', 'nibu', '', '1', 0, 'C', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1010683.JPG', NULL, 'I', '2013-02-05 18:18:27', '0'),
(38, 'Little', NULL, NULL, 'Little Sahu', 'little.sahoo@aabsys.com', '2013', 'welly', '', '0', 0, 'x', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'it group.JPG', NULL, 'I', '2013-02-05 18:17:01', '0'),
(41, 'Sibashish', NULL, NULL, 'Sibasis Mohanty', 'shibashish.mohanty@aabsys.com', '2013', 'sibu', '', '1', 0, 'A', 'B.tech', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'd41d8cd98f00b204e9800998ecf8427eRaj AABSyS Party.JPG', NULL, 'I', '2013-02-05 18:18:05', '0'),
(51, 'AABSyS GIS', NULL, NULL, 'AABSyS GIS', 'a@gmail.com', '2013', 'aaa', '', '2', 51, 'y', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1020582.JPG', NULL, 'I', '2013-02-05 18:18:32', '0'),
(55, 'AABSyS CAD', NULL, NULL, 'AABSyS CAD', 'abc@yahoo.com', '2013', 'abcd', '', '1', 0, 'z', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1020505.JPG', NULL, 'I', '2013-02-05 20:18:41', '0'),
(56, 'Dinesh', NULL, NULL, 'Dinesh Bisoyi', 'dinesh.bisoyi@aabsys.com', '2013', 'Arjun', '', '1', 1, 'z', 'B.tech', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1020602.JPG', NULL, 'I', '2013-02-05 18:18:41', '0'),
(59, 'Lalit', NULL, NULL, 'Lalit Tyagi', 'lalit.tyagi@aabsys.com', '2013', 'lalit', '', '2', 1, 'z', 'B.tech', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1020590.JPG', NULL, 'I', '2013-02-05 18:18:39', '0'),
(69, 'AABSyS IT', NULL, NULL, 'AABSyS IT', 'aabsys@gmail.com', '2013', 'aabsys', '', '2', 69, 'y', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1020577.JPG', NULL, 'I', '2013-02-05 18:18:34', '0'),
(74, 'Dilip', NULL, NULL, 'Dilip Rath', 'dilip.rath@aabsys.com', '2013', 'dilip', '', '2', 1, 'x', 'B.tech', 'Bhubaneswar', '', NULL, NULL, NULL, '', '', 'P1020590.JPG', NULL, 'I', '2013-02-05 18:18:15', '0'),
(85, 'Raj', NULL, NULL, 'Rajesh Kumar', 'rajeshkukhatei@gmail.com', '123', 'abc', '', '2', 0, 'x', 'MCA', 'Bhubaneswar', '', NULL, NULL, NULL, 'S', '', 'P1020514.JPG', NULL, 'I', '2013-02-05 18:18:18', '0'),
(86, NULL, NULL, NULL, 'r', 'aabsys.rajesh@gmail.com', '1', 'fdff', 'c9f0f895fb98ab9159f51fd0297e236d', '1', 0, '', '', '', '', NULL, NULL, NULL, 'S', '', NULL, NULL, 'I', '2013-02-04 14:53:04', '0'),
(87, NULL, NULL, NULL, 'sbc', 'acd@gmail.com', '546', 'raj', 'sdsdsd4343', '0', 0, '', '', '', '', NULL, NULL, NULL, 'S', '', NULL, NULL, 'I', '2013-02-07 16:36:03', '0'),
(88, 'r', NULL, NULL, 'raj', 'aabsys.rajesh@gmail.com', '1', 'w', '1be3bc32e6564055d5ca3e5a354acbef', '0', 0, '', '', '', '', NULL, NULL, NULL, 'S', '', NULL, NULL, 'I', '2013-02-01 14:51:23', '0'),
(90, 'Rajesh Kumar', NULL, 'Khatei', 'Rajesh Ku Khatei', 'biki@gmail.com', '2015', 'biki', '9232fe81225bcaef853ae32870a2b0fe', '1', 0, '', '', '', '', NULL, NULL, NULL, 'S', '', '5114e5960c080_profile.jpeg', '', 'I', '2013-02-22 14:46:29', '0'),
(91, '', NULL, '', ' ', 'fgggd@erw.hg', '1', 'fdfd', 'e0ec453e28e061cc58ac43f91dc2f3f0', '0', 0, '', '', '', '', NULL, NULL, NULL, 'S', '', '', NULL, 'I', '2013-02-23 15:36:25', '0');

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `friend_id` int(11) NOT NULL auto_increment,
  `frnd_req_from_id` int(11) NOT NULL,
  `frnd_req_to_id` int(11) NOT NULL,
  `date_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `status` enum('P','C','R','U') NOT NULL default 'P',
  `view` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`friend_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`friend_id`, `frnd_req_from_id`, `frnd_req_to_id`, `date_time`, `status`, `view`) VALUES
(1, 24, 23, '2013-01-02 15:56:10', 'C', '0'),
(2, 24, 22, '2013-01-02 15:57:56', 'U', '0'),
(3, 29, 22, '2013-01-02 15:57:56', 'C', '0'),
(5, 22, 24, '2013-01-02 18:14:47', 'C', '0'),
(6, 22, 36, '2013-01-02 18:48:26', 'C', '0'),
(7, 22, 55, '2013-01-03 14:07:57', 'P', '0'),
(8, 22, 41, '2013-01-03 14:08:00', 'P', '0'),
(9, 36, 23, '2013-01-03 14:08:35', 'C', '0'),
(10, 36, 24, '2013-01-03 14:08:40', 'P', '0'),
(11, 36, 22, '2013-01-03 14:08:44', 'C', '0'),
(12, 36, 41, '2013-01-03 14:08:46', 'P', '0'),
(13, 41, 22, '2013-01-03 14:10:29', 'C', '0'),
(14, 41, 24, '2013-01-03 14:10:39', 'C', '0'),
(15, 41, 23, '2013-01-03 14:10:41', 'C', '0'),
(16, 41, 55, '2013-01-03 14:10:44', 'P', '0'),
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
(43, 0, 88, '2013-02-20 09:14:28', 'P', '0');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL auto_increment,
  `message_from_id` int(11) NOT NULL,
  `message_to_id` int(11) NOT NULL,
  `date_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `message_content` varchar(440) NOT NULL,
  `reply_id` int(11) NOT NULL default '0',
  `status` enum('0','1','2') NOT NULL default '0' COMMENT '''0''-Not read,''1''-Read,''2''-delete',
  `active` enum('0','1') NOT NULL default '1' COMMENT '''1''-approve ,''0''-not Approve',
  PRIMARY KEY  (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `message_from_id`, `message_to_id`, `date_time`, `message_content`, `reply_id`, `status`, `active`) VALUES
(1, 24, 23, '2013-02-11 12:23:40', '1.HI', 0, '1', '1'),
(3, 23, 24, '2013-02-11 12:18:18', '1.Anshuman sir', 0, '1', '1'),
(6, 24, 23, '2013-02-11 13:56:11', 'hello', 1, '1', '1'),
(7, 23, 24, '2013-02-11 12:28:08', 'Well done', 1, '0', '1'),
(8, 23, 24, '2013-02-11 13:57:47', 'enjoying', 1, '1', '1'),
(9, 24, 23, '2013-02-11 13:57:52', 'yes', 1, '1', '1'),
(10, 23, 24, '2013-02-11 13:58:57', 'doing your work?', 1, '0', '1'),
(11, 23, 24, '2013-02-11 14:00:19', 'have fun', 1, '0', '1'),
(12, 23, 24, '2013-02-11 14:01:15', 'hi', 1, '0', '0'),
(13, 23, 24, '2013-02-11 14:02:41', 'hi', 1, '0', '1'),
(14, 23, 24, '2013-02-11 14:03:32', 'ghgfh', 1, '0', '0'),
(15, 22, 24, '2013-02-26 11:09:17', 'hghg', 0, '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `post_comment_id` int(11) NOT NULL auto_increment,
  `videoID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `date_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `comment` varchar(140) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `status` enum('0','1','2') NOT NULL default '0' COMMENT '''0''-not read,''1''-read,''2''-delete',
  `active` enum('0','1') NOT NULL default '1' COMMENT '''1''-approve ,''0''-not Approve',
  PRIMARY KEY  (`post_comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `post_comments`
--

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
(31, 18, 22, '2013-02-07 12:37:00', 'Nice\n', '', '0', '1'),
(32, 18, 22, '2013-02-07 16:15:09', 'Good', '', '0', '1'),
(33, 19, 23, '2013-02-09 11:42:58', 'waoo', '', '0', '1'),
(34, 5, 22, '2013-02-09 21:42:59', 'x', '', '2', '1'),
(35, 5, 22, '2013-02-09 21:48:17', 'nice', '', '1', '0'),
(36, 7, 22, '2013-02-10 09:23:11', 'What s up dude', '', '0', '1'),
(37, 10, 22, '2013-02-10 09:24:08', 'What s dance', '', '0', '0'),
(38, 24, 22, '2013-02-10 10:20:22', 'What s this', '', '0', '1'),
(39, 14, 22, '2013-02-10 12:28:34', 'nice post', '', '0', '1'),
(40, 29, 22, '2013-02-15 22:17:42', 'HI', '', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `upload_image`
--

CREATE TABLE `upload_image` (
  `image_id` int(11) NOT NULL auto_increment,
  `img_upload_by` int(11) NOT NULL,
  `image_name` varchar(30) NOT NULL,
  `image_url` varchar(128) NOT NULL,
  `image_desc` varchar(500) NOT NULL,
  `uploaded_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL default '0',
  PRIMARY KEY  (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `upload_image`
--

INSERT INTO `upload_image` (`image_id`, `img_upload_by`, `image_name`, `image_url`, `image_desc`, `uploaded_date`, `status`) VALUES
(1, 24, 'Animated', 'http://animated-desktop-background.com/wp-content/uploads/2012/06/free-animated-nature-backgrounds.jpg', 'Good snap', '2013-02-05 09:59:05', '0'),
(2, 22, 'Nature', 'http://cdn.hdwallpaperspics.com/uploads/2012/11/free-animated-desktop-wallpaper-for-mac.jpg', 'What a picture', '2013-02-05 10:31:55', '0');

-- --------------------------------------------------------

--
-- Table structure for table `upload_video`
--

CREATE TABLE `upload_video` (
  `video_id` int(11) NOT NULL auto_increment,
  `video_upload_by` int(11) NOT NULL,
  `video_name` varchar(30) default NULL,
  `video_url` varchar(256) NOT NULL,
  `video_object` varchar(128) NOT NULL,
  `video_desc` varchar(4540) default NULL,
  `video_type` varchar(20) NOT NULL,
  `uploaded_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL default '0' COMMENT '''0''-not View,''1''-''View'',''2''-''deleted''',
  `like` int(30) NOT NULL default '0',
  `dislike` int(30) NOT NULL default '0',
  `visit` int(30) NOT NULL default '0',
  PRIMARY KEY  (`video_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `upload_video`
--

INSERT INTO `upload_video` (`video_id`, `video_upload_by`, `video_name`, `video_url`, `video_object`, `video_desc`, `video_type`, `uploaded_date`, `status`, `like`, `dislike`, `visit`) VALUES
(1, 23, 'Sky Fall', '', 'iGng9NLo37Y', NULL, 'youtube', '2013-02-07 10:34:48', '2', 0, 0, 0),
(2, 23, '2012. 366 days', 'http://vimeo.com/56599373', '56599373', NULL, 'vimeo', '2013-02-09 14:15:49', '0', 1, 0, 57),
(3, 22, 'Titanic 3D', 'http://www.youtube.com/watch?v=tXsyGFXjzcY', 'tXsyGFXjzcY', NULL, 'youtube', '2013-02-09 15:02:41', '0', 1, 0, 38),
(4, 22, '2012 BIFA', 'https://vimeo.com/56654321', '56654321', NULL, 'vimeo', '2013-02-09 15:56:21', '0', 1, 0, 139),
(5, 22, 'New York city', 'https://vimeo.com/56477894', '56477894', NULL, 'vimeo', '2013-02-09 15:04:08', '0', 0, 1, 43),
(6, 22, 'Iron Man 3', '', '5EjG-1U3wqA', NULL, 'youtube', '2013-02-07 10:34:48', '2', 0, 0, 0),
(7, 22, 'Sky Fall', '', 'iGng9NLo37Y', NULL, 'youtube', '2013-02-09 15:02:48', '0', 0, 2, 155),
(10, 22, 'ABCD', 'http://www.youtube.com/watch?v=qLZC67-NfOI', 'qLZC67-NfOI', 'From India''s biggest film studio, UTV Motion Pictures, and renowned choreographer & director, Remo D''souza comes India''s first dance film in 3D -- a spectacular entertainer that proves yet again that if you dare to dream, impossible is nothing! In Cinemas: Feb 2013 Lead Cast: Prabhudeva, Salman Khan, Kay Kay Menon, Dharmesh Yelande, Lauren Gottlieb Directed & Choreographed By: Remo D''souza Produced By: Ronnie Screwvala & Siddharth Roy Kapur', 'youtube', '2013-02-09 15:03:14', '0', 0, 1, 17),
(11, 24, 'Matru ', 'http://www.youtube.com/user/FoxStarIndia?v=eihADcleSCQ', 'eihADcleSCQ', NULL, 'youtube', '2013-02-09 14:00:57', '0', 1, 0, 36),
(12, 24, 'krissh', 'http://www.youtube.com/watch?v=qRDUb5MZRRQ', 'qRDUb5MZRRQ', NULL, 'youtube', '2013-02-09 10:52:29', '0', 1, 0, 25),
(13, 22, 'Brave the movie', 'http://www.youtube.com/watch?feature=player_embedded', '1_GeQmhxc6g', NULL, 'youtube', '2013-02-07 10:34:48', '2', 0, 0, 0),
(14, 24, 'Oblivion Trailer (2013)', 'http://www.youtube.com/watch?v=vGpjlfCfe2Y', 'vGpjlfCfe2Y', NULL, 'youtube', '2013-02-09 15:48:14', '0', 1, 0, 60),
(15, 22, 'Matru Ki Bijlee Ka Mandola', 'http://www.youtube.com/user/FoxStarIndia?v=eihADcleSCQ', 'eihADcleSCQ', 'Vishal Bhardwaj is back with his crazy comic drama : Matru Ki Bijlee Ka Mandola, starring Imran Khan, Anushka Sharma, Pankaj Kapur, Shabana Azmi and Arya Babbar. Releasing on 11th January 2013.\r\n\r\nCatch the official trailer today of the film, featuring the whole star cast.\r\n\r\nFox Star Studios presents a VB Pictures Production of Matru Ki Bijlee Ka Mandola, directed by Vishal Bhardwaj. Music is by Vishal Bhardwaj and lyrics by Gulzar.\r\n\r\nFor all updates on the film, log on to:\r\nFacebook:  www.facebook.com/matrubijleemandola\r\nTwitter: @MBMthefilm\r\nYoutube: www.youtube.com/foxstarindia.com', 'youtube', '2013-02-09 10:13:09', '0', 0, 1, 5),
(16, 23, 'EPIC Trailer 2013', 'http://www.youtube.com/watch?v=j6Nwdpa5PcU', 'j6Nwdpa5PcU', 'Epic Trailer 2013 Movie - Official 2012 trailer in HD - Animated Adventure-Comedy starring Colin Farrell, Amanda Seyfried, Josh Hutcherson, and Beyonce Knowles - directed by Chris Wedge - a 3D CG movie that reveals a hidden world unlike any other\n\nEpic movie hits theaters on May 17, 2013.\n\nEPIC tells the story of an ongoing battle deep in the forest between the forces of good and the forces of evil.  When a teen age girl finds herself magically transported into this secret universe, she must band together with a rag-tag team of fun and whimsical characters in order to save their world...and ours. Epic movie trailer 2013 is presented in full HD 1080p high resolution. \n\nEPIC 2013 Movie\nDirector: Chris Wedge\nWriters: Tom J. Astle, Matt Ember\nStars: Colin Farrell, Amanda Seyfried, Josh Hutcherson and Beyonce Knowles.\n\nEpic official movie trailer courtesy 20th Century Fox.\n\nCieon Movies is your daily dose of "everything movies", a mainstream channel with wider coverage from G-rated to R-rated movies and includes both theatrical and DVD releases, with an extended selection of officially licensed movie trailers and movie clips.\n\nTags: "epic trailer" "epic 2013" epic trailer 2013 official hd movie 2012 "epic trailer 2013" "epic trailer 2012" "epic movie" "epic movie trailer" "epic 2013 movie" "epic 2013 trailer" "colin farrell" "amanda seyfried" "josh hutcherson" "beyonce knowles" "chris wedge" colin farrell amanda seyfried hutcherson beyonce knowles chris wedge movies trailers film films today this week month year new "official trailer" "movie trailer" "film trailer" "trailer 2013" "trailer 2012"', 'youtube', '2013-02-09 10:10:34', '0', 2, 0, 210),
(17, 23, 'Jurassic Park 3D', 'http://www.youtube.com/watch?v=bc-fZaLbyJM', 'bc-fZaLbyJM', 'Jurassic Park  3D - Official Trailer (2013)\r\n\r\n\r\nGenre : Science Fiction\r\nOfficial Site : http://www.jurassicpark.com\r\nDirector:Steven Spielberg\r\nCast:Sam Neill, Laura Dern, Jeff Goldblum, Richard AttenboroughWriters:David Koepp, Michael Crichton\r\n\r\nSynopsis\r\nUniversal Pictures will release Steven Spielberg groundbreaking masterpiece JURASSIC PARK in 3D on April 5, 2013. With his remastering of the epic into a state-of-the-art 3D format, Spielberg introduces the three-time Academy AwardÂ®-winning blockbuster to a new generation of moviegoers and allows longtime fans to experience the world he envisioned in a way that was unimaginable during the film original release. Starring Sam Neill, Laura Dern, Jeff Goldblum, Samuel L. Jackson and Richard Attenborough, the film based on the novel by Michael Crichton is produced by Kathleen Kennedy and Gerald R. Molen.', 'youtube', '2013-02-09 14:15:44', '0', 1, 0, 14),
(18, 22, 'Jurassic Park 3D', 'http://www.youtube.com/watch?feature=player_embedded', 'bc-fZaLbyJM', 'Jurassic Park  3D - Official Trailer (2013)\n\n\nGenre : Science Fiction\nOfficial Site : http://www.jurassicpark.com\nDirector:Steven Spielberg\nCast:Sam Neill, Laura Dern, Jeff Goldblum, Richard AttenboroughWriters:David Koepp, Michael Crichton\n\nSynopsis\nUniversal Pictures will release Steven Spielberg s groundbreaking masterpiece JURASSIC PARK in 3D on April 5, 2013. With his remastering of the epic into a state-of-the-art 3D format, Spielberg introduces the three-time Academy AwardÂ®-winning blockbuster to a new generation of moviegoers and allows longtime fans to experience the world he envisioned in a way that was unimaginable during the film s original release. Starring Sam Neill, Laura Dern, Jeff Goldblum, Samuel L. Jackson and Richard Attenborough, the film based on the novel by Michael Crichton is produced by Kathleen Kennedy and Gerald R. Molen.', 'youtube', '2013-02-09 15:54:30', '0', 1, 0, 43),
(19, 23, 'Oblivion Trailer (2013)', 'http://www.youtube.com/watch?v=vGpjlfCfe2Y', 'vGpjlfCfe2Y', 'Earth is a memory worth fighting for...  Watch the first Oblivion Trailer starring Tom Cruise. An original and groundbreaking cinematic event from the director of TRON: Legacy and the producer of Rise of the Planet of the Apes. On a spectacular future Earth that has evolved beyond recognition, one man s confrontation with the past will lead him on a journey of redemption and discovery as he battles to save mankind. ack Harper (Cruise) is one of the last few drone repairmen stationed on Earth. Part of a massive operation to extract vital resources after decades of war with a terrifying threat known as the Scavs, Jack s mission is nearly complete.\n\nLiving in and patrolling the breathtaking skies from thousands of feet above, his soaring existence is brought crashing down when he rescues a beautiful stranger from a downed spacecraft. Her arrival triggers a chain of events that forces him to question everything he knows and puts the fate of humanity in his hands.\n\nOblivion was shot in stunning digital 4K resolution on location across the United States and Iceland.\n\nOblivion Official Trailer. Join us on Facebook http://facebook.com/FreshMovieTrailers & http://twitter.com/mytrailerisrich and subscribe now to get the best and the latest movie trailers, clips and videos !', 'youtube', '2013-02-09 14:01:05', '0', 1, 1, 54),
(20, 24, '[HD] Audi R8 goes up in flames', 'http://www.youtube.com/watch?v=KjIuFsk1hgQ', 'KjIuFsk1hgQ', '27/01/2013\n\nAs a fan of these cars, this hurt to watch.\nA silver grey Audi R8 caught fire on the Bandra-Worli sealink today morning. \n(video taken from several sources, same incident)\n\nAudi R8 up in Flames in Mumbai at the Parx Supercar Rally 2013\nExclusive video Audi R8 up in Flames in Mumbai at the Parx Supercar Rally 2013', 'youtube', '2013-02-07 10:34:48', '2', 0, 0, 0),
(21, 24, 'Earring Studs movie', 'http://www.youtube.com/user/realeyez3d?v=tmL9uUwjesA', 'tmL9uUwjesA', 'Beautiful pair of earring studs, all in 3d.', 'youtube', '2013-02-07 10:34:48', '2', 0, 0, 0),
(22, 24, 'Tata Manza -  A class apart', 'http://www.youtube.com/watch?v=tyTRR2vT0Qk', 'tyTRR2vT0Qk', 'Introducing the all new Tata Manza. With exteriors detailed in chrome and interiors dressed in beige and burgundy, the Manza makes a bold statement. \n\nTest Drive it today', 'youtube', '2013-02-09 14:00:49', '0', 0, 2, 43),
(23, 22, 'Fast & Furious 6 - Extended', 'http://www.youtube.com/watch?v=p1QgNF6J1h0', 'p1QgNF6J1h0', 'Official Website: http://thefastandthefurious.com\n\nVin Diesel, Paul Walker and Dwayne Johnson lead the returning cast of all-stars as the global blockbuster franchise built on speed races to its next continent in Fast & Furious 6.  Reuniting for their most high-stakes adventure yet, fan favorites Jordana Brewster, Michelle Rodriguez, Tyrese Gibson, Sung Kang, Gal Gadot, Chris "Ludacris" Bridges and Elsa Pataky are joined by badass series newcomers Luke Evans and Gina Carano.\n\nSince Dom (Diesel) and Brian s (Walker) Rio heist toppled a kingpin s empire and left their crew with $100 million, our heroes have scattered across the globe.  But their inability to return home and living forever on the lam have left their lives incomplete.  \n\nMeanwhile, Hobbs (Johnson) has been tracking an organization of lethally skilled mercenary drivers across 12 countries, whose mastermind (Evans) is aided by a ruthless second-in-command revealed to be the love Dom thought was dead, Letty (Rodriguez).  The only way to stop the criminal outfit is to outmatch them at street level, so Hobbs asks Dom to assemble his elite team in London.  Payment?  Full pardons for all of them so they can return home and make their families whole again.  \n\nBuilding on the worldwide blockbuster success of Fast Five and taking the action, stunts and narrative to even greater heights, Fast & Furious 6 sees director Justin Lin back behind the camera for the fourth time.  He is supported by longtime producers Neal H. Moritz and Vin Diesel, who welcome producer Clayton Townsend back to the series.', 'youtube', '2013-02-09 15:56:14', '2', 0, 1, 2),
(24, 22, 'FASHION FILM', 'http://vimeo.com/58933055', '58933055', 'Lizzy Caplan for Viva Vena!', 'vimeo', '2013-02-09 16:15:15', '0', 1, 0, 33),
(25, 24, '50 Cent - You Should Be Dead', 'http://www.youtube.com/watch?v=UL1XLzec2vM', 'UL1XLzec2vM', 'www.Thisis50.com - IF IT S HOT IT S HERE', 'youtube', '2013-02-09 17:21:32', '0', 1, 0, 2),
(26, 22, 'STORYBOARD: A Day With New Yor', 'https://vimeo.com/56477894', '56477894', 'Every day, on a Tumblr called "The Daily Pothole," New Yorkers get a peek inside the inner workings of a city system few knew existed: the men who repair our potholes. Tumblr spent a day with the crew that makes up New York City s pothole repair team.', 'vimeo', '2013-02-09 17:22:14', '0', 0, 1, 9),
(27, 22, 'LASTorder "Reindeer"', 'http://vimeo.com/58822081', '58822081', 'LASTorder 1st album<br />\r\nBliss in the loss<br />\r\n2013.02.05ã€€on sale.<br />\r\n"Reindeer"', 'vimeo', '2013-02-09 19:26:06', '0', 1, 1, 27),
(28, 22, 'Epic Official Trailer', 'http://www.youtube.com/watch?v=BJVkoq_wK80', 'BJVkoq_wK80', 'Subscribe to TRAILERS: http://bit.ly/sxaw6h\nSubscribe to COMING SOON: http://bit.ly/H2vZUn\nEpic Official Trailer #1 (2013) Amanda Seyfried, BeyoncÃ© Animated Movie HD\n\n\nA teenager finds herself transported to a deep forest setting where a battle between the forces of good and the forces of evil is taking place. She bands together with a rag-tag group characters in order to save their world -- and ours.\n\n"Epic trailer" "Epic movie" "Epic HD" HD 2012 "Amanda Seyfried" "Josh Hutcherson" "BeyoncÃ© Knowles" "Tom J. Astle" "Matt Ember" "Chris Wedge" "Colin Farrell" "Jason Sudeikis" "Aziz Ansari" "Johnny Knoxville" "Steven Tyler" Pitbull Animation Adventure Family Fantasy movieclips movie clips movieclipstrailers animated animation etimmons cartoon little small fairies bugs fantasy "ice age" adventure fly movieclipscomingsoon', 'youtube', '2013-02-10 09:45:31', '0', 0, 1, 3),
(29, 22, 'Dave', 'http://vimeo.com/58450445', '58450445', 'Dave is trying all kinds of way to get to work on time. Will he make it?', 'vimeo', '2013-02-10 09:52:21', '0', 1, 0, 12),
(30, 22, 'Brand New HD Song - Yaar Amli ', 'http://www.youtube.com/watch?v=01DVIHoYg84', '01DVIHoYg84', 'Official Page - www.facebook.com/kamalproductions\nSong - Yaar Amli ,\nArtist - Ammy Virk \nMusic - Bhinda Aujla \nLabel - Kamal Productions(www.facebook.com/kamalproducÂ­tions)\n\nFor Any INQUIRES : 9056315000, 7696438005', 'youtube', '2013-02-10 13:19:51', '0', 0, 0, 2),
(31, 22, 'Drake - Started From The Botto', 'http://www.youtube.com/watch?v=NZOKgL_OjLk', 'NZOKgL_OjLk', 'Drake s latest single "Started From The Bottom" is now available on iTunes. Purchase it here: http://itun.es/i6J29Xz\n\nFollow my fan account! - @ItsJustDrake -  www.twitter.com/ItsJustDrake\n\nWiz Khalifa - Started From The Bottom Wiz Khalifa - Started From The Bottom\nWiz Khalifa - Started From The Bottom Wiz Khalifa - Started From The Bottom\nWiz Khalifa - Started From The Bottom Wiz Khalifa - Started From The Bottom\nWiz Khalifa - Started From The Bottom Wiz Khalifa - Started From The Bottom Wiz Khalifa - Started From The Bottom\nWiz Khalifa - Started From The Bottom Wiz Khalifa - Started From The Bottom\nWiz Khalifa - Started From The Bottom Wiz Khalifa - Started From The Bottom\nWiz Khalifa - Started From The Bottom\n\nMusic video by Drake performing Started From The Bottom. \n(C) 2013 Cash Money Records Inc\n\nDrake - Started From The Bottom \nDrake - Started From The Bottom \nDrake - Started From The Bottom \nDrake - Started From The Bottom \nDrake - Started From The Bottom \nDrake - Started From The Bottom \nWiz Khalifa ft. Drake - Started From The Bottom \nWiz Khalifa ft. Drake - Started From The Bottom \nWiz Khalifa ft. Drake - Started From The Bottom \nWiz Khalifa ft. Drake - Started From The Bottom \nWiz Khalifa ft. Drake - Started From The Bottom \n\nDrake New Song 2013 Official Video\nDrake New Song 2013 Official Video\nDrake New Song 2013 Official Video\nDrake New Song 2013 Official Video\nDrake New Song 2013 Official Video', 'youtube', '2013-02-10 13:22:51', '0', 0, 0, 4),
(32, 22, 'The Chipettes- Tik Tok', 'http://www.youtube.com/watch?v=xTSxYvOaJXc', 'xTSxYvOaJXc', 'Brittany- We Singing Tik Tok ( Enjoy)', 'youtube', '2013-02-10 13:28:02', '0', 2, 0, 218),
(37, 24, '', 'http://www.youtube.com/watch?v=KJrTS0hQY7I', 'KJrTS0hQY7I', '', 'youtube', '2013-02-10 19:28:03', '0', 0, 0, 4),
(38, 24, '', 'http://www.youtube.com/watch?v=KJrTS0hQY7I', 'KJrTS0hQY7I', '', 'youtube', '2013-02-10 19:30:20', '0', 0, 0, 1),
(41, 22, '', 'http://www.youtube.com/watch?v=2jtOBWSko_E', '2jtOBWSko_E', '', 'youtube', '2013-02-12 07:29:15', '0', 2, 0, 73),
(42, 0, '', 'http://www.youtube.com/watch?v=0PcPLf9rGEk', '0PcPLf9rGEk', '', 'youtube', '2013-02-16 02:02:12', '0', 0, 0, 0),
(43, 0, '', 'http://www.youtube.com/watch?v=GYSCybbWLbI', 'GYSCybbWLbI', '', 'youtube', '2013-02-16 14:44:20', '0', 0, 0, 0),
(44, 22, '', 'http://www.youtube.com/watch?v=wZ4QNS__zDM', 'wZ4QNS__zDM', '', 'youtube', '2013-02-20 16:12:58', '0', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(70) NOT NULL,
  `oauth_uid` varchar(200) NOT NULL,
  `oauth_provider` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `twitter_oauth_token` varchar(200) NOT NULL,
  `twitter_oauth_token_secret` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `oauth_uid`, `oauth_provider`, `username`, `twitter_oauth_token`, `twitter_oauth_token_secret`) VALUES
(1, '', '786352064', 'twitter', 'Rajesh Kumar Khatei', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `video_like`
--

CREATE TABLE `video_like` (
  `like_id` int(20) NOT NULL auto_increment,
  `videoID` int(20) NOT NULL,
  `memberID` int(20) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY  (`like_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `video_like`
--

INSERT INTO `video_like` (`like_id`, `videoID`, `memberID`, `status`) VALUES
(1, 10, 22, 'dislike'),
(2, 3, 22, 'like'),
(3, 4, 22, 'like'),
(4, 19, 22, 'dislike'),
(5, 2, 22, 'dislike'),
(6, 19, 23, 'like'),
(7, 22, 24, 'dislike'),
(8, 5, 22, 'like'),
(9, 23, 22, 'dislike'),
(10, 26, 22, 'like'),
(11, 24, 22, 'like'),
(12, 7, 22, 'like'),
(13, 27, 22, 'like'),
(14, 18, 22, 'like'),
(15, 15, 22, 'dislike'),
(16, 28, 22, 'dislike'),
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
(27, 32, 22, 'like'),
(28, 7, 1, 'dislike'),
(29, 27, 1, 'like'),
(30, 41, 1, 'like'),
(31, 16, 1, 'like');
