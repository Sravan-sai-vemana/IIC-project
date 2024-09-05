-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2023 at 03:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iic`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `email` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(150) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `eventName` varchar(150) NOT NULL,
  `teamName` varchar(150) NOT NULL,
  `position` varchar(30) NOT NULL,
  `amount` int(11) NOT NULL,
  `doc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`email`, `date`, `name`, `branch`, `year`, `eventName`, `teamName`, `position`, `amount`, `doc`) VALUES
('21pa1a6164@vishnu.edu.in', '2023-12-21', 'a', 'AIML', 1, 'd', 'fe', 'w', 55, 'b.v.raju-institute-of-technology-logo.jpg'),
('21pa1a6164@vishnu.edu.in', '2023-12-13', 'drftgyh', 'CSE', 2, 'fgbhnj', 'fgthj', 'fghj', 2500, 'bg4.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `praj`
-- (See below for the actual view)
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `fullName` varchar(150) NOT NULL,
  `email` varchar(30) NOT NULL,
  `departmentname` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`fullName`, `email`, `departmentname`, `password`) VALUES
('SRAVAN SAI VEMANA', '21pa1a6164@vishnu.edu.in', 'AIML', '$2y$10$wS1d1JERgZREcsH./fwYyumXsurMjs7jhS/FY0MPR.AmsqaoFGOg.');

-- --------------------------------------------------------

--
-- Structure for view `praj`
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
