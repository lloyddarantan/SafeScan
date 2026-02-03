-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2026 at 04:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safescan_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appliance`
--

CREATE TABLE `appliance` (
  `appliance_id` int(55) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `type` varchar(55) NOT NULL,
  `description` varchar(525) NOT NULL,
  `wattage` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appliance_history`
--

CREATE TABLE `appliance_history` (
  `appliancehistory_id` int(55) NOT NULL,
  `appliance_id` int(55) NOT NULL,
  `scanhistory_id` int(55) NOT NULL,
  `date_scanned` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `safety_reminder`
--

CREATE TABLE `safety_reminder` (
  `reminder_id` int(55) NOT NULL,
  `appliance_id` int(11) NOT NULL,
  `risk_type` varchar(555) NOT NULL,
  `safety_message` varchar(555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scan_history`
--

CREATE TABLE `scan_history` (
  `scanhistory_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `scan_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `wattage` varchar(255) NOT NULL,
  `energy_consumption` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `country` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `country`, `province`, `city`, `street`, `role`, `date_registered`, `date_updated`) VALUES
(1, 'Lloyd', 'Testing', 'testing123@gmail.com', '123', '123', '123', '', '', '', 'Admin', '2026-01-29 14:28:00', '2026-01-29 14:28:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appliance`
--
ALTER TABLE `appliance`
  ADD PRIMARY KEY (`appliance_id`);

--
-- Indexes for table `appliance_history`
--
ALTER TABLE `appliance_history`
  ADD PRIMARY KEY (`appliancehistory_id`),
  ADD KEY `appliance_id` (`appliance_id`),
  ADD KEY `scanhistory_id` (`scanhistory_id`);

--
-- Indexes for table `safety_reminder`
--
ALTER TABLE `safety_reminder`
  ADD PRIMARY KEY (`reminder_id`),
  ADD KEY `appliance_id` (`appliance_id`);

--
-- Indexes for table `scan_history`
--
ALTER TABLE `scan_history`
  ADD PRIMARY KEY (`scanhistory_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appliance`
--
ALTER TABLE `appliance`
  MODIFY `appliance_id` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appliance_history`
--
ALTER TABLE `appliance_history`
  MODIFY `appliancehistory_id` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `safety_reminder`
--
ALTER TABLE `safety_reminder`
  MODIFY `reminder_id` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scan_history`
--
ALTER TABLE `scan_history`
  MODIFY `scanhistory_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appliance_history`
--
ALTER TABLE `appliance_history`
  ADD CONSTRAINT `appliance_history_ibfk_1` FOREIGN KEY (`appliance_id`) REFERENCES `appliance` (`appliance_id`),
  ADD CONSTRAINT `appliance_history_ibfk_2` FOREIGN KEY (`scanhistory_id`) REFERENCES `scan_history` (`scanhistory_id`);

--
-- Constraints for table `safety_reminder`
--
ALTER TABLE `safety_reminder`
  ADD CONSTRAINT `safety_reminder_ibfk_1` FOREIGN KEY (`appliance_id`) REFERENCES `appliance` (`appliance_id`);

--
-- Constraints for table `scan_history`
--
ALTER TABLE `scan_history`
  ADD CONSTRAINT `scan_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
