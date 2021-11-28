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
#      
# rScriptArgs<-c("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/analisiStruttura/analisiStruttura_params.csv")

#* parametri esterni
#* 
#* rScriptParams="
#*   CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&
#*   CSVDataFilename=adults2.csv&
#*   decSep=,&
#*   csvSep=;&
#*   csvHeader=T&           
#*   event=adults2
#*   
#*** optional:   
#*   ctsa=numeric,numeric,numeric,character& 
#*   cns=n,DAX,BAX,FAX,TAX&
#*   rns=100&
#*   ncs=4&
#*   ctsd=numeric,numeric,numeric,numeric
#* " 

#* spec params
#* caso: 
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv&decSep=,&csvSep=;&csvHeader=T" 
#* caso: 
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&CSVDataFilename=EuStockMarkets2.csv&decSep=,&csvSep=;&csvHeader=T" 
#* errore
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv&decSep=,&csvSep=;&csvHeader=T" 

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
logAndPrint <- function(msg="No msg!"){
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(Sys.time() %>% as.character(),msg,"<br>"))
  
}
###############################
out <- tryCatch(
{
  #* dopo queste informazioni deve intervenire una pulizia e le decisioni del data analyst:
  #* 1) colonna enumerativa
  #* 2) colonna tempo: date
  #* 3) conversioni colonne con dati sporchi
  #* 4) altre operazioni di cleaning
  
  ##################################################################
  library(tidyverse)
  # preimpostazione uscita
  out="OK"
  
  # timestampIni = Sys.time() %>% as.character()
  # print(paste("Start Script","<br>"))
  # log
  log <- tibble(timestamp = character(), note = character())
  logAndPrint(paste("Start script."))
  
  # log <- log %>% add_row(timestamp=timestampIni, note = "Start script.")
  
  #no argomenti
  if(!exists("rScriptArgs")){
    rScriptArgs <- commandArgs(trailingOnly = TRUE)
    # leggi parametri csv
  }
  
  logAndPrint(paste("Args Num: ",length(rScriptArgs)))
  # msg<-paste("Numero parametri in rScriptArgs: ", length(rScriptArgs))
  # log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  
  # test if there is at least one argument: if not, return an error
  if (length(rScriptArgs)==0) {
    msg<-"At least one argument must be supplied (input file)."
    log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
    stop(msg, call.=FALSE)
    
  } else if (length(rScriptArgs)==1) {
    
    # leggi csv parametri
    logAndPrint(paste("Read csv params: "))
    paramsCSVPathFilename=rScriptArgs[1];
    logAndPrint(paste("paramsCSVPathFilename:",paramsCSVPathFilename))
    params <- read.csv(paramsCSVPathFilename, sep = ";")
    #parametri standard rScriptArgs
    logAndPrint(paste("Standard params:"))
    
    rScriptName=params[1,1]
    logAndPrint(paste("rScriptName:",rScriptName))
    rScriptAbsolutePath=params[1,2]
    logAndPrint(paste("rScriptAbsolutePath:",rScriptAbsolutePath))
    rScriptOutputAbsolutePath=params[1,3]
    logAndPrint(paste("rScriptOutputAbsolutePath:",rScriptOutputAbsolutePath))
    rScriptParams=params[1,4]
    logAndPrint(paste("rScriptParams:",rScriptParams))
    
    # parametri specifici
    logAndPrint(paste("Specific params:"))
    specParams=str_split(rScriptParams, "&")[[1]]
    nParams=length(specParams)
    paramsList=list()
    for(i in 1:nParams) {
      logAndPrint(paste("Par",i,": ",specParams[i]))
      specParam=str_split(specParams, "=")[[i]]
      key=specParam[1]
      value=specParam[2]
      #my_list1[key[1]] <- value[1] 
      paramsList[key]<-value
      
      logAndPrint(paste("Nam: ", key, " - Val: ", value))
      # log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
      
    }
    #print(paramsList)
    
    outputsList <- tibble(filename = character(), url = character(), check = character())
    
    ######################################################
    # parametri specifici
    
    logAndPrint(paste("Specific params:"))
    specParams=str_split(rScriptParams, "&")[[1]]
    nSpecParams=length(specParams)
    specParamsList=list()
    for(i in 1:nSpecParams) {
      #print(paste(specParams[i],"<br>"))
      specParam=str_split(specParams, "=")[[i]]
      key=specParam[1]
      value=specParam[2]
      #my_list1[key[1]] <- value[1] 
      specParamsList[key]<-value
      
      # msg<-paste("Nam: ", key, " - Val: ", value)
      # log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
      
    }
  }
  # logAndPrint(specParamsList)
    ####################################
    
    #####################################
    # analisi generale
    logAndPrint("Analysis start:")
    
    # anom <- tibble(Nam = character(), Val = character())
    
    ## carica dati 
    #ds = read.csv(CSVDataPathFilename, dec=decSep, sep=csvSep, header=csvHeader)
    CSVDataPathFileName=paste(sep="", specParamsList$CSVDataPath,specParamsList$CSVDataFilename)
    ds = read.csv(CSVDataPathFileName, dec=specParamsList$decSep, sep=specParamsList$csvSep, header=as.logical(specParamsList$csvHeader) )
    logAndPrint("Data loaded.")
    
# ## carica dati grezzi
# ds = read.csv("C:/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/EuStockMarkets2.csv", dec=",", sep=";", header=T)
# head(ds, 10)
#* Parametri Esterni:
  #* 1) nomi e tipi di campo automatici
  #* 2) nomi e tipi di campo desiderati
  #* 3) nome standard col enum
    # event="EuStockMarkets2"
    # event="adult2"
event=sub('.csv_da$', "", specParamsList$CSVDataFilename)
#* devono arrivare dal chiamante
#* ctsa, cns,rns,ncs: da verifica struttura
#* ctsd: da input utente
#* 
#* ***   esempi per il test
ctsa=sapply(ds,mode) #* tipi colonne automatici
ctsd=ctsa
# ctsd["DAX2"]<-"numeric"
cns<-colnames(ds)    #* nomi colonne
# cns<-sapply(ds, colnames)
# toString(cns)
rns=nrow(ds)        #* numero righe
ncs=ncol(ds)        #* numero colonne

enumColStdName="" # variabile di sessione

logAndPrint("Params Setup.")

anom <- tibble(nam = character(), val = character())

#*****************************************************
#*inizio elaborazione anomalie
#*
#* impostazioni iniziali
nNa=0
nErr=0
nAnom=0
enumColCheck="N"
rowNamesFlag=FALSE #do not add index col

NaMap =c()
ErrMap  =c()
ErrvalMap =c()
AnomMap =c()
AnomvalMap =c()

#* per intera matrice
#* 
#* copia ds per revisione
#* 
dsRev<-ds

# head(dsRev,10)
# #* cerca i vuoti
# dsRev[dsRev == ""]
# #* conta i cuoti
# nEmptys=length(dsRev[dsRev == ""])
#* riempie i vuoti con NA
dsRev[dsRev == ""]<- NA

logAndPrint("Na map.")
#* mappa coordinate NA
NaMap=which(is.na(dsRev), arr.ind=TRUE)
#* conta NA
nNa=nrow(NaMap)

logAndPrint("Columns auto review.")
#* per ciascuna colonna (distribuzione). 
#* esempio per il test DAX2: 
    #* c="DAX2"
    #* colonna caratteri random
      #* set.seed(1)
      #* charCol<-stringi::stri_rand_strings(rns,5)
      #* dsRev["charCol"]<-charCol
    #* c="age"
    #* c="n"
for(c in cns){
  logAndPrint(paste("Column: ",c))
  
  anomCol <- tibble(nam = character(), val = character())

  nNaCol=0
  nErrCol=0
  nAnomCol=0
  
  NaMapCol=c()
  ErrMapCol=c()
  ErrvalMapCol=c()
  AnomMapCol=c()
  AnomvalMapCol=c()
  
  # ds[[6]][[9]] #* [1] ""        - campo vuoto
  # ds[[6]][[8]] #* [1] "1640,17" - campo con valore
  dsc=dsRev[[c]]
  #* numero campi vuoti per conteggi anomalie
  NaMapCol=which(is.na(dsc), arr.ind=TRUE)
  #* conta NA
  nNaCol=length(NaMapCol)

  #nNAs= sum(is.na(dsc))
  logAndPrint(paste("Type check: "))
  
  #* se colonna non numerica
  #* tipi possibii
  #* numerici: numeric, integer, double
  #* non numerici: factor, character
  if(ctsa[c]!=ctsd[c]){  
    #* cerca valori sospetti per tipo
    #* per ogni campo
    #** se il campo è potenzialmente numerico: attenzione alla virgola decimale
    if(ctsd[c]=="numeric" || ctsd[c]=="double"){
      dscn=as.numeric(sub(",", ".", dsc, fixed = TRUE))
      #* dscn=as.double(sub(",", ".", dsc, fixed = TRUE))
      #* nNAs2= sum(is.na(dscn))
      #* is.double(dscn)
      if(is.numeric(dscn)){
        #* numero campi vuoti per conteggi anomalie
        NaMapColc=which(is.na(dscn), arr.ind=TRUE)
        #* conta NA
        nAnomCol=length(NaMapColc)
        nErrCol=nAnomCol-nNaCol
        
        ErrMapCol= setdiff(NaMapColc,NaMapCol)
        ErrvalMapCol=dsc[ErrMapCol]
        
        AnomMapCol=paste(toString(ErrMapCol),toString(NaMapCol),sep=",")
        AnomvalMapCol=dsc[AnomMapCol]
        
        dsc=dscn
        dscn=NULL
        
      }
      # #** verifica dei dati e dei tipi
      # dsRev["nc"]<-dsc
      # is.numeric(dsRev[c])
      # is.numeric(dsRev[[c]])
      # dsRev["nc"] <- NULL
    }else if(ctsd[c]=="integer"){
      dscn=as.integer(sub(",", ".", dsc, fixed = TRUE))
      #* valori decimali vengono tagliati
      #* valori carattere e vuoti divengono NA
      # nNAs2= sum(is.na(dscn))
      if(is.integer(dscn)){
        dsc=dscn
        dscn=NULL
      }
      # #** verifica dei dati e dei tipi
      # dsRev["nc"]<-dsc
      # is.numeric(dsc)
      # is.factor(dsc)
    }else if(ctsd[c]=="factor"){
      dscn=as.factor(dsc)
      # nNAs2= sum(is.na(dscn))
      if(is.factor(dscn)){
        dsc=dscn
        dscn=NULL
      }
      # #** verifica dei dati e dei tipi
      # dsRev["nc"]<-dsc
      # is.numeric(dsc)
      # is.factor(dsc)
    }
    nMeasuresCol=rns-nNaCol
    # which(is.na(dsRev[c]), arr.ind=TRUE)

    dsRev[c]<-dsc
    # head(dsRev[c],10)
    # head(dsc,10)
  }

  logAndPrint(paste("Enum col check: "))
  #* se ancora non è stata trovata una colonna enumerativa
  if(enumColCheck=="N"){
    #* se colonna numerica
    if(is.numeric(dsc)){
      #* se colonna enumerativa
      if(is.integer(dsc)){
        #* crea colonna enumerativa
        enumCol<-(1:rns)
        #* se la colonna numerica è enumerativa
        if(identical(dsc,enumCol)){
          #* imposta flag presenza colonna enumerativa
          enumColCheck="Y"
          #* imposta il nome convenzionale colonnna enumerativa
          if(c!=enumColStdName){
            enumColCheck="YR"    # YES-Renamed
            names(dsRev)[names(dsRev) == c] <- enumColStdName
          # head(dsRev)
          }
        }
      }
    }
  }
  
  nErr  =nErr+nErrCol
  nAnom =nAnom+nAnomCol
  
  NaMap     = union(NaMap,NaMapCol)
  ErrMap    = union(ErrMap,ErrMapCol)
  ErrvalMap = union(ErrvalMap,ErrvalMapCol)
  AnomMap   = union(AnomMap,AnomMapCol)
  AnomvalMap = union(AnomvalMap,AnomvalMapCol)
  
  #* build anomalies map
  #* log
  #* 
  #* mappa anomalie 
  #** nome, valore
  logAndPrint("Build anomalies csv:")

  anomCol <- anomCol %>% add_row(nam="colName", val = toString(c))
  
  #** numero anomalie => numero NA finali
  anomCol <- anomCol %>% add_row(nam="nNaCol", val = toString(nNaCol))
  anomCol <- anomCol %>% add_row(nam="nErrCol", val = toString(nErrCol))
  anomCol <- anomCol %>% add_row(nam="nAnomCol", val = toString(nAnomCol))
  #** nomeColonna => da TipoAutomatico e TipoDesiderato
  anomCol <- anomCol %>% add_row(nam="typeMap", val = paste(ctsa[c],"->",ctsd[c]))
  #** Mappe Anomalie
  anomCol <- anomCol %>% add_row(nam="NaMapCol", val = toString(NaMapCol))
  anomCol <- anomCol %>% add_row(nam="ErrMapCol", val = toString(ErrMapCol))
  anomCol <- anomCol %>% add_row(nam="AnomMapCol", val = toString(AnomMapCol))
  #** nomeColonna => da TipoAutomatico e TipoDesiderato
  anomCol <- anomCol %>% add_row(nam="ErrvalMapCol", val = toString(ErrvalMapCol))
  anomCol <- anomCol %>% add_row(nam="AnomvalMapCol", val = toString(AnomvalMapCol))

    #** colonna enumerativa => inserita|trovata
  #* anomCol <- anomCol %>% add_row(nam="_n", val = toString(enumColCheck))
  
  # msg<-"Salvataggio csv analisi struct:"
  # log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  
  # logAndPrint(struct)
  ext=paste(sep="_","", c, "anom.csv_da")
  fn=sub('.csv_da$', ext, specParamsList$CSVDataFilename)
  of=paste(sep="",rScriptOutputAbsolutePath,fn)
  write.csv2(anomCol, file = of, row.names = FALSE)
  
  logAndPrint(paste("Anomalies csv saved...", of))
  # log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  
  outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
  
}
logAndPrint(paste("Enum col check."))
#* se non è stata trovata la colonna enumerativa
if(enumColCheck=="N"){
  #* genera colonna enumerativa
  # enumCol<-(1:rns)
  # #** inserisci una colonna enumerativa
  # dsRev[enumColStdName]<-enumCol
  rowNamesFlag=TRUE
  enumColCheck="I" # inserted
}

# if(enumColCheck=="N"){  
#   #  save result set
#   ext=paste(sep="_","", "autoclean.csv")
#   fn=sub('.csv$', ext, specParamsList$CSVDataFilename)
#   of=paste(sep="",rScriptOutputAbsolutePath,fn)
#   write.csv2(dsRev, file = of, row.names = FALSE)
#   
#   logAndPrint(paste("Auto cleaned csv saved...", of))
#   # log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
#   
#   outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
#   
# }


logAndPrint(paste("Save overall anomalies."))
#* salva mappa anomalie automatiche
#* log
#*
#* mappa anomalie
#** nome, valore
#** numero anomalie => numero NA finali
anom <- anom %>% add_row(nam="nNa", val = toString(nNa))
anom <- anom %>% add_row(nam="nErr", val = toString(nErr))
anom <- anom %>% add_row(nam="nAnom", val = toString(nAnom))
# #** nomeColonna => da TipoAutomatico e TipoDesiderato
anom <- anom %>% add_row(nam="NaMap", val = toString(NaMap))
anom <- anom %>% add_row(nam="ErrMap", val = toString(ErrMap))
anom <- anom %>% add_row(nam="AnomMap", val = toString(AnomMap))
# #** nomeColonna => da TipoAutomatico e TipoDesiderato
# anom <- anom %>% add_row(nam="ErrvalMap", val = toString(ErrvalMap))

#** colonna enumerativa => inserita|trovata
# anom <- anom %>% add_row(nam="_n", val = paste(enumColCheck,c,"->",enumColStdName))
anom <- anom %>% add_row(nam="ErrvalMap", val = toString(ErrvalMap))
anom <- anom %>% add_row(nam="AnomvalMap", val = toString(AnomvalMap))

ext=paste(sep="_","", "anom.csv_da")
fn=sub('.csv_da$', ext, specParamsList$CSVDataFilename)
of=paste(sep="",rScriptOutputAbsolutePath,fn)
write.csv2(anom, file = of, row.names = FALSE)

logAndPrint(paste("Overall anomalies csv saved...", of))
# log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)

outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")

#  save result set
ext=paste(sep="_","", "autoclean.csv_da")
fn=sub('.csv_da$', ext, specParamsList$CSVDataFilename)
of=paste(sep="",rScriptOutputAbsolutePath,fn)
write.csv2(dsRev, file = of, row.names = rowNamesFlag)

logAndPrint(paste("rowNamesFlag.", rowNamesFlag))
logAndPrint(paste("Auto cleaned csv saved...", of))
# log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)

outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")

### end of code
###################################################

### start error handling

  },
error=function(cond) {
  # message(paste("URL does not seem to exist:", url))
  # message("Here's the original error message:")
  #message(paste("error<br>:<br> ",cond))
  logAndPrint(paste("error: ",cond))
  # Choose a return value in case of error
  out=NA
  # return(NA)
},
# warning=function(cond) {
#   # message(paste("URL caused a warning:", url))
#   # message("Here's the original warning message:")
#   #message(paste("warn:<br> ",cond))
#   print(paste("warn:<br> ",cond))
#   # Choose a return value in case of warning
#   out=NA
#   # return(NULL)
# },
finally={
  # NOTE:
  # Here goes everything that should be executed at the end,
  # regardless of success or error.
  # If you want more than one expression to be executed, then you 
  # need to wrap them in curly brackets ({...}); otherwise you could
  # just have written 'finally=<expression>' 
  # message(paste("Processed URL:", url))
  #message("OK: end")
  #termine script
  logAndPrint("End script.")
  # timestampEnd = Sys.time() %>% as.character()
  # log <- log %>% add_row(timestamp=timestampEnd, note = "End script.")
  
  #outputs list
  fn=paste(sep="_", rScriptName,"outputs.csv_da")
  of=paste(sep="", rScriptOutputAbsolutePath, fn)
  write.csv2(outputsList, file = of, row.names = FALSE)
  
  # lapply(outputsList, function(x) write.table( data.frame(x), of , append= T, sep=';' ))
  
  #log operazioni
  
  fn=paste(sep="_", rScriptName,"log.csv_da")
  of=paste(sep="", rScriptOutputAbsolutePath, fn)
  write.csv2(log, file = of, row.names = FALSE)
  
  logAndPrint(paste("OK: end"))
}
) 
