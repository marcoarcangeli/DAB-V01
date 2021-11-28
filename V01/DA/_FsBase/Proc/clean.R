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
# rScriptArgs<-c("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/anomalies/anomaliesAuto_params.csv")

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
    logAndPrint("Clean start:")
    
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
event=sub('.csv$', "", specParamsList$CSVDataFilename)
#* devono arrivare dal chiamante
#* ctsa, cns,rns,ncs: da verifica struttura
#* ctsd: da input utente
#* 
#* ***   esempi per il test

logAndPrint("Params Setup.")

anom <- tibble(nam = character(), val = character())

#*****************************************************
#*inizio elaborazione anomalie
#*
#* impostazioni iniziali
# rowNamesFlag=FALSE #do not add index col


#* per intera matrice
#* 
#* copia ds per revisione
#* 
dsRev<-ds


#  save result set
ext=paste(sep="_","", "clean.csv_da")
fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
of=paste(sep="",rScriptOutputAbsolutePath,fn)
write.csv2(dsRev, file = of, row.names = FALSE, row.names = FALSE)

logAndPrint(paste("Cleaned csv saved:", of))
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
  fn=paste(sep="_", rScriptName,"outputs.csv")
  of=paste(sep="", rScriptOutputAbsolutePath, fn)
  write.csv2(outputsList, file = of, row.names = FALSE)
  logAndPrint(paste("Saved .", of))
  
  #log operazioni
  
  fn=paste(sep="_", rScriptName,"log.csv")
  of=paste(sep="", rScriptOutputAbsolutePath, fn)
  write.csv2(log, file = of, row.names = FALSE)
  print(paste("Saved .", of))
  
  # message(paste("Processed URL:", url))
  #message("OK: end")
  print(paste("OK: end"))
}
) 
