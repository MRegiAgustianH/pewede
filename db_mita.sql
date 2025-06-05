-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2025 at 04:02 PM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `produk_id` int NOT NULL,
  `quantity` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `produk_id`, `quantity`, `created_at`) VALUES
(2, 1, 47, 1, '2025-06-04 18:05:25'),
(4, 1, 56, 1, '2025-06-04 18:05:43'),
(5, 1, 63, 1, '2025-06-05 13:36:37'),
(6, 1, 67, 1, '2025-06-05 13:36:58'),
(10, 1, 59, 1, '2025-06-05 15:45:52'),
(11, 1, 72, 1, '2025-06-05 15:45:56');

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
(8, 1, 46, '2025-06-01 12:14:16'),
(12, 11, 45, '2025-06-01 16:57:15'),
(13, 11, 46, '2025-06-01 16:58:10'),
(14, 11, 50, '2025-06-01 16:58:30'),
(15, 11, 47, '2025-06-01 16:58:34'),
(16, 1, 50, '2025-06-03 15:02:01'),
(18, 1, 59, '2025-06-05 14:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_date` timestamp NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `status`) VALUES
(1, 1, '2025-06-05 14:09:55', 'pending'),
(2, 1, '2025-06-05 14:10:53', 'pending'),
(3, 1, '2025-06-05 15:45:26', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 45, 1),
(2, 2, 45, 1),
(3, 3, 46, 1),
(4, 3, 72, 1),
(5, 3, 59, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `deskripsi` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `ukuran`, `type`, `kategori`, `deskripsi`, `image`) VALUES
(45, 'rok', 200000, 'm', 'rok', 'wanita', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'rok.jpg'),
(46, 'SAMBA', 200000, '39', 'sepatu', 'wanita', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'sambapink.jpg'),
(47, 'sandal', 150000, '39', 'sandal', 'wanita', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'sandal.jpg'),
(48, 'sandal', 50000, '39', 'sandal', 'wanita', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'sendal1.jpg'),
(49, 'sandal', 150000, '39', 'sandal', 'wanita', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'sendal2.jpg'),
(50, 'SEPATU', 1700000, '40', 'sepatu', 'wanita', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'jq8309_2_footwear_photography_side20lateral20view_grey.jpg'),
(51, 'SEPATU', 1000000, '42', 'sepatu', 'wanita', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'sepatu2.jpg'),
(55, 'JAKET', 500000, 'M', 'jaket', 'wanita', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'jaket.jpg'),
(56, 'JAKET', 1500000, 'XL', 'jaket', 'wanita', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'jaketpink.jpg'),
(58, 'SEPATU', 2500000, '40', 'sepatu', 'wanita', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'sepatu1.jpg'),
(59, 'TAS', 750000, 'S', 'tas', 'wanita', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'tas.jpg'),
(60, 'SEPATU', 1700000, '40', 'sepatu', 'pria', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'ji0079_2_footwear_photography_side_lateral_view_grey.jpg'),
(61, 'SEPATU', 1800000, '39', 'sepatu', 'pria', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'jr7943_2_footwear_photography_side_lateral_view_grey.jpg'),
(62, 'SEPATU', 2500000, '40', 'sepatu', 'pria', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'jr2702_2_footwear_photography_side_lateral_view_grey.jpg'),
(63, 'SEPATU', 2000000, '39', 'sepatu', 'pria', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'ih0849_2_footwear_photography_side_lateral_view_grey.jpg'),
(64, 'SEPATU', 1600000, '41', 'sepatu', 'pria', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'jh7772_2_footwear_photography_side20lateral20view_grey.jpg'),
(65, 'SEPATU', 1100000, '39', 'sepatu', 'pria', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'jh5393_2_footwear_photography_side20lateral20view_grey.jpg'),
(66, 'SEPATU', 450000, '29', 'sepatu', 'anak', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'jh9234_2_footwear_photography_side_lateral_view_grey.jpg'),
(67, 'SEPATU', 450000, '29', 'sepatu', 'anak', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'jh9235_2_footwear_photography_side_lateral_view_grey_1_.jpg'),
(68, 'KAOS', 300000, 'XS', 'pakaian', 'anak', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'in2103_8_apparel_photography_standard_top_part_view_grey.jpg'),
(69, 'KAOS', 300000, 'XS', 'pakaian', 'anak', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'in2097_8_apparel_photography_standard_top_part_view_grey.jpg'),
(70, 'KAOS', 300000, 'XS', 'pakaian', 'anak', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'in2101_8_apparel_photography_standard_top_part_view_grey.jpg'),
(71, 'BAJU SET', 360000, 'XS', 'pakaian', 'anak', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'it7273_1_apparel_photography_front_center_view_grey.jpg'),
(72, 'BAJU SET', 420000, 'S', 'pakaian', 'anak', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates doloribus, tenetur rem repellat repudiandae quaerat ipsum tempore unde doloremque delectus quis culpa ex nesciunt quae optio perspiciatis magnam eos illum!', 'in2102_2_apparel_photography_front_view_grey.jpg');

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
(10, 'maman', 'maman@gmail.com', 'maman123', 'maman123', 1),
(11, 'mitakedua', 'mitaatsil@gmail.com', 'mita123', 'mita123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `fav_produk`
--
ALTER TABLE `fav_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fav_produk`
--
ALTER TABLE `fav_produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Constraints for table `fav_produk`
--
ALTER TABLE `fav_produk`
  ADD CONSTRAINT `fav_produk_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fav_produk_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `produk` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
