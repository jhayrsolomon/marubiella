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
-- Database: `marubiella_auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('common', '1', 1612376258),
('common', '12', 1614303544),
('common', '2', 1612376271),
('development', '2', 1612483702),
('employee_encoder', '12', 1614303466),
('Sales CSR', '16', 1614329864),
('Sales Encoder', '1', 1612221789),
('Sales Encoder', '19', 1614343976),
('Sales Junior', '11', 1614318884),
('Sales Leader', '18', 1614341646),
('Sales Manager', '17', 1614329993),
('Sales OSR', '15', 1614318896),
('Super Admin', '1', 1612218345);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/accounting/*', 2, NULL, NULL, NULL, 1613073976, 1613073976),
('/accounting/dashboard/*', 2, NULL, NULL, NULL, 1614152344, 1614152344),
('/accounting/default/*', 2, NULL, NULL, NULL, 1614152350, 1614152350),
('/admin/*', 2, NULL, NULL, NULL, 1612216210, 1612216210),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1612216128, 1612216128),
('/admin/dashboard/*', 2, NULL, NULL, NULL, 1612376562, 1612376562),
('/admin/default/*', 2, NULL, NULL, NULL, 1612216130, 1612216130),
('/admin/menu/*', 2, NULL, NULL, NULL, 1612216132, 1612216132),
('/admin/permission/*', 2, NULL, NULL, NULL, 1612216134, 1612216134),
('/admin/role/*', 2, NULL, NULL, NULL, 1612216137, 1612216137),
('/admin/route/*', 2, NULL, NULL, NULL, 1612216139, 1612216139),
('/admin/rule/*', 2, NULL, NULL, NULL, 1612216141, 1612216141),
('/admin/user/*', 2, NULL, NULL, NULL, 1612216144, 1612216144),
('/administration/*', 2, NULL, NULL, NULL, 1613066568, 1613066568),
('/administration/dashboard/*', 2, NULL, NULL, NULL, 1614152338, 1614152338),
('/administration/default/*', 2, NULL, NULL, NULL, 1614152335, 1614152335),
('/administration/default/index', 2, NULL, NULL, NULL, 1614303374, 1614303374),
('/administration/employee/*', 2, NULL, NULL, NULL, 1614152341, 1614152341),
('/administration/employee/attendance', 2, NULL, NULL, NULL, 1614329152, 1614329152),
('/administration/employee/create', 2, NULL, NULL, NULL, 1614303360, 1614303360),
('/administration/employee/index', 2, NULL, NULL, NULL, 1614303369, 1614303369),
('/administration/employee/master-list', 2, NULL, NULL, NULL, 1614303364, 1614303364),
('/administration/employee/payroll', 2, NULL, NULL, NULL, 1614329154, 1614329154),
('/administration/employee/status', 2, NULL, NULL, NULL, 1614329156, 1614329156),
('/administration/employee/update', 2, NULL, NULL, NULL, 1614303367, 1614303367),
('/administration/employee/view', 2, NULL, NULL, NULL, 1614303362, 1614303362),
('/administration/employment-designation/*', 2, NULL, NULL, NULL, 1614152348, 1614152348),
('/administration/employment-status/*', 2, NULL, NULL, NULL, 1614152346, 1614152346),
('/debug/*', 2, NULL, NULL, NULL, 1612216208, 1612216208),
('/debug/default/*', 2, NULL, NULL, NULL, 1612216206, 1612216206),
('/debug/user/*', 2, NULL, NULL, NULL, 1612216148, 1612216148),
('/gii/*', 2, NULL, NULL, NULL, 1612216154, 1612216154),
('/gii/default/*', 2, NULL, NULL, NULL, 1612216152, 1612216152),
('/gridview/*', 2, NULL, NULL, NULL, 1612376572, 1612376572),
('/gridview/export/*', 2, NULL, NULL, NULL, 1612376573, 1612376573),
('/gridviewKrajee/*', 2, NULL, NULL, NULL, 1612376570, 1612376570),
('/products/*', 2, NULL, NULL, NULL, 1613073979, 1613073979),
('/products/default/*', 2, NULL, NULL, NULL, 1614152352, 1614152352),
('/products/master-list/*', 2, NULL, NULL, NULL, 1614152354, 1614152354),
('/sales/*', 2, NULL, NULL, NULL, 1613066565, 1613066565),
('/sales/csr/*', 2, NULL, NULL, NULL, 1614152312, 1614152312),
('/sales/dashboard/*', 2, NULL, NULL, NULL, 1614152318, 1614152318),
('/sales/default/*', 2, NULL, NULL, NULL, 1614152316, 1614152316),
('/sales/encoder/*', 2, NULL, NULL, NULL, 1614152322, 1614152322),
('/sales/junior-leader/*', 2, NULL, NULL, NULL, 1614152325, 1614152325),
('/sales/leader/*', 2, NULL, NULL, NULL, 1614152328, 1614152328),
('/sales/manager/*', 2, NULL, NULL, NULL, 1614152329, 1614152329),
('/sales/osr/*', 2, NULL, NULL, NULL, 1614152332, 1614152332),
('/site/*', 2, NULL, NULL, NULL, 1612216156, 1612216156),
('/site/error', 2, NULL, NULL, NULL, 1612216213, 1612216213),
('/site/index', 2, NULL, NULL, NULL, 1612216215, 1612216215),
('/site/login', 2, NULL, NULL, NULL, 1612216217, 1612216217),
('/site/logout', 2, NULL, NULL, NULL, 1612216218, 1612216218),
('assignment', 2, 'Admin - Assignment;', NULL, NULL, 1612217381, 1614152096),
('common', 2, 'General Access;', NULL, NULL, 1612216528, 1614152107),
('debug', 2, 'Admin - Debug;', NULL, NULL, 1612217549, 1614152115),
('development', 2, 'Can access all frontend modules;', NULL, NULL, 1612483453, 1614152134),
('employee_encoder', 2, 'Encodes employee details', NULL, NULL, 1614303418, 1614303418),
('gii', 2, 'GII', NULL, NULL, 1612217567, 1614151872),
('menu', 2, 'Admin - Menu;', NULL, NULL, 1612217418, 1614152146),
('permission', 2, 'Admin - Permission;\r\nGive user access to certain class or module', NULL, NULL, 1612216721, 1614152155),
('rbac', 2, 'Admin - All;\r\nCan use all class(es) from admin module (Route, Permission, Menu, Role, Assignment, User)', NULL, NULL, 1612216109, 1614152165),
('role', 2, 'Admin - Role;\r\nAssign permission(s) to user', NULL, NULL, 1612216828, 1614152176),
('route', 2, 'Admin - Route;', NULL, NULL, 1612217366, 1614152184),
('rule', 2, 'Admin - Rule;', NULL, NULL, 1612217129, 1614152191),
('Sales CSR', 1, 'Sales Customer Service Representative', NULL, NULL, 1614153126, 1614153126),
('Sales Encoder', 1, 'Sales Encoder', NULL, NULL, 1612221756, 1614153077),
('Sales Junior', 1, 'Sales Junior Leader', NULL, NULL, 1614153308, 1614153365),
('Sales Leader', 1, 'Sales Team Leader', NULL, NULL, 1614153162, 1614153353),
('Sales Manager', 1, 'Sale Branch manager', NULL, NULL, 1614153331, 1614153331),
('Sales OSR', 1, 'Sales Online Seller Representative', NULL, NULL, 1614153236, 1614153236),
('sales_csr', 2, 'Sales Customer Service Representative;\r\nCan access Sales Module: CSR Controller', NULL, NULL, 1614152683, 1614152854),
('sales_encoder', 2, 'Sales Encoder;\r\nCan access Sales Module: Encoder Controller', NULL, NULL, 1614152729, 1614152875),
('sales_junior', 2, 'Sales Junior Team Leader;\r\nCan access Sales Module: Junior Leader Controller', NULL, NULL, 1614152455, 1614152897),
('sales_leader', 2, 'Sales Team Leader;\r\nCan access Sales Module: Leader Controller', NULL, NULL, 1614152514, 1614152917),
('sales_manager', 2, 'Sales Branch Manager;\r\nCan access Sales Module: Manger Controller', NULL, NULL, 1614152778, 1614152933),
('sales_osr', 2, 'Sales Online Sales Representative;\r\nCan access Sales Module: OSR Controller', NULL, NULL, 1614152297, 1614152825),
('Super Admin', 1, 'Super Administrator. Can access all modules in this system.', NULL, NULL, 1612215974, 1614153010),
('user', 2, 'Admin - User;\r\nUtilize the module(s) in the system', NULL, NULL, 1612217026, 1614152199);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('assignment', '/admin/assignment/*'),
('common', '/site/error'),
('common', '/site/index'),
('common', '/site/login'),
('common', '/site/logout'),
('debug', '/debug/*'),
('development', '/accounting/dashboard/*'),
('development', '/accounting/default/*'),
('development', '/administration/dashboard/*'),
('development', '/administration/default/*'),
('development', '/administration/default/index'),
('development', '/administration/employee/*'),
('development', '/administration/employee/attendance'),
('development', '/administration/employee/master-list'),
('development', '/administration/employee/payroll'),
('development', '/administration/employee/status'),
('development', '/administration/employment-designation/*'),
('development', '/administration/employment-status/*'),
('development', '/debug/default/*'),
('development', '/debug/user/*'),
('development', '/products/default/*'),
('development', '/products/master-list/*'),
('development', '/sales/csr/*'),
('development', '/sales/dashboard/*'),
('development', '/sales/default/*'),
('development', '/sales/encoder/*'),
('development', '/sales/junior-leader/*'),
('development', '/sales/leader/*'),
('development', '/sales/manager/*'),
('development', '/sales/osr/*'),
('employee_encoder', '/administration/dashboard/*'),
('employee_encoder', '/administration/default/*'),
('employee_encoder', '/administration/employee/create'),
('employee_encoder', '/administration/employee/index'),
('employee_encoder', '/administration/employee/master-list'),
('employee_encoder', '/administration/employee/update'),
('employee_encoder', '/administration/employee/view'),
('gii', '/gii/*'),
('menu', '/admin/menu/*'),
('permission', '/admin/permission/*'),
('rbac', '/admin/*'),
('role', '/admin/role/*'),
('route', '/admin/route/*'),
('rule', '/admin/rule/*'),
('Sales CSR', 'common'),
('Sales CSR', 'sales_csr'),
('Sales Encoder', 'common'),
('Sales Encoder', 'sales_encoder'),
('Sales Junior', 'common'),
('Sales Junior', 'sales_junior'),
('Sales Leader', 'common'),
('Sales Leader', 'sales_leader'),
('Sales Manager', 'common'),
('Sales Manager', 'sales_manager'),
('Sales OSR', 'common'),
('Sales OSR', 'sales_osr'),
('sales_csr', '/sales/csr/*'),
('sales_csr', '/sales/dashboard/*'),
('sales_encoder', '/sales/dashboard/*'),
('sales_encoder', '/sales/encoder/*'),
('sales_junior', '/sales/dashboard/*'),
('sales_junior', '/sales/junior-leader/*'),
('sales_leader', '/sales/dashboard/*'),
('sales_leader', '/sales/leader/*'),
('sales_manager', '/sales/dashboard/*'),
('sales_manager', '/sales/manager/*'),
('sales_osr', '/sales/dashboard/*'),
('sales_osr', '/sales/osr/*'),
('Super Admin', 'common'),
('Super Admin', 'debug'),
('Super Admin', 'gii'),
('Super Admin', 'rbac'),
('user', '/admin/user/*');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1612215156),
('m140506_102106_rbac_init', 1612215619),
('m140602_111327_create_menu_table', 1612215162),
('m160312_050000_create_user', 1612215162),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1612215619),
('m180523_151638_rbac_updates_indexes_without_prefix', 1612215619),
('m200409_110543_rbac_update_mssql_trigger', 1612215619);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'rhaiyne18', 'gZdqBAyyV3t7WAIpzHnDhQbDyWsWD0aK', '$2y$13$x3hiLI9dfIqYzdUJRTqnIOjiiJYyvVQpIJZwJe.Fb/PgQe/3j3XsC', NULL, 'jras.rhaiyne18@gmail.com', 10, 1612215341, 1612215341),
(2, 'manager', 'O0eOJ3b-5QBGP8jzHIY1p_uy4zalrjwG', '$2y$13$8.e8oa6fSYbryUJVakuaO.cNJlbPkT1nuJDgXriljHn5tj9iOpaUa', NULL, 'jras02012021.marubiella@gmail.com', 10, 1612375962, 1612375962),
(11, 'trisha', 'YSyCRM5WBX2jHrSg6zDxw5tMnLlVKMu6', '$2y$13$GzA91dHsHcZVADnB1zJAUuIQWrAmAzt3rpoNzwwY17.NToP05GBvi', NULL, 'trisha@gmail.com', 10, 1613161549, 1613161549),
(12, 'encoder', '1xF9Kwsrke8v6SjCvDoJkMqQQ8XA9um8', '$2y$13$FkI6Vaq1AhqS6D5bfXHfqeVuTSEIQHomqcTC8X5o/9XVPTVyBIqam', NULL, 'johnray_solomon18@yahoo.com', 10, 1614303306, 1614303306),
(15, 'kim', 'CynriYy0iPYqnaym_2yUlauzjEbnfOun', '$2y$13$i6RAkXj.oxIqbK5eDD9zdenH/eSL6RWFMvoPqSH3zsyKooeS//.FC', NULL, 'kim@gmail.com', 10, 1614318475, 1614318475),
(16, 'jane', 'NR8vMrDBjSINESjk881IR_Ek3OQxtOPv', '$2y$13$BkGquz1NckucgLATrB1EQukwHUGqRfFdMPfGUsF9K.acXmb45Dny2', NULL, 'jane@gmail.com', 10, 1614329842, 1614329842),
(17, 'kane', 'MlQhAhno79dH5OHvOKBg7qNFw48ysuvG', '$2y$13$KZECh0lLrDJktsaJR6XAS.pCPFHFQH1PP.8ntNkpVu7HF5c9PyCmO', NULL, 'kane@gmail.com', 10, 1614329975, 1614329975),
(18, 'hailey', '3BFhEt4xu21MbFP81v6dVQbl_A5eYgvM', '$2y$13$7TsiFmNPFABoHGC8plur.u.rV9cYVudT6FPot30y04bBM746VYvNC', NULL, 'hailey@gmail.com', 10, 1614341630, 1614341630),
(19, 'arvi', 'THaU3w0ChRAKn2rXE9Ye42NA_a-OgY21', '$2y$13$YDovoJR400.RDqx7mSaLNupVB6/dDpo2UdfYQBcRH2lJER5MfgMZ6', NULL, 'arvi@gmail.com', 10, 1614343964, 1614343964);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
