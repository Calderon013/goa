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
-- Database: `smallbui_theodore`
--

-- --------------------------------------------------------

--
-- Table structure for table `onboarding_funnel`
--

CREATE TABLE `onboarding_funnel` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` longtext NOT NULL,
  `timestamp` longtext NOT NULL,
  `onboarding` longtext NOT NULL,
  `step` longtext NOT NULL,
  `action` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `onboarding_funnel`
--

INSERT INTO `onboarding_funnel` (`id`, `user_id`, `ip_address`, `timestamp`, `onboarding`, `step`, `action`) VALUES
(1, 1, '123.45.67.89', '2019-01-10', 'wtf', 'saha', 'submit'),
(2, 1, '123.45.65.22', '2019-01-10', 'wat', 'onboarding', 'submit'),
(3, 1, '123.4.4.4', '2019-01-10', 'ha', 'onboarding', 'Exit Onboarding');

-- --------------------------------------------------------

--
-- Table structure for table `onboarding_funnel2`
--

CREATE TABLE `onboarding_funnel2` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` longtext NOT NULL,
  `timestamp` longtext NOT NULL,
  `onboarding` longtext NOT NULL,
  `step` longtext NOT NULL,
  `action` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `onboarding_funnel2`
--

INSERT INTO `onboarding_funnel2` (`id`, `user_id`, `ip_address`, `timestamp`, `onboarding`, `step`, `action`) VALUES
(1, 1, '123.45.67.89', '2019-01-10', 'wtf', 'saha\r\n', 'submit');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `onboarding_funnel`
--
ALTER TABLE `onboarding_funnel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onboarding_funnel2`
--
ALTER TABLE `onboarding_funnel2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `onboarding_funnel`
--
ALTER TABLE `onboarding_funnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `onboarding_funnel2`
--
ALTER TABLE `onboarding_funnel2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
