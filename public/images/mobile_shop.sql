-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2021 at 03:59 PM
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
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Madurai', '43/a main road,Madurai.', '2021-09-21 10:07:34', '2021-09-21 11:22:27'),
(4, 'Tirunelveli', '43/a mainroad,tirunelveli', '2021-09-21 11:20:46', '2021-09-21 11:20:46'),
(5, 'Chennai', '43/a mainroad,chennai', '2021-09-21 11:21:13', '2021-09-21 11:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2021_09_20_131550_create_branch_table', 1),
(5, '2021_09_20_131558_create_profile_table', 1),
(6, '2021_09_20_131559_create_users_table', 1),
(7, '2021_09_20_131712_create_transaction_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `profile` (`id`, `name`, `phone`, `branch_id`, `current_position`, `user_id`, `created_at`, `updated_at`) VALUES
(27, 'Bala Ganesh', '9790234893', 4, '1', '7000', '2021-09-21 14:33:02', '2021-09-23 13:47:09'),
(28, 'John', '123456789111', 4, '0', '7001', '2021-09-21 14:33:42', '2021-09-22 05:48:15'),
(29, 'Jenith', '09790234893', 4, '12', '7002', '2021-09-21 14:34:14', '2021-09-22 05:48:15'),
(30, 'Alex', '09790234893', 4, '11', '7003', '2021-09-21 14:44:04', '2021-09-22 05:48:15'),
(31, 'Benish', '09790234893', 4, '10', '7004', '2021-09-21 14:44:51', '2021-09-22 05:48:15'),
(32, 'Krishna', '09790234893', 5, '9', '7005', '2021-09-21 14:45:19', '2021-09-22 05:48:15'),
(33, 'Sabarai', '09790234893', 1, '8', '7006', '2021-09-21 14:45:47', '2021-09-22 05:48:15'),
(34, 'Bala Ganesh', '09790234893', 1, '7', '7007', '2021-09-21 14:47:20', '2021-09-22 05:48:15'),
(35, 'Bala Ganes', '09790234893', 1, '6', '7008', '2021-09-21 14:47:38', '2021-09-22 05:48:15'),
(36, 'Bala Ganesh', '09790234893', 1, '5', '7009', '2021-09-21 14:47:59', '2021-09-22 05:48:15'),
(37, 'Bala Ganesh', '09790234893', 4, '4', '7010', '2021-09-21 14:48:27', '2021-09-22 05:48:15'),
(38, 'Bala Ganes', '09790234893', 1, '3', '7011', '2021-09-21 14:48:53', '2021-09-22 05:48:15'),
(39, 'Bala Ganes', '09790234893', 1, '2', '7012', '2021-09-21 14:49:51', '2021-09-22 05:48:15'),
(40, 'Bala Ganesh', '09790234893', 1, '1', '7013', '2021-09-21 14:50:33', '2021-09-22 05:48:15'),
(41, 'Bala Ganes', '1234567891', 1, '0', '7014', '2021-09-22 05:48:15', '2021-09-22 05:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `profile_id`, `details`, `amount`, `created_at`, `updated_at`) VALUES
(9, 27, 'Sign Up', '50', '2021-09-21 14:33:02', '2021-09-21 14:33:02'),
(10, 28, 'Sign Up', '50', '2021-09-21 14:33:42', '2021-09-21 14:33:42'),
(11, 29, 'Sign Up', '50', '2021-09-21 14:34:14', '2021-09-21 14:34:14'),
(12, 30, 'Sign Up', '50', '2021-09-21 14:44:05', '2021-09-21 14:44:05'),
(13, 31, 'Sign Up', '50', '2021-09-21 14:44:52', '2021-09-21 14:44:52'),
(14, 32, 'Sign Up', '50', '2021-09-21 14:45:19', '2021-09-21 14:45:19'),
(15, 33, 'Sign Up', '50', '2021-09-21 14:45:47', '2021-09-21 14:45:47'),
(16, 34, 'Sign Up', '50', '2021-09-21 14:47:20', '2021-09-21 14:47:20'),
(17, 35, 'Sign Up', '50', '2021-09-21 14:47:38', '2021-09-21 14:47:38'),
(18, 36, 'Sign Up', '50', '2021-09-21 14:47:59', '2021-09-21 14:47:59'),
(19, 37, 'Sign Up', '50', '2021-09-21 14:48:27', '2021-09-21 14:48:27'),
(20, 38, 'Sign Up', '50', '2021-09-21 14:48:53', '2021-09-21 14:48:53'),
(21, 27, 'limit reached', '200', '2021-09-21 14:49:51', '2021-09-21 14:49:51'),
(22, 39, 'Sign Up', '50', '2021-09-21 14:49:52', '2021-09-21 14:49:52'),
(23, 28, 'limit reached', '200', '2021-09-21 14:50:33', '2021-09-21 14:50:33'),
(24, 40, 'Sign Up', '50', '2021-09-21 14:50:34', '2021-09-21 14:50:34'),
(25, 29, 'limit reached', '200', '2021-09-22 05:48:15', '2021-09-22 05:48:15'),
(26, 41, 'Sign Up', '50', '2021-09-22 05:48:16', '2021-09-22 05:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `profile_id`, `is_admin`, `email`, `email_verified_at`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, 1, 'admin@gmail.com', NULL, '$2y$10$O8dCSlb4NQ20pR87r1Y2PufS.LG4qwUTXYjLQO8HaCewAhLUR3aXe', NULL, 1, NULL, NULL),
(18, 'Bala Ganes', 27, 0, 'balaig7@gmail.com', NULL, '$2y$10$5QITNMw/TTY24iukPjJiOeqoExam9JAsX9pxP.TborXn4ehtXSzke', NULL, 1, '2021-09-21 14:33:02', '2021-09-23 13:45:15'),
(19, 'John', 28, 0, 'john@gmail.com', NULL, '$2y$10$hHyMBXYR0bdjnHYRdI5g8utMYYgJOAw89W7gai/Fo3WmcbSLR1ruq', NULL, 1, '2021-09-21 14:33:42', '2021-09-23 06:49:28'),
(20, 'Jenith', 29, 0, 'jenith@gmail.com', NULL, '$2y$10$NdGf3WQ37JGW7slMRjfwwen2odzHLQ3BpDcYYZj3uS2mOglBWYKDK', NULL, 1, '2021-09-21 14:34:14', '2021-09-21 14:34:14'),
(21, 'Alex', 30, 0, 'alex@gmail.com', NULL, '$2y$10$uz9s4mPCWPZpYL5.mSOs6OhTt67hSKtMHHl5KJnRVNaqgnvjLcNmK', NULL, 1, '2021-09-21 14:44:05', '2021-09-21 14:44:05'),
(22, 'Benish', 31, 0, 'benish@gmail.com', NULL, '$2y$10$yYj2jJlJU62KQ3UcFHTRh.VZNAi5MFimK/W.GxKHDT0.CnyfHLK9m', NULL, 0, '2021-09-21 14:44:52', '2021-09-23 11:08:55'),
(23, 'Krishna', 32, 0, 'krishna@gmail.com', NULL, '$2y$10$ukY6p7p4x2z.wL.LBKWm8OnmmFliRbwkSPgAYhI4BDxkKGZ/snjl.', NULL, 1, '2021-09-21 14:45:19', '2021-09-21 14:45:19'),
(24, 'Sabarai', 33, 0, 'sat@gmail.com', NULL, '$2y$10$ccxcdY.rZGEliwqoRvac1ehVnwvma.LgazEcKTLRDCqaEDXzYiJd2', NULL, 1, '2021-09-21 14:45:47', '2021-09-21 14:45:47'),
(25, 'Bala Ganesh', 34, 0, 'balaigsgfgfd7@gmail.com', NULL, '$2y$10$eBrDdOs59rq2ouJIgpNBW.uneaH8Xhll1NVfcZUBzo19OeA008eC2', NULL, 1, '2021-09-21 14:47:20', '2021-09-21 14:47:20'),
(26, 'Bala Ganes', 35, 0, 'baladsfsfsig7@gmail.com', NULL, '$2y$10$uR1Tt5lcCOC2wKSJby8Yv.heedY5KbzRyM4t6GW4r3mZOsWKXV9Qe', NULL, 1, '2021-09-21 14:47:38', '2021-09-21 14:47:38'),
(27, 'Bala Ganesh', 36, 0, 'balaidsfdfsfg7@gmail.com', NULL, '$2y$10$zm5VvT6NfxGdVoz2Do8ehe.pUFNk6VaqOvxy6X0khPuRHtXlORa/.', NULL, 0, '2021-09-21 14:47:59', '2021-09-23 07:38:04'),
(28, 'Bala Ganesh', 37, 0, 'badsfdsfsdflaig7@gmail.com', NULL, '$2y$10$SukidFkZacw57bSMMP5iJuWgllxig39Wqzl5N5xEgcjPWQwdsaHGO', NULL, 0, '2021-09-21 14:48:27', '2021-09-23 07:35:14'),
(29, 'Bala Ganes', 38, 0, 'bsdfdfsdfsdalaig7@gmail.com', NULL, '$2y$10$PuKSC0CU9GlAiGY4RZoJeONNYC2VMSHIJ/XPhTz0Es9zzD5YnoUEC', NULL, 1, '2021-09-21 14:48:53', '2021-09-21 14:48:53'),
(30, 'Bala Ganes', 39, 0, 'baefsdgdgsgflaig7@gmail.com', NULL, '$2y$10$m9Pz3Aq.A2NLZmVLadusW.4plyYBuVmPLi90XgyaxkOqut2KEw2.K', NULL, 1, '2021-09-21 14:49:52', '2021-09-21 14:49:52'),
(31, 'Bala Ganesh', 40, 0, 'bafdsfsdffdfsfalaig7@gmail.com', NULL, '$2y$10$obz7svp6PKFk8mRxUtemT.W62t/CMGde/Q/6vOX9Qt5I/oqrVNmjq', NULL, 1, '2021-09-21 14:50:34', '2021-09-21 14:50:34'),
(32, 'Bala Ganes', 41, 0, 'baldsfsfsaig7@gmail.com', NULL, '$2y$10$fu0SPcWbSxuj97//29YT8eK0dQyEOs8D9PPIQBYMZ2M6u.RxfZQSG', NULL, 1, '2021-09-22 05:48:16', '2021-09-22 05:48:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_profile_id_foreign` (`profile_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_profile_id_foreign` (`profile_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
