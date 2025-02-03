-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2023 at 12:41 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `field`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepted_application`
--

CREATE TABLE `accepted_application` (
  `organization_id` int(100) NOT NULL,
  `student_id` int(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `startdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accepted_application`
--

INSERT INTO `accepted_application` (`organization_id`, `student_id`, `date`, `startdate`) VALUES
(6, 8, '2023-02-21', '2023-02-21'),
(6, 10, '2023-02-27', '2023-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `organization_id` int(100) NOT NULL,
  `student_id` int(100) NOT NULL,
  `field_letter` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `student` int(100) NOT NULL,
  `info` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`student`, `info`) VALUES
(8, 'Your Field application Has been Accepted!'),
(10, 'Your Field application Has been Accepted!');

-- --------------------------------------------------------

--
-- Table structure for table `logbook_data`
--

CREATE TABLE `logbook_data` (
  `logbook` int(100) NOT NULL,
  `date` date NOT NULL,
  `task` varchar(500) NOT NULL,
  `lesson` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logbook_data`
--

INSERT INTO `logbook_data` (`logbook`, `date`, `task`, `lesson`) VALUES
(2, '2023-02-21', 'did nothing', 'learned nothing'),
(2, '2023-02-22', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum'),
(2, '2023-02-23', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum'),
(2, '2023-02-27', 'test text  presley 2', 'test text presley 3');

-- --------------------------------------------------------

--
-- Table structure for table `logbook_supervisor`
--

CREATE TABLE `logbook_supervisor` (
  `supervisor` int(100) NOT NULL,
  `logbook` int(100) NOT NULL,
  `score` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `region` varchar(15) NOT NULL,
  `district` varchar(15) NOT NULL,
  `ward` varchar(15) NOT NULL,
  `village` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `name`, `email`, `phone`, `pass`, `region`, `district`, `ward`, `village`) VALUES
(6, 'NBC', 'nbc@org.com', '0765423436', '11d6ff9a17974c9a7a3e1ccd50c92fc0', 'DAR-ES-SALAAM', 'ILALA', 'ILALA', 'ILALA');

-- --------------------------------------------------------

--
-- Table structure for table `organization_ocupied_pos`
--

CREATE TABLE `organization_ocupied_pos` (
  `oid` int(100) NOT NULL,
  `course` varchar(10) NOT NULL,
  `pos` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organization_ocupied_pos`
--

INSERT INTO `organization_ocupied_pos` (`oid`, `course`, `pos`) VALUES
(6, 'ACC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `organization_pos`
--

CREATE TABLE `organization_pos` (
  `organization_id` int(100) NOT NULL,
  `course` varchar(10) NOT NULL,
  `required_pos` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organization_pos`
--

INSERT INTO `organization_pos` (`organization_id`, `course`, `required_pos`) VALUES
(6, 'ACC', 5);

-- --------------------------------------------------------

--
-- Table structure for table `rejected_application`
--

CREATE TABLE `rejected_application` (
  `organization_id` int(100) NOT NULL,
  `student_id` int(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(100) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `University` varchar(50) NOT NULL,
  `regno` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `first_name`, `middle_name`, `surname`, `email`, `gender`, `phonenumber`, `University`, `regno`, `course`, `password`) VALUES
(8, 'PRESLEY', 'JOHN', 'HUMPHREY', 'presley@gmail.com', 'MALE', '0724858585', 'IFM-MAIN', 'IMC/BAC/2124717', 'ACC', '33f142212957eabbfdc6831f4d43fc7c'),
(10, 'JACKLINE', 'FRANK', 'MOSHI', 'jack@gmail.com', 'FEMALE', '0762544354', 'IFM-MAIN', 'IMC/BAC/2110986', 'ACC', '4ff9fc6e4e5d5f590c4f2134a8cc96d1');

-- --------------------------------------------------------

--
-- Table structure for table `student_logbook`
--

CREATE TABLE `student_logbook` (
  `student` int(100) NOT NULL,
  `logbook_id` int(100) NOT NULL,
  `score` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_logbook`
--

INSERT INTO `student_logbook` (`student`, `logbook_id`, `score`) VALUES
(8, 2, '100'),
(10, 6, '100');

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `organization` int(100) NOT NULL,
  `supervisor_id` int(100) NOT NULL,
  `supervisor_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `course` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`organization`, `supervisor_id`, `supervisor_name`, `email`, `course`, `password`) VALUES
(6, 3, 'WILLIAM BWIRE', 'williambwire97@gmail.com', 'ACC', 'e652e4ec5113abb19dbd42c4a362f4b4');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_comment`
--

CREATE TABLE `supervisor_comment` (
  `logbook` int(11) NOT NULL,
  `date` date NOT NULL,
  `comment` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE `university` (
  `id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`id`, `email`, `name`, `password`) VALUES
(1, 'ifm@university.com', 'IFM-MAIN', 'a5c5c5940cf12ff2f16c6e465761386f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepted_application`
--
ALTER TABLE `accepted_application`
  ADD PRIMARY KEY (`organization_id`,`student_id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`organization_id`,`student_id`),
  ADD KEY `app_stu_fk` (`student_id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`student`);

--
-- Indexes for table `logbook_data`
--
ALTER TABLE `logbook_data`
  ADD PRIMARY KEY (`logbook`,`date`);

--
-- Indexes for table `logbook_supervisor`
--
ALTER TABLE `logbook_supervisor`
  ADD PRIMARY KEY (`supervisor`,`logbook`),
  ADD UNIQUE KEY `unique_logbook` (`logbook`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD UNIQUE KEY `unique_phone` (`phone`);

--
-- Indexes for table `organization_ocupied_pos`
--
ALTER TABLE `organization_ocupied_pos`
  ADD PRIMARY KEY (`oid`,`course`,`pos`);

--
-- Indexes for table `organization_pos`
--
ALTER TABLE `organization_pos`
  ADD PRIMARY KEY (`organization_id`,`course`);

--
-- Indexes for table `rejected_application`
--
ALTER TABLE `rejected_application`
  ADD PRIMARY KEY (`organization_id`,`student_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_reg_no` (`regno`);

--
-- Indexes for table `student_logbook`
--
ALTER TABLE `student_logbook`
  ADD PRIMARY KEY (`student`,`logbook_id`),
  ADD UNIQUE KEY `unique_logbook` (`logbook_id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`supervisor_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `supervisor_org_fk` (`organization`);

--
-- Indexes for table `supervisor_comment`
--
ALTER TABLE `supervisor_comment`
  ADD PRIMARY KEY (`logbook`,`date`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_logbook`
--
ALTER TABLE `student_logbook`
  MODIFY `logbook_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `supervisor_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `app_org_fk` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `app_stu_fk` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `info_student_fk` FOREIGN KEY (`student`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logbook_data`
--
ALTER TABLE `logbook_data`
  ADD CONSTRAINT `logbook_data` FOREIGN KEY (`logbook`) REFERENCES `student_logbook` (`logbook_id`) ON DELETE CASCADE;

--
-- Constraints for table `logbook_supervisor`
--
ALTER TABLE `logbook_supervisor`
  ADD CONSTRAINT `logbook_supervisor_fk` FOREIGN KEY (`logbook`) REFERENCES `student_logbook` (`logbook_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `logbook_supervisors_fk` FOREIGN KEY (`supervisor`) REFERENCES `supervisors` (`supervisor_id`) ON DELETE CASCADE;

--
-- Constraints for table `organization_ocupied_pos`
--
ALTER TABLE `organization_ocupied_pos`
  ADD CONSTRAINT `occupied_pos_fk` FOREIGN KEY (`oid`) REFERENCES `organization` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `organization_pos`
--
ALTER TABLE `organization_pos`
  ADD CONSTRAINT `pos_fk` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_logbook`
--
ALTER TABLE `student_logbook`
  ADD CONSTRAINT `student_logbook_fk` FOREIGN KEY (`student`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD CONSTRAINT `supervisor_org_fk` FOREIGN KEY (`organization`) REFERENCES `organization` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supervisor_comment`
--
ALTER TABLE `supervisor_comment`
  ADD CONSTRAINT `comment_logbook` FOREIGN KEY (`logbook`) REFERENCES `logbook_supervisor` (`logbook`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
