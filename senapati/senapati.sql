-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2016 at 03:17 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `senapati`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pemakalah`
--

CREATE TABLE IF NOT EXISTS `jenis_pemakalah` (
  `jenis_id` int(11) NOT NULL,
  `jenis_deskripsi` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelajar`
--

CREATE TABLE IF NOT EXISTS `pelajar` (
  `id_peserta` int(11) NOT NULL,
  `no_identitas` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemakalah`
--

CREATE TABLE IF NOT EXISTS `pemakalah` (
  `pem_id` int(11) NOT NULL,
  `pem_nama` varchar(100) DEFAULT NULL,
  `pem_email` varchar(100) DEFAULT NULL,
  `pem_bank` varchar(100) DEFAULT NULL,
  `pem_tgl_trf` date DEFAULT NULL,
  `pem_image` varchar(100) DEFAULT NULL,
  `pem_id_makalah` varchar(50) DEFAULT NULL,
  `pem_jml_trf` varchar(100) DEFAULT NULL,
  `jenis_id` int(11) DEFAULT NULL,
  `pem_status` enum('Mengantri','Validasi') NOT NULL DEFAULT 'Mengantri'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE IF NOT EXISTS `peserta` (
  `peserta_id` int(11) NOT NULL,
  `peserta_nama` varchar(100) DEFAULT NULL,
  `peserta_email` varchar(100) DEFAULT NULL,
  `peserta_bank` varchar(50) DEFAULT NULL,
  `peserta_pemilik` varchar(100) DEFAULT NULL,
  `peserta_tgl_trf` date DEFAULT NULL,
  `peserta_image` varchar(100) DEFAULT NULL,
  `peserta_jenis` enum('umum','pelajar') DEFAULT 'umum',
  `peserta_status` enum('Mengantri','Validasi','','') NOT NULL DEFAULT 'Mengantri'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_pemakalah`
--
ALTER TABLE `jenis_pemakalah`
  ADD PRIMARY KEY (`jenis_id`);

--
-- Indexes for table `pelajar`
--
ALTER TABLE `pelajar`
  ADD PRIMARY KEY (`id_peserta`,`no_identitas`);

--
-- Indexes for table `pemakalah`
--
ALTER TABLE `pemakalah`
  ADD PRIMARY KEY (`pem_id`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`peserta_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
