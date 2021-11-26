-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 26, 2021 at 10:58 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newblog6`
--

-- --------------------------------------------------------

--
-- Table structure for table `wlv_blogs`
--

CREATE TABLE `wlv_blogs` (
  `id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `content` text,
  `published` varchar(1) DEFAULT '0',
  `topicId` int NOT NULL,
  `userId` int NOT NULL,
  `createdAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wlv_comments`
--

CREATE TABLE `wlv_comments` (
  `id` int NOT NULL,
  `comment` text,
  `userId` int NOT NULL,
  `blogId` int NOT NULL,
  `parent` varchar(16000) DEFAULT NULL,
  `createdAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wlv_likes`
--

CREATE TABLE `wlv_likes` (
  `id` int NOT NULL,
  `val` int DEFAULT '0',
  `userId` int NOT NULL,
  `blogId` int NOT NULL,
  `parent` varchar(16000) DEFAULT NULL,
  `createdAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wlv_likes_comments`
--

CREATE TABLE `wlv_likes_comments` (
  `id` int NOT NULL,
  `val` int DEFAULT '0',
  `userId` int NOT NULL,
  `commentId` int NOT NULL,
  `createdAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wlv_topic`
--

CREATE TABLE `wlv_topic` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `createdAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wlv_users`
--

CREATE TABLE `wlv_users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `admin` tinyint DEFAULT '0',
  `password` text NOT NULL,
  `createdAT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wlv_blogs`
--
ALTER TABLE `wlv_blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topicId` (`topicId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `wlv_comments`
--
ALTER TABLE `wlv_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `blogId` (`blogId`);

--
-- Indexes for table `wlv_likes`
--
ALTER TABLE `wlv_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `blogId` (`blogId`);

--
-- Indexes for table `wlv_likes_comments`
--
ALTER TABLE `wlv_likes_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `commentId` (`commentId`);

--
-- Indexes for table `wlv_topic`
--
ALTER TABLE `wlv_topic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wlv_users`
--
ALTER TABLE `wlv_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wlv_blogs`
--
ALTER TABLE `wlv_blogs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wlv_comments`
--
ALTER TABLE `wlv_comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wlv_likes`
--
ALTER TABLE `wlv_likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wlv_likes_comments`
--
ALTER TABLE `wlv_likes_comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wlv_topic`
--
ALTER TABLE `wlv_topic`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wlv_users`
--
ALTER TABLE `wlv_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wlv_blogs`
--
ALTER TABLE `wlv_blogs`
  ADD CONSTRAINT `wlv_blogs_ibfk_1` FOREIGN KEY (`topicId`) REFERENCES `wlv_topic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wlv_blogs_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `wlv_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wlv_comments`
--
ALTER TABLE `wlv_comments`
  ADD CONSTRAINT `wlv_comments_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `wlv_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wlv_comments_ibfk_2` FOREIGN KEY (`blogId`) REFERENCES `wlv_blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wlv_likes`
--
ALTER TABLE `wlv_likes`
  ADD CONSTRAINT `wlv_likes_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `wlv_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wlv_likes_ibfk_2` FOREIGN KEY (`blogId`) REFERENCES `wlv_blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wlv_likes_comments`
--
ALTER TABLE `wlv_likes_comments`
  ADD CONSTRAINT `wlv_likes_comments_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `wlv_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wlv_likes_comments_ibfk_2` FOREIGN KEY (`commentId`) REFERENCES `wlv_comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;