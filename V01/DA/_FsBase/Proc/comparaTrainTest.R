#***********************************************************
#* coparazione Training e test
#************************************************************
### regole stringhe parametri
###* regole stringhe parametri
###* ordine separatori
#* ;
#* &
#* ,
#* numeri passato con . decimale
#* 
#* Rscript /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/regressioneLineare.R /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/regressioneLineare/regressioneLineare_params.csv
## test params 
#      
#* 
#* #rScriptArgs<-c("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/analisiStruttura/regressioneLineare_params.csv")

#* parametri esterni

#* rScriptParams="
#*   CSVTrainDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/&
#*   CSVTestDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/&
#*   CSVTrainDataFilename=EuStockMarkets2_training.csv&
#*   CSVTestDataFilename=EuStockMarkets2_test.csv&
#*   decSep=,&
#*   csvSep=;&
#*   csvHeader=T&   
#*   outcome=DAX&
#*   variables=SMI,CAC,FTSE&
#*   modelMethods=lm,svmRadial 

#* " 

#* spec params
#* caso: 
# rScriptParams="CSVTrainDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/&CSVTestDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/&CSVTrainDataFilename=EuStockMarkets2_training.csv&CSVTestDataFilename=EuStockMarkets2_test.csv&decSep=,&csvSep=;&csvHeader=T&outcome=DAX&variables=SMI,CAC,FTSE&modelMethods=lm,svmRadial" 
#* errore
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv&decSep=,&csvSep=;&csvHeader=T" 

#class(rScriptArgs)
############
# service functions
logAndPrint <- function(msg="No msg!"){
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(Sys.time() %>% as.character(),msg,"<br>"))
  
}
############
out <- tryCatch(
  {
    #main
    library(tidyverse) 
    # Repeated K-fold cross-validation with 3 methods compare 
    library(mlbench)
    library(kernlab)
    library(caret)
    # output pre-setup
    out="OK"

    # log
    log <- tibble(timestamp = character(), note = character())
    logAndPrint(paste("Start script."))
    
    #no argomenti
    if(!exists("rScriptArgs")){
      rScriptArgs <- commandArgs(trailingOnly = TRUE)
      # leggi parametri csv
    }
    
    logAndPrint(paste("Args Num: ",length(rScriptArgs)))
    
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
        
        # msg<-paste("Nome: ", key, " - Valore: ", value)
        # log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
        
      }
      # print(specParamsList)
      ####################################
      
      ######################################################
      # operazione 1: caricamento dati
      logAndPrint("Analysis start:")
      
      ## carica dati train
      
      CSVTrainDataPathFileName=paste(sep="", specParamsList$CSVTrainDataPath,specParamsList$CSVTrainDataFilename)
      dsTrain = read.csv(CSVTrainDataPathFileName, dec=specParamsList$decSep, sep=specParamsList$csvSep, header=as.logical(specParamsList$csvHeader) )
      logAndPrint("Train Data loaded.")
      ## carica dati test
      CSVTestDataPathFileName=paste(sep="", specParamsList$CSVTestDataPath,specParamsList$CSVTestDataFilename)
      dsTest = read.csv(CSVTestDataPathFileName, dec=specParamsList$decSep, sep=specParamsList$csvSep, header=as.logical(specParamsList$csvHeader) )
      logAndPrint("Test Data loaded.")
      # funzione lineare parametrica
      variabs=strsplit(variables,split = ",")
      f <- as.formula(
        paste(specParamsList$outcome, 
              paste(variabs[[1]], collapse = " + "), 
              sep = " ~ "))
      
      logAndPrint(paste(sep="","Linear model: ",f))
      
      ######################################################
      #* regressione lineare training
      logAndPrint(paste(sep="","Train linear regression: "))
      
      modelTrain <- lm(f, data = dsTrain)
      # print(model)

      #* Risultati regressione training
      #* 
      #* training coefficienti
      #* 
      coeffsTrain=coefficients(modelTrain) # model coefficients
      #* salvataggio csv coefficienti
      #* 
      # print(coeffsTrain)
      ext=paste(sep="_","","lm", "train", "coeffs.csv_da")
      fn=sub('.csv_da$', ext, specParamsList$CSVTrainDataFilename)
      of=paste(sep="",rScriptOutputAbsolutePath,fn)
      write.csv2(coeffsTrain, file = of, row.names = FALSE)
      
      logAndPrint(paste("coeffsTrain csv saved:", of))
      
      outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
      
      #* 
      #* training valori
      #* 
      valoriTrain=fitted(modelTrain) # predicted values
      #* salvataggio csv valoriTrain
      #* 
      # print(valoriTrain)
      ext=paste(sep="_","","lm", "train", "val.csv_da")
      fn=sub('.csv_da$', ext, specParamsList$CSVTrainDataFilename)
      of=paste(sep="",rScriptOutputAbsolutePath,fn)
      write.csv2(valoriTrain, file = of, row.names = FALSE)
      
      logAndPrint(paste("valTrain csv saved ...", of))
      
      outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
      #* 

      #* 
      #* training scarti
      #* 
      scartiTrain=residuals(modelTrain) # residuals
      #* salvataggio csv scartiTrain
      #* 
      # print(scartiTrain)
      ext=paste(sep="_","","lm", "train", "residual.csv_da")
      fn=sub('.csv_da$', ext, specParamsList$CSVTrainDataFilename)
      of=paste(sep="",rScriptOutputAbsolutePath,fn)
      write.csv2(scartiTrain, file = of, row.names = FALSE)
      
      logAndPrint(paste("residualTrain csv saved ...", of))
      
      outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
      #* 

      #* 
      #* training influenza 
      #* 
      inflTrain=influence(modelTrain) # influenza
      #* salvataggio csv inflTrain$sigma
      #* 
      # print(inflTrain$sigma)
      ext=paste(sep="_","","lm", "train", "influence.sigma.csv_da")
      fn=sub('.csv_da$', ext, specParamsList$CSVTrainDataFilename)
      of=paste(sep="",rScriptOutputAbsolutePath,fn)
      write.csv2(inflTrain$sigma, file = of, row.names = FALSE)
      
      logAndPrint(paste("influence sigma Train  csv saved ...", of))
      
      outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
      #* 
      #* salvataggio csv inflTrain$hat
      #* 
      # print(inflTrain$hat)
      ext=paste(sep="_","","lm", "train", "influence.hat.csv_da")
      fn=sub('.csv_da$', ext, specParamsList$CSVTrainDataFilename)
      of=paste(sep="",rScriptOutputAbsolutePath,fn)
      write.csv2(inflTrain$hat, file = of, row.names = FALSE)
      
      logAndPrint(paste("influence  Train csv saved ...", of))
      
      outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
      #* 

      ######################################################
      #* regressione lineare test
      logAndPrint(paste("Regressione lineare: test", of))
      
      modelTest <- lm(f, data = dsTest)
      # print(model)
      
      #* Risultati regressione Test
      #* 
      #* training coefficienti
      #* 
      coeffsTest=coefficients(modelTest) # model coefficients
      #* salvataggio csv coefficienti
      #* 
      print(coeffsTest)
      ext=paste(sep="_","","lm", "test", "coeffs.csv_da")
      fn=sub('.csv_da$', ext, specParamsList$CSVTestDataFilename)
      of=paste(sep="",rScriptOutputAbsolutePath,fn)
      write.csv2(coeffsTest, file = of, row.names = FALSE)
      
      logAndPrint(paste("coeffsTest csv saved ...", of))
      
      outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
      
      #* 
      #* Test valori
      #* 
      valoriTest=fitted(modelTest) # predicted values
      #* salvataggio csv valoriTest
      #* 
      # print(valoriTTest)
      ext=paste(sep="_","","lm", "test", "val.csv_da")
      fn=sub('.csv_da$', ext, specParamsList$CSVTestDataFilename)
      of=paste(sep="",rScriptOutputAbsolutePath,fn)
      write.csv2(valoriTest, file = of, row.names = FALSE)
      
      logAndPrint(paste("valTest csv saved ...", of))
      
      outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
      #* 
      
      #* 
      #* Test scarti
      #* 
      scartiTest=residuals(modelTest) # residuals
      #* salvataggio csv scartiTest
      #* 
      # print(scartiTest)
      ext=paste(sep="_","","lm", "test", "residual.csv_da")
      fn=sub('.csv_da$', ext, specParamsList$CSVTestDataFilename)
      of=paste(sep="",rScriptOutputAbsolutePath,fn)
      write.csv2(scartiTest, file = of, row.names = FALSE)
      
      logAndPrint(paste("residualTest csv saved ...", of))
      
      outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
      #* 
      
      #* 
      #* test influenza 
      #* 
      inflTest=influence(modelTest) # influenza
      #* salvataggio csv inflTrain$sigma
      #* 
      # print(inflTrain$sigma)
      ext=paste(sep="_","","lm", "test", "influence.sigma.csv_da")
      fn=sub('.csv_da$', ext, specParamsList$CSVTestDataFilename)
      of=paste(sep="",rScriptOutputAbsolutePath,fn)
      write.csv2(inflTest$sigma, file = of, row.names = FALSE)
      
      logAndPrint(paste("influence sigme Test csv saved ...", of))
      
      outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
      #* 
      #* salvataggio csv inflTest$hat
      #* 
      # print(inflTest$hat)
      ext=paste(sep="_","","lm", "test","influence.hat.csv_da")
      fn=sub('.csv_da$', ext, specParamsList$CSVTestDataFilename)
      of=paste(sep="",rScriptOutputAbsolutePath,fn)
      write.csv2(inflTest$hat, file = of, row.names = FALSE)
      
      logAndPrint(paste("influence hat Test csv saved ...", of))
      
      outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
      #* 
      
      #* ################################################
      # compare models train test
      #*******************************************************************
      # Repeated K-fold cross-validation with 3 methods compare 
      # prepare training scheme
      logAndPrint(paste("Compare models ..."))
      
      control <- trainControl(method="repeatedcv", number=10, repeats=3)
      #* metodi da eseguire
      modelMeths=strsplit(modelMethods,split = ",")
      # train the lm model (Linear Regression)
      set.seed(7)
      #* loop sui metodi
      for (modelMeth in modelMeths[[1]]){
        # print(paste("modelMethod: ",modelMeth,"<br>"))
        modelTrain <- train(f, data=dsTrain, method=modelMeth, trControl=control)
        # print(paste("calcolo training: ",modelMeth,"<br>"))
        modelTest <- train(f, data=dsTest, method=modelMeth, trControl=control)
        # print(paste("calcolo test: ",modelMeth,"<br>"))
        rResults <- resamples(list(lmTrain=modelTrain, lmTest=modelTest))
        # print(paste("calcolo risultati: ",modelMeth,"<br>"))
        resultsSummary <- summary(lmResults)
        # print(paste("calcolo sommario: ",modelMeth,"<br>"))
        
        #* 
        #* salvataggio csv dati
        #* 
        resultsSummary_values<-resultsSummary$values
        ext=paste(sep="_","compare",modelMeth, "ResSummary","values.csv_da")
        fn=sub('training.csv_da$', ext, CSVTrainDataFilename) # oppure il filename di test
        of=paste(sep="",rScriptOutputAbsolutePath,fn)
        # non possibile: write.csv2(lmResultsSummary, file = of, row.names = FALSE)
        write.csv2(resultsSummary_values, file = of, row.names = FALSE)
        logAndPrint(paste("Saved ...", of))
        outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
        
        resultsSummary_MAE<-resultsSummary$statistics$MAE
        ext=paste(sep="_","cOmpare",modelMeth, "ResSummary","MAE.csv_da")
        fn=sub('training.csv_da$', ext, CSVTrainDataFilename) # oppure il filename di test
        of=paste(sep="",rScriptOutputAbsolutePath,fn)
        # non possibile: write.csv2(lmResultsSummary, file = of, row.names = FALSE)
        write.csv2(resultsSummary_MAE, file = of, row.names = FALSE)
        logAndPrint(paste("Saved ...", of))
        outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
        
        resultsSummary_RMSE<-resultsSummary$statistics$RMSE
        ext=paste(sep="_","cOmpare",modelMeth, "ResSummary","RMSE.csv_da")
        fn=sub('training.csv_da$', ext, CSVTrainDataFilename) # oppure il filename di test
        of=paste(sep="",rScriptOutputAbsolutePath,fn)
        # non possibile: write.csv2(lmResultsSummary, file = of, row.names = FALSE)
        write.csv2(resultsSummary_RMSE, file = of, row.names = FALSE)
        logAndPrint(paste("Saved ...", of))
        outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
        
        resultsSummary_Rsquared<-resultsSummary$statistics$Rsquared
        ext=paste(sep="_","cOmpare",modelMeth, "ResSummary","Rsquared.csv_da")
        fn=sub('training.csv_da$', ext, CSVTrainDataFilename) # oppure il filename di test
        of=paste(sep="",rScriptOutputAbsolutePath,fn)
        # non possibile: write.csv2(lmResultsSummary, file = of, row.names = FALSE)
        write.csv2(resultsSummary_Rsquared, file = of, row.names = FALSE)
        logAndPrint(paste("Saved ...", of))
        outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
        
        #* 
        #* salvataggio html graphs
        #* 
        # bwplot(lmResults)
        # dotplot(lmResults)
      }
      
      
      #******************************************************

      # #**************************************************
      # #* analisi delle varianze (solo se i set di dati sono di uguale numerosità)
      # cmp<-anova(modelTrain, modelTest)
      # cmpSum=summary(cmp)
      # #* 
      # #* salvataggio csv cmpSum
      # #* 
      # # print(cmpSum)
      # ext=paste(sep="_","","lm", "compareTrainTest.csv")
      # fn=sub('.csv$', ext, specParamsList$CSVTrainDataFilename) # oppure il filename di test
      # of=paste(sep="",rScriptOutputAbsolutePath,fn)
      # write.csv2(inflTest$hat, file = of, row.names = FALSE)
      # 
      # msg<-paste("Salvataggio csv cmpSum...", of)
      # log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
      # print(paste(msg,"<br>"))
      # 
      # outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
      # #* 
      # 
      # 
      # # end do something
      # ########################################################

  }

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
#   logAndPrint(paste("warn: ",cond))
#   
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
  #termine script

  logAndPrint(paste("termine script. "))
  
  #outputs list
  fn=paste(sep="_", rScriptName,"outputs.csv_da")
  of=paste(sep="", rScriptOutputAbsolutePath, fn)
  write.csv2(outputsList, file = of, row.names = FALSE)
  logAndPrint(paste("Saved: ", of))
  
  # lapply(outputsList, function(x) write.table( data.frame(x), of , append= T, sep=';' ))
  
  #log operazioni
  
  fn=paste(sep="_", rScriptName,"log.csv_da")
  of=paste(sep="", rScriptOutputAbsolutePath, fn)
  write.csv2(log, file = of, row.names = FALSE)
  print(paste("Saved", of))
  
  # message(paste("Processed URL:", url))
  
  #message("OK: end")
  print(paste("OK: end"))
}
) 