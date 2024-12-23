-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 22, 2024 at 06:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TrainerFinder`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepted_trainers`
--

CREATE TABLE `accepted_trainers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `certificate` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `sport` varchar(255) DEFAULT NULL,
  `day_time` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `reservations` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accepted_trainers`
--

INSERT INTO `accepted_trainers` (`id`, `user_id`, `username`, `email`, `certificate`, `location`, `sport`, `day_time`, `state`, `approved_at`, `reservations`) VALUES
(2, 9, 'aml el gedawey', 'amlhatem@gmail.com', 'Ai lec 4.pdf', 'New Cairo', 'Squash', 'Monday 05:00 PM', 'accepted', '2024-11-29 15:17:52', NULL),
(3, 9, 'aml el gedawey', 'amlhatem@gmail.com', 'WhatsApp Image 2024-04-23 at 8.29.11 PM.pdf', 'Sheraton', 'Basketball', 'Monday 02:00 PM', 'accepted', '2024-12-07 19:46:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `username`) VALUES
(3, 'nourhan2712@gmail.com', '$2b$12$UF7PyijJjLYJMs7k3NVb3O4hqC5YUZKumcuQA9A83XSZIWJnbLua2\r\n.', 'Nourhan Muhammad'),
(4, 'nourhan2712@gmail.com', '$2b$12$UF7PyijJjLYJMs7k3NVb3O4hqC5YUZKumcuQA9A83XSZIWJnbLua2', 'Nourhan Muhammad');

-- --------------------------------------------------------

--
-- Table structure for table `trainer_applications`
--

CREATE TABLE `trainer_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `sport` varchar(255) DEFAULT NULL,
  `day_time` varchar(255) DEFAULT NULL,
  `certificate` varchar(255) DEFAULT NULL,
  `state` varchar(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer_applications`
--

INSERT INTO `trainer_applications` (`id`, `user_id`, `username`, `email`, `location`, `sport`, `day_time`, `certificate`, `state`) VALUES
(1, 9, 'aml el gedawey', 'amlhatem@gmail.com', 'New Cairo', 'Squash', 'Monday 02:00 PM - 04:00 PM', 'AI.pdf', 'accepted'),
(2, 9, 'aml el gedawey', 'amlhatem@gmail.com', 'Sheraton', 'Squash', 'Monday 02:00 PM', 'AI.pdf', 'denied'),
(3, 9, 'aml el gedawey', 'amlhatem@gmail.com', 'Nasr City', 'Squash', 'Monday 05:00 PM', 'Ai lec 4.pdf', 'accepted'),
(4, 9, 'aml el gedawey', 'amlhatem@gmail.com', 'Sheraton', 'Basketball', 'Monday 02:00 PM', 'WhatsApp Image 2024-04-23 at 8.29.11 PM.pdf', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `reserved` tinyint(5) DEFAULT NULL COMMENT 'default:0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `reserved`) VALUES
(2, 'randakhaled@gmail.com', '$2y$10$yEkLyz5q6Uc1kcwj3c60euT2a2PNVtqnPNavPniBiUcYyW.azr/Vi', 'Randa Khaled ', NULL),
(5, 'youssifhussien@gmail.com', '$2y$10$hbIlBH5RPLcvo7BJrpLFNulFoHsp17Ycue3Nps.2lUggtp.M9Yt7e', 'Youssef Hussien', NULL),
(7, 'tarek@gmail.com', '$2y$10$jTp9rOPDJcS0jQB.NSzltuWHcH16VsYfPrk1X5FPwI3.Pw86XjZWy', 'tarek mostafa', NULL),
(8, 'amlelgedawey@gmail.com', '$2y$10$e8Ojtmgd.bI.DdOoBbZu2OY3QLgQxDHkU17z0souf1BOQRm5ji9uy', 'amlhatem', NULL),
(9, 'amlhatem@gmail.com', '$2y$10$dWsV4n9k5b9.QkqzKRlefOTebTralXbkjEkxwpA7Yz0MQEpzB97TW', 'aml el gedawey', NULL),
(10, 'randa2004@gmail.com', '$2y$10$uieJBclFaCrCIqSppMNCY.klhUHOjP3lSv.dWLqvjyTJ4L5bzVAX6', 'Randa Khaled', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepted_trainers`
--
ALTER TABLE `accepted_trainers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`,`email`);

--
-- Indexes for table `trainer_applications`
--
ALTER TABLE `trainer_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accepted_trainers`
--
ALTER TABLE `accepted_trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trainer_applications`
--
ALTER TABLE `trainer_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accepted_trainers`
--
ALTER TABLE `accepted_trainers`
  ADD CONSTRAINT `accepted_trainers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `trainer_applications`
--
ALTER TABLE `trainer_applications`
  ADD CONSTRAINT `trainer_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
