-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2014 at 01:35 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `sold_item`
--

CREATE TABLE IF NOT EXISTS `sold_item` (
`id` int(11) NOT NULL,
  `category` varchar(8) NOT NULL,
  `trx_date` date NOT NULL,
  `qty_in` int(11) NOT NULL,
  `qty_sold` int(11) NOT NULL,
  `shop_code` varchar(8) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=67942 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sold_item`
--
ALTER TABLE `sold_item`
 ADD PRIMARY KEY (`id`), ADD KEY `date_sold` (`qty_in`), ADD KEY `category` (`category`), ADD KEY `category_2` (`category`,`qty_in`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sold_item`
--
ALTER TABLE `sold_item`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;