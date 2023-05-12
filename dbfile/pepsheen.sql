-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 12, 2023 at 12:10 PM
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
-- Database: `pepsheen`
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
(145, 'yT7OruunlZdt', 63, 2, 6300, 'card rtgs', '2023-05-08 14:03:48', '2023-05-11 22:08:20', '', ''),
(146, 'yT7OruunlZdt', 66, 2, 2100, 'card rtgs', '2023-05-08 14:03:48', '2023-05-11 22:08:20', '', '');

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
(1, 'bond', 1400, '2023-02-12 09:28:14', '2023-05-12 10:05:59'),
(2, 'rtgs', 1600, '2023-02-11 09:28:14', '2023-05-12 10:06:08'),
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
(62, 'SUGAR', '', 10, 2, 3, 10, 2, 3, '2023-05-12 12:05:23', 0, '2023-05-12 10:05:23'),
(63, 'RICE', '', 10, 2, 3, 10, 2, 3, '2023-05-12 12:05:15', 0, '2023-05-12 10:05:15'),
(64, 'TISSUE', '', 10, 1, 2, 10, 1, 2, '2023-05-12 12:04:37', 0, '2023-05-12 10:04:37'),
(65, 'SALT', '', 5, 1, 3, 5, 1, 3, '2023-05-12 12:05:08', 0, '2023-05-12 10:05:08'),
(66, 'MILK', '', 5, 0.9, 1, 5, 0.9, 1, '2023-05-12 12:04:47', 0, '2023-05-12 10:04:47'),
(67, 'SURF', '', 5, 1, 3, 5, 1, 3, '2023-05-12 12:04:58', 0, '2023-05-12 10:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `stockTakeChild`
--

CREATE TABLE `stockTakeChild` (
  `id` int(11) NOT NULL,
  `stockID` int(11) NOT NULL,
  `uid` varchar(225) NOT NULL,
  `stockName` varchar(225) NOT NULL,
  `stockDBNetQuantity` int(11) NOT NULL,
  `stockDBGrossQuantity` int(11) NOT NULL,
  `stockPhysicalQuantity` int(11) NOT NULL,
  `stockBuyingPrice` float NOT NULL,
  `stockSellingPrice` float NOT NULL,
  `status` int(11) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'ADMIN', '$2y$10$l0qigAWpY2xIsxXiZAzgjuFvxkMfI/FfzqutvN8DhgdSdMOHfitbG', 'admin', '2023-05-12 00:05:18', '2022-11-07 05:11:20', 1, '2023-05-11 22:05:18'),
(57, 'CASHIER', '$2y$10$dwUp7zOwAVjy0z8Q2fRzfuTRIERRC1xoqT6clsJf0bfqTSYRnm9s.', 'cashier', '2023-05-12 00:15:48', '2023-02-08 09:22:49', 1, '2023-05-11 22:15:48');

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
(1, '2023', 'Pepsheen', 'PS', 'assets/img/undraw_rocket.svg', 'Pepsheen Pvt Ltd', 'Pepsheen Pvt Ltd. All right reserved', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `stockTakeMain`
--
ALTER TABLE `stockTakeMain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
