-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2020 at 07:46 AM
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
(111, NULL, NULL, NULL, 'X5sAVCECwNoHE', 'X5DdH3G1Ih', 'kevin@kevinfrost.dk'),
(112, NULL, NULL, NULL, 'AxBEkDgmsr8zs', 'AxDgSEZ3J4', 'kevin@kevinfrost.com'),
(113, NULL, NULL, NULL, 'ey3qOZT2/RJxI', 'eyEglnmYxq', 'kevin@kevinfrost.eu'),
(114, NULL, NULL, NULL, '2TmNucYxQLo6g', '2T13f7jRzt', 'kevin@kevinfrost.co.uk');

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
-- Stand-in structure for view `lis`
-- (See below for the actual view)
--
CREATE TABLE `lis` (
`RoomNumber` int(11)
,`RoomName` varchar(255)
,`Rate` decimal(10,0)
,`MaxGuests` int(11)
,`IsClean` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `poul og hans peter`
-- (See below for the actual view)
--
CREATE TABLE `poul og hans peter` (
`RoomName` varchar(255)
,`ArrivalDate` date
,`DepatureDate` date
);

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
(511, 1, 111, '2020-12-08', '2020-12-09'),
(512, 1, 111, '2020-12-10', '2020-12-10'),
(513, 1, 111, '2020-12-10', '2020-12-17'),
(514, 1, 111, '2020-12-24', '2020-12-31'),
(515, 1, 111, '2020-12-10', '2020-12-25'),
(516, 1, 111, '2020-12-17', '2020-12-24'),
(517, 1, 111, '2020-12-10', '2020-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `reservationroomlines`
--

CREATE TABLE `reservationroomlines` (
  `ReservationRoomLineNumber` int(11) NOT NULL,
  `RoomNumber` int(11) NOT NULL,
  `ReservationNumber` int(11) NOT NULL,
  `isCanceled` tinyint(1) NOT NULL DEFAULT '0',
  `CheckoutDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservationroomlines`
--

INSERT INTO `reservationroomlines` (`ReservationRoomLineNumber`, `RoomNumber`, `ReservationNumber`, `isCanceled`, `CheckoutDate`) VALUES
(48, 2, 511, 0, NULL),
(49, 3, 512, 0, NULL),
(50, 6, 513, 0, '2020-12-10'),
(51, 8, 514, 1, NULL),
(52, 27, 515, 0, '2020-12-10'),
(53, 44, 516, 1, NULL),
(54, 1, 517, 0, '2020-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RoomNumber` int(11) NOT NULL,
  `RoomName` varchar(255) NOT NULL,
  `Rate` decimal(10,0) NOT NULL,
  `MaxGuests` int(11) NOT NULL,
  `IsClean` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RoomNumber`, `RoomName`, `Rate`, `MaxGuests`, `IsClean`) VALUES
(1, 'King Suite', '695', 2, 1),
(2, 'Queen Suite', '695', 2, 1),
(3, 'Winner Suite', '695', 1, 1),
(4, 'Budget Suite', '695', 1, 1),
(5, 'Blackjack Suite', '695', 1, 1),
(6, 'Couple Suite', '695', 2, 1),
(7, 'Gaming Suite', '695', 5, 1),
(8, 'Party Suite', '695', 5, 1),
(9, 'Secure Suite', '695', 1, 1),
(10, 'Small Suite', '695', 1, 1),
(11, 'Highroller Suite', '695', 1, 1),
(12, 'Jackpot Suite', '695', 1, 1),
(13, 'Bringurchildren Suite', '695', 3, 1),
(14, 'Minibar Suite', '695', 1, 1),
(15, 'Easyaccess Suite', '695', 2, 1),
(16, 'Chef Suite', '695', 1, 1),
(17, 'Loft Suite', '695', 1, 1),
(18, 'Luxury Suite', '695', 2, 1),
(19, 'Comfort Suite', '695', 2, 1),
(20, 'Christian Suite', '695', 2, 1),
(21, 'Noodle Suite', '695', 3, 1),
(22, 'Roulette Suite', '695', 2, 1),
(23, 'Enjoyment Suite', '695', 2, 1),
(24, 'Pool Suite', '695', 2, 1),
(25, 'Biker Suite', '695', 2, 1),
(26, 'Retro Suite', '695', 2, 1),
(27, 'Reasonable Suite', '695', 3, 1),
(28, 'Clinic Suite', '695', 3, 1),
(29, 'Feline Suite', '695', 3, 1),
(30, 'Bunk Suite', '695', 3, 1),
(31, 'Royal Suite', '695', 2, 1),
(32, 'Peasant Suite', '695', 2, 1),
(33, 'Exotic Suite', '695', 2, 1),
(34, 'Flower Suite', '695', 2, 1),
(35, 'Twin Suite', '695', 2, 1),
(36, 'Toddler Suite', '695', 2, 1),
(37, 'Satisfaction Suite', '695', 2, 1),
(38, 'Jackpot Winner Suite', '695', 2, 1),
(39, 'Posh Suite', '695', 2, 1),
(40, 'Exclusive Suite', '695', 2, 0),
(41, 'Family Suite', '695', 2, 1),
(42, 'Pocket Monster Suite', '695', 2, 1),
(43, 'Allyouneed Suite', '695', 2, 1),
(44, 'Cowboy Suite', '695', 2, 1),
(45, 'Luxurious Suite', '695', 2, 1),
(46, 'Two star Suite', '695', 2, 1),
(47, 'Five star Suite', '695', 2, 1),
(48, 'Wife Suite', '695', 2, 1),
(49, '\"Fun\" Suite', '695', 2, 1),
(50, 'Top Suite', '695', 2, 1),
(51, 'Homeless Suite', '695', 2, 1);

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

-- --------------------------------------------------------

--
-- Structure for view `lis`
--
DROP TABLE IF EXISTS `lis`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lis`  AS  select `room`.`RoomNumber` AS `RoomNumber`,`room`.`RoomName` AS `RoomName`,`room`.`Rate` AS `Rate`,`room`.`MaxGuests` AS `MaxGuests`,`room`.`IsClean` AS `IsClean` from `room` where (`room`.`IsClean` = '0') ;

-- --------------------------------------------------------

--
-- Structure for view `poul og hans peter`
--
DROP TABLE IF EXISTS `poul og hans peter`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `poul og hans peter`  AS  select `r`.`RoomName` AS `RoomName`,`s`.`ArrivalDate` AS `ArrivalDate`,`s`.`DepatureDate` AS `DepatureDate` from ((`reservationroomlines` `e` join `reservation` `s` on((`e`.`ReservationNumber` = `s`.`ReservationNumber`))) join `room` `r` on((`e`.`RoomNumber` = `r`.`RoomNumber`))) order by `s`.`ArrivalDate` ;

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
  MODIFY `GuestNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `ReservationNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=518;

--
-- AUTO_INCREMENT for table `reservationroomlines`
--
ALTER TABLE `reservationroomlines`
  MODIFY `ReservationRoomLineNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `roomattribute`
--
ALTER TABLE `roomattribute`
  MODIFY `RoomAttritubeNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roomattributes`
--
ALTER TABLE `roomattributes`
  MODIFY `RoomAttribute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
