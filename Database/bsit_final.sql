-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2025 at 03:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bsit_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `first_semester_students`
--

CREATE TABLE `first_semester_students` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `grade` decimal(5,2) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `professor_id` int(11) DEFAULT NULL,
  `semester` enum('1st Semester','2nd Semester') DEFAULT '1st Semester',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `full_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `first_semester_students`
--

INSERT INTO `first_semester_students` (`id`, `student_id`, `grade`, `subject_id`, `professor_id`, `semester`, `date_added`, `full_name`) VALUES
(84, 77, 70.00, 8, 69, '1st Semester', '0000-00-00 00:00:00', 'Jb'),
(85, 78, 33.00, 8, 69, '1st Semester', '2025-01-31 07:41:07', 'jose'),
(86, 79, 75.00, 8, 69, '1st Semester', '2025-02-02 23:49:43', 'Kim Carlo Salimbagat'),
(89, 73, 78.00, 9, 73, '1st Semester', '2025-02-20 08:18:58', 'jayco manguilimutan');

-- --------------------------------------------------------

--
-- Table structure for table `first_year`
--

CREATE TABLE `first_year` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) DEFAULT './assets/profile-images/default-profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fourth_year`
--

CREATE TABLE `fourth_year` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) DEFAULT './assets/profile-images/default-profile.png',
  `semester` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fourth_year`
--

INSERT INTO `fourth_year` (`id`, `full_name`, `email`, `password`, `created_at`, `profile_image`, `semester`) VALUES
(73, 'jayco manguilimutan', 'jaycomanguilimotan896@gmail.com', '$2y$10$0EqaqZRDmHyr.z5bsLKBJOxW6mCsoYFBf5N41tGYO6.t489BHJx8i', '2025-02-20 14:11:07', './assets/profile-images/profile_67b5297c24fca0.33909174.jpg', ''),
(77, 'Kim Carlo Salimbagat', 'kim@gmail.com', '$2y$10$93ovf8Diateos2TJ4uzt6eK0QozKSBF75MMt8FgyQjFlp967GEFii', '2025-02-03 06:48:51', './assets/profile-images/default-profile.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1= active. 0= Deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `title`, `bio`, `status`) VALUES
(1, 'cpr', '<p style=\"text-align: center;\"> CopyRight by <a href=\"https://www.youtube.com/@codecampbdofficial\">Code Camp BD</a> Design and Developer <a href=\"https://developerrony.com\">MH RONY</a> All Resalve\n                <?php echo \"20\".date(\"y\"); ?></p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `like_reactions`
--

CREATE TABLE `like_reactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `reaction_type` enum('like') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `like_reactions`
--

INSERT INTO `like_reactions` (`id`, `user_id`, `post_id`, `reaction_type`, `created_at`) VALUES
(12, 73, 11, 'like', '2025-02-20 14:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) DEFAULT NULL,
  `year_level` varchar(20) DEFAULT 'Unassigned'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`id`, `full_name`, `email`, `password`, `created_at`, `profile_image`, `year_level`) VALUES
(69, 'dino', 'dino@gmail.com', '$2y$10$Xa8yVkVAnSHU6TKOmxVwbeLuLPWT2mTpB2L8g/gV9E5bYfV80gfzq', '2025-01-31 03:57:54', './assets/profile-images/default-profile.png', '4th Year'),
(73, 'Dandan', 'dandan@gmail.com', '$2y$10$j.rN6WsJxtUn4Qg5IU2yw.dFbW/maiDw63n.6TSBYCVMzx8.sGZ5S', '2025-01-31 14:17:01', NULL, '4th Year'),
(74, 'Clint Clarido', 'clint@gmail.com', '$2y$10$w70x4Gqz4qnhYvvGzVG8Y.Dt8slM4lMOVNe6afL5SNA.jxOAqSgzS', '2025-02-19 22:29:55', NULL, '4th Year');

-- --------------------------------------------------------

--
-- Table structure for table `professors_post`
--

CREATE TABLE `professors_post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `PostText` text DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `likes` int(11) DEFAULT 0,
  `comments_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professors_post`
--

INSERT INTO `professors_post` (`id`, `user_id`, `PostText`, `PostImage`, `created_at`, `likes`, `comments_count`) VALUES
(11, 71, 'sample', '67a9dd24105c5.jpg', '2025-02-10 11:04:04', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `professor_comments`
--

CREATE TABLE `professor_comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor_comments`
--

INSERT INTO `professor_comments` (`id`, `post_id`, `user_id`, `comment_text`, `created_at`) VALUES
(1, 11, 71, 'hello', '2025-02-10 19:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `second_semester_students`
--

CREATE TABLE `second_semester_students` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `grade` decimal(5,2) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `semester` enum('1st Semester','2nd Semester') DEFAULT '2nd Semester',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `full_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `second_semester_students`
--

INSERT INTO `second_semester_students` (`id`, `student_id`, `grade`, `subject_id`, `professor_id`, `semester`, `date_added`, `full_name`) VALUES
(3, 77, 90.00, 8, 69, '2nd Semester', '2025-02-02 22:10:21', 'Jb'),
(4, 79, 80.00, 8, 69, '2nd Semester', '0000-00-00 00:00:00', 'Kim Carlo Salimbagat'),
(7, 73, 90.00, 10, 73, '2nd Semester', '2025-02-20 08:19:11', 'jayco manguilimutan');

-- --------------------------------------------------------

--
-- Table structure for table `second_year`
--

CREATE TABLE `second_year` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) DEFAULT './assets/profile-images/default-profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `second_year`
--

INSERT INTO `second_year` (`id`, `full_name`, `email`, `password`, `created_at`, `profile_image`) VALUES
(66, 'Jb', 'jb@gmail.com', '$2y$10$XZo3oW7FkqbqhXiRjVd2IO6Txd8YOMOCChKFJ5ubWZQ0.aLMY/mrW', '2025-01-31 14:38:45', './assets/profile-images/default-profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `student_comments`
--

CREATE TABLE `student_comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_comments`
--

INSERT INTO `student_comments` (`id`, `post_id`, `user_id`, `comment_text`, `created_at`) VALUES
(4, 11, 73, 'hello', '2025-02-10 11:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `student_grades`
--

CREATE TABLE `student_grades` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_grades`
--

INSERT INTO `student_grades` (`id`, `user_id`, `grade`, `date_added`) VALUES
(76, 67, '76', '2025-01-31 05:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `semester` enum('1st Semester','2nd Semester') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `semester`, `created_at`) VALUES
(8, 'sample', '1st Semester', '2025-01-31 05:11:02'),
(9, 'PCIT19', '1st Semester', '2025-02-19 00:17:26'),
(10, 'PCIT20', '2nd Semester', '2025-02-19 00:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `AdminUserName` varchar(255) DEFAULT NULL,
  `AdminPassword` varchar(255) DEFAULT NULL,
  `AdminEmailId` varchar(255) DEFAULT NULL,
  `userType` int(11) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `AdminUserName`, `AdminPassword`, `AdminEmailId`, `userType`, `CreationDate`, `UpdationDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'jayjayzjpa@gmail.com', 1, '2022-12-12 18:30:00', '2025-01-16 05:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE `tblcomments` (
  `id` int(11) NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comment` mediumtext DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblgrades`
--

CREATE TABLE `tblgrades` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_year` enum('1st Year','2nd Year','3rd Year','4th Year') NOT NULL,
  `semester` enum('1st Sem','2nd Sem') NOT NULL,
  `course_no` varchar(20) NOT NULL,
  `descriptive_title` varchar(255) NOT NULL,
  `grade` decimal(5,2) DEFAULT NULL,
  `re` varchar(10) DEFAULT NULL,
  `unit` int(11) NOT NULL,
  `pre_req` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `year_form` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblgrades`
--

INSERT INTO `tblgrades` (`id`, `student_id`, `student_name`, `student_year`, `semester`, `course_no`, `descriptive_title`, `grade`, `re`, `unit`, `pre_req`, `created_at`, `year_form`) VALUES
(1137, '123', '', '1st Year', '1st Sem', 'PCIT-14', 'Practicum', 67.00, NULL, 6, '4th Year', '2025-03-30 08:47:11', '[\"4\"]'),
(1138, '123', '', '1st Year', '2nd Sem', 'PCIT-15 - 4th year', 'System Integration & Architecture 2', 67.00, NULL, 3, 'PCIT-11', '2025-03-30 08:47:11', '[\"4\"]'),
(1139, '123', '', '1st Year', '2nd Sem', 'PCIT-16 - 4th year', 'Capstone Project & Research 2', 67.00, NULL, 3, '', '2025-03-30 08:47:11', '[\"4\"]'),
(1140, '123', '', '1st Year', '2nd Sem', 'PSIT-01 - 4th year', 'Application Development & Emerging Tech 2', 67.00, NULL, 3, '', '2025-03-30 08:47:11', '[\"4\"]'),
(1141, '123', '', '1st Year', '2nd Sem', 'GEL3 - 4th year', 'Philippine Popular Culture', 67.00, NULL, 3, '', '2025-03-30 08:47:11', '[\"4\"]'),
(1142, '123', '', '1st Year', '1st Sem', 'CCIT 06', 'Applications Development and Emerging Technologies', 56.00, NULL, 3, '', '2025-03-30 08:47:27', '[\"3\"]'),
(1143, '123', '', '1st Year', '1st Sem', 'PFIT 03', 'Web System and Technology', 56.00, NULL, 3, 'PCIT 02', '2025-03-30 08:47:27', '[\"3\"]'),
(1144, '123', '', '1st Year', '1st Sem', 'PCIT 11', 'System Architecture', 56.00, NULL, 3, 'PCIT 03', '2025-03-30 08:47:27', '[\"3\"]'),
(1145, '123', '', '1st Year', '1st Sem', 'PCIT 09', 'Networking 2', 56.00, NULL, 3, 'PCIT 04', '2025-03-30 08:47:27', '[\"3\"]'),
(1146, '123', '', '1st Year', '1st Sem', 'PSIT 04', 'Technopreneurship', 65.00, NULL, 3, '', '2025-03-30 08:47:27', '[\"3\"]'),
(1147, '123', '', '1st Year', '1st Sem', 'PSIT 03', 'IT Security and Management', 65.00, NULL, 3, 'CCIT 05', '2025-03-30 08:47:27', '[\"3\"]'),
(1148, '123', '', '1st Year', '1st Sem', 'GEC 9', 'Life, Works and Writing of Dr. Jose Rizal', 56.00, NULL, 3, '', '2025-03-30 08:47:27', '[\"3\"]'),
(1149, '123', '', '1st Year', '2nd Sem', 'PCIT 12', 'Information Assurance and Security 2', 90.00, NULL, 3, 'PCIT 07', '2025-03-30 08:47:27', '[\"3\"]'),
(1150, '123', '', '1st Year', '2nd Sem', 'PCIT 13', 'Capstone Project and Research 1', 45.00, NULL, 3, 'PCIT 07, CCIT 06', '2025-03-30 08:47:27', '[\"3\"]'),
(1151, '123', '', '1st Year', '2nd Sem', 'PSIT 02', 'Data Mining Methodology', 56.00, NULL, 3, '', '2025-03-30 08:47:27', '[\"3\"]'),
(1152, '123', '', '1st Year', '2nd Sem', 'PFIT 04', 'Software Engineering', 56.00, NULL, 3, 'CCIT 06', '2025-03-30 08:47:27', '[\"3\"]'),
(1153, '123', '', '1st Year', '2nd Sem', 'PSIT 05', 'Regression Analysis', 67.00, NULL, 3, '', '2025-03-30 08:47:27', '[\"3\"]'),
(1154, '123', '', '1st Year', '2nd Sem', 'PFIT 06', 'Business Process Management', 56.00, NULL, 3, '', '2025-03-30 08:47:27', '[\"3\"]'),
(1155, '123', '', '1st Year', '2nd Sem', 'SEMINAR', 'Seminars', 45.00, NULL, 3, '', '2025-03-30 08:47:27', '[\"3\"]'),
(1156, '123', '', '1st Year', '1st Sem', 'PCIT-15', 'Data Structures and Algorithms', 90.00, NULL, 3, 'CCIT-03', '2025-03-30 08:47:48', '[\"2\"]'),
(1157, '123', '', '1st Year', '1st Sem', 'PCIT-16', 'Integrative Programming and Technologies 1', 90.00, NULL, 3, 'CCIT-03', '2025-03-30 08:47:48', '[\"2\"]'),
(1158, '123', '', '1st Year', '1st Sem', 'PSIT-01', 'Platform Technologies', 90.00, NULL, 3, '', '2025-03-30 08:47:48', '[\"2\"]'),
(1159, '123', '', '1st Year', '1st Sem', 'GEL3', 'Introduction to Human-Computer Interaction', 90.00, NULL, 3, 'CCIT-02', '2025-03-30 08:47:48', '[\"2\"]'),
(1160, '123', '', '1st Year', '1st Sem', 'PSIT-02', 'Social and Professional Issues', 90.00, NULL, 3, '', '2025-03-30 08:47:48', '[\"2\"]'),
(1161, '123', '', '1st Year', '1st Sem', 'PATHFIT-3', 'Folk Dance and Other Dance Forms', 90.00, NULL, 2, 'PE-02', '2025-03-30 08:47:48', '[\"2\"]'),
(1162, '123', '', '1st Year', '2nd Sem', 'PCIT-17', 'Object-Oriented Programming', 90.00, NULL, 3, 'PCIT-15', '2025-03-30 08:47:48', '[\"2\"]'),
(1163, '123', '', '1st Year', '2nd Sem', 'PCIT-18', 'Database Management System 2', 90.00, NULL, 3, 'PCIT-12', '2025-03-30 08:47:48', '[\"2\"]'),
(1164, '123', '', '1st Year', '2nd Sem', 'PSIT-03', 'Network Security', 78.00, NULL, 3, 'PCIT-14', '2025-03-30 08:47:48', '[\"2\"]'),
(1165, '123', '', '1st Year', '2nd Sem', 'GEL4', 'Environmental Science', 78.00, NULL, 3, '', '2025-03-30 08:47:48', '[\"2\"]'),
(1166, '123', '', '1st Year', '2nd Sem', 'PSIT-04', 'IT Infrastructure', 67.00, NULL, 3, '', '2025-03-30 08:47:48', '[\"2\"]'),
(1167, '123', '', '1st Year', '2nd Sem', 'PATHFIT-4', 'Sports Science and Recreation', 67.00, NULL, 2, 'PATHFIT-3', '2025-03-30 08:47:48', '[\"2\"]'),
(1168, '123', '', '1st Year', '1st Sem', 'CCIT-01', 'Introduction to Computing', 90.00, NULL, 3, 'None', '2025-03-30 08:47:58', '[\"1\"]'),
(1169, '123', '', '1st Year', '1st Sem', 'CCIT-02', 'Computer Programming 1', 90.00, NULL, 3, 'None', '2025-03-30 08:47:58', '[\"1\"]'),
(1170, '123', '', '1st Year', '1st Sem', 'GEC-1', 'Understanding the Self', 90.00, NULL, 3, 'None', '2025-03-30 08:47:58', '[\"1\"]'),
(1171, '123', '', '1st Year', '1st Sem', 'GEC-6', 'Art Appreciation', 90.00, NULL, 3, 'None', '2025-03-30 08:47:58', '[\"1\"]'),
(1172, '123', '', '1st Year', '1st Sem', 'GEC-2', 'Readings in Philippine History', 90.00, NULL, 3, 'None', '2025-03-30 08:47:58', '[\"1\"]'),
(1173, '123', '', '1st Year', '1st Sem', 'GEC-5', 'Purposive Communication', 90.00, NULL, 3, 'None', '2025-03-30 08:47:58', '[\"1\"]'),
(1174, '123', '', '1st Year', '1st Sem', 'GEC-4', 'Mathematics in the Modern World', 90.00, NULL, 3, 'None', '2025-03-30 08:47:58', '[\"1\"]'),
(1175, '123', '', '1st Year', '1st Sem', 'PE-1', 'PATH FIT 1 - Movement Enhancement', 90.00, NULL, 2, 'None', '2025-03-30 08:47:58', '[\"1\"]'),
(1176, '123', '', '1st Year', '1st Sem', 'NSTP-1', 'National Service Training Program 1', 90.00, NULL, 3, 'None', '2025-03-30 08:47:58', '[\"1\"]'),
(1177, '123', '', '1st Year', '2nd Sem', 'CCIT-03', 'Computer Programming 2', 89.00, NULL, 3, 'CCIT-02', '2025-03-30 08:47:58', '[\"1\"]'),
(1178, '123', '', '1st Year', '2nd Sem', 'CCIT-04', 'Discrete Structures', 90.00, NULL, 3, 'None', '2025-03-30 08:47:58', '[\"1\"]'),
(1179, '123', '', '1st Year', '2nd Sem', 'CCIT-05', 'Digital Logic Design', 90.00, NULL, 3, 'None', '2025-03-30 08:47:58', '[\"1\"]'),
(1180, '123', '', '1st Year', '2nd Sem', 'GEC-3', 'The Contemporary World', 90.00, NULL, 3, 'None', '2025-03-30 08:47:58', '[\"1\"]'),
(1181, '123', '', '1st Year', '2nd Sem', 'GEC-7', 'Science, Technology, and Society', 90.00, NULL, 3, 'None', '2025-03-30 08:47:58', '[\"1\"]'),
(1182, '123', '', '1st Year', '2nd Sem', 'GEC-8', 'Ethics', 90.00, NULL, 3, 'None', '2025-03-30 08:47:58', '[\"1\"]'),
(1183, '123', '', '1st Year', '2nd Sem', 'GEC-9', 'Filipino 1 - Komunikasyon sa Akademikong Filipino', 90.00, NULL, 3, 'None', '2025-03-30 08:47:58', '[\"1\"]'),
(1184, '123', '', '1st Year', '2nd Sem', 'PE-2', 'PATH FIT 2 - Exercise-based Fitness Activities', 90.00, NULL, 2, 'PE-1', '2025-03-30 08:47:58', '[\"1\"]'),
(1185, '123', '', '1st Year', '2nd Sem', 'NSTP-2', 'National Service Training Program 2', 90.00, NULL, 3, 'NSTP-1', '2025-03-30 08:47:58', '[\"1\"]'),
(1186, '000', '', '1st Year', '1st Sem', 'PCIT-14', 'Practicum', 67.00, NULL, 6, '4th Year', '2025-03-30 13:14:32', '[\"4\"]'),
(1187, '000', '', '1st Year', '2nd Sem', 'PCIT-15 - 4th year', 'System Integration & Architecture 2', 67.00, NULL, 3, 'PCIT-11', '2025-03-30 13:14:32', '[\"4\"]'),
(1188, '000', '', '1st Year', '2nd Sem', 'PCIT-16 - 4th year', 'Capstone Project & Research 2', 67.00, NULL, 3, '', '2025-03-30 13:14:32', '[\"4\"]'),
(1189, '000', '', '1st Year', '2nd Sem', 'PSIT-01 - 4th year', 'Application Development & Emerging Tech 2', 67.00, NULL, 3, '', '2025-03-30 13:14:32', '[\"4\"]'),
(1190, '000', '', '1st Year', '2nd Sem', 'GEL3 - 4th year', 'Philippine Popular Culture', 67.00, NULL, 3, '', '2025-03-30 13:14:32', '[\"4\"]'),
(1191, '000', '', '1st Year', '1st Sem', 'CCIT-01', 'Introduction to Computing', 7.00, NULL, 3, 'None', '2025-04-01 03:49:24', '[\"1\"]'),
(1192, '000', '', '1st Year', '1st Sem', 'CCIT-02', 'Computer Programming 1', 90.00, NULL, 3, 'None', '2025-04-01 03:49:24', '[\"1\"]'),
(1193, '000', '', '1st Year', '1st Sem', 'GEC-1', 'Understanding the Self', 90.00, NULL, 3, 'None', '2025-04-01 03:49:24', '[\"1\"]'),
(1194, '000', '', '1st Year', '1st Sem', 'GEC-6', 'Art Appreciation', 90.00, NULL, 3, 'None', '2025-04-01 03:49:24', '[\"1\"]'),
(1195, '000', '', '1st Year', '1st Sem', 'GEC-2', 'Readings in Philippine History', 90.00, NULL, 3, 'None', '2025-04-01 03:49:24', '[\"1\"]'),
(1196, '000', '', '1st Year', '1st Sem', 'GEC-5', 'Purposive Communication', 90.00, NULL, 3, 'None', '2025-04-01 03:49:24', '[\"1\"]'),
(1197, '000', '', '1st Year', '1st Sem', 'GEC-4', 'Mathematics in the Modern World', 90.00, NULL, 3, 'None', '2025-04-01 03:49:24', '[\"1\"]'),
(1198, '000', '', '1st Year', '1st Sem', 'PE-1', 'PATH FIT 1 - Movement Enhancement', 90.00, NULL, 2, 'None', '2025-04-01 03:49:24', '[\"1\"]'),
(1199, '000', '', '1st Year', '1st Sem', 'NSTP-1', 'National Service Training Program 1', 90.00, NULL, 3, 'None', '2025-04-01 03:49:24', '[\"1\"]'),
(1200, '000', '', '1st Year', '2nd Sem', 'CCIT-03', 'Computer Programming 2', 89.00, NULL, 3, 'CCIT-02', '2025-04-01 03:49:24', '[\"1\"]'),
(1201, '000', '', '1st Year', '2nd Sem', 'CCIT-04', 'Discrete Structures', 90.00, NULL, 3, 'None', '2025-04-01 03:49:24', '[\"1\"]'),
(1202, '000', '', '1st Year', '2nd Sem', 'CCIT-05', 'Digital Logic Design', 90.00, NULL, 3, 'None', '2025-04-01 03:49:24', '[\"1\"]'),
(1203, '000', '', '1st Year', '2nd Sem', 'GEC-3', 'The Contemporary World', 90.00, NULL, 3, 'None', '2025-04-01 03:49:24', '[\"1\"]'),
(1204, '000', '', '1st Year', '2nd Sem', 'GEC-7', 'Science, Technology, and Society', 90.00, NULL, 3, 'None', '2025-04-01 03:49:24', '[\"1\"]'),
(1205, '000', '', '1st Year', '2nd Sem', 'GEC-8', 'Ethics', 90.00, NULL, 3, 'None', '2025-04-01 03:49:24', '[\"1\"]'),
(1206, '000', '', '1st Year', '2nd Sem', 'GEC-9', 'Filipino 1 - Komunikasyon sa Akademikong Filipino', 90.00, NULL, 3, 'None', '2025-04-01 03:49:24', '[\"1\"]'),
(1207, '000', '', '1st Year', '2nd Sem', 'PE-2', 'PATH FIT 2 - Exercise-based Fitness Activities', 90.00, NULL, 2, 'PE-1', '2025-04-01 03:49:24', '[\"1\"]'),
(1208, '000', '', '1st Year', '2nd Sem', 'NSTP-2', 'National Service Training Program 2', 90.00, NULL, 3, 'NSTP-1', '2025-04-01 03:49:24', '[\"1\"]'),
(1209, '321', '', '1st Year', '1st Sem', 'CCIT-01', 'Introduction to Computing', 70.00, NULL, 3, 'None', '2025-04-02 03:20:39', '[\"1\"]'),
(1210, '321', '', '1st Year', '1st Sem', 'CCIT-02', 'Computer Programming 1', 90.00, NULL, 3, 'None', '2025-04-02 03:20:39', '[\"1\"]'),
(1211, '321', '', '1st Year', '1st Sem', 'GEC-1', 'Understanding the Self', 89.00, NULL, 3, 'None', '2025-04-02 03:20:39', '[\"1\"]'),
(1212, '321', '', '1st Year', '1st Sem', 'GEC-6', 'Art Appreciation', 78.00, NULL, 3, 'None', '2025-04-02 03:20:39', '[\"1\"]'),
(1213, '321', '', '1st Year', '1st Sem', 'GEC-2', 'Readings in Philippine History', 78.00, NULL, 3, 'None', '2025-04-02 03:20:39', '[\"1\"]'),
(1214, '321', '', '1st Year', '1st Sem', 'GEC-5', 'Purposive Communication', 90.00, NULL, 3, 'None', '2025-04-02 03:20:39', '[\"1\"]'),
(1215, '321', '', '1st Year', '1st Sem', 'GEC-4', 'Mathematics in the Modern World', 89.00, NULL, 3, 'None', '2025-04-02 03:20:39', '[\"1\"]'),
(1216, '321', '', '1st Year', '1st Sem', 'PE-1', 'PATH FIT 1 - Movement Enhancement', 89.00, NULL, 2, 'None', '2025-04-02 03:20:39', '[\"1\"]'),
(1217, '321', '', '1st Year', '1st Sem', 'NSTP-1', 'National Service Training Program 1', 78.00, NULL, 3, 'None', '2025-04-02 03:20:39', '[\"1\"]'),
(1218, '321', '', '1st Year', '2nd Sem', 'CCIT-03', 'Computer Programming 2', 90.00, NULL, 3, 'CCIT-02', '2025-04-02 03:20:39', '[\"1\"]'),
(1219, '321', '', '1st Year', '2nd Sem', 'CCIT-04', 'Discrete Structures', 90.00, NULL, 3, 'None', '2025-04-02 03:20:39', '[\"1\"]'),
(1220, '321', '', '1st Year', '2nd Sem', 'CCIT-05', 'Digital Logic Design', 90.00, NULL, 3, 'None', '2025-04-02 03:20:39', '[\"1\"]'),
(1221, '321', '', '1st Year', '2nd Sem', 'GEC-3', 'The Contemporary World', 90.00, NULL, 3, 'None', '2025-04-02 03:20:39', '[\"1\"]'),
(1222, '321', '', '1st Year', '2nd Sem', 'GEC-7', 'Science, Technology, and Society', 90.00, NULL, 3, 'None', '2025-04-02 03:20:39', '[\"1\"]'),
(1223, '321', '', '1st Year', '2nd Sem', 'GEC-8', 'Ethics', 90.00, NULL, 3, 'None', '2025-04-02 03:20:39', '[\"1\"]'),
(1224, '321', '', '1st Year', '2nd Sem', 'GEC-9', 'Filipino 1 - Komunikasyon sa Akademikong Filipino', 90.00, NULL, 3, 'None', '2025-04-02 03:20:39', '[\"1\"]'),
(1225, '321', '', '1st Year', '2nd Sem', 'PE-2', 'PATH FIT 2 - Exercise-based Fitness Activities', 90.00, NULL, 2, 'PE-1', '2025-04-02 03:20:39', '[\"1\"]'),
(1226, '321', '', '1st Year', '2nd Sem', 'NSTP-2', 'National Service Training Program 2', 90.00, NULL, 3, 'NSTP-1', '2025-04-02 03:20:39', '[\"1\"]'),
(1227, '321', '', '1st Year', '1st Sem', 'PCIT-15', 'Data Structures and Algorithms', NULL, NULL, 3, 'CCIT-03', '2025-04-02 03:55:51', '[\"2\"]'),
(1228, '321', '', '1st Year', '1st Sem', 'PCIT-16', 'Integrative Programming and Technologies 1', NULL, NULL, 3, 'CCIT-03', '2025-04-02 03:55:51', '[\"2\"]'),
(1229, '321', '', '1st Year', '1st Sem', 'PSIT-01', 'Platform Technologies', NULL, NULL, 3, '', '2025-04-02 03:55:51', '[\"2\"]'),
(1230, '321', '', '1st Year', '1st Sem', 'GEL3', 'Introduction to Human-Computer Interaction', NULL, NULL, 3, 'CCIT-02', '2025-04-02 03:55:51', '[\"2\"]'),
(1231, '321', '', '1st Year', '1st Sem', 'PSIT-02', 'Social and Professional Issues', NULL, NULL, 3, '', '2025-04-02 03:55:51', '[\"2\"]'),
(1232, '321', '', '1st Year', '1st Sem', 'PATHFIT-3', 'Folk Dance and Other Dance Forms', NULL, NULL, 2, 'PE-02', '2025-04-02 03:55:51', '[\"2\"]'),
(1233, '321', '', '1st Year', '2nd Sem', 'PCIT-17', 'Object-Oriented Programming', 90.00, NULL, 3, 'PCIT-15', '2025-04-02 03:55:51', '[\"2\"]'),
(1234, '321', '', '1st Year', '2nd Sem', 'PCIT-18', 'Database Management System 2', 90.00, NULL, 3, 'PCIT-12', '2025-04-02 03:55:51', '[\"2\"]'),
(1235, '321', '', '1st Year', '2nd Sem', 'PSIT-03', 'Network Security', 90.00, NULL, 3, 'PCIT-14', '2025-04-02 03:55:51', '[\"2\"]'),
(1236, '321', '', '1st Year', '2nd Sem', 'GEL4', 'Environmental Science', 90.00, NULL, 3, '', '2025-04-02 03:55:51', '[\"2\"]'),
(1237, '321', '', '1st Year', '2nd Sem', 'PSIT-04', 'IT Infrastructure', 90.00, NULL, 3, '', '2025-04-02 03:55:51', '[\"2\"]'),
(1238, '321', '', '1st Year', '2nd Sem', 'PATHFIT-4', 'Sports Science and Recreation', 90.00, NULL, 2, 'PATHFIT-3', '2025-04-02 03:55:51', '[\"2\"]');

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `PageTitle`, `Description`, `PostingDate`, `UpdationDate`) VALUES
(1, 'aboutus', 'About the BSIT Department at Central Philippines State University (CPSU)', '<p>The <strong>BSIT Department</strong> at <strong>Central Philippines State University (CPSU)</strong> is dedicated to providing top-notch education in the field of Information Technology. With a focus on both theoretical knowledge and practical skills, the department equips students with the expertise needed to excel in the ever-evolving tech industry.</p><p>Our program emphasizes hands-on learning, innovation, and the development of critical problem-solving skills. Students are prepared for careers in various IT sectors, including software development, network administration, cybersecurity, and data management, ensuring they are well-prepared to meet the challenges of a global digital economy.</p><p>At CPSU, we are committed to fostering a learning environment that promotes academic excellence, industry readiness, and the ethical application of technology.</p>', '2021-06-29 18:30:00', '2024-11-16 04:34:31'),
(2, 'contactus', 'Contact Details', '<p style=\"text-align: justify;\"><br></p><p style=\"text-align: justify;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"font-weight: 600; font-family: &quot;Hind Madurai&quot;, sans-serif; text-align: center;\">Name:&nbsp;&nbsp;</span><span style=\"text-align: center;\">&nbsp; &nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"text-align: center;\"><b> CPSU BSIT</b></span><b></b></p><p style=\"text-align: justify;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Address :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> San Carlos City Negros Occidental Philippines&nbsp;</b></p><p style=\"text-align: justify;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style=\"text-align: center;\">Phone Number :&nbsp; &nbsp;+880 1608445456</b></p><p style=\"text-align: justify;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style=\"text-align: center;\">Email -id :&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;bsit@edu.ph</b></p>', '2021-06-29 18:30:00', '2025-03-04 13:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `tblposts`
--

CREATE TABLE `tblposts` (
  `id` int(11) NOT NULL,
  `PostTitle` varchar(255) NOT NULL,
  `PostDetails` text NOT NULL,
  `PostUrl` varchar(255) NOT NULL,
  `Is_Active` tinyint(1) DEFAULT 1,
  `PostImage` text DEFAULT NULL,
  `cloudinary_url` longtext NOT NULL,
  `cloudinary_public_id` longtext NOT NULL,
  `postedBy` int(11) NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `viewCounter` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`id`, `PostTitle`, `PostDetails`, `PostUrl`, `Is_Active`, `PostImage`, `cloudinary_url`, `cloudinary_public_id`, `postedBy`, `PostingDate`, `viewCounter`) VALUES
(59, 'sapoadd', '<p>asfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsfasfsf</p>', 'sapoadd', 0, '', 'https://res.cloudinary.com/dvliuqc1j/image/upload/v1743931791/Updates/Posts/vg968fen4fmgotsr6wsk.avif', 'Updates/Posts/vg968fen4fmgotsr6wsk', 0, '2025-04-06 09:29:53', 2),
(60, 'asas', '<p>asas</p>', 'asas', 0, '', 'https://res.cloudinary.com/dvliuqc1j/image/upload/v1743933210/Updates/Posts/vv1hcfuuteutu72uppkc.jpg', 'Updates/Posts/vv1hcfuuteutu72uppkc', 0, '2025-04-06 09:53:32', 1),
(61, 'asas', '<p>asas</p>', 'asas', 0, '', 'https://res.cloudinary.com/dvliuqc1j/image/upload/v1743946264/Updates/Posts/cljwsosewpaoyqx7duc4.jpg', 'Updates/Posts/cljwsosewpaoyqx7duc4', 0, '2025-04-06 13:31:07', 2),
(62, 'asas', '<p>asas</p>', 'asas', 0, 'a1419361bb4a1a68cd21cde376e5f076.jpeg', 'https://res.cloudinary.com/dvliuqc1j/image/upload/v1743947444/Updates/Posts/nreym193ibjtzugnhzsb.jpg,https://res.cloudinary.com/dvliuqc1j/image/upload/v1743947448/Updates/Posts/lieqgqvrjsefsjae473q.jpg,https://res.cloudinary.com/dvliuqc1j/image/upload/v1743947452/Updates/Posts/uykh2x3uwmjjbtqb2kqm.jpg', 'Updates/Posts/nreym193ibjtzugnhzsb,Updates/Posts/lieqgqvrjsefsjae473q,Updates/Posts/uykh2x3uwmjjbtqb2kqm', 0, '2025-04-06 13:50:55', 1),
(63, 'heyyy', '<p>heyyy</p>', 'aaaaa', 0, '18183ea96600bada4bc66fd2e71437e0.jpg', 'https://res.cloudinary.com/dvliuqc1j/image/upload/v1743950018/Updates/Posts/zyi2wxosdr2hv39qmnxk.jpg', 'Updates/Posts/zyi2wxosdr2hv39qmnxk', 0, '2025-04-06 14:12:30', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_year` enum('1st Year','2nd Year','3rd Year','4th Year') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `student_id`, `student_name`, `student_year`, `created_at`) VALUES
(9, '123', 'jayco ', '4th Year', '2025-02-26 23:34:48'),
(10, '1234', 'hiiiiiiiiiii', '1st Year', '2025-02-26 23:36:52'),
(11, '12345', 'sean', '4th Year', '2025-02-26 23:44:58'),
(12, '321', 'gegege', '1st Year', '2025-02-26 23:48:17'),
(13, '111', '2nd year sample', '2nd Year', '2025-03-19 23:59:59'),
(14, '333', '3rd year sample name', '3rd Year', '2025-03-20 00:01:01'),
(16, '000', '000', '1st Year', '2025-03-24 14:33:19'),
(17, '222', 'test', '4th Year', '2025-03-31 06:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `third_year`
--

CREATE TABLE `third_year` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) DEFAULT './assets/profile-images/default-profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `third_year`
--

INSERT INTO `third_year` (`id`, `full_name`, `email`, `password`, `created_at`, `profile_image`) VALUES
(66, 'jose', 'jose@gmail.com', '$2y$10$ACNs.WFt4Q5r62F9aHmouOMfOJsMx4fLqLLAvm6LM54njC6OkJlrm', '2025-01-31 14:39:17', './assets/profile-images/default-profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','professor') NOT NULL,
  `year` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT './assets/profile-images/default-profile.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `year_level` varchar(20) DEFAULT 'Unassigned'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`, `year`, `profile_image`, `created_at`, `year_level`) VALUES
(71, 'dino', 'dino@gmail.com', '$2y$10$ZQWPHohP7Z0hYLhnkZ3TMOl6qpMtv/ueqLjBNpa284rHM7h8HBsIy', 'professor', '', './assets/profile-images/default-profile.png', '2025-01-31 03:57:54', '4th Year'),
(73, 'jayco manguilimutan', 'jaycomanguilimotan896@gmail.com', '$2y$10$0EqaqZRDmHyr.z5bsLKBJOxW6mCsoYFBf5N41tGYO6.t489BHJx8i', 'student', '4th Year', './assets/profile-images/profile_67b5297c24fca0.33909174.jpg', '2025-01-30 21:12:17', 'Unassigned'),
(75, 'Dandan', 'dandan@gmail.com', '$2y$10$j.rN6WsJxtUn4Qg5IU2yw.dFbW/maiDw63n.6TSBYCVMzx8.sGZ5S', 'professor', '', './assets/profile-images/default-profile.png', '2025-01-31 14:17:01', '4th Year'),
(77, 'Jb', 'jb@gmail.com', '$2y$10$XZo3oW7FkqbqhXiRjVd2IO6Txd8YOMOCChKFJ5ubWZQ0.aLMY/mrW', 'student', '2nd Year', './assets/profile-images/default-profile.png', '2025-01-31 14:38:45', 'Unassigned'),
(78, 'jose', 'jose@gmail.com', '$2y$10$ACNs.WFt4Q5r62F9aHmouOMfOJsMx4fLqLLAvm6LM54njC6OkJlrm', 'student', '3rd Year', './assets/profile-images/default-profile.png', '2025-01-31 14:39:17', 'Unassigned'),
(79, 'Kim Carlo Salimbagat', 'kim@gmail.com', '$2y$10$93ovf8Diateos2TJ4uzt6eK0QozKSBF75MMt8FgyQjFlp967GEFii', 'student', '4th Year', './assets/profile-images/default-profile.png', '2025-02-03 06:48:51', 'Unassigned'),
(80, 'Clint Clarido', 'clint@gmail.com', '$2y$10$w70x4Gqz4qnhYvvGzVG8Y.Dt8slM4lMOVNe6afL5SNA.jxOAqSgzS', 'professor', NULL, './assets/profile-images/default-profile.png', '2025-02-19 22:29:55', '4th Year');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `first_semester_students`
--
ALTER TABLE `first_semester_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `professor_id` (`professor_id`);

--
-- Indexes for table `first_year`
--
ALTER TABLE `first_year`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `fourth_year`
--
ALTER TABLE `fourth_year`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_reactions`
--
ALTER TABLE `like_reactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `professors_post`
--
ALTER TABLE `professors_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `professor_comments`
--
ALTER TABLE `professor_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `second_semester_students`
--
ALTER TABLE `second_semester_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `professor_id` (`professor_id`);

--
-- Indexes for table `second_year`
--
ALTER TABLE `second_year`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `student_comments`
--
ALTER TABLE `student_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AdminUserName` (`AdminUserName`);

--
-- Indexes for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `tblgrades`
--
ALTER TABLE `tblgrades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `third_year`
--
ALTER TABLE `third_year`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `first_semester_students`
--
ALTER TABLE `first_semester_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `first_year`
--
ALTER TABLE `first_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `fourth_year`
--
ALTER TABLE `fourth_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `like_reactions`
--
ALTER TABLE `like_reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `professors`
--
ALTER TABLE `professors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `professors_post`
--
ALTER TABLE `professors_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `professor_comments`
--
ALTER TABLE `professor_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `second_semester_students`
--
ALTER TABLE `second_semester_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `second_year`
--
ALTER TABLE `second_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `student_comments`
--
ALTER TABLE `student_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_grades`
--
ALTER TABLE `student_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblgrades`
--
ALTER TABLE `tblgrades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1239;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `third_year`
--
ALTER TABLE `third_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `first_semester_students`
--
ALTER TABLE `first_semester_students`
  ADD CONSTRAINT `first_semester_students_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `first_semester_students_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `first_semester_students_ibfk_3` FOREIGN KEY (`professor_id`) REFERENCES `professors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `like_reactions`
--
ALTER TABLE `like_reactions`
  ADD CONSTRAINT `like_reactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `professors_post`
--
ALTER TABLE `professors_post`
  ADD CONSTRAINT `professors_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `professor_comments`
--
ALTER TABLE `professor_comments`
  ADD CONSTRAINT `professor_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `professors_post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `professor_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `second_semester_students`
--
ALTER TABLE `second_semester_students`
  ADD CONSTRAINT `second_semester_students_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `second_semester_students_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `second_semester_students_ibfk_3` FOREIGN KEY (`professor_id`) REFERENCES `professors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_comments`
--
ALTER TABLE `student_comments`
  ADD CONSTRAINT `student_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `professors_post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD CONSTRAINT `pid` FOREIGN KEY (`postId`) REFERENCES `tblposts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
