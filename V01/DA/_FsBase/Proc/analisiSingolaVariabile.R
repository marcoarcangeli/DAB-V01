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
logAndPrint <- function(msg="No msg!"){
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(Sys.time() %>% as.character(),msg,"<br>"))
  
}
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
    #standardizzazione e normalizzazione
    library(BBmisc)

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
    
    logAndPrint(paste("Numero parametri in rScriptArgs: ", length(rScriptArgs)))
    
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
            #print(paste(specParams[i],"<br>"))
            specParam=str_split(specParams, "=")[[i]]
            key=specParam[1]
            value=specParam[2]
            #my_list1[key[1]] <- value[1] 
            specParamsList[key]<-value
            
            logAndPrint(paste("Nam: ", key, " - Val: ", value))
        }
        outputsList <- tibble(filename = character(), url = character(), check = character())
        ####################################
        
        ######################################################
        # caricamento dati
        logAndPrint("Analysis start:")
        
        eventNam=sub('.csv_da$', "", specParamsList$CSVDataFilename)

        ## carica dati grezzi
        #ds = read.csv(CSVDataPathFilename, dec=decSep, sep=csvSep, header=csvHeader)
        CSVDataPathFileName=paste(sep="", specParamsList$CSVDataPath,specParamsList$CSVDataFilename)
        ds = read.csv(CSVDataPathFileName, dec=specParamsList$decSep, sep=specParamsList$csvSep, header=as.logical(specParamsList$csvHeader) )
        logAndPrint("Data loaded.")
        # head(ds, 10)
        # class(ds)
        # str(ds)
        # nObs=count(ds)
        # ds %>% count(DAX2)
        ##################################
        # matrici per calcolo moduli di Fingerprint
        EFP <- tibble(nam = character(), val = character())
        FPMatrix = matrix(nrow=10,ncol=0)

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
            
            logAndPrint(paste("StVarName:",stVarName))
            
            stVar<-ds[[stVarName]]
            #* stVar<-ds[[1]]
            #**************************
            # variabili e fingerprint normalizzato e standardizzato
            stVarStd=NULL
            stVarNrm=NULL
            fingerprintStd=NULL
            fingerprintNrm=NULL
            
            FP                  <- tibble(nam = character(), val = character())
            fingerprint         <- tibble(nam = character(), val = character())
            quantili            <- tibble(nam = character(), val = character())
            outliers_iqr_params <- tibble(nam = character(), val = character())
            outliers_iqr        <- tibble(ind = integer(),   val = double())
            outliers_sd_params  <- tibble(nam = character(), val = character())
            outliers_sd         <- tibble(und = integer(),   val = double())
            centri              <- tibble(nam = character(), val = character())
            asimmetria          <- tibble(nam = character(), val = character())

            #per tutte le colonne
            #####################################
            logAndPrint(paste("# FINGERPRINT:"))
            
            stVar.length<-length(stVar)
            fingerprint <- fingerprint %>% add_row(nam="RowNum", val = toString(stVar.length))
            
            stVar.nMeasures<-sum(!is.na(stVar))
            fingerprint <- fingerprint %>% add_row(nam="MeasureNum", val = toString(stVar.nMeasures))
            
            stVar.moda<-mlv(stVar, method="shorth",na.rm = TRUE)
            fingerprint <- fingerprint %>% add_row(nam="Mode", val = toString(stVar.moda))
            
            #frequenze
            # print(" ")
            # print("#####################################")
            # print("# FREQUENZE")
            # print(" ")
            # 
            # print(freqTable<-freq(stVar, na.rm=TRUE)) 
            
            if(is.numeric(stVar)){
                logAndPrint(paste("Numeric variable: ",stVarName))
                #fingerprint
                #####################################
                # msg<-"# FINGERPRINT: calcolo"
                # log <- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
                # print(paste(msg,"<br>"))
                #standardizzazione
                # stVarStd=scale(stVar)
                stVarStd=normalize(stVar,method="standardize") # 
                logAndPrint(paste("# FINGERPRINT: standardized"))

                # head(stVarStd,10)
                # summary(stVarStd)
                fingerprintStd <- tibble(nam = character(), val = character())

                #normalize
                stVarNrm=normalize(stVar,method="range", range=c(0,1)) # 
                logAndPrint(paste("# FINGERPRINT: normalized"))

                # head(dsVarNrm,10)
                # summary(dsVarNrm)
                fingerprintNrm <- tibble(nam = character(), val = character())

                
                stVar.mean<-mean(stVar,na.rm = TRUE)
                fingerprint <- fingerprint %>% add_row(nam="Mean", val = toString(stVar.mean))
                
                stVar.sd<-sd(stVar,na.rm = TRUE)
                fingerprint <- fingerprint %>% add_row(nam="SD", val = toString(stVar.sd))
                FP <- FP %>% add_row(nam="sd", val = toString(stVar.sd))

                stVar.var<-sd(stVar,na.rm = TRUE)
                fingerprint <- fingerprint %>% add_row(nam="Var", val = toString(stVar.var))
                
                stVar.min<-min(stVar,na.rm = TRUE)
                fingerprint <- fingerprint %>% add_row(nam="Min", val = toString(stVar.min))
                
                stVar.max<-max(stVar,na.rm = TRUE)
                fingerprint <- fingerprint %>% add_row(nam="Max", val = toString(stVar.max))
                
                # stVar.range<-range(stVar,na.rm = TRUE)
                stVar.range <- stVar.max - stVar.min
                fingerprint <- fingerprint %>% add_row(nam="Range", val = toString(stVar.range))
                
                stVar.coeffVar<-stVar.sd / stVar.mean
                fingerprint <- fingerprint %>% add_row(nam="VarCoeff", val = toString(stVar.coeffVar))

                # Std
                stVarStd.length<-length(stVarStd)
                fingerprintStd <- fingerprintStd %>% add_row(nam="RowNum", val = toString(stVarStd.length))
                
                stVarStd.nMeasures<-sum(!is.na(stVarStd))
                fingerprintStd <- fingerprintStd %>% add_row(nam="MeasureNum", val = toString(stVarStd.nMeasures))
                
                stVarStd.moda<-mlv(stVarStd, method="shorth", na.rm = TRUE)
                # print(paste("Moda: ",stVarStd.moda))
                fingerprintStd <- fingerprintStd %>% add_row(nam="Moda", val = toString(stVarStd.moda))
                FP <- FP %>% add_row(nam="modaStd", val = toString(stVarStd.moda[1]))   # perle multimodali si considera il primo elemento

                stVarStd.mean<-mean(stVarStd, na.rm=TRUE)
                fingerprintStd <- fingerprintStd %>% add_row(nam="Mean", val = toString(stVarStd.mean))
                FP <- FP %>% add_row(nam="meanStd", val = toString(stVarStd.mean))
                
                stVarStd.sd<-sd(stVarStd, na.rm=TRUE)
                fingerprintStd <- fingerprintStd %>% add_row(nam="SD", val = toString(stVarStd.sd))
                
                stVarStd.var<-var(stVarStd, na.rm=TRUE)
                fingerprintStd <- fingerprintStd %>% add_row(nam="Var", val = toString(stVarStd.var))
                
                stVarStd.min<-min(stVarStd, na.rm=TRUE)
                fingerprintStd <- fingerprintStd %>% add_row(nam="Min", val = toString(stVarStd.min))
                FP <- FP %>% add_row(nam="minStd", val = toString(stVarStd.min))
                
                stVarStd.max<-max(stVarStd, na.rm=TRUE)
                fingerprintStd <- fingerprintStd %>% add_row(nam="Max", val = toString(stVarStd.max))
                FP <- FP %>% add_row(nam="maxStd", val = toString(stVarStd.max))
                
                # stVarStd.range<-range(stVarStd, na.rm=TRUE)
                stVarStd.range<-stVarStd.max - stVarStd.min
                fingerprintStd <- fingerprintStd %>% add_row(nam="Range", val = toString(stVarStd.range))
                FP <- FP %>% add_row(nam="rangeStd", val = toString(stVarStd.range))
                
                # Nrm
                stVarNrm.length<-length(stVarNrm)
                fingerprintNrm <- fingerprintNrm %>% add_row(nam="RowNum", val = toString(stVarNrm.length))
                
                stVarNrm.nMeasures<-sum(!is.na(stVarNrm))
                fingerprintNrm <- fingerprintNrm %>% add_row(nam="MeasureNum", val = toString(stVarNrm.nMeasures))
                
                stVarNrm.moda<-mlv(stVarNrm, method="shorth", na.rm = TRUE)
                # print(paste("Moda: ",stVarNrm.moda))
                fingerprintNrm <- fingerprintNrm %>% add_row(nam="Moda", val = toString(stVarNrm.moda))
                FP <- FP %>% add_row(nam="modaNrm", val = toString(stVarNrm.moda[1]))   # perle multimodali si considera il primo elemento

                stVarNrm.mean<-mean(stVarNrm, na.rm=TRUE)
                fingerprintNrm <- fingerprintNrm %>% add_row(nam="Mean", val = toString(stVarNrm.mean))
                FP <- FP %>% add_row(nam="meanNrm", val = toString(stVarNrm.mean))
                
                stVarNrm.sd<-sd(stVarNrm, na.rm=TRUE)
                fingerprintNrm <- fingerprintNrm %>% add_row(nam="SD", val = toString(stVarNrm.sd))
                FP <- FP %>% add_row(nam="sdNrm", val = toString(stVarNrm.sd))
                
                stVarNrm.var<-var(stVarNrm, na.rm=TRUE)
                fingerprintNrm <- fingerprintNrm %>% add_row(nam="Var", val = toString(stVarNrm.var))
                FP <- FP %>% add_row(nam="varNrm", val = toString(stVarNrm.var))
                
                stVarNrm.min<-min(stVarNrm, na.rm=TRUE)
                fingerprintNrm <- fingerprintNrm %>% add_row(nam="Min", val = toString(stVarNrm.min))
                
                stVarNrm.max<-max(stVarNrm, na.rm=TRUE)
                fingerprintNrm <- fingerprintNrm %>% add_row(nam="Max", val = toString(stVarNrm.max))
                
                # stVarNrm.range<-range(stVarNrm, na.rm=TRUE)
                stVarNrm.range<-stVarNrm.max - stVarNrm.min
                fingerprintNrm <- fingerprintNrm %>% add_row(nam="Range", val = toString(stVarNrm.range))

                ##############################################
                # aggiorna matrice dei fingerprint di variabile
                FPMatrix<-cbind(FPMatrix,as.numeric(FP[["val"]]))
                colnames(FPMatrix)[[ncol(FPMatrix)]] <- c(stVarName)
                #calcola modulo di variabile
                FPModulus=norm(as.matrix(as.numeric(FP[["val"]])))
                #aggiorna tabella dei moduli di variabile
                EFP <- EFP %>% add_row(nam=stVarName, val = toString(FPModulus))
                ###############################################

                #quantili
                #####################################
                logAndPrint(paste("# QUANTILE:"))
                
                cond<-1/3
                stVar.terzile<-quantile(stVar, probs = seq(0, 1, cond),na.rm = TRUE)
                quantili <- quantili %>% add_row(nam="Terzili", val = toString(stVar.terzile))
                
                cond<-1/4
                stVar.quartile<-quantile(stVar, probs = seq(0, 1, cond),na.rm = TRUE)
                quantili <- quantili %>% add_row(nam="Quartili", val = toString(stVar.quartile))
                
                cond<-1/5
                stVar.quintile<-quantile(stVar, probs = seq(0, 1, cond),na.rm = TRUE)
                quantili <- quantili %>% add_row(nam="Quintili", val = toString(stVar.quintile))
                
                cond<-c(0.02, 0.98)
                stVar.quantileExt<-quantile(stVar, cond,na.rm = TRUE)
                quantili <- quantili %>% add_row(nam="Percentili Estremi (2% 98%)", val = toString(stVar.quantileExt))
                
                cond= stVar.mean/2
                stVar.percentile<-length(stVar[stVar <= cond]) / stVar.length * 100
                quantili <- quantili %>% add_row(nam="Percentile (<=media/2)", val = toString(stVar.percentile))
                
                stVar.IQR<-IQR(stVar,na.rm = TRUE)
                quantili <- quantili %>% add_row(nam="Intervallo interquartile", val = toString(stVar.IQR))
                
                #centri
                #####################################
                logAndPrint(paste("# CENTRES:"))
                
                stVar.median<-median(stVar,na.rm = TRUE)
                centri <- centri %>% add_row(nam="Mediana", val = toString(stVar.median))
                
                stVar.harmonicMean<- 1/mean(1/stVar, na.rm=TRUE) 
                centri <- centri %>% add_row(nam="Media Armonica", val = toString(stVar.harmonicMean))
                
                stVar.geometricMean<-prod(stVar, na.rm=TRUE)^(1/stVar.length) 
                centri <- centri %>% add_row(nam="Media Geometrica", val = toString(stVar.geometricMean))
                
                stVar.quadraticMean<-sqrt(sum(stVar, na.rm=TRUE)^2/stVar.length)
                centri <- centri %>% add_row(nam="Media Quadratica", val = toString(stVar.geometricMean))
                
                #asimmetria
                #####################################
                logAndPrint(paste("# ASIMMETRIA:"))
                
                stVar.skewness<-skewness(stVar, na.rm=TRUE)
                asimmetria <- asimmetria %>% add_row(nam="Asimmetria", val = toString(stVar.skewness))
                
                stVar.kurtosis<-kurtosis(stVar, na.rm=TRUE)
                asimmetria <- asimmetria %>% add_row(nam="Curtosi", val = toString(stVar.kurtosis))
                
                stVar.moment<-moment(stVar, na.rm=TRUE)
                asimmetria <- asimmetria %>% add_row(nam="Momento Statistico", val = toString(stVar.moment))
                
                #outliers potenziali
                #####################################
                logAndPrint(paste("# OUTLIERS:"))
                
                #* OUTLIERS POTENZIALI fra 25 75 perc   OK
                #* dai quartili
                stVar.outliers.up<- stVar.quartile[4] + 1.5 * stVar.IQR         # Upper Range  
                outliers_iqr_params <- outliers_iqr_params %>% add_row(nam="Outliers.up", val = toString(stVar.outliers.up))
                
                stVar.outliers.low<- stVar.quartile[2] - 1.5 * stVar.IQR        # Lower Range
                outliers_iqr_params <- outliers_iqr_params %>% add_row(nam="Outliers.low", val = toString(stVar.outliers.low))
                #* crea tabella outliers su scarto interquartile
                indice=which(stVar < stVar.outliers.low | stVar > stVar.outliers.up)
                stVar.outliers.iqr <- as.data.frame(indice) 
                stVar.outliers.iqr$valore<- subset(stVar,  stVar < stVar.outliers.low | stVar > stVar.outliers.up)
                outliers_iqr<-stVar.outliers.iqr

                stVar.outliers.num=count(outliers_iqr)
                outliers_iqr_params <- outliers_iqr_params %>% add_row(nam="Outliers.num", val = toString(stVar.outliers.num))
                
                #* OUTLIERS POTENZIALI standard deviation filter  OK
                stVar.outliers.low <- stVar.mean - 3 * stVar.sd
                outliers_sd_params <- outliers_sd_params %>% add_row(nam="Outliers.up", val = toString(stVar.outliers.up))
                
                stVar.outliers.up <- stVar.mean + 3 * stVar.sd
                outliers_sd_params <- outliers_sd_params %>% add_row(nam="Outliers.low", val = toString(stVar.outliers.low))
                
                indice=which(stVar < stVar.outliers.low | stVar > stVar.outliers.up)

                stVar.outliers.sd <- as.data.frame(indice) 
                stVar.outliers.sd$valore<- subset(stVar,  stVar < stVar.outliers.low | stVar > stVar.outliers.up)
                outliers_sd<-stVar.outliers.sd

                stVar.outliers.num=count(outliers_sd)
                outliers_sd_params <- outliers_sd_params %>% add_row(nam="Outliers.num", val = toString(stVar.outliers.num))
                
                #****************************************************
                #* graphs for numeric cols
                #* 
                #**************************************************
                #* fingerprint
                logAndPrint(paste("# GRAPHS."))
                unit="unit" # DA PASSARE COME PARAMETRO
                narm<-as.logical("TRUE") # DA PASSARE COME PARAMETRO
                yLabel="unit" # DA PASSARE COME PARAMETRO
                xLabel=stVarName

                geom="Box"
                pTitle<-paste(sep="_","Fingerprint", stVarName, geom)

                #**** parametrizzazione
                # ds<-airquality
                aes_s<-aes_string(x=0, y = stVarName)
                logAndPrint(paste("# aes_string:",aes_s,"stVarName",stVarName))
                
                p <- ggplot(ds[stVarName], aes_s) +
                    geom_boxplot(na.rm = narm, 
                                 outlier.colour="red", 
                                 outlier.shape=1,
                                 outlier.size=2, 
                                 notch=FALSE,
                                 alpha=0.80) + 
                    scale_y_discrete(name = unit) + 
                    scale_x_discrete(name = stVarName) + 
                    ggtitle(pTitle) #+ 
                    #geom_point(colour="green", size=2)
                #* aggiunge la Mean
                p <- p + geom_point(aes(x=0, y=stVar.mean), colour="red", size=3)
                p <- p + geom_hline(yintercept = stVar.mean, colour="red")
                #* aggiunge la moda
                # p <- p + geom_point(aes(x=0, y=stVar.moda), colour="blue", size=3)
                # p <- p + geom_hline(yintercept = stVar.moda, colour="blue")
                #* aggiunge la mediana
                p <- p + geom_point(aes(x=0, y=stVar.median), colour="green", size=3)
                p <- p + geom_hline(yintercept = stVar.median, colour="green")
                
                d <-ggplotly(p)
                
                ext=paste(sep="_","", pTitle,"Graph.html")
                fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
                of=paste(sep="",rScriptOutputAbsolutePath,fn)
                logAndPrint(paste("Saved .", of))
                
                htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
                
                outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
                
                #***** violino
                geom="Violino"
                pTitle<-paste(sep="_","Fingerprint", stVarName,geom)
                
                p <- ggplot(ds[stVarName], aes_s) +
                    geom_violin(na.rm = narm) + 
                    scale_y_continuous(name = yLabel) + 
                    scale_x_discrete(name = xLabel) + 
                    ggtitle(pTitle) 
                
                #* aggiunge la Mean
                p <- p + geom_point(aes(x=0, y=stVar.mean), colour="red", size=3)
                p <- p + geom_hline(yintercept = stVar.mean, colour="red")
                #* aggiunge la moda
                # p <- p + geom_point(aes(x=0, y=stVar.moda), colour="blue", size=3)
                # p <- p + geom_hline(yintercept = stVar.moda, colour="blue")
                #* aggiunge la mediana
                p <- p + geom_point(aes(x=0, y=stVar.median), colour="green", size=3)
                p <- p + geom_hline(yintercept = stVar.median, colour="green")
                
                d <-ggplotly(p)
                
                ext=paste(sep="_","", pTitle,"Graph.html")
                fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
                of=paste(sep="",rScriptOutputAbsolutePath,fn)
                logAndPrint(paste("Saved .", of))
                
                htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
                
                outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
                
                #**************************************************
                #* asimmetria
                #* 

                pTitle<-paste(sep="_","Asimmetria", stVarName)
                
                aes_s<-aes_string(x = stVarName)
                
                # p<-ggplot(data = ds[stVarName], mapping = aes_s) +
                #     stat_function(mapping = aes(colour = "fGarch"),
                #                   fun = dsnorm,
                #                   args = list(mean = stVar.mean,
                #                               sd = stVar.sd,
                #                               xi = stVar.skewness)) +
                #     stat_function(mapping = aes(colour = "sn"),
                #                   fun = dsn,
                #                   args = list(xi = stVar.mean,
                #                               omega = stVar.sd,
                #                               alpha = stVar.skewness)) +
                #     stat_function(mapping = aes(colour = "standard"),
                #                   fun = dnorm,
                #                   args = list(mean = stVar.mean,
                #                               sd = stVar.sd),
                #                   linetype = "dashed") +  
                #     scale_colour_manual(name = NULL,
                #                         values = c("red", "blue", "black")) +
                # aes_s<-aes_string(x=0, y = stVarName)

                p<-ggplot(mapping = aes_s) +
                    stat_density(data = ds[stVarName],geom = "line", alpha = 1, colour = "cornflowerblue") +
                    geom_vline(xintercept = stVar.mean, colour="red") +
                    geom_vline(xintercept = stVar.median, colour="blue") +
                    geom_text(mapping = aes(x = stVar.mean, y = 0, label = "Mean", hjust = -0.1, vjust = -0.1)) +
                    geom_text(mapping = aes(x = stVar.median, y = 0, label = "Median", hjust = +0.1, vjust = +0.1)) +
                    ggtitle(pTitle)
                
                d <-ggplotly(p)
                
                ext=paste(sep="_","", pTitle,"Graph.html")
                fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
                of=paste(sep="",rScriptOutputAbsolutePath,fn)
                logAndPrint(paste("Saved .", of))
                
                htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
                
                outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
                
                #* density
                pTitle<-paste(sep="_","Density", stVarName)

                aes_s<-aes_string(x = stVarName)
                
                p<-ggplot(ds[stVarName], aes_s) +
                    geom_density(fill="#69b3a2", color="#e9ecef", alpha=0.8) +
                    ggtitle(pTitle)
                
                #* aggiunge la Mean
                p <- p + geom_vline(xintercept = stVar.mean, colour="red")
                
                #* aggiunge la moda
                p <- p + geom_vline(xintercept = stVar.median, colour="blue")
                #* aggiunge la moda
                # p <- p + geom_vline(xintercept = stVar.moda, colour="blue")
                
                d <-ggplotly(p)
                
                ext=paste(sep="_","", pTitle,"Graph.html")
                fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
                of=paste(sep="",rScriptOutputAbsolutePath,fn)
                
                htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
                
                logAndPrint(paste("Saved .", of))
                
                outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
                
                #* *************************************************
                #* quantile
                #* 
                pTitle<-paste(sep="_","Quantile", stVarName)
                
                p<-ggplot(ds[stVarName], aes_string(sample=stVarName)) + 
                    stat_qq(distribution=qnorm,geom="line") +
                    ggtitle(pTitle)

                d <-ggplotly(p)
                
                ext=paste(sep="_","", pTitle,"Graph.html")
                fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
                of=paste(sep="",rScriptOutputAbsolutePath,fn)
                
                htmlwidgets::saveWidget(as_widget(d), of,selfcontained = FALSE)
                
                logAndPrint(paste("Saved .", of))
                
                outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
                
            }
            
            #* Saved csv
            #* 
            logAndPrint(paste("Saved csv analisi:", of))
            
            #* Saved fingereprint
            ext=paste(sep="_","", stVarName,"fingerprint.csv_da")
            fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(fingerprint, file = of, row.names = FALSE)
            
            logAndPrint(paste("Saved .", of))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
            #* Saved fingereprintStd
            ext=paste(sep="_","", stVarName,"std_fingerprint.csv_da")
            fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(fingerprintStd, file = of, row.names = FALSE)
            
            logAndPrint(paste("Saved .", of))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
            #* Saved fingereprintNrm
            ext=paste(sep="_","", stVarName,"nrm_fingerprint.csv_da")
            fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(fingerprintNrm, file = of, row.names = FALSE)
            
            logAndPrint(paste("Saved .", of))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
            #* Saved quantili
            ext=paste(sep="_","", stVarName,"quantili.csv_da")
            fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(quantili, file = of, row.names = FALSE)
            
            logAndPrint(paste("Saved .", of))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
            #* Saved centri
            ext=paste(sep="_","", stVarName,"centri.csv_da")
            fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(centri, file = of, row.names = FALSE)
            
            logAndPrint(paste("Saved .", of))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
            #* Saved asimmetria
            ext=paste(sep="_","", stVarName,"asimmetria.csv_da")
            fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(asimmetria, file = of, row.names = FALSE)
            
            logAndPrint(paste("Saved .", of))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
            #* Saved outliers iqr
            ext=paste(sep="_","", stVarName,"outliersPotenziali_iqr.csv_da")
            fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(outliers_iqr, file = of, row.names = FALSE)

            logAndPrint(paste("Saved .", of))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
            #* Saved outliers iqr params
            ext=paste(sep="_","", stVarName,"outliersPotenziali_iqr_params.csv_da")
            fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(outliers_iqr_params, file = of, row.names = FALSE)
            
            logAndPrint(paste("Saved .", of))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")

            #* Saved outliers sd
            ext=paste(sep="_","", stVarName,"outliersPotenziali_sd.csv_da")
            fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(outliers_sd, file = of, row.names = FALSE)
            
            logAndPrint(paste("Saved .", of))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
            #* Saved outliers sd params
            ext=paste(sep="_","", stVarName,"outliersPotenziali_sd_params.csv_da")
            fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
            of=paste(sep="",rScriptOutputAbsolutePath,fn)
            
            write.csv2(outliers_sd_params, file = of, row.names = FALSE)
            
            logAndPrint(paste("Saved .", of))
            
            outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
        }

        #* Saved FP variable Matrix
        ext=paste(sep="_","", "stvarmtx_fingerprint.csv_da")
        fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
        of=paste(sep="",rScriptOutputAbsolutePath,fn)
        
        write.csv2(FPMatrix, file = of, row.names = FALSE)
        
        logAndPrint(paste("Saved .", of))
        
        outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            
        #calcola modulo di evento
        EFPModulus=norm(as.matrix(as.numeric(EFP[["val"]])))
        # aggiorna event fingereprint
        EFP <- EFP %>% add_row(nam=eventNam, val = toString(EFPModulus))

        #* Saved EFP  Event Fingerprint vector
        ext=paste(sep="_","", "evntvec_fingerprint.csv_da")
        fn=sub('_autoclean.csv_da$', ext, specParamsList$CSVDataFilename)
        of=paste(sep="",rScriptOutputAbsolutePath,fn)
        
        write.csv2(EFP, file = of, row.names = FALSE)
        
        logAndPrint(paste("Saved .", of))
        
        outputsList <- outputsList %>% add_row(filename = fn, url = of, check = "created")
            

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
    logAndPrint(paste("error: ",cond))
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
    logAndPrint("termine script<br>")
    
    # timestampEnd = Sys.time() %>% as.character()
    # log <- log %>% add_row(timestamp=timestampEnd, note = "End script.")
    
    #output list
    fn=paste(sep="_", rScriptName,"output.csv_da")
    of=paste(sep="", rScriptOutputAbsolutePath, fn)
    write.csv2(outputsList, file = of)
    logAndPrint(paste("Saved .", of))
    
    #log operazioni
    
    fn=paste(sep="_", rScriptName,"log.csv_da")
    of=paste(sep="", rScriptOutputAbsolutePath, fn)
    write.csv2(log, file = of)
    print(paste("Saved .", of))
    
    # message(paste("Processed URL:", url))
    #message("OK: end")
    print(paste("OK: end"))
}
)    
# return(out)
# }

