-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2019 at 03:58 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `darunee`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `username`, `password`) VALUES
(1, 'best', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `name_product` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_product` int(11) DEFAULT NULL,
  `unit` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('health','farm') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `name_product`, `num_product`, `unit`, `status`) VALUES
(1, 'ซอฟต์ฮอมดี้', 135, 'ลัง', 'health'),
(2, 'ซอฟท์ฮอมดี้', 38, 'ขวด', 'health'),
(3, 'เครื่องดื่มสมุนไพร HOMDY', 54, 'ลัง', 'health'),
(4, 'เครื่องดื่มสมุนไพร HOMDY', 52, 'ขวด', 'health'),
(5, 'สบู่ วีฮาร่า', 46, 'ลัง', 'health'),
(6, 'สบู่ วีฮาร่า', 50, 'ก้อน', 'health'),
(7, 'กาแฟเซินถี่', 85, 'กล่อง', 'health'),
(8, 'กาแฟเซินถี่', 70, 'ซอง', 'health'),
(9, 'น้ำปลาร้า เด็ม เด็ม', 71, 'ลัง', 'health'),
(10, 'น้ำปลาร้า เด็ม เด็ม', 89, 'ขวด', 'health'),
(11, 'สารปรับปรุงดินโซเล่', 49, 'กระสอบ', 'farm'),
(12, 'ปุ๋ยอินทรีย์กวางเหรียญทอง', 71, 'กระสอบ', 'farm'),
(13, 'ปุ๋ยเคมีบอมก้า (สีเขียว) 27-12-8', 93, 'กระสอบ', 'farm'),
(14, 'ปุ๋ยเคมีบอมก้า (สีแดง) 29-5-18', 93, 'กระสอบ', 'farm'),
(15, 'ปุ๋ยเคมีบอมก้า (สีเหลือง) 16-6-26', 82, 'กระสอบ', 'farm'),
(16, 'ปุ๋ยเคมีบอมก้า (สีส้ม) 16-16-16', 81, 'กระสอบ', 'farm'),
(17, 'น้ำสมุนไพรเทียนหลง', 89, 'ขวด', 'health'),
(18, 'น้ำสมุนไพรอินทรา', 91, 'ขวด', 'health');

-- --------------------------------------------------------

--
-- Table structure for table `sale_history`
--

CREATE TABLE `sale_history` (
  `id_sale_history` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `num_sale` int(11) DEFAULT NULL,
  `price` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_draw` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_sale` enum('sale','draw') COLLATE utf8_unicode_ci DEFAULT NULL,
  `datetime` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sale_history`
--

INSERT INTO `sale_history` (`id_sale_history`, `id_product`, `num_sale`, `price`, `name_draw`, `status_sale`, `datetime`) VALUES
(32, 15, 1, '0', 'พี่วาน', 'draw', '2019-02-06 14:15:39'),
(33, 16, 3, '0', 'พี่วาน', 'draw', '2019-02-06 14:15:39'),
(34, 3, 5, '5000', '-', 'sale', '2019-02-06 14:18:09'),
(35, 6, 2, '100', '-', 'sale', '2019-02-06 14:18:09'),
(36, 8, 5, '100', '-', 'sale', '2019-02-06 14:18:09'),
(37, 11, 4, '1480', '-', 'sale', '2019-02-06 14:18:09'),
(38, 1, 4, '2800', '-', 'sale', '2019-02-06 14:19:21'),
(39, 4, 2, '60', '-', 'sale', '2019-02-06 14:19:21'),
(40, 6, 4, '120', '-', 'sale', '2019-02-06 14:19:21'),
(41, 8, 4, '120', '-', 'sale', '2019-02-06 14:19:21'),
(42, 11, 7, '0', 'พี่เกียติ', 'draw', '2019-02-06 14:20:36'),
(43, 2, 5, '75', '-', 'sale', '2019-02-07 08:33:36'),
(44, 5, 5, '1500', '-', 'sale', '2019-02-07 08:33:37'),
(45, 10, 4, '80', '-', 'sale', '2019-02-07 08:33:37'),
(46, 11, 4, '1480', '-', 'sale', '2019-02-07 08:33:37'),
(47, 12, 8, '2800', '-', 'sale', '2019-02-07 08:33:37'),
(48, 1, 4, '1600', '-', 'sale', '2019-02-07 08:34:55'),
(49, 2, 4, '60', '-', 'sale', '2019-02-07 08:34:55'),
(50, 6, 5, '200', '-', 'sale', '2019-02-07 08:34:55'),
(51, 9, 4, '2800', '-', 'sale', '2019-02-07 08:34:55'),
(52, 11, 20, '7400', '-', 'sale', '2019-02-07 08:34:55'),
(53, 12, 2, '620', '-', 'sale', '2019-02-07 08:34:55'),
(54, 1, 5, '500', '-', 'sale', '2019-02-07 09:06:57'),
(55, 2, 5, '500', '-', 'sale', '2019-02-07 09:06:57'),
(56, 3, 5, '500', '-', 'sale', '2019-02-07 09:06:58'),
(57, 4, 5, '500', '-', 'sale', '2019-02-07 09:06:58'),
(58, 5, 5, '500', '-', 'sale', '2019-02-07 09:06:58'),
(59, 6, 5, '500', '-', 'sale', '2019-02-07 09:06:58'),
(60, 7, 5, '500', '-', 'sale', '2019-02-07 09:06:58'),
(61, 8, 5, '500', '-', 'sale', '2019-02-07 09:06:58'),
(62, 9, 5, '500', '-', 'sale', '2019-02-07 09:06:58'),
(63, 10, 5, '500', '-', 'sale', '2019-02-07 09:06:59'),
(64, 11, 5, '500', '-', 'sale', '2019-02-07 09:06:59'),
(65, 12, 5, '500', '-', 'sale', '2019-02-07 09:06:59'),
(66, 13, 5, '500', '-', 'sale', '2019-02-07 09:06:59'),
(67, 14, 5, '500', '-', 'sale', '2019-02-07 09:06:59'),
(68, 15, 5, '500', '-', 'sale', '2019-02-07 09:06:59'),
(69, 16, 5, '500', '-', 'sale', '2019-02-07 09:06:59'),
(70, 17, 5, '500', '-', 'sale', '2019-02-07 09:06:59'),
(71, 18, 5, '500', '-', 'sale', '2019-02-07 09:06:59'),
(72, 1, 2, '18', '-', 'sale', '2019-02-07 09:09:17'),
(73, 2, 2, '18', '-', 'sale', '2019-02-07 09:09:18'),
(74, 3, 2, '18', '-', 'sale', '2019-02-07 09:09:18'),
(75, 4, 2, '198', '-', 'sale', '2019-02-07 09:09:18'),
(76, 5, 2, '18', '-', 'sale', '2019-02-07 09:09:18'),
(77, 6, 2, '18', '-', 'sale', '2019-02-07 09:09:18'),
(78, 7, 2, '18', '-', 'sale', '2019-02-07 09:09:18'),
(79, 8, 2, '90', '-', 'sale', '2019-02-07 09:09:18'),
(80, 9, 2, '912', '-', 'sale', '2019-02-07 09:09:18'),
(81, 10, 2, '1128', '-', 'sale', '2019-02-07 09:09:19'),
(82, 11, 2, '690', '-', 'sale', '2019-02-07 09:09:19'),
(83, 12, 2, '912', '-', 'sale', '2019-02-07 09:09:19'),
(84, 13, 2, '94', '-', 'sale', '2019-02-07 09:09:19'),
(85, 14, 2, '912', '-', 'sale', '2019-02-07 09:09:19'),
(86, 15, 2, '912', '-', 'sale', '2019-02-07 09:09:19'),
(87, 16, 2, '1572', '-', 'sale', '2019-02-07 09:09:20'),
(88, 17, 2, '1374', '-', 'sale', '2019-02-07 09:09:20'),
(89, 18, 2, '1574', '-', 'sale', '2019-02-07 09:09:20'),
(90, 1, 9, '5130', '-', 'sale', '2019-02-07 13:28:21'),
(91, 1, 5, '5000', '-', 'sale', '2019-02-08 10:47:14'),
(92, 2, 7, '14000', '-', 'sale', '2019-02-08 10:47:14'),
(93, 2, 2, '800', '-', 'sale', '2019-02-08 15:09:18'),
(94, 5, 2, '400', '-', 'sale', '2019-02-08 15:09:18'),
(95, 3, 4, '4000', '-', 'sale', '2019-02-08 15:54:19'),
(96, 6, 1, '441', '-', 'sale', '2019-02-08 15:54:20'),
(97, 7, 4, '1804', '-', 'sale', '2019-02-08 15:54:20'),
(98, 15, 5, '3900', '-', 'sale', '2019-02-08 15:54:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `sale_history`
--
ALTER TABLE `sale_history`
  ADD PRIMARY KEY (`id_sale_history`),
  ADD KEY `id_product` (`id_product`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sale_history`
--
ALTER TABLE `sale_history`
  MODIFY `id_sale_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
