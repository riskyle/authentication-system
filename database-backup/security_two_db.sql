-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 06:36 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `security_two_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `login_time` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attempts`
--

INSERT INTO `attempts` (`id`, `ip_address`, `login_time`) VALUES
(81, '127.0.0.1', 1713684001),
(82, '127.0.0.1', 1713684003),
(83, '127.0.0.1', 1713684005),
(84, '127.0.0.1', 1713684053),
(85, '127.0.0.1', 1713684055),
(86, '127.0.0.1', 1713684057),
(87, '127.0.0.1', 1713684331),
(88, '127.0.0.1', 1713684335),
(89, '127.0.0.1', 1713684344);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `time_in` timestamp NULL DEFAULT NULL,
  `time_out` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `middlename` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `suffix` varchar(45) DEFAULT NULL,
  `sex` varchar(45) DEFAULT NULL,
  `birthdate` varchar(45) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `mobile_number` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `province` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `purok` varchar(45) DEFAULT NULL,
  `barangay` varchar(45) DEFAULT NULL,
  `zipcode` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(10) DEFAULT NULL COMMENT '1 - STUDENT\r\n2 - ADMIN\r\n3 - SUPER ADMIN',
  `is_blocked` int(11) DEFAULT 0 COMMENT '1 - user is blocked\r\n0 - user is not blocked',
  `is_accepted` int(11) DEFAULT 0 COMMENT '1 - user is accepted\r\n0 - user is not accepted',
  `email_verified_at` date DEFAULT NULL,
  `otp` varchar(45) DEFAULT NULL,
  `is_otp_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `suffix`, `sex`, `birthdate`, `age`, `mobile_number`, `country`, `province`, `city`, `purok`, `barangay`, `zipcode`, `username`, `email`, `password`, `role`, `is_blocked`, `is_accepted`, `email_verified_at`, `otp`, `is_otp_verified`) VALUES
(1, 'Christian Kyle', 'Autor', '', '', 'Male', '2003-03-14', '20', '09158585694', 'Phi', 'Agusan Del Norte', 'Cabadbaran City', 'Purok 1', 'Cabeltes', '8601', 'cautor3', 'cautor3@gmail.com', '$2y$10$lp/V8/aZOcYVNzhWvnjVfOfxcdir5DbTiDBmJcJ/UOpHTXMj5ixJC', 3, 0, 1, NULL, NULL, 0),
(2, 'Jee Ann', 'Guinsod', '', '', 'Female', '2003-02-11', '21', '09278366066', 'Philippines', 'Agusan Del Norte', 'Cabadbaran City', 'Purok 1', 'Cabeltes', '8605', 'jeeann.guinsod', 'jeeann.guinsod@csucc.edu.ph', '$2y$10$V4qDAyF60Pc95Aja4aFgfu1I4OdXN3qAc0wrE.rBo8gWA9mt.5oPy', 3, 1, 1, NULL, NULL, 0),
(3, 'Eufee Mae', 'Guinsod', 'Macaputol', '', 'Female', '2005-04-18', '18', '09158585694', 'Philippines', 'Agusan Del Norte', 'Cabadbaran City', 'Purok 1', 'Cabeltes', '8605', 'eufee', 'eufee@gmail.com', '$2y$10$EFZ6yKxhLjtaRePDFtQU0eTP7.W/Te0OcfQGQ1s24q7SRYlALyqd6', 1, 0, 1, NULL, NULL, 0),
(4, 'Jaymar', 'Salas', '', '', 'Male', '2003-03-14', '20', '09158585694', 'Philippines', 'Agusan Del Norte', 'Cabadbaran City', 'Purok 1', 'Cabeltes', '8605', 'jaymar123', 'jaymar.salas@csucc.edu.ph', '$2y$10$4iy/M.jIUX/FD09tcHY3GOrYid1SyzforQImsiiqYjXN7b5PG4hIe', 1, 1, 1, NULL, NULL, 0),
(5, 'Ahrrol', 'Cervantes', 'Dalo', '', 'Male', '2003-03-14', '20', '09158585694', 'Philippines', 'Agusan Del Norte', 'Cabadbaran City', 'Purok 1', 'Cabeltes', '8605', 'ahhrol123', 'ahrrol.cervantes@csucc.edu.ph', '$2y$10$19o8h2orXBNeA/GyLiOVyO5MSx7meefYL19LBL05aSIHHlFRwvaJW', 1, 1, 1, NULL, NULL, 0),
(6, 'Alvin', 'Pendica', 'Andonga', '', 'Male', '2003-03-14', '20', '09158585694', 'Philippines', 'Agusan Del Norte', 'Cabadbaran City', 'Purok 1', 'Cabeltes', '8605', 'alvin123', 'alvin.andonga@csucc.edu.ph', '$2y$10$luYEnA05yAVa5Zw/7CNtJeTZd1uYypCYwJS.pu475tnqz8dYf7/.O', 3, 1, 0, NULL, NULL, 0),
(8, 'Ferdilyn ', 'Macaputol', 'Guinsod', 'Jr.', 'Female', '2006-03-14', '18', '09158585694', 'Philippines', 'Agusan Del Norte', 'Cabadbaran City', 'Purok 1', 'Cabeltes', '8605', 'ferd123', 'ferd@gmail.com', '$2y$10$YS.J0De4iWPxlJXxGx1kNubJyVv1fTig53.3YCdjaf1rvQsvODdh6', 2, 0, 1, NULL, NULL, 0),
(9, 'Joseph ', '', 'Vistal', '', 'Male', '1989-12-13', '34', '09158585694', 'Philippines', 'Agusan Del Norte', 'Cabadbaran City', 'Purok 1', 'Cabeltes', '8605', 'joseph123', 'joseph@gmail.com', '$2y$10$70mXN77l5q2q2jSYFdOGo.bR8MyNibeis6016rJrI5wcqRDJRFbyW', 1, 1, 0, NULL, NULL, 0),
(11, 'Jimin', '', 'Park', '', 'Male', '1995-07-13', '28', '+639158585695', 'Philippines', 'Agusan Del Norte', 'Cabadbaran City', 'Cabiltes', 'Cabeltes', '8605', 'jimin123', 'jimin@gmail.com', '$2y$10$fTICwtT1r6s9KzyjBn8FzumzXBcl.7AdmR8C3c1ObJEzwZ.R0wMpC', 2, 1, 1, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attempts`
--
ALTER TABLE `attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
