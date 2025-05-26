-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 30, 2024 at 01:10 PM
-- Server version: 10.11.6-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u935321349_note`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `note` varchar(1000) NOT NULL,
  `pdffile` text NOT NULL,
  `public` int(11) NOT NULL,
  `report` int(11) NOT NULL,
  `time_in` varchar(50) NOT NULL,
  `last_updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `user_ID`, `title`, `note`, `pdffile`, `public`, `report`, `time_in`, `last_updated_at`) VALUES
(6, 1, 'Momentum', 'Momentum is a commonly used term in sports. A team that has the momentum is on the move and is going to take some effort to stop. A team that has a lot of momentum is really on the move and is going to be hard to stop. Momentum is a physics term; it refers to the quantity of motion that an object has. A sports team that is on the move has the momentum. If an object is in motion (on the move) then it has momentum.\r\n\r\nMomentum can be defined as \"mass in motion.\" All objects have mass; so if an object is moving, then it has momentum - it has its mass in motion. The amount of momentum that an object has is dependent upon two variables: how much stuff is moving and how fast the stuff is moving. Momentum depends upon the variables mass and velocity. In terms of an equation, the momentum of an object is equal to the mass of the object times the velocity of the object.', '', 0, 0, '10:15:08pm', '2021-09-02 01:02:43'),
(7, 1, 'Cohesive Force', 'Excel is a spreadsheet program that allows you to store, organize, and analyze information. While you may think Excel is only used by certain people to process complicated data, anyone can learn how to take advantage of the program\'s powerful features. Whether you\'re keeping a budget, organizing a training log, or creating an invoice, Excel makes it easy to work with different types of data.', '', 0, 0, '12:11:04am', '2021-09-02 00:54:34'),
(9, 3, 'TEST', 'TESING ', '', 0, 0, '06:04:52pm', '2024-01-27 23:35:59'),
(11, 3, 'TEST PUBLIC', 'TEST PUBLICK 1 2', '', 0, 0, '06:23:18pm', '2024-01-28 07:40:37'),
(23, 3, 'ghhss', 'dpf', '', 0, 0, '07:54:01pm', '0000-00-00 00:00:00'),
(30, 3, 'pdf', 'pdf', 'definingcomputerscience.pdf', 2, 0, '08:08:54pm', '0000-00-00 00:00:00'),
(34, 3, 'This is Vipin', 'Hello', '', 2, 0, '05:11:04am', '0000-00-00 00:00:00'),
(35, 3, 'This is Vipin', 'Hello', '', 2, 0, '05:11:08am', '0000-00-00 00:00:00'),
(36, 5, 'Sample 1', 'Hey this is Harve Suvala,\r\nI am a Student Pursuing B.Tech in computer science and engineering from GLS University FCAIT', '', 2, 0, '05:50:51am', '0000-00-00 00:00:00'),
(38, 10, 'note', 'test', 'Screen_recording_20240129_103312.mp4', 1, 0, '07:55:37am', '0000-00-00 00:00:00'),
(39, 1, 'hey', 'This Harve Suvala,\r\nfrom larlin cryogenics our product is of cryogenics valves, tanks, heat exchanger.\r\nIt\'s a simple product to store, liquified gases', 'Screenshot 2023-09-03 124749.png', 1, 1, '12:42:54pm', '0000-00-00 00:00:00'),
(40, 3, 'Image', 'image', 'log.jpg', 2, 0, '06:48:06am', '0000-00-00 00:00:00'),
(41, 3, 'Video', 'Video', 'Sunn Raha Hai Na Tu - Aashiqui 2_HD-(PagalWorld.video).mp4', 2, 0, '07:36:54am', '0000-00-00 00:00:00'),
(42, 10, 'Test Note', 'This one for review', 'Screen_recording_20240129_103312.mp4', 2, 0, '08:47:24am', '0000-00-00 00:00:00'),
(43, 10, 'Test Note', 'This one for review', 'Screen_recording_20240129_103312.mp4', 1, 0, '08:47:59am', '0000-00-00 00:00:00'),
(44, 1, 'Gls', 'Stuti godi', '', 0, 0, '09:00:42am', '0000-00-00 00:00:00'),
(45, 1, 'Gls', 'Stuti godi', '', 0, 0, '09:02:27am', '0000-00-00 00:00:00'),
(46, 1, 'Gls', 'Stuti godi', '', 0, 0, '09:03:24am', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `user_ID` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_ID`, `user_type`, `fullName`, `email`, `password`) VALUES
(1, 1, 'Admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 0, 'Ram', 'r@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 0, 'saroj', 's@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 0, 'Test', 'test@c.m', 'e713ac3f1878db58de9dd37f6eb0aa5f'),
(5, 0, 'Harve Suvala', 'harvesuvala08@gmail.com', '0a92e4e166906e6eb35c6945d11cc0e7'),
(6, 0, 'Stuti', 'stutiraval6215@gmail.com', '7993f333c83a07c9d5d28fcaa53adace'),
(7, 0, 'stavan', 'stavanraval@gmail.com', '7028d2e2eb69459003bb3f8815f9634a'),
(9, 0, 'Janvi', 'janvi@gmail.com', 'e697252866040ba12fd63992b339340d'),
(10, 0, 'test@g.com', 'test@123.com', 'f925916e2754e5e03f75dd58a5733251'),
(11, 0, 'Janvi', 'janvikoladiya@gmail.com', 'f5465422c5c73f66273df80f628440c8'),
(12, 0, 'Janvi koladiya', 'janvi12@gmail.com', 'e0b8ac4e49729670269ae2fd3ee99c2b');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `userid` text NOT NULL,
  `review` text NOT NULL,
  `stars` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `userid`, `review`, `stars`, `date`) VALUES
(1, '3', 'TEST', 5, '0000-00-00 00:00:00'),
(2, '2', 'Very Good', 5, '0000-00-00 00:00:00'),
(3, '12', 'this web app could be more better', 1, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;