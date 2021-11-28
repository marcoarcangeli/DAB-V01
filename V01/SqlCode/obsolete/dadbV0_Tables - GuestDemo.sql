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

--
-- Database: `dadb`
--

-- --------------------------------------------------------


--
-- Dump dei dati per la tabella `an`
--

INSERT INTO `an` (`idAn`, `idPrj`, `idAlg`, `nam`, `descr`) VALUES
(8, 26, 1, 'Diabete analisi', 'Analisi Regressione Lineare.\nDiabets (Pregnancies, SkinThickness, Age)'),
(9, 30, 1, 'Analiksi Regrssione Lineare', 'regressione linea su singola variabile: x'),
(10, 27, 1, 'lm analysis', 'linear regression'),
(11, 28, 1, '2 vars analysis', '2 vars analysis'),
(12, 29, 1, 'w=f(t,d)', 'weight=f(time, diet)'),
(14, 31, 1, 'Nile river flow', 'Nile river flow.\nSingle variable.'),
(15, 32, 1, 'Linear Regressione', 'circumference=f(age)');

-- --------------------------------------------------------


--
-- Dump dei dati per la tabella `ancntx`
--

INSERT INTO `ancntx` (`IdAnCntx`, `IdAn`, `IdCntx`, `IdSplitType`, `nam`, `descr`, `fileRefTrainDat`, `fileRefTestDat`, `Regr_Outcome`, `Regr_Vars`, `Regr_CtrlMethod`, `Regr_ModelMethods`) VALUES
(9, 8, 9, 1, 'Diabete contesto di analisi', 'Diabete contesto di analisi.\noutcome=Diabets (Pregnancies, SkinThickness, Age)', 'diabetes_autoclean_train.csv_da', 'diabetes_autoclean_test.csv_da', 'Outcome', 'Pregnancies,SkinThickness,Age', 'repeatedcv', 'lm,svmRadial'),
(10, 9, 13, 1, 'Contesto', 'Semplice su 1 variabile', 'CO2_autoclean_train.csv_da', 'CO2_autoclean_test.csv_da', 'x', 'x', 'repeatedcv', 'lm,svmRadial'),
(11, 11, 15, 1, '2 vars', '2 vars', 'cars_autoclean_train.csv_da', 'cars_autoclean_test.csv_da', 'dist', 'speed', 'repeatedcv', 'lm,svmRadial'),
(12, 12, 16, 1, 'weight=f(time, diet)', 'weight=f(time, diet)', 'ChickWeight_autoclean_train.csv_da', 'ChickWeight_autoclean_test.csv_da', 'weight', 'Time,Diet', 'repeatedcv', 'lm,svmRadial'),
(14, 14, 17, 1, 'Nile river flow', 'Nile river flow.\nSIngle variable.', 'Nile_autoclean_train.csv_da', 'Nile_autoclean_test.csv_da', 'y', 'x', 'repeatedcv', 'lm,svmRadial'),
(15, 15, 18, 1, 'Linear Regression', 'circumference=f(age)', 'Orange_autoclean_train.csv_da', 'Orange_autoclean_test.csv_da', 'circumference', 'age', 'repeatedcv', 'lm,svmRadial');

-- --------------------------------------------------------


--
-- Dump dei dati per la tabella `clean`
--

INSERT INTO `clean` (`idClean`, `idPrj`, `Note`, `ctsd`, `cnsd`, `cusd`) VALUES
(8, 26, 'Diabets (Pregnancies, SkinThickness, Age)', 'numeric,numeric,numeric,numeric', 'Pregnancies,SkinThickness,Age,Outcome', 'numeric,numeric,numeric,numeric'),
(10, 30, 'no cleaning necessary', 'numeric,numeric', 'n,x', 'numeric,numeric'),
(11, 27, 'automatic clean', NULL, NULL, NULL),
(12, 28, 'auto', NULL, NULL, NULL),
(13, 29, 'weight=f(time, diet)', NULL, NULL, NULL),
(14, 31, 'Nile river flow\nSIngle variable.', NULL, NULL, NULL),
(15, 32, 'Autoclean.\ncircumference=f(age)', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Dump dei dati per la tabella `cntx`
--

INSERT INTO `cntx` (`idCntx`, `idPrj`, `idEvnt`, `nam`, `descr`, `fileRefDat`, `ctsd`, `cnsd`, `cusd`) VALUES
(9, 26, 20, 'Diabete contesto', 'verifica del contesto\nDiabets (Pregnancies, SkinThickness, Age)', 'DA/_FsBase/Prj/Usr_8_Prj_26/Evnt_20/diabetes_autoclean.csv_da', NULL, NULL, NULL),
(13, 30, 27, 'co2', 'co2 contesto semplice.\nuna sola variabile.', 'DA/_FsBase/Prj/Usr_8_Prj_30/Evnt_27/CO2_autoclean.csv_da', NULL, NULL, NULL),
(14, 27, 24, 'context', 'context description', 'DA/_FsBase/Prj/Usr_8_Prj_27/Evnt_24/austres_autoclean.csv_da', NULL, NULL, NULL),
(15, 28, 25, '2 vars', '2 vars', 'DA/_FsBase/Prj/Usr_8_Prj_28/Evnt_25/cars_autoclean.csv_da', NULL, NULL, NULL),
(16, 29, 26, 'context', 'weight=f(time, diet)', 'DA/_FsBase/Prj/Usr_8_Prj_29/Evnt_26/ChickWeight_autoclean.csv_da', NULL, NULL, NULL),
(17, 31, 28, 'Nile river flow', 'Nile river flow.\nSingle variable.', 'DA/_FsBase/Prj/Usr_8_Prj_31/Evnt_28/Nile_autoclean.csv_da', NULL, NULL, NULL),
(18, 32, 29, 'Context', 'circumference=f(age)', 'DA/_FsBase/Prj/Usr_8_Prj_32/Evnt_29/Orange_autoclean.csv_da', NULL, NULL, NULL);

-- --------------------------------------------------------


--
-- Dump dei dati per la tabella `evnt`
--

INSERT INTO `evnt` (`idEvnt`, `idPrj`, `idEvntCat`, `nam`, `descr`, `fileRefRepoDat`, `fileRefEvntDat`) VALUES
(20, 26, 2, 'Diabete', 'Diabete', 'DA/_FsBase/Dat/Evnt/diabetes.csv_da', NULL),
(24, 27, NULL, 'austres', 'Quarterly Time Series of the Number of Australian Residents', 'DA/_FsBase/Dat/Evnt/austres.csv_da', NULL),
(25, 28, 8, 'Cars', 'Speed, stopping distance', 'DA/_FsBase/Dat/Evnt/cars.csv_da', NULL),
(26, 29, 2, 'Chicken Weigth', 'Chicken Weigth', 'DA/_FsBase/Dat/Evnt/ChickWeight.csv_da', NULL),
(27, 30, 5, 'CO2', 'Mauna Loa Atmospheric CO2 Concentration', 'DA/_FsBase/Dat/Evnt/CO2.csv_da', NULL),
(28, 31, 5, 'Nile river flow', 'Nile river flow', 'DA/_FsBase/Dat/Evnt/Nile.csv_da', NULL),
(29, 32, NULL, 'Orange tree', 'Orange tree.\ncircumference=f(age)', 'DA/_FsBase/Dat/Evnt/Orange.csv_da', NULL);

-- --------------------------------------------------------

--
-- Dump dei dati per la tabella `prj`
--

INSERT INTO `prj` (`idPrj`, `idUsr`, `nam`, `descr`, `folderRef`, `idPrjState`) VALUES
(26, 8, 'Diabete', 'Diabete', NULL, 5),
(27, 8, 'Australian Residents', 'Quarterly Time Series of the Number of Australian Residents', NULL, 4),
(28, 8, 'Cars', 'Speed and Stopping Distances of Cars', NULL, 5),
(29, 8, 'ChickWeight', 'Weight versus age of chicks on different diets', NULL, 4),
(30, 8, 'co2', 'Mauna Loa Atmospheric CO2 Concentration', NULL, 5),
(31, 8, 'Nile', 'Flow of the River Nile', NULL, 4),
(32, 8, 'Orange', 'Growth of Orange Trees', NULL, 4);

-- --------------------------------------------------------

--
-- Dump dei dati per la tabella `rev`
--

INSERT INTO `rev` (`IdRev`, `IdAn`, `Note`) VALUES
(5, 8, 'Valutazione di\nMAE\nRMSE\nR2\n----------------------------------------------\nValutazione della qualità di previsione\nrispetto alla variabile:\nPregnancies:\nSkinThickness:\nAge:\n'),
(7, 9, 'Valutazione di\nMAE:\nRMSE:\nR2:\n ----------------------------------------------\n Valutazione della qualità di previsione\n Outcome:\n rispetto alla variabile:\n Var1:\n Var2:\n Var3:'),
(8, 11, 'Valutazione di\nMAE:\nRMSE:\nR2:\n ----------------------------------------------\n Valutazione della qualità di previsione\n dist:\n rispetto alla variabile:\n speed:\n '),
(9, 13, 'Valutazione di\nMAE:\nRMSE:\nR2:\n ----------------------------------------------\n Valutazione della qualità di previsione\n Outcome:\n rispetto alla variabile:\n Var1:\n Var2:\n Var3:');

-- --------------------------------------------------------
COMMIT;


