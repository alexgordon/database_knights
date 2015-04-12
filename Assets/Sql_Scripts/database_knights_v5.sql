-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2015 at 01:05 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `database_knights`
--
CREATE DATABASE IF NOT EXISTS `database_knights` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `database_knights`;

-- --------------------------------------------------------

--
-- Table structure for table `events_table`
--

DROP TABLE IF EXISTS `events_table`;
CREATE TABLE IF NOT EXISTS `events_table` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_name` varchar(45) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(45) NOT NULL,
  `description` varchar(250) NOT NULL,
  `rating` float NOT NULL,
  `rating_count` int(11) NOT NULL,
  `rso_id` int(11) NOT NULL,
  `privateEvent` varchar(45) NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `rso_id` (`rso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `events_table`
--

INSERT INTO `events_table` (`event_id`, `e_name`, `time`, `location`, `description`, `rating`, `rating_count`, `rso_id`, `privateEvent`) VALUES
(1, 'Test', '2015-04-07 23:47:20', 'Here', 'Test Event!', 3, 2, 6, 'Public'),
(2, 'Test 2', '2015-04-08 21:30:00', 'Over There', 'Here is the description!!!!', 2, 2, 6, 'Public'),
(3, 'Test 3', '2015-04-10 21:30:00', 'Over There', 'Here is the description!!!!', 0, 0, 6, 'Public'),
(4, 'Test 5', '2015-04-14 18:30:00', 'Here', 'Here is a description', 0, 0, 6, 'Public'),
(5, 'UCF Only Event', '2015-04-10 08:30:00', '4000 Central Florida Blvd, Orlando, FL 32816', 'This is a UCF only event', 0, 0, 3, 'Private'),
(6, 'Tech Talk', '2015-04-12 15:00:00', '777 E Princeton St, Orlando, FL 32803', 'This will be a tech talk at the Science Center', 0, 0, 3, 'Public'),
(7, 'Tech Talk #2', '2015-04-12 15:00:00', '777 E Princeton St, Orlando, FL 32803', 'This will be a tech talk at the Science Center', 5, 1, 3, 'Public'),
(8, 'Jack and the Box', '2015-12-30 23:59:00', '2220 Chester Ave Bakersfield, CA', 'Description', 0, 0, 7, 'Public_pending_3');

-- --------------------------------------------------------

--
-- Table structure for table `non_rso_events_table`
--

DROP TABLE IF EXISTS `non_rso_events_table`;
CREATE TABLE IF NOT EXISTS `non_rso_events_table` (
  `nre_id` int(11) NOT NULL AUTO_INCREMENT,
  `nre_name` varchar(45) NOT NULL,
  `nre_time` datetime NOT NULL,
  `nre_location` varchar(45) NOT NULL,
  `nre_description` varchar(250) NOT NULL,
  `nre_rating` float NOT NULL,
  `nre_rating_count` int(11) NOT NULL,
  `nre_privateEvent` varchar(45) NOT NULL,
  `uni_id` int(11) NOT NULL,
  PRIMARY KEY (`nre_id`),
  KEY `uni_id` (`uni_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `non_rso_events_table`
--

INSERT INTO `non_rso_events_table` (`nre_id`, `nre_name`, `nre_time`, `nre_location`, `nre_description`, `nre_rating`, `nre_rating_count`, `nre_privateEvent`, `uni_id`) VALUES
(2, 'Jack and the Box', '2015-10-29 23:59:00', '2220 Chester Ave Bakersfield, CA', 'This will work', 0, 0, 'Private', 3);

-- --------------------------------------------------------

--
-- Table structure for table `passwords_table`
--

DROP TABLE IF EXISTS `passwords_table`;
CREATE TABLE IF NOT EXISTS `passwords_table` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `passwords_table`
--

INSERT INTO `passwords_table` (`p_id`, `user_id`, `password`) VALUES
(1, 1, 'test'),
(2, 2, 'test'),
(3, 3, 'test'),
(4, 4, 'test'),
(6, 6, 'test'),
(7, 7, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `privileges_table`
--

DROP TABLE IF EXISTS `privileges_table`;
CREATE TABLE IF NOT EXISTS `privileges_table` (
  `priv_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `privilege_status` varchar(45) NOT NULL,
  PRIMARY KEY (`priv_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `privileges_table`
--

INSERT INTO `privileges_table` (`priv_id`, `user_id`, `privilege_status`) VALUES
(1, 1, 'admin'),
(2, 2, 'super_admin'),
(3, 3, 'student'),
(4, 4, 'student'),
(6, 6, 'student'),
(7, 7, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `reviews_table`
--

DROP TABLE IF EXISTS `reviews_table`;
CREATE TABLE IF NOT EXISTS `reviews_table` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `reviewDate` varchar(255) DEFAULT NULL,
  `nre_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  KEY `user_id` (`user_id`),
  KEY `event_id` (`event_id`),
  KEY `nre_id` (`nre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `reviews_table`
--

INSERT INTO `reviews_table` (`review_id`, `user_id`, `event_id`, `comments`, `rating`, `reviewDate`, `nre_id`) VALUES
(2, 4, 5, 'This ', NULL, 'April 10th 2015 01:39:37 AM', NULL),
(3, 3, 1, 'I thought this was a great event!!!', 5, 'April 10th 2015 01:50:02 AM', NULL),
(4, 3, 1, 'This was an awful event', 1, 'April 10th 2015 02:22:27 AM', NULL),
(5, 4, 2, 'I thought it was an ok event', 3, 'April 10th 2015 02:24:04 AM', NULL),
(6, 3, 7, 'I had a great time!', 5, 'April 12th 2015 02:05:47 PM', NULL),
(7, 3, 2, 'NOXPLODE', NULL, 'April 12th 2015 06:50:11 PM', NULL),
(8, 3, NULL, 'Jack and the box is good', NULL, 'April 12th 2015 07:01:39 PM', 2),
(9, 3, NULL, 'Jack and the box is good again', NULL, 'April 12th 2015 07:02:45 PM', 2),
(10, 3, 2, 'Does this work or explode', 1, 'April 12th 2015 07:03:15 PM', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rso_member`
--

DROP TABLE IF EXISTS `rso_member`;
CREATE TABLE IF NOT EXISTS `rso_member` (
  `rel_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rso_id` int(11) NOT NULL,
  PRIMARY KEY (`rel_id`),
  KEY `user_id` (`user_id`),
  KEY `rso_id` (`rso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `rso_member`
--

INSERT INTO `rso_member` (`rel_id`, `user_id`, `rso_id`) VALUES
(1, 3, 3),
(2, 6, 6),
(3, 3, 6),
(7, 4, 3),
(8, 7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `rso_pending`
--

DROP TABLE IF EXISTS `rso_pending`;
CREATE TABLE IF NOT EXISTS `rso_pending` (
  `pending_id` int(11) NOT NULL AUTO_INCREMENT,
  `rso_id` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `mem2` int(11) NOT NULL,
  `mem3` int(11) NOT NULL,
  `mem4` int(11) NOT NULL,
  `mem5` int(11) NOT NULL,
  PRIMARY KEY (`pending_id`),
  KEY `admin` (`admin`),
  KEY `mem2` (`mem2`),
  KEY `mem3` (`mem3`),
  KEY `mem4` (`mem4`),
  KEY `mem5` (`mem5`),
  KEY `rso_id` (`rso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rso_table`
--

DROP TABLE IF EXISTS `rso_table`;
CREATE TABLE IF NOT EXISTS `rso_table` (
  `rso_id` int(11) NOT NULL AUTO_INCREMENT,
  `uni_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `admin` int(11) NOT NULL,
  PRIMARY KEY (`rso_id`),
  KEY `uni_id` (`uni_id`),
  KEY `admin` (`admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `rso_table`
--

INSERT INTO `rso_table` (`rso_id`, `uni_id`, `name`, `admin`) VALUES
(3, 3, 'New RSO', 3),
(6, 3, 'TestaRSO', 6),
(7, 4, 'Non RSO Events', 7);

-- --------------------------------------------------------

--
-- Table structure for table `universities_table`
--

DROP TABLE IF EXISTS `universities_table`;
CREATE TABLE IF NOT EXISTS `universities_table` (
  `uni_id` int(11) NOT NULL AUTO_INCREMENT,
  `uni_name` varchar(45) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL,
  `num_students` int(11) NOT NULL,
  PRIMARY KEY (`uni_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `universities_table`
--

INSERT INTO `universities_table` (`uni_id`, `uni_name`, `location`, `description`, `num_students`) VALUES
(3, 'University of Central Florida', 'Orlando, Florida', 'This is a description of UCF.\r\nGO KNIGHTS!!!', 0),
(4, 'Non RSO University', 'Non RSO University', 'Holds RSO that holds Non RSO Events', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

DROP TABLE IF EXISTS `users_table`;
CREATE TABLE IF NOT EXISTS `users_table` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `uni_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `uni_id` (`uni_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`user_id`, `firstName`, `lastName`, `email`, `uni_id`) VALUES
(1, 'admin', 'user', 'admin@test.com', 3),
(2, 'super', 'admin', 'superadmin@test.com', 3),
(3, 'student', 'user', 'student@test.com', 3),
(4, 'test', 'account', 'test@test.com', 3),
(6, 'Danny', 'Finkelstein', 'danny@test.com', 3),
(7, 'Non', 'Rso', 'nonrsoeventadmin@test.com', 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events_table`
--
ALTER TABLE `events_table`
  ADD CONSTRAINT `events_table_ibfk_1` FOREIGN KEY (`rso_id`) REFERENCES `rso_table` (`rso_id`);

--
-- Constraints for table `non_rso_events_table`
--
ALTER TABLE `non_rso_events_table`
  ADD CONSTRAINT `non_rso_events_table_ibfk_1` FOREIGN KEY (`uni_id`) REFERENCES `universities_table` (`uni_id`);

--
-- Constraints for table `passwords_table`
--
ALTER TABLE `passwords_table`
  ADD CONSTRAINT `passwords_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `privileges_table`
--
ALTER TABLE `privileges_table`
  ADD CONSTRAINT `privileges_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews_table`
--
ALTER TABLE `reviews_table`
  ADD CONSTRAINT `reviews_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`user_id`),
  ADD CONSTRAINT `reviews_table_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events_table` (`event_id`),
  ADD CONSTRAINT `reviews_table_ibfk_3` FOREIGN KEY (`nre_id`) REFERENCES `non_rso_events_table` (`nre_id`);

--
-- Constraints for table `rso_member`
--
ALTER TABLE `rso_member`
  ADD CONSTRAINT `rso_member_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`user_id`),
  ADD CONSTRAINT `rso_member_ibfk_2` FOREIGN KEY (`rso_id`) REFERENCES `rso_table` (`rso_id`);

--
-- Constraints for table `rso_pending`
--
ALTER TABLE `rso_pending`
  ADD CONSTRAINT `rso_pending_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `users_table` (`user_id`),
  ADD CONSTRAINT `rso_pending_ibfk_2` FOREIGN KEY (`mem2`) REFERENCES `users_table` (`user_id`),
  ADD CONSTRAINT `rso_pending_ibfk_3` FOREIGN KEY (`mem3`) REFERENCES `users_table` (`user_id`),
  ADD CONSTRAINT `rso_pending_ibfk_4` FOREIGN KEY (`mem4`) REFERENCES `users_table` (`user_id`),
  ADD CONSTRAINT `rso_pending_ibfk_5` FOREIGN KEY (`mem5`) REFERENCES `users_table` (`user_id`),
  ADD CONSTRAINT `rso_pending_ibfk_6` FOREIGN KEY (`rso_id`) REFERENCES `rso_table` (`rso_id`);

--
-- Constraints for table `rso_table`
--
ALTER TABLE `rso_table`
  ADD CONSTRAINT `rso_table_ibfk_1` FOREIGN KEY (`uni_id`) REFERENCES `universities_table` (`uni_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rso_table_ibfk_2` FOREIGN KEY (`admin`) REFERENCES `users_table` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_table`
--
ALTER TABLE `users_table`
  ADD CONSTRAINT `users_table_ibfk_1` FOREIGN KEY (`uni_id`) REFERENCES `universities_table` (`uni_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
