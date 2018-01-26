-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2018 at 02:08 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mralam_anauv`
--

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`subject_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `subject_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_mark` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subject_marks` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `year` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 for disable | 1 for enable'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `name`, `class_id`, `group_id`, `subject_category`, `subject_code`, `total_mark`, `subject_marks`, `teacher_id`, `year`, `status`) VALUES
(1, 'Bangla 1st', 13, 0, 'main', '8f90b', '100', '0|50|50|0', 15, '2017-2018', '1'),
(2, 'Bangla 2nd', 13, 0, 'join', '8f90b', '100', '0|50|50|0', 18, '2017-2018', '1'),
(3, 'English 1st', 13, 0, 'main', '8f90b', '100', '0|100|0|0', 18, '2017-2018', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
 ADD PRIMARY KEY (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
