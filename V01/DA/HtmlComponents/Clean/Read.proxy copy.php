<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/mySqlComponents/Database.php');
include_once($BFD.'DA/mySqlComponents/Clean.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\mySqlComponents\Database as DB;

try {
    // get Database connection
    $Db = new DB();
    $Db = $Db->getConnection();
    // throw new exception("Connection DB.\n");

    // prepara Clean object
    // Clean(IdClean, IdPrj, IdEvnt, Note, timestamp, IdUsr)
    $Clean = new Clean($Db);

    if (isset($_GET["IdClean"])) {
        if (trim($_GET["IdClean"]) != '') {
            $Clean->IdClean = $_GET['IdClean']; //"2"; //$_POST['IdClean'];
        }
    } 
    // if (isset($_SESSION["PSV"]["IdPrj"])) {
    //     if ($_SESSION["PSV"]["IdPrj"] != '') {
    //         $Evnt->IdPrj = $_SESSION["PSV"]["IdPrj"]; //"2"; //$_POST['IdEvnt'];
    //     }
    // }

    // throw new exception("Dati post.\n");
    // seleziona la lista
    $Results = $Clean->selectSingle();
    // throw new exception("Result. ".$Results->num_rows."\n");

    // se l'Clean esiste
    // json encode lista Clean
    $Clean_arr = array();
    if ($Results) {
        // conta le righe
        // $num = $Results->num_rows;
        $Data=array();
        while ($Row = mysqli_fetch_assoc($Results)) {
            // $Clean_arr[] = $Row;
            $Data = array(
                "IdClean" => $Row['IdClean'],
                "IdPrj" => $Row['IdPrj'],
                "PrjNam" => $Row['PrjNam'],
                "Note" => $Row['Note'],
                "ctsd" => $Row['ctsd'],
                "cnsd" => $Row['cnsd'],
                "cusd" => $Row['cusd']
            );
        }
        $Clean_arr = array(
            "State" => true,
            "Msg" => "Ok !",
            "Data" => $Data
        );
    } else {
        $Clean_arr = array(
            "State" => false,
            "Msg" => "No result !"
        );
    }

    // throw new exception(json_encode($Clean_arr));
    print_r(json_encode($Clean_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
    // throw new exception("Exception ".$e->getCode()." Msg: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine());
}
