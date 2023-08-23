-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2023 at 02:41 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ios`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `brand_image` varchar(255) DEFAULT NULL,
  `brand_slug` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `category_id`, `brand_name`, `brand_image`, `brand_slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Aidelai', 'upload/brands/1769281693491172.jpg', 'aidelai', 1, 14, NULL, '2023-06-20 19:35:09', NULL),
(2, 1, 'Christine', 'upload/brands/1769281783377527.jpg', 'christine', 1, 14, NULL, '2023-06-20 19:36:35', NULL),
(3, 1, 'Swift', 'upload/brands/1769281797035742.jpg', 'swift', 1, 14, NULL, '2023-06-20 19:36:48', NULL),
(4, 2, 'Supreme', 'upload/brands/1769281811184351.jpg', 'supreme', 1, 14, NULL, '2023-06-20 19:37:01', NULL),
(5, 2, 'AlcoPlus', 'upload/brands/1769281825355911.jpg', 'alcoplus', 1, 14, NULL, '2023-06-20 19:37:15', NULL),
(6, 2, 'Prestige', 'upload/brands/1769281836815365.jpg', 'prestige', 1, 14, NULL, '2023-06-20 19:37:26', NULL),
(7, 3, 'EcoBudget', 'upload/brands/1769281849395681.jpg', 'ecobudget', 1, 14, NULL, '2023-06-20 19:37:38', NULL),
(8, 3, 'Femme', 'upload/brands/1769281865313609.webp', 'femme', 1, 14, NULL, '2023-06-20 19:37:53', NULL),
(9, 3, 'Sanicare', 'upload/brands/1769281878316829.jpg', 'sanicare', 1, 14, NULL, '2023-06-20 19:38:05', NULL),
(10, 4, 'Local Brands', 'upload/brands/1771187199093373.jpg', 'local-brands', 1, 14, NULL, '2023-07-11 20:22:21', NULL),
(11, 2, 'Lucasth', 'upload/brands/1771187639951011.png', 'lucasth', 1, 14, NULL, '2023-07-11 20:29:21', NULL),
(12, 4, 'Lucasth', 'upload/brands/1771187884946593.png', 'lucasth', 1, 14, NULL, '2023-07-11 20:33:15', NULL),
(13, 4, 'Lysol', 'upload/brands/1771188793022821.png', 'lysol', 1, 14, NULL, '2023-07-11 20:47:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `category_slug` varchar(255) DEFAULT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `category_image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Facemasks', 'facemasks', 'upload/categories/1769281639973153.webp', 1, 14, NULL, '2023-06-20 19:34:18', NULL),
(2, 'Alcohols', 'alcohols', 'upload/categories/1769281657122004.jpg', 1, 14, NULL, '2023-06-20 19:34:35', NULL),
(3, 'Tissues', 'tissues', 'upload/categories/1769281673141626.png', 1, 14, NULL, '2023-06-20 19:34:50', NULL),
(4, 'Other Products', 'other-products', 'upload/categories/1771187168517796.jpg', 1, 14, NULL, '2023-07-11 20:21:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `footers`
--

CREATE TABLE IF NOT EXISTS `footers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `company_description` longtext NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_phone` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_facebook` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footers`
--

INSERT INTO `footers` (`id`, `company_name`, `company_description`, `company_address`, `company_phone`, `company_email`, `company_facebook`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'eTorrecamps', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id quam ut nunc aliquet dignissim at fringilla neque. Nulla posuere, dolor vel cursus fringilla, quam odio posuere turpis, quis fermentum risus ipsum in velit. Proin sollicitudin, ipsum sit amet elementum vehicula, augue tellus vulputate nunc,', '#14 San Vicente Ferrer St., SAV-1, Sucat, Paranaque City, Metro Manila, 1700', '09369225861', 'mtrf24@gmail.com', 'https://www.facebook.com/torrecampsmktg', 1, 1, '2023-05-23 11:21:04', '2023-05-27 06:48:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_17_010427_add_details_to_users_table', 2),
(6, '2023_05_17_072238_create_suppliers_table', 3),
(7, '2023_05_17_130950_create_units_table', 4),
(8, '2023_05_17_134127_create_categories_table', 5),
(9, '2023_05_17_151424_create_brands_table', 6),
(10, '2023_05_18_003103_create_products_table', 7),
(11, '2023_05_19_091048_create_purchases_table', 8),
(12, '2023_05_22_025551_create_sliders_table', 9),
(13, '2023_05_22_154735_create_wishlists_table', 10),
(14, '2023_05_23_030209_create_carts_table', 11),
(15, '2023_05_23_081520_create_orders_table', 12),
(16, '2023_05_23_081928_create_order_items_table', 12),
(17, '2023_05_23_190235_create_footers_table', 13),
(18, '2023_05_24_042609_create_user_details_table', 14),
(19, '2023_05_29_084740_create_purchase_ids_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tracking_no` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `status_message` varchar(255) NOT NULL,
  `return_order` varchar(255) DEFAULT '0',
  `payment_mode` varchar(255) NOT NULL,
  `del_fee` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `tracking_no`, `name`, `email`, `phone`, `address1`, `address2`, `city`, `province`, `zip_code`, `status_message`, `return_order`, `payment_mode`, `del_fee`, `created_at`, `updated_at`) VALUES
(1, 18, 'TM-X6baufQ9G5', 'Jan Terence Francisco', 'franciscoterence98@gmail.com', '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'completed', '2', 'Cash on Delivery', '300', '2023-06-20 22:12:33', '2023-07-11 03:59:38'),
(2, 18, 'TM-L7uJAdKnbb', 'Jan Terence Francisco', 'franciscoterence98@gmail.com', '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'in progress', '0', 'Cash on Delivery', NULL, '2023-06-20 22:45:33', '2023-06-20 22:45:33'),
(3, 18, 'TM-8feXP0Ov39', 'Jan Terence Francisco', 'franciscoterence98@gmail.com', '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'completed', '2', 'Cash on Delivery', NULL, '2023-06-20 22:54:56', '2023-07-11 08:43:30'),
(4, 18, 'TM-4ZpMKTTUwN', 'Jan Terence Francisco', 'franciscoterence98@gmail.com', '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-07-12 08:50:45', '2023-07-10 22:25:24'),
(5, 14, 'TM-HmS7XOU4R4', 'Admin Torrecamps', 'torrecampsm@gmail.com', '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque', 'Metro Manila', '1700', 'completed', '2', 'Cash on Delivery', '300', '2023-07-11 04:00:49', '2023-07-11 04:04:28'),
(6, 13, 'TM-Y7KrQqtzr0', 'Clarisse Rivera', 'clrssrivera001@gmail.com', '09195346006', 'San Pancrasio St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'completed', '2', 'Cash on Delivery', NULL, '2023-07-11 08:36:28', '2023-07-11 08:39:34'),
(7, 18, 'TM-XOVAqdbzR7', 'Jan Terence Francisco', 'franciscoterence98@gmail.com', '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'in progress', '0', 'Cash on Delivery', NULL, '2023-07-11 09:11:53', '2023-07-11 09:11:53'),
(8, 18, 'TM-sxxeJdEu9j', 'Jan Terence Francisco', 'franciscoterence98@gmail.com', '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'in progress', '0', 'Cash on Delivery', NULL, '2023-07-11 09:13:16', '2023-07-11 09:13:16'),
(9, 14, 'TM-79Eb8zslZv', 'Admin Torrecamps', 'torrecampsm@gmail.com', '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque', 'Metro Manila', '1700', 'completed', '2', 'Cash on Delivery', NULL, '2023-07-11 09:45:08', '2023-07-11 22:24:02'),
(10, 14, 'TM-Nd5qQRiObn', 'Admin Torrecamps', 'torrecampsm@gmail.com', '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-07-12 07:19:27', '2023-07-12 07:19:48'),
(11, 14, 'TM-tfVYKxWmSy', 'Admin Torrecamps', 'torrecampsm@gmail.com', '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-07-12 08:50:45', '2023-07-12 08:50:59'),
(12, 15, 'TM-vI52AaetWt', 'Ken Carangan', 'ken.angelo.18@gmail.com', '09365225861', '14 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-07-10 10:20:42', '2023-07-10 10:20:42'),
(13, 15, 'TM-Hm9pfmu0R8', 'Ken Carangan', 'ken.angelo.18@gmail.com', '09365225861', '14 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-06-12 10:25:07', '2023-07-12 10:27:55'),
(14, 9, 'TM-Iz7Poxhm4n', 'Babs Francisco', 'babsf0321@gmail.com', '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', '150', '2023-07-07 10:30:30', '2023-07-12 10:30:55'),
(15, 9, 'TM-qwsXPQ7bfm', 'Babs Francisco', 'babsf0321@gmail.com', '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-07-08 10:33:12', '2023-07-12 10:33:27'),
(16, 9, 'TM-iSeJ8s0zDP', 'Babs Francisco', 'babsf0321@gmail.com', '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-07-11 10:35:06', '2023-07-12 10:35:26'),
(17, 9, 'TM-mGhRvSvpA8', 'Babs Francisco', 'babsf0321@gmail.com', '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-05-12 10:37:13', '2023-07-12 10:39:05'),
(18, 9, 'TM-XENpbN5aX7', 'Babs Francisco', 'babsf0321@gmail.com', '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-07-09 10:40:30', '2023-07-12 10:41:26'),
(19, 13, 'TM-uJ8CJN07I3', 'Clarisse Rivera', 'clrssrivera001@gmail.com', '09195346006', 'San Pancrasio St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-06-12 10:44:14', '2023-07-12 10:45:03'),
(20, 13, 'TM-PPMHL6ZfA5', 'Clarisse Rivera', 'clrssrivera001@gmail.com', '09195346006', 'San Pancrasio St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-07-12 10:45:38', '2023-07-12 10:46:03'),
(21, 13, 'TM-zLwKVEM6zJ', 'Clarisse Rivera', 'clrssrivera001@gmail.com', '09195346006', 'San Pancrasio St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-07-11 10:46:47', '2023-07-12 10:47:27'),
(22, 16, 'TM-QwDeq4WxDf', 'Juan Dela Cruz', 'demothis@gmail.com', '09365225861', '14 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-05-12 10:49:06', '2023-07-12 10:50:06'),
(23, 16, 'TM-NrWSr84PzH', 'Juan Dela Cruz', 'demothis@gmail.com', '09365225861', '14 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-05-12 10:49:06', '2023-07-12 10:51:20'),
(24, 16, 'TM-TACiKaJMsU', 'Juan Dela Cruz', 'demothis@gmail.com', '09365225861', '14 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-07-10 10:52:51', '2023-07-12 10:53:26'),
(25, 16, 'TM-EmHg04Q2KR', 'Juan Dela Cruz', 'demothis@gmail.com', '09365225861', '14 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-07-12 10:54:02', '2023-07-12 10:54:21'),
(26, 13, 'TM-ivldOzKPz1', 'Clarisse Rivera', 'clrssrivera001@gmail.com', '09195346006', 'San Pancrasio St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'completed', '0', 'Cash on Delivery', NULL, '2023-07-12 17:22:00', '2023-07-12 17:23:00'),
(27, 13, 'TM-yBdqMbs3Dm', 'Clarisse Rivera', 'clrssrivera001@gmail.com', '09195346006', 'San Pancrasio St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'completed', '2', 'Cash on Delivery', NULL, '2023-07-12 17:22:18', '2023-07-12 17:25:13'),
(28, 13, 'TM-YAmRDGm3bj', 'Clarisse Rivera', 'clrssrivera001@gmail.com', '09195346006', 'San Pancrasio St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', 'in progress', '0', 'Cash on Delivery', NULL, '2023-07-12 17:33:55', '2023-07-12 17:33:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(19,2) NOT NULL,
  `total_price` decimal(19,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 200, '30.00', '0.00', '2023-06-20 22:12:33', '2023-07-11 03:59:38'),
(2, 2, 1, 800, '30.00', '24000.00', '2023-06-20 22:45:33', '2023-06-20 22:45:33'),
(3, 3, 3, 3, '30.00', '0.00', '2023-06-20 22:54:56', '2023-07-11 08:43:30'),
(4, 3, 4, 3, '25.00', '0.00', '2023-06-20 22:54:56', '2023-07-11 08:43:30'),
(5, 3, 7, 4, '200.00', '0.00', '2023-06-20 22:54:56', '2023-07-11 08:43:30'),
(6, 3, 8, 4, '200.00', '0.00', '2023-07-12 08:50:45', '2023-07-11 08:43:30'),
(7, 3, 9, 4, '210.00', '0.00', '2023-07-12 08:50:45', '2023-07-11 08:43:30'),
(8, 3, 10, 4, '210.00', '0.00', '2023-07-12 08:50:45', '2023-07-12 08:50:45'),
(9, 4, 6, 3, '190.00', '570.00', '2023-07-12 08:50:45', '2023-07-12 08:50:45'),
(10, 4, 2, 4, '30.00', '120.00', '2023-07-12 08:50:45', '2023-06-20 22:55:34'),
(11, 4, 11, 4, '180.00', '720.00', '2023-07-12 08:50:45', '2023-06-20 22:55:34'),
(12, 5, 5, 1, '190.00', '0.00', '2023-07-11 04:00:49', '2023-07-11 04:04:28'),
(13, 5, 6, 1, '190.00', '0.00', '2023-07-11 04:00:49', '2023-07-11 04:04:28'),
(14, 6, 6, 1, '190.00', '0.00', '2023-07-11 08:36:28', '2023-07-11 08:39:34'),
(15, 6, 7, 1, '200.00', '0.00', '2023-07-11 08:36:28', '2023-07-11 08:39:34'),
(16, 7, 8, 1, '200.00', '200.00', '2023-07-11 09:11:53', '2023-07-11 09:11:53'),
(17, 8, 4, 1, '25.00', '25.00', '2023-07-11 09:13:16', '2023-07-11 09:13:16'),
(18, 9, 7, 995, '200.00', '0.00', '2023-07-11 09:45:08', '2023-07-11 22:24:02'),
(19, 10, 24, 3, '450.00', '1350.00', '2023-07-12 07:19:27', '2023-07-12 07:19:27'),
(20, 11, 5, 3, '190.00', '570.00', '2023-07-12 08:50:45', '2023-07-12 08:50:45'),
(21, 12, 1, 5, '30.00', '150.00', '2023-07-10 10:20:42', '2023-07-12 10:20:42'),
(22, 12, 8, 15, '200.00', '3000.00', '2023-07-10 10:20:42', '2023-07-12 10:20:42'),
(23, 13, 14, 5, '220.00', '1100.00', '2023-06-12 10:25:07', '2023-07-12 10:25:07'),
(24, 13, 43, 10, '40.00', '400.00', '2023-06-12 10:25:07', '2023-07-12 10:25:07'),
(25, 14, 3, 50, '30.00', '1500.00', '2023-07-07 10:30:30', '2023-07-12 10:30:30'),
(26, 14, 27, 100, '180.00', '18000.00', '2023-07-07 10:30:30', '2023-07-12 10:30:30'),
(27, 14, 17, 10, '845.00', '8450.00', '2023-07-07 10:30:30', '2023-07-12 10:30:30'),
(28, 15, 26, 5, '600.00', '3000.00', '2023-07-08 10:33:12', '2023-07-12 10:33:12'),
(29, 15, 33, 100, '95.00', '9500.00', '2023-07-08 10:33:12', '2023-07-12 10:33:12'),
(30, 16, 8, 15, '200.00', '3000.00', '2023-07-11 10:35:06', '2023-07-12 10:35:06'),
(31, 16, 4, 100, '25.00', '2500.00', '2023-07-11 10:35:06', '2023-07-12 10:35:06'),
(32, 17, 2, 15, '30.00', '450.00', '2023-05-12 10:37:13', '2023-07-12 10:37:13'),
(33, 17, 41, 100, '110.00', '11000.00', '2023-05-12 10:37:13', '2023-07-12 10:37:13'),
(34, 18, 24, 5, '450.00', '2250.00', '2023-07-09 10:40:30', '2023-07-12 10:40:30'),
(35, 18, 39, 10, '190.00', '1900.00', '2023-07-09 10:40:30', '2023-07-12 10:40:30'),
(36, 19, 7, 100, '200.00', '20000.00', '2023-06-12 10:44:14', '2023-07-12 10:44:14'),
(37, 19, 17, 5, '845.00', '4225.00', '2023-06-12 10:44:14', '2023-07-12 10:44:14'),
(38, 20, 42, 100, '110.00', '11000.00', '2023-07-12 10:45:38', '2023-07-12 10:45:38'),
(39, 20, 10, 50, '210.00', '10500.00', '2023-07-12 10:45:38', '2023-07-12 10:45:38'),
(40, 21, 10, 80, '210.00', '16800.00', '2023-07-11 10:46:47', '2023-07-12 10:46:47'),
(41, 21, 29, 40, '120.00', '4800.00', '2023-07-11 10:46:47', '2023-07-12 10:46:47'),
(42, 22, 37, 50, '150.00', '7500.00', '2023-05-12 10:49:06', '2023-07-12 10:49:06'),
(43, 22, 1, 100, '30.00', '3000.00', '2023-05-12 10:49:06', '2023-07-12 10:49:06'),
(44, 23, 38, 50, '400.00', '20000.00', '2023-05-12 10:49:06', '2023-07-12 10:50:39'),
(45, 23, 9, 150, '210.00', '31500.00', '2023-05-12 10:49:06', '2023-07-12 10:50:39'),
(46, 24, 16, 15, '1150.00', '17250.00', '2023-07-10 10:52:51', '2023-07-12 10:52:51'),
(47, 24, 11, 10, '180.00', '1800.00', '2023-07-10 10:52:51', '2023-07-12 10:52:51'),
(48, 25, 35, 200, '300.00', '60000.00', '2023-07-12 10:54:02', '2023-07-12 10:54:02'),
(49, 26, 1, 3, '30.00', '90.00', '2023-07-12 17:22:00', '2023-07-12 17:22:00'),
(50, 27, 14, 4, '220.00', '0.00', '2023-07-12 17:22:18', '2023-07-12 17:25:13'),
(51, 28, 5, 497, '190.00', '94430.00', '2023-07-12 17:33:55', '2023-07-12 17:33:55');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_slug` varchar(255) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `quantity` double NOT NULL DEFAULT 0,
  `selling_price` decimal(19,2) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `to_reorder` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `supplier_id`, `unit_id`, `category_id`, `brand_id`, `product_name`, `product_slug`, `product_image`, `quantity`, `selling_price`, `status`, `to_reorder`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'Aidelai Black Facemask', 'aidelai-black-facemask', 'upload/products/1769281926032143.jpg', 892, '30.00', 1, '200', 14, NULL, '2023-06-20 19:38:51', '2023-07-12 17:22:00'),
(2, 1, 1, 1, 1, 'Aidelai Blue Facemask', 'aidelai-blue-facemask', 'upload/products/1769282003839242.jpg', 985, '30.00', 1, '300', 14, NULL, '2023-06-20 19:40:05', '2023-07-12 10:37:13'),
(3, 2, 1, 1, 2, 'Christine KN95', 'christine-kn95', 'upload/products/1769282106365107.jpg', 948, '30.00', 1, '100', 14, NULL, '2023-06-20 19:41:43', '2023-07-12 10:30:30'),
(4, 3, 1, 1, 3, 'Swift 3D Mask', 'swift-3d-mask', 'upload/products/1769282149235372.jpg', 896, '25.00', 1, '300', 14, 14, '2023-06-20 19:42:24', '2023-07-12 10:35:06'),
(5, 4, 2, 2, 4, 'Supreme Isopropyl Alcohol', 'supreme-isopropyl-alcohol', 'upload/products/1769282221269922.jpg', 499, '190.00', 1, '500', 14, NULL, '2023-06-20 19:43:33', '2023-07-12 17:33:55'),
(6, 4, 2, 2, 4, 'Supreme Ethyl Alcohol', 'supreme-ethyl-alcohol', 'upload/products/1769282254742862.jpg', 998, '190.00', 1, '500', 14, NULL, '2023-06-20 19:44:04', '2023-07-11 08:36:28'),
(7, 5, 2, 2, 5, 'AlcoPlus Isopropyl Alcohol', 'alcoplus-isopropyl-alcohol', 'upload/products/1769282292387586.jpg', 900, '200.00', 1, '300', 14, NULL, '2023-06-20 19:44:40', '2023-07-12 10:44:14'),
(8, 5, 2, 2, 5, 'AlcoPlus Ethyl Alcohol', 'alcoplus-ethyl-alcohol', 'upload/products/1769282328833878.jpg', 965, '200.00', 1, '300', 14, NULL, '2023-06-20 19:45:15', '2023-07-12 10:35:06'),
(9, 6, 2, 2, 6, 'Prestige Isopropyl Alcohol', 'prestige-isopropyl-alcohol', 'upload/products/1769282370095148.jpg', 846, '210.00', 1, '400', 14, NULL, '2023-06-20 19:45:54', '2023-07-12 10:50:39'),
(10, 6, 2, 2, 6, 'Prestige Ethyl Alcohol', 'prestige-ethyl-alcohol', 'upload/products/1769282420858795.jpg', 866, '210.00', 1, '400', 14, NULL, '2023-06-20 19:46:43', '2023-07-12 10:46:47'),
(11, 7, 3, 3, 7, 'EcoBudget Quarterfold Tissue', 'ecobudget-quarterfold-tissue', 'upload/products/1769282460925342.jpg', 990, '180.00', 1, '200', 14, NULL, '2023-06-20 19:47:21', '2023-07-12 10:52:51'),
(12, 7, 1, 3, 8, 'Femme Bathroom Tissue', 'femme-bathroom-tissue', 'upload/products/1769282494616702.webp', 0, '150.00', 1, '100', 14, NULL, '2023-06-20 19:47:53', NULL),
(13, 7, 1, 3, 9, 'Sanicare Kitchen Towel', 'sanicare-kitchen-towel', 'upload/products/1769282521300131.jpg', 1000, '240.00', 1, '100', 14, NULL, '2023-06-20 19:48:19', '2023-07-12 07:18:35'),
(14, 7, 4, 3, 9, 'Pre-Cut Table Napkin', 'pre-cut-table-napkin', 'upload/products/1771186266199128.jpg', 991, '220.00', 1, '100', 14, NULL, '2023-07-11 20:07:32', '2023-07-12 17:22:18'),
(15, 7, 5, 3, 7, 'Pop Up Tissue 400 Sheets', 'pop-up-tissue-400-sheets', 'upload/products/1771186397657990.jpg', 1000, '1030.00', 1, '150', 14, NULL, '2023-07-11 20:09:37', '2023-07-12 07:18:35'),
(16, 7, 5, 3, 7, 'Jumbo Roll Tissue 200m VP', 'jumbo-roll-tissue-200m-vp', 'upload/products/1771186479100268.jpg', 985, '1150.00', 1, '100', 14, NULL, '2023-07-11 20:10:54', '2023-07-12 10:52:51'),
(17, 7, 5, 3, 7, 'Hand Roll Towel 180m', 'hand-roll-towel-180m', 'upload/products/1771186558501268.jpg', 985, '845.00', 1, '200', 14, NULL, '2023-07-11 20:12:10', '2023-07-12 10:44:14'),
(18, 7, 1, 3, 7, 'Facial/Soft Tissue 3 PLY', 'facial/soft-tissue-3-ply', 'upload/products/1771186657817712.jpg', 1000, '130.00', 1, '200', 14, NULL, '2023-07-11 20:13:45', '2023-07-12 07:18:35'),
(19, 7, 5, 3, 7, 'Paper Towel White 175/34 GSM', 'paper-towel-white-175/34-gsm', 'upload/products/1771186743176501.jpg', 1000, '950.00', 1, '50', 14, NULL, '2023-07-11 20:15:06', '2023-07-12 07:18:35'),
(20, 7, 5, 3, 7, 'Paper Towel White 175/30 GSM', 'paper-towel-white-175/30-gsm', 'upload/products/1771186812611753.jpg', 1000, '870.00', 1, '50', 14, NULL, '2023-07-11 20:16:12', '2023-07-12 07:18:35'),
(21, 7, 5, 3, 7, 'Paper Towel Brown - Mixed Grade', 'paper-towel-brown---mixed-grade', 'upload/products/1771186873933619.jpg', 1000, '820.00', 1, '50', 14, NULL, '2023-07-11 20:17:11', '2023-07-12 07:18:35'),
(22, 7, 1, 3, 7, 'Soft Tissue Wipes', 'soft-tissue-wipes', 'upload/products/1771186974696850.jpg', 1000, '18.00', 1, '200', 14, NULL, '2023-07-11 20:18:47', '2023-07-12 07:18:35'),
(23, 7, 5, 3, 7, 'Facial Tissue Flat Box', 'facial-tissue-flat-box', 'upload/products/1771187051987347.jpg', 1000, '27.00', 1, '50', 14, NULL, '2023-07-11 20:20:01', '2023-07-12 07:18:35'),
(24, 5, 6, 4, 10, 'Aluminum Foil', 'aluminum-foil', 'upload/products/1771187272200729.jpg', 992, '450.00', 1, '20', 14, NULL, '2023-07-11 20:23:31', '2023-07-12 10:40:30'),
(25, 5, 6, 4, 10, 'Food Wrap 12\" X 300M', 'food-wrap-12\"-x-300m', 'upload/products/1771187486182158.webp', 1000, '290.00', 1, '50', 14, NULL, '2023-07-11 20:26:55', '2023-07-12 07:18:22'),
(26, 5, 6, 4, 10, 'Food Wrap 18\" X 300M', 'food-wrap-18\"-x-300m', 'upload/products/1771187518259021.webp', 995, '600.00', 1, '50', 14, NULL, '2023-07-11 20:27:25', '2023-07-12 10:33:12'),
(27, 5, 2, 2, 11, 'Lucaseth Isopropyl Alcohol', 'lucaseth-isopropyl-alcohol', 'upload/products/1771187688135551.jpg', 900, '180.00', 1, '200', 14, NULL, '2023-07-11 20:30:07', '2023-07-12 10:30:30'),
(28, 5, 2, 2, 11, 'Lucaseth Ethyl Alcohol', 'lucaseth-ethyl-alcohol', 'upload/products/1771187714473490.jpg', 1000, '180.00', 1, '200', 14, NULL, '2023-07-11 20:30:32', '2023-07-12 07:18:22'),
(29, 6, 2, 4, 12, 'Toilet Bowl Cleaner', 'toilet-bowl-cleaner', 'upload/products/1771187917579128.jpg', 960, '120.00', 1, '20', 14, NULL, '2023-07-11 20:33:46', '2023-07-12 10:46:47'),
(30, 6, 2, 4, 12, 'Liquid Detergent', 'liquid-detergent', 'upload/products/1771188007712072.png', 1000, '120.00', 1, '20', 14, NULL, '2023-07-11 20:35:12', '2023-07-12 07:18:29'),
(31, 6, 2, 4, 10, 'Fabric Conditioner', 'fabric-conditioner', 'upload/products/1771188050846286.png', 1000, '120.00', 1, '20', 14, NULL, '2023-07-11 20:35:53', '2023-07-12 07:18:29'),
(32, 6, 2, 4, 10, 'All Purpose Cleaner', 'all-purpose-cleaner', 'upload/products/1771188095565321.png', 1000, '115.00', 1, '20', 14, NULL, '2023-07-11 20:36:36', '2023-07-12 07:18:29'),
(33, 6, 2, 4, 10, 'Bleach', 'bleach', 'upload/products/1771188196285776.png', 900, '95.00', 1, '20', 14, NULL, '2023-07-11 20:38:12', '2023-07-12 10:33:12'),
(34, 6, 2, 4, 10, 'Disinfectant', 'disinfectant', 'upload/products/1771188259568566.png', 1000, '110.00', 1, '50', 14, NULL, '2023-07-11 20:39:12', '2023-07-12 07:18:29'),
(35, 4, 2, 4, 12, 'Fogging Solution', 'fogging-solution', 'upload/products/1771188324720590.png', 800, '300.00', 1, '10', 14, NULL, '2023-07-11 20:40:14', '2023-07-12 10:54:02'),
(36, 4, 2, 4, 12, 'Hand Gel Sanitizer', 'hand-gel-sanitizer', 'upload/products/1771188476299617.png', 1000, '250.00', 1, '20', 14, NULL, '2023-07-11 20:42:39', '2023-07-12 07:18:18'),
(37, 4, 2, 4, 12, 'Car Shampoo', 'car-shampoo', 'upload/products/1771188499944358.png', 950, '150.00', 1, '20', 14, NULL, '2023-07-11 20:43:02', '2023-07-12 10:49:06'),
(38, 1, 7, 4, 13, 'Lysol Disinfectant Spray 681 mL', 'lysol-disinfectant-spray-681-ml', 'upload/products/1771188872732854.png', 950, '400.00', 1, '50', 14, NULL, '2023-07-11 20:48:57', '2023-07-12 10:50:39'),
(39, 1, 7, 4, 10, 'Furniture Polish 300mL', 'furniture-polish-300ml', 'upload/products/1771188924203710.png', 990, '190.00', 1, '20', 14, NULL, '2023-07-11 20:49:46', '2023-07-12 10:40:30'),
(40, 4, 2, 4, 12, 'Hand Soap Strawberry Scent', 'hand-soap-strawberry-scent', 'upload/products/1771189011095858.png', 1000, '110.00', 1, '20', 14, NULL, '2023-07-11 20:51:09', '2023-07-12 07:18:18'),
(41, 4, 2, 4, 12, 'Hand Soap Green Apple Scent', 'hand-soap-green-apple-scent', 'upload/products/1771189071348369.png', 900, '110.00', 1, '20', 14, NULL, '2023-07-11 20:52:06', '2023-07-12 10:37:13'),
(42, 4, 2, 4, 12, 'Hand Soap Lavender Scent', 'hand-soap-lavender-scent', 'upload/products/1771189099303250.png', 900, '110.00', 1, '20', 14, NULL, '2023-07-11 20:52:33', '2023-07-12 10:45:38'),
(43, 2, 6, 4, 10, 'Clear Packing Tape 2 X 100m', 'clear-packing-tape-2-x-100m', 'upload/products/1771189272236406.png', 990, '40.00', 1, '50', 14, NULL, '2023-07-11 20:55:18', '2023-07-12 10:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_no` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `buying_qty` double NOT NULL,
  `unit_price` decimal(19,2) NOT NULL,
  `buying_price` decimal(19,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_id`, `category_id`, `brand_id`, `product_id`, `purchase_no`, `date`, `buying_qty`, `unit_price`, `buying_price`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '1', '2023-06-21', 1000, '23.50', '23500.00', 1, 14, 14, '2023-06-20 21:56:24', '2023-06-20 21:59:50'),
(2, 1, 1, 1, 2, '1', '2023-06-21', 1000, '23.50', '23500.00', 1, 14, 14, '2023-06-20 21:56:24', '2023-06-20 21:59:50'),
(3, 2, 1, 2, 3, '2', '2023-06-21', 1000, '25.00', '25000.00', 1, 14, 14, '2023-06-20 21:56:44', '2023-06-20 21:59:47'),
(4, 3, 1, 3, 4, '3', '2023-06-21', 1000, '19.25', '19250.00', 1, 14, 14, '2023-06-20 21:57:12', '2023-06-20 21:59:44'),
(5, 4, 2, 4, 5, '4', '2023-06-21', 1000, '140.00', '140000.00', 1, 14, 14, '2023-06-20 21:57:52', '2023-06-20 21:59:41'),
(6, 4, 2, 4, 6, '4', '2023-06-21', 1000, '150.00', '150000.00', 1, 14, 14, '2023-06-20 21:57:52', '2023-06-20 21:59:41'),
(7, 5, 2, 5, 7, '5', '2023-06-21', 1000, '160.00', '160000.00', 1, 14, 14, '2023-06-20 21:58:46', '2023-06-20 21:59:37'),
(8, 5, 2, 5, 8, '5', '2023-06-21', 1000, '160.00', '160000.00', 1, 14, 14, '2023-06-20 21:58:46', '2023-06-20 21:59:37'),
(9, 6, 2, 6, 9, '6', '2023-06-21', 1000, '180.00', '180000.00', 1, 14, 14, '2023-06-20 21:59:18', '2023-06-20 21:59:32'),
(10, 6, 2, 6, 10, '6', '2023-06-21', 1000, '180.00', '180000.00', 1, 14, 14, '2023-06-20 21:59:18', '2023-06-20 21:59:32'),
(11, 7, 3, 7, 11, '7', '2023-06-21', 1000, '150.00', '150000.00', 1, 14, 14, '2023-06-20 22:18:32', '2023-06-20 22:19:09'),
(13, 1, 1, 1, 1, '9', '2023-07-12', 1000, '19.50', '19500.00', 1, 14, 14, '2023-07-12 07:04:58', '2023-07-12 07:18:03'),
(14, 1, 4, 10, 39, '9', '2023-07-12', 1000, '140.00', '140000.00', 1, 14, 14, '2023-07-12 07:04:58', '2023-07-12 07:18:03'),
(15, 1, 4, 13, 38, '9', '2023-07-12', 1000, '340.00', '340000.00', 1, 14, 14, '2023-07-12 07:04:58', '2023-07-12 07:18:03'),
(16, 2, 4, 10, 43, '10', '2023-07-12', 1000, '25.00', '25000.00', 1, 14, 14, '2023-07-12 07:05:42', '2023-07-12 07:18:14'),
(17, 4, 4, 12, 35, '11', '2023-07-12', 1000, '240.00', '240000.00', 1, 14, 14, '2023-07-12 07:08:02', '2023-07-12 07:18:18'),
(18, 4, 4, 12, 36, '11', '2023-07-12', 1000, '200.00', '200000.00', 1, 14, 14, '2023-07-12 07:08:02', '2023-07-12 07:18:18'),
(19, 4, 4, 12, 37, '11', '2023-07-12', 1000, '110.00', '110000.00', 1, 14, 14, '2023-07-12 07:08:02', '2023-07-12 07:18:18'),
(20, 4, 4, 12, 40, '11', '2023-07-12', 1000, '90.00', '90000.00', 1, 14, 14, '2023-07-12 07:08:02', '2023-07-12 07:18:18'),
(21, 4, 4, 12, 41, '11', '2023-07-12', 1000, '90.00', '90000.00', 1, 14, 14, '2023-07-12 07:08:02', '2023-07-12 07:18:18'),
(22, 4, 4, 12, 42, '11', '2023-07-12', 1000, '90.00', '90000.00', 1, 14, 14, '2023-07-12 07:08:02', '2023-07-12 07:18:18'),
(23, 5, 2, 5, 7, '12', '2023-07-12', 1000, '150.00', '150000.00', 1, 14, 14, '2023-07-12 07:11:36', '2023-07-12 07:18:22'),
(24, 5, 2, 11, 28, '12', '2023-07-12', 1000, '110.00', '110000.00', 1, 14, 14, '2023-07-12 07:11:36', '2023-07-12 07:18:22'),
(25, 5, 2, 11, 27, '12', '2023-07-12', 1000, '110.00', '110000.00', 1, 14, 14, '2023-07-12 07:11:36', '2023-07-12 07:18:22'),
(26, 5, 4, 10, 24, '12', '2023-07-12', 1000, '340.00', '340000.00', 1, 14, 14, '2023-07-12 07:11:36', '2023-07-12 07:18:22'),
(27, 5, 4, 10, 25, '12', '2023-07-12', 1000, '210.00', '210000.00', 1, 14, 14, '2023-07-12 07:11:36', '2023-07-12 07:18:22'),
(28, 5, 4, 10, 26, '12', '2023-07-12', 1000, '500.00', '500000.00', 1, 14, 14, '2023-07-12 07:11:36', '2023-07-12 07:18:22'),
(29, 6, 4, 10, 31, '13', '2023-07-12', 1000, '90.00', '90000.00', 1, 14, 14, '2023-07-12 07:13:44', '2023-07-12 07:18:29'),
(30, 6, 4, 10, 32, '13', '2023-07-12', 1000, '100.00', '100000.00', 1, 14, 14, '2023-07-12 07:13:44', '2023-07-12 07:18:29'),
(31, 6, 4, 10, 33, '13', '2023-07-12', 1000, '70.00', '70000.00', 1, 14, 14, '2023-07-12 07:13:44', '2023-07-12 07:18:29'),
(32, 6, 4, 10, 34, '13', '2023-07-12', 1000, '90.00', '90000.00', 1, 14, 14, '2023-07-12 07:13:44', '2023-07-12 07:18:29'),
(33, 6, 4, 12, 29, '13', '2023-07-12', 1000, '95.00', '95000.00', 1, 14, 14, '2023-07-12 07:13:44', '2023-07-12 07:18:29'),
(34, 6, 4, 12, 30, '13', '2023-07-12', 1000, '95.00', '95000.00', 1, 14, 14, '2023-07-12 07:13:44', '2023-07-12 07:18:29'),
(35, 7, 3, 7, 15, '14', '2023-07-12', 1000, '900.00', '900000.00', 1, 14, 14, '2023-07-12 07:17:54', '2023-07-12 07:18:35'),
(36, 7, 3, 7, 16, '14', '2023-07-12', 1000, '1000.00', '1000000.00', 1, 14, 14, '2023-07-12 07:17:54', '2023-07-12 07:18:35'),
(37, 7, 3, 7, 17, '14', '2023-07-12', 1000, '790.00', '790000.00', 1, 14, 14, '2023-07-12 07:17:55', '2023-07-12 07:18:35'),
(38, 7, 3, 7, 18, '14', '2023-07-12', 1000, '100.00', '100000.00', 1, 14, 14, '2023-07-12 07:17:55', '2023-07-12 07:18:35'),
(39, 7, 3, 7, 19, '14', '2023-07-12', 1000, '870.00', '870000.00', 1, 14, 14, '2023-07-12 07:17:55', '2023-07-12 07:18:35'),
(40, 7, 3, 7, 20, '14', '2023-07-12', 1000, '800.00', '800000.00', 1, 14, 14, '2023-07-12 07:17:55', '2023-07-12 07:18:35'),
(41, 7, 3, 7, 21, '14', '2023-07-12', 1000, '750.00', '750000.00', 1, 14, 14, '2023-07-12 07:17:55', '2023-07-12 07:18:35'),
(42, 7, 3, 7, 22, '14', '2023-07-12', 1000, '10.00', '10000.00', 1, 14, 14, '2023-07-12 07:17:55', '2023-07-12 07:18:35'),
(43, 7, 3, 7, 23, '14', '2023-07-12', 1000, '20.00', '20000.00', 1, 14, 14, '2023-07-12 07:17:55', '2023-07-12 07:18:35'),
(44, 7, 3, 9, 13, '14', '2023-07-12', 1000, '200.00', '200000.00', 1, 14, 14, '2023-07-12 07:17:55', '2023-07-12 07:18:35'),
(45, 7, 3, 9, 14, '14', '2023-07-12', 1000, '180.00', '180000.00', 1, 14, 14, '2023-07-12 07:17:55', '2023-07-12 07:18:35'),
(46, 1, 1, 2, 3, '15', '2023-07-13', 1, '233.00', '233.00', 1, 14, 14, '2023-07-12 08:10:47', '2023-07-12 08:10:54'),
(48, 2, 4, 10, 25, '17', '2023-07-13', 1, '234.00', '234.00', 1, 13, NULL, '2023-07-12 17:19:42', '2023-07-12 17:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_ids`
--

CREATE TABLE IF NOT EXISTS `purchase_ids` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_no` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_ids`
--

INSERT INTO `purchase_ids` (`id`, `purchase_no`, `date`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'TM - 09zBU2fHGh', '2023-06-21', 1, 14, 14, '2023-06-20 21:56:24', '2023-06-20 21:59:50'),
(2, 'TM - 71liKCqCmJ', '2023-06-21', 1, 14, 14, '2023-06-20 21:56:44', '2023-06-20 21:59:47'),
(3, 'TM - xtit0IxeqN', '2023-06-21', 1, 14, 14, '2023-06-20 21:57:12', '2023-06-20 21:59:44'),
(4, 'TM - si4szbSy3a', '2023-06-21', 1, 14, 14, '2023-06-20 21:57:52', '2023-06-20 21:59:41'),
(5, 'TM - cu059RiYsa', '2023-06-21', 1, 14, 14, '2023-06-20 21:58:46', '2023-06-20 21:59:37'),
(6, 'TM - Z0xC6NICbf', '2023-06-21', 1, 14, 14, '2023-06-20 21:59:18', '2023-06-20 21:59:32'),
(7, 'TM - XherDUPfv1', '2023-06-21', 1, 14, 14, '2023-06-20 22:18:32', '2023-06-20 22:19:09'),
(9, 'TM - KkGk6iTMJG', '2023-07-12', 1, 14, 14, '2023-07-12 07:04:58', '2023-07-12 07:18:03'),
(10, 'TM - hyJWtRGAJY', '2023-07-12', 1, 14, 14, '2023-07-12 07:05:42', '2023-07-12 07:18:14'),
(11, 'TM - T9j6UQH7HQ', '2023-07-12', 1, 14, 14, '2023-07-12 07:08:02', '2023-07-12 07:18:18'),
(12, 'TM - eEEp1a4sB4', '2023-07-12', 1, 14, 14, '2023-07-12 07:11:36', '2023-07-12 07:18:22'),
(13, 'TM - ci1wk1X9XG', '2023-07-12', 1, 14, 14, '2023-07-12 07:13:44', '2023-07-12 07:18:29'),
(14, 'TM - nZfN7KKjAQ', '2023-07-12', 1, 14, 14, '2023-07-12 07:17:54', '2023-07-12 07:18:35'),
(15, 'TM - dkNOzWcTor', '2023-07-13', 1, 14, 14, '2023-07-12 08:10:47', '2023-07-12 08:10:54'),
(17, 'TM - xhkZxRWMYl', '2023-07-13', 0, 13, NULL, '2023-07-12 17:19:42', '2023-07-12 17:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `slider_title` varchar(255) NOT NULL,
  `slider_description` mediumtext DEFAULT NULL,
  `slider_image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=hidden, 0=visible',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_title`, `slider_description`, `slider_image`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'First Slider Title', 'Sample Slider', 'upload/sliders/1769280270112993.jpg', 0, 14, 14, NULL, '2023-06-20 22:04:46');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) DEFAULT NULL,
  `supplier_phone` varchar(255) DEFAULT NULL,
  `supplier_email` varchar(255) DEFAULT NULL,
  `supplier_address1` varchar(255) DEFAULT NULL,
  `supplier_address2` varchar(255) DEFAULT NULL,
  `supplier_city` varchar(255) DEFAULT NULL,
  `supplier_province` varchar(255) DEFAULT NULL,
  `supplier_zipcode` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `supplier_phone`, `supplier_email`, `supplier_address1`, `supplier_address2`, `supplier_city`, `supplier_province`, `supplier_zipcode`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Matt Reyes', '+639431295921', 'mattreyes@gmail.com', '1069 Soler St', 'Binondo', 'Manila', 'Metro Manila', '1006', 1, 14, NULL, '2023-06-20 19:24:52', NULL),
(2, 'Kimberly Liu', '+639215726307', 'kimberlyliu@gmail.com', '616 Sto Nino St.', NULL, 'Mandaluyong', 'Metro Manila', '1550', 1, 14, NULL, '2023-06-20 19:25:55', NULL),
(3, 'Brenda Del Rosario', '+639206702096', 'bdelrosario@gmail.com', '12-A Eulogio Amang Rodriguez Ave', NULL, 'Pasig', 'Metro Manila', '1600', 1, 14, NULL, '2023-06-20 19:27:05', NULL),
(4, 'Marites Reyes', '+639275112202', 'tessreyes@gmail.com', '8 Mulawinan Street', 'Lawang Bato', 'Valenzuela', 'Metro Manila', '1440', 1, 14, NULL, '2023-06-20 19:28:09', NULL),
(5, 'Clarisse Rivera', '+639177915602', 'clrssrivera001@gmail.com', 'Co Kiong Bldg, 67 Gen. Luna St', NULL, 'Malabon', 'Metro Manila', '1470', 1, 14, NULL, '2023-06-20 19:29:45', NULL),
(6, 'Darwin Dalanon', '09195346006', 'ddalanon@gmail.com', 'Blk 5 Lt 2 Expressview Villas', 'Margarita, Putatan', 'Muntinlupa', 'Metro Manila', '1772', 1, 14, NULL, '2023-06-20 19:30:33', NULL),
(7, 'Jasmine Ramboyong', '+639174451468', 'jramboyong@gmail.com', '605 M. Naval Street', 'Bagumbayan', 'Navotas', 'Metro Manila', '1485', 1, 14, NULL, '2023-06-20 19:31:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'PACKS', 1, 14, NULL, '2023-06-20 19:31:59', NULL),
(2, 'GALLONS', 1, 14, NULL, '2023-06-20 19:32:06', NULL),
(3, 'SETS', 1, 14, NULL, '2023-06-20 19:32:12', NULL),
(4, 'BUNDLE', 1, 14, NULL, '2023-07-11 20:06:38', NULL),
(5, 'BOX', 1, 14, NULL, '2023-07-11 20:08:44', NULL),
(6, 'ROLL', 1, 14, NULL, '2023-07-11 20:23:06', NULL),
(7, 'PCS', 1, 14, NULL, '2023-07-11 20:46:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=user,1=admin',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_as`) VALUES
(3, 'Customer', 'customer@gmail.com', NULL, '$2y$10$5mATmdJ9RVZJbxynrEfw/eukuJvy9Nr6lthF10wtHPCs/nMj1RAgO', NULL, '2023-05-22 08:50:57', '2023-06-01 19:49:16', 0),
(9, 'Babs Francisco', 'babsf0321@gmail.com', '2023-05-25 02:48:19', '$2y$10$K.sVv.D5zwx7m6UjPh.7s.ewjC8wkizxvYhHmPdrUo3mLfwuGG0IO', NULL, '2023-05-25 02:48:12', '2023-07-12 08:23:52', 0),
(13, 'Clarisse Rivera', 'clrssrivera001@gmail.com', '2023-05-25 02:48:19', '$2y$10$XKZgSQaY9fefapAGG056Q.ZCx6DyUaz6/wMU51TWHopyy17vh6qRm', NULL, '2023-05-26 06:15:49', '2023-05-28 17:35:00', 2),
(14, 'Admin Torrecamps', 'torrecampsm@gmail.com', '2023-05-28 17:34:01', '$2y$10$KYBaUCD61t5zK0C7JQnHoOWtt2bjIo5ubc9/uziy.D4vC4j.vsUOe', NULL, '2023-05-28 17:33:44', '2023-05-28 17:34:01', 1),
(15, 'Ken Carangan', 'ken.angelo.18@gmail.com', '2023-05-28 17:34:01', '$2y$10$y3qZ/Vbj9PNWz8gqoBd0w.uAJ6YKniskZiSBDTN14BxJ4h.LhgGP6', NULL, '2023-06-02 08:09:38', '2023-07-12 08:21:32', 0),
(16, 'Juan Dela Cruz', 'demothis@gmail.com', '2023-05-28 17:34:01', '$2y$10$kew6S1A4wPpXsyNhD7NjoeWAqEEbXdOn.J7c1fT1ZbDjwXRca3Lk6', NULL, '2023-06-15 01:33:36', '2023-07-12 10:48:38', 0),
(17, 'Jan Terence Francisco', 'demothis0121@gmail.com', '2023-06-15 01:52:48', '$2y$10$Jo461QJANRPMFaOUmeWUw.Jr8DBMOTp9TLgvq7GRPIySflMtLCaOy', NULL, '2023-06-15 01:52:35', '2023-06-15 01:53:31', 0),
(18, 'Jan Terence Francisco', 'franciscoterence98@gmail.com', '2023-06-20 22:11:05', '$2y$10$BftSfpv4uRxILCA60UZ4xe8oPWa3ELJiRcfRFKi5CT/RyIITgZfcu', NULL, '2023-06-20 22:10:47', '2023-06-20 22:11:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_details_user_id_unique` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `phone`, `address1`, `address2`, `city`, `province`, `zip_code`, `created_at`, `updated_at`) VALUES
(2, 9, '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque', 'Metro Manila', '1700', '2023-05-25 10:13:56', '2023-05-25 10:13:56'),
(3, 13, '09195346006', 'San Pancrasio St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', '2023-05-26 06:17:28', '2023-05-26 06:17:28'),
(4, 14, '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque', 'Metro Manila', '1700', '2023-05-30 22:30:32', '2023-05-30 22:30:32'),
(5, 17, '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', '2023-06-15 01:53:31', '2023-06-15 01:53:31'),
(6, 18, '09171580121', '5 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', '2023-06-20 22:12:20', '2023-06-20 22:12:20'),
(7, 15, '09365225861', '14 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', '2023-07-12 10:20:38', '2023-07-12 10:20:38'),
(8, 16, '09365225861', '14 San Vicente Ferrer St.', 'SAV-1, Sucat', 'Paranaque City', 'Metro Manila', '1700', '2023-07-12 10:48:38', '2023-07-12 10:48:38');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
