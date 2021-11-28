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
#rScriptArgs<-c("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/analisiStruttura/analisiStruttura_params.csv_da")

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
  ##################################################################
  library(tidyverse)
  this_file <- getCurrentFileLocation()
  this_dirname <- dirname(this_file)
  this_filename <- sub(paste(this_dirname,"/",sep=""),"",this_file)

  source(paste(sep="",this_dirname,"/common/logAndPrint.R"))
  source(paste(sep="",this_dirname,"/common/daWrite.R"))

  # preimpostazione uscita
  out="OK"
  # log
  log <- tibble(timestamp = character(), note = character())
  logAndPrint(paste("Start script."))

  # no args for manual testing
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

  # logAndPrint(specParamsList)
  #*******************************************************
  # verify params
  # compulsory params
  source(paste(sep="",this_dirname,"/common/compulsoryParamsCheck.R"))
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
  #ds = read.csv(CSVDataPathFilename, dec=decSep, sep=csvSep, header=csvHeader)
  CSVDataPathFileName=paste(sep="", CSVDataPath,CSVDataFilename)
  ds = read.csv(CSVDataPathFileName, dec=decSep, sep=csvSep, header=as.logical(csvHeader))
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

  #************************************************
  #* future params
  #*   filter=rows:20-30+44+56-200&
  #*   ncs=4&
  #*   cusd: metre, second, metre, euro
  #*************************************************

  ####################################
  #*****************************************************
  #*  Structure analysis start 
  #*
  #* Initial Setup
  #####################################
  # analisi generale
  logAndPrint("Structure Analysis start:")
  
  struct <- tibble(Nam = character(), Val = character())
  #* nomi colonne
  cns=paste(colnames(ds), sep="",collapse=",")  #indica numeric generico
  struct <- struct %>% add_row(Nam="ColNam", Val = cns)
  logAndPrint(paste("cns:",cns))

  #* tipi automatici colonne
  cts=paste(sapply(ds, mode), sep="",collapse=",")  #indica numeric generico
  struct <- struct %>% add_row(Nam="ColType", Val = cts)
  logAndPrint(paste("cts:",cts))

  # numero colonne 
  nc=toString(ncol(ds))
  struct <- struct %>% add_row(Nam="ColNum", Val = nc)
  logAndPrint(paste("cns:",nc))

  # numero righe
  nr=toString(nrow(ds))
  struct <- struct %>% add_row(Nam="RowNum", Val = nr)
  logAndPrint(paste("nr:",nr))

  # unita di misura !!!SOLO PER TEST!!! versione successiva
  um<-cts  #indica unità di misura per test devono essere assegnate dall'utente e salvate in struct
  struct <- struct %>% add_row(Nam="Unit", Val = um)
  
  #* salvataggio csv
  #* 
  logAndPrint("Save struct analysis csv:")
  # msg<-"Salvataggio csv analisi struct:"
  # log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  
  # logAndPrint(struct)
  daWrite(struct, NULL, "struct.csv_da", CSVDataFilename, rScriptOutputAbsolutePath, rScriptOutputRelativePath)
  # ext=paste(sep="_","", "struct.csv_da")
  # fn=sub('.csv_da$', ext, CSVDataFilename)
  # of=paste(sep="",rScriptOutputAbsolutePath,fn)
  # rf=paste(sep="",rScriptOutputRelativePath,fn)
  # write.csv2(struct, file = of, row.names = FALSE)
  # logAndPrint(paste("Struct analysis csv saved:", rf))
  # outputsList <- outputsList %>% add_row(filename = fn, url = rf, check = "created")

  # end struct analysis
  ########################################################
# }
### end of code
###################################################
###  error handling
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
