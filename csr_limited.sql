-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 11, 2020 at 06:01 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csr_limited`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_11_000000_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_01_13_100839_create_shops_table', 1),
(6, '2020_01_13_100840_create_reviews_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_id` int(191) DEFAULT NULL,
  `star_rating` int(11) DEFAULT NULL,
  `review_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_member_type` enum('paid','unpaid') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_status` enum('pending','approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `review_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `shop_id`, `star_rating`, `review_details`, `review_member_type`, `review_status`, `review_date`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 5, 'kinikoiuiiji', 'unpaid', 'pending', '2020-04-28 05:39:20', '2020-04-28 12:39:20', '2020-04-28 12:39:20'),
(2, '5e9c8f367a9ef', 1, 4, 'asdasdasd', 'paid', 'pending', '2020-04-28 05:39:55', '2020-04-28 12:39:55', '2020-04-28 12:39:55'),
(3, NULL, 4, 5, 'asdasdasdas', 'unpaid', 'pending', '2020-04-28 05:43:52', '2020-04-28 12:43:52', '2020-04-28 12:43:52'),
(4, NULL, 5, 3, 'asdasdad', 'unpaid', 'approved', '2020-04-28 07:46:50', '2020-04-28 14:46:50', '2020-04-30 11:01:04'),
(5, NULL, 6, 5, 'zyx', 'unpaid', 'approved', '2020-04-28 15:35:11', '2020-04-28 22:35:11', '2020-04-30 10:21:30'),
(6, '5ea84c7754035', 1, 4, 'okay', 'paid', 'approved', '2020-04-28 15:36:56', '2020-04-28 22:36:56', '2020-04-30 11:01:01'),
(7, NULL, 6, 4, 'sdasdas', 'unpaid', 'approved', '2020-04-28 16:04:35', '2020-04-28 23:04:35', '2020-04-30 10:03:47'),
(8, NULL, 5, 4, 'asdasd', 'unpaid', 'approved', '2020-04-28 16:06:32', '2020-04-28 23:06:32', '2020-04-30 11:00:58'),
(9, NULL, 6, 2, 'sadasdasd', 'unpaid', 'approved', '2020-04-28 16:06:56', '2020-04-28 23:06:56', '2020-04-30 10:20:58'),
(10, NULL, 5, 5, 'asdasdasda', 'unpaid', 'approved', '2020-04-28 16:08:54', '2020-04-28 23:08:54', '2020-04-30 10:57:23'),
(11, '5ea84c7754035', 5, 3, 'asdasdas', 'paid', 'approved', '2020-04-28 16:09:20', '2020-04-28 23:09:20', '2020-04-30 10:24:20'),
(12, '5ea7cb755420b', 5, 1, 'asdasasd', 'paid', 'approved', '2020-04-28 16:21:29', '2020-04-28 23:21:29', '2020-04-30 10:28:08'),
(13, NULL, 7, 5, 'hhghhghghghghgffdffj', 'unpaid', 'approved', '2020-05-02 18:01:40', '2020-05-02 13:01:40', '2020-05-02 13:02:02'),
(14, '5ea7cc021f006', 7, 4, 'juaid', 'paid', 'approved', '2020-05-02 18:03:31', '2020-05-02 13:03:31', '2020-05-02 13:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'user', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
CREATE TABLE IF NOT EXISTS `shops` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coffee_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `listing_date` datetime DEFAULT NULL,
  `status` enum('activated','deactivated') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shops_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `user_id`, `shop_name`, `shop_details`, `shop_image`, `coffee_price`, `listing_date`, `status`, `created_at`, `updated_at`) VALUES
(1, '5e9c8f367a9ef', 'coffee 1', 'sadasd', '1588445049_commerce-and-shopping.png', '160', '2020-04-25 23:08:25', 'activated', '2020-04-26 06:08:25', '2020-05-02 13:44:10'),
(4, '5e9c6145155a4', 'coffee 2', 'asdkjakdasldlasjdlj', '1588445040_commerce-and-shopping.png', '250', '2020-04-28 05:42:41', 'activated', '2020-04-28 12:42:41', '2020-05-02 13:44:00'),
(5, '5ea7cc021f006', 'coffee 3', 'asdausduadiuas', '1588445030_commerce-and-shopping.png', '450', '2020-04-28 06:26:10', 'activated', '2020-04-28 13:26:10', '2020-05-02 13:43:50'),
(6, '5ea84c7754035', 'coffee shop 1', 'dasdasdasd', '1588445019_commerce-and-shopping.png', '180', '2020-04-28 15:33:54', 'activated', '2020-04-28 22:33:54', '2020-05-02 13:43:39'),
(7, '5ea84c7754035', 'testing 123', 'testing 12345 abc', '1588445010_commerce-and-shopping.png', '25', '2020-05-02 17:58:26', 'activated', '2020-05-02 12:58:26', '2020-05-02 13:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 2,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` enum('paid','unpaid') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('activated','deactivated') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activated',
  `user_created_at` datetime DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `lname`, `email`, `password`, `phone`, `user_type`, `status`, `user_created_at`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
('5e9c6145155a4', 1, 'Admin', '', 'admin@gmail.com', '$2y$10$MsHHu6Wecb1dohKv/xDm..tTXm2KEMwXh3lhQFAUChZ6yXkpm/ZiS', NULL, NULL, 'activated', NULL, NULL, NULL, '2020-04-19 21:33:41', '2020-04-19 21:33:41'),
('5e9c8f367a9ef', 2, 'ay', 'jee', 'ay_jee@fmail.com', '$2y$10$Jc1iJlspgETydtnIfXl2levOLolxmck/brSqLHH8fAehOqUornXHm', '03213213213', 'unpaid', 'activated', '2020-04-19 17:49:42', NULL, NULL, '2020-04-20 00:49:42', '2020-04-20 00:49:42'),
('5ea7ca382dd4d', 2, 'sir', 'jee', 'sir_jee@gmail.com', '$2y$10$tFywuGiqIVSYhtrfM6JTU.tMQClHVpvGB6sVet53vQzgizVKG6PAC', '03131121333', 'unpaid', 'activated', '2020-04-28 06:16:24', NULL, NULL, '2020-04-28 13:16:24', '2020-04-28 13:16:24'),
('5ea7cb755420b', 2, 'sain', 'muhanja', 'sain_muhanja@sain.com', '$2y$10$opJqqeAbjnVnA3dHXQ/cJ./gxCIU2sbIa1UZHABKKNkmAhDz8nuLa', '03312121321', 'unpaid', 'activated', '2020-04-28 06:21:41', NULL, NULL, '2020-04-28 13:21:41', '2020-04-28 13:21:41'),
('5ea7cc021f006', 2, 'junaid', 'bhai', 'junaid@m.com', '$2y$10$8.VMn/Z/lYxIy1u/XQfu5uLL4TFzTMhi6gCH7wkfsCSlwhjeNXOLi', '03121213213', 'unpaid', 'activated', '2020-04-28 06:24:02', NULL, NULL, '2020-04-28 13:24:02', '2020-04-28 13:24:02'),
('5ea84c7754035', 2, 'akram', 'khan', 'akram_khan@m.com', '$2y$10$ImY39ojwpLb4Yam.bamL5uU5E8R7UKyxuZkfQJbPJv/GEvNK8DeYS', '03213212131', 'unpaid', 'activated', '2020-04-28 15:32:07', NULL, NULL, '2020-04-28 22:32:07', '2020-04-28 22:32:07');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
