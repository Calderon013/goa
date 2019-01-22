-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2019 at 03:34 AM
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
(1, 4, '123.45.67.89', '2019-01-22', 'wtf', 'Intro', 'Submit'),
(2, 4, '123.45.67.89', '2019-01-22', 'wtf', 'Pop Up 1', 'Submit'),
(3, 4, '123.45.67.89', '2019-01-22', 'wtf', 'Pop Up 2', 'Submit'),
(4, 4, '123.45.67.89', '2019-01-22', 'wtf', 'Aha', 'Submit'),
(5, 4, '123.45.67.89', '2019-01-22', 'wtf', 'Onboarding', 'Submit'),
(6, 4, '123.45.67.89', '2019-01-22', 'wtf', 'Explore', 'Submit'),
(7, 4, '123.45.67.89', '2019-01-22', 'wtf', 'Video', 'Submit'),
(8, 4, '123.45.67.89', '2019-01-22', 'wtf', 'Report Video', 'Submit');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `userID` int(10) NOT NULL,
  `onbName` varchar(50) NOT NULL,
  `onbComp` varchar(40) NOT NULL,
  `onbFeat` varchar(40) NOT NULL,
  `onbCrtd` varchar(40) NOT NULL,
  `onbUp` varchar(40) NOT NULL,
  `onbDate` date NOT NULL,
  `onbDays` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`userID`, `onbName`, `onbComp`, `onbFeat`, `onbCrtd`, `onbUp`, `onbDate`, `onbDays`) VALUES
(1, 'Vincent Calderon (calderon.vincent013@gmail.com)', '13%', 'Yes', 'Yes', 'Yes', '2018-12-25', '5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `onboarding_funnel`
--
ALTER TABLE `onboarding_funnel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `onboarding_funnel`
--
ALTER TABLE `onboarding_funnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
