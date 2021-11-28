    # leggi csv parametri
    logAndPrint(paste("Read csv params: "))
    paramsCSVPathFilename=rScriptArgs[1];
    logAndPrint(paste("paramsCSVPathFilename:",paramsCSVPathFilename))
    params <- read.csv(paramsCSVPathFilename, sep = ";")
    # parametri standard rScriptArgs
    logAndPrint(paste("Standard params:"))
    
    rScriptName=params[1,1]
    logAndPrint(paste("rScriptName:",rScriptName))
    rScriptAbsolutePath=params[1,2]
    logAndPrint(paste("rScriptAbsolutePath:",rScriptAbsolutePath))
    rScriptOutputAbsolutePath=params[1,3]
    logAndPrint(paste("rScriptOutputAbsolutePath:",rScriptOutputAbsolutePath))
    rScriptOutputRelativePath = sub(this_dirname, "", rScriptOutputAbsolutePath)
    #extract base and relative paths
    pos = regexpr('/DA/', rScriptOutputRelativePath)
    baseDirname = substr(rScriptOutputRelativePath, 0, pos)
    logAndPrint(paste("baseDirname:",baseDirname))
    rScriptOutputRelativePath = substr(rScriptOutputRelativePath, pos+1, nchar(rScriptOutputRelativePath))
    logAndPrint(paste("rScriptOutputRelativePath:",rScriptOutputRelativePath))
    #*********************
    rScriptParams=params[1,4]
    logAndPrint(paste("rScriptParams:",rScriptParams))
    ######################################################
    # parametri specifici
    logAndPrint(paste("Specific params:"))
    specParams=str_split(rScriptParams, "&")[[1]]
    nSpecParams=length(specParams)
    specParamsList=list()
    for(i in 1:nSpecParams) {
      logAndPrint(paste(specParams[i]))
      specParam=str_split(specParams, "=")[[i]]
      key=specParam[1]
      value=specParam[2]
      #my_list1[key[1]] <- value[1] 
      specParamsList[key]<-value
      logAndPrint(paste("Nam: ", key, " - Val: ", value))
    }
