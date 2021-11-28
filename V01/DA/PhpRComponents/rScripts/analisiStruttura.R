### regole stringhe parametri
###* regole stringhe parametri
###* ordine separatori
#* ;
#* &
#* ,
#* numeri passato con . decimale
#* 
#* Rscript /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/analisiStruttura.R /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/analisiStruttura/analisiStruttura_params.csv
## test params 
#      
#rScriptArgs<-c("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/analisiStruttura/analisiStruttura_params.csv")

#* parametri esterni
#* 
#* rScriptParams="
#*   CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&
#*   CSVDataFilename=adults2.csv&
#*   decSep=,&
#*   csvSep=;&
#*   csvHeader=T           
#* " 

#* spec params
#* caso: 
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv&decSep=,&csvSep=;&csvHeader=T" 
#* caso: 
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv&decSep=,&csvSep=;&csvHeader=T" 
#* errore
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv&decSep=,&csvSep=;&csvHeader=T" 

#class(rScriptArgs)
############

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
    
timestampIni = Sys.time() %>% as.character()
print("Start Script","<br>")
# log
log <- tibble(timestamp = character(), note = character())

log <- log %>% add_row(timestamp=timestampIni, note = "Start script.")

#no argomenti
if(!exists("rScriptArgs")){
  rScriptArgs <- commandArgs(trailingOnly = TRUE)
  # leggi parametri csv
}

print(paste("Numero argomenti: ",length(rScriptArgs), "<br>"))
msg<-paste("Numero parametri in rScriptArgs: ", length(rScriptArgs))
log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)

# test if there is at least one argument: if not, return an error
if (length(rScriptArgs)==0) {
  msg<-"At least one argument must be supplied (input file)."
  log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  stop(msg, call.=FALSE)
  
} else if (length(rScriptArgs)==1) {
  
  # leggi csv parametri
  print(paste("leggi csv parametri: <br>"))
  paramsCSVPathFilename=rScriptArgs[1];
  print(paste("paramsCSVPathFilename:",paramsCSVPathFilename,"<br>"))
  params <- read.csv(paramsCSVPathFilename, sep = ";")
  #parametri standard rScriptArgs
  print(paste("parametri standard rScriptArgs: <br>"))
  
  rScriptName=params[1,1]
  print(paste("rScriptName:",rScriptName,"<br>"))
  rScriptAbsolutePath=params[1,2]
  print(paste("rScriptAbsolutePath:",rScriptAbsolutePath,"<br>"))
  rScriptOutputAbsolutePath=params[1,3]
  print(paste("rScriptOutputAbsolutePath:",rScriptOutputAbsolutePath,"<br>"))
  rScriptParams=params[1,4]
  print(paste("rScriptParams:",rScriptParams,"<br>"))
  
  # parametri specifici
  print(paste("parametri specifici: <br>"))
  specParams=str_split(rScriptParams, "&")[[1]]
  nParams=length(specParams)
  paramsList=list()
  for(i in 1:nParams) {
    print(paste("Par",i,": ",specParams[i],"<br>"))
    specParam=str_split(specParams, "=")[[i]]
    key=specParam[1]
    value=specParam[2]
    #my_list1[key[1]] <- value[1] 
    paramsList[key]<-value
    
    msg<-paste("Nome: ", key, " - Valore: ", value)
    log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
    
  }
  #print(paramsList)
  
  outputsList <- tibble(filename = character(), url = character(), check = character())
  
  ######################################################
  # parametri specifici
  
  print(paste("parametri specifici: <br>"))
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
    
    # msg<-paste("Nome: ", key, " - Valore: ", value)
    # log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
    
  }
  print(specParamsList)
  print("<br>")
  ####################################
  
  #####################################
  # analisi generale
  print("analisi generale: inizio <br>")
  msg<-"analisi generale: inizio"
  log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  
  struttura <- tibble(nome = character(), valore = character())
  
  ## carica dati 
  #ds = read.csv(CSVDataPathFilename, dec=decSep, sep=csvSep, header=csvHeader)
  CSVDataPathFileName=paste(sep="", specParamsList$CSVDataPath,specParamsList$CSVDataFilename)
  ds = read.csv(CSVDataPathFileName, dec=specParamsList$decSep, sep=specParamsList$csvSep, header=as.logical(specParamsList$csvHeader) )
  
  #* tipi automatici colonne
  cts<-sapply(ds, mode)  #indica numeric generico
  struttura <- struttura %>% add_row(nome="TipoDatiColonna", valore = toString(cts))
  
  # numero colonne 
  nc<-ncol(ds)
  struttura <- struttura %>% add_row(nome="NumeroColonne", valore = toString(nc))
  
  # numero righe
  nr<-nrow(ds)
  struttura <- struttura %>% add_row(nome="NumeroRighe", valore = toString(nr))
  
  # unita di misura !!!SOLO PER TEST!!!
  um<-paste(cts,"unit",sep="_")  #indica unità di misura per test devono essere assegnate dall'utente e salvate in struttura
  struttura <- struttura %>% add_row(nome="UnitaMisura", valore = toString(um))
  
  #* salvataggio csv
  #* 
  print("Salvataggio csv analisi struttura:<br>")
  msg<-"Salvataggio csv analisi struttura:"
  log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  
  print(struttura)
  ext=paste(sep="_","", "struttura.csv")
  fn=sub('.csv$', ext, specParamsList$CSVDataFilename)
  of=paste(sep="",rScriptOutputAbsolutePath,fn)
  write.csv2(struttura, file = of, row.names = FALSE)

  msg<-paste("operazione 2 salvataggio csv struttura...", of)
  log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  
  outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")

  # end do something
  ########################################################

  
}

### end of code
###################################################

### start error handling
},
error=function(cond) {
  # message(paste("URL does not seem to exist:", url))
  # message("Here's the original error message:")
  #message(paste("error<br>:<br> ",cond))
  print(paste("error: ",cond))
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
  print("termine script<br>")
  
  timestampEnd = Sys.time() %>% as.character()
  log <- log %>% add_row(timestamp=timestampEnd, note = "End script.")
  
  #outputs list
  fn=paste(sep="_", rScriptName,"outputs.csv")
  of=paste(sep="", rScriptOutputAbsolutePath, fn)
  write.csv2(outputsList, file = of, row.names = FALSE)
  
  # lapply(outputsList, function(x) write.table( data.frame(x), of , append= T, sep=';' ))
  
  #log operazioni
  
  fn=paste(sep="_", rScriptName,"log.csv")
  of=paste(sep="", rScriptOutputAbsolutePath, fn)
  write.csv2(log, file = of, row.names = FALSE)
  
  print(paste("OK: end"))
}
) 
