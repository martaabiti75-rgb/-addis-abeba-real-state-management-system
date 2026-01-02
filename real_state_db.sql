-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2025 at 01:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real_state_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers_request`
--
-- Add manager columns to room table
ALTER TABLE `real_state_db`.`room` 
ADD COLUMN `ManagerEmail` VARCHAR(255) NULL DEFAULT NULL AFTER `Block_Url`,
ADD COLUMN `ManagerName` VARCHAR(255) NULL DEFAULT NULL AFTER `ManagerEmail`,
ADD COLUMN `ManagerPhone` VARCHAR(20) NULL DEFAULT NULL AFTER `ManagerName`;

-- Add index for better performance
ALTER TABLE `real_state_db`.`room` 
ADD INDEX `idx_manager_email` (`ManagerEmail`);
-- Contact Messages Table
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(500) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('unread', 'read', 'replied') DEFAULT 'unread',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE `customers_request` (
  `req_id` int(11) NOT NULL,
  `req_room_id` varchar(110) NOT NULL,
  `req_room_no` int(11) NOT NULL,
  `req_floor` varchar(100) NOT NULL,
  `req_block` int(11) NOT NULL,
  `room_size` double NOT NULL,
  `block_url` text NOT NULL,
  `sale_price` int(11) NOT NULL,
  `rid` varchar(100) NOT NULL,
  `oid` varchar(100) NOT NULL,
  `owner_email` varchar(50) NOT NULL,
  `oname` varchar(100) NOT NULL,
  `cid` varchar(50) NOT NULL,
  `req_fullname` varchar(100) NOT NULL,
  `req_email` varchar(100) NOT NULL,
  `req_phone` varchar(100) NOT NULL,
  `req_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `req_status` tinyint(4) NOT NULL,
  `res_status` int(11) NOT NULL,
  `order_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers_request`
--

INSERT INTO `customers_request` (`req_id`, `req_room_id`, `req_room_no`, `req_floor`, `req_block`, `room_size`, `block_url`, `sale_price`, `rid`, `oid`, `owner_email`, `oname`, `cid`, `req_fullname`, `req_email`, `req_phone`, `req_date`, `req_status`, `res_status`, `order_code`) VALUES
(5, 'R120820250645', 1, '1', 1, 4, 'room.jpg', 500000, 'RSID120820250308', 'RS12082025142856', '', 'Woldeamanuel Dubale', 'C120820250920', 'Alebachew Degefe', 'alebachew@gmail.com', '', '0000-00-00 00:00:00', 2, 1, ''),
(7, 'R120920250935', 1, '1', 2, 4, 'room2.jpg', 450000, 'RSID120820250308', 'RS12082025142856', '', 'Woldeamanuel Dubale', 'C120820250920', 'Alebachew Degefe', 'alebachew@gmail.com', '', '0000-00-00 00:00:00', 2, 1, ''),
(8, 'R120920251237', 1, '1', 1, 4, 'room3.jpg', 350000, 'RSID120920251201', 'RS12092025122003', '', 'Zelalem Woldeamanuel ', 'C120920251208', 'Israel Abebe ', 'israel23@gmail.com', '', '0000-00-00 00:00:00', 2, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `realestateregistration`
--

CREATE TABLE `realestateregistration` (
  `PropertyID` int(11) NOT NULL,
  `OwnerName` varchar(150) NOT NULL,
  `OwnerContact` varchar(50) DEFAULT NULL,
  `OwnerEmail` varchar(50) DEFAULT NULL,
  `OwnerID` varchar(50) DEFAULT NULL,
  `ManagerName` varchar(50) DEFAULT NULL,
  `ManagerEmail` varchar(50) DEFAULT NULL,
  `ManagerPhone` varchar(50) DEFAULT NULL,
  `PropertyType` varchar(50) NOT NULL,
  `PropertyAddress` varchar(255) NOT NULL,
  `PropertySize` varchar(255) NOT NULL,
  `Blocks` varchar(255) NOT NULL,
  `RealStateId` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `realestateregistration`
--

INSERT INTO `realestateregistration` (`PropertyID`, `OwnerName`, `OwnerContact`, `OwnerEmail`, `OwnerID`, `ManagerName`, `ManagerEmail`, `ManagerPhone`, `PropertyType`, `PropertyAddress`, `PropertySize`, `Blocks`, `RealStateId`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'Woldeamanuel Dubale', '0950005656', 'wolde@gmail.com', '', 'Simegn Tamirat', 'simegn@gmail.com', NULL, 'Commercial', 'Adiss Abeba', '500', '23', 'RSID120820250308', '2025-12-08 14:42:08', '2025-12-08 16:50:41'),
(2, 'Zelalem Woldeamanuel ', '0988887878', 'duguna@gmail.com', '', 'Zemenu Kasse', 'zemenekasse@gmail.com', NULL, 'Commercial', 'Koyee', '6000', '10', 'RSID120920251201', '2025-12-09 11:23:01', '2025-12-09 11:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `real_estate_owners`
--

CREATE TABLE `real_estate_owners` (
  `owner_id` int(11) NOT NULL,
  `owner_uniq_id` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `fiyda` varchar(50) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `address_line1` varchar(200) DEFAULT NULL,
  `address_line2` varchar(200) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `id_number` varchar(100) DEFAULT NULL,
  `gender` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `real_estate_owners`
--

INSERT INTO `real_estate_owners` (`owner_id`, `owner_uniq_id`, `fullname`, `phone_number`, `fiyda`, `email`, `address_line1`, `address_line2`, `city`, `state`, `country`, `id_number`, `gender`, `created_at`, `updated_at`, `status`) VALUES
(3, 'RS12082025142856', 'Woldeamanuel Dubale', '0950005656', '0002541209875555', 'wolde@gmail.com', 'Hawassa', 'Hawassa', 'Hawassa', 'ሲዳማ ክልል', 'Ethiopia', NULL, 'Male', '2025-12-08 13:28:56', '2025-12-08 13:28:56', 0),
(4, 'RS12092025122003', 'Zelalem Woldeamanuel', '0988887878', '7874848484884884', 'duguna@gmail.com', 'Hawas', 'Hawassa', 'Hawasa', 'ሲዳማ ክልል', 'Ethiopia', NULL, 'Male', '2025-12-09 11:20:03', '2025-12-09 11:20:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RoomID` int(11) NOT NULL,
  `RUniqId` text NOT NULL,
  `RoomNumber` varchar(100) NOT NULL,
  `RoomSize` decimal(10,2) NOT NULL,
  `FloorNumber` int(11) NOT NULL,
  `BlockNo` int(11) NOT NULL,
  `Availability` text DEFAULT NULL,
  `SalePrice` decimal(10,2) NOT NULL,
  `RealStateId` text DEFAULT NULL,
  `OwnerId` text DEFAULT NULL,
  `Owner_email` varchar(50) NOT NULL,
  `OwnerName` text DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `ContactCenter` text DEFAULT NULL,
  `Block_Url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RoomID`, `RUniqId`, `RoomNumber`, `RoomSize`, `FloorNumber`, `BlockNo`, `Availability`, `SalePrice`, `RealStateId`, `OwnerId`, `Owner_email`, `OwnerName`, `Address`, `ContactCenter`, `Block_Url`) VALUES
(1, 'R120820250645', '1', 4.00, 1, 1, '2', 500000.00, 'RSID120820250308', 'RS12082025142856', 'wolde@gmail.com', 'Woldeamanuel Dubale', '', '', 'room.jpg'),
(2, 'R120920250935', '1', 4.00, 1, 2, '2', 450000.00, 'RSID120820250308', 'RS12082025142856', 'wolde@gmail.com', 'Woldeamanuel Dubale', '', '', 'room2.jpg'),
(3, 'R120920251237', '1', 4.00, 1, 1, '2', 350000.00, 'RSID120920251201', 'RS12092025122003', 'duguna@gmail.com', 'Zelalem Woldeamanuel ', '', '', 'room3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `saled_room`
--

CREATE TABLE `saled_room` (
  `res_id` int(200) NOT NULL,
  `res_room_id` varchar(110) NOT NULL,
  `res_room_no` int(11) NOT NULL,
  `res_floor` varchar(100) NOT NULL,
  `res_block` int(100) NOT NULL,
  `room_size` double NOT NULL,
  `sale_price` int(100) NOT NULL,
  `rid` varchar(100) NOT NULL,
  `oid` varchar(100) NOT NULL,
  `oname` varchar(100) NOT NULL,
  `url_image` varchar(100) NOT NULL,
  `cid` varchar(50) NOT NULL,
  `res_fullname` varchar(100) NOT NULL,
  `res_email` varchar(100) NOT NULL,
  `res_phone` varchar(100) NOT NULL,
  `res_date` date NOT NULL DEFAULT current_timestamp(),
  `saled_status` int(2) NOT NULL,
  `reserved_status2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saled_room`
--

INSERT INTO `saled_room` (`res_id`, `res_room_id`, `res_room_no`, `res_floor`, `res_block`, `room_size`, `sale_price`, `rid`, `oid`, `oname`, `url_image`, `cid`, `res_fullname`, `res_email`, `res_phone`, `res_date`, `saled_status`, `reserved_status2`) VALUES
(1, 'R120820250645', 1, '1', 1, 4, 500000, 'RSID120820250308', 'RS12082025142856', 'Woldeamanuel Dubale', 'room.jpg', 'C120820250920', 'Alebachew Degefe', 'alebachew@gmail.com', '', '0000-00-00', 1, 0),
(2, 'R120920250935', 1, '1', 2, 4, 450000, 'RSID120820250308', 'RS12082025142856', 'Woldeamanuel Dubale', 'room2.jpg', 'C120820250920', 'Alebachew Degefe', 'alebachew@gmail.com', '', '0000-00-00', 1, 0),
(3, 'R120920251237', 1, '1', 1, 4, 350000, 'RSID120920251201', 'RS12092025122003', 'Zelalem Woldeamanuel ', 'room3.jpg', 'C120920251208', 'Israel Abebe ', 'israel23@gmail.com', '', '0000-00-00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `transaction_date` varchar(50) DEFAULT 'Nov , 11 2024',
  `transaction_type` enum('credit','debit') DEFAULT NULL,
  `description` text DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `payemntto` varchar(50) DEFAULT NULL,
  `payment_toemail` varchar(50) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `status` enum('pending','success','failed') DEFAULT NULL,
  `reference_number` varchar(50) DEFAULT NULL,
  `order_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `amount`, `transaction_date`, `transaction_type`, `description`, `name`, `email`, `payemntto`, `payment_toemail`, `payment_method`, `currency`, `status`, `reference_number`, `order_code`) VALUES
(1, 500000.00, 'Dec-09-2025', 'credit', 'Payment For Property', 'Alebachew Degefe', 'alebachew@gmail.com', 'Woldeamanuel Dubale', 'wolde@gmail.com', 'From Vertual API Transfer', 'ETB', 'success', 'FT67184584557', '8458333'),
(2, 450000.00, 'Dec-09-2025', 'credit', 'Payment For Property', 'Alebachew Degefe', 'alebachew@gmail.com', 'Woldeamanuel Dubale', 'wolde@gmail.com', 'From Vertual API Transfer', 'ETB', 'success', 'FT10655102864', '2604489'),
(3, 350000.00, 'Dec-09-2025', 'credit', 'Payment For Property', 'Israel Abebe ', 'israel23@gmail.com', 'Zelalem Woldeamanuel ', 'duguna@gmail.com', 'From Vertual API Transfer', 'ETB', 'success', 'FT65208115711', '1295753');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `account_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `passwordhash` varchar(50) NOT NULL,
  `otp` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  `account_status` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 0,
  `oid_for_mg` varchar(50) NOT NULL,
  `ow_email_mg` varchar(50) NOT NULL,
  `cid` varchar(50) NOT NULL,
  `last_login_time` varchar(50) NOT NULL,
  `last_login_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`account_id`, `email`, `password`, `passwordhash`, `otp`, `role`, `created_at`, `updated_at`, `account_status`, `is_active`, `oid_for_mg`, `ow_email_mg`, `cid`, `last_login_time`, `last_login_date`) VALUES
(1, 'zelalemabreham8@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '849611', 'System administrator', '2023-10-26 10:00:00', '2025-09-19', '1', 0, '', '', '', 'Tue, 01:30: 05pm', 'Dec 09 2025 Tue, 01:30: 05pm'),
(2, 'wolde@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '199237', 'Owner', '2025-12-06', '', '1', 0, '', '', '', 'Tue, 10:10: 47am', 'Dec 09 2025 Tue, 10:10: 47am'),
(4, 'simegn@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '214553', 'Manager', '2025-12-08', '', '1', 0, 'RS12082025142856', 'wolde@gmail.com', '', 'Tue, 09:45: 10am', 'Dec 09 2025 Tue, 09:45: 10am'),
(7, 'alebachew@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '23069', 'Customer', '', '', '1', 0, '', '', 'C120820250920', 'Tue, 09:45: 51am', 'Dec 09 2025 Tue, 09:45: 51am'),
(9, 'duguna@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '423742', 'Owner', '2025-12-09', '', '1', 0, '', '', '', 'Tue, 12:14: 05pm', 'Dec 09 2025 Tue, 12:14: 05pm'),
(10, 'zemenekasse@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '392586', 'Manager', '2025-12-09', '', '1', 0, 'RS12092025122003', 'duguna@gmail.com', '', 'Tue, 12:40: 47pm', 'Dec 09 2025 Tue, 12:40: 47pm'),
(11, 'israel23@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', '87172', 'Customer', '', '', '1', 0, '', '', 'C120920251208', 'Tue, 12:41: 57pm', 'Dec 09 2025 Tue, 12:41: 57pm'),
(12, 'abititegen@gmail.com', 'bc53b5813c49642762c251319405523e399e6176', '321321', '118883', 'Customer', '', '', '1', 0, '', '', 'C120920251257', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_detail_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `date_of_birth` varchar(50) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `profile_picture_url` varchar(255) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `kebele` varchar(50) NOT NULL,
  `wereda` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `bio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_detail_id`, `account_id`, `fullname`, `phone_number`, `age`, `gender`, `date_of_birth`, `nationality`, `profile_picture_url`, `city`, `address`, `kebele`, `wereda`, `state`, `bio`) VALUES
(1, 1, 'Zelalem Abreham', '0920498295', '24', 'Male', '2025-09-20', 'ETH', '../assets/img/avatar/zola.jpg', 'Wondo', 'Wondo', 'አራዳ', 'አባላ አባያ', 'ሲዳማ ክልል', 'Bio'),
(2, 2, 'Woldeamanuel Dubale', NULL, '', 'Male', '', 'ETH', '', 'Yebelo', 'Yebelo', '', '', 'መካከለኛ ኢትዮጵያ', 'Proxima'),
(4, 4, 'Simegn Tamirat', NULL, '', '', '', 'ETH', '', '', '', '', '', '', ''),
(5, 7, 'Alebachew Degefe', '0955121288', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', ''),
(6, 9, 'Zelalem Woldeamanuel ', NULL, '', '', '', 'ETH', '', '', '', '', '', '', ''),
(7, 10, 'Zemenu Kasse', NULL, '', '', '', 'ETH', '', '', '', '', '', '', ''),
(8, 11, 'Israel Abebe ', '0985064477', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', ''),
(9, 12, 'Tegegn Te', '0949935857', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers_request`
--
ALTER TABLE `customers_request`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `realestateregistration`
--
ALTER TABLE `realestateregistration`
  ADD PRIMARY KEY (`PropertyID`);

--
-- Indexes for table `real_estate_owners`
--
ALTER TABLE `real_estate_owners`
  ADD PRIMARY KEY (`owner_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id_number` (`id_number`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`RoomID`);

--
-- Indexes for table `saled_room`
--
ALTER TABLE `saled_room`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_detail_id`),
  ADD KEY `user_details_ibfk_1` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers_request`
--
ALTER TABLE `customers_request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `realestateregistration`
--
ALTER TABLE `realestateregistration`
  MODIFY `PropertyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `real_estate_owners`
--
ALTER TABLE `real_estate_owners`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `saled_room`
--
ALTER TABLE `saled_room`
  MODIFY `res_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
