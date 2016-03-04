-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 05, 2016 at 12:11 AM
-- Server version: 5.5.48-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `padj6178_padangdeal-main`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(100) NOT NULL,
  `category_name` varchar(150) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `identifier`, `category_name`) VALUES
(1, 'restaurant', 'Restaurant'),
(2, 'product', 'product');

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

CREATE TABLE IF NOT EXISTS `merchant` (
  `merchant_id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_name` varchar(150) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  PRIMARY KEY (`merchant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`merchant_id`, `merchant_name`, `phone_number`, `city`, `address`) VALUES
(1, 'asdasd', '0123', 'medan', 'ghahaha');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `order_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `voucher_detail_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`order_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `voucher_id`, `voucher_detail_id`, `quantity`, `price`) VALUES
(1, 7, 13, 1, 3, 10000),
(2, 8, 13, 1, 1, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `order_header`
--

CREATE TABLE IF NOT EXISTS `order_header` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `invoice_ref_num` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `order_header`
--

INSERT INTO `order_header` (`order_id`, `user_id`, `invoice_ref_num`, `status`, `total_price`, `create_time`, `update_time`) VALUES
(7, 23, 'INV/2016/02/17/7', 10, 30000, '2016-02-18 16:08:40', NULL),
(8, 23, 'INV/2016/03/03/8', 10, 10000, '2016-03-03 14:45:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `bank_account` varchar(100) NOT NULL,
  `sender_account_name` varchar(100) NOT NULL,
  `nominal_transfer` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `order_id`, `user_id`, `status`, `payment_date`, `bank_account`, `sender_account_name`, `nominal_transfer`, `create_time`, `update_time`) VALUES
(1, 7, 23, 0, '2016-02-11', 'asdasdasd', 'zzzz', 123123, '2016-02-21 07:10:41', '0000-00-00 00:00:00'),
(2, 8, 23, 0, '2016-03-04', 'BCA', 'hahaaha', 12312, '2016-03-03 14:46:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `activation_code` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `role_id`, `email`, `full_name`, `phone_number`, `gender`, `status`, `create_time`, `update_time`, `profile_picture`, `password`, `activation_code`) VALUES
(23, 1, 'stephanus.tedy@gmail.com', 'Stephanus Tedy', '012120', 'male', 0, '2016-02-08 16:01:49', NULL, 'b314d7ddae87155245f086c7e3b5e1e6.jpg', '101a6ec9f938885df0a44f20458d2eb4', NULL),
(29, 1, 'tolepy.shop@gmail.com', 'asdasd', '01230123', '', 0, '2016-02-28 15:39:36', NULL, NULL, 'a8f5f167f44f4964e6c998dee827110c', 'aaff5efa29f7cf7afcec831fd16809be29990f1f'),
(30, 1, 'a@gmail.co.id', 'asdasd', '123456789', '', 0, '2016-02-29 03:29:57', NULL, NULL, 'a8f5f167f44f4964e6c998dee827110c', '85d33dfede8773a3d54aa7ea75dfa773405a57eb'),
(31, 1, 'b@gmail.co.id', 'asdasd', '12345456', '', 0, '2016-02-29 03:45:39', NULL, NULL, '7815696ecbf1c96e6894b779456d330e', 'b68468ee205fdd7f4888a4b6868a0b4a2aec7498'),
(32, 1, 'rsetyapratama@gmail.com', 'rendy', '454545', '', 0, '2016-03-03 17:51:33', NULL, NULL, '4af444de0b2474684a01634e00c6fb5c', 'f9746e00b097c1d28d410d793c80693957e84c3b');

-- --------------------------------------------------------

--
-- Table structure for table `user_api_connector`
--

CREATE TABLE IF NOT EXISTS `user_api_connector` (
  `api_id` bigint(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `api_type` int(11) NOT NULL,
  PRIMARY KEY (`api_id`)
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

CREATE TABLE IF NOT EXISTS `voucher` (
  `voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `display_price` int(11) NOT NULL,
  `display_normal_price` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `info` text NOT NULL,
  `highlight` text NOT NULL,
  `voucher_condition` text NOT NULL,
  `expired_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`voucher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_id`, `title`, `status`, `display_price`, `display_normal_price`, `category_id`, `description`, `info`, `highlight`, `voucher_condition`, `expired_date`, `start_date`, `end_date`, `update_time`, `create_time`) VALUES
(13, 'sapi lada hitam', 1, 10000, 20000, 1, 'jual apa aja', 'size a b c d', 'murah loh', 'gak boleh balikin', '0000-00-00', '2016-01-01', '2016-03-29', '2016-02-25 15:48:43', '2016-02-15 16:43:28');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_code`
--

CREATE TABLE IF NOT EXISTS `voucher_code` (
  `voucher_code_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_detail_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `voucher_code` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`voucher_code_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `voucher_code`
--

INSERT INTO `voucher_code` (`voucher_code_id`, `voucher_detail_id`, `user_id`, `order_id`, `voucher_code`, `status`) VALUES
(1, 1, 23, 7, 'asdf1234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `voucher_detail`
--

CREATE TABLE IF NOT EXISTS `voucher_detail` (
  `voucher_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `normal_price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`voucher_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `voucher_detail`
--

INSERT INTO `voucher_detail` (`voucher_detail_id`, `voucher_id`, `merchant_id`, `status`, `type`, `price`, `normal_price`, `stock`) VALUES
(1, 13, 1, 1, 'dinner', 10000, 25000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `voucher_image`
--

CREATE TABLE IF NOT EXISTS `voucher_image` (
  `voucher_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image_url` varchar(150) NOT NULL,
  PRIMARY KEY (`voucher_image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `voucher_image`
--

INSERT INTO `voucher_image` (`voucher_image_id`, `voucher_id`, `status`, `image_url`) VALUES
(1, 13, 2, '6b4fc954275fb5fef00a6062e73bfa09.jpg'),
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
