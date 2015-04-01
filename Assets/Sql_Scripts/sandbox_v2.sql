-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2015 at 05:11 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sandbox`
--
CREATE DATABASE IF NOT EXISTS `sandbox` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sandbox`;

-- --------------------------------------------------------

--
-- Table structure for table `commentstable`
--

DROP TABLE IF EXISTS `commentstable`;
CREATE TABLE IF NOT EXISTS `commentstable` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `commentDate` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`c_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `commentstable`
--

INSERT INTO `commentstable` (`c_id`, `user_id`, `comment`, `commentDate`) VALUES
(40, 15, 'Lorem ipsum dolor sit amet, ei vim vero integre. Cu vulputate concludaturque nam, id vel justo mandamus molestiae. Pri nusquam definitionem ad. Cu saepe dolorum vix, eos te quod reque persius.', 'March 24th 2015 12:05:55 AM'),
(41, 15, 'Eros dicit cetero in mea, reque nostrud consequuntur duo ut. An his accusam vivendum, sea eu doctus tacimates. Soluta eirmod utamur at vix. Choro definitionem at mei, qui et harum pertinacia, eius aeterno in eos. Eum errem accusam praesent no, in mei grae', 'March 24th 2015 12:06:25 AM'),
(42, 15, 'Oratio mentitum eu duo, quas dicam elaboraret eam te, te nostrum mentitum percipit pro. Mea detraxit comprehensam ne. Sit mundi facilisis cu, vim id numquam omittantur. Vix albucius molestie iudicabit ad, tempor corrumpit pertinacia ne his.', 'March 24th 2015 12:06:39 AM'),
(43, 15, 'Mel quot fastidii appareat at. Ei pro populo virtute vocibus, sed regione aperiam signiferumque no. Erant habemus assueverit an cum. Mea at summo oblique. Cum erat sale albucius ut, dolore corpora appetere vis ei.', 'March 24th 2015 12:06:54 AM'),
(44, 15, 'No falli ocurreret vix, qui eu ignota eruditi contentiones. Quem torquatos mediocritatem mel ea, nam in detraxit volutpat. His oporteat percipitur at. Vis mucius labitur percipitur ad, nonumy possit possim te est.', 'March 24th 2015 12:07:03 AM');

-- --------------------------------------------------------

--
-- Table structure for table `passwordtable`
--

DROP TABLE IF EXISTS `passwordtable`;
CREATE TABLE IF NOT EXISTS `passwordtable` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `passcode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `passwordtable`
--

INSERT INTO `passwordtable` (`p_id`, `user_id`, `passcode`) VALUES
(8, 14, 'ggg'),
(9, 15, 'secret'),
(10, 16, 'test'),
(12, 18, 'test'),
(13, 19, 'test'),
(14, 20, 'test'),
(16, 22, 'test'),
(17, 23, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `privilegestable`
--

DROP TABLE IF EXISTS `privilegestable`;
CREATE TABLE IF NOT EXISTS `privilegestable` (
  `priv_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `privilege_status` varchar(255) NOT NULL,
  PRIMARY KEY (`priv_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `privilegestable`
--

INSERT INTO `privilegestable` (`priv_id`, `user_id`, `privilege_status`) VALUES
(1, 14, 'student'),
(2, 15, 'student'),
(3, 16, 'student'),
(4, 18, 'student'),
(5, 19, 'student'),
(6, 20, 'student'),
(7, 22, 'super_admin'),
(8, 23, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

DROP TABLE IF EXISTS `usertable`;
CREATE TABLE IF NOT EXISTS `usertable` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`user_id`, `firstName`, `lastName`, `email`) VALUES
(14, 'alex', 'gordon', 'ag@gmail.com'),
(15, 'Alex', 'Gordon', 'gordon@test.com'),
(16, 'Test', 'Dummy', 'test@dummy.com'),
(18, 'New', 'Person', 'newperson@test.com'),
(19, 'Shayne', 'Linhart', 'shayne@test.com'),
(20, 'New', 'User', 'newuser@test.com'),
(22, 'super', 'admin', 'superadmin@test.com'),
(23, 'admin', 'account', 'admin@test.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentstable`
--
ALTER TABLE `commentstable`
  ADD CONSTRAINT `commentstable_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usertable` (`user_id`);

--
-- Constraints for table `passwordtable`
--
ALTER TABLE `passwordtable`
  ADD CONSTRAINT `passwordtable_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usertable` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `privilegestable`
--
ALTER TABLE `privilegestable`
  ADD CONSTRAINT `privilegestable_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usertable` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
