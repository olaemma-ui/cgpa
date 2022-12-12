-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2022 at 11:38 PM
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
-- Database: `cgpa`
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
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_title`, `course_code`, `course_id`, `course_unit`, `level`, `semester`) VALUES
(4, 'Basic Hardware Mentainance', 'COM 222', '047e92c92042f3e195064778b424b1dd5964410b', 3, '2533d1069c3c1156de962c746fdac754d0bd2841', 1),
(2, 'Intro to computing', 'COM 228', '0a2385ee459f35ddfafc6672395a745e990dc71b', 3, '2533d1069c3c1156de962c746fdac754d0bd2841', 2),
(10, 'Q MATHA', 'COM 113', '2f158311d433d25a8c67b9370019cb3276ab62fa', 3, 'a87312cea7950ecb3817d25faccdb74c24f1a8cc', 1),
(8, 'WEB Development', 'COM 202', '46e6a7e853c440127785c3bf4ad98610911d56f3', 3, '2533d1069c3c1156de962c746fdac754d0bd2841', 1),
(7, 'SIWES', 'SIWES 111', '598cfd572fd2165507997711d73a4b4e3f0718db', 3, '2533d1069c3c1156de962c746fdac754d0bd2841', 1),
(9, 'Management Information System', 'COM 224', '5a6dfc76726f356020ea2d1931b9bb9d6220c4cc', 3, '2533d1069c3c1156de962c746fdac754d0bd2841', 2),
(5, 'OO JAVA', 'COM 212', '687de3a784f040f7fa109efc0e56d308728cb418', 3, '2533d1069c3c1156de962c746fdac754d0bd2841', 2),
(6, 'OO FORTRAN', 'COM 221', '8955ea734453a74a0390fcdcf48a4817e7fec7b4', 3, '2533d1069c3c1156de962c746fdac754d0bd2841', 1),
(3, 'Intro to programming', 'COM 220', '8d0110c8ff9cb62f91a5a29ee05cf0bff1559002', 4, '2533d1069c3c1156de962c746fdac754d0bd2841', 2),
(11, 'C Langunge', 'COM 114', 'afba43cbc904f3bab78116b8aa5d396e2af436cb', 3, 'a87312cea7950ecb3817d25faccdb74c24f1a8cc', 1),
(17, 'Intro Tech', 'IT 111', 'c8276a99a4bee9db7ff364667f847262e729e950', 3, 'a87312cea7950ecb3817d25faccdb74c24f1a8cc', 2),
(1, 'Intro to database', 'COM 227', 'ce7b32874f134bda68457e88ef124656a28adf1e', 3, '2533d1069c3c1156de962c746fdac754d0bd2841', 1),
(15, 'Functions and Geometry', 'STA 113', 'cfe72c36cf6da2bbd971051ca71f73675d655ea5', 3, '2533d1069c3c1156de962c746fdac754d0bd2841', 1),
(12, 'C Sharp ', 'COM 115', 'd3fe01665fe5a79f875006fd57c6cb5f3275eac3', 3, 'a87312cea7950ecb3817d25faccdb74c24f1a8cc', 1),
(14, 'STATISTICS ', 'STA 111', 'd44d2682825c5e5f08acc7b6e841464bcdffb746', 3, '2533d1069c3c1156de962c746fdac754d0bd2841', 1),
(13, 'CALCULUS', 'STA 112', 'e35a675cbcb54fee660b3be0fec04ceb45f495ef', 3, '2533d1069c3c1156de962c746fdac754d0bd2841', 1),
(16, 'System Analysis and Design', 'COM 226', 'f6b2e59d33f26688ca47c3d4428abd9a93389e02', 3, '2533d1069c3c1156de962c746fdac754d0bd2841', 2);

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

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `level` varchar(5) NOT NULL,
  `levelID` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `level`, `levelID`) VALUES
(4, 'HND 2', '0682950946050ed63d82bb196b0effe4d3d9ea57'),
(2, 'ND 2', '2533d1069c3c1156de962c746fdac754d0bd2841'),
(3, 'HND 1', '71dcfb3d92236917391f2bb44d5753724f0a1118'),
(1, 'ND 1', 'a87312cea7950ecb3817d25faccdb74c24f1a8cc');

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

--
-- Dumping data for table `std_score`
--

INSERT INTO `std_score` (`id`, `stdID`, `courseID`, `score`, `semester`, `level`, `scoreID`) VALUES
(3, '35a6c651f6cc5bc7e002a01d3a2935d8970c6726', '2f158311d433d25a8c67b9370019cb3276ab62fa', 66, '1', 'a87312cea7950ecb3817d25faccdb74c24f1a8cc', '52e92c496a8712468bed8e97d4529db4bbd3b2ed'),
(2, '35a6c651f6cc5bc7e002a01d3a2935d8970c6726', 'afba43cbc904f3bab78116b8aa5d396e2af436cb', 44, '1', 'a87312cea7950ecb3817d25faccdb74c24f1a8cc', 'ea8fc0ce4084d1eae01b69d40185aa8218ba62f1'),
(4, '35a6c651f6cc5bc7e002a01d3a2935d8970c6726', 'c8276a99a4bee9db7ff364667f847262e729e950', 44, '2', 'a87312cea7950ecb3817d25faccdb74c24f1a8cc', '3b6f677d51178a8e64f49dd0a88acade3885ed0f'),
(1, '35a6c651f6cc5bc7e002a01d3a2935d8970c6726', 'd3fe01665fe5a79f875006fd57c6cb5f3275eac3', 55, '1', 'a87312cea7950ecb3817d25faccdb74c24f1a8cc', '612bcf14fd3f9608f72918c8470a9389c3d25425');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `matric` varchar(10) NOT NULL,
  `std_name` text NOT NULL,
  `level` varchar(500) NOT NULL,
  `stdID` varchar(500) NOT NULL
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
  ADD UNIQUE KEY `course_code` (`course_code`);

--
-- Indexes for table `gradepoint`
--
ALTER TABLE `gradepoint`
  ADD PRIMARY KEY (`stdId`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`levelID`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `level` (`level`),
  ADD UNIQUE KEY `id_2` (`id`);

--
-- Indexes for table `std_score`
--
ALTER TABLE `std_score`
  ADD PRIMARY KEY (`courseID`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `scoreID` (`scoreID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stdID`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `matric` (`matric`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `gradepoint`
--
ALTER TABLE `gradepoint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `std_score`
--
ALTER TABLE `std_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
