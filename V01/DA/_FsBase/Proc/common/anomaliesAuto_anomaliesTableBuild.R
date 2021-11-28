  #* build anomalies map
logAndPrint(paste("Build overall anomalies csv"))
#* salva mappa anomalie automatiche
#* mappa anomalie
#** nome, valore
anom <- tibble(nam = character(), val = character())

anom <- anom %>% add_row(nam="nMeasures", val = toString(nMeasures))
anom <- anom %>% add_row(nam="percMeasures", val = toString(percMeasures))
#** numero anomalie => numero NA finali
anom <- anom %>% add_row(nam="nNa", val = toString(nNa))
anom <- anom %>% add_row(nam="nErr", val = toString(nErr))
anom <- anom %>% add_row(nam="nAnom", val = toString(nAnom))
# #** nomeColonna => da TipoAutomatico e TipoDesiderato
anom <- anom %>% add_row(nam="NaMap", val = paste(NaMap,sep="",collapse=","))
anom <- anom %>% add_row(nam="ErrMap", val = paste(ErrMap,sep="",collapse=","))
anom <- anom %>% add_row(nam="AnomMap", val = paste(AnomMap,sep="",collapse=","))
# #** nomeColonna => da TipoAutomatico e TipoDesiderato
# anom <- anom %>% add_row(nam="ErrvalMap", val = toString(ErrvalMap))

#** colonna enumerativa => inserita|trovata
anom <- anom %>% add_row(nam="DeletedEnumCols", val = paste(DeletedEnumCols,sep="",collapse=","))
anom <- anom %>% add_row(nam="AnomvalMap", val = paste(AnomvalMap,sep="",collapse=","))
