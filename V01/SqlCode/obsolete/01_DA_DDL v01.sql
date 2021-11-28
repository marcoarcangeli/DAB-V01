--
-- database: dadb
-- prove di verifica: Data Analysis DB
use dadb;
CREATE USER 'm.arcangeli' @'%' IDENTIFIED VIA mysql_native_password USING '***';
GRANT ALL PRIVILEGES ON *.* TO 'm.arcangeli' @'%' REQUIRE NONE WITH
GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
/*
 drop table if exists utente;			
 drop table if exists Progetto;
 drop table if exists StatoProgetto;
 drop table if exists Analisi;
 drop table if exists Evento;
 drop table if exists Contesto;
 drop table if exists ContestoAnalisi;

 drop table if exists TipoParametro;
 drop table if exists ValoreParametroTraining;
 drop table if exists ValoreParametroTest;

 drop table if exists Algoritmo;
 drop table if exists StatoAlgoritmo;
 drop table if exists CategoriaAlg;

 drop table if exists Train;
 drop table if exists Test;
 drop table if exists Revisione;
 drop table if exists Ranking;

 drop table if exists TipoOperazioneDati;
 drop table if exists ParametroTipoOperazioneDati;
 drop table if exists Pulizia;
 drop table if exists OperazioneDati;
 drop table if exists ParametroOperazioneDati;
 drop table if exists TipoSplit;	
 drop table if exists ParametroTipoSplit;	
 drop table if exists Split;	
 drop table if exists ParametroSplit;	
 drop TABLE StatVar;
 drop TABLE StatDatiEvento;
 drop TABLE StatDatiEventoVar;
 drop TABLE StatDatiEventoVarMappaAnomalie;
 drop TABLE StatDatiContesto;
 drop TABLE StatDatiContestoVar;
 drop TABLE StatDatiContestoAnalisi;
 drop TABLE StatDatiContestoAnalisiVar;
 drop TABLE StatDatiTrain;
 drop TABLE StatDatiTrainVar;
 drop TABLE StatDatiTrainCentro;
 drop TABLE StatDatiTrainAsim;
 drop TABLE StatRisTrain;
 drop TABLE StatRisTrainVar;
 drop TABLE StatRisTrainCentro;
 drop TABLE StatRisTrainAsim;
 drop TABLE StatDatiTest;
 drop TABLE StatDatiTestVar;
 drop TABLE StatDatiTrainCentro;
 drop TABLE StatDatiTrainAsim;
 drop TABLE StatRisTest;
 drop TABLE StatRisTestVar;
 drop TABLE StatRisTrainCentro;
 drop TABLE StatRisTrainAsim;

 drop TABLE StatCompDatiTrainTest;
 drop TABLE StatCompDatiTrainTestIndip;
 drop TABLE StatCompDatiTrainTestCorr;
 drop TABLE StatCompRisTrainTest;
 drop TABLE StatCompRisTrainTestIndip;
 drop TABLE StatCompRisTrainTestCorr;
 */

create table utente(
	idUtente int not null primary key auto_increment,
	nomeUtente varchar(30) not null,
	pwd varchar(30) not null,
	cognome varchar(50) not null,
	nome varchar(50) not null,
	eMail varchar(100)
);

create table Progetto(
	idProgetto int not null primary key auto_increment,
	idUtente int,
	nome varchar(50),
	descrizione text,
	folderRef varchar(200),
	idStatoProgetto int not null
);

create table StatoProgetto(
	idStatoProgetto int not null primary key auto_increment,
	nome varchar(50),
	descrizione text
);

create table ProgettoAnalisi(
	idProgetto int not null,
	IdAnalisi int not null
);

create table Analisi(
	IdAnalisi int not null primary key auto_increment,
	idProgetto int,
	idAlgoritmo int,
	nome varchar(50),
	descrizione text
);

create table Evento(
	idEvento int not null primary key auto_increment,
	idProgetto int,
	idCategoriaEvento int,
	nome varchar(50),
	descrizione text,
	fileRefDatiRepo varchar(200),
	fileRefDatiEvento varchar(200)
);

create table Contesto(
	idContesto int not null primary key auto_increment,
	idProgetto int,
	idEvento int,
	nome varchar(50),
	descrizione text,
	fileRefDatiRepo varchar(200),
	fileRefDatiPuliti varchar(200)
);

create table ContestoAnalisi(
	idContestoAnalisi int not null primary key auto_increment,
	IdAnalisi int,
	idContesto int,
	idTecnicaSplitDati int,
	nome varchar(50),
	descrizione text,
	fileRefDatiTrain varchar(200),
	fileRefDatiTest varchar(200)
);

create table TipoAlgoritmo(
	idTipoAlgoritmo int not null primary key auto_increment,
	nome varchar(50),
	descrizione text
);

create table ParametroTipoAlgoritmo(
	idParametroTipoAlgoritmo int not null primary key auto_increment,
	nome varchar(50),
	descrizione text,
	unitaMisura varchar(20)
);

create table Algoritmo(
	idAlgoritmo int not null primary key auto_increment,
	idStatoAlgoritmo int,
	idTipoAlgoritmo int,
	nome varchar(50),
	descrizione text,
	fileRefProcesso varchar(200)
);

create table StatoAlgoritmo(
	idStatoAlgoritmo int not null primary key auto_increment,
	nome varchar(50),
	descrizione text
);

create table ParametroAlgoritmo(
	idParametroAlgoritmo int not null primary key auto_increment,
	idParametroTipoAlgoritmo int,
	idAlgoritmo int,
	valore varchar(30)
);

create table ParametroAlgoritmoTrain (
	idParametroAlgoritmoTrain int not null primary key auto_increment,
	idParametroAlgoritmo int,
	IdTrain int,
	idParametroTipoAlgoritmo int,
	valore varchar(30)
);

create table ParametroAlgoritmoTest(
	idParametroAlgoritmoTest int not null primary key auto_increment,
	idParametroAlgoritmo int,
	IdTrain int,
	idParametroTipoAlgoritmo int,
	valore varchar(30)
);

create table Training(
	IdTraining int not null primary key auto_increment,
	idContestoAnalisi int,
	fileRefDatiTrain varchar(200),
	fileRefDatiRisTrain varchar(200),
	note text
);

create table Test(
	IdTrain int not null primary key auto_increment,
	idContestoAnalisi int,
	fileRefDatiTest varchar(200),
	fileRefDatiRisTest varchar(200),
	note text
);

create table Revisione(
	idRevisione int not null primary key auto_increment,
	IdAnalisi int,
	note text
);

create table Ranking(
	idRanking int not null primary key auto_increment,
	IdAnalisi int,
	note text
);

/* -------------------
*/

create table TipoOperazioneDati(
	idTipoOperazioneDati int not null primary key auto_increment,
	nome varchar(50),
	descrizione text
);

create table ParametroTipoOperazioneDati(
	idParametroTipoOperazioneDati int not null primary key auto_increment,
	idTipoOperazioneDati int,
	nome varchar(50),
	descrizione text,
	unitaMisura varchar(20)
);

create table Pulizia(
	idPulizia int not null primary key auto_increment,
	idContesto int,
	idEvento int,
	nota text
);

create table OperazioneDati(
	idOperazioneDati int not null primary key auto_increment,
	idPulizia int,
	idTipoOperazioneDati int,
	ordineEsecuzione int,
	nota text
);

create table ParametroOperazioneDati(
	idParametroOperazioneDati int not null primary key auto_increment,
	idOperazioneDati int,
	idParametroTipoOperazioneDati int,
	valore varchar(30)
);

create table TipoSplit(
	idTipoSplit int not null primary key auto_increment,
	nome varchar(50),
	descrizione text
);

create table ParametroTipoSplit(
	idParametroTipoSplit int not null primary key auto_increment,
	idSplit int,
	nome varchar(50),
	descrizione text,
	unitaMisura varchar(20)
);

create table Split(
	idSplit int not null primary key auto_increment,
	idTipoSplit int,
	idContestoAnalisi int,
	nota text,
	ts timestamp,
	idUtente int not null
);

create table ParametroSplit(
	idParametroSplit int not null primary key auto_increment,
	idSplit int,
	idParametroTipoSplit int,
	valore varchar(30)
);

/*****************************************************************************
 statistiche
 */

CREATE TABLE StatVar(
	idStatVar INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(50),
	descrizione TEXT,
	unitaMisura VARCHAR(20)
);

CREATE TABLE StatDatiEvento(
	idStatDatiEvento INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idEvento INT,
	note TEXT,
	nDimensioni INT,
	nMisure INT
);

CREATE TABLE StatDatiEventoVar(
	idStatDatiEventoVar INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiEvento INT,
	idStatVar INT,
	note TEXT,
	minimum DOUBLE,
	maximum DOUBLE,
	mean DOUBLE,
	sd DOUBLE,
	variance DOUBLE,
	varCoeff DOUBLE
);

CREATE TABLE StatDatiEventoVarMappaAnomalie(
	idStatDatiEventoVariabiliMappaAnomalie INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiEventoVar INT,
	nAnomalie INT,
	nMancanze INT,
	nErrori INT,
	nAltreAnomalie INT,
	mappaMancanze TEXT,
	mappaErrori TEXT,
	mappaAltreAnomalie TEXT,
	nCorrezioni INT,
	mappaCorrezioni TEXT
);

CREATE TABLE StatDatiContesto(
	idStatDatiContesto INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idContesto INT,
	note TEXT,
	nDimensioni INT,
	nMisure INT,
	proiezioneEvento TEXT
);

CREATE TABLE StatDatiContestoVar(
	idStatDatiContestoVar INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiContesto INT,
	idStatVar INT,
	note TEXT,
	minimum DOUBLE,
	maximum DOUBLE,
	mean DOUBLE,
	sd DOUBLE,
	variance DOUBLE,
	varCoeff DOUBLE,
	filtro TEXT
);

CREATE TABLE StatDatiContestoAnalisi(
	idStatDatiContestoAnalisi INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idContesto INT,
	note TEXT,
	nDimensioni INT,
	nMisure INT,
	proiezioneContesto TEXT
);

CREATE TABLE StatDatiContestoAnalisiVar(
	idStatDatiContestoAnalisiVar INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiContestoAnalisi INT,
	idStatVar INT,
	note TEXT,
	minimum DOUBLE,
	maximum DOUBLE,
	mean DOUBLE,
	sd DOUBLE,
	variance DOUBLE,
	varCoeff DOUBLE,
	filtro TEXT
);

CREATE TABLE StatDatiTrain(
	idStatDatiTrain INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdTrain INT,
	note TEXT,
	nDimensioni INT,
	nMisure INT
);

CREATE TABLE StatDatiTrainVar(
	idStatDatiTrainVar INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiTrain INT,
	idStatVar INT,
	note TEXT,
	nMisure INT,
	minimum DOUBLE,
	maximum DOUBLE,
	mean DOUBLE,
	sd DOUBLE,
	variance DOUBLE,
	varCoeff DOUBLE
);

CREATE TABLE StatDatiTrainCentro(
	idStatDatiTrainCentro INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiTrain INT,
	idStatVar INT,
	note TEXT,
	aritmetica DOUBLE,
	geometrica DOUBLE,
	quadratica DOUBLE,
	armonica DOUBLE,
	moda DOUBLE,
	mediana DOUBLE
);

CREATE TABLE StatDatiTrainAsim(
	idStatDatiTrainAsim INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiTrain INT,
	idStatVar INT,
	note TEXT,
	mediaModa DOUBLE,
	coefPearson1 DOUBLE,
	coefPearson2 DOUBLE
);

CREATE TABLE StatRisTrain(
	idStatRisTrain INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdTrain INT,
	note TEXT,
	nDimensioni INT,
	nMisure INT
);

CREATE TABLE StatRisTrainVar(
	idStatRisTrainVar INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatRisTrain INT,
	idStatVar INT,
	note TEXT,
	minimum DOUBLE,
	maximum DOUBLE,
	mean DOUBLE,
	sd DOUBLE,
	variance DOUBLE,
	varCoeff DOUBLE
);

CREATE TABLE StatRisTrainCentro(
	idStatRisTrainCentro INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatRisTrain INT,
	idStatVar INT,
	note TEXT,
	aritmetica DOUBLE,
	geometrica DOUBLE,
	quadratica DOUBLE,
	armonica DOUBLE,
	moda DOUBLE,
	mediana DOUBLE
);

CREATE TABLE StatRisTrainAsim(
	idStatRisTrainAsim INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatRisTrain INT,
	idStatVar INT,
	note TEXT, 
	mediaModa DOUBLE,
	coefPearson1 DOUBLE,
	coefPearson2 DOUBLE
);

/*****************************************
 */
CREATE TABLE StatDatiTest(
	idStatDatiTest INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idTest INT,
	note TEXT, 
	nDimensioni INT,
	nMisure INT
);

CREATE TABLE StatDatiTestVar(
	idStatDatiTestVar INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiTest INT,
	idStatVar INT,
	note TEXT, 
	minimum DOUBLE,
	maximum DOUBLE,
	mean DOUBLE,
	sd DOUBLE,
	variance DOUBLE,
	varCoeff DOUBLE
);

CREATE TABLE StatDatiTestCentro(
	idStatDatiTestCentro INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiTest INT,
	idStatVar INT,
	note TEXT, 
	aritmetica DOUBLE,
	geometrica DOUBLE,
	quadratica DOUBLE,
	armonica DOUBLE,
	moda DOUBLE,
	mediana DOUBLE
);

CREATE TABLE StatDatiTestAsim(
	idStatDatiTestAsim INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiTest INT,
	idStatVar INT,
	note TEXT, 
	mediaModa DOUBLE,
	coefPearson1 DOUBLE,
	coefPearson2 DOUBLE
);

CREATE TABLE StatRisTest(
	idStatRisTest INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idTest INT,
	note TEXT, 
	nDimensioni INT,
	nMisure INT
);

CREATE TABLE StatRisTestVar(
	idStatRisTestVar INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatRisTest INT,
	idStatVar INT,
	note TEXT, 
	minimum DOUBLE,
	maximum DOUBLE,
	mean DOUBLE,
	sd DOUBLE,
	variance DOUBLE,
	varCoeff DOUBLE
);

CREATE TABLE StatRisTestCentro(
	idStatRisTestCentro INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiTest INT,
	idStatVar INT,
	note TEXT, 
	aritmetica DOUBLE,
	geometrica DOUBLE,
	quadratica DOUBLE,
	armonica DOUBLE,
	moda DOUBLE,
	mediana DOUBLE
);

CREATE TABLE StatRisTestAsim(
	idStatRisTestAsim INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiTest INT,
	idStatVar INT,
	note TEXT, 
	mediaModa DOUBLE,
	coefPearson1 DOUBLE,
	coefPearson2 DOUBLE
);

/************************************
da fare i componenti php
*/

CREATE TABLE StatCompDatiTrainTestScost(
	idStatCompTrainTestScost INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idRevisione INT,
	note TEXT, 
	r_min DOUBLE,
	r_max DOUBLE,
	r_mean DOUBLE,
	r_sd DOUBLE,
	r_var DOUBLE,
	r_varCoeff DOUBLE
);

CREATE TABLE StatCompDatiTrainTestIndip(
	idStatDatiTrainIndip INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiTrain INT,
	idStatVar1 INT,
	idStatVar2 INT,
	note TEXT, 
	chi2 DOUBLE,
	df DOUBLE,
	pValue DOUBLE,
	phi DOUBLE,
	coeffContingenza DOUBLE,
	vCramer DOUBLE,
	verosimiglianza DOUBLE
);

CREATE TABLE StatCompDatiTrainTestCorrel(
	idStatCompDatiTrainTestCorrel INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiTrain INT,
	idStatVar1 INT,
	idStatVar2 INT,
	note TEXT, 
	r DOUBLE,
	95CI DOUBLE,
	t DOUBLE,
	Spearman DOUBLE,
	Pearson DOUBLE
);

CREATE TABLE StatCompRisTrainTestScost(
	idStatCompRisTrainTestScost INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idRevisione INT,
	note TEXT, 
	r_min DOUBLE,
	r_max DOUBLE,
	r_mean DOUBLE,
	r_sd DOUBLE,
	r_var DOUBLE,
	r_varCoeff DOUBLE
);

CREATE TABLE StatCompRisTrainTestIndip(
	idStatCompRisTrainTestIndip INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiTrain INT,
	idStatVar1 INT,
	idStatVar2 INT,
	note TEXT, 
	chi2 DOUBLE,
	df DOUBLE,
	pValue DOUBLE,
	phi DOUBLE,
	coeffContingenza DOUBLE,
	vCramer DOUBLE,
	verosimiglianza DOUBLE
);

CREATE TABLE StatCompRisTrainTestCorr(
	idStatCompRisTrainTestCorr INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStatDatiTrain INT,
	idStatVar1 INT,
	idStatVar2 INT,
	note TEXT, 
	r DOUBLE,
	95CI DOUBLE,
	t DOUBLE,
	Spearman DOUBLE,
	Pearson DOUBLE
);

/*
tipi categoriali e classificatiri ricorsivi
*/

CREATE TABLE CategoriaVar(
	idCategoriaVar INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idCategoriaVarGen INT, 
	nome varchar(50),
	descrizione text
	);

CREATE TABLE CategoriaDati(
	idCategoriaEvento INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idCategoriaEventoGen, 
	nome varchar(50),
	descrizione text
	);

CREATE TABLE CategoriaAlg(
	idCategoriaAlg INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idCategoriaAlgGen INT, 
	nome varchar(50),
	descrizione text
	);

CREATE TABLE ValDAAlg(
	idValDAAlg INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nome varchar(50),
	descrizione text, 
	ordine INT
	);

CREATE TABLE ValDASpazio(
	idValDASpazio INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nome varchar(50),
	descrizione text, 
	ordine INT
	);

/*
classificazioni, capacità e ranking
*/

CREATE TABLE ClassifAlg(
	idClassifAlg INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idAlgoritmo INT, 
	idCategoriaAlg INT, 
	note
	);

CREATE TABLE ClassifEvento(
	idClassifEvento INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idStatEvento INT, 
	idCategoriaEvento INT, 
	note
	);

CREATE TABLE ClassifContesto(
	idClassifContesto INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idStatContesto INT, 
	idCategoriaEvento INT, 
	note
	);

CREATE TABLE ClassifContestoAnalisi(
	idClassifContestoAnalisi INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idStatDatiContestoAnalisi INT, 
	idCategoriaEvento INT, 
	note
	);

CREATE TABLE ClassifVariabile(
	idClassifVar INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idStatVar INT, 
	idCategoriaVariabile INT, 
	note
	);

CREATE TABLE StatCapacitaDescr(
	idStatCapacitaDescr INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idStatDatiTrainVar INT, 
	idStatRisTrainVar INT, 
	note, 
	dMin, 
	dMax, 
	dMean, 
	dSd, 
	dVar, 
	dVarCoeff
	);

CREATE TABLE StatCapacitaPredit(
	idStatCapacitaPred INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idStatDatiTestVar INT, 
	idStatRisTestVar INT, 
	note, 
	dMin, 
	dMax, 
	dMean, 
	dSd, 
	dVar, 
	dVarCoeff
	);

CREATE TABLE StatCapacitaEsplic(
	idStatCapacitaEspl INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idStatCompDatiTrainTestCorrel INT, 
	idStatCompRisTrainTestCorrel INT, 
	note, 
	dr, 
	d95CI, 
	dt, 
	dSpearman, 
	dPearson
	);
	
CREATE TABLE RankAlg(
	idRankAlg INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idAlgoritmo INT, 
	efficienza, 
	nRequisiti, 
	idValDAAlg
	);

CREATE TABLE RankAlgContesto(
	idRankAlgContesto INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idAlgoritmo INT, 
	idContesto INT, 
	idStatCapacitaDescr INT, 
	idStatCapacitaPredit INT, 
	idStatCapacitaEsplic INT, 
	idValDASpazio INT
	);

CREATE TABLE RankAlgContestoNorm(
	idRankAlgContestoNorm INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idAlgoritmo INT, 
	idContesto INT, 
	idStatCapacitaDescr INT, 
	idStatCapacitaPredit INT, 
	idStatCapacitaEsplic INT, 
	idValDASpazio INT
	);
