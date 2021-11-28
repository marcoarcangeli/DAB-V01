#*************************************************
# optional params:  
#*  post-load params
#*    specific params:
#*      - ctsd=numeric,numeric,numeric,numeric
#*      - cnsd=n,DAX,BAX,FAX,TAX&
logAndPrint(paste("Compulsory Post-load Specific Params."))

# splitConditionVect
if(str_trim(specParamsList$splitConditionVect) == "" || 
   is.null(specParamsList$splitConditionVect)){
  logAndPrint(paste("splitConditionVect is incorrect."))
  stop("Procedure stopped:",this_filename)
}else{
  splitConditionVect=str_split(specParamsList$splitConditionVect, ",")
}
logAndPrint(paste("splitConditionVect:", splitConditionVect))

# splitType
if(str_trim(specParamsList$splitType) == "" || 
   is.null(specParamsList$splitType)){
  logAndPrint(paste("splitType is incorrect."))
  stop("Procedure stopped:",this_filename)
}else{
  splitType=specParamsList$splitType
}
logAndPrint(paste("splitType:",splitType))
# logAndPrint(paste("cnsd:",paste(cnsd, sep="",collapse=",")))
