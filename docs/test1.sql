-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2017 at 07:46 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test1`
--

-- --------------------------------------------------------

--
-- Table structure for table `cateogry`
--

CREATE TABLE IF NOT EXISTS `cateogry` (
  `catid` int(3) NOT NULL AUTO_INCREMENT,
  `parentid` int(3) NOT NULL,
  `catname` varchar(50) NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cateogry`
--

INSERT INTO `cateogry` (`catid`, `parentid`, `catname`) VALUES
(1, 0, 'common'),
(2, 0, 'food'),
(3, 0, 'travel'),
(4, 0, 'general');

-- --------------------------------------------------------

--
-- Table structure for table `exp`
--

CREATE TABLE IF NOT EXISTS `exp` (
  `expid` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `catid` int(10) NOT NULL,
  `description` text NOT NULL,
  `amount` double(10,2) NOT NULL,
  `expdate` date NOT NULL,
  `comment` text,
  `exptype` enum('received','paid','unpaid') NOT NULL DEFAULT 'paid',
  PRIMARY KEY (`expid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `exp`
--

INSERT INTO `exp` (`expid`, `userid`, `catid`, `description`, `amount`, `expdate`, `comment`, `exptype`) VALUES
(1, 1, 1, ' Snacks', 60.00, '2017-02-27', ' ', 'paid'),
(2, 2, 1, 'snacks', 30.00, '2017-02-27', NULL, 'paid'),
(3, 1, 4, 'Xerox of documents', 35.00, '2017-02-27', '', 'paid'),
(4, 1, 1, '27+12+5 milk+sugar+elichi', 44.00, '2017-02-28', '', 'paid'),
(5, 1, 4, '15+6 mith+candle', 21.00, '2017-02-28', '', 'paid'),
(6, 1, 2, 'dinner', 25.00, '2017-02-28', '', 'paid'),
(7, 1, 2, '45 tea+brekfast', 45.00, '2017-03-01', '', 'paid'),
(8, 2, 2, 'milk', 25.00, '2017-03-01', '', 'paid'),
(9, 1, 3, 'petrol', 70.00, '2017-03-01', '', 'paid'),
(10, 1, 2, 'milk', 11.00, '2017-03-02', '', 'paid'),
(11, 1, 4, 'mith', 15.00, '2017-03-02', '', 'paid'),
(12, 1, 2, '35 - lucnh\r\n20+35 - tea', 90.00, '2017-03-02', '', 'paid'),
(13, 1, 2, 'ganesh party', 220.00, '2017-03-02', '', 'paid'),
(14, 1, 2, '70 - lunch\r\n10 - nashta\r\n25 - juice dinner', 105.00, '2017-03-03', '', 'paid'),
(15, 1, 3, '228 - pune-mumbai bus\r\n10 - railway dadar to boriwali\r\n20 riksha', 260.00, '2017-03-04', 'vikrams reception', 'paid'),
(16, 1, 2, 'tea+pani bottle(10+70)', 80.00, '2017-03-04', '50 bottle dhaple', 'paid'),
(17, 1, 4, 'rto fine', 80.00, '2017-03-04', 'fine near nashikphata ', 'paid'),
(18, 1, 3, '100 me +100 harshad petrol', 200.00, '2017-03-04', '', 'paid'),
(19, 1, 3, 'boriwali to pune bus', 233.00, '2017-03-05', 'coming to pune ', 'paid'),
(20, 1, 4, '100 rto fine', 100.00, '2017-03-05', 'fine near shivaji nagar', 'paid'),
(21, 1, 2, '20 - sandwaitch\r\n10 - juice\r\n70 - dinner', 120.00, '2017-03-05', 'vahini gifted nankhatai', 'paid'),
(22, 1, 4, '145 - mith + comb + sctoch scrubber', 145.00, '2017-03-06', '', 'paid'),
(23, 1, 2, ' 30 - nashta\r\n28+10 - milk + tea', 68.00, '2017-03-06', ' ', 'paid'),
(24, 1, 3, 'Given to ganesh petrol country for 27 feb bike nashik to pune', 200.00, '2017-03-06', '', 'paid'),
(25, 1, 2, '     35 + 10 lunch and buttermilk', 45.00, '2017-03-06', ' ', 'unpaid'),
(29, 2, 2, ' 205+60 - chaitanya paratha dinner + jamun shot\r\n', 265.00, '2017-03-06', ' 130 pending to give ganesh', 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`) VALUES
(1, 'sam'),
(2, 'ganesh'),
(3, 'surendra'),
(4, 'home');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
