-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 10, 2012 at 04:06 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `intermediary`
--

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employe`
--

CREATE TABLE IF NOT EXISTS `employe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `dob` date NOT NULL,
  `pob` varchar(128) NOT NULL,
  `address` text NOT NULL,
  `occupation` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `hm` varchar(11) NOT NULL,
  `hp` varchar(11) NOT NULL,
  `hj` varchar(11) NOT NULL,
  `total` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `cat` varchar(11) NOT NULL,
  `sup` varchar(11) NOT NULL,
  `sync_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `code`, `name`, `hm`, `hp`, `hj`, `total`, `stock`, `cat`, `sup`, `sync_time`) VALUES
(1, '0731201110', 'PW KM LE''ZUWA 3MDL', '1440000', '40000', '62900', 0, 0, '073', 'L046', 1345691855),
(2, '0701200184', 'PW BLR HK 3181', '510000', '42500', '65900', 0, 0, '070', 'C009', 1345691855),
(3, '0721200976', 'PW KS BELLE 6837', '1548000', '21500', '32900', 0, 0, '072', 'L002', 1345691855),
(4, '0721200977', 'PW KS BELLE 8235', '648000', '27000', '42900', 0, 0, '072', 'L002', 1345691855),
(5, '0721200975', 'PW KS ISCLUB 5MTF', '1380000', '23000', '35900', 0, 0, '072', 'I017', 1345691855),
(6, '0721200984', 'PW KS GES 8803', '504000', '42000', '65900', 0, 0, '072', 'G026', 1345691855),
(7, '0731201114', 'PW KM MOOD 83', '456000', '38000', '59900', 0, 0, '073', 'C007', 1345691855);

-- --------------------------------------------------------

--
-- Table structure for table `item_distribution`
--

CREATE TABLE IF NOT EXISTS `item_distribution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_code` varchar(11) NOT NULL,
  `dist_code` varchar(11) NOT NULL,
  `item_code` varchar(11) NOT NULL,
  `dist_date` date NOT NULL,
  `qty` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `store_code` (`store_code`,`dist_code`,`item_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `item_distribution`
--

INSERT INTO `item_distribution` (`id`, `store_code`, `dist_code`, `item_code`, `dist_date`, `qty`, `status`) VALUES
(1, '11', 'NB12-0292', '0731201110', '2012-04-20', 3, 0),
(2, '11', 'NB12-0292', '0701200184', '2012-04-20', 3, 0),
(3, '11', 'NB12-0292', '0721200976', '2012-04-20', 6, 0),
(4, '11', 'NB12-0292', '0721200977', '2012-04-20', 3, 0),
(5, '11', 'NB12-0292', '0721200975', '2012-04-20', 6, 0),
(6, '11', 'NB12-0292', '0721200984', '2012-04-20', 3, 0),
(7, '11', 'NB12-0292', '0731201114', '2012-04-20', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_lost`
--

CREATE TABLE IF NOT EXISTS `item_lost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_code` varchar(11) NOT NULL,
  `item_code` varchar(11) NOT NULL,
  `date` date NOT NULL,
  `price` varchar(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `store_code` (`store_code`,`item_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `item_retur`
--

CREATE TABLE IF NOT EXISTS `item_retur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `retur_id` varchar(32) NOT NULL,
  `store_code` varchar(11) NOT NULL,
  `item_code` varchar(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `retur_id` (`retur_id`,`store_code`,`item_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_code` varchar(11) NOT NULL,
  `kassa` int(11) NOT NULL,
  `sale_date` date NOT NULL,
  `sales_id` varchar(128) NOT NULL,
  `amount` varchar(11) NOT NULL,
  `disc` varchar(11) NOT NULL,
  `cc` varchar(16) NOT NULL,
  `teller_id` varchar(128) NOT NULL,
  `clerk_id` varchar(128) NOT NULL,
  `sync_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `store_code` (`store_code`,`sales_id`),
  KEY `teller_id` (`teller_id`,`clerk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE IF NOT EXISTS `sale_items` (
  `id` int(11) NOT NULL,
  `item_code` varchar(128) NOT NULL,
  `qty` int(11) NOT NULL,
  `disc` varchar(11) NOT NULL,
  KEY `id` (`id`),
  KEY `item_code` (`item_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE IF NOT EXISTS `store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(11) NOT NULL,
  `alias` varchar(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `addres` text NOT NULL,
  `phone` varchar(16) NOT NULL,
  `supervisor` varchar(128) NOT NULL,
  `cat` varchar(128) NOT NULL,
  `deleted` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `store_ip`
--

CREATE TABLE IF NOT EXISTS `store_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_code` varchar(16) NOT NULL,
  `name` varchar(128) NOT NULL,
  `current_ip` varchar(32) NOT NULL,
  `last_updated` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `store_code` (`store_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `store_ip`
--

INSERT INTO `store_ip` (`id`, `store_code`, `name`, `current_ip`, `last_updated`) VALUES
(2, '17', 'Mode Fashion Perbaungan', '152.118.31.168', 1349776386);

-- --------------------------------------------------------

--
-- Table structure for table `store_items`
--

CREATE TABLE IF NOT EXISTS `store_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_code` varchar(11) NOT NULL,
  `item_code` varchar(11) NOT NULL,
  `total` int(11) NOT NULL,
  `init_stock` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `opname_stock` int(11) NOT NULL,
  `item_in` int(11) NOT NULL,
  `item_sold` int(11) NOT NULL,
  `disc` varchar(11) NOT NULL,
  `total_sold` int(11) NOT NULL,
  `sync_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `store_code` (`store_code`,`item_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `passwd` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL,
  `updated_time` int(11) NOT NULL,
  `last_login_time` int(11) NOT NULL,
  `login_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `passwd`, `status`, `created_time`, `updated_time`, `last_login_time`, `login_status`) VALUES
(1, 'admin', '7096da3e640c166554d4c422c1f58c96b643bb48', 0, 1323153616, 0, 1323229873, 0),
(2, 'purwa', '7096da3e640c166554d4c422c1f58c96b643bb48', 1, 1323156186, 0, 1349774066, 1),
(3, 'perbaungan', '02921880aaf8c133152f4b65335724b9b26f94d1', 1, 1323229808, 0, 1323230230, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
