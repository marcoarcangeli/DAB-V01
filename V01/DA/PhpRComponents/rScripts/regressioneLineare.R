#************************************************************
#* Regressione lineare calcolo e plot Training Test Compare
#* **********************************************************
#* funzione di Elaborazione
lmElabora <- function(label="label", fitModel, specParamsList, rScriptOutputAbsolutePath){
  #* Risultati regressione training
  #* 
  #* training coefficienti
  #* 
  coeffsTrain=coefficients(fitModel) # model coefficients
  #* salvataggio csv coefficienti
  #* 
  print(coeffsTrain)
  ext=paste(sep="_","","lm", label, "coeffs.csv")
  fn=sub('training.csv$', ext, specParamsList$CSVTrainDataFilename)
  of=paste(sep="",rScriptOutputAbsolutePath,fn)
  write.csv2(coeffsTrain, file = of, row.names = FALSE)
  
  msg<-paste("Salvataggio csv", of)
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(msg,"<br>"))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  
  #* 
  #* training valori
  #* 
  predizioniTrain=fitted(fitModel) # predicted values
  
  msg<-paste("Calcolo csv predizioniTrain...", of)
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(msg,"<br>"))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  #* 
  
  #* 
  #* training scarti
  #* 
  scartiTrain=residuals(fitModel) # residuals
  
  msg<-paste("Calcolo csv scartiTrain...", of)
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(msg,"<br>"))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  #* 
  
  #* 
  #* training scarti standardizzati (standardized residuals)
  #* 
  scartiStdTrain=MASS::stdres(fitModel) 
  
  msg<-paste("Calcolo csv scartiStdTrain...", of)
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(msg,"<br>"))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  #* 
  
  #* 
  #* training quantili teorici
  #* 
  quantiliTeoriciTrain=qqnorm(scartiTrain, plot.it = F)$x
  
  msg<-paste("Calcolo csv quantiliTeoriciTrain...", of)
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(msg,"<br>"))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  #* 
  
  # training radice scarti (Square root of abs(residuals))
  radiceScartiTrain <- sqrt(abs(scartiStdTrain))
  
  msg<-paste("Calcolo csv quantiliTeoriciTrain...", of)
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(msg,"<br>"))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  #* 
  
  #* 
  #* training influenza o leverage (effetto leva)
  #* 
  leverageTrain <- influence(fitModel)$hat
  
  inflTrain=influence(fitModel) # influenza
  
  msg<-paste("Calcolo csv leverageTrain...", of)
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(msg,"<br>"))
  
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
  ext=paste(sep="_","","lm", label, "valori.csv")
  fn=sub('training.csv$', ext, specParamsList$CSVTrainDataFilename)
  of=paste(sep="",rScriptOutputAbsolutePath,fn)
  write.csv2(trainValori, file = of, row.names = FALSE)
  
  msg<-paste("Salvataggio csv", of)
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(msg,"<br>"))
  
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
    
    layout(title = "Scarti vs Predizioni", plot_bgcolor = "#e6e6e6", width = 1000)
  
  d <-ggplotly(plt1)
  
  ext=paste(sep="_","","lm", label, "Graph","ScartiVsPredizioni.html")
  fn=sub('training.csv$', ext, specParamsList$CSVTrainDataFilename)
  of=paste(sep="",rScriptOutputAbsolutePath,fn)
  
  htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
  
  msg<-paste("Salvataggio csv", of)
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(msg,"<br>"))
  
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
  fn=sub('training.csv$', ext, specParamsList$CSVTrainDataFilename)
  of=paste(sep="",rScriptOutputAbsolutePath,fn)
  
  htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
  
  msg<-paste("Salvataggio csv", of)
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(msg,"<br>"))
  
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
  fn=sub('training.csv$', ext, specParamsList$CSVTrainDataFilename)
  of=paste(sep="",rScriptOutputAbsolutePath,fn)
  
  htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
  
  msg<-paste("Salvataggio csv", of)
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(msg,"<br>"))
  
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
    
    layout(title = "Leverage vs Scarti", plot_bgcolor = "#e6e6e6")
  
  d <-ggplotly(plt4)
  
  ext=paste(sep="_","","lm", label, "Graph","LeverageVsScarti.html")
  fn=sub('training.csv$', ext, specParamsList$CSVTrainDataFilename)
  of=paste(sep="",rScriptOutputAbsolutePath,fn)
  
  htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
  
  msg<-paste("Salvataggio csv", of)
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(msg,"<br>"))
  
  outputsList <<- outputsList %>% add_row(filename = fn, url = of, check = "created")
  
  #***********************************************************
  
}
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

    # timestamp inizio
    timestampIni = Sys.time() %>% as.character()
    
    # log
    log <- tibble(timestamp = character(), note = character())
    
    log <- log %>% add_row(timestamp=timestampIni, note = "Start script.")
    
    #no argomenti
    if(!exists("rScriptArgs")){
      rScriptArgs <- commandArgs(trailingOnly = TRUE)
      # leggi parametri csv
    }
    
    msg<-paste("Numero parametri in rScriptArgs: ", length(rScriptArgs))
    log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
    print(paste(msg,"<br>"))
    
    # test if there is at least one argument: if not, return an error
    if (length(rScriptArgs)==0) {
      msg<-"At least one argument must be supplied (input file)."
      log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
      stop(msg, call.=FALSE)
      
    } else if (length(rScriptArgs)==1) {
      
      # leggi csv parametri
      print(paste("leggi csv parametri: <br>"))
      
      paramsCSVPathFilename=rScriptArgs[1];
      params <- read.csv(paramsCSVPathFilename, sep = ";")
      #parametri standard rScriptArgs
      msg<-paste("parametri standard rScriptArgs... ")
      log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
      print(paste(msg,"<br>"))

      rScriptName=params[1,1]
      rScriptAbsolutePath=params[1,2]
      rScriptOutputAbsolutePath=params[1,3]
      rScriptParams=params[1,4]
      
      # parametri specifici
      msg<-paste("parametri specifici rScriptParams... ")
      log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
      print(paste(msg,"<br>"))

      specParams=str_split(rScriptParams, "&")[[1]]
      nParams=length(specParams)
      paramsList=list()
      for(i in 1:nParams) {
        specParam=str_split(specParams, "=")[[i]]
        key=specParam[1]
        value=specParam[2]
        #my_list1[key[1]] <- value[1] 
        paramsList[key]<-value
        
        msg<-paste("Nome: ", key, " - Valore: ", value)
        log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
        print(paste(msg,"<br>"))
      }
      #print(paramsList)
      
      outputsList <- tibble(filename = character(), url = character(), check = character())
      
      ######################################################
      # parametri specifici
      
      msg<-paste("parametri specifici: ")
      log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
      print(paste(msg,"<br>"))

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
      ####################################
      
      ######################################################
      # operazione 1: caricamento dati
      msg<-"caricamento dati Training"
      log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
      print(paste(msg,"<br>"))
      
      ## carica dati train
      CSVTrainDataPathFileName=paste(sep="", specParamsList$CSVTrainDataPath,specParamsList$CSVTrainDataFilename)
      dsTrain = read.csv(CSVTrainDataPathFileName, dec=specParamsList$decSep, sep=specParamsList$csvSep, header=as.logical(specParamsList$csvHeader) )
      
      msg<-"caricamento dati Test"
      log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
      print(paste(msg,"<br>"))

      ## carica dati test
      CSVTestDataPathFileName=paste(sep="", specParamsList$CSVTestDataPath,specParamsList$CSVTestDataFilename)
      dsTest = read.csv(CSVTestDataPathFileName, dec=specParamsList$decSep, sep=specParamsList$csvSep, header=as.logical(specParamsList$csvHeader) )
      
      # funzione lineare parametrica
      variabs=strsplit(specParamsList$variables,split = ",")
      f <- as.formula(
        paste(specParamsList$outcome, 
              paste(variabs[[1]], collapse = " + "), 
              sep = " ~ "))
      
      msg<-paste(sep="","Modello Lineare: ",f)
      log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
      print(paste(msg,"<br>"))

      ######################################################
      #* operazione 2 regressione lineare training
      label="train"
      
      msg<-paste("regressione lineare", label)
      log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
      print(paste(msg,"<br>"))
      
      modelTrain <- lm(f, data = dsTrain)
      
      lmElabora(label, modelTrain, specParamsList, rScriptOutputAbsolutePath)
      
      # #***********************************************************

      ######################################################
      #* operazione 3 regressione lineare test
      label="test"

      msg<-paste("regressione lineare", label)
      log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
      print(paste(msg,"<br>"))
      
      modelTest <- lm(f, data = dsTest)
      # print(model)
      lmElabora(label, modelTest, specParamsList, rScriptOutputAbsolutePath)
        
      
      #********************************************************************* 
      
      #* ################################################
      # operazione 4 compare models train test
      #*******************************************************************
      label="compare"
      
      msg<-paste("regressione lineare", label)
      log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
      print(paste(msg,"<br>"))
      
      # Repeated K-fold cross-validation with 3 methods compare 
      # prepare training scheme
      control <- trainControl(method=specParamsList$controlMethod, number=10, repeats=3)
      #* metodi da eseguire
      modelMeths=strsplit(specParamsList$modelMethods,split = ",")
      # train the lm model (Linear Regression)
      set.seed(7)
      #* loop sui metodi
      for (modelMeth in modelMeths[[1]]){
        print(paste("modelMethod: ",modelMeth,"<br>"))
        
        modelTrain <- train(f, data=dsTrain, method=modelMeth, trControl=control)
        print(paste("calcolo training: ",modelMeth,"<br>"))
        
        modelTest <- train(f, data=dsTest, method=modelMeth, trControl=control)
        print(paste("calcolo test: ",modelMeth,"<br>"))
        
        results <- resamples(list(lmTrain=modelTrain, lmTest=modelTest))
        print(paste("calcolo risultati: ",modelMeth,"<br>"))
        
        resultsSummary <- summary(results)
        print(paste("calcolo sommario: ",modelMeth,"<br>"))
        
        #* 
        #* salvataggio csv dati
        #* 
        #**** resultsSummary_values
        resultsSummary_values<-resultsSummary$values
        ext=paste(sep="_","compare",modelMeth, "ResSummary","values.csv")
        fn=sub('training.csv$', ext, specParamsList$CSVTrainDataFilename) # oppure il filename di test
        of=paste(sep="",rScriptOutputAbsolutePath,fn)
        # non possibile: write.csv2(lmResultsSummary, file = of, row.names = FALSE)
        write.csv2(resultsSummary_values, file = of, row.names = FALSE)

        msg<-paste("Salva", of)
        log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
        print(paste(msg,"<br>"))
        
        outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
        
        #***** resultsSummary_MAE       
        resultsSummary_MAE<-resultsSummary$statistics$MAE
        ext=paste(sep="_","compare",modelMeth, "ResSummary","MAE.csv")
        fn=sub('training.csv$', ext, specParamsList$CSVTrainDataFilename) # oppure il filename di test
        of=paste(sep="",rScriptOutputAbsolutePath,fn)
        # non possibile: write.csv2(lmResultsSummary, file = of, row.names = FALSE)
        write.csv2(resultsSummary_MAE, file = of, row.names = FALSE)

        msg<-paste("Salva", of)
        log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
        print(paste(msg,"<br>"))
        
        outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
        
        #***** resultsSummary_RMSE       
        resultsSummary_RMSE<-resultsSummary$statistics$RMSE
        ext=paste(sep="_","compare",modelMeth, "ResSummary","RMSE.csv")
        fn=sub('training.csv$', ext, specParamsList$CSVTrainDataFilename) # oppure il filename di test
        of=paste(sep="",rScriptOutputAbsolutePath,fn)
        # non possibile: write.csv2(lmResultsSummary, file = of, row.names = FALSE)
        write.csv2(resultsSummary_RMSE, file = of, row.names = FALSE)

        msg<-paste("Salva", of)
        log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
        print(paste(msg,"<br>"))
        
        outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")

        #***** resultsSummary_Rsquared       
        resultsSummary_Rsquared<-resultsSummary$statistics$Rsquared
        ext=paste(sep="_","compare",modelMeth, "ResSummary","Rsquared.csv")
        fn=sub('training.csv$', ext, specParamsList$CSVTrainDataFilename) # oppure il filename di test
        of=paste(sep="",rScriptOutputAbsolutePath,fn)
        # non possibile: write.csv2(lmResultsSummary, file = of, row.names = FALSE)
        write.csv2(resultsSummary_Rsquared, file = of, row.names = FALSE)
        
        msg<-paste("Salva", of)
        log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
        print(paste(msg,"<br>"))
        
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
        fn=sub('training.csv$', ext, specParamsList$CSVTrainDataFilename)
        of=paste(sep="",rScriptOutputAbsolutePath,fn)
        
        htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
        
        msg<-paste("Salva", of)
        log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
        print(paste(msg,"<br>"))
        
        outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")

        for(v in variabs[[1]]){
          aes_s<-aes_string(v, specParamsList$outcome, col = "Fold")
          p<-ggplot(fold_data, aes_s) + 
            geom_point(col = "blue") + 
            geom_smooth(method = lm, se = FALSE) 
          
          d<-ggplotly(p) 
          
          ext=paste(sep="_","","lm", label, v, specParamsList$outcome, "Graph", "k-fold.html")
          fn=sub('training.csv$', ext, specParamsList$CSVTrainDataFilename)
          of=paste(sep="",rScriptOutputAbsolutePath,fn)
          
          htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
          
          msg<-paste("Salva", of)
          log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
          print(paste(msg,"<br>"))
          
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
  msg<-paste("error: ",cond)
  log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(msg,"<br>"))
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

  
  #outputs list
  fn=paste(sep="_", rScriptName,"outputs.csv")
  of=paste(sep="", rScriptOutputAbsolutePath, fn)
  write.csv2(outputsList, file = of, row.names = FALSE)
  
  # lapply(outputsList, function(x) write.table( data.frame(x), of , append= T, sep=';' ))
  
  #log operazioni
  
  fn=paste(sep="_", rScriptName,"log.csv")
  of=paste(sep="", rScriptOutputAbsolutePath, fn)
  write.csv2(log, file = of, row.names = FALSE)
  
  # message(paste("Processed URL:", url))
  
  msg<-"termine script."
  log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  
  print(paste(msg,"<br>"))
}
) 