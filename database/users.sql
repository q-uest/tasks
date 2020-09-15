-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2020 at 06:29 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--
CREATE DATABASE IF NOT EXISTS `users` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `users`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_body` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `project_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `project_body`, `created_date`, `project_user_id`) VALUES
(34, 'Database Tasks', 'Database Tasks', '2020-04-21 08:16:27', 24),
(35, 'Java Spring', 'Java Spring boot!! Try next....!', '2020-04-21 08:16:27', 24),
(36, 'Bheem\'s', 'Bheem\'s project', '2020-04-21 12:51:29', 24),
(37, 'SalesForce', 'SalesForce', '2020-09-12 14:02:18', 24),
(38, 'Renew the world', 'Renew the world', '2020-09-12 15:08:50', 24),
(39, 'Training', 'Training', '2020-09-12 15:29:34', 24);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_body` text NOT NULL,
  `parent_task_id` int(11) DEFAULT NULL,
  `userid` int(5) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `approved` int(1) NOT NULL DEFAULT 1,
  `status` int(1) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `groupid` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `clo_comments` text NOT NULL COMMENT 'closing comments',
  `clo_date` date DEFAULT NULL,
  `latest_update` text DEFAULT NULL,
  `latestupd_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_name`, `task_body`, `parent_task_id`, `userid`, `date_created`, `approved`, `status`, `project_id`, `due_date`, `groupid`, `created_datetime`, `clo_comments`, `clo_date`, `latest_update`, `latestupd_datetime`) VALUES
(160, 'Create and execute databasse tasks!', 'Create and execute databasse tasks!', 0, 26, '2019-09-30 18:30:00', 0, 1, 34, '2020-09-14', 160, '2020-08-15 18:08:21', '', '0000-00-00', 'Got stuck as there is no enough storage space available!!!', '2020-09-05 06:29:00'),
(161, 'setup database', 'create database for the app', 160, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', '0000-00-00', 'in progress!', '2020-09-05 14:12:00'),
(162, 'create users', 'create the required database users', 161, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(163, 'Generate users list', 'Generate users list checking with the business  team', 162, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(164, 'Create scripts for users creation', 'Create database scripts for user setup', 162, 26, '2019-09-30 18:30:00', 0, 1, 34, '2020-09-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(165, 'Execute database scripts', 'Ask the dba responsible to execute the script', 162, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(166, 'Generate user list', 'Create users list in a text file', 164, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(167, 'Write shell script', 'Write a shell script', 164, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(168, 'Checkin scripts in GIT', 'Checkin the script in GIT', 164, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(169, 'php application layer', 'php application layer components', 0, 26, '2019-09-30 18:30:00', 0, 1, 34, '2022-02-01', 169, '2020-08-15 18:08:21', '', '0000-00-00', 'The task is in progress ! will be done on time !!! :-)', '2020-09-04 17:02:00'),
(170, 'php backend', 'php backend components', 169, 26, '2019-09-30 18:30:00', 0, 3, 34, '2022-02-01', 169, '2020-08-15 18:08:21', 'The task is to be closed!!', NULL, NULL, NULL),
(172, 'javascript coding', 'javascript coding', 170, 26, '2019-09-30 18:30:00', 0, 1, 34, '2022-02-01', 169, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(173, 'setup prod database', 'setup prod database', 161, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(174, 'write db scripts', 'write db scripts', 173, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(175, 'Java spring backend', 'JS application layer components', 0, 26, '2019-09-30 18:30:00', 0, 1, 35, '2021-01-01', 175, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(176, 'Java spring database', 'JS application database components', 175, 26, '2019-09-30 18:30:00', 0, 3, 35, '2021-01-01', 175, '2020-08-15 18:08:21', 'task closed !', '2020-08-30', NULL, NULL),
(177, 'Java spring app', 'JS application app components', 175, 26, '2019-09-30 18:30:00', 0, 1, 35, '2021-01-01', 175, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(178, 'Java spring database creation', 'JS create db', 176, 26, '2019-09-30 18:30:00', 0, 1, 35, '2021-01-01', 175, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(179, 'subtask1', 'subtask test', 167, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(180, 'subtask1', 'subtask test', 179, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(181, 'subtask1', 'subtask test', 180, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(182, 'subtask1', 'subtask test', 181, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(183, 'subtask1', 'subtask test', 182, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(184, 'subtask1', 'subtask test', 183, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(185, 'subtask1', 'subtask test', 184, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(186, 'subtask1', 'subtask test', 185, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(187, 'subtask1', 'subtask test', 186, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(188, 'subtask1', 'subtask test', 187, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(189, 'subtask1', 'subtask test', 188, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', '0000-00-00', 'The work is in progress. DB part completed. Awaiting sysadmin team response.', '2020-09-04 12:44:00'),
(190, 'subtask', 'subtask', 181, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(191, 'subtask2', 'subtask2', 181, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(192, 'subtask test', 'sub task test', 188, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(193, 'subtask test', 'sub task test', 188, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(194, 'subtask test', 'sub task test', 188, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(195, 'exeute oracle db scripts', 'Oracle database scripts', 165, 24, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', '0000-00-00', NULL, NULL),
(196, 'exeute SQLSERVER db scripts', 'SQLSERVER database scripts', 165, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(197, 'oracle db scripts', 'Oracle database scripts', 173, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(198, 'sqlserver db scripts', 'Sqlserver database scripts', 173, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(199, 'sqlserver create user', 'Sqlserver create user', 198, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(200, 'Ask busiess unit', 'Ask business unit for users list', 162, 26, '2019-09-30 18:30:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(220, 'oracle db', 'oracle db', 160, 26, '2020-08-10 04:37:58', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(222, 'newtask', 'newtask', 161, 26, '2020-08-10 05:49:09', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(245, 'fdfd', 'dfdfdf', 161, 25, '2020-08-10 16:18:37', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(262, '4444', '34343434', 160, 26, '2020-08-14 14:55:49', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', '0000-00-00', 'working on top prioirity basis...expected to be complete by end of this week', '2020-09-04 14:06:00'),
(264, 'ram23', 'ram23', 160, 27, '2020-08-14 14:56:31', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', '0000-00-00', NULL, NULL),
(265, 'iuiuiu', 'uiuiu', 160, 27, '2020-08-14 15:00:31', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', '0000-00-00', NULL, NULL),
(266, '33434', '343434', 160, 26, '2020-08-14 15:03:00', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', '0000-00-00', 'to be completed by end of this week!', '2020-09-04 14:07:00'),
(267, 'subtask', 'subtask', 265, 24, '2020-08-14 15:05:21', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', NULL, NULL, NULL),
(268, 'subtask', 'subtask', 267, 24, '2020-08-14 15:06:36', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', '0000-00-00', 'This is in progress! will be complete end of next week !!! :-)', '2020-09-04 16:36:00'),
(271, 'rk2', 'rk2', 160, 26, '2020-08-14 15:26:58', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', '0000-00-00', 'willbe complete on time !', '2020-09-05 03:38:00'),
(273, 'Backend', 'Backend34343', 160, 26, '2020-08-15 06:32:28', 0, 1, 34, '2021-01-01', 160, '2020-08-15 18:08:21', '', '0000-00-00', 'will be done on time...promise !', '2020-09-06 17:03:00'),
(274, 'newtask', 'newtask', 160, 24, '2020-08-17 05:00:24', 0, 1, 34, '2021-01-01', 160, '2020-08-17 10:30:24', '', NULL, NULL, NULL),
(275, 'new1', 'new1', 160, 24, '2020-08-17 07:57:16', 0, 1, 34, '2021-01-01', 160, '2020-08-17 13:27:16', '', NULL, NULL, NULL),
(276, 'approved', 'mani task', 160, 24, '2020-08-18 02:59:07', 0, 1, 34, '2021-01-01', 160, '2020-08-18 08:29:07', '', NULL, NULL, NULL),
(277, 'approved', 'mani task2', 160, 24, '2020-08-18 03:04:47', 0, 1, 34, '2021-01-01', 160, '2020-08-18 08:34:47', '', NULL, NULL, NULL),
(278, 'manitask102', 'manitask102', 160, 24, '2020-08-18 04:43:06', 0, 1, 34, '2021-01-01', 160, '2020-08-18 10:13:06', '', NULL, NULL, NULL),
(279, 'manitask103', 'manitask103', 160, 24, '2020-08-18 04:45:05', 0, 1, 34, '2021-01-01', 160, '2020-08-18 10:15:05', '', NULL, NULL, NULL),
(280, 'manitask150', 'manitask150', 160, 24, '2020-08-18 05:39:52', 0, 1, 34, '2021-01-01', 160, '2020-08-18 11:09:52', '', NULL, NULL, NULL),
(281, 'ramkumartask1', 'ramkumartask1', 160, 24, '2020-08-18 09:51:39', 0, 1, 34, '2021-01-01', 160, '2020-08-18 15:21:39', '', NULL, NULL, NULL),
(282, 'ramkumar-subtask1', 'ramkumar-subtask1', 161, 24, '2020-08-18 09:53:31', 0, 1, 34, '2021-01-01', 160, '2020-08-18 15:23:31', '', NULL, NULL, NULL),
(283, 'manitask200', 'manitask200', 160, 24, '2020-08-18 15:16:07', 0, 1, 34, '2021-01-01', 160, '2020-08-18 20:46:07', '', NULL, NULL, NULL),
(284, 'mani300', 'mani300', 160, 24, '2020-08-18 15:22:59', 0, 1, 34, '2021-01-01', 160, '2020-08-18 20:52:59', '', NULL, NULL, NULL),
(285, 'mani301', 'mani301', 160, 24, '2020-08-18 15:27:29', 0, 1, 34, '2021-01-01', 160, '2020-08-18 20:57:29', '', NULL, NULL, NULL),
(286, 'mani401', 'mani401', 160, 24, '2020-08-18 15:29:16', 0, 1, 34, '2021-01-01', 160, '2020-08-18 20:59:16', '', NULL, NULL, NULL),
(287, 'mani420', 'mani420', 160, 24, '2020-08-18 15:31:52', 0, 1, 34, '2021-01-01', 160, '2020-08-18 21:01:52', '', NULL, NULL, NULL),
(288, 'mani500', 'mani500', 160, 24, '2020-08-18 15:34:13', 0, 1, 34, '2021-01-01', 160, '2020-08-18 21:04:13', '', NULL, NULL, NULL),
(289, 'mani501', 'mani501', 160, 24, '2020-08-18 15:35:51', 0, 1, 34, '2021-01-01', 160, '2020-08-18 21:05:51', '', NULL, NULL, NULL),
(290, 'task502', 'task502', 160, 24, '2020-08-18 15:37:11', 0, 1, 34, '2021-01-01', 160, '2020-08-18 21:07:11', '', NULL, NULL, NULL),
(291, 'mani505', 'mani505', 160, 24, '2020-08-18 15:40:50', 0, 1, 34, '2021-01-01', 160, '2020-08-18 21:10:50', '', NULL, NULL, NULL),
(292, 'mani506', 'mani506', 160, 24, '2020-08-18 15:45:24', 0, 1, 34, '2021-01-01', 160, '2020-08-18 21:15:24', '', NULL, NULL, NULL),
(293, 'mani601', 'mani601', 160, 24, '2020-08-18 15:46:52', 0, 1, 34, '2021-01-01', 160, '2020-08-18 21:16:52', '', NULL, NULL, NULL),
(294, 'mani602', 'mani602', 160, 24, '2020-08-18 15:47:07', 0, 1, 34, '2021-01-01', 160, '2020-08-18 21:17:07', '', NULL, NULL, NULL),
(295, 'mani600', 'mani600', 160, 24, '2020-08-18 15:56:04', 0, 1, 34, '2021-01-01', 160, '2020-08-18 21:26:04', '', NULL, NULL, NULL),
(296, 'mani602', 'mani602', 160, 24, '2020-08-18 15:58:05', 0, 1, 34, '2021-01-01', 160, '2020-08-18 21:28:05', '', NULL, NULL, NULL),
(297, 'mani605', 'mni605', 160, 24, '2020-08-18 15:59:42', 0, 1, 34, '2021-01-01', 160, '2020-08-18 21:29:42', '', NULL, NULL, NULL),
(298, 'mani700', 'mani700', 160, 24, '2020-08-18 16:01:34', 0, 1, 34, '2021-01-01', 160, '2020-08-18 21:31:34', '', NULL, NULL, NULL),
(299, 'mani2!!', 'mani2', 160, 24, '2020-08-19 03:45:16', 0, 1, 34, '2021-01-01', 160, '2020-08-19 09:15:16', '', NULL, NULL, NULL),
(300, 'new1', 'ejeireiru', 160, 24, '2020-08-21 02:56:09', 0, 1, 34, '2021-01-01', 160, '2020-08-21 08:26:09', '', NULL, NULL, NULL),
(301, 'maninew', 'maninew', 160, 24, '2020-08-21 16:23:27', 0, 1, 34, '2021-01-01', 160, '2020-08-21 21:53:27', '', NULL, NULL, NULL),
(307, 'approvecheck2', 'approvecheck2', 160, 24, '2020-08-22 11:54:45', 0, 1, 34, '2021-01-01', 160, '2020-08-22 17:24:45', '', NULL, NULL, NULL),
(309, 'appr+statchk2', 'appr+statchk2', 160, 24, '2020-08-22 12:01:12', 0, 1, 34, '2021-01-01', 160, '2020-08-22 17:31:12', '', NULL, NULL, NULL),
(310, 'status+approvecheck101', 'status+approvecheck101', 160, 24, '2020-08-22 12:09:24', 0, 1, 34, '2021-01-01', 160, '2020-08-22 17:39:24', '', NULL, NULL, NULL),
(311, 'rk1', 'rk1', 160, 24, '2020-08-22 12:13:13', 0, 1, 34, '2021-01-01', 160, '2020-08-22 17:43:13', '', NULL, NULL, NULL),
(312, 'rk1', 'rk1', 160, 24, '2020-08-22 12:14:14', 0, 1, 34, '2021-01-01', 160, '2020-08-22 17:44:14', '', NULL, NULL, NULL),
(313, 'rk1', 'rk1', 160, 24, '2020-08-22 12:19:44', 0, 1, 34, '2021-01-01', 160, '2020-08-22 17:49:44', '', NULL, NULL, NULL),
(314, 'rk1', 'rk1', 160, 24, '2020-08-22 12:21:06', 0, 1, 34, '2021-01-01', 160, '2020-08-22 17:51:06', '', NULL, NULL, NULL),
(315, 'rk1', 'rk1', 160, 24, '2020-08-22 12:24:07', 0, 1, 34, '2021-01-01', 160, '2020-08-22 17:54:07', '', NULL, NULL, NULL),
(316, 'rk1', 'rk1', 160, 24, '2020-08-22 12:25:23', 0, 1, 34, '2021-01-01', 160, '2020-08-22 17:55:23', '', NULL, NULL, NULL),
(317, 'rk1', 'rk1', 160, 24, '2020-08-22 15:20:02', 0, 1, 34, '2021-01-01', 160, '2020-08-22 20:50:02', '', NULL, NULL, NULL),
(318, 'rk1', 'rk1', 160, 24, '2020-08-22 15:21:36', 0, 1, 34, '2021-01-01', 160, '2020-08-22 20:51:36', '', NULL, NULL, NULL),
(319, 'rk1', 'rk1', 160, 24, '2020-08-22 15:26:27', 0, 1, 34, '2021-01-01', 160, '2020-08-22 20:56:27', '', NULL, NULL, NULL),
(320, 'rk1', 'rk1', 160, 24, '2020-08-22 15:28:43', 0, 1, 34, '2021-01-01', 160, '2020-08-22 20:58:43', '', NULL, NULL, NULL),
(321, 'rk1', 'rk1', 160, 24, '2020-08-22 15:28:46', 0, 1, 34, '2021-01-01', 160, '2020-08-22 20:58:46', '', NULL, NULL, NULL),
(322, 'rk1', 'rk1', 160, 24, '2020-08-22 15:29:19', 0, 1, 34, '2021-01-01', 160, '2020-08-22 20:59:19', '', NULL, NULL, NULL),
(323, 'rk1', 'rk1', 160, 24, '2020-08-22 15:31:26', 0, 1, 34, '2021-01-01', 160, '2020-08-22 21:01:26', '', NULL, NULL, NULL),
(324, 'rk1', 'rk1', 160, 24, '2020-08-22 15:31:44', 0, 1, 34, '2021-01-01', 160, '2020-08-22 21:01:44', '', NULL, NULL, NULL),
(325, 'rk1', 'rk1', 160, 24, '2020-08-22 15:40:46', 0, 1, 34, '2021-01-01', 160, '2020-08-22 21:10:46', '', NULL, NULL, NULL),
(326, 'rk2', 'rk2', 160, 24, '2020-08-22 15:44:46', 0, 1, 34, '2021-01-01', 160, '2020-08-22 21:14:46', '', NULL, NULL, NULL),
(327, 'rk3', 'rk3', 160, 26, '2020-08-22 15:47:26', 0, NULL, 34, '2021-01-01', 160, '2020-08-22 21:17:26', '', NULL, NULL, NULL),
(328, 'rk4', 'rk4', 160, 26, '2020-08-22 15:49:52', 0, NULL, 34, '2021-01-01', 160, '2020-08-22 21:19:52', '', NULL, NULL, NULL),
(329, 'rk5', 'rk5', 160, 26, '2020-08-22 15:52:49', 0, NULL, 34, '2021-01-01', 160, '2020-08-22 21:22:49', '', NULL, NULL, NULL),
(330, 'rk6', 'rk6', 160, 26, '2020-08-22 15:55:29', 0, NULL, 34, '2021-01-01', 160, '2020-08-22 21:25:29', '', NULL, NULL, NULL),
(331, 'rk7', 'rk7', 160, 26, '2020-08-22 15:58:04', 0, 1, 34, '2021-01-01', 160, '2020-08-22 21:28:04', '', NULL, NULL, NULL),
(332, 'rk8', 'rk8', 160, 26, '2020-08-22 15:59:19', 0, 1, 34, '2021-01-01', 160, '2020-08-22 21:29:19', '', NULL, NULL, NULL),
(333, 'rk9', 'rk9', 160, 24, '2020-08-22 16:00:46', 0, 1, 34, '2021-01-01', 160, '2020-08-22 21:30:46', '', NULL, NULL, NULL),
(334, 'rk5', 'rk5', 160, 24, '2020-08-23 00:39:36', 0, 1, 34, '2021-01-01', 160, '2020-08-23 06:09:36', '', NULL, NULL, NULL),
(335, 'rk6', 'rk6', 160, 24, '2020-08-23 00:42:36', 0, 1, 34, '2021-01-01', 160, '2020-08-23 06:12:36', '', NULL, NULL, NULL),
(337, 'rk10', 'rk10', 160, 26, '2020-08-23 05:51:47', 0, 1, 34, '2021-01-01', 160, '2020-08-23 11:21:47', '', NULL, NULL, NULL),
(338, 'rk11', 'rk11', 160, 24, '2020-08-23 05:52:23', 0, 1, 34, '2021-01-01', 160, '2020-08-23 11:22:23', '', NULL, NULL, NULL),
(339, 'rk11', 'rk11', 160, 24, '2020-08-23 05:53:07', 0, 1, 34, '2021-01-01', 160, '2020-08-23 11:23:07', '', NULL, NULL, NULL),
(340, 'rk12', 'rk12', 160, 24, '2020-08-23 05:54:01', 0, 1, 34, '2021-01-01', 160, '2020-08-23 11:24:01', '', NULL, NULL, NULL),
(341, 'PHP- Javascript', 'PHP- Javascript', 169, 26, '2020-08-23 10:03:47', 0, 2, 34, '2022-02-01', 169, '2020-08-23 15:33:47', '', '0000-00-00', NULL, NULL),
(342, 'rk12', 'rk12', 160, 24, '2020-08-23 16:21:38', 0, 1, 34, '2021-01-01', 160, '2020-08-23 21:51:38', '', NULL, NULL, NULL),
(343, 'rk16', 'rk16', 160, 24, '2020-08-23 16:23:12', 0, 1, 34, '2021-01-01', 160, '2020-08-23 21:53:12', '', NULL, NULL, NULL),
(344, 'ram', 'ram', 160, 26, '2020-08-27 13:55:08', 0, 1, 34, '2021-01-01', 160, '2020-08-27 19:25:08', '', NULL, NULL, NULL),
(345, 'php task subtaask', 'php task subtaask', 172, 24, '2020-08-28 05:44:38', 0, 1, 34, '2021-01-31', 169, '2020-08-28 11:14:38', '', '0000-00-00', NULL, NULL),
(346, 'PHP Lvl3 stask', 'PHP Lvl3 stask', 345, 26, '2020-08-28 05:50:35', 0, 1, 34, '2021-01-31', 169, '2020-08-28 11:20:35', '', NULL, NULL, NULL),
(347, 'PHP insert test', 'PHP insert test', 172, 26, '2020-08-28 05:54:29', 0, 1, 34, '2022-02-01', 169, '2020-08-28 11:24:29', '', NULL, NULL, NULL),
(354, 'PHP subtask102', 'PHP subtask102', 169, 26, '2020-08-29 01:57:46', 0, 1, 34, '2022-02-01', 169, '2020-08-29 07:27:46', '', NULL, NULL, NULL),
(359, 'subtask of mani-main taks owned by bheem', 'subtask of mani-main taks owned by bheem', 267, 27, '2020-09-03 14:43:17', 0, 1, 34, '2021-01-01', 160, '2020-09-03 20:13:17', '', NULL, NULL, '2020-09-03 20:13:17'),
(360, 'stask', 'stask', 262, 24, '2020-09-04 01:51:16', 0, 1, 34, '2021-01-01', 160, '2020-09-04 07:21:16', '', NULL, NULL, '2020-09-04 07:21:16'),
(361, 'stask', 'stask', 359, 27, '2020-09-04 01:55:29', 0, 1, 34, '2021-01-01', 160, '2020-09-04 07:25:29', '', NULL, NULL, '2020-09-04 07:25:29'),
(362, 'bheem subtask', 'bheem subtask', 361, 27, '2020-09-04 01:56:54', 0, 1, 34, '2021-01-01', 160, '2020-09-04 07:26:54', '', NULL, NULL, '2020-09-04 07:26:54'),
(363, 'subtask of bheem', 'subtask of bheem', 265, 24, '2020-09-04 02:01:20', 0, 1, 34, '2021-01-01', 160, '2020-09-04 07:31:20', '', NULL, NULL, '2020-09-04 07:31:20'),
(364, 'PHP subtask', 'PHP subtask', 346, 26, '2020-09-05 16:36:19', 0, 1, 34, '2021-01-31', 169, '2020-09-05 22:06:19', '', NULL, NULL, NULL),
(365, 'PHP subtask', 'PHP subtask', 364, 26, '2020-09-05 16:37:04', 0, 1, 34, '2021-01-31', 169, '2020-09-05 22:07:04', '', NULL, NULL, NULL),
(366, 'PHP task2', 'PHP task2', 354, 26, '2020-09-09 03:01:37', 0, 1, 34, '2022-02-01', 169, '2020-09-09 08:31:37', '', NULL, NULL, NULL),
(370, 'BRD documentation', 'BRD documentation', 0, 26, '2020-09-09 14:10:24', 0, 1, 36, '2020-10-10', 370, '2020-09-09 19:40:24', '', NULL, NULL, NULL),
(371, 'Project Initiative document', 'Project Initiative document', 370, 24, '2020-09-09 14:21:31', 0, 1, 36, '2020-09-10', 370, '2020-09-09 19:51:31', '', '0000-00-00', '', '2020-09-09 16:21:00'),
(372, 'Document to be reviewed', 'Document to be reviewed', 371, 26, '2020-09-09 15:33:00', 0, 1, 36, '2020-09-10', 370, '2020-09-09 21:03:00', '', NULL, NULL, NULL),
(373, 'PHP App dev', 'PHP App dev', 0, 26, '2020-09-10 10:20:53', 0, 1, 36, '2021-07-31', 370, '2020-09-10 15:50:53', '', NULL, NULL, NULL),
(374, 'PHP Module', 'PHP Module', 373, 26, '2020-09-10 10:31:06', 0, 1, 36, '2021-07-31', 373, '2020-09-10 16:01:06', '', NULL, NULL, NULL),
(375, 'Subtask Lvl17', 'Subtask Lvl17', 189, 26, '2020-09-11 06:47:44', 0, 1, 34, '2021-01-01', 160, '2020-09-11 12:17:44', '', NULL, NULL, NULL),
(376, 'Subtask Lvl18', 'Subtask Lvl18', 375, 26, '2020-09-11 06:48:16', 0, 1, 34, '2021-01-01', 160, '2020-09-11 12:18:16', '', NULL, NULL, NULL),
(377, 'Subtask Lvl19', 'Subtask Lvl19', 376, 26, '2020-09-11 06:49:03', 0, 1, 34, '2021-01-01', 160, '2020-09-11 12:19:03', '', NULL, NULL, NULL),
(378, 'Subtask Lvl20', 'Subtask Lvl20', 377, 26, '2020-09-11 06:49:36', 0, 1, 34, '2021-01-01', 160, '2020-09-11 12:19:36', '', NULL, NULL, NULL),
(379, 'Subtask Lvl21', 'Subtask Lvl21', 378, 26, '2020-09-11 06:50:05', 0, 1, 34, '2021-01-01', 160, '2020-09-11 12:20:05', '', NULL, NULL, NULL),
(380, 'Subtask Lvl21', 'Subtask Lvl20', 379, 26, '2020-09-11 06:58:08', 0, 1, 34, '2021-01-01', 160, '2020-09-11 12:28:08', '', NULL, NULL, NULL),
(381, 'Subtask Lvl23', 'Subtask Lvl23', 380, 26, '2020-09-11 06:58:50', 0, 1, 34, '2021-01-01', 160, '2020-09-11 12:28:50', '', NULL, NULL, NULL),
(382, 'subtask', 'subtask', 381, 26, '2020-09-11 10:13:06', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:43:06', '', NULL, NULL, NULL),
(383, 'subtask', 'subtask', 382, 26, '2020-09-11 10:13:40', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:43:40', '', NULL, NULL, NULL),
(384, 'subtask', 'subtask', 383, 26, '2020-09-11 10:14:13', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:44:13', '', NULL, NULL, NULL),
(385, 'subtask', 'subtask', 384, 26, '2020-09-11 10:14:45', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:44:45', '', NULL, NULL, NULL),
(386, 'subtask', 'subtask', 385, 26, '2020-09-11 10:15:22', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:45:22', '', NULL, NULL, NULL),
(387, 'subtask', 'subtask', 386, 26, '2020-09-11 10:15:57', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:45:57', '', NULL, NULL, NULL),
(388, 'subtask', 'subtask', 387, 26, '2020-09-11 10:16:31', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:46:31', '', NULL, NULL, NULL),
(389, 'subtask', 'subtask', 388, 26, '2020-09-11 10:17:06', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:47:06', '', NULL, NULL, NULL),
(390, 'subtask', 'subtask', 389, 26, '2020-09-11 10:17:34', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:47:34', '', NULL, NULL, NULL),
(391, 'subtask', 'subtask', 390, 26, '2020-09-11 10:18:09', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:48:09', '', NULL, NULL, NULL),
(392, 'subtask', 'subtask', 391, 26, '2020-09-11 10:18:34', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:48:34', '', NULL, NULL, NULL),
(393, 'subtask', 'subtask', 392, 26, '2020-09-11 10:19:18', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:49:18', '', NULL, NULL, NULL),
(394, 'subtask', 'subtask', 393, 26, '2020-09-11 10:20:44', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:50:44', '', NULL, NULL, NULL),
(395, 'subtask', 'subtask', 394, 26, '2020-09-11 10:21:27', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:51:27', '', NULL, NULL, NULL),
(396, 'subtask', 'subtask', 395, 26, '2020-09-11 10:21:57', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:51:57', '', NULL, NULL, NULL),
(397, 'subtask', 'subtask', 396, 26, '2020-09-11 10:22:25', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:52:25', '', NULL, NULL, NULL),
(398, 'subtask', 'subtask', 397, 26, '2020-09-11 10:23:04', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:53:04', '', NULL, NULL, NULL),
(399, 'subtask', 'subtask', 398, 26, '2020-09-11 10:23:45', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:53:45', '', NULL, NULL, NULL),
(400, 'subtask', 'subtask', 399, 24, '2020-09-11 10:24:16', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:54:16', '', '0000-00-00', 'Will be delivered before the deadline date', '2020-09-11 16:18:00'),
(401, 'subtask', 'subtask', 400, 26, '2020-09-11 10:24:52', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:54:52', '', NULL, NULL, NULL),
(402, 'subtask', 'subtask', 401, 26, '2020-09-11 10:25:21', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:55:21', '', NULL, NULL, NULL),
(403, 'subtask', 'subtask', 402, 26, '2020-09-11 10:25:59', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:55:59', '', NULL, NULL, NULL),
(404, 'subtask', 'subtask', 403, 26, '2020-09-11 10:26:42', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:56:42', '', NULL, NULL, NULL),
(405, 'subtask', 'subtask', 404, 26, '2020-09-11 10:27:17', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:57:17', '', NULL, NULL, NULL),
(406, 'subtask', 'subtask', 405, 26, '2020-09-11 10:27:42', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:57:42', '', NULL, NULL, NULL),
(407, 'subtask', 'subtask', 406, 26, '2020-09-11 10:28:24', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:58:24', '', NULL, NULL, NULL),
(408, 'subtask', 'subtask', 407, 26, '2020-09-11 10:29:16', 0, 1, 34, '2021-01-01', 160, '2020-09-11 15:59:16', '', NULL, NULL, NULL),
(409, 'subtask', 'subtask', 408, 26, '2020-09-11 10:30:08', 0, 1, 34, '2021-01-01', 160, '2020-09-11 16:00:08', '', NULL, NULL, NULL),
(410, 'Mani subtask', 'Mani subtask', 399, 24, '2020-09-11 14:19:14', 0, 1, 34, '2021-01-01', 160, '2020-09-11 19:49:14', '', NULL, NULL, NULL),
(411, 'Mani\'s task', 'Mani\'s task', 399, 24, '2020-09-11 14:22:04', 0, 1, 34, '2021-01-01', 160, '2020-09-11 19:52:04', '', NULL, NULL, NULL),
(412, 'Mani\'s subtask', 'Mani\'s subtask', 163, 24, '2020-09-11 14:55:04', 0, 1, 34, '2021-01-01', 160, '2020-09-11 20:25:04', '', NULL, NULL, NULL),
(413, 'check css var', 'check css var', 160, 26, '2020-09-13 06:35:52', 0, 1, 34, '2021-01-01', 160, '2020-09-13 12:05:52', '', NULL, NULL, NULL),
(414, 'check css var', 'check css var', 160, 24, '2020-09-13 06:37:00', 1, NULL, 34, '2021-01-01', 160, '2020-09-13 12:07:00', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tasks_hierarch_view`
-- (See below for the actual view)
--
CREATE TABLE `tasks_hierarch_view` (
`lvl` int(1)
,`id` int(11)
,`task_name` varchar(255)
,`task_body` mediumtext
,`assignee` varchar(25)
,`parent_task_id` int(11)
,`due_date` varchar(40)
,`created_on` timestamp
,`approved` int(11)
,`status` int(11)
,`project_id` int(11)
,`group_id` bigint(12)
,`username` varchar(25)
,`last_loggedin` datetime
,`state` varchar(3)
,`Alert` varchar(1)
,`latest_update` mediumtext
,`latestupd_datetime` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Firstname` varchar(250) NOT NULL,
  `Lastname` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Register_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_loggedin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Username`, `Password`, `Firstname`, `Lastname`, `Email`, `Register_date`, `last_loggedin`) VALUES
(24, 'mani', '$2y$12$UsknknbGP2qI7HdjVO/YXus047O.bvFCq3h/uWU6L9kcS8LWj8H/i', 'mani', 'mani', 'main', '2020-04-14 08:03:07', '2020-09-15 20:52:23'),
(25, 'beem', '$2y$12$1r4A2cb2YbnRc3hhNBhsOu8gHFii.EgCIdz4C64fTKx3Q9JAOtCoi', 'beem', 'beem', 'beem', '2020-04-21 12:50:39', '0000-00-00 00:00:00'),
(26, 'Ramkumar', '$2y$12$CdDT21FyZTxnPJmUJZr8uOnTnO6i82uckmlur9LYwBfXDlPh2tg3K', 'Ramkumar', 'jay', 'oshokumarj@gmail.com', '2020-08-06 09:34:58', '2020-09-14 18:38:52'),
(27, 'bheem', '$2y$12$8RmvrDEKiwBKejvAW8h3Ceh/rRfpWXahWPNqsp6mkkfJwuA0fD3F.', 'bheem', 'bheem', 'bheem@gmail.com', '2020-09-03 14:29:04', '2020-09-04 07:38:13');

-- --------------------------------------------------------

--
-- Structure for view `tasks_hierarch_view`
--
DROP TABLE IF EXISTS `tasks_hierarch_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tasks_hierarch_view`  AS  with recursive task_main as (select 1 AS `lvl`,`tasks`.`id` AS `id`,`tasks`.`task_name` AS `task_name`,`tasks`.`task_body` AS `task_body`,`Username` AS `assignee`,`tasks`.`parent_task_id` AS `parent_task_id`,`tasks`.`due_date` AS `due_date`,`tasks`.`date_created` AS `created_on`,`tasks`.`approved` AS `approved`,`tasks`.`status` AS `status`,`tasks`.`project_id` AS `project_id`,`tasks`.`id` + 0 AS `group_id`,`tasks`.`latest_update` AS `latest_update`,`tasks`.`latestupd_datetime` AS `latestupd_datetime` from (`tasks` join `users`) where `tasks`.`parent_task_id` = 0 and `tasks`.`userid` = `id` union all select `p`.`lvl` + 1 AS `lvl+1`,`st`.`id` AS `id`,`st`.`task_name` AS `task_name`,`st`.`task_body` AS `task_body`,`u`.`Username` AS `assignee`,`st`.`parent_task_id` AS `parent_task_id`,`st`.`due_date` AS `due_date`,`st`.`date_created` AS `created_on`,`st`.`approved` AS `approved`,`st`.`status` AS `status`,`st`.`project_id` AS `project_id`,`p`.`group_id` AS `group_id`,`st`.`latest_update` AS `latest_update`,`st`.`latestupd_datetime` AS `latestupd_datetime` from ((`tasks` `st` join `users` `u`) join `task_main` `p`) where `st`.`parent_task_id` = `p`.`id` and `u`.`id` = `st`.`userid`)select `task_main`.`lvl` AS `lvl`,`task_main`.`id` AS `id`,`task_main`.`task_name` AS `task_name`,`task_main`.`task_body` AS `task_body`,`task_main`.`assignee` AS `assignee`,`task_main`.`parent_task_id` AS `parent_task_id`,date_format(`task_main`.`due_date`,'%d-%b-%Y') AS `due_date`,`task_main`.`created_on` AS `created_on`,`task_main`.`approved` AS `approved`,`task_main`.`status` AS `status`,`task_main`.`project_id` AS `project_id`,`task_main`.`group_id` AS `group_id`,`Username` AS `username`,`last_loggedin` AS `last_loggedin`,if(`last_loggedin` < `task_main`.`created_on`,'new','') AS `state`,if(to_days(`task_main`.`due_date`) - to_days(date_format(current_timestamp(),'%Y-%m-%d')) <= 0,'Y','N') AS `Alert`,`task_main`.`latest_update` AS `latest_update`,`task_main`.`latestupd_datetime` AS `latestupd_datetime` from (`task_main` join `users`) order by `task_main`.`group_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fk_parent_task_id` (`parent_task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=415;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
