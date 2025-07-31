-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2025 at 12:20 PM
-- Server version: 11.8.2-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qspace`
--

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `topic` varchar(250) NOT NULL,
  `host` varchar(250) NOT NULL,
  `members_count` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `topic`, `host`, `members_count`, `description`, `created_date`) VALUES
(1, 'Lets Learn python', 'Python', 'jasan', 20, '', '2025-07-24 00:00:00'),
(2, '100 days of Java', 'Java', 'kumar', 20, '', '2025-07-24 00:00:00'),
(3, 'Jans room', 'support', 'user1', 2, '', '2025-07-25 10:37:23'),
(5, 'test 2', 'WebDev', 'user1', 5, '', '2025-07-25 15:39:01'),
(6, 'Study at ICST', 'Java', 'Aashik sir', 10, '', '2025-07-28 12:18:19'),
(7, 'Group For Discuss', 'Java', 'Jasan', 3, '', '2025-07-29 00:10:52'),
(8, 'example', 'Django', 'Jasan', 20, '', '2025-07-31 11:51:07'),
(9, 'parc', 'Python', 'Jasan', 3, '', '2025-07-31 13:52:25'),
(10, 'sdsd', 'Java', 'Jasan', 32, '', '2025-07-31 13:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `room_members`
--

CREATE TABLE `room_members` (
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_members`
--

INSERT INTO `room_members` (`room_id`, `user_id`) VALUES
(1, 1),
(3, 1),
(2, 1),
(1, 5),
(8, 1),
(7, 1),
(7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `name` varchar(100) NOT NULL,
  `created_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`name`, `created_by`) VALUES
('Python', 'admin'),
('Java', 'admin'),
('Django', 'admin'),
('WebDev', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `username`) VALUES
(1, 'mjasan9@gmail.com', '12345678', 'Jasan'),
(2, 'user@gmail.com', '12345678', 'kumar'),
(4, 'jasan@gmail.com', '$2y$10$XeQEbIDjOQsJy0tUS/4/LOnDJx8amtJsp.Z0esnxzNa', 'Max'),
(5, 'user1@gmail.com', '12345678', 'Aashik sir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_members`
--
ALTER TABLE `room_members`
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `room_members`
--
ALTER TABLE `room_members`
  ADD CONSTRAINT `room_members_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `room_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
