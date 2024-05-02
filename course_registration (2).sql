-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 08:42 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses_table`
--

CREATE TABLE `courses_table` (
  `CourseID` int(10) NOT NULL,
  `CourseName` varchar(100) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `CreditHours` int(255) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `RoomNumber` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments_table`
--

CREATE TABLE `departments_table` (
  `DepartmentID` int(10) NOT NULL,
  `StudentId` int(11) NOT NULL,
  `DepartmentName` varchar(50) NOT NULL,
  `DepartmentHead` varchar(30) NOT NULL,
  `Location` varchar(30) NOT NULL,
  `DEPhone` int(10) NOT NULL,
  `DepEmail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollments_table`
--

CREATE TABLE `enrollments_table` (
  `EnrollmentID` int(10) NOT NULL,
  `StudentId` int(10) NOT NULL,
  `Semester` varchar(10) NOT NULL,
  `CourseID` int(10) NOT NULL,
  `EnrollmentDate` date NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_table`
--

CREATE TABLE `login_table` (
  `login_ID` int(11) NOT NULL,
  `UserName` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students_table`
--

CREATE TABLE `students_table` (
  `id` int(10) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `StudentId` int(11) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Phone` int(10) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `EmergencyContactName` varchar(30) NOT NULL,
  `EmergencyContactPhone` int(10) NOT NULL,
  `deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses_table`
--
ALTER TABLE `courses_table`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `departments_table`
--
ALTER TABLE `departments_table`
  ADD PRIMARY KEY (`DepartmentID`),
  ADD KEY `StudentId` (`StudentId`);

--
-- Indexes for table `enrollments_table`
--
ALTER TABLE `enrollments_table`
  ADD PRIMARY KEY (`EnrollmentID`),
  ADD KEY `StudentINDEX` (`Semester`),
  ADD KEY `CourseINDEX` (`CourseID`);

--
-- Indexes for table `login_table`
--
ALTER TABLE `login_table`
  ADD PRIMARY KEY (`login_ID`);

--
-- Indexes for table `students_table`
--
ALTER TABLE `students_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses_table`
--
ALTER TABLE `courses_table`
  MODIFY `CourseID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7888;

--
-- AUTO_INCREMENT for table `departments_table`
--
ALTER TABLE `departments_table`
  MODIFY `DepartmentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8891;

--
-- AUTO_INCREMENT for table `enrollments_table`
--
ALTER TABLE `enrollments_table`
  MODIFY `EnrollmentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7882;

--
-- AUTO_INCREMENT for table `login_table`
--
ALTER TABLE `login_table`
  MODIFY `login_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4586;

--
-- AUTO_INCREMENT for table `students_table`
--
ALTER TABLE `students_table`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollments_table`
--
ALTER TABLE `enrollments_table`
  ADD CONSTRAINT `enrollments_table_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses_table` (`CourseID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
