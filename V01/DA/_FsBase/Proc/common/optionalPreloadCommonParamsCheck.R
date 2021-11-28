#*******************************************************
#* verify params
#*** 
# optional params:  
#*  pre-load params:
#*    common params:
#*      decSep=,&
#*      csvSep=;&
#*      csvHeader=T&   
logAndPrint(paste("Optional Pre-load Common params. "))

if(str_trim(specParamsList$decSep) == "" || 
   is.null(specParamsList$decSep)){
  decSep=","
}else{
  decSep=specParamsList$decSep
}
logAndPrint(paste("decSep: ",decSep))

if(str_trim(specParamsList$csvSep) == "" || 
   is.null(specParamsList$csvSep)){
  csvSep=";"
}else{
  csvSep=specParamsList$csvSep
}
logAndPrint(paste("csvSep: ",csvSep))

if(str_trim(specParamsList$csvHeader) == "" || 
   is.null(specParamsList$csvHeader)){
  csvHeader="TRUE"
}else{
  csvHeader=specParamsList$csvHeader
}
logAndPrint(paste("csvHeader: ",csvHeader))
