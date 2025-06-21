-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 21, 2025 at 09:42 AM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `party_witty`
--

-- --------------------------------------------------------

--
-- Table structure for table `consumers`
--

DROP TABLE IF EXISTS `consumers`;
CREATE TABLE IF NOT EXISTS `consumers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Person','Department','BusinessUnit') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Person',
  `contact_info` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consumers`
--

INSERT INTO `consumers` (`id`, `name`, `email`, `type`, `contact_info`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Zora Keeling', 'jaylen46@example.com', 'BusinessUnit', ', +12837368740', '2025-06-20 22:48:30', '2025-06-20 22:48:30', NULL),
(2, 'Santa Gerlach PhD', 'delbert.koepp@example.org', 'BusinessUnit', ', +1.951.692.3110', '2025-06-20 22:48:30', '2025-06-20 22:48:30', NULL),
(3, 'Salvador Pollich V', 'adam36@example.org', 'Person', ', 689.732.4072', '2025-06-20 22:48:30', '2025-06-20 22:48:30', NULL),
(4, 'Prof. Hilma Rolfson', 'augustus.swaniawski@example.org', 'Department', '1556 Lela Club\nPort Mayra, ND 61373-0890, 256-451-2554', '2025-06-20 22:48:30', '2025-06-20 22:48:30', NULL),
(5, 'Marian Buckridge I', 'layla90@example.org', 'Person', ', +1 (947) 903-3305', '2025-06-20 22:48:30', '2025-06-20 22:48:30', NULL),
(6, 'Shyanne Roberts', 'fletcher06@example.org', 'Department', ', +1-952-219-7832', '2025-06-20 22:48:30', '2025-06-20 22:48:30', NULL),
(7, 'Rolando Johns', 'langosh.jeffry@example.org', 'Department', ', 1-651-931-9360', '2025-06-20 22:48:30', '2025-06-20 22:48:30', NULL),
(8, 'Mr. Xander King DDS', 'bmedhurst@example.com', 'Department', '3407 Thiel Haven\nSouth Mikel, MA 42698, +12532591607', '2025-06-20 22:48:30', '2025-06-20 22:48:30', NULL),
(9, 'Gennaro Morissette', 'ryan.hillard@example.net', 'BusinessUnit', '975 Hammes Inlet\nEast Uriahmouth, KS 15721, +1.667.408.0672', '2025-06-20 22:48:30', '2025-06-20 22:48:30', NULL),
(10, 'Zackary Lang', 'kturner@example.com', 'Department', '5307 Rempel Manor\nWalkerport, ND 79616-4881, 504-204-5203', '2025-06-20 22:48:30', '2025-06-21 03:24:55', '2025-06-21 03:24:55'),
(11, 'Test 2', 'prajapatiarun67@gmail.com', 'BusinessUnit', 'malad', '2025-06-21 03:01:58', '2025-06-21 03:56:53', NULL),
(12, 'Test 1', 'test@test.com', 'Person', 'malad', '2025-06-21 03:56:53', '2025-06-21 03:56:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_06_18_151355_create_product_table', 1),
(6, '2025_06_18_151429_create_product_inventory_table', 1),
(7, '2025_06_18_151508_create_consumers_table', 1),
(8, '2025_06_18_151530_create_transactions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `191` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_product_code_unique` (`product_code`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `product_code`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Mrs. Hertha Walker', '239.56', 'kj-57248', NULL, '2025-06-20 22:15:32', '2025-06-20 21:20:52', '2025-06-20 22:15:32'),
(2, 'Darlene Ruecker', '534.73', 'pi-25349', 'In placeat tenetur aspernatur corrupti dolores. Magnam et possimus est sint qui. Quia deserunt culpa molestias dolore quia. Voluptatibus qui velit occaecati voluptatem consequatur voluptatem impedit.', '2025-06-20 22:15:39', '2025-06-20 21:20:52', '2025-06-20 22:15:39'),
(3, 'Miss Danika Barton', '656.02', 'oa-41650', NULL, NULL, '2025-06-20 21:20:52', '2025-06-20 21:20:52'),
(4, 'Nathaniel Kling', '293.29', 'oi-45642', NULL, NULL, '2025-06-20 21:20:52', '2025-06-20 21:20:52'),
(5, 'Mr. Hazle Frami IV', '740.28', 'xa-56852', NULL, NULL, '2025-06-20 21:20:52', '2025-06-20 21:20:52'),
(6, 'Mr. Fred Barrows', '113.47', 'kw-64241', NULL, NULL, '2025-06-20 21:20:52', '2025-06-20 21:20:52'),
(7, 'Mr. Joany Hagenes PhD', '123.45', 'ee-57266', NULL, NULL, '2025-06-20 21:20:52', '2025-06-20 21:20:52'),
(8, 'Wilfrid McClure', '171.65', 'as-07691', NULL, NULL, '2025-06-20 21:20:52', '2025-06-20 21:20:52'),
(9, 'Brooks Zieme', '509.03', 'dc-63648', 'Deserunt amet iste ipsa. Dicta veritatis sit quasi quo aut id dolorem velit. Et quidem ut aut eligendi temporibus temporibus. Quo est tempore impedit atque tempora omnis quibusdam.', NULL, '2025-06-20 21:20:52', '2025-06-20 21:20:52'),
(10, 'Prof. Deontae Harber PhD', '262.47', 'tl-60160', 'Non natus veniam dolorum sed ducimus. Consequatur dolorem quis voluptatem illum. Perferendis natus mollitia ipsum inventore quaerat eius.', NULL, '2025-06-20 21:20:52', '2025-06-20 21:20:52'),
(34, 'Jeans', '120.00', 'JNS002', 'Slim fit denim jeans', NULL, '2025-06-21 02:21:06', '2025-06-21 02:21:06'),
(33, 'T-Shirt', '30.00', 'TSH001', 't-shirt in various sizes', NULL, '2025-06-21 02:21:06', '2025-06-21 02:21:06'),
(32, 'Product 1', '30.00', 'pd-001', 'adasdasd', '2025-06-20 22:14:36', '2025-06-20 21:43:28', '2025-06-20 22:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory`
--

DROP TABLE IF EXISTS `product_inventory`;
CREATE TABLE IF NOT EXISTS `product_inventory` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `available_units` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_product_inventory_product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_inventory`
--

INSERT INTO `product_inventory` (`id`, `product_id`, `available_units`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 28, '2025-06-20 21:20:52', '2025-06-20 22:15:32', '2025-06-20 22:15:32'),
(2, 2, 6, '2025-06-20 21:20:52', '2025-06-20 22:15:39', '2025-06-20 22:15:39'),
(3, 3, 48, '2025-06-20 21:20:52', '2025-06-21 00:43:00', NULL),
(4, 4, 31, '2025-06-20 21:20:52', '2025-06-20 21:20:52', NULL),
(5, 5, 12, '2025-06-20 21:20:52', '2025-06-20 21:20:52', NULL),
(6, 6, 64, '2025-06-20 21:20:52', '2025-06-20 21:20:52', NULL),
(7, 7, 3, '2025-06-20 21:20:52', '2025-06-20 21:20:52', NULL),
(8, 8, 100, '2025-06-20 21:20:52', '2025-06-20 21:20:52', NULL),
(9, 9, 13, '2025-06-20 21:20:52', '2025-06-20 23:19:38', NULL),
(10, 10, 63, '2025-06-20 21:20:52', '2025-06-20 21:20:52', NULL),
(11, 32, 20, '2025-06-20 21:43:28', '2025-06-20 22:14:36', '2025-06-20 22:14:36'),
(12, 33, 30, '2025-06-21 02:21:06', '2025-06-21 02:21:06', NULL),
(13, 34, 50, '2025-06-21 02:21:06', '2025-06-21 02:21:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `consumer_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `transaction_type` enum('Issue','Return') COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_consumer_id_index` (`consumer_id`),
  KEY `transactions_product_id_index` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `consumer_id`, `product_id`, `transaction_type`, `quantity`, `transaction_date`, `notes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Issue', 34, '2025-06-20 23:27:48', NULL, NULL, '2025-06-20 23:27:48', '2025-06-20 23:27:48'),
(2, 1, 3, 'Issue', 34, '2025-06-20 23:30:55', NULL, NULL, '2025-06-20 23:30:55', '2025-06-20 23:30:55'),
(3, 1, 3, 'Return', 3, '2025-06-21 00:43:00', NULL, NULL, '2025-06-21 00:43:00', '2025-06-21 00:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
