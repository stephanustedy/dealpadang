-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2016 at 03:02 PM
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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `full_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `birthdate` date NOT NULL,
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

INSERT INTO `user` (`user_id`, `role_id`, `email`, `full_name`, `birthdate`, `gender`, `status`, `create_time`, `update_time`, `profile_picture`, `password`, `activation_code`) VALUES
(23, 1, 'stephanus.tedy@gmail.com', 'Stephanus Tedy', '0000-00-00', 'male', 0, '2016-02-08 16:01:49', NULL, 'b33a69195e5e9836c54171b5fd2ed2e6.jpg', '101a6ec9f938885df0a44f20458d2eb4', NULL);

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

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
