-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2025 at 02:04 AM
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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `room_id`, `user_id`, `content`, `created_at`) VALUES
(25, 18, 10, 'hello', '2025-08-03 22:10:29'),
(26, 18, 1, 'hi', '2025-08-04 07:04:27'),
(27, 18, 1, 'how are you', '2025-08-04 07:04:32'),
(28, 22, 1, 'hi', '2025-08-04 20:16:24'),
(29, 18, 10, 'i\'m fine', '2025-08-08 08:27:29'),
(30, 18, 10, 'lets learn together', '2025-08-08 08:27:39'),
(31, 18, 17, 'hi', '2025-08-14 23:05:42'),
(32, 29, 17, 'welcome', '2025-08-14 23:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `topic` varchar(250) NOT NULL,
  `host` int(11) NOT NULL,
  `members_count` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `topic`, `host`, `members_count`, `description`, `created_date`, `views`) VALUES
(18, 'Lets learn Python', 'Python', 1, 23, 'value=\" \"', '2025-08-03 18:15:50', 0),
(20, '100 Days of java', 'Java', 11, 10, ' join the java community!', '2025-08-03 22:07:42', 0),
(21, 'Spring Devs', 'Java', 11, 10, 'lets Smash the spring!', '2025-08-03 22:09:17', 0),
(22, 'Community of webDevs', 'WebDev', 10, 25, ' ', '2025-08-03 22:11:42', 1),
(29, 'React ', 'WebDev', 17, 20, ' ', '2025-08-14 23:06:33', 0);

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
(18, 1),
(20, 11),
(21, 11),
(18, 10),
(22, 10),
(22, 1),
(18, 17),
(29, 17),
(20, 1);

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
  `password` varchar(250) NOT NULL,
  `username` varchar(100) NOT NULL,
  `profile_pic` longblob NOT NULL,
  `role` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `username`, `profile_pic`, `role`) VALUES
(1, 'mjasan9@gmail.com', '$2y$10$leF5whZtNflBcffFYEYIAeT3OHaFiJxk94cAjkew61kjT.nHAWy.m', 'Aj. Jasan', 0x66646566363939612d623166312d346334632d383831382d3761663535323638333033632e6a7067, 'user'),
(10, 'kumar@gmail.com', '$2y$10$leF5whZtNflBcffFYEYIAeT3OHaFiJxk94cAjkew61kjT.nHAWy.m', 'kumar', '', 'user'),
(11, 'erick@gmail.com', '$2y$10$aPEJWJ5hWW.LAJGkvd5M/O5Fxuyxs0A/d7Q/uZiJyvNKWp/Jg7m3q', 'Erick', 0x6c65747465722d652e706e67, 'user'),
(13, 'admin@gmail.com', '$2y$10$eYsKz7XBfna6rQKP4iloo.E30cjL9MEdcELqf9/LGvmZYDT8Dlnjm', 'Admin', 0x776f726c642d646f63746f722d6461795f313035393432332d3339342e6a7067, 'admin'),
(17, 'example@gmail.com', '$2y$10$Bf0TYExB8DpLJuM9STpEauzcNjN97dkWIazC5qpPihLLQyWvIT4P6', 'user1', 0x4f4950202831292e77656270, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `host` (`host`);

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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`host`) REFERENCES `user` (`id`) ON DELETE CASCADE;

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
