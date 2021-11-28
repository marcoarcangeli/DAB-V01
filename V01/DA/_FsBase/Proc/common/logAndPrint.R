############
# service functions
logAndPrint <- function(msg="No msg!"){
  log <<- log %>% add_row(timestamp = Sys.time() %>% as.character(), note = msg)
  print(paste(Sys.time() %>% as.character(),msg,"<br>"))
}
###############################
