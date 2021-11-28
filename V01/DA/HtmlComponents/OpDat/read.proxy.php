<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/mySqlComponents/Database.php');
include_once($BFD.'DA/mySqlComponents/OpDat.php');

use DA\mySqlComponents\Database as DB;

try {

    // get Database connection
    $Db = new DB();
    $Db = $Db->getConnection();
    // throw new exception("Connection DB.\n");

    // prepara OpDat object
    $OpDat = new OpDat($Db);

    if (isset($_GET["IdOpDat"])) {
        if (trim($_GET["IdOpDat"]) != '') {
            $OpDat->idOpDat = $_GET['idOpDat']; //"2"; //$_POST['idOpDat'];
        }
    } 
    // if (isset($_GET["IdClean"])) {
    //     if (trim($_GET["IdClean"]) != '') {
    //         $OpDat->IdClean = $_GET['IdClean']; //"2"; //$_POST['idOpDat'];
    //     }
    // }

    // seleziona la lista
    $Results = $OpDat->selectSingle();
    //throw new exception("Dati post.\n");

    // se l'OpDat esiste
    // json encode lista OpDat
    $Prj_arr = array();
    if ($Results) {
        // conta le righe
        // $num = $Results->num_rows;

        while ($Row = mysqli_fetch_assoc($Results)) {
            // $Prj_arr[] = $Row;
            $Prj_arr = array(
                "IdOpDat" => $Row['idOpDat'],
                "IdClean" => $Row['IdClean'],
                "IdOpDatCat" => $Row['idOpDatCat'],
                "execOr" => $Row['execOr'],
                "note" => $Row['note']
            );
        }
    } else {
        $Prj_arr = array(
            "State" => false,
            "Msg" => "No result !"
        );
    }

    print_r(json_encode($Prj_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
