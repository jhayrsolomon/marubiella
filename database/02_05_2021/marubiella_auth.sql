-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2021 at 06:00 PM
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
('common', '2', 1612376271),
('development', '2', 1612483702),
('Sales Encoder', '1', 1612221789),
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
('/administration/employee/*', 2, NULL, NULL, NULL, 1614152341, 1614152341),
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
('development', '/accounting/*'),
('development', '/administration/*'),
('development', '/debug/*'),
('development', '/products/*'),
('development', '/sales/*'),
('gii', '/gii/*'),
('menu', '/admin/menu/*'),
('permission', '/admin/permission/*'),
('rbac', '/admin/*'),
('role', '/admin/role/*'),
('route', '/admin/route/*'),
('rule', '/admin/rule/*'),
('Sales CSR', 'sales_csr'),
('Sales Encoder', 'sales_encoder'),
('Sales Junior', 'sales_junior'),
('Sales Leader', 'sales_leader'),
('Sales Manager', 'sales_manager'),
('Sales OSR', 'sales_osr'),
('sales_csr', '/sales/csr/*'),
('sales_encoder', '/sales/encoder/*'),
('sales_junior', '/sales/junior-leader/*'),
('sales_leader', '/sales/leader/*'),
('sales_osr', '/sales/osr/*'),
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
(11, 'trisha', 'YSyCRM5WBX2jHrSg6zDxw5tMnLlVKMu6', '$2y$13$GzA91dHsHcZVADnB1zJAUuIQWrAmAzt3rpoNzwwY17.NToP05GBvi', NULL, 'trisha@gmail.com', 10, 1613161549, 1613161549);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
