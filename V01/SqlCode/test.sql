-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Nov 27, 2021 alle 16:03
-- Versione del server: 10.4.19-MariaDB
-- Versione PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dadbv01`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Struttura della tabella `alg`
--

DROP TABLE IF EXISTS `t1`;
CREATE TABLE IF NOT EXISTS `t1` (
  `idT1` int(11) NOT NULL AUTO_INCREMENT,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  PRIMARY KEY (`idT1`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `alg`
--

INSERT INTO `t1` (`idT1`, `nam`, `descr`) VALUES
(1, 'Linear regression', 'Linear regression'),
(2, 'anomalies auto clean', 'alg with compulsory fields'),
(3, 'Clean', 'Clean'),
(4, 'Struct', 'Struct'),
(5, 'Compare Train Test', 'Compare Train Test '),
(6, 'Compare', 'Compare'),
(7, 'Polinomial Regression', NULL),
(8, 'Logistic Regression', 'Logistic Regression');

