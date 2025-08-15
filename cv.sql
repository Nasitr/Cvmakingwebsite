-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2025 at 01:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cv`
--

-- --------------------------------------------------------

--
-- Table structure for table `cvs`
--

CREATE TABLE `cvs` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `career_objective` text DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `certifications_json` text DEFAULT NULL,
  `education_json` text DEFAULT NULL,
  `work_experience_json` text DEFAULT NULL,
  `languages_json` text DEFAULT NULL,
  `hobbies_json` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cvs`
--

INSERT INTO `cvs` (`id`, `full_name`, `designation`, `email`, `phone`, `address`, `career_objective`, `skills`, `certifications_json`, `education_json`, `work_experience_json`, `languages_json`, `hobbies_json`, `created_at`, `profile_image`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'null', 'null', 'null', 'null', 'null', '2025-08-03 16:33:04', NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'null', 'null', 'null', 'null', 'null', '2025-08-03 16:37:43', NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'null', 'null', 'null', 'null', 'null', '2025-08-03 16:40:47', NULL),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'null', 'null', 'null', 'null', 'null', '2025-08-03 17:02:23', NULL),
(5, 'wae', NULL, 'sad@gmail.com', '9', 'w', 'w', '', '[\"\",\"\",\"\",\"\"]', '[{\"institute\":\"\",\"year\":\"\",\"course\":\"\"},{\"institute\":\"\",\"year\":\"\",\"course\":\"\"}]', '[{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"},{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"}]', '[\"\",\"\",\"\",\"\"]', '[\"\",\"\",\"\",\"\"]', '2025-08-03 17:49:01', NULL),
(6, 'wae', NULL, 'sad@gmail.com', '9', 'w', 'w', '', '[\"\",\"\",\"\",\"\"]', '[{\"institute\":\"\",\"year\":\"\",\"course\":\"\"},{\"institute\":\"\",\"year\":\"\",\"course\":\"\"}]', '[{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"},{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"}]', '[\"\",\"\",\"\",\"\"]', '[\"\",\"\",\"\",\"\"]', '2025-08-03 18:52:24', NULL),
(7, 'ro', NULL, 's@gmail.com', '8', 'j', 'j', '', '[\"\",\"\",\"\",\"\"]', '[{\"institute\":\"\",\"year\":\"\",\"course\":\"\"},{\"institute\":\"\",\"year\":\"\",\"course\":\"\"}]', '[{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"},{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"}]', '[\"\",\"\",\"\",\"\"]', '[\"\",\"\",\"\",\"\"]', '2025-08-03 18:52:55', NULL),
(8, 'roshni nasit', NULL, 'roshni@gmail.com', '77896541203', 'london', 'whqeuihweiuhwqeiuhwqiuehwqejhwqiehwqiuewehwqiuehwiuehwiuehwqiehwquehwiehwqiuehwieuhwuiehwqieqwenwiheiwhewiqehqwiuehqwieunqwiuehqiweqiuwehwqehwqiewqiejiwueqwejiwquejqwieuhqiwheqwiej', 'html, css, javascript, nodejs,dfsj,sdf', '[\"c1\",\"c2\",\"c3\",\"c4\"]', '[{\"institute\":\"vnsgu\",\"year\":\"2022\",\"course\":\"bca\"},{\"institute\":\"roehampton\",\"year\":\"2025\",\"course\":\"web devlopment\"}]', '[{\"company\":\"arham\",\"start_date\":\"2022-01-01\",\"end_date\":\"2023-02-01\",\"job_title\":\"web devloper\"},{\"company\":\"adjis\",\"start_date\":\"2022-12-12\",\"end_date\":\"\",\"present\":\"1\",\"job_title\":\"wqewe\"}]', '[\"weq\",\"jkiujk\",\"iujk\",\"\"]', '[\"iuj\",\"iujk\",\"\",\"\"]', '2025-08-03 20:38:53', NULL),
(9, 'roshni nasit', NULL, 'roshni@gmail.com', '77896541203', 'london', 'whqeuihweiuhwqeiuhwqiuehwqejhwqiehwqiuewehwqiuehwiuehwiuehwqiehwquehwiehwqiuehwieuhwuiehwqieqwenwiheiwhewiqehqwiuehqwieunqwiuehqiweqiuwehwqehwqiewqiejiwueqwejiwquejqwieuhqiwheqwiej', 'html, css, javascript, nodejs,dfsj,sdf', '[\"c1\",\"c2\",\"c3\",\"c4\"]', '[{\"institute\":\"vnsgu\",\"year\":\"2022\",\"course\":\"bca\"},{\"institute\":\"roehampton\",\"year\":\"2025\",\"course\":\"web devlopment\"}]', '[{\"company\":\"arham\",\"start_date\":\"2022-01-01\",\"end_date\":\"2023-02-01\",\"job_title\":\"web devloper\"},{\"company\":\"adjis\",\"start_date\":\"2022-12-12\",\"end_date\":\"\",\"present\":\"1\",\"job_title\":\"wqewe\"}]', '[\"weq\",\"jkiujk\",\"iujk\",\"\"]', '[\"iuj\",\"iujk\",\"\",\"\"]', '2025-08-03 20:58:54', NULL),
(10, 'sd', 'yu', 'g@gmail.com', '55', 'erw', 'sad', '', '[\"\",\"\",\"\",\"\"]', '[{\"institute\":\"\",\"year\":\"\",\"course\":\"\"},{\"institute\":\"\",\"year\":\"\",\"course\":\"\"}]', '[{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"},{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"}]', '[\"\",\"\",\"\",\"\"]', '[\"\",\"\",\"\",\"\"]', '2025-08-06 14:20:17', ''),
(11, 'sdds', 'erf', 'e@gmail.com', '685', 'wed', 're', '', '[\"\",\"\",\"\",\"\"]', '[{\"institute\":\"\",\"year\":\"\",\"course\":\"\"},{\"institute\":\"\",\"year\":\"\",\"course\":\"\"}]', '[{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"},{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"}]', '[\"\",\"\",\"\",\"\"]', '[\"\",\"\",\"\",\"\"]', '2025-08-07 14:01:16', ''),
(12, 'sdds', 'erf', 'e@gmail.com', '685', 'wed', 're', '', '[\"\",\"\",\"\",\"\"]', '[{\"institute\":\"\",\"year\":\"\",\"course\":\"\"},{\"institute\":\"\",\"year\":\"\",\"course\":\"\"}]', '[{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"},{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"}]', '[\"\",\"\",\"\",\"\"]', '[\"\",\"\",\"\",\"\"]', '2025-08-07 14:04:31', ''),
(13, '3', 'hbjn', 'g@gmauol.com', '63', 'uhjn', 'uhyj', '', '[\"\",\"\",\"\",\"\"]', '[{\"institute\":\"\",\"year\":\"\",\"course\":\"\"},{\"institute\":\"\",\"year\":\"\",\"course\":\"\"}]', '[{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"},{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"}]', '[\"\",\"\",\"\",\"\"]', '[\"\",\"\",\"\",\"\"]', '2025-08-07 14:13:16', ''),
(14, '3', 'hbjn', 'g@gmauol.com', '63', 'uhjn', 'uhyj', '', '[\"\",\"\",\"\",\"\"]', '[{\"institute\":\"\",\"year\":\"\",\"course\":\"\"},{\"institute\":\"\",\"year\":\"\",\"course\":\"\"}]', '[{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"},{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"}]', '[\"\",\"\",\"\",\"\"]', '[\"\",\"\",\"\",\"\"]', '2025-08-07 14:14:25', ''),
(15, '3', 'hbjn', 'g@gmauol.com', '63', 'uhjn', 'uhyj', '', '[\"\",\"\",\"\",\"\"]', '[{\"institute\":\"\",\"year\":\"\",\"course\":\"\"},{\"institute\":\"\",\"year\":\"\",\"course\":\"\"}]', '[{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"},{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"}]', '[\"\",\"\",\"\",\"\"]', '[\"\",\"\",\"\",\"\"]', '2025-08-07 15:18:35', 'assets/images/profile/1754572715_screencapture-localhost-cv-Signin-2025-08-03-23_42_40_-_Copy.png'),
(16, '3', 'hbjn', 'g@gmauol.com', '63', 'uhjn', 'uhyj', '', '[\"\",\"\",\"\",\"\"]', '[{\"institute\":\"\",\"year\":\"\",\"course\":\"\"},{\"institute\":\"\",\"year\":\"\",\"course\":\"\"}]', '[{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"},{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"}]', '[\"\",\"\",\"\",\"\"]', '[\"\",\"\",\"\",\"\"]', '2025-08-07 15:43:57', 'assets/images/profile/1754574237_screencapture-localhost-cv-Signin-2025-08-03-23_42_40_-_Copy.png'),
(17, '3', 'hbjn', 'g@gmauol.com', '63', 'uhjn', 'uhyj', '', '[\"\",\"\",\"\",\"\"]', '[{\"institute\":\"\",\"year\":\"\",\"course\":\"\"},{\"institute\":\"\",\"year\":\"\",\"course\":\"\"}]', '[{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"},{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"}]', '[\"\",\"\",\"\",\"\"]', '[\"\",\"\",\"\",\"\"]', '2025-08-07 15:44:46', 'assets/images/profile/1754574286_screencapture-localhost-cv-Signin-2025-08-03-23_42_40_-_Copy.png'),
(18, '3', 'hbjn', 'g@gmauol.com', '63', 'uhjn', 'uhyj', '', '[\"\",\"\",\"\",\"\"]', '[{\"institute\":\"\",\"year\":\"\",\"course\":\"\"},{\"institute\":\"\",\"year\":\"\",\"course\":\"\"}]', '[{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"},{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"}]', '[\"\",\"\",\"\",\"\"]', '[\"\",\"\",\"\",\"\"]', '2025-08-07 15:53:27', 'assets/images/profile/1754574807_screencapture-localhost-cv-Signin-2025-08-03-23_42_40_-_Copy.png'),
(19, 'tre', 'h', 'h@gmail.com', '9865', 'gthn', 'ewsd', '', '[\"\",\"\",\"\",\"\"]', '[{\"institute\":\"\",\"year\":\"\",\"course\":\"\"},{\"institute\":\"\",\"year\":\"\",\"course\":\"\"}]', '[{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"},{\"company\":\"\",\"start_date\":\"\",\"end_date\":\"\",\"job_title\":\"\"}]', '[\"\",\"\",\"\",\"\"]', '[\"\",\"\",\"\",\"\"]', '2025-08-07 15:54:14', 'assets/images/profile/1754574854_Capture1.PNG'),
(20, 'Roshni', 'nasit', 'RR@gmail.com', '7878787878', 'London, UK', 'Career ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer Objective', 'HTML,CSS,JAVASCRIP,NODEJS,JAVA', '[\"c1\",\"c2\",\"c3\",\"c4\"]', '[{\"institute\":\"asas\",\"year\":\"2022\",\"course\":\"abc\"},{\"institute\":\"wdd\",\"year\":\"2025\",\"course\":\"abc\"}]', '[{\"company\":\"waw\",\"start_date\":\"2022-01-01\",\"end_date\":\"2554-01-01\",\"job_title\":\"dsd\"},{\"company\":\"ads\",\"start_date\":\"2025-01-02\",\"end_date\":\"2025-05-05\",\"job_title\":\"sdsad\"}]', '[\"english\",\"hindi\",\"\",\"\"]', '[\"h1\",\"h2\",\"h3\",\"h4\"]', '2025-08-07 16:32:56', 'assets/images/profile/1754577175_img_avatar2.png'),
(21, 'Roshni', 'nasit', 'RR@gmail.com', '7878787878', 'London, UK', 'Career ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer Objective', 'HTML,CSS,JAVASCRIP,NODEJS,JAVA', '[\"c1\",\"c2\",\"c3\",\"c4\"]', '[{\"institute\":\"asas\",\"year\":\"2022\",\"course\":\"abc\"},{\"institute\":\"wdd\",\"year\":\"2025\",\"course\":\"abc\"}]', '[{\"company\":\"waw\",\"start_date\":\"2022-01-01\",\"end_date\":\"2554-01-01\",\"job_title\":\"dsd\"},{\"company\":\"ads\",\"start_date\":\"2025-01-02\",\"end_date\":\"2025-05-05\",\"job_title\":\"sdsad\"}]', '[\"english\",\"hindi\",\"\",\"\"]', '[\"h1\",\"h2\",\"h3\",\"h4\"]', '2025-08-07 16:42:39', 'assets/images/profile/1754577759_img_avatar2.png'),
(22, 'Roshni', 'nasit', 'RR@gmail.com', '7878787878', 'London, UK', 'Career ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer ObjectiveCareer Objective', 'HTML,CSS,JAVASCRIP,NODEJS,JAVA', '[\"c1\",\"c2\",\"c3\",\"c4\"]', '[{\"institute\":\"asas\",\"year\":\"2022\",\"course\":\"abc\"},{\"institute\":\"wdd\",\"year\":\"2025\",\"course\":\"abc\"}]', '[{\"company\":\"waw\",\"start_date\":\"2022-01-01\",\"end_date\":\"2554-01-01\",\"job_title\":\"dsd\"},{\"company\":\"ads\",\"start_date\":\"2025-01-02\",\"end_date\":\"2025-05-05\",\"job_title\":\"sdsad\"}]', '[\"english\",\"hindi\",\"\",\"\"]', '[\"h1\",\"h2\",\"h3\",\"h4\"]', '2025-08-07 16:59:01', 'assets/images/profile/1754578740_img_avatar2.png'),
(23, 'roshni', 'webdevloper', 'roshni@gmail.com', '78946514965895', 'london', 'Let me know if you also want:\r\n\r\nThe profile image displayed inside the PDF.\r\n\r\nA template selection dropdown before submission.\r\n\r\nA ZIP download with all three PDFs bundled.Let me know if you also want:\r\n\r\nThe profile image displayed inside the PDF.\r\n\r\nA template selection dropdown before submission.\r\n\r\nA ZIP download with all three PDFs bundled.', 'html,css,javascript,nodejs,python,react', '[\"c1\",\"c2\",\"c3\",\"\"]', '[{\"institute\":\"abc\",\"year\":\"2022\",\"course\":\"abc\"},{\"institute\":\"abc\",\"year\":\"2025\",\"course\":\"abc\"}]', '[{\"company\":\"abc\",\"start_date\":\"2022-01-01\",\"end_date\":\"2023-01-01\",\"job_title\":\"webdevloper\"},{\"company\":\"abc\",\"start_date\":\"2025-05-02\",\"end_date\":\"\",\"present\":\"1\",\"job_title\":\"web devloper\"}]', '[\"english\",\"hindi\",\"\",\"\"]', '[\"h1\",\"h2\",\"h3\",\"h4\"]', '2025-08-08 14:11:01', 'assets/images/profile/1754655060_img_avatar2.png'),
(24, 'roshni', 'webdevloper', 'roshni@gmail.com', '78946514965895', 'london', 'Let me know if you also want:\r\n\r\nThe profile image displayed inside the PDF.\r\n\r\nA template selection dropdown before submission.\r\n\r\nA ZIP download with all three PDFs bundled.Let me know if you also want:\r\n\r\nThe profile image displayed inside the PDF.\r\n\r\nA template selection dropdown before submission.\r\n\r\nA ZIP download with all three PDFs bundled.', 'html,css,javascript,nodejs,python,react', '[\"c1\",\"c2\",\"c3\",\"\"]', '[{\"institute\":\"abc\",\"year\":\"2022\",\"course\":\"abc\"},{\"institute\":\"abc\",\"year\":\"2025\",\"course\":\"abc\"}]', '[{\"company\":\"abc\",\"start_date\":\"2022-01-01\",\"end_date\":\"2023-01-01\",\"job_title\":\"webdevloper\"},{\"company\":\"abc\",\"start_date\":\"2025-05-02\",\"end_date\":\"\",\"present\":\"1\",\"job_title\":\"web devloper\"}]', '[\"english\",\"hindi\",\"\",\"\"]', '[\"h1\",\"h2\",\"h3\",\"h4\"]', '2025-08-08 14:39:11', 'assets/images/profile/1754656751_img_avatar2.png'),
(25, 'abc abc', 'web devloper', 'abc@gmail.com', '7897897897', 'london', 'The best place to find government services and informationThe best place to find government services and informationThe best place to find government services and informationThe best place to find government services and informationThe best place to find government services and informationThe best place to find government services and informationThe best place to find government services and information', 'html,css,jaascrpit, react,nodejs,php', '[\"c1\",\"c2\",\"c3\",\"c4\"]', '[{\"institute\":\"abc\",\"year\":\"2022\",\"course\":\"abc\"},{\"institute\":\"abc\",\"year\":\"2025\",\"course\":\"abc\"}]', '[{\"company\":\"abc\",\"start_date\":\"2022-01-01\",\"end_date\":\"2024-01-01\",\"job_title\":\"web devlopmet\"},{\"company\":\"abc\",\"start_date\":\"2025-05-05\",\"end_date\":\"\",\"present\":\"1\",\"job_title\":\"web devlopment\"}]', '[\"english\",\"hindi\",\"\",\"\"]', '[\"h1\",\"h2\",\"h4\",\"\"]', '2025-08-08 14:47:36', 'assets/images/profile/1754657256_img_avatar2.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `emailid` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `emailid`, `password`, `created_at`) VALUES
(1, 'roshni', 'nasit', 'r@gmail.com', '$2y$10$3u86RQAPRHZ2RrcAchjkN.37I7gqY5okOWEJwV6LAEGOyglswZGbG', '2025-07-25 14:03:41'),
(2, 'r', 'n', 'nr@gmail.com', '$2y$10$CpOnepgUjDsTPL1BlnwI4uy6PZ7TKTohVq2KR5jdIkbbqyoJ2K3ui', '2025-07-25 14:04:33'),
(3, 'qw', 's', 'WQ@gmail.com', '$2y$10$neZSwseY3dxSQy9mORwvbuB5MLcK4Uns9It.GtlKjiKu3Nbr6cJ2K', '2025-07-25 14:05:28'),
(4, 'RO', 'na', 'RN@gmail.com', '$2y$10$hiYeSDB8ncApBQHazUIAsOoR1E4/E2jcDyUsgElzw63kcvYkWqJqy', '2025-07-25 14:10:06'),
(5, 'Roshni', 'nasit', 'RRR@gmail.com', '$2y$10$RzxKaJyfj5WMDWb2Umw6MO1rejqV3Y0LMWYdjS.6VYC5MN1D3lcPa', '2025-08-07 14:28:37'),
(6, 'roshni', 'nasit', 'roshni@gmail.com', '$2y$10$tUQPQrSMB3jutUBh/PF18.eevugfTcchCmIB93AUC2PkY2WBnB7aO', '2025-08-08 12:44:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cvs`
--
ALTER TABLE `cvs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emailid` (`emailid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cvs`
--
ALTER TABLE `cvs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
