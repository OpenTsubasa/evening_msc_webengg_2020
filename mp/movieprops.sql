-- phpMyAdmin SQL Dump
-- version 4.4.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2015 at 01:49 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `movieprops`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `cid` int(11) unsigned NOT NULL,
  `cname` varchar(255) NOT NULL,
  `cemail` varchar(255) NOT NULL,
  `cpassword` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cid`, `cname`, `cemail`, `cpassword`) VALUES
(1, 'Mr. A', 'abc@xyz.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'Mr. B', 'def@xyz.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(3, 'Mr. C', 'ghi@xyz.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(4, 'Mr. D', 'jkl@xyz.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(5, 'Mr. X', 'mno@xyz.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE IF NOT EXISTS `movie` (
  `mid` int(11) unsigned NOT NULL,
  `mname` varchar(255) NOT NULL,
  `myear` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`mid`, `mname`, `myear`) VALUES
(1, 'Dredd', 2012),
(2, 'Stargate Atlantis', 2009),
(3, 'Killing Season', 2013),
(4, 'GI Joe-The Rise of Cobra', 2009),
(5, 'Ender-s Game', 2013),
(6, 'Tomb Raider-The Cradle of Life', 2003),
(7, 'Warlords of Atlantis', 1978),
(8, 'Man In The Iron Mask', 1998),
(9, '101 Dalmatians', 1996),
(10, 'Chronicles Of Narnia-Prince Caspian', 2008),
(11, 'X-Men', 2000),
(12, 'Pirates-Adventure with Scientists', 2012),
(13, 'Kingdom Of Heaven', 2005),
(14, 'Little Buddha', 1993),
(15, 'Galaxy Quest', 1999),
(16, 'Dracula 2000', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `pid` int(11) unsigned NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pcost` int(11) NOT NULL,
  `pavailability` int(1) NOT NULL,
  `paddingdate` date NOT NULL,
  `pphoto` varchar(255) NOT NULL,
  `mid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `pname`, `pcost`, `pavailability`, `paddingdate`, `pphoto`, `mid`) VALUES
(1, 'Anderson (Olivia Thirlby) Hero Badge', 1342, 1, '2015-04-12', 'Anderson Hero Badge.jpg', 1),
(2, 'Asuran Central Data Core', 3245, 1, '2015-04-12', 'Asuran Central Data Core.jpg', 2),
(3, 'Ben-s (Robert De Niro) Silver Star Medal', 1225, 1, '2015-04-13', 'Ben-s Silver Star Medal.jpg', 3),
(4, 'Destro-s (Christopher Eccleston) Hero Flamethrower', 2326, 1, '2015-04-15', 'Destro-s Hero Flamethrower.jpg', 4),
(5, 'Ender-s Game - Stunt Resin Flash Gun', 2235, 1, '2015-04-15', 'Stunt Resin Flash Gun.jpg', 5),
(6, 'Fibreglass Terracotta Army Head', 2500, 1, '2015-04-17', 'Fibreglass Terracotta Army Head.jpg', 6),
(7, 'Full-Size Diving Bell', 5565, 1, '2015-04-18', 'Full-Size Diving Bell.jpg', 7),
(8, 'Hero Iron Mask', 3425, 1, '2015-04-18', 'Hero Iron Mask.jpg', 8),
(9, 'Mansion Decoration', 1699, 1, '2015-04-18', 'Mansion Decoration.jpg', 9),
(10, 'Original Minotaur Costume Display', 4555, 1, '2015-04-18', 'Original Minotaur Costume Display.jpg', 10),
(11, 'Prototype Cyclops (James Marsden) Visor', 2095, 1, '2015-04-19', 'Prototype Cyclops Visor.jpg', 11),
(12, 'Royal Society Plato Bust & Plinth Set', 1245, 1, '2015-04-19', 'Royal Society Plato Bust-Plinth Set.jpg', 12),
(13, 'Silver Coloured Engraved Shield', 1879, 1, '2015-04-20', 'Silver Coloured Engraved Shield.jpg', 13),
(14, 'Temptation Girl (Kavita Hahat) Sari-Top-Skirt', 899, 1, '2015-04-21', 'Temptation Girl Sari-Top-Skirt.jpg', 14),
(15, 'Thermian Docking Bay Miniature', 3555, 1, '2015-04-22', 'Thermian Docking Bay Miniature.jpg', 15),
(16, 'Van Helsing-s (Christopher Plummer) Decapitated Head', 3995, 1, '2015-04-22', 'Van Helsing-s Decapitated Head.jpg', 16);

-- --------------------------------------------------------

--
-- Table structure for table `productcustomer`
--

CREATE TABLE IF NOT EXISTS `productcustomer` (
  `pid` int(11) unsigned NOT NULL,
  `cid` int(11) unsigned NOT NULL,
  `pcdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productcustomer`
--

INSERT INTO `productcustomer` (`pid`, `cid`, `pcdate`) VALUES
(1, 1, '2015-04-30'),
(1, 2, '2015-04-23'),
(2, 1, '2015-04-24'),
(2, 3, '2015-04-23'),
(3, 1, '2015-04-24'),
(3, 3, '2015-04-23'),
(3, 5, '2015-04-24'),
(5, 1, '2015-04-23'),
(6, 1, '2015-04-24'),
(7, 2, '2015-04-23'),
(8, 1, '2015-04-24'),
(9, 2, '2015-04-23'),
(12, 2, '2015-04-23'),
(16, 5, '2015-04-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `productcustomer`
--
ALTER TABLE `productcustomer`
  ADD PRIMARY KEY (`pid`,`cid`),
  ADD KEY `cid` (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cid` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `mid` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `movie` (`mid`);

--
-- Constraints for table `productcustomer`
--
ALTER TABLE `productcustomer`
  ADD CONSTRAINT `productcustomer_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`),
  ADD CONSTRAINT `productcustomer_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `customer` (`cid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
