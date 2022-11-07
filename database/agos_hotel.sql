-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2022 at 10:45 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agos_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE IF NOT EXISTS `admin_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `role_type` varchar(50) NOT NULL DEFAULT 'Admin',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= not active, 1=active',
  `verified` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not verified, 1= verified',
  `is_online` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=offline, 1=online',
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`id`, `username`, `email`, `password`, `fullname`, `role_type`, `status`, `verified`, `is_online`, `created_at`) VALUES
(1, 'Osotech', 'admin@agos.com', '$2y$10$yJXS7SIQ2mGTj6Y9d4ebvO0oeeKwkWGWEsNDsDwjyheaTL9nrsfwy', 'Osotech Samson', 'Admin', 1, 1, 1, '2022-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `booking_history`
--

CREATE TABLE IF NOT EXISTS `booking_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `ref_code` varchar(100) DEFAULT NULL,
  `total_bill` float NOT NULL DEFAULT 0,
  `checkIn` date DEFAULT NULL,
  `checkOut` date DEFAULT NULL,
  `total_night` int(5) DEFAULT 1,
  `people` int(3) DEFAULT NULL,
  `paid` decimal(7,2) NOT NULL DEFAULT 0.00,
  `due` decimal(7,2) NOT NULL DEFAULT 0.00,
  `check_out_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_checked_out` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not checked out, 1= checked out',
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `booking_tbl`
--

CREATE TABLE IF NOT EXISTS `booking_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) NOT NULL,
  `room_id` int(11) NOT NULL,
  `no_of_guest` int(5) DEFAULT NULL,
  `no_of_children` int(5) DEFAULT NULL,
  `checkIn` date DEFAULT NULL,
  `checkOut` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=pending,2 checked In,3 checked Out,4=extend staying',
  `ref_code` varchar(100) NOT NULL,
  `total_night` int(5) NOT NULL,
  `total_bill` float NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `booking_time` time DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= pending,1= approved,2=rejected',
  `bookedBy` int(11) DEFAULT NULL,
  `checkIn_time` datetime DEFAULT NULL COMMENT 'customer checkin datetime',
  `checkOut_time` datetime DEFAULT NULL COMMENT 'customer checkout datetime',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not verified, 1=verified',
  `is_online` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=offline, 1=online',
  `address` text DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `state_of_origin` varchar(100) DEFAULT NULL,
  `confirmation_code` varchar(100) DEFAULT NULL COMMENT 'confirmation code sent via email',
  `tokenExp` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` date DEFAULT NULL,
  `reset_token` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fullname` (`fullname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logging_history`
--

CREATE TABLE IF NOT EXISTS `logging_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) NOT NULL COMMENT 'tracking the user ip address',
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `recharge_history`
--

CREATE TABLE IF NOT EXISTS `recharge_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) DEFAULT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `recharge_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rejected_booking_tbl`
--

CREATE TABLE IF NOT EXISTS `rejected_booking_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) NOT NULL,
  `room_id` int(11) NOT NULL,
  `no_of_guest` int(5) DEFAULT NULL,
  `no_of_children` int(5) DEFAULT NULL,
  `checkIn` date DEFAULT NULL,
  `checkOut` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=pending,2 checked In,3 checked Out,4=extend staying',
  `ref_code` varchar(100) NOT NULL,
  `total_night` int(5) NOT NULL,
  `total_bill` float NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `booking_time` time DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `is_approved` int(1) NOT NULL DEFAULT 1,
  `bookedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rooms_tbl`
--

CREATE TABLE IF NOT EXISTS `rooms_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `price` decimal(7,2) NOT NULL COMMENT 'price of the room per night',
  `room_desc` mediumtext NOT NULL,
  `facilities` text NOT NULL,
  `firstImage` varchar(255) NOT NULL,
  `acType` varchar(100) DEFAULT NULL,
  `thirdImage` varchar(255) NOT NULL,
  `is_booked` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not booked, 1= booked',
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `room_name` (`room_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff_tbl`
--

CREATE TABLE IF NOT EXISTS `staff_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `role_type` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= not active, 1=active',
  `verified` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= not verified, 1=verified',
  `is_online` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= offline, 1=online',
  `address` text DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `state_of_origin` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `last_login_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `account_token` varchar(225) DEFAULT NULL,
  `image` varchar(225) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `state_tbl`
--

CREATE TABLE IF NOT EXISTS `state_tbl` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `state_tbl`
--

INSERT INTO `state_tbl` (`state_id`, `name`) VALUES
(1, 'Abia State'),
(2, 'Adamawa State'),
(3, 'Akwa Ibom State'),
(4, 'Anambra State'),
(5, 'Bauchi State'),
(6, 'Bayelsa State'),
(7, 'Benue State'),
(8, 'Borno State'),
(9, 'Cross River State'),
(10, 'Delta State'),
(11, 'Ebonyi State'),
(12, 'Edo State'),
(13, 'Ekiti State'),
(14, 'Enugu State'),
(15, 'FCT'),
(16, 'Gombe State'),
(17, 'Imo State'),
(18, 'Jigawa State'),
(19, 'Kaduna State'),
(20, 'Kano State'),
(21, 'Katsina State'),
(22, 'Kebbi State'),
(23, 'Kogi State'),
(24, 'Kwara State'),
(25, 'Lagos State'),
(26, 'Nasarawa State'),
(27, 'Niger State'),
(28, 'Ogun State'),
(29, 'Ondo State'),
(30, 'Osun State'),
(31, 'Oyo State'),
(32, 'Plateau State'),
(33, 'Rivers State'),
(34, 'Sokoto State'),
(35, 'Taraba State'),
(36, 'Yobe State'),
(37, 'Zamfara State');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `lga` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `owner` varchar(255) NOT NULL,
  `founded_year` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_pins_tbl`
--

CREATE TABLE IF NOT EXISTS `wallet_pins_tbl` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= active, 1=used',
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_tbl`
--

CREATE TABLE IF NOT EXISTS `wallet_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) NOT NULL,
  `balance` float NOT NULL DEFAULT 0,
  `last_recharge_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=active, 2= banned',
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_history`
--
ALTER TABLE `booking_history`
  ADD CONSTRAINT `booking_history_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_history_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking_tbl`
--
ALTER TABLE `booking_tbl`
  ADD CONSTRAINT `booking_tbl_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_tbl_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recharge_history`
--
ALTER TABLE `recharge_history`
  ADD CONSTRAINT `recharge_history_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wallet_tbl`
--
ALTER TABLE `wallet_tbl`
  ADD CONSTRAINT `wallet_tbl_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
