-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2016 at 04:54 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dealpadang-main`
--

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

CREATE TABLE `merchant` (
  `merchant_id` int(11) NOT NULL,
  `merchant_name` varchar(150) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`merchant_id`, `merchant_name`, `phone_number`, `city`, `address`) VALUES
(1, 'asdasd', '0123', 'medan', 'ghahaha');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `voucher_detail_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `voucher_id`, `voucher_detail_id`, `quantity`, `price`) VALUES
(1, 7, 13, 1, 3, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `order_header`
--

CREATE TABLE `order_header` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_ref_num` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_header`
--

INSERT INTO `order_header` (`order_id`, `user_id`, `invoice_ref_num`, `status`, `total_price`, `create_time`, `update_time`) VALUES
(7, 23, 'INV/2016/02/17/7', 10, 30000, '2016-02-18 16:08:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `bank_account` varchar(100) NOT NULL,
  `sender_account_name` varchar(100) NOT NULL,
  `nominal_transfer` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `order_id`, `user_id`, `status`, `payment_date`, `bank_account`, `sender_account_name`, `nominal_transfer`, `create_time`, `update_time`) VALUES
(1, 7, 23, 0, '2016-02-11', 'asdasdasd', 'zzzz', 123123, '2016-02-21 07:10:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `full_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `gender` varchar(20) CHARACTER SET latin1 NOT NULL,
  `status` smallint(6) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL,
  `profile_picture` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `activation_code` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `role_id`, `email`, `full_name`, `phone_number`, `gender`, `status`, `create_time`, `update_time`, `profile_picture`, `password`, `activation_code`) VALUES
(23, 1, 'stephanus.tedy@gmail.com', 'Stephanus Tedy', '012120', 'male', 0, '2016-02-08 16:01:49', NULL, 'b314d7ddae87155245f086c7e3b5e1e6.jpg', '101a6ec9f938885df0a44f20458d2eb4', NULL),
(24, 1, 'asd@asd.com', 'asd', '021453', 'male', 0, '2016-02-12 14:25:11', NULL, NULL, '7815696ecbf1c96e6894b779456d330e', 'fbe33f22aeae04bc5761810fac8e0c5f4d5093db'),
(25, 1, 'stephanus.tedy@tokopedia.com', 'asdasd', '01230123', '', 0, '2016-02-14 16:28:33', NULL, NULL, 'a8f5f167f44f4964e6c998dee827110c', '2d60153a04f712554c0b2cba27b118fb8d96b399'),
(26, 1, 'asdasdasdas@asdasd.com', 'asdasd', '021652', '', 0, '2016-02-15 16:01:26', NULL, NULL, 'a8f5f167f44f4964e6c998dee827110c', '63316214d404b247bbe136df52a71c71acabf881');

-- --------------------------------------------------------

--
-- Table structure for table `user_api_connector`
--

CREATE TABLE `user_api_connector` (
  `api_id` bigint(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `api_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_api_connector`
--

INSERT INTO `user_api_connector` (`api_id`, `user_id`, `api_type`) VALUES
(10205614918396753, 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `voucher_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `description` text NOT NULL,
  `info` text NOT NULL,
  `highlight` text NOT NULL,
  `voucher_condition` text NOT NULL,
  `expired_date` date NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_id`, `title`, `status`, `description`, `info`, `highlight`, `voucher_condition`, `expired_date`, `start_date`, `end_date`, `update_time`, `create_time`) VALUES
(13, 'hahaha', 0, 'jual apa aja', 'size a b c d', 'murah loh', 'gak boleh balikin', '0000-00-00', '2016-02-01 00:00:00', '2016-02-04 00:00:00', '2016-02-15 16:43:28', '2016-02-15 16:43:28');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_code`
--

CREATE TABLE `voucher_code` (
  `voucher_code_id` int(11) NOT NULL,
  `voucher_detail_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `voucher_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_detail`
--

CREATE TABLE `voucher_detail` (
  `voucher_detail_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `normal_price` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `voucher_detail`
--

INSERT INTO `voucher_detail` (`voucher_detail_id`, `voucher_id`, `merchant_id`, `status`, `type`, `price`, `normal_price`, `stock`) VALUES
(1, 13, 1, 1, 'dinner', 10000, 25000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `voucher_image`
--

CREATE TABLE `voucher_image` (
  `voucher_image_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image_url` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `voucher_image`
--

INSERT INTO `voucher_image` (`voucher_image_id`, `voucher_id`, `status`, `image_url`) VALUES
(1, 13, 1, '6b4fc954275fb5fef00a6062e73bfa09.jpg'),
(2, 13, 1, '13b32655fcb3eff21aa1f897025859da.jpg'),
(3, 13, 1, 'ff2e41580f292e22dfadc6f5adc9325f.jpg'),
(4, 13, 1, '93fc25f628308d6ae86b3c18e19982c2.jpg'),
(5, 7, 1, '54886d1072f582d725b59ee78bf31358.jpg'),
(6, 8, 1, '7efc5776f698efc6fdccc5f2cbb829cb.jpg'),
(7, 9, 1, 'e867098407e54208f46ac782d1bbd135.jpg'),
(8, 10, 1, 'f77acaa6743b5b5e3ce4db1960ac5b42.jpg'),
(9, 11, 1, 'a57d50a8270591b5d14c28a2bcb9be58.jpg'),
(10, 12, 1, 'eccf7dff8710bdf79e92ee9c36dc131e.jpg'),
(11, 12, 1, '404e7f6874da0f78d49b77c3398d52e9.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `merchant`
--
ALTER TABLE `merchant`
  ADD PRIMARY KEY (`merchant_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `order_header`
--
ALTER TABLE `order_header`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- Indexes for table `user_api_connector`
--
ALTER TABLE `user_api_connector`
  ADD PRIMARY KEY (`api_id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`voucher_id`);

--
-- Indexes for table `voucher_code`
--
ALTER TABLE `voucher_code`
  ADD PRIMARY KEY (`voucher_code_id`);

--
-- Indexes for table `voucher_detail`
--
ALTER TABLE `voucher_detail`
  ADD PRIMARY KEY (`voucher_detail_id`);

--
-- Indexes for table `voucher_image`
--
ALTER TABLE `voucher_image`
  ADD PRIMARY KEY (`voucher_image_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `merchant`
--
ALTER TABLE `merchant`
  MODIFY `merchant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `order_header`
--
ALTER TABLE `order_header`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `voucher_code`
--
ALTER TABLE `voucher_code`
  MODIFY `voucher_code_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `voucher_detail`
--
ALTER TABLE `voucher_detail`
  MODIFY `voucher_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `voucher_image`
--
ALTER TABLE `voucher_image`
  MODIFY `voucher_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
