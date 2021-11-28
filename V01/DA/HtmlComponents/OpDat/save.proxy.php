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

    // prepare Prjobject
    $OpDat = new OpDat($Db);
    /*
    // OpDat(idOpDat, IdClean, idOpDatCat, execOr, note, fileRefDatiOpDat, timestamp, IdUsr)
*/
    // set Prjproperty values
    $OpDat->idOpDat = $_POST['idOpDat'];
    $OpDat->IdClean = $_POST['IdClean'];
    $OpDat->idOpDatCat = $_POST['idOpDatCat'];
    $OpDat->execOr =   $_POST['execOr'];
    $OpDat->note =   $_POST['note'];
    // throw new exception("Dati post.\n");

    // se l'OpDat esiste
    if (
        isset($_POST['idOpDat'])
        && trim($_POST['idOpDat']) != ''
    ) {
        // update the OpDat
        if ($OpDat->update()) {
            $Result_arr = array(
                "State" => true,
                "Msg" => "Updated !",
                "IdOpDat" => $OpDat->idOpDat //,
            );
        } else {
            $Result_arr = array(
                "State" => false,
                "Msg" => "Not updated !"
            );
        }
    } else {
        // create the OpDat
        if ($OpDat->insert()) {
            $Result_arr = array(
                "State" => true,
                "Msg" => "Inserted !",
                "IdOpDat" => $OpDat->idOpDat //,
                // "IdUsr" => $OpDat->IdUsr,
                // "IdOpDatCat" => $OpDat->idOpDatCat,
                // "IdProfilo" => $OpDat->idProfilo
            );
        } else {
            $Result_arr = array(
                "State" => false,
                "Msg" => "Not inserted !"
            );
        }
    }
    // throw new exception(json_encode($Result_arr) . "\n");

    print_r(json_encode($Result_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
