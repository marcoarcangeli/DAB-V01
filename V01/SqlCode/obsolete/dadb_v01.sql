-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 26, 2021 alle 18:15
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.4.10

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
-- Struttura della tabella `algoritmo`
--

CREATE TABLE `algoritmo` (
  `idAlgoritmo` int(11) NOT NULL,
  `idStatoAlgoritmo` int(11) DEFAULT NULL,
  `idTipoAlgoritmo` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `fileRefProcesso` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `analisi`
--

CREATE TABLE `analisi` (
  `IdAnalisi` int(11) NOT NULL,
  `idProgetto` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `idContestoAnalisi` int(11) DEFAULT NULL,
  `idAlgoritmo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `contesto`
--

CREATE TABLE `contesto` (
  `idContesto` int(11) NOT NULL,
  `idProgetto` int(11) DEFAULT NULL,
  `idEvento` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `fileRefDatiPuliti` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `contestoanalisi`
--

CREATE TABLE `contestoanalisi` (
  `idContestoAnalisi` int(11) NOT NULL,
  `IdAnalisi` int(11) DEFAULT NULL,
  `idContesto` int(11) DEFAULT NULL,
  `idTecnicaSplitDati` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `fileRefDatiTraining` varchar(200) DEFAULT NULL,
  `fileRefDatiTest` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `evento`
--

CREATE TABLE `evento` (
  `idEvento` int(11) NOT NULL,
  `idProgetto` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `fileRefDatiRepo` varchar(200) DEFAULT NULL,
  `fileRefDatiEvento` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `evento`
--

INSERT INTO `evento` (`idEvento`, `idProgetto`, `nome`, `descrizione`, `fileRefDatiRepo`, `fileRefDatiEvento`) VALUES
(1, NULL, 'eee', NULL, NULL, NULL),
(2, NULL, 'eee', NULL, NULL, NULL),
(3, 1, 'e', NULL, NULL, NULL),
(4, 22, 'e', NULL, NULL, NULL),
(6, 2, 'e', 'eee', 'ability.cov.csv', NULL),
(7, 2, 'e', 'eeeaaa', 'ability.cov.csv', NULL),
(8, 2, 'e', 'eeeaaa vvv', 'ability.cov.csv', NULL),
(9, 4, '444', '4', 'ability.cov.csv', NULL),
(10, 23, 'ev23', NULL, 'ability.cov.csv', 'ability.cov.csv'),
(11, 23, 'ev23', NULL, 'ability.cov.csv', 'ability.cov.csv'),
(12, 23, 'ev23', NULL, 'ability.cov.csv', 'ability.cov.csv'),
(13, 23, 'ev23', NULL, 'ability.cov.csv', 'ability.cov.csv'),
(14, 23, 'ev23', NULL, 'ability.cov.csv', 'ability.cov.csv'),
(15, 23, 'ev23', NULL, 'ability.cov.csv', 'ability.cov.csv'),
(16, 23, 'ev23', 'ddd', 'ability.cov.csv', 'ability.cov.csv'),
(17, 23, 'ev23', 'ddd', 'anscombe.csv', 'anscombe.csv');

-- --------------------------------------------------------

--
-- Struttura della tabella `operazionedati`
--

CREATE TABLE `operazionedati` (
  `idOperazioneDati` int(11) NOT NULL,
  `idPulizia` int(11) DEFAULT NULL,
  `idTipoOperazioneDati` int(11) DEFAULT NULL,
  `ordineEsecuzione` int(11) DEFAULT NULL,
  `nota` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `parametroalgoritmo`
--

CREATE TABLE `parametroalgoritmo` (
  `idParametroAlgoritmo` int(11) NOT NULL,
  `idParametroTipoAlgoritmo` int(11) DEFAULT NULL,
  `valore` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `parametroalgoritmotest`
--

CREATE TABLE `parametroalgoritmotest` (
  `idParametroAlgoritmoTest` int(11) NOT NULL,
  `idParametroAlgoritmo` int(11) DEFAULT NULL,
  `idTraining` int(11) DEFAULT NULL,
  `idParametroTipoAlgoritmo` int(11) DEFAULT NULL,
  `valore` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `parametroalgoritmotraining`
--

CREATE TABLE `parametroalgoritmotraining` (
  `idParametroAlgoritmoTraining` int(11) NOT NULL,
  `idParametroAlgoritmo` int(11) DEFAULT NULL,
  `idTraining` int(11) DEFAULT NULL,
  `idParametroTipoAlgoritmo` int(11) DEFAULT NULL,
  `valore` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `parametrooperazionedati`
--

CREATE TABLE `parametrooperazionedati` (
  `idParametroOperazioneDati` int(11) NOT NULL,
  `idOperazioneDati` int(11) DEFAULT NULL,
  `idParametroTipoOperazioneDati` int(11) DEFAULT NULL,
  `valore` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `parametrosplit`
--

CREATE TABLE `parametrosplit` (
  `idParametroSplit` int(11) NOT NULL,
  `idSplit` int(11) DEFAULT NULL,
  `idParametroTipoSplit` int(11) DEFAULT NULL,
  `valore` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `parametrotipoalgoritmo`
--

CREATE TABLE `parametrotipoalgoritmo` (
  `idParametroTipoAlgoritmo` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `unitaMisura` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `parametrotipooperazionedati`
--

CREATE TABLE `parametrotipooperazionedati` (
  `idParametroTipoOperazioneDati` int(11) NOT NULL,
  `idTipoOperazioneDati` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `unitaMisura` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `parametrotiposplit`
--

CREATE TABLE `parametrotiposplit` (
  `idParametroTipoSplit` int(11) NOT NULL,
  `idSplit` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `unitaMisura` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `progetto`
--

CREATE TABLE `progetto` (
  `idProgetto` int(11) NOT NULL,
  `idUtente` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `folderRef` varchar(200) DEFAULT NULL,
  `idStatoProgetto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `progetto`
--

INSERT INTO `progetto` (`idProgetto`, `idUtente`, `nome`, `descrizione`, `folderRef`, `idStatoProgetto`) VALUES
(1, 1, 'progetto000', 'progetto.\n000.\n', NULL, 2),
(2, 1, 'progetto002', 'progetto.\n', NULL, 1),
(4, 1, 'progettoNuovo', 'Nuovo Progetto', 'bbbb', 1),
(22, 1, 'ggg', 'des', NULL, 1),
(23, 1, 'asdf', 'dfghdfgh', NULL, 1),
(28, 1, 'ddd', 'eee', NULL, 1),
(29, 1, 'sdf', 'aaa', NULL, 1),
(30, 1, 'ee', 'fff', NULL, 1),
(31, 1, 'progetto002', 'progetto.\n', NULL, 1),
(32, 1, 'progetto002', 'progetto.\n\n', NULL, 1),
(33, 1, 'progetto002', 'progetto. aaa\n', NULL, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `progettoanalisi`
--

CREATE TABLE `progettoanalisi` (
  `idProgetto` int(11) NOT NULL,
  `IdAnalisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `pulizia`
--

CREATE TABLE `pulizia` (
  `idPulizia` int(11) NOT NULL,
  `idContesto` int(11) DEFAULT NULL,
  `idEvento` int(11) DEFAULT NULL,
  `nota` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ranking`
--

CREATE TABLE `ranking` (
  `idRanking` int(11) NOT NULL,
  `idProgetto` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `revisione`
--

CREATE TABLE `revisione` (
  `idRevisione` int(11) NOT NULL,
  `IdAnalisi` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `split`
--

CREATE TABLE `split` (
  `idSplit` int(11) NOT NULL,
  `idTipoSplit` int(11) DEFAULT NULL,
  `idContestoAnalisi` int(11) DEFAULT NULL,
  `nota` text DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idUtente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `statoalgoritmo`
--

CREATE TABLE `statoalgoritmo` (
  `idStatoAlgoritmo` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `statoprogetto`
--

CREATE TABLE `statoprogetto` (
  `idStatoProgetto` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `statoprogetto`
--

INSERT INTO `statoprogetto` (`idStatoProgetto`, `nome`, `descrizione`) VALUES
(1, 'New', 'Nuovo progetto'),
(2, 'Event Building', 'Evanto in costruzione'),
(3, 'Context Building', 'Constesto in costruzione'),
(4, 'Analysis Building', 'Analisi in costruzione'),
(5, 'Training Building', 'Training in costruzione'),
(6, 'Test Building', 'Test in costruzione'),
(7, 'Review', 'Revisione in lavorazione'),
(8, 'Ranking', 'Classifica in lavorazione'),
(9, 'Canceled', 'Cancellato');

-- --------------------------------------------------------

--
-- Struttura della tabella `test`
--

CREATE TABLE `test` (
  `idTraining` int(11) NOT NULL,
  `fileRefDatiTest` varchar(200) DEFAULT NULL,
  `fileRefDatiRisultatiTest` varchar(200) DEFAULT NULL,
  `idStatisticaDatiTest` int(11) DEFAULT NULL,
  `idStatisticaRisultatiTest` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `tipoalgoritmo`
--

CREATE TABLE `tipoalgoritmo` (
  `idTipoAlgoritmo` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `tipooperazionedati`
--

CREATE TABLE `tipooperazionedati` (
  `idTipoOperazioneDati` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `tiposplit`
--

CREATE TABLE `tiposplit` (
  `idTipoSplit` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `training`
--

CREATE TABLE `training` (
  `idTraining` int(11) NOT NULL,
  `fileRefDatiTraining` varchar(200) DEFAULT NULL,
  `fileRefDatiRisultatiTraining` varchar(200) DEFAULT NULL,
  `idStatisticaDatiTraining` int(11) DEFAULT NULL,
  `idStatisticaRisultatiTraining` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `idUtente` int(11) NOT NULL,
  `nomeUtente` varchar(30) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `eMail` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`idUtente`, `nomeUtente`, `pwd`, `cognome`, `nome`, `eMail`) VALUES
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

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `algoritmo`
--
ALTER TABLE `algoritmo`
  ADD PRIMARY KEY (`idAlgoritmo`);

--
-- Indici per le tabelle `analisi`
--
ALTER TABLE `analisi`
  ADD PRIMARY KEY (`IdAnalisi`);

--
-- Indici per le tabelle `contesto`
--
ALTER TABLE `contesto`
  ADD PRIMARY KEY (`idContesto`);

--
-- Indici per le tabelle `contestoanalisi`
--
ALTER TABLE `contestoanalisi`
  ADD PRIMARY KEY (`idContestoAnalisi`);

--
-- Indici per le tabelle `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idEvento`);

--
-- Indici per le tabelle `operazionedati`
--
ALTER TABLE `operazionedati`
  ADD PRIMARY KEY (`idOperazioneDati`);

--
-- Indici per le tabelle `parametroalgoritmo`
--
ALTER TABLE `parametroalgoritmo`
  ADD PRIMARY KEY (`idParametroAlgoritmo`);

--
-- Indici per le tabelle `parametroalgoritmotest`
--
ALTER TABLE `parametroalgoritmotest`
  ADD PRIMARY KEY (`idParametroAlgoritmoTest`);

--
-- Indici per le tabelle `parametroalgoritmotraining`
--
ALTER TABLE `parametroalgoritmotraining`
  ADD PRIMARY KEY (`idParametroAlgoritmoTraining`);

--
-- Indici per le tabelle `parametrooperazionedati`
--
ALTER TABLE `parametrooperazionedati`
  ADD PRIMARY KEY (`idParametroOperazioneDati`);

--
-- Indici per le tabelle `parametrosplit`
--
ALTER TABLE `parametrosplit`
  ADD PRIMARY KEY (`idParametroSplit`);

--
-- Indici per le tabelle `parametrotipoalgoritmo`
--
ALTER TABLE `parametrotipoalgoritmo`
  ADD PRIMARY KEY (`idParametroTipoAlgoritmo`);

--
-- Indici per le tabelle `parametrotipooperazionedati`
--
ALTER TABLE `parametrotipooperazionedati`
  ADD PRIMARY KEY (`idParametroTipoOperazioneDati`);

--
-- Indici per le tabelle `parametrotiposplit`
--
ALTER TABLE `parametrotiposplit`
  ADD PRIMARY KEY (`idParametroTipoSplit`);

--
-- Indici per le tabelle `progetto`
--
ALTER TABLE `progetto`
  ADD PRIMARY KEY (`idProgetto`);

--
-- Indici per le tabelle `pulizia`
--
ALTER TABLE `pulizia`
  ADD PRIMARY KEY (`idPulizia`);

--
-- Indici per le tabelle `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`idRanking`);

--
-- Indici per le tabelle `revisione`
--
ALTER TABLE `revisione`
  ADD PRIMARY KEY (`idRevisione`);

--
-- Indici per le tabelle `split`
--
ALTER TABLE `split`
  ADD PRIMARY KEY (`idSplit`);

--
-- Indici per le tabelle `statoalgoritmo`
--
ALTER TABLE `statoalgoritmo`
  ADD PRIMARY KEY (`idStatoAlgoritmo`);

--
-- Indici per le tabelle `statoprogetto`
--
ALTER TABLE `statoprogetto`
  ADD PRIMARY KEY (`idStatoProgetto`);

--
-- Indici per le tabelle `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`idTraining`);

--
-- Indici per le tabelle `tipoalgoritmo`
--
ALTER TABLE `tipoalgoritmo`
  ADD PRIMARY KEY (`idTipoAlgoritmo`);

--
-- Indici per le tabelle `tipooperazionedati`
--
ALTER TABLE `tipooperazionedati`
  ADD PRIMARY KEY (`idTipoOperazioneDati`);

--
-- Indici per le tabelle `tiposplit`
--
ALTER TABLE `tiposplit`
  ADD PRIMARY KEY (`idTipoSplit`);

--
-- Indici per le tabelle `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`idTraining`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`idUtente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `algoritmo`
--
ALTER TABLE `algoritmo`
  MODIFY `idAlgoritmo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `analisi`
--
ALTER TABLE `analisi`
  MODIFY `IdAnalisi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `contesto`
--
ALTER TABLE `contesto`
  MODIFY `idContesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `contestoanalisi`
--
ALTER TABLE `contestoanalisi`
  MODIFY `idContestoAnalisi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `evento`
--
ALTER TABLE `evento`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `operazionedati`
--
ALTER TABLE `operazionedati`
  MODIFY `idOperazioneDati` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `parametroalgoritmo`
--
ALTER TABLE `parametroalgoritmo`
  MODIFY `idParametroAlgoritmo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `parametroalgoritmotest`
--
ALTER TABLE `parametroalgoritmotest`
  MODIFY `idParametroAlgoritmoTest` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `parametroalgoritmotraining`
--
ALTER TABLE `parametroalgoritmotraining`
  MODIFY `idParametroAlgoritmoTraining` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `parametrooperazionedati`
--
ALTER TABLE `parametrooperazionedati`
  MODIFY `idParametroOperazioneDati` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `parametrosplit`
--
ALTER TABLE `parametrosplit`
  MODIFY `idParametroSplit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `parametrotipoalgoritmo`
--
ALTER TABLE `parametrotipoalgoritmo`
  MODIFY `idParametroTipoAlgoritmo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `parametrotipooperazionedati`
--
ALTER TABLE `parametrotipooperazionedati`
  MODIFY `idParametroTipoOperazioneDati` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `parametrotiposplit`
--
ALTER TABLE `parametrotiposplit`
  MODIFY `idParametroTipoSplit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `progetto`
--
ALTER TABLE `progetto`
  MODIFY `idProgetto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT per la tabella `pulizia`
--
ALTER TABLE `pulizia`
  MODIFY `idPulizia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ranking`
--
ALTER TABLE `ranking`
  MODIFY `idRanking` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `revisione`
--
ALTER TABLE `revisione`
  MODIFY `idRevisione` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `split`
--
ALTER TABLE `split`
  MODIFY `idSplit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `statoalgoritmo`
--
ALTER TABLE `statoalgoritmo`
  MODIFY `idStatoAlgoritmo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `statoprogetto`
--
ALTER TABLE `statoprogetto`
  MODIFY `idStatoProgetto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `test`
--
ALTER TABLE `test`
  MODIFY `idTraining` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `tipoalgoritmo`
--
ALTER TABLE `tipoalgoritmo`
  MODIFY `idTipoAlgoritmo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `tipooperazionedati`
--
ALTER TABLE `tipooperazionedati`
  MODIFY `idTipoOperazioneDati` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `tiposplit`
--
ALTER TABLE `tiposplit`
  MODIFY `idTipoSplit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `training`
--
ALTER TABLE `training`
  MODIFY `idTraining` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `idUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
