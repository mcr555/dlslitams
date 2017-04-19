-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2017 at 04:02 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itams`
--

-- --------------------------------------------------------

--
-- Table structure for table `changepassword`
--

CREATE TABLE `changepassword` (
  `code` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `changepassword`
--

INSERT INTO `changepassword` (`code`, `email`) VALUES
('E8MpifY9', 'recto_matthew@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

CREATE TABLE `components` (
  `component_id` int(50) NOT NULL,
  `asset_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `component_status` int(1) NOT NULL,
  `component_category` varchar(50) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateBuy` date DEFAULT NULL,
  `warranty_expiration` date DEFAULT NULL,
  `buy_price` varchar(50) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`component_id`, `asset_id`, `name`, `component_status`, `component_category`, `dateAdded`, `dateBuy`, `warranty_expiration`, `buy_price`, `supplier_id`) VALUES
(1, 4, 'test', 1, 'Processor', '2017-04-16 06:21:51', '0000-00-00', '0000-00-00', '', NULL),
(2, 4, 'test', 1, 'Memory', '2017-04-16 06:21:52', '0000-00-00', '0000-00-00', '', NULL),
(3, 4, 'test', 1, 'Video Card', '2017-04-16 06:21:52', '0000-00-00', '0000-00-00', '', NULL),
(4, 4, 'test', 1, 'Audio Card', '2017-04-16 06:21:52', '0000-00-00', '0000-00-00', '', NULL),
(5, 4, 'test', 1, 'Optical Drive', '2017-04-16 06:21:52', '0000-00-00', '0000-00-00', '', NULL),
(6, 4, 'test', 1, 'Storage', '2017-04-16 06:21:52', '0000-00-00', '0000-00-00', '', NULL),
(7, 4, 'test', 1, 'Motherboard', '2017-04-16 06:21:52', '0000-00-00', '0000-00-00', '', NULL),
(8, 5, 'test', 1, 'Processor', '2017-04-16 06:21:52', '0000-00-00', '0000-00-00', '', NULL),
(9, 5, 'test', 1, 'Memory', '2017-04-16 06:21:52', '0000-00-00', '0000-00-00', '', NULL),
(10, 5, 'test', 1, 'Video Card', '2017-04-16 06:21:52', '0000-00-00', '0000-00-00', '', NULL),
(11, 5, 'test', 1, 'Audio Card', '2017-04-16 06:21:53', '0000-00-00', '0000-00-00', '', NULL),
(12, 5, 'test', 1, 'Optical Drive', '2017-04-16 06:21:53', '0000-00-00', '0000-00-00', '', NULL),
(13, 5, 'test', 1, 'Storage', '2017-04-16 06:21:53', '0000-00-00', '0000-00-00', '', NULL),
(14, 5, 'test', 1, 'Motherboard', '2017-04-16 06:21:53', '0000-00-00', '0000-00-00', '', NULL),
(15, 6, 'i7', 1, 'Processor', '2017-04-16 06:37:08', '0000-00-00', '0000-00-00', '', NULL),
(16, 6, '4gb DDR3 RAM', 1, 'Memory', '2017-04-16 06:37:08', '0000-00-00', '0000-00-00', '', NULL),
(17, 6, 'NVIDIA GTX1080', 1, 'Video Card', '2017-04-16 06:37:09', '0000-00-00', '0000-00-00', '', NULL),
(18, 6, 'Realtek', 1, 'Audio Card', '2017-04-16 06:37:09', '0000-00-00', '0000-00-00', '', NULL),
(19, 6, 'CD Drive', 1, 'Optical Drive', '2017-04-16 06:37:09', '0000-00-00', '0000-00-00', '', NULL),
(20, 6, '500GB HDD', 1, 'Storage', '2017-04-16 06:37:09', '0000-00-00', '0000-00-00', '', NULL),
(21, 6, 'Asus', 1, 'Motherboard', '2017-04-16 06:37:10', '0000-00-00', '0000-00-00', '', NULL),
(22, 7, 'i7', 1, 'Processor', '2017-04-16 06:37:10', '0000-00-00', '0000-00-00', '', NULL),
(23, 7, '4gb DDR3 RAM', 1, 'Memory', '2017-04-16 06:37:10', '0000-00-00', '0000-00-00', '', NULL),
(24, 7, 'NVIDIA GTX1080', 1, 'Video Card', '2017-04-16 06:37:10', '0000-00-00', '0000-00-00', '', NULL),
(25, 7, 'Realtek', 1, 'Audio Card', '2017-04-16 06:37:10', '0000-00-00', '0000-00-00', '', NULL),
(26, 7, 'CD Drive', 1, 'Optical Drive', '2017-04-16 06:37:11', '0000-00-00', '0000-00-00', '', NULL),
(27, 7, '500GB HDD', 1, 'Storage', '2017-04-16 06:37:11', '0000-00-00', '0000-00-00', '', NULL),
(28, 7, 'Asus', 1, 'Motherboard', '2017-04-16 06:37:11', '0000-00-00', '0000-00-00', '', NULL),
(29, 8, 'i7', 1, 'Processor', '2017-04-16 06:37:11', '0000-00-00', '0000-00-00', '', NULL),
(30, 8, '4gb DDR3 RAM', 1, 'Memory', '2017-04-16 06:37:11', '0000-00-00', '0000-00-00', '', NULL),
(31, 8, 'NVIDIA GTX1080', 1, 'Video Card', '2017-04-16 06:37:11', '0000-00-00', '0000-00-00', '', NULL),
(32, 8, 'Realtek', 1, 'Audio Card', '2017-04-16 06:37:12', '0000-00-00', '0000-00-00', '', NULL),
(33, 8, 'CD Drive', 1, 'Optical Drive', '2017-04-16 06:37:12', '0000-00-00', '0000-00-00', '', NULL),
(34, 8, '500GB HDD', 1, 'Storage', '2017-04-16 06:37:12', '0000-00-00', '0000-00-00', '', NULL),
(35, 8, 'Asus', 1, 'Motherboard', '2017-04-16 06:37:12', '0000-00-00', '0000-00-00', '', NULL),
(36, 13, '1', 1, 'Processor', '2017-04-16 14:33:58', '0000-00-00', '0000-00-00', '', NULL),
(37, 13, '2', 1, 'Memory', '2017-04-16 14:33:58', '0000-00-00', '0000-00-00', '', NULL),
(38, 13, '3', 1, 'Video Card', '2017-04-16 14:33:58', '0000-00-00', '0000-00-00', '', NULL),
(39, 13, '4', 1, 'Audio Card', '2017-04-16 14:33:59', '0000-00-00', '0000-00-00', '', NULL),
(40, 13, '5', 1, 'Optical Drive', '2017-04-16 14:33:59', '0000-00-00', '0000-00-00', '', NULL),
(41, 13, '6', 1, 'Storage', '2017-04-16 14:33:59', '0000-00-00', '0000-00-00', '', NULL),
(42, 13, '7', 1, 'Motherboard', '2017-04-16 14:33:59', '0000-00-00', '0000-00-00', '', NULL),
(43, 0, 'New Graphics Card', 0, 'Graphics Card', '2017-04-16 21:26:55', '2017-03-28', '2017-05-03', '50000', 0),
(44, 0, 'Woo', 0, 'Motherboard', '2017-04-16 21:29:55', '2017-04-16', '2017-04-16', '300', 1),
(45, 14, 'Pro', 1, 'Processor', '2017-04-16 23:10:05', '2017-04-02', '2017-11-15', '', 6),
(46, 14, 'mem', 1, 'Memory', '2017-04-16 23:10:05', '2017-04-02', '2017-11-15', '', 6),
(47, 14, 'Vid', 1, 'Video Card', '2017-04-16 23:10:05', '2017-04-02', '2017-11-15', '', 6),
(48, 14, 'Audi', 1, 'Audio Card', '2017-04-16 23:10:05', '2017-04-02', '2017-11-15', '', 6),
(49, 14, 'Opti', 1, 'Optical Drive', '2017-04-16 23:10:06', '2017-04-02', '2017-11-15', '', 6),
(50, 14, '500gb', 1, 'Storage', '2017-04-16 23:10:06', '2017-04-02', '2017-11-15', '', 6),
(51, 14, 'Asus', 1, 'Motherboard', '2017-04-16 23:10:06', '2017-04-02', '2017-11-15', '', 6),
(52, 15, 'Pro', 1, 'Processor', '2017-04-16 23:10:06', '2017-04-02', '2017-11-15', '', 6),
(53, 15, 'mem', 1, 'Memory', '2017-04-16 23:10:06', '2017-04-02', '2017-11-15', '', 6),
(54, 15, 'Vid', 1, 'Video Card', '2017-04-16 23:10:06', '2017-04-02', '2017-11-15', '', 6),
(55, 15, 'Audi', 1, 'Audio Card', '2017-04-16 23:10:07', '2017-04-02', '2017-11-15', '', 6),
(56, 15, 'Opti', 1, 'Optical Drive', '2017-04-16 23:10:07', '2017-04-02', '2017-11-15', '', 6),
(57, 15, '500gb', 1, 'Storage', '2017-04-16 23:10:07', '2017-04-02', '2017-11-15', '', 6),
(58, 15, 'Asus', 1, 'Motherboard', '2017-04-16 23:10:07', '2017-04-02', '2017-11-15', '', 6),
(59, 0, 'test', 0, 'Mouse', '2017-04-16 23:14:30', '2017-04-02', '2017-04-26', '3', 1),
(60, 0, 'Test 2', 0, 'Mouse', '2017-04-16 23:17:26', '2017-02-07', '2017-03-26', '300', 1),
(61, 0, 'Test 2', 0, 'Mouse', '2017-04-16 23:17:26', '2017-02-07', '2017-03-26', '300', 1),
(62, 0, 'Test 2', 0, 'Mouse', '2017-04-16 23:17:27', '2017-02-07', '2017-03-26', '300', 1),
(63, 0, 'Test 2', 0, 'Mouse', '2017-04-16 23:17:27', '2017-02-07', '2017-03-26', '300', 1),
(64, 0, 'Test 2', 0, 'Mouse', '2017-04-16 23:17:49', '2017-02-07', '2017-03-26', '300', 1),
(65, 0, 'Test 2', 0, 'Mouse', '2017-04-16 23:17:49', '2017-02-07', '2017-03-26', '300', 1),
(66, 0, 'Test 2', 0, 'Mouse', '2017-04-16 23:17:50', '2017-02-07', '2017-03-26', '300', 1),
(67, 0, 'Test 2', 0, 'Mouse', '2017-04-16 23:17:50', '2017-02-07', '2017-03-26', '300', 1),
(68, 0, 'test3', 0, 'Mouse', '2017-04-16 23:18:14', '2017-03-28', '2017-06-28', '400', 0),
(69, 0, 'test3', 0, 'Mouse', '2017-04-16 23:18:14', '2017-03-28', '2017-06-28', '400', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contract_license`
--

CREATE TABLE `contract_license` (
  `clId` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `donated_assets`
--

CREATE TABLE `donated_assets` (
  `donated_id` int(11) NOT NULL,
  `dasset_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dateRetired` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donated_assets`
--

INSERT INTO `donated_assets` (`donated_id`, `dasset_id`, `name`, `dateRetired`, `location`) VALUES
(1, 27, 'MB308-1', '2017-03-27 04:56:21', '0'),
(2, 28, 'MB308-2', '2017-03-27 04:56:26', '0'),
(3, 29, 'MB308-3', '2017-03-27 04:56:28', '0'),
(4, 30, 'MB308-4', '2017-03-27 04:56:32', '0'),
(5, 32, 'MB308-5', '2017-03-27 04:56:35', '0'),
(6, 35, 'MB309-10', '2017-03-26 19:10:28', '0'),
(7, 36, 'MB308-10', '2017-03-26 19:10:28', '0'),
(8, 25, 'Tablet 1', '2017-03-26 19:39:38', '0'),
(9, 39, 'MB308-16', '2017-03-27 04:56:39', '0'),
(10, 40, 'MB308-17', '2017-03-27 04:56:47', '0'),
(11, 46, 'Tablet', '2017-03-30 16:03:53', '0'),
(12, 37, 'GZ101-10', '2017-03-30 16:04:18', '0'),
(13, 47, 'FaTablet', '2017-03-30 16:06:20', '0'),
(14, 45, 'Tablet', '2017-03-30 16:06:38', '0'),
(15, 48, 'Asar', '2017-03-31 05:11:36', ''),
(16, 49, 'ki', '2017-03-30 16:12:55', ''),
(17, 50, '1', '2017-03-30 16:14:55', '<script>document.write(loc)</script>'),
(18, 51, '1', '2017-03-30 16:23:13', ''),
(19, 53, 'i', '2017-03-30 16:35:24', 'Asa ka pa'),
(20, 54, 'i', '2017-03-30 16:35:24', 'Asa ka pa'),
(21, 55, 'i', '2017-04-04 15:12:10', 'Freedor'),
(22, 56, 'i', '2017-04-04 15:13:04', '.'),
(23, 107, 'log1', '2017-04-07 00:35:34', 'Yahoo'),
(24, 106, 'log1', '2017-04-07 00:35:34', 'Yahoo'),
(25, 31, 'Epson Printer', '2017-04-07 03:42:32', 'AA'),
(26, 34, 'Epson Printer', '2017-04-15 23:44:41', 'School 20'),
(27, 38, 'MB308-189', '2017-04-15 23:46:24', 'Sa malayo'),
(28, 57, 'asa ka pa', '2017-04-15 23:47:45', 'La lang');

-- --------------------------------------------------------

--
-- Table structure for table `dropdown_list`
--

CREATE TABLE `dropdown_list` (
  `dropdown_id` int(11) NOT NULL,
  `dropdown_name` varchar(50) NOT NULL,
  `dropdown_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dropdown_list`
--

INSERT INTO `dropdown_list` (`dropdown_id`, `dropdown_name`, `dropdown_type`) VALUES
(1, 'Switch', 1),
(2, 'Mouse', 2),
(3, 'Motherboard', 2),
(4, 'Graphics Card', 2),
(5, 'Asa', 2),
(6, 'Ka', 2),
(7, 'MB308', 3),
(8, 'MB310', 3),
(9, 'MB309', 3),
(10, 'Router', 1),
(11, 'Printer', 1),
(12, 'Ewan na', 1),
(13, 'MB110', 3),
(14, 'Shin', 2),
(15, 'Swicsh', 1),
(16, 'AA', 2);

-- --------------------------------------------------------

--
-- Table structure for table `hardware`
--

CREATE TABLE `hardware` (
  `asset_id` int(11) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dateBought` date NOT NULL,
  `warranty_expiration` date NOT NULL,
  `book_value` float NOT NULL,
  `buying_price` float NOT NULL,
  `location` varchar(50) NOT NULL,
  `date_borrowed` varchar(50) DEFAULT NULL,
  `date_returned` varchar(50) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `lifespanEnd` varchar(50) NOT NULL,
  `user_id` int(50) DEFAULT NULL,
  `macAddress` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `asset_type` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hardware_category` varchar(50) NOT NULL,
  `custodian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hardware`
--

INSERT INTO `hardware` (`asset_id`, `barcode`, `name`, `dateBought`, `warranty_expiration`, `book_value`, `buying_price`, `location`, `date_borrowed`, `date_returned`, `supplier_id`, `lifespanEnd`, `user_id`, `macAddress`, `status`, `asset_type`, `date_update`, `hardware_category`, `custodian`) VALUES
(1, 'isaopd', 'MB308', '2017-04-16', '2017-04-26', 10000, 10000, 'MB110', NULL, '', 6, '', NULL, '', 1, 2, '2017-04-16 11:50:40', 'desktop', 4),
(2, 'jsdklwlkj', 'MB308', '2017-04-16', '2017-04-26', 10000, 10000, 'MB310', NULL, '', 6, '', NULL, '', 1, 2, '2017-04-16 11:50:21', 'desktop', 8),
(3, 'sdoifjp', 'MB309', '2017-04-02', '2017-04-10', 10, 10, 'MB110', NULL, '', 1, '', NULL, '', 1, 2, '2017-04-16 11:44:35', 'laptop', 20),
(4, 'fsdjk', 'TEST', '2017-04-10', '2017-04-25', 2, 2, 'MB310', NULL, '', 1, '', NULL, '', 1, 2, '2017-04-16 11:47:45', 'laptop', 2345),
(5, 'jlkui', 'TEST', '2017-04-10', '2017-04-25', 2, 2, 'MB309', NULL, '', 1, '', NULL, '', 1, 2, '2017-04-16 11:47:39', 'laptop', 8),
(6, 'ofsdijp', 'MB110', '2017-03-07', '2017-04-18', 50000, 50000, 'MB309', NULL, '', 6, '2020-03-07', NULL, '', 1, 2, '2017-04-16 11:47:39', 'desktop', 8),
(7, 'woueip', 'MB110', '2017-03-07', '2017-04-18', 50000, 50000, 'MB308', NULL, '', 6, '2020-03-07', NULL, '', 1, 2, '2017-04-16 11:47:17', 'desktop', 2012100000),
(8, 'wfuoi', 'MB110', '2017-03-07', '2017-04-18', 0, 50000, 'MB308', NULL, '', 6, '2020-03-07', NULL, '', 1, 2, '2017-04-16 11:45:39', 'desktop', 1234),
(9, 'sjdlkffas', 'Epson Printer', '2017-02-06', '2017-04-27', 23000, 23000, 'MB309', NULL, '', 6, '2020-02-06', NULL, '', 1, 3, '2017-04-16 11:42:19', '11', 1234),
(10, 'dsfgji', 'Epson Printer', '2017-02-06', '2017-04-27', 23000, 23000, 'MB309', NULL, '', 6, '2020-02-06', NULL, '', 1, 3, '2017-04-16 11:42:19', '11', 1234),
(11, 'cjklrsd', 'Linksys', '2017-04-02', '2017-05-24', 5000, 5000, 'MB308', NULL, '', 6, '2020-04-02', NULL, '', 1, 3, '2017-04-16 11:45:30', 'Router', 1234),
(12, 'joiweo', 'Linksys', '2017-04-02', '2017-05-24', 0, 5000, 'MB309', NULL, '', 6, '2020-04-02', NULL, '', 2, 3, '2017-04-17 07:38:11', 'Router', 1234),
(13, '789', 'Masn', '2017-03-26', '2017-04-03', 300, 300, 'warehouse', NULL, '', 6, '2023-03-26', NULL, '', 0, 2, '2017-04-16 14:33:58', 'desktop', 0),
(14, '12349', 'Minesotta', '2017-04-02', '2017-11-15', 1, 500, 'warehouse', NULL, '', 6, '2019-04-02', NULL, '', 3, 2, '2017-04-17 07:34:18', 'desktop', 0),
(15, '7653', 'Minesotta', '2017-04-02', '2017-11-15', 0, 500, 'warehouse', NULL, '', 6, '2019-04-02', NULL, '', 2, 2, '2017-04-17 07:34:10', 'desktop', 0);

-- --------------------------------------------------------

--
-- Table structure for table `history_borrow`
--

CREATE TABLE `history_borrow` (
  `history_id` int(11) NOT NULL,
  `history_user` int(11) NOT NULL,
  `dateBorrowed` date NOT NULL,
  `dateReturned` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `software`
--

CREATE TABLE `software` (
  `software_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `version` varchar(50) NOT NULL,
  `expiration_date` date DEFAULT NULL,
  `date_bought` date DEFAULT NULL,
  `serial` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_warn` date DEFAULT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software`
--

INSERT INTO `software` (`software_id`, `asset_id`, `name`, `version`, `expiration_date`, `date_bought`, `serial`, `date_added`, `date_warn`, `type`) VALUES
(1, 1, 'Windows 10', '', '0000-00-00', '2017-04-01', '', '2017-04-16 06:07:44', '0000-00-00', 1),
(2, 2, 'Windows 10', '', '0000-00-00', '0000-00-00', '', '2017-04-16 06:07:45', '0000-00-00', 1),
(3, 3, 'test', '', '0000-00-00', '0000-00-00', '', '2017-04-16 06:13:18', '0000-00-00', 1),
(4, 4, 'test', '', '0000-00-00', '0000-00-00', '', '2017-04-16 06:21:52', '0000-00-00', 1),
(5, 5, 'test', '', '0000-00-00', '0000-00-00', '', '2017-04-16 06:21:53', '0000-00-00', 1),
(6, 6, 'LLL', '', '0000-00-00', '0000-00-00', '', '2017-04-16 06:37:10', '0000-00-00', 1),
(7, 7, 'LLL', '', '0000-00-00', '0000-00-00', '', '2017-04-16 06:37:11', '0000-00-00', 1),
(8, 8, 'LLL', '', '0000-00-00', '0000-00-00', '', '2017-04-16 06:37:12', '0000-00-00', 1),
(9, 0, 'Face IT', '1', NULL, NULL, '', '2017-04-16 11:16:48', NULL, 0),
(10, 0, 'Face IT', '1', NULL, NULL, '', '2017-04-16 11:16:48', NULL, 0),
(11, 0, 'Face IT', '1', NULL, NULL, '', '2017-04-16 11:16:48', NULL, 0),
(12, 0, 'Face IT', '1', NULL, NULL, '', '2017-04-16 11:16:49', NULL, 0),
(13, 0, 'Face IT', '1', NULL, NULL, '', '2017-04-16 11:16:49', NULL, 0),
(14, 0, 'Face IT', '1', NULL, NULL, '', '2017-04-16 11:16:49', NULL, 0),
(15, 0, 'Face IT', '1', NULL, NULL, '', '2017-04-16 11:16:49', NULL, 0),
(16, 3, 'Face IT', '1', NULL, NULL, '', '2017-04-16 11:16:49', NULL, 0),
(17, 13, '8', '', NULL, NULL, '', '2017-04-16 14:34:00', NULL, 1),
(18, 14, 'Windows 10', '', NULL, NULL, '', '2017-04-16 23:10:06', NULL, 1),
(19, 15, 'Windows 10', '', NULL, NULL, '', '2017-04-16 23:10:07', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `supplier_address` varchar(100) NOT NULL,
  `supplier_contact` varchar(50) NOT NULL,
  `supplier_email` varchar(50) NOT NULL,
  `supplier_representative` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contact`, `supplier_email`, `supplier_representative`) VALUES
(1, 'PC Express', 'Lipa Tambo\r\nCity', '', '', ''),
(2, '4', '4', '4', '4', '4'),
(3, '3', '3', '3', '3', '3'),
(4, '2', '2', '2', '2', '2'),
(5, '11', '1', '1', '1@yahoo.com', '1'),
(6, 'PC Chain', '012 P. Cantos', '09331831', 'apsdo@yahoo.com', 'Riley'),
(7, 'asdf&#039;&quot; dsaf&#039;&quot;&quot; &quot;&quo', 'wtrdfyg', '98765rytgu', 'iouy@yahoo.com', 'Fucu'),
(8, 'Mr. Uno', 'Tambo', '09331831123', 'fsdpo@yahoo.com', 'Mr. Recto'),
(9, 'BB', 'b', 'b', 'b@yahoo.com', 'b');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE `tbl_log` (
  `Log_Id` int(11) NOT NULL,
  `Log_Name` varchar(50) NOT NULL,
  `Log_LOP` varchar(50) NOT NULL,
  `Log_Date_Time` varchar(50) NOT NULL,
  `Log_Function` varchar(200) NOT NULL,
  `category` varchar(50) NOT NULL,
  `id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_log`
--

INSERT INTO `tbl_log` (`Log_Id`, `Log_Name`, `Log_LOP`, `Log_Date_Time`, `Log_Function`, `category`, `id`) VALUES
(1, 'Admin  Rec', 'Admin', '2017-04-16 09:45:pm', 'Log On to the system', 'Login', '2012100000'),
(2, 'Manch Riss Licc', 'Admin', '2017-04-16 09:54:pm', 'Log On to the system', 'Login', '2012100'),
(3, 'Admin  Rec', 'Admin', '2017-04-16 09:58:pm', 'Log On to the system', 'Login', '2012100000'),
(4, 'Admin  Rec', 'Admin', '2017-04-16 10:09:pm', 'Log On to the system', 'Login', '2012100000'),
(5, 'Manch Riss Licc', 'Admin', '2017-04-16 10:33:pm', 'add a Masn', 'Hardware', '789'),
(6, 'Manch Riss Licc', 'Admin', '2017-04-16 10:33:pm', 'add a Masn', 'Hardware', '789'),
(7, 'Manch Riss Licc', 'Admin', '2017-04-16 10:33:pm', 'add a Masn', 'Hardware', '789'),
(8, 'Manch Riss Licc', 'Admin', '2017-04-16 10:33:pm', 'add a Masn', 'Hardware', '789'),
(9, 'Manch Riss Licc', 'Admin', '2017-04-16 10:33:pm', 'add a Masn', 'Hardware', '789'),
(10, 'Manch Riss Licc', 'Admin', '2017-04-16 10:33:pm', 'add a Masn', 'Hardware', '789'),
(11, 'Manch Riss Licc', 'Admin', '2017-04-16 10:34:pm', 'add a Masn', 'Hardware', '789'),
(12, 'Manch Riss Licc', 'Admin', '2017-04-17 07:10:am', 'add a Minesotta', 'Hardware', '12349'),
(13, 'Manch Riss Licc', 'Admin', '2017-04-17 07:10:am', 'add a Minesotta', 'Hardware', '12349'),
(14, 'Manch Riss Licc', 'Admin', '2017-04-17 07:10:am', 'add a Minesotta', 'Hardware', '12349'),
(15, 'Manch Riss Licc', 'Admin', '2017-04-17 07:10:am', 'add a Minesotta', 'Hardware', '12349'),
(16, 'Manch Riss Licc', 'Admin', '2017-04-17 07:10:am', 'add a Minesotta', 'Hardware', '12349'),
(17, 'Manch Riss Licc', 'Admin', '2017-04-17 07:10:am', 'add a Minesotta', 'Hardware', '12349'),
(18, 'Manch Riss Licc', 'Admin', '2017-04-17 07:10:am', 'add a Minesotta', 'Hardware', '12349'),
(19, 'Manch Riss Licc', 'Admin', '2017-04-17 07:10:am', 'add a Minesotta', 'Hardware', '7653'),
(20, 'Manch Riss Licc', 'Admin', '2017-04-17 07:10:am', 'add a Minesotta', 'Hardware', '7653'),
(21, 'Manch Riss Licc', 'Admin', '2017-04-17 07:10:am', 'add a Minesotta', 'Hardware', '7653'),
(22, 'Manch Riss Licc', 'Admin', '2017-04-17 07:10:am', 'add a Minesotta', 'Hardware', '7653'),
(23, 'Manch Riss Licc', 'Admin', '2017-04-17 07:10:am', 'add a Minesotta', 'Hardware', '7653'),
(24, 'Manch Riss Licc', 'Admin', '2017-04-17 07:10:am', 'add a Minesotta', 'Hardware', '7653'),
(25, 'Manch Riss Licc', 'Admin', '2017-04-17 07:10:am', 'add a Minesotta', 'Hardware', '7653'),
(26, 'Admin  Rec', 'Admin', '2017-04-17 03:15:pm', 'Log On to the system', 'Login', '2012100000'),
(27, 'Admin  Rec', 'Admin', '2017-04-17 03:15:pm', 'Log out', 'User', '2012100000'),
(28, 'Admin  Rec', 'Admin', '2017-04-17 03:20:pm', 'Log On to the system', 'Login', '2012100000'),
(29, 'Admin  Rec', 'Admin', '2017-04-17 03:34:pm', 'retired a Minesotta', 'Hardware', '7653'),
(30, 'Admin  Rec', 'Admin', '2017-04-17 03:34:pm', 'decommission a Minesotta', 'Hardware', '12349'),
(31, 'Admin  Rec', 'Admin', '2017-04-17 03:38:pm', 'retired a Linksys', 'Hardware', 'joiweo'),
(32, 'Admin  Rec', 'Admin', '2017-04-17 03:55:pm', 'Log out', 'User', '2012100000'),
(33, 'Ann A Clemente', 'CITE Immediate Superior', '2017-04-17 03:55:pm', 'Log On to the system', 'Login', ''),
(34, 'Ann A Clemente', 'CITE Immediate Superior', '2017-04-17 03:57:pm', 'Log out', 'User', '1'),
(35, 'Matthew sdaf Recto', 'Regular Employee', '2017-04-17 03:57:pm', 'Log On to the system', 'Login', ''),
(36, 'Matthew sdaf Recto', 'Regular Employee', '2017-04-17 03:58:pm', 'Log out', 'User', '1234'),
(37, 'Ann A Clemente', 'CITE Immediate Superior', '2017-04-17 03:59:pm', 'Log On to the system', 'Login', ''),
(38, 'Ann A Clemente', 'CITE Immediate Superior', '2017-04-17 03:59:pm', 'Log out', 'User', '1'),
(39, 'Matthew sdaf Recto', 'Regular Employee', '2017-04-17 04:00:pm', 'Log On to the system', 'Login', ''),
(40, 'Matthew sdaf Recto', 'Regular Employee', '2017-04-17 04:01:pm', 'Log out', 'User', '1234'),
(41, 'Admin  Rec', 'Admin', '2017-04-19 12:04:am', 'Log On to the system', 'Login', '2012100000'),
(42, 'Admin..Rec', 'Admin', '2017-04-19 12:05:am', 'Generate Report of all all hardware date 2017-04-01-2017-04-30', 'Report', ''),
(43, 'Admin..Rec', 'Admin', '2017-04-19 12:08:am', 'Generate Report of all all hardware date 2017-04-01-2017-04-30', 'Report', ''),
(44, 'Admin  Rec', 'Admin', '2017-04-19 01:03:am', 'Generate hardware report ', 'Hardware', ''),
(45, '..', '', '2017-04-19 01:10:am', 'Generate Report of hardware located at MB110', 'Report', ''),
(46, 'Admin  Rec', 'Admin', '2017-04-19 01:12:am', 'Generate Report of hardware located at MB110', 'Report', ''),
(47, '  ', '', '2017-04-19 01:22:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(48, 'Admin  Rec', 'Admin', '2017-04-19 01:23:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(49, 'Admin  Rec', 'Admin', '2017-04-19 01:24:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(50, 'Admin  Rec', 'Admin', '2017-04-19 01:25:am', 'Log On to the system', 'Login', '2012100000'),
(51, 'Admin  Rec', 'Admin', '2017-04-19 01:34:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(52, 'Admin  Rec', 'Admin', '2017-04-19 01:36:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(53, 'Admin  Rec', 'Admin', '2017-04-19 01:38:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(54, 'Admin  Rec', 'Admin', '2017-04-19 01:44:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(55, 'Admin  Rec', 'Admin', '2017-04-19 01:51:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(56, 'Admin  Rec', 'Admin', '2017-04-19 01:52:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(57, 'Admin  Rec', 'Admin', '2017-04-19 01:53:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(58, 'Admin  Rec', 'Admin', '2017-04-19 01:53:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(59, 'Admin  Rec', 'Admin', '2017-04-19 01:53:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(60, 'Admin  Rec', 'Admin', '2017-04-19 01:53:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(61, 'Admin  Rec', 'Admin', '2017-04-19 01:54:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(62, 'Admin  Rec', 'Admin', '2017-04-19 01:54:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(63, 'Admin  Rec', 'Admin', '2017-04-19 01:54:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(64, 'Admin  Rec', 'Admin', '2017-04-19 01:55:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(65, 'Admin  Rec', 'Admin', '2017-04-19 01:56:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(66, 'Admin  Rec', 'Admin', '2017-04-19 01:56:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(67, 'Admin  Rec', 'Admin', '2017-04-19 01:57:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(68, 'Admin  Rec', 'Admin', '2017-04-19 01:57:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(69, 'Admin  Rec', 'Admin', '2017-04-19 01:57:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(70, 'Admin  Rec', 'Admin', '2017-04-19 01:58:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(71, 'Admin  Rec', 'Admin', '2017-04-19 01:58:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(72, 'Admin  Rec', 'Admin', '2017-04-19 01:59:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(73, 'Admin  Rec', 'Admin', '2017-04-19 01:59:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(74, 'Admin  Rec', 'Admin', '2017-04-19 01:59:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(75, 'Admin  Rec', 'Admin', '2017-04-19 01:59:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(76, 'Admin  Rec', 'Admin', '2017-04-19 02:00:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(77, 'Admin  Rec', 'Admin', '2017-04-19 02:00:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(78, 'Admin  Rec', 'Admin', '2017-04-19 02:01:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(79, 'Admin  Rec', 'Admin', '2017-04-19 02:01:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(80, 'Admin  Rec', 'Admin', '2017-04-19 02:02:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(81, 'Admin  Rec', 'Admin', '2017-04-19 02:02:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(82, 'Admin  Rec', 'Admin', '2017-04-19 02:03:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(83, 'Admin  Rec', 'Admin', '2017-04-19 02:03:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(84, 'Admin  Rec', 'Admin', '2017-04-19 02:03:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(85, 'Admin  Rec', 'Admin', '2017-04-19 02:04:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(86, 'Admin  Rec', 'Admin', '2017-04-19 02:04:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(87, 'Admin  Rec', 'Admin', '2017-04-19 02:05:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(88, 'Admin  Rec', 'Admin', '2017-04-19 02:05:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(89, 'Admin..Rec', 'Admin', '2017-04-19 02:32:am', 'Generate Report of all expired warranty hardware', 'Report', ''),
(90, 'Admin  Rec', 'Admin', '2017-04-19 02:32:am', 'Generate report of Logs date 2017-04-01-2017-04-30 ', 'Report', ''),
(91, 'Admin  Rec', 'Admin', '2017-04-19 02:33:am', 'Generate report of expired software ', 'Report', ''),
(92, 'Admin  Rec', 'Admin', '2017-04-19 02:48:am', 'Generate supplier report of PC Express', 'Report', ''),
(93, 'Admin  Rec', 'Admin', '2017-04-19 03:52:am', 'Generate hardware report ', 'Hardware', ''),
(94, 'Admin  Rec', 'Admin', '2017-04-19 03:53:am', 'Generate hardware report ', 'Hardware', ''),
(95, 'Admin  Rec', 'Admin', '2017-04-19 04:03:am', 'Generate hardware report ', 'Hardware', ''),
(96, 'Admin  Rec', 'Admin', '2017-04-19 04:04:am', 'Generate hardware report ', 'Hardware', ''),
(97, 'Admin  Rec', 'Admin', '2017-04-19 04:10:am', 'Generate hardware report ', 'Hardware', ''),
(98, 'Admin  Rec', 'Admin', '2017-04-19 04:11:am', 'Generate hardware report ', 'Hardware', ''),
(99, 'Admin  Rec', 'Admin', '2017-04-19 07:19:am', 'Generate hardware report ', 'Hardware', ''),
(100, 'Admin  Rec', 'Admin', '2017-04-19 07:20:am', 'Generate hardware report ', 'Hardware', ''),
(101, 'Admin  Rec', 'Admin', '2017-04-19 07:21:am', 'Generate hardware report ', 'Hardware', ''),
(102, 'Admin  Rec', 'Admin', '2017-04-19 07:37:am', 'Generate hardware report ', 'Hardware', ''),
(103, 'Admin  Rec', 'Admin', '2017-04-19 07:39:am', 'Generate hardware report ', 'Hardware', ''),
(104, 'Admin  Rec', 'Admin', '2017-04-19 07:39:am', 'Generate hardware report ', 'Hardware', ''),
(105, 'Admin  Rec', 'Admin', '2017-04-19 07:39:am', 'Generate hardware report ', 'Hardware', ''),
(106, 'Admin  Rec', 'Admin', '2017-04-19 07:41:am', 'Generate hardware report ', 'Hardware', ''),
(107, 'Admin  Rec', 'Admin', '2017-04-19 07:41:am', 'Generate hardware report ', 'Hardware', ''),
(108, 'Admin  Rec', 'Admin', '2017-04-19 07:42:am', 'Generate hardware report ', 'Hardware', ''),
(109, 'Admin  Rec', 'Admin', '2017-04-19 07:43:am', 'Generate hardware report ', 'Hardware', ''),
(110, 'Admin  Rec', 'Admin', '2017-04-19 07:43:am', 'Generate hardware report ', 'Hardware', ''),
(111, 'Admin  Rec', 'Admin', '2017-04-19 07:44:am', 'Generate hardware report ', 'Hardware', ''),
(112, 'Admin  Rec', 'Admin', '2017-04-19 07:45:am', 'Generate hardware report ', 'Hardware', ''),
(113, 'Admin  Rec', 'Admin', '2017-04-19 07:45:am', 'Generate hardware report ', 'Hardware', ''),
(114, 'Admin  Rec', 'Admin', '2017-04-19 07:46:am', 'Generate hardware report ', 'Hardware', ''),
(115, 'Admin  Rec', 'Admin', '2017-04-19 07:46:am', 'Generate hardware report ', 'Hardware', ''),
(116, 'Admin  Rec', 'Admin', '2017-04-19 07:46:am', 'Generate hardware report ', 'Hardware', ''),
(117, 'Admin  Rec', 'Admin', '2017-04-19 07:46:am', 'Generate hardware report ', 'Hardware', ''),
(118, 'Admin  Rec', 'Admin', '2017-04-19 07:46:am', 'Generate hardware report ', 'Hardware', ''),
(119, 'Admin  Rec', 'Admin', '2017-04-19 07:47:am', 'Generate hardware report ', 'Hardware', ''),
(120, 'Admin  Rec', 'Admin', '2017-04-19 07:48:am', 'Generate hardware report ', 'Hardware', ''),
(121, 'Admin  Rec', 'Admin', '2017-04-19 07:48:am', 'Generate hardware report ', 'Hardware', ''),
(122, 'Admin  Rec', 'Admin', '2017-04-19 07:48:am', 'Generate hardware report ', 'Hardware', ''),
(123, 'Admin  Rec', 'Admin', '2017-04-19 07:49:am', 'Generate hardware report ', 'Hardware', ''),
(124, 'Admin  Rec', 'Admin', '2017-04-19 07:50:am', 'Generate hardware report ', 'Hardware', ''),
(125, 'Admin  Rec', 'Admin', '2017-04-19 07:51:am', 'Generate hardware report ', 'Hardware', ''),
(126, 'Admin  Rec', 'Admin', '2017-04-19 07:51:am', 'Generate hardware report ', 'Hardware', ''),
(127, 'Admin  Rec', 'Admin', '2017-04-19 07:52:am', 'Generate hardware report ', 'Hardware', ''),
(128, 'Admin  Rec', 'Admin', '2017-04-19 07:52:am', 'Generate hardware report ', 'Hardware', ''),
(129, 'Admin  Rec', 'Admin', '2017-04-19 07:53:am', 'Generate hardware report ', 'Hardware', ''),
(130, 'Admin  Rec', 'Admin', '2017-04-19 07:53:am', 'Generate hardware report ', 'Hardware', ''),
(131, 'Admin  Rec', 'Admin', '2017-04-19 07:54:am', 'Generate hardware report ', 'Hardware', ''),
(132, 'Admin  Rec', 'Admin', '2017-04-19 07:54:am', 'Generate hardware report ', 'Hardware', ''),
(133, 'Admin  Rec', 'Admin', '2017-04-19 07:55:am', 'Generate hardware report ', 'Hardware', ''),
(134, 'Admin  Rec', 'Admin', '2017-04-19 07:58:am', 'Generate hardware report ', 'Hardware', ''),
(135, 'Admin  Rec', 'Admin', '2017-04-19 07:59:am', 'Generate hardware report ', 'Hardware', ''),
(136, 'Admin  Rec', 'Admin', '2017-04-19 07:59:am', 'Generate hardware report ', 'Hardware', ''),
(137, 'Admin  Rec', 'Admin', '2017-04-19 08:00:am', 'Generate hardware report ', 'Hardware', ''),
(138, 'Admin  Rec', 'Admin', '2017-04-19 08:00:am', 'Generate hardware report ', 'Hardware', ''),
(139, 'Admin  Rec', 'Admin', '2017-04-19 08:01:am', 'Generate hardware report ', 'Hardware', ''),
(140, 'Admin  Rec', 'Admin', '2017-04-19 08:05:am', 'Generate Report of hardware located at MB110', 'Report', ''),
(141, 'Admin  Rec', 'Admin', '2017-04-19 08:07:am', 'Generate Report of hardware located at MB110', 'Report', ''),
(142, 'Admin  Rec', 'Admin', '2017-04-19 08:08:am', 'Generate hardware report ', 'Hardware', ''),
(143, 'Admin  Rec', 'Admin', '2017-04-19 08:10:am', 'Generate hardware report ', 'Hardware', ''),
(144, 'Admin  Rec', 'Admin', '2017-04-19 08:11:am', 'Generate hardware report ', 'Hardware', ''),
(145, 'Admin  Rec', 'Admin', '2017-04-19 08:12:am', 'Generate hardware report ', 'Hardware', ''),
(146, 'Admin  Rec', 'Admin', '2017-04-19 08:14:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(147, 'Admin  Rec', 'Admin', '2017-04-19 08:14:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(148, 'Admin  Rec', 'Admin', '2017-04-19 08:15:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(149, 'Admin  Rec', 'Admin', '2017-04-19 08:15:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(150, 'Admin  Rec', 'Admin', '2017-04-19 08:15:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(151, 'Admin  Rec', 'Admin', '2017-04-19 08:16:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(152, 'Admin  Rec', 'Admin', '2017-04-19 08:17:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(153, 'Admin  Rec', 'Admin', '2017-04-19 08:19:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(154, 'Admin  Rec', 'Admin', '2017-04-19 08:19:am', 'Generate report of hardware waranty date 2017-04-01-2017-04-30 ', 'Report', ''),
(155, 'Admin  Rec', 'Admin', '2017-04-19 08:20:am', 'Generate Report of all expired warranty hardware', 'Report', ''),
(156, 'Admin  Rec', 'Admin', '2017-04-19 08:21:am', 'Generate Report of all expired warranty hardware', 'Report', ''),
(157, 'Admin  Rec', 'Admin', '2017-04-19 08:25:am', 'Generate Report of all expired warranty hardware', 'Report', ''),
(158, 'Admin  Rec', 'Admin', '2017-04-19 08:26:am', 'Generate Report of all expired warranty hardware', 'Report', ''),
(159, 'Admin  Rec', 'Admin', '2017-04-19 08:26:am', 'Generate Report of all expired warranty hardware', 'Report', ''),
(160, 'Admin  Rec', 'Admin', '2017-04-19 08:36:am', 'Generate report of all Software date 2017-04-01-2017-04-30 ', 'Report', ''),
(161, 'Admin  Rec', 'Admin', '2017-04-19 08:37:am', 'Generate report of all Software date 2017-04-01-2017-04-30 ', 'Report', ''),
(162, 'Admin  Rec', 'Admin', '2017-04-19 08:38:am', 'Generate report of all Software date 2017-04-01-2017-04-30 ', 'Report', ''),
(163, 'Admin  Rec', 'Admin', '2017-04-19 08:39:am', 'Generate report of all Software date 2017-04-01-2017-04-30 ', 'Report', ''),
(164, 'Admin  Rec', 'Admin', '2017-04-19 08:40:am', 'Generate report of all Software date 2017-04-01-2017-04-30 ', 'Report', ''),
(165, 'Admin  Rec', 'Admin', '2017-04-19 08:40:am', 'Generate report of all Software date 2017-04-01-2017-04-30 ', 'Report', ''),
(166, 'Admin  Rec', 'Admin', '2017-04-19 08:42:am', 'Generate report of all Software date 2017-04-01-2017-04-30 ', 'Report', ''),
(167, 'Admin  Rec', 'Admin', '2017-04-19 08:42:am', 'Generate report of all Software date 2017-04-01-2017-04-30 ', 'Report', ''),
(168, 'Admin  Rec', 'Admin', '2017-04-19 08:44:am', 'Generate report of all Software date 2017-04-01-2017-04-30 ', 'Report', ''),
(169, 'Admin  Rec', 'Admin', '2017-04-19 08:46:am', 'Generate report of all Software date 2017-04-01-2017-04-30 ', 'Report', ''),
(170, 'Admin  Rec', 'Admin', '2017-04-19 08:46:am', 'Generate report of all Software date 2017-04-01-2017-04-30 ', 'Report', ''),
(171, 'Admin  Rec', 'Admin', '2017-04-19 08:47:am', 'Generate report of all Software date 2017-04-01-2017-04-30 ', 'Report', ''),
(172, 'Admin  Rec', 'Admin', '2017-04-19 09:07:am', 'Generate report of expired software ', 'Report', ''),
(173, 'Admin  Rec', 'Admin', '2017-04-19 09:14:am', 'Generate report of expired software ', 'Report', ''),
(174, 'Admin  Rec', 'Admin', '2017-04-19 09:15:am', 'Generate report of expired software ', 'Report', ''),
(175, 'Admin  Rec', 'Admin', '2017-04-19 09:16:am', 'Generate report of expired software ', 'Report', ''),
(176, 'Admin  Rec', 'Admin', '2017-04-19 09:16:am', 'Generate report of expired software ', 'Report', ''),
(177, 'Admin  Rec', 'Admin', '2017-04-19 09:17:am', 'Generate report of expired software ', 'Report', ''),
(178, 'Admin  Rec', 'Admin', '2017-04-19 09:18:am', 'Generate report of expired software ', 'Report', ''),
(179, 'Admin  Rec', 'Admin', '2017-04-19 09:19:am', 'Generate report of all User date 2017-04-01-2017-04-30', 'Report', ''),
(180, 'Admin  Rec', 'Admin', '2017-04-19 09:20:am', 'Generate report of all User date 2017-04-01-2017-04-30', 'Report', ''),
(181, 'Admin  Rec', 'Admin', '2017-04-19 09:22:am', 'Generate report of all User date 2017-04-01-2017-04-30', 'Report', ''),
(182, 'Admin  Rec', 'Admin', '2017-04-19 09:52:am', 'Generate report of all User date 2017-04-01-2017-04-30', 'Report', ''),
(183, 'Admin  Rec', 'Admin', '2017-04-19 09:54:am', 'Generate report of all User date 2017-04-01-2017-04-30', 'Report', ''),
(184, 'Admin  Rec', 'Admin', '2017-04-19 09:56:am', 'Generate report of all CITE Immediate Superior User', 'Report', ''),
(185, 'Admin  Rec', 'Admin', '2017-04-19 09:57:am', 'Generate report of all CITE Immediate Superior User', 'Report', '');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(50) NOT NULL,
  `ticket_type` varchar(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `date_requested` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text NOT NULL,
  `requestedFor` varchar(50) NOT NULL,
  `dateNeeded` date NOT NULL,
  `quantity` text NOT NULL,
  `amount` text NOT NULL,
  `specs` text NOT NULL,
  `justification` text NOT NULL,
  `tto` varchar(50) NOT NULL,
  `tfrom` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `tstatus` int(11) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `amountw` varchar(80) NOT NULL,
  `charging` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_view`
--

CREATE TABLE `ticket_view` (
  `tview_id` int(11) NOT NULL,
  `ticket_id` int(50) NOT NULL,
  `tuser_id` int(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `tistatus` int(11) NOT NULL,
  `step` int(11) NOT NULL,
  `dateApproved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idnumber` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `middlename` varchar(40) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `department` varchar(40) NOT NULL,
  `accountType` varchar(50) DEFAULT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userStatus` int(11) NOT NULL,
  `dateDeactivated` varchar(50) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `imagepath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idnumber`, `password`, `lastname`, `firstname`, `middlename`, `gender`, `email`, `department`, `accountType`, `dateAdded`, `userStatus`, `dateDeactivated`, `imagepath`) VALUES
('1', '81dc9bdb52d04dc20036dbd8313ed055', 'Clemente', 'Ann', 'A', 'Male', 'is@yahoo.com', 'CITE', 'CITE Immediate Superior', '2017-03-23 02:32:11', 1, '2017/03/29 2:28:41 ', 'gelo.jpg'),
('10', '81dc9bdb52d04dc20036dbd8313ed055', 'Marquez', 'Ale', '', 'Male', 'ahsjk@yahoo.com', 'CITE', 'Principal', '2017-03-27 02:13:34', 0, '', ''),
('11', '81dc9bdb52d04dc20036dbd8313ed055', 'Claveria', 'gelo', '', 'Male', 'haio@yahoo.com', 'CITE', 'Properties and Reservation Officer', '2017-03-27 02:13:52', 1, '2017/04/06 9:58:47 ', ''),
('1234', '81dc9bdb52d04dc20036dbd8313ed055', 'Recto', 'Matthew', 'sdaf', 'Male', 'recto_matthew@yahoo.com', 'CITE', 'Regular Employee', '2017-03-22 01:38:53', 0, '2017/03/26 23:52:36 ', 'trish.jpg'),
('2', '81dc9bdb52d04dc20036dbd8313ed055', 'Marquez', 'Sheila', '', 'Male', 'rkwsdop@yahoo.com', 'CITE', 'CITE Dean', '2017-03-24 00:52:32', 0, '0000-00-00 00:00:00', ''),
('20', '81dc9bdb52d04dc20036dbd8313ed055', 'Calpe', 'Carlo', 'm', 'Male', 'ms@yahoo.com', 'CITE', 'Regular Employee', '2017-04-06 01:51:47', 0, '0000-00-00 00:00:00', ''),
('2012100', '81dc9bdb52d04dc20036dbd8313ed055', 'Licc', 'Manch', 'Riss', 'Male', 'asmo@yahoo.com', 'CITE', 'Admin', '2017-04-16 13:54:19', 0, '0000-00-00 00:00:00', '1492351583recto jc sc.JPG'),
('2012100000', '81dc9bdb52d04dc20036dbd8313ed055', 'Rec', 'Admin', '', 'Male', 'admin@yahoo.com', 'CITE', 'Admin', '2017-02-22 14:38:11', 0, '0000-00-00 00:00:00', '1492351911recto jc sc.JPG'),
('2345', '81dc9bdb52d04dc20036dbd8313ed055', 'Barbosa', 'kevin', '', 'Male', 'skfl@yahoo.com', 'CITE', 'Regular Employee', '2017-03-23 03:30:33', 0, '2017/03/26 23:52:11 ', ''),
('3', '81dc9bdb52d04dc20036dbd8313ed055', 'Clemente', 'Mary', '', 'Male', 'ssas@yahoo.com', 'CITE', 'Budget Analyst', '2017-03-23 23:45:02', 0, '0000-00-00 00:00:00', ''),
('4', '81dc9bdb52d04dc20036dbd8313ed055', 'Sanchez', 'Lanz', '', 'Male', 'klgsd@yahoo.com', 'CITE', 'FRD Manager', '2017-03-23 23:46:05', 0, '0000-00-00 00:00:00', ''),
('5', '81dc9bdb52d04dc20036dbd8313ed055', 'Noel', 'Claveria', '', 'Male', 'jklj@yahoo.com', 'CITE', 'FHP Director', '2017-03-23 23:46:42', 0, '0000-00-00 00:00:00', ''),
('55', '81dc9bdb52d04dc20036dbd8313ed055', 'Mora', 'Jerry', 'oNe', 'Male', 'fhio@Yajkl', 'CITE', 'Section Head', '2017-04-06 01:19:25', 0, '0000-00-00 00:00:00', ''),
('7', '81dc9bdb52d04dc20036dbd8313ed055', 'Rodelas', 'jona', 'bn', 'Male', 'asdhjk@yahoo.com', 'CITE', 'ICT Manager', '2017-03-27 01:42:22', 0, '0000-00-00 00:00:00', ''),
('8', '81dc9bdb52d04dc20036dbd8313ed055', 'Saguin', 'Patricia', 'fa', 'Male', 'asf@yahoo.com', 'CITE', 'ICT Staff', '2017-03-27 01:42:41', 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `changepassword`
--
ALTER TABLE `changepassword`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `components`
--
ALTER TABLE `components`
  ADD PRIMARY KEY (`component_id`);

--
-- Indexes for table `contract_license`
--
ALTER TABLE `contract_license`
  ADD PRIMARY KEY (`clId`);

--
-- Indexes for table `donated_assets`
--
ALTER TABLE `donated_assets`
  ADD PRIMARY KEY (`donated_id`);

--
-- Indexes for table `dropdown_list`
--
ALTER TABLE `dropdown_list`
  ADD PRIMARY KEY (`dropdown_id`);

--
-- Indexes for table `hardware`
--
ALTER TABLE `hardware`
  ADD PRIMARY KEY (`asset_id`);

--
-- Indexes for table `history_borrow`
--
ALTER TABLE `history_borrow`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`software_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`Log_Id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `ticket_view`
--
ALTER TABLE `ticket_view`
  ADD PRIMARY KEY (`tview_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idnumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `components`
--
ALTER TABLE `components`
  MODIFY `component_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `contract_license`
--
ALTER TABLE `contract_license`
  MODIFY `clId` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `donated_assets`
--
ALTER TABLE `donated_assets`
  MODIFY `donated_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `dropdown_list`
--
ALTER TABLE `dropdown_list`
  MODIFY `dropdown_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `hardware`
--
ALTER TABLE `hardware`
  MODIFY `asset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `history_borrow`
--
ALTER TABLE `history_borrow`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `software`
--
ALTER TABLE `software`
  MODIFY `software_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `Log_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket_view`
--
ALTER TABLE `ticket_view`
  MODIFY `tview_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
