-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2020 at 07:13 AM
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
--
-- Database: `users`
--

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

-- --------------------------------------------------------

--
-- Structure for view `tasks_hierarch_view`
--
DROP TABLE IF EXISTS `tasks_hierarch_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tasks_hierarch_view`  AS  with recursive task_main as (select 1 AS `lvl`,`tasks`.`id` AS `id`,`tasks`.`task_name` AS `task_name`,`tasks`.`task_body` AS `task_body`,`Username` AS `assignee`,`tasks`.`parent_task_id` AS `parent_task_id`,`tasks`.`due_date` AS `due_date`,`tasks`.`date_created` AS `created_on`,`tasks`.`approved` AS `approved`,`tasks`.`status` AS `status`,`tasks`.`project_id` AS `project_id`,`tasks`.`id` + 0 AS `group_id`,`tasks`.`latest_update` AS `latest_update`,`tasks`.`latestupd_datetime` AS `latestupd_datetime` from (`tasks` join `users`) where `tasks`.`parent_task_id` = 0 and `tasks`.`userid` = `id` union all select `p`.`lvl` + 1 AS `lvl+1`,`st`.`id` AS `id`,`st`.`task_name` AS `task_name`,`st`.`task_body` AS `task_body`,`u`.`Username` AS `assignee`,`st`.`parent_task_id` AS `parent_task_id`,`st`.`due_date` AS `due_date`,`st`.`date_created` AS `created_on`,`st`.`approved` AS `approved`,`st`.`status` AS `status`,`st`.`project_id` AS `project_id`,`p`.`group_id` AS `group_id`,`st`.`latest_update` AS `latest_update`,`st`.`latestupd_datetime` AS `latestupd_datetime` from ((`tasks` `st` join `users` `u`) join `task_main` `p`) where `st`.`parent_task_id` = `p`.`id` and `u`.`id` = `st`.`userid`)select `task_main`.`lvl` AS `lvl`,`task_main`.`id` AS `id`,`task_main`.`task_name` AS `task_name`,`task_main`.`task_body` AS `task_body`,`task_main`.`assignee` AS `assignee`,`task_main`.`parent_task_id` AS `parent_task_id`,date_format(`task_main`.`due_date`,'%d-%b-%Y') AS `due_date`,`task_main`.`created_on` AS `created_on`,`task_main`.`approved` AS `approved`,`task_main`.`status` AS `status`,`task_main`.`project_id` AS `project_id`,`task_main`.`group_id` AS `group_id`,`Username` AS `username`,`last_loggedin` AS `last_loggedin`,if(`last_loggedin` < `task_main`.`created_on`,'new','') AS `state`,`task_main`.`latest_update` AS `latest_update`,`task_main`.`latestupd_datetime` AS `latestupd_datetime` from (`task_main` join `users`) order by `task_main`.`group_id` ;

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
