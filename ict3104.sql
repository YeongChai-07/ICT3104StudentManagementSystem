-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2016 at 11:57 AM
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
  `contact` int(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `adminname`, `adminemail`, `password`, `contact`, `address`, `remember_token`, `updated_at`) VALUES
(1, 'admin1', 'admin@admin.com', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', 66655544, 'block 123', 'sS4mjKA3Sh46nmbBrEsabH7yBw9zcTsUVp7lN8pb5cy1XnYfb2knJ22VAUyd', '2016-11-01 22:53:20'),
(2, 'admin2', 'admin2@admin.com', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', 11112222, 'block555', '', NULL);

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
(1, 1, 1),
(2, 2, 2),
(3, 1, 2),
(4, 4, 1);

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
(1, NULL, NULL, 1, 1, 2, 1, 0),
(2, NULL, NULL, 2, 1, 2, 1, 0),
(3, NULL, NULL, 1, 4, 2, 1, 0),
(4, NULL, NULL, 2, 4, 2, 1, 0),
(6, 'D', 'eyJpdiI6ImNIS3BKNU42ZFwvRWN4N1liTHZFMzNnPT0iLCJ2YWx1ZSI6Ilg0eE00ZVAzRDUzXC92KzNPbHFcL1wvd3c9PSIsIm1hYyI6ImNlNGQ0YzNkOWNhOGUzMDJkN2E0ZmI3ODE4NjMzN2Y1YTFlMGQxYjcxYmJlZDVjM2NkYTc2MGUyNWE0ZWY5NjQifQ==', 4, 1, 2, 1, 1);

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

--
-- Dumping data for table `gradstudentsmetainfo`
--

INSERT INTO `gradstudentsmetainfo` (`gradstudentid`, `moduleid`, `grade`, `marks`) VALUES
(4, 1, 'B', '61.20'),
(4, 2, 'A', '79.50');

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
  `cgpa` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `graduatedstudents`
--

INSERT INTO `graduatedstudents` (`gradstudentid`, `gradstudentname`, `gradstudentemail`, `metric`, `contact`, `address`, `enrolyear`, `gradyear`, `cgpa`) VALUES
(4, 'izzat23', 'izzat23@izzat.com', 123456, 99938354, 'CCK 123', 2002, 2005, '3.45'),
(10, 'mavis', 'mavis@123.com', 1010, 66655544, 'Block 100', 2000, 2003, '4.30');

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
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expirydate` date DEFAULT NULL,
  `lockacc` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hod`
--

INSERT INTO `hod` (`hodid`, `hodname`, `hodemail`, `metric`, `contact`, `address`, `password`, `remember_token`, `created_at`, `updated_at`, `expirydate`, `lockacc`) VALUES
(1, 'hod', 'hod@hod.com', NULL, '2637238', 'Block 112', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', 'PMdaBpZDRNajXFOudvtuC5xW2qdwjOnhc0FbmttiLiJd9ezIh7c0QFVQFPL7', NULL, '2016-11-01 21:50:12', NULL, 0),
(2, 'izzat', 'izzathod@gmail.com', NULL, '96938353', '', '$2y$10$qG8n6uZuDdGnVrOTSS5evOgUgoy0AJDPnzBM2pxFg8Gw50vZFwEu2', '4hcvUdxJGfw5OK4tHZ9uTsbq9zeu5rYcpy707i2g4GxnFyVbZMrZqUG46EoO', NULL, '2016-11-01 23:20:23', '2017-01-31', 0);

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
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expirydate` date DEFAULT NULL,
  `lockacc` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lecturerid`, `lecturername`, `lectureremail`, `metric`, `contact`, `address`, `password`, `remember_token`, `created_at`, `updated_at`, `expirydate`, `lockacc`) VALUES
(1, 'lecturer2', 'lecturer2@lecturer2.com', NULL, NULL, NULL, '$2y$10$ZgaDz0DwyxdnJOoJ3PLEv.jK4POSe9iR0N/Ax8nWJJgF7PkmCVr2q', NULL, NULL, NULL, NULL, 0),
(2, 'lecturertest', 'lecturer@lecturer.com', NULL, NULL, NULL, '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', '5kj821azZaZ3g4hDosSZ7fSRMLxSZQxzqryNJARt9qeys2BLOKqITYEDaYmo', NULL, '2016-10-17 22:59:10', NULL, 0),
(3, 'izzat', 'izzatgeno@gmail.com', NULL, '96938353', NULL, '$2y$10$Zcq1VPQvKXahJCm7zoqR3ul0ustT0l7VY8z7vqN99/Mbo4/hjL4Nm', 'K1CMA1i7bHCodZ4XtN1AbzNUdsM8NSIUWdxJEy38S7nWVWX87p4dvj6reqku', NULL, '2016-11-01 23:18:57', '2017-01-31', 0);

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
  `publish` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `modulename`, `description`, `lecturerid`, `hodid`, `editdate`, `freezedate`, `endedit`, `endfreeze`, `publish`) VALUES
(1, 'Maths', 'E Maths', 2, 1, '2016-11-14', '2016-11-30', 0, 0, 0),
(2, 'Science', 'Physics', 2, 1, '2016-11-14', '2016-11-30', 0, 0, 0),
(4, 'English', 'English', 1, 1, '2016-11-14', '2016-11-30', 1, 1, 1);

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
(12, 'test', 1, 2, 1, 4, '5', 3);

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

INSERT INTO `students` (`studentid`, `studentname`, `studentemail`, `metric`, `enrolyear`, `cgpa`, `contact`, `address`, `password`, `remember_token`, `created_at`, `updated_at`, `expirydate`, `lockacc`) VALUES
(1, 'student2', 'student@student.com', 'Hello Panda', 2001, '2', '', '', '$2y$10$.zNUS.sRY060bL0c1Uovxu9PeFlUHD8oFkOxTK5n6zkeSz3iwF9y2', '9nnwls2hX345Mpfd9RnevPO6tiqOOYCAukX5N5OdekII6LLSG7VnXxqLBboc', NULL, '2016-10-16 08:01:26', '2017-01-31', 0),
(2, 'izzat', 'izzat@izzat.com', '123456', 2002, '2.40', '96938354', 'CCK 123', '$2y$10$NC2Gz.ouF6MEnZMwuavdROvE8ZMYdkdxhSFSwP06na12KRRkCruFG', 'npRKgofeQ33MGVw6SmXwAC4U8QuDq7cvTeAeVT4KRNvMQO8oa3gOVqIugHmd', NULL, '2016-10-02 00:39:06', NULL, 0),
(3, 'testing', 'test@test.com', NULL, 2003, '3.30', NULL, NULL, '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', NULL, NULL, NULL, NULL, 0),
(5, 'izzat234', 'izzat234@izzat.com', '123456', 2002, '3.45', '99938354', 'CCK 123', '$2y$10$NC2Gz.ouF6MEnZMwuavdROvE8ZMYdkdxhSFSwP06na12KRRkCruFG', 'npRKgofeQ33MGVw6SmXwAC4U8QuDq7cvTeAeVT4KRNvMQO8oa3gOVqIugHmd', NULL, '2016-10-02 00:39:06', NULL, 0),
(7, 'izzat', 'izzatstudent@gmail.com', '14sic044y', 2016, NULL, '96938353', 'cck 123', '$2y$10$Pa.zlX1WeO.Q4eB7wvJy3O9ch5Gc9vPESbFVE.s46bfV7XWHgkg1q', 'WatCrkAyfjrG8hqQb9kuGF06Tc1gBtX35SN9x1H6KYzQk7AFAcgSfLOXrgMw', NULL, '2016-11-01 23:19:45', '2017-01-31', 0);

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
  MODIFY `adminid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `enroll`
--
ALTER TABLE `enroll`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `graduatedstudents`
--
ALTER TABLE `graduatedstudents`
  MODIFY `gradstudentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `hod`
--
ALTER TABLE `hod`
  MODIFY `hodid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `lecturerid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `recommendation`
--
ALTER TABLE `recommendation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
