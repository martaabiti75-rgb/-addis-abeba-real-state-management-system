-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2025 at 01:37 PM
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
-- Database: `real_state_bank_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_db_table`
--

CREATE TABLE `bank_db_table` (
  `bid` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL DEFAULT 'ንግድ ባንክ ኢትዮጵያ',
  `account_type` varchar(50) NOT NULL DEFAULT 'Saving',
  `currency` varchar(20) NOT NULL DEFAULT 'ETB',
  `account_number` varchar(50) NOT NULL,
  `balance` decimal(15,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_db_table`
--

INSERT INTO `bank_db_table` (`bid`, `fullname`, `phone`, `email`, `bank_name`, `account_type`, `currency`, `account_number`, `balance`) VALUES
(1, 'Woldeamanuel Dubale', '', 'wolde@gmail.com', 'TellBirr', 'Saving', 'ETB', '0920495555', 450000.00),
(2, 'Woldeamanuel Dubale', '', 'wolde@gmail.com', 'CBE', 'Saving', 'ETB', '1000308770961', 25000.00),
(3, 'Woldeamanuel Dubale', '', 'wolde@gmail.com', 'Mpessa', 'Saving', 'ETB', '0788000144', 525000.01),
(4, 'Alebachew Degefe', '0955121288', 'alebachew@gmail.com', 'TellBirr', 'Saving', 'ETB', '0988888888', 1550000.00),
(5, 'Zelalem Woldeamanuel ', '', 'duguna@gmail.com', 'Abyssinia', 'Saving', 'ETB', '91238563', 2500000.00),
(6, 'Zelalem Woldeamanuel ', '', 'duguna@gmail.com', 'TellBirr', 'Saving', 'ETB', '0988887777', 2850000.00),
(7, 'Israel Abebe ', '0985064477', 'israel23@gmail.com', 'Mpessa', 'Saving', 'ETB', '0788033665', 2150000.00),
(8, 'Israel Abebe ', '0985064477', 'israel23@gmail.com', 'CBE', 'Saving', 'ETB', '1000308770958', 2500000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_db_table`
--
ALTER TABLE `bank_db_table`
  ADD PRIMARY KEY (`bid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_db_table`
--
ALTER TABLE `bank_db_table`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
