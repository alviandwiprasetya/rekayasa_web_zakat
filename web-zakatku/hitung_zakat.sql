-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 12, 2018 at 12:45 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hitung_zakat`
--

-- --------------------------------------------------------

--
-- Table structure for table `hitung`
--

CREATE TABLE `hitung` (
  `kode_hitung` int(9) UNSIGNED NOT NULL,
  `kode_zakat` int(9) UNSIGNED NOT NULL,
  `kode_user` int(9) UNSIGNED DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jumlah_harta` double UNSIGNED NOT NULL,
  `jumlah_zakat` double UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hitung`
--

INSERT INTO `hitung` (`kode_hitung`, `kode_zakat`, `kode_user`, `tanggal`, `jumlah_harta`, `jumlah_zakat`) VALUES
(1, 1, NULL, '2018-12-04 17:00:00', 50000000, 1250000);

-- --------------------------------------------------------

--
-- Table structure for table `kadar`
--

CREATE TABLE `kadar` (
  `kode_kadar` int(9) UNSIGNED NOT NULL,
  `nama_kadar` varchar(125) NOT NULL,
  `harga` double UNSIGNED NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kadar`
--

INSERT INTO `kadar` (`kode_kadar`, `nama_kadar`, `harga`, `satuan`) VALUES
(1, 'Emas', 550000, 'gram');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kode_user` int(9) UNSIGNED NOT NULL,
  `nama` varchar(125) NOT NULL,
  `alamat` text NOT NULL,
  `pekerjaan` varchar(125) NOT NULL,
  `email` varchar(125) NOT NULL,
  `password` varchar(125) NOT NULL,
  `jenis_user` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kode_user`, `nama`, `alamat`, `pekerjaan`, `email`, `password`, `jenis_user`) VALUES
(1, 'Admin', '', '', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'Operator 1', 'Jl Kusumanegara', 'Operator', 'operator1@gmail.com', '37832cda757792aef82ce5e21f542006', 'admin'),
(3, 'Operator 2', 'Jl. janti', 'Operator', 'operator2@gmail.com', '9e64fc8a2ad3331c44a846c3a2b4bb14', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `zakat`
--

CREATE TABLE `zakat` (
  `kode_zakat` int(9) UNSIGNED NOT NULL,
  `kode_kadar` int(9) UNSIGNED NOT NULL,
  `nama_zakat` varchar(20) NOT NULL,
  `nishab` double UNSIGNED NOT NULL,
  `haul` int(3) UNSIGNED NOT NULL,
  `persentase_zakat` double UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zakat`
--

INSERT INTO `zakat` (`kode_zakat`, `kode_kadar`, `nama_zakat`, `nishab`, `haul`, `persentase_zakat`) VALUES
(1, 1, 'Emas', 85, 12, 2.5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hitung`
--
ALTER TABLE `hitung`
  ADD PRIMARY KEY (`kode_hitung`),
  ADD KEY `kode_user` (`kode_user`),
  ADD KEY `kode_zakat` (`kode_zakat`);

--
-- Indexes for table `kadar`
--
ALTER TABLE `kadar`
  ADD PRIMARY KEY (`kode_kadar`),
  ADD UNIQUE KEY `nama_kadar` (`nama_kadar`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kode_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `zakat`
--
ALTER TABLE `zakat`
  ADD PRIMARY KEY (`kode_zakat`),
  ADD KEY `kode_kadar` (`kode_kadar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hitung`
--
ALTER TABLE `hitung`
  MODIFY `kode_hitung` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kadar`
--
ALTER TABLE `kadar`
  MODIFY `kode_kadar` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `kode_user` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `zakat`
--
ALTER TABLE `zakat`
  MODIFY `kode_zakat` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hitung`
--
ALTER TABLE `hitung`
  ADD CONSTRAINT `hitung_ibfk_1` FOREIGN KEY (`kode_user`) REFERENCES `user` (`kode_user`),
  ADD CONSTRAINT `hitung_ibfk_2` FOREIGN KEY (`kode_zakat`) REFERENCES `zakat` (`kode_zakat`);

--
-- Constraints for table `zakat`
--
ALTER TABLE `zakat`
  ADD CONSTRAINT `zakat_ibfk_1` FOREIGN KEY (`kode_kadar`) REFERENCES `kadar` (`kode_kadar`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
