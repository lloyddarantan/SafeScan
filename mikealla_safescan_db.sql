-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 17, 2026 at 02:38 PM
-- Server version: 11.8.5-MariaDB-log
-- PHP Version: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mikealla_safescan_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appliance`
--

CREATE TABLE `appliance` (
  `appliance_id` int(55) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `type` varchar(55) NOT NULL,
  `group` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(525) NOT NULL,
  `wattage` varchar(55) NOT NULL,
  `energy_consumption` varchar(255) NOT NULL,
  `safety_reminder` varchar(555) NOT NULL,
  `hazards` varchar(555) NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appliance`
--

INSERT INTO `appliance` (`appliance_id`, `brand`, `type`, `group`, `category`, `description`, `wattage`, `energy_consumption`, `safety_reminder`, `hazards`, `image`) VALUES
(1, 'Condura', 'No Frost Refrigerator', 'Refrigerator', 'Kitchen', 'Energy-efficient double door refrigerator for daily food storage.', '2000', '4.8', 'Do not overload outlets and keep door seals clean and intact.', 'Electrical fire, refrigerant leak, food spoilage from poor sealing.', NULL),
(2, 'Fujidenzo', 'Chest Freezer', 'Refrigerator', 'Kitchen', 'Large capacity chest freezer for frozen food and meat storage.', '1800', '4.3', 'Keep the lid closed properly and allow proper ventilation around the unit.', 'Electrical shock, frostbite from prolonged contact, overheating compressor.', NULL),
(3, 'Panasonic', 'Inverter Microwave Oven', 'Small Appliances', 'Kitchen', 'Microwave oven with inverter heating for fast and even cooking.', '1200', '1.2', 'Do not operate empty and use microwave-safe containers only.', 'Radiation leakage from damaged door, burns, fire from metal objects.', NULL),
(4, 'Condura', 'Rice Cooker', 'Small Appliances\r\n', 'Kitchen', 'Standard rice cooker commonly used in Filipino kitchens.', '700', '0.7', 'Keep the cooker dry and unplug after use. Avoid touching hot surfaces.', 'Burns from hot steam, electrical shock, fire risk.', NULL),
(5, 'Fujidenzo', 'Oven Toaster', 'Small Appliances\r\n', 'Kitchen', 'Oven toaster for baking, toasting, and reheating meals.', '1500', '1.5', 'Keep away from flammable materials and never leave unattended while in use.', 'Fire hazard, burns, electrical shock.', NULL),
(6, 'Union', 'Desk Electric Fan', 'Fan', 'Kitchen', 'Small desk fan used for kitchen ventilation and cooling.', '40', '0.24', 'Keep fingers and objects away from the fan blades and unplug before cleaning.', 'Blade injury, electric shock, overheating motor.', NULL),
(7, 'Panasonic', 'Blender', 'Small Appliances\r\n', 'Kitchen', 'Kitchen blender for shakes, drinks, and food preparation.', '350', '0.35', 'Ensure the lid is tightly secured before blending and unplug before cleaning.', 'Blade injury, electric shock, spills causing slips.', NULL),
(8, 'Panasonic', '1.5 HP Inverter Split Air Conditioner', 'Air Conditioner', 'Living Room', 'Energy-saving inverter air conditioner for medium-sized rooms.', '1500', '12.0', 'Clean filters regularly and ensure proper ventilation. Do not block air vents.', 'Overheating, electrical shock from damaged wiring, water leakage.', ''),
(9, 'Haier', '1.5 HP Inverter Split Air Conditioner', 'Air Conditioner', 'Living Room', 'Quiet and efficient inverter air conditioner with strong cooling.', '1500', '12.0', 'Keep the unit properly mounted and maintain regular cleaning of filters.', 'Electrical shock, refrigerant leaks, overheating if airflow is blocked.', NULL),
(10, 'Condura', '1.0 HP Window Air Conditioner', 'Air Conditioner', 'Living Room', 'Compact window-type air conditioner ideal for small spaces.', '1100', '8.8', 'Install securely in the window and keep vents unobstructed.', 'Unit falling, electrical shock, water leakage.', NULL),
(11, 'HKTV', '43 inch LED Smart TV', 'TV', 'Living Room', 'Smart LED television for entertainment and streaming.', '80', '0.4', 'Keep ventilation holes clear and avoid placing liquids near the TV.', 'Electrical shock, overheating, screen damage.', NULL),
(12, 'Cherry', '50 inch Smart LED TV', 'TV', 'Living Room', 'Large smart TV suitable for family viewing.', '100', '0.5', 'Mount securely or place on a stable stand. Keep away from moisture.', 'TV tipping over, electrical shock, overheating.', NULL),
(13, 'Panasonic', '32 inch LED TV', 'TV', 'Living Room', 'Compact LED television with clear display.', '60', '0.3', 'Ensure proper ventilation and avoid covering the TV while in use.', 'Overheating, electrical short circuit, screen damage.', NULL),
(14, 'Union', 'Stand Electric Fan', 'Fan', 'Living Room', 'Stand fan for air circulation and cooling.', '60', '0.36', 'Place on a stable surface and keep away from curtains or loose materials.', 'Tipping over, blade injury, electrical short circuit.', NULL),
(15, 'Union', 'Table Fan', 'Fan', 'Bedroom', 'Personal table fan for bedside cooling.', '40', '0.24', 'Keep away from water and ensure the fan guard is secure.', 'Electric shock, blade injury, overheating.', NULL),
(16, 'Panasonic', 'Ceiling Fan', 'Fan', 'Bedroom', 'Ceiling fan providing continuous airflow for comfort.', '70', '0.56', 'Ensure proper ceiling mounting and turn off power before maintenance.', 'Fan falling, electrical shock, loose blade injury.', NULL),
(17, 'Union', 'Air Cooler', 'Fan', 'Bedroom', 'Evaporative air cooler for energy-efficient cooling.', '200', '1.6', 'Fill with clean water only and unplug before refilling or cleaning.', 'Water spillage causing electric shock, mold buildup, slipping hazard.', NULL),
(19, 'Haier', 'Air Purifier', 'Small Appliances\r\n', 'Bedroom', 'Air purifier that cleans and filters bedroom air.', '60', '0.36', 'Replace filters regularly and keep air intake unobstructed.', 'Reduced air quality if dirty, electrical overheating.', NULL),
(20, 'Philips', 'LED Desk Lamp', 'Small Appliances\r\n', 'Bedroom', 'Energy-saving LED lamp for reading and studying.', '12', '0.048', 'Use the correct voltage and avoid contact with water.', 'Electrical shock, overheating if covered.', NULL),
(21, 'Fujidenzo', 'Mini Refrigerator', 'Refrigerator', 'Bedroom', 'Compact mini fridge for drinks and snacks.', '1200', '2.88', 'Place on a level surface and avoid overloading the power outlet.', 'Electrical fire, overheating, refrigerant leak.', NULL),
(31, 'Panasonic', 'Inverter Fan', 'Fan', 'Living Room', '', '60', '0.11', 'Use on a flat surface and keep vents clear for proper airflow.', 'Overheating, electrical short, fan blade injury.', '1771301924_6993ec24c499d.jpg'),
(32, 'LG', '4K Smart TV', 'TV', 'Living Room', '', '85', '0.13', 'Use a surge protector and ensure adequate ventilation space.', 'Power surge damage, overheating, electrical shock.', '1771325964_69944a0ce4efa.jpg');

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
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `appliance_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `appliance_id`, `created_at`) VALUES
(18, 23, 10, '2026-02-11 00:39:12'),
(25, 18, 16, '2026-02-16 17:51:02'),
(26, 18, 20, '2026-02-16 17:51:08'),
(31, 13, 6, '2026-02-17 03:38:56'),
(32, 13, 9, '2026-02-17 03:39:42'),
(33, 13, 16, '2026-02-17 04:07:30'),
(34, 13, 31, '2026-02-17 04:19:10'),
(35, 13, 1, '2026-02-17 04:53:57'),
(36, 18, 9, '2026-02-17 09:44:19'),
(38, 24, 9, '2026-02-17 14:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `safety_reminder`
--

CREATE TABLE `safety_reminder` (
  `reminder_id` int(55) NOT NULL,
  `appliance_id` int(11) NOT NULL,
  `hazards` varchar(555) NOT NULL,
  `safety_reminder` varchar(555) NOT NULL
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
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `country` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'User',
  `date_registered` timestamp NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `country`, `province`, `city`, `street`, `role`, `date_registered`, `date_updated`) VALUES
(2, 'Lloyd', 'Trial', 'lloydtrial@gmail.com', '$2y$12$.ORzjrCg77eQZPkEp105teDWP4S.3f.i/0IeET.BXda', '09998819651', 'Philippines', 'Negros Occidental', 'Bacolod City', '12th Street', 'User', '2026-02-03 15:52:35', '2026-02-03 15:52:35'),
(3, 'Nikki', 'Inventor', 'nikki123@gmail.com', '$2y$12$sjvTxgmXba.uc3At6m6BBufXPYJryBEXWmTq.f.LF1o', '09998819652', 'Ph', 'Negros Occidental', 'Bacolod City', '12th Street', 'User', '2026-02-03 16:13:54', '2026-02-03 16:13:54'),
(4, 'Nikki', 'Inventor', 'nikki123@gmail.com', '$2y$12$Of4BKLOCQBRtquc3WxO/g.ofc6tJldKht0YlsZTFf1Ye8U0pIZw.G', '09998819652', 'Ph', 'Negros Occidental', 'Bacolod City', '12th Street', 'User', '2026-02-03 16:18:30', '2026-02-03 16:18:30'),
(5, 'Nikki', 'Inventor', 'nikki123@gmail.com', '$2y$12$PtMKMPP2Jl7b369YN.OcPOT735Zn5UvgOWHjd5b6xgu1Szqbs2gCm', '09998819652', 'Ph', 'Negros Occidental', 'Bacolod City', '12th Street', 'User', '2026-02-03 16:18:31', '2026-02-03 16:18:31'),
(7, 'Ehrica', 'Ledesma', 'ledesmaehrica@gmail.com', '$2y$12$U6bfGhn9nULvl/hk..O.dOEpGkqcDjy.5Y5nrKjFmzAcdf6KzG/cK', '0912345678', 'secret', 'secret', 'secret', 'secret', 'User', '2026-02-03 16:41:26', '2026-02-03 16:41:26'),
(8, 'Justine', 'Torres', 'lolcrusttacean@gmail.com', '$2y$12$GubiIbKr6Ku8/FrxNn0y7ub7AHVJRYDGXHMa1eM7qPKAVjmTogT7.', '09275750012', 'Philippines', 'Negros', 'Bago', 'crazy', 'User', '2026-02-03 21:33:40', '2026-02-03 21:33:40'),
(12, 'Super', 'Admin', 'superadmin@safescan.com', '$2y$12$N/4rUDQ1B/8jvbdo3Q08CetIj2ZNWJJV9BWBCXYkn1wUM3g2SCSPC', '09754884', 'Philippines ', 'Negros Occidental', 'Bacolod', '1st street', 'Admin', '2026-02-05 12:59:05', '2026-02-05 12:59:05'),
(13, 'John Lloyd', 'Darantan', 'jnzketaganile@gmail.com', '$2y$12$ac37qJYbQL/mpUSJa1d3Lee/5ARkwhRVf12Eba1I9gA1DmeuuPAWm', '09998819654', 'Philippines', 'Negros Occidental', 'Bacolod City', '12th Street', 'User', '2026-02-05 20:51:32', '2026-02-05 20:51:32'),
(14, 'Lloyd', 'Darantan', 'jnzketaganile@gmail.com', '$2y$12$MmEfG4AHVtckNI8vRJ.R6.OACEc1GH4hh02k8yit9HaglfotPtbVK', '09998819654', 'Philippines', 'Negros Occidental', 'Bacolod City', '12th Street', 'User', '2026-02-05 20:51:33', '2026-02-05 20:51:33'),
(15, 'Nikki', 'Darantan', 'inventornikkijanelle@gmail.com', '$2y$12$yxuUKqEHSkvhFGPwjcmoAuDwaoFxKxyWcqvS/SJGRD5WWAhSOFCjC', '09991234567', 'Philippines ', 'Negros Occidental ', 'Bacolod City', '123', 'User', '2026-02-06 01:21:25', '2026-02-06 01:21:25'),
(16, 'Nikki', 'Darantan', 'inventornikkijanelle@gmail.com', '$2y$12$EAll1MGMboLEWO3LXrdb3uhjm7fbI.IKyD2WJ3W9HHy0RzsvL.bBC', '09991234567', 'Philippines ', 'Negros Occidental ', 'Bacolod City', '123', 'User', '2026-02-06 01:21:25', '2026-02-06 01:21:25'),
(18, 'mika', 'rent', 'mika@gmail.com', '$2y$12$2Ja/Ptgq0zAte.dGvtYAGeEzho8JRckhFE2Ns2bmqYhdvQ00V24aS', '8908893', 'Philippines', 'Negros Occidental', 'Bacolod City', '12th Street', 'User', '2026-02-09 15:49:02', '2026-02-09 15:49:02'),
(23, 'Lloyd', 'DARANTAN', 'jnzketaganile10@gmail.com', '$2y$12$pEEvYqa9z8zCZzKwfBIdxu6HuWwFksnjVrXcjnUVLnOUkcMPs5u9y', '09998819654', 'Philippines', 'Negros Occidental', 'Bacolod City', '12th Street', 'User', '2026-02-11 00:37:32', '2026-02-11 00:37:32'),
(24, 'User', 'User', 'user@safescan.com', '$2y$12$t39UMxnwrIi8vbFFzQtzn.FSROVJaVTgBRKGqp7pEqLTMZA0RG0aC', '09991234567', 'Philippines', 'Negros Occidental', 'Bacolod City', 'La Salle Avenue', 'User', '2026-02-12 12:25:04', '2026-02-12 12:25:04');

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
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_fav` (`user_id`,`appliance_id`);

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
  MODIFY `appliance_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `appliance_history`
--
ALTER TABLE `appliance_history`
  MODIFY `appliancehistory_id` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
