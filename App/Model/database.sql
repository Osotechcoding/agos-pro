CREATE TABLE `agos_hotel`.`admin_tbl` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `username` VARCHAR(50) NULL DEFAULT NULL , `email` VARCHAR(255) NULL DEFAULT NULL , `password` VARCHAR(255) NULL DEFAULT NULL , `fullname` VARCHAR(255) NULL DEFAULT NULL , `role_type` VARCHAR(50) NOT NULL DEFAULT 'Admin' , `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0= not active, 1=active' , `verified` BOOLEAN NOT NULL DEFAULT FALSE COMMENT '0=not verified, 1= verified' , `is_online` BOOLEAN NOT NULL DEFAULT FALSE COMMENT '0=offline, 1=online' , `created_at` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
--
--
CREATE TABLE `agos_hotel`.`staff_tbl` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `username` VARCHAR(50) NULL DEFAULT NULL , `email` VARCHAR(255) NULL DEFAULT NULL , `password` VARCHAR(255) NULL DEFAULT NULL , `fullname` VARCHAR(255) NULL DEFAULT NULL , `role_type` VARCHAR(50) NULL DEFAULT NULL , `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0= not active, 1=active' , `verified` BOOLEAN NOT NULL DEFAULT FALSE COMMENT '0= not verified, 1=verified' , `is_online` BOOLEAN NOT NULL DEFAULT FALSE COMMENT '0= offline, 1=online' , `address` TEXT NULL DEFAULT NULL , `gender` VARCHAR(50) NULL DEFAULT NULL , `state_of_origin` VARCHAR(100) NULL DEFAULT NULL , `phone` VARCHAR(50) NULL DEFAULT NULL , `last_login_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `account_token` VARCHAR(225) NULL DEFAULT NULL , `image` VARCHAR(225) NULL DEFAULT NULL , `created_at` DATE NULL DEFAULT NULL , PRIMARY KEY (`id`), UNIQUE (`email`)) ENGINE = InnoDB;
--
---
CREATE TABLE `agos_hotel`.`wallet_tbl` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `customer_id` BIGINT(20) NOT NULL , `balance` DECIMAL(7,2) NOT NULL DEFAULT '0.00' , `last_recharge_date` TIMESTAMP NOT NULL , `status` INT(1) NOT NULL DEFAULT '1' COMMENT '1=active, 2= banned' , `created_at` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
--
--
CREATE TABLE `agos_hotel`.`customers` ( `id` BIGINT(20) NOT NULL AUTO_INCREMENT , `fullname` VARCHAR(255) NULL DEFAULT NULL , `email` VARCHAR(255) NULL DEFAULT NULL , `password` VARCHAR(255) NULL DEFAULT NULL , `username` VARCHAR(50) NULL DEFAULT NULL , `verified` BOOLEAN NOT NULL DEFAULT FALSE COMMENT '0=not verified, 1=verified' , `is_online` BOOLEAN NOT NULL DEFAULT FALSE COMMENT '0=offline, 1=online' , `address` TEXT NULL DEFAULT NULL , `phone` VARCHAR(50) NULL DEFAULT NULL , `gender` VARCHAR(50) NULL DEFAULT NULL , `state_of_origin` VARCHAR(100) NULL DEFAULT NULL , `confirmation_code` VARCHAR(100) NULL DEFAULT NULL COMMENT 'confirmation code sent via email' , `tokenExp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` DATE NULL DEFAULT NULL , PRIMARY KEY (`id`), INDEX (`fullname`), UNIQUE (`email`)) ENGINE = InnoDB;
--
--
CREATE TABLE `agos_hotel`.`rooms_tbl` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `room_name` VARCHAR(255) NOT NULL , `room_type` VARCHAR(255) NOT NULL , `price` DECIMAL(7,2) NOT NULL COMMENT 'price of the room per night' , `room_desc` MEDIUMTEXT NOT NULL , `facilities` TEXT NOT NULL , `firstImage` VARCHAR(255) NOT NULL , `secondImage` VARCHAR(255) NOT NULL , `thirdImage` VARCHAR(255) NOT NULL , `is_booked` BOOLEAN NOT NULL DEFAULT FALSE COMMENT '0=not booked, 1= booked' , `created_at` DATE NULL DEFAULT NULL , PRIMARY KEY (`id`), INDEX (`room_name`)) ENGINE = InnoDB;

--
--
CREATE TABLE `agos_hotel`.`booking_history` ( `id` BIGINT(20) NOT NULL AUTO_INCREMENT , `customer_id` BIGINT(20) NULL DEFAULT NULL , `room_id` INT(11) NULL DEFAULT NULL , `ref_code` VARCHAR(100) NULL DEFAULT NULL , `total_bill` DECIMAL(7,2) NOT NULL DEFAULT '0.00' , `checkIn` DATE NULL DEFAULT NULL , `checkOut` DATE NULL DEFAULT NULL , `total_night` INT(5) NULL DEFAULT '1' , `people` INT(3) NULL DEFAULT NULL , `paid` DECIMAL(7,2) NOT NULL DEFAULT '0.00' , `due` DECIMAL(7,2) NOT NULL DEFAULT '0.00' , `check_out_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `is_checked_out` BOOLEAN NOT NULL DEFAULT FALSE COMMENT '0=not checked out, 1= checked out' , `created_at` DATE NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

--
--
CREATE TABLE `agos_hotel`.`logging_history` ( `id` BIGINT(20) NOT NULL AUTO_INCREMENT , `email` VARCHAR(255) NULL DEFAULT NULL , `login_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `logout_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `ip_address` VARCHAR(45) NOT NULL COMMENT 'tracking the user ip address' , `created_at` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
--
ALTER TABLE `wallet_tbl` ADD FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
--
ALTER TABLE `booking_history` ADD FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
--
ALTER TABLE `booking_history` ADD FOREIGN KEY (`room_id`) REFERENCES `rooms_tbl`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
--
CREATE TABLE `agos_hotel`.`booking_tbl` ( `id` INT NOT NULL AUTO_INCREMENT , `customer_id` BIGINT(20) NOT NULL , `room_id` INT(11) NOT NULL , `no_of_guest` INT(5) NULL DEFAULT NULL , `no_of_children` INT(5) NULL DEFAULT NULL , `checkIn` DATE NULL DEFAULT NULL , `checkOut` DATE NULL DEFAULT NULL , `status` BOOLEAN NOT NULL DEFAULT TRUE COMMENT '1=pending,2 checked In,3 checked Out,4=extend staying' , `ref_code` VARCHAR(100) NOT NULL , `total_night` INT(5) NOT NULL , `total_bill` DECIMAL(7,2) NOT NULL , `payment_method` VARCHAR(100) NOT NULL , `booking_time` TIME NULL DEFAULT NULL , `create_at` DATE NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
--
--
ALTER TABLE `booking_tbl` ADD FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
--
ALTER TABLE `booking_tbl` ADD FOREIGN KEY (`room_id`) REFERENCES `rooms_tbl`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
--
CREATE TABLE `agos_hotel`.`tbl_settings` ( `id` INT(1) NOT NULL AUTO_INCREMENT , `company_name` VARCHAR(255) NULL DEFAULT NULL , `phone` VARCHAR(255) NULL DEFAULT NULL , `email` VARCHAR(255) NULL DEFAULT NULL , `address` TEXT NULL DEFAULT NULL , `country` VARCHAR(255) NULL DEFAULT NULL , `lga` VARCHAR(255) NULL DEFAULT NULL , `state` VARCHAR(255) NULL DEFAULT NULL , `favicon` VARCHAR(255) NULL DEFAULT NULL , `logo` VARCHAR(255) NULL DEFAULT NULL , `url` VARCHAR(255) NULL DEFAULT NULL , `owner` VARCHAR(255) NOT NULL , `founded_year` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
--
--
CREATE TABLE `agos_hotel`.`wallet_pins_tbl` ( `id` BIGINT(20) NOT NULL AUTO_INCREMENT , `token` VARCHAR(50) NOT NULL , `amount` INT(11) NOT NULL , `status` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0= active, 1=used' , `created_at` DATE NOT NULL , PRIMARY KEY (`id`), UNIQUE (`token`)) ENGINE = InnoDB;

--
--
CREATE TABLE `agos_hotel`.`recharge_history` ( `id` BIGINT(20) NOT NULL AUTO_INCREMENT , `customer_id` BIGINT(20) NULL , `amount` DECIMAL(10,2) NOT NULL DEFAULT '0.00' , `recharge_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` DATE NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

--

-- SELECT r.id
-- FROM `rooms_tbl` AS r
-- WHERE NOT EXISTS (SELECT * FROM `booking_tbl` as br WHERE r.id = br.room_id
--     AND ('checkIn' BETWEEN checkIn AND checkOut
--       OR 'checkOut' BETWEEN checkIn AND checkOut
--       OR checkIn BETWEEN 'checkIn' AND '2checkOut'
--       OR checkOut BETWEEN 'checkIn' AND 'checkOut'));