-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 06:45 AM
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
(81, 76, 11.00, 8, 69, '1st Semester', '0000-00-00 00:00:00', 'Joel primr algadipe'),
(82, 73, 75.00, 8, 69, '1st Semester', '0000-00-00 00:00:00', 'jayco Primor jayco'),
(83, 70, 100.00, 8, 69, '1st Semester', '0000-00-00 00:00:00', 'Jayver Primor Algadipe'),
(84, 77, 70.00, 8, 69, '1st Semester', '0000-00-00 00:00:00', 'Jb'),
(85, 78, 33.00, 8, 69, '1st Semester', '2025-01-31 07:41:07', 'jose');

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

--
-- Dumping data for table `first_year`
--

INSERT INTO `first_year` (`id`, `full_name`, `email`, `password`, `created_at`, `profile_image`) VALUES
(76, 'Joel primr algadipe', 'joel@gmail.com', '$2y$10$KiwmFtiJ68IMiu1dFFymQO.z0Gt0DQ9h8uXDLAAxk2brsAGmZUcV6', '2025-01-31 14:23:30', './assets/profile-images/default-profile.png');

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
(67, 'Jayver Primor Algadipe', 'jayjayzjpa@gmail.com', '$2y$10$97j.mogH71KkA0Bf8rtHzecSsOn1Bqcx1JR0T.MLf8iEGomsN0hMy', '2025-01-31 03:52:17', './assets/profile-images/default-profile.png', ''),
(68, 'jayco Primor jayco', 'jaycomanguilimotan896@gmail.com', '$2y$10$0EqaqZRDmHyr.z5bsLKBJOxW6mCsoYFBf5N41tGYO6.t489BHJx8i', '2025-01-30 21:12:17', './assets/profile-images/default-profile.png', '');

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
(69, 'dino', 'dino@gmail.com', '$2y$10$Xa8yVkVAnSHU6TKOmxVwbeLuLPWT2mTpB2L8g/gV9E5bYfV80gfzq', '2025-01-31 03:57:54', './assets/profile-images/default-profile.png', 'Unassigned'),
(73, 'Dandan', 'dandan@gmail.com', '$2y$10$j.rN6WsJxtUn4Qg5IU2yw.dFbW/maiDw63n.6TSBYCVMzx8.sGZ5S', '2025-01-31 14:17:01', NULL, 'Unassigned');

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
(1, 70, 12.00, 8, 69, '2nd Semester', '2025-02-02 21:58:42', 'Jayver Primor Algadipe'),
(2, 73, 80.00, 8, 69, '2nd Semester', '2025-02-02 22:05:59', 'jayco Primor jayco'),
(3, 77, 90.00, 8, 69, '2nd Semester', '2025-02-02 22:10:21', 'Jb');

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
(8, 'sample', '1st Semester', '2025-01-31 05:11:02');

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
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(1, 'ENTERTAINMENT', 'ENTERTAINMENT', '2022-12-13 17:26:13', '2024-11-16 14:14:58', 1),
(2, 'TECHNOLOGY', 'TECHNOLOGY', '2022-12-13 17:36:33', NULL, 1),
(3, 'LIFESTYLE', 'LIFESTYLE', '2022-12-13 17:36:50', NULL, 1),
(4, 'POLITICAL', 'POLITICAL', '2022-12-13 17:37:23', NULL, 1),
(5, 'SPORTS', 'SPORTS', '2022-12-13 17:37:48', NULL, 1),
(6, 'SPIRITUAL', 'SPIRITUAL', '2022-12-16 11:32:39', NULL, 1),
(7, 'IT & Programming', 'Sample post of IT & Programming', '2024-11-16 05:31:57', NULL, 1);

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

--
-- Dumping data for table `tblcomments`
--

INSERT INTO `tblcomments` (`id`, `postId`, `name`, `email`, `comment`, `postingDate`, `status`) VALUES
(1, 4, 'j-aldev', 'jayjayzjpa@gmail.com', 'hi', '2022-12-16 11:20:07', 1);

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
(2, 'contactus', 'Contact Details', '<p style=\"text-align: center;\"><br></p><p style=\"text-align: center; \"><b>Name:&nbsp;&nbsp;</b>&nbsp; &nbsp; CPSU BSIT</p><p style=\"text-align: center; \"></p><p style=\"text-align: center; \"><b>Address : San Carlos City Negros Occidental Philippines&nbsp;</b></p><div style=\"text-align: center;\"><b>Phone Number : +880 1608445456</b></div><p></p><p style=\"text-align: center;\"><b>Email -id : bsit@edu.ph</b></p>', '2021-06-29 18:30:00', '2024-11-15 14:01:56');

-- --------------------------------------------------------

--
-- Table structure for table `tblposts`
--

CREATE TABLE `tblposts` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(11) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `viewCounter` int(11) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`id`, `PostTitle`, `CategoryId`, `SubCategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`, `viewCounter`, `postedBy`, `lastUpdatedBy`) VALUES
(1, 'Team India on top as Bangladesh two wickets away from getting bowled out', 5, 4, '<p>Team India were humbled 2-1 by a resurgent Bangladesh team in the three-match ODI series which the visitors managed to end on a high thanks to Ishan Kishanâ€™s record double century. The Indian cricket team will now want to switch gears to prepare themselves for red-ball cricket as the first Test against Bangladesh gets underway in Chattogram on Wednesday (December 14). India will resume on 278/6 on Day 2 of the first Test on Thursday (December 15).</p><p>The Indian side will be led by KL Rahul with regular skipper Rohit Sharma ruled out after dislocating his thumb in the second ODI against Bangladesh last week. Shubman Gill is expected to take Rohitâ€™s place at the top of the order alongside stand-in skipper Rahul.<br></p><p>Bangladesh, on the other hand, will be led by veteran all-rounder Shakib al Hasan with Tamim Iqbal missing both the ODI and the Test series with injury. The home side will have their task cut out against the world No. 2-ranked Test side India as they eye first-ever Test match win over them.</p><p>India have promised to play aggressive cricket, much like Englandâ€™s â€˜Bazballâ€™ model which has powered them to a Test series win over Babar Azamâ€™s Pakistan. India need win at least 5 of the next 6 upcoming Tests, which includes the next two Test matches against Bangladesh to assure them of a qualification spot in the World Test Championships final next year.</p><p>The Indian side is injury-hit with the likes of Mohammed Shami and Ravindra Jadeja also ruled out with injury apart from skipper Rohit. It will be interesting to see if Jaydev Unadkat will make a return to Test cricket after a gap of 12 years. Mohammed Siraj and Umesh Yadav will be expected the carry the pace-bowling load while Ravichandran Ashwin and Kuldeep Yadav will team up in the spin bowling department.</p><p>Check all the LIVE Scores and Updates from Day 1 of 1st Test between India and Bangladesh here.</p>', '2022-12-15 18:08:34', '2025-01-22 01:10:28', 1, 'Team-India-on-top-as-Bangladesh-two-wickets-away-from-getting-bowled-out', '1167610aa17b0813233fe82d99403e41.jpg', 33, 'admin', NULL),
(2, 'Creative Christmas gift ideas for kids', 3, 8, '<p>With Christmas, a few weeks from now, planning a gift for your kids can be a task quite challenging. Worry not! We have a few ideas for all the parents who are looking for those creative gifts to make their kids Xmas merry.<br></p><div><br></div><p>Being unprepared for Christmas is the very last thing you want. Start looking for presents now, or at the very least start thinking about ideas, rather than waiting until the last minute and this guide is your saviour.<br></p>', '2022-12-15 18:14:00', '2025-01-18 14:55:19', 1, 'Creative-Christmas-gift-ideas-for-kids', '646c8915fc1096c12b679108e7022df9.jpg', 60, 'admin', NULL),
(3, 'Petrol prices still high in your city? Centre blames THESE for costly fuel', 4, 9, '<p>The minister said, currently the petrol price in India is one of the lowest. He said the oil marketing companies together suffered losses of Rs 27,276 crore due to high prices of crude in international markets.</p><p><br></p><p>Six states - West Bengal, Tamil Nadu, Andhra Pradesh, Telengana, Kerala, and Jharkhand - have not reduced the VAT, he said amidst vocal protests by the opposition members. The minister said, currently the petrol price in India is one of the lowest.&nbsp;</p>', '2022-12-15 18:16:46', '2025-01-18 14:55:53', 1, 'Petrol-prices-still-high-in-your-city?-Centre-blames-THESE-for-costly-fuel', 'c1ae896415041d9173d4935145243c14.jpg', 8, 'admin', NULL),
(4, 'Lionel Messi to Kylian Mbappe: Race to FIFA World Cup 2022 Golden Boot, in PICS', 5, 5, '<p>The FIFA World Cup 2022 final are set with Lionel Messis Argentina set to take on Kylian Mbappe France at the Lusail Stadium on Sunday (December 18). Messi and Mbappe, teammates at PSG, are also in the race to win the FIFA World Cup 2022 Golden Boot award as well. In these collection of pictures, we take a look at players in race to win Golden Boot award this year.</p><p>The FIFA World Cup 2022 final are set with Lionel Messis Argentina set to take on Kylian Mbappe France at the Lusail Stadium on Sunday (December 18). Messi and Mbappe, teammates at PSG, are also in the race to win the FIFA World Cup 2022 Golden Boot award as well. In these collection of pictures, we take a look at players in race to win Golden Boot award this year.</p><p>The FIFA World Cup 2022 final are set with Lionel Messis Argentina set to take on Kylian Mbappe France at the Lusail Stadium on Sunday (December 18). Messi and Mbappe, teammates at PSG, are also in the race to win the FIFA World Cup 2022 Golden Boot award as well. In these collection of pictures, we take a look at players in race to win Golden Boot award this year.</p><p>The FIFA World Cup 2022 final are set with Lionel Messis Argentina set to take on Kylian Mbappe France at the Lusail Stadium on Sunday (December 18). Messi and Mbappe, teammates at PSG, are also in the race to win the FIFA World Cup 2022 Golden Boot award as well. In these collection of pictures, we take a look at players in race to win Golden Boot award this year.</p><p><br></p>', '2022-12-15 18:22:51', '2025-01-18 14:53:30', 1, 'Lionel-Messi-to-Kylian-Mbappe:-Race-to-FIFA-World-Cup-2022-Golden-Boot,-in-PICS', 'cefb64713b6ae016047d3bcd8a38e1cc.jpg', 22, 'admin', NULL),
(5, 'Twitter suspends journalists from NYT, Washington Post and others covering Elon Musk: Report', 2, 11, 'The Washington Posts Drew Harwell, alongside other banned reporters, was able to participate in a Twitter Spaces audio session while under suspension, exposing a loophole in Twitter’s enforcement.\r\n\r\n\r\nTwitter Inc. suspended the accounts of upstart rival service Mastodon and several prominent journalists covering the social network’s billionaire owner Elon Musk.\r\n\r\nLate Thursday, reporters from publications including the Washington Post, the New York Times, Mashable and CNN were listed as blocked and their tweets were no longer visible, with the companys standard notice saying it suspends accounts that violate the Twitter rules.\r\n\r\nAlso affected was sports and political commentator Keith Olbermann. Musk said Olbermann will be subject to a 7-day suspension for doxxing. In a separate tweet, he alleged the suspended journalists had posted his exact real-time location, describing the information as basically assassination coordinates.', '2022-12-16 11:34:26', '2025-01-18 14:59:49', 1, 'Twitter-suspends-journalists-from-NYT,-Washington-Post-and-others-covering-Elon-Musk:-Report', 'd7c9faa1953eebd19b2ae47f7f201858.jpg', 149, 'admin', 'admin'),
(6, 'sample IT & Programming', 7, 12, '&nbsp;sample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree text&nbsp;sample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree textsample coding heree text', '2024-11-16 05:33:47', '2025-01-22 01:10:17', 1, 'sample-IT-&-Programming', '6696a49433d2098daf680ecc647ca3c1.jpg', 79, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubcategory`
--

CREATE TABLE `tblsubcategory` (
  `SubCategoryId` int(11) NOT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `Subcategory` varchar(255) DEFAULT NULL,
  `SubCatDescription` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsubcategory`
--

INSERT INTO `tblsubcategory` (`SubCategoryId`, `CategoryId`, `Subcategory`, `SubCatDescription`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(1, 1, 'BOLLYWOOD', 'BOLLYWOOD', '2022-12-13 17:26:52', '2022-12-13 17:42:55', 1),
(2, 1, 'HOLLYWOOD', 'HOLLYWOOD', '2022-12-13 17:27:09', NULL, 1),
(3, 1, 'TELEVISION', 'TELEVISION', '2022-12-13 17:27:35', NULL, 1),
(4, 5, 'CRICKET', 'CRICKET', '2022-12-13 17:39:12', NULL, 1),
(5, 5, 'FOOTBALL', 'FOOTBALL', '2022-12-13 17:39:33', NULL, 1),
(6, 5, 'TENNIS', 'TENNIS', '2022-12-13 17:39:53', NULL, 1),
(7, 5, 'WWE', 'WWE', '2022-12-13 17:40:17', NULL, 1),
(8, 3, 'Culture', 'Culture', '2022-12-15 18:10:39', NULL, 1),
(9, 4, 'Economy', 'Economy', '2022-12-15 18:15:11', NULL, 1),
(10, 6, 'HINDUISM', 'HINDUISM', '2022-12-16 11:32:56', NULL, 1),
(11, 2, 'SOCIAL MEDIA', 'SOCIAL MEDIA', '2022-12-16 11:33:27', NULL, 1),
(12, 7, 'coding', 'Sub-Category Description IT & Programming', '2024-11-16 05:32:27', NULL, 1);

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
(70, 'Jayver Primor Algadipe', 'jayjayzjpa@gmail.com', '$2y$10$EqRfVQvbC6SXiL0RabyecO4eMCBIbT0pT2X7U3AdgEkw2Sl0.swdW', 'student', '4th Year', './assets/profile-images/default-profile.png', '2025-01-31 03:52:17', 'Unassigned'),
(71, 'dino', 'dino@gmail.com', '$2y$10$ZQWPHohP7Z0hYLhnkZ3TMOl6qpMtv/ueqLjBNpa284rHM7h8HBsIy', 'professor', '', './assets/profile-images/default-profile.png', '2025-01-31 03:57:54', 'Unassigned'),
(73, 'jayco Primor jayco', 'jaycomanguilimotan896@gmail.com', '$2y$10$0EqaqZRDmHyr.z5bsLKBJOxW6mCsoYFBf5N41tGYO6.t489BHJx8i', 'student', '4th Year', './assets/profile-images/default-profile.png', '2025-01-30 21:12:17', 'Unassigned'),
(75, 'Dandan', 'dandan@gmail.com', '$2y$10$j.rN6WsJxtUn4Qg5IU2yw.dFbW/maiDw63n.6TSBYCVMzx8.sGZ5S', 'professor', '', './assets/profile-images/default-profile.png', '2025-01-31 14:17:01', 'Unassigned'),
(76, 'Joel primr algadipe', 'joel@gmail.com', '$2y$10$KiwmFtiJ68IMiu1dFFymQO.z0Gt0DQ9h8uXDLAAxk2brsAGmZUcV6', 'student', '1st Year', './assets/profile-images/default-profile.png', '2025-01-31 14:17:35', 'Unassigned'),
(77, 'Jb', 'jb@gmail.com', '$2y$10$XZo3oW7FkqbqhXiRjVd2IO6Txd8YOMOCChKFJ5ubWZQ0.aLMY/mrW', 'student', '2nd Year', './assets/profile-images/default-profile.png', '2025-01-31 14:38:45', 'Unassigned'),
(78, 'jose', 'jose@gmail.com', '$2y$10$ACNs.WFt4Q5r62F9aHmouOMfOJsMx4fLqLLAvm6LM54njC6OkJlrm', 'student', '3rd Year', './assets/profile-images/default-profile.png', '2025-01-31 14:39:17', 'Unassigned');

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
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postcatid` (`CategoryId`),
  ADD KEY `postsucatid` (`SubCategoryId`),
  ADD KEY `subadmin` (`postedBy`);

--
-- Indexes for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD PRIMARY KEY (`SubCategoryId`),
  ADD KEY `catid` (`CategoryId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `first_year`
--
ALTER TABLE `first_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `fourth_year`
--
ALTER TABLE `fourth_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `like_reactions`
--
ALTER TABLE `like_reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `professors`
--
ALTER TABLE `professors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `professors_post`
--
ALTER TABLE `professors_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `professor_comments`
--
ALTER TABLE `professor_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `second_semester_students`
--
ALTER TABLE `second_semester_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `second_year`
--
ALTER TABLE `second_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `student_comments`
--
ALTER TABLE `student_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_grades`
--
ALTER TABLE `student_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  MODIFY `SubCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `third_year`
--
ALTER TABLE `third_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

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

--
-- Constraints for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD CONSTRAINT `postcatid` FOREIGN KEY (`CategoryId`) REFERENCES `tblcategory` (`id`),
  ADD CONSTRAINT `postsucatid` FOREIGN KEY (`SubCategoryId`) REFERENCES `tblsubcategory` (`SubCategoryId`),
  ADD CONSTRAINT `subadmin` FOREIGN KEY (`postedBy`) REFERENCES `tbladmin` (`AdminUserName`);

--
-- Constraints for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD CONSTRAINT `catid` FOREIGN KEY (`CategoryId`) REFERENCES `tblcategory` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
