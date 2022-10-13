-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2022 at 02:11 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daftar_pelanggan`
--

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idPelanggan` varchar(5) NOT NULL,
  `namaPelanggan` varchar(50) NOT NULL,
  `alamatPelanggan` varchar(200) NOT NULL,
  `jumlahTransaksi` double NOT NULL,
  `statusPelanggan` varchar(30) NOT NULL,
  `genderPelanggan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idPelanggan`, `namaPelanggan`, `alamatPelanggan`, `jumlahTransaksi`, `statusPelanggan`, `genderPelanggan`) VALUES
('PE0', 'Tantowi Putra Agung Setiawan', 'Pondok Lestari Blok D2 No.14, Karang Tengah', 60000, 'Bronze', 'Laki-Laki'),
('PE1', 'Raden Akira ', 'Jalan Ciamis No33', 70000, 'Gold', 'Laki-Laki'),
('PE2', 'Fisalma Maradita', 'jln Mawar no.11', 40000, 'Silver', 'Perempuan'),
('PE3', 'Angelique ', 'jln kunciran no.37', 80000, 'Gold', 'Perempuan'),
('PE4', 'Salsabilla Adrian', 'jln simpang no.8', 10000, 'Gold', 'Perempuan');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
