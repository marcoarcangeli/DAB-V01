#************************************************************
#* Regressione lineare calcolo e plot Training Test Compare
#* **********************************************************
### regole stringhe parametri
###* regole stringhe parametri
###* ordine separatori
#* ;
#* &
#* ,
#* numeri passato con . decimale
#* 
#* Rscript /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/regressioneLineare.R /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/regressioneLineare/regressioneLineare_params.csv_da
## test params 
#      
#* 
#* #rScriptArgs<-c("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/analisiStruttura/regressioneLineare_params.csv_da")

#* parametri esterni

#* rScriptParams="
#*   CSVTrainDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/&
#*   CSVTestDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/&
#*   CSVTrainDataFilename=EuStockMarkets2_training.csv_da&
#*   CSVTestDataFilename=EuStockMarkets2_test.csv_da&
#*   decSep=,&
#*   csvSep=;&
#*   csvHeader=T&   
#*   outcome=DAX&
#*   variables=SMI,CAC,FTSE&
#*   modelMethods=lm,svmRadial 

#* " 

#* spec params
#* caso: 
# rScriptParams="CSVTrainDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/&CSVTestDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/&CSVTrainDataFilename=EuStockMarkets2_training.csv_da&CSVTestDataFilename=EuStockMarkets2_test.csv_da&decSep=,&csvSep=;&csvHeader=T&outcome=DAX&variables=SMI,CAC,FTSE&modelMethods=lm,svmRadial" 
#* errore
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv_da&decSep=,&csvSep=;&csvHeader=T" 

#class(rScriptArgs)
############
# service functions
logAndPrint <- function(msg="No msg!"){
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(Sys.time() %>% as.character(),msg,"<br>"))
  
}
###############################
#* funzione di Elaborazione
lmElabora <- function(label="label", fitModel, specParamsList, rScriptOutputAbsolutePath){
  #* Risultati regressione training
  #* 
  #* training coefficienti
  #* 
  coeffsTrain=coefficients(fitModel) # model coefficients
  #* salvataggio csv coefficienti
  #* 
  # print(coeffsTrain)
  ext=paste(sep="_","","lm", label, "coeffs.csv_da")
  fn=sub('train.csv_da$', ext, specParamsList$CSVTrainDataFilename)
  of=paste(sep="",rScriptOutputAbsolutePath,fn)
  write.csv2(coeffsTrain, file = of, row.names = FALSE)
  
  logAndPrint(paste("Saved: ", of))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  
  #* 
  #* training valori
  #* 
  predizioniTrain=fitted(fitModel) # predicted values
  
  logAndPrint(paste("Train predictions csv ...", of))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  #* 
  
  #* 
  #* training scarti
  #* 
  scartiTrain=residuals(fitModel) # residuals
  
  logAndPrint(paste("Train residuals csv ...", of))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  #* 
  
  #* 
  #* training scarti standardizzati (standardized residuals)
  #* 
  scartiStdTrain=MASS::stdres(fitModel) 
  
  logAndPrint(paste("Train standard residuals csv ...", of))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  #* 
  
  #* 
  #* training quantili teorici
  #* 
  quantiliTeoriciTrain=qqnorm(scartiTrain, plot.it = F)$x
  
  logAndPrint(paste("Train theoric quantiles csv ...", of))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  #* 
  
  # training radice scarti (Square root of abs(residuals))
  radiceScartiTrain <- sqrt(abs(scartiStdTrain))
  
  logAndPrint(paste("Train residual root csv ...", of))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  #* 
  
  #* 
  #* training influenza o leverage (effetto leva)
  #* 
  leverageTrain <- influence(fitModel)$hat
  
  inflTrain=influence(fitModel) # influenza
  
  logAndPrint(paste("Train leverage csv ...", of))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  
  # Create data frame
  # Will be used as input to plot_ly
  trainValori <- data.frame(predizioniTrain,
                            scartiTrain,
                            scartiStdTrain,
                            quantiliTeoriciTrain,
                            radiceScartiTrain,
                            leverageTrain)
  
  #* salvataggio csv trainingValues
  #* 
  # print(trainingValues)
  ext=paste(sep="_","","lm", label, "values.csv_da")
  fn=sub('train.csv_da$', ext, specParamsList$CSVTrainDataFilename)
  of=paste(sep="",rScriptOutputAbsolutePath,fn)
  write.csv2(trainValori, file = of, row.names = FALSE)
  
  logAndPrint(paste("Saved ", of))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  #* 
  
  #* *********************************************
  #* plots
  #* fitModel
  # trainLmPlots<-lmPlots(fitModel)
  # Fitted vs Residuals
  # For scatter plot smoother
  LOESS1 <- loess.smooth(predizioniTrain, scartiTrain)
  
  plt1 <- trainValori %>% 
    plot_ly(x = predizioniTrain, y = scartiTrain, 
            type = "scatter", mode = "markers", hoverinfo = "x+y", name = "Data",
            marker = list(size = 10, opacity = 0.5), showlegend = F) %>% 
    
    add_trace(x = LOESS1$x, y = LOESS1$y, type = "scatter", mode = "line", name = "Smooth",
              line = list(width = 2)) %>% 
    
    layout(title = "Residuals vs Prediction", plot_bgcolor = "#e6e6e6", width = 1000)
  
  d <-ggplotly(plt1)
  
  ext=paste(sep="_","","lm", label, "Graph","ResidualsVsPrediction.html")
  fn=sub('train.csv_da$', ext, specParamsList$CSVTrainDataFilename)
  of=paste(sep="",rScriptOutputAbsolutePath,fn)
  
  htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
  
  logAndPrint(paste("Saved ", of))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  
  # QQ Pot
  plt2 <- trainValori %>% 
    plot_ly(x = quantiliTeoriciTrain, y = scartiStdTrain, 
            type = "scatter", mode = "markers", hoverinfo = "x+y", name = "Data",
            marker = list(size = 10, opacity = 0.5), showlegend = F) %>% 
    
    add_trace(x = quantiliTeoriciTrain, y = quantiliTeoriciTrain, type = "scatter", mode = "line", name = "",
              line = list(width = 2)) %>% 
    
    layout(title = "Q-Q Plot", plot_bgcolor = "#e6e6e6")
  
  d <-ggplotly(plt2)
  
  ext=paste(sep="_","","lm", label, "Graph","Q-QPlot.html")
  fn=sub('train.csv_da$', ext, specParamsList$CSVTrainDataFilename)
  of=paste(sep="",rScriptOutputAbsolutePath,fn)
  
  htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
  
  logAndPrint(paste("Saved ", of))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  
  # Scale Location
  # For scatter plot smoother
  LOESS2 <- loess.smooth(predizioniTrain, radiceScartiTrain)
  
  plt3 <- trainValori %>% 
    plot_ly(x = predizioniTrain, y = radiceScartiTrain, 
            type = "scatter", mode = "markers", hoverinfo = "x+y", name = "Data",
            marker = list(size = 10, opacity = 0.5), showlegend = F) %>% 
    
    add_trace(x = LOESS2$x, y = LOESS2$y, type = "scatter", mode = "line", name = "Smooth",
              line = list(width = 2)) %>% 
    
    layout(title = "Scale Location", plot_bgcolor = "#e6e6e6", width = 1000)
  
  d <-ggplotly(plt3)
  
  ext=paste(sep="_","","lm", label, "Graph","ScaleLocation.html")
  fn=sub('train.csv_da$', ext, specParamsList$CSVTrainDataFilename)
  of=paste(sep="",rScriptOutputAbsolutePath,fn)
  
  htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
  
  logAndPrint(paste("Saved ", of))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  
  
  # Residuals vs Leverage
  # For scatter plot smoother
  LOESS3 <- loess.smooth(leverageTrain, scartiTrain)
  
  plt4 <- trainValori %>% 
    plot_ly(x = leverageTrain, y = scartiTrain, 
            type = "scatter", mode = "markers", hoverinfo = "x+y", name = "Data",
            marker = list(size = 10, opacity = 0.5), showlegend = F) %>% 
    
    add_trace(x = LOESS3$x, y = LOESS3$y, type = "scatter", mode = "line", name = "Smooth",
              line = list(width = 2)) %>% 
    
    layout(title = "Leverage vs Residuals", plot_bgcolor = "#e6e6e6")
  
  d <-ggplotly(plt4)
  
  ext=paste(sep="_","","lm", label, "Graph","LeverageVsResiduals.html")
  fn=sub('train.csv_da$', ext, specParamsList$CSVTrainDataFilename)
  of=paste(sep="",rScriptOutputAbsolutePath,fn)
  
  htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
  
  logAndPrint(paste("Saved ", of))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  
  #***********************************************************
  
}
#############################################################
out <- tryCatch(
{
  #generale
  library(tidyverse) 
  # Repeated K-fold cross-validation with 3 methods compare 
  library(mlbench)
  library(kernlab)
  library(caret)
  # per plottaggi
  library(ggplot2)
  library(plotly)

  # preimpostazione uscita
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
      
  ######################################################
  # parametri specifici
  
  logAndPrint(paste("Specific params:"))
  specParams=str_split(rScriptParams, "&")[[1]]
  nSpecParams=length(specParams)
  specParamsList=list()
  for(i in 1:nSpecParams) {
    # logAndPrint(paste(specParams[i]))
    specParam=str_split(specParams, "=")[[i]]
    key=specParam[1]
    value=specParam[2]
    #my_list1[key[1]] <- value[1] 
    specParamsList[key]<-value

    logAndPrint(paste("Nam: ", key, " - Val: ", value))

  }
  outputsList <- tibble(filename = character(), url = character(), check = character())

# verifica parametri
  # variabs=strsplit(specParamsList$variables,split = ",")
  variabs=str_split(specParamsList$variables, ",")
  logAndPrint(paste("variabs",specParamsList$variables))
  ####################################

  ######################################################
  # operazione 1: caricamento dati
  logAndPrint("Analysis start:")
      
  logAndPrint(paste("specParamsList$CSVTrainDataPath:",specParamsList$CSVTrainDataPath))
  logAndPrint(paste("specParamsList$CSVTrainDataFilename:",specParamsList$CSVTrainDataFilename))
  ## carica dati train
  CSVTrainDataPathFileName=paste(sep="", specParamsList$CSVTrainDataPath,specParamsList$CSVTrainDataFilename)
  dsTrain = read.csv(CSVTrainDataPathFileName, dec=specParamsList$decSep, sep=specParamsList$csvSep, header=as.logical(specParamsList$csvHeader) )
      
  logAndPrint(paste("Train data loaded. Row n:",nrow(dsTrain),"Col n:",ncol(dsTrain)))

  ## carica dati test
  CSVTestDataPathFileName=paste(sep="", specParamsList$CSVTestDataPath,specParamsList$CSVTestDataFilename)
  dsTest = read.csv(CSVTestDataPathFileName, dec=specParamsList$decSep, sep=specParamsList$csvSep, header=as.logical(specParamsList$csvHeader) )
      
  logAndPrint(paste("Test data loaded. Row n:",nrow(dsTrain),"Col n:",ncol(dsTrain)))
  # funzione lineare parametrica
  # verifica se una sola colonna
  logAndPrint("Verifica colonna singola.")
  # introduce enumerativa per l'analisi
  nc=ncol(dsTrain)
  if(nc==1){
    #introduce daEnum col
    rns=nrow(dsTrain)
    dsTrain["daEnum"]<-(1:rns)
    rns=nrow(dsTest)
    dsTest["daEnum"]<-(1:rns)
    # force variabs and outcome
    variabs[1]<-"daEnum"
    specParamsList$outcome=colnames(dsTrain)[[1]]
  }

  frm=paste(specParamsList$outcome, 
          paste(variabs[[1]], collapse = " + "), 
          sep = " ~ ")
  f <- as.formula(frm)
      
  logAndPrint(paste(sep="","Linear model: ",frm))

  ######################################################
  #* operazione 2 regressione lineare training
  label="train"
      
  logAndPrint(paste("Linear regression", label))
      
  modelTrain <- lm(f, data = dsTrain)
      
  lmElabora(label, modelTrain, specParamsList, rScriptOutputAbsolutePath)
      
  ######################################################
  #* operazione 3 regressione lineare test
  label="test"

  logAndPrint(paste("Linear regression", label))
      
  modelTest <- lm(f, data = dsTest)
  # print(model)
  lmElabora(label, modelTest, specParamsList, rScriptOutputAbsolutePath)
      
  #* ################################################
  # operazione 4 compare models train test
  #*******************************************************************
  label="compare"
      
  logAndPrint(paste("Linear regression", label))
      
  # Repeated K-fold cross-validation with 3 methods compare 
  # prepare training scheme
  control <- trainControl(method=specParamsList$controlMethod, number=10, repeats=3, )
  #* metodi da eseguire
  modelMeths=strsplit(specParamsList$modelMethods,split = ",")
  # train the lm model (Linear Regression)
  set.seed(7)
  #* loop sui metodi
  for (modelMeth in modelMeths[[1]]){
    logAndPrint(paste("modelMethod: ",modelMeth))
    modelTrain <- train(f, data=dsTrain, method=modelMeth, trControl=control, na.action=na.omit)
    logAndPrint(paste("Train elab: ",modelMeth))
    
    modelTest <- train(f, data=dsTest, method=modelMeth, trControl=control, na.action=na.omit)
    logAndPrint(paste("Test elab: ",modelMeth))
    
    results <- resamples(list(lmTrain=modelTrain, lmTest=modelTest))
    logAndPrint(paste("Results elab: ",modelMeth))
    
    resultsSummary <- summary(results)
    logAndPrint(paste("Summary elab: ",modelMeth))
    
    #* 
    #* salvataggio csv dati
    #* 
    #**** resultsSummary_values
    resultsSummary_values<-resultsSummary$values
    ext=paste(sep="_","compare",modelMeth, "ResSummary","values.csv_da")
    fn=sub('train.csv_da$', ext, specParamsList$CSVTrainDataFilename) # oppure il filename di test
    of=paste(sep="",rScriptOutputAbsolutePath,fn)
    # non possibile: write.csv2(lmResultsSummary, file = of, row.names = FALSE)
    write.csv2(resultsSummary_values, file = of, row.names = FALSE)

    logAndPrint(paste("Saved ", of))
    
    outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
    
    #***** resultsSummary_MAE       
    resultsSummary_MAE<-resultsSummary$statistics$MAE
    ext=paste(sep="_","compare",modelMeth, "ResSummary","MAE.csv_da")
    fn=sub('train.csv_da$', ext, specParamsList$CSVTrainDataFilename) # oppure il filename di test
    of=paste(sep="",rScriptOutputAbsolutePath,fn)
    # non possibile: write.csv2(lmResultsSummary, file = of, row.names = FALSE)
    write.csv2(resultsSummary_MAE, file = of, row.names = FALSE)

    logAndPrint(paste("Saved ", of))
    
    outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
    
    #***** resultsSummary_RMSE       
    resultsSummary_RMSE<-resultsSummary$statistics$RMSE
    ext=paste(sep="_","compare",modelMeth, "ResSummary","RMSE.csv_da")
    fn=sub('train.csv_da$', ext, specParamsList$CSVTrainDataFilename) # oppure il filename di test
    of=paste(sep="",rScriptOutputAbsolutePath,fn)
    # non possibile: write.csv2(lmResultsSummary, file = of, row.names = FALSE)
    write.csv2(resultsSummary_RMSE, file = of, row.names = FALSE)

    logAndPrint(paste("Saved ", of))
    
    outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")

    #***** resultsSummary_Rsquared       
    resultsSummary_Rsquared<-resultsSummary$statistics$Rsquared
    ext=paste(sep="_","compare",modelMeth, "ResSummary","Rsquared.csv_da")
    fn=sub('train.csv_da$', ext, specParamsList$CSVTrainDataFilename) # oppure il filename di test
    of=paste(sep="",rScriptOutputAbsolutePath,fn)
    # non possibile: write.csv2(lmResultsSummary, file = of, row.names = FALSE)
    write.csv2(resultsSummary_Rsquared, file = of, row.names = FALSE)
    
    logAndPrint(paste("Saved ", of))
    
    outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
    
    
    #* 
    #* salvataggio html graphs
    #* 
    # bwplot(lmResults)
    # dotplot(lmResults)
    # get fold subsets
    # get fold subsets
    fold_data <- lapply(modelTrain$control$index, function(index) dsTrain[index,]) %>% 
      bind_rows(.id = "Fold")
    
    aes_s<-aes_string(specParamsList$outcome, col = "Fold")
    p<-ggplot(fold_data, aes_s) + geom_density()
    
    d<-ggplotly(p) 
    
    ext=paste(sep="_","","lm", label, "Graph","k-fold.html")
    fn=sub('train.csv_da$', ext, specParamsList$CSVTrainDataFilename)
    of=paste(sep="",rScriptOutputAbsolutePath,fn)
    
    htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
    
    logAndPrint(paste("Saved ", of))
    
    outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")

    logAndPrint(paste("Variabs", toString(variabs)))

    for(v in variabs[[1]]){
      aes_s<-aes_string(v, specParamsList$outcome, col = "Fold")
      p<-ggplot(fold_data, aes_s) + 
        geom_point(col = "blue") + 
        geom_smooth(method = lm, se = FALSE) 
      
      d<-ggplotly(p) 
      
      ext=paste(sep="_","","lm", label, v, specParamsList$outcome, "Graph", "k-fold.html")
      fn=sub('train.csv_da$', ext, specParamsList$CSVTrainDataFilename)
      of=paste(sep="",rScriptOutputAbsolutePath,fn)
      
      htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
      
      logAndPrint(paste("Saved ", of))
      
      outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
      
    }
    
  }
  #******************************************************
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
#   msg<-paste("warn: ",cond)
#   log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
#   
#   print(paste(msg,"<br>"))
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
  logAndPrint("termine script<br>")
  
  #outputs list
  fn=paste(sep="_", rScriptName,"output.csv_da")
  of=paste(sep="", rScriptOutputAbsolutePath, fn)
  write.csv2(outputsList, file = of, row.names = FALSE)
  logAndPrint(paste("Saved ", of))
  
  #log operazioni

  fn=paste(sep="_", rScriptName,"log.csv_da")
  of=paste(sep="", rScriptOutputAbsolutePath, fn)
  write.csv2(log, file = of, row.names = FALSE)
  print(paste("Saved .", of))
  
  # message(paste("Processed URL:", url))
  #message("OK: end")
  print(paste("OK: end"))
  
}
) 