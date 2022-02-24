-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2022 at 02:37 PM
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
-- Table structure for table `shared_warehouse`
--

CREATE TABLE `shared_warehouse` (
  `SW_ID` bigint(20) UNSIGNED NOT NULL,
  `SW_Warehouse_ID` int(11) NOT NULL,
  `SW_Shared_To_User_ID` int(11) NOT NULL,
  `SW_Status` enum('Available','Unavailable') NOT NULL,
  `SW_Created_Date_And_Time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shared_warehouse`
--

INSERT INTO `shared_warehouse` (`SW_ID`, `SW_Warehouse_ID`, `SW_Shared_To_User_ID`, `SW_Status`, `SW_Created_Date_And_Time`) VALUES
(1, 1, 1, 'Available', '2022/01/24 12:56:16 AM'),
(2, 2, 1, 'Available', '2022/01/24 12:56:16 AM');

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
  `U_Status` enum('Active','Deactivate','Suspended','Pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`U_ID`, `U_Username`, `U_Password`, `U_First_Name`, `U_Second_Name`, `U_Third_Name`, `U_Account_Type`, `U_Status`) VALUES
(1, 'AbdulBasetRS', '6116afedcb0bc31083935c1c262ff4c9', 'عبدالباسط', 'رضا', 'سيد', 'Employee', 'Active'),
(2, 'HadyMM', '6116afedcb0bc31083935c1c262ff4c9', 'هادى', 'محمد', 'مرسى', 'User', 'Active'),
(3, 'MuhammadMA', '6116afedcb0bc31083935c1c262ff4c9', 'محمد', 'مسعد', 'العدوى', 'User', 'Suspended'),
(4, 'UserDemo', '6116afedcb0bc31083935c1c262ff4c9', 'مستخدم', 'عادى', '', 'User', 'Deactivate');

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE `user_permission` (
  `U_P_ID` bigint(20) UNSIGNED NOT NULL,
  `U_P_User_ID` int(11) NOT NULL,
  `U_P_Section` varchar(255) NOT NULL,
  `U_P_Status` varchar(255) NOT NULL,
  `U_P_Give_By_User_ID` int(11) NOT NULL,
  `U_P_Give_Date_And_Time` varchar(255) NOT NULL,
  `U_P_Cancellation_By_User_ID` int(11) NOT NULL,
  `U_P_Cancellation_Date_And_Time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_permission`
--

INSERT INTO `user_permission` (`U_P_ID`, `U_P_User_ID`, `U_P_Section`, `U_P_Status`, `U_P_Give_By_User_ID`, `U_P_Give_Date_And_Time`, `U_P_Cancellation_By_User_ID`, `U_P_Cancellation_Date_And_Time`) VALUES
(1, 1, 'Home', '', 1, '2022/01/24 12:56:16 AM', 2, '2022/01/24 12:56:16 AM');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `W_ID` bigint(20) UNSIGNED NOT NULL,
  `W_Owner_User_ID` int(11) NOT NULL,
  `W_Warehouse_Name` varchar(255) NOT NULL,
  `W_Warehouse_Details` text NOT NULL,
  `W_Status` enum('Active','Deactivate','Suspended') NOT NULL,
  `HA_U_Date_And_Time_Created` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`W_ID`, `W_Owner_User_ID`, `W_Warehouse_Name`, `W_Warehouse_Details`, `W_Status`, `HA_U_Date_And_Time_Created`) VALUES
(1, 1, 'محل الرحمن فرع بشتيل', 'يتميز هذا الفرع بالمساحه الواسعه والنتجات المتوافره وتم افتتاح يوم الثلاثاء الموافق 12/12/2021', 'Suspended', '2022/01/24 12:56:16 AM'),
(2, 1, 'محل عسل وطحينه فرع امبابه', 'يتميز هذا الفرع بالمساحه الواسعه والنتجات المتوافره وتم افتتاح يوم الثلاثاء الموافق 12/12/2021', 'Active', '2022/01/24 12:56:16 AM'),
(3, 1, 'محل ملابس', 'يتميز هذا الفرع بالمساحه الواسعه والنتجات المتوافره وتم افتتاح يوم الثلاثاء الموافق 12/12/2021', 'Active', '2022/01/24 12:56:16 AM'),
(4, 1, 'محل كوتشات', 'يتميز هذا الفرع بالمساحه الواسعه والنتجات المتوافره وتم افتتاح يوم الثلاثاء الموافق 12/12/2021', 'Active', '2022/01/24 12:56:16 AM'),
(5, 1, 'محل عصائر الحسينى', 'فرع امبابه شارع الوحده', 'Active', '2022/01/25 08:31:09 AM'),
(6, 1, 'سوبر ماركت الرحمن', 'فرع اكتوبر عند الحصرى', 'Active', '2022/01/25 08:32:35 AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shared_warehouse`
--
ALTER TABLE `shared_warehouse`
  ADD UNIQUE KEY `SW_ID` (`SW_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `U_Username` (`U_Username`),
  ADD UNIQUE KEY `U_ID` (`U_ID`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD UNIQUE KEY `U_P_ID` (`U_P_ID`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD UNIQUE KEY `W_ID` (`W_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shared_warehouse`
--
ALTER TABLE `shared_warehouse`
  MODIFY `SW_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `U_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_permission`
--
ALTER TABLE `user_permission`
  MODIFY `U_P_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `W_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
