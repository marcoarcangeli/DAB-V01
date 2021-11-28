  # NOTE:
  # Here goes everything that should be executed at the end,
  # regardless of success or error.
  # If you want more than one expression to be executed, then you 
  # need to wrap them in curly brackets ({...}); otherwise you could
  # just have written 'finally=<expression>' 
  # message(paste("Processed URL:", url))
  #message("OK: end")
  #termine script
  logAndPrint("End script.")
  
  #outputs list
  fn=paste(sep="_", rScriptName,"output.csv_da")
  of=paste(sep="", rScriptOutputAbsolutePath, fn)
  write.csv2(outputsList, file = of, row.names = FALSE)
  rf=paste(sep="",rScriptOutputRelativePath,fn)
  logAndPrint(paste("Saved .", rf))
  
  #log operazioni
  
  fn=paste(sep="_", rScriptName,"log.csv_da")
  of=paste(sep="", rScriptOutputAbsolutePath, fn)
  write.csv2(log, file = of, row.names = FALSE)
  rf=paste(sep="",rScriptOutputRelativePath,fn)
  print(paste("Saved .", rf))
  
  # message(paste("Processed URL:", url))
  #message("OK: end")
  print(paste("OK: end"))
