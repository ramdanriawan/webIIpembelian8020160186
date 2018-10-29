-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2018 at 06:03 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_8020160186`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga_jual` int(10) NOT NULL,
  `stok` int(10) NOT NULL,
  `gambar` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `nama`, `harga_jual`, `stok`, `gambar`, `created_at`, `updated_at`) VALUES
(85, 'asdasd', 2000, 1000, '{\"url\":[\"/gambar/iphone1.jpg\",\"/gambar/iphone2.jpg\",\"/gambar/iphone3.jpg\",\"/gambar/iphone4.jpg\"]}', '2018-10-28 16:17:24', '2018-10-28 16:17:24'),
(88, 'ramdan riawan', 1000, 1000, '{\"url\":[\"/gambar/iphone1.jpg\",\"/gambar/iphone2.jpg\",\"/gambar/iphone3.jpg\",\"/gambar/iphone4.jpg\"]}', '2018-10-28 16:19:41', '2018-10-28 16:19:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggans`
--

CREATE TABLE `pelanggans` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` longtext NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggans`
--

INSERT INTO `pelanggans` (`id`, `nama`, `alamat`, `created_at`, `updated_at`) VALUES
(9, 'adfas asdfsf', 'asdasdfasdfasfasdfasdfasdasdasdsa', '2018-10-23 09:06:27', '2018-10-27 17:11:06'),
(10, 'sdfsf', 'sdfs', '2018-10-23 09:06:53', '2018-10-23 09:06:53'),
(11, 'sdfdsf', 'sdfdsf', '2018-10-23 09:10:02', '2018-10-23 09:10:02'),
(12, 'asdas', 'asdasd', '2018-10-23 09:10:22', '2018-10-23 09:10:22'),
(13, 'xcxvxc', 'xcvxc', '2018-10-23 09:10:40', '2018-10-23 09:10:40'),
(14, 'sdfdsf', 'sdfdsfdsf', '2018-10-23 09:11:16', '2018-10-23 09:11:16'),
(15, 'dsfsd', 'fdsfds', '2018-10-23 09:11:42', '2018-10-23 09:11:42'),
(16, 'dsfdsf', 'sdfsd', '2018-10-23 09:12:08', '2018-10-23 09:12:08'),
(17, 'sdf', 'sdfds', '2018-10-23 09:12:27', '2018-10-23 09:12:27'),
(18, 'sdfsd', 'dsf', '2018-10-23 09:20:17', '2018-10-23 09:20:17'),
(19, 'asdfsa', 'asdasd', '2018-10-23 09:22:15', '2018-10-23 09:22:15'),
(20, 'asda', 'asd', '2018-10-24 16:09:46', '2018-10-24 16:09:46'),
(21, 'sdfds', 'dsfdsf', '2018-10-24 16:10:22', '2018-10-24 16:10:22'),
(22, 'sdfds', 'sdf', '2018-10-24 16:18:56', '2018-10-24 16:18:56'),
(23, 'dsfds', 'sdf', '2018-10-24 16:19:41', '2018-10-24 16:19:41'),
(24, 'ini budi', 'rumah budi di mana lagi yaa??', '2018-10-25 05:53:10', '2018-10-25 05:53:10'),
(25, 'dsfsfsdf', 'sdfsdfds', '2018-10-25 08:43:43', '2018-10-25 08:43:43'),
(26, '123', '4567', '2018-10-25 14:10:11', '2018-10-25 14:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ramdan riawan', 'ramdanriawan3@gmail.com', 'ramdan3mts', '$2y$10$mDpUaSmpTU6evzewGYoyie3EaRWT4XQRrtoskGLwAnPosNTze8HDO', 'vqPxkJGGyYIKyQFDKuvWHLXahph6G2PtYnsXthwOrMsxyzNL2zBs9E2af2jJ', '2018-10-09 19:56:37', '2018-10-09 19:56:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggans`
--
ALTER TABLE `pelanggans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
