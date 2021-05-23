-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2021 at 08:11 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_login_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `aid` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `verify_key` varchar(100) NOT NULL,
  `last_login_time` timestamp NULL DEFAULT NULL,
  `last_logout_time` timestamp NULL DEFAULT NULL,
  `last_ip_address` varchar(100) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`aid`, `name`, `email`, `pwd`, `salt`, `verify_key`, `last_login_time`, `last_logout_time`, `last_ip_address`, `created_date`, `modified_date`) VALUES
(1, 'Hanoak', 'user@gmail.com', '$2y$10$6pzN7cnQYseSohtSJD1RLu.CcdHL0.V5VVCJOOEkDsU8MXoztKo.a', '&XaHSj$wYVljnp6J!mve', 'RY@s##%a&zkAM7Pw@', '2021-10-20 14:38:38', '2021-10-20 14:38:41', '::1', '2021-04-19 06:48:56', '2021-10-20 18:08:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `aid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
