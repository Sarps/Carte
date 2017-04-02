-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2017 at 06:43 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'food', 'all sort of comestible item'),
(2, 'ninja tools', 'any sort of tool according to konoha classifications');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'PENDING',
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `payment_token` varchar(45) NOT NULL,
  `order_id` varchar(45) NOT NULL,
  `transaction_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `productId`, `order_status`, `date_created`, `date_modified`, `payment_token`, `order_id`, `transaction_id`) VALUES
(7, 0, 'success', '2017-02-24 21:22:41', '2017-02-24 21:26:58', '97024354-8557-4a43-b00d-9b272bca5e4a', '4A6C6483-59C0-4FF4-BFCB-30042C5F96D0', '3493-455454-EEEE'),
(8, 0, 'success', '2017-02-24 22:55:56', '2017-02-24 23:04:46', '4dc1beeb-1734-40a4-b1f2-8f82550c0080', 'B5EC63EC-BFE3-4C44-A8B9-38FFCE3A0519', '3493-455454-EEEE'),
(9, 0, 'success', '2017-03-31 00:35:38', '2017-03-31 00:37:40', 'e1b0ae17-5df3-4571-bb61-072611153069', 'FE21AF9C-E29E-4EEA-85A0-7F49448F8A59', '3493-455454-EEEE'),
(10, 0, 'success', '2017-03-31 15:43:55', '2017-03-31 15:44:57', '74f6c49a-9c35-43f1-80d6-eebc337c1b62', 'A169812F-B0B7-444C-AF27-D15FC69701CF', '3493-455454-EEEE'),
(11, 0, 'PENDING', '2017-04-01 11:03:13', '0000-00-00 00:00:00', '7c1810b5-1fd6-4662-ae15-7278a862e929', '10CD4D6E-CD92-4071-9B7C-28569C9F30FD', ''),
(12, 0, 'success', '2017-04-01 11:04:25', '2017-04-01 11:07:15', '170c24dd-f92d-4809-a2ae-cd597fc28bb3', '912D9B83-6998-45FB-8ED4-5D1866CEB338', '3493-455454-EEEE'),
(13, 0, 'success', '2017-04-01 12:12:24', '2017-04-01 12:22:53', '9dd32a7e-3609-4291-90a8-a5e9be3c1a90', '3AEE3787-B738-453E-A2D7-271267F7C193', '3493-455454-EEEE'),
(14, 0, 'success', '2017-04-01 14:43:25', '2017-04-01 14:44:38', 'daad4871-ffd0-407b-b29a-2cc857ce8129', 'DCD850E7-7639-4F57-BBEB-85335D6D6008', '3493-455454-EEEE'),
(15, 0, 'PENDING', '2017-04-01 17:28:06', '0000-00-00 00:00:00', '3e6bbf4b-3242-446d-b162-eda6b2daf8d7', 'D41119D2-C115-4842-B7DC-38BF57652F22', ''),
(16, 0, 'PENDING', '2017-04-02 09:47:14', '0000-00-00 00:00:00', '36f00443-f6c7-475c-95b1-9fe7c33ca647', 'B3781ABC-CE5C-43A9-9468-424AFC96062D', ''),
(17, 0, 'PENDING', '2017-04-02 10:04:02', '0000-00-00 00:00:00', 'f34d438d-b8b0-4bc7-a803-01034df1c07f', 'E4087684-05B3-4F98-A05E-8DCBED941B62', ''),
(18, 0, 'PENDING', '2017-04-02 10:04:17', '0000-00-00 00:00:00', '3547f039-d05b-4970-92b5-4707416613a7', '4A760B7C-A65C-4092-9339-CF86247A616C', ''),
(19, 0, 'success', '2017-04-02 11:00:55', '2017-04-02 11:02:17', '45e9d4f1-ed9e-4ba4-8ca9-1445f57c41df', '7BD9275B-3A6D-41F1-92A1-5ABBCD9BF9B0', '3493-455454-EEEE'),
(20, 0, 'success', '2017-04-02 12:16:02', '2017-04-02 12:17:08', 'a022f517-935f-4435-aa85-5d74f2bd3c6a', 'F543546D-93BD-4E8D-9163-CCBBBE4B45EB', '3493-455454-EEEE'),
(21, 0, 'PENDING', '2017-04-02 12:18:39', '0000-00-00 00:00:00', '70cdad0c-64fd-42a3-9c2b-bccbed8436e5', 'A00CB440-5785-4AED-BE34-8F1081BA6096', ''),
(22, 0, 'success', '2017-04-02 12:26:03', '2017-04-02 12:26:45', '39385616-219b-4744-9be8-ec9df2abbfd8', '8C09812F-0759-4944-B639-A5FFE0DC2674', '3493-455454-EEEE'),
(23, 0, 'success', '2017-04-02 12:28:32', '2017-04-02 12:30:15', 'dd2ee589-78ff-47f6-ba5a-b21b23dda184', '494C64F6-EF88-4D60-9F08-838BE089A1BF', '3493-455454-EEEE'),
(24, 0, 'success', '2017-04-02 12:32:54', '2017-04-02 12:35:50', 'c4ba4509-1f8a-48a6-a7ea-dd86a8827fb3', '2314B3AA-8E33-4736-B415-1DC0E9934885', '3493-455454-EEEE');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `in_stock` tinyint(1) NOT NULL,
  `product_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `price`, `description`, `category_id`, `name`, `in_stock`, `product_id`) VALUES
(1, 30, '0', 1, 'ramen', 20, 'ra_0001'),
(2, 120, '0', 2, 'shuriken', 100, 'we_0001'),
(3, 62, '0', 2, 'kunai', 95, 'we_0002');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
