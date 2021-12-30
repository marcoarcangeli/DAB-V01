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


CREATE USER IF NOT EXISTS 'DABUser'@'%' IDENTIFIED VIA mysql_native_password USING '***';GRANT ALL PRIVILEGES ON *.* TO 'DABUser'@'%' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dadbv01`
--
CREATE DATABASE IF NOT EXISTS `dadbv01` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dadbv01`;

-- --------------------------------------------------------

--
-- Struttura della tabella `alg`
--

DROP TABLE IF EXISTS `alg`;
CREATE TABLE IF NOT EXISTS `alg` (
  `idAlg` int(11) NOT NULL AUTO_INCREMENT,
  `idAlgState` int(11) DEFAULT NULL,
  `idAlgCat` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `fileRefProc` varchar(200) DEFAULT NULL,
  `CatTag` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idAlg`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `alg`
--

INSERT INTO `alg` (`idAlg`, `idAlgState`, `idAlgCat`, `nam`, `descr`, `fileRefProc`, `CatTag`) VALUES
(1, 3, 26, 'Linear regression', 'Linear regression', 'regressioneLineare.R', NULL),
(2, 3, 6, 'anomalies auto clean', 'alg with compulsory fields', 'anomaliesAuto.R', 'cleaning, automatic, procedure, R'),
(3, 3, 25, 'Clean', 'Clean', 'clean.R', NULL),
(4, 3, 5, 'Struct', 'Struct', 'analisiStruttura.R', NULL),
(5, 2, 29, 'Compare Train Test', 'Compare Train Test ', 'comparaTrainTest.R', NULL),
(6, 1, 2, 'Compare', 'Compare', NULL, NULL),
(7, 1, 27, 'Polinomial Regression', NULL, NULL, NULL),
(8, 1, 28, 'Logistic Regression', 'Logistic Regression', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `algcat`
--

DROP TABLE IF EXISTS `algcat`;
CREATE TABLE IF NOT EXISTS `algcat` (
  `idAlgCat` int(11) NOT NULL AUTO_INCREMENT,
  `idAlgCatPar` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  PRIMARY KEY (`idAlgCat`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `algcat`
--

INSERT INTO `algcat` (`idAlgCat`, `idAlgCatPar`, `nam`, `descr`) VALUES
(1, NULL, 'System Algs', 'System Algs.\nThis is a System Configuration.\nDO NOT DELETE THIS CATHEGORY'),
(2, NULL, 'DA Algs', 'DA Algs'),
(5, 1, 'Struct', 'Struct.\nDO NOT DELETE.'),
(6, 1, 'Autoclean', 'Autoclean.\nDO NOT DELETE.'),
(7, 2, 'Regression', 'Regression'),
(25, 1, 'Clean', 'Clean.\nDO NOT DELETE.'),
(26, 7, 'Linear Regression', 'Linear Regression'),
(27, 7, 'Polinomial Regression', 'Polinomial Regression'),
(28, 7, 'Logistic Regression', 'Logistic Regression'),
(29, 2, 'Compare', 'Compare');

-- --------------------------------------------------------

--
-- Struttura della tabella `algcntxrnk`
--

DROP TABLE IF EXISTS `algcntxrnk`;
CREATE TABLE IF NOT EXISTS `algcntxrnk` (
  `idAlgCntxRnk` int(11) NOT NULL AUTO_INCREMENT,
  `idAn` int(11) DEFAULT NULL,
  `idDescrCapStat` int(11) DEFAULT NULL,
  `idPredCapStat` int(11) DEFAULT NULL,
  `idExplCapStat` int(11) DEFAULT NULL,
  `idSpaceDAVl` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAlgCntxRnk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `algcntxrnknorm`
--

DROP TABLE IF EXISTS `algcntxrnknorm`;
CREATE TABLE IF NOT EXISTS `algcntxrnknorm` (
  `idAlgCntxRnkNorm` int(11) NOT NULL AUTO_INCREMENT,
  `idAn` int(11) DEFAULT NULL,
  `idDescrCapStat` int(11) DEFAULT NULL,
  `idPredCapStat` int(11) DEFAULT NULL,
  `idExplCapStat` int(11) DEFAULT NULL,
  `idSpaceDAVl` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAlgCntxRnkNorm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `algdavl`
--

DROP TABLE IF EXISTS `algdavl`;
CREATE TABLE IF NOT EXISTS `algdavl` (
  `idAlgDAVl` int(11) NOT NULL AUTO_INCREMENT,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `ordine` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAlgDAVl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `algparam`
--

DROP TABLE IF EXISTS `algparam`;
CREATE TABLE IF NOT EXISTS `algparam` (
  `idAlgParam` int(11) NOT NULL AUTO_INCREMENT,
  `idAlgParamType` int(11) DEFAULT NULL,
  `idAlg` int(11) DEFAULT NULL,
  `vl` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idAlgParam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `algparamtest`
--

DROP TABLE IF EXISTS `algparamtest`;
CREATE TABLE IF NOT EXISTS `algparamtest` (
  `idAlgParamtest` int(11) NOT NULL AUTO_INCREMENT,
  `idAlgParam` int(11) DEFAULT NULL,
  `idTrain` int(11) DEFAULT NULL,
  `idAlgParamType` int(11) DEFAULT NULL,
  `vl` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idAlgParamtest`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `algparamtype`
--

DROP TABLE IF EXISTS `algparamtype`;
CREATE TABLE IF NOT EXISTS `algparamtype` (
  `IdAlgParamType` int(11) NOT NULL AUTO_INCREMENT,
  `IdParamType` int(11) DEFAULT NULL,
  `idAlg` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `vlDefault` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IdAlgParamType`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `algparamtype`
--

INSERT INTO `algparamtype` (`IdAlgParamType`, `IdParamType`, `idAlg`, `nam`, `descr`, `vlDefault`) VALUES
(1, NULL, NULL, 'test1', NULL, NULL),
(2, NULL, NULL, 'test2', NULL, NULL),
(3, NULL, NULL, 'test3', NULL, NULL),
(4, NULL, NULL, 'test4', NULL, NULL),
(5, NULL, NULL, 'test5', NULL, NULL),
(6, NULL, NULL, 'test6', NULL, NULL),
(7, NULL, NULL, 'test7', NULL, NULL),
(8, NULL, NULL, 'test8', NULL, NULL),
(9, 2, NULL, 'another weight', NULL, '0'),
(10, 2, NULL, 'weight', NULL, '0');

-- --------------------------------------------------------

--
-- Struttura della tabella `algrnk`
--

DROP TABLE IF EXISTS `algrnk`;
CREATE TABLE IF NOT EXISTS `algrnk` (
  `idAlgRnk` int(11) NOT NULL AUTO_INCREMENT,
  `idAlg` int(11) DEFAULT NULL,
  `nReq` int(11) DEFAULT NULL,
  `idAlgDAVl` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAlgRnk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `algstate`
--

DROP TABLE IF EXISTS `algstate`;
CREATE TABLE IF NOT EXISTS `algstate` (
  `idAlgState` int(11) NOT NULL AUTO_INCREMENT,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  PRIMARY KEY (`idAlgState`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `algstate`
--

INSERT INTO `algstate` (`idAlgState`, `nam`, `descr`) VALUES
(1, 'New', 'New Alg'),
(2, 'Build', 'Building phase of alg life cycle'),
(3, 'Ready', 'Alg ready for Analysis'),
(4, 'NA', 'Not Available');

-- --------------------------------------------------------

--
-- Struttura della tabella `algtrainparam`
--

DROP TABLE IF EXISTS `algtrainparam`;
CREATE TABLE IF NOT EXISTS `algtrainparam` (
  `idAlgTrainParam` int(11) NOT NULL AUTO_INCREMENT,
  `idAlgParam` int(11) DEFAULT NULL,
  `idTrain` int(11) DEFAULT NULL,
  `idAlgParamType` int(11) DEFAULT NULL,
  `vl` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idAlgTrainParam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `algtypeparam`
--

DROP TABLE IF EXISTS `algtypeparam`;
CREATE TABLE IF NOT EXISTS `algtypeparam` (
  `idAlgParamType` int(11) NOT NULL AUTO_INCREMENT,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idAlgParamType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `an`
--

DROP TABLE IF EXISTS `an`;
CREATE TABLE IF NOT EXISTS `an` (
  `idAn` int(11) NOT NULL AUTO_INCREMENT,
  `idPrj` int(11) DEFAULT NULL,
  `idAlg` int(11) DEFAULT NULL,
  `idAnState` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `dttm` datetime DEFAULT NULL,
  PRIMARY KEY (`idAn`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `an`
--

INSERT INTO `an` (`idAn`, `idPrj`, `idAlg`, `idAnState`, `nam`, `descr`, `dttm`) VALUES
(1, 1, 1, 3, 'Regressione Lineare', 'Regressione Lineare', '2021-10-18 10:03:00'),
(3, 23, 1, 6, 'dfff', 'sss', NULL),
(4, 2, 1, 3, 'analysis', 'analysis', '1970-01-01 00:00:00'),
(5, 15, 1, 3, 'analisi', 'analisi v2', '1970-01-01 00:00:00'),
(6, 3, 1, 2, 'an', NULL, '1970-01-01 00:00:00'),
(7, 24, 1, 6, 'Attenuation anallysis', 'event=mag+dis+accel', NULL),
(8, 26, 1, 6, 'Diabete analisi', 'Analisi Regressione Lineare.\nDiabets (Pregnancies, SkinThickness, Age)', NULL),
(9, 30, 1, 6, 'Analiksi Regrssione Lineare', 'regressione linea su singola variabile: x', NULL),
(10, 27, 1, 6, 'lm analysis', 'linear regression', NULL),
(11, 28, 1, 6, '2 vars analysis', '2 vars analysis', NULL),
(12, 29, 1, 6, 'w=f(t,d)', 'weight=f(time, diet)', NULL),
(13, 25, 1, 6, 'raises only', 'raises only', NULL),
(14, 31, 1, 6, 'Nile river flow', 'Nile river flow.\nSingle variable.', NULL),
(15, 32, 1, 6, 'Linear Regressione', 'circumference=f(age)', NULL),
(16, 14, 1, 3, 'an', NULL, '1970-01-01 00:00:00'),
(17, 4, 1, 3, 'austres', NULL, '1970-01-01 00:00:00'),
(18, 33, 1, 3, 'Disco', '1 column: x', '1970-01-01 00:00:00'),
(19, 1, 1, 1, 'an2', 'an2', '2021-10-19 09:41:00'),
(20, 1, NULL, 1, 'an3', NULL, NULL),
(21, 2, NULL, 1, 'an22', NULL, NULL),
(22, 23, 1, 2, 'dfff', 'sss', '1970-01-01 00:00:00'),
(23, 3, 1, 1, 'an2', NULL, '2021-10-22 04:45:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `ancntx`
--

DROP TABLE IF EXISTS `ancntx`;
CREATE TABLE IF NOT EXISTS `ancntx` (
  `IdAnCntx` int(11) NOT NULL AUTO_INCREMENT,
  `IdAn` int(11) DEFAULT NULL,
  `IdCntx` int(11) DEFAULT NULL,
  `IdSplitType` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `fileRefTrainDat` varchar(200) DEFAULT NULL,
  `fileRefTestDat` varchar(200) DEFAULT NULL,
  `Regr_Outcome` varchar(50) DEFAULT NULL,
  `Regr_Vars` varchar(200) DEFAULT NULL,
  `Regr_CtrlMethod` varchar(50) DEFAULT NULL,
  `Regr_ModelMethods` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`IdAnCntx`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ancntx`
--

INSERT INTO `ancntx` (`IdAnCntx`, `IdAn`, `IdCntx`, `IdSplitType`, `nam`, `descr`, `fileRefTrainDat`, `fileRefTestDat`, `Regr_Outcome`, `Regr_Vars`, `Regr_CtrlMethod`, `Regr_ModelMethods`) VALUES
(1, 1, 1, 1, 'Contesto Analisi 1', 'Contesto Analisi 1', 'AirPassengers_autoclean_train.csv_da', 'AirPassengers_autoclean_test.csv_da', NULL, NULL, NULL, NULL),
(2, 3, 3, 1, 'sss', 'ss', 'DA/_FsBase/Prj/Usr_1_Prj_23/Evnt_15/airmiles_autoclean.csv_da', 'DA/_FsBase/Prj/Usr_1_Prj_23/Evnt_15/airmiles_autoclean.csv_da', NULL, NULL, NULL, NULL),
(3, NULL, 5, NULL, 'contesto ozone', 'ozone', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, 5, 1, 'context', 'ccc', 'airquality_autoclean_train.csv_da', 'airquality_autoclean_test.csv_da', NULL, NULL, NULL, NULL),
(5, NULL, 4, 1, 'ac', 'ac', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 5, 4, 1, 'ac', 'ac v2', 'adults2_autoclean_train.csv_da', 'adults2_autoclean_test.csv_da', NULL, NULL, NULL, NULL),
(7, 6, 6, NULL, 'ancontext', NULL, NULL, NULL, 'y', 'x', NULL, NULL),
(8, 7, 8, 1, 'attenuation analysis context', 'event=mag+dis+accel', 'attenu_autoclean_train.csv_da', 'attenu_autoclean_test.csv_da', 'event', 'mag,dist,accel', 'repeatedcv', 'lm,svmRadial'),
(9, 8, 9, 1, 'Diabete contesto di analisi', 'Diabete contesto di analisi.\noutcome=Diabets (Pregnancies, SkinThickness, Age)', 'diabetes_autoclean_train.csv_da', 'diabetes_autoclean_test.csv_da', 'Outcome', 'Pregnancies,SkinThickness,Age', 'repeatedcv', 'lm,svmRadial'),
(10, 9, 13, 1, 'Contesto', 'Semplice su 1 variabile', 'CO2_autoclean_train.csv_da', 'CO2_autoclean_test.csv_da', 'x', 'x', 'repeatedcv', 'lm,svmRadial'),
(11, 11, 15, 1, '2 vars', '2 vars', 'cars_autoclean_train.csv_da', 'cars_autoclean_test.csv_da', 'dist', 'speed', 'repeatedcv', 'lm,svmRadial'),
(12, 12, 16, 1, 'weight=f(time, diet)', 'weight=f(time, diet)', 'ChickWeight_autoclean_train.csv_da', 'ChickWeight_autoclean_test.csv_da', 'weight', 'Time,Diet', 'repeatedcv', 'lm,svmRadial'),
(13, 13, 7, 1, 'raises only', 'complains=f(, learning, raises)', 'attitude_autoclean_train.csv_da', 'attitude_autoclean_test.csv_da', 'complaints', 'learning,raises', 'repeatedcv', 'lm,svmRadial'),
(14, 14, 17, 1, 'Nile river flow', 'Nile river flow.\nSIngle variable.', 'Nile_autoclean_train.csv_da', 'Nile_autoclean_test.csv_da', 'y', 'x', 'repeatedcv', 'lm,svmRadial'),
(15, 15, 18, 1, 'Linear Regression', 'circumference=f(age)', 'Orange_autoclean_train.csv_da', 'Orange_autoclean_test.csv_da', 'circumference', 'age', 'repeatedcv', 'lm,svmRadial'),
(16, 16, 19, 1, 'an cntx', NULL, 'BJsales_autoclean_train.csv_da', 'BJsales_autoclean_test.csv_da', 'y', 'x', 'repeatedcv', 'lm,svmRadial'),
(17, 17, 20, 1, 'austres', NULL, 'austres_autoclean_train.csv_da', 'austres_autoclean_test.csv_da', 'y', 'x', 'repeatedcv', 'lm,svmRadial'),
(18, 18, 21, 1, 'an cntx disco', '1 column: x', 'discoveries_autoclean_train.csv_da', 'discoveries_autoclean_test.csv_da', 'y', 'x', 'repeatedcv', 'lm,svmRadial');

-- --------------------------------------------------------

--
-- Struttura della tabella `ancntxstrucstat`
--

DROP TABLE IF EXISTS `ancntxstrucstat`;
CREATE TABLE IF NOT EXISTS `ancntxstrucstat` (
  `idStatDatiAnCntx` int(11) NOT NULL AUTO_INCREMENT,
  `IdAnCntx` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nCols` int(11) DEFAULT NULL,
  `nRows` int(11) DEFAULT NULL,
  `colTypes` text DEFAULT NULL,
  `units` text DEFAULT NULL,
  `cntxProjection` text DEFAULT NULL,
  PRIMARY KEY (`idStatDatiAnCntx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ancntxstvarfpstat`
--

DROP TABLE IF EXISTS `ancntxstvarfpstat`;
CREATE TABLE IF NOT EXISTS `ancntxstvarfpstat` (
  `IdAnCntxStVarFpStat` int(11) NOT NULL AUTO_INCREMENT,
  `IdAnCntx` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nMeasures` int(11) DEFAULT NULL,
  `MODE` double DEFAULT NULL,
  `mn` double DEFAULT NULL,
  `mx` double DEFAULT NULL,
  `mean` double DEFAULT NULL,
  `sd` double DEFAULT NULL,
  `VARIANCE` double DEFAULT NULL,
  `varCoef` double DEFAULT NULL,
  `filtr` text DEFAULT NULL,
  PRIMARY KEY (`IdAnCntxStVarFpStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `anstate`
--

DROP TABLE IF EXISTS `anstate`;
CREATE TABLE IF NOT EXISTS `anstate` (
  `idAnState` int(11) NOT NULL AUTO_INCREMENT,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  PRIMARY KEY (`idAnState`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `anstate`
--

INSERT INTO `anstate` (`idAnState`, `nam`, `descr`) VALUES
(1, 'New', 'New Analysis'),
(2, 'AnCntx', 'Analysis Context'),
(3, 'Train', 'Train'),
(4, 'Test', 'Test'),
(5, 'Compare', 'Compare'),
(6, 'Rev', 'Review'),
(7, 'NA', 'Not Available or Not Active');

-- --------------------------------------------------------

--
-- Struttura della tabella `authlevel`
--

DROP TABLE IF EXISTS `authlevel`;
CREATE TABLE IF NOT EXISTS `authlevel` (
  `IdAuthLevel` int(11) NOT NULL AUTO_INCREMENT,
  `Nam` varchar(50) DEFAULT NULL,
  `Descr` text DEFAULT NULL,
  `AuthLevel` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`IdAuthLevel`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `authlevel`
--

INSERT INTO `authlevel` (`IdAuthLevel`, `Nam`, `Descr`, `AuthLevel`) VALUES
(1, 'Denied', 'Feature denied access. It overlaps others authorizations.', 0),
(2, 'View', 'View authorization. Read-only.', 1),
(3, 'Modify', 'Modify Authoruzation. Contribution. No new creation or deletion.', 2),
(4, 'Full', 'Full authorization. Complete ownwership.', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `clean`
--

DROP TABLE IF EXISTS `clean`;
CREATE TABLE IF NOT EXISTS `clean` (
  `idClean` int(11) NOT NULL AUTO_INCREMENT,
  `idPrj` int(11) DEFAULT NULL,
  `Note` text DEFAULT NULL,
  `ctsd` varchar(300) DEFAULT NULL,
  `cnsd` varchar(300) DEFAULT NULL,
  `cusd` varchar(300) DEFAULT NULL,
  `filters` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idClean`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `clean`
--

INSERT INTO `clean` (`idClean`, `idPrj`, `Note`, `ctsd`, `cnsd`, `cusd`, `filters`) VALUES
(1, 1, 'verify structure new', NULL, NULL, NULL, NULL),
(2, 23, 'autocleaning', NULL, NULL, NULL, NULL),
(3, 15, 'clean v3', 'numeric,numeric,numeric', 'age,fnlwgt,education_num', 'numeric,numeric,numeric', NULL),
(4, 2, 'Ozone quantity analysis', NULL, NULL, NULL, NULL),
(5, 3, 'only x1 y1', 'numeric,numeric', 'x1,y1', 'numeric,numeric', NULL),
(6, 25, 'clean n\ncomplains=f(, learning, raises)\n\nonly raises\nthen only complains', 'numeric', 'raises', 'numeric', NULL),
(7, 24, 'clean n, station', 'numeric,numeric,numeric,numeric', 'event,mag,dist,accel', 'numeric,numeric,numeric,numeric', NULL),
(8, 26, 'Diabets (Pregnancies, SkinThickness, Age)', 'numeric,numeric,numeric,numeric', 'Pregnancies,SkinThickness,Age,Outcome', 'numeric,numeric,numeric,numeric', NULL),
(9, 14, 'pulizia automatica', NULL, NULL, NULL, NULL),
(10, 30, 'no cleaning necessary', 'numeric,numeric', 'n,x', 'numeric,numeric', NULL),
(11, 27, 'automatic clean', NULL, NULL, NULL, NULL),
(12, 28, 'auto', NULL, NULL, NULL, NULL),
(13, 29, 'weight=f(time, diet)', NULL, NULL, NULL, NULL),
(14, 31, 'Nile river flow\nSIngle variable.', NULL, NULL, NULL, NULL),
(15, 32, 'Autoclean.\ncircumference=f(age)', NULL, NULL, NULL, NULL),
(16, 4, 'austres', NULL, NULL, NULL, NULL),
(17, 33, 'automatic cleaning.\n1 column: x', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `cntx`
--

DROP TABLE IF EXISTS `cntx`;
CREATE TABLE IF NOT EXISTS `cntx` (
  `idCntx` int(11) NOT NULL AUTO_INCREMENT,
  `idPrj` int(11) DEFAULT NULL,
  `idEvnt` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `fileRefDat` varchar(200) DEFAULT NULL,
  `ctsd` varchar(300) DEFAULT NULL,
  `cnsd` varchar(300) DEFAULT NULL,
  `cusd` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idCntx`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `cntx`
--

INSERT INTO `cntx` (`idCntx`, `idPrj`, `idEvnt`, `nam`, `descr`, `fileRefDat`, `ctsd`, `cnsd`, `cusd`) VALUES
(1, 1, 1, 'Contesto Prj 1', 'Contesto PRJ 1', 'DA/_FsBase/Prj/Usr_1_Prj_1/Evnt_1/AirPassengers_autoclean.csv_da', NULL, NULL, NULL),
(3, 23, 15, 'context', 'context', 'DA/_FsBase/Prj/Usr_1_Prj_23/Evnt_15/airmiles_autoclean.csv_da', NULL, NULL, NULL),
(4, 15, 17, 'adults contaxt', 'ver 3', 'DA/_FsBase/Prj/Usr_1_Prj_15/Evnt_17/adults2_autoclean.csv_da', NULL, NULL, NULL),
(5, 2, 8, 'no soalr r', 'dataset without solar r', 'DA/_FsBase/Prj/Usr_1_Prj_2/Evnt_8/airquality_autoclean.csv_da', NULL, NULL, NULL),
(6, 3, 14, 'anscombe context', 'anscombe context', 'DA/_FsBase/Prj/Usr_1_Prj_3/Evnt_14/anscombe_autoclean.csv_da', NULL, NULL, NULL),
(7, 25, 19, 'conte', 'complains=f(, learning, raises)', 'DA/_FsBase/Prj/Usr_8_Prj_25/Evnt_19/attitude_autoclean.csv_da', NULL, NULL, NULL),
(8, 24, 18, 'Attenuation context', 'attenuation context,\nevent=mag+dis+accel', 'DA/_FsBase/Prj/Usr_8_Prj_24/Evnt_18/attenu_autoclean.csv_da', NULL, NULL, NULL),
(9, 26, 20, 'Diabete contesto', 'verifica del contesto\nDiabets (Pregnancies, SkinThickness, Age)', 'DA/_FsBase/Prj/Usr_8_Prj_26/Evnt_20/diabetes_autoclean.csv_da', NULL, NULL, NULL),
(13, 30, 27, 'co2', 'co2 contesto semplice.\nuna sola variabile.', 'DA/_FsBase/Prj/Usr_8_Prj_30/Evnt_27/CO2_autoclean.csv_da', NULL, NULL, NULL),
(14, 27, 24, 'context', 'context description', 'DA/_FsBase/Prj/Usr_8_Prj_27/Evnt_24/austres_autoclean.csv_da', NULL, NULL, NULL),
(15, 28, 25, '2 vars', '2 vars', 'DA/_FsBase/Prj/Usr_8_Prj_28/Evnt_25/cars_autoclean.csv_da', NULL, NULL, NULL),
(16, 29, 26, 'context', 'weight=f(time, diet)', 'DA/_FsBase/Prj/Usr_8_Prj_29/Evnt_26/ChickWeight_autoclean.csv_da', NULL, NULL, NULL),
(17, 31, 28, 'Nile river flow', 'Nile river flow.\nSingle variable.', 'DA/_FsBase/Prj/Usr_8_Prj_31/Evnt_28/Nile_autoclean.csv_da', NULL, NULL, NULL),
(18, 32, 29, 'Context', 'circumference=f(age)', 'DA/_FsBase/Prj/Usr_8_Prj_32/Evnt_29/Orange_autoclean.csv_da', NULL, NULL, NULL),
(19, 14, 23, 'BJsales', 'solo 1 carattere variabile', 'DA/_FsBase/Prj/Usr_1_Prj_14/Evnt_23/BJsales_autoclean.csv_da', NULL, NULL, NULL),
(20, 4, 21, 'austres', NULL, 'DA/_FsBase/Prj/Usr_1_Prj_4/Evnt_21/austres_autoclean.csv_da', NULL, NULL, NULL),
(21, 33, 30, 'disco', '1 column: x', 'DA/_FsBase/Prj/Usr_1_Prj_33/Evnt_30/discoveries_autoclean.csv_da', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `cntxstrucstat`
--

DROP TABLE IF EXISTS `cntxstrucstat`;
CREATE TABLE IF NOT EXISTS `cntxstrucstat` (
  `idCntxStrucStat` int(11) NOT NULL AUTO_INCREMENT,
  `idCntx` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nCols` int(11) DEFAULT NULL,
  `nRows` int(11) DEFAULT NULL,
  `colTypes` text DEFAULT NULL,
  `units` text DEFAULT NULL,
  `evntProjection` text DEFAULT NULL,
  PRIMARY KEY (`idCntxStrucStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `cntxstvarfpstat`
--

DROP TABLE IF EXISTS `cntxstvarfpstat`;
CREATE TABLE IF NOT EXISTS `cntxstvarfpstat` (
  `idStatDaticntxVar` int(11) NOT NULL AUTO_INCREMENT,
  `idCntx` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nMeasures` int(11) DEFAULT NULL,
  `MODE` double DEFAULT NULL,
  `mn` double DEFAULT NULL,
  `mx` double DEFAULT NULL,
  `mean` double DEFAULT NULL,
  `sd` double DEFAULT NULL,
  `VARIANCE` double DEFAULT NULL,
  `varCoef` double DEFAULT NULL,
  `filtr` text DEFAULT NULL,
  PRIMARY KEY (`idStatDaticntxVar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `comp2stvarscorrstat`
--

DROP TABLE IF EXISTS `comp2stvarscorrstat`;
CREATE TABLE IF NOT EXISTS `comp2stvarscorrstat` (
  `idComp2StVarsCorrStat` int(11) NOT NULL AUTO_INCREMENT,
  `idRev` int(11) DEFAULT NULL,
  `idStVar1` int(11) DEFAULT NULL,
  `idStVar2` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `r` double DEFAULT NULL,
  `95CI` double DEFAULT NULL,
  `t` double DEFAULT NULL,
  `Spearman` double DEFAULT NULL,
  `Pearson` double DEFAULT NULL,
  PRIMARY KEY (`idComp2StVarsCorrStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `comp2stvarsindstat`
--

DROP TABLE IF EXISTS `comp2stvarsindstat`;
CREATE TABLE IF NOT EXISTS `comp2stvarsindstat` (
  `idComp2StVarsIndStat` int(11) NOT NULL AUTO_INCREMENT,
  `idRev` int(11) DEFAULT NULL,
  `idStVar1` int(11) DEFAULT NULL,
  `idStVar2` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `chi2` double DEFAULT NULL,
  `df` double DEFAULT NULL,
  `pval` double DEFAULT NULL,
  `phi` double DEFAULT NULL,
  `coefPartialContg` double DEFAULT NULL,
  `vCramer` double DEFAULT NULL,
  `verosimiglianza` double DEFAULT NULL,
  PRIMARY KEY (`idComp2StVarsIndStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `compare`
--

DROP TABLE IF EXISTS `compare`;
CREATE TABLE IF NOT EXISTS `compare` (
  `idCompare` int(11) NOT NULL AUTO_INCREMENT,
  `idAn` int(11) DEFAULT NULL,
  `fileRefDat` varchar(200) DEFAULT NULL,
  `fileRefRsdat` varchar(200) DEFAULT NULL,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`idCompare`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `compfpstat`
--

DROP TABLE IF EXISTS `compfpstat`;
CREATE TABLE IF NOT EXISTS `compfpstat` (
  `idCompFpStat` int(11) NOT NULL AUTO_INCREMENT,
  `idRev` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `modeRsd` double DEFAULT NULL,
  `minRsd` double DEFAULT NULL,
  `maxRsd` double DEFAULT NULL,
  `rmeanRsd` double DEFAULT NULL,
  `sdRsd` double DEFAULT NULL,
  `varRsd` double DEFAULT NULL,
  `varCoefRsd` double DEFAULT NULL,
  PRIMARY KEY (`idCompFpStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `compres2stvarscorrstat`
--

DROP TABLE IF EXISTS `compres2stvarscorrstat`;
CREATE TABLE IF NOT EXISTS `compres2stvarscorrstat` (
  `idCompRes2StVarsCorrStat` int(11) NOT NULL AUTO_INCREMENT,
  `idRev` int(11) DEFAULT NULL,
  `idStVar1` int(11) DEFAULT NULL,
  `idStVar2` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `r` double DEFAULT NULL,
  `95CI` double DEFAULT NULL,
  `t` double DEFAULT NULL,
  `Spearman` double DEFAULT NULL,
  `Pearson` double DEFAULT NULL,
  PRIMARY KEY (`idCompRes2StVarsCorrStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `compres2stvarsindstat`
--

DROP TABLE IF EXISTS `compres2stvarsindstat`;
CREATE TABLE IF NOT EXISTS `compres2stvarsindstat` (
  `idCompRes2StVarsIndStat` int(11) NOT NULL AUTO_INCREMENT,
  `idRev` int(11) DEFAULT NULL,
  `idStVar1` int(11) DEFAULT NULL,
  `idStVar2` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `chi2` double DEFAULT NULL,
  `df` double DEFAULT NULL,
  `pval` double DEFAULT NULL,
  `phi` double DEFAULT NULL,
  `coefPartialContg` double DEFAULT NULL,
  `vCramer` double DEFAULT NULL,
  `verosimiglianza` double DEFAULT NULL,
  PRIMARY KEY (`idCompRes2StVarsIndStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `compresfpstat`
--

DROP TABLE IF EXISTS `compresfpstat`;
CREATE TABLE IF NOT EXISTS `compresfpstat` (
  `idCompResFpStat` int(11) NOT NULL AUTO_INCREMENT,
  `idRev` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `modeRsd` double DEFAULT NULL,
  `minRsd` double DEFAULT NULL,
  `maxRsd` double DEFAULT NULL,
  `rmeanRsd` double DEFAULT NULL,
  `sdRsd` double DEFAULT NULL,
  `varRsd` double DEFAULT NULL,
  `varRsdCoef` double DEFAULT NULL,
  PRIMARY KEY (`idCompResFpStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `descrcapstat`
--

DROP TABLE IF EXISTS `descrcapstat`;
CREATE TABLE IF NOT EXISTS `descrcapstat` (
  `idDescrCapStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTrainStVarFpStat` int(11) DEFAULT NULL,
  `idTrainResStVarFpStat` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `dMin` double DEFAULT NULL,
  `dMax` double DEFAULT NULL,
  `dMean` double DEFAULT NULL,
  `dSd` double DEFAULT NULL,
  `dVar` double DEFAULT NULL,
  `dVarCoef` double DEFAULT NULL,
  PRIMARY KEY (`idDescrCapStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `evnt`
--

DROP TABLE IF EXISTS `evnt`;
CREATE TABLE IF NOT EXISTS `evnt` (
  `idEvnt` int(11) NOT NULL AUTO_INCREMENT,
  `idPrj` int(11) DEFAULT NULL,
  `idEvntCat` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `fileRefRepoDat` varchar(200) DEFAULT NULL,
  `fileRefEvntDat` varchar(200) DEFAULT NULL,
  `CatTag` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idEvnt`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `evnt`
--

INSERT INTO `evnt` (`idEvnt`, `idPrj`, `idEvntCat`, `nam`, `descr`, `fileRefRepoDat`, `fileRefEvntDat`, `CatTag`) VALUES
(1, 1, 7, 'evento test 1', 'evento test 1', 'DA/_FsBase/Dat/Evnt/AirPassengers.csv_da', NULL, NULL),
(4, NULL, NULL, 'aaa', NULL, NULL, NULL, NULL),
(5, NULL, NULL, 'sss', NULL, NULL, NULL, NULL),
(8, 2, 2, 'Airquality', 'Airquality', 'DA/_FsBase/Dat/Evnt/airquality.csv_da', NULL, 'Pollution, Climate'),
(9, NULL, 8, 'eee', NULL, 'DA/_FsBase/Dat/Evnt/AirPassengers.csv_da', NULL, NULL),
(10, NULL, 8, 'eee', NULL, 'DA/_FsBase/Dat/Evnt/AirPassengers.csv_da', NULL, NULL),
(11, NULL, 8, 'eee', NULL, 'DA/_FsBase/Dat/Evnt/AirPassengers.csv_da', NULL, NULL),
(12, NULL, 8, 'eee', NULL, 'DA/_FsBase/Dat/Evnt/airquality.csv_da', NULL, NULL),
(13, NULL, 8, 'eee', NULL, 'DA/_FsBase/Dat/Evnt/airmiles.csv_da', NULL, NULL),
(14, 3, 8, 'anscombe event', 'anscombe event description', 'DA/_FsBase/Dat/Evnt/anscombe.csv_da', NULL, NULL),
(15, 23, 5, 'eee', 'gggg', 'DA/_FsBase/Dat/Evnt/airmiles.csv_da', NULL, NULL),
(17, 15, 10, 'adults', 'Salary and annual income analysis', 'DA/_FsBase/Dat/Evnt/adults2.csv_da', NULL, NULL),
(18, 24, 9, 'att', 'The Joyner-Boore Attenuation Data', 'DA/_FsBase/Dat/Evnt/attenu.csv_da', NULL, NULL),
(19, 25, 11, 'attitude', NULL, 'DA/_FsBase/Dat/Evnt/attitude.csv_da', NULL, NULL),
(20, 26, 2, 'Diabete', 'Diabete', 'DA/_FsBase/Dat/Evnt/diabetes.csv_da', NULL, NULL),
(21, 4, NULL, 'austres', 'Quarterly Time Series of the Number of Australian Residents', 'DA/_FsBase/Dat/Evnt/austres.csv_da', NULL, NULL),
(23, 14, 10, 'BJsales', NULL, 'DA/_FsBase/Dat/Evnt/BJsales.csv_da', NULL, NULL),
(24, 27, NULL, 'austres', 'Quarterly Time Series of the Number of Australian Residents', 'DA/_FsBase/Dat/Evnt/austres.csv_da', NULL, NULL),
(25, 28, 8, 'Cars', 'Speed, stopping distance', 'DA/_FsBase/Dat/Evnt/cars.csv_da', NULL, NULL),
(26, 29, 2, 'Chicken Weigth', 'Chicken Weigth', 'DA/_FsBase/Dat/Evnt/ChickWeight.csv_da', NULL, NULL),
(27, 30, 5, 'CO2', 'Mauna Loa Atmospheric CO2 Concentration', 'DA/_FsBase/Dat/Evnt/CO2.csv_da', NULL, NULL),
(28, 31, 5, 'Nile river flow', 'Nile river flow', 'DA/_FsBase/Dat/Evnt/Nile.csv_da', NULL, NULL),
(29, 32, NULL, 'Orange tree', 'Orange tree.\ncircumference=f(age)', 'DA/_FsBase/Dat/Evnt/Orange.csv_da', NULL, NULL),
(30, 33, NULL, 'discoveries', 'Yearly Numbers of Important Discoveries', 'DA/_FsBase/Dat/Evnt/discoveries.csv_da', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `evntanom`
--

DROP TABLE IF EXISTS `evntanom`;
CREATE TABLE IF NOT EXISTS `evntanom` (
  `idEvntStVarAnom` int(11) NOT NULL AUTO_INCREMENT,
  `idEvnt` int(11) DEFAULT NULL,
  `nAnom` int(11) DEFAULT NULL,
  `nNA` int(11) DEFAULT NULL,
  `nErr` int(11) DEFAULT NULL,
  `nOtherAnom` int(11) DEFAULT NULL,
  `nCorrections` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEvntStVarAnom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `evntcat`
--

DROP TABLE IF EXISTS `evntcat`;
CREATE TABLE IF NOT EXISTS `evntcat` (
  `idEvntCat` int(11) NOT NULL AUTO_INCREMENT,
  `idEvntCatPar` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  PRIMARY KEY (`idEvntCat`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `evntcat`
--

INSERT INTO `evntcat` (`idEvntCat`, `idEvntCatPar`, `nam`, `descr`) VALUES
(1, NULL, 'Accidental', NULL),
(2, NULL, 'Natural', NULL),
(3, 2, 'Sismic', NULL),
(4, 2, 'Vulcanic', NULL),
(5, 2, 'Hydrogeologic', NULL),
(6, 2, 'Pandemic', NULL),
(7, 1, 'Transport Accident', NULL),
(8, 7, 'Car Accident', NULL),
(9, 7, 'Rail Accident', NULL),
(10, NULL, 'Economical', 'Economical Categories'),
(11, NULL, 'Demographyc', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `evntstrucstat`
--

DROP TABLE IF EXISTS `evntstrucstat`;
CREATE TABLE IF NOT EXISTS `evntstrucstat` (
  `idEvntStrucStat` int(11) NOT NULL AUTO_INCREMENT,
  `idEvnt` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nCols` int(11) DEFAULT NULL,
  `nRows` int(11) DEFAULT NULL,
  `colTypes` text DEFAULT NULL,
  `units` text DEFAULT NULL,
  PRIMARY KEY (`idEvntStrucStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `evntstvaranom`
--

DROP TABLE IF EXISTS `evntstvaranom`;
CREATE TABLE IF NOT EXISTS `evntstvaranom` (
  `idEvntStVarAnom` int(11) NOT NULL AUTO_INCREMENT,
  `idStVar` int(11) DEFAULT NULL,
  `idEvnt` int(11) DEFAULT NULL,
  `nAnom` int(11) DEFAULT NULL,
  `nNA` int(11) DEFAULT NULL,
  `nErr` int(11) DEFAULT NULL,
  `nOtherAnom` int(11) DEFAULT NULL,
  `NaMap` text DEFAULT NULL,
  `errMap` text DEFAULT NULL,
  `errVlMap` text DEFAULT NULL,
  `otherAnomMap` text DEFAULT NULL,
  `nCorrections` int(11) DEFAULT NULL,
  `correctionsMap` text DEFAULT NULL,
  PRIMARY KEY (`idEvntStVarAnom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `explcapstat`
--

DROP TABLE IF EXISTS `explcapstat`;
CREATE TABLE IF NOT EXISTS `explcapstat` (
  `idExplCapStat` int(11) NOT NULL AUTO_INCREMENT,
  `idComp2StVarsCorrStat` int(11) DEFAULT NULL,
  `idCompRes2StVarsCorrStat` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `dr` double DEFAULT NULL,
  `d95CI` double DEFAULT NULL,
  `dt` double DEFAULT NULL,
  `dSpearman` double DEFAULT NULL,
  `dPearson` double DEFAULT NULL,
  PRIMARY KEY (`idExplCapStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `feature`
--

DROP TABLE IF EXISTS `feature`;
CREATE TABLE IF NOT EXISTS `feature` (
  `IdFeature` int(11) NOT NULL AUTO_INCREMENT,
  `Nam` varchar(50) DEFAULT NULL,
  `Descr` text DEFAULT NULL,
  `IdFeatureCat` int(11) DEFAULT NULL,
  `codeParams` text DEFAULT NULL,
  PRIMARY KEY (`IdFeature`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `feature`
--

INSERT INTO `feature` (`IdFeature`, `Nam`, `Descr`, `IdFeatureCat`, `codeParams`) VALUES
(1, 'Procedures', 'Procedures Feature', 1, '{\n  \"icon\": \"icon.png\",\n  \"label\": \"label\"\n}'),
(2, 'Event Data', NULL, 1, NULL),
(3, 'Spaces', NULL, 1, NULL),
(4, 'Table1', NULL, 2, NULL),
(5, 'Table2', NULL, 2, NULL),
(6, 'Algorithm Categories', NULL, 3, NULL),
(7, 'Algorithm States', 'a', 3, NULL),
(8, 'Event Categories', NULL, 3, NULL),
(9, 'Analysis States', NULL, 3, NULL),
(10, 'Data Operation Categories', NULL, 3, NULL),
(11, 'Param Types', NULL, 3, NULL),
(12, 'Param Type Categories', NULL, 3, NULL),
(13, 'Project States', NULL, 3, NULL),
(14, 'R Column Types', NULL, 3, NULL),
(15, 'Split Categories', NULL, 3, NULL),
(16, 'Split Types', NULL, 3, NULL),
(17, 'Statistical Variable Categories', 'StVar Categories.', 3, NULL),
(18, 'Users', NULL, 4, NULL),
(19, 'Profiles', NULL, 4, NULL),
(20, 'Logs', NULL, 4, NULL),
(21, 'Organization', NULL, 4, NULL),
(22, 'Feature Authorization Levels', NULL, 4, NULL),
(23, 'Feature Categories', NULL, 4, NULL),
(24, 'Features', NULL, 4, NULL),
(25, 'Session Variables', 'Sessione Vars', 4, NULL),
(26, 'System Settings', NULL, 4, NULL),
(27, 'RDBMS Connection', NULL, 4, NULL),
(28, 'Installation Guide', NULL, 5, NULL),
(29, 'Source Code', NULL, 6, NULL),
(30, 'Current Site Code', NULL, 6, NULL),
(31, 'Algorithms List', NULL, 7, NULL),
(32, 'Projects List', NULL, 8, NULL),
(33, 'Spaces List', NULL, 9, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `featurecat`
--

DROP TABLE IF EXISTS `featurecat`;
CREATE TABLE IF NOT EXISTS `featurecat` (
  `IdFeatureCat` int(11) NOT NULL AUTO_INCREMENT,
  `IdFeatureCatPar` int(11) DEFAULT NULL,
  `Nam` varchar(50) DEFAULT NULL,
  `Descr` text DEFAULT NULL,
  PRIMARY KEY (`IdFeatureCat`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `featurecat`
--

INSERT INTO `featurecat` (`IdFeatureCat`, `IdFeatureCatPar`, `Nam`, `Descr`) VALUES
(1, NULL, 'File System', 'File System'),
(2, NULL, 'RDBMS', NULL),
(3, NULL, 'Process', NULL),
(4, NULL, 'Sys Admin', NULL),
(5, NULL, 'Docs', NULL),
(6, NULL, 'DownLoads', NULL),
(7, 10, 'Algorithms', NULL),
(8, 10, 'Projects', NULL),
(9, 10, 'Spaces', NULL),
(10, NULL, 'Processes', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `opdat`
--

DROP TABLE IF EXISTS `opdat`;
CREATE TABLE IF NOT EXISTS `opdat` (
  `idOpDat` int(11) NOT NULL AUTO_INCREMENT,
  `idClean` int(11) DEFAULT NULL,
  `idOpDatCat` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `execOr` int(11) DEFAULT NULL,
  PRIMARY KEY (`idOpDat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `opdatcat`
--

DROP TABLE IF EXISTS `opdatcat`;
CREATE TABLE IF NOT EXISTS `opdatcat` (
  `idOpDatCat` int(11) NOT NULL AUTO_INCREMENT,
  `idOpDatCatPar` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  PRIMARY KEY (`idOpDatCat`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `opdatcat`
--

INSERT INTO `opdatcat` (`idOpDatCat`, `idOpDatCatPar`, `nam`, `descr`) VALUES
(1, 8, 'Insert', NULL),
(2, 8, 'Update', NULL),
(3, 8, 'Delete', NULL),
(4, 8, 'Select', NULL),
(5, NULL, 'Order', NULL),
(6, NULL, 'Auto Correction', NULL),
(7, NULL, 'Interpolation', NULL),
(8, NULL, 'Basics', 'Basic operations');

-- --------------------------------------------------------

--
-- Struttura della tabella `opdatparam`
--

DROP TABLE IF EXISTS `opdatparam`;
CREATE TABLE IF NOT EXISTS `opdatparam` (
  `idTestParam` int(11) NOT NULL AUTO_INCREMENT,
  `idOpDat` int(11) DEFAULT NULL,
  `idParamType` int(11) DEFAULT NULL,
  `vl` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idTestParam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `opdatparamtype`
--

DROP TABLE IF EXISTS `opdatparamtype`;
CREATE TABLE IF NOT EXISTS `opdatparamtype` (
  `idOpDatParamType` int(11) NOT NULL AUTO_INCREMENT,
  `idOpDat` int(11) DEFAULT NULL,
  `idParamType` int(11) DEFAULT NULL,
  PRIMARY KEY (`idOpDatParamType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `organization`
--

DROP TABLE IF EXISTS `organization`;
CREATE TABLE IF NOT EXISTS `organization` (
  `IdOrganization` int(11) NOT NULL AUTO_INCREMENT,
  `Nam` varchar(50) DEFAULT NULL,
  `Descr` text DEFAULT NULL,
  `CodeParams` text DEFAULT NULL,
  `dttm` datetime DEFAULT NULL,
  PRIMARY KEY (`IdOrganization`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `organization`
--

INSERT INTO `organization` (`IdOrganization`, `Nam`, `Descr`, `CodeParams`, `dttm`) VALUES
(1, 'my org', 'my org description', '{\n  \"Logo\": \"MA_Logo.png\",\n  \"App\": \"DAB\",\n  \"Title\": \"Data Analysis Board for DA Process Management\",\n  \"Version\": \"0.1\",\n  \"License\": \"MIT\",\n  \"Author\": \"Marco Arcangeli\",\n  \"Description\": \"Data Analysis Board for Data Analysis Process Management\"\n}', '2021-10-26 02:49:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `paramtype`
--

DROP TABLE IF EXISTS `paramtype`;
CREATE TABLE IF NOT EXISTS `paramtype` (
  `idParamType` int(11) NOT NULL AUTO_INCREMENT,
  `idParamTypeCat` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `vlDefault` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idParamType`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `paramtype`
--

INSERT INTO `paramtype` (`idParamType`, `idParamTypeCat`, `nam`, `descr`, `unit`, `vlDefault`) VALUES
(1, 1, 'metre', 'metre', 'm', '0'),
(2, 2, 'kilogram', NULL, 'kg', '0'),
(3, 3, 'litre', NULL, 'l', '0'),
(4, 6, 'm/s^2', 'SI/MKS: m/s^2', 'm/s^2', '0'),
(5, 4, 'second', 'second', 's', '0'),
(6, 3, 'cube metre', 'cube metre', 'm^3', '0');

-- --------------------------------------------------------

--
-- Struttura della tabella `paramtypecat`
--

DROP TABLE IF EXISTS `paramtypecat`;
CREATE TABLE IF NOT EXISTS `paramtypecat` (
  `idParamTypeCat` int(11) NOT NULL AUTO_INCREMENT,
  `idParamTypeCatPar` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  PRIMARY KEY (`idParamTypeCat`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `paramtypecat`
--

INSERT INTO `paramtypecat` (`idParamTypeCat`, `idParamTypeCatPar`, `nam`, `descr`) VALUES
(1, 12, 'Length', 'distance, displacement, length, height'),
(2, 12, 'Mass', 'Mass Units'),
(3, 12, 'Volume', NULL),
(4, 12, 'Time', 'Time'),
(5, 12, 'Velocity', 'Velocity, Speed'),
(6, 12, 'Acceleration ', 'Acceleration '),
(7, 12, 'Viscosity', 'Viscosity'),
(8, 12, 'Power', 'Power'),
(9, 12, 'Force', 'Force'),
(10, 12, 'Pressure ', 'Pressure '),
(11, 12, 'Energy ', 'energy '),
(12, NULL, 'SI', 'SI: System International\nMKS: Metre, Kilogram, Second'),
(13, NULL, 'cgs', 'cgs system');

-- --------------------------------------------------------

--
-- Struttura della tabella `predcapstat`
--

DROP TABLE IF EXISTS `predcapstat`;
CREATE TABLE IF NOT EXISTS `predcapstat` (
  `idPredCapStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTestStVarFpStat` int(11) DEFAULT NULL,
  `idTestResStVarFpStat` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `dMin` double DEFAULT NULL,
  `dMax` double DEFAULT NULL,
  `dMean` double DEFAULT NULL,
  `dSd` double DEFAULT NULL,
  `dVar` double DEFAULT NULL,
  `dVarCoef` double DEFAULT NULL,
  PRIMARY KEY (`idPredCapStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prj`
--

DROP TABLE IF EXISTS `prj`;
CREATE TABLE IF NOT EXISTS `prj` (
  `idPrj` int(11) NOT NULL AUTO_INCREMENT,
  `idUsr` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `folderRef` varchar(200) DEFAULT NULL,
  `idPrjState` int(11) NOT NULL,
  PRIMARY KEY (`idPrj`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prj`
--

INSERT INTO `prj` (`idPrj`, `idUsr`, `nam`, `descr`, `folderRef`, `idPrjState`) VALUES
(1, 1, 'AirPassengers', 'AirPassengers', NULL, 5),
(2, 1, 'air quality', 'air quality', NULL, 5),
(3, 1, 'anscombe', 'anscombe prj', NULL, 5),
(4, 1, 'austres', 'Quarterly Time Series of the Number of Australian Residents', NULL, 5),
(14, 1, 'BJsales', 'Sales Data with Leading Indicator', NULL, 5),
(15, 1, 'Adults', 'Adults analysis', NULL, 5),
(23, 1, 'airmiles', 'airmiles', NULL, 5),
(24, 8, 'Attenuation ', 'The Joyner-Boore Attenuation Data', NULL, 5),
(25, 8, 'Attitude ', 'The Chatterjee–Price Attitude Data.\nhttps://stat.ethz.ch/R-manual/R-devel/library/datasets/html/attitude.html\nFrom a survey of the clerical employees of a large financial organization, the data are aggregated from the questionnaires of the approximately 35 employees for each of 30 (randomly selected) departments. The numbers give the percent proportion of favourable responses to seven questions in each department.\n', NULL, 5),
(26, 8, 'Diabete', 'Diabete', NULL, 5),
(27, 8, 'Australian Residents', 'Quarterly Time Series of the Number of Australian Residents', NULL, 4),
(28, 8, 'Cars', 'Speed and Stopping Distances of Cars', NULL, 5),
(29, 8, 'Chicken Weight', 'Weight versus age of chicks on different diets', NULL, 4),
(30, 8, 'co2', 'Mauna Loa Atmospheric CO2 Concentration', NULL, 5),
(31, 8, 'Nile', 'Flow of the River Nile', NULL, 4),
(32, 8, 'Orange', 'Growth of Orange Trees', NULL, 4),
(33, 1, 'Discoveries', 'Yearly Numbers of Important Discoveries', NULL, 5),
(34, 1, 'new prj', NULL, NULL, 1),
(35, 1, 'sss', NULL, NULL, 1),
(36, 1, 'fff', 'fffg ffffff', NULL, 1),
(37, 1, 'hhh', NULL, NULL, 1),
(39, 1, 'www', NULL, NULL, 1),
(41, 1, 'fdsa', 'dsdfe', NULL, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `prjan`
--

DROP TABLE IF EXISTS `prjan`;
CREATE TABLE IF NOT EXISTS `prjan` (
  `idPrj` int(11) NOT NULL,
  `idAn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prjstate`
--

DROP TABLE IF EXISTS `prjstate`;
CREATE TABLE IF NOT EXISTS `prjstate` (
  `idPrjState` int(11) NOT NULL AUTO_INCREMENT,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  PRIMARY KEY (`idPrjState`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prjstate`
--

INSERT INTO `prjstate` (`idPrjState`, `nam`, `descr`) VALUES
(1, 'New', 'New Prj'),
(2, 'Evnt', 'Event'),
(3, 'Clean', 'Cleaning'),
(4, 'Cntx', 'Context'),
(5, 'An', 'Analysis'),
(6, 'Rnk', 'Ranking or standardization'),
(7, 'NA', 'Not Available or Not Active');

-- --------------------------------------------------------

--
-- Struttura della tabella `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `IdProfile` int(11) NOT NULL AUTO_INCREMENT,
  `Nam` varchar(50) DEFAULT NULL,
  `Descr` text DEFAULT NULL,
  PRIMARY KEY (`IdProfile`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `profile`
--

INSERT INTO `profile` (`IdProfile`, `Nam`, `Descr`) VALUES
(1, 'Developer', 'Developer profile. \nFull Authorization in development and test environments.'),
(2, 'Guest', 'Guest profile. Minimum authorization read only.'),
(3, 'Contributor', 'Contributor profile.\nAbility to modify but cannot create new or delete items.'),
(4, 'Data Analyst', 'Data Analyst profile.\nAbility to fully manage Algorithms, Projects, Spaces Processes.\nDo not access to Process and Sys Admin Features.'),
(5, 'Administrator', 'Administrator profile.\nAbility to fully manage Sys Admin and Process features.'),
(6, 'SuperUser', 'SuperUser profile.\nAbility to fully acces to every app feature.'),
(7, 'other', 'other');

-- --------------------------------------------------------

--
-- Struttura della tabella `profilefeatureauth`
--

DROP TABLE IF EXISTS `profilefeatureauth`;
CREATE TABLE IF NOT EXISTS `profilefeatureauth` (
  `IdProfileFeatureAuth` int(11) NOT NULL AUTO_INCREMENT,
  `IdProfile` int(11) DEFAULT NULL,
  `IdFeature` int(11) DEFAULT NULL,
  `IdAuthLevel` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdProfileFeatureAuth`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `profilefeatureauth`
--

INSERT INTO `profilefeatureauth` (`IdProfileFeatureAuth`, `IdProfile`, `IdFeature`, `IdAuthLevel`) VALUES
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
-- Struttura della tabella `profileusr`
--

DROP TABLE IF EXISTS `profileusr`;
CREATE TABLE IF NOT EXISTS `profileusr` (
  `IdProfileUsr` int(11) NOT NULL AUTO_INCREMENT,
  `IdProfile` int(11) DEFAULT NULL,
  `IdUsr` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdProfileUsr`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `profileusr`
--

INSERT INTO `profileusr` (`IdProfileUsr`, `IdProfile`, `IdUsr`) VALUES
(1, 2, 8),
(2, 1, 1),
(3, 3, 7),
(4, 4, 3),
(5, 5, 1),
(6, 6, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `rcoltype`
--

DROP TABLE IF EXISTS `rcoltype`;
CREATE TABLE IF NOT EXISTS `rcoltype` (
  `idRColType` int(11) NOT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `rcoltype`
--

INSERT INTO `rcoltype` (`idRColType`, `nam`, `descr`) VALUES
(1, 'numeric', 'Generic numeric type. It could correspond to an integer or a double. If it is not specified it is a double.'),
(2, 'integer', 'Specific integer type. It is recognized as numeric if not specified.'),
(3, 'double', 'Specific double type.'),
(4, 'factor', 'Specific factor type.'),
(5, 'character', 'Specific character type.');

-- --------------------------------------------------------

--
-- Struttura della tabella `rev`
--

DROP TABLE IF EXISTS `rev`;
CREATE TABLE IF NOT EXISTS `rev` (
  `IdRev` int(11) NOT NULL AUTO_INCREMENT,
  `IdAn` int(11) DEFAULT NULL,
  `Note` text DEFAULT NULL,
  PRIMARY KEY (`IdRev`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `rev`
--

INSERT INTO `rev` (`IdRev`, `IdAn`, `Note`) VALUES
(2, 5, 'new review'),
(3, 4, 'rev'),
(4, 1, 'Valutazione di\nMAE:\nRMSE:\nR2:\n ----------------------------------------------\n Valutazione della qualità di previsione\n Outcome:\n rispetto alla variabile:\n Var1:\n Var2:\n Var3:'),
(5, 8, 'Valutazione di\nMAE\nRMSE\nR2\n----------------------------------------------\nValutazione della qualità di previsione\nrispetto alla variabile:\nPregnancies:\nSkinThickness:\nAge:\n'),
(6, 7, 'Valutazione di\nMAE\nRMSE\nR2\n----------------------------------------------\nValutazione della qualità di previsione\nevent:\nrispetto alla variabile:\nmag:\ndis:\naccel:\n'),
(7, 9, 'Valutazione di\nMAE:\nRMSE:\nR2:\n ----------------------------------------------\n Valutazione della qualità di previsione\n Outcome:\n rispetto alla variabile:\n Var1:\n Var2:\n Var3:'),
(8, 11, 'Valutazione di\nMAE:\nRMSE:\nR2:\n ----------------------------------------------\n Valutazione della qualità di previsione\n dist:\n rispetto alla variabile:\n speed:\n '),
(9, 13, 'Valutazione di\nMAE:\nRMSE:\nR2:\n ----------------------------------------------\n Valutazione della qualità di previsione\n Outcome:\n rispetto alla variabile:\n Var1:\n Var2:\n Var3:'),
(10, 16, 'Valutazione di\nMAE:\nRMSE:\nR2:\n ----------------------------------------------\n Valutazione della qualità di previsione\n Outcome:\n rispetto alla variabile:\n Var1:\n Var2:\n Var3:'),
(11, 17, 'Valutazione di\nMAE:\nRMSE:\nR2:\n ----------------------------------------------\n Valutazione della qualità di previsione\n Outcome:\n rispetto alla variabile:\n Var1:\n Var2:\n Var3:'),
(12, 18, 'Valutazione di\nMAE:\nRMSE:\nR2:\n ----------------------------------------------\n Valutazione della qualità di previsione\n Outcome:\n rispetto alla variabile:\n Var1:\n Var2:\n Var3:');

-- --------------------------------------------------------

--
-- Struttura della tabella `rnk`
--

DROP TABLE IF EXISTS `rnk`;
CREATE TABLE IF NOT EXISTS `rnk` (
  `idRnk` int(11) NOT NULL AUTO_INCREMENT,
  `idPrj` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`idRnk`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `spacedavl`
--

DROP TABLE IF EXISTS `spacedavl`;
CREATE TABLE IF NOT EXISTS `spacedavl` (
  `idSpaceDAVl` int(11) NOT NULL AUTO_INCREMENT,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `ordine` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSpaceDAVl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `split`
--

DROP TABLE IF EXISTS `split`;
CREATE TABLE IF NOT EXISTS `split` (
  `idSplit` int(11) NOT NULL AUTO_INCREMENT,
  `idSplitType` int(11) DEFAULT NULL,
  `idCntxAn` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`idSplit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `splitcat`
--

DROP TABLE IF EXISTS `splitcat`;
CREATE TABLE IF NOT EXISTS `splitcat` (
  `idSplitCat` int(11) NOT NULL AUTO_INCREMENT,
  `idSplitCatPar` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  PRIMARY KEY (`idSplitCat`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `splitcat`
--

INSERT INTO `splitcat` (`idSplitCat`, `idSplitCatPar`, `nam`, `descr`) VALUES
(1, NULL, 'Percentage', 'Percentage'),
(2, NULL, 'Condition', 'Condition'),
(9, NULL, 'Position', 'Position'),
(10, 2, 'childsample', NULL),
(11, 9, 'child test', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `splitparam`
--

DROP TABLE IF EXISTS `splitparam`;
CREATE TABLE IF NOT EXISTS `splitparam` (
  `idSplitParam` int(11) NOT NULL AUTO_INCREMENT,
  `idSplit` int(11) DEFAULT NULL,
  `idParamType` int(11) DEFAULT NULL,
  `vl` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idSplitParam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `splitparamtype`
--

DROP TABLE IF EXISTS `splitparamtype`;
CREATE TABLE IF NOT EXISTS `splitparamtype` (
  `idSplitParamType` int(11) NOT NULL AUTO_INCREMENT,
  `idSplit` int(11) DEFAULT NULL,
  `idParamType` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSplitParamType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `splittype`
--

DROP TABLE IF EXISTS `splittype`;
CREATE TABLE IF NOT EXISTS `splittype` (
  `IdSplitType` int(11) NOT NULL AUTO_INCREMENT,
  `IdSplitCat` int(11) DEFAULT NULL,
  `Nam` varchar(50) DEFAULT NULL,
  `Descr` text DEFAULT NULL,
  `Perc` int(2) DEFAULT NULL,
  PRIMARY KEY (`IdSplitType`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `splittype`
--

INSERT INTO `splittype` (`IdSplitType`, `IdSplitCat`, `Nam`, `Descr`, `Perc`) VALUES
(1, 1, 'Train 50', 'Half', 50),
(2, 1, 'Train 75', 'Train 75', 75),
(3, 1, 'Train 80', 'Train 80', 80);

-- --------------------------------------------------------

--
-- Struttura della tabella `stvar`
--

DROP TABLE IF EXISTS `stvar`;
CREATE TABLE IF NOT EXISTS `stvar` (
  `idStVar` int(11) NOT NULL AUTO_INCREMENT,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idStVar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `stvarcat`
--

DROP TABLE IF EXISTS `stvarcat`;
CREATE TABLE IF NOT EXISTS `stvarcat` (
  `idStVarCat` int(11) NOT NULL AUTO_INCREMENT,
  `idStVarCatPar` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  PRIMARY KEY (`idStVarCat`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `stvarcat`
--

INSERT INTO `stvarcat` (`idStVarCat`, `idStVarCatPar`, `nam`, `descr`) VALUES
(1, NULL, 'Economical', NULL),
(2, NULL, 'Engineering', NULL),
(3, NULL, 'Social', NULL),
(4, 2, 'childtest', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `idTest` int(11) NOT NULL AUTO_INCREMENT,
  `idAn` int(11) DEFAULT NULL,
  `fileRefTestDat` varchar(200) DEFAULT NULL,
  `fileRefTestRsdat` varchar(200) DEFAULT NULL,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`idTest`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `testparam`
--

DROP TABLE IF EXISTS `testparam`;
CREATE TABLE IF NOT EXISTS `testparam` (
  `idTestParam` int(11) NOT NULL AUTO_INCREMENT,
  `idAlgAn` int(11) DEFAULT NULL,
  `idParamType` int(11) DEFAULT NULL,
  `idTest` int(11) DEFAULT NULL,
  `vl` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idTestParam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `testresstrucstat`
--

DROP TABLE IF EXISTS `testresstrucstat`;
CREATE TABLE IF NOT EXISTS `testresstrucstat` (
  `idTestResStrucStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTest` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nCols` int(11) DEFAULT NULL,
  `nRows` int(11) DEFAULT NULL,
  `colTypes` text DEFAULT NULL,
  `units` text DEFAULT NULL,
  PRIMARY KEY (`idTestResStrucStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `testresstvarasimstat`
--

DROP TABLE IF EXISTS `testresstvarasimstat`;
CREATE TABLE IF NOT EXISTS `testresstvarasimstat` (
  `idTestResStVarAsimStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTest` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `aritMode` double DEFAULT NULL,
  `coefPearson1` double DEFAULT NULL,
  `coefPearson2` double DEFAULT NULL,
  PRIMARY KEY (`idTestResStVarAsimStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `testresstvarcentresstat`
--

DROP TABLE IF EXISTS `testresstvarcentresstat`;
CREATE TABLE IF NOT EXISTS `testresstvarcentresstat` (
  `idTestResStVarCentresStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTest` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `arit` double DEFAULT NULL,
  `geom` double DEFAULT NULL,
  `quad` double DEFAULT NULL,
  `harm` double DEFAULT NULL,
  `MODE` double DEFAULT NULL,
  `med` double DEFAULT NULL,
  PRIMARY KEY (`idTestResStVarCentresStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `testresstvarfpstat`
--

DROP TABLE IF EXISTS `testresstvarfpstat`;
CREATE TABLE IF NOT EXISTS `testresstvarfpstat` (
  `idTestResStVarFpStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTest` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nMeasures` int(11) DEFAULT NULL,
  `MODE` double DEFAULT NULL,
  `mn` double DEFAULT NULL,
  `mx` double DEFAULT NULL,
  `mean` double DEFAULT NULL,
  `sd` double DEFAULT NULL,
  `VARIANCE` double DEFAULT NULL,
  `varCoef` double DEFAULT NULL,
  PRIMARY KEY (`idTestResStVarFpStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `teststrucstat`
--

DROP TABLE IF EXISTS `teststrucstat`;
CREATE TABLE IF NOT EXISTS `teststrucstat` (
  `idTestStrucStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTest` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nCols` int(11) DEFAULT NULL,
  `nRows` int(11) DEFAULT NULL,
  `colTypes` text DEFAULT NULL,
  `units` text DEFAULT NULL,
  PRIMARY KEY (`idTestStrucStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `teststvarasimstat`
--

DROP TABLE IF EXISTS `teststvarasimstat`;
CREATE TABLE IF NOT EXISTS `teststvarasimstat` (
  `idTestStVarAsimStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTest` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `aritMode` double DEFAULT NULL,
  `coefPearson1` double DEFAULT NULL,
  `coefPearson2` double DEFAULT NULL,
  PRIMARY KEY (`idTestStVarAsimStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `teststvarfpstat`
--

DROP TABLE IF EXISTS `teststvarfpstat`;
CREATE TABLE IF NOT EXISTS `teststvarfpstat` (
  `idTestStVarFpStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTest` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nMeasures` int(11) DEFAULT NULL,
  `MODE` double DEFAULT NULL,
  `mn` double DEFAULT NULL,
  `mx` double DEFAULT NULL,
  `mean` double DEFAULT NULL,
  `sd` double DEFAULT NULL,
  `VARIANCE` double DEFAULT NULL,
  `varCoef` double DEFAULT NULL,
  PRIMARY KEY (`idTestStVarFpStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `train`
--

DROP TABLE IF EXISTS `train`;
CREATE TABLE IF NOT EXISTS `train` (
  `idTrain` int(11) NOT NULL AUTO_INCREMENT,
  `idAn` int(11) DEFAULT NULL,
  `fileRefTrainDat` varchar(200) DEFAULT NULL,
  `fileRefTrainRsdat` varchar(200) DEFAULT NULL,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`idTrain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trainparam`
--

DROP TABLE IF EXISTS `trainparam`;
CREATE TABLE IF NOT EXISTS `trainparam` (
  `idTrainParam` int(11) NOT NULL AUTO_INCREMENT,
  `idAlgAn` int(11) DEFAULT NULL,
  `idParamType` int(11) DEFAULT NULL,
  `idTrain` int(11) DEFAULT NULL,
  `vl` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idTrainParam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trainresstrucstat`
--

DROP TABLE IF EXISTS `trainresstrucstat`;
CREATE TABLE IF NOT EXISTS `trainresstrucstat` (
  `idTrainResStrucStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTrain` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nCols` int(11) DEFAULT NULL,
  `nRows` int(11) DEFAULT NULL,
  `colTypes` text DEFAULT NULL,
  `units` text DEFAULT NULL,
  PRIMARY KEY (`idTrainResStrucStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trainresstvarasimstat`
--

DROP TABLE IF EXISTS `trainresstvarasimstat`;
CREATE TABLE IF NOT EXISTS `trainresstvarasimstat` (
  `idTrainResStVarAsimStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTrain` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `aritMode` double DEFAULT NULL,
  `coefPearson1` double DEFAULT NULL,
  `coefPearson2` double DEFAULT NULL,
  PRIMARY KEY (`idTrainResStVarAsimStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trainresstvarcentresstat`
--

DROP TABLE IF EXISTS `trainresstvarcentresstat`;
CREATE TABLE IF NOT EXISTS `trainresstvarcentresstat` (
  `idTrainResStVarCentresStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTrain` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `arit` double DEFAULT NULL,
  `geom` double DEFAULT NULL,
  `quad` double DEFAULT NULL,
  `harm` double DEFAULT NULL,
  `MODE` double DEFAULT NULL,
  `med` double DEFAULT NULL,
  PRIMARY KEY (`idTrainResStVarCentresStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trainresstvarfpstat`
--

DROP TABLE IF EXISTS `trainresstvarfpstat`;
CREATE TABLE IF NOT EXISTS `trainresstvarfpstat` (
  `idTrainResStVarFpStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTrain` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nMeasures` int(11) DEFAULT NULL,
  `MODE` double DEFAULT NULL,
  `mn` double DEFAULT NULL,
  `mx` double DEFAULT NULL,
  `mean` double DEFAULT NULL,
  `sd` double DEFAULT NULL,
  `VARIANCE` double DEFAULT NULL,
  `varCoef` double DEFAULT NULL,
  PRIMARY KEY (`idTrainResStVarFpStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trainstrucstat`
--

DROP TABLE IF EXISTS `trainstrucstat`;
CREATE TABLE IF NOT EXISTS `trainstrucstat` (
  `idTrainStrucStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTrain` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nCols` int(11) DEFAULT NULL,
  `nRows` int(11) DEFAULT NULL,
  `colTypes` text DEFAULT NULL,
  `units` text DEFAULT NULL,
  PRIMARY KEY (`idTrainStrucStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trainstvarasimstat`
--

DROP TABLE IF EXISTS `trainstvarasimstat`;
CREATE TABLE IF NOT EXISTS `trainstvarasimstat` (
  `idTrainStVarAsimStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTrain` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `aritMode` double DEFAULT NULL,
  `coefPearson1` double DEFAULT NULL,
  `coefPearson2` double DEFAULT NULL,
  PRIMARY KEY (`idTrainStVarAsimStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trainstvarfpstat`
--

DROP TABLE IF EXISTS `trainstvarfpstat`;
CREATE TABLE IF NOT EXISTS `trainstvarfpstat` (
  `idTrainStVarFpStat` int(11) NOT NULL AUTO_INCREMENT,
  `idTrain` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nMeasures` int(11) DEFAULT NULL,
  `MODE` double DEFAULT NULL,
  `mn` double DEFAULT NULL,
  `mx` double DEFAULT NULL,
  `mean` double DEFAULT NULL,
  `sd` double DEFAULT NULL,
  `VARIANCE` double DEFAULT NULL,
  `varCoef` double DEFAULT NULL,
  PRIMARY KEY (`idTrainStVarFpStat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `usr`
--

DROP TABLE IF EXISTS `usr`;
CREATE TABLE IF NOT EXISTS `usr` (
  `idUsr` int(11) NOT NULL AUTO_INCREMENT,
  `usrNam` varchar(30) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `firstnam` varchar(50) NOT NULL,
  `nam` varchar(50) NOT NULL,
  `eMail` varchar(100) DEFAULT NULL,
  `IdOrganization` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsr`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `usr`
--

INSERT INTO `usr` (`idUsr`, `usrNam`, `pwd`, `firstnam`, `nam`, `eMail`, `IdOrganization`) VALUES
(1, 'dev', 'dev', 'dev', 'dev', 'dev@myorg.it', 1),
(3, 'User1', 'User1', 'User1', 'User1', 'user1.user1@user1.org', 1),
(7, 'Contributor', 'Contributor', 'Contributor', 'Contributor', 'Contributor.Contributor@Contributor.org', 1),
(8, 'Guest', 'Guest', 'Guest', 'Guest', 'Guest@Guest.h', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
