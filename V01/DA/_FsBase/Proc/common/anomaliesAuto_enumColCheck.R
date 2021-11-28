  logAndPrint(paste("Enum col check: "))
  #* se ancora non è stata trovata una colonna enumerativa
  # elimina la colonna se meramente enumerativa
  # if(enumColCheck=="N"){  
    #* se colonna numerica
    if(is.numeric(dsc)){  
      #* se colonna enumerativa
      if(is.integer(dsc)){
        #* crea colonna enumerativa
        enumCol<-(1:rns)
        #* se la colonna numerica è enumerativa
        if(identical(dsc,enumCol)){
          # imposta flag presenza colonna enumerativa
          # enumColCheck="Y"    
          # imposta il nome convenzionale colonnna enumerativa
          # if(c!=enumColStdName){
            # rimuovi la colonna
            dsRev[c] <- NULL
            # --
            DeletedEnumCols <- append(DeletedEnumCols, c)
            logAndPrint(paste("Column Deleted: ", c))
            next

            # enumColCheck="N"    
            # YES-Renamed
            # names(dsRev)[names(dsRev) == c] <- enumColStdName
            # head(dsRev)
          # }
        }
      }
    }
  # }
