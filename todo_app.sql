-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2023 at 05:00 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `todo_table`
--

CREATE TABLE `todo_table` (
  `id` int(11) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `todo_title` varchar(40) NOT NULL,
  `todo_desc` varchar(255) NOT NULL,
  `todo_date` datetime(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000' ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `todo_table`
--

INSERT INTO `todo_table` (`id`, `user_email`, `todo_title`, `todo_desc`, `todo_date`) VALUES
(34, 'rameem2019@gmail.com', 'Class with Fahmida', 'Android class with my best friend Fahmida Yeasmin at 9 pm local time', '2023-04-30 00:00:00.000000'),
(36, 'fahmidaYeasmin@gmail.com', 'Shopping', 'Go shopping at Muktijoddha Market, Mirpur 1', '2023-04-29 00:00:00.000000'),
(37, 'rameem2019@gmail.com', 'Class', 'Tomorrow class at college from 1 pm local time', '2023-04-30 00:00:00.000000'),
(38, 'rameem2019@gmail.com', 'Chill with friends', 'After class ends me and my friends make chill and have fun after long times', '2023-04-30 00:00:00.000000'),
(39, 'fahmidaYeasmin@gmail.com', 'Coding', 'Complete my Tasbih App today with Rameem', '2023-04-30 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int(20) NOT NULL,
  `f_name` varchar(20) NOT NULL,
  `l_name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `record_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `f_name`, `l_name`, `email`, `password`, `record_id`) VALUES
(467610176, 'M Hassan', 'Rameem', 'rameem2019@gmail.com', 'fymhr', 1),
(99086563, 'Fahmida', 'Yeasmin', 'fahmidaYeasmin@gmail.com', '12345', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `todo_table`
--
ALTER TABLE `todo_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`record_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `todo_table`
--
ALTER TABLE `todo_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
