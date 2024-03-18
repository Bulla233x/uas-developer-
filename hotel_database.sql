-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2024 at 03:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotel_inap`
--

CREATE TABLE `hotel_inap` (
  `id` int(11) NOT NULL,
  `kode_temu` varchar(255) NOT NULL,
  `kode_kamar` varchar(255) NOT NULL,
  `tgl_checkin` date NOT NULL,
  `lama_inap` int(11) NOT NULL,
  `total_tarif` decimal(10,2) NOT NULL,
  `diskon` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel_inap`
--

INSERT INTO `hotel_inap` (`id`, `kode_temu`, `kode_kamar`, `tgl_checkin`, `lama_inap`, `total_tarif`, `diskon`) VALUES
(10, 'C100', 'B100', '2024-01-02', 1, 4000000.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_rooms`
--

CREATE TABLE `hotel_rooms` (
  `id` int(11) NOT NULL,
  `kode_kamar` varchar(255) NOT NULL,
  `tipe_kamar` varchar(255) NOT NULL,
  `jumlah_kamar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel_rooms`
--

INSERT INTO `hotel_rooms` (`id`, `kode_kamar`, `tipe_kamar`, `jumlah_kamar`) VALUES
(7, 'A100', 'VIP-1', 7),
(8, 'B100', 'GOLD-1', 5),
(9, 'C100', 'SILVER-1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_tamu`
--

CREATE TABLE `hotel_tamu` (
  `id` int(11) NOT NULL,
  `kode_temu` varchar(255) NOT NULL,
  `nama_tamu` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel_tamu`
--

INSERT INTO `hotel_tamu` (`id`, `kode_temu`, `nama_tamu`, `alamat`, `jenis_kelamin`) VALUES
(8, 'A100', 'Reza', 'jakarta', 'perempuan'),
(9, 'B100', 'Winy', 'bekasi', 'laki-laki'),
(10, 'C100', 'Tyo', 'pekanbaru', 'laki-laki');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotel_inap`
--
ALTER TABLE `hotel_inap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_tamu`
--
ALTER TABLE `hotel_tamu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotel_inap`
--
ALTER TABLE `hotel_inap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hotel_tamu`
--
ALTER TABLE `hotel_tamu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
