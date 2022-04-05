-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2021 at 03:02 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobile_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `current_position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`, `address`, `phone`, `branch_id`, `current_position`, `user_id`, `created_at`, `updated_at`) VALUES
(27, 'Bala Ganesh', NULL, '9790234893', 1, '6', '7000', '2021-09-21 14:33:02', '2021-09-27 08:02:11'),
(28, 'John', NULL, '123456789111', 4, '5', '7001', '2021-09-21 14:33:42', '2021-09-27 07:24:32'),
(29, 'Jenith', NULL, '09790234893', 4, '4', '7002', '2021-09-21 14:34:14', '2021-09-27 07:24:32'),
(30, 'Alex', NULL, '09790234893', 4, '3', '7003', '2021-09-21 14:44:04', '2021-09-27 07:24:32'),
(31, 'Benish', NULL, '09790234893', 4, '2', '7004', '2021-09-21 14:44:51', '2021-09-27 07:24:32'),
(32, 'Krishna', NULL, '09790234893', 5, '1', '7005', '2021-09-21 14:45:19', '2021-09-27 07:24:32'),
(33, 'Sabarai', NULL, '09790234893', 1, '0', '7006', '2021-09-21 14:45:47', '2021-09-27 07:24:32'),
(34, 'Bala Ganesh', NULL, '09790234893', 1, '12', '7007', '2021-09-21 14:47:20', '2021-09-27 07:24:32'),
(35, 'Bala Ganes', NULL, '09790234893', 1, '11', '7008', '2021-09-21 14:47:38', '2021-09-27 07:24:32'),
(36, 'Bala Ganesh', NULL, '09790234893', 1, '10', '7009', '2021-09-21 14:47:59', '2021-09-27 07:24:32'),
(37, 'Bala Ganesh', NULL, '09790234893', 4, '9', '7010', '2021-09-21 14:48:27', '2021-09-27 07:24:32'),
(38, 'Bala Ganes', NULL, '09790234893', 1, '8', '7011', '2021-09-21 14:48:53', '2021-09-27 07:24:32'),
(39, 'Bala Ganes', NULL, '09790234893', 1, '7', '7012', '2021-09-21 14:49:51', '2021-09-27 07:24:32'),
(40, 'Bala Ganesh', NULL, '09790234893', 1, '6', '7013', '2021-09-21 14:50:33', '2021-09-27 07:24:32'),
(41, 'Bala Ganes', NULL, '1234567891', 1, '5', '7014', '2021-09-22 05:48:15', '2021-09-27 07:24:32'),
(42, 'Test', '43/a', '9876543217', 4, '4', '7015', '2021-09-27 05:59:19', '2021-09-27 07:24:32'),
(44, 'New', NULL, '9876543211', 1, '2', '7017', '2021-09-27 07:04:36', '2021-09-27 07:24:32'),
(45, 'Ajith', NULL, '9863892104', 1, '1', '7018', '2021-09-27 07:09:29', '2021-09-27 07:24:32'),
(46, 'Agastin', NULL, '9762535350', 5, '0', '7019', '2021-09-27 07:24:32', '2021-09-27 08:00:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
