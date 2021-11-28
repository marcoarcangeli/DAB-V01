-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Set 25, 2021 alle 11:44
-- Versione del server: 10.4.19-MariaDB
-- Versione PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
CREATE USER IF NOT EXISTS 'DABUser'@'%' IDENTIFIED VIA mysql_native_password 
USING '***';GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'DABUser'@'%' 
REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dadb`
--
CREATE DATABASE IF NOT EXISTS `dadb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dadb`;

--
-- Database: `dadb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `alg`
--

CREATE TABLE `alg` (
  `idAlg` int(11) NOT NULL,
  `idAlgState` int(11) DEFAULT NULL,
  `idAlgCat` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `fileRefProc` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `alg`
--

INSERT INTO `alg` (`idAlg`, `idAlgState`, `idAlgCat`, `nam`, `descr`, `fileRefProc`) VALUES
(1, 1, 26, 'Linear regression', 'Linear regression', 'regressioneLineare.R'),
(2, 1, 6, 'anomalies auto clean', 'alg with compulsory fields', 'anomaliesAuto.R'),
(3, 1, 25, 'Clean', 'Clean', 'clean.R'),
(4, 1, 5, 'Struct', 'Struct', 'analisiStruttura.R'),
(5, 1, 29, 'Compare Train Test', 'Compare Train Test', 'comparaTrainTest.R'),
(6, 1, 2, 'Compare', 'Compare', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `algcat`
--

CREATE TABLE `algcat` (
  `idAlgCat` int(11) NOT NULL,
  `idAlgCatPar` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `algcat`
--

INSERT INTO `algcat` (`idAlgCat`, `idAlgCatPar`, `nam`, `descr`) VALUES
(1, NULL, 'System Algs', 'System Algs.\nDO NOT DELETE'),
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

CREATE TABLE `algcntxrnk` (
  `idAlgCntxRnk` int(11) NOT NULL,
  `idAn` int(11) DEFAULT NULL,
  `idDescrCapStat` int(11) DEFAULT NULL,
  `idPredCapStat` int(11) DEFAULT NULL,
  `idExplCapStat` int(11) DEFAULT NULL,
  `idSpaceDAVl` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `algcntxrnknorm`
--

CREATE TABLE `algcntxrnknorm` (
  `idAlgCntxRnkNorm` int(11) NOT NULL,
  `idAn` int(11) DEFAULT NULL,
  `idDescrCapStat` int(11) DEFAULT NULL,
  `idPredCapStat` int(11) DEFAULT NULL,
  `idExplCapStat` int(11) DEFAULT NULL,
  `idSpaceDAVl` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `algdavl`
--

CREATE TABLE `algdavl` (
  `idAlgDAVl` int(11) NOT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `ordine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `algparam`
--

CREATE TABLE `algparam` (
  `idAlgParam` int(11) NOT NULL,
  `idAlgParamType` int(11) DEFAULT NULL,
  `idAlg` int(11) DEFAULT NULL,
  `vl` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `algparamtest`
--

CREATE TABLE `algparamtest` (
  `idAlgParamtest` int(11) NOT NULL,
  `idAlgParam` int(11) DEFAULT NULL,
  `idTrain` int(11) DEFAULT NULL,
  `idAlgParamType` int(11) DEFAULT NULL,
  `vl` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `algparamtype`
--

CREATE TABLE `algparamtype` (
  `IdAlgParamType` int(11) NOT NULL,
  `IdParamType` int(11) DEFAULT NULL,
  `idAlg` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `vlDefault` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `algparamtype`
--

INSERT INTO `algparamtype` (`IdAlgParamType`, `IdParamType`, `idAlg`, `nam`, `descr`, `vlDefault`) VALUES
(1, NULL, NULL, 'apt1', NULL, NULL),
(2, NULL, NULL, 'apt1', NULL, NULL),
(3, NULL, NULL, 'alp1', NULL, NULL),
(4, NULL, NULL, 'aaaa', NULL, NULL),
(5, NULL, NULL, 'aaaaaaa', NULL, NULL),
(6, NULL, NULL, 'aaa', NULL, NULL),
(7, NULL, NULL, 'aaa', NULL, NULL),
(8, NULL, NULL, 'ffff', NULL, NULL),
(9, 2, NULL, 'another weight', NULL, '0'),
(10, 2, NULL, 'weight', NULL, '0');

-- --------------------------------------------------------

--
-- Struttura della tabella `algrnk`
--

CREATE TABLE `algrnk` (
  `idAlgRnk` int(11) NOT NULL,
  `idAlg` int(11) DEFAULT NULL,
  `nReq` int(11) DEFAULT NULL,
  `idAlgDAVl` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `algstate`
--

CREATE TABLE `algstate` (
  `idAlgState` int(11) NOT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `algtrainparam` (
  `idAlgTrainParam` int(11) NOT NULL,
  `idAlgParam` int(11) DEFAULT NULL,
  `idTrain` int(11) DEFAULT NULL,
  `idAlgParamType` int(11) DEFAULT NULL,
  `vl` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `algtypeparam`
--

CREATE TABLE `algtypeparam` (
  `idAlgParamType` int(11) NOT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `an`
--

CREATE TABLE `an` (
  `idAn` int(11) NOT NULL,
  `idPrj` int(11) DEFAULT NULL,
  `idAlg` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `an`
--

INSERT INTO `an` (`idAn`, `idPrj`, `idAlg`, `nam`, `descr`) VALUES
(1, 1, 1, 'Regressione Lineare', 'Regressione Lineare'),
(3, 23, 1, 'dfff', 'sss'),
(4, 2, 1, 'analysis', 'analysis'),
(5, 15, 1, 'analisi', 'analisi v2'),
(6, 3, 1, 'an', NULL),
(7, 24, 1, 'Attenuation anallysis', 'event=mag+dis+accel'),
(8, 26, 1, 'Diabete analisi', 'Analisi Regressione Lineare.\nDiabets (Pregnancies, SkinThickness, Age)'),
(9, 30, 1, 'Analiksi Regrssione Lineare', 'regressione linea su singola variabile: x'),
(10, 27, 1, 'lm analysis', 'linear regression'),
(11, 28, 1, '2 vars analysis', '2 vars analysis'),
(12, 29, 1, 'w=f(t,d)', 'weight=f(time, diet)'),
(13, 25, 1, 'raises only', 'raises only'),
(14, 31, 1, 'Nile river flow', 'Nile river flow.\nSingle variable.'),
(15, 32, 1, 'Linear Regressione', 'circumference=f(age)');

-- --------------------------------------------------------

--
-- Struttura della tabella `ancntx`
--

CREATE TABLE `ancntx` (
  `IdAnCntx` int(11) NOT NULL,
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
  `Regr_ModelMethods` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(15, 15, 18, 1, 'Linear Regression', 'circumference=f(age)', 'Orange_autoclean_train.csv_da', 'Orange_autoclean_test.csv_da', 'circumference', 'age', 'repeatedcv', 'lm,svmRadial');

-- --------------------------------------------------------

--
-- Struttura della tabella `ancntxstrucstat`
--

CREATE TABLE `ancntxstrucstat` (
  `idStatDatiAnCntx` int(11) NOT NULL,
  `IdAnCntx` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nCols` int(11) DEFAULT NULL,
  `nRows` int(11) DEFAULT NULL,
  `colTypes` text DEFAULT NULL,
  `units` text DEFAULT NULL,
  `cntxProjection` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ancntxstvarfpstat`
--

CREATE TABLE `ancntxstvarfpstat` (
  `IdAnCntxStVarFpStat` int(11) NOT NULL,
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
  `filtr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `clean`
--

CREATE TABLE `clean` (
  `idClean` int(11) NOT NULL,
  `idPrj` int(11) DEFAULT NULL,
  `Note` text DEFAULT NULL,
  `ctsd` varchar(300) DEFAULT NULL,
  `cnsd` varchar(300) DEFAULT NULL,
  `cusd` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `clean`
--

INSERT INTO `clean` (`idClean`, `idPrj`, `Note`, `ctsd`, `cnsd`, `cusd`) VALUES
(1, 1, 'verify structure new', NULL, NULL, NULL),
(2, 23, 'autocleaning', NULL, NULL, NULL),
(3, 15, 'clean v3', 'numeric,numeric,numeric', 'age,fnlwgt,education_num', 'numeric,numeric,numeric'),
(4, 2, 'Ozone quantity analysis', NULL, NULL, NULL),
(5, 3, 'only x1 y1', 'numeric,numeric', 'x1,y1', 'numeric,numeric'),
(6, 25, 'clean n\ncomplains=f(, learning, raises)\n\nonly raises\nthen only complains', 'numeric', 'raises', 'numeric'),
(7, 24, 'clean n, station', 'numeric,numeric,numeric,numeric', 'event,mag,dist,accel', 'numeric,numeric,numeric,numeric'),
(8, 26, 'Diabets (Pregnancies, SkinThickness, Age)', 'numeric,numeric,numeric,numeric', 'Pregnancies,SkinThickness,Age,Outcome', 'numeric,numeric,numeric,numeric'),
(9, 14, 'pulizia automatica', NULL, NULL, NULL),
(10, 30, 'no cleaning necessary', 'numeric,numeric', 'n,x', 'numeric,numeric'),
(11, 27, 'automatic clean', NULL, NULL, NULL),
(12, 28, 'auto', NULL, NULL, NULL),
(13, 29, 'weight=f(time, diet)', NULL, NULL, NULL),
(14, 31, 'Nile river flow\nSIngle variable.', NULL, NULL, NULL),
(15, 32, 'Autoclean.\ncircumference=f(age)', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `cntx`
--

CREATE TABLE `cntx` (
  `idCntx` int(11) NOT NULL,
  `idPrj` int(11) DEFAULT NULL,
  `idEvnt` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `fileRefDat` varchar(200) DEFAULT NULL,
  `ctsd` varchar(300) DEFAULT NULL,
  `cnsd` varchar(300) DEFAULT NULL,
  `cusd` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(18, 32, 29, 'Context', 'circumference=f(age)', 'DA/_FsBase/Prj/Usr_8_Prj_32/Evnt_29/Orange_autoclean.csv_da', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `cntxstrucstat`
--

CREATE TABLE `cntxstrucstat` (
  `idCntxStrucStat` int(11) NOT NULL,
  `idCntx` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nCols` int(11) DEFAULT NULL,
  `nRows` int(11) DEFAULT NULL,
  `colTypes` text DEFAULT NULL,
  `units` text DEFAULT NULL,
  `evntProjection` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `cntxstvarfpstat`
--

CREATE TABLE `cntxstvarfpstat` (
  `idStatDaticntxVar` int(11) NOT NULL,
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
  `filtr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `comp2stvarscorrstat`
--

CREATE TABLE `comp2stvarscorrstat` (
  `idComp2StVarsCorrStat` int(11) NOT NULL,
  `idRev` int(11) DEFAULT NULL,
  `idStVar1` int(11) DEFAULT NULL,
  `idStVar2` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `r` double DEFAULT NULL,
  `95CI` double DEFAULT NULL,
  `t` double DEFAULT NULL,
  `Spearman` double DEFAULT NULL,
  `Pearson` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `comp2stvarsindstat`
--

CREATE TABLE `comp2stvarsindstat` (
  `idComp2StVarsIndStat` int(11) NOT NULL,
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
  `verosimiglianza` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `compfpstat`
--

CREATE TABLE `compfpstat` (
  `idCompFpStat` int(11) NOT NULL,
  `idRev` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `modeRsd` double DEFAULT NULL,
  `minRsd` double DEFAULT NULL,
  `maxRsd` double DEFAULT NULL,
  `rmeanRsd` double DEFAULT NULL,
  `sdRsd` double DEFAULT NULL,
  `varRsd` double DEFAULT NULL,
  `varCoefRsd` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `compres2stvarscorrstat`
--

CREATE TABLE `compres2stvarscorrstat` (
  `idCompRes2StVarsCorrStat` int(11) NOT NULL,
  `idRev` int(11) DEFAULT NULL,
  `idStVar1` int(11) DEFAULT NULL,
  `idStVar2` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `r` double DEFAULT NULL,
  `95CI` double DEFAULT NULL,
  `t` double DEFAULT NULL,
  `Spearman` double DEFAULT NULL,
  `Pearson` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `compres2stvarsindstat`
--

CREATE TABLE `compres2stvarsindstat` (
  `idCompRes2StVarsIndStat` int(11) NOT NULL,
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
  `verosimiglianza` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `compresfpstat`
--

CREATE TABLE `compresfpstat` (
  `idCompResFpStat` int(11) NOT NULL,
  `idRev` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `modeRsd` double DEFAULT NULL,
  `minRsd` double DEFAULT NULL,
  `maxRsd` double DEFAULT NULL,
  `rmeanRsd` double DEFAULT NULL,
  `sdRsd` double DEFAULT NULL,
  `varRsd` double DEFAULT NULL,
  `varRsdCoef` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `descrcapstat`
--

CREATE TABLE `descrcapstat` (
  `idDescrCapStat` int(11) NOT NULL,
  `idTrainStVarFpStat` int(11) DEFAULT NULL,
  `idTrainResStVarFpStat` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `dMin` double DEFAULT NULL,
  `dMax` double DEFAULT NULL,
  `dMean` double DEFAULT NULL,
  `dSd` double DEFAULT NULL,
  `dVar` double DEFAULT NULL,
  `dVarCoef` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `evnt`
--

CREATE TABLE `evnt` (
  `idEvnt` int(11) NOT NULL,
  `idPrj` int(11) DEFAULT NULL,
  `idEvntCat` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `fileRefRepoDat` varchar(200) DEFAULT NULL,
  `fileRefEvntDat` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `evnt`
--

INSERT INTO `evnt` (`idEvnt`, `idPrj`, `idEvntCat`, `nam`, `descr`, `fileRefRepoDat`, `fileRefEvntDat`) VALUES
(1, 1, 7, 'evento test 1', 'evento test 1', 'DA/_FsBase/Dat/Evnt/AirPassengers.csv_da', NULL),
(4, NULL, NULL, 'aaa', NULL, NULL, NULL),
(5, NULL, NULL, 'sss', NULL, NULL, NULL),
(8, 2, 2, 'Airquality', 'Airquality', 'DA/_FsBase/Dat/Evnt/airquality.csv_da', NULL),
(9, NULL, 8, 'eee', NULL, 'DA/_FsBase/Dat/Evnt/AirPassengers.csv_da', NULL),
(10, NULL, 8, 'eee', NULL, 'DA/_FsBase/Dat/Evnt/AirPassengers.csv_da', NULL),
(11, NULL, 8, 'eee', NULL, 'DA/_FsBase/Dat/Evnt/AirPassengers.csv_da', NULL),
(12, NULL, 8, 'eee', NULL, 'DA/_FsBase/Dat/Evnt/airquality.csv_da', NULL),
(13, NULL, 8, 'eee', NULL, 'DA/_FsBase/Dat/Evnt/airmiles.csv_da', NULL),
(14, 3, 8, 'anscombe event', 'anscombe event description', 'DA/_FsBase/Dat/Evnt/anscombe.csv_da', NULL),
(15, 23, 5, 'eee', 'gggg', 'DA/_FsBase/Dat/Evnt/airmiles.csv_da', NULL),
(17, 15, 10, 'adults', 'Salary and annual income analysis', 'DA/_FsBase/Dat/Evnt/adults2.csv_da', NULL),
(18, 24, 9, 'att', 'The Joyner-Boore Attenuation Data', 'DA/_FsBase/Dat/Evnt/attenu.csv_da', NULL),
(19, 25, 11, 'attitude', NULL, 'DA/_FsBase/Dat/Evnt/attitude.csv_da', NULL),
(20, 26, 2, 'Diabete', 'Diabete', 'DA/_FsBase/Dat/Evnt/diabetes.csv_da', NULL),
(21, 4, NULL, 'autres', 'Quarterly Time Series of the Number of Australian Residents', 'DA/_FsBase/Dat/Evnt/austres.csv_da', NULL),
(23, 14, NULL, 'eee', NULL, 'DA/_FsBase/Dat/Evnt/BJsales.csv_da', NULL),
(24, 27, NULL, 'austres', 'Quarterly Time Series of the Number of Australian Residents', 'DA/_FsBase/Dat/Evnt/austres.csv_da', NULL),
(25, 28, 8, 'Cars', 'Speed, stopping distance', 'DA/_FsBase/Dat/Evnt/cars.csv_da', NULL),
(26, 29, 2, 'Chicken Weigth', 'Chicken Weigth', 'DA/_FsBase/Dat/Evnt/ChickWeight.csv_da', NULL),
(27, 30, 5, 'CO2', 'Mauna Loa Atmospheric CO2 Concentration', 'DA/_FsBase/Dat/Evnt/CO2.csv_da', NULL),
(28, 31, 5, 'Nile river flow', 'Nile river flow', 'DA/_FsBase/Dat/Evnt/Nile.csv_da', NULL),
(29, 32, NULL, 'Orange tree', 'Orange tree.\ncircumference=f(age)', 'DA/_FsBase/Dat/Evnt/Orange.csv_da', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `evntanom`
--

CREATE TABLE `evntanom` (
  `idEvntStVarAnom` int(11) NOT NULL,
  `idEvnt` int(11) DEFAULT NULL,
  `nAnom` int(11) DEFAULT NULL,
  `nNA` int(11) DEFAULT NULL,
  `nErr` int(11) DEFAULT NULL,
  `nOtherAnom` int(11) DEFAULT NULL,
  `nCorrections` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `evntcat`
--

CREATE TABLE `evntcat` (
  `idEvntCat` int(11) NOT NULL,
  `idEvntCatPar` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `evntstrucstat` (
  `idEvntStrucStat` int(11) NOT NULL,
  `idEvnt` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nCols` int(11) DEFAULT NULL,
  `nRows` int(11) DEFAULT NULL,
  `colTypes` text DEFAULT NULL,
  `units` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `evntstvaranom`
--

CREATE TABLE `evntstvaranom` (
  `idEvntStVarAnom` int(11) NOT NULL,
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
  `correctionsMap` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `explcapstat`
--

CREATE TABLE `explcapstat` (
  `idExplCapStat` int(11) NOT NULL,
  `idComp2StVarsCorrStat` int(11) DEFAULT NULL,
  `idCompRes2StVarsCorrStat` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `dr` double DEFAULT NULL,
  `d95CI` double DEFAULT NULL,
  `dt` double DEFAULT NULL,
  `dSpearman` double DEFAULT NULL,
  `dPearson` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `opdat`
--

CREATE TABLE `opdat` (
  `idOpDat` int(11) NOT NULL,
  `idClean` int(11) DEFAULT NULL,
  `idOpDatCat` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `execOr` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `opdatcat`
--

CREATE TABLE `opdatcat` (
  `idOpDatCat` int(11) NOT NULL,
  `idOpDatCatPar` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `opdatcat`
--

INSERT INTO `opdatcat` (`idOpDatCat`, `idOpDatCatPar`, `nam`, `descr`) VALUES
(1, NULL, 'Insert', NULL),
(2, NULL, 'Update', NULL),
(3, NULL, 'Delete', NULL),
(4, NULL, 'Select', NULL),
(5, NULL, 'Order', NULL),
(6, NULL, 'Auto Correction', NULL),
(7, NULL, 'Interpolation', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `opdatparam`
--

CREATE TABLE `opdatparam` (
  `idTestParam` int(11) NOT NULL,
  `idOpDat` int(11) DEFAULT NULL,
  `idParamType` int(11) DEFAULT NULL,
  `vl` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `opdatparamtype`
--

CREATE TABLE `opdatparamtype` (
  `idOpDatParamType` int(11) NOT NULL,
  `idOpDat` int(11) DEFAULT NULL,
  `idParamType` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `paramtype`
--

CREATE TABLE `paramtype` (
  `idParamType` int(11) NOT NULL,
  `idParamTypeCat` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `vlDefault` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `paramtypecat` (
  `idParamTypeCat` int(11) NOT NULL,
  `idParamTypeCatPar` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `paramtypecat`
--

INSERT INTO `paramtypecat` (`idParamTypeCat`, `idParamTypeCatPar`, `nam`, `descr`) VALUES
(1, 12, 'Length', 'distance, displacement, length, height'),
(2, 12, 'Mass', NULL),
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

CREATE TABLE `predcapstat` (
  `idPredCapStat` int(11) NOT NULL,
  `idTestStVarFpStat` int(11) DEFAULT NULL,
  `idTestResStVarFpStat` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `dMin` double DEFAULT NULL,
  `dMax` double DEFAULT NULL,
  `dMean` double DEFAULT NULL,
  `dSd` double DEFAULT NULL,
  `dVar` double DEFAULT NULL,
  `dVarCoef` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prj`
--

CREATE TABLE `prj` (
  `idPrj` int(11) NOT NULL,
  `idUsr` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `folderRef` varchar(200) DEFAULT NULL,
  `idPrjState` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prj`
--

INSERT INTO `prj` (`idPrj`, `idUsr`, `nam`, `descr`, `folderRef`, `idPrjState`) VALUES
(1, 1, 'AirPassengers', 'AirPassengers', NULL, 5),
(2, 1, 'air quality', 'air quality', NULL, 5),
(3, 1, 'anscombe', 'anscombe prj', NULL, 4),
(4, 1, 'prj4', NULL, NULL, 2),
(14, 1, 'ggg', NULL, NULL, 2),
(15, 1, 'Adults', 'Adults analysis', NULL, 5),
(23, 1, 'airmiles', 'airmiles', NULL, 4),
(24, 8, 'Attenuation ', 'The Joyner-Boore Attenuation Data', NULL, 5),
(25, 8, 'Attitude ', 'The Chatterjee–Price Attitude Data.\nhttps://stat.ethz.ch/R-manual/R-devel/library/datasets/html/attitude.html\nFrom a survey of the clerical employees of a large financial organization, the data are aggregated from the questionnaires of the approximately 35 employees for each of 30 (randomly selected) departments. The numbers give the percent proportion of favourable responses to seven questions in each department.\n', NULL, 5),
(26, 8, 'Diabete', 'Diabete', NULL, 5),
(27, 8, 'Australian Residents', 'Quarterly Time Series of the Number of Australian Residents', NULL, 4),
(28, 8, 'Cars', 'Speed and Stopping Distances of Cars', NULL, 5),
(29, 8, 'ChickWeight', 'Weight versus age of chicks on different diets', NULL, 4),
(30, 8, 'co2', 'Mauna Loa Atmospheric CO2 Concentration', NULL, 5),
(31, 8, 'Nile', 'Flow of the River Nile', NULL, 4),
(32, 8, 'Orange', 'Growth of Orange Trees', NULL, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `prjan`
--

CREATE TABLE `prjan` (
  `idPrj` int(11) NOT NULL,
  `idAn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prjstate`
--

CREATE TABLE `prjstate` (
  `idPrjState` int(11) NOT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prjstate`
--

INSERT INTO `prjstate` (`idPrjState`, `nam`, `descr`) VALUES
(1, 'New', 'New Prj'),
(2, 'Evnt', 'Event'),
(3, 'Cntx', 'Context'),
(4, 'An', 'Analysis'),
(5, 'Rev', 'Review'),
(6, 'Rnk', 'Ranking or standardization'),
(7, 'NA', 'Not Available or Not Active');

-- --------------------------------------------------------

--
-- Struttura della tabella `rev`
--

CREATE TABLE `rev` (
  `IdRev` int(11) NOT NULL,
  `IdAn` int(11) DEFAULT NULL,
  `Note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `rev`
--

INSERT INTO `rev` (`IdRev`, `IdAn`, `Note`) VALUES
(2, 5, 'new review'),
(3, 4, 'rev'),
(4, 1, 'rev'),
(5, 8, 'Valutazione di\nMAE\nRMSE\nR2\n----------------------------------------------\nValutazione della qualità di previsione\nrispetto alla variabile:\nPregnancies:\nSkinThickness:\nAge:\n'),
(6, 7, 'Valutazione di\nMAE\nRMSE\nR2\n----------------------------------------------\nValutazione della qualità di previsione\nevent:\nrispetto alla variabile:\nmag:\ndis:\naccel:\n'),
(7, 9, 'Valutazione di\nMAE:\nRMSE:\nR2:\n ----------------------------------------------\n Valutazione della qualità di previsione\n Outcome:\n rispetto alla variabile:\n Var1:\n Var2:\n Var3:'),
(8, 11, 'Valutazione di\nMAE:\nRMSE:\nR2:\n ----------------------------------------------\n Valutazione della qualità di previsione\n dist:\n rispetto alla variabile:\n speed:\n '),
(9, 13, 'Valutazione di\nMAE:\nRMSE:\nR2:\n ----------------------------------------------\n Valutazione della qualità di previsione\n Outcome:\n rispetto alla variabile:\n Var1:\n Var2:\n Var3:');

-- --------------------------------------------------------

--
-- Struttura della tabella `rnk`
--

CREATE TABLE `rnk` (
  `idRnk` int(11) NOT NULL,
  `idAn` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `spacedavl`
--

CREATE TABLE `spacedavl` (
  `idSpaceDAVl` int(11) NOT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `ordine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `split`
--

CREATE TABLE `split` (
  `idSplit` int(11) NOT NULL,
  `idSplitType` int(11) DEFAULT NULL,
  `idCntxAn` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `splitcat`
--

CREATE TABLE `splitcat` (
  `idSplitCat` int(11) NOT NULL,
  `idSplitCatPar` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `splitcat`
--

INSERT INTO `splitcat` (`idSplitCat`, `idSplitCatPar`, `nam`, `descr`) VALUES
(1, NULL, 'Percentage', 'Percentage'),
(2, NULL, 'Condition', 'Condition'),
(9, NULL, 'Position', 'Position');

-- --------------------------------------------------------

--
-- Struttura della tabella `splitparam`
--

CREATE TABLE `splitparam` (
  `idSplitParam` int(11) NOT NULL,
  `idSplit` int(11) DEFAULT NULL,
  `idParamType` int(11) DEFAULT NULL,
  `vl` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `splitparamtype`
--

CREATE TABLE `splitparamtype` (
  `idSplitParamType` int(11) NOT NULL,
  `idSplit` int(11) DEFAULT NULL,
  `idParamType` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `splittype`
--

CREATE TABLE `splittype` (
  `IdSplitType` int(11) NOT NULL,
  `IdSplitCat` int(11) DEFAULT NULL,
  `Nam` varchar(50) DEFAULT NULL,
  `Descr` text DEFAULT NULL,
  `Perc` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `stvar` (
  `idStVar` int(11) NOT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `stvarcat`
--

CREATE TABLE `stvarcat` (
  `idStVarCat` int(11) NOT NULL,
  `idStVarCatPar` int(11) DEFAULT NULL,
  `nam` varchar(50) DEFAULT NULL,
  `descr` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `stvarcat`
--

INSERT INTO `stvarcat` (`idStVarCat`, `idStVarCatPar`, `nam`, `descr`) VALUES
(1, NULL, 'Economical', NULL),
(2, NULL, 'Engineering', NULL),
(3, NULL, 'Social', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `test`
--

CREATE TABLE `test` (
  `idTest` int(11) NOT NULL,
  `idAn` int(11) DEFAULT NULL,
  `fileRefTestDat` varchar(200) DEFAULT NULL,
  `fileRefTestRsdat` varchar(200) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `test`
--

INSERT INTO `test` (`idTest`, `idAn`, `fileRefTestDat`, `fileRefTestRsdat`, `note`) VALUES
(1, 1, NULL, NULL, 'test 1');

-- --------------------------------------------------------

--
-- Struttura della tabella `testparam`
--

CREATE TABLE `testparam` (
  `idTestParam` int(11) NOT NULL,
  `idAlgAn` int(11) DEFAULT NULL,
  `idParamType` int(11) DEFAULT NULL,
  `idTest` int(11) DEFAULT NULL,
  `vl` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `testresstrucstat`
--

CREATE TABLE `testresstrucstat` (
  `idTestResStrucStat` int(11) NOT NULL,
  `idTest` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nCols` int(11) DEFAULT NULL,
  `nRows` int(11) DEFAULT NULL,
  `colTypes` text DEFAULT NULL,
  `units` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `testresstvarasimstat`
--

CREATE TABLE `testresstvarasimstat` (
  `idTestResStVarAsimStat` int(11) NOT NULL,
  `idTest` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `aritMode` double DEFAULT NULL,
  `coefPearson1` double DEFAULT NULL,
  `coefPearson2` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `testresstvarcentresstat`
--

CREATE TABLE `testresstvarcentresstat` (
  `idTestResStVarCentresStat` int(11) NOT NULL,
  `idTest` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `arit` double DEFAULT NULL,
  `geom` double DEFAULT NULL,
  `quad` double DEFAULT NULL,
  `harm` double DEFAULT NULL,
  `MODE` double DEFAULT NULL,
  `med` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `testresstvarfpstat`
--

CREATE TABLE `testresstvarfpstat` (
  `idTestResStVarFpStat` int(11) NOT NULL,
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
  `varCoef` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `teststrucstat`
--

CREATE TABLE `teststrucstat` (
  `idTestStrucStat` int(11) NOT NULL,
  `idTest` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nCols` int(11) DEFAULT NULL,
  `nRows` int(11) DEFAULT NULL,
  `colTypes` text DEFAULT NULL,
  `units` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `teststvarasimstat`
--

CREATE TABLE `teststvarasimstat` (
  `idTestStVarAsimStat` int(11) NOT NULL,
  `idTest` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `aritMode` double DEFAULT NULL,
  `coefPearson1` double DEFAULT NULL,
  `coefPearson2` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `teststvarfpstat`
--

CREATE TABLE `teststvarfpstat` (
  `idTestStVarFpStat` int(11) NOT NULL,
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
  `varCoef` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `train`
--

CREATE TABLE `train` (
  `idTrain` int(11) NOT NULL,
  `idAn` int(11) DEFAULT NULL,
  `fileRefTrainDat` varchar(200) DEFAULT NULL,
  `fileRefTrainRsdat` varchar(200) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `train`
--

INSERT INTO `train` (`idTrain`, `idAn`, `fileRefTrainDat`, `fileRefTrainRsdat`, `note`) VALUES
(1, 1, NULL, NULL, 'training 1');

-- --------------------------------------------------------

--
-- Struttura della tabella `trainparam`
--

CREATE TABLE `trainparam` (
  `idTrainParam` int(11) NOT NULL,
  `idAlgAn` int(11) DEFAULT NULL,
  `idParamType` int(11) DEFAULT NULL,
  `idTrain` int(11) DEFAULT NULL,
  `vl` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trainresstrucstat`
--

CREATE TABLE `trainresstrucstat` (
  `idTrainResStrucStat` int(11) NOT NULL,
  `idTrain` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nCols` int(11) DEFAULT NULL,
  `nRows` int(11) DEFAULT NULL,
  `colTypes` text DEFAULT NULL,
  `units` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trainresstvarasimstat`
--

CREATE TABLE `trainresstvarasimstat` (
  `idTrainResStVarAsimStat` int(11) NOT NULL,
  `idTrain` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `aritMode` double DEFAULT NULL,
  `coefPearson1` double DEFAULT NULL,
  `coefPearson2` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trainresstvarcentresstat`
--

CREATE TABLE `trainresstvarcentresstat` (
  `idTrainResStVarCentresStat` int(11) NOT NULL,
  `idTrain` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `arit` double DEFAULT NULL,
  `geom` double DEFAULT NULL,
  `quad` double DEFAULT NULL,
  `harm` double DEFAULT NULL,
  `MODE` double DEFAULT NULL,
  `med` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trainresstvarfpstat`
--

CREATE TABLE `trainresstvarfpstat` (
  `idTrainResStVarFpStat` int(11) NOT NULL,
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
  `varCoef` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trainstrucstat`
--

CREATE TABLE `trainstrucstat` (
  `idTrainStrucStat` int(11) NOT NULL,
  `idTrain` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `nCols` int(11) DEFAULT NULL,
  `nRows` int(11) DEFAULT NULL,
  `colTypes` text DEFAULT NULL,
  `units` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trainstvarasimstat`
--

CREATE TABLE `trainstvarasimstat` (
  `idTrainStVarAsimStat` int(11) NOT NULL,
  `idTrain` int(11) DEFAULT NULL,
  `idStVar` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `aritMode` double DEFAULT NULL,
  `coefPearson1` double DEFAULT NULL,
  `coefPearson2` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `trainstvarfpstat`
--

CREATE TABLE `trainstvarfpstat` (
  `idTrainStVarFpStat` int(11) NOT NULL,
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
  `varCoef` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `usr`
--

CREATE TABLE `usr` (
  `idUsr` int(11) NOT NULL,
  `usrNam` varchar(30) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `firstnam` varchar(50) NOT NULL,
  `nam` varchar(50) NOT NULL,
  `eMail` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `usr`
--

INSERT INTO `usr` (`idUsr`, `usrNam`, `pwd`, `firstnam`, `nam`, `eMail`) VALUES
(1, 'dev', 'dev', 'Arcangeli', 'Marco', 'dev.dev@gmail.com'),
(3, 'User1', 'User1', 'User1', 'User1', 'user1.user1@gmail.com'),
(7, 'Prof', 'Prof', 'Prof', 'Prof', 'prof.prof@prof.a'),
(8, 'Guest', 'Guest', 'Guest', 'Guest', 'Guest@Guest.h');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `alg`
--
ALTER TABLE `alg`
  ADD PRIMARY KEY (`idAlg`);

--
-- Indici per le tabelle `algcat`
--
ALTER TABLE `algcat`
  ADD PRIMARY KEY (`idAlgCat`);

--
-- Indici per le tabelle `algcntxrnk`
--
ALTER TABLE `algcntxrnk`
  ADD PRIMARY KEY (`idAlgCntxRnk`);

--
-- Indici per le tabelle `algcntxrnknorm`
--
ALTER TABLE `algcntxrnknorm`
  ADD PRIMARY KEY (`idAlgCntxRnkNorm`);

--
-- Indici per le tabelle `algdavl`
--
ALTER TABLE `algdavl`
  ADD PRIMARY KEY (`idAlgDAVl`);

--
-- Indici per le tabelle `algparam`
--
ALTER TABLE `algparam`
  ADD PRIMARY KEY (`idAlgParam`);

--
-- Indici per le tabelle `algparamtest`
--
ALTER TABLE `algparamtest`
  ADD PRIMARY KEY (`idAlgParamtest`);

--
-- Indici per le tabelle `algparamtype`
--
ALTER TABLE `algparamtype`
  ADD PRIMARY KEY (`IdAlgParamType`);

--
-- Indici per le tabelle `algrnk`
--
ALTER TABLE `algrnk`
  ADD PRIMARY KEY (`idAlgRnk`);

--
-- Indici per le tabelle `algstate`
--
ALTER TABLE `algstate`
  ADD PRIMARY KEY (`idAlgState`);

--
-- Indici per le tabelle `algtrainparam`
--
ALTER TABLE `algtrainparam`
  ADD PRIMARY KEY (`idAlgTrainParam`);

--
-- Indici per le tabelle `algtypeparam`
--
ALTER TABLE `algtypeparam`
  ADD PRIMARY KEY (`idAlgParamType`);

--
-- Indici per le tabelle `an`
--
ALTER TABLE `an`
  ADD PRIMARY KEY (`idAn`);

--
-- Indici per le tabelle `ancntx`
--
ALTER TABLE `ancntx`
  ADD PRIMARY KEY (`IdAnCntx`);

--
-- Indici per le tabelle `ancntxstrucstat`
--
ALTER TABLE `ancntxstrucstat`
  ADD PRIMARY KEY (`idStatDatiAnCntx`);

--
-- Indici per le tabelle `ancntxstvarfpstat`
--
ALTER TABLE `ancntxstvarfpstat`
  ADD PRIMARY KEY (`IdAnCntxStVarFpStat`);

--
-- Indici per le tabelle `clean`
--
ALTER TABLE `clean`
  ADD PRIMARY KEY (`idClean`);

--
-- Indici per le tabelle `cntx`
--
ALTER TABLE `cntx`
  ADD PRIMARY KEY (`idCntx`);

--
-- Indici per le tabelle `cntxstrucstat`
--
ALTER TABLE `cntxstrucstat`
  ADD PRIMARY KEY (`idCntxStrucStat`);

--
-- Indici per le tabelle `cntxstvarfpstat`
--
ALTER TABLE `cntxstvarfpstat`
  ADD PRIMARY KEY (`idStatDaticntxVar`);

--
-- Indici per le tabelle `comp2stvarscorrstat`
--
ALTER TABLE `comp2stvarscorrstat`
  ADD PRIMARY KEY (`idComp2StVarsCorrStat`);

--
-- Indici per le tabelle `comp2stvarsindstat`
--
ALTER TABLE `comp2stvarsindstat`
  ADD PRIMARY KEY (`idComp2StVarsIndStat`);

--
-- Indici per le tabelle `compfpstat`
--
ALTER TABLE `compfpstat`
  ADD PRIMARY KEY (`idCompFpStat`);

--
-- Indici per le tabelle `compres2stvarscorrstat`
--
ALTER TABLE `compres2stvarscorrstat`
  ADD PRIMARY KEY (`idCompRes2StVarsCorrStat`);

--
-- Indici per le tabelle `compres2stvarsindstat`
--
ALTER TABLE `compres2stvarsindstat`
  ADD PRIMARY KEY (`idCompRes2StVarsIndStat`);

--
-- Indici per le tabelle `compresfpstat`
--
ALTER TABLE `compresfpstat`
  ADD PRIMARY KEY (`idCompResFpStat`);

--
-- Indici per le tabelle `descrcapstat`
--
ALTER TABLE `descrcapstat`
  ADD PRIMARY KEY (`idDescrCapStat`);

--
-- Indici per le tabelle `evnt`
--
ALTER TABLE `evnt`
  ADD PRIMARY KEY (`idEvnt`);

--
-- Indici per le tabelle `evntanom`
--
ALTER TABLE `evntanom`
  ADD PRIMARY KEY (`idEvntStVarAnom`);

--
-- Indici per le tabelle `evntcat`
--
ALTER TABLE `evntcat`
  ADD PRIMARY KEY (`idEvntCat`);

--
-- Indici per le tabelle `evntstrucstat`
--
ALTER TABLE `evntstrucstat`
  ADD PRIMARY KEY (`idEvntStrucStat`);

--
-- Indici per le tabelle `evntstvaranom`
--
ALTER TABLE `evntstvaranom`
  ADD PRIMARY KEY (`idEvntStVarAnom`);

--
-- Indici per le tabelle `explcapstat`
--
ALTER TABLE `explcapstat`
  ADD PRIMARY KEY (`idExplCapStat`);

--
-- Indici per le tabelle `opdat`
--
ALTER TABLE `opdat`
  ADD PRIMARY KEY (`idOpDat`);

--
-- Indici per le tabelle `opdatcat`
--
ALTER TABLE `opdatcat`
  ADD PRIMARY KEY (`idOpDatCat`);

--
-- Indici per le tabelle `opdatparam`
--
ALTER TABLE `opdatparam`
  ADD PRIMARY KEY (`idTestParam`);

--
-- Indici per le tabelle `opdatparamtype`
--
ALTER TABLE `opdatparamtype`
  ADD PRIMARY KEY (`idOpDatParamType`);

--
-- Indici per le tabelle `paramtype`
--
ALTER TABLE `paramtype`
  ADD PRIMARY KEY (`idParamType`);

--
-- Indici per le tabelle `paramtypecat`
--
ALTER TABLE `paramtypecat`
  ADD PRIMARY KEY (`idParamTypeCat`);

--
-- Indici per le tabelle `predcapstat`
--
ALTER TABLE `predcapstat`
  ADD PRIMARY KEY (`idPredCapStat`);

--
-- Indici per le tabelle `prj`
--
ALTER TABLE `prj`
  ADD PRIMARY KEY (`idPrj`);

--
-- Indici per le tabelle `prjstate`
--
ALTER TABLE `prjstate`
  ADD PRIMARY KEY (`idPrjState`);

--
-- Indici per le tabelle `rev`
--
ALTER TABLE `rev`
  ADD PRIMARY KEY (`IdRev`);

--
-- Indici per le tabelle `rnk`
--
ALTER TABLE `rnk`
  ADD PRIMARY KEY (`idRnk`);

--
-- Indici per le tabelle `spacedavl`
--
ALTER TABLE `spacedavl`
  ADD PRIMARY KEY (`idSpaceDAVl`);

--
-- Indici per le tabelle `split`
--
ALTER TABLE `split`
  ADD PRIMARY KEY (`idSplit`);

--
-- Indici per le tabelle `splitcat`
--
ALTER TABLE `splitcat`
  ADD PRIMARY KEY (`idSplitCat`);

--
-- Indici per le tabelle `splitparam`
--
ALTER TABLE `splitparam`
  ADD PRIMARY KEY (`idSplitParam`);

--
-- Indici per le tabelle `splitparamtype`
--
ALTER TABLE `splitparamtype`
  ADD PRIMARY KEY (`idSplitParamType`);

--
-- Indici per le tabelle `splittype`
--
ALTER TABLE `splittype`
  ADD PRIMARY KEY (`IdSplitType`);

--
-- Indici per le tabelle `stvar`
--
ALTER TABLE `stvar`
  ADD PRIMARY KEY (`idStVar`);

--
-- Indici per le tabelle `stvarcat`
--
ALTER TABLE `stvarcat`
  ADD PRIMARY KEY (`idStVarCat`);

--
-- Indici per le tabelle `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`idTest`);

--
-- Indici per le tabelle `testparam`
--
ALTER TABLE `testparam`
  ADD PRIMARY KEY (`idTestParam`);

--
-- Indici per le tabelle `testresstrucstat`
--
ALTER TABLE `testresstrucstat`
  ADD PRIMARY KEY (`idTestResStrucStat`);

--
-- Indici per le tabelle `testresstvarasimstat`
--
ALTER TABLE `testresstvarasimstat`
  ADD PRIMARY KEY (`idTestResStVarAsimStat`);

--
-- Indici per le tabelle `testresstvarcentresstat`
--
ALTER TABLE `testresstvarcentresstat`
  ADD PRIMARY KEY (`idTestResStVarCentresStat`);

--
-- Indici per le tabelle `testresstvarfpstat`
--
ALTER TABLE `testresstvarfpstat`
  ADD PRIMARY KEY (`idTestResStVarFpStat`);

--
-- Indici per le tabelle `teststrucstat`
--
ALTER TABLE `teststrucstat`
  ADD PRIMARY KEY (`idTestStrucStat`);

--
-- Indici per le tabelle `teststvarasimstat`
--
ALTER TABLE `teststvarasimstat`
  ADD PRIMARY KEY (`idTestStVarAsimStat`);

--
-- Indici per le tabelle `teststvarfpstat`
--
ALTER TABLE `teststvarfpstat`
  ADD PRIMARY KEY (`idTestStVarFpStat`);

--
-- Indici per le tabelle `train`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`idTrain`);

--
-- Indici per le tabelle `trainparam`
--
ALTER TABLE `trainparam`
  ADD PRIMARY KEY (`idTrainParam`);

--
-- Indici per le tabelle `trainresstrucstat`
--
ALTER TABLE `trainresstrucstat`
  ADD PRIMARY KEY (`idTrainResStrucStat`);

--
-- Indici per le tabelle `trainresstvarasimstat`
--
ALTER TABLE `trainresstvarasimstat`
  ADD PRIMARY KEY (`idTrainResStVarAsimStat`);

--
-- Indici per le tabelle `trainresstvarcentresstat`
--
ALTER TABLE `trainresstvarcentresstat`
  ADD PRIMARY KEY (`idTrainResStVarCentresStat`);

--
-- Indici per le tabelle `trainresstvarfpstat`
--
ALTER TABLE `trainresstvarfpstat`
  ADD PRIMARY KEY (`idTrainResStVarFpStat`);

--
-- Indici per le tabelle `trainstrucstat`
--
ALTER TABLE `trainstrucstat`
  ADD PRIMARY KEY (`idTrainStrucStat`);

--
-- Indici per le tabelle `trainstvarasimstat`
--
ALTER TABLE `trainstvarasimstat`
  ADD PRIMARY KEY (`idTrainStVarAsimStat`);

--
-- Indici per le tabelle `trainstvarfpstat`
--
ALTER TABLE `trainstvarfpstat`
  ADD PRIMARY KEY (`idTrainStVarFpStat`);

--
-- Indici per le tabelle `usr`
--
ALTER TABLE `usr`
  ADD PRIMARY KEY (`idUsr`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `alg`
--
ALTER TABLE `alg`
  MODIFY `idAlg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `algcat`
--
ALTER TABLE `algcat`
  MODIFY `idAlgCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT per la tabella `algcntxrnk`
--
ALTER TABLE `algcntxrnk`
  MODIFY `idAlgCntxRnk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `algcntxrnknorm`
--
ALTER TABLE `algcntxrnknorm`
  MODIFY `idAlgCntxRnkNorm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `algdavl`
--
ALTER TABLE `algdavl`
  MODIFY `idAlgDAVl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `algparam`
--
ALTER TABLE `algparam`
  MODIFY `idAlgParam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `algparamtest`
--
ALTER TABLE `algparamtest`
  MODIFY `idAlgParamtest` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `algparamtype`
--
ALTER TABLE `algparamtype`
  MODIFY `IdAlgParamType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `algrnk`
--
ALTER TABLE `algrnk`
  MODIFY `idAlgRnk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `algstate`
--
ALTER TABLE `algstate`
  MODIFY `idAlgState` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `algtrainparam`
--
ALTER TABLE `algtrainparam`
  MODIFY `idAlgTrainParam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `algtypeparam`
--
ALTER TABLE `algtypeparam`
  MODIFY `idAlgParamType` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `an`
--
ALTER TABLE `an`
  MODIFY `idAn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `ancntx`
--
ALTER TABLE `ancntx`
  MODIFY `IdAnCntx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `ancntxstrucstat`
--
ALTER TABLE `ancntxstrucstat`
  MODIFY `idStatDatiAnCntx` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ancntxstvarfpstat`
--
ALTER TABLE `ancntxstvarfpstat`
  MODIFY `IdAnCntxStVarFpStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `clean`
--
ALTER TABLE `clean`
  MODIFY `idClean` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `cntx`
--
ALTER TABLE `cntx`
  MODIFY `idCntx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `cntxstrucstat`
--
ALTER TABLE `cntxstrucstat`
  MODIFY `idCntxStrucStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `cntxstvarfpstat`
--
ALTER TABLE `cntxstvarfpstat`
  MODIFY `idStatDaticntxVar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `comp2stvarscorrstat`
--
ALTER TABLE `comp2stvarscorrstat`
  MODIFY `idComp2StVarsCorrStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `comp2stvarsindstat`
--
ALTER TABLE `comp2stvarsindstat`
  MODIFY `idComp2StVarsIndStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `compfpstat`
--
ALTER TABLE `compfpstat`
  MODIFY `idCompFpStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `compres2stvarscorrstat`
--
ALTER TABLE `compres2stvarscorrstat`
  MODIFY `idCompRes2StVarsCorrStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `compres2stvarsindstat`
--
ALTER TABLE `compres2stvarsindstat`
  MODIFY `idCompRes2StVarsIndStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `compresfpstat`
--
ALTER TABLE `compresfpstat`
  MODIFY `idCompResFpStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `descrcapstat`
--
ALTER TABLE `descrcapstat`
  MODIFY `idDescrCapStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `evnt`
--
ALTER TABLE `evnt`
  MODIFY `idEvnt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT per la tabella `evntanom`
--
ALTER TABLE `evntanom`
  MODIFY `idEvntStVarAnom` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `evntcat`
--
ALTER TABLE `evntcat`
  MODIFY `idEvntCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `evntstrucstat`
--
ALTER TABLE `evntstrucstat`
  MODIFY `idEvntStrucStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `evntstvaranom`
--
ALTER TABLE `evntstvaranom`
  MODIFY `idEvntStVarAnom` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `explcapstat`
--
ALTER TABLE `explcapstat`
  MODIFY `idExplCapStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `opdat`
--
ALTER TABLE `opdat`
  MODIFY `idOpDat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `opdatcat`
--
ALTER TABLE `opdatcat`
  MODIFY `idOpDatCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `opdatparam`
--
ALTER TABLE `opdatparam`
  MODIFY `idTestParam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `opdatparamtype`
--
ALTER TABLE `opdatparamtype`
  MODIFY `idOpDatParamType` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `paramtype`
--
ALTER TABLE `paramtype`
  MODIFY `idParamType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `paramtypecat`
--
ALTER TABLE `paramtypecat`
  MODIFY `idParamTypeCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `predcapstat`
--
ALTER TABLE `predcapstat`
  MODIFY `idPredCapStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prj`
--
ALTER TABLE `prj`
  MODIFY `idPrj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT per la tabella `prjstate`
--
ALTER TABLE `prjstate`
  MODIFY `idPrjState` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `rev`
--
ALTER TABLE `rev`
  MODIFY `IdRev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `rnk`
--
ALTER TABLE `rnk`
  MODIFY `idRnk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `spacedavl`
--
ALTER TABLE `spacedavl`
  MODIFY `idSpaceDAVl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `split`
--
ALTER TABLE `split`
  MODIFY `idSplit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `splitcat`
--
ALTER TABLE `splitcat`
  MODIFY `idSplitCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `splitparam`
--
ALTER TABLE `splitparam`
  MODIFY `idSplitParam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `splitparamtype`
--
ALTER TABLE `splitparamtype`
  MODIFY `idSplitParamType` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `splittype`
--
ALTER TABLE `splittype`
  MODIFY `IdSplitType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `stvar`
--
ALTER TABLE `stvar`
  MODIFY `idStVar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `stvarcat`
--
ALTER TABLE `stvarcat`
  MODIFY `idStVarCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `test`
--
ALTER TABLE `test`
  MODIFY `idTest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `testparam`
--
ALTER TABLE `testparam`
  MODIFY `idTestParam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `testresstrucstat`
--
ALTER TABLE `testresstrucstat`
  MODIFY `idTestResStrucStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `testresstvarasimstat`
--
ALTER TABLE `testresstvarasimstat`
  MODIFY `idTestResStVarAsimStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `testresstvarcentresstat`
--
ALTER TABLE `testresstvarcentresstat`
  MODIFY `idTestResStVarCentresStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `testresstvarfpstat`
--
ALTER TABLE `testresstvarfpstat`
  MODIFY `idTestResStVarFpStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `teststrucstat`
--
ALTER TABLE `teststrucstat`
  MODIFY `idTestStrucStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `teststvarasimstat`
--
ALTER TABLE `teststvarasimstat`
  MODIFY `idTestStVarAsimStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `teststvarfpstat`
--
ALTER TABLE `teststvarfpstat`
  MODIFY `idTestStVarFpStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `train`
--
ALTER TABLE `train`
  MODIFY `idTrain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `trainparam`
--
ALTER TABLE `trainparam`
  MODIFY `idTrainParam` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `trainresstrucstat`
--
ALTER TABLE `trainresstrucstat`
  MODIFY `idTrainResStrucStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `trainresstvarasimstat`
--
ALTER TABLE `trainresstvarasimstat`
  MODIFY `idTrainResStVarAsimStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `trainresstvarcentresstat`
--
ALTER TABLE `trainresstvarcentresstat`
  MODIFY `idTrainResStVarCentresStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `trainresstvarfpstat`
--
ALTER TABLE `trainresstvarfpstat`
  MODIFY `idTrainResStVarFpStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `trainstrucstat`
--
ALTER TABLE `trainstrucstat`
  MODIFY `idTrainStrucStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `trainstvarasimstat`
--
ALTER TABLE `trainstvarasimstat`
  MODIFY `idTrainStVarAsimStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `trainstvarfpstat`
--
ALTER TABLE `trainstvarfpstat`
  MODIFY `idTrainStVarFpStat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `usr`
--
ALTER TABLE `usr`
  MODIFY `idUsr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
  

--
-- DELETE DEMO DATA to reserve ids
--
--
-- Dump dei dati per la tabella `an`
--

DELETE FROM `an` WHERE `idAn` IN (8, 9, 10,11,12,14,15);

-- --------------------------------------------------------
--
-- DELETE dei dati per la tabella `ancntx`
--

DELETE FROM `ancntx` WHERE `IdAnCntx` IN (9, 10, 11, 12, 14, 15);

-- --------------------------------------------------------
--
-- DELETE dei dati per la tabella `clean`
--

DELETE FROM `clean` WHERE `idClean` IN (8, 10,11,12,13,14,15);

-- --------------------------------------------------------
--
-- DELETE dei dati per la tabella `cntx`
--

DELETE FROM `cntx` WHERE `idCntx` IN (9, 13,14,15,16,17,18);

-- --------------------------------------------------------
--
-- DELETE dei dati per la tabella `evnt`
--

DELETE FROM `evnt` WHERE `idEvnt` IN (20, 24, 25, 26, 27, 28, 29);

-- --------------------------------------------------------
--
-- DELETE dei dati per la tabella `prj`
--

DELETE FROM `prj` WHERE `idPrj` IN (26, 27, 28, 29, 30, 31, 32);

-- --------------------------------------------------------
--
-- DELETE dei dati per la tabella `rev`
--

DELETE FROM `rev` WHERE `IdRev` IN (5, 7, 8, 9);

-- --------------------------------------------------------
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
