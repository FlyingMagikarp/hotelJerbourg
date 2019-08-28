-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 28. Aug 2019 um 17:45
-- Server-Version: 10.1.37-MariaDB
-- PHP-Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `hotelJerbourg`
--
CREATE DATABASE IF NOT EXISTS `hotelJerbourg` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hotelJerbourg`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `guest`
--

DROP TABLE IF EXISTS `guest`;
CREATE TABLE `guest` (
  `ID` int(11) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
  `ID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `GuestID` int(11) NOT NULL,
  `DateReservation` date NOT NULL,
  `DateStart` int(11) NOT NULL,
  `DateEnd` date NOT NULL,
  `AmountDays` int(11) NOT NULL,
  `Paid` tinyint(1) NOT NULL,
  `Cancelled` tinyint(1) NOT NULL,
  `Active` tinyint(1) NOT NULL,
  `Inactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `ID` int(11) NOT NULL,
  `Number` int(11) NOT NULL,
  `Class` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `room`
--

INSERT INTO `room` (`ID`, `Number`, `Class`, `Price`) VALUES
(2, 1, 1, 50),
(5, 2, 1, 50),
(6, 3, 1, 50),
(7, 4, 1, 50),
(8, 5, 1, 50),
(9, 6, 1, 50),
(10, 7, 1, 50),
(11, 8, 1, 50),
(12, 9, 1, 50),
(13, 10, 1, 50),
(14, 11, 1, 50),
(15, 12, 1, 50),
(16, 13, 1, 50),
(17, 14, 1, 50),
(18, 15, 1, 50),
(19, 16, 1, 50),
(20, 17, 1, 50),
(21, 18, 1, 50),
(22, 19, 1, 50),
(23, 20, 1, 50),
(24, 21, 2, 100),
(25, 22, 2, 100),
(26, 23, 2, 100),
(27, 24, 2, 100),
(28, 25, 2, 100),
(29, 26, 2, 100),
(30, 27, 3, 150),
(31, 28, 3, 150),
(32, 29, 3, 150);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `roomClass`
--

DROP TABLE IF EXISTS `roomClass`;
CREATE TABLE `roomClass` (
  `ID` int(11) NOT NULL,
  `Class` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `roomClass`
--

INSERT INTO `roomClass` (`ID`, `Class`) VALUES
(1, 'Standard'),
(2, 'Premium'),
(3, 'Suite');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `roomClass`
--
ALTER TABLE `roomClass`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `guest`
--
ALTER TABLE `guest`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `reservations`
--
ALTER TABLE `reservations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `room`
--
ALTER TABLE `room`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT für Tabelle `roomClass`
--
ALTER TABLE `roomClass`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
