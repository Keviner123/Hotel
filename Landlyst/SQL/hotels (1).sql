-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2020 at 07:29 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotels`
--

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RoomNumber` int(11) NOT NULL,
  `RoomName` varchar(255) NOT NULL,
  `Rate` decimal(10,0) NOT NULL,
  `MaxGuests` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RoomNumber`, `RoomName`, `Rate`, `MaxGuests`) VALUES
(1, 'King Suite', '625', 2),
(2, 'Queen Suite', '625', 2),
(3, 'Winner Suite', '625', 1),
(4, 'Budget Suite', '625', 1),
(5, 'Blackjack Suite', '625', 1),
(6, 'Couple Suite', '625', 2),
(7, 'Gaming Suite', '625', 5),
(8, 'Party Suite', '625', 5),
(9, 'Secure Suite', '625', 1),
(10, 'Small Suite', '625', 1),
(11, 'Highroller Suite', '625', 1),
(12, 'Jackpot Suite', '625', 1),
(13, 'Bringurchildren Suite', '625', 3),
(14, 'Minibar Suite', '625', 1),
(15, 'Easyaccess Suite', '625', 2);

-- --------------------------------------------------------

--
-- Table structure for table `roomattribute`
--

CREATE TABLE `roomattribute` (
  `RoomAttritubeNumber` int(11) NOT NULL,
  `RoomAttributeName` varchar(255) NOT NULL,
  `RoomAttributeRate` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roomattribute`
--

INSERT INTO `roomattribute` (`RoomAttritubeNumber`, `RoomAttributeName`, `RoomAttributeRate`) VALUES
(1, 'Altan', '150'),
(2, 'Dobbeltseng', '200'),
(3, 'Badekar', '50'),
(4, 'Jacuzzi', '175'),
(5, 'Eget køkken', '350');

-- --------------------------------------------------------

--
-- Table structure for table `roomattributes`
--

CREATE TABLE `roomattributes` (
  `RoomNumber` int(11) NOT NULL,
  `RoomAttritubeNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roomattributes`
--

INSERT INTO `roomattributes` (`RoomNumber`, `RoomAttritubeNumber`) VALUES
(1, 1),
(1, 3),
(2, 1),
(3, 4),
(5, 4),
(6, 2),
(6, 3),
(6, 5),
(7, 2),
(8, 1),
(8, 2),
(9, 5),
(11, 2),
(11, 4),
(13, 2),
(14, 5),
(15, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`RoomNumber`);

--
-- Indexes for table `roomattribute`
--
ALTER TABLE `roomattribute`
  ADD PRIMARY KEY (`RoomAttritubeNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roomattribute`
--
ALTER TABLE `roomattribute`
  MODIFY `RoomAttritubeNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
