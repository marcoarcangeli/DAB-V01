-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 17, 2021 alle 09:54
-- Versione del server: 10.4.22-MariaDB
-- Versione PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dadbv01`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `profile_feature_auth`
--

DROP TABLE IF EXISTS `profile_feature_auth`;
CREATE TABLE IF NOT EXISTS `ProfileFeatureAuth` (
  `IdProfileFeatureAuth` int(11) NOT NULL AUTO_INCREMENT,
  `IdProfile` int(11) DEFAULT NULL,
  `IdFeature` int(11) DEFAULT NULL,
  `IdAuthLevel` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdProfileFeatureAuth`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `profile_feature_auth`
--

INSERT INTO `ProfileFeatureAuth` (`IdProfileFeatureAuth`, `IdProfile`, `IdFeature`, `IdAuthLevel`) VALUES
(1, 2, 31, 2),
(2, 2, 32, 2),
(3, 2, 33, 2),
(4, 2, 28, 2),
(5, 1, 31, 4),
(6, 1, 28, 4),
(7, 1, 30, 4),
(8, 1, 29, 4),
(9, 1, 2, 4),
(10, 1, 1, 4),
(11, 1, 3, 4),
(12, 1, 6, 4),
(13, 1, 7, 4),
(14, 1, 9, 4),
(15, 1, 10, 4),
(16, 1, 8, 4),
(17, 1, 12, 4),
(18, 1, 11, 4),
(19, 1, 13, 4),
(20, 1, 14, 4),
(21, 1, 15, 4),
(24, 3, 31, 3),
(25, 3, 28, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `profile_usr`
--

DROP TABLE IF EXISTS `profile_usr`;
CREATE TABLE IF NOT EXISTS `ProfileUsr` (
  `IdProfileUsr` int(11) NOT NULL AUTO_INCREMENT,
  `IdProfile` int(11) DEFAULT NULL,
  `IdUsr` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdProfileUsr`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `profile_usr`
--

INSERT INTO `ProfileUsr` (`IdProfileUsr`, `IdProfile`, `IdUsr`) VALUES
(1, 2, 8),
(2, 1, 1),
(3, 3, 7),
(4, 4, 3),
(5, 5, 1),
(6, 6, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
