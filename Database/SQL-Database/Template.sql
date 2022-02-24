-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2022 at 11:49 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msa`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `U_ID` bigint(20) UNSIGNED NOT NULL,
  `U_Username` varchar(255) NOT NULL,
  `U_Password` varchar(255) NOT NULL,
  `U_First_Name` varchar(255) NOT NULL,
  `U_Second_Name` varchar(255) NOT NULL,
  `U_Third_Name` varchar(255) NOT NULL,
  `U_Account_Type` varchar(255) NOT NULL,
  `U_Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`U_ID`, `U_Username`, `U_Password`, `U_First_Name`, `U_Second_Name`, `U_Third_Name`, `U_Account_Type`, `U_Status`) VALUES
(1, 'AbdulBasetRS', '123', 'عبدالباسط', 'رضا', 'سيد', 'Employee', 'Active'),
(2, 'HadyMM', '123', 'هادى', 'محمد', 'مرسى', 'User', 'Deactive'),
(3, 'MuhammadMA', '123', 'محمد', 'مسعد', 'العدوى', 'User', 'Active'),
(4, 'UserDemo', '123', 'مستخدم', 'عادى', '', 'User', 'Deactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `U_Username` (`U_Username`),
  ADD UNIQUE KEY `U_ID` (`U_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `U_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
