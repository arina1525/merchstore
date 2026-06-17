-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2026 at 10:11 AM
-- Server version: 8.4.3
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `merchstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` text,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int DEFAULT '1',
  `customization_json` json DEFAULT NULL,
  `preview_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `base_price` decimal(12,2) NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `preview_image` varchar(255) DEFAULT NULL,
  `design_file` varchar(255) DEFAULT NULL,
  `svg_file` varchar(255) DEFAULT NULL,
  `hole_x` int DEFAULT NULL,
  `hole_y` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `product_id`, `qty`, `base_price`, `total_price`, `preview_image`, `design_file`, `svg_file`, `hole_x`, `hole_y`, `created_at`, `updated_at`) VALUES
(8, 2, 7, 2, 10000.00, 24000.00, '6a31647f2a534.png', '1781621887_7f7e7e904e6619f1ead1.png', '1781621887_02f56696537db7351db8.svg', 250, 80, '2026-06-16 14:58:07', '2026-06-16 14:58:07'),
(9, 2, 9, 4, 3500.00, 34000.00, '6a32291c35248.png', '1781672220_ab2d53d4ecf30d1f1789.png', NULL, 250, 80, '2026-06-17 04:57:00', '2026-06-17 04:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item_variants`
--

CREATE TABLE `cart_item_variants` (
  `id` int NOT NULL,
  `cart_item_id` int NOT NULL,
  `variant_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_item_variants`
--

INSERT INTO `cart_item_variants` (`id`, `cart_item_id`, `variant_id`, `created_at`) VALUES
(14, 8, 32, '2026-06-16 14:58:07'),
(15, 8, 33, '2026-06-16 14:58:07'),
(16, 8, 36, '2026-06-16 14:58:07'),
(17, 9, 50, '2026-06-17 04:57:00'),
(18, 9, 53, '2026-06-17 04:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `preview_type` enum('keychain','phonestrap','standee','sticker','print','pin') NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `preview_type`, `description`, `created_at`) VALUES
(1, 'keychain', 'keychain', NULL, '2026-06-06 06:38:49'),
(2, 'phonestrap', 'phonestrap', NULL, '2026-06-06 06:39:14'),
(3, 'standee', 'standee', NULL, '2026-06-06 06:39:31'),
(4, 'sticker', 'sticker', NULL, '2026-06-06 06:39:44'),
(5, 'print', 'print', NULL, '2026-06-06 06:40:31'),
(6, 'pin', 'pin', NULL, '2026-06-06 06:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `design_uploads`
--

CREATE TABLE `design_uploads` (
  `id` int NOT NULL,
  `order_item_id` int NOT NULL,
  `original_file` varchar(255) NOT NULL,
  `preview_file` varchar(255) DEFAULT NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_code` varchar(50) DEFAULT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `address_id` int DEFAULT NULL,
  `shipping_cost` decimal(12,2) DEFAULT '0.00',
  `total_price` decimal(12,2) NOT NULL,
  `payment_status` enum('pending','paid','expired','refunded') DEFAULT NULL,
  `order_status` enum('pending','processing','shipped','completed','cancelled','refund_requested','refunded') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `xendit_invoice_id` varchar(255) DEFAULT NULL,
  `payment_url` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_code`, `invoice_number`, `address_id`, `shipping_cost`, `total_price`, `payment_status`, `order_status`, `created_at`, `xendit_invoice_id`, `payment_url`) VALUES
(1, 3, 'ORD20260615235948', 'INV20260615235948', 1, 18000.00, 228500.00, 'pending', 'pending', '2026-06-15 23:59:48', NULL, NULL),
(2, 2, 'ORD20260616114807', 'INV20260616114807', 3, 10000.00, 194000.00, 'paid', 'processing', '2026-06-16 11:48:07', '6a3137f391a293a99d8dc95b', 'https://checkout-staging.xendit.co/web/6a3137f391a293a99d8dc95b'),
(3, 2, 'ORD20260616122017', 'INV20260616122017', 3, 10000.00, 52000.00, 'refunded', 'refunded', '2026-06-16 12:20:17', '6a313f7f9cc85f96c7c14c91', 'https://checkout-staging.xendit.co/web/6a313f7f9cc85f96c7c14c91'),
(4, 2, 'ORD20260616122347', 'INV20260616122347', 3, 10000.00, 65000.00, 'pending', 'pending', '2026-06-16 12:23:47', '6a31404f9cc85f96c7c14da3', 'https://checkout-staging.xendit.co/web/6a31404f9cc85f96c7c14da3');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `customization_json` json DEFAULT NULL,
  `preview_file` varchar(255) DEFAULT NULL,
  `design_file` varchar(255) DEFAULT NULL,
  `svg_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`, `customization_json`, `preview_file`, `design_file`, `svg_file`) VALUES
(1, 1, 3, 5, 28000.00, 155000.00, NULL, '6a2e54c04e809.png', '1781421248_7e38318337b39ec65622.png', '1781421248_87e84d0d69885ebe4a54.svg'),
(2, 1, 10, 7, 3500.00, 38500.00, NULL, '6a2e56cdb5886.png', '1781421773_7fb25ed32d7e3cd3b2d7.png', NULL),
(3, 1, 7, 1, 10000.00, 17000.00, NULL, '6a2e6fc117a20.png', '1781428161_9f713996570b4365fd82.png', '1781428161_37c4d0a27a98b7aea15d.svg'),
(4, 2, 2, 5, 10000.00, 100000.00, NULL, '6a313762d8846.png', '1781610338_71fde16c6d0c4da39a87.png', '1781610338_803796e6538c886de282.svg'),
(5, 2, 11, 12, 4500.00, 84000.00, NULL, '6a3137aecaf34.png', '1781610414_c683c9b16b88f330ed13.png', NULL),
(6, 3, 10, 12, 3500.00, 42000.00, NULL, '6a313f7623246.png', '1781612406_22c18eca86d38feb387d.png', NULL),
(7, 4, 10, 10, 3500.00, 55000.00, NULL, '6a31403546da5.png', '1781612597_4796a9668d7699f02c85.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `payment_gateway` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` enum('pending','paid','failed') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_consents`
--

CREATE TABLE `privacy_consents` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `agreed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text,
  `stock` int DEFAULT '0',
  `price` decimal(12,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `stock`, `price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'Acrylic Keychain', '- Material: Acrylic transparan\r\n- Ketebalan: 3 mm\r\n- Cetak: Full color UV print\r\n- Finishing: Potong custom sesuai desain', NULL, 10000.00, NULL, 'active', '2026-06-07 23:42:06', '2026-06-17 07:35:22'),
(3, 1, 'Plushie Keychain', '- Material: Kain yelvo premium\r\n- Isi: Dakron lembut\r\n- Cetak: Full color sublimasi 2 sisi', NULL, 28000.00, NULL, 'active', '2026-06-08 02:34:06', '2026-06-17 07:36:15'),
(4, 2, 'Acrylic Phonestrap', '- Material: Acrylic transparan\r\n- Ketebalan: 3 mm\r\n- Cetak: UV printing full color\r\n- Finishing: Potong custom\r\n- Strap: Phone strap nylon', NULL, 6000.00, NULL, 'active', '2026-06-08 02:54:17', '2026-06-17 07:37:00'),
(6, 3, 'Acrylic Standee', '- Material: Acrylic transparan\r\n- Ketebalan: 3 mm\r\n- Cetak: UV printing full color\r\n- Finishing: Die-cut sesuai desain\r\n- Dilengkapi base/penyangga acrylic', NULL, 20000.00, NULL, 'active', '2026-06-08 03:03:32', '2026-06-17 07:37:33'),
(7, 4, 'Sticker Diecut', '- Material: Vinyl/chromo\r\n- Laminasi: Glossy/matte/glitter/holo\r\n- Cetak: Full color\r\n- Finishing: Die-cut custom\r\n\r\n*harga 1 lembar A4', NULL, 10000.00, NULL, 'active', '2026-06-08 03:24:46', '2026-06-17 07:39:03'),
(8, 5, 'Art Print A6', '- Ukuran: 105 × 148 mm (A6)\r\n- Cetak: Full color\r\n- Finishing: Potong rapi mesin', NULL, 2000.00, NULL, 'active', '2026-06-08 03:33:47', '2026-06-17 07:39:57'),
(9, 5, 'Art Print A5', '- Ukuran: 148 × 210 mm (A5)\r\n- Cetak: Full color\r\n- Finishing: Potong rapi mesin', NULL, 3500.00, NULL, 'active', '2026-06-08 03:41:59', '2026-06-17 07:40:19'),
(10, 6, 'Pin 32mm', '- Diameter: 32 mm\r\n- Material: Metal pin\r\n- Cetak: Full color\r\n- anti karat', NULL, 3500.00, NULL, 'active', '2026-06-08 03:55:56', '2026-06-17 07:41:27'),
(11, 6, 'Pin 44mm', '- Diameter: 44 mm\r\n- Material: Metal pin\r\n- Cetak: Full color\r\n- anti karat', NULL, 4500.00, NULL, 'active', '2026-06-08 13:23:31', '2026-06-17 07:41:38'),
(12, 5, 'Art Print A4', '- Ukuran: 210 × 297 mm (A4)\r\n- Cetak: Full color\r\n- Finishing: Potong rapi mesin', NULL, 5500.00, NULL, 'active', '2026-06-08 13:29:04', '2026-06-17 07:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`) VALUES
(1, 2, '1780924364_fe92c4b27597e2bb8af5.jpeg', '2026-06-08 13:12:44'),
(2, 2, '1780924383_dd2915ad878555f1cfa7.jpeg', '2026-06-08 13:13:03'),
(3, 2, '1780924397_b8a2b567eeb4335baf04.png', '2026-06-08 13:13:17'),
(4, 4, '1780924462_76daa90adf193af81cc3.jpeg', '2026-06-08 13:14:22'),
(5, 4, '1780924471_54447fab433cdb1cfd00.jpeg', '2026-06-08 13:14:31'),
(6, 6, '1780924498_a138c29919f107155a49.jpeg', '2026-06-08 13:14:58'),
(7, 6, '1780924506_f2db8b75b13108f38297.jpeg', '2026-06-08 13:15:06'),
(8, 7, '1780924533_fd0252d75806fe569649.jpeg', '2026-06-08 13:15:33'),
(9, 7, '1780924540_0155b250c1649c50fc2a.png', '2026-06-08 13:15:40'),
(10, 8, '1780924558_6991396e0a1c0f4dac1b.jpeg', '2026-06-08 13:15:58'),
(11, 8, '1780924565_fa1923a0de20776b99dc.png', '2026-06-08 13:16:05'),
(12, 8, '1780924572_99c6c64c3cf721f8d276.png', '2026-06-08 13:16:12'),
(13, 9, '1780924602_996002bebfce344de8aa.jpeg', '2026-06-08 13:16:42'),
(14, 9, '1780924612_1df3f6ac32192400e478.png', '2026-06-08 13:16:52'),
(15, 9, '1780924618_4c67863afc850ea67072.png', '2026-06-08 13:16:58'),
(16, 10, '1780924637_4a42999cb965c04feb0a.jpeg', '2026-06-08 13:17:17'),
(17, 10, '1780924643_08ec57430170874558ba.png', '2026-06-08 13:17:24'),
(18, 11, '1780925249_b9c18cb9a08f422aad52.jpeg', '2026-06-08 13:27:29'),
(19, 11, '1780925262_07c38253760b5e57fa1b.png', '2026-06-08 13:27:42'),
(20, 12, '1780925362_c4bcdd22af8cd07c335a.jpeg', '2026-06-08 13:29:22'),
(21, 12, '1780925370_3689ea415db5eb59c9b8.png', '2026-06-08 13:29:30'),
(22, 12, '1780925391_13f47f6536cee5c6a472.png', '2026-06-08 13:29:51'),
(23, 3, '1780926869_1999b1033a1ee8126173.jpeg', '2026-06-08 13:54:29'),
(24, 3, '1780926874_5ef717ef81c0ee76c1da.jpeg', '2026-06-08 13:54:34'),
(26, 3, '1780927105_d4d2162932650aa431c6.png', '2026-06-08 13:58:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant_options`
--

CREATE TABLE `product_variant_options` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `variant_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund_requests`
--

CREATE TABLE `refund_requests` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `user_id` int NOT NULL,
  `reason` text,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `rating` int DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@mail.com', '$2y$10$F1JkEbzFAjvM/elViw5OsO8NapQUcdP7cmIDbOEJN9wCQz/eOu.Vu', 'admin', '88888888', '2026-06-06 05:18:56', NULL),
(2, 'arin', 'arin@gmail.com', '$2y$10$PkLOHiBd4vOjvl2xhiZZVedaxnvXq4.gVMoqzepHx8xswN8mYBsoC', 'customer', '082122631172', '2026-06-07 04:10:49', '2026-06-16 15:38:02'),
(3, 'arum', 'arum@gmail.com', '$2y$10$OjVCjJFk3zIp4Wgke4BVJ.zOxpf3bge4Zm2jRnd6S1QXpQpmhQEj2', 'customer', NULL, '2026-06-07 05:01:18', NULL),
(4, 'user', 'arinalhaq@student.uns.ac.id', '$2y$10$im.j2TMva3t8o6ldbqICkOJWETtCGy0tbh3WP8z2TAZh5OcHxsLsS', 'customer', NULL, '2026-06-17 05:22:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `receiver_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `address` text,
  `is_default` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `receiver_name`, `phone`, `province`, `city`, `postal_code`, `address`, `is_default`) VALUES
(1, 3, 'rum', '88888888', 'Jawa Tengah', 'to bumen', '00000', 'di kossssssssssss bobok zzzzzzzzz', 1),
(2, 3, 'arum', '08xxxxxxx', 'Jawa Timur', 'hihiy', '8787', 'di kossssssss kerjain tugaaas bwanyaaaak pooool capekkk', 0),
(3, 2, 'arin', '082122631172', 'DKI Jakarta', 'jakarta', '15221', 'bobok di rumaaahhhh zzzzzzzzzzzzzzzzz', 1);

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` int NOT NULL,
  `group_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `additional_price` decimal(12,2) DEFAULT '0.00',
  `stock` int DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `group_id`, `name`, `additional_price`, `stock`, `updated_at`) VALUES
(1, 1, '5cm', 0.00, 110, '2026-06-08 02:57:42'),
(2, 1, '6cm', 5000.00, 80, NULL),
(3, 1, '7cm', 8000.00, 90, NULL),
(4, 2, 'bleed', 0.00, 100000, NULL),
(5, 2, 'No Bleed', 0.00, 100000, NULL),
(6, 3, 'Ring Clasp', 0.00, 100, NULL),
(7, 3, 'U Clasp', 3000.00, 85, NULL),
(8, 3, 'Star Clasp', 5000.00, 80, NULL),
(9, 4, '5cm', 0.00, 100, '2026-06-08 02:58:15'),
(10, 4, '6cm', 4000.00, 90, NULL),
(11, 4, '7cm', 6500.00, 65, '2026-06-08 02:41:32'),
(12, 5, 'Bleed', 0.00, 10000, NULL),
(13, 5, 'No Bleed', 0.00, 10000, NULL),
(14, 6, 'Ring Clasp', 0.00, 100, NULL),
(15, 6, 'U Clasp', 3000.00, 85, NULL),
(16, 6, 'Star Clasp', 5000.00, 90, NULL),
(17, 7, '3cm', 0.00, 100, NULL),
(18, 7, '4cm', 2000.00, 100, NULL),
(19, 8, 'Bleed', 0.00, 10000, NULL),
(20, 8, 'No Bleed', 0.00, 10000, NULL),
(25, 11, '8cm', 0.00, 107, NULL),
(26, 11, '10cm', 5000.00, 83, NULL),
(27, 11, '15cm', 13000.00, 98, NULL),
(28, 12, 'Bleed', 0.00, 10000, NULL),
(29, 12, 'No Bleed', 0.00, 10000, NULL),
(30, 13, 'Sticker Chromo ', 0.00, 127, NULL),
(31, 13, 'Sticker Vinyl Matte', 3000.00, 102, NULL),
(32, 13, 'Sticker Vinyl Glossy', 2000.00, 78, NULL),
(33, 14, 'Bleed', 0.00, 10000, NULL),
(34, 14, 'No Bleed', 0.00, 10000, NULL),
(35, 15, 'Glossy', 0.00, 1000, NULL),
(36, 15, 'Matte', 0.00, 1000, NULL),
(37, 15, 'Glitter', 4000.00, 105, NULL),
(38, 15, 'Hologram', 4000.00, 89, NULL),
(39, 16, 'Art Paper 210gsm', 0.00, 124, NULL),
(40, 16, 'Art Carton 310gsm', 3000.00, 112, NULL),
(41, 16, 'Jasmine Paper', 2000.00, 97, NULL),
(42, 16, 'Linen Paper', 2500.00, 76, NULL),
(44, 17, 'glossy', 1500.00, 113, NULL),
(45, 17, 'Matte', 1400.00, 116, NULL),
(46, 17, 'Glitter', 2540.00, 134, NULL),
(47, 17, 'Hologram', 2630.00, 132, NULL),
(48, 18, 'Art Paper 210gsm', 0.00, 114, NULL),
(49, 18, 'Art Carton 310gsm', 4100.00, 108, NULL),
(50, 18, 'Jasmine Paper', 3150.00, 109, NULL),
(51, 18, 'Linen Paper', 3750.00, 112, NULL),
(52, 19, 'Glossy', 2000.00, 108, NULL),
(53, 19, 'Matte', 1850.00, 109, NULL),
(54, 19, 'Glitter', 3780.00, 104, NULL),
(55, 19, 'Hologram', 4172.00, 102, NULL),
(58, 21, 'Glossy', 0.00, 35, '2026-06-08 13:22:08'),
(59, 21, 'Matte', 0.00, 47, '2026-06-08 13:22:16'),
(60, 21, 'Glitter', 2000.00, 56, '2026-06-08 13:22:24'),
(61, 21, 'Hologram', 2100.00, 48, '2026-06-08 13:22:35'),
(62, 22, 'Glossy', 0.00, 43, NULL),
(63, 22, 'Matte', 0.00, 39, NULL),
(64, 22, 'Glitter', 2500.00, 52, NULL),
(65, 22, 'Hologram', 2850.00, 39, NULL),
(66, 23, 'Art Paper 210gsm', 0.00, 75, NULL),
(67, 23, 'Art Carton 310gsm', 5275.00, 67, NULL),
(68, 23, 'Jasmine Paper', 3870.00, 49, NULL),
(69, 23, 'Linen Paper', 4793.00, 87, NULL),
(70, 24, 'Glossy', 2500.00, 58, NULL),
(71, 24, 'Matte', 2375.00, 63, NULL),
(72, 24, 'Glitter', 5328.00, 73, NULL),
(73, 24, 'Hologram', 6317.00, 29, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variant_groups`
--

CREATE TABLE `variant_groups` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `variant_groups`
--

INSERT INTO `variant_groups` (`id`, `product_id`, `name`, `updated_at`) VALUES
(1, 2, 'Size', '2026-06-08 00:38:17'),
(2, 2, 'Bleed', NULL),
(3, 2, 'Clasp', NULL),
(4, 3, 'Size', NULL),
(5, 3, 'Bleed', NULL),
(6, 3, 'Clasp', NULL),
(7, 4, 'Size', NULL),
(8, 4, 'Bleed', NULL),
(11, 6, 'Size', NULL),
(12, 6, 'Bleed', NULL),
(13, 7, 'Sticker Type', NULL),
(14, 7, 'Bleed', NULL),
(15, 7, 'Lamination', NULL),
(16, 8, 'Paper', NULL),
(17, 8, 'Lamination', NULL),
(18, 9, 'Paper', NULL),
(19, 9, 'Lamination', NULL),
(21, 10, 'Lamination', NULL),
(22, 11, 'Lamination', NULL),
(23, 12, 'Paper Type', NULL),
(24, 12, 'Lamination', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_items_user` (`user_id`),
  ADD KEY `fk_cart_items_product` (`product_id`);

--
-- Indexes for table `cart_item_variants`
--
ALTER TABLE `cart_item_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_item_variants_cart` (`cart_item_id`),
  ADD KEY `fk_cart_item_variants_variant` (`variant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `design_uploads`
--
ALTER TABLE `design_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_item_id` (`order_item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_code` (`order_code`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `privacy_consents`
--
ALTER TABLE `privacy_consents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_variant_options`
--
ALTER TABLE `product_variant_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `refund_requests`
--
ALTER TABLE `refund_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `variant_groups`
--
ALTER TABLE `variant_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_variant_groups_product` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart_item_variants`
--
ALTER TABLE `cart_item_variants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `design_uploads`
--
ALTER TABLE `design_uploads`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privacy_consents`
--
ALTER TABLE `privacy_consents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product_variant_options`
--
ALTER TABLE `product_variant_options`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refund_requests`
--
ALTER TABLE `refund_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `variant_groups`
--
ALTER TABLE `variant_groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk_cart_items_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_items_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_item_variants`
--
ALTER TABLE `cart_item_variants`
  ADD CONSTRAINT `fk_cart_item_variants_cart` FOREIGN KEY (`cart_item_id`) REFERENCES `cart_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_item_variants_variant` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `design_uploads`
--
ALTER TABLE `design_uploads`
  ADD CONSTRAINT `design_uploads_ibfk_1` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `user_addresses` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `privacy_consents`
--
ALTER TABLE `privacy_consents`
  ADD CONSTRAINT `privacy_consents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variant_options`
--
ALTER TABLE `product_variant_options`
  ADD CONSTRAINT `product_variant_options_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_options_ibfk_2` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `refund_requests`
--
ALTER TABLE `refund_requests`
  ADD CONSTRAINT `refund_requests_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `refund_requests_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variants`
--
ALTER TABLE `variants`
  ADD CONSTRAINT `variants_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `variant_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variant_groups`
--
ALTER TABLE `variant_groups`
  ADD CONSTRAINT `fk_variant_groups_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
