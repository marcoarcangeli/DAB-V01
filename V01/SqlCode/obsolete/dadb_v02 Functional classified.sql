STATISTICS TABLES
AnCntxstrucstat (idStatDatiAnCntx, IdAnCntx, note, nCols, nRows, colTypes, units, cntxProjection)
AnCntxstvarfpstat (IdAnCntxStVarFpStat, IdAnCntx, idStVar, note, nMeasures, MODE, mn, mx, mean, sd, VARIANCE, varCoef, filtr)
cntxstrucstat (IdCntxStrucStat, IdCntx, note, nCols, nRows, colTypes, units, evntProjection)
cntxstvarfpstat (idStatDaticntxVar, IdCntx, idStVar, note, nMeasures, MODE, mn, mx, mean, sd, VARIANCE, varCoef, filtr)
comp2stvarscorrstat (idComp2StVarsCorrStat, idRev, idStVar1, idStVar2, note, r, 95CI, t, Spearman, Pearson)
comp2stvarsindstat (idComp2StVarsIndStat, idRev, idStVar1, idStVar2, note, chi2, df, pval, phi, coefPartialContg, vCramer, verosimiglianza)
compfpstat (idCompFpStat, idRev, note, modeRsd, minRsd, maxRsd, rmeanRsd, sdRsd, varRsd, varCoefRsd, idCompFpStat)
compres2stvarscorrstat (idCompRes2StVarsCorrStat, idRev, idStVar1, idStVar2, note, r, 95CI, t, Spearman, Pearson)
compres2stvarsindstat (idCompRes2StVarsIndStat, idRev, idStVar1, idStVar2, note, chi2, df, pval, phi, coefPartialContg, vCramer, verosimiglianza)
compresfpstat (idCompResFpStat, idRev, note, modeRsd, minRsd, maxRsd, rmeanRsd, sdRsd, varRsd, varRsdCoef, idCompResFpStat)
descrcapstat (idDescrCapStat, IdTrainStVarFpStat, IdTrainResStVarFpStat, note, dMin, dMax, dMean, dSd, dVar, dVarCoef)
evntanom (IdEvntStVarAnom, IdEvnt, nAnom, nNA, nErr, nOtherAnom, nCorrections)
evntstrucstat (IdEvntStrucStat, IdEvnt, note, nCols, nRows, colTypes, units)
evntstvaranom (IdEvntStVarAnom, idStVar, IdEvnt, nAnom, nNA, nErr, nOtherAnom, NaMap, errMap, errVlMap, otherAnomMap, nCorrections, correctionsMap)
explcapstat (idExplCapStat, idComp2StVarsCorrStat, idCompRes2StVarsCorrStat, note, dr, d95CI, dt, dSpearman, dPearson)
predcapstat (idPredCapStat, idTestStVarFpStat, idTestResStVarFpStat, note, dMin, dMax, dMean, dSd, dVar, dVarCoef)
testresstrucstat (idTestResStrucStat, idTest, note, nCols, nRows, colTypes, units)
testresstvarasimstat (idTestResStVarAsimStat, idTest, idStVar, note, aritMode, coefPearson1, coefPearson2)
testresstvarcentresstat (idTestResStVarCentresStat, idTest, idStVar, note, arit, geom, quad, harm, MODE, med)
testresstvarfpstat (idTestResStVarFpStat, idTest, idStVar, note, nMeasures, MODE, mn, mx, mean, sd, VARIANCE, varCoef)
teststrucstat (idTestStrucStat, idTest, note, nCols, nRows, colTypes, units)
teststvarasimstat (idTestStVarAsimStat, idTest, idStVar, note, aritMode, coefPearson1, coefPearson2)
teststvarfpstat (idTestStVarFpStat, idTest, idStVar, note, nMeasures, MODE, mn, mx, mean, sd, VARIANCE, varCoef)
trainresstrucstat (IdTrainResStrucStat, IdTrain, note, nCols, nRows, colTypes, units)
trainresstvarasimstat (IdTrainResStVarAsimStat, IdTrain, idStVar, note, aritMode, coefPearson1, coefPearson2)
trainresstvarcentresstat (IdTrainResStVarCentresStat, IdTrain, idStVar, note, arit, geom, quad, harm, MODE, med)
trainresstvarfpstat (IdTrainResStVarFpStat, IdTrain, idStVar, note, nMeasures, MODE, mn, mx, mean, sd, VARIANCE, varCoef)
trainstrucstat (IdTrainStrucStat, IdTrain, note, nCols, nRows, colTypes, units, IdTrainStrucStat)
trainstvarasimstat (IdTrainStVarAsimStat, IdTrain, idStVar, note, aritMode, coefPearson1, coefPearson2)
trainstvarfpstat (IdTrainStVarFpStat, IdTrain, idStVar, note, nMeasures, MODE, mn, mx, mean, sd, VARIANCE, varCoef)

DESCRIPTIVE TABLES
algcat (IdAlgCat, IdAlgCatPar, nam, descr)
algstate (idAlgState, nam, descr)
evntcat (IdEvntCat, IdEvntCatPar, nam, descr)
opdatcat (idOpDatCat, idOpDatCatPar, nam, descr)
paramtype (IdParamType, IdParamTypeCat, nam, descr, unit, vlDefault)
paramtypecat (IdParamTypeCat, idParamTypeCatPar, nam, descr)
prjstate (IdPrjState, nam, descr)
splitcat (idSplitCat, idSplitCatPar, nam, descr)
splittype (idSplitType, idSplitCat, nam, descr, perc)
stVarCat (idStVarCat, idStVarCatPar, nam, descr)

todo: RegrCtrlMethod(IdRegrCtrlMethod, Nam, Descr, code)

PARAMS MANAGEMENT
AlgParam (idAlgParam, IdAlgParamType, idAlg, vl)
AlgParamType (IdAlgParamType, idAlg, IdParamType, Nam, Descr, vlDefault) // può sovrapporre i valori di nome, descr, e default

OpDatParam (idTestParam, idOpDat, IdParamType, vl)
OpDatParamType (idOpDatParamType, idOpDat, IdParamType, Nam, Descr, vlDefault)
SplitParam (idSplitParam, idSplit, IdParamType, vl)
SplitParamType (idSplitParamType, idSplit, IdParamType, Nam, Descr, vlDefault)

algparamtest (idAlgParamtest, idAlgParam, IdTrain, IdAlgCatParam, vl)
algtrainparam (idAlgTrainParam, idAlgParam, IdTrain, IdAlgCatParam, vl)
testparam (idTestParam, idAlgAn, IdParamType, idTest, vl)
trainparam (IdTrainParam, idAlgAn, IdParamType, IdTrain, vl, IdTrainParam)

SPACES TABLES
algRnk (idAlgRnk, idAlg, nReq, idAlgDAVl, idAlgRnk)
algCntxRnk (idAlgCntxRnk, IdAn, idDescrCapStat, idPredCapStat, idExplCapStat, idSpaceDAVl)
algCntxRnkNorm (idAlgCntxRnkNorm, IdAn, idDescrCapStat, idPredCapStat, idExplCapStat, idSpaceDAVl)

PROCESS TABLES
alg (idAlg, idAlgState, idalgcat, nam, descr, fileRefProc)
algDaVl (idAlgDAVl, nam, descr, ordine)
an (IdAn, idPrj, idAlg, nam, descr)
clean (IdClean, idPrj, note)
cntx (IdCntx, idPrj, IdEvnt, nam, descr, fileRefDat)
AnCntx (IdAnCntx, IdAn, IdCntx, idSplitRule, nam, descr, fileRefTrainDat, fileRefTestDat)
evnt (IdEvnt, idPrj, IdEvntCat, nam, descr, fileRefRepoDat, fileRefEvntDat)
opdat (idOpDat, IdClean, idOpDatCat, nam, descr, execOr)
prj (idPrj, idUsr, nam, descr, folderRef, IdPrjState)
prjan (idPrj,IdAn)
rev (idRev, IdAn, note)
rnk (idRnk, IdAn, note)
spacedavl (idSpaceDAVl, nam, descr, ordine)
split (idSplit, idSplitType, IdAnCntx, nam, descr, note)
stvar (idStVar, nam, descr, unit)
test (idTest, IdAn, fileRefTestDat, fileRefTestRsdat, note)
train (IdTrain, IdAn, fileRefTrainDat, fileRefTrainRsdat, note)
usr (idUsr, usrNam,pwd,firstnam,nam,eMail)

