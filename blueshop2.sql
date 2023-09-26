-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2021 at 04:56 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blueshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `username` varchar(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`username`, `pid`, `quantity`) VALUES
('baramee', 2, 2),
('baramee', 3, 5),
('baramee', 4, 1),
('metasit', 1, 2),
('metasit', 3, 4),
('metasit', 4, 3),
('somsak', 2, 3),
('somsak', 4, 5),
('samanwanich', 2, 2),
('samanwanich', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`username`, `password`, `name`, `address`, `mobile`, `email`) VALUES
('somsak', '1899', 'สมศักดิ์ สุรเสถียร', '174 ถ.มิตรภาพ จ.ขอนแก่น', '', 'somsak@gmail.com'),
('baramee', 'aafff1', 'บารมี บุญหลาย', '123 ถ.วิภาวดีรังสิต กรุงเทพฯ', '08-9446-9955', 'baramee@gmail.com'),
('metasit', 'm345', 'เมธาสิทธิ์ สอนสั่ง', '98/9 ถ.ศรีจันทร์ จ.ขอนแก่น', '08-4456-9877', 'metasit@outlook.com'),
('samanwanich', '1412', 'veera', '13/2', '0637651021', 'kungjeje@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(13) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pdetail` text NOT NULL,
  `price` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `pname`, `pdetail`, `price`) VALUES
(1, 'Centrum', 'วิตามินรวมจาก A ถึง Zinc', 350),
(2, 'Caltrate', 'บำรุงกระดูก เสริมวิตามินดี', 760),
(3, 'Ester-C', 'วิตามินซี 500 mg ไม่กัดกระเพาะ', 500),
(4, 'Glucosamine', 'บำรุงข้อต่อ ป้องกันข้อเสื่อม', 1200),
(5, 'TYLENOL 500mg', 'บรรเทาอาการปวด ใช้เป็นยาลดไข้ แก้ตัวร้อน', 300),
(6, 'APACHE', 'ยาน้ำแก้ไอ ขับเสมหะ', 25),
(7, 'ฟ้าทะลายโจรแคปซูล', 'บรรเทาอาการเจ็บคอ', 160),
(8, 'ENO', 'ลดกรดเกินในกระเพาะ', 105),
(9, 'อบเชยแคปซูล', 'ช่วยย่อยอาหาร ช่วยย่อยสลายไขมัน', 200),
(10, 'POI-SIAN', 'ใช้สูดดมบรรเทาอาการคัดจมูก เวียนหัว เป็นลม', 25),
(11, 'ถ้วยทอง', 'ยาหม่องตราถ้วยทอง ใช้ดม ใช้ทา ในถ้วยเดียวกัน', 90);

-- --------------------------------------------------------

--
-- Table structure for table `typeproduct`
--

CREATE TABLE `typeproduct` (
  `pname` varchar(255) NOT NULL,
  `typebygroup` varchar(15) NOT NULL,
  `typebyuse` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `typeproduct`
--

INSERT INTO `typeproduct` (`pname`, `typebygroup`, `typebyuse`) VALUES
('Centrum', 'อาหารเสริม', 'รับประทานชนิดเม็ด'),
('Caltrate', 'อาหารเสริม', 'รับประทานชนิดเม็ด'),
('Ester-C', 'อาหารเสริม', 'รับประทานชนิดเม็ด'),
('Glucosamine', 'อาหารเสริม', 'รับประทานชนิดเม็ด'),
('TYLENOL 500mg', 'ยาสามัญประจำบ้า', 'รับประทานชนิดเม็ด'),
('APACHE', 'ยาสามัญประจำบ้า', 'รับประทานชนิดน้ำ'),
('ฟ้าทะลายโจรแคปซูล', 'ยาสมุนไพร', 'รับประทานชนิดแคปซูล'),
('ENO', 'ยาสามัญประจำบ้า', 'ยาผง ผสมน้ำเพื่อทาน'),
('อบเชยแคปซูล', 'ยาสมุนไพร', 'รับประทานชนิดแคปซูล'),
('POI-SIAN', 'ยาสามัญประจำบ้า', 'ยาดม'),
('ถ้วยทอง', 'ยาสามัญประจำบ้า', 'ใช้ทาภายนอก');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`username`,`pid`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `typeproduct`
--
ALTER TABLE `typeproduct`
  ADD KEY `pname` (`pname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
