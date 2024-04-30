-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 12:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_platform_for_renting_tools`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `email`, `password`, `created_at`) VALUES
(1, 'uwase audile', 'uwa@gmail.com', '122333', '2024-04-24 11:30:31');

-- --------------------------------------------------------

--
-- Table structure for table `deliverymen`
--

CREATE TABLE `deliverymen` (
  `deliveryman_id` int(11) NOT NULL,
  `deliveryman_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliverymen`
--

INSERT INTO `deliverymen` (`deliveryman_id`, `deliveryman_name`, `email`, `phone_number`, `created_at`) VALUES
(1, 'Michael Johnson', 'michael@example.com', '+1234567890', '2024-04-24 11:30:31'),
(2, 'Sarah Adams', 'sarah@example.com', '+1987654321', '2024-04-24 11:30:31'),
(5, 'Kalisa', 'kali@gmail.com', '0791461871', '2024-04-10 11:01:00'),
(6, 'Kalisa', 'kali@gmail.com', '0791461871', '2024-04-10 11:01:00'),
(7, 'Kalisa', 'kali@gmail.com', '0791461871', '2024-04-10 11:01:00'),
(8, 'Kalisa', 'kali@gmail.com', '0791461871', '2024-04-10 11:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `rental_id` int(11) NOT NULL,
  `tool_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(30) NOT NULL,
  `tool_name` varchar(30) NOT NULL,
  `rental_start` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rental_end` timestamp NULL DEFAULT current_timestamp(),
  `total_price` decimal(8,2) NOT NULL,
  `rental_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`rental_id`, `tool_id`, `user_id`, `user_name`, `tool_name`, `rental_start`, `rental_end`, `total_price`, `rental_status`) VALUES
(1, 1, 2, 'jane', 'Hammer', '2024-04-24 12:17:54', '2024-04-28 15:00:00', 15.00, 'Active'),
(2, 2, 1, 'john_doe', 'Drill', '2024-04-24 12:19:31', '2024-04-28 16:00:00', 20.00, 'Active'),
(3, 1, 1, 'john_doe', 'hammer', '2024-04-01 23:38:00', '0000-00-00 00:00:00', 15.00, 'completed'),
(4, 1, 1, 'john_doe', 'hammer', '2024-04-01 23:38:00', '0000-00-00 00:00:00', 15.00, 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `tool_id` int(11) NOT NULL,
  `tool_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price_per_day` decimal(8,2) NOT NULL,
  `available` tinyint(1) DEFAULT 1,
  `owner_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`tool_id`, `tool_name`, `description`, `price_per_day`, `available`, `owner_id`, `created_at`) VALUES
(1, 'Hammer', 'A basic tool for driving and removing nails.', 5.00, 1, 1, '2024-04-24 11:30:31'),
(2, 'Drill', 'A tool used for drilling holes in various materials.', 10.00, 1, 1, '2024-04-24 11:30:31'),
(3, 'Saw', 'A tool for cutting wood or other materials.', 8.00, 1, 2, '2024-04-24 11:30:31'),
(4, 'Wedding dresses', 'For the contemporary bride, modern wedding dresses offer sleek lines and minimalist designs. Whether it\'s a form-fitting sheath dress or a stylish mermaid gown, modern wedding dresses are all about clean silhouettes and understated glamour. With subtle embellishments and unique necklines, these dresses perfectly blend elegance with modernity.', 100.00, 0, 1, '2024-04-11 08:32:00'),
(5, 'pliers', ' A hand tool used to hold objects firmly or for bending and compressing\r\n', 100.00, 0, 1, '2024-04-08 15:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `rental_id` int(11) DEFAULT NULL,
  `tool_id` int(11) DEFAULT NULL,
  `deliveryman_id` int(11) DEFAULT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `transaction_status` varchar(20) NOT NULL,
  `transaction_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `rental_id`, `tool_id`, `deliveryman_id`, `total_price`, `transaction_status`, `transaction_date`) VALUES
(1, 1, 1, 1, 15.00, 'Completed', '2024-04-25'),
(2, 2, 2, 2, 20.00, 'Completed', '2024-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `phone` text NOT NULL,
  `gender` varchar(30) NOT NULL,
  `dob` date NOT NULL DEFAULT current_timestamp(),
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `phone`, `gender`, `dob`, `email`, `password`, `created_at`) VALUES
(1, 'john', 'doe', '0791461871', 'male', '2024-04-25', 'doe@gmail.com', '12233', '2024-04-24 11:30:31'),
(2, 'jane_smith', '', '', '', '2024-04-25', 'jane@example.com', 'password456', '2024-04-24 11:30:31'),
(4, 'karera', 'anita', '07896768', 'female', '2024-04-02', 'ani@gmail.com', '12233', '2024-04-27 23:48:37'),
(5, 'Mbabazi', 'fillete', '07894543', 'Female', '2000-02-03', 'file@gmail.com', '12233', '2024-04-25 17:59:30'),
(6, 'kalire', 'kellen', '07898543', 'female', '2012-06-05', 'kelle@gmail.com', '12233', '2024-04-25 17:49:04'),
(9, 'kaliza', 'keke', '09766746', 'female', '2000-02-27', 'ke@gmail.com', '12233', '2024-04-29 17:40:08'),
(10, 'kalisa', 'da', 'rer', 'wrw', '0044-02-04', 'jf@gmail.com', '1234', '2024-04-29 17:47:29'),
(11, 'kalisa', 'da', 'rer', 'wrw', '0044-02-04', 'jf@gmail.com', '1234', '2024-04-29 17:50:21'),
(12, 'rurangwa', 'erenestina', '07892323', 'female', '2000-02-04', 'ere@gmail.com', '12233', '2024-04-29 19:50:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `deliverymen`
--
ALTER TABLE `deliverymen`
  ADD PRIMARY KEY (`deliveryman_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `tool_id` (`tool_id`),
  ADD KEY `user_id` (`user_id`,`user_name`,`tool_name`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`tool_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `rental_id` (`rental_id`),
  ADD KEY `tool_id` (`tool_id`),
  ADD KEY `deliveryman_id` (`deliveryman_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `deliverymen`
--
ALTER TABLE `deliverymen`
  MODIFY `deliveryman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `tool_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`tool_id`) REFERENCES `tools` (`tool_id`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `tools`
--
ALTER TABLE `tools`
  ADD CONSTRAINT `tools_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`rental_id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`tool_id`) REFERENCES `tools` (`tool_id`),
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`deliveryman_id`) REFERENCES `deliverymen` (`deliveryman_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
