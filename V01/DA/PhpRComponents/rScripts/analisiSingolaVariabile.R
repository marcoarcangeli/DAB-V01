### regole stringhe parametri
###* regole stringhe parametri
###* ordine separatori
#* ;
#* &
#* ,
#* numeri passato con . decimale
#* 
#* Rscript /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/analisiSingolaVariabile.R /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/analisiSingolaVariabile/splitTrainingTest_params.csv
## test params 
#      
#rScriptArgs<-c("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/analisiSingolaVariabile/analisiSingolaVariabile_params.csv")

#* parametri esterni
#* 
#* rScriptParams="
#*   CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&
#*   CSVDataFilename=adults2.csv&
#*   decSep=,&
#*   csvSep=;&
#*   csvHeader=T&           
#* " 

#* spec params
#* caso: 
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv&decSep=,&csvSep=;&csvHeader=T" 
#* caso: 
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv&decSep=,&csvSep=;&csvHeader=T" 
#* errore
# rScriptParams="CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv&decSep=,&csvSep=;&csvHeader=T" 

#class(rScriptArgs)
############

out <- tryCatch(
{
    #generale
    library(tidyverse) 
    # per plottaggi
    library(ggplot2)
    library(plotly)
    # plot asimmetria
    library(fGarch)
    library(sn)
    # moda
    library(modeest)
    #frequenze
    # library(summarytools)
    #omogeneità
    #library(readxl)
    #asimmetria
    library(abind)
    library(asymmetry)
    library(moments)
    
    # preimpostazione uscita
    out="OK"
    
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
            print(paste(msg,"<br>"))
            
        }
        #print(paramsList)
        
        outputsList <- tibble(filename = character(), url = character(), check = character())
        
        ######################################################
        # parametri specifici
        
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
        ####################################
        
        ######################################################
        # caricamento dati
        msg<-"caricamento dati..."
        log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
        print(paste(msg,"<br>"))
        
        ## carica dati grezzi
        #ds = read.csv(CSVDataPathFilename, dec=decSep, sep=csvSep, header=csvHeader)
        CSVDataPathFileName=paste(sep="", specParamsList$CSVDataPath,specParamsList$CSVDataFilename)
        ds = read.csv(CSVDataPathFileName, dec=specParamsList$decSep, sep=specParamsList$csvSep, header=as.logical(specParamsList$csvHeader) )
        # head(ds, 10)
        # class(ds)
        # str(ds)
        # nObs=count(ds)
        # ds %>% count(DAX2)
        
        ############################################################
        # per la singola variabile statistica
        #attach data variable
        # numStVar<-ds%>%select_if(is.numeric)
        # head(numStVar)
        # noNumStVar<-ds%>%select_if(negate(is.numeric))
        # head(noNumStVar)
        
        #for (stVarName in colnames(numStVar)){
        # es test stVarName="hours_per_week"
        for (stVarName in colnames(ds)){
            
            msg<-paste("Variabile:",stVarName)
            log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
            print(paste(msg,"<br>"))
            
            stVar<-ds[[stVarName]]
            #* stVar<-ds[[1]]
            
            fingerprint <- tibble(nome = character(), valore = character())
            quantili <- tibble(nome = character(), valore = character())
            outliers_iqr_params <- tibble(nome = character(), valore = character())
            outliers_iqr <- tibble(indice = integer(), valore = double())
            outliers_sd_params <- tibble(nome = character(), valore = character())
            outliers_sd <- tibble(indice = integer(), valore = double())
            centri <- tibble(nome = character(), valore = character())
            asimmetria <- tibble(nome = character(), valore = character())
            
            #per tutte le colonne
            #####################################
            msg<-"# FINGERPRINT: calcolo"
            log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
            print(paste(msg,"<br>"))
            
            stVar.length<-length(stVar)
            fingerprint <- fingerprint %>% add_row(nome="Numero occorrenze", valore = toString(stVar.length))
            
            stVar.nMeasures<-sum(!is.na(stVar))
            fingerprint <- fingerprint %>% add_row(nome="Numero misure", valore = toString(stVar.nMeasures))
            
            stVar.moda<-mlv(stVar, na.rm = TRUE)
            fingerprint <- fingerprint %>% add_row(nome="Moda", valore = toString(stVar.moda))
            
            #frequenze
            # print(" ")
            # print("#####################################")
            # print("# FREQUENZE")
            # print(" ")
            # 
            # print(freqTable<-freq(stVar, na.rm=TRUE)) 
            
            if(is.numeric(ds[[stVarName]])){
                
                #fingerprint
                #####################################
                msg<-"# FINGERPRINT: calcolo"
                log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
                print(paste(msg,"<br>"))
                
                stVar.mean<-mean(stVar)
                fingerprint <- fingerprint %>% add_row(nome="Media Aritmetica", valore = toString(stVar.mean))
                
                stVar.sd<-sd(stVar)
                fingerprint <- fingerprint %>% add_row(nome="Deviazione Standard", valore = toString(stVar.sd))
                
                stVar.var<-sd(stVar)
                fingerprint <- fingerprint %>% add_row(nome="Varianza", valore = toString(stVar.var))
                
                stVar.min<-min(stVar)
                fingerprint <- fingerprint %>% add_row(nome="Minimo", valore = toString(stVar.min))
                
                stVar.max<-max(stVar)
                fingerprint <- fingerprint %>% add_row(nome="Massimo", valore = toString(stVar.max))
                
                stVar.range<-range(stVar)
                fingerprint <- fingerprint %>% add_row(nome="Intervallo di Variazione", valore = toString(stVar.range))
                
                stVar.coeffVar<-stVar.sd / stVar.mean
                fingerprint <- fingerprint %>% add_row(nome="Coeff. di Variazione", valore = toString(stVar.coeffVar))

                #quantili
                #####################################
                msg<-"# QUANTILI: calcolo"
                log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
                print(paste(msg,"<br>"))
                
                cond<-1/3
                stVar.terzile<-quantile(stVar, probs = seq(0, 1, cond))
                quantili <- quantili %>% add_row(nome="Terzili", valore = toString(stVar.terzile))
                
                cond<-1/4
                stVar.quartile<-quantile(stVar, probs = seq(0, 1, cond))
                quantili <- quantili %>% add_row(nome="Quartili", valore = toString(stVar.quartile))
                
                cond<-1/5
                stVar.quintile<-quantile(stVar, probs = seq(0, 1, cond))
                quantili <- quantili %>% add_row(nome="Quintili", valore = toString(stVar.quintile))
                
                cond<-c(0.02, 0.98)
                stVar.quantileExt<-quantile(stVar, cond)
                quantili <- quantili %>% add_row(nome="Percentili Estremi (2% 98%)", valore = toString(stVar.quantileExt))
                
                cond= stVar.mean/2
                stVar.percentile<-length(stVar[stVar <= cond]) / stVar.length * 100
                quantili <- quantili %>% add_row(nome="Percentile (<=media/2)", valore = toString(stVar.percentile))
                
                stVar.IQR<-IQR(stVar)
                quantili <- quantili %>% add_row(nome="Intervallo interquartile", valore = toString(stVar.IQR))
                
                #centri
                #####################################
                msg<-"# CENTRI: calcolo"
                log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
                print(paste(msg,"<br>"))
                
                stVar.median<-median(stVar)
                centri <- centri %>% add_row(nome="Mediana", valore = toString(stVar.median))
                
                stVar.harmonicMean<- 1/mean(1/stVar, na.rm=TRUE) 
                centri <- centri %>% add_row(nome="Media Armonica", valore = toString(stVar.harmonicMean))
                
                stVar.geometricMean<-prod(stVar, na.rm=TRUE)^(1/stVar.length) 
                centri <- centri %>% add_row(nome="Media Geometrica", valore = toString(stVar.geometricMean))
                
                stVar.quadraticMean<-sqrt(sum(stVar, na.rm=TRUE)^2/stVar.length)
                centri <- centri %>% add_row(nome="Media Quadratica", valore = toString(stVar.geometricMean))
                
                #asimmetria
                #####################################
                msg<-"# ASIMMETRIA: calcolo"
                log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
                print(paste(msg,"<br>"))
                
                stVar.skewness<-skewness(stVar, na.rm=TRUE)
                asimmetria <- asimmetria %>% add_row(nome="Asimmetria", valore = toString(stVar.skewness))
                
                stVar.kurtosis<-kurtosis(stVar, na.rm=TRUE)
                asimmetria <- asimmetria %>% add_row(nome="Curtosi", valore = toString(stVar.kurtosis))
                
                stVar.moment<-moment(stVar, na.rm=TRUE)
                asimmetria <- asimmetria %>% add_row(nome="Momento Statistico", valore = toString(stVar.moment))
                
                #outliers potenziali
                #####################################
                msg<-"# OUTLIERS POTENZIALI: calcolo"
                log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
                print(paste(msg,"<br>"))
                
                #* OUTLIERS POTENZIALI fra 25 75 perc   OK
                #* dai quartili
                stVar.outliers.up<- stVar.quartile[4] + 1.5 * stVar.IQR         # Upper Range  
                outliers_iqr_params <- outliers_iqr_params %>% add_row(nome="Outliers.up", valore = toString(stVar.outliers.up))
                
                stVar.outliers.low<- stVar.quartile[2] - 1.5 * stVar.IQR        # Lower Range
                outliers_iqr_params <- outliers_iqr_params %>% add_row(nome="Outliers.low", valore = toString(stVar.outliers.low))
                #* crea tabella outliers su scarto interquartile
                indice=which(stVar < stVar.outliers.low | stVar > stVar.outliers.up)
                stVar.outliers.iqr <- as.data.frame(indice) 
                stVar.outliers.iqr$valore<- subset(stVar,  stVar < stVar.outliers.low | stVar > stVar.outliers.up)
                outliers_iqr<-stVar.outliers.iqr

                stVar.outliers.num=count(stVar.outliers)
                outliers_iqr_params <- outliers_iqr_params %>% add_row(nome="Outliers.num", valore = toString(stVar.outliers.num))
                
                #* OUTLIERS POTENZIALI standard deviation filter  OK
                stVar.outliers.low <- stVar.mean - 3 * stVar.sd
                outliers_sd_params <- outliers_sd_params %>% add_row(nome="Outliers.up", valore = toString(stVar.outliers.up))
                
                stVar.outliers.up <- stVar.mean + 3 * stVar.sd
                outliers_sd_params <- outliers_sd_params %>% add_row(nome="Outliers.low", valore = toString(stVar.outliers.low))
                
                indice=which(stVar < stVar.outliers.low | stVar > stVar.outliers.up)
                stVar.outliers.sd <- as.data.frame(indice) 
                stVar.outliers.sd$valore<- subset(stVar,  stVar < stVar.outliers.low | stVar > stVar.outliers.up)
                outliers_sd<-stVar.outliers.sd

                stVar.outliers.num=count(stVar.outliers)
                outliers_sd_params <- outliers_sd_params %>% add_row(nome="Outliers.num", valore = toString(stVar.outliers.num))
                
                #****************************************************
                #* graphs for numeric cols
                #* 
                #**************************************************
                #* fingerprint
                unit="unit" # DA PASSARE COME PARAMETRO
                narm<-as.logical("TRUE") # DA PASSARE COME PARAMETRO
                
                geom="Box"
                pTitle<-paste("Fingerprint:", stVarName,geom)

                #**** parametrizzazione
                # ds<-airquality
                aes_s<-aes_string(x=0, y = stVarName)
                
                p <- ggplot(ds, aes_s) +
                    geom_boxplot(na.rm = narm, 
                                 outlier.colour="red", 
                                 outlier.shape=1,
                                 outlier.size=2, 
                                 notch=FALSE,
                                 alpha=0.80) + 
                    scale_y_continuous(name = unit) + 
                    scale_x_discrete(name = stVarName) + 
                    ggtitle(pTitle) #+ 
                    #geom_point(colour="green", size=2)
                #* aggiunge la media aritmetica
                p <- p + geom_point(aes(x=xc, y=stVar.mean), colour="red", size=4)
                p <- p + geom_hline(yintercept = stVar.mean, colour="red")
                #* aggiunge la moda
                p <- p + geom_point(aes(x=xc, y=stVar.moda), colour="blue", size=4)
                p <- p + geom_hline(yintercept = stVar.moda, colour="blue")
                #* aggiunge la mediana
                p <- p + geom_point(aes(x=xc, y=stVar.median), colour="green", size=4)
                p <- p + geom_hline(yintercept = stVar.median, colour="green")
                
                
                d <-ggplotly(p)
                
                ext=paste(sep="_","", pTitle,"Graph.html")
                fn=sub('.csv$', ext, specParamsList$CSVDataFilename)
                of=paste(sep="",rScriptOutputAbsolutePath,fn)
                
                htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
                
                msg<-paste("Salvataggio .", of)
                log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
                print(paste(msg,"<br>"))
                
                outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
                
                #***** violino
                geom="Violino"
                pTitle<-paste("Fingerprint:", stVarName,geom)
                
                p <- ggplot(ds, aes_s) +
                    geom_violin(na.rm = narm) + 
                    scale_y_continuous(name = yLabel) + 
                    scale_x_discrete(name = xLabel) + 
                    ggtitle(pTitle) 
                
                #* aggiunge la media aritmetica
                p <- p + geom_point(aes(x=xc, y=stVar.mean), colour="red", size=4)
                p <- p + geom_hline(yintercept = stVar.mean, colour="red")
                #* aggiunge la moda
                p <- p + geom_point(aes(x=xc, y=stVar.moda), colour="blue", size=4)
                p <- p + geom_hline(yintercept = stVar.moda, colour="blue")
                #* aggiunge la mediana
                p <- p + geom_point(aes(x=xc, y=stVar.median), colour="green", size=4)
                p <- p + geom_hline(yintercept = stVar.median, colour="green")
                
                d <-ggplotly(p)
                
                ext=paste(sep="_","", pTitle,"Graph.html")
                fn=sub('.csv$', ext, specParamsList$CSVDataFilename)
                of=paste(sep="",rScriptOutputAbsolutePath,fn)
                
                htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
                
                msg<-paste("Salvataggio .", of)
                log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
                print(paste(msg,"<br>"))
                
                outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
                
                #**************************************************
                #* asimmetria
                #* 

                pTitle<-paste("Asimmetria:", stVarName)
                
                aes_s<-aes_string(x = stVarName)
                
                p<-ggplot(data = ds, mapping = aes_s) +
                    stat_function(mapping = aes(colour = "fGarch"),
                                  fun = dsnorm,
                                  args = list(mean = stVar.mean,
                                              sd = stVar.sd,
                                              xi = stVar.skewness)) +
                    stat_function(mapping = aes(colour = "sn"),
                                  fun = dsn,
                                  args = list(xi = stVar.mean,
                                              omega = stVar.sd,
                                              alpha = stVar.skewness)) +
                    stat_function(mapping = aes(colour = "standard"),
                                  fun = dnorm,
                                  args = list(mean = stVar.mean,
                                              sd = stVar.sd),
                                  linetype = "dashed") +  
                    scale_colour_manual(name = NULL,
                                        values = c("red", "blue", "black")) +
                    ggtitle(pTitle)
                
                d <-ggplotly(p)
                
                ext=paste(sep="_","", pTitle,"Graph.html")
                fn=sub('.csv$', ext, specParamsList$CSVDataFilename)
                of=paste(sep="",rScriptOutputAbsolutePath,fn)
                
                htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
                
                msg<-paste("Salvataggio .", of)
                log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
                print(paste(msg,"<br>"))
                
                outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
                
                #* density
                pTitle<-paste("Density", stVarName, sep="_")
                
                p<-ggplot(ds, aes_s) +
                    geom_density(fill="#69b3a2", color="#e9ecef", alpha=0.8) +
                    ggtitle(pTitle)
                
                #* aggiunge la media aritmetica
                p <- p + geom_vline(xintercept = stVar.mean, colour="red")
                
                #* aggiunge la moda
                p <- p + geom_vline(xintercept = stVar.moda, colour="blue")
                
                d <-ggplotly(p)
                
                ext=paste(sep="_","", pTitle,"Graph.html")
                fn=sub('.csv$', ext, specParamsList$CSVDataFilename)
                of=paste(sep="",rScriptOutputAbsolutePath,fn)
                
                htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
                
                msg<-paste("Salvataggio .", of)
                log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
                print(paste(msg,"<br>"))
                
                outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
                
                #* *************************************************
                #* quantile
                #* 
                pTitle<-paste("Quantile", stVarName, sep="_")
                
                p<-ggplot(ds, aes_string(sample=stVarName)) + 
                    stat_qq(distribution=qnorm,geom="line") +
                    ggtitle(pTitle)

                d <-ggplotly(p)
                
                ext=paste(sep="_","", pTitle,"Graph.html")
                fn=sub('.csv$', ext, specParamsList$CSVDataFilename)
                of=paste(sep="",rScriptOutputAbsolutePath,fn)
                
                htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
                
                msg<-paste("Salvataggio .", of)
                log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
                print(paste(msg,"<br>"))
                
                outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
                
            }
            
            #* salvataggio csv
            #* 
            msg<-"Salvataggio csv analisi:"
            log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
            print(paste(msg,"<br>"))
            
            #* salvataggio fingereprint
            ext=paste(sep="_","", stVarName,"fingerprint.csv")
            fn=sub('.csv$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(fingerprint, file = of, row.names = FALSE)
            
            msg<-paste("Salvataggio .", of)
            log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
            print(paste(msg,"<br>"))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
            #* salvataggio quantili
            ext=paste(sep="_","", stVarName,"quantili.csv")
            fn=sub('.csv$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(quantili, file = of, row.names = FALSE)
            
            msg<-paste("Salvataggio .", of)
            log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
            print(paste(msg,"<br>"))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
            #* salvataggio centri
            ext=paste(sep="_","", stVarName,"centri.csv")
            fn=sub('.csv$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(centri, file = of, row.names = FALSE)
            
            msg<-paste("Salvataggio .", of)
            log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
            print(paste(msg,"<br>"))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
            #* salvataggio asimmetria
            ext=paste(sep="_","", stVarName,"asimmetria.csv")
            fn=sub('.csv$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(asimmetria, file = of, row.names = FALSE)
            
            msg<-paste("Salvataggio .", of)
            log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
            print(paste(msg,"<br>"))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
            #* salvataggio outliers iqr
            ext=paste(sep="_","", stVarName,"outliersPotenziali_iqr.csv")
            fn=sub('.csv$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(outliers_iqr, file = of, row.names = FALSE)

            msg<-paste("Salvataggio .", of)
            log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
            print(paste(msg,"<br>"))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
            #* salvataggio outliers iqr params
            ext=paste(sep="_","", stVarName,"outliersPotenziali_iqr_params.csv")
            fn=sub('.csv$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(outliers_iqr_params, file = of, row.names = FALSE)
            
            msg<-paste("Salvataggio .", of)
            log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
            print(paste(msg,"<br>"))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")

            #* salvataggio outliers sd
            ext=paste(sep="_","", stVarName,"outliersPotenziali_sd.csv")
            fn=sub('.csv$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(outliers_sd, file = of, row.names = FALSE)
            
            msg<-paste("Salvataggio .", of)
            log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
            print(paste(msg,"<br>"))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
            #* salvataggio outliers sd params
            ext=paste(sep="_","", stVarName,"outliersPotenziali_sd_params.csv")
            fn=sub('.csv$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(outliers_sd_params, file = of, row.names = FALSE)
            
            msg<-paste("Salvataggio .", of)
            log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
            print(paste(msg,"<br>"))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
        }
        
        # end do 
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
# warning=function(cond) {
#     # message(paste("URL caused a warning:", url))
#     # message("Here's the original warning message:")
#     #message(paste("warn:<br> ",cond))
#     print(paste("warn:<br> ",cond))
#     # Choose a return value in case of warning
#     out=NA
#     # return(NULL)
# },
finally={
    # NOTE:
    # Here goes everything that should be executed at the end,
    # regardless of success or error.
    # If you want more than one expression to be executed, then you 
    # need to wrap them in curly brackets ({...}); otherwise you could
    # just have written 'finally=<expression>' 
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
}
)    
# return(out)
# }

