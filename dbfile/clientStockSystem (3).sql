-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 11, 2023 at 01:03 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clientStockSystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `avatar` varchar(225) NOT NULL,
  `sex` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `userID`, `name`, `surname`, `avatar`, `sex`, `address`, `phone`, `email`, `lastUpdated`) VALUES
(1, 1, 'FARAI', 'FARAISURNAME', '../avatar/63e6495307f2d3.48707558.jpg', 'FEMALE', 'N/A', '0700000000', 'example@example.com', '2023-02-10 13:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `transactionID` varchar(12) NOT NULL,
  `itemID` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cashier`
--

CREATE TABLE `cashier` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `avatar` varchar(225) NOT NULL,
  `sex` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cashier`
--

INSERT INTO `cashier` (`id`, `userID`, `name`, `surname`, `avatar`, `sex`, `address`, `phone`, `email`, `lastUpdated`) VALUES
(3, 57, 'FIRST', 'CASHIER', '', '', '', '', '', '2023-02-08 09:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `dateAdded`, `lastUpdated`) VALUES
(10, 'chemicals', '2023-02-23 12:20:43', '2023-02-23 11:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `transactionID` varchar(225) NOT NULL,
  `itemID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `paymentType` varchar(225) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cardNumber` varchar(225) NOT NULL,
  `phoneNumber` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `transactionID`, `itemID`, `quantity`, `price`, `paymentType`, `dateAdded`, `lastUpdated`, `cardNumber`, `phoneNumber`) VALUES
(121, 'QrJnwTainkNI', 60, 1, 5, 'cash (usd)', '2023-02-19 11:31:27', '2023-02-19 10:31:27', '', ''),
(122, 'Manually Added', 59, 2, 7200, 'Manual (bond)', '2023-02-19 11:33:19', '2023-02-19 10:33:19', '', ''),
(123, 'Manually Added', 54, 3, 12000, 'Manual (ecocash)', '2023-02-19 11:33:27', '2023-02-19 10:33:27', '', ''),
(124, 'Manually Added', 54, 5, 20000, 'Manual (ecocash)', '2023-02-19 11:33:37', '2023-02-19 10:33:37', '', ''),
(125, 'Manually Added', 57, 4, 320, 'Manual (zar)', '2023-02-19 11:33:47', '2023-02-19 10:33:47', '', ''),
(126, 'Manually Added', 35, 2, 8, 'Manual (usd)', '2023-02-19 11:33:58', '2023-02-19 10:33:58', '', ''),
(127, 'Manually Added', 36, 2, 7200, 'Manual (bond)', '2023-02-19 11:34:08', '2023-02-19 10:34:09', '', ''),
(128, 'Manually Added', 52, 1, 4, 'Manual (usd)', '2023-02-19 11:34:19', '2023-02-19 10:34:19', '', ''),
(129, 'Manually Added', 39, 2, 7200, 'Manual (bond)', '2023-02-19 11:34:34', '2023-02-19 10:34:34', '', ''),
(131, 'Manually Added', 56, 3, 12, 'Manual (usd)', '2023-02-19 12:08:54', '2023-02-19 11:08:54', '', ''),
(132, 'Manually Added', 41, 3, 10800, 'Manual (bond)', '2023-02-19 12:09:05', '2023-02-19 11:09:05', '', ''),
(133, 'Manually Added', 40, 3, 240, 'Manual (zar)', '2023-02-19 12:09:19', '2023-02-19 11:09:19', '', ''),
(134, 'E688PKodNl3M', 61, 1, 3000, 'cash (bond)', '2023-02-23 12:27:04', '2023-02-23 11:27:04', '', ''),
(135, 'E688PKodNl3M', 60, 2, 10000, 'cash (bond)', '2023-02-23 12:27:04', '2023-02-23 11:27:04', '', ''),
(136, 'RzJIMeoSKVXi', 61, 34, 102, 'cash (usd)', '2023-02-23 12:31:10', '2023-02-23 11:31:10', '', ''),
(137, 'Manually Added', 61, 2, 120, 'Manual (zar)', '2023-02-23 12:31:56', '2023-02-23 11:31:56', '', ''),
(138, 'iaFntcclzejZ', 60, 2, 10, 'cash (usd)', '2023-05-06 02:27:55', '2023-05-06 00:27:55', '', ''),
(139, 'iaFntcclzejZ', 58, 1, 4, 'cash (usd)', '2023-05-06 02:27:55', '2023-05-06 00:27:55', '', ''),
(140, 'RjZFw0eHljmS', 60, 1, 5, 'cash (usd)', '2023-05-06 10:12:21', '2023-05-06 08:12:21', '', ''),
(141, 'U0yoKUGlJH5w', 60, 1, 5, 'cash (usd)', '2023-05-07 08:51:16', '2023-05-07 06:51:16', '', ''),
(142, 'U0yoKUGlJH5w', 58, 2, 8, 'cash (usd)', '2023-05-07 08:51:16', '2023-05-07 06:51:16', '', ''),
(143, 'wP0sOTarmkM5', 64, 2, 0.5, 'cash (usd)', '2023-05-08 14:03:17', '2023-05-08 12:03:17', '', ''),
(144, 'wP0sOTarmkM5', 67, 1, 3, 'cash (usd)', '2023-05-08 14:03:17', '2023-05-08 12:03:17', '', ''),
(145, 'yT7OruunlZdt', 63, 2, 6300, 'card', '2023-05-08 14:03:48', '2023-05-08 12:03:48', '', ''),
(146, 'yT7OruunlZdt', 66, 2, 2100, 'card', '2023-05-08 14:03:48', '2023-05-08 12:03:48', '', ''),
(147, 'yT7OruunlZdt', 65, 1, 3150, 'card', '2023-05-08 14:03:48', '2023-05-08 12:03:48', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `currency` varchar(225) NOT NULL,
  `rate` float NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `currency`, `rate`, `dateAdded`, `lastUpdated`) VALUES
(1, 'bond', 1000, '2023-02-12 09:28:14', '2023-02-23 11:19:39'),
(2, 'rtgs', 1050, '2023-02-11 09:28:14', '2023-02-23 11:19:47'),
(3, 'zar', 20, '2023-02-12 09:28:14', '2023-02-12 07:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `barCode` varchar(225) NOT NULL,
  `quantity` int(11) NOT NULL,
  `buyingPrice` float NOT NULL,
  `sellingPrice` float NOT NULL,
  `newDQuantity` int(11) NOT NULL,
  `newDBuyingPrice` float NOT NULL,
  `newDSellingPrice` float NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `category` int(11) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `name`, `barCode`, `quantity`, `buyingPrice`, `sellingPrice`, `newDQuantity`, `newDBuyingPrice`, `newDSellingPrice`, `dateAdded`, `category`, `lastUpdated`) VALUES
(62, 'SUGAR', '', 10, 2, 3, 10, 2, 3, '2023-05-08 13:58:52', 0, '2023-05-08 11:58:52'),
(63, 'RICE', '', 13, 2, 3, 13, 2, 3, '2023-05-08 13:59:10', 0, '2023-05-08 12:06:35'),
(64, 'TISSUE', '', 8, 1, 2, 8, 1, 2, '2023-05-08 14:08:30', 0, '2023-05-08 12:08:30'),
(65, 'SALT', '', 4, 1, 3, 4, 1, 3, '2023-05-08 13:59:37', 0, '2023-05-08 12:06:35'),
(66, 'MILK', '', 8, 0.9, 1, 8, 0.9, 1, '2023-05-08 14:00:05', 0, '2023-05-08 12:06:35'),
(67, 'SURF', '', 9, 1, 3, 9, 1, 3, '2023-05-08 14:01:43', 0, '2023-05-08 12:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `stockTakeChild`
--

CREATE TABLE `stockTakeChild` (
  `id` int(11) NOT NULL,
  `uid` varchar(225) NOT NULL,
  `stockName` varchar(225) NOT NULL,
  `stockDBNetQuantity` int(11) NOT NULL,
  `stockDBGrossQuantity` int(11) NOT NULL,
  `stockPhysicalQuantity` int(11) NOT NULL,
  `stockBuyingPrice` int(11) NOT NULL,
  `stockSellingPrice` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockTakeChild`
--

INSERT INTO `stockTakeChild` (`id`, `uid`, `stockName`, `stockDBNetQuantity`, `stockDBGrossQuantity`, `stockPhysicalQuantity`, `stockBuyingPrice`, `stockSellingPrice`, `status`, `lastUpdated`) VALUES
(27, 'wCoujt04XZSo', 'ZZ', 16, 14, 14, 2, 5, 1, '2023-05-02 07:47:47'),
(28, 'wCoujt04XZSo', 'YY', 8, 8, 6, 2, 4, 1, '2023-05-05 20:38:58'),
(29, 'wCoujt04XZSo', 'XX', 10, 10, 7, 2, 4, 1, '2023-05-01 18:55:58'),
(30, 'wCoujt04XZSo', 'WW', 6, 6, 4, 2, 4, 1, '2023-05-01 19:15:50'),
(31, 'wCoujt04XZSo', 'VV', 7, 6, 15, 2, 4, 1, '2023-05-02 08:48:19'),
(32, 'wCoujt04XZSo', 'UU', 10, 10, 7, 2, 4, 1, '2023-05-01 18:56:32'),
(33, 'wCoujt04XZSo', 'TT', 2, 2, 5, 2, 4, 1, '2023-05-01 18:57:12'),
(34, 'wCoujt04XZSo', 'SS', 10, 10, 7, 2, 4, 1, '2023-05-01 18:57:16'),
(35, 'wCoujt04XZSo', 'RR', 9, 9, 0, 2, 4, 1, '2023-05-01 18:57:21'),
(36, 'wCoujt04XZSo', 'QQ', 10, 10, 1, 2, 4, 1, '2023-05-01 18:57:25'),
(37, 'wCoujt04XZSo', 'PP', 10, 10, 2, 2, 4, 1, '2023-05-01 18:57:29'),
(38, 'wCoujt04XZSo', 'OO', 10, 10, 34, 2, 4, 1, '2023-05-01 18:57:34'),
(39, 'wCoujt04XZSo', 'NN', 10, 10, 2, 2, 4, 1, '2023-05-01 18:57:37'),
(40, 'wCoujt04XZSo', 'MM', 10, 10, 5, 2, 4, 1, '2023-05-01 18:57:40'),
(41, 'wCoujt04XZSo', 'LL', 10, 10, 7, 2, 4, 1, '2023-05-01 18:57:45'),
(42, 'wCoujt04XZSo', 'KK', 10, 10, 8, 2, 4, 1, '2023-05-01 18:57:48'),
(43, 'wCoujt04XZSo', 'JJ', 10, 10, 2, 2, 4, 1, '2023-05-01 18:57:51'),
(44, 'wCoujt04XZSo', 'II', 10, 10, 11, 2, 4, 1, '2023-05-01 18:57:55'),
(45, 'wCoujt04XZSo', 'HH', 10, 10, 2, 2, 4, 1, '2023-05-01 18:57:58'),
(46, 'wCoujt04XZSo', 'GG', 7, 7, 4, 2, 4, 1, '2023-05-01 18:58:03'),
(47, 'wCoujt04XZSo', 'FF', 7, 7, 12, 2, 4, 1, '2023-05-01 18:58:08'),
(48, 'wCoujt04XZSo', 'EE', 8, 8, 43, 2, 4, 1, '2023-05-01 18:58:11'),
(49, 'wCoujt04XZSo', 'DD', 9, 9, 66, 2, 4, 1, '2023-05-01 18:58:14'),
(50, 'wCoujt04XZSo', 'CC', 10, 10, 1, 2, 4, 1, '2023-05-01 18:58:17'),
(51, 'wCoujt04XZSo', 'BB', 8, 8, 0, 2, 4, 1, '2023-05-01 18:58:21'),
(52, 'wCoujt04XZSo', 'AA', 8, 8, 5, 2, 4, 1, '2023-05-01 18:58:25'),
(105, 'Y51G2TrNHJWi', 'ZZ', 14, 14, 14, 2, 5, 1, '2023-05-02 14:26:05'),
(106, 'Y51G2TrNHJWi', 'YY', 8, 8, 8, 2, 4, 1, '2023-05-02 14:26:13'),
(107, 'Y51G2TrNHJWi', 'XX', 10, 10, 8, 2, 4, 1, '2023-05-02 14:26:21'),
(108, 'Y51G2TrNHJWi', 'WW', 6, 6, 6, 2, 4, 1, '2023-05-02 14:27:17'),
(109, 'Y51G2TrNHJWi', 'VV', 7, 7, 7, 2, 4, 1, '2023-05-02 14:27:24'),
(110, 'Y51G2TrNHJWi', 'UU', 10, 10, 10, 2, 4, 1, '2023-05-02 14:27:32'),
(111, 'Y51G2TrNHJWi', 'TT', 2, 2, 5, 2, 4, 1, '2023-05-02 14:27:40'),
(112, 'Y51G2TrNHJWi', 'SS', 10, 10, 10, 2, 4, 1, '2023-05-02 14:27:46'),
(113, 'Y51G2TrNHJWi', 'RR', 9, 9, 10, 2, 4, 1, '2023-05-02 14:27:53'),
(114, 'Y51G2TrNHJWi', 'QQ', 10, 10, 5, 2, 4, 1, '2023-05-02 14:27:59'),
(115, 'Y51G2TrNHJWi', 'PP', 10, 10, 10, 2, 4, 1, '2023-05-02 14:28:05'),
(116, 'Y51G2TrNHJWi', 'OO', 10, 10, 10, 2, 4, 1, '2023-05-02 14:28:12'),
(117, 'Y51G2TrNHJWi', 'NN', 10, 10, 10, 2, 4, 1, '2023-05-02 14:28:16'),
(118, 'Y51G2TrNHJWi', 'MM', 10, 10, 10, 2, 4, 1, '2023-05-02 14:28:20'),
(119, 'Y51G2TrNHJWi', 'LL', 10, 10, 10, 2, 4, 1, '2023-05-02 14:28:24'),
(120, 'Y51G2TrNHJWi', 'KK', 10, 10, 10, 2, 4, 1, '2023-05-02 14:28:27'),
(121, 'Y51G2TrNHJWi', 'JJ', 10, 10, 10, 2, 4, 1, '2023-05-02 14:28:31'),
(122, 'Y51G2TrNHJWi', 'II', 10, 10, 10, 2, 4, 1, '2023-05-02 14:28:34'),
(123, 'Y51G2TrNHJWi', 'HH', 10, 10, 10, 2, 4, 1, '2023-05-02 14:28:39'),
(124, 'Y51G2TrNHJWi', 'GG', 7, 7, 7, 2, 4, 1, '2023-05-02 14:28:45'),
(125, 'Y51G2TrNHJWi', 'FF', 7, 7, 7, 2, 4, 1, '2023-05-02 14:28:50'),
(126, 'Y51G2TrNHJWi', 'EE', 8, 8, 8, 2, 4, 1, '2023-05-02 14:28:54'),
(127, 'Y51G2TrNHJWi', 'DD', 9, 9, 9, 2, 4, 1, '2023-05-02 14:28:58'),
(128, 'Y51G2TrNHJWi', 'CC', 10, 10, 10, 2, 4, 1, '2023-05-02 14:29:04'),
(129, 'Y51G2TrNHJWi', 'BB', 8, 8, 8, 2, 4, 1, '2023-05-02 14:29:09'),
(130, 'Y51G2TrNHJWi', 'AA', 8, 8, 8, 2, 4, 1, '2023-05-02 14:29:13'),
(131, 'qdck5dh2p4m9', 'ZZ', 14, 14, 14, 2, 5, 1, '2023-05-05 17:00:36'),
(132, 'qdck5dh2p4m9', 'YY', 8, 8, 8, 2, 4, 1, '2023-05-05 17:00:41'),
(133, 'qdck5dh2p4m9', 'XX', 10, 10, 10, 2, 4, 1, '2023-05-05 17:00:46'),
(134, 'qdck5dh2p4m9', 'WW', 6, 6, 6, 2, 4, 1, '2023-05-05 17:00:51'),
(135, 'qdck5dh2p4m9', 'VV', 7, 7, 7, 2, 4, 1, '2023-05-05 17:00:56'),
(136, 'qdck5dh2p4m9', 'UU', 10, 10, 10, 2, 4, 1, '2023-05-05 17:01:01'),
(137, 'qdck5dh2p4m9', 'TT', 2, 2, 2, 2, 4, 1, '2023-05-05 17:01:05'),
(138, 'qdck5dh2p4m9', 'SS', 10, 10, 10, 2, 4, 1, '2023-05-05 17:01:09'),
(139, 'qdck5dh2p4m9', 'RR', 9, 9, 9, 2, 4, 1, '2023-05-05 17:01:14'),
(140, 'qdck5dh2p4m9', 'QQ', 10, 10, 10, 2, 4, 1, '2023-05-05 17:01:18'),
(141, 'qdck5dh2p4m9', 'PP', 10, 10, 10, 2, 4, 1, '2023-05-05 17:01:23'),
(142, 'qdck5dh2p4m9', 'OO', 10, 10, 10, 2, 4, 1, '2023-05-05 17:01:27'),
(143, 'qdck5dh2p4m9', 'NN', 10, 10, 10, 2, 4, 1, '2023-05-05 17:01:32'),
(144, 'qdck5dh2p4m9', 'MM', 10, 10, 10, 2, 4, 1, '2023-05-05 17:01:36'),
(145, 'qdck5dh2p4m9', 'LL', 10, 10, 10, 2, 4, 1, '2023-05-05 17:01:41'),
(146, 'qdck5dh2p4m9', 'KK', 10, 10, 10, 2, 4, 1, '2023-05-05 17:01:46'),
(147, 'qdck5dh2p4m9', 'JJ', 10, 10, 10, 2, 4, 1, '2023-05-05 17:01:53'),
(148, 'qdck5dh2p4m9', 'II', 10, 10, 10, 2, 4, 1, '2023-05-05 17:01:58'),
(149, 'qdck5dh2p4m9', 'HH', 10, 10, 10, 2, 4, 1, '2023-05-05 17:02:02'),
(150, 'qdck5dh2p4m9', 'GG', 7, 7, 7, 2, 4, 1, '2023-05-05 17:02:07'),
(151, 'qdck5dh2p4m9', 'FF', 7, 7, 7, 2, 4, 1, '2023-05-05 17:02:11'),
(152, 'qdck5dh2p4m9', 'EE', 8, 8, 8, 2, 4, 1, '2023-05-05 17:02:14'),
(153, 'qdck5dh2p4m9', 'DD', 9, 9, 9, 2, 4, 1, '2023-05-05 17:02:19'),
(154, 'qdck5dh2p4m9', 'CC', 10, 10, 10, 2, 4, 1, '2023-05-05 17:07:05'),
(155, 'qdck5dh2p4m9', 'BB', 8, 8, 8, 2, 4, 1, '2023-05-05 17:05:38'),
(156, 'qdck5dh2p4m9', 'AA', 8, 8, 8, 2, 4, 1, '2023-05-06 19:05:52'),
(183, 'rqsyxNErT6mo', 'TISSUE', 10, 8, 8, 1, 2, 1, '2023-05-08 12:09:34'),
(184, 'rqsyxNErT6mo', 'SURF', 10, 9, 9, 1, 3, 1, '2023-05-08 17:52:44'),
(185, 'rqsyxNErT6mo', 'MILK', 10, 8, 8, 1, 5, 1, '2023-05-08 17:52:59'),
(186, 'rqsyxNErT6mo', 'SALT', 5, 4, 4, 1, 3, 1, '2023-05-08 12:10:05'),
(187, 'rqsyxNErT6mo', 'RICE', 15, 13, 13, 2, 3, 1, '2023-05-08 12:10:10'),
(188, 'rqsyxNErT6mo', 'SUGAR', 10, 10, 10, 2, 3, 1, '2023-05-08 12:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `stockTakeMain`
--

CREATE TABLE `stockTakeMain` (
  `id` int(11) NOT NULL,
  `uid` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `addedBY` int(11) NOT NULL,
  `lastUpdatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockTakeMain`
--

INSERT INTO `stockTakeMain` (`id`, `uid`, `status`, `dateAdded`, `lastUpdated`, `addedBY`, `lastUpdatedBy`) VALUES
(11, 'wCoujt04XZSo', 1, '2023-05-01 14:00:57', '2023-05-05 15:57:58', 1, 1),
(14, 'Y51G2TrNHJWi', 1, '2023-05-02 16:25:53', '2023-05-02 14:29:13', 1, 1),
(15, 'qdck5dh2p4m9', 1, '2023-05-05 19:00:26', '2023-05-06 19:05:10', 1, 1),
(17, 'rqsyxNErT6mo', 1, '2023-05-08 14:06:34', '2023-05-08 12:10:15', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userRoles`
--

CREATE TABLE `userRoles` (
  `id` int(11) NOT NULL,
  `viewName` varchar(225) NOT NULL,
  `valueName` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userRoles`
--

INSERT INTO `userRoles` (`id`, `viewName`, `valueName`) VALUES
(1, 'Cashier', 'cashier');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `loginID` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role` varchar(225) NOT NULL,
  `lastLogin` varchar(225) NOT NULL,
  `joined` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `loginID`, `password`, `role`, `lastLogin`, `joined`, `status`, `lastUpdated`) VALUES
(1, 'ADMIN', '$2y$10$l0qigAWpY2xIsxXiZAzgjuFvxkMfI/FfzqutvN8DhgdSdMOHfitbG', 'admin', '2023-05-08 19:49:05', '2022-11-07 05:11:20', 1, '2023-05-08 17:49:05'),
(57, 'CASHIER', '$2y$10$dwUp7zOwAVjy0z8Q2fRzfuTRIERRC1xoqT6clsJf0bfqTSYRnm9s.', 'cashier', '2023-05-08 14:02:44', '2023-02-08 09:22:49', 1, '2023-05-08 12:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `webDetails`
--

CREATE TABLE `webDetails` (
  `id` int(11) NOT NULL,
  `webYear` varchar(225) NOT NULL,
  `webNameFull` varchar(225) NOT NULL,
  `webNameShort` varchar(225) NOT NULL,
  `webLogo` varchar(225) NOT NULL,
  `webSlogan` varchar(225) NOT NULL,
  `webFooter` varchar(225) NOT NULL,
  `webDescription` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `webDetails`
--

INSERT INTO `webDetails` (`id`, `webYear`, `webNameFull`, `webNameShort`, `webLogo`, `webSlogan`, `webFooter`, `webDescription`) VALUES
(1, '2023', 'Wrapthem Investments', 'W-I', 'assets/img/undraw_rocket.svg', 'WrapThem Investments', 'WrepThem Investments Shop No, 41 Highglen Shopping Center', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashier`
--
ALTER TABLE `cashier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockTakeChild`
--
ALTER TABLE `stockTakeChild`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockTakeMain`
--
ALTER TABLE `stockTakeMain`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `userRoles`
--
ALTER TABLE `userRoles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loginID` (`loginID`);

--
-- Indexes for table `webDetails`
--
ALTER TABLE `webDetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `cashier`
--
ALTER TABLE `cashier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `stockTakeChild`
--
ALTER TABLE `stockTakeChild`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `stockTakeMain`
--
ALTER TABLE `stockTakeMain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `userRoles`
--
ALTER TABLE `userRoles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
