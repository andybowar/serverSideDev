-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 24, 2017 at 07:38 PM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `analytics`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `action_id` int(6) NOT NULL,
  `actionName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`action_id`, `actionName`) VALUES
(1, 'clicked home button'),
(2, 'tapped ''compose'''),
(3, 'view inbox'),
(4, 'took photo'),
(5, 'changed camera type'),
(6, 'dismissed notification'),
(7, 'increased screen brightness'),
(8, 'changed ringtone'),
(9, '');

-- --------------------------------------------------------

--
-- Table structure for table `analytic`
--

CREATE TABLE IF NOT EXISTS `analytic` (
  `device_id` int(6) DEFAULT NULL,
  `cat_id` int(6) DEFAULT NULL,
  `action_id` int(6) DEFAULT NULL,
  `num_events` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analytic`
--

INSERT INTO `analytic` (`device_id`, `cat_id`, `action_id`, `num_events`) VALUES
(1, 1, 2, 12),
(1, 2, 1, 12),
(1, 1, 2, 12),
(1, 6, 4, 12),
(1, 5, 6, 12),
(2, 1, 2, 12),
(2, 2, 1, 12),
(2, 1, 2, 12),
(2, 6, 4, 12),
(2, 5, 6, 12),
(3, 1, 2, 12),
(3, 2, 1, 12),
(3, 1, 2, 12),
(3, 6, 4, 12),
(3, 5, 6, 12),
(4, 1, 2, 12),
(4, 2, 1, 12),
(4, 1, 2, 12),
(4, 6, 4, 12),
(4, 5, 6, 12),
(5, 1, 2, 12),
(5, 2, 1, 12),
(5, 1, 2, 12),
(5, 6, 4, 12),
(5, 5, 6, 12),
(6, 1, 2, 12),
(6, 2, 1, 12),
(6, 1, 2, 12),
(6, 6, 4, 12),
(6, 5, 6, 12),
(7, 1, 2, 12),
(7, 2, 1, 12),
(7, 1, 2, 12),
(7, 6, 4, 12),
(7, 5, 6, 12),
(4, 1, 2, 12),
(4, 2, 1, 12),
(4, 1, 2, 12),
(4, 6, 4, 12),
(4, 5, 6, 12),
(9, 1, 2, 12),
(9, 2, 1, 12),
(9, 1, 2, 12),
(9, 6, 4, 12),
(9, 5, 6, 12),
(10, 1, 2, 12),
(10, 2, 1, 12),
(10, 1, 2, 12),
(10, 6, 4, 12),
(10, 5, 6, 12),
(4, 1, 2, 12),
(4, 2, 1, 12),
(4, 1, 2, 12),
(4, 6, 4, 12),
(4, 5, 6, 12),
(12, 1, 2, 12),
(12, 2, 1, 12),
(12, 1, 2, 12),
(12, 6, 4, 12),
(12, 5, 6, 12),
(4, 1, 2, 12),
(4, 2, 1, 12),
(4, 1, 2, 12),
(4, 6, 4, 12),
(4, 5, 6, 12),
(14, 1, 2, 12),
(14, 2, 1, 12),
(14, 1, 2, 12),
(14, 6, 4, 12),
(14, 5, 6, 12),
(15, 1, 2, 12),
(15, 2, 1, 12),
(15, 1, 2, 12),
(15, 6, 4, 12),
(15, 5, 6, 12);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(6) NOT NULL,
  `catName` varchar(25) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `catName`) VALUES
(1, 'Email'),
(2, 'Calendar'),
(3, 'Web Browser'),
(4, 'Settings'),
(5, 'Notifications'),
(6, 'Camera'),
(7, ''),
(8, '');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `device_id` int(6) NOT NULL,
  `make` varchar(25) DEFAULT NULL,
  `model` varchar(25) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`device_id`, `make`, `model`) VALUES
(1, 'Samsung', 'Galaxy S6'),
(2, 'Samsung', 'Galaxy S7'),
(3, 'Google', 'Nexus'),
(4, '', ''),
(5, 'HTC', 'One'),
(6, 'Google', 'Pixel'),
(7, 'Apple', 'iPhone SE'),
(8, '', ''),
(9, 'Apple', 'iPhone 7 Plus'),
(10, 'Apple', 'iPad Mini 2'),
(11, '', ''),
(12, 'Motorola', 'Moto'),
(13, '', ''),
(14, 'Apple', 'iPhone 5'),
(15, 'LG', 'Tribute');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`device_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
  MODIFY `action_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `device_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
