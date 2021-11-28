--
-- database: dadb
-- prove di verifica: Data Analysis DB

-- CREATE usr 'm.arcangeli' @'%' IDENTIFIED VIA mysql_native_password USING '***';
-- GRANT ALL PRIVILEGES ON *.* TO 'm.arcangeli' @'%' REQUIRE NONE WITH
-- GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_usr_CONNECTIONS 0;
use dadb;


create table if not exists usr(
	idUsr int not null primary key auto_increment,
	usrNam varchar(30) not null,
	pwd varchar(30) not null,
	firstnam varchar(50) not null,
	nam varchar(50) not null,
	eMail varchar(100)
);

create table if not exists prj(
	idPrj int not null primary key auto_increment,
	idUsr int,
	nam varchar(50),
	descr text,
	folderRef varchar(200),
	IdPrjState int not null
);

create table if not exists prjState(
	IdPrjState int not null primary key auto_increment,
	nam varchar(50),
	descr text
);

create table if not exists prjAn(
	idPrj int not null,
	IdAn int not null
);

create table if not exists an(
	IdAn int not null primary key auto_increment,
	idPrj int,
	idAlg int,
	nam varchar(50),
	descr text
);

create table if not exists evnt(
	IdEvnt int not null primary key auto_increment,
	idPrj int,
	IdEvntCat int,
	nam varchar(50),
	descr text,
	fileRefRepoDat varchar(200),
	fileRefEvntDat varchar(200)
);

create table if not exists cntx(
	IdCntx int not null primary key auto_increment,
	idPrj int,
	IdEvnt int,
	nam varchar(50),
	descr text,
	fileRefRepoDat varchar(200),
	fileRefCleanedDat varchar(200)
);

create table if not exists cntxAn(
	IdCntxAn int not null primary key auto_increment,
	IdAn int,
	IdCntx int,
	idSplitRule int,
	nam varchar(50),
	descr text,
	fileRefTrainDat varchar(200),
	fileRefTestDat varchar(200)
);

create table if not exists algType(
	idAlgType int not null primary key auto_increment,
	nam varchar(50),
	descr text
);

create table if not exists algTypeParam(
	idAlgParamType int not null primary key auto_increment,
	nam varchar(50),
	descr text,
	unit varchar(20)
);

create table if not exists alg(
	idAlg int not null primary key auto_increment,
	idAlgState int,
	idAlgType int,
	nam varchar(50),
	descr text,
	fileRefProc varchar(200)
);

create table if not exists algState(
	idAlgState int not null primary key auto_increment,
	nam varchar(50),
	descr text
);

create table if not exists algParam(
	idAlgParam int not null primary key auto_increment,
	idAlgParamType int,
	idAlg int,
	vl varchar(30)
);

create table if not exists algTrainParam (
	idAlgTrainParam int not null primary key auto_increment,
	idAlgParam int,
	IdTrain int,
	idAlgParamType int,
	vl varchar(30)
);

create table if not exists algParamtest(
	idAlgParamtest int not null primary key auto_increment,
	idAlgParam int,
	IdTrain int,
	idAlgParamType int,
	vl VARCHAR(20)
);

create table if not exists train(
	IdTrain int not null primary key auto_increment,
	IdCntxAn int,
	fileRefTrainDat varchar(200),
	fileRefTrainResDat varchar(200),
	note text
);

create table if not exists test(
	idTest int not null primary key auto_increment,
	IdCntxAn int,
	fileRefTestDat varchar(200),
	fileRefTestResDat varchar(200),
	note text
);

create table if not exists rev(
	idRev int not null primary key auto_increment,
	IdAn int,
	note text
);

create table if not exists rnk(
	idRnk int not null primary key auto_increment,
	IdAn int,
	note text
);

/* -------------------
	Categorie, parametri
*/

create table if not exists paramTypeCat(
	IdParamTypeCat INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idParamTypeCatPar INT, 
	nam VARCHAR(50),
	descr TEXT
	);

create table if not exists paramType(
	IdParamType INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	IdParamTypeCat INT, 
	nam VARCHAR(50),
	descr TEXT,
	unit VARCHAR(20), 
	vlDefault VARCHAR(20)
	);

create table if not exists AlgCat(
	IdAlgCat INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	IdAlgCatPar INT, 
	nam VARCHAR(50),
	descr TEXT
	);

create table if not exists alg(
	idAlg INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idAlgState INT, 
	IdAlgCat INT, 
	nam VARCHAR(50),
	descr TEXT,
	fileRefProc varchar(200)
	);

create table if not exists algParamType(
	idAlgParamType INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idAlg INT, 
	IdParamType INT
	);

create table if not exists algState(
	idAlgState INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nam VARCHAR(50),
	descr TEXT
	);

create table if not exists trainParam(
	IdTrainParam INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idAlgAn INT, 
	IdParamType INT, 
	IdTrain INT, 
	vl VARCHAR(20)
	);

create table if not exists testParam(
	idTestParam INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idAlgAn INT, 
	IdParamType INT, 
	idTest INT, 
	vl VARCHAR(20)
	);

create table if not exists clean(
	IdClean INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	IdCntx INT, 
	IdEvnt INT, 
	note TEXT
	);

create table if not exists opDatCat(
	idOpDatCat INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idOpDatCatPar INT, 
	nam VARCHAR(50),
	descr TEXT
	);

create table if not exists opDat(
	idOpDat INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	IdClean INT, 
	idOpDatCat INT, 
	nam VARCHAR(50),
	descr TEXT,
	execOr INT
	);

create table if not exists opDatParamType(
	idOpDatParamType INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idOpDat INT, 
	IdParamType INT
	);

create table if not exists opDatParam(
	idTestParam INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idOpDat INT, 
	IdParamType INT, 
	vl VARCHAR(20)
	);

create table if not exists splitCat(
	idSplitCat INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idSplitCatPar INT, 
	nam VARCHAR(50),
	descr TEXT
	);

create table if not exists split(
	idSplit INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idSplitCat INT, 
	IdCntxAn INT, 
	note TEXT
	);

create table if not exists splitParamType(
	idSplitParamType INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idSplit INT, 
	IdParamType INT
	);

create table if not exists splitParam(
	idSplitParam INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idSplit INT, 
	IdParamType INT, 
	vl VARCHAR(20)
	);

/*
categories recoursive entities
*/	

create table if not exists varCat(
	idVarCat INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idVarCatPar INT, 
	nam VARCHAR(50),
	descr TEXT
	);

create table if not exists evntCat(
	IdEvntCat INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	IdEvntCatPar INT, 
	nam VARCHAR(50),
	descr TEXT
	);

create table if not exists AlgCat(
	IdAlgCat INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	IdAlgCatPar INT, 
	nam VARCHAR(50),
	descr TEXT
	);

create table if not exists algDAVl(
	idAlgDAVl INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nam VARCHAR(50),
	descr TEXT,
	ordine INT
	);

create table if not exists spaceDAVl(
	idSpaceDAVl INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nam VARCHAR(50),
	descr TEXT,
	ordine INT
	);


/************************************************************
STATS
*******************************************************/
/*****************************************************************************
 struct, fp, centers, asimm, qtl, corr, MAE, RMSE, Rsq, lev-Res, q-qPlot, scLoc, k-fold, anov, moments
 */
 create table if not exists stVar(
	idStVar INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nam VARCHAR(50),
	descr TEXT,
	unit VARCHAR(20)
);

/* STRUC */
create table if not exists evntStrucStat(
	IdEvntStrucStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdEvnt INT,
	note TEXT,
	nCols INT,
	nRows INT,
	colTypes TEXT,
	units TEXT
);

/* not usefull for dirty data */
-- create table if not exists evntStVarStat(
-- 	IdEvntStrucStVarStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
-- 	IdEvnt INT,
-- 	idStVar INT,
-- 	note TEXT,
-- 	mn DOUBLE,
-- 	mx DOUBLE,
-- 	mean DOUBLE,
-- 	sd DOUBLE,
-- 	variance DOUBLE,
-- 	varCoef DOUBLE
-- );

/* ONLY FOR evnt */
create table if not exists evntAnom(
	IdEvntStVarAnom INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdEvnt INT,
	nAnom INT,
	nNA INT,
	nErr INT,
	nOtherAnom INT,
	nCorrections INT
);

create table if not exists evntStVarAnom(
	IdEvntStVarAnom INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idStVar INT,
	IdEvnt INT,
	nAnom INT,
	nNA INT,
	nErr INT,
	nOtherAnom INT,
	NaMap TEXT,
	errMap TEXT,
	errVlMap TEXT,
	otherAnomMap TEXT,
	nCorrections INT,
	correctionsMap TEXT
);

/* CNTX */
create table if not exists cntxStrucStat(
	IdCntxStrucStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdCntx INT,
	note TEXT,
	nCols INT,
	nRows INT,
	colTypes TEXT,
	units TEXT,
	evntProjection TEXT
);

/* FOR SPACES */
create table if not exists cntxStVarFpStat(
	idStatDaticntxVar INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdCntx INT,
	idStVar INT,
	note TEXT,
	nMeasures INT,
	mode DOUBLE,
	mn DOUBLE,
	mx DOUBLE,
	mean DOUBLE,
	sd DOUBLE,
	variance DOUBLE,
	varCoef DOUBLE,
	filtr TEXT
);

/* CNTXAN */
create table if not exists cntxAnStrucStat(
	idStatDaticntxAn INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdCntxAn INT,
	note TEXT,
	nCols INT,
	nRows INT,
	colTypes TEXT,
	units TEXT,
	cntxProjection TEXT
);

create table if not exists cntxAnStVarFpStat(
	IdCntxAnStVarFpStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdCntxAn INT,
	idStVar INT,
	note TEXT,
	nMeasures INT,
	mode DOUBLE,
	mn DOUBLE,
	mx DOUBLE,
	mean DOUBLE,
	sd DOUBLE,
	variance DOUBLE,
	varCoef DOUBLE,
	filtr TEXT
);

/* TRAIN */
create table if not exists trainStrucStat(
	IdTrainStrucStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdTrain INT,
	note TEXT,
	nCols INT,
	nRows INT,
	colTypes TEXT,
	units TEXT
);

create table if not exists trainStVarFpStat(
	IdTrainStVarFpStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdTrain INT,
	idStVar INT,
	note TEXT,
	nMeasures INT,
	mode DOUBLE,
	mn DOUBLE,
	mx DOUBLE,
	mean DOUBLE,
	sd DOUBLE,
	variance DOUBLE,
	varCoef DOUBLE
);

create table if not exists train(
	IdTrainStVarCentresStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdTrain INT,
	idStVar INT,
	note TEXT,
	arit DOUBLE,
	geom DOUBLE,
	quad DOUBLE,
	harm DOUBLE,
	mode DOUBLE,
	med DOUBLE
);

create table if not exists trainStVarAsimStat(
	IdTrainStVarAsimStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdTrain INT,
	idStVar INT,
	note TEXT,
	aritMode DOUBLE,
	coefPearson1 DOUBLE,
	coefPearson2 DOUBLE
);

/* train results */
create table if not exists trainResStrucStat(
	IdTrainResStrucStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdTrain INT,
	note TEXT,
	nCols INT,
	nRows INT,
	colTypes TEXT,
	units TEXT
);

create table if not exists trainResStVarFpStat(
	IdTrainResStVarFpStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdTrain INT,
	idStVar INT,
	note TEXT,
	nMeasures INT,
	mode DOUBLE,
	mn DOUBLE,
	mx DOUBLE,
	mean DOUBLE,
	sd DOUBLE,
	variance DOUBLE,
	varCoef DOUBLE
);

create table if not exists trainResStVarCentresStat(
	IdTrainResStVarCentresStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdTrain INT,
	idStVar INT,
	note TEXT,
	arit DOUBLE,
	geom DOUBLE,
	quad DOUBLE,
	harm DOUBLE,
	mode DOUBLE,
	med DOUBLE
);

create table if not exists trainResStVarAsimStat(
	IdTrainResStVarAsimStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	IdTrain INT,
	idStVar INT,
	note TEXT, 
	aritMode DOUBLE,
	coefPearson1 DOUBLE,
	coefPearson2 DOUBLE
);

/* TEST */
create table if not exists testStrucStat(
	idTestStrucStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idTest INT,
	note TEXT,
	nCols INT,
	nRows INT,
	colTypes TEXT,
	units TEXT
);

create table if not exists testStVarFpStat(
	idTestStVarFpStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idTest INT,
	idStVar INT,
	note TEXT,
	nMeasures INT,
	mode DOUBLE,
	mn DOUBLE,
	mx DOUBLE,
	mean DOUBLE,
	sd DOUBLE,
	variance DOUBLE,
	varCoef DOUBLE
);

create table if not exists test(
	idTestStVarCentresStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idTest INT,
	idStVar INT,
	note TEXT,
	arit DOUBLE,
	geom DOUBLE,
	quad DOUBLE,
	harm DOUBLE,
	mode DOUBLE,
	med DOUBLE
);

create table if not exists testStVarAsimStat(
	idTestStVarAsimStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idTest INT,
	idStVar INT,
	note TEXT,
	aritMode DOUBLE,
	coefPearson1 DOUBLE,
	coefPearson2 DOUBLE
);

/* train results */
create table if not exists testResStrucStat(
	idTestResStrucStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idTest INT,
	note TEXT,
	nCols INT,
	nRows INT,
	colTypes TEXT,
	units TEXT
);

create table if not exists testResStVarFpStat(
	idTestResStVarFpStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idTest INT,
	idStVar INT,
	note TEXT,
	nMeasures INT,
	mode DOUBLE,
	mn DOUBLE,
	mx DOUBLE,
	mean DOUBLE,
	sd DOUBLE,
	variance DOUBLE,
	varCoef DOUBLE
);

create table if not exists testResStVarCentresStat(
	idTestResStVarCentresStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idTest INT,
	idStVar INT,
	note TEXT,
	arit DOUBLE,
	geom DOUBLE,
	quad DOUBLE,
	harm DOUBLE,
	mode DOUBLE,
	med DOUBLE
);

create table if not exists testResStVarAsimStat(
	idTestResStVarAsimStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idTest INT,
	idStVar INT,
	note TEXT, 
	aritMode DOUBLE,
	coefPearson1 DOUBLE,
	coefPearson2 DOUBLE
);

/* COMP part of the REVIEW phase*/

create table if not exists compFpStat(
	idCompFpStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idRev INT,
	note TEXT, 
	modeRsd DOUBLE,
	minRsd DOUBLE,
	maxRsd DOUBLE,
	rmeanRsd DOUBLE,
	sdRsd DOUBLE,
	varRsd DOUBLE,
	varCoefRsd DOUBLE
);

create table if not exists comp2StVarsIndStat(
	idComp2StVarsIndStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idRev INT,
	idStVar1 INT,
	idStVar2 INT,
	note TEXT, 
	chi2 DOUBLE,
	df DOUBLE,
	pval DOUBLE,
	phi DOUBLE,
	coefPartialContg DOUBLE,
	vCramer DOUBLE,
	verosimiglianza DOUBLE
);

create table if not exists comp2StVarsCorrStat(
	idComp2StVarsCorrStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idRev INT,
	idStVar1 INT,
	idStVar2 INT,
	note TEXT, 
	r DOUBLE,
	95CI DOUBLE,
	t DOUBLE,
	Spearman DOUBLE,
	Pearson DOUBLE
);

create table if not exists compResFpStat(
	idCompResFpStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idRev INT,
	note TEXT, 
	modeRsd DOUBLE,
	minRsd DOUBLE,
	maxRsd DOUBLE,
	rmeanRsd DOUBLE,
	sdRsd DOUBLE,
	varRsd DOUBLE,
	varRsdCoef DOUBLE
);

create table if not exists compRes2StVarsIndStat(
	idCompRes2StVarsIndStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idRev INT,
	idStVar1 INT,
	idStVar2 INT,
	note TEXT, 
	chi2 DOUBLE,
	df DOUBLE,
	pval DOUBLE,
	phi DOUBLE,
	coefPartialContg DOUBLE,
	vCramer DOUBLE,
	verosimiglianza DOUBLE
);

create table if not exists compRes2StVarsCorrStat(
	idCompRes2StVarsCorrStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	idRev INT,
	idStVar1 INT,
	idStVar2 INT,
	note TEXT, 
	r DOUBLE,
	95CI DOUBLE,
	t DOUBLE,
	Spearman DOUBLE,
	Pearson DOUBLE
);

/* REVIEW AND rnk*/

create table if not exists descrCapStat(
	idDescrCapStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	IdTrainStVarFpStat INT, 
	IdTrainResStVarFpStat INT, 
	note TEXT, 
	dMin DOUBLE, 
	dMax DOUBLE, 
	dMean DOUBLE, 
	dSd DOUBLE, 
	dVar DOUBLE, 
	dVarCoef DOUBLE
	);

create table if not exists predCapStat(
	idPredCapStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idTestStVarFpStat INT, 
	idTestResStVarFpStat INT, 
	note TEXT, 
	dMin DOUBLE, 
	dMax DOUBLE, 
	dMean DOUBLE, 
	dSd DOUBLE, 
	dVar DOUBLE, 
	dVarCoef DOUBLE
	);

create table if not exists explCapStat(
	idExplCapStat INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idComp2StVarsCorrStat INT, 
	idCompRes2StVarsCorrStat INT, 
	note TEXT, 
	dr DOUBLE, 
	d95CI DOUBLE, 
	dt DOUBLE, 
	dSpearman DOUBLE, 
	dPearson DOUBLE
	);

/* ALG rnk */
create table if not exists algrnk(
	idAlgrnk INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	idAlg INT, 
	nReq INT, 
	idAlgDAVl INT
	);

create table if not exists algrnkCntx(
	idalgrnkCntx INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	IdAn INT, 
	idDescrCapStat INT, 
	idPredCapStat INT, 
	idExplCapStat INT, 
	idSpaceDAVl INT
	);

create table if not exists algrnkCntxNorm(
	idAlgrnkCntxNorm INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	IdAn INT, 
	idDescrCapStat INT, 
	idPredCapStat INT, 
	idExplCapStat INT, 
	idSpaceDAVl INT
	);

