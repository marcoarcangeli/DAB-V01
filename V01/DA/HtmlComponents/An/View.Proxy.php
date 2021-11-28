<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/mySqlComponents/Database.php');
include_once($BFD.'DA/mySqlComponents/An.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\mySqlComponents\Database as DB;

try {
    // get Database connection
    $Db = new DB();
    $Db = $Db->getConnection();
    // throw new exception("Connection DB.\n");

    // prepara An object
    $An = new An($Db);


    // set Anproperty values
    if (isset($_SESSION["PSV"])) {
        $An_arr=$_SESSION["PSV"];
    }

    print_r(json_encode($An_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
    // throw new exception("Exception ".$e->getCode()." Msg: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine());
}
