-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2019 at 03:12 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

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
(1, 'ซอฟต์ฮอมดี้', 1048, 'ลัง', 'health'),
(2, 'ซอฟท์ฮอมดี้', 26, 'ขวด', 'health'),
(3, 'เครื่องดื่มสมุนไพร HOMDY', 0, 'ลัง', 'health'),
(4, 'เครื่องดื่มสมุนไพร HOMDY', 22, 'ขวด', 'health'),
(5, 'สบู่ วีฮาร่า', 4, 'ลัง', 'health'),
(6, 'สบู่ วีฮาร่า', 66, 'ก้อน', 'health'),
(7, 'กาแฟเซินถี่', 81, 'กล่อง', 'health'),
(8, 'กาแฟเซินถี่', 1, 'ซอง', 'health'),
(9, 'น้ำปลาร้า เด็ม เด็ม', 127, 'ลัง', 'health'),
(10, 'น้ำปลาร้า เด็ม เด็ม', 9, 'ขวด', 'health'),
(11, 'สารปรับปรุงดินโซเล่', 28, 'กระสอบ', 'farm'),
(12, 'ปุ๋ยอินทรีย์กวางเหรียญทอง', 5, 'กระสอบ', 'farm'),
(13, 'ปุ๋ยเคมีบอมก้า (สีเขียว) 27-12-8', 0, 'กระสอบ', 'farm'),
(14, 'ปุ๋ยเคมีบอมก้า (สีแดง) 29-5-18', 0, 'กระสอบ', 'farm'),
(15, 'ปุ๋ยเคมีบอมก้า (สีเหลือง) 16-6-26', 8, 'กระสอบ', 'farm'),
(16, 'ปุ๋ยเคมีบอมก้า (สีส้ม) 16-16-16', 74, 'กระสอบ', 'farm'),
(17, 'น้ำสมุนไพรเทียนหลง', 6, 'ขวด', 'health'),
(18, 'น้ำสมุนไพรอินทรา', 14, 'ขวด', 'health'),
(19, 'กาโว', 107, 'ขวด', 'farm'),
(20, 'แซมบ้า', 78, 'ขวด', 'farm'),
(21, 'มิกซ์พลัส', 4, 'ขวด', 'farm'),
(22, 'เบสส์สต็อป', 58, 'ขวด', 'farm'),
(23, 'บราซิล', 14, 'ขวด', 'farm'),
(24, 'ลิตต์โตโต้', 7, 'ขวด', 'farm'),
(25, 'ซามูไร', 69, 'ขวด', 'farm'),
(26, 'ทอง(แหวน)', 1, 'วง', 'health'),
(27, 'เจี้ยนคัง', 34, 'ลัง', 'health'),
(28, 'เจี้ยงคัง', 22, 'ขวด', 'health'),
(29, '', 0, '', 'farm'),
(30, 'กรด', 101, 'ลัง', 'farm');

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
  `status_sale` enum('sale','import') COLLATE utf8_unicode_ci DEFAULT NULL,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sale_history`
--

INSERT INTO `sale_history` (`id_sale_history`, `id_product`, `num_sale`, `price`, `name_draw`, `status_sale`, `datetime`) VALUES
(1, 2, 1, '0', NULL, 'sale', '2019-02-05 12:41:45'),
(2, 3, 1, '0', NULL, 'sale', '2019-02-05 12:41:45'),
(3, 11, 6, '2220', NULL, 'sale', '2019-02-05 13:18:21'),
(4, 11, 6, '2220', NULL, 'sale', '2019-02-05 13:19:19'),
(5, 11, 2, '740', NULL, 'sale', '2019-02-05 13:43:35'),
(6, 9, 1, '400', NULL, 'sale', '2019-02-05 13:48:50'),
(7, 11, 2, '740', NULL, 'sale', '2019-02-05 13:48:50'),
(8, 7, 2, '1000', NULL, 'sale', '2019-02-05 13:51:07'),
(9, 12, 3, '960', NULL, 'sale', '2019-02-05 13:51:07'),
(10, 1, 1, '576', NULL, 'sale', '2019-02-05 14:16:14'),
(11, 3, 3, '1728', NULL, 'sale', '2019-02-05 15:24:51'),
(12, 10, 12, '240', NULL, 'sale', '2019-02-05 15:24:51'),
(13, 11, 3, '1110', NULL, 'sale', '2019-02-05 15:24:51'),
(14, 12, 2, '640', NULL, 'sale', '2019-02-05 15:24:51'),
(15, 13, 2, '1620', NULL, 'sale', '2019-02-05 15:24:51'),
(16, 1, 3, '1728', NULL, 'sale', '2019-02-05 15:33:18'),
(17, 11, 3, '1110', NULL, 'sale', '2019-02-05 15:33:18'),
(18, 12, 2, '640', NULL, 'sale', '2019-02-05 15:33:18'),
(19, 13, 2, '1620', NULL, 'sale', '2019-02-05 15:33:19'),
(20, 1, 3, '1728', NULL, 'sale', '2019-02-05 15:38:13'),
(21, 10, 12, '240', NULL, 'sale', '2019-02-05 15:38:13'),
(22, 11, 3, '1110', NULL, 'sale', '2019-02-05 15:38:13'),
(23, 12, 2, '640', NULL, 'sale', '2019-02-05 15:38:13'),
(24, 1, 3, '1728', NULL, 'sale', '2019-02-05 15:41:18'),
(25, 10, 12, '240', NULL, 'sale', '2019-02-05 15:41:18'),
(26, 11, 3, '1110', NULL, 'sale', '2019-02-05 15:41:18'),
(27, 12, 2, '640', NULL, 'sale', '2019-02-05 15:41:18'),
(28, 13, 2, '1620', NULL, 'sale', '2019-02-05 15:41:18'),
(29, 1, 3, '1728', NULL, 'sale', '2019-02-05 15:46:56'),
(30, 10, 12, '240', NULL, 'sale', '2019-02-05 15:46:56'),
(31, 11, 3, '1110', NULL, 'sale', '2019-02-05 15:46:56'),
(32, 12, 2, '640', NULL, 'sale', '2019-02-05 15:46:56'),
(33, 13, 2, '1620', NULL, 'sale', '2019-02-05 15:46:56'),
(34, 1, 20, '0', NULL, 'sale', '2019-02-05 15:53:42'),
(35, 7, 10, '0', NULL, 'sale', '2019-02-05 15:53:42'),
(36, 11, 50, '0', NULL, 'sale', '2019-02-05 15:53:42'),
(37, 12, 20, '0', NULL, 'sale', '2019-02-05 15:53:42'),
(38, 11, 1, '370', NULL, 'sale', '2019-02-06 08:45:33'),
(39, 4, 12, '300', NULL, 'sale', '2019-02-06 09:52:09'),
(40, 1, 20, '0', NULL, 'sale', '2019-02-06 11:52:11'),
(41, 1, 20, '11520', NULL, 'sale', '2019-02-06 11:54:12'),
(42, 19, 1, '350', NULL, 'sale', '2019-02-06 12:55:04'),
(43, 21, 1, '350', NULL, 'sale', '2019-02-06 12:55:05'),
(44, 11, 1, '0', NULL, 'sale', '2019-02-06 15:24:18'),
(45, 14, 3, '0', NULL, 'sale', '2019-02-06 15:24:18'),
(46, 11, 1, '0', NULL, 'sale', '2019-02-06 15:25:00'),
(47, 13, 3, '0', NULL, 'sale', '2019-02-06 15:25:00'),
(48, 14, 5, '0', NULL, 'sale', '2019-02-06 15:25:00'),
(49, 13, 3, '2430', NULL, 'sale', '2019-02-06 15:29:21'),
(50, 14, 4, '3240', NULL, 'sale', '2019-02-06 15:29:21'),
(51, 14, 1, '0', NULL, 'sale', '2019-02-06 15:30:35'),
(52, 14, 1, '810', NULL, 'sale', '2019-02-06 15:38:54'),
(53, 4, 1, '0', NULL, 'sale', '2019-02-07 08:25:25'),
(54, 11, 13, '0', NULL, 'sale', '2019-02-07 08:25:25'),
(55, 30, 10, '0', NULL, 'sale', '2019-02-07 08:25:25'),
(56, 1, 2, '1152', NULL, 'sale', '2019-02-07 08:26:15'),
(57, 3, 1, '1200', NULL, 'sale', '2019-02-07 08:26:15'),
(58, 4, 8, '200', NULL, 'sale', '2019-02-07 08:26:15'),
(59, 11, 13, '4810', NULL, 'sale', '2019-02-07 08:26:15'),
(60, 30, 10, '1700', NULL, 'sale', '2019-02-07 08:26:15'),
(61, 11, 1, '370', NULL, 'sale', '2019-02-07 10:02:03'),
(62, 12, 1, '320', NULL, 'sale', '2019-02-07 10:02:03'),
(63, 16, 2, '1620', NULL, 'sale', '2019-02-07 10:02:03'),
(64, 11, 1, '370', NULL, 'sale', '2019-02-07 10:02:36'),
(65, 12, 1, '320', NULL, 'sale', '2019-02-07 10:02:36'),
(66, 16, 2, '1420', NULL, 'sale', '2019-02-07 10:02:36'),
(67, 11, 68, '25160', NULL, 'sale', '2019-02-07 10:05:15'),
(68, 30, 11, '1870', NULL, 'sale', '2019-02-07 10:06:29'),
(69, 19, 2, '700', NULL, 'sale', '2019-02-07 10:07:50'),
(70, 20, 1, '350', NULL, 'sale', '2019-02-07 10:07:50'),
(71, 1, 36, '20736', NULL, 'sale', '2019-02-07 10:08:31'),
(72, 27, 1, '760', NULL, 'sale', '2019-02-07 10:09:17'),
(73, 12, 20, '6400', NULL, 'sale', '2019-02-07 10:09:56'),
(74, 12, 1, '320', NULL, 'sale', '2019-02-07 10:10:36'),
(75, 3, 2, '2400', NULL, 'sale', '2019-02-07 10:11:04'),
(76, 9, 8, '3200', NULL, 'sale', '2019-02-07 10:12:23'),
(77, 4, 20, '500', NULL, 'sale', '2019-02-07 10:13:04'),
(78, 4, 20, '500', NULL, 'sale', '2019-02-07 10:15:40'),
(79, 1, 4, '0', 'พี่เอ-พี่วาน', '', '2019-02-07 11:20:21'),
(80, 9, 1, '0', 'พี่เอ-พี่วาน', '', '2019-02-07 11:20:21'),
(81, 11, 6, '0', 'พี่เอ-พี่วาน', '', '2019-02-07 11:20:21'),
(82, 12, 4, '0', 'พี่เอ-พี่วาน', '', '2019-02-07 11:20:21'),
(83, 1, 6, '0', 'วาน+เอ', '', '2019-02-07 11:24:29'),
(84, 5, 2, '0', 'วาน+เอ', '', '2019-02-07 11:24:29'),
(85, 9, 1, '0', 'วาน+เอ', '', '2019-02-07 11:24:29'),
(86, 11, 53, '0', 'วาน+เอ', '', '2019-02-07 11:24:29'),
(87, 12, 20, '0', 'วาน+เอ', '', '2019-02-07 11:24:29'),
(88, 27, 1, '0', 'วาน+เอ', '', '2019-02-07 11:24:29'),
(89, 11, 3, '1110', '-', 'sale', '2019-02-07 12:11:39'),
(90, 7, 3, '3000', '-', 'sale', '2019-02-07 12:15:16'),
(91, 12, 1, '320', '-', 'sale', '2019-02-07 12:16:35'),
(92, 25, 2, '900', '-', 'sale', '2019-02-07 12:18:25'),
(93, 11, 1, '370', '-', 'sale', '2019-02-07 13:17:51'),
(94, 10, 1, '20', '-', 'sale', '2019-02-07 13:44:14'),
(95, 11, 1, '370', '-', 'sale', '2019-02-07 13:44:14'),
(96, 12, 2, '640', '-', 'sale', '2019-02-07 13:44:14'),
(97, 1, 576, '576000', '-', 'sale', '2019-02-07 13:53:27'),
(98, 1, 1, '576', '-', 'sale', '2019-02-07 13:53:37'),
(99, 1, 30, '0', 'พี่ลิน', '', '2019-02-07 14:46:52'),
(100, 5, 1, '0', 'พี่ลิน', '', '2019-02-07 14:46:52'),
(101, 9, 2, '0', 'พี่ลิน', '', '2019-02-07 14:46:52'),
(102, 9, 2, '0', 'พี่เอ๋', '', '2019-02-08 07:49:23'),
(103, 11, 5, '1850', '-', 'sale', '2019-02-08 09:18:34'),
(104, 11, 5, '1500', '-', 'sale', '2019-02-08 09:19:42'),
(105, 11, 2, '740', '-', 'sale', '2019-02-08 09:39:17'),
(106, 12, 1, '320', '-', 'sale', '2019-02-08 09:39:17'),
(107, 11, 2, '740', '-', 'sale', '2019-02-08 09:39:35'),
(108, 12, 2, '640', '-', 'sale', '2019-02-08 09:39:35'),
(109, 7, 3, '3000', '-', 'sale', '2019-02-08 09:50:30'),
(110, 20, 1, '350', '-', 'sale', '2019-02-08 10:11:33'),
(111, 25, 1, '450', '-', 'sale', '2019-02-08 10:11:33'),
(112, 5, 1, '30', '-', 'sale', '2019-02-08 10:29:09'),
(113, 7, 6, '3000', '-', 'sale', '2019-02-08 10:29:09'),
(114, 9, 1, '330', '-', 'sale', '2019-02-08 10:29:10'),
(115, 5, 1, '1440', '-', 'sale', '2019-02-08 10:29:42'),
(116, 7, 6, '3000', '-', 'sale', '2019-02-08 10:29:43'),
(117, 9, 1, '330', '-', 'sale', '2019-02-08 10:29:43'),
(118, 5, 1, '1440', '-', 'sale', '2019-02-08 10:30:05'),
(119, 7, 6, '1500', '-', 'sale', '2019-02-08 10:30:05'),
(120, 9, 1, '330', '-', 'sale', '2019-02-08 10:30:05'),
(121, 5, 1, '1440', '-', 'sale', '2019-02-08 10:30:34'),
(122, 7, 6, '3000', '-', 'sale', '2019-02-08 10:30:34'),
(123, 9, 1, '330', '-', 'sale', '2019-02-08 10:30:35'),
(124, 6, 24, '768', '-', 'sale', '2019-02-08 10:56:07'),
(125, 30, 1, '170', '-', 'sale', '2019-02-08 14:23:12'),
(126, 1, 27, '0', 'พี่ลิน', '', '2019-02-08 15:53:24'),
(127, 6, 24, '0', 'พี่ลิน', '', '2019-02-08 15:53:24'),
(128, 7, 3, '0', 'พี่ลิน', '', '2019-02-08 15:53:24'),
(129, 9, 2, '0', 'พี่ลิน', '', '2019-02-08 15:53:24'),
(130, 5, 4, '0', 'พี่เอ๋', '', '2019-02-09 07:43:01'),
(131, 9, 1, '0', 'พี่เอ๋', '', '2019-02-09 07:43:01'),
(132, 5, 1, '0', 'พี่เอ๋', '', '2019-02-09 07:47:03'),
(133, 9, 4, '0', 'พี่เอ๋', '', '2019-02-09 07:47:03'),
(134, 5, 1, '0', 'รวม', '', '2019-02-09 08:56:59'),
(135, 9, 4, '0', 'รวม', '', '2019-02-09 08:56:59'),
(136, 11, 50, '0', 'รวม', '', '2019-02-09 08:56:59'),
(137, 1, 1, '576', '-', 'sale', '2019-02-09 09:34:16'),
(138, 11, 2, '740', '-', 'sale', '2019-02-09 09:34:16'),
(139, 25, 4, '1800', '-', 'sale', '2019-02-09 09:34:16'),
(140, 8, 2, '100', '-', 'sale', '2019-02-09 10:00:35'),
(141, 19, 1, '350', '-', 'sale', '2019-02-09 10:00:35'),
(142, 21, 1, '350', '-', 'sale', '2019-02-09 10:00:36'),
(143, 7, 3, '3000', '-', 'sale', '2019-02-09 11:30:09'),
(144, 11, 1, '350', '-', 'sale', '2019-02-09 13:39:40'),
(145, 12, 1, '320', '-', 'sale', '2019-02-09 13:39:40'),
(146, 30, 15, '0', 'พี่เอ๋', '', '2019-02-09 14:43:02'),
(147, 1, 80, '0', 'พี่เอ๋', '', '2019-02-11 08:07:04'),
(148, 12, 20, '0', 'พี่ยุทะ+พี่วาน', '', '2019-02-11 08:08:56'),
(149, 14, 3, '0', 'พี่ยุทะ+พี่วาน', '', '2019-02-11 08:08:56'),
(150, 12, 20, '0', 'พี่ยุทธ+พี่วาน', '', '2019-02-11 08:09:22'),
(151, 11, 12, '3240', '-', 'sale', '2019-02-11 09:03:29'),
(152, 12, 5, '1350', '-', 'sale', '2019-02-11 09:03:29');

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
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sale_history`
--
ALTER TABLE `sale_history`
  MODIFY `id_sale_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

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
