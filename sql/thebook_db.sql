-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2020 at 09:06 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thebook_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `from_userid` bigint(20) NOT NULL,
  `to_userid` bigint(20) NOT NULL,
  `requested` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `from_userid`, `to_userid`, `requested`) VALUES
(56, 55254617640577, 57575060199, 2),
(57, 57575060199, 55254617640577, 2),
(58, 93826415, 57575060199, 2),
(59, 57575060199, 93826415, 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(19) NOT NULL,
  `postid` bigint(19) NOT NULL,
  `userid` bigint(19) NOT NULL,
  `post` text NOT NULL,
  `image` varchar(500) NOT NULL,
  `comments` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `has_image` tinyint(1) NOT NULL,
  `guestid` bigint(19) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `postid`, `userid`, `post`, `image`, `comments`, `likes`, `date`, `has_image`, `guestid`) VALUES
(84, 897110156, 55254617640577, 'Henry\'s post on Henry\'s profile , no image', '', 0, 0, '2020-07-30 06:41:11', 0, 0),
(85, 567668726, 55254617640577, 'Henry\'s post on Henry\'s profile with image', '../uploads/post_photos/post6.jpg', 0, 0, '2020-07-30 06:41:28', 1, 0),
(86, 1095286993, 57575060199, 'Henry\'s post on Tim\'s profile , no image', '', 0, 0, '2020-07-30 06:42:04', 0, 55254617640577),
(87, 5311430, 57575060199, 'Henry\'s post on Tim\'s profile with image', '../uploads/post_photos/post3.jpg', 0, 0, '2020-07-30 06:42:19', 1, 55254617640577),
(88, 7291741844910202, 57575060199, 'Tim\'s post on Tim\'s timeline , no image', '', 0, 0, '2020-07-30 06:47:58', 0, 0),
(89, 9223372036854775807, 57575060199, 'Tim\'s post on Tim\'s timeline , with image', '../uploads/post_photos/post5.jpg', 0, 0, '2020-07-30 06:48:13', 1, 0),
(90, 3255166, 55254617640577, 'Steve\'s post on Henry\'s profile no image', '', 0, 0, '2020-07-30 06:50:24', 0, 93826415),
(91, 73500854564, 55254617640577, 'Steve\'s post on Henry\'s profile with image', '../uploads/post_photos/post1.jpg', 0, 0, '2020-07-30 06:50:41', 1, 93826415);

-- --------------------------------------------------------

--
-- Table structure for table `preview_images`
--

CREATE TABLE `preview_images` (
  `id` int(11) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `preview_profile_image` varchar(1000) NOT NULL,
  `preview_cover_image` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `month_birth` varchar(15) NOT NULL,
  `day_birth` varchar(5) NOT NULL,
  `year_birth` varchar(6) NOT NULL,
  `url_address` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_image` varchar(1000) NOT NULL,
  `cover_image` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `first_name`, `last_name`, `gender`, `email`, `password`, `month_birth`, `day_birth`, `year_birth`, `url_address`, `date`, `profile_image`, `cover_image`) VALUES
(23, 55254617640577, 'Henry', 'Ta', 'Male', 'dta02@mylangara.ca', '$2y$10$CBzia42AeuKhl/GMxtxwtOTwbuHkx.LccvfllGyUv3zhHOGAKBb76', 'December', '19', '2008', 'henry.ta', '2020-07-30 06:40:50', '../uploads/profile_photos/profile3.jpg', '../uploads/cover_photos/cover1.jpg'),
(24, 57575060199, 'Tim', 'Hortons', 'Female', 'timhortons@gmail.com', '$2y$10$JDSsqAFAxejAxsy1J4OvrOhZajcSI0mb7Rbk4BbzSZ3mQfdNILiD2', 'December', '17', '2000', 'tim.hortons', '2020-07-30 06:48:40', '../uploads/profile_photos/profile1.jpg', '../uploads/cover_photos/cover3.jpg'),
(25, 93826415, 'Steve', 'Job', 'Male', 'stevejob@job.com', '$2y$10$3yDiKYr36PWITpwUUj2hvu/YVHG3zEhGrcH5DyntcubksRqNcmKTi', 'December', '19', '2008', 'steve.job', '2020-07-30 06:49:18', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date` (`date`),
  ADD KEY `postid` (`postid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `has_image` (`has_image`);
ALTER TABLE `posts` ADD FULLTEXT KEY `post` (`post`);

--
-- Indexes for table `preview_images`
--
ALTER TABLE `preview_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `gender` (`gender`),
  ADD KEY `email` (`email`),
  ADD KEY `month_birth` (`month_birth`),
  ADD KEY `day_birth` (`day_birth`),
  ADD KEY `year_birth` (`year_birth`),
  ADD KEY `url_address` (`url_address`),
  ADD KEY `date` (`date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `preview_images`
--
ALTER TABLE `preview_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
