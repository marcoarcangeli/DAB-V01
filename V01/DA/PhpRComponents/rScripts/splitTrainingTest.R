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
#*   splitType=percentuale&
#*   splitConditionVect=60
#* " 
#* 

#* spec params
#* percentuale
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&CSVDataFilename=EuStockMarkets2.csv&decSep=,&csvSep=;&csvHeader=T&splitType=percentuale&splitConditionVect=1,55" 
#* posizione
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&CSVDataFilename=EuStockMarkets2.csv&decSep=,&csvSep=;&csvHeader=T&splitType=posizione&splitConditionVect=1,7,700" 
#* condizione numerica
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&CSVDataFilename=EuStockMarkets2.csv&decSep=,&csvSep=;&csvHeader=T&splitType=condizione&splitConditionVect=2,1000.00,1600.00" 
#* condizione testo
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&CSVDataFilename=chickwts.csv&decSep=,&csvSep=;&csvHeader=T&splitType=condizione&splitConditionVect=3,a,i" 
#* errore
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&CSVDataFilename=EuStockMarkets2.csv&decSep=,&csvSep=;&csvHeader=T&splitType=composizione&splitConditionVect=2,1000.00,1600.00" 

#class(rScriptArgs)
############
#readUrl <- function(url="") {
out <- tryCatch(
{
            
require(tidyverse)

timestampIni = Sys.time() %>% as.character()

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
    stop(msg, call.=FALSE)
    log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
    
} else if (length(rScriptArgs)==1) {

    # leggi csv parametri
    print(paste("leggi csv parametri: <br>"))
    
    paramsCSVPathFilename=rScriptArgs[1];
    params <- read.csv(paramsCSVPathFilename, sep = ";")
    #parametri standard rScriptArgs
    print(paste("parametri standard rScriptArgs: <br>"))
    
    rScriptName=params[1,1]
    rScriptAbsolutePath=params[1,2]
    rScriptOutputAbsolutePath=params[1,3]
    rScriptParams=params[1,4]

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
    # do something
    
    #operazione 1
    
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
    ####################################à
    
    library(tidyverse)
    
    ## carica dati grezzi
    #ds = read.csv(CSVDataPathFilename, dec=decSep, sep=csvSep, header=csvHeader)
    CSVDataPathFileName=paste(sep="", specParamsList$CSVDataPath,specParamsList$CSVDataFilename)
    ds = read.csv(CSVDataPathFileName, dec=specParamsList$decSep, sep=specParamsList$csvSep, header=as.logical(specParamsList$csvHeader) )
    # head(ds, 10)
    # class(ds)
    # str(ds)
    # nObs=count(ds)
    # ds %>% count(DAX2)
    
    varSt=0    # numero colonna enumerativa
    inizio=0  # condizione iniziale
    fine=0    # condizione finale
    opParams=str_split(specParamsList$splitConditionVect, ",")
    
    if (specParamsList$splitType=="percentuale") { 
        print(paste("tipo split: ",specParamsList$splitType))
        percTrain=strtoi(opParams[[1]][2]) # percentuale
        nObs=count(ds)
        #is.numeric(percTrain)
        varSt<-strtoi(opParams[[1]][1]) # numero colonna enumerativa
        inizio<-1
        fine<-as.integer(round(nObs*percTrain/100, 0))
    } else if (specParamsList$splitType=="posizione")  {
        print(paste("tipo split: ",paramsList$splitType))
        varSt<-strtoi(opParams[[1]][1]) # num colonna
        inizio<-strtoi(opParams[[1]][2]) # riga iniziale
        fine<-strtoi(opParams[[1]][3]) # riga finale
    } else if  (specParamsList$splitType=="condizione") {
        varSt=strtoi(opParams[[1]][1]) # num colonna
        if(!is.na(as.double(opParams[[1]][2]))){
            inizio=as.double(opParams[[1]][2]) # riga iniziale
            fine=as.double(opParams[[1]][3]) # riga finale
        }else{
            inizio=opParams[[1]][2] # riga iniziale
            fine=opParams[[1]][3] # riga finale
        }
    } else {
        #* log impostazione splitType non corretta.
        stop("impostazione splitType non corretta.")
    }
    #posizioneRange<-c(1, 0, 1116)
    print(paste("Variabili di split: varSt: ",varSt,"inizio: ",inizio,"fine: ",fine))
    ss<-split(ds, ds[varSt]  >= inizio & ds[varSt] <= fine)
    dsTest<-ss[[1]]
    dsTrain<-ss[[2]]
    print(paste("numero righe Training: ",count(dsTrain)))
    print(paste("numero righe Test: ",count(dsTest)))
    # head(dsTrain,10)
    # head(dsTest,10)
    
    # operazione 2 salvataggio csv training 
    print("operazione 2 salvataggio csv training...<br>")

    fn=sub('.csv$', '_training.csv', specParamsList$CSVDataFilename)
    of=paste(sep="",rScriptOutputAbsolutePath,fn)

    msg<-paste("operazione 2 salvataggio csv training...", of)
    log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
    
    write.csv2(dsTrain, file = of, row.names = FALSE)
    
    outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
    
    msg<-paste("operazione 2 salvataggio csv training terminata.", of)
    log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)

    # operazione 3 salvataggio csv test 
    print("operazione 3 salvataggio csv test...<br>")
    
    fn=sub('.csv$', '_test.csv', specParamsList$CSVDataFilename)
    of=paste(sep="",rScriptOutputAbsolutePath,fn)
    
    msg<-paste("operazione 2 salvataggio csv test...", of)
    log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
    
    write.csv2(dsTest,of)
    
    outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
    
    msg<-paste("operazione 3 salvataggio csv test terminata.", of)
    log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
    
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
warning=function(cond) {
    # message(paste("URL caused a warning:", url))
    # message("Here's the original warning message:")
    #message(paste("warn:<br> ",cond))
    print(paste("warn:<br> ",cond))
    # Choose a return value in case of warning
    out=NA
    # return(NULL)
},
finally={
    # NOTE:
    # Here goes everything that should be executed at the end,
    # regardless of success or exit
    #termine script
    print("termine script<br>")
    
    timestampEnd = Sys.time() %>% as.character()
    log <- log %>% add_row(timestamp=timestampEnd, note = "End script.")
    
    #outputs list
    fn=paste(sep="_", rScriptName,"output.csv")
    of=paste(sep="", rScriptOutputAbsolutePath, fn)
    write.csv2(outputsList, file = of, row.names = FALSE)
    
    # lapply(outputsList, function(x) write.table( data.frame(x), of , append= T, sep=';' ))
    
    #log operazioni
    
    fn=paste(sep="_", rScriptName,"log.csv")
    of=paste(sep="", rScriptOutputAbsolutePath, fn)
    write.csv2(log, file = of, row.names = FALSE)
    
    # message(paste("Processed URL:", url))
    
    #message("OK: end")
    print(paste("OK: end"))
    out="OK"
    
