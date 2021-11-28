#*******************************************************
# verify params
# compulsory params
#*   CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&
#*   CSVDataFilename=adults2.csv&
#*   
if(str_trim(specParamsList$CSVDataPath) == "" || 
   is.null(specParamsList$CSVDataPath)){
    msg<-"CSVDataPath not defined."
    log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
    stop(msg, call.=FALSE)
}
CSVDataPath=specParamsList$CSVDataPath
logAndPrint(paste("CSVDataPath: ",CSVDataPath))

if(str_trim(specParamsList$CSVDataFilename) == "" || 
   is.null(specParamsList$CSVDataFilename)){
    msg<-"CSVDataFilename not defined."
    log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
    stop(msg, call.=FALSE)
}
CSVDataFilename=specParamsList$CSVDataFilename
logAndPrint(paste("CSVDataFilename: ",CSVDataFilename))
