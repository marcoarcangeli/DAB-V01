### regole stringhe parametri
###* regole stringhe parametri
###* ordine separatori
#* ;
#* &
#* ,
#* numeri passato con . decimale
#* 
#* Rscript /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/analisiSingolaVariabile.R /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/analisiSingolaVariabile/splitTrainingTest_params.csv
#* Rscript /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/anomaliesAuto.R /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/analisiStruttura/analisiStruttura_params.csv
## test params C:
#*****************************************************************************
# rScriptArgs<-c("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/analisiStruttura/analisiStruttura_params.csv")
#*****************************************************************************
#* parametri esterni
#* 
#* rScriptParams="
#*   CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&
#*   CSVDataFilename=adults2.csv&
#*   
#*** optional:   
#*   decSep=,&
#*   csvSep=;&
#*   csvHeader=T&           
#*   ctsd=numeric,numeric,numeric,numeric   # column types desired
#*   cnsd=n,DAX,BAX,FAX,TAX&                # column names desired
# future params
#*   cusd: metre, second, metre, euro       # column units desired
#*   rns=100&
#*   ncs=4&
#* " 
#* spec params
#* caso: 
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv&decSep=,&csvSep=;&csvHeader=T" 
#* caso: 
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&CSVDataFilename=EuStockMarkets2.csv&decSep=,&csvSep=;&csvHeader=T" 
#* errore
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv&decSep=,&csvSep=;&csvHeader=T" 
#
#class(rScriptArgs)
############
#* 
#* Dopo il calcolo della struttura evento,
#* 
#* si verificano le anomalie in fase di pulizia automatica,
#* 
#* prima della pulizia complessiva.
#* 
############
# service functions

getCurrentFileLocation <-  function()
{
  this_file <- commandArgs() %>% 
    tibble::enframe(name = NULL) %>%
    tidyr::separate(col=value, into=c("key", "value"), sep="=", fill='right') %>%
    dplyr::filter(key == "--file") %>%
    dplyr::pull(value)

    print(paste("rscript",this_file,"<br>"))

  if (is_empty(this_file))
  {
    this_file <- rstudioapi::getSourceEditorContext()$path
    print(paste("rstudio",this_file,"<br>"))
  }
  return(this_file)
}

###############################
out <- tryCatch(
{
  library(tidyverse)
  # get source code path
  this_file <- getCurrentFileLocation()
  this_dirname <- dirname(this_file)
  this_filename <- sub(paste(this_dirname,"/",sep=""),"",this_file)

  # get common external source code
  print(paste("Working folder:",getwd(),"<br>"))
  print(paste("this_file:",this_file,"<br>"))
  print(paste("dirname this_file:",this_dirname,"<br>"))
  source(paste(sep="",this_dirname,"/common/logAndPrint.R"))
  source(paste(sep="",this_dirname,"/common/daWrite.R"))
  # preimpostazione uscita
  out="OK"
  # log
  log <- tibble(timestamp = character(), note = character())
  logAndPrint(paste("Start script."))

  # no args
  if(!exists("rScriptArgs")){
    rScriptArgs <- commandArgs(trailingOnly = TRUE)
    # leggi parametri csv
  }
  
  logAndPrint(paste("Args Num: ",length(rScriptArgs)))
  
  # test if there is at least one argument: if not, return an error
  if (length(rScriptArgs)==1) {
    source(paste(sep="",this_dirname,"/common/getScriptParams.R"))
  }else{
    msg<-"The number of arguments is not correct. It must be 1."
    log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
    stop(msg, call.=FALSE)
  }  
  outputsList <- tibble(filename = character(), url = character(), check = character())

  #*******************************************************
  # verify params
  # compulsory params
  source(paste(sep="",this_dirname,"/common/compulsoryParamsCheck.R"))

  event=sub('.csv_da$', "", CSVDataFilename)
  logAndPrint(paste("event: ",event))

  #*******************************************************
  #* verify params
  #*** 
  # optional params:  
  #*  pre-load params:
  #*    common params:
  #* ***   esempi per il test
  source(paste(sep="",this_dirname,"/common/optionalPreloadCommonParamsCheck.R"))

  #*******************************************
  # optional params:  
  #*  pre-load params:
  #*    specific params:
  #*      - ...
  #**********************************************
  ## load data
  CSVDataPathFileName=paste(sep="", CSVDataPath,CSVDataFilename)
  ds = read.csv(CSVDataPathFileName, dec=decSep, sep=csvSep, header=as.logical(csvHeader) )
  logAndPrint("Data loaded.")
      
  #*************************************************
  # optional params:  
  #*  post-load params
  #*    common params:
  #*      - ...

  #*************************************************
  # optional params:  
  #*  post-load params
  #*    specific params:
  #*      - ctsd=numeric,numeric,numeric,numeric
  #*      - cnsd=n,DAX,BAX,FAX,TAX&
  source(paste(sep="",this_dirname,"/common/anomaliesAuto_optionalPostloadSpecificParams.R"))

  #************************************************
  #* future params
  #*   filter=rows:20-30+44+56-200&
  #*   ncs=4&
  #*   cusd: metre, second, metre, euro
  #*************************************************


  #*****************************************************
  #* Anomalies Analysis Start
  #*
  #* initial setup
  ####################################
  logAndPrint("Anomalies Analysis start:")

  cns=cnsd        # variable rename for convenience
  rns=nrow(ds)    #* rows number

  nNa=0
  nErr=0
  nAnom=0
  enumCols <- c()

  NaMap <- c()
  ErrMap  <- c()
  ErrvalMap <- c()
  AnomMap <- c()
  AnomvalMap <- c()
  DeletedEnumCols <- c()

  nMeasures = 0
  percMeasures = 0
  #* 
  #* per intera matrice
  #* copia ds per revisione e filtra colonne
  #* 
  dsRev <- ds[c(cns)]
  ctsaRev <- sapply(dsRev, mode)
  #* riempie i vuoti con NA
  dsRev[dsRev == ""]<- NA

  logAndPrint("Na map.")
  #* mappa coordinate NA
  NaMap <- which(is.na(dsRev), arr.ind=TRUE)
  #* conta NA
  nNa <- nrow(NaMap)

  logAndPrint("Columns auto review.")
  #* per ciascuna colonna (distribuzione). 
  nCns <- length(cns)

  for(i in 1:nCns){
  # for(c in cns){
    c = cns[i]
    logAndPrint(paste("Column:",c))
    
    nNaCol    = 0
    nErrCol   = 0
    nAnomCol  = 0
    
    nMeasuresCol = 0
    percMeasuresCol = 0

    NaMapCol<- c()
    ErrMapCol<- c()
    ErrvalMapCol<- c()
    AnomMapCol<- c()
    AnomvalMapCol<- c()

    dsc=dsRev[[c]]
    #* numero campi vuoti per conteggi anomalie
    NaMapCol=which(is.na(dsc), arr.ind=TRUE)
    #* conta NA
    nNaCol=length(NaMapCol)

    source(paste(sep="",this_dirname,"/common/anomaliesAuto_enumColCheck.R"))

    logAndPrint(paste("Type check: "))
    #* se colonna non numerica
    #* tipi possibii
    #* numerici: numeric, integer, double
    #* non numerici: factor, character
    logAndPrint(paste("ctsaRev[i]:", ctsaRev[i]))
    logAndPrint(paste("ctsd[i]:", ctsd[i]))
    logAndPrint(paste("i:", i))

    if(ctsaRev[i] != ctsd[i]){  
      #* cerca valori sospetti per tipo
      #* per ogni campo
      #** se il campo è potenzialmente numerico: attenzione alla virgola decimale
      if(ctsd[i]=="numeric" || ctsd[i]=="double"){
        dscn=as.numeric(sub(",", ".", dsc, fixed = TRUE))
        #* dscn=as.double(sub(",", ".", dsc, fixed = TRUE))
        #* nNAs2= sum(is.na(dscn))
        #* is.double(dscn)
        if(is.numeric(dscn)){
          source(paste(sep="",this_dirname,"/common/anomaliesAuto_columnAnomaliesCheck.R"))
          
          dsc=dscn
          dscn=NULL
          logAndPrint(paste("Column ", c ," converted from ", ctsaRev[i] ," to numeric double."))
        }else{
          logAndPrint(paste("Column ", c ," cannot be converted from ", ctsaRev[i] ," to numeric double."))
        }
      }else if(ctsd[i]=="integer"){
        dscn=as.integer(sub(",", ".", dsc, fixed = TRUE))
        #* valori decimali vengono tagliati
        #* valori carattere e vuoti divengono NA
        # nNAs2= sum(is.na(dscn))
        if(is.integer(dscn)){
          source(paste(sep="",this_dirname,"/common/anomaliesAuto_columnAnomaliesCheck.R"))

          dsc=dscn
          dscn=NULL
          logAndPrint(paste("Column ", c ," converted from ", ctsaRev[i] ," to numeric integer."))
        }else{
          logAndPrint(paste("Column ", c ," cannot be converted from ", ctsaRev[i] ," to numeric integer."))
        }
      }else if(ctsd[i]=="factor"){
        dscn=as.factor(dsc)
        # nNAs2= sum(is.na(dscn))
        if(is.factor(dscn)){
          source(paste(sep="",this_dirname,"/common/anomaliesAuto_columnAnomaliesCheck.R"))

          dsc=dscn
          dscn=NULL
          logAndPrint(paste("Column ", c ," converted from ", ctsaRev[i] ," to factor."))
        }else{
          logAndPrint(paste("Column ", c ," cannot be converted from ", ctsaRev[i] ," to factor."))
        }
      }else if(ctsd[i]=="character"){
        dscn=as.character(dsc)
        # nNAs2= sum(is.na(dscn))
        if(is.character(dscn)){
          dsc=dscn
          dscn=NULL
          logAndPrint(paste("Column ", c ," converted from ", ctsaRev[i] ," to character."))
        }else{
          logAndPrint(paste("Column ", c ," cannot be converted from ", ctsaRev[i] ," to character."))
        }
      }else{
          logAndPrint(paste("Convertion type ", ctsd[i] ," is not a valid type. Convertion not executed."))
      }
      # which(is.na(dsRev[c]), arr.ind=TRUE)

      dsRev[c]<-dsc
    }

    logAndPrint(paste("Compute column ", i , "-", c, " anomalies."))
    
    nMeasuresCol=rns-nNaCol # numero misure effettive
    percMeasuresCol= nMeasuresCol/rns # percentuale delle misure effettive sul totale

    nErr  =nErr+nErrCol
    nAnom =nAnom+nAnomCol
    
    nMeasures = nMeasures + nMeasuresCol

    NaMap     = union(NaMap,NaMapCol)
    ErrMap    = union(ErrMap,ErrMapCol)
    ErrvalMap = union(ErrvalMap,ErrvalMapCol)
    AnomMap   = union(AnomMap,AnomMapCol)
    AnomvalMap = union(AnomvalMap,AnomvalMapCol)
    
    # #* build column anomalies map
    source(paste(sep="",this_dirname,"/common/anomaliesAuto_colAnomaliesTableBuild.R"))

    daWrite(anomCol, c, "anom.csv_da", CSVDataFilename, rScriptOutputAbsolutePath, rScriptOutputRelativePath)
    
  }
  # compute 
  percMeasures = nMeasures/(rns * nCns)

  source(paste(sep="",this_dirname,"/common/anomaliesAuto_anomaliesTableBuild.R"))

  daWrite(anomCol, NULL, "anom.csv_da", CSVDataFilename, rScriptOutputAbsolutePath, rScriptOutputRelativePath)

  #  save result set
  daWrite(dsRev, NULL, "autoclean.csv_da", CSVDataFilename, rScriptOutputAbsolutePath, rScriptOutputRelativePath)

  ### end anomalies analysis
  ###################################################
  ### error handling
  },
  error=function(cond) {
    source(paste(sep="",this_dirname,"/common/errorBlock.R"))
  },
  # warning=function(cond) {
    # source(paste(sep="",this_dirname,"/common/warningBlock.R"))
  # },
  finally={
    source(paste(sep="",this_dirname,"/common/finallyBlock.R"))
  }
) 
