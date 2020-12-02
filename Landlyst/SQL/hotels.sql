-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 02, 2020 at 07:38 AM
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
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `GuestNumber` int(11) NOT NULL,
  `Firstname` varchar(255) DEFAULT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(255) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `Salt` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`GuestNumber`, `Firstname`, `Lastname`, `PhoneNumber`, `Password`, `Salt`, `Email`) VALUES
(98, NULL, NULL, NULL, '0eI9SAUdCg1t.', '0eF8fsI1hi', 'kevin@kevinfrost.dk'),
(99, NULL, NULL, NULL, '17E.n6EQ.UpwE', '17uexBRNX8', 'test@kevinfrost.dk'),
(100, NULL, NULL, NULL, 'N3k.JPriqCUmM', 'N3x7Z0hjF9', 'Donald@trump.dk'),
(101, NULL, NULL, NULL, 'qbvroCz02ZD32', 'qbKWz31LCI', 'Julemanden@nordpolen.dk'),
(102, NULL, NULL, NULL, 'unsjpGWfm89w.', 'unRlqkDYNQ', 'Cabinet.Bgm.Mayeur@brucity.be'),
(103, NULL, NULL, NULL, 'MWx0PVu3dv6io', 'MWkrQ5ZYJv', ''),
(104, NULL, NULL, NULL, 'pg8VmwdvOvXDs', 'pgGOZLNo1B', '⊂(◉‿◉)つ'),
(105, NULL, NULL, NULL, 'VM.dIR4aD5Q2M', 'VM4DlmePsC', '(•_•) ( •_•)>⌐■-■ (⌐■_■)'),
(106, NULL, NULL, NULL, '', '', ''),
(107, NULL, NULL, NULL, '', '', ''),
(108, NULL, NULL, NULL, 'JtFj5blAb1bCQ', 'JtucB2Mi3x', 'undefined'),
(109, NULL, NULL, NULL, 'RWppIbqDkMdUM', 'RWUb5pSMcT', 'hemmelige@xn--lrke-voa.dk');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `HotelNumber` int(11) NOT NULL,
  `HotelName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Website` varchar(255) NOT NULL,
  `PhoneNumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`HotelNumber`, `HotelName`, `Address`, `Website`, `PhoneNumber`) VALUES
(1, '', 'Melbyvej 55-53, 5471 Søndersø', 'Landlysthotel.dk', '88888888');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `ReservationNumber` int(11) NOT NULL,
  `HotelNumber` int(11) NOT NULL,
  `GuestNumber` int(11) NOT NULL,
  `ArrivalDate` date NOT NULL,
  `DepatureDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`ReservationNumber`, `HotelNumber`, `GuestNumber`, `ArrivalDate`, `DepatureDate`) VALUES
(341, 1, 98, '2020-11-10', '2020-11-11'),
(342, 1, 98, '2020-11-10', '2020-11-11'),
(343, 1, 98, '2020-11-10', '2020-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `reservationroomlines`
--

CREATE TABLE `reservationroomlines` (
  `ReservationRoomLineNumber` int(11) NOT NULL,
  `RoomNumber` int(11) NOT NULL,
  `ReservationNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservationroomlines`
--

INSERT INTO `reservationroomlines` (`ReservationRoomLineNumber`, `RoomNumber`, `ReservationNumber`) VALUES
(42, 1, 341),
(43, 2, 341),
(44, 3, 341),
(45, 4, 341),
(46, 5, 341),
(47, 19, 342),
(48, 18, 342),
(49, 24, 342),
(50, 23, 342),
(51, 17, 342),
(52, 5, 342),
(53, 4, 342),
(54, 5, 343),
(55, 4, 343),
(56, 3, 343),
(57, 9, 343),
(58, 8, 343),
(59, 2, 343),
(60, 7, 343),
(61, 6, 343),
(62, 1, 343),
(63, 10, 343),
(64, 11, 343),
(65, 12, 343),
(66, 13, 343),
(67, 14, 343),
(68, 15, 343),
(69, 20, 343),
(70, 19, 343),
(71, 18, 343),
(72, 17, 343),
(73, 16, 343),
(74, 21, 343),
(75, 22, 343),
(76, 23, 343),
(77, 24, 343),
(78, 25, 343),
(79, 30, 343),
(80, 29, 343);

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
(1, 'King Suite', '695', 2),
(2, 'Queen Suite', '695', 2),
(3, 'Winner Suite', '695', 1),
(4, 'Budget Suite', '695', 1),
(5, 'Blackjack Suite', '695', 1),
(6, 'Couple Suite', '695', 2),
(7, 'Gaming Suite', '695', 5),
(8, 'Party Suite', '695', 5),
(9, 'Secure Suite', '695', 1),
(10, 'Small Suite', '695', 1),
(11, 'Highroller Suite', '695', 1),
(12, 'Jackpot Suite', '695', 1),
(13, 'Bringurchildren Suite', '695', 3),
(14, 'Minibar Suite', '695', 1),
(15, 'Easyaccess Suite', '695', 2),
(16, 'Chef Suite', '695', 1),
(17, 'Loft Suite', '695', 1),
(18, 'Luxury Suite', '695', 2),
(19, 'Comfort Suite', '695', 2),
(20, 'Christian Suite', '695', 2),
(21, 'Noodle Suite', '695', 3),
(22, 'Roulette Suite', '695', 2),
(23, 'Enjoyment Suite', '695', 2),
(24, 'Pool Suite', '695', 2),
(25, 'Biker Suite', '695', 2),
(26, 'Retro Suite', '695', 2),
(27, 'Reasonable Suite', '695', 3),
(28, 'Clinic Suite', '695', 3),
(29, 'Feline Suite', '695', 3),
(30, 'Bunk Suite', '695', 3),
(31, 'Royal Suite', '695', 2),
(32, 'Peasant Suite', '695', 2),
(33, 'Exotic Suite', '695', 2),
(34, 'Flower Suite', '695', 2),
(35, 'Twin Suite', '695', 2),
(36, 'Toddler Suite', '695', 2),
(37, 'Satisfaction Suite', '695', 2),
(38, 'Jackpot Winner Suite', '695', 2),
(39, 'Posh Suite', '695', 2),
(40, 'Exclusive Suite', '695', 2),
(41, 'Family Suite', '695', 2),
(42, 'Pocket Monster Suite', '695', 2),
(43, 'Allyouneed Suite', '695', 2),
(44, 'Cowboy Suite', '695', 2),
(45, 'Luxurious Suite', '695', 2),
(46, 'Two star Suite', '695', 2),
(47, 'Five star Suite', '695', 2),
(48, 'Wife Suite', '695', 2),
(49, '\"Fun\" Suite', '695', 2),
(50, 'Top Suite', '695', 2),
(51, 'Homeless Suite', '695', 2);

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
  `RoomAttribute` int(11) NOT NULL,
  `RoomNumber` int(11) NOT NULL,
  `RoomAttritubeNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roomattributes`
--

INSERT INTO `roomattributes` (`RoomAttribute`, `RoomNumber`, `RoomAttritubeNumber`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 1),
(4, 3, 4),
(5, 5, 4),
(6, 6, 2),
(7, 6, 3),
(8, 6, 5),
(9, 7, 2),
(10, 8, 1),
(11, 8, 2),
(12, 9, 5),
(13, 11, 2),
(14, 11, 4),
(15, 13, 2),
(16, 14, 5),
(17, 15, 2),
(18, 16, 5),
(19, 18, 2),
(20, 19, 2),
(21, 20, 2),
(22, 21, 2),
(23, 21, 5),
(24, 22, 4),
(25, 23, 2),
(26, 24, 4),
(27, 25, 2),
(28, 26, 2),
(29, 27, 2),
(30, 28, 3),
(31, 30, 5),
(32, 31, 2),
(33, 32, 2),
(34, 33, 2),
(35, 33, 4),
(36, 34, 2),
(37, 35, 2),
(38, 36, 2),
(39, 37, 2),
(40, 38, 2),
(41, 38, 4),
(42, 38, 3),
(43, 39, 2),
(44, 40, 2),
(45, 40, 5),
(46, 41, 2),
(47, 42, 2),
(48, 43, 2),
(49, 44, 2),
(51, 45, 2),
(53, 46, 2),
(54, 46, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`GuestNumber`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ReservationNumber`);

--
-- Indexes for table `reservationroomlines`
--
ALTER TABLE `reservationroomlines`
  ADD PRIMARY KEY (`ReservationRoomLineNumber`);

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
-- Indexes for table `roomattributes`
--
ALTER TABLE `roomattributes`
  ADD PRIMARY KEY (`RoomAttribute`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `GuestNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ReservationNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344;

--
-- AUTO_INCREMENT for table `reservationroomlines`
--
ALTER TABLE `reservationroomlines`
  MODIFY `ReservationRoomLineNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `roomattribute`
--
ALTER TABLE `roomattribute`
  MODIFY `RoomAttritubeNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roomattributes`
--
ALTER TABLE `roomattributes`
  MODIFY `RoomAttribute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
