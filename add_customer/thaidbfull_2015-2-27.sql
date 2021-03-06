-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2015 at 01:03 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thaidbfull01`
--

-- --------------------------------------------------------

--
-- Table structure for table `amphures`
--

CREATE TABLE IF NOT EXISTS `tbl2_amphures` (
  `amphur_id` int(5) NOT NULL AUTO_INCREMENT,
  `amphur_code` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `amphur_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `AMPHUR_NAME_ENG` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `geo_id` int(5) NOT NULL DEFAULT '0',
  `province_id` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`amphur_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1007 ;

--
-- Dumping data for table `amphures`
--

INSERT INTO `tbl2_amphures` (`amphur_id`, `amphur_code`, `amphur_name`, `AMPHUR_NAME_ENG`, `geo_id`, `province_id`) VALUES
(568, '5001', 'เมืองเชียงใหม่   ', 'Mueang Chiang Mai', 1, 38),
(569, '5002', 'จอมทอง   ', 'Chom Thong', 1, 38),
(570, '5003', 'แม่แจ่ม   ', 'Mae Chaem', 1, 38),
(571, '5004', 'เชียงดาว   ', 'Chiang Dao', 1, 38),
(572, '5005', 'ดอยสะเก็ด   ', 'Doi Saket', 1, 38),
(573, '5006', 'แม่แตง   ', 'Mae Taeng', 1, 38),
(574, '5007', 'แม่ริม   ', 'Mae Rim', 1, 38),
(575, '5008', 'สะเมิง   ', 'Samoeng', 1, 38),
(576, '5009', 'ฝาง   ', 'Fang', 1, 38),
(577, '5010', 'แม่อาย   ', 'Mae Ai', 1, 38),
(578, '5011', 'พร้าว   ', 'Phrao', 1, 38),
(579, '5012', 'สันป่าตอง   ', 'San Pa Tong', 1, 38),
(580, '5013', 'สันกำแพง   ', 'San Kamphaeng', 1, 38),
(581, '5014', 'สันทราย   ', 'San Sai', 1, 38),
(582, '5015', 'หางดง   ', 'Hang Dong', 1, 38),
(583, '5016', 'ฮอด   ', 'Hot', 1, 38),
(584, '5017', 'ดอยเต่า   ', 'Doi Tao', 1, 38),
(585, '5018', 'อมก๋อย   ', 'Omkoi', 1, 38),
(586, '5019', 'สารภี   ', 'Saraphi', 1, 38),
(587, '5020', 'เวียงแหง   ', 'Wiang Haeng', 1, 38),
(588, '5021', 'ไชยปราการ   ', 'Chai Prakan', 1, 38),
(589, '5022', 'แม่วาง   ', 'Mae Wang', 1, 38),
(590, '5023', 'แม่ออน   ', 'Mae On', 1, 38),
(591, '5024', 'ดอยหล่อ   ', 'Doi Lo', 1, 38),
(592, '5051', 'เทศบาลนครเชียงใหม่ (สาขาแขวงกาลวิละ)*   ', 'Tet Saban Nakorn Chiangmai(Kan lawi la)*', 1, 38),
(593, '5052', 'เทศบาลนครเชียงใหม่ (สาขาแขวงศรีวิชั)*   ', 'Tet Saban Nakorn Chiangmai(Sri Wi)*', 1, 38),
(594, '5053', 'เทศบาลนครเชียงใหม่ (สาขาเม็งราย)*   ', 'Tet Saban Nakorn Chiangmai(Meng Rai)*', 1, 38),
(595, '5101', 'เมืองลำพูน   ', 'Mueang Lamphun', 1, 39),
(596, '5102', 'แม่ทา   ', 'Mae Tha', 1, 39),
(597, '5103', 'บ้านโฮ่ง   ', 'Ban Hong', 1, 39),
(598, '5104', 'ลี้   ', 'Li', 1, 39),
(599, '5105', 'ทุ่งหัวช้าง   ', 'Thung Hua Chang', 1, 39),
(600, '5106', 'ป่าซาง   ', 'Pa Sang', 1, 39),
(601, '5107', 'บ้านธิ   ', 'Ban Thi', 1, 39),
(602, '5108', 'เวียงหนองล่อง   ', 'Wiang Nong Long', 1, 39),
(603, '5201', 'เมืองลำปาง   ', 'Mueang Lampang', 1, 40),
(604, '5202', 'แม่เมาะ   ', 'Mae Mo', 1, 40),
(605, '5203', 'เกาะคา   ', 'Ko Kha', 1, 40),
(606, '5204', 'เสริมงาม   ', 'Soem Ngam', 1, 40),
(607, '5205', 'งาว   ', 'Ngao', 1, 40),
(608, '5206', 'แจ้ห่ม   ', 'Chae Hom', 1, 40),
(609, '5207', 'วังเหนือ   ', 'Wang Nuea', 1, 40),
(610, '5208', 'เถิน   ', 'Thoen', 1, 40),
(611, '5209', 'แม่พริก   ', 'Mae Phrik', 1, 40),
(612, '5210', 'แม่ทะ   ', 'Mae Tha', 1, 40),
(613, '5211', 'สบปราบ   ', 'Sop Prap', 1, 40),
(614, '5212', 'ห้างฉัตร   ', 'Hang Chat', 1, 40),
(615, '5213', 'เมืองปาน   ', 'Mueang Pan', 1, 40),
(616, '5301', 'เมืองอุตรดิตถ์   ', 'Mueang Uttaradit', 1, 41),
(617, '5302', 'ตรอน   ', 'Tron', 1, 41),
(618, '5303', 'ท่าปลา   ', 'Tha Pla', 1, 41),
(619, '5304', 'น้ำปาด   ', 'Nam Pat', 1, 41),
(620, '5305', 'ฟากท่า   ', 'Fak Tha', 1, 41),
(621, '5306', 'บ้านโคก   ', 'Ban Khok', 1, 41),
(622, '5307', 'พิชัย   ', 'Phichai', 1, 41),
(623, '5308', 'ลับแล   ', 'Laplae', 1, 41),
(624, '5309', 'ทองแสนขัน   ', 'Thong Saen Khan', 1, 41),
(625, '5401', 'เมืองแพร่   ', 'Mueang Phrae', 1, 42),
(626, '5402', 'ร้องกวาง   ', 'Rong Kwang', 1, 42),
(627, '5403', 'ลอง   ', 'Long', 1, 42),
(628, '5404', 'สูงเม่น   ', 'Sung Men', 1, 42),
(629, '5405', 'เด่นชัย   ', 'Den Chai', 1, 42),
(630, '5406', 'สอง   ', 'Song', 1, 42),
(631, '5407', 'วังชิ้น   ', 'Wang Chin', 1, 42),
(632, '5408', 'หนองม่วงไข่   ', 'Nong Muang Khai', 1, 42),
(633, '5501', 'เมืองน่าน   ', 'Mueang Nan', 1, 43),
(634, '5502', 'แม่จริม   ', 'Mae Charim', 1, 43),
(635, '5503', 'บ้านหลวง   ', 'Ban Luang', 1, 43),
(636, '5504', 'นาน้อย   ', 'Na Noi', 1, 43),
(637, '5505', 'ปัว   ', 'Pua', 1, 43),
(638, '5506', 'ท่าวังผา   ', 'Tha Wang Pha', 1, 43),
(639, '5507', 'เวียงสา   ', 'Wiang Sa', 1, 43),
(640, '5508', 'ทุ่งช้าง   ', 'Thung Chang', 1, 43),
(641, '5509', 'เชียงกลาง   ', 'Chiang Klang', 1, 43),
(642, '5510', 'นาหมื่น   ', 'Na Muen', 1, 43),
(643, '5511', 'สันติสุข   ', 'Santi Suk', 1, 43),
(644, '5512', 'บ่อเกลือ   ', 'Bo Kluea', 1, 43),
(645, '5513', 'สองแคว   ', 'Song Khwae', 1, 43),
(646, '5514', 'ภูเพียง   ', 'Phu Phiang', 1, 43),
(647, '5515', 'เฉลิมพระเกียรติ   ', 'Chaloem Phra Kiat', 1, 43),
(648, '5601', 'เมืองพะเยา   ', 'Mueang Phayao', 1, 44),
(649, '5602', 'จุน   ', 'Chun', 1, 44),
(650, '5603', 'เชียงคำ   ', 'Chiang Kham', 1, 44),
(651, '5604', 'เชียงม่วน   ', 'Chiang Muan', 1, 44),
(652, '5605', 'ดอกคำใต้   ', 'Dok Khamtai', 1, 44),
(653, '5606', 'ปง   ', 'Pong', 1, 44),
(654, '5607', 'แม่ใจ   ', 'Mae Chai', 1, 44),
(655, '5608', 'ภูซาง   ', 'Phu Sang', 1, 44),
(656, '5609', 'ภูกามยาว   ', 'Phu Kamyao', 1, 44),
(657, '5701', 'เมืองเชียงราย   ', 'Mueang Chiang Rai', 1, 45),
(658, '5702', 'เวียงชัย   ', 'Wiang Chai', 1, 45),
(659, '5703', 'เชียงของ   ', 'Chiang Khong', 1, 45),
(660, '5704', 'เทิง   ', 'Thoeng', 1, 45),
(661, '5705', 'พาน   ', 'Phan', 1, 45),
(662, '5706', 'ป่าแดด   ', 'Pa Daet', 1, 45),
(663, '5707', 'แม่จัน   ', 'Mae Chan', 1, 45),
(664, '5708', 'เชียงแสน   ', 'Chiang Saen', 1, 45),
(665, '5709', 'แม่สาย   ', 'Mae Sai', 1, 45),
(666, '5710', 'แม่สรวย   ', 'Mae Suai', 1, 45),
(667, '5711', 'เวียงป่าเป้า   ', 'Wiang Pa Pao', 1, 45),
(668, '5712', 'พญาเม็งราย   ', 'Phaya Mengrai', 1, 45),
(669, '5713', 'เวียงแก่น   ', 'Wiang Kaen', 1, 45),
(670, '5714', 'ขุนตาล   ', 'Khun Tan', 1, 45),
(671, '5715', 'แม่ฟ้าหลวง   ', 'Mae Fa Luang', 1, 45),
(672, '5716', 'แม่ลาว   ', 'Mae Lao', 1, 45),
(673, '5717', 'เวียงเชียงรุ้ง   ', 'Wiang Chiang Rung', 1, 45),
(674, '5718', 'ดอยหลวง   ', 'Doi Luang', 1, 45);


-- --------------------------------------------------------


--
-- Table structure for table `provinces`
--

CREATE TABLE IF NOT EXISTS `tbl2_provinces` (
  `province_id` int(5) NOT NULL AUTO_INCREMENT,
  `province_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `province_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `PROVINCE_NAME_ENG` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `geo_id` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`province_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=78 ;

--
-- Dumping data for table `provinces`
--

INSERT INTO `tbl2_provinces` (`province_id`, `province_code`, `province_name`, `PROVINCE_NAME_ENG`, `geo_id`) VALUES

(38, '50', 'เชียงใหม่   ', 'Chiang Mai', 1),
(39, '51', 'ลำพูน   ', 'Lamphun', 1),
(40, '52', 'ลำปาง   ', 'Lampang', 1),
(41, '53', 'อุตรดิตถ์   ', 'Uttaradit', 1),
(42, '54', 'แพร่   ', 'Phrae', 1),
(43, '55', 'น่าน   ', 'Nan', 1),
(44, '56', 'พะเยา   ', 'Phayao', 1),
(45, '57', 'เชียงราย   ', 'Chiang Rai', 1);

-- --------------------------------------------------------
