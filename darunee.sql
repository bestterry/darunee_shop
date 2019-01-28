-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2019 at 04:08 AM
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
(1, 'ซอฟต์ฮอมดี้', 79, 'ลัง', 'health'),
(2, 'ซอฟท์ฮอมดี้', 94, 'ขวด', 'health'),
(3, 'สบู่ วีฮาร่า', 91, 'ลัง', 'health'),
(4, 'สบู่ วีฮาร่า', 89, 'กล่อง', 'health'),
(5, 'น้ำปลาร้า เด็ม เด็ม', 90, 'ลัง', 'health'),
(6, 'น้ำปลาร้า เด็ม เด็ม', 100, 'ขวด', 'health'),
(7, 'สารปรับปรุงดินโซเล่', 95, 'กระสอบ', 'farm'),
(8, 'ปุ๋ยอินทรีย์กวางเหรียญทอง', 88, 'กระสอบ', 'farm'),
(9, 'ปุ๋ยบอมก้า สีเขียว 27-12-8', 100, 'กระสอบ', 'farm'),
(10, 'ปุ๋ยบอมก้า สีแดง 29-5-18', 100, 'กระสอบ', 'farm'),
(11, 'ปุ๋ยบอมก้า สีเหลือง 16-6-26', 100, 'กระสอบ', 'farm'),
(12, 'ปุ๋ยบอมก้า สีส้ม 16-16-16', 100, 'กระสอบ', 'farm'),
(13, 'กาแฟเซินถี่', 100, 'กล่อง', 'health'),
(14, 'กาแฟเซินถี่', 100, 'ซอง', 'health'),
(15, 'น้ำสมุนไพรเทียนหลง', 100, 'ขวด', 'health'),
(16, 'น้ำสมุนไพรอินทรา', 100, 'ขวด', 'health');

-- --------------------------------------------------------

--
-- Table structure for table `sale_history`
--

CREATE TABLE `sale_history` (
  `id_sale_history` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `num_sale` int(11) DEFAULT NULL,
  `price` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_sale` enum('sale','import') COLLATE utf8_unicode_ci DEFAULT NULL,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sale_history`
--

INSERT INTO `sale_history` (`id_sale_history`, `id_product`, `num_sale`, `price`, `status_sale`, `datetime`) VALUES
(17, 1, 5, '1000', 'sale', '2019-01-26 10:54:08'),
(18, 3, 4, '2000', 'sale', '2019-01-26 10:54:08'),
(19, 4, 1, '200', 'sale', '2019-01-26 10:54:08'),
(20, 1, 4, '2000', 'sale', '2019-01-26 10:55:08'),
(21, 3, 5, '1000', 'sale', '2019-01-26 10:55:08'),
(22, 4, 4, '1200', 'sale', '2019-01-26 10:55:08'),
(23, 1, 5, '2000', 'sale', '2019-01-26 11:52:17'),
(24, 8, 4, '1200', 'sale', '2019-01-26 11:52:17'),
(25, 1, 2, '600', 'sale', '2019-01-26 11:53:21'),
(26, 8, 4, '1600', 'sale', '2019-01-26 11:53:21');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sale_history`
--
ALTER TABLE `sale_history`
  MODIFY `id_sale_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sale_history`
--
ALTER TABLE `sale_history`
  ADD CONSTRAINT `FK_sale_history_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
