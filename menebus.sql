-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2021 at 09:54 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `menebus`
--

-- --------------------------------------------------------

--
-- Table structure for table `giftdata`
--

CREATE TABLE `giftdata` (
  `thumbnail` varchar(50) NOT NULL,
  `id` int(5) NOT NULL,
  `gifttitle` varchar(50) NOT NULL,
  `giftprice` varchar(20) NOT NULL,
  `sUname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `giftdata`
--

INSERT INTO `giftdata` (`thumbnail`, `id`, `gifttitle`, `giftprice`, `sUname`) VALUES
('1.jpg', 9, 'Gift3', '100', 'seller1'),
('2.jpg', 10, 'Gift1', '150', 'seller5'),
('7.jpg', 11, 'Gift2', '120', 'seller1');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(100) NOT NULL,
  `seller_Username` varchar(100) NOT NULL,
  `buyer_Username` varchar(100) NOT NULL,
  `Card_Price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `seller_Username`, `buyer_Username`, `Card_Price`) VALUES
(1, 'seller1', 'user1', 100),
(2, 'seller1', 'user2', 120),
(3, 'seller2', 'user1', 160),
(4, 'seller2', 'user2', 180),
(5, 'seller1', 'user3', 100);

-- --------------------------------------------------------

--
-- Table structure for table `sellerdata`
--

CREATE TABLE `sellerdata` (
  `sellerName` varchar(50) NOT NULL,
  `sellerAddress` varchar(50) NOT NULL,
  `id` int(5) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `confirmpass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellerdata`
--

INSERT INTO `sellerdata` (`sellerName`, `sellerAddress`, `id`, `userName`, `email`, `password`, `confirmpass`) VALUES
('seller2', 'dhaka', 3, 'seller2', 'seller2@gmail.com', '1234', '1234'),
('seller4', 'dhaka', 5, 'seller4', 'seller4@gmail.com', '1234', '1234'),
('seller1', 'dhaka', 6, 'seller1', 'seller1@gmail.com', '1111', '1111'),
('seller3', ',dhaka', 7, 'seller3', 'seller3@gmail.com', '1234', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`id`, `name`, `phone`, `email`, `comment`) VALUES
(3, 'zif', '1212121212', 'zif@gmail.com', '	hello				');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(100) NOT NULL,
  `seller_Username` varchar(100) NOT NULL,
  `buyer_Username` varchar(100) NOT NULL,
  `amount` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `seller_Username`, `buyer_Username`, `amount`) VALUES
(1, 'seller1', 'user1', 220),
(2, 'seller1', 'user1', 150),
(3, 'seller2', 'user1', 120),
(4, 'seller2', 'user2', 120);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `giftdata`
--
ALTER TABLE `giftdata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellerdata`
--
ALTER TABLE `sellerdata`
  ADD PRIMARY KEY (`id`,`userName`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `giftdata`
--
ALTER TABLE `giftdata`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sellerdata`
--
ALTER TABLE `sellerdata`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
