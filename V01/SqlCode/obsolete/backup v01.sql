-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ago 09, 2021 alle 19:06
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
-- Database: dadb
--
DROP DATABASE IF EXISTS dadb;
CREATE DATABASE IF NOT EXISTS dadb DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE dadb;

-- --------------------------------------------------------

--
-- Struttura della tabella algoritmo
--

DROP TABLE IF EXISTS algoritmo;
CREATE TABLE IF NOT EXISTS algoritmo (
  idAlgoritmo int(11) NOT NULL AUTO_INCREMENT,
  idStatoAlgoritmo int(11) DEFAULT NULL,
  idTipoAlgoritmo int(11) DEFAULT NULL,
  nome varchar(50) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  fileRefProcesso varchar(200) DEFAULT NULL,
  PRIMARY KEY (idAlgoritmo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella analisi
--

DROP TABLE IF EXISTS analisi;
CREATE TABLE IF NOT EXISTS analisi (
  IdAnalisi int(11) NOT NULL AUTO_INCREMENT,
  idProgetto int(11) DEFAULT NULL,
  nome varchar(50) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  idContestoAnalisi int(11) DEFAULT NULL,
  idAlgoritmo int(11) DEFAULT NULL,
  PRIMARY KEY (IdAnalisi)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella contesto
--

DROP TABLE IF EXISTS contesto;
CREATE TABLE IF NOT EXISTS contesto (
  idContesto int(11) NOT NULL AUTO_INCREMENT,
  idProgetto int(11) DEFAULT NULL,
  idEvento int(11) DEFAULT NULL,
  nome varchar(50) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  fileRefDatiPuliti varchar(200) DEFAULT NULL,
  PRIMARY KEY (idContesto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella contestoanalisi
--

DROP TABLE IF EXISTS contestoanalisi;
CREATE TABLE IF NOT EXISTS contestoanalisi (
  idContestoAnalisi int(11) NOT NULL AUTO_INCREMENT,
  IdAnalisi int(11) DEFAULT NULL,
  idContesto int(11) DEFAULT NULL,
  idTecnicaSplitDati int(11) DEFAULT NULL,
  nome varchar(50) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  fileRefDatiTraining varchar(200) DEFAULT NULL,
  fileRefDatiTest varchar(200) DEFAULT NULL,
  PRIMARY KEY (idContestoAnalisi)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella evento
--

DROP TABLE IF EXISTS evento;
CREATE TABLE IF NOT EXISTS evento (
  idEvento int(11) NOT NULL AUTO_INCREMENT,
  idProgetto int(11) DEFAULT NULL,
  nome varchar(50) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  fileRefDatiRepo varchar(200) DEFAULT NULL,
  fileRefDatiEvento varchar(200) DEFAULT NULL,
  PRIMARY KEY (idEvento)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella operazionedati
--

DROP TABLE IF EXISTS operazionedati;
CREATE TABLE IF NOT EXISTS operazionedati (
  idOperazioneDati int(11) NOT NULL AUTO_INCREMENT,
  idPulizia int(11) DEFAULT NULL,
  idTipoOperazioneDati int(11) DEFAULT NULL,
  ordineEsecuzione int(11) DEFAULT NULL,
  nota text DEFAULT NULL,
  PRIMARY KEY (idOperazioneDati)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella parametroalgoritmo
--

DROP TABLE IF EXISTS parametroalgoritmo;
CREATE TABLE IF NOT EXISTS parametroalgoritmo (
  idParametroAlgoritmo int(11) NOT NULL AUTO_INCREMENT,
  idParametroTipoAlgoritmo int(11) DEFAULT NULL,
  idAlgoritmo int(11) DEFAULT NULL,
  valore varchar(30) DEFAULT NULL,
  PRIMARY KEY (idParametroAlgoritmo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella parametroalgoritmotest
--

DROP TABLE IF EXISTS parametroalgoritmotest;
CREATE TABLE IF NOT EXISTS parametroalgoritmotest (
  idParametroAlgoritmoTest int(11) NOT NULL AUTO_INCREMENT,
  idParametroAlgoritmo int(11) DEFAULT NULL,
  IdTraining int(11) DEFAULT NULL,
  idParametroTipoAlgoritmo int(11) DEFAULT NULL,
  valore varchar(30) DEFAULT NULL,
  PRIMARY KEY (idParametroAlgoritmoTest)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella parametroalgoritmotraining
--

DROP TABLE IF EXISTS parametroalgoritmotraining;
CREATE TABLE IF NOT EXISTS parametroalgoritmotraining (
  idParametroAlgoritmoTraining int(11) NOT NULL AUTO_INCREMENT,
  idParametroAlgoritmo int(11) DEFAULT NULL,
  IdTraining int(11) DEFAULT NULL,
  idParametroTipoAlgoritmo int(11) DEFAULT NULL,
  valore varchar(30) DEFAULT NULL,
  PRIMARY KEY (idParametroAlgoritmoTraining)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella parametrooperazionedati
--

DROP TABLE IF EXISTS parametrooperazionedati;
CREATE TABLE IF NOT EXISTS parametrooperazionedati (
  idParametroOperazioneDati int(11) NOT NULL AUTO_INCREMENT,
  idOperazioneDati int(11) DEFAULT NULL,
  idParametroTipoOperazioneDati int(11) DEFAULT NULL,
  valore varchar(30) DEFAULT NULL,
  PRIMARY KEY (idParametroOperazioneDati)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella parametrosplit
--

DROP TABLE IF EXISTS parametrosplit;
CREATE TABLE IF NOT EXISTS parametrosplit (
  idParametroSplit int(11) NOT NULL AUTO_INCREMENT,
  idSplit int(11) DEFAULT NULL,
  idParametroTipoSplit int(11) DEFAULT NULL,
  valore varchar(30) DEFAULT NULL,
  PRIMARY KEY (idParametroSplit)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella parametrotipoalgoritmo
--

DROP TABLE IF EXISTS parametrotipoalgoritmo;
CREATE TABLE IF NOT EXISTS parametrotipoalgoritmo (
  idParametroTipoAlgoritmo int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(50) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  unitaMisura varchar(20) DEFAULT NULL,
  PRIMARY KEY (idParametroTipoAlgoritmo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella parametrotipooperazionedati
--

DROP TABLE IF EXISTS parametrotipooperazionedati;
CREATE TABLE IF NOT EXISTS parametrotipooperazionedati (
  idParametroTipoOperazioneDati int(11) NOT NULL AUTO_INCREMENT,
  idTipoOperazioneDati int(11) DEFAULT NULL,
  nome varchar(50) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  unitaMisura varchar(20) DEFAULT NULL,
  PRIMARY KEY (idParametroTipoOperazioneDati)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella parametrotiposplit
--

DROP TABLE IF EXISTS parametrotiposplit;
CREATE TABLE IF NOT EXISTS parametrotiposplit (
  idParametroTipoSplit int(11) NOT NULL AUTO_INCREMENT,
  idSplit int(11) DEFAULT NULL,
  nome varchar(50) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  unitaMisura varchar(20) DEFAULT NULL,
  PRIMARY KEY (idParametroTipoSplit)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella progetto
--

DROP TABLE IF EXISTS progetto;
CREATE TABLE IF NOT EXISTS progetto (
  idProgetto int(11) NOT NULL AUTO_INCREMENT,
  idUtente int(11) DEFAULT NULL,
  nome varchar(50) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  folderRef varchar(200) DEFAULT NULL,
  idStatoProgetto int(11) NOT NULL,
  PRIMARY KEY (idProgetto)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella progetto
--

INSERT INTO progetto (idProgetto, idUtente, nome, descrizione, folderRef, idStatoProgetto) VALUES
(1, 1, 'progettoTestTransazione', 'progetto Test Transazione.', NULL, 1),
(5, 1, 'progettoTestTransazione', 'progetto Test Transazione.', NULL, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella progettoanalisi
--

DROP TABLE IF EXISTS progettoanalisi;
CREATE TABLE IF NOT EXISTS progettoanalisi (
  idProgetto int(11) NOT NULL,
  IdAnalisi int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella pulizia
--

DROP TABLE IF EXISTS pulizia;
CREATE TABLE IF NOT EXISTS pulizia (
  idPulizia int(11) NOT NULL AUTO_INCREMENT,
  idContesto int(11) DEFAULT NULL,
  idEvento int(11) DEFAULT NULL,
  nota text DEFAULT NULL,
  PRIMARY KEY (idPulizia)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella ranking
--

DROP TABLE IF EXISTS ranking;
CREATE TABLE IF NOT EXISTS ranking (
  idRanking int(11) NOT NULL AUTO_INCREMENT,
  idProgetto int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  PRIMARY KEY (idRanking)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella revisione
--

DROP TABLE IF EXISTS revisione;
CREATE TABLE IF NOT EXISTS revisione (
  idRevisione int(11) NOT NULL AUTO_INCREMENT,
  IdAnalisi int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  PRIMARY KEY (idRevisione)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella split
--

DROP TABLE IF EXISTS split;
CREATE TABLE IF NOT EXISTS split (
  idSplit int(11) NOT NULL AUTO_INCREMENT,
  idTipoSplit int(11) DEFAULT NULL,
  idContestoAnalisi int(11) DEFAULT NULL,
  nota text DEFAULT NULL,
  ts timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  idUtente int(11) NOT NULL,
  PRIMARY KEY (idSplit)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statcompdatitraintest
--

DROP TABLE IF EXISTS statcompdatitraintest;
CREATE TABLE IF NOT EXISTS statcompdatitraintest (
  idStatCompTrainTest int(11) NOT NULL AUTO_INCREMENT,
  idRevisione int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  min double DEFAULT NULL,
  max double DEFAULT NULL,
  mean double DEFAULT NULL,
  sd double DEFAULT NULL,
  var double DEFAULT NULL,
  varCoeff double DEFAULT NULL,
  PRIMARY KEY (idStatCompTrainTest)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statcompdatitraintestcorr
--

DROP TABLE IF EXISTS statcompdatitraintestcorr;
CREATE TABLE IF NOT EXISTS statcompdatitraintestcorr (
  idStatCompDatiTrainTestCorr int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTrain int(11) DEFAULT NULL,
  idStatVar1 int(11) DEFAULT NULL,
  idStatVar2 int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  r double DEFAULT NULL,
  95CI double DEFAULT NULL,
  t double DEFAULT NULL,
  Spearman double DEFAULT NULL,
  Pearson double DEFAULT NULL,
  PRIMARY KEY (idStatCompDatiTrainTestCorr)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statcompdatitraintestindip
--

DROP TABLE IF EXISTS statcompdatitraintestindip;
CREATE TABLE IF NOT EXISTS statcompdatitraintestindip (
  idStatDatiTrainTestIndip int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTrain int(11) DEFAULT NULL,
  idStatVar1 int(11) DEFAULT NULL,
  idStatVar2 int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  chi2 double DEFAULT NULL,
  df double DEFAULT NULL,
  pValue double DEFAULT NULL,
  phi double DEFAULT NULL,
  coeffContingenza double DEFAULT NULL,
  vCramer double DEFAULT NULL,
  verosimiglianza double DEFAULT NULL,
  PRIMARY KEY (idStatDatiTrainTestIndip)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statcompristraintest
--

DROP TABLE IF EXISTS statcompristraintest;
CREATE TABLE IF NOT EXISTS statcompristraintest (
  idStatCompRisTrainTest int(11) NOT NULL AUTO_INCREMENT,
  idRevisione int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  min double DEFAULT NULL,
  max double DEFAULT NULL,
  mean double DEFAULT NULL,
  sd double DEFAULT NULL,
  var double DEFAULT NULL,
  varCoeff double DEFAULT NULL,
  PRIMARY KEY (idStatCompRisTrainTest)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statcompristraintestcorr
--

DROP TABLE IF EXISTS statcompristraintestcorr;
CREATE TABLE IF NOT EXISTS statcompristraintestcorr (
  idStatCompRisTrainTestCorr int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTrain int(11) DEFAULT NULL,
  idStatVar1 int(11) DEFAULT NULL,
  idStatVar2 int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  r double DEFAULT NULL,
  95CI double DEFAULT NULL,
  t double DEFAULT NULL,
  Spearman double DEFAULT NULL,
  Pearson double DEFAULT NULL,
  PRIMARY KEY (idStatCompRisTrainTestCorr)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statcompristraintestindip
--

DROP TABLE IF EXISTS statcompristraintestindip;
CREATE TABLE IF NOT EXISTS statcompristraintestindip (
  idStatCompRisTrainTestIndip int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTrain int(11) DEFAULT NULL,
  idStatVar1 int(11) DEFAULT NULL,
  idStatVar2 int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  chi2 double DEFAULT NULL,
  df double DEFAULT NULL,
  pValue double DEFAULT NULL,
  phi double DEFAULT NULL,
  coeffContingenza double DEFAULT NULL,
  vCramer double DEFAULT NULL,
  verosimiglianza double DEFAULT NULL,
  PRIMARY KEY (idStatCompRisTrainTestIndip)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statdaticontesto
--

DROP TABLE IF EXISTS statdaticontesto;
CREATE TABLE IF NOT EXISTS statdaticontesto (
  idStatDatiContesto int(11) NOT NULL AUTO_INCREMENT,
  idContesto int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nDimensioni int(11) DEFAULT NULL,
  nMisure int(11) DEFAULT NULL,
  proiezioneEvento text DEFAULT NULL,
  PRIMARY KEY (idStatDatiContesto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statdaticontestoanalisi
--

DROP TABLE IF EXISTS statdaticontestoanalisi;
CREATE TABLE IF NOT EXISTS statdaticontestoanalisi (
  idStatDatiContestoAnalisi int(11) NOT NULL AUTO_INCREMENT,
  idContesto int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nDimensioni int(11) DEFAULT NULL,
  nMisure int(11) DEFAULT NULL,
  proiezioneContesto text DEFAULT NULL,
  PRIMARY KEY (idStatDatiContestoAnalisi)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statdaticontestoanalisivar
--

DROP TABLE IF EXISTS statdaticontestoanalisivar;
CREATE TABLE IF NOT EXISTS statdaticontestoanalisivar (
  idStatDatiContestoAnalisiVar int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiContestoAnalisi int(11) DEFAULT NULL,
  idStatVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  MIN double DEFAULT NULL,
  MAX double DEFAULT NULL,
  mean double DEFAULT NULL,
  sd double DEFAULT NULL,
  var double DEFAULT NULL,
  varCoeff double DEFAULT NULL,
  filtro text DEFAULT NULL,
  PRIMARY KEY (idStatDatiContestoAnalisiVar)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statdaticontestovar
--

DROP TABLE IF EXISTS statdaticontestovar;
CREATE TABLE IF NOT EXISTS statdaticontestovar (
  idStatDatiContestoVar int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiContesto int(11) DEFAULT NULL,
  idStatVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  MIN double DEFAULT NULL,
  MAX double DEFAULT NULL,
  mean double DEFAULT NULL,
  sd double DEFAULT NULL,
  var double DEFAULT NULL,
  varCoeff double DEFAULT NULL,
  filtro text DEFAULT NULL,
  PRIMARY KEY (idStatDatiContestoVar)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statdatievento
--

DROP TABLE IF EXISTS statdatievento;
CREATE TABLE IF NOT EXISTS statdatievento (
  idStatDatiEvento int(11) NOT NULL AUTO_INCREMENT,
  idEvento int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nDimensioni int(11) DEFAULT NULL,
  nMisure int(11) DEFAULT NULL,
  PRIMARY KEY (idStatDatiEvento)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statdatieventovar
--

DROP TABLE IF EXISTS statdatieventovar;
CREATE TABLE IF NOT EXISTS statdatieventovar (
  idStatDatiEventoVar int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiEvento int(11) DEFAULT NULL,
  idStatVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  minimum double DEFAULT NULL,
  maximum double DEFAULT NULL,
  mean double DEFAULT NULL,
  sd double DEFAULT NULL,
  variance double DEFAULT NULL,
  varCoeff double DEFAULT NULL,
  PRIMARY KEY (idStatDatiEventoVar)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statdatieventovarmappaanomalie
--

DROP TABLE IF EXISTS statdatieventovarmappaanomalie;
CREATE TABLE IF NOT EXISTS statdatieventovarmappaanomalie (
  idStatDatiEventoVariabiliMappaAnomalie int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiEventoVar int(11) DEFAULT NULL,
  nAnomalie int(11) DEFAULT NULL,
  nMancanze int(11) DEFAULT NULL,
  nErrori int(11) DEFAULT NULL,
  nAltreAnomalie int(11) DEFAULT NULL,
  mappaMancanze text DEFAULT NULL,
  mappaErrori text DEFAULT NULL,
  mappaAltreAnomalie text DEFAULT NULL,
  nCorrezioni int(11) DEFAULT NULL,
  mappaCorrezioni text DEFAULT NULL,
  PRIMARY KEY (idStatDatiEventoVariabiliMappaAnomalie)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statdatitest
--

DROP TABLE IF EXISTS statdatitest;
CREATE TABLE IF NOT EXISTS statdatitest (
  idStatDatiTest int(11) NOT NULL AUTO_INCREMENT,
  idTest int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nDimensioni int(11) DEFAULT NULL,
  nMisure int(11) DEFAULT NULL,
  PRIMARY KEY (idStatDatiTest)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statdatitestasim
--

DROP TABLE IF EXISTS statdatitestasim;
CREATE TABLE IF NOT EXISTS statdatitestasim (
  idStatDatiTestAsim int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTest int(11) DEFAULT NULL,
  idStatVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  mediaModa double DEFAULT NULL,
  coefPearson1 double DEFAULT NULL,
  coefPearson2 double DEFAULT NULL,
  PRIMARY KEY (idStatDatiTestAsim)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statdatitestcentro
--

DROP TABLE IF EXISTS statdatitestcentro;
CREATE TABLE IF NOT EXISTS statdatitestcentro (
  idStatDatiTestCentro int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTest int(11) DEFAULT NULL,
  idStatVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  aritmetica double DEFAULT NULL,
  geometrica double DEFAULT NULL,
  quadratica double DEFAULT NULL,
  armonica double DEFAULT NULL,
  moda double DEFAULT NULL,
  mediana double DEFAULT NULL,
  PRIMARY KEY (idStatDatiTestCentro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statdatitestvar
--

DROP TABLE IF EXISTS statdatitestvar;
CREATE TABLE IF NOT EXISTS statdatitestvar (
  idStatDatiTestVar int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTest int(11) DEFAULT NULL,
  idStatVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  min double DEFAULT NULL,
  max double DEFAULT NULL,
  mean double DEFAULT NULL,
  sd double DEFAULT NULL,
  var double DEFAULT NULL,
  varCoeff double DEFAULT NULL,
  PRIMARY KEY (idStatDatiTestVar)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statdatitrain
--

DROP TABLE IF EXISTS statdatitrain;
CREATE TABLE IF NOT EXISTS statdatitrain (
  idStatDatiTrain int(11) NOT NULL AUTO_INCREMENT,
  IdTrain int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nDimensioni int(11) DEFAULT NULL,
  nMisure int(11) DEFAULT NULL,
  PRIMARY KEY (idStatDatiTrain)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statdatitrainasim
--

DROP TABLE IF EXISTS statdatitrainasim;
CREATE TABLE IF NOT EXISTS statdatitrainasim (
  idStatDatiTrainAsim int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTrain int(11) DEFAULT NULL,
  idStatVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  mediaModa double DEFAULT NULL,
  coefPearson1 double DEFAULT NULL,
  coefPearson2 double DEFAULT NULL,
  PRIMARY KEY (idStatDatiTrainAsim)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statdatitraincentro
--

DROP TABLE IF EXISTS statdatitraincentro;
CREATE TABLE IF NOT EXISTS statdatitraincentro (
  idStatDatiTrainCentro int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTrain int(11) DEFAULT NULL,
  idStatVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  aritmetica double DEFAULT NULL,
  geometrica double DEFAULT NULL,
  quadratica double DEFAULT NULL,
  armonica double DEFAULT NULL,
  moda double DEFAULT NULL,
  mediana double DEFAULT NULL,
  PRIMARY KEY (idStatDatiTrainCentro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statdatitrainvar
--

DROP TABLE IF EXISTS statdatitrainvar;
CREATE TABLE IF NOT EXISTS statdatitrainvar (
  idStatDatiTrainVar int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTrain int(11) DEFAULT NULL,
  idStatVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nMisure int(11) DEFAULT NULL,
  MIN double DEFAULT NULL,
  MAX double DEFAULT NULL,
  mean double DEFAULT NULL,
  sd double DEFAULT NULL,
  var double DEFAULT NULL,
  varCoeff double DEFAULT NULL,
  PRIMARY KEY (idStatDatiTrainVar)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statoalgoritmo
--

DROP TABLE IF EXISTS statoalgoritmo;
CREATE TABLE IF NOT EXISTS statoalgoritmo (
  idStatoAlgoritmo int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(50) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  PRIMARY KEY (idStatoAlgoritmo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statoprogetto
--

DROP TABLE IF EXISTS statoprogetto;
CREATE TABLE IF NOT EXISTS statoprogetto (
  idStatoProgetto int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(50) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  PRIMARY KEY (idStatoProgetto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statristest
--

DROP TABLE IF EXISTS statristest;
CREATE TABLE IF NOT EXISTS statristest (
  idStatRisTest int(11) NOT NULL AUTO_INCREMENT,
  idTest int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nDimensioni int(11) DEFAULT NULL,
  nMisure int(11) DEFAULT NULL,
  PRIMARY KEY (idStatRisTest)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statristestasim
--

DROP TABLE IF EXISTS statristestasim;
CREATE TABLE IF NOT EXISTS statristestasim (
  idStatRisTestAsim int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTest int(11) DEFAULT NULL,
  idStatVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  mediaModa double DEFAULT NULL,
  coefPearson1 double DEFAULT NULL,
  coefPearson2 double DEFAULT NULL,
  PRIMARY KEY (idStatRisTestAsim)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statristestcentro
--

DROP TABLE IF EXISTS statristestcentro;
CREATE TABLE IF NOT EXISTS statristestcentro (
  idStatRisTestCentro int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTest int(11) DEFAULT NULL,
  idStatVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  aritmetica double DEFAULT NULL,
  geometrica double DEFAULT NULL,
  quadratica double DEFAULT NULL,
  armonica double DEFAULT NULL,
  moda double DEFAULT NULL,
  mediana double DEFAULT NULL,
  PRIMARY KEY (idStatRisTestCentro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statristestvar
--

DROP TABLE IF EXISTS statristestvar;
CREATE TABLE IF NOT EXISTS statristestvar (
  idStatRisTestVar int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTest int(11) DEFAULT NULL,
  idStatVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  min double DEFAULT NULL,
  max double DEFAULT NULL,
  mean double DEFAULT NULL,
  sd double DEFAULT NULL,
  var double DEFAULT NULL,
  varCoeff double DEFAULT NULL,
  PRIMARY KEY (idStatRisTestVar)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statristrain
--

DROP TABLE IF EXISTS statristrain;
CREATE TABLE IF NOT EXISTS statristrain (
  idStatRisTrain int(11) NOT NULL AUTO_INCREMENT,
  IdTrain int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nDimensioni int(11) DEFAULT NULL,
  nMisure int(11) DEFAULT NULL,
  PRIMARY KEY (idStatRisTrain)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statristrainasim
--

DROP TABLE IF EXISTS statristrainasim;
CREATE TABLE IF NOT EXISTS statristrainasim (
  idStatDatiTrainAsim int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTrain int(11) DEFAULT NULL,
  idStatVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  mediaModa double DEFAULT NULL,
  coefPearson1 double DEFAULT NULL,
  coefPearson2 double DEFAULT NULL,
  PRIMARY KEY (idStatDatiTrainAsim)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statristraincentro
--

DROP TABLE IF EXISTS statristraincentro;
CREATE TABLE IF NOT EXISTS statristraincentro (
  idStatDatiTrainCentro int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTrain int(11) DEFAULT NULL,
  idStatVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  aritmetica double DEFAULT NULL,
  geometrica double DEFAULT NULL,
  quadratica double DEFAULT NULL,
  armonica double DEFAULT NULL,
  moda double DEFAULT NULL,
  mediana double DEFAULT NULL,
  PRIMARY KEY (idStatDatiTrainCentro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statristrainvar
--

DROP TABLE IF EXISTS statristrainvar;
CREATE TABLE IF NOT EXISTS statristrainvar (
  idStatRisTrainVar int(11) NOT NULL AUTO_INCREMENT,
  idStatDatiTrain int(11) DEFAULT NULL,
  idStatVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  MIN double DEFAULT NULL,
  MAX double DEFAULT NULL,
  mean double DEFAULT NULL,
  sd double DEFAULT NULL,
  var double DEFAULT NULL,
  varCoeff double DEFAULT NULL,
  PRIMARY KEY (idStatRisTrainVar)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella statvar
--

DROP TABLE IF EXISTS statvar;
CREATE TABLE IF NOT EXISTS statvar (
  idStatVar int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(50) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  unitaMisura varchar(20) DEFAULT NULL,
  PRIMARY KEY (idStatVar)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella statvar
--

INSERT INTO statvar (idStatVar, nome, descrizione, unitaMisura) VALUES
(1, 'nome variabile test', 'descrizione della variabile di test', 'kg'),
(3, 'nome variabile test', 'descrizione della variabile di test', 'kg'),
(4, 'nome variabile test', 'descrizione della variabile di test', 'kg'),
(5, 'nome variabile test', 'descrizione della variabile di test', 'kg');

-- --------------------------------------------------------

--
-- Struttura della tabella test
--

DROP TABLE IF EXISTS test;
CREATE TABLE IF NOT EXISTS test (
  IdTraining int(11) NOT NULL AUTO_INCREMENT,
  fileRefDatiTest varchar(200) DEFAULT NULL,
  fileRefDatiRisultatiTest varchar(200) DEFAULT NULL,
  idStatisticaDatiTest int(11) DEFAULT NULL,
  idStatisticaRisultatiTest int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  PRIMARY KEY (IdTraining)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella tipoalgoritmo
--

DROP TABLE IF EXISTS tipoalgoritmo;
CREATE TABLE IF NOT EXISTS tipoalgoritmo (
  idTipoAlgoritmo int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(50) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  PRIMARY KEY (idTipoAlgoritmo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella tipooperazionedati
--

DROP TABLE IF EXISTS tipooperazionedati;
CREATE TABLE IF NOT EXISTS tipooperazionedati (
  idTipoOperazioneDati int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(50) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  PRIMARY KEY (idTipoOperazioneDati)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella tiposplit
--

DROP TABLE IF EXISTS tiposplit;
CREATE TABLE IF NOT EXISTS tiposplit (
  idTipoSplit int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(50) DEFAULT NULL,
  descrizione text DEFAULT NULL,
  PRIMARY KEY (idTipoSplit)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella training
--

DROP TABLE IF EXISTS training;
CREATE TABLE IF NOT EXISTS training (
  IdTraining int(11) NOT NULL AUTO_INCREMENT,
  fileRefDatiTraining varchar(200) DEFAULT NULL,
  fileRefDatiRisultatiTraining varchar(200) DEFAULT NULL,
  idStatisticaDatiTraining int(11) DEFAULT NULL,
  idStatisticaRisultatiTraining int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  PRIMARY KEY (IdTraining)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella utente
--

DROP TABLE IF EXISTS utente;
CREATE TABLE IF NOT EXISTS utente (
  idUtente int(11) NOT NULL AUTO_INCREMENT,
  nomeUtente varchar(30) NOT NULL,
  pwd varchar(30) NOT NULL,
  cognome varchar(50) NOT NULL,
  nome varchar(50) NOT NULL,
  eMail varchar(100) DEFAULT NULL,
  PRIMARY KEY (idUtente)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella utente
--

INSERT INTO utente (idUtente, nomeUtente, pwd, cognome, nome, eMail) VALUES
(1, 'dev', 'dev', 'Arcangeli', 'Marco', 'marco.arcangeli@gmail.com'),
(2, 'utente01', 'pwd01', 'utente01', 'pwd01', 'utente01@pwd01.da'),
(3, 'utente03', 'pwd03', 'utente03', 'pwd03', 'utente01@pwd03.da'),
(4, 'utente04', 'pwd01', 'utente01', 'pwd01', 'utente01@pwd01.da'),
(5, 'utente05', 'pwd01', 'utente05', 'pwd01', 'utente01@pwd01.da'),
(7, 'utente07', 'pwd01', 'utente7', 'pwd07', 'utente7@pwd7.de'),
(11, 'utente11', 'pwd01', 'utente01', 'pwd01', 'utente01@pwd01.da'),
(12, 'utente12', 'pwd01', 'utente01', 'pwd01', 'utente01@pwd01.da'),
(13, 'utente13', 'pwd01', 'utente01', 'pwd01', 'utente01@pwd01.da'),
(14, 'utente14', 'pwd01', 'utente01', 'pwd01', 'utente01@pwd01.da'),
(15, 'utente15', 'pwd01', 'utente01', 'pwd01', 'utente01@pwd01.da'),
(16, 'utente nuovo', 'pwd', 'utente', 'nuovo', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
