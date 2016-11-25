-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2016 at 01:27 PM
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
(1, 'admin1', 'admin@admin.com', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', '687415', 66655544, 'block 12345', 'Ndhl4dLoSoUHYjQQqsQHokdBRB1McudHQ514pOtQzoDZ928UMqQ0hbuwciUK', '2016-11-25 04:26:38', 1);

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
(9, 5, 4);

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
(12, 'B', 'eyJpdiI6IlV4alVIc3lnQUJhblwvXC91aElBb0FKdz09IiwidmFsdWUiOiJDclF4MVlMWnRYYSs1OW5KSnUxUTVRPT0iLCJtYWMiOiI1NzAwMmY1ZGNjMzkxNmUxMjRkMWQ0YjEzODVlZWM3NjU3ZWI2YmM4ZDFjYTk1YzZiY2E4Mzc2YmE0NzI5NTM3In0=', 5, 4, 5, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gradstudentsmetainfo`
--

CREATE TABLE `gradstudentsmetainfo` (
  `gradstudentid` int(11) NOT NULL,
  `moduleid` int(11) NOT NULL,
  `grade` varchar(3) NOT NULL,
  `marks` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(4, 'hod', 'hod@hod.com', '123qweasd', '96938353', '123qweCC', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', '853110', 'L79z4IsccoDXM9UoVqOXiKH2pbALuD5ZgJ8Roa1HbqzTiavOowSk7es7x7xQ', NULL, '2016-11-25 04:26:58', '2017-02-23', 0);

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
(5, 'lecturer', 'lecturer@lecturer.com', '12345678', '96938353', 'cc', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', '852523', '9GiC2CxS2aiQZfJSYr9IssOlYS5orP1BUXi3WT7XtsQiWEZtUsGpnR5cy6s3', NULL, '2016-11-25 03:59:26', '2017-02-23', 0);

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
(5, 'Maths', 'E Maths', 5, 4, '2016-12-17', '2017-01-06', 1, 1, 1, 5);

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

--
-- Dumping data for table `recommendation`
--

INSERT INTO `recommendation` (`id`, `recommendation`, `studentid`, `lecturerid`, `hodid`, `moduleid`, `moderation`, `status`) VALUES
(17, 'test', 4, 5, 4, 5, '10', 3);

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
(4, 'student', 'student@student.com', '14sic044y', 2019, NULL, 'eyJpdiI6Ijc0eEQwaUtrQXVFREIrMDU3SkNEeHc9PSIsInZhbHVlIjoiRFBOQzdaS3VpXC9jb0MzOXJCWmZsa0E9PSIsIm1hYyI6IjM2NmM1NDZmZGUzMGMxYWZjOWJhZWYwMTU4NDRlMWM4MmYyODIwZmYxYTZkOTE0OWQwZDE4ZTFlMTgwYjE0NWQifQ==', '96938353', 'cck123', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', 'C0MfsTszBCyg2ZIA6pKkZFtVeMXIC3RYBrczwLepy5czRXb5zTWAwn573UTV', NULL, '2016-11-25 04:24:50', '2017-02-23', 0);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `graduatedstudents`
--
ALTER TABLE `graduatedstudents`
  MODIFY `gradstudentid` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hod`
--
ALTER TABLE `hod`
  MODIFY `hodid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `lecturerid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `recommendation`
--
ALTER TABLE `recommendation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
