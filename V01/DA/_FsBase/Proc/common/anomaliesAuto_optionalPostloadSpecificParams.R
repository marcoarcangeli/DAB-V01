#*************************************************
# optional params:  
#*  post-load params
#*    specific params:
#*      - ctsd=numeric,numeric,numeric,numeric
#*      - cnsd=n,DAX,BAX,FAX,TAX&
logAndPrint(paste("Optional Post-load Specific Params."))

ctsa=sapply(ds, mode) #* tipi colonne automatici
logAndPrint(paste("ctsa:", paste(ctsa, sep="",collapse=",")))
# ctsd["DAX2"]<-"numeric"
if(str_trim(specParamsList$ctsd) == "" || 
   is.null(specParamsList$ctsd)){
  ctsd=ctsa
}else{
  ctsd=str_split(specParamsList$ctsd, ",")[[1]]
}
logAndPrint(paste("ctsd:", specParamsList$ctsd))

#cnsd="age,workclass,fnlwgt,education,education_num,marital_status,occupation,relationship"
#specParams=str_split(cnsd, ",")[[1]]
# ctsd["DAX2"]<-"numeric"
cnsa<-colnames(ds)    #* nomi colonne
logAndPrint(paste("cnsa:",paste(cnsa, sep="",collapse=",")))

# cns<-sapply(ds, colnames)
# toString(cns)
if(str_trim(specParamsList$cnsd) == "" || 
   is.null(specParamsList$cnsd)){
  cnsd=str_split(cnsa, ",")[[1]]
}else{
  cnsd=str_split(specParamsList$cnsd, ",")[[1]]
}
logAndPrint(paste("cns:",specParamsList$cnsd))
# logAndPrint(paste("cnsd:",paste(cnsd, sep="",collapse=",")))
