<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/mySqlComponents/Database.php');
include_once($BFD.'DA/mySqlComponents/Prj.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\mySqlComponents\Database as DB;

try {
    // get Database connection
    $Db = new DB();
    $Db = $Db->getConnection();
    // throw new exception("Connection DB.\n");

    // prepara Prj object
    $Prj = new Prj($Db);


    // set Prjproperty values
    if (isset($_SESSION["PSV"])) {
        $Prj_arr=$_SESSION["PSV"];
    }

    print_r(json_encode($Prj_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
