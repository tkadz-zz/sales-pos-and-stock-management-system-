-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 11, 2023 at 05:10 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stockTakeMain`
--
ALTER TABLE `stockTakeMain`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stockTakeMain`
--
ALTER TABLE `stockTakeMain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
