-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2017 at 02:01 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_prediksifix`
--

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` int(10) unsigned NOT NULL,
  `id_teknik` int(11) NOT NULL,
  `tahun` char(10) NOT NULL,
  `bulan` char(50) NOT NULL,
  `jumlah` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teknik_penjualan`
--

CREATE TABLE IF NOT EXISTS `teknik_penjualan` (
  `id` int(11) NOT NULL,
  `nama_teknik` varchar(100) NOT NULL,
  `parent` int(10) unsigned NOT NULL,
  `kode` char(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teknik_penjualan`
--

INSERT INTO `teknik_penjualan` (`id`, `nama_teknik`, `parent`, `kode`) VALUES
(3, 'Advertising', 0, 'Adv'),
(4, 'Open Table', 0, 'Opt'),
(5, 'Advertising - Tv', 3, 'Adv1'),
(6, 'Advertising - Radio', 3, 'Adv2'),
(7, 'Advertising - Internet', 3, 'Adv3'),
(8, 'Open Table - Event', 4, 'Opt1'),
(9, 'Open Table - Home', 4, 'Opt2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`), ADD KEY `tahun` (`tahun`) COMMENT 'tahun', ADD KEY `penjualan_fk` (`id_teknik`);

--
-- Indexes for table `teknik_penjualan`
--
ALTER TABLE `teknik_penjualan`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nama_teknik` (`nama_teknik`) COMMENT 'nama_teknik', ADD UNIQUE KEY `kode` (`kode`) COMMENT 'kode';

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unik` (`username`) COMMENT 'unik', ADD KEY `name` (`name`) COMMENT 'name';

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teknik_penjualan`
--
ALTER TABLE `teknik_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
ADD CONSTRAINT `penjualan_fk` FOREIGN KEY (`id_teknik`) REFERENCES `teknik_penjualan` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
