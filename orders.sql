-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 17, 2023 at 09:55 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `price_total` int(11) NOT NULL,
  `payment_status` tinyint(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `address`, `mobile`, `email`, `note`, `price_total`, `payment_status`, `created_at`, `updated_at`) VALUES
(18, 6, 'Hà', '62-Bãi Thụy-Đồng Tháp-Đan Phượng-Hà Nội', 966108364, 'nguyenthuha@gmail.com', '', 48000000, 0, '2023-08-15 06:39:38', '2023-08-17 14:53:56'),
(19, 5, 'Lan', '62-Bãi Thụy-Đồng Tháp-Đan Phượng-Hà Nội', 966108364, 'abc123@gmail.com', '', 48000000, 0, '2023-08-16 06:56:37', '2023-08-17 14:54:26'),
(20, 5, 'Lan', 'Từ Liêm-Hà Nội', 966108364, 'abc123@gmail.com', '', 135000000, 0, '2023-08-16 06:56:37', '2023-08-17 14:54:32'),
(21, 4, 'Hằng', 'Đan Phượng-Hà Nội', 93399663, 'hang@gmail.com', '', 31300000, 0, '2023-08-16 07:54:35', '2023-08-17 14:54:55'),
(22, 5, 'Lan', '62-Bãi Thụy-Đồng Tháp-Đan Phượng-Hà Nội', 966108364, 'abc123@gmail.com', '', 91800000, 0, '2023-08-16 07:21:46', '2023-08-17 14:55:07'),
(23, 6, 'Hà', '62-Bãi Thụy-Đồng Tháp-Đan Phượng-Hà Nội', 966108364, 'nguyenthuha@gmail.com', 'xin cái túi nhé', 88000000, 0, '2023-08-16 07:33:49', '2023-08-17 14:55:15'),
(24, 4, 'Hằng', '62-Bãi Thụy-Đồng Tháp-Đan Phượng-Hà Nội', 966108364, 'hang@gmail.com', 'Xin cái túi nè', 88000000, 0, '2022-06-11 07:36:56', '2023-08-17 13:44:39'),
(25, 6, 'Hà', 'Hà Nội', 966108368, 'nguyenthuha@gmail.com', 'hihi', 16400000, 0, '2023-08-17 07:37:49', '2023-08-17 14:55:22'),
(27, 0, 'Thu Hà', 'AAAA', 999777354, 'emailregistertest97@gmail.com', 'hehe', 2290000, 0, '2023-08-17 06:43:24', '2023-08-17 13:43:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
