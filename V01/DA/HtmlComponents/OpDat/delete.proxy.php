<?php

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

    // set Prjproperty values
    $OpDat->idOpDat = $_POST['idOpDat'];
    //throw new exception("Dati post.\n");

    // se l'OpDat esiste
    if (
        isset($_POST['idOpDat'])
        && trim($_POST['idOpDat']) != ''
    ) {
        // update the OpDat
        if ($OpDat->delete()) {
            $Prj_arr = array(
                "State" => true,
                "Msg" => "Deleted !",
                "IdOpDat" => $OpDat->idOpDat //,
            );
        } else {
            $Prj_arr = array(
                "State" => false,
                "Msg" => "Not deleted !"
            );
        }
    } else {
        $Prj_arr = array(
            "State" => false,
            "Msg" => "Id incorrect !"
        );
    }

    print_r(json_encode($Prj_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
