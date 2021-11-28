<?php
$_SESSION["Debug"] = false; // true: debugMode active
// db connection
$_SESSION["DbHost"] = "localhost";
$_SESSION["DbNam"] = "dadbv01";
$_SESSION["DbUsrNam"] = "DABUser";
$_SESSION["DbPwd"] = "DABUser";

// set Paths Relative
$_SESSION["BaseFolderDyn"]  = explode(":",str_replace( '\\', '/', __DIR__))[1]."/";                     // BaseFolderDyn: /xampp/htdocs/tesiTerzoAnno/DAB/
// $_SESSION["MySqlConnJsonAbsPathFilename"] = $_SESSION["BaseFolderDyn"]."MySqlConn.json";
$_SESSION["LogRelPath"]     = "DA/Logs/";
$_SESSION["LogAbsPath"]     = $_SESSION["BaseFolderDyn"] . $_SESSION["LogRelPath"];
