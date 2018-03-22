-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2018 at 01:16 AM
-- Server version: 5.7.21-log
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twitter`
--

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `following` int(11) NOT NULL,
  `follower` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `following`, `follower`) VALUES
(39, 5, 7),
(41, 7, 8),
(45, 8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `tweets` text NOT NULL,
  `userid` int(11) NOT NULL,
  `dateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`id`, `tweets`, `userid`, `dateTime`) VALUES
(2, 'First tweet!', 6, '2018-03-03 15:15:33'),
(4, 'First tweet!', 6, '2018-03-03 01:15:38'),
(5, 'Hey, this is amazing!', 5, '2018-03-03 21:07:16'),
(7, 'Life\'s good!', 7, '2018-03-05 19:37:28'),
(8, 'This is working!', 7, '2018-03-05 19:41:16'),
(9, 'I hope this works!', 7, '2018-03-05 20:36:45'),
(10, 'I hope this works!', 7, '2018-03-05 20:36:53'),
(11, 'Tada!', 7, '2018-03-05 20:37:48'),
(17, 'My first tweet!', 8, '2018-03-06 02:26:17'),
(18, 'Life\'s a bit dull these days!', 5, '2018-03-09 22:09:49'),
(19, 'hii there.', 5, '2018-03-12 11:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, 'Darshan', 'Majithiya', 'darsh@gmail.com', '1234'),
(5, 'Darshan', 'Majithiya', 'darsh26@gmail.com', '$2y$12$01wHAhSX.Mwp30M.8IejmePYXdmSa8HG9C6PWb8ixI5YIjbjJUIDK'),
(6, 'Darshan', 'Majithiya', 'darsh2115@gmail.com', '$2y$12$gNoUcZgu.pRGVqKa73fKh.z9dcG8NqsX.uYbCxzDLP4E7rRRlXgcm'),
(7, 'Aakash', 'Majithiya', 'aakash@gmail.com', '$2y$12$afjAd/uz6jzWjfcj58CFCeyHaPUGqZma2gDfJT97SjjhJG0o8Bu.G'),
(8, 'Harsh', 'Thakker', 'harsh@gmail.com', '$2y$12$M8pmZbNP98JXdOWiu4/yuOasabhRliNlDPiVH0/orA4Kci9X9N2VG'),
(9, 'Rohan', 'Maheshwari', 'rohan@gmail.com', '$2y$12$yoarpLLHijjR4ZCQKg.IruyR2DVRTC/1Mu08ero91enqzQtlK7E.6'),
(10, 'Yash', 'Rajgor', 'Yash@gmail.com', '$2y$12$LvPlEdRCF1PbTOlCc0dfp.aZiloHbHsegQA3EK8soW6Y6eVX.iBWG'),
(11, 'Vandit ', 'Mehta', 'vandit@gmail.com', '$2y$12$8DOVJZ9LKZDfqJRvQ454K.ANeZ1cCF5nuHnPINL5NHKTXF0ZEVUrW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
