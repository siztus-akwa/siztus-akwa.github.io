-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 03:20 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_schedule_info`
--

CREATE TABLE `class_schedule_info` (
  `id` int(30) NOT NULL,
  `schedule_id` int(30) NOT NULL,
  `course_id` int(30) NOT NULL,
  `subject` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(30) NOT NULL,
  `course` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `leader` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `description`, `leader`) VALUES
(7, 'DLMM01', 'Financial Management and Control', 'Julie Mayers'),
(8, 'DLMM02', 'Operations Management', 'Bindu Jose'),
(9, 'DLMM03', 'International Business Environment', 'Bindu Jose'),
(10, 'DLMM09', 'Managing and Leading People', 'Jessica Muirhead'),
(11, 'DLMM04', 'International Trade', 'Bindu Jose'),
(12, 'DLMM06', 'International HRM', 'Nigel Houlden'),
(13, 'DLMM07', 'Cross Cultural Management', 'Nigel Houlden'),
(14, 'DLMM08', 'Developing Skills for Business Leadership', 'Jessica Muirhead'),
(15, 'DLMM05', 'Marketing Management', 'Jessica Muirhead'),
(16, 'DLMM10', 'Enterprise and Entrepreneurship', 'Nigel Houlden'),
(17, 'DLMM04', 'International Trade', 'Jessica Muirhead'),
(18, 'DLMM06', 'International HRM', 'Denise Oram');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(30) NOT NULL,
  `id_no` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `id_no`, `firstname`, `middlename`, `lastname`, `contact`, `gender`, `address`, `email`) VALUES
(1, '06232014', 'Chi', 'C', 'Ji', '+44184565455', 'Female', 'Sample Address', 'jchi@sample.com'),
(2, '37362629', 'C', 'C', 'Chrystanus', '+442345687923', 'Female', 'Sample Address', 'ce@sample.com');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(30) NOT NULL,
  `faculty_id` int(30) NOT NULL,
  `title` varchar(200) NOT NULL,
  `schedule_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1= class, 2= meeting,3=others',
  `description` text NOT NULL,
  `location` text NOT NULL,
  `is_repeating` tinyint(1) NOT NULL DEFAULT 1,
  `repeating_data` text NOT NULL,
  `schedule_date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `faculty_id`, `title`, `schedule_type`, `description`, `location`, `is_repeating`, `repeating_data`, `schedule_date`, `time_from`, `time_to`, `date_created`) VALUES
(4, 1, 'Digital Forensics', 1, '', '', 0, '', '2024-01-15', '00:00:00', '00:00:00', '2024-01-06 13:17:03'),
(54, 2, 'Financial Management and Control', 1, '', '', 1, '{\"dow\":\"1,2,3,4,5\",\"start\":\"2024-11-01\",\"end\":\"2024-12-01\"}', '2024-11-01', '09:00:00', '17:00:00', '2024-01-22 03:11:33'),
(55, 2, 'Operations Management', 1, '', '', 1, '{\"dow\":\"1,2,3,4,5\",\"start\":\"2024-12-01\",\"end\":\"2025-01-01\"}', '2024-12-01', '09:00:00', '17:00:00', '2024-01-22 03:11:33'),
(56, 2, 'International Business Environment', 1, '', '', 1, '{\"dow\":\"1,2,3,4,5\",\"start\":\"2025-01-01\",\"end\":\"2025-02-01\"}', '2025-01-01', '09:00:00', '17:00:00', '2024-01-22 03:11:33'),
(57, 2, 'Managing and Leading People', 1, '', '', 1, '{\"dow\":\"1,2,3,4,5\",\"start\":\"2025-02-01\",\"end\":\"2025-03-01\"}', '2025-02-01', '09:00:00', '17:00:00', '2024-01-22 03:11:33'),
(58, 2, 'International Trade', 1, '', '', 1, '{\"dow\":\"1,2,3,4,5\",\"start\":\"2025-03-01\",\"end\":\"2025-04-01\"}', '2025-03-01', '09:00:00', '17:00:00', '2024-01-22 03:11:33'),
(59, 2, 'International HRM', 1, '', '', 1, '{\"dow\":\"1,2,3,4,5\",\"start\":\"2025-04-01\",\"end\":\"2025-05-01\"}', '2025-04-01', '09:00:00', '17:00:00', '2024-01-22 03:11:33'),
(60, 2, 'Cross Cultural Management', 1, '', '', 1, '{\"dow\":\"1,2,3,4,5\",\"start\":\"2025-05-01\",\"end\":\"2025-06-01\"}', '2025-05-01', '09:00:00', '17:00:00', '2024-01-22 03:11:33'),
(61, 2, 'Developing Skills for Business Leadership', 1, '', '', 1, '{\"dow\":\"1,2,3,4,5\",\"start\":\"2025-06-01\",\"end\":\"2025-07-01\"}', '2025-06-01', '09:00:00', '17:00:00', '2024-01-22 03:11:33'),
(62, 2, 'Marketing Management', 1, '', '', 1, '{\"dow\":\"1,2,3,4,5\",\"start\":\"2025-07-01\",\"end\":\"2025-08-01\"}', '2025-07-01', '09:00:00', '17:00:00', '2024-01-22 03:11:33'),
(63, 2, 'Enterprise and Entrepreneurship', 1, '', '', 1, '{\"dow\":\"1,2,3,4,5\",\"start\":\"2025-08-01\",\"end\":\"2025-09-01\"}', '2025-08-01', '09:00:00', '17:00:00', '2024-01-22 03:11:33'),
(64, 2, 'International Trade', 1, '', '', 1, '{\"dow\":\"1,2,3,4,5\",\"start\":\"2025-09-01\",\"end\":\"2025-10-01\"}', '2025-09-01', '09:00:00', '17:00:00', '2024-01-22 03:11:33'),
(65, 2, 'International HRM', 1, '', '', 1, '{\"dow\":\"1,2,3,4,5\",\"start\":\"2025-10-01\",\"end\":\"2025-11-01\"}', '2025-10-01', '09:00:00', '17:00:00', '2024-01-22 03:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(30) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject`, `description`) VALUES
(6, 'MSc Management', ''),
(7, 'MSc Management with Finance', ''),
(8, 'MSc Management with Marketing', ''),
(9, 'MSc Management with HR', ''),
(10, 'MSc Management with Law', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2=Staff, 3= subscriber'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_schedule_info`
--
ALTER TABLE `class_schedule_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_schedule_info`
--
ALTER TABLE `class_schedule_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
