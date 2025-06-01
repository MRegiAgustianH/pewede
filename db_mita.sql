-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2025 at 04:16 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `tanggal`, `judul`, `penulis`, `deskripsi`, `posting`) VALUES
(1, '2025-05-15', 'pemrograman dasar web', 'pak lalan', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid fugit eos esse alias aperiam ad vero illum, velit, sint ratione earum, nobis minima in cumque explicabo numquam molestias eaque quae.\r\n', 'tidak'),
(2, '2025-05-19', 'Basis Data', 'Pak Tarmin', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum culpa perferendis architecto quia qui alias.', 'tidak'),
(3, '2025-05-21', 'MUKBANG', 'Milky', 'lorem Ipsum Sit Amet Dolor', 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `fav_produk`
--

CREATE TABLE `fav_produk` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `produk_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fav_produk`
--

INSERT INTO `fav_produk` (`id`, `user_id`, `produk_id`, `created_at`) VALUES
(3, 1, 48, '2025-06-01 11:54:29'),
(4, 1, 49, '2025-06-01 11:54:44'),
(6, 1, 55, '2025-06-01 11:55:46'),
(8, 1, 46, '2025-06-01 12:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `ukuran`, `deskripsi`, `image`) VALUES
(45, 'rok', 200000, 'm', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'rok.jpg'),
(46, 'SAMBA', 200000, '39', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'sambapink.jpg'),
(47, 'sandal', 150000, '39', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'sandal.jpg'),
(48, 'sandal', 50000, '39', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'sendal1.jpg'),
(49, 'sandal', 150000, '39', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'sendal2.jpg'),
(50, 'SEPATU', 1700000, '40', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'sepatu1.jpg'),
(51, 'SEPATU', 1000000, '42', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'sepatu2.jpg'),
(55, 'JAKET', 500000, 'M', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'jaket.jpg'),
(56, 'JAKET', 1500000, 'XL', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'jaketpink.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `confirm_password`, `role`) VALUES
(1, 'mita', 'mita@gmail.com', 'mita123', 'mita123\r\n', 1),
(9, 'admin', 'admin@admin.com', 'admin123', 'admin123', 0),
(10, 'maman', 'maman@gmail.com', 'maman123', 'maman123', 1);

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
-- Indexes for table `fav_produk`
--
ALTER TABLE `fav_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `produk_id` (`produk_id`);

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
-- AUTO_INCREMENT for table `fav_produk`
--
ALTER TABLE `fav_produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fav_produk`
--
ALTER TABLE `fav_produk`
  ADD CONSTRAINT `fav_produk_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fav_produk_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
