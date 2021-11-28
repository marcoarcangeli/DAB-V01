############
# service functions
daWrite <- function(table, subject, newExt, CSVDataFilename, AbsolutePath, RelativePath, fileType="csv_da"){
  if(is.null(subject)){
    ext=paste(sep="_","", newExt)
  }else{
    ext=paste(sep="_","", subject, newExt)
  }

  fn=sub('.csv_da$', ext, CSVDataFilename)
  of=paste(sep="",AbsolutePath,fn)
  write.csv2(table, file = of, row.names = FALSE)
  rf=paste(sep="",RelativePath,fn)
  logAndPrint(paste("Saved:", rf))
  outputsList <<- outputsList %>% add_row(filename = fn, url = rf, check = "created")
}
###############################
