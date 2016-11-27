-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2016 at 09:34 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ict3104`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(10) NOT NULL,
  `adminname` varchar(255) NOT NULL,
  `adminemail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(11) DEFAULT NULL,
  `contact` int(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `backupsettings` int(5) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `adminname`, `adminemail`, `password`, `token`, `contact`, `address`, `remember_token`, `updated_at`, `backupsettings`) VALUES
(1, 'admin1', 'admin@admin.com', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', '807178', 66655544, 'block 12345', 'd2d4RQcnMk3zp1PCuk3Lb0penip4b5G3Ob4l6RLglzc63nHC4XTKBAjrH3tB', '2016-11-27 00:20:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `id` int(10) NOT NULL,
  `moduleid` int(10) NOT NULL,
  `studentid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`id`, `moduleid`, `studentid`) VALUES
(12, 8, 8),
(13, 8, 9),
(14, 5, 7);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) NOT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `marks` varchar(255) DEFAULT NULL,
  `moduleid` int(10) NOT NULL,
  `studentid` int(10) NOT NULL,
  `lecturerid` int(10) NOT NULL,
  `hodid` int(10) NOT NULL,
  `publish` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `grade`, `marks`, `moduleid`, `studentid`, `lecturerid`, `hodid`, `publish`) VALUES
(17, NULL, NULL, 5, 7, 5, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gradstudentsmetainfo`
--

CREATE TABLE `gradstudentsmetainfo` (
  `gradstudentid` int(11) NOT NULL,
  `moduleid` int(11) NOT NULL,
  `grade` varchar(3) NOT NULL,
  `marks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gradstudentsmetainfo`
--

INSERT INTO `gradstudentsmetainfo` (`gradstudentid`, `moduleid`, `grade`, `marks`) VALUES
(8, 8, 'B', 'eyJpdiI6Im1qcldwT1M4TXU1bzVxT1dSbXdHTUE9PSIsInZhbHVlIjoibW5OWlwvNEZRV2R5c1Y2dDlxd1dlMXc9PSIsIm1hYyI6IjJmNzlkMjVlZDE1ZjJjZTgzZDY5MDljMjNhYzAwZGYwYzQ0NTA0NjczMWY5MTk2MmQzMTVmNTUzMjhhNTMxN2EifQ=='),
(9, 8, 'A', 'eyJpdiI6IkNBazA5dldFa25BdXEwRFZOZndFU2c9PSIsInZhbHVlIjoiU2JDUjFvQitHMUt5blZIa2E4V0RaUT09IiwibWFjIjoiODM1Y2NiZDJjYzBiNTBlMzQ3MmU4Y2Q4ZGQ1MzcyZWMxZTU3NDlkNGFiYmFmMjAxNTAxNmQwYmQyNTlkN2M0MiJ9');

-- --------------------------------------------------------

--
-- Table structure for table `graduatedstudents`
--

CREATE TABLE `graduatedstudents` (
  `gradstudentid` int(10) NOT NULL,
  `gradstudentname` varchar(255) NOT NULL,
  `gradstudentemail` varchar(255) NOT NULL,
  `metric` int(10) NOT NULL,
  `contact` int(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `enrolyear` int(5) NOT NULL,
  `gradyear` int(5) NOT NULL,
  `cgpa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `graduatedstudents`
--

INSERT INTO `graduatedstudents` (`gradstudentid`, `gradstudentname`, `gradstudentemail`, `metric`, `contact`, `address`, `enrolyear`, `gradyear`, `cgpa`) VALUES
(8, 'GraduateStudent', 'graduate@student.com', 123456, 12345678, 'cck 64', 2013, 2016, 'eyJpdiI6IlQ1TVBveUlOOHVyTk5vUVwveFU1QjFRPT0iLCJ2YWx1ZSI6Ik42dW5xcFYxUXh1YTZmUjhmQkc5Q0E9PSIsIm1hYyI6ImU1Y2MxN2E2ZTNkOWE2NmY1YzU4OWQ2NTA1YjcxNWZiYzhmNzhjMTUwZjkzMjI2NjBjN2FlYTliZTM1ZGI1MWIifQ=='),
(9, 'GraduateStudent2', 'graduate2@student.com', 123, 5123, '123t', 2013, 2016, 'eyJpdiI6InBsb0NqR3ZpaytSVk5iTkVTYlpjZ1E9PSIsInZhbHVlIjoiMDlaNGk0REFiS3dIRmRmU25tXC85YWc9PSIsIm1hYyI6ImYwZDE1ZTEyZDQyMGRiYjk1ODRkNGZjYTM0MmY3Y2RjYzViZDFhZjM4OGRlN2MxNmQ0NTczMDZjOGNmMGRkNmIifQ==');

-- --------------------------------------------------------

--
-- Table structure for table `hod`
--

CREATE TABLE `hod` (
  `hodid` int(10) NOT NULL,
  `hodname` varchar(255) NOT NULL,
  `hodemail` varchar(255) NOT NULL,
  `metric` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(11) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expirydate` date DEFAULT NULL,
  `lockacc` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hod`
--

INSERT INTO `hod` (`hodid`, `hodname`, `hodemail`, `metric`, `contact`, `address`, `password`, `token`, `remember_token`, `created_at`, `updated_at`, `expirydate`, `lockacc`) VALUES
(4, 'hod', 'hod@hod.com', '123qweasd', '96938353', '123qweCC', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', '836542', '5ThtsWz5ivNFISCngAUKp1mlGcyEUJci0UcZJiEHvfod0rtMmCtjOtA3zGsk', NULL, '2016-11-27 00:22:56', '2017-02-23', 0),
(5, 'hod2', 'izzatgeno@gmail.com', 'hod123', '0987654', 'hod house', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', NULL, NULL, NULL, NULL, '2016-12-01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `lecturerid` int(10) NOT NULL,
  `lecturername` varchar(255) NOT NULL,
  `lectureremail` varchar(255) NOT NULL,
  `metric` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(11) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expirydate` date DEFAULT NULL,
  `lockacc` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lecturerid`, `lecturername`, `lectureremail`, `metric`, `contact`, `address`, `password`, `token`, `remember_token`, `created_at`, `updated_at`, `expirydate`, `lockacc`) VALUES
(5, 'lecturer', 'lecturer@lecturer.com', '12345678', '96938353', 'cc', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', '932509', 'ieczTrQa56trIbmKiKagdXpBULWemaEDAq0JP5FsVutsA5gj8Vp4u6veMcna', NULL, '2016-11-27 00:22:12', '2017-02-23', 0),
(6, 'lecturer2', 'spartan_genocide@hotmail.com', 'lec 123', '96938354', 'lecturer house', '$2y$10$ez0qJNZXed9riE0/Y8AtgOVhUNI5/VIakiVuEo4PJ/rbuvuTdL/zy', NULL, NULL, NULL, NULL, '2016-10-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(10) NOT NULL,
  `modulename` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `lecturerid` int(10) NOT NULL,
  `hodid` int(10) NOT NULL,
  `editdate` date NOT NULL,
  `freezedate` date NOT NULL,
  `endedit` int(11) NOT NULL DEFAULT '0',
  `endfreeze` int(11) NOT NULL DEFAULT '0',
  `publish` int(11) DEFAULT '0',
  `credit` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `modulename`, `description`, `lecturerid`, `hodid`, `editdate`, `freezedate`, `endedit`, `endfreeze`, `publish`, `credit`) VALUES
(5, 'Maths', 'E Maths', 5, 4, '2016-12-17', '2017-01-06', 0, 0, 0, 5),
(6, 'English', 'English', 5, 4, '2016-12-22', '2017-01-20', 0, 0, 0, 5),
(7, 'Science', 'Science', 5, 4, '2016-12-16', '2017-01-12', 0, 0, 0, 5),
(8, 'Phys Ed', 'Phys Ed', 5, 4, '2016-12-30', '2017-01-20', 1, 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `recommendation`
--

CREATE TABLE `recommendation` (
  `id` int(10) NOT NULL,
  `recommendation` varchar(255) DEFAULT NULL,
  `studentid` int(10) NOT NULL,
  `lecturerid` int(10) NOT NULL,
  `hodid` int(11) NOT NULL,
  `moduleid` int(11) NOT NULL,
  `moderation` varchar(255) DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentid` int(10) NOT NULL,
  `studentname` varchar(255) NOT NULL,
  `studentemail` varchar(255) NOT NULL,
  `metric` varchar(255) DEFAULT NULL,
  `enrolyear` int(5) NOT NULL,
  `gradyear` int(5) DEFAULT NULL,
  `cgpa` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expirydate` date DEFAULT NULL,
  `lockacc` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentid`, `studentname`, `studentemail`, `metric`, `enrolyear`, `gradyear`, `cgpa`, `contact`, `address`, `password`, `remember_token`, `created_at`, `updated_at`, `expirydate`, `lockacc`) VALUES
(7, 'Izzat', 'izzat@izzat.com', '14sic980E', 2016, 2020, NULL, '65429876', 'yeww yeeee', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', NULL, NULL, NULL, '2017-02-25', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gradstudentsmetainfo`
--
ALTER TABLE `gradstudentsmetainfo`
  ADD PRIMARY KEY (`gradstudentid`,`moduleid`);

--
-- Indexes for table `graduatedstudents`
--
ALTER TABLE `graduatedstudents`
  ADD PRIMARY KEY (`gradstudentid`);

--
-- Indexes for table `hod`
--
ALTER TABLE `hod`
  ADD PRIMARY KEY (`hodid`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lecturerid`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recommendation`
--
ALTER TABLE `recommendation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `enroll`
--
ALTER TABLE `enroll`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `graduatedstudents`
--
ALTER TABLE `graduatedstudents`
  MODIFY `gradstudentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `hod`
--
ALTER TABLE `hod`
  MODIFY `hodid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `lecturerid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `recommendation`
--
ALTER TABLE `recommendation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
