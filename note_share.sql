-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2021 at 09:56 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `note_share`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `users_id` int(10) UNSIGNED NOT NULL,
  `notes_id` int(10) UNSIGNED NOT NULL,
  `favorites_id` int(20) UNSIGNED NOT NULL,
  `favorites_liked` tinyint(1) NOT NULL DEFAULT 0,
  `favorites_disliked` tinyint(1) NOT NULL DEFAULT 0,
  `favorites_favorited` tinyint(1) NOT NULL DEFAULT 0,
  `favorites_rated` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `users_id` int(10) UNSIGNED NOT NULL,
  `notes_id` int(10) UNSIGNED NOT NULL,
  `notes_name` varchar(50) NOT NULL,
  `notes_course_number` varchar(5) NOT NULL,
  `notes_course_name` varchar(50) NOT NULL,
  `notes_teacher` varchar(50) NOT NULL,
  `notes_year` int(4) NOT NULL,
  `notes_season` tinyint(1) UNSIGNED NOT NULL,
  `notes_likes` int(20) DEFAULT NULL,
  `notes_dislikes` int(20) DEFAULT NULL,
  `notes_favorites` int(20) DEFAULT NULL,
  `notes_rating` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`users_id`, `notes_id`, `notes_name`, `notes_course_number`, `notes_course_name`, `notes_teacher`, `notes_year`, `notes_season`, `notes_likes`, `notes_dislikes`, `notes_favorites`, `notes_rating`) VALUES
(1, 1, 'Software Engineering II Chapter 14', 'CS356', 'Computer Science', 'Dr. Sparks', 2021, 1, NULL, NULL, NULL, NULL),
(1, 2, 'Software Engineering II Chapter 15', 'CS356', 'Computer Science', 'Dr. Sparks', 2021, 1, NULL, NULL, NULL, NULL),
(1, 3, 'Software Engineering II Chapter 16', 'CS356', 'Computer Science', 'Dr. Sparks', 2021, 1, NULL, NULL, NULL, NULL),
(1, 4, 'Software Engineering II Chapter 17', 'CS356', 'Computer Science', 'Dr. Sparks', 2021, 1, NULL, NULL, NULL, NULL),
(1, 5, 'Software Engineering II Chapter 19', 'CS356', 'Computer Science', 'Dr. Sparks', 2021, 1, NULL, NULL, NULL, NULL),
(1, 6, 'Software Engineering II Chapter 20', 'CS356', 'Computer Science', 'Dr. Sparks', 2021, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(10) UNSIGNED NOT NULL,
  `users_email` varchar(50) NOT NULL,
  `users_name` varchar(50) NOT NULL,
  `users_password` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_email`, `users_name`, `users_password`) VALUES
(1, 'hotwheeljets@hotmail.com', 'Damon', '$2y$10$5frDtIgAvYkP/ZGkGwW1d.ifzzG6GZ8Go.A8tRFXkz60lW1tXdo9.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorites_id`),
  ADD UNIQUE KEY `users_id` (`users_id`,`notes_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`notes_id`),
  ADD UNIQUE KEY `users_id` (`users_id`,`notes_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorites_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `notes_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
