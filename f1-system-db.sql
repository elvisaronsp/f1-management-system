-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2019 at 07:57 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `f1-system-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `curse`
--

CREATE TABLE `curse` (
  `ID_Cursa` int(11) NOT NULL,
  `locatie` varchar(30) DEFAULT NULL,
  `numar_ture` int(11) NOT NULL,
  `lungime` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `curse`
--

INSERT INTO `curse` (`ID_Cursa`, `locatie`, `numar_ture`, `lungime`) VALUES
(1, 'Monaco', 32, 21.33),
(2, 'Paris', 51, 52.97),
(3, 'Salzburg', 23, 47.21),
(4, 'Bucuresti', 24, 19.53),
(5, 'Tokyo', 89, 102.53);

-- --------------------------------------------------------

--
-- Table structure for table `echipe`
--

CREATE TABLE `echipe` (
  `ID_Echipa` int(11) NOT NULL,
  `nume` varchar(40) NOT NULL,
  `sediu_central` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `echipe`
--

INSERT INTO `echipe` (`ID_Echipa`, `nume`, `sediu_central`) VALUES
(1, 'Mercedes', 'Regie'),
(2, 'BMW', 'Grozavesti'),
(3, 'Ferrari', 'Kogalniceanu'),
(4, 'Renault', 'Titu'),
(5, 'Ford', 'LA');

-- --------------------------------------------------------

--
-- Table structure for table `masini`
--

CREATE TABLE `masini` (
  `Serie_Sasiu` varchar(18) NOT NULL,
  `ID_Pilot` int(11) DEFAULT NULL,
  `numar_masina` int(11) NOT NULL,
  `putere_motor` int(11) NOT NULL,
  `capacitate_motor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `masini`
--

INSERT INTO `masini` (`Serie_Sasiu`, `ID_Pilot`, `numar_masina`, `putere_motor`, `capacitate_motor`) VALUES
('QS2MN', 3, 1, 530, 4.7),
('WF0KK', 1, 69, 270, 3.2),
('YH0KS', 2, 71, 2, 0.9);

-- --------------------------------------------------------

--
-- Table structure for table `piloti`
--

CREATE TABLE `piloti` (
  `ID_Pilot` int(11) NOT NULL,
  `nume` varchar(15) DEFAULT NULL,
  `ID_Echipa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `piloti`
--

INSERT INTO `piloti` (`ID_Pilot`, `nume`, `ID_Echipa`) VALUES
(1, 'Andrei', 1),
(2, 'Marius', 2),
(3, 'Marian', 3),
(5, 'Iulius', 4),
(6, 'Radu', 5);

-- --------------------------------------------------------

--
-- Table structure for table `piloticurseturnee`
--

CREATE TABLE `piloticurseturnee` (
  `ID_Pilot` int(11) DEFAULT NULL,
  `ID_Cursa` int(11) DEFAULT NULL,
  `ID_Turneu` int(11) DEFAULT NULL,
  `timp` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `piloticurseturnee`
--

INSERT INTO `piloticurseturnee` (`ID_Pilot`, `ID_Cursa`, `ID_Turneu`, `timp`) VALUES
(3, 1, 1, 11),
(3, 2, 1, 8),
(3, 3, 1, 3.3),
(1, 1, 1, 41),
(1, 2, 1, 12),
(1, 3, 1, 2.2),
(2, 1, 1, 22),
(2, 2, 1, 10),
(2, 3, 1, 1.1),
(3, 1, 2, NULL),
(3, 2, 2, 7),
(1, 1, 2, NULL),
(1, 2, 2, 12),
(2, 1, 2, NULL),
(2, 2, 2, 151),
(2, 1, 3, 1),
(3, 1, 2, NULL),
(3, 2, 2, NULL),
(3, 5, 2, NULL),
(1, 1, 2, NULL),
(1, 2, 2, NULL),
(1, 5, 2, NULL),
(2, 1, 2, NULL),
(2, 2, 2, NULL),
(2, 5, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `turnee`
--

CREATE TABLE `turnee` (
  `ID_Turneu` int(11) NOT NULL,
  `an` int(11) NOT NULL,
  `denumire` varchar(30) NOT NULL,
  `status` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `turnee`
--

INSERT INTO `turnee` (`ID_Turneu`, `an`, `denumire`, `status`) VALUES
(1, 2019, 'Lisabona', 'Inchis'),
(2, 2003, 'Dublin', 'Deschis'),
(3, 2015, 'Roma', 'Inchis');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(2, 'Ovidiu', 'gheorgheovidu@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `curse`
--
ALTER TABLE `curse`
  ADD PRIMARY KEY (`ID_Cursa`);

--
-- Indexes for table `echipe`
--
ALTER TABLE `echipe`
  ADD PRIMARY KEY (`ID_Echipa`),
  ADD UNIQUE KEY `nume` (`nume`);

--
-- Indexes for table `masini`
--
ALTER TABLE `masini`
  ADD PRIMARY KEY (`Serie_Sasiu`),
  ADD KEY `ID_Pilot` (`ID_Pilot`);

--
-- Indexes for table `piloti`
--
ALTER TABLE `piloti`
  ADD PRIMARY KEY (`ID_Pilot`),
  ADD KEY `ID_Echipa` (`ID_Echipa`);

--
-- Indexes for table `piloticurseturnee`
--
ALTER TABLE `piloticurseturnee`
  ADD KEY `ID_Pilot` (`ID_Pilot`),
  ADD KEY `ID_Cursa` (`ID_Cursa`),
  ADD KEY `ID_Turneu` (`ID_Turneu`);

--
-- Indexes for table `turnee`
--
ALTER TABLE `turnee`
  ADD PRIMARY KEY (`ID_Turneu`),
  ADD UNIQUE KEY `denumire` (`denumire`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `curse`
--
ALTER TABLE `curse`
  MODIFY `ID_Cursa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `echipe`
--
ALTER TABLE `echipe`
  MODIFY `ID_Echipa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `piloti`
--
ALTER TABLE `piloti`
  MODIFY `ID_Pilot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `turnee`
--
ALTER TABLE `turnee`
  MODIFY `ID_Turneu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `masini`
--
ALTER TABLE `masini`
  ADD CONSTRAINT `masini_ibfk_1` FOREIGN KEY (`ID_Pilot`) REFERENCES `piloti` (`ID_Pilot`);

--
-- Constraints for table `piloti`
--
ALTER TABLE `piloti`
  ADD CONSTRAINT `piloti_ibfk_1` FOREIGN KEY (`ID_Echipa`) REFERENCES `echipe` (`ID_Echipa`);

--
-- Constraints for table `piloticurseturnee`
--
ALTER TABLE `piloticurseturnee`
  ADD CONSTRAINT `piloticurseturnee_ibfk_1` FOREIGN KEY (`ID_Pilot`) REFERENCES `piloti` (`ID_Pilot`),
  ADD CONSTRAINT `piloticurseturnee_ibfk_2` FOREIGN KEY (`ID_Cursa`) REFERENCES `curse` (`ID_Cursa`),
  ADD CONSTRAINT `piloticurseturnee_ibfk_3` FOREIGN KEY (`ID_Turneu`) REFERENCES `turnee` (`ID_Turneu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
