-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 06:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `furniturestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `categorySlug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `created_at`, `categorySlug`) VALUES
(1, 'Bàn', 'Các loại bàn nội thất', 'ban.png', '2025-03-30 12:38:40', ''),
(2, 'Ghế', 'Các loại ghế nội thất', 'ghe.png', '2025-03-30 12:38:40', ''),
(3, 'Tủ', 'Các loại tủ nội thất', 'tu.png', '2025-03-30 12:38:40', ''),
(4, 'Sofa', 'Các loại sofa nội thất', 'sofa.png', '2025-03-30 12:38:40', ''),
(5, 'Đèn', 'Các loại đèn nội thất', 'den.png', '2025-03-30 12:38:40', ''),
(6, 'Giường', 'Các loại giường nội thất', 'giuong.png', '2025-03-30 12:38:40', ''),
(7, 'Cây', 'Các loại cây trang trí nội thất', 'cay.png', '2025-03-30 12:38:40', '');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','completed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 380000.00, 'pending', '2025-03-31 00:18:14', '2025-03-31 00:18:14'),
(2, 1, 453515.00, 'pending', '2025-03-31 00:19:50', '2025-03-31 00:19:50'),
(3, 1, 453515.00, 'pending', '2025-03-31 00:22:05', '2025-03-31 00:22:05'),
(4, 1, 453515.00, 'pending', '2025-03-31 00:24:04', '2025-03-31 00:24:04'),
(5, 1, 453515.00, 'cancelled', '2025-03-31 00:27:08', '2025-03-31 00:28:09'),
(6, 1, 453515.00, 'pending', '2025-03-31 00:42:16', '2025-03-31 00:42:16'),
(7, 1, 2353515.00, 'pending', '2025-03-31 04:12:47', '2025-03-31 04:12:47'),
(8, 1, 2353515.00, 'pending', '2025-03-31 04:12:47', '2025-03-31 04:12:47'),
(9, 1, 2353515.00, 'pending', '2025-03-31 04:12:48', '2025-03-31 04:12:48'),
(10, 1, 2353515.00, 'pending', '2025-03-31 04:12:48', '2025-03-31 04:12:48'),
(11, 1, 1140000.00, 'cancelled', '2025-03-31 04:17:16', '2025-03-31 04:17:53'),
(12, 1, 1213515.00, 'cancelled', '2025-03-31 04:19:31', '2025-03-31 04:19:56'),
(13, 1, 73515.00, 'pending', '2025-03-31 04:21:05', '2025-03-31 04:21:05'),
(14, 1, 73515.00, 'cancelled', '2025-03-31 04:21:05', '2025-03-31 04:21:24'),
(15, 1, 453515.00, 'pending', '2025-03-31 04:22:40', '2025-03-31 04:22:40'),
(16, 1, 453515.00, 'cancelled', '2025-03-31 04:22:50', '2025-03-31 04:23:20'),
(17, 1, 73515.00, 'pending', '2025-03-31 04:26:38', '2025-03-31 04:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, NULL, 7, 1, 380000.00, '2025-03-31 00:18:14', '2025-03-31 00:18:14'),
(2, NULL, 7, 1, 380000.00, '2025-03-31 00:19:50', '2025-03-31 00:19:50'),
(3, NULL, 19, 1, 73515.00, '2025-03-31 00:19:50', '2025-03-31 00:19:50'),
(4, NULL, 7, 1, 380000.00, '2025-03-31 00:22:05', '2025-03-31 00:22:05'),
(5, NULL, 19, 1, 73515.00, '2025-03-31 00:22:05', '2025-03-31 00:22:05'),
(6, 4, 7, 1, 380000.00, '2025-03-31 00:24:04', '2025-03-31 00:24:04'),
(7, 4, 19, 1, 73515.00, '2025-03-31 00:24:04', '2025-03-31 00:24:04'),
(8, 5, 7, 1, 380000.00, '2025-03-31 00:27:08', '2025-03-31 00:27:08'),
(9, 5, 19, 1, 73515.00, '2025-03-31 00:27:08', '2025-03-31 00:27:08'),
(10, 6, 7, 1, 380000.00, '2025-03-31 00:42:16', '2025-03-31 00:42:16'),
(11, 6, 19, 1, 73515.00, '2025-03-31 00:42:16', '2025-03-31 00:42:16'),
(12, 7, 7, 6, 380000.00, '2025-03-31 04:12:47', '2025-03-31 04:12:47'),
(13, 7, 19, 1, 73515.00, '2025-03-31 04:12:47', '2025-03-31 04:12:47'),
(14, 8, 7, 6, 380000.00, '2025-03-31 04:12:47', '2025-03-31 04:12:47'),
(15, 8, 19, 1, 73515.00, '2025-03-31 04:12:47', '2025-03-31 04:12:47'),
(16, 9, 7, 6, 380000.00, '2025-03-31 04:12:48', '2025-03-31 04:12:48'),
(17, 9, 19, 1, 73515.00, '2025-03-31 04:12:48', '2025-03-31 04:12:48'),
(18, 10, 7, 6, 380000.00, '2025-03-31 04:12:48', '2025-03-31 04:12:48'),
(19, 10, 19, 1, 73515.00, '2025-03-31 04:12:48', '2025-03-31 04:12:48'),
(20, 11, 7, 3, 380000.00, '2025-03-31 04:17:16', '2025-03-31 04:17:16'),
(21, 12, 7, 3, 380000.00, '2025-03-31 04:19:31', '2025-03-31 04:19:31'),
(22, 12, 19, 1, 73515.00, '2025-03-31 04:19:31', '2025-03-31 04:19:31'),
(23, 13, 19, 1, 73515.00, '2025-03-31 04:21:05', '2025-03-31 04:21:05'),
(24, 14, 19, 1, 73515.00, '2025-03-31 04:21:05', '2025-03-31 04:21:05'),
(25, 15, 19, 1, 73515.00, '2025-03-31 04:22:40', '2025-03-31 04:22:40'),
(26, 15, 7, 1, 380000.00, '2025-03-31 04:22:40', '2025-03-31 04:22:40'),
(27, 16, 19, 1, 73515.00, '2025-03-31 04:22:50', '2025-03-31 04:22:50'),
(28, 16, 7, 1, 380000.00, '2025-03-31 04:22:50', '2025-03-31 04:22:50'),
(29, 17, 19, 1, 73515.00, '2025-03-31 04:26:38', '2025-03-31 04:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `payment_method` enum('COD','Credit Card','Bank Transfer') NOT NULL,
  `status` enum('pending','paid','failed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `views` int(11) DEFAULT 0,
  `sale_price` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `price`, `quantity`, `category_id`, `image`, `created_at`, `views`, `sale_price`) VALUES
(1, 'Sofa đơn hiện đại', 'sofa-don-hien-dai', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 3200000.00, 10, 4, 'sofa-don.webp', '2025-03-30 12:39:05', 30, 3006934.00),
(2, 'Sofa giường đa năng', 'sofa-giuong-da-nang', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 5500000.00, 5, 4, 'sofa-giuong.webp', '2025-03-30 12:39:05', 20, 5385274.00),
(3, 'Sofa da cao cấp', 'sofa-da-cao-cap', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 7800000.00, 7, 4, 'sofa-da.webp', '2025-03-30 12:39:05', 12, 7605865.00),
(4, 'Sofa vải nhung', 'sofa-vai-nhung', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 4600000.00, 12, 4, 'sofa-vai.webp', '2025-03-30 12:39:05', 0, 4473802.00),
(5, 'Sofa 3 chỗ bọc nỉ', 'sofa-3-cho-boc-ni', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 5200000.00, 6, 4, 'sofa-3-cho.webp', '2025-03-30 12:39:05', 63, 5051717.00),
(6, 'Sofa góc chữ U', 'sofa-goc-chu-u', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 8900000.00, 4, 4, 'sofa-goc-u.webp', '2025-03-30 12:39:05', 25, 8737478.00),
(7, 'Đèn bàn LED', 'den-ban-led', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 450000.00, 20, 5, 'den-ban.webp', '2025-03-30 12:39:05', 65, 380000.00),
(8, 'Đèn cây đứng', 'den-cay-dung', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 1200000.00, 15, 5, 'den-cay.webp', '2025-03-30 12:39:05', 23, 1050561.00),
(9, 'Đèn ngủ để bàn', 'den-ngu-de-ban', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 350000.00, 30, 5, 'den-ngu.jpg', '2025-03-30 12:39:05', 45, 205486.00),
(10, 'Đèn treo trần hiện đại', 'den-treo-tran-hien-dai', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 2500000.00, 10, 5, 'den-treo-tran.webp', '2025-03-30 12:39:05', 26, 2326048.00),
(11, 'Đèn led dây trang trí', 'den-led-day-trang-tri', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 200000.00, 50, 5, 'den-led-day.webp', '2025-03-30 12:39:05', 42, 64082.00),
(12, 'Đèn thả trần', 'den-tha-tran', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 1800000.00, 8, 5, 'den-tha.webp', '2025-03-30 12:39:05', 46, 1642564.00),
(13, 'Giường tầng gỗ', 'giuong-tang-go', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 7500000.00, 5, 6, 'giuong-tang.jpg', '2025-03-30 12:39:05', 36, 7320873.00),
(14, 'Giường ngủ đơn', 'giuong-ngu-don', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 3200000.00, 10, 6, 'giuong-don.webp', '2025-03-30 12:39:05', 49, 3076975.00),
(15, 'Giường ngủ đôi', 'giuong-ngu-doi', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 5800000.00, 7, 6, 'giuong-doi.jpg', '2025-03-30 12:39:05', 15, 5622554.00),
(16, 'Giường pallet gỗ', 'giuong-pallet-go', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 4000000.00, 12, 6, 'giuong-pallet.jpg', '2025-03-30 12:39:05', 62, 3882144.00),
(17, 'Giường ngủ bọc nỉ', 'giuong-ngu-boc-ni', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 6200000.00, 6, 6, 'giuong-boc-ni.jpg', '2025-03-30 12:39:05', 42, 6043358.00),
(18, 'Giường ngủ có hộc kéo', 'giuong-ngu-co-hoc-keo', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 6800000.00, 4, 6, 'giuong-hoc-keo.jpg', '2025-03-30 12:39:05', 42, 6670658.00),
(19, 'Cây lưỡi hổ', 'cay-luoi-ho', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 250000.00, 25, 7, 'cay-luoi-ho.webp', '2025-03-30 12:39:05', 65, 73515.00),
(20, 'Cây kim tiền', 'cay-kim-tien', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 380000.00, 20, 7, 'cay-kim-tien.webp', '2025-03-30 12:39:05', 25, 185902.00),
(21, 'Cây sen đá', 'cay-sen-da', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 150000.00, 50, 7, 'cay-sen-da.webp', '2025-03-30 12:39:05', 0, 9265.00),
(22, 'Cây trầu bà leo', 'cay-trau-ba-leo', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 320000.00, 18, 7, 'cay-trau-ba.webp', '2025-03-30 12:39:05', 0, 198916.00),
(23, 'Cây bàng Singapore', 'cay-bang-singapore', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 950000.00, 8, 7, 'cay-bang.webp', '2025-03-30 12:39:05', 0, 767085.00),
(24, 'Cây xương rồng mini', 'cay-xuong-rong-mini', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 100000.00, 40, 7, 'cay-xuong-rong.webp', '2025-03-30 12:39:05', 0, -51025.00),
(25, 'Bàn làm việc gỗ sồi', 'ban-lam-viec-go-soi', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 2500000.00, 10, 1, 'ban-go-soi.webp', '2025-03-30 12:41:58', 0, 2393920.00),
(26, 'Bàn trà hiện đại', 'ban-tra-hien-dai', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 1800000.00, 15, 1, 'ban-tra.webp', '2025-03-30 12:41:58', 0, 1622973.00),
(28, 'Bàn học thông minh', 'ban-hoc-thong-minh', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 2100000.00, 12, 1, 'ban-hoc.jpg', '2025-03-30 12:41:58', 0, 1933406.00),
(29, 'Bàn tròn cafe', 'ban-tron-cafe', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 1600000.00, 20, 1, 'ban-tron.jpg', '2025-03-30 12:41:58', 0, 1498412.00),
(30, 'Bàn xếp gọn', 'ban-xep-gon', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 1900000.00, 10, 1, 'ban-xep.jpg', '2025-03-30 12:41:58', 0, 1792143.00),
(31, 'Ghế xoay văn phòng', 'ghe-xoay-van-phong', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 1400000.00, 15, 2, 'ghe-xoay.jpg', '2025-03-30 12:41:58', 0, 1265775.00),
(32, 'Ghế gỗ tự nhiên', 'ghe-go-tu-nhien', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 1200000.00, 20, 2, 'ghe-go.jpg', '2025-03-30 12:41:58', 0, 1052745.00),
(33, 'Ghế sofa đơn', 'ghe-sofa-don', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 2300000.00, 10, 2, 'ghe-sofa.jpg', '2025-03-30 12:41:58', 0, 2166701.00),
(34, 'Ghế nhựa cao cấp', 'ghe-nhua-cao-cap', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 900000.00, 25, 2, 'ghe-nhua.webp', '2025-03-30 12:41:58', 0, 775567.00),
(35, 'Ghế thư giãn gấp gọn', 'ghe-thu-gian-gap-gon', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 1700000.00, 12, 2, 'ghe-thu-gian.jpg', '2025-03-30 12:41:58', 0, 1578035.00),
(36, 'Ghế ăn sang trọng', 'ghe-an-sang-trong', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 1300000.00, 18, 2, 'ghe-an.jpg', '2025-03-30 12:41:58', 0, 1163773.00),
(37, 'Tủ quần áo 3 cánh', 'tu-quan-ao-3-canh', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 4200000.00, 8, 3, 'tu-quan-ao.jpg', '2025-03-30 12:41:58', 0, 4085057.00),
(38, 'Tủ giày thông minh', 'tu-giay-thong-minh', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 2100000.00, 12, 3, 'tu-giay.jpg', '2025-03-30 12:41:58', 0, 1934269.00),
(39, 'Tủ bếp gỗ tự nhiên', 'tu-bep-go-tu-nhien', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 5800000.00, 5, 3, 'tu-bep.png', '2025-03-30 12:41:58', 0, 5616470.00),
(40, 'Tủ sách nhiều ngăn', 'tu-sach-nhieu-ngan', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 2700000.00, 15, 3, 'tu-sach.jpg', '2025-03-30 12:41:58', 0, 2579845.00),
(41, 'Tủ đựng tài liệu', 'tu-dung-tai-lieu', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 3300000.00, 10, 3, 'tu-ho-so.jpg', '2025-03-30 12:41:58', 0, 3150114.00),
(42, 'Tủ gỗ trang trí', 'tu-go-trang-tri', '7 ngày hoàn trả miễn phí\nBảo hành trong 12 tháng\nMiễn phí vận chuyển', 2900000.00, 12, 3, 'tu-trang-tri.webp', '2025-03-30 12:41:58', 0, 2711336.00);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `product_id`, `color`) VALUES
(49, 1, 'Nâu gỗ'),
(50, 1, 'Trắng'),
(51, 2, 'Đen'),
(52, 2, 'Ghi'),
(53, 3, 'Nâu'),
(54, 3, 'Vàng'),
(55, 4, 'Trắng'),
(56, 4, 'Xám'),
(57, 5, 'Be'),
(58, 5, 'Gỗ tự nhiên'),
(59, 6, 'Nâu'),
(60, 6, 'Xanh dương'),
(61, 7, 'Đen'),
(62, 7, 'Trắng'),
(63, 8, 'Nâu gỗ'),
(64, 8, 'Xám'),
(65, 9, 'Xanh dương'),
(66, 9, 'Vàng'),
(67, 10, 'Đỏ'),
(68, 10, 'Be'),
(69, 11, 'Trắng'),
(70, 11, 'Xanh lá'),
(71, 12, 'Đen'),
(72, 12, 'Kem'),
(73, 13, 'Nâu gỗ'),
(74, 13, 'Trắng'),
(75, 14, 'Be'),
(76, 14, 'Xám'),
(77, 15, 'Nâu'),
(78, 15, 'Đỏ'),
(79, 16, 'Trắng'),
(80, 16, 'Xanh lá'),
(81, 17, 'Đen'),
(82, 17, 'Vàng'),
(83, 18, 'Ghi'),
(84, 18, 'Kem'),
(85, 19, 'Xám'),
(86, 19, 'Xanh dương'),
(87, 20, 'Be'),
(88, 20, 'Đỏ'),
(89, 21, 'Đen'),
(90, 21, 'Nâu'),
(91, 22, 'Hồng'),
(92, 22, 'Xanh lá'),
(93, 23, 'Trắng'),
(94, 23, 'Kem'),
(95, 24, 'Vàng'),
(96, 24, 'Ghi'),
(97, 25, 'Trắng'),
(98, 25, 'Vàng'),
(99, 26, 'Đen'),
(100, 26, 'Nâu gỗ'),
(103, 28, 'Đồng'),
(104, 28, 'Bạc'),
(105, 29, 'Tím'),
(106, 29, 'Xanh dương'),
(107, 30, 'Đỏ'),
(108, 30, 'Hồng'),
(109, 31, 'Nâu gỗ'),
(110, 31, 'Xám'),
(111, 32, 'Trắng'),
(112, 32, 'Be'),
(113, 33, 'Xanh'),
(114, 33, 'Ghi'),
(115, 34, 'Đen'),
(116, 34, 'Vàng'),
(117, 35, 'Kem'),
(118, 35, 'Gỗ tự nhiên'),
(119, 36, 'Đỏ'),
(120, 36, 'Xanh lá');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Lê Phùng Tiến Quân', 'quanlptps39861@gmail.com', '$2y$10$S7JGHwpurKXuHclzVmUa1eacB8ZzYMX3YSur8SqNdXZRZrHJRXNfG', NULL, NULL, 'customer', '2025-03-30 05:58:35', '2025-03-30 05:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

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
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
