-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2024 at 11:21 PM
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
-- Database: `uiu_cc`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `dp_url` text NOT NULL DEFAULT 'uploads/user.png',
  `student_id` varchar(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dept` enum('CSE','EEE','CE','ECO','BBA') NOT NULL,
  `major` varchar(255) DEFAULT NULL,
  `thesis_domain` varchar(255) DEFAULT NULL,
  `profile_description` text DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `interests` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `dp_url`, `student_id`, `name`, `email`, `dept`, `major`, `thesis_domain`, `profile_description`, `skills`, `interests`, `created_at`, `password`) VALUES
(1, 'uploads/user.png', '011212057', 'Mohammad Abu Obaida Mullick', 'mmullick212057@bscse.uiu.ac.bd', 'CSE', 'Data Science', 'ML, DL, DIP, LLM, SD', 'Passionate coder with an interest in AI and HCI.', 'C, Python, Java, HTML, CSS, PHP', 'Machine Learning, Human Machine Relation', '2024-09-16 04:00:04', 'asd'),
(7, 'uploads/MOSHED-2023-2-13-0-32-26.gif', '011212001', 'Adnan', 'mohammadabuobaidamullick@gmail.com', 'CSE', NULL, NULL, NULL, NULL, NULL, '2024-09-16 13:56:31', 'asd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
