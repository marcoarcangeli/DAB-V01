<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/mySqlComponents/Database.php');
include_once($BFD.'DA/mySqlComponents/OpDatCat.php');

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
    $OpDatCat->IdOpDatCat = $_POST['IdOpDatCat'];
    //throw new exception("Dati post.\n");

    // se l'OpDatCat esiste
    if (
        isset($_POST['IdOpDatCat'])
        && trim($_POST['IdOpDatCat']) != ''
    ) {
        // update the OpDatCat
        if ($OpDatCat->delete()) {
            $OpDatCat_arr = array(
                "State" => true,
                "Msg" => "Deleted !",
                "IdOpDatCat" => $OpDatCat->IdOpDatCat //,
            );
        } else {
            $OpDatCat_arr = array(
                "State" => false,
                "Msg" => "Not deleted !"
            );
        }
    } else {
        $OpDatCat_arr = array(
            "State" => false,
            "Msg" => "IdOpDatCat incorrect !"
        );
    }

    print_r(json_encode($OpDatCat_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
