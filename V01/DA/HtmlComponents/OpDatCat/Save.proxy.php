<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/mySqlComponents/Database.php');
include_once($BFD.'DA/mySqlComponents/OpDatCat.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\mySqlComponents\Database as DB;

try {
    // get Database connection
    $Db = new DB();
    $Db = $Db->getConnection();
    // throw new exception("Connection DB.\n");

    // prepare OpDatCatobject
    $OpDatCat = new OpDatCat($Db);
    // set OpDatCatproperty values
    $OpDatCat->IdOpDatCat   = $_POST['IdOpDatCat'];
    $OpDatCat->IdOpDatCatPar= $_POST['IdOpDatCatPar'];
    $OpDatCat->Nam        = $_POST['Nam']; 
    $OpDatCat->Descr      = $_POST['Descr'];
    //throw new exception("Dati post.\n");

    // se l'OpDatCat esiste
    if (
        isset($_POST['IdOpDatCat'])
        && trim($_POST['IdOpDatCat']) != ''
    ) {
        // update the OpDatCat
        if ($OpDatCat->update()) {
            $OpDatCat_arr = array(
                "State" => true,
                "Msg" => "Updated !",
                "IdOpDatCat" => $OpDatCat->IdOpDatCat //,
            );
        } else {
            $OpDatCat_arr = array(
                "State" => false,
                "Msg" => "Not inserted !"
            );
        }
    } else {
        // create the OpDatCat
        if ($OpDatCat->insert()) {
            $OpDatCat_arr = array(
                "State" => true,
                "Msg" => "Inserted !",
                "IdOpDatCat" => $OpDatCat->IdOpDatCat //,
            );
        } else {
            $OpDatCat_arr = array(
                "State" => false,
                "Msg" => "Operation not executed !"
            );
        }
    }

    print_r(json_encode($OpDatCat_arr));

} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
