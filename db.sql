-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2023 at 08:30 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shorturl`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_qrcode`
--

CREATE TABLE `tb_qrcode` (
  `qr_id` int(11) NOT NULL,
  `qr_text` text NOT NULL,
  `qr_image` text NOT NULL,
  `qr_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_shorturl`
--

CREATE TABLE `tb_shorturl` (
  `su_id` int(11) NOT NULL,
  `su_short` varchar(7) NOT NULL,
  `su_full` text NOT NULL,
  `su_time` datetime NOT NULL DEFAULT current_timestamp(),
  `su_clicked` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_qrcode`
--
ALTER TABLE `tb_qrcode`
  ADD PRIMARY KEY (`qr_id`);

--
-- Indexes for table `tb_shorturl`
--
ALTER TABLE `tb_shorturl`
  ADD PRIMARY KEY (`su_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_qrcode`
--
ALTER TABLE `tb_qrcode`
  MODIFY `qr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_shorturl`
--
ALTER TABLE `tb_shorturl`
  MODIFY `su_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
