-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2015 at 05:40 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `events_table`
--

INSERT INTO `events_table` (`event_id`, `e_name`, `time`, `location`, `description`, `rating`, `rating_count`, `rso_id`, `privateEvent`) VALUES
(1, 'Test', '2015-04-07 23:47:20', 'Here', 'Test Event!', 3, 2, 6, 'Public'),
(2, 'Test 2', '2015-04-08 21:30:00', 'Over There', 'Here is the description!!!!', 2, 2, 6, 'Public'),
(3, 'Test 3', '2015-04-10 21:30:00', 'Over There', 'Here is the description!!!!', 0, 0, 6, 'Public'),
(4, 'Test 5', '2015-04-14 18:30:00', 'Here', 'Here is a description', 0, 0, 6, 'Public'),
(5, 'UCF Only Event', '2015-04-10 08:30:00', '4000 Central Florida Blvd, Orlando, FL 32816', 'This is a UCF only event', 0, 0, 3, 'Private'),
(6, 'Tech Talk', '2015-04-12 15:00:00', '777 E Princeton St, Orlando, FL 32803', 'This will be a tech talk at the Science Center', 4, 2, 3, 'Public'),
(7, 'Tech Talk #2', '2015-04-12 15:00:00', '777 E Princeton St, Orlando, FL 32803', 'This will be a tech talk at the Science Center', 5, 1, 3, 'Public'),
(8, 'Jack and the Box', '2015-12-30 23:59:00', '2220 Chester Ave Bakersfield, CA', 'Description', 0, 0, 7, 'Public_pending_3'),
(9, 'New RSO event', '2015-04-16 17:00:00', '4000 Central Florida Blvd, Orlando, FL 32816', 'Lorem ipsum dolor sit amet, suscipit molestiae efficiendi cum id. Tale essent quaerendum ne cum, no erant aperiri vim, ne paulo epicuri maiestatis vel. Ne nibh regione sit, cu latine percipitur mea, eu iriure aliquando nam. Id usu denique epicurei re', 0, 0, 3, 'RSO Event'),
(10, 'Basketball Game', '2015-04-17 16:00:00', '600 W College Ave, Tallahassee, FL 32306', 'This will be a basketball game that will feature some of the best players from FSU.  All members of the rso should come watch!!', 0, 0, 8, 'RSO Event'),
(11, 'FSU Men vs. Women', '2015-04-22 20:00:00', '600 W College Ave, Tallahassee, FL 32306', 'This will be a basketball game that will be hosted for FSU students only.', 0, 0, 8, 'Private'),
(12, 'Car Wash', '2015-04-20 10:00:00', '600 W College Ave, Tallahassee, FL 32306', 'This will be a fundraising event for the RSO.  Please come and support the FSU basketball club', 0, 0, 8, 'Public');

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
  `nre_user_id` int(11) NOT NULL,
  PRIMARY KEY (`nre_id`),
  KEY `uni_id` (`uni_id`),
  KEY `nre_user_id` (`nre_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `non_rso_events_table`
--

INSERT INTO `non_rso_events_table` (`nre_id`, `nre_name`, `nre_time`, `nre_location`, `nre_description`, `nre_rating`, `nre_rating_count`, `nre_privateEvent`, `uni_id`, `nre_user_id`) VALUES
(2, 'Jack and the Box', '2015-10-29 23:59:00', '2220 Chester Ave Bakersfield, CA', 'This will work', 0, 0, 'Private', 3, 9),
(3, 'Chess Tournament', '2015-04-18 13:00:00', '600 W College Ave, Tallahassee, FL 32306', 'There will be a chess tournament that will be open to any university that wishes to come.  This will be a friendly match, therefore there will be no money involved!', 0, 0, 'Public', 5, 20),
(6, 'Database Knights Demo', '2015-04-21 13:30:00', '4000 Central Florida Blvd, Orlando, FL 32816', 'This will be a demo of the website, Database Knights.', 0, 0, 'Public', 3, 6),
(8, 'Graduation', '2015-05-07 08:00:00', '4000 Central Florida Blvd, Orlando, FL 32816', 'This is the graduation date for computer science majors!!', 0, 0, 'Public_pending', 3, 6),
(9, 'A UCF Soical', '2015-04-17 16:00:00', '4000 Central Florida Blvd, Orlando, FL 32816', 'This is a social for ucf students only.  Please bring a student ID if you want to enter.  The social will be located in the Pegasus Ballroom.', 0, 0, 'Private_pending', 3, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `passwords_table`
--

INSERT INTO `passwords_table` (`p_id`, `user_id`, `password`) VALUES
(1, 1, 'test'),
(2, 2, 'test'),
(3, 3, 'test'),
(4, 4, 'test'),
(6, 6, 'test'),
(7, 7, 'test'),
(8, 8, 'test'),
(9, 9, 'test'),
(10, 10, 'test'),
(11, 11, 'test'),
(12, 12, 'test'),
(13, 13, 'test'),
(14, 14, 'test'),
(15, 15, 'test'),
(16, 16, 'test'),
(17, 17, 'test'),
(18, 18, 'test'),
(19, 19, 'test'),
(20, 20, 'test'),
(21, 21, 'test');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `privileges_table`
--

INSERT INTO `privileges_table` (`priv_id`, `user_id`, `privilege_status`) VALUES
(1, 1, 'admin'),
(2, 2, 'super_admin'),
(3, 3, 'student'),
(4, 4, 'student'),
(6, 6, 'student'),
(7, 7, 'student'),
(8, 8, 'student'),
(9, 9, 'student'),
(10, 10, 'student'),
(11, 11, 'student'),
(12, 12, 'student'),
(13, 13, 'student'),
(14, 14, 'student'),
(15, 15, 'student'),
(16, 16, 'student'),
(17, 17, 'student'),
(18, 18, 'student'),
(19, 19, 'student'),
(20, 20, 'student'),
(21, 21, 'student');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

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
(10, 3, 2, 'Does this work or explode', 1, 'April 12th 2015 07:03:15 PM', NULL),
(11, 3, 9, 'I am adding a comment', NULL, 'April 15th 2015 12:06:01 AM', NULL),
(12, 3, 9, 'Another comment is added', NULL, 'April 15th 2015 12:09:42 AM', NULL),
(13, 3, 9, 'Lorem ipsum dolor sit amet, suscipit molestiae efficiendi cum id. Tale essent quaerendum ne cum, no erant aperiri vim, ne paulo epicuri maiestatis vel. Ne nibh regione sit, cu latine percipitur mea, e', NULL, 'April 15th 2015 12:09:52 AM', NULL),
(14, 3, 6, 'This was an average event', 3, 'April 15th 2015 12:34:06 AM', NULL),
(15, 6, NULL, 'Where is jack and the box?', NULL, 'April 16th 2015 12:03:14 AM', 2),
(16, 3, 6, 'This tech talk really inspired me!!', 5, 'April 16th 2015 02:54:19 AM', NULL),
(17, 3, NULL, 'I would like to play chess, does anyone want to play against me?', NULL, 'April 16th 2015 03:04:38 AM', 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `rso_member`
--

INSERT INTO `rso_member` (`rel_id`, `user_id`, `rso_id`) VALUES
(1, 3, 3),
(2, 6, 6),
(3, 3, 6),
(7, 4, 3),
(8, 7, 7),
(13, 4, 6),
(14, 20, 8),
(15, 15, 8),
(16, 16, 8),
(17, 17, 8),
(18, 18, 8),
(19, 11, 3),
(20, 3, 12),
(21, 8, 12),
(22, 9, 12),
(23, 10, 12),
(24, 11, 12),
(25, 3, 13),
(26, 8, 13),
(27, 10, 13),
(28, 6, 13),
(29, 11, 13);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `rso_pending`
--

INSERT INTO `rso_pending` (`pending_id`, `rso_id`, `admin`, `mem2`, `mem3`, `mem4`, `mem5`) VALUES
(3, 10, 6, 3, 9, 11, 8),
(4, 11, 6, 4, 10, 13, 14);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `rso_table`
--

INSERT INTO `rso_table` (`rso_id`, `uni_id`, `name`, `admin`) VALUES
(3, 3, 'New RSO', 3),
(6, 3, 'TestaRSO', 6),
(7, 4, 'Non RSO Events', 7),
(8, 5, 'FSU Basketball Club', 20),
(10, 3, 'Math Club', 6),
(11, 3, '4Ever Knights', 6),
(12, 3, 'UCF Powerlifting', 3),
(13, 3, 'UCF Pottery Club', 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `universities_table`
--

INSERT INTO `universities_table` (`uni_id`, `uni_name`, `location`, `description`, `num_students`) VALUES
(3, 'University of Central Florida', 'Orlando, Florida', 'This is a description of UCF.\r\nGO KNIGHTS!!!', 14),
(4, 'Non RSO University', 'Non RSO University', 'Holds RSO that holds Non RSO Events', 1),
(5, 'Florida State University', '600 W College Ave, Tallahassee, FL 32306', 'The Florida State University is a space-grant and sea-grant public research university located on a 474.5-acre campus in the state capital city of Tal', 5),
(6, 'University of Florida', 'Gainesville, FL 32611', 'The University of Florida is an American public land-grant, sea-grant, and space-grant research university located on a 2,000-acre campus in North Cen', 0),
(7, 'University of Miami', '1320 S Dixie Hwy, Coral Gables, FL 33124', 'The University of Miami is a private, nonsectarian university located in Coral Gables, Florida, United States', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`user_id`, `firstName`, `lastName`, `email`, `uni_id`) VALUES
(1, 'admin', 'user', 'admin@test.com', 3),
(2, 'super', 'admin', 'superadmin@test.com', 3),
(3, 'Jonny', 'Smith', 'jon.smith@knights.ucf.edu', 3),
(4, 'test', 'account', 'test@knights.ucf.edu', 3),
(6, 'Danny', 'Finkelstein', 'danny@knights.ucf.edu', 3),
(7, 'Non', 'Rso', 'nonrsoeventadmin@test.com', 4),
(8, 'Angela', 'Abraham', 'angela.abraham@knights.ucf.edu', 3),
(9, 'Jacob', 'Knox', 'jacob.knox@knights.ucf.edu', 3),
(10, 'Claire', 'Nolan', 'claire.nolan@knights.ucf.edu', 3),
(11, 'Simon', 'Langdon', 'simon.langdon@knights.ucf.edu', 3),
(12, 'Connor', 'Edmunds', 'connor.edmunds@knights.ucf.edu', 3),
(13, 'Wanda', 'Paterson', 'wanda.paterson@knights.ucf.edu', 3),
(14, 'Stephen', 'Allan', 'stephen.allan@knights.ucf.edu', 3),
(15, 'Natalie', 'Parsons', 'natalie.parsons@fsu.edu', 5),
(16, 'Trevor', 'Young', 'trevor.young@fsu.edu', 5),
(17, 'Carl', 'Simpson', 'carl.simpson@fsu.edu', 5),
(18, 'Amelia', 'Parr', 'amelia.parr@fsu.edu', 5),
(19, 'Paul', 'Smith', 'paul.smith@fsu.edu', 3),
(20, 'Phil', 'Forsyth', 'phil.forsyth@fsu.edu', 5),
(21, 'Jon', 'Smithy', 'jon.smithy@knights.ucf.edu', 3);

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
  ADD CONSTRAINT `non_rso_events_table_ibfk_2` FOREIGN KEY (`nre_user_id`) REFERENCES `users_table` (`user_id`),
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
