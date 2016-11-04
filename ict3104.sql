-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2016 at 08:01 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `adminname`, `adminemail`, `password`, `token`, `contact`, `address`, `remember_token`, `updated_at`) VALUES
(1, 'admin1', 'admin@admin.com', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', NULL, 66655544, 'block 123', 'xqgSy8NjBqV9ClXHsqr5bWXUuexvCJ91o9p60gGQU6pnbfySUBgcopa7u25e', '2016-11-02 06:00:28'),
(2, 'admin2', 'spartan_genocide@hotmail.com', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', 'EFrn8Gpk49', 11112222, 'block555', 'XATJQYMiOGWGrufh1hiuBECJ7oGO8KNIFB8Pwx2sONGKfhDACnF7tj2PWiCc', '2016-11-04 01:27:17'),
(3, 'admin3', 'jerlyn.peh_2014@sit.singaporetech.edu.sg', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', 'wqI22AmP15', 11112222, 'block555', '6nhQbaeDJaVw1mV1ncXptBn9Rgkn6aA1GlmhTWAKkTsfWE2ccjjAoMGOQkuQ', '2016-11-04 10:56:54');

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
(4, 4, 1),
(5, 1, 4),
(6, 2, 4),
(7, 4, 6);

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
(5, 'D', 'eyJpdiI6ImNIS3BKNU42ZFwvRWN4N1liTHZFMzNnPT0iLCJ2YWx1ZSI6Ilg0eE00ZVAzRDUzXC92KzNPbHFcL1wvd3c9PSIsIm1hYyI6ImNlNGQ0YzNkOWNhOGUzMDJkN2E0ZmI3ODE4NjMzN2Y1YTFlMGQxYjcxYmJlZDVjM2NkYTc2MGUyNWE0ZWY5NjQifQ==', 6, 6, 1, 1, 1),
(6, 'D', 'eyJpdiI6ImNIS3BKNU42ZFwvRWN4N1liTHZFMzNnPT0iLCJ2YWx1ZSI6Ilg0eE00ZVAzRDUzXC92KzNPbHFcL1wvd3c9PSIsIm1hYyI6ImNlNGQ0YzNkOWNhOGUzMDJkN2E0ZmI3ODE4NjMzN2Y1YTFlMGQxYjcxYmJlZDVjM2NkYTc2MGUyNWE0ZWY5NjQifQ==', 4, 1, 1, 1, 1),
(7, 'D', 'eyJpdiI6ImNIS3BKNU42ZFwvRWN4N1liTHZFMzNnPT0iLCJ2YWx1ZSI6Ilg0eE00ZVAzRDUzXC92KzNPbHFcL1wvd3c9PSIsIm1hYyI6ImNlNGQ0YzNkOWNhOGUzMDJkN2E0ZmI3ODE4NjMzN2Y1YTFlMGQxYjcxYmJlZDVjM2NkYTc2MGUyNWE0ZWY5NjQifQ==', 4, 7, 1, 1, 1),
(8, 'D', 'eyJpdiI6ImNIS3BKNU42ZFwvRWN4N1liTHZFMzNnPT0iLCJ2YWx1ZSI6Ilg0eE00ZVAzRDUzXC92KzNPbHFcL1wvd3c9PSIsIm1hYyI6ImNlNGQ0YzNkOWNhOGUzMDJkN2E0ZmI3ODE4NjMzN2Y1YTFlMGQxYjcxYmJlZDVjM2NkYTc2MGUyNWE0ZWY5NjQifQ==', 4, 6, 1, 1, 1);

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
(4, 1, 'B', '0.00'),
(4, 2, 'A', '0.00'),
(6, 4, 'D', '0.00');

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
(4, 'student4', 'student@student.com', 0, 0, '', 2001, 2016, 'eyJpdiI6IlgyRVNxdTNuNG14T1liZ3IwalNiR1E9PSIsInZhbHVlIjoibWNSTXlpcDRyVnpJMDR5TjIraThjQT09IiwibWFjIjoiOTFmMjFkOGI3OWJiYzQ2OTM1NjdlYjE5M2Y0NDA1MjczYTA3ZGY5YmEwYzFhMThmYTc5OGRhZTg3ZjQ4ZGMwNSJ9'),
(6, 'student6', 'student@student.com', 0, 0, '', 2001, 2017, 'eyJpdiI6IlgyRVNxdTNuNG14T1liZ3IwalNiR1E9PSIsInZhbHVlIjoibWNSTXlpcDRyVnpJMDR5TjIraThjQT09IiwibWFjIjoiOTFmMjFkOGI3OWJiYzQ2OTM1NjdlYjE5M2Y0NDA1MjczYTA3ZGY5YmEwYzFhMThmYTc5OGRhZTg3ZjQ4ZGMwNSJ9'),
(10, 'mavis', 'mavis@123.com', 1010, 66655544, 'Block 100', 2000, 2003, '4eyJpdiI6IlgyRVNxdTNuNG14T1liZ3IwalNiR1E9PSIsInZhbHVlIjoibWNSTXlpcDRyVnpJMDR5TjIraThjQT09IiwibWFjIjoiOTFmMjFkOGI3OWJiYzQ2OTM1NjdlYjE5M2Y0NDA1MjczYTA3ZGY5YmEwYzFhMThmYTc5OGRhZTg3ZjQ4ZGMwNSJ9'),
(11, 'izzat23', 'izzat23@izzat.com', 123456, 99938354, 'CCK 123', 2002, 2005, 'eyJpdiI6IlgyRVNxdTNuNG14T1liZ3IwalNiR1E9PSIsInZhbHVlIjoibWNSTXlpcDRyVnpJMDR5TjIraThjQT09IiwibWFjIjoiOTFmMjFkOGI3OWJiYzQ2OTM1NjdlYjE5M2Y0NDA1MjczYTA3ZGY5YmEwYzFhMThmYTc5OGRhZTg3ZjQ4ZGMwNSJ9');

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
(1, 'hod', 'hod@hod.com', NULL, '2637238', 'Block 112', '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', 'ZfdYoOx7if', 'pO2IinvDalTRjDeF64qtOvI0pgKJ6nlNk4cOFEnY5NPKh7r7NROaghPXxqPz', NULL, '2016-11-04 02:01:47', '2017-01-31', 0),
(2, 'izzat', 'izzathod@hod.com', NULL, '96938353', '', '$2y$10$qG8n6uZuDdGnVrOTSS5evOgUgoy0AJDPnzBM2pxFg8Gw50vZFwEu2', NULL, '4hcvUdxJGfw5OK4tHZ9uTsbq9zeu5rYcpy707i2g4GxnFyVbZMrZqUG46EoO', NULL, '2016-11-01 23:20:23', '2017-01-31', 0),
(3, 'test', 'test@test.com', '123qweasd123', '12345678123', '123qwe123qwe', '$2y$10$LQTk0iQox.pu1yVixRUgm.c3.bhU4kfEgAfcNCky0KDDJJ2aesdRy', NULL, NULL, NULL, NULL, '2017-01-31', 0);

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
(1, 'lecturer2', 'lecturer2@lecturer2.com', NULL, NULL, NULL, '$2y$10$ZgaDz0DwyxdnJOoJ3PLEv.jK4POSe9iR0N/Ax8nWJJgF7PkmCVr2q', NULL, NULL, NULL, NULL, '2017-01-31', 0),
(2, 'lecturertest', 'lecturer@lecturer.com', NULL, NULL, NULL, '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', '0zLDEItehP', 'svbKTDjl0lTWerbKgRARccRcJi4GhAlwpDpXtwphKPYg2MpI3TOnxX3yMrce', NULL, '2016-11-02 04:31:02', '2017-01-31', 0),
(3, 'izzat', '14sic044y@sit.singaporetech.edu.eg', NULL, '96938353', NULL, '$2y$10$Zcq1VPQvKXahJCm7zoqR3ul0ustT0l7VY8z7vqN99/Mbo4/hjL4Nm', NULL, 'K1CMA1i7bHCodZ4XtN1AbzNUdsM8NSIUWdxJEy38S7nWVWX87p4dvj6reqku', NULL, '2016-11-01 23:18:57', '2017-01-31', 0),
(4, 'test2', 'izzatgeno@gmail.com', '123qwe123asfafa', '123qweasd123asdas', '123qwegwgwqwea12e1', '$2y$10$KVsgbEzzflgLHlvcEbeBC.WtK9LL3XoCbeDnxn/5w8QMCmiGu.arq', '4B0J6IiY3s', 'VpeSqV5a75sm5fW6jdR1N3U0fFgS7jVImrrhxDtD4SrlM9Q9l5nVClzIryyG', NULL, '2016-11-04 01:23:33', '2016-11-10', 0);

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
(1, 'Maths', 'E Maths', 2, 1, '2016-11-14', '2016-11-30', 0, 0, 0, 5),
(2, 'Science', 'Physics', 2, 1, '2016-11-14', '2016-11-30', 0, 0, 0, 5),
(4, 'English', 'English', 1, 1, '2016-11-14', '2016-11-30', 1, 1, 1, 6);

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
(12, 'test', 1, 1, 1, 4, '5', 3);

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
  `gradyear` int(5) NOT NULL,
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
(1, 'student2', 'student@student.com', 'Hello Panda', 2001, 2010, 'eyJpdiI6IlgyRVNxdTNuNG14T1liZ3IwalNiR1E9PSIsInZhbHVlIjoibWNSTXlpcDRyVnpJMDR5TjIraThjQT09IiwibWFjIjoiOTFmMjFkOGI3OWJiYzQ2OTM1NjdlYjE5M2Y0NDA1MjczYTA3ZGY5YmEwYzFhMThmYTc5OGRhZTg3ZjQ4ZGMwNSJ9', '', '', '$2y$10$.zNUS.sRY060bL0c1Uovxu9PeFlUHD8oFkOxTK5n6zkeSz3iwF9y2', 'pgZrrCKeYuT97jmUfI4UN4MV94xABc98HksjKcA9aOgrxPpLHQWZXcE2ICdu', NULL, '2016-11-04 08:27:46', '2017-01-31', 0),
(2, 'izzat', 'izzat@izzat.com', '123456', 2002, 0, 'eyJpdiI6IlgyRVNxdTNuNG14T1liZ3IwalNiR1E9PSIsInZhbHVlIjoibWNSTXlpcDRyVnpJMDR5TjIraThjQT09IiwibWFjIjoiOTFmMjFkOGI3OWJiYzQ2OTM1NjdlYjE5M2Y0NDA1MjczYTA3ZGY5YmEwYzFhMThmYTc5OGRhZTg3ZjQ4ZGMwNSJ9', '96938354', 'CCK 123', '$2y$10$NC2Gz.ouF6MEnZMwuavdROvE8ZMYdkdxhSFSwP06na12KRRkCruFG', 'npRKgofeQ33MGVw6SmXwAC4U8QuDq7cvTeAeVT4KRNvMQO8oa3gOVqIugHmd', NULL, '2016-10-02 00:39:06', '2017-01-31', 0),
(3, 'testing', 'test@test.com', NULL, 2003, 0, 'eyJpdiI6IlgyRVNxdTNuNG14T1liZ3IwalNiR1E9PSIsInZhbHVlIjoibWNSTXlpcDRyVnpJMDR5TjIraThjQT09IiwibWFjIjoiOTFmMjFkOGI3OWJiYzQ2OTM1NjdlYjE5M2Y0NDA1MjczYTA3ZGY5YmEwYzFhMThmYTc5OGRhZTg3ZjQ4ZGMwNSJ9', NULL, NULL, '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', NULL, NULL, NULL, '2017-01-31', 0),
(5, 'izzat234', 'test2@test.com', '123456', 2002, 0, 'eyJpdiI6IlgyRVNxdTNuNG14T1liZ3IwalNiR1E9PSIsInZhbHVlIjoibWNSTXlpcDRyVnpJMDR5TjIraThjQT09IiwibWFjIjoiOTFmMjFkOGI3OWJiYzQ2OTM1NjdlYjE5M2Y0NDA1MjczYTA3ZGY5YmEwYzFhMThmYTc5OGRhZTg3ZjQ4ZGMwNSJ9', '99938354', 'CCK 123', '$2y$10$7SFFNzhswXphAxSD9WSZ9uNDqnxW03S5qMNcfqgY/2bkflElHvPPu', 'sYQlOWEd4bheYID6DmyGjWSBkTPXX871RrKZBMAu5OI3Sa0hdFx5a5c4YVP9', NULL, '2016-11-02 23:30:35', '2017-01-31', 0);

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
  MODIFY `adminid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `enroll`
--
ALTER TABLE `enroll`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `graduatedstudents`
--
ALTER TABLE `graduatedstudents`
  MODIFY `gradstudentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `hod`
--
ALTER TABLE `hod`
  MODIFY `hodid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `lecturerid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `studentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
