-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2019 at 03:20 AM
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
  `registered_from` longtext NOT NULL,
  `date_registered` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_users`
--

INSERT INTO `cs_users` (`user_id`, `user_fname`, `user_lname`, `company`, `email_address`, `preference`, `activity`, `registered_from`, `date_registered`) VALUES
(1, 'Vincent', 'Calderon', 'LOPHILS INC.', 'calderon.vincent013@gmail.com', 'sample preference', 'sample activity', '???', '2019-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `cs_user_activity`
--

CREATE TABLE `cs_user_activity` (
  `user_id` int(11) NOT NULL,
  `activity` longtext NOT NULL,
  `page_name` longtext NOT NULL,
  `log_date` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_user_activity`
--

INSERT INTO `cs_user_activity` (`user_id`, `activity`, `page_name`, `log_date`) VALUES
(1, 'sample activity', 'sample page', '2019-01-10');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
