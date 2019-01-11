-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2019 at 05:35 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smallbui_cs_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cs_users`
--

CREATE TABLE `cs_users` (
  `user_id` int(11) NOT NULL,
  `user_fname` longtext NOT NULL,
  `user_lname` longtext NOT NULL,
  `company` longtext NOT NULL,
  `email_address` longtext NOT NULL,
  `preference` longtext NOT NULL,
  `activity` longtext NOT NULL,
  `page_name` longtext NOT NULL,
  `registered_from` longtext NOT NULL,
  `date_registered` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_users`
--

INSERT INTO `cs_users` (`user_id`, `user_fname`, `user_lname`, `company`, `email_address`, `preference`, `activity`, `page_name`, `registered_from`, `date_registered`) VALUES
(1, 'Vincent', 'Calderon', 'Lophils Inc.', 'calderon.vincent013@gmail.com', 'none', 'Submit', 'Upgrade to Business\r\n', 'wtf', '2019-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `cs_user_activity`
--

CREATE TABLE `cs_user_activity` (
  `user_id` int(11) NOT NULL,
  `page_name` longtext NOT NULL,
  `activity` longtext NOT NULL,
  `log_date` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_user_activity`
--

INSERT INTO `cs_user_activity` (`user_id`, `page_name`, `activity`, `log_date`) VALUES
(1, 'Upgrade to Business', 'Submit', '2019-01-10'),
(1, 'Dashboard', 'Submit', '2019-01-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cs_users`
--
ALTER TABLE `cs_users`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
