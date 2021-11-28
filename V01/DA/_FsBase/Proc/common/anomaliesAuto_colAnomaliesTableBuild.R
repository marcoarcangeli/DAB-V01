  #* build anomalies map
  #* log
  #* 
  #* mappa anomalie 
  #** nome, valore
  logAndPrint(paste("Build  anomalies csv Column:", i, "-", c))
  
  anomCol <- tibble(nam = character(), val = character())

  anomCol <- anomCol %>% add_row(nam="colName", val = toString(c))
  anomCol <- anomCol %>% add_row(nam="rns", val = toString(rns))
  anomCol <- anomCol %>% add_row(nam="nMeasuresCol", val = toString(nMeasuresCol))
  anomCol <- anomCol %>% add_row(nam="percMeasuresCol", val = toString(percMeasuresCol))

  #** numero anomalie => numero NA finali
  anomCol <- anomCol %>% add_row(nam="nNaCol", val = toString(nNaCol))
  anomCol <- anomCol %>% add_row(nam="nErrCol", val = toString(nErrCol))
  anomCol <- anomCol %>% add_row(nam="nAnomCol", val = toString(nAnomCol))
  #** nomeColonna => da TipoAutomatico e TipoDesiderato
  anomCol <- anomCol %>% add_row(nam="typeMap", val = paste(ctsaRev[i],"->",ctsd[i]))
  #** Mappe Anomalie
  anomCol <- anomCol %>% add_row(nam="NaMapCol", val = paste(NaMapCol,sep="",collapse=","))
  anomCol <- anomCol %>% add_row(nam="ErrMapCol", val = paste(ErrMapCol,sep="",collapse=","))
  anomCol <- anomCol %>% add_row(nam="AnomMapCol", val = paste(AnomMapCol,sep="",collapse=","))
  #** nomeColonna => da TipoAutomatico e TipoDesiderato
  anomCol <- anomCol %>% add_row(nam="ErrvalMapCol", val = paste(ErrvalMapCol,sep="",collapse=","))
  anomCol <- anomCol %>% add_row(nam="AnomvalMapCol", val = paste(AnomvalMapCol,sep="",collapse=","))
