-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2022 at 06:26 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `reciever_id`, `message`, `created_at`) VALUES
(1, 1, 2, 'This is a test script to run', '2022-10-04 06:38:02'),
(2, 2, 1, 'This is also a test script before deployment to aws', '2022-10-04 06:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `profilepic` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_title`, `post_description`, `user_id`, `profilepic`, `created_at`) VALUES
(1, 'Blockchain Technology', 'This is a post about a distributed block chain system', 1, 'd41d8cd98f00b204e9800998ecf8427e1664690238.jpg', '2022-10-02 06:57:18'),
(3, 'VR Technology', 'Application of Virtual reality into the live streaming services', 2, 'd41d8cd98f00b204e9800998ecf8427e1664690457.jpg', '2022-10-02 07:00:57'),
(4, 'AI in Cyber Security', 'this is a project base security system', 3, 'd41d8cd98f00b204e9800998ecf8427e1664691885.jpg', '2022-10-02 07:24:45'),
(6, 'Software Engineer With VR', 'This is software engineering with a vr technology to treamline the process of live streaming application', 2, 'd41d8cd98f00b204e9800998ecf8427e1664692246.jpg', '2022-10-02 07:30:46'),
(8, 'Cloud Computing', 'What is cloud computing engineering', 4, 'd41d8cd98f00b204e9800998ecf8427e1664728532.jpg', '2022-10-02 17:35:32'),
(9, 'Mobile App', 'Mobile app development using react native and node.js server for the backend.', 4, 'd41d8cd98f00b204e9800998ecf8427e1664817964.jpg', '2022-10-03 18:26:04'),
(10, 'distributed machine learning', 'this is also worth knowing in the institution', 1, 'd41d8cd98f00b204e9800998ecf8427e1664863156.jpg', '2022-10-04 06:59:16'),
(11, 'distributed system', 'Lets talk about distributed system with scalability.', 3, 'd41d8cd98f00b204e9800998ecf8427e1664899600.jpg', '2022-10-04 17:06:40'),
(12, 'Programming', 'programming web technology is a very good venture capital intensive for early startups', 1, 'd41d8cd98f00b204e9800998ecf8427e1664899946.jpg', '2022-10-04 17:12:26'),
(13, 'Software Machine', 'algorithm for distributing load across cluster of servers', 3, 'd41d8cd98f00b204e9800998ecf8427e1664900123.jpg', '2022-10-04 17:15:23'),
(14, 'system design', 'what is CAP Theorem.', 2, 'd41d8cd98f00b204e9800998ecf8427e1664900198.jpg', '2022-10-04 17:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `image`, `created_at`) VALUES
(1, 'kateJacob', '$2y$10$LcVzDu.lJDpDFFLk7.5HB.hneieJunyYYB/XFWebmFWK2VrRnykJC', 'd41d8cd98f00b204e9800998ecf8427e1664693486.jpg', '2022-10-02 06:51:34'),
(2, 'JacobServerSide', '$2y$10$HUzsee58UxHft0Pu/zyS7OOZH/de.bGwlHAQXtnzwAivWonj9G5BC', 'd41d8cd98f00b204e9800998ecf8427e1664690372.jpg', '2022-10-02 06:58:45'),
(3, 'FelixChucks', '$2y$10$ti2dtH4Hro3ghAuVIyHB6Oz/dehNV.SfprCXUb/eutqn15GtDdwy.', 'd41d8cd98f00b204e9800998ecf8427e1664691834.jpg', '2022-10-02 07:22:44'),
(4, 'affluentJacob', '$2y$10$SNq8qCui/1sqJ8Gkc.9rXe0M40Ue8hjJc5AXDQeFmr/AxTP1bEtM6', 'd41d8cd98f00b204e9800998ecf8427e1664702628.jpg', '2022-10-02 10:22:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
