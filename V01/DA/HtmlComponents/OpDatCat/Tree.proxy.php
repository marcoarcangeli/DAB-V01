<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/mySqlComponents/Database.php');
include_once($BFD.'DA/mySqlComponents/OpDatCat.php');
$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\mySqlComponents\Database as DB;

try {
    // get Database connection
    $Db = new DB();
    $Db = $Db->getConnection();
    // throw new exception("Connection DB.\n");

    // prepara OpDatCat object
    $OpDatCat = new OpDatCat($Db);
// seleziona la lista
    $Results = $OpDatCat->selectAll();

    //throw new exception("Dati post.\n");

    // se l'OpDatCat esiste
        // json encode lista OpDatCat
        $OpDatCat_arr = array();
        if ($Results) {
            // conta le righe
            // $num = $Results->num_rows;
            while($Row = mysqli_fetch_assoc($Results)) {
                $OpDatCat_arr[] = $Row;
            }
        } else {
            $OpDatCat_arr = array(
                "State" => false,
                "Msg" => "No result !"
            );
        }

    $return_arr=array(
        "State" => true,
        "Msg" => "Ok !",
        "Data"=> $OpDatCat_arr
    );

    print_r(json_encode($return_arr));

} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
