-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 30, 2024 at 11:14 AM
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
-- Database: `trainerfinder`
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
(3, 9, 'aml el gedawy', 'amlhatem@gmail.com', 'WhatsApp Image 2024-04-23 at 8.29.11 PM.pdf', 'Sheraton', 'Basketball', 'Monday 02:00 PM', 'accepted', '2024-12-07 19:46:32', NULL);

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
(5, 'nourhan@gamil.com', '$2b$12$UF7PyijJjLYJMs7k3NVb3O4hqC5YUZKumcuQA9A83XSZIWJnbLua2', 'Nourhan Muhammad');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `sub_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='relation between user and trainer';

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
(7, 'tarek122@gmail.com', '$2y$10$jTp9rOPDJcS0jQB.NSzltuWHcH16VsYfPrk1X5FPwI3.Pw86XjZWy', 'tarek Mostafa', NULL),
(8, 'amlelgedawey@gmail.com', '$2y$10$e8Ojtmgd.bI.DdOoBbZu2OY3QLgQxDHkU17z0souf1BOQRm5ji9uy', 'amlhatem', NULL),
(9, 'amlhatem@gmail.com', '$2y$10$dWsV4n9k5b9.QkqzKRlefOTebTralXbkjEkxwpA7Yz0MQEpzB97TW', 'aml el gedawey', NULL),
(10, 'randa2004@gmail.com', '$2y$10$uieJBclFaCrCIqSppMNCY.klhUHOjP3lSv.dWLqvjyTJ4L5bzVAX6', 'Randa Khaled', NULL),
(12, 'mmm@gmail.com', '$2y$10$LDTMgyZ5z4s9SMfe6g0.i.FAvGxrgV.CjELwb4xC4Viak6MEZCxyO', 'mmm', NULL),
(13, 'randakhaled@gmail.com', '$2y$10$ZC/cUGe.5MFhau.LjN6V7.wHo3R5XsekwOWaruoEYWPPctza5NYxq', 'Randa Khaled', NULL),
(14, 'ss@gmail.com', '$2y$10$xkqqi4y70zBX9UFqDLnuA.SwY3dB.YSlZQm/uWp7VaAp00uyYhwSS', 'ss', NULL),
(15, 'urdad@email.com', '$2y$10$jefVY.6iPO7g4m6nU0/j1.g14ZLzDzArVtLSObmRE7J7zNYeRWena', 'urdad', NULL);

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
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `sub_id_2` (`sub_id`,`trainer_id`,`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `trainer_id` (`trainer_id`);

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
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id` (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainer_applications`
--
ALTER TABLE `trainer_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accepted_trainers`
--
ALTER TABLE `accepted_trainers`
  ADD CONSTRAINT `accepted_trainers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD CONSTRAINT `subscribe_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscribe_ibfk_2` FOREIGN KEY (`trainer_id`) REFERENCES `accepted_trainers` (`id`);

--
-- Constraints for table `trainer_applications`
--
ALTER TABLE `trainer_applications`
  ADD CONSTRAINT `trainer_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
