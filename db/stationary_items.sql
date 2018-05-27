-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2018 at 06:00 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mralam_anauv`
--

-- --------------------------------------------------------

--
-- Table structure for table `stationary_items`
--

CREATE TABLE `stationary_items` (
  `stationary_item_id` int(11) NOT NULL,
  `stationary_category_id` int(11) NOT NULL,
  `item_amount` int(11) NOT NULL,
  `item_price` float NOT NULL,
  `item_price_total` int(11) NOT NULL,
  `item_description` text COLLATE utf8_unicode_ci NOT NULL,
  `item_status` int(1) NOT NULL COMMENT '1 for IN | 2 for OUT',
  `item_transaction_date` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stationary_items`
--

INSERT INTO `stationary_items` (`stationary_item_id`, `stationary_category_id`, `item_amount`, `item_price`, `item_price_total`, `item_description`, `item_status`, `item_transaction_date`, `year`) VALUES
(9, 1, 200, 110, 22000, 'book', 2, '1525888800', '2018-2019'),
(8, 1, 500, 100, 50000, 'book', 1, '1525111200', '2018-2019'),
(10, 2, 100, 10, 1000, 'pen', 1, '1525111200', '2018-2019'),
(14, 2, 50, 20, 1000, 'pen', 2, '1527530400', '2018-2019'),
(12, 1, 100, 150, 15000, 'book', 2, '1527616800', '2018-2019'),
(13, 1, 100, 200, 20000, 'book', 2, '1527789600', '2018-2019');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stationary_items`
--
ALTER TABLE `stationary_items`
  ADD PRIMARY KEY (`stationary_item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stationary_items`
--
ALTER TABLE `stationary_items`
  MODIFY `stationary_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
