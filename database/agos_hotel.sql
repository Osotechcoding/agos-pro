-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2022 at 05:30 PM
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
  `total_bill` decimal(7,2) NOT NULL DEFAULT 0.00,
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
  `total_bill` decimal(7,2) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `booking_time` time DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `is_approved` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_tbl`
--

INSERT INTO `booking_tbl` (`id`, `customer_id`, `room_id`, `no_of_guest`, `no_of_children`, `checkIn`, `checkOut`, `status`, `ref_code`, `total_night`, `total_bill`, `payment_method`, `booking_time`, `comment`, `created_at`, `is_approved`) VALUES
(1, 6, 3, 1, 0, '2022-11-08', '2022-11-10', 1, '2022110400381', 2, '20000.00', 'Wallet', '12:38:18', 'Some comments go here', '2022-11-04', 1);

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fullname` (`fullname`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fullname`, `email`, `password`, `username`, `verified`, `is_online`, `address`, `phone`, `gender`, `state_of_origin`, `confirmation_code`, `tokenExp`, `created_at`) VALUES
(6, 'Yakubu Oiza', 'taiwooiza@gmail.com', '$2y$10$GmpNcmiAgSNAiOmWvOQFtO3le37eGG3VTXReYiAlqwrcoveCpkmB.', 'taiwooiza', 1, 0, 'Sango Ota', '09036583063', 'Female', 'Ogun State', 'RMWukolRWboHC0bXVDqEOgbXyyeqkuPhK1FTijm2Am9WO6Ns428ela8wiNrXiBblMSsQ6eQdvgi5dtRufis7wosVhFQPknrF5M6N', '2022-11-03 14:10:23', '2022-11-03'),
(7, 'Agberayi Samson', 'osotechcoding@gmail.com', '$2y$10$GmpNcmiAgSNAiOmWvOQFtO3le37eGG3VTXReYiAlqwrcoveCpkmB.', 'osotechcoding', 1, 0, 'Ikere Ekiti', '08131374443', 'Male', 'Ekiti State', '', '2022-11-04 15:06:17', '2022-11-03'),
(8, 'Yakubu Olayemi P', 'christabelyemi7@gmail.com', '$2y$10$GmpNcmiAgSNAiOmWvOQFtO3le37eGG3VTXReYiAlqwrcoveCpkmB.', 'christabelyemi7', 1, 1, 'Sample address', '08140122566', 'Female', 'Lagos State', '', '2022-11-14 10:46:51', '2022-11-04');

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
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `recharge_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recharge_history`
--

INSERT INTO `recharge_history` (`id`, `customer_id`, `amount`, `recharge_at`, `created_at`) VALUES
(2, 6, '65000.00', '2022-11-04 10:25:40', '2022-11-04'),
(5, 6, '55000.00', '2022-11-04 14:35:07', '2022-11-04'),
(6, 8, '55000.00', '2022-11-04 14:38:28', '2022-11-04');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms_tbl`
--

INSERT INTO `rooms_tbl` (`id`, `room_name`, `room_type`, `price`, `room_desc`, `facilities`, `firstImage`, `acType`, `thirdImage`, `is_booked`, `created_at`) VALUES
(1, 'Room 101', 'Executive Suite', '30000.00', 'Sample', 'Wifi, TV Set, Pool', '1667424209.jpg', 'AC', '', 0, '2022-11-02'),
(2, 'Room 130', 'Standard Room', '50000.00', 'Just Another Sample Description', 'Tennis, Basket Ball, Flat Screen TV, Pool, Free Unlimited Wifi', '1667436186.jpg', 'AC', '', 0, '2022-11-03'),
(3, 'Room 203', 'Single Room', '10000.00', 'You\'re going to create an API for newsletter subscriptions. The user will subscribe to the newsletter by submitting their email address. After doing so, their email address will be stored in the database, and they are sent', 'TV, Bathroom', '1667455794.jpg', 'NON-AC', '', 1, '2022-11-03');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_tbl`
--

INSERT INTO `staff_tbl` (`id`, `username`, `email`, `password`, `fullname`, `role_type`, `status`, `verified`, `is_online`, `address`, `gender`, `state_of_origin`, `phone`, `last_login_date`, `account_token`, `image`, `created_at`) VALUES
(1, 'info.ftchelpdesk', 'info.ftchelpdesk@gmail.com', '$2y$10$4raLrj/QcYx9BQTYFkUQQuM9NseMql1YTzX2H111wUnPTLmHsllZW', 'Ayoola Iremide', 'Manager', 1, 1, 0, 'No 45, Aaye Street, Ilawe Ekit.', 'Female', 'Ekiti State', '08140122566', '2022-11-03 14:23:31', 'rF6tovwmnQ11FBKWldTR4bGzkA7BklMbpt', NULL, '2022-11-03');

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
  `amount` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= active, 1=used',
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet_pins_tbl`
--

INSERT INTO `wallet_pins_tbl` (`id`, `token`, `amount`, `status`, `created_at`) VALUES
(1, '638520179342', 55000, 0, '2022-11-03'),
(2, '342062551317', 55000, 0, '2022-11-03'),
(3, '593317604221', 55000, 0, '2022-11-03'),
(4, '416756251203', 55000, 0, '2022-11-03'),
(5, '512672341350', 55000, 0, '2022-11-03'),
(6, '623984712053', 55000, 0, '2022-11-03'),
(7, '419752320863', 55000, 0, '2022-11-03'),
(8, '724150365312', 55000, 0, '2022-11-03'),
(9, '238092146537', 55000, 0, '2022-11-03'),
(10, '275141366052', 55000, 0, '2022-11-03'),
(11, '653309812742', 55000, 0, '2022-11-03'),
(12, '323101425769', 55000, 0, '2022-11-03'),
(13, '750122531646', 55000, 0, '2022-11-03'),
(14, '016652423175', 55000, 0, '2022-11-03'),
(15, '625907132348', 55000, 0, '2022-11-03'),
(16, '795110243623', 55000, 0, '2022-11-03'),
(17, '206915343712', 55000, 1, '2022-11-03'),
(18, '472251316903', 55000, 1, '2022-11-03'),
(19, '012356261547', 55000, 0, '2022-11-03');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet_tbl`
--

INSERT INTO `wallet_tbl` (`id`, `customer_id`, `balance`, `last_recharge_date`, `status`, `created_at`) VALUES
(6, 6, 155000, '2022-11-04 13:35:07', 1, '2022-11-03'),
(7, 7, 30000, '2022-11-03 11:06:17', 1, '2022-11-03'),
(8, 8, 85000, '2022-11-04 13:38:28', 1, '2022-11-04');

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
-- Constraints for table `wallet_tbl`
--
ALTER TABLE `wallet_tbl`
  ADD CONSTRAINT `wallet_tbl_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
