-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2020 at 02:05 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `youtube_embed`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `email`, `password`) VALUES
('zawad', 'zawad@admin.io', '9df3b01c60df20d13843841ff0d4482c');

-- --------------------------------------------------------

--
-- Table structure for table `private_stats`
--

CREATE TABLE `private_stats` (
  `id` varchar(40) NOT NULL,
  `like_count` int(11) NOT NULL,
  `dislike_count` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `comment_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `private_stats`
--

INSERT INTO `private_stats` (`id`, `like_count`, `dislike_count`, `view_count`, `comment_count`) VALUES
('AjA68t4IGqk', 2085, 55, 78217, 330),
('CPWrfDNabMg', 234, 6, 7705, 22),
('Fd8en6aOSIc', 819, 15, 74099, 44),
('irVZV0R5eLk', 333, 13, 24660, 93),
('tr_QSWBJFzY', 612, 11, 39960, 23),
('uWk9tjnXc6Y', 624, 40, 33761, 60);

-- --------------------------------------------------------

--
-- Table structure for table `public_stats`
--

CREATE TABLE `public_stats` (
  `id` varchar(40) NOT NULL,
  `like_count` int(11) NOT NULL,
  `dislike_count` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `comment_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `public_stats`
--

INSERT INTO `public_stats` (`id`, `like_count`, `dislike_count`, `view_count`, `comment_count`) VALUES
('7ARFyrM6gVs', 219750, 6685, 24867956, 4960),
('azvR__GRQic', 102885, 6643, 11802040, 12541),
('eaW0tYpxyp0', 179505, 3297, 30596393, 23559),
('hA6hldpSTF8', 3265325, 51033, 99963848, 295930),
('jxmwtfqYZfA', 5718, 314, 213224, 529),
('KYhJZu_dcVE', 27746, 1749, 4082564, 2145),
('RGJ-8zxWm7s', 4613, 321, 189674, 323),
('W9oHf-u5b68', 3138, 68, 106115, 40);

-- --------------------------------------------------------

--
-- Table structure for table `public_view`
--

CREATE TABLE `public_view` (
  `id` varchar(30) NOT NULL,
  `like_count` int(11) NOT NULL,
  `dislike_count` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `comment_count` int(11) NOT NULL,
  `commenter` varchar(40) NOT NULL,
  `cor_comments` text NOT NULL,
  `replier` varchar(40) NOT NULL,
  `cor_replies` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `username` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`username`, `email`, `password`) VALUES
('fahim', 'fahim@hja.com', '3474fa07b4b9328f9f5efaa11fa4b0bc'),
('jami', 'jami@yj.lo', 'c8b3f5cc93013adfb0cc205e17b4ba14'),
('kaka', 'magic@skills.com', 'dc79e52682639c53c5b46a24094fdace'),
('smith', 'quirky@best.com', 'fc8baa6879e639926be3916810962e13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `private_stats`
--
ALTER TABLE `private_stats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `public_stats`
--
ALTER TABLE `public_stats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
