-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 11, 2023 at 05:09 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stockTakeChild`
--
ALTER TABLE `stockTakeChild`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stockTakeChild`
--
ALTER TABLE `stockTakeChild`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
