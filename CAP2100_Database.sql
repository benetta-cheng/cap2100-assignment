-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2020 at 04:07 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cap2100_system`
--
CREATE DATABASE IF NOT EXISTS `cap2100_system` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cap2100_system`;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `created_at`, `updated_at`) VALUES
('AVJ8630', 'Object-Oriented Programming', '2020-12-05 15:06:43', '2020-12-05 15:06:43'),
('BGW3478', 'Introduction to Data Structure', '2020-12-05 15:06:38', '2020-12-05 15:06:38'),
('BKU2486', 'Object-Oriented Programming', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('DNO8051', 'Introduction to Cloud Computing', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('DTX7570', 'Introduction to Data Structure', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('ENA6862', 'Introduction to Cloud Computing', '2020-12-05 15:06:37', '2020-12-05 15:06:37'),
('EZN2177', 'Introduction to Web Programming with PHP', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('GLS5763', 'Fundamentals of Trustworthy Computing', '2020-12-05 15:06:38', '2020-12-05 15:06:38'),
('GTO1862', 'Introduction to Data Structure', '2020-12-05 15:06:42', '2020-12-05 15:06:42'),
('KGY2362', 'Introduction to Web Programming with PHP', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('LFW6812', 'Introduction to Data Structure', '2020-12-05 15:06:42', '2020-12-05 15:06:42'),
('LJW5990', 'Capstone Project', '2020-12-05 15:06:41', '2020-12-05 15:06:41'),
('MCZ4525', 'Object-Oriented Programming', '2020-12-05 15:06:41', '2020-12-05 15:06:41'),
('PKA9255', 'Program Logic Formulation', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('PTG9486', 'Object-Oriented Programming', '2020-12-05 15:06:36', '2020-12-05 15:06:36'),
('QCZ9774', 'Introduction to Mobile Apps Development', '2020-12-05 15:06:35', '2020-12-05 15:06:35'),
('XHL2206', 'Introduction to Cloud Computing', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('XZF4806', 'Introduction to Web Programming with PHP', '2020-12-05 15:06:41', '2020-12-05 15:06:41'),
('YNE3309', 'Capstone Project', '2020-12-05 15:06:42', '2020-12-05 15:06:42'),
('ZKG6803', 'Program Logic Formulation', '2020-12-05 15:06:39', '2020-12-05 15:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `enrolment`
--

CREATE TABLE `enrolment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrolment`
--

INSERT INTO `enrolment` (`id`, `student_id`, `section_id`, `created_at`, `updated_at`) VALUES
(1, 'J00000001', 'SC00000009', '2020-12-05 15:06:45', '2020-12-05 15:06:45'),
(2, 'J00000001', 'SC00000010', '2020-12-05 15:06:45', '2020-12-05 15:06:45'),
(3, 'J00000001', 'SC00000036', '2020-12-05 15:06:46', '2020-12-05 15:06:46'),
(4, 'J00000001', 'SC00000003', '2020-12-05 15:06:46', '2020-12-05 15:06:46'),
(5, 'J00000001', 'SC00000029', '2020-12-05 15:06:46', '2020-12-05 15:06:46'),
(6, 'J00000001', 'SC00000008', '2020-12-05 15:06:46', '2020-12-05 15:06:46'),
(7, 'J00000002', 'SC00000034', '2020-12-05 15:06:46', '2020-12-05 15:06:46'),
(8, 'J00000002', 'SC00000038', '2020-12-05 15:06:46', '2020-12-05 15:06:46'),
(9, 'J00000002', 'SC00000012', '2020-12-05 15:06:46', '2020-12-05 15:06:46'),
(10, 'J00000002', 'SC00000017', '2020-12-05 15:06:46', '2020-12-05 15:06:46'),
(11, 'J00000002', 'SC00000014', '2020-12-05 15:06:47', '2020-12-05 15:06:47'),
(12, 'J00000002', 'SC00000023', '2020-12-05 15:06:47', '2020-12-05 15:06:47'),
(13, 'J00000003', 'SC00000008', '2020-12-05 15:06:47', '2020-12-05 15:06:47'),
(14, 'J00000003', 'SC00000019', '2020-12-05 15:06:47', '2020-12-05 15:06:47'),
(15, 'J00000003', 'SC00000017', '2020-12-05 15:06:47', '2020-12-05 15:06:47'),
(16, 'J00000003', 'SC00000037', '2020-12-05 15:06:47', '2020-12-05 15:06:47'),
(17, 'J00000003', 'SC00000024', '2020-12-05 15:06:47', '2020-12-05 15:06:47'),
(18, 'J00000003', 'SC00000035', '2020-12-05 15:06:48', '2020-12-05 15:06:48'),
(19, 'J00000004', 'SC00000034', '2020-12-05 15:06:48', '2020-12-05 15:06:48'),
(20, 'J00000004', 'SC00000007', '2020-12-05 15:06:48', '2020-12-05 15:06:48'),
(21, 'J00000004', 'SC00000005', '2020-12-05 15:06:48', '2020-12-05 15:06:48'),
(22, 'J00000004', 'SC00000027', '2020-12-05 15:06:48', '2020-12-05 15:06:48'),
(23, 'J00000004', 'SC00000010', '2020-12-05 15:06:48', '2020-12-05 15:06:48'),
(24, 'J00000004', 'SC00000025', '2020-12-05 15:06:48', '2020-12-05 15:06:48'),
(25, 'J00000005', 'SC00000006', '2020-12-05 15:06:48', '2020-12-05 15:06:48'),
(26, 'J00000005', 'SC00000024', '2020-12-05 15:06:49', '2020-12-05 15:06:49'),
(27, 'J00000005', 'SC00000005', '2020-12-05 15:06:49', '2020-12-05 15:06:49'),
(28, 'J00000005', 'SC00000011', '2020-12-05 15:06:49', '2020-12-05 15:06:49'),
(29, 'J00000005', 'SC00000009', '2020-12-05 15:06:49', '2020-12-05 15:06:49'),
(30, 'J00000005', 'SC00000014', '2020-12-05 15:06:49', '2020-12-05 15:06:49'),
(31, 'J00000006', 'SC00000035', '2020-12-05 15:06:50', '2020-12-05 15:06:50'),
(32, 'J00000006', 'SC00000024', '2020-12-05 15:06:50', '2020-12-05 15:06:50'),
(33, 'J00000006', 'SC00000021', '2020-12-05 15:06:50', '2020-12-05 15:06:50'),
(34, 'J00000006', 'SC00000031', '2020-12-05 15:06:50', '2020-12-05 15:06:50'),
(35, 'J00000006', 'SC00000003', '2020-12-05 15:06:50', '2020-12-05 15:06:50'),
(36, 'J00000006', 'SC00000014', '2020-12-05 15:06:50', '2020-12-05 15:06:50'),
(37, 'J00000007', 'SC00000021', '2020-12-05 15:06:50', '2020-12-05 15:06:50'),
(38, 'J00000007', 'SC00000025', '2020-12-05 15:06:50', '2020-12-05 15:06:50'),
(39, 'J00000007', 'SC00000019', '2020-12-05 15:06:51', '2020-12-05 15:06:51'),
(40, 'J00000007', 'SC00000024', '2020-12-05 15:06:51', '2020-12-05 15:06:51'),
(41, 'J00000007', 'SC00000031', '2020-12-05 15:06:51', '2020-12-05 15:06:51'),
(42, 'J00000007', 'SC00000008', '2020-12-05 15:06:51', '2020-12-05 15:06:51'),
(43, 'J00000008', 'SC00000033', '2020-12-05 15:06:51', '2020-12-05 15:06:51'),
(44, 'J00000008', 'SC00000016', '2020-12-05 15:06:51', '2020-12-05 15:06:51'),
(45, 'J00000008', 'SC00000014', '2020-12-05 15:06:51', '2020-12-05 15:06:51'),
(46, 'J00000008', 'SC00000019', '2020-12-05 15:06:51', '2020-12-05 15:06:51'),
(47, 'J00000008', 'SC00000037', '2020-12-05 15:06:52', '2020-12-05 15:06:52'),
(48, 'J00000008', 'SC00000009', '2020-12-05 15:06:52', '2020-12-05 15:06:52'),
(49, 'J00000009', 'SC00000017', '2020-12-05 15:06:52', '2020-12-05 15:06:52'),
(50, 'J00000009', 'SC00000019', '2020-12-05 15:06:52', '2020-12-05 15:06:52'),
(51, 'J00000009', 'SC00000025', '2020-12-05 15:06:52', '2020-12-05 15:06:52'),
(52, 'J00000009', 'SC00000016', '2020-12-05 15:06:52', '2020-12-05 15:06:52'),
(53, 'J00000009', 'SC00000009', '2020-12-05 15:06:52', '2020-12-05 15:06:52'),
(54, 'J00000009', 'SC00000030', '2020-12-05 15:06:52', '2020-12-05 15:06:52'),
(55, 'J00000010', 'SC00000008', '2020-12-05 15:06:53', '2020-12-05 15:06:53'),
(56, 'J00000010', 'SC00000004', '2020-12-05 15:06:53', '2020-12-05 15:06:53'),
(57, 'J00000010', 'SC00000033', '2020-12-05 15:06:53', '2020-12-05 15:06:53'),
(58, 'J00000010', 'SC00000040', '2020-12-05 15:06:53', '2020-12-05 15:06:53'),
(59, 'J00000010', 'SC00000010', '2020-12-05 15:06:53', '2020-12-05 15:06:53'),
(60, 'J00000010', 'SC00000020', '2020-12-05 15:06:53', '2020-12-05 15:06:53'),
(61, 'J00000011', 'SC00000030', '2020-12-05 15:06:54', '2020-12-05 15:06:54'),
(62, 'J00000011', 'SC00000011', '2020-12-05 15:06:54', '2020-12-05 15:06:54'),
(63, 'J00000011', 'SC00000029', '2020-12-05 15:06:54', '2020-12-05 15:06:54'),
(64, 'J00000011', 'SC00000035', '2020-12-05 15:06:54', '2020-12-05 15:06:54'),
(65, 'J00000011', 'SC00000024', '2020-12-05 15:06:54', '2020-12-05 15:06:54'),
(66, 'J00000011', 'SC00000007', '2020-12-05 15:06:54', '2020-12-05 15:06:54'),
(67, 'J00000012', 'SC00000030', '2020-12-05 15:06:55', '2020-12-05 15:06:55'),
(68, 'J00000012', 'SC00000035', '2020-12-05 15:06:55', '2020-12-05 15:06:55'),
(69, 'J00000012', 'SC00000007', '2020-12-05 15:06:55', '2020-12-05 15:06:55'),
(70, 'J00000012', 'SC00000036', '2020-12-05 15:06:55', '2020-12-05 15:06:55'),
(71, 'J00000012', 'SC00000018', '2020-12-05 15:06:55', '2020-12-05 15:06:55'),
(72, 'J00000012', 'SC00000037', '2020-12-05 15:06:55', '2020-12-05 15:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `leave_action`
--

CREATE TABLE `leave_action` (
  `id` int(10) UNSIGNED NOT NULL,
  `leave_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_authority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_application`
--

CREATE TABLE `leave_application` (
  `leave_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reasons` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_10_25_061417_create_session_table', 1),
(2, '2020_10_25_061851_create_section_table', 1),
(3, '2020_10_25_062643_create_course_table', 1),
(4, '2020_10_25_065357_create_staff_table', 1),
(5, '2020_10_25_065411_create_leave_action_table', 1),
(6, '2020_10_25_065428_create_programme_table', 1),
(7, '2020_10_25_065440_create_student_table', 1),
(8, '2020_10_25_065453_create_leave_application_table', 1),
(9, '2020_10_25_113555_update_foreign_keys', 1),
(10, '2020_11_07_132204_add_primary_key_to_leave_action_table', 1),
(11, '2020_11_08_065918_update_foreign_keys_in_leave_action', 1),
(12, '2020_11_09_085955_create_enrolment_table', 1),
(13, '2020_11_09_090259_update_foreign_key_in_student', 1),
(14, '2020_11_10_045932_create_supporting_document_table', 1),
(15, '2020_11_10_124429_remove_supporting_document_from_leave_application', 1),
(16, '2020_11_10_163436_create_update_table', 1),
(17, '2020_11_12_101435_add_remember_token_to_users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

CREATE TABLE `programme` (
  `programme_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `programme_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `head_of_programme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`programme_id`, `programme_name`, `head_of_programme`, `created_at`, `updated_at`) VALUES
('P00000001', 'Diploma in Information Technology', 'S00000009', '2020-12-05 15:06:35', '2020-12-05 15:06:35'),
('P00000002', 'Diploma in Computer Science', 'S00000008', '2020-12-05 15:06:35', '2020-12-05 15:06:35'),
('P00000003', 'Diploma in Computer Science', 'S00000008', '2020-12-05 15:06:35', '2020-12-05 15:06:35'),
('P00000004', 'Diploma in Computer Science', 'S00000009', '2020-12-05 15:06:35', '2020-12-05 15:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lecturer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_name`, `lecturer_id`, `course_id`, `created_at`, `updated_at`) VALUES
('SC00000001', 'Z2', 'S00000006', 'QCZ9774', '2020-12-05 15:06:35', '2020-12-05 15:06:35'),
('SC00000002', 'P3', 'S00000003', 'QCZ9774', '2020-12-05 15:06:35', '2020-12-05 15:06:35'),
('SC00000003', 'Q2', 'S00000007', 'PTG9486', '2020-12-05 15:06:36', '2020-12-05 15:06:36'),
('SC00000004', 'F8', 'S00000003', 'PTG9486', '2020-12-05 15:06:36', '2020-12-05 15:06:36'),
('SC00000005', 'A7', 'S00000009', 'ENA6862', '2020-12-05 15:06:37', '2020-12-05 15:06:37'),
('SC00000006', 'B9', 'S00000007', 'ENA6862', '2020-12-05 15:06:37', '2020-12-05 15:06:37'),
('SC00000007', 'U5', 'S00000002', 'BGW3478', '2020-12-05 15:06:38', '2020-12-05 15:06:38'),
('SC00000008', 'D8', 'S00000009', 'BGW3478', '2020-12-05 15:06:38', '2020-12-05 15:06:38'),
('SC00000009', 'F3', 'S00000009', 'GLS5763', '2020-12-05 15:06:38', '2020-12-05 15:06:38'),
('SC00000010', 'U3', 'S00000003', 'GLS5763', '2020-12-05 15:06:38', '2020-12-05 15:06:38'),
('SC00000011', 'Q1', 'S00000006', 'ZKG6803', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('SC00000012', 'N7', 'S00000002', 'ZKG6803', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('SC00000013', 'R4', 'S00000008', 'DNO8051', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('SC00000014', 'Z3', 'S00000001', 'DNO8051', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('SC00000015', 'U6', 'S00000008', 'XHL2206', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('SC00000016', 'H2', 'S00000004', 'XHL2206', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('SC00000017', 'M6', 'S00000006', 'PKA9255', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('SC00000018', 'L7', 'S00000009', 'PKA9255', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SC00000019', 'W5', 'S00000002', 'BKU2486', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SC00000020', 'F9', 'S00000004', 'BKU2486', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SC00000021', 'Z1', 'S00000005', 'DTX7570', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SC00000022', 'Z9', 'S00000007', 'DTX7570', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SC00000023', 'Z5', 'S00000004', 'EZN2177', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SC00000024', 'R1', 'S00000009', 'EZN2177', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SC00000025', 'J4', 'S00000002', 'KGY2362', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SC00000026', 'G5', 'S00000006', 'KGY2362', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SC00000027', 'X9', 'S00000008', 'LJW5990', '2020-12-05 15:06:41', '2020-12-05 15:06:41'),
('SC00000028', 'D4', 'S00000002', 'LJW5990', '2020-12-05 15:06:41', '2020-12-05 15:06:41'),
('SC00000029', 'H8', 'S00000008', 'XZF4806', '2020-12-05 15:06:41', '2020-12-05 15:06:41'),
('SC00000030', 'J2', 'S00000007', 'XZF4806', '2020-12-05 15:06:41', '2020-12-05 15:06:41'),
('SC00000031', 'M1', 'S00000007', 'MCZ4525', '2020-12-05 15:06:41', '2020-12-05 15:06:41'),
('SC00000032', 'H3', 'S00000006', 'MCZ4525', '2020-12-05 15:06:42', '2020-12-05 15:06:42'),
('SC00000033', 'N2', 'S00000008', 'GTO1862', '2020-12-05 15:06:42', '2020-12-05 15:06:42'),
('SC00000034', 'A8', 'S00000006', 'GTO1862', '2020-12-05 15:06:42', '2020-12-05 15:06:42'),
('SC00000035', 'W3', 'S00000001', 'LFW6812', '2020-12-05 15:06:42', '2020-12-05 15:06:42'),
('SC00000036', 'A3', 'S00000009', 'LFW6812', '2020-12-05 15:06:42', '2020-12-05 15:06:42'),
('SC00000037', 'P2', 'S00000001', 'YNE3309', '2020-12-05 15:06:43', '2020-12-05 15:06:43'),
('SC00000038', 'N7', 'S00000005', 'YNE3309', '2020-12-05 15:06:43', '2020-12-05 15:06:43'),
('SC00000039', 'M1', 'S00000001', 'AVJ8630', '2020-12-05 15:06:43', '2020-12-05 15:06:43'),
('SC00000040', 'H2', 'S00000001', 'AVJ8630', '2020-12-05 15:06:43', '2020-12-05 15:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_of_week` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `section_id`, `day_of_week`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
('SS00000001', 'SC00000001', 'Monday', '13:00:00', '15:00:00', '2020-12-05 15:06:35', '2020-12-05 15:06:35'),
('SS00000002', 'SC00000002', 'Thursday', '08:00:00', '10:00:00', '2020-12-05 15:06:36', '2020-12-05 15:06:36'),
('SS00000003', 'SC00000003', 'Saturday', '15:00:00', '17:00:00', '2020-12-05 15:06:36', '2020-12-05 15:06:36'),
('SS00000004', 'SC00000004', 'Wednesday', '11:00:00', '13:00:00', '2020-12-05 15:06:36', '2020-12-05 15:06:36'),
('SS00000005', 'SC00000005', 'Tuesday', '15:00:00', '17:00:00', '2020-12-05 15:06:37', '2020-12-05 15:06:37'),
('SS00000006', 'SC00000006', 'Wednesday', '11:00:00', '13:00:00', '2020-12-05 15:06:38', '2020-12-05 15:06:38'),
('SS00000007', 'SC00000007', 'Friday', '20:00:00', '22:00:00', '2020-12-05 15:06:38', '2020-12-05 15:06:38'),
('SS00000008', 'SC00000008', 'Wednesday', '11:00:00', '12:00:00', '2020-12-05 15:06:38', '2020-12-05 15:06:38'),
('SS00000009', 'SC00000009', 'Tuesday', '18:00:00', '20:00:00', '2020-12-05 15:06:38', '2020-12-05 15:06:38'),
('SS00000010', 'SC00000010', 'Monday', '16:00:00', '18:00:00', '2020-12-05 15:06:38', '2020-12-05 15:06:38'),
('SS00000011', 'SC00000011', 'Thursday', '21:00:00', '23:00:00', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('SS00000012', 'SC00000012', 'Monday', '19:00:00', '21:00:00', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('SS00000013', 'SC00000013', 'Saturday', '08:00:00', '09:00:00', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('SS00000014', 'SC00000014', 'Wednesday', '16:00:00', '18:00:00', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('SS00000015', 'SC00000015', 'Wednesday', '17:00:00', '19:00:00', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('SS00000016', 'SC00000016', 'Thursday', '16:00:00', '17:00:00', '2020-12-05 15:06:39', '2020-12-05 15:06:39'),
('SS00000017', 'SC00000017', 'Thursday', '15:00:00', '17:00:00', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SS00000018', 'SC00000018', 'Thursday', '14:00:00', '15:00:00', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SS00000019', 'SC00000019', 'Monday', '12:00:00', '13:00:00', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SS00000020', 'SC00000020', 'Thursday', '10:00:00', '12:00:00', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SS00000021', 'SC00000021', 'Tuesday', '17:00:00', '19:00:00', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SS00000022', 'SC00000022', 'Wednesday', '16:00:00', '17:00:00', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SS00000023', 'SC00000023', 'Saturday', '16:00:00', '17:00:00', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SS00000024', 'SC00000024', 'Wednesday', '09:00:00', '10:00:00', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SS00000025', 'SC00000025', 'Wednesday', '14:00:00', '16:00:00', '2020-12-05 15:06:40', '2020-12-05 15:06:40'),
('SS00000026', 'SC00000026', 'Tuesday', '12:00:00', '13:00:00', '2020-12-05 15:06:41', '2020-12-05 15:06:41'),
('SS00000027', 'SC00000027', 'Tuesday', '14:00:00', '16:00:00', '2020-12-05 15:06:41', '2020-12-05 15:06:41'),
('SS00000028', 'SC00000028', 'Wednesday', '09:00:00', '10:00:00', '2020-12-05 15:06:41', '2020-12-05 15:06:41'),
('SS00000029', 'SC00000029', 'Saturday', '15:00:00', '16:00:00', '2020-12-05 15:06:41', '2020-12-05 15:06:41'),
('SS00000030', 'SC00000030', 'Thursday', '19:00:00', '21:00:00', '2020-12-05 15:06:41', '2020-12-05 15:06:41'),
('SS00000031', 'SC00000031', 'Saturday', '16:00:00', '18:00:00', '2020-12-05 15:06:42', '2020-12-05 15:06:42'),
('SS00000032', 'SC00000032', 'Sunday', '12:00:00', '13:00:00', '2020-12-05 15:06:42', '2020-12-05 15:06:42'),
('SS00000033', 'SC00000033', 'Wednesday', '21:00:00', '22:00:00', '2020-12-05 15:06:42', '2020-12-05 15:06:42'),
('SS00000034', 'SC00000034', 'Thursday', '13:00:00', '15:00:00', '2020-12-05 15:06:42', '2020-12-05 15:06:42'),
('SS00000035', 'SC00000035', 'Tuesday', '14:00:00', '15:00:00', '2020-12-05 15:06:42', '2020-12-05 15:06:42'),
('SS00000036', 'SC00000036', 'Saturday', '08:00:00', '10:00:00', '2020-12-05 15:06:42', '2020-12-05 15:06:42'),
('SS00000037', 'SC00000037', 'Friday', '08:00:00', '10:00:00', '2020-12-05 15:06:43', '2020-12-05 15:06:43'),
('SS00000038', 'SC00000038', 'Sunday', '08:00:00', '09:00:00', '2020-12-05 15:06:43', '2020-12-05 15:06:43'),
('SS00000039', 'SC00000039', 'Wednesday', '17:00:00', '18:00:00', '2020-12-05 15:06:43', '2020-12-05 15:06:43'),
('SS00000040', 'SC00000040', 'Monday', '18:00:00', '19:00:00', '2020-12-05 15:06:43', '2020-12-05 15:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `email_address`, `name`, `staff_type`, `password`, `created_at`, `updated_at`, `remember_token`) VALUES
('S00000001', 'staff1@newinti.edu.my', 'Ganesh a/l Krishnamurthi', 'Lecturer', '$2y$10$cIyKOGCYB.UBkQ5HEFoWTO/hmvwUHkOvpH2XL2ahckmt/7vzKHv9W', '2020-12-05 15:06:33', '2020-12-05 15:06:33', NULL),
('S00000002', 'staff2@newinti.edu.my', 'Shuba Perera', 'Lecturer', '$2y$10$jY8XQJVuKYVyXGdm1ZbeSudo6moqMftXWYF2.ROR5CozZUf7s1WAG', '2020-12-05 15:06:33', '2020-12-05 15:06:33', NULL),
('S00000003', 'staff3@newinti.edu.my', 'Hajjah Suhani Zawi binti Hasri', 'Lecturer', '$2y$10$zDp5TbcmNXkrZC3Kg/xab.8sgY5XPUvrF/N5IbIe5yWAcNL5JHDDi', '2020-12-05 15:06:33', '2020-12-05 15:06:33', NULL),
('S00000004', 'staff4@newinti.edu.my', 'Hj Hamka bin Izlan', 'Lecturer', '$2y$10$bdgFyq4/tfCJEnwYY6QFVulDVmjH48vsu.x3TpK54V.mtEkGjb3de', '2020-12-05 15:06:34', '2020-12-05 15:06:34', NULL),
('S00000005', 'staff5@newinti.edu.my', 'Tey Kor Hooi', 'Lecturer', '$2y$10$63LatpdsEyVEqspHnWxZr.vRgeIN95hLQDTnZBBZQvSNEAXgHyA/q', '2020-12-05 15:06:34', '2020-12-05 15:06:34', NULL),
('S00000006', 'staff6@newinti.edu.my', 'Kulasegaran a/l Manjit Sundram', 'Lecturer', '$2y$10$3iMb7TRolFfULimE5DD1t.2HCxyKIjQgsznL.XZ5KGlmceHqk9hfK', '2020-12-05 15:06:34', '2020-12-05 15:06:34', NULL),
('S00000007', 'staff7@newinti.edu.my', 'V. T. Thanuja', 'Lecturer', '$2y$10$K049bPlDCXHXSbHgTud.quvEHTpnneYDs59JdOIMHtswRX2kGvSX2', '2020-12-05 15:06:35', '2020-12-05 15:06:35', NULL),
('S00000008', 'staff8@newinti.edu.my', 'Seetho Quay Fei', 'Head of Programme', '$2y$10$L0kIPoVGWwTFiuQcOpGZku367bstZ7jZTqoRIALK4df.GOlv8Ku1C', '2020-12-05 15:06:35', '2020-12-05 15:06:35', NULL),
('S00000009', 'staff9@newinti.edu.my', 'Gun Zet Teu', 'Head of Programme', '$2y$10$x/XE2FwayUbVeQnnVsLqHui5N9Es7G1.Mm3XzG1Bz9w7njCuP6.3q', '2020-12-05 15:06:35', '2020-12-05 15:06:35', NULL),
('S00000010', 'staff10@newinti.edu.my', 'Nithya a/l Sanisvara', 'International Office', '$2y$10$pib2q9RpX9nQ7RS9FV7bsOaAnWc2hPeelJUJa/4z5qkGunLSd1pqm', '2020-12-05 15:06:35', '2020-12-05 15:06:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ic_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `academic_session` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `programme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_type`, `ic_num`, `name`, `contact_num`, `address`, `academic_session`, `programme`, `password`, `created_at`, `updated_at`, `remember_token`) VALUES
('J00000001', 'Local', '490116273083', 'T. Surendran', '+6017-197 9671', 'No. 8, Lorong Bellamy 5/8M, Desa Puchong, 72175 Seremban, Negeri Sembilan', 'AUGUST 2020', 'P00000003', '$2y$10$HAxMAF7LfwvjfW9jRR4zGOgUIR0lOxmab/ryo8eHvjb4aBJRhyKta', '2020-12-05 15:06:44', '2020-12-05 15:06:44', NULL),
('J00000002', 'Local', '500621377619', 'Qu Khi Thong', '+6013-056 7830', '32, Jln Raja Abdullah, Laman Mulia, 90627 Kota Kinabalu, Sabah', 'AUGUST 2020', 'P00000001', '$2y$10$y1C3IHmpXXROOnLDhMQOlegMm2wn7DMtXO7wDaPf6lgqXELfjkYm2', '2020-12-05 15:06:44', '2020-12-05 15:06:44', NULL),
('J00000003', 'Local', '590223420518', 'Janaky Alagaratnam a/l Kamalanathan', '+6017-976 4271', '46, Jalan 3/78, Taman Desa Utama, 90725 Pitas, Sabah', 'AUGUST 2020', 'P00000004', '$2y$10$AjewaoVXTkpNuV44kxFnQur5EmOsvufUrW86CCBc6ZqVKlvRkgYdq', '2020-12-05 15:06:44', '2020-12-05 15:06:44', NULL),
('J00000004', 'Local', '880821536516', 'Su Yew Chong', '+6010-599 1004', '3-4, Jalan Baru 7/16D, Kampung Pahlawan, 02054 Mata Ayer, Perlis Indera Kayangan', 'AUGUST 2020', 'P00000003', '$2y$10$ccuBpoYWerZHs0xpdw4hpuuAXe4JUvpdL9ZyyXR4yQFSTBWu6Xk2y', '2020-12-05 15:06:44', '2020-12-05 15:06:44', NULL),
('J00000005', 'Local', '210714412760', 'Rohan Sachithanandan a/l Krishnamurthi Devaraj', '+6016-529 6702', '8, Jalan 6Z, PJS21, 81723 Permas Jaya, Johor', 'AUGUST 2020', 'P00000002', '$2y$10$qdTw4.7k6.w6dsoOQAn2me4jT5ODiYmM6XXkQwn0hap2nc5yVczIe', '2020-12-05 15:06:44', '2020-12-05 15:06:44', NULL),
('J00000006', 'Local', '561010065013', 'Kamal a/l Manoharan', '+6012-852 8688', 'No. 6-3, Jalan Tun Ismail 79Q, Bandar Bukit Rahmat, 93213 Matu, Sarawak', 'AUGUST 2020', 'P00000003', '$2y$10$KU/3do5H/QCp9/9xdkKv6erotUMlB22ec.ovna94zmm8OhzIvXtTO', '2020-12-05 15:06:44', '2020-12-05 15:06:44', NULL),
('J00000007', 'International', '867098584', 'Maxime Bernier', '+6017-634 3109', 'No. N-03-59, Lorong 4, PJU8, 52784 Batu, KL', 'AUGUST 2020', 'P00000003', '$2y$10$M3tUMvAreR1Caov4lCatpOHiA08SmyZnbcWNgHFNnw5MP93K2Y.QC', '2020-12-05 15:06:45', '2020-12-05 15:06:45', NULL),
('J00000008', 'International', '679244050', 'Jerome Kling', '+6018-063 7743', '9-1, Jln Yap Ah Shak 4/5, Bandar Mahkota, 76664 Hang Tuah Jaya, Melaka', 'AUGUST 2020', 'P00000004', '$2y$10$zZXyHWUpG1cMd6avNZL2neL.b/n0i7U8mdzNK9aT/6AcNO8i/MBOC', '2020-12-05 15:06:45', '2020-12-05 15:06:45', NULL),
('J00000009', 'International', '972579882', 'Anika Sauer', '+6013-706 1995', '7, Jalan Davis 3Z, Taman Setapak, 33651 Teluk Intan, Perak', 'AUGUST 2020', 'P00000003', '$2y$10$hcp0vznZq4t1oBqyiW.7POb.mkcUND/I/dnIS6Qk0JQQkTQy8eD/e', '2020-12-05 15:06:45', '2020-12-05 15:06:45', NULL),
('J00000010', 'International', '84357908', 'Taryn Gulgowski', '+6013-533 9842', '18, Jln 9/97I, Taman Indah, 32278 Tanjung Rambutan, Perak', 'AUGUST 2020', 'P00000004', '$2y$10$NS9isrEtySFvP/BHW3WEU.sAdqhrbaqDOPd5jesEotqpp5b4TQWym', '2020-12-05 15:06:45', '2020-12-05 15:06:45', NULL),
('J00000011', 'International', '89877703', 'Douglas Cormier', '+6010-229 4085', 'Lot 4-5, Jalan 9/30, Taman Kinrara, 75450 Lubuk China, Malacca', 'AUGUST 2020', 'P00000004', '$2y$10$9EXZnjB7psfdHv5CyQDrYeCnRtzin.GWIfUi6xHaXGjMCKpfvKiDi', '2020-12-05 15:06:45', '2020-12-05 15:06:45', NULL),
('J00000012', 'International', '180194738', 'Mozell Conroy', '+6014-654 3594', '84, Lorong Tugu 6G, Taman Indah, 76233 Telok Mas, Malacca', 'AUGUST 2020', 'P00000003', '$2y$10$C8JUJ.mCaeTl2kHHzZWFGeBm0pklibBU96J31NqB3VzTJzStVaQOu', '2020-12-05 15:06:45', '2020-12-05 15:06:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supporting_document`
--

CREATE TABLE `supporting_document` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leave_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `update`
--

CREATE TABLE `update` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leave_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `enrolment`
--
ALTER TABLE `enrolment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `enrolment_student_id_section_id_unique` (`student_id`,`section_id`),
  ADD KEY `enrolment_section_id_foreign` (`section_id`);

--
-- Indexes for table `leave_action`
--
ALTER TABLE `leave_action`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_action_leave_id_foreign` (`leave_id`),
  ADD KEY `leave_action_session_id_foreign` (`session_id`);

--
-- Indexes for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD PRIMARY KEY (`leave_id`),
  ADD KEY `leave_application_student_id_foreign` (`student_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`programme_id`),
  ADD KEY `programme_head_of_programme_foreign` (`head_of_programme`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `section_lecturer_id_foreign` (`lecturer_id`),
  ADD KEY `section_course_id_foreign` (`course_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `session_section_id_foreign` (`section_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `student_programme_foreign` (`programme`);

--
-- Indexes for table `supporting_document`
--
ALTER TABLE `supporting_document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supporting_document_leave_id_foreign` (`leave_id`);

--
-- Indexes for table `update`
--
ALTER TABLE `update`
  ADD PRIMARY KEY (`id`),
  ADD KEY `update_leave_id_foreign` (`leave_id`),
  ADD KEY `update_student_id_foreign` (`student_id`),
  ADD KEY `update_staff_id_foreign` (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enrolment`
--
ALTER TABLE `enrolment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `leave_action`
--
ALTER TABLE `leave_action`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `supporting_document`
--
ALTER TABLE `supporting_document`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `update`
--
ALTER TABLE `update`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrolment`
--
ALTER TABLE `enrolment`
  ADD CONSTRAINT `enrolment_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`),
  ADD CONSTRAINT `enrolment_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `leave_action`
--
ALTER TABLE `leave_action`
  ADD CONSTRAINT `leave_action_leave_id_foreign` FOREIGN KEY (`leave_id`) REFERENCES `leave_application` (`leave_id`),
  ADD CONSTRAINT `leave_action_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `session` (`session_id`);

--
-- Constraints for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD CONSTRAINT `leave_application_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `programme`
--
ALTER TABLE `programme`
  ADD CONSTRAINT `programme_head_of_programme_foreign` FOREIGN KEY (`head_of_programme`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `section_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_programme_foreign` FOREIGN KEY (`programme`) REFERENCES `programme` (`programme_id`);

--
-- Constraints for table `supporting_document`
--
ALTER TABLE `supporting_document`
  ADD CONSTRAINT `supporting_document_leave_id_foreign` FOREIGN KEY (`leave_id`) REFERENCES `leave_application` (`leave_id`);

--
-- Constraints for table `update`
--
ALTER TABLE `update`
  ADD CONSTRAINT `update_leave_id_foreign` FOREIGN KEY (`leave_id`) REFERENCES `leave_application` (`leave_id`),
  ADD CONSTRAINT `update_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `update_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
