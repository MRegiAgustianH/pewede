-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2025 at 03:09 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mita`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int NOT NULL,
  `deskripsi` text NOT NULL
);

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `deskripsi`) VALUES
(1, 'Agoda, platform perjalanan digital, membantu semua melihat dunia lebih murah dengan penawaran terbaiknya di jaringan global 4,5 juta hotel dan akomodasi liburan lainnya di seluruh dunia, serta penerbangan, aktivitas, dan lainnya. Agoda.com dan aplikasi seluler Agoda tersedia dalam 39 bahasa dan didukung oleh layanan pelanggan 24 jam. Berkantor pusat di Singapura, Agoda adalah bagian dari Booking Holdings (Nasdaq: BKNG) dan memiliki lebih dari 7.000 staf di 27 pasar, berdedikasi untuk memaksimalkan manfaat teknologi terbaik di kelasnya untuk membuat perjalanan Anda lebih mudah.');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` mediumint NOT NULL,
  `tanggal` date NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `posting` enum('tidak','ya') NOT NULL
);

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `tanggal`, `judul`, `penulis`, `deskripsi`, `posting`) VALUES
(1, '2025-05-15', 'pemrograman dasar web', 'pak lalan', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid fugit eos esse alias aperiam ad vero illum, velit, sint ratione earum, nobis minima in cumque explicabo numquam molestias eaque quae.\r\n', 'tidak'),
(2, '2025-05-19', 'Basis Data', 'Pak Tarmin', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum culpa perferendis architecto quia qui alias.', 'tidak'),
(3, '2025-05-21', 'MUKBANG', 'Milky', 'lorem Ipsum Sit Amet Dolor', 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
);

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `ukuran`, `image`) VALUES
(11, 'samba', 200000, '39', '682e27a44af02.jpg'),
(12, 'JAKET', 150000, 'm', '682e2988ef4d5.jpg'),
(15, 'sandal', 200000, '39', '68396089c83a3.jpg'),
(25, 'sandal', 200000, '39', '683b0db2d678a.jpg'),
(26, 'sandal', 200000, 's', '683b111c2232c.jpg'),
(28, 'sandal', 150000, '39', '683b131b76555.jpg'),
(29, 'SHOES', 150000, '39', '683b1340a4103.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` tinyint NOT NULL DEFAULT '1'
);

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `confirm_password`, `role`) VALUES
(1, 'mita', 'mita@gmail.com', 'mita123', 'mita123\r\n', 1),
(9, 'admin', 'admin@admin.com', 'admin123', 'admin123', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
