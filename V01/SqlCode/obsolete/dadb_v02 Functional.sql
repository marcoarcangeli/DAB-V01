alg (idAlg, idAlgState, idalgcat, nam, descr, fileRefProc)
algcat (IdAlgCat, IdAlgCatPar, nam, descr)
algdavl (idAlgDAVl, nam, descr, ordine)
algparam (idAlgParam, IdAlgCatParam, idAlg, vl)
algparamtest (idAlgParamtest, idAlgParam, IdTrain, IdAlgCatParam, vl)
AlgCatParam (IdAlgCatParam, idAlg, IdParamType)
algRnk (idAlgRnk, idAlg, nReq, idAlgDAVl, idAlgRnk)
AlgCntxRnk (idAlgCntxRnk, IdAn, idDescrCapStat, idPredCapStat, idExplCapStat, idSpaceDAVl)
AlgCntxRnknorm (idAlgCntxRnkNorm, IdAn, idDescrCapStat, idPredCapStat, idExplCapStat, idSpaceDAVl)
algstate (idAlgState, nam, descr)
algtrainparam (idAlgTrainParam, idAlgParam, IdTrain, IdAlgCatParam, vl)
algcatparam (IdAlgCatParam, nam, descr, unit)
an (IdAn, idPrj, idAlg, nam, descr)
clean (IdClean, IdCntx, IdEvnt, note)
cntx (IdCntx, idPrj, IdEvnt, nam, descr, fileRefRepoDat, fileRefCleanedDat)
AnCntx (IdAnCntx, IdAn, IdCntx, idSplitRule, nam, descr, fileRefTrainDat, fileRefTestDat)
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
evnt (IdEvnt, idPrj, IdEvntCat, nam, descr, fileRefRepoDat, fileRefEvntDat)
evntanom (IdEvntStVarAnom, IdEvnt, nAnom, nNA, nErr, nOtherAnom, nCorrections)
evntcat (IdEvntCat, IdEvntCatPar, nam, descr)
evntstrucstat (IdEvntStrucStat, IdEvnt, note, nCols, nRows, colTypes, units)
evntstvaranom (IdEvntStVarAnom, idStVar, IdEvnt, nAnom, nNA, nErr, nOtherAnom, NaMap, errMap, errVlMap, otherAnomMap, nCorrections, correctionsMap)
explcapstat (idExplCapStat, idComp2StVarsCorrStat, idCompRes2StVarsCorrStat, note, dr, d95CI, dt, dSpearman, dPearson)
opdat (idOpDat, IdClean, idOpDatCat, nam, descr, execOr)
opdatcat (idOpDatCat, idOpDatCatPar, nam, descr)
opdatparam (idTestParam, idOpDat, IdParamType, vl)
opdatparamtype (idOpDatParamType, idOpDat, IdParamType)
paramtype (IdParamType, IdParamTypeCat, nam, descr, unit, vlDefault)
paramtypecat (IdParamTypeCat, idParamTypeCatPar, nam, descr)
predcapstat (idPredCapStat, idTestStVarFpStat, idTestResStVarFpStat, note, dMin, dMax, dMean, dSd, dVar, dVarCoef)
prj (idPrj, idUsr, nam, descr, folderRef)
prjan (idPrj,IdAn)
prjstate (IdPrjState, nam, descr)
rev (idRev, IdAn, note)
rnk (idRnk, IdAn, note)
spacedavl (idSpaceDAVl, nam, descr, ordine)
split (idSplit, idSplitType, IdAnCntx, nam, descr, note)
splitcat (idSplitCat, idOpDatCatPar, nam, descr)
splitparam (idSplitParam, idSplit, IdParamType, vl)
splitparamtype (idSplitParamType, idSplit, IdParamType)
stvar (idStVar, nam, descr, unit)
test (idTest, IdAnCntx, fileRefTestDat, fileRefTestRsdat, note)
testparam (idTestParam, idAlgAn, IdParamType, idTest, vl)
testresstrucstat (idTestResStrucStat, idTest, note, nCols, nRows, colTypes, units)
testresstvarasimstat (idTestResStVarAsimStat, idTest, idStVar, note, aritMode, coefPearson1, coefPearson2)
testresstvarcentresstat (idTestResStVarCentresStat, idTest, idStVar, note, arit, geom, quad, harm, MODE, med)
testresstvarfpstat (idTestResStVarFpStat, idTest, idStVar, note, nMeasures, MODE, mn, mx, mean, sd, VARIANCE, varCoef)
teststrucstat (idTestStrucStat, idTest, note, nCols, nRows, colTypes, units)
teststvarasimstat (idTestStVarAsimStat, idTest, idStVar, note, aritMode, coefPearson1, coefPearson2)
teststvarfpstat (idTestStVarFpStat, idTest, idStVar, note, nMeasures, MODE, mn, mx, mean, sd, VARIANCE, varCoef)
train (IdTrain, IdAnCntx, fileRefTrainDat, fileRefTrainRsdat, note)
trainparam (IdTrainParam, idAlgAn, IdParamType, IdTrain, vl, IdTrainParam)
trainresstrucstat (IdTrainResStrucStat, IdTrain, note, nCols, nRows, colTypes, units)
trainresstvarasimstat (IdTrainResStVarAsimStat, IdTrain, idStVar, note, aritMode, coefPearson1, coefPearson2)
trainresstvarcentresstat (IdTrainResStVarCentresStat, IdTrain, idStVar, note, arit, geom, quad, harm, MODE, med)
trainresstvarfpstat (IdTrainResStVarFpStat, IdTrain, idStVar, note, nMeasures, MODE, mn, mx, mean, sd, VARIANCE, varCoef)
trainstrucstat (IdTrainStrucStat, IdTrain, note, nCols, nRows, colTypes, units, IdTrainStrucStat)
trainstvarasimstat (IdTrainStVarAsimStat, IdTrain, idStVar, note, aritMode, coefPearson1, coefPearson2)
trainstvarfpstat (IdTrainStVarFpStat, IdTrain, idStVar, note, nMeasures, MODE, mn, mx, mean, sd, VARIANCE, varCoef)
usr (idUsr, usrNam,pwd,firstnam,nam,eMail)
stVarCat (idStVarCat, idStVarCatPar, nam, descr)


