-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2023 at 04:21 AM
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
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`id`, `category_name`, `category_img`) VALUES
(1, 'study', 'study.png'),
(2, 'medic', 'medic.png'),
(3, 'sport', 'sport.png'),
(4, 'meeting', 'meeting.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_collaborator`
--

CREATE TABLE `tb_collaborator` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `collabolator_user_id` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_collaborator`
--

INSERT INTO `tb_collaborator` (`id`, `task_id`, `collabolator_user_id`, `added_by`, `added_at`) VALUES
(1, 101, 2, NULL, NULL),
(2, 101, 3, NULL, NULL),
(3, 102, 1, NULL, NULL),
(4, 102, 3, NULL, NULL),
(11, 108, 2, 1, NULL),
(12, 108, 3, 1, NULL),
(13, 113, 2, NULL, NULL),
(14, 113, 3, NULL, NULL),
(15, 114, 2, 0, NULL),
(16, 114, 3, 0, NULL),
(17, 115, 2, 0, NULL),
(18, 116, 2, 1, NULL),
(19, 120, 2, 1, NULL),
(20, 120, 3, 1, NULL),
(22, 144, 2, 1, NULL),
(23, 144, 3, 1, NULL),
(24, 145, 1, 2, NULL),
(25, 146, 2, 1, NULL),
(26, 146, 3, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pet`
--

CREATE TABLE `tb_pet` (
  `id` int(11) NOT NULL,
  `pet_name` varchar(255) DEFAULT NULL,
  `pet_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pet`
--

INSERT INTO `tb_pet` (`id`, `pet_name`, `pet_img`) VALUES
(1, 'Rocky', 'pet.png'),
(2, 'Golem', 'Golem-Baby.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_phase`
--

CREATE TABLE `tb_phase` (
  `id` int(11) NOT NULL,
  `phase_name` varchar(255) DEFAULT NULL,
  `min_xp` int(11) DEFAULT NULL,
  `max_xp` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `phase_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_phase`
--

INSERT INTO `tb_phase` (`id`, `phase_name`, `min_xp`, `max_xp`, `level`, `pet_id`, `phase_img`) VALUES
(1, 'Golem Egg', 0, 50, 1, 2, 'Golem-Egg.png'),
(2, 'Golem Baby', 51, 100, 2, 2, 'Golem-Baby.png'),
(3, 'Golem Kid', 101, 150, 3, 2, 'Golem-kid.png'),
(4, 'Golem', 151, 10000, 4, 2, 'Golem-mature.png'),
(5, 'Eggy', 0, 50, 1, 1, 'pet.png'),
(6, 'Big egg', 51, 100, 2, 1, 'pet.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_priority`
--

CREATE TABLE `tb_priority` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `priority_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_priority`
--

INSERT INTO `tb_priority` (`id`, `title`, `priority_score`) VALUES
(1, 'High', 1),
(2, 'Medium', 2),
(3, 'Low', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_reminder`
--

CREATE TABLE `tb_reminder` (
  `id` int(11) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `reminder_time` time DEFAULT NULL,
  `reminder_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_reminder`
--

INSERT INTO `tb_reminder` (`id`, `task_id`, `reminder_time`, `reminder_date`) VALUES
(49, 101, '08:42:00', '2023-07-21'),
(50, 102, '01:55:00', '2023-07-22'),
(54, 108, '08:34:00', '2023-07-21'),
(55, 111, '08:53:00', '2023-07-25'),
(56, 112, '10:23:00', '2023-07-21'),
(57, 113, '04:18:00', '2023-07-24'),
(58, 114, '04:23:00', '2023-07-24'),
(59, 115, '04:26:00', '2023-07-24'),
(60, 116, '04:29:00', '2023-07-24'),
(79, 111, '08:53:00', '2023-07-25'),
(82, 120, '08:32:00', '2023-07-25'),
(84, 108, '08:46:00', '2023-07-25'),
(85, 143, '08:59:00', '2023-07-25'),
(86, 144, '09:06:00', '2023-07-25'),
(87, 145, '02:06:00', '2023-07-25'),
(88, 146, '03:12:00', '2023-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `id` int(11) NOT NULL,
  `status` enum('active','done') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`id`, `status`) VALUES
(1, 'active'),
(2, 'done');

-- --------------------------------------------------------

--
-- Table structure for table `tb_task`
--

CREATE TABLE `tb_task` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_date` date DEFAULT NULL,
  `task_time` time DEFAULT NULL,
  `task_desc` varchar(255) DEFAULT NULL,
  `priority_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_task`
--

INSERT INTO `tb_task` (`id`, `task_name`, `task_date`, `task_time`, `task_desc`, `priority_id`, `user_id`, `category_id`, `status_id`) VALUES
(101, 'Akhir', '2023-07-21', '08:43:00', '', 1, 1, 1, 2),
(102, 'Pertama', '2023-07-22', '01:57:00', '', 1, 2, 1, 2),
(106, 'Minum', '2023-07-21', '01:21:00', '', 1, 2, 1, 1),
(107, 'Minum', '2023-07-21', '01:21:00', '', 1, 3, 1, 1),
(108, 'Hari ini', '2023-07-21', '08:36:00', '', 1, 1, 1, 2),
(109, 'Hari ini', '2023-07-21', '08:36:00', '', 1, 2, 1, 2),
(110, 'Hari ini', '2023-07-21', '08:36:00', '', 1, 3, 1, 1),
(111, 'ini', '2023-07-21', '09:57:00', '', 1, 1, 1, 2),
(112, 'addd', '2023-07-21', '10:10:00', '', 1, 1, 1, 2),
(113, 'waktu', '2023-07-24', '04:21:00', '', 1, 1, 1, 2),
(114, 'manusia', '2023-07-24', '04:25:00', '', 1, 1, 1, 2),
(115, 'hidup', '2023-07-24', '04:27:00', '', 1, 1, 1, 2),
(116, 'boleh', '2023-07-24', '04:30:00', '', 1, 1, 1, 2),
(119, 'nonton', '2023-07-24', '05:23:00', '', 1, 1, 1, 2),
(120, 'baru', '2023-07-23', '09:25:00', '', 1, 1, 1, 2),
(143, 'lagi3', '2023-07-25', '09:00:00', '', 1, 1, 1, 1),
(144, 'test colab', '2023-07-25', '09:08:00', '', 1, 1, 1, 1),
(145, 'test colab2', '2023-07-25', '02:08:00', '', 1, 2, 1, 1),
(146, 'add  task baru', '2023-07-25', '03:15:00', '', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `profile_img` varchar(255) DEFAULT NULL,
  `total_score` int(11) DEFAULT NULL,
  `xp` int(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `current_pet_phase` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `fullname`, `email`, `password`, `status`, `profile_img`, `total_score`, `xp`, `pet_id`, `current_pet_phase`) VALUES
(1, 'Dellaaa', 'Fredellaaa', 'della@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 'f3a7ad479629a79e79b67da372fc1e5a_23-07-21.png', 10, 100, 2, 2),
(2, 'Fredella', 'Fredella cc', 'fredella@gmail.com', '202cb962ac59075b964b07152d234b70', 0, NULL, 2, 20, NULL, NULL),
(3, 'Dll', 'Dellaaaa', 'dllcc@gmail.com', '202cb962ac59075b964b07152d234b70', 0, NULL, 0, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_collaborator`
--
ALTER TABLE `tb_collaborator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `tb_pet`
--
ALTER TABLE `tb_pet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_phase`
--
ALTER TABLE `tb_phase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `tb_priority`
--
ALTER TABLE `tb_priority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_reminder`
--
ALTER TABLE `tb_reminder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_task`
--
ALTER TABLE `tb_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `priority_id` (`priority_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_id` (`pet_id`),
  ADD KEY `current_pet_phase` (`current_pet_phase`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_collaborator`
--
ALTER TABLE `tb_collaborator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_pet`
--
ALTER TABLE `tb_pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_phase`
--
ALTER TABLE `tb_phase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_reminder`
--
ALTER TABLE `tb_reminder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `tb_task`
--
ALTER TABLE `tb_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_collaborator`
--
ALTER TABLE `tb_collaborator`
  ADD CONSTRAINT `tb_collaborator_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tb_task` (`id`);

--
-- Constraints for table `tb_phase`
--
ALTER TABLE `tb_phase`
  ADD CONSTRAINT `tb_phase_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `tb_pet` (`id`);

--
-- Constraints for table `tb_reminder`
--
ALTER TABLE `tb_reminder`
  ADD CONSTRAINT `tb_reminder_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tb_task` (`id`);

--
-- Constraints for table `tb_task`
--
ALTER TABLE `tb_task`
  ADD CONSTRAINT `tb_task_ibfk_1` FOREIGN KEY (`priority_id`) REFERENCES `tb_priority` (`id`),
  ADD CONSTRAINT `tb_task_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tb_category` (`id`),
  ADD CONSTRAINT `tb_task_ibfk_4` FOREIGN KEY (`status_id`) REFERENCES `tb_status` (`id`),
  ADD CONSTRAINT `tb_task_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `tb_pet` (`id`),
  ADD CONSTRAINT `tb_user_ibfk_2` FOREIGN KEY (`current_pet_phase`) REFERENCES `tb_phase` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
