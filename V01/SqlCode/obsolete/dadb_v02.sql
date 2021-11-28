SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS dadb DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE dadb;

DROP TABLE IF EXISTS alg;
CREATE TABLE IF NOT EXISTS alg (
  idAlg int(11) NOT NULL AUTO_INCREMENT,
  idAlgState int(11) DEFAULT NULL,
  idalgcat int(11) DEFAULT NULL,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  fileRefProc varchar(200) DEFAULT NULL,
  PRIMARY KEY (idAlg)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS algcat;
CREATE TABLE IF NOT EXISTS algcat (
  IdAlgCat int(11) NOT NULL AUTO_INCREMENT,
  IdAlgCatPar int(11) DEFAULT NULL,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  PRIMARY KEY (IdAlgCat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS algdavl;
CREATE TABLE IF NOT EXISTS algdavl (
  idAlgDAVl int(11) NOT NULL AUTO_INCREMENT,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  ordine int(11) DEFAULT NULL,
  PRIMARY KEY (idAlgDAVl)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS algparam;
CREATE TABLE IF NOT EXISTS algparam (
  idAlgParam int(11) NOT NULL AUTO_INCREMENT,
  IdAlgCatParam int(11) DEFAULT NULL,
  idAlg int(11) DEFAULT NULL,
  vl varchar(30) DEFAULT NULL,
  PRIMARY KEY (idAlgParam)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS algparamtype;
CREATE TABLE IF NOT EXISTS algparamtype (
  idAlgParamType int(11) NOT NULL AUTO_INCREMENT,
  IdParamType int(11) DEFAULT NULL,
  idAlg int(11) DEFAULT NULL,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  vlDefault varchar(20) DEFAULT NULL,
  PRIMARY KEY (IdAlgParamType)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS algparamtest;
CREATE TABLE IF NOT EXISTS algparamtest (
  idAlgParamtest int(11) NOT NULL AUTO_INCREMENT,
  idAlgParam int(11) DEFAULT NULL,
  IdTrain int(11) DEFAULT NULL,
  IdAlgCatParam int(11) DEFAULT NULL,
  vl varchar(20) DEFAULT NULL,
  PRIMARY KEY (idAlgParamtest)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS AlgCatParam;
CREATE TABLE IF NOT EXISTS AlgCatParam (
  IdAlgCatParam int(11) NOT NULL AUTO_INCREMENT,
  idAlg int(11) DEFAULT NULL,
  IdParamType int(11) DEFAULT NULL,
  PRIMARY KEY (IdAlgCatParam)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS algRnk;
CREATE TABLE IF NOT EXISTS algRnk (
  idAlgRnk int(11) NOT NULL AUTO_INCREMENT,
  idAlg int(11) DEFAULT NULL,
  nReq int(11) DEFAULT NULL,
  idAlgDAVl int(11) DEFAULT NULL,
  PRIMARY KEY (idAlgRnk)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS algCntxRnk;
CREATE TABLE IF NOT EXISTS AlgCntxRnk (
  idAlgCntxRnk int(11) NOT NULL AUTO_INCREMENT,
  IdAn int(11) DEFAULT NULL,
  idDescrCapStat int(11) DEFAULT NULL,
  idPredCapStat int(11) DEFAULT NULL,
  idExplCapStat int(11) DEFAULT NULL,
  idSpaceDAVl int(11) DEFAULT NULL,
  PRIMARY KEY (idAlgCntxRnk)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS algCntxRnkNorm;
CREATE TABLE IF NOT EXISTS AlgCntxRnknorm (
  idAlgCntxRnkNorm int(11) NOT NULL AUTO_INCREMENT,
  IdAn int(11) DEFAULT NULL,
  idDescrCapStat int(11) DEFAULT NULL,
  idPredCapStat int(11) DEFAULT NULL,
  idExplCapStat int(11) DEFAULT NULL,
  idSpaceDAVl int(11) DEFAULT NULL,
  PRIMARY KEY (idAlgCntxRnkNorm)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS algstate;
CREATE TABLE IF NOT EXISTS algstate (
  idAlgState int(11) NOT NULL AUTO_INCREMENT,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  PRIMARY KEY (idAlgState)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS algtrainparam;
CREATE TABLE IF NOT EXISTS algtrainparam (
  idAlgTrainParam int(11) NOT NULL AUTO_INCREMENT,
  idAlgParam int(11) DEFAULT NULL,
  IdTrain int(11) DEFAULT NULL,
  IdAlgCatParam int(11) DEFAULT NULL,
  vl varchar(30) DEFAULT NULL,
  PRIMARY KEY (idAlgTrainParam)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS algcatparam;
CREATE TABLE IF NOT EXISTS algcatparam (
  IdAlgCatParam int(11) NOT NULL AUTO_INCREMENT,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  unit varchar(20) DEFAULT NULL,
  PRIMARY KEY (IdAlgCatParam)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS an;
CREATE TABLE IF NOT EXISTS an (
  IdAn int(11) NOT NULL AUTO_INCREMENT,
  idPrj int(11) DEFAULT NULL,
  idAlg int(11) DEFAULT NULL,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  PRIMARY KEY (IdAn)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS clean;
CREATE TABLE IF NOT EXISTS clean (
  IdClean int(11) NOT NULL AUTO_INCREMENT,
  idPrj int(11) DEFAULT NULL,
  ctsd varchar(300) DEFAULT NULL,
  cnsd varchar(300) DEFAULT NULL,
  note text DEFAULT NULL,
  PRIMARY KEY (IdClean)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS cntx;
CREATE TABLE IF NOT EXISTS cntx (
  IdCntx int(11) NOT NULL AUTO_INCREMENT,
  idPrj int(11) DEFAULT NULL,
  IdEvnt int(11) DEFAULT NULL,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  fileRefRepoDat varchar(200) DEFAULT NULL,
  fileRefCleanedDat varchar(200) DEFAULT NULL,
  PRIMARY KEY (IdCntx)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS AnCntx;
CREATE TABLE IF NOT EXISTS AnCntx (
  IdAnCntx int(11) NOT NULL AUTO_INCREMENT,
  IdAn int(11) DEFAULT NULL,
  IdCntx int(11) DEFAULT NULL,
  IdSplitType int(11) DEFAULT NULL,
  Nam varchar(50) DEFAULT NULL,
  Descr text DEFAULT NULL,
  fileRefTrainDat varchar(200) DEFAULT NULL,
  fileRefTestDat varchar(200) DEFAULT NULL,
  Regr_Outcome varchar(50) DEFAULT NULL,
  Regr_Vars varchar(200) DEFAULT NULL,
  Regr_CtrlMethod varchar(50) DEFAULT NULL,
  Regr_ModelMethods varchar(200) DEFAULT NULL,
  PRIMARY KEY (IdAnCntx)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS AnCntxstrucstat;
CREATE TABLE IF NOT EXISTS AnCntxstrucstat (
  idStatDatiAnCntx int(11) NOT NULL AUTO_INCREMENT,
  IdAnCntx int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nCols int(11) DEFAULT NULL,
  nRows int(11) DEFAULT NULL,
  colTypes text DEFAULT NULL,
  units text DEFAULT NULL,
  cntxProjection text DEFAULT NULL,
  PRIMARY KEY (idStatDatiAnCntx)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS AnCntxstvarfpstat;
CREATE TABLE IF NOT EXISTS AnCntxstvarfpstat (
  IdAnCntxStVarFpStat int(11) NOT NULL AUTO_INCREMENT,
  IdAnCntx int(11) DEFAULT NULL,
  idStVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nMeasures int(11) DEFAULT NULL,
  MODE double DEFAULT NULL,
  mn double DEFAULT NULL,
  mx double DEFAULT NULL,
  mean double DEFAULT NULL,
  sd double DEFAULT NULL,
  VARIANCE double DEFAULT NULL,
  varCoef double DEFAULT NULL,
  filtr text DEFAULT NULL,
  PRIMARY KEY (IdAnCntxStVarFpStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS cntxstrucstat;
CREATE TABLE IF NOT EXISTS cntxstrucstat (
  IdCntxStrucStat int(11) NOT NULL AUTO_INCREMENT,
  IdCntx int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nCols int(11) DEFAULT NULL,
  nRows int(11) DEFAULT NULL,
  colTypes text DEFAULT NULL,
  units text DEFAULT NULL,
  evntProjection text DEFAULT NULL,
  PRIMARY KEY (IdCntxStrucStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS cntxstvarfpstat;
CREATE TABLE IF NOT EXISTS cntxstvarfpstat (
  idStatDaticntxVar int(11) NOT NULL AUTO_INCREMENT,
  IdCntx int(11) DEFAULT NULL,
  idStVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nMeasures int(11) DEFAULT NULL,
  MODE double DEFAULT NULL,
  mn double DEFAULT NULL,
  mx double DEFAULT NULL,
  mean double DEFAULT NULL,
  sd double DEFAULT NULL,
  VARIANCE double DEFAULT NULL,
  varCoef double DEFAULT NULL,
  filtr text DEFAULT NULL,
  PRIMARY KEY (idStatDaticntxVar)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS comp2stvarscorrstat;
CREATE TABLE IF NOT EXISTS comp2stvarscorrstat (
  idComp2StVarsCorrStat int(11) NOT NULL AUTO_INCREMENT,
  idRev int(11) DEFAULT NULL,
  idStVar1 int(11) DEFAULT NULL,
  idStVar2 int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  r double DEFAULT NULL,
  95CI double DEFAULT NULL,
  t double DEFAULT NULL,
  Spearman double DEFAULT NULL,
  Pearson double DEFAULT NULL,
  PRIMARY KEY (idComp2StVarsCorrStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS comp2stvarsindstat;
CREATE TABLE IF NOT EXISTS comp2stvarsindstat (
  idComp2StVarsIndStat int(11) NOT NULL AUTO_INCREMENT,
  idRev int(11) DEFAULT NULL,
  idStVar1 int(11) DEFAULT NULL,
  idStVar2 int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  chi2 double DEFAULT NULL,
  df double DEFAULT NULL,
  pval double DEFAULT NULL,
  phi double DEFAULT NULL,
  coefPartialContg double DEFAULT NULL,
  vCramer double DEFAULT NULL,
  verosimiglianza double DEFAULT NULL,
  PRIMARY KEY (idComp2StVarsIndStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS compfpstat;
CREATE TABLE IF NOT EXISTS compfpstat (
  idCompFpStat int(11) NOT NULL AUTO_INCREMENT,
  idRev int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  modeRsd double DEFAULT NULL,
  minRsd double DEFAULT NULL,
  maxRsd double DEFAULT NULL,
  rmeanRsd double DEFAULT NULL,
  sdRsd double DEFAULT NULL,
  varRsd double DEFAULT NULL,
  varCoefRsd double DEFAULT NULL,
  PRIMARY KEY (idCompFpStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS compres2stvarscorrstat;
CREATE TABLE IF NOT EXISTS compres2stvarscorrstat (
  idCompRes2StVarsCorrStat int(11) NOT NULL AUTO_INCREMENT,
  idRev int(11) DEFAULT NULL,
  idStVar1 int(11) DEFAULT NULL,
  idStVar2 int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  r double DEFAULT NULL,
  95CI double DEFAULT NULL,
  t double DEFAULT NULL,
  Spearman double DEFAULT NULL,
  Pearson double DEFAULT NULL,
  PRIMARY KEY (idCompRes2StVarsCorrStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS compres2stvarsindstat;
CREATE TABLE IF NOT EXISTS compres2stvarsindstat (
  idCompRes2StVarsIndStat int(11) NOT NULL AUTO_INCREMENT,
  idRev int(11) DEFAULT NULL,
  idStVar1 int(11) DEFAULT NULL,
  idStVar2 int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  chi2 double DEFAULT NULL,
  df double DEFAULT NULL,
  pval double DEFAULT NULL,
  phi double DEFAULT NULL,
  coefPartialContg double DEFAULT NULL,
  vCramer double DEFAULT NULL,
  verosimiglianza double DEFAULT NULL,
  PRIMARY KEY (idCompRes2StVarsIndStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS compresfpstat;
CREATE TABLE IF NOT EXISTS compresfpstat (
  idCompResFpStat int(11) NOT NULL AUTO_INCREMENT,
  idRev int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  modeRsd double DEFAULT NULL,
  minRsd double DEFAULT NULL,
  maxRsd double DEFAULT NULL,
  rmeanRsd double DEFAULT NULL,
  sdRsd double DEFAULT NULL,
  varRsd double DEFAULT NULL,
  varRsdCoef double DEFAULT NULL,
  PRIMARY KEY (idCompResFpStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS descrcapstat;
CREATE TABLE IF NOT EXISTS descrcapstat (
  idDescrCapStat int(11) NOT NULL AUTO_INCREMENT,
  IdTrainStVarFpStat int(11) DEFAULT NULL,
  IdTrainResStVarFpStat int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  dMin double DEFAULT NULL,
  dMax double DEFAULT NULL,
  dMean double DEFAULT NULL,
  dSd double DEFAULT NULL,
  dVar double DEFAULT NULL,
  dVarCoef double DEFAULT NULL,
  PRIMARY KEY (idDescrCapStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS evnt;
CREATE TABLE IF NOT EXISTS evnt (
  IdEvnt int(11) NOT NULL AUTO_INCREMENT,
  idPrj int(11) DEFAULT NULL,
  IdEvntCat int(11) DEFAULT NULL,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  fileRefRepoDat varchar(200) DEFAULT NULL,
  fileRefEvntDat varchar(200) DEFAULT NULL,
  PRIMARY KEY (IdEvnt)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS evntanom;
CREATE TABLE IF NOT EXISTS evntanom (
  IdEvntStVarAnom int(11) NOT NULL AUTO_INCREMENT,
  IdEvnt int(11) DEFAULT NULL,
  nAnom int(11) DEFAULT NULL,
  nNA int(11) DEFAULT NULL,
  nErr int(11) DEFAULT NULL,
  nOtherAnom int(11) DEFAULT NULL,
  nCorrections int(11) DEFAULT NULL,
  PRIMARY KEY (IdEvntStVarAnom)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS evntcat;
CREATE TABLE IF NOT EXISTS evntcat (
  IdEvntCat int(11) NOT NULL AUTO_INCREMENT,
  IdEvntCatPar int(11) DEFAULT NULL,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  PRIMARY KEY (IdEvntCat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS evntstrucstat;
CREATE TABLE IF NOT EXISTS evntstrucstat (
  IdEvntStrucStat int(11) NOT NULL AUTO_INCREMENT,
  IdEvnt int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nCols int(11) DEFAULT NULL,
  nRows int(11) DEFAULT NULL,
  colTypes text DEFAULT NULL,
  units text DEFAULT NULL,
  PRIMARY KEY (IdEvntStrucStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS evntstvaranom;
CREATE TABLE IF NOT EXISTS evntstvaranom (
  IdEvntStVarAnom int(11) NOT NULL AUTO_INCREMENT,
  idStVar int(11) DEFAULT NULL,
  IdEvnt int(11) DEFAULT NULL,
  nAnom int(11) DEFAULT NULL,
  nNA int(11) DEFAULT NULL,
  nErr int(11) DEFAULT NULL,
  nOtherAnom int(11) DEFAULT NULL,
  NaMap text DEFAULT NULL,
  errMap text DEFAULT NULL,
  errVlMap text DEFAULT NULL,
  otherAnomMap text DEFAULT NULL,
  nCorrections int(11) DEFAULT NULL,
  correctionsMap text DEFAULT NULL,
  PRIMARY KEY (IdEvntStVarAnom)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS explcapstat;
CREATE TABLE IF NOT EXISTS explcapstat (
  idExplCapStat int(11) NOT NULL AUTO_INCREMENT,
  idComp2StVarsCorrStat int(11) DEFAULT NULL,
  idCompRes2StVarsCorrStat int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  dr double DEFAULT NULL,
  d95CI double DEFAULT NULL,
  dt double DEFAULT NULL,
  dSpearman double DEFAULT NULL,
  dPearson double DEFAULT NULL,
  PRIMARY KEY (idExplCapStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS opdat;
CREATE TABLE IF NOT EXISTS opdat (
  idOpDat int(11) NOT NULL AUTO_INCREMENT,
  IdClean int(11) DEFAULT NULL,
  idOpDatCat int(11) DEFAULT NULL,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  execOr int(11) DEFAULT NULL,
  PRIMARY KEY (idOpDat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS opdatcat;
CREATE TABLE IF NOT EXISTS opdatcat (
  idOpDatCat int(11) NOT NULL AUTO_INCREMENT,
  idOpDatCatPar int(11) DEFAULT NULL,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  PRIMARY KEY (idOpDatCat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS opdatparam;
CREATE TABLE IF NOT EXISTS opdatparam (
  idTestParam int(11) NOT NULL AUTO_INCREMENT,
  idOpDat int(11) DEFAULT NULL,
  IdParamType int(11) DEFAULT NULL,
  vl varchar(20) DEFAULT NULL,
  PRIMARY KEY (idTestParam)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS opdatparamtype;
CREATE TABLE IF NOT EXISTS opdatparamtype (
  idOpDatParamType int(11) NOT NULL AUTO_INCREMENT,
  idOpDat int(11) DEFAULT NULL,
  IdParamType int(11) DEFAULT NULL,
  PRIMARY KEY (idOpDatParamType)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS paramtype;
CREATE TABLE IF NOT EXISTS paramtype (
  IdParamType int(11) NOT NULL AUTO_INCREMENT,
  IdParamTypeCat int(11) DEFAULT NULL,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  unit varchar(20) DEFAULT NULL,
  vlDefault varchar(20) DEFAULT NULL,
  PRIMARY KEY (IdParamType)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS paramtypecat;
CREATE TABLE IF NOT EXISTS paramtypecat (
  IdParamTypeCat int(11) NOT NULL AUTO_INCREMENT,
  idParamTypeCatPar int(11) DEFAULT NULL,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  PRIMARY KEY (IdParamTypeCat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS predcapstat;
CREATE TABLE IF NOT EXISTS predcapstat (
  idPredCapStat int(11) NOT NULL AUTO_INCREMENT,
  idTestStVarFpStat int(11) DEFAULT NULL,
  idTestResStVarFpStat int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  dMin double DEFAULT NULL,
  dMax double DEFAULT NULL,
  dMean double DEFAULT NULL,
  dSd double DEFAULT NULL,
  dVar double DEFAULT NULL,
  dVarCoef double DEFAULT NULL,
  PRIMARY KEY (idPredCapStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS prj;
CREATE TABLE IF NOT EXISTS prj (
  idPrj int(11) NOT NULL AUTO_INCREMENT,
  idUsr int(11) DEFAULT NULL,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  folderRef varchar(200) DEFAULT NULL,
  IdPrjState int(11) NOT NULL,
  PRIMARY KEY (idPrj)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS prjan;
CREATE TABLE IF NOT EXISTS prjan (
  idPrj int(11) NOT NULL,
  IdAn int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS prjstate;
CREATE TABLE IF NOT EXISTS prjstate (
  IdPrjState int(11) NOT NULL AUTO_INCREMENT,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  PRIMARY KEY (IdPrjState)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS rev;
CREATE TABLE IF NOT EXISTS rev (
  idRev int(11) NOT NULL AUTO_INCREMENT,
  IdAn int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  PRIMARY KEY (idRev)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS rnk;
CREATE TABLE IF NOT EXISTS rnk (
  idRnk int(11) NOT NULL AUTO_INCREMENT,
  IdAn int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  PRIMARY KEY (idRnk)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS spacedavl;
CREATE TABLE IF NOT EXISTS spacedavl (
  idSpaceDAVl int(11) NOT NULL AUTO_INCREMENT,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  ordine int(11) DEFAULT NULL,
  PRIMARY KEY (idSpaceDAVl)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS split;
CREATE TABLE IF NOT EXISTS split (
  idSplit int(11) NOT NULL AUTO_INCREMENT,
  IdSplitType int(11) DEFAULT NULL,
  IdAnCntx int(11) DEFAULT NULL,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  note text DEFAULT NULL,
  PRIMARY KEY (idSplit)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS splitcat;
CREATE TABLE IF NOT EXISTS splitcat (
  IdSplitCat int(11) NOT NULL AUTO_INCREMENT,
  IdSplitCatPar int(11) DEFAULT NULL,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  PRIMARY KEY (IdSplitCat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS SplitType;
CREATE TABLE IF NOT EXISTS SplitType (
  IdSplitType int(11) NOT NULL AUTO_INCREMENT,
  IdSplitCat int(11) DEFAULT NULL,
  Nam varchar(50) DEFAULT NULL,
  Descr text DEFAULT NULL,
  Perc int(2) DEFAULT NULL,
  PRIMARY KEY (IdSplitType)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS RegressionCtrlMethod;
CREATE TABLE IF NOT EXISTS RegressionCtrlMethod (
  IdRegrCtrlMethod int(11) NOT NULL AUTO_INCREMENT,
  Nam varchar(50) DEFAULT NULL,
  Descr text DEFAULT NULL,
  Code int(2) DEFAULT NULL,
  PRIMARY KEY (IdRegrCtrlMethod)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS splitparam;
CREATE TABLE IF NOT EXISTS splitparam (
  idSplitParam int(11) NOT NULL AUTO_INCREMENT,
  idSplit int(11) DEFAULT NULL,
  IdParamType int(11) DEFAULT NULL,
  vl varchar(20) DEFAULT NULL,
  PRIMARY KEY (idSplitParam)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS splitparamtype;
CREATE TABLE IF NOT EXISTS splitparamtype (
  idSplitParamType int(11) NOT NULL AUTO_INCREMENT,
  idSplit int(11) DEFAULT NULL,
  IdParamType int(11) DEFAULT NULL,
  PRIMARY KEY (idSplitParamType)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS stvar;
CREATE TABLE IF NOT EXISTS stvar (
  idStVar int(11) NOT NULL AUTO_INCREMENT,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  unit varchar(20) DEFAULT NULL,
  PRIMARY KEY (idStVar)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS test;
CREATE TABLE IF NOT EXISTS test (
  idTest int(11) NOT NULL AUTO_INCREMENT,
  IdAn int(11) DEFAULT NULL,
  fileRefTestDat varchar(200) DEFAULT NULL,
  fileRefTestRsdat varchar(200) DEFAULT NULL,
  note text DEFAULT NULL,
  PRIMARY KEY (idTest)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS testparam;
CREATE TABLE IF NOT EXISTS testparam (
  idTestParam int(11) NOT NULL AUTO_INCREMENT,
  idAlgAn int(11) DEFAULT NULL,
  IdParamType int(11) DEFAULT NULL,
  idTest int(11) DEFAULT NULL,
  vl varchar(20) DEFAULT NULL,
  PRIMARY KEY (idTestParam)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS testresstrucstat;
CREATE TABLE IF NOT EXISTS testresstrucstat (
  idTestResStrucStat int(11) NOT NULL AUTO_INCREMENT,
  idTest int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nCols int(11) DEFAULT NULL,
  nRows int(11) DEFAULT NULL,
  colTypes text DEFAULT NULL,
  units text DEFAULT NULL,
  PRIMARY KEY (idTestResStrucStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS testresstvarasimstat;
CREATE TABLE IF NOT EXISTS testresstvarasimstat (
  idTestResStVarAsimStat int(11) NOT NULL AUTO_INCREMENT,
  idTest int(11) DEFAULT NULL,
  idStVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  aritMode double DEFAULT NULL,
  coefPearson1 double DEFAULT NULL,
  coefPearson2 double DEFAULT NULL,
  PRIMARY KEY (idTestResStVarAsimStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS testresstvarcentresstat;
CREATE TABLE IF NOT EXISTS testresstvarcentresstat (
  idTestResStVarCentresStat int(11) NOT NULL AUTO_INCREMENT,
  idTest int(11) DEFAULT NULL,
  idStVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  arit double DEFAULT NULL,
  geom double DEFAULT NULL,
  quad double DEFAULT NULL,
  harm double DEFAULT NULL,
  MODE double DEFAULT NULL,
  med double DEFAULT NULL,
  PRIMARY KEY (idTestResStVarCentresStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS testresstvarfpstat;
CREATE TABLE IF NOT EXISTS testresstvarfpstat (
  idTestResStVarFpStat int(11) NOT NULL AUTO_INCREMENT,
  idTest int(11) DEFAULT NULL,
  idStVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nMeasures int(11) DEFAULT NULL,
  MODE double DEFAULT NULL,
  mn double DEFAULT NULL,
  mx double DEFAULT NULL,
  mean double DEFAULT NULL,
  sd double DEFAULT NULL,
  VARIANCE double DEFAULT NULL,
  varCoef double DEFAULT NULL,
  PRIMARY KEY (idTestResStVarFpStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS teststrucstat;
CREATE TABLE IF NOT EXISTS teststrucstat (
  idTestStrucStat int(11) NOT NULL AUTO_INCREMENT,
  idTest int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nCols int(11) DEFAULT NULL,
  nRows int(11) DEFAULT NULL,
  colTypes text DEFAULT NULL,
  units text DEFAULT NULL,
  PRIMARY KEY (idTestStrucStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS teststvarasimstat;
CREATE TABLE IF NOT EXISTS teststvarasimstat (
  idTestStVarAsimStat int(11) NOT NULL AUTO_INCREMENT,
  idTest int(11) DEFAULT NULL,
  idStVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  aritMode double DEFAULT NULL,
  coefPearson1 double DEFAULT NULL,
  coefPearson2 double DEFAULT NULL,
  PRIMARY KEY (idTestStVarAsimStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS teststvarfpstat;
CREATE TABLE IF NOT EXISTS teststvarfpstat (
  idTestStVarFpStat int(11) NOT NULL AUTO_INCREMENT,
  idTest int(11) DEFAULT NULL,
  idStVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nMeasures int(11) DEFAULT NULL,
  MODE double DEFAULT NULL,
  mn double DEFAULT NULL,
  mx double DEFAULT NULL,
  mean double DEFAULT NULL,
  sd double DEFAULT NULL,
  VARIANCE double DEFAULT NULL,
  varCoef double DEFAULT NULL,
  PRIMARY KEY (idTestStVarFpStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS train;
CREATE TABLE IF NOT EXISTS train (
  IdTrain int(11) NOT NULL AUTO_INCREMENT,
  IdAn int(11) DEFAULT NULL,
  fileRefTrainDat varchar(200) DEFAULT NULL,
  fileRefTrainRsdat varchar(200) DEFAULT NULL,
  note text DEFAULT NULL,
  PRIMARY KEY (IdTrain)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS trainparam;
CREATE TABLE IF NOT EXISTS trainparam (
  IdTrainParam int(11) NOT NULL AUTO_INCREMENT,
  idAlgAn int(11) DEFAULT NULL,
  IdParamType int(11) DEFAULT NULL,
  IdTrain int(11) DEFAULT NULL,
  vl varchar(20) DEFAULT NULL,
  PRIMARY KEY (IdTrainParam)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS trainresstrucstat;
CREATE TABLE IF NOT EXISTS trainresstrucstat (
  IdTrainResStrucStat int(11) NOT NULL AUTO_INCREMENT,
  IdTrain int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nCols int(11) DEFAULT NULL,
  nRows int(11) DEFAULT NULL,
  colTypes text DEFAULT NULL,
  units text DEFAULT NULL,
  PRIMARY KEY (IdTrainResStrucStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS trainresstvarasimstat;
CREATE TABLE IF NOT EXISTS trainresstvarasimstat (
  IdTrainResStVarAsimStat int(11) NOT NULL AUTO_INCREMENT,
  IdTrain int(11) DEFAULT NULL,
  idStVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  aritMode double DEFAULT NULL,
  coefPearson1 double DEFAULT NULL,
  coefPearson2 double DEFAULT NULL,
  PRIMARY KEY (IdTrainResStVarAsimStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS trainresstvarcentresstat;
CREATE TABLE IF NOT EXISTS trainresstvarcentresstat (
  IdTrainResStVarCentresStat int(11) NOT NULL AUTO_INCREMENT,
  IdTrain int(11) DEFAULT NULL,
  idStVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  arit double DEFAULT NULL,
  geom double DEFAULT NULL,
  quad double DEFAULT NULL,
  harm double DEFAULT NULL,
  MODE double DEFAULT NULL,
  med double DEFAULT NULL,
  PRIMARY KEY (IdTrainResStVarCentresStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS trainresstvarfpstat;
CREATE TABLE IF NOT EXISTS trainresstvarfpstat (
  IdTrainResStVarFpStat int(11) NOT NULL AUTO_INCREMENT,
  IdTrain int(11) DEFAULT NULL,
  idStVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nMeasures int(11) DEFAULT NULL,
  MODE double DEFAULT NULL,
  mn double DEFAULT NULL,
  mx double DEFAULT NULL,
  mean double DEFAULT NULL,
  sd double DEFAULT NULL,
  VARIANCE double DEFAULT NULL,
  varCoef double DEFAULT NULL,
  PRIMARY KEY (IdTrainResStVarFpStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS trainstrucstat;
CREATE TABLE IF NOT EXISTS trainstrucstat (
  IdTrainStrucStat int(11) NOT NULL AUTO_INCREMENT,
  IdTrain int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nCols int(11) DEFAULT NULL,
  nRows int(11) DEFAULT NULL,
  colTypes text DEFAULT NULL,
  units text DEFAULT NULL,
  PRIMARY KEY (IdTrainStrucStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS trainstvarasimstat;
CREATE TABLE IF NOT EXISTS trainstvarasimstat (
  IdTrainStVarAsimStat int(11) NOT NULL AUTO_INCREMENT,
  IdTrain int(11) DEFAULT NULL,
  idStVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  aritMode double DEFAULT NULL,
  coefPearson1 double DEFAULT NULL,
  coefPearson2 double DEFAULT NULL,
  PRIMARY KEY (IdTrainStVarAsimStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS trainstvarfpstat;
CREATE TABLE IF NOT EXISTS trainstvarfpstat (
  IdTrainStVarFpStat int(11) NOT NULL AUTO_INCREMENT,
  IdTrain int(11) DEFAULT NULL,
  idStVar int(11) DEFAULT NULL,
  note text DEFAULT NULL,
  nMeasures int(11) DEFAULT NULL,
  MODE double DEFAULT NULL,
  mn double DEFAULT NULL,
  mx double DEFAULT NULL,
  mean double DEFAULT NULL,
  sd double DEFAULT NULL,
  VARIANCE double DEFAULT NULL,
  varCoef double DEFAULT NULL,
  PRIMARY KEY (IdTrainStVarFpStat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS usr;
CREATE TABLE IF NOT EXISTS usr (
  idUsr int(11) NOT NULL AUTO_INCREMENT,
  usrNam varchar(30) NOT NULL,
  pwd varchar(30) NOT NULL,
  firstnam varchar(50) NOT NULL,
  nam varchar(50) NOT NULL,
  eMail varchar(100) DEFAULT NULL,
  PRIMARY KEY (idUsr)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO usr (idUsr, usrNam, pwd, firstnam, nam, eMail) VALUES
(1, 'dev', 'dev', 'dev', 'dev', 'dev.dev@gmail.com');

DROP TABLE IF EXISTS stVarCat;
CREATE TABLE IF NOT EXISTS stVarCat (
  idStVarCat int(11) NOT NULL AUTO_INCREMENT,
  idStVarCatPar int(11) DEFAULT NULL,
  nam varchar(50) DEFAULT NULL,
  descr text DEFAULT NULL,
  PRIMARY KEY (idStVarCat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO usr (idUsr, usrNam, pwd, firstnam, nam, eMail) VALUES
(1, 'dev', 'dev', 'dev', 'dev', 'dev.dev@gmail.com');

INSERT INTO `prj` (`idPrj`, `idUsr`, `nam`, `descr`, `folderRef`, `IdPrjState`) VALUES 
(NULL, '1', 'evento test 1', 'evento test 1', NULL, '1');

INSERT INTO `clean` (`IdClean`, `idPrj`, `note`) VALUES 
(NULL, '1', 'clean prj 1');

INSERT INTO `cntx` (`IdCntx`, `idPrj`, `IdEvnt`, `nam`, `descr`, `fileRefRepoDat`, `fileRefCleanedDat`) VALUES 
(NULL, '1', '1', 'Contesto Analisi 1', 'Contesto Analisi 1', NULL, NULL);

INSERT INTO `an` (`IdAn`, `idPrj`, `idAlg`, `nam`, `descr`) VALUES 
(NULL, '1', '1', 'analisi 1', 'analisi 1');

INSERT INTO `AnCntx` (`IdAnCntx`, `IdAn`, `IdCntx`, `idSplitRule`, `nam`, `descr`, `fileRefTrainDat`, `fileRefTestDat`) VALUES 
(NULL, '1', '1', '1', 'Contesto Analisi 1', 'Contesto Analisi 1', NULL, NULL);

INSERT INTO `train` (`IdTrain`, `IdAn`, `fileRefTrainDat`, `fileRefTrainRsdat`, `note`) VALUES 
(NULL, '1', NULL, NULL, 'training 1');

INSERT INTO `test` (`idTest`, `IdAn`, `fileRefTestDat`, `fileRefTestRsdat`, `note`) VALUES 
(NULL, '1', NULL, NULL, 'test 1');

INSERT INTO `rev` (`idRev`, `IdAn`, `note`) VALUES (NULL, '1', 'Revisione 1');

INSERT INTO `rnk` (`idRnk`, `IdAn`, `note`) VALUES (NULL, '1', 'ranking 1');

