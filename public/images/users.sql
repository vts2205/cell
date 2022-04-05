-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2021 at 03:00 PM
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
(18, 'Bala Ganes', 27, 0, 'balaig@gmail.com', NULL, '$2y$10$5QITNMw/TTY24iukPjJiOeqoExam9JAsX9pxP.TborXn4ehtXSzke', NULL, 1, '2021-09-21 14:33:02', '2021-09-27 08:02:11'),
(19, 'John', 28, 0, 'john@gmail.com', NULL, '$2y$10$hHyMBXYR0bdjnHYRdI5g8utMYYgJOAw89W7gai/Fo3WmcbSLR1ruq', NULL, 1, '2021-09-21 14:33:42', '2021-09-23 06:49:28'),
(20, 'Jenith', 29, 0, 'jenith@gmail.com', NULL, '$2y$10$NdGf3WQ37JGW7slMRjfwwen2odzHLQ3BpDcYYZj3uS2mOglBWYKDK', NULL, 1, '2021-09-21 14:34:14', '2021-09-21 14:34:14'),
(21, 'Alex', 30, 0, 'alex@gmail.com', NULL, '$2y$10$uz9s4mPCWPZpYL5.mSOs6OhTt67hSKtMHHl5KJnRVNaqgnvjLcNmK', NULL, 1, '2021-09-21 14:44:05', '2021-09-21 14:44:05'),
(22, 'Benish', 31, 0, 'benish@gmail.com', NULL, '$2y$10$yYj2jJlJU62KQ3UcFHTRh.VZNAi5MFimK/W.GxKHDT0.CnyfHLK9m', NULL, 1, '2021-09-21 14:44:52', '2021-09-27 06:00:51'),
(23, 'Krishna', 32, 0, 'krishna@gmail.com', NULL, '$2y$10$ukY6p7p4x2z.wL.LBKWm8OnmmFliRbwkSPgAYhI4BDxkKGZ/snjl.', NULL, 1, '2021-09-21 14:45:19', '2021-09-21 14:45:19'),
(24, 'Sabarai', 33, 0, 'sat@gmail.com', NULL, '$2y$10$ccxcdY.rZGEliwqoRvac1ehVnwvma.LgazEcKTLRDCqaEDXzYiJd2', NULL, 1, '2021-09-21 14:45:47', '2021-09-21 14:45:47'),
(25, 'Bala Ganesh', 34, 0, 'balaigsgfgfd7@gmail.com', NULL, '$2y$10$eBrDdOs59rq2ouJIgpNBW.uneaH8Xhll1NVfcZUBzo19OeA008eC2', NULL, 1, '2021-09-21 14:47:20', '2021-09-21 14:47:20'),
(26, 'Bala Ganes', 35, 0, 'baladsfsfsig7@gmail.com', NULL, '$2y$10$uR1Tt5lcCOC2wKSJby8Yv.heedY5KbzRyM4t6GW4r3mZOsWKXV9Qe', NULL, 1, '2021-09-21 14:47:38', '2021-09-21 14:47:38'),
(27, 'Bala Ganesh', 36, 0, 'balaidsfdfsfg7@gmail.com', NULL, '$2y$10$zm5VvT6NfxGdVoz2Do8ehe.pUFNk6VaqOvxy6X0khPuRHtXlORa/.', NULL, 1, '2021-09-21 14:47:59', '2021-09-27 06:00:44'),
(28, 'Bala Ganesh', 37, 0, 'badsfdsfsdflaig7@gmail.com', NULL, '$2y$10$SukidFkZacw57bSMMP5iJuWgllxig39Wqzl5N5xEgcjPWQwdsaHGO', NULL, 1, '2021-09-21 14:48:27', '2021-09-27 06:03:04'),
(29, 'Bala Ganes', 38, 0, 'bsdfdfsdfsdalaig7@gmail.com', NULL, '$2y$10$PuKSC0CU9GlAiGY4RZoJeONNYC2VMSHIJ/XPhTz0Es9zzD5YnoUEC', NULL, 1, '2021-09-21 14:48:53', '2021-09-21 14:48:53'),
(30, 'Bala Ganes', 39, 0, 'baefsdgdgsgflaig7@gmail.com', NULL, '$2y$10$m9Pz3Aq.A2NLZmVLadusW.4plyYBuVmPLi90XgyaxkOqut2KEw2.K', NULL, 1, '2021-09-21 14:49:52', '2021-09-21 14:49:52'),
(31, 'Bala Ganesh', 40, 0, 'bafdsfsdffdfsfalaig7@gmail.com', NULL, '$2y$10$obz7svp6PKFk8mRxUtemT.W62t/CMGde/Q/6vOX9Qt5I/oqrVNmjq', NULL, 1, '2021-09-21 14:50:34', '2021-09-21 14:50:34'),
(32, 'Bala Ganes', 41, 0, 'baldsfsfsaig7@gmail.com', NULL, '$2y$10$fu0SPcWbSxuj97//29YT8eK0dQyEOs8D9PPIQBYMZ2M6u.RxfZQSG', NULL, 1, '2021-09-22 05:48:16', '2021-09-22 05:48:16'),
(33, 'Test', 42, 0, 'test@gmail.com', NULL, '$2y$10$F./tbLMT4UKJZlUJ31LirOOoNimyIp/U6dCFHC6ctf6FV3dbZbPg2', NULL, 1, '2021-09-27 05:59:19', '2021-09-27 05:59:19'),
(34, 'New', 44, 0, 'balaig7@gmail.com', NULL, '$2y$10$758aOle3etxqncPpc5TSgecnY1BP5TygmTFTkeNngsQ9MERGj.2u2', NULL, 1, '2021-09-27 07:04:36', '2021-09-27 11:08:49'),
(35, 'Ajith', 45, 0, 'ajith@gmail.com', NULL, '$2y$10$AZVukraXE7o.AJuQpPnNOOzKJTM4/S9Fhycmw7.Cs74F9NA6SxLHK', NULL, 1, '2021-09-27 07:09:30', '2021-09-27 07:09:30'),
(36, 'Agastin', 46, 0, 'agastin@gmail.com', NULL, '$2y$10$nrJ5wQDYfnK5/7LZTI1NGuW53yFG5Py232nFSYefOt1mEpQyLxbTO', NULL, 1, '2021-09-27 07:24:32', '2021-09-27 08:01:20');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
