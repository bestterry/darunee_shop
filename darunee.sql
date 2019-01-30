-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2019 at 08:14 AM
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
(1, 'ซอฟต์ฮอมดี้', 100, 'ลัง', 'health'),
(2, 'ซอฟท์ฮอมดี้', 100, 'ขวด', 'health'),
(3, 'เครื่องดื่มสมุนไพร HOMDY', 100, 'ลัง', 'health'),
(4, 'เครื่องดื่มสมุนไพร HOMDY', 83, 'ขวด', 'health'),
(5, 'สบู่ วีฮาร่า', 91, 'ลัง', 'health'),
(6, 'สบู่ วีฮาร่า', 85, 'ก้อน', 'health'),
(7, 'กาแฟเซินถี่', 96, 'กล่อง', 'health'),
(8, 'กาแฟเซินถี่', 100, 'ซอง', 'health'),
(9, 'น้ำปลาร้า เด็ม เด็ม', 87, 'ลัง', 'health'),
(10, 'น้ำปลาร้า เด็ม เด็ม', 100, 'ขวด', 'health'),
(11, 'สารปรับปรุงดินโซเล่', 95, 'กระสอบ', 'farm'),
(12, 'ปุ๋ยอินทรีย์กวางเหรียญทอง', 88, 'กระสอบ', 'farm'),
(13, 'ปุ๋ยเคมีบอมก้า (สีเขียว) 27-12-8', 100, 'กระสอบ', 'farm'),
(14, 'ปุ๋ยเคมีบอมก้า (สีแดง) 29-5-18', 100, 'กระสอบ', 'farm'),
(15, 'ปุ๋ยเคมีบอมก้า (สีเหลือง) 16-6-26', 100, 'กระสอบ', 'farm'),
(16, 'ปุ๋ยเคมีบอมก้า (สีส้ม) 16-16-16', 100, 'กระสอบ', 'farm'),
(17, 'น้ำสมุนไพรเทียนหลง', 98, 'ขวด', 'health'),
(18, 'น้ำสมุนไพรอินทรา', 98, 'ขวด', 'health');

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
(29, 3, 2, '1400', 'sale', '2019-01-29 13:16:43'),
(30, 4, 2, '60', 'sale', '2019-01-29 13:16:43'),
(31, 3, 2, '1400', 'sale', '2019-01-29 14:03:14'),
(32, 4, 2, '60', 'sale', '2019-01-29 14:03:14'),
(33, 3, 2, '1400', 'sale', '2019-01-29 14:03:47'),
(34, 4, 2, '60', 'sale', '2019-01-29 14:03:47'),
(35, 3, 5, '3000', 'sale', '2019-01-29 14:13:41'),
(36, 4, 2, '60', 'sale', '2019-01-29 14:13:42'),
(37, 3, 5, '3000', 'sale', '2019-01-29 14:15:12'),
(38, 4, 2, '60', 'sale', '2019-01-29 14:15:12'),
(39, 3, 5, '3000', 'sale', '2019-01-29 14:16:29'),
(40, 4, 2, '60', 'sale', '2019-01-29 14:16:29'),
(41, 3, 5, '3000', 'sale', '2019-01-29 14:19:30'),
(42, 4, 2, '60', 'sale', '2019-01-29 14:19:30'),
(43, 1, 5, '2000', 'sale', '2019-01-29 15:36:21'),
(44, 3, 4, '800', 'sale', '2019-01-29 15:36:22'),
(45, 4, 3, '900', 'sale', '2019-01-29 15:36:22'),
(46, 6, 4, '2400', 'sale', '2019-01-30 09:25:16'),
(47, 7, 4, '1200', 'sale', '2019-01-30 09:25:16'),
(48, 17, 2, '600', 'sale', '2019-01-30 09:25:55'),
(49, 18, 2, '200', 'sale', '2019-01-30 09:25:55');

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
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sale_history`
--
ALTER TABLE `sale_history`
  MODIFY `id_sale_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
