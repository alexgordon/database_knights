-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2015 at 04:06 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `database_knights_v3`
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
  `name` varchar(45) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(45) NOT NULL,
  `description` varchar(250) NOT NULL,
  `rating` float NOT NULL,
  `rating_count` int(11) NOT NULL,
  `rso_id` int(11) NOT NULL,
  `privateEvent` varchar(45) NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `rso_id` (`rso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `events_table`
--

INSERT INTO `events_table` (`event_id`, `name`, `time`, `location`, `description`, `rating`, `rating_count`, `rso_id`, `privateEvent`) VALUES
(1, 'Test', '2015-04-07 23:47:20', 'Here', 'Test Event!', 0, 0, 6, 'Public'),
(2, 'Test 2', '2015-04-08 21:30:00', 'Over There', 'Here is the description!!!!', 0, 0, 6, 'Public'),
(3, 'Test 3', '2015-04-10 21:30:00', 'Over There', 'Here is the description!!!!', 0, 0, 6, 'Public'),
(4, 'Test 5', '2015-04-14 18:30:00', 'Here', 'Here is a description', 0, 0, 6, 'Public');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `passwords_table`
--

INSERT INTO `passwords_table` (`p_id`, `user_id`, `password`) VALUES
(1, 1, 'test'),
(2, 2, 'test'),
(3, 3, 'test'),
(4, 4, 'test'),
(6, 6, 'test');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `privileges_table`
--

INSERT INTO `privileges_table` (`priv_id`, `user_id`, `privilege_status`) VALUES
(1, 1, 'admin'),
(2, 2, 'super_admin'),
(3, 3, 'student'),
(4, 4, 'student'),
(6, 6, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `reviews_table`
--

DROP TABLE IF EXISTS `reviews_table`;
CREATE TABLE IF NOT EXISTS `reviews_table` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `reviewDate` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  KEY `user_id` (`user_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `rso_member`
--

INSERT INTO `rso_member` (`rel_id`, `user_id`, `rso_id`) VALUES
(1, 3, 3),
(2, 6, 6),
(3, 3, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `rso_table`
--

INSERT INTO `rso_table` (`rso_id`, `uni_id`, `name`, `admin`) VALUES
(3, 3, 'New RSO', 3),
(6, 3, 'TestaRSO', 6);

-- --------------------------------------------------------

--
-- Table structure for table `universities_table`
--

DROP TABLE IF EXISTS `universities_table`;
CREATE TABLE IF NOT EXISTS `universities_table` (
  `uni_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL,
  `num_students` int(11) NOT NULL,
  PRIMARY KEY (`uni_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `universities_table`
--

INSERT INTO `universities_table` (`uni_id`, `name`, `location`, `description`, `num_students`) VALUES
(3, 'University of Central Florida', 'Orlando, Florida', 'This is a description of UCF.\r\nGO KNIGHTS!!!', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`user_id`, `firstName`, `lastName`, `email`, `uni_id`) VALUES
(1, 'admin', 'user', 'admin@test.com', 3),
(2, 'super', 'admin', 'superadmin@test.com', 3),
(3, 'student', 'user', 'student@test.com', 3),
(4, 'test', 'account', 'test@test.com', 3),
(6, 'Danny', 'Finkelstein', 'danny@test.com', 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events_table`
--
ALTER TABLE `events_table`
  ADD CONSTRAINT `events_table_ibfk_1` FOREIGN KEY (`rso_id`) REFERENCES `rso_table` (`rso_id`);

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
  ADD CONSTRAINT `reviews_table_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events_table` (`event_id`);

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
  ADD CONSTRAINT `rso_pending_ibfk_6` FOREIGN KEY (`rso_id`) REFERENCES `rso_table` (`rso_id`),
  ADD CONSTRAINT `rso_pending_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `users_table` (`user_id`),
  ADD CONSTRAINT `rso_pending_ibfk_2` FOREIGN KEY (`mem2`) REFERENCES `users_table` (`user_id`),
  ADD CONSTRAINT `rso_pending_ibfk_3` FOREIGN KEY (`mem3`) REFERENCES `users_table` (`user_id`),
  ADD CONSTRAINT `rso_pending_ibfk_4` FOREIGN KEY (`mem4`) REFERENCES `users_table` (`user_id`),
  ADD CONSTRAINT `rso_pending_ibfk_5` FOREIGN KEY (`mem5`) REFERENCES `users_table` (`user_id`);

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
