-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2017 at 10:29 AM
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
-- Table structure for table `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `blog_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(100) NOT NULL,
  `blog_description` text,
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

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
(25, 1, 2, ' 35 + 10 lunch and buttermilk', 45.00, '2017-03-06', ' paid on 8 march', 'paid'),
(29, 2, 2, ' 205+60 - chaitanya paratha dinner + jamun shot\r\n', 265.00, '2017-03-06', ' 130 pending to give ganesh', 'unpaid'),
(30, 1, 2, ' lunch', 35.00, '2017-03-07', ' paid on 8 march', 'paid'),
(31, 2, 1, '  milk', 25.00, '2017-03-07', ' ', 'paid'),
(32, 2, 1, '  milk', 25.00, '2017-03-08', ' ', 'paid'),
(33, 1, 2, '  juice', 25.00, '2017-03-07', ' ', 'paid'),
(34, 2, 1, ' milk', 11.00, '2017-03-09', ' ', 'paid'),
(35, 2, 2, ' total 120 - anda bhruji+sprite. 53 ', 53.00, '2017-03-08', ' ', 'unpaid'),
(36, 1, 2, ' lunch', 50.00, '2017-03-08', ' ', 'paid'),
(37, 1, 2, ' lunch', 35.00, '2017-03-09', ' ', 'unpaid'),
(38, 1, 2, ' Lunch ofc given to vinod (50+50 datta)', 100.00, '2017-03-10', ' ', 'paid'),
(39, 1, 2, ' Dinner', 55.00, '2017-03-10', ' ', 'paid'),
(40, 1, 2, ' Juice', 25.00, '2017-03-10', ' ', 'paid'),
(41, 1, 3, ' Petrol pune to nasik', 400.00, '2017-03-11', ' ', 'paid'),
(42, 1, 2, ' nashta traveling', 70.00, '2017-03-11', ' ', 'paid'),
(43, 1, 2, ' pedha ghargaon', 240.00, '2017-03-11', ' ', 'paid'),
(44, 1, 4, ' fruits at home', 100.00, '2017-03-12', ' nashik exp', 'paid'),
(45, 1, 4, ' Discover battery ', 1100.00, '2017-03-12', ' nashik exp', 'paid'),
(46, 1, 4, ' bike washing', 50.00, '2017-03-12', ' nashik exp', 'paid'),
(47, 1, 3, ' petrol nashik to pune ', 350.00, '2017-03-13', ' bike km starting 41080.0\r\n', 'paid'),
(48, 1, 2, ' nashta', 50.00, '2017-03-13', ' ', 'paid'),
(49, 1, 1, ' tea powder', 38.00, '2017-03-13', ' ', 'paid'),
(50, 1, 2, ' milk etc', 14.00, '2017-03-13', ' ', 'paid'),
(51, 1, 4, ' 20+20 toothbrush tea', 40.00, '2017-03-14', ' ', 'paid'),
(52, 3, 4, ' Dinesh ', 50.00, '2017-03-14', ' ', 'paid'),
(53, 1, 2, ' lunch', 35.00, '2017-03-14', ' ', 'unpaid'),
(54, 2, 2, ' dinner ganesh paid ', 263.00, '2017-03-14', ' non veg', 'unpaid'),
(55, 1, 1, ' milk', 21.00, '2017-03-15', ' ', 'paid'),
(56, 1, 2, ' tea+candle+paper', 20.00, '2017-03-15', ' ', 'paid'),
(57, 1, 2, ' lunch', 70.00, '2017-03-15', ' ', 'unpaid'),
(58, 3, 4, ' Rent for February and 2000 deposit ', 4000.00, '2017-02-24', ' ', 'paid'),
(59, 3, 4, ' rent for march 1000 deducted for dinner removal', 5000.00, '2017-03-09', ' neft transfer', 'paid'),
(60, 1, 4, ' SBI credit card bill payment', 1171.00, '2017-03-15', ' ', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `lang_vars`
--

CREATE TABLE IF NOT EXISTS `lang_vars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lbl` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `lang_id` int(2) NOT NULL,
  `lbl_category` enum('general','system','menu') NOT NULL DEFAULT 'general',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `lang_vars`
--

INSERT INTO `lang_vars` (`id`, `lbl`, `msg`, `lang_id`, `lbl_category`) VALUES
(1, 'custom_lbl1', 'Custom message 1 !!!', 1, 'general'),
(2, 'custom_lbl2', 'Custom message 2 !!!', 1, 'general'),
(3, 'custom_lbl3', 'Custom message 1 !!!', 1, 'general'),
(4, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(5, 'custom_lbl5', 'Custom message 1 !!!', 1, 'general'),
(6, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(7, 'custom_lbl7', 'Custom message 1 !!!', 1, 'general'),
(8, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(9, 'custom_lbl9', 'Custom message 1 !!!', 1, 'general'),
(10, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(11, 'custom_lbl11', 'Custom message 1 !!!', 1, 'general'),
(12, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(13, 'custom_lbl13', 'Custom message 1 !!!', 1, 'general'),
(14, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(15, 'custom_lbl15', 'Custom message 1 !!!', 1, 'general'),
(16, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(17, 'custom_lbl7', 'Custom message 1 !!!', 1, 'general'),
(18, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(19, 'custom_lbl19', 'Custom message 1 !!!', 1, 'general'),
(20, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(21, 'custom_lbl21', 'Custom message 1 !!!', 1, 'general'),
(22, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(23, 'custom_lbl23', 'Custom message 1 !!!', 1, 'general'),
(24, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(25, 'custom_lbl25', 'Custom message 1 !!!', 1, 'general'),
(26, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(27, 'custom_lbl27', 'Custom message 1 !!!', 1, 'general'),
(28, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(29, 'custom_lbl29', 'Custom message 1 !!!', 1, 'general'),
(30, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(31, 'custom_lbl31', 'Custom message 1 !!!', 1, 'general'),
(32, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(33, 'custom_lbl33', 'Custom message 1 !!!', 1, 'general'),
(34, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(35, 'custom_lbl35', 'Custom message 1 !!!', 1, 'general'),
(36, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(37, 'custom_lbl37', 'Custom message 1 !!!', 1, 'general'),
(38, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(39, 'custom_lbl39', 'Custom message 1 !!!', 1, 'general'),
(40, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(41, 'custom_lbl41', 'Custom message 1 !!!', 1, 'general'),
(42, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(43, 'custom_lbl43', 'Custom message 1 !!!', 1, 'general'),
(44, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(45, 'custom_lbl45', 'Custom message 1 !!!', 1, 'general'),
(46, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(47, 'custom_lbl47', 'Custom message 1 !!!', 1, 'general'),
(48, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(49, 'custom_lbl49', 'Custom message 1 !!!', 1, 'general'),
(50, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(51, 'custom_lbl51', 'Custom message 1 !!!', 1, 'general'),
(52, 'custom_lbl4', 'Custom message 2 !!!', 1, 'general'),
(53, 'custom_lbl1', 'In spanish text', 2, 'general');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(2);

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
