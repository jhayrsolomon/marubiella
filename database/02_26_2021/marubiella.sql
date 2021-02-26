-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2021 at 08:56 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marubiella`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_code` varchar(32) NOT NULL,
  `customer_firstname` varchar(250) NOT NULL,
  `customer_middlename` varchar(250) DEFAULT NULL,
  `customer_lastname` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `age` varchar(11) NOT NULL,
  `customer_type_id` int(11) NOT NULL,
  `prefix_address` varchar(1000) NOT NULL,
  `barangay_id` int(11) NOT NULL,
  `municipality_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `landmark` varchar(1000) NOT NULL,
  `cellphone_number` varchar(13) NOT NULL,
  `telephone_number` varchar(15) NOT NULL,
  `customer_status_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_code`, `customer_firstname`, `customer_middlename`, `customer_lastname`, `gender`, `age`, `customer_type_id`, `prefix_address`, `barangay_id`, `municipality_id`, `province_id`, `region_id`, `landmark`, `cellphone_number`, `telephone_number`, `customer_status_id`, `is_active`, `date_created`, `date_updated`, `date_deleted`) VALUES
(1, 'jd01613604930', 'johnny', 'doe', 'doe', 'male', '35', 0, '12345', 13543, 526, 25, 5, 'Near gasoline station', '09261234567', 'N/A', 1, 1, '2021-02-17 23:35:30', '2021-02-23 23:39:24', NULL),
(2, 'ss11613605100', 'sarah', 'young', 'sy', 'female', '45', 0, 'f462', 16647, 646, 31, 6, 'Seaside', '09614567891', 'N/A', 1, 1, '2021-02-17 23:38:20', '2021-02-23 23:40:03', NULL),
(3, 'sv11613692958', 'sarah', 'dy', 'vergara', 'female', '23', 0, '123', 16646, 646, 31, 6, 'beside shell station', '09151234567', 'N/A', 1, 1, '2021-02-19 00:02:38', '2021-02-23 23:40:09', NULL),
(4, 'rs01613693080', 'raiyne', 'dy', 'sy', 'male', '28', 0, '34 zone 2', 7888, 313, 14, 3, 'Along conception church', '09201234567', 'N/A', 1, 1, '2021-02-19 00:04:40', '2021-02-23 23:40:14', NULL),
(5, 'sv11614128441', 'stela', 'ganda', 'valdez', 'female', '56', 0, '123', 12651, 487, 21, 4, 'Beside Macro Bistro', '', '', 1, 1, '2021-02-24 01:00:41', '2021-02-24 01:00:41', NULL),
(6, 'jp01614322968', 'john', 'solis', 'panganiban', 'male', '34', 0, 'lot 123, block 181, Fernandez Street, Oasis Subdivision', 36303, 1366, 70, 14, 'infront of Robinsons Lucky Gold, Ortigas Extension', '09613574535', 'N/A', 1, 1, '2021-02-26 07:02:48', '2021-02-26 07:02:48', NULL),
(7, 'rc01614328447', 'raiyne', 'sy', 'chua', 'male', '28', 0, '143', 7398, 293, 13, 3, 'beside jelexie bakeshop', '09511631473', 'N/A', 1, 1, '2021-02-26 08:34:07', '2021-02-26 08:34:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_status`
--

CREATE TABLE `customer_status` (
  `id` int(11) NOT NULL,
  `customer_status_code` varchar(32) NOT NULL,
  `customer_status_name` varchar(250) NOT NULL,
  `customer_status_description` varchar(1000) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_status`
--

INSERT INTO `customer_status` (`id`, `customer_status_code`, `customer_status_name`, `customer_status_description`, `is_active`, `date_created`, `date_updated`, `date_deleted`) VALUES
(1, 'ACTIVE', 'Active Customer', 'Active Customer', 1, '2021-02-10 22:20:25', '2021-02-10 22:20:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_type`
--

CREATE TABLE `customer_type` (
  `id` int(11) NOT NULL,
  `customer_type_code` varchar(250) NOT NULL,
  `customer_type_name` varchar(250) NOT NULL,
  `customer_type_description` varchar(1000) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_type`
--

INSERT INTO `customer_type` (`id`, `customer_type_code`, `customer_type_name`, `customer_type_description`, `is_active`, `date_created`, `date_updated`, `date_deleted`) VALUES
(1, 'SOLE', 'Sole Customer', 'A customer who bought product(s) for personal use', 1, '2021-02-10 22:16:58', NULL, NULL),
(2, 'RESELLER', 'Reseller Customer', 'A customer who bought product(s) for business and also for personal use', 1, '2021-02-10 22:18:53', '2021-02-10 22:18:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_code` varchar(32) DEFAULT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `cellphone_number` varchar(13) NOT NULL,
  `telephone_number` varchar(15) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `status_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `user_id`, `user_code`, `firstname`, `middlename`, `lastname`, `cellphone_number`, `telephone_number`, `date_of_birth`, `is_active`, `status_id`, `date_created`, `date_updated`, `date_deleted`) VALUES
(1, 1, 'gZdqBAyyV3t7WAIpzHnDhQbDyWsWD0aK', 'john raymund', 'abenojar', 'solomon', '09264372840', 'N/A', '1993-05-18', 1, 1, '2021-02-10 18:59:56', '2021-02-12 23:56:17', NULL),
(2, 2, 'O0eOJ3b-5QBGP8jzHIY1p_uy4zalrjwG', 'Raymund', 'Solomon', 'Abenojar', '09511631473', 'N/A', '1990-03-18', 1, 1, '2021-02-11 22:14:45', '2021-02-12 23:57:03', NULL),
(3, 11, 'YSyCRM5WBX2jHrSg6zDxw5tMnLlVKMu6', 'john floyd', 'terrado', 'ferrer', '09090602900', 'na', '2000-09-18', 1, 1, '2021-02-12 18:17:44', '2021-02-12 23:57:07', NULL),
(4, 15, 'CynriYy0iPYqnaym_2yUlauzjEbnfOun', 'Alexander Kim', 'Carreon', 'Gemino', '09302182773', 'N/A', '2001-12-29', 1, 1, '2021-02-12 18:19:36', '2021-02-26 05:47:55', NULL),
(5, 16, 'NR8vMrDBjSINESjk881IR_Ek3OQxtOPv', 'Jane', 'Sy', 'Doe', '09511631473', 'N/A', '1995-08-17', 1, 1, '2021-02-26 08:56:46', '2021-02-26 09:09:34', NULL),
(6, 17, 'MlQhAhno79dH5OHvOKBg7qNFw48ysuvG', 'Kane', 'Sy', 'Palaganas', '09511631473', 'N/A', '1991-07-17', 1, 1, '2021-02-26 08:58:59', '2021-02-26 09:09:37', NULL),
(7, 18, '3BFhEt4xu21MbFP81v6dVQbl_A5eYgvM', 'Hailey', 'Sy', 'Doe', '09511631473', 'N/A', '1994-07-27', 1, 1, '2021-02-26 12:13:19', '2021-02-26 12:13:50', NULL),
(8, 19, 'THaU3w0ChRAKn2rXE9Ye42NA_a-OgY21', 'Arvi', 'Molina', 'Valdez', '09511631473', 'N/A', '1995-06-14', 1, 1, '2021-02-26 12:52:17', '2021-02-26 12:52:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_address`
--

CREATE TABLE `employee_address` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `prefix_address` varchar(1000) NOT NULL,
  `barangay_id` int(11) NOT NULL,
  `municipality_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_address`
--

INSERT INTO `employee_address` (`id`, `employee_id`, `prefix_address`, `barangay_id`, `municipality_id`, `province_id`, `region_id`, `is_active`, `date_created`, `date_updated`, `date_deleted`) VALUES
(1, 1, '199', 2897, 111, 4, 1, 1, '2021-02-10 18:59:56', '2021-02-10 18:59:56', NULL),
(2, 2, '123', 8590, 345, 16, 3, 1, '2021-02-11 22:14:45', '2021-02-11 22:14:45', NULL),
(3, 3, '#1483 malued dist. dagupan city', 2354, 95, 4, 1, 1, '2021-02-12 18:17:44', '2021-02-12 18:17:44', NULL),
(4, 4, '#44 Mangin District Dagupan City', 2356, 95, 4, 1, 1, '2021-02-12 18:19:36', '2021-02-12 18:19:36', NULL),
(5, 5, '1435', 2345, 95, 4, 1, 1, '2021-02-26 08:56:46', '2021-02-26 08:56:46', NULL),
(6, 6, '145', 2348, 95, 4, 1, 1, '2021-02-26 08:58:59', '2021-02-26 08:58:59', NULL),
(7, 7, '345', 2347, 95, 4, 1, 1, '2021-02-26 12:13:19', '2021-02-26 12:13:19', NULL),
(8, 8, '234', 2718, 107, 4, 1, 1, '2021-02-26 12:52:17', '2021-02-26 12:52:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_affiliation`
--

CREATE TABLE `employee_affiliation` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `employment_designation_id` int(11) NOT NULL,
  `employment_status_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_affiliation`
--

INSERT INTO `employee_affiliation` (`id`, `employee_id`, `employment_designation_id`, `employment_status_id`, `is_active`, `date_created`, `date_updated`, `date_deleted`) VALUES
(1, 1, 2, 2, 1, '2021-02-10 18:59:56', '2021-02-10 19:47:19', NULL),
(2, 2, 1, 2, 1, '2021-02-11 22:14:45', NULL, NULL),
(3, 3, 4, 1, 1, '2021-02-12 18:17:44', NULL, NULL),
(4, 4, 1, 2, 1, '2021-02-12 18:19:36', NULL, NULL),
(5, 5, 5, 1, 1, '2021-02-26 08:56:46', NULL, NULL),
(6, 6, 7, 1, 1, '2021-02-26 08:58:59', NULL, NULL),
(7, 7, 3, 1, 1, '2021-02-26 12:13:19', NULL, NULL),
(8, 8, 6, 1, 1, '2021-02-26 12:52:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_daily_time_record`
--

CREATE TABLE `employee_daily_time_record` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `today_date` date NOT NULL,
  `in_out` varchar(3) NOT NULL,
  `time_report` time NOT NULL,
  `remark` varchar(500) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_daily_time_record`
--

INSERT INTO `employee_daily_time_record` (`id`, `user_id`, `employee_id`, `today_date`, `in_out`, `time_report`, `remark`, `date_created`, `date_updated`, `date_deleted`) VALUES
(1, 2, 2, '2021-02-24', 'in', '17:48:23', 'late', '2021-02-24 09:48:23', NULL, NULL),
(2, 2, 2, '2021-02-24', 'out', '17:48:44', 'On Time', '2021-02-24 09:48:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employment_designation`
--

CREATE TABLE `employment_designation` (
  `id` int(11) NOT NULL,
  `employment_designation_code` varchar(10) NOT NULL,
  `employment_designation_code_description` varchar(500) NOT NULL,
  `employment_designation_job_description` varchar(1000) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employment_designation`
--

INSERT INTO `employment_designation` (`id`, `employment_designation_code`, `employment_designation_code_description`, `employment_designation_job_description`, `is_active`, `date_created`, `date_updated`, `date_deleted`) VALUES
(1, 'OSR', 'Online Sales Representative', 'Sell Product(s) to clients / customer via online', 1, '2021-02-04 01:45:01', '2021-02-05 18:53:40', NULL),
(2, 'ITM', 'Information Technology Manager', 'Running regular checks on network and data security; Identifying and acting on opportunities to improve and update software and systems; Developing and implementing IT policy and best practice guides for the organisation;  Conducting regular system audits', 1, '2021-02-04 01:50:59', '2021-02-04 01:50:59', NULL),
(3, 'TL', 'Sales Team Leader', 'Oversee OSR and ATL, and Sell Product(s) to client(s) / Customer(s) via online', 1, '2021-02-05 18:14:18', '2021-02-24 08:29:51', NULL),
(4, 'JTL', 'Sales Junior Team Leader', 'Oversee OSR and Sell Product(s) to client(s) / Customer(s) via online', 1, '2021-02-05 18:14:58', '2021-02-24 08:26:28', NULL),
(5, 'CSR', 'Customer Sales Representative', 'Confirm Sale(s)', 1, '2021-02-05 18:16:21', '2021-02-05 18:17:02', NULL),
(6, 'ENC', 'Sales Encoder', 'Dispatch Sale(s)', 1, '2021-02-05 18:16:49', '2021-02-24 08:30:13', NULL),
(7, 'BM', 'Sales Branch Manager', 'Oversee all Operations', 1, '2021-02-05 18:18:43', '2021-02-24 08:30:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employment_status`
--

CREATE TABLE `employment_status` (
  `id` int(11) NOT NULL,
  `employment_status_code` varchar(10) NOT NULL,
  `employment_status_description` varchar(500) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employment_status`
--

INSERT INTO `employment_status` (`id`, `employment_status_code`, `employment_status_description`, `is_active`, `date_created`, `date_updated`, `date_deleted`) VALUES
(1, 'REG', 'Regular / Permanent Employee', 1, '2021-02-04 00:35:22', '2021-02-24 08:19:11', NULL),
(2, 'PROBIE', 'Probationary Employee', 1, '2021-02-05 18:08:11', '2021-02-05 18:55:45', NULL),
(3, 'CAS', 'Casual Employee', 1, '2021-02-05 18:08:30', NULL, NULL),
(4, 'FIXED', 'Fixed-Term Employee', 1, '2021-02-05 18:11:57', NULL, NULL),
(5, 'OBS', 'Observation', 1, '2021-02-24 08:22:57', NULL, NULL),
(6, 'TRN', 'Trainee', 1, '2021-02-24 08:23:30', NULL, NULL),
(7, 'BOS', 'Base On Sales', 1, '2021-02-24 08:23:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_code` varchar(32) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_type` varchar(250) NOT NULL,
  `product_description` varchar(1000) NOT NULL,
  `amount` double(11,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_code`, `product_name`, `product_type`, `product_description`, `amount`, `is_active`, `date_created`, `date_updated`, `date_deleted`) VALUES
(1, 'MACA', 'MACA', 'MACA', 'MACA', 1000.00, 1, '2021-02-10 20:17:51', '2021-02-10 20:17:51', NULL),
(2, 'Ginger', 'Blooms2', 'Sampoo2', 'Organic Shampoo', 2500.00, 1, '2021-02-11 01:03:51', '2021-02-16 22:05:02', NULL),
(3, 'Varicose', 'Varicose', 'Food Suppliment', 'To Treat Varicose Veins', 650.00, 1, '2021-02-18 23:14:26', '2021-02-18 23:14:26', NULL),
(4, 'Via', 'Viagra', 'Food Suppl', 'Food Suppliment', 2500.00, 1, '2021-02-24 00:57:28', '2021-02-24 00:57:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_online`
--

CREATE TABLE `sales_online` (
  `id` int(11) NOT NULL,
  `sales_code` varchar(32) NOT NULL,
  `sales_tracking_number` varchar(32) DEFAULT NULL,
  `courier_id` int(11) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_type_id` int(11) NOT NULL,
  `total_amount` double(11,2) NOT NULL,
  `care_of` varchar(250) NOT NULL,
  `sales_status_id` int(11) NOT NULL,
  `osr_remark` varchar(1000) DEFAULT NULL,
  `page` varchar(250) NOT NULL,
  `csr_id` int(11) DEFAULT NULL,
  `csr_remark` varchar(1000) DEFAULT NULL,
  `dispatcher_id` int(11) DEFAULT NULL,
  `dispatcher_remark` varchar(1000) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_online`
--

INSERT INTO `sales_online` (`id`, `sales_code`, `sales_tracking_number`, `courier_id`, `employee_id`, `team_id`, `customer_id`, `customer_type_id`, `total_amount`, `care_of`, `sales_status_id`, `osr_remark`, `page`, `csr_id`, `csr_remark`, `dispatcher_id`, `dispatcher_remark`, `is_active`, `date_created`, `date_updated`, `date_deleted`) VALUES
(1, 'ra11613604930', NULL, NULL, 2, 1, 1, 1, 4500.00, 'N/A', 2, 'For Confirmation', 'Marketplace', NULL, NULL, NULL, NULL, 1, '2021-02-17 23:35:30', '2021-02-19 19:02:57', NULL),
(2, 'ra11613605100', NULL, NULL, 2, 1, 2, 2, 8500.00, 'Jenny Sy', 1, 'For Confirmation', 'Marketplace', NULL, NULL, NULL, NULL, 1, '2021-02-17 23:38:20', '2021-02-17 23:38:20', NULL),
(3, 'ra11613692958', NULL, NULL, 2, 1, 3, 2, 650.00, 'N/A', 3, 'For Confirmation', 'Marketplace', NULL, 'sample', NULL, NULL, 1, '2021-02-19 00:02:38', '2021-02-25 06:51:14', NULL),
(4, 'ra11613693080', NULL, NULL, 2, 1, 4, 1, 4150.00, 'N/A', 5, 'For Confirmation', 'Marketplace', NULL, 'sample2', NULL, NULL, 1, '2021-02-19 00:04:40', '2021-02-25 06:53:49', NULL),
(5, 'ra11614128441', NULL, NULL, 2, 1, 5, 1, 5800.00, 'N/A', 6, 'For Confirmation', 'Marketplace', NULL, 'dfgbhsfdh', NULL, NULL, 1, '2021-02-24 01:00:41', '2021-02-25 07:23:40', NULL),
(6, 'ag11614322968', NULL, NULL, 4, 1, 6, 1, 2000.00, 'N/A', 2, 'For Confirmation', 'Marketplace', NULL, 'Confirmed', NULL, NULL, 1, '2021-02-26 07:02:48', '2021-02-26 09:57:22', NULL),
(7, 'jf11614328447', NULL, NULL, 3, 1, 7, 1, 6000.00, 'N/A', 1, 'For Confirmation', 'Marketplace', NULL, NULL, NULL, NULL, 1, '2021-02-26 08:34:07', '2021-02-26 08:34:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_product`
--

CREATE TABLE `sales_product` (
  `id` int(11) NOT NULL,
  `sales_online_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(100) NOT NULL,
  `collectible_amount` double(100,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_product`
--

INSERT INTO `sales_product` (`id`, `sales_online_id`, `product_id`, `quantity`, `collectible_amount`, `is_active`, `date_created`, `date_updated`, `date_deleted`) VALUES
(1, 1, 1, 2, 2000.00, 1, '2021-02-17 23:35:30', '2021-02-17 23:35:30', NULL),
(2, 1, 2, 1, 2500.00, 1, '2021-02-17 23:35:30', '2021-02-17 23:35:30', NULL),
(3, 2, 1, 1, 1000.00, 1, '2021-02-17 23:38:20', '2021-02-17 23:38:20', NULL),
(4, 2, 2, 3, 7500.00, 1, '2021-02-17 23:38:20', '2021-02-17 23:38:20', NULL),
(5, 3, 3, 1, 650.00, 1, '2021-02-19 00:02:38', '2021-02-19 00:02:38', NULL),
(6, 4, 1, 1, 1000.00, 1, '2021-02-19 00:04:40', '2021-02-19 00:04:40', NULL),
(7, 4, 3, 1, 650.00, 1, '2021-02-19 00:04:40', '2021-02-19 00:04:40', NULL),
(8, 4, 2, 1, 2500.00, 1, '2021-02-19 00:04:40', '2021-02-19 00:04:40', NULL),
(9, 5, 1, 2, 2000.00, 1, '2021-02-24 01:00:41', '2021-02-24 01:00:41', NULL),
(10, 5, 2, 1, 2500.00, 1, '2021-02-24 01:00:41', '2021-02-24 01:00:41', NULL),
(11, 5, 3, 2, 1300.00, 1, '2021-02-24 01:00:41', '2021-02-24 01:00:41', NULL),
(12, 6, 1, 2, 2000.00, 1, '2021-02-26 07:02:48', '2021-02-26 07:02:48', NULL),
(13, 7, 2, 2, 5000.00, 1, '2021-02-26 08:34:07', '2021-02-26 08:34:07', NULL),
(14, 7, 1, 1, 1000.00, 1, '2021-02-26 08:34:07', '2021-02-26 08:34:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_status`
--

CREATE TABLE `sales_status` (
  `id` int(11) NOT NULL,
  `sales_status_code` varchar(32) NOT NULL,
  `sales_status_name` varchar(250) NOT NULL,
  `sales_status_description` varchar(1000) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_status`
--

INSERT INTO `sales_status` (`id`, `sales_status_code`, `sales_status_name`, `sales_status_description`, `is_active`, `date_created`, `date_updated`, `date_deleted`) VALUES
(1, 'FOR CONFIRMATION', 'For Confirmation', 'For confirmation', 1, '2021-02-16 21:49:10', '2021-02-16 21:49:10', NULL),
(2, 'VALIDATED', 'Validated', 'Validated sales', 1, '2021-02-16 21:50:00', '2021-02-16 21:50:00', NULL),
(3, 'UNAVAILABLE', 'Unavailable', 'Unavailable', 1, '2021-02-16 21:52:33', '2021-02-16 21:52:33', NULL),
(4, 'RESERVED', 'Reserved', 'Reserved', 1, '2021-02-16 21:53:32', '2021-02-16 21:53:32', NULL),
(5, 'REPROCESS', 'Reprocess', 'Reprocess', 1, '2021-02-16 21:53:32', '2021-02-16 21:53:32', NULL),
(6, 'HOLD', 'Hold', 'Hold', 1, '2021-02-16 21:54:07', '2021-02-16 21:54:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status_code` varchar(10) NOT NULL,
  `status_description` varchar(500) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_code`, `status_description`, `is_active`, `date_created`, `date_updated`, `date_deleted`) VALUES
(1, 'ACTIVE', 'No disciplinary action given', 1, '2021-02-09 19:26:22', '2021-02-09 19:26:22', NULL),
(2, 'SUSPENDED', 'Given suspension for disciplinary action', 1, '2021-02-09 19:26:22', '2021-02-09 19:26:22', NULL),
(3, 'TERMINATED', 'Discharge from the job', 1, '2021-02-09 19:26:22', '2021-02-09 19:26:22', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_status`
--
ALTER TABLE `customer_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_type`
--
ALTER TABLE `customer_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `employee_address`
--
ALTER TABLE `employee_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_affiliation`
--
ALTER TABLE `employee_affiliation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_daily_time_record`
--
ALTER TABLE `employee_daily_time_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment_designation`
--
ALTER TABLE `employment_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment_status`
--
ALTER TABLE `employment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_online`
--
ALTER TABLE `sales_online`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_product`
--
ALTER TABLE `sales_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_status`
--
ALTER TABLE `sales_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_status`
--
ALTER TABLE `customer_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_type`
--
ALTER TABLE `customer_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee_address`
--
ALTER TABLE `employee_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee_affiliation`
--
ALTER TABLE `employee_affiliation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee_daily_time_record`
--
ALTER TABLE `employee_daily_time_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employment_designation`
--
ALTER TABLE `employment_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employment_status`
--
ALTER TABLE `employment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_online`
--
ALTER TABLE `sales_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sales_product`
--
ALTER TABLE `sales_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sales_status`
--
ALTER TABLE `sales_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
