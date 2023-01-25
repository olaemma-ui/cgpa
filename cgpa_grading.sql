-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2023 at 11:40 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cgpa_grading`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `admin_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `admin_id`) VALUES
(1, 'olaemma4213', 'cc9c85a32a3d03666173bd30d02ab5cd6eb9f810', 'cc9c85a32a3d036');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_title` text NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_id` varchar(200) NOT NULL,
  `course_unit` int(11) NOT NULL,
  `level` varchar(500) NOT NULL,
  `semester` int(11) NOT NULL,
  `sessionId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gradepoint`
--

CREATE TABLE `gradepoint` (
  `id` int(11) NOT NULL,
  `stdId` varchar(500) NOT NULL,
  `first` double NOT NULL,
  `second` double NOT NULL,
  `third` double NOT NULL,
  `fourth` double NOT NULL,
  `cgpa` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gradepoint`
--

INSERT INTO `gradepoint` (`id`, `stdId`, `first`, `second`, `third`, `fourth`, `cgpa`) VALUES
(1, '8f019c518f93bab19664d98f34e403b7556b01f1', 2, 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `sessionId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `session`, `sessionId`) VALUES
(1, '2019', '0987654321');

-- --------------------------------------------------------

--
-- Table structure for table `std_score`
--

CREATE TABLE `std_score` (
  `id` int(11) NOT NULL,
  `stdID` varchar(200) NOT NULL,
  `courseID` varchar(200) NOT NULL,
  `score` int(11) NOT NULL,
  `semester` char(1) NOT NULL,
  `level` varchar(200) NOT NULL,
  `scoreID` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `matric` varchar(10) NOT NULL,
  `std_name` text NOT NULL,
  `level` varchar(500) NOT NULL,
  `stdId` varchar(255) DEFAULT NULL,
  `sessionId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `course_code` (`course_code`),
  ADD UNIQUE KEY `id_2` (`id`);

--
-- Indexes for table `gradepoint`
--
ALTER TABLE `gradepoint`
  ADD PRIMARY KEY (`stdId`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`sessionId`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `session` (`session`),
  ADD UNIQUE KEY `sessionId` (`sessionId`);

--
-- Indexes for table `std_score`
--
ALTER TABLE `std_score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`matric`),
  ADD UNIQUE KEY `matric` (`matric`),
  ADD UNIQUE KEY `stdID` (`stdId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gradepoint`
--
ALTER TABLE `gradepoint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
