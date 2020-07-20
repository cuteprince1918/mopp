-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2020 at 07:10 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `univercity`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_master`
--

CREATE TABLE `admin_master` (
  `id` int(12) NOT NULL,
  `user_type` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(12) NOT NULL,
  `created_time` datetime NOT NULL,
  `created_ip` varchar(255) NOT NULL,
  `modified_by` int(12) NOT NULL,
  `modified_time` datetime NOT NULL,
  `modified_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_master`
--

INSERT INTO `admin_master` (`id`, `user_type`, `name`, `email`, `image`, `username`, `password`, `status`, `is_delete`, `created_by`, `created_time`, `created_ip`, `modified_by`, `modified_time`, `modified_ip`) VALUES
(1, 1, 'Aksha', 'akshamakarani@gmail.com', '1594068131143962.jpg', 'superadmin', '$2y$10$AMAyyL4fnCNTtzh3tr2mX.jI4ONIuYt8PCJ7Fz93FWQmlK0FNx7oi', 1, 0, 0, '0000-00-00 00:00:00', '', 0, '2020-07-10 22:11:30', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `company_master`
--

CREATE TABLE `company_master` (
  `id` int(12) NOT NULL,
  `user_type` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `forgotkey` varchar(250) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(12) NOT NULL,
  `created_time` datetime NOT NULL,
  `created_ip` varchar(255) NOT NULL,
  `modified_by` int(12) NOT NULL,
  `modified_time` datetime NOT NULL,
  `modified_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_master`
--

INSERT INTO `company_master` (`id`, `user_type`, `name`, `email`, `image`, `username`, `password`, `status`, `forgotkey`, `is_delete`, `created_by`, `created_time`, `created_ip`, `modified_by`, `modified_time`, `modified_ip`) VALUES
(1, 3, 'Jdevio', 'jdevio@gmail.com', '1594229764477772.jpg', 'jdevio', '$2y$10$AMAyyL4fnCNTtzh3tr2mX.jI4ONIuYt8PCJ7Fz93FWQmlK0FNx7oi', 1, '', 0, 0, '0000-00-00 00:00:00', '', 1, '2020-07-08 23:06:04', '::1'),
(3, 3, 'Ilustrate', 'ilustrate@gmail.com', '1594229809630752.png', 'illum', '$2y$10$AMAyyL4fnCNTtzh3tr2mX.jI4ONIuYt8PCJ7Fz93FWQmlK0FNx7oi', 1, '', 0, 1, '2020-07-08 23:06:49', '::1', 0, '0000-00-00 00:00:00', ''),
(4, 3, 'yumm', 'yumm@gmail.com', '1594229860208468.png', 'yumm1', '$2y$10$AMAyyL4fnCNTtzh3tr2mX.jI4ONIuYt8PCJ7Fz93FWQmlK0FNx7oi', 1, '', 0, 1, '2020-07-08 23:07:40', '::1', 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `job_child`
--

CREATE TABLE `job_child` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jobid` int(11) NOT NULL,
  `jobtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobdesc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobimage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobenddate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `univercity` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `student` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_confirmation`
--

CREATE TABLE `job_confirmation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jobid` int(11) NOT NULL,
  `unvercityid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `isaccept` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_master`
--

CREATE TABLE `job_master` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urertype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` int(11) NOT NULL,
  `isactive` int(11) NOT NULL,
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_master`
--

CREATE TABLE `student_master` (
  `id` int(12) NOT NULL,
  `user_type` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(12) NOT NULL,
  `created_time` datetime NOT NULL,
  `created_ip` varchar(255) NOT NULL,
  `modified_by` int(12) NOT NULL,
  `modified_time` datetime NOT NULL,
  `modified_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_master`
--

INSERT INTO `student_master` (`id`, `user_type`, `name`, `email`, `image`, `username`, `password`, `status`, `is_delete`, `created_by`, `created_time`, `created_ip`, `modified_by`, `modified_time`, `modified_ip`) VALUES
(1, 1, 'Kabeer', 'kabeer@gmail.com', '1594229434991940.png', 'kabeerm', 'bUd1R0xhTVl5ZWdjNCtRSEhiQ3lxZz09', 1, 0, 0, '0000-00-00 00:00:00', '', 1, '2020-07-08 23:00:34', '::1'),
(3, 0, 'Nishat', 'nishat@gmail.com', '1594229464104274.png', 'nishatm', 'bUd1R0xhTVl5ZWdjNCtRSEhiQ3lxZz09', 1, 0, 1, '2020-07-08 22:54:05', '::1', 1, '2020-07-08 23:01:04', '::1'),
(4, 0, 'Amairah', 'amairah@gmail.com', '1594229489875217.png', 'amairahk', 'bUd1R0xhTVl5ZWdjNCtRSEhiQ3lxZz09', 1, 0, 1, '2020-07-08 22:54:53', '::1', 1, '2020-07-08 23:01:29', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `university_master`
--

CREATE TABLE `university_master` (
  `id` int(12) NOT NULL,
  `user_type` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `forgotkey` varchar(250) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(12) NOT NULL,
  `created_time` datetime NOT NULL,
  `created_ip` varchar(255) NOT NULL,
  `modified_by` int(12) NOT NULL,
  `modified_time` datetime NOT NULL,
  `modified_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `university_master`
--

INSERT INTO `university_master` (`id`, `user_type`, `name`, `email`, `image`, `username`, `password`, `status`, `forgotkey`, `is_delete`, `created_by`, `created_time`, `created_ip`, `modified_by`, `modified_time`, `modified_ip`) VALUES
(1, 2, 'Bombay University', 'bmu@gmail.com', '1594230001135117.jpg', 'bmuadmin', '$2y$10$3Rdg3Wi1xLI6mdx304dINO1tSFkcu.0ZKEkQ5zWSGK1E6nGJlb2fe', 1, '', 0, 0, '0000-00-00 00:00:00', '', 1, '2020-07-08 23:10:01', '::1'),
(3, 2, 'Anand University', 'aau@gmail.com', '1594230046200254.jpg', 'aauadmin', '$2y$10$AMAyyL4fnCNTtzh3tr2mX.jI4ONIuYt8PCJ7Fz93FWQmlK0FNx7oi', 1, '', 0, 1, '2020-07-08 23:10:46', '::1', 0, '0000-00-00 00:00:00', ''),
(4, 2, 'Saurashtra University', 'sau@gmail.com', '1594230095777076.jpg', 'sauadmin', '$2y$10$AMAyyL4fnCNTtzh3tr2mX.jI4ONIuYt8PCJ7Fz93FWQmlK0FNx7oi', 1, '', 0, 1, '2020-07-08 23:11:35', '::1', 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_type_master`
--

CREATE TABLE `user_type_master` (
  `id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(12) NOT NULL,
  `created_time` datetime NOT NULL,
  `created_ip` varchar(255) NOT NULL,
  `modified_by` int(12) NOT NULL,
  `modified_time` datetime NOT NULL,
  `modified_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type_master`
--

INSERT INTO `user_type_master` (`id`, `name`, `table_name`, `status`, `is_delete`, `created_by`, `created_time`, `created_ip`, `modified_by`, `modified_time`, `modified_ip`) VALUES
(1, 'Administrator', 'admin', 1, 0, 0, '0000-00-00 00:00:00', '', 0, '0000-00-00 00:00:00', ''),
(2, 'University', 'university', 1, 0, 0, '0000-00-00 00:00:00', '', 0, '0000-00-00 00:00:00', ''),
(3, 'Company', 'company', 1, 0, 0, '0000-00-00 00:00:00', '', 0, '0000-00-00 00:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_master`
--
ALTER TABLE `admin_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_master`
--
ALTER TABLE `company_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_child`
--
ALTER TABLE `job_child`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_confirmation`
--
ALTER TABLE `job_confirmation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_master`
--
ALTER TABLE `job_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_master`
--
ALTER TABLE `student_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `university_master`
--
ALTER TABLE `university_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type_master`
--
ALTER TABLE `user_type_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_master`
--
ALTER TABLE `admin_master`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company_master`
--
ALTER TABLE `company_master`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_child`
--
ALTER TABLE `job_child`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_confirmation`
--
ALTER TABLE `job_confirmation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_master`
--
ALTER TABLE `job_master`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_master`
--
ALTER TABLE `student_master`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `university_master`
--
ALTER TABLE `university_master`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_type_master`
--
ALTER TABLE `user_type_master`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
