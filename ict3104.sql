-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2016 at 04:34 AM
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
  `token` varchar(11) NOT NULL,
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
(1, 'lecturer2', 'lecturer2@lecturer2.com', NULL, NULL, NULL, '$2y$10$ZgaDz0DwyxdnJOoJ3PLEv.jK4POSe9iR0N/Ax8nWJJgF7PkmCVr2q', '', NULL, NULL, NULL, NULL, 0),
(2, 'lecturertest', 'lecturer@lecturer.com', NULL, NULL, NULL, '$2y$10$ADd3MMvLklcRfOb1oC5JD.xF8.h3P6rfogkETuf8/z.1cnmqYu4wi', '', '5kj821azZaZ3g4hDosSZ7fSRMLxSZQxzqryNJARt9qeys2BLOKqITYEDaYmo', NULL, '2016-10-17 22:59:10', NULL, 0),
(3, 'izzat', 'jerlyn.peh_2014@sit.singaporetech.edu.sg', NULL, '96938353', NULL, '$2y$10$Zcq1VPQvKXahJCm7zoqR3ul0ustT0l7VY8z7vqN99/Mbo4/hjL4Nm', 'uXW0qBRB1T', '9ft8qtOhSmAxawDUMHhGFuLxuOFFnJE0shUUsgkbybYnqsHnQwkzXi2HNugo', NULL, '2016-11-02 19:24:15', '2017-01-31', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lecturerid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `lecturerid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
