        #* verifica valori sospetti per nuovo tipo
        #* numero campi vuoti per conteggi anomalie
        NaMapColc=which(is.na(dscn), arr.ind=TRUE)
        #* conta NA
        nAnomCol=length(NaMapColc)
        nErrCol=nAnomCol-nNaCol
        
        ErrMapCol= setdiff(NaMapColc,NaMapCol)
        ErrvalMapCol=dsc[ErrMapCol]
        
        AnomMapCol=paste(paste(ErrMapCol,sep="",collapse=","),paste(NaMapCol,sep="",collapse=","),sep="",collapse=",")
        AnomvalMapCol=dsc[AnomMapCol]

