-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2015 at 07:05 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `techmate15`
--

-- --------------------------------------------------------

--
-- Table structure for table `costdb`
--

CREATE TABLE IF NOT EXISTS `costdb` (
`event_id` int(10) NOT NULL,
  `event_name` varchar(40) NOT NULL,
  `cost` int(3) NOT NULL,
  `group` varchar(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costdb`
--

INSERT INTO `costdb` (`event_id`, `event_name`, `cost`, `group`) VALUES
(32, 'Spell Bound', 30, '1'),
(31, 'Placement Mantra', 40, '1'),
(30, 'Quiz-O-Clock', 50, '2'),
(29, 'Quiz-O-Clock', 30, '1'),
(28, 'Freakenstien', 50, '2'),
(27, 'Freakenstien', 30, '1'),
(26, 'Java Jargons', 50, '2'),
(25, 'Javas Jargons', 30, '1'),
(24, 'Seek() in c', 50, '2'),
(23, 'Seek() in c', 30, '1'),
(22, 'Search Engine Generation', 1000, '1'),
(21, 'NTPP', 180, '3'),
(20, 'NTPP', 130, '2'),
(19, 'NTPP', 70, '1'),
(33, 'Spell Bound', 50, '2'),
(34, 'Next Aim', 40, '1'),
(35, 'Gwiggle', 30, '1'),
(36, 'Gwiggle', 50, '2'),
(37, 'Digital Picasso', 30, '1'),
(38, 'Digital Picasso', 50, '2'),
(39, 'Cric-O-Lumina', 120, '4'),
(40, 'Counter Strike', 250, '5'),
(47, 'Search Engine Generation-rait', 300, '1'),
(42, 'Counter Strike (Reentry)', 300, '5'),
(48, 'Combo-Seek() in C + Java Jargons', 40, '1'),
(44, 'Fifa 11', 50, '1'),
(45, 'Nerf Strike', 50, '1'),
(46, 'Nerf Strike', 100, '2'),
(49, 'Combo-Seek() in C + Java Jargons', 80, '2'),
(50, 'Combo-SpellBound + Freakenstein + Quiz-o', 70, '1'),
(51, 'Combo-SpellBound + Freakenstein + Quiz-o', 130, '2'),
(52, 'Combo-Placement Mantra + Next Aim', 60, '1'),
(53, 'Combo-Gwigle + Digital Picasso', 40, '1'),
(54, 'Combo-Gwigle + Digital Picasso', 80, '2'),
(55, 'Combo-NTPP + Search Engine Generation', 1000, '1');

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE IF NOT EXISTS `entries` (
`entry_id` int(5) NOT NULL,
  `reciept_no` varchar(10) NOT NULL,
  `event_id` int(10) NOT NULL,
  `cost` int(3) NOT NULL,
  `paid` int(3) NOT NULL,
  `balance` int(3) NOT NULL,
  `balance_status` int(1) NOT NULL,
  `balance_entered_by` int(5) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `entered_by` varchar(10) NOT NULL,
  `payed_at` date NOT NULL,
  `balance_payed_at` date NOT NULL,
  `mobile_no` varchar(25) NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `college_name` varchar(50) NOT NULL,
  `c_year` varchar(10) NOT NULL,
  `event_name` varchar(40) NOT NULL,
  `group` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `costdb`
--
ALTER TABLE `costdb`
 ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
 ADD PRIMARY KEY (`entry_id`), ADD UNIQUE KEY `reciept_no` (`reciept_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `costdb`
--
ALTER TABLE `costdb`
MODIFY `event_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
MODIFY `entry_id` int(5) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
