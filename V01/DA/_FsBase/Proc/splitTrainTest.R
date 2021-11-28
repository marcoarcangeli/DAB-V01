###rscript.exe rScriptPrototype_csv.R 
### regole stringhe parametri
###* regole stringhe parametri
###* ordine separatori
#* ;
#* &
#* ,
#* numeri passato con . decimale
#* 
#* Rscript /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/splitTrainingTest.R /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/esempio1/splitTrainingTest_params.csv
## test params 
#      
#rScriptArgs<-c("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/esempio1/rScriptPrototype_csv_params.csv")

#* 
#* parametri esterni
#* rScriptParams="
#*   CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&
#*   CSVDataFilename=EuStockMarkets2.csv&
#*   decSep=,&
#*   csvSep=;&
#*   csvHeader=T&           
#*   splitType=percentage&
#*   splitConditionVect=60
#* " 
#* 

#* spec params
#* percentage
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&CSVDataFilename=EuStockMarkets2.csv&decSep=,&csvSep=;&csvHeader=T&splitType=percentage&splitConditionVect=1,55" 
#* position
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&CSVDataFilename=EuStockMarkets2.csv&decSep=,&csvSep=;&csvHeader=T&splitType=position&splitConditionVect=1,7,700" 
#* condition numerica
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&CSVDataFilename=EuStockMarkets2.csv&decSep=,&csvSep=;&csvHeader=T&splitType=condition&splitConditionVect=2,1000.00,1600.00" 
#* condition testo
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&CSVDataFilename=chickwts.csv&decSep=,&csvSep=;&csvHeader=T&splitType=condition&splitConditionVect=3,a,i" 
#* errore
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&CSVDataFilename=EuStockMarkets2.csv&decSep=,&csvSep=;&csvHeader=T&splitType=composizione&splitConditionVect=2,1000.00,1600.00" 

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

    # print(paste("rscript",this_file,"<br>"))

  if (is_empty(this_file))
  {
    this_file <- rstudioapi::getSourceEditorContext()$path
    # print(paste("rstudio",this_file,"<br>"))
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

    source(paste(sep="",this_dirname,"/common/logAndPrint.R"))
    source(paste(sep="",this_dirname,"/common/daWrite.R"))

    # preimpostazione uscita
    out="OK"
    # log
    log <- tibble(timestamp = character(), note = character())
    logAndPrint(paste("Start script."))
    # logAndPrint(paste("this_filename:",this_filename))

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
    ## load data    ####################################à
    ## carica dati grezzi
    #ds = read.csv(CSVDataPathFilename, dec=decSep, sep=csvSep, header=csvHeader)
    CSVDataPathFileName=paste(sep="", specParamsList$CSVDataPath,specParamsList$CSVDataFilename)
    ds = read.csv(CSVDataPathFileName, dec=specParamsList$decSep, sep=specParamsList$csvSep, header=as.logical(specParamsList$csvHeader) )
    logAndPrint("Data loaded.")
    #*************************************************
    # optional params:  
    #*  post-load params
    #*    common params:
    #*      - ...
    source(paste(sep="",this_dirname,"/common/splitTrainTest_compulsoryPostloadSpecificParams.R"))
    #*************************************************
    # optional params:  
    #*  post-load params
    #*    specific params:
    #*      - ctsd=numeric,numeric,numeric,numeric
    #*      - cnsd=n,DAX,BAX,FAX,TAX&
    #   source(paste(sep="",this_dirname,"/common/splitTrainTest_optionalPostloadSpecificParams.R"))

    #************************************************
    #* future params
    #*   ...
    #*************************************************
    
    # start split
    #operazione 1
    logAndPrint("Split start:")
   
    varSt=0    # numero colonna enumerativa
    inizio=0  # condition iniziale
    fine=0    # condition finale
    dsTest = NULL
    dsTrain = NULL
    # opParams=str_split(specParamsList$splitConditionVect, ",")
    # variable rename for elaboration
    opParams=splitConditionVect
    
    if (splitType=="percentage") { 
        percTrain=strtoi(opParams[[1]][2]) # percentuale
        nObs=count(ds)
        #is.numeric(percTrain)
        varSt<-strtoi(opParams[[1]][1]) # numero colonna enumerativa ??? non necessaria
        inizio<-1
        fine<-as.integer(round(nObs*percTrain/100, 0))
        dsTest<-ds[-(inizio:fine),]
        dsTrain<-ds[inizio:fine,]
    } else if (splitType=="position")  {
        varSt<-strtoi(opParams[[1]][1]) # num colonna
        inizio<-strtoi(opParams[[1]][2]) # riga iniziale
        fine<-strtoi(opParams[[1]][3]) # riga finale
        ss<-split(ds, ds[varSt]  >= inizio & ds[varSt] <= fine)
        dsTest<-ss[[1]]
        dsTrain<-ss[[2]]
    } else if  (splitType=="condition") {
        varSt=strtoi(opParams[[1]][1]) # num colonna
        if(!is.na(as.double(opParams[[1]][2]))){
            inizio=as.double(opParams[[1]][2]) # riga iniziale
            fine=as.double(opParams[[1]][3]) # riga finale
        }else{
            inizio=opParams[[1]][2] # riga iniziale
            fine=opParams[[1]][3] # riga finale
        }
        ss<-split(ds, ds[varSt]  >= inizio & ds[varSt] <= fine)
        dsTest<-ss[[1]]
        dsTrain<-ss[[2]]
    } else {
        #* log impostazione splitType non corretta.
        stop("splitType is incorrect.")
    }
    #posizioneRange<-c(1, 0, 1116)
    logAndPrint(paste("Split vars: varSt: ",varSt,"inizio: ",inizio,"fine: ",fine))
    # ss<-split(ds, ds[varSt]  >= inizio & ds[varSt] <= fine)
    # dsTest<-ss[[1]]
    # dsTrain<-ss[[2]]
    logAndPrint(paste("Training row num: ",nrow(dsTrain)))
    logAndPrint(paste("Test row num: ",nrow(dsTest)))
    # head(dsTrain,10)
    # head(dsTest,10)
    
    # operazione 2 salvataggio csv training 
    daWrite(dsTrain, NULL, "train.csv_da", CSVDataFilename, rScriptOutputAbsolutePath, rScriptOutputRelativePath)
    # ext=paste(sep="_","", "train.csv_da")
    # fn=sub('.csv_da$', ext, specParamsList$CSVDataFilename)
    # of=paste(sep="",rScriptOutputAbsolutePath,fn)
    # write.csv2(dsTrain, file = of, row.names = FALSE)

    # logAndPrint(paste("Train dataset csv saved:", of))
    # log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)

    # outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")

    # operazione 3 salvataggio csv test 
    daWrite(dsTest, NULL, "test.csv_da", CSVDataFilename, rScriptOutputAbsolutePath, rScriptOutputRelativePath)
    # ext=paste(sep="_","", "test.csv_da")
    # fn=sub('.csv_da$', ext, specParamsList$CSVDataFilename)
    # of=paste(sep="",rScriptOutputAbsolutePath,fn)
    # write.csv2(dsTest, file = of, row.names = FALSE)

    # logAndPrint(paste("Test dataset csv saved:", of))
    # log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)

    # outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
    
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
#     # end do something
#     ########################################################

# ###################################################
# ### start error handling
# },
# error=function(cond) {
#   # message(paste("URL does not seem to exist:", url))
#   # message("Here's the original error message:")
#   #message(paste("error<br>:<br> ",cond))
#   logAndPrint(paste("error: ",cond))
#   # Choose a return value in case of error
#   out=NA
#   # return(NA)
# },
# # warning=function(cond) {
# #   # message(paste("URL caused a warning:", url))
# #   # message("Here's the original warning message:")
# #   #message(paste("warn:<br> ",cond))
# #   print(paste("warn:<br> ",cond))
# #   # Choose a return value in case of warning
# #   out=NA
# #   # return(NULL)
# # },
# finally={
#   # NOTE:
#   # Here goes everything that should be executed at the end,
#   # regardless of success or error.
#   # If you want more than one expression to be executed, then you 
#   # need to wrap them in curly brackets ({...}); otherwise you could
#   # just have written 'finally=<expression>' 
#   # message(paste("Processed URL:", url))
#   #message("OK: end")
#   #termine script
#   logAndPrint("End script.")
#   # timestampEnd = Sys.time() %>% as.character()
#   # log <- log %>% add_row(timestamp=timestampEnd, note = "End script.")
  
#   #outputs list
#   fn=paste(sep="_", rScriptName,"split_outputs.csv_da")
#   of=paste(sep="", rScriptOutputAbsolutePath, fn)
#   write.csv2(outputsList, file = of, row.names = FALSE)
#     logAndPrint(paste("Saved .", of))
  
#   #log operazioni
  
#   fn=paste(sep="_", rScriptName,"split_log.csv_da")
#   of=paste(sep="", rScriptOutputAbsolutePath, fn)
#   write.csv2(log, file = of, row.names = FALSE)
#     print(paste("Saved .", of))

#     # message(paste("Processed URL:", url))
#     #message("OK: end")
#     print(paste("OK: end"))
# }
) 
