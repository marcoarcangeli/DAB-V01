<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/mySqlComponents/Database.php');
include_once($BFD.'DA/mySqlComponents/OpDat.php');

use DA\Logs\LogManager as LM;
use DA\mySqlComponents\Database as DB;

try {
    // get Database connection
    $Db = new DB();
    $Db = $Db->getConnection();
    // throw new exception("Connection DB.\n");

    // prepara OpDat object
    $OpDat = new OpDat($Db);

    // if (isset($_GET["IdOpDat"])) {
    //     if (trim($_GET["IdOpDat"]) != '') {
    //         $OpDat->idOpDat = $_GET['idOpDat']; //"2"; //$_POST['idOpDat'];
    //         // $Prj->NamPrj = $_POST['NamPrj'];
    //         // $Prj->Pwd = $_POST['Pwd']; //base64_encode($_POST['password'])
    //         // $Prj->idProfilo =  '';

    //     }
    // }
    // set OpDatproperty values
    // $OpDat->idOpDat = $_POST['idOpDat'];
    // $OpDat->NamOpDat = $_POST['NamOpDat'];
    // $OpDat->Pwd = $_POST['Pwd']; //base64_encode($_POST['password'])
    // $OpDat->idProfilo =  '';
    //throw new exception("Dati post.\n");
    // seleziona la lista
    $Results = $OpDat->selectAll();

    // se l'OpDat esiste
    // json encode lista OpDat
    $OpDat_arr = array();
    if ($Results) {
        // conta le righe
        $num = $Results->num_rows;

        while ($Row = mysqli_fetch_assoc($Results)) {
            $OpDat_arr[] = $Row;
        }
    } else {
        $OpDat_arr = array(
            "State" => false,
            "Msg" => "No result !"
        );
    }

    $return_arr = array(
        "draw" => "1",
        "recordsTotal" => $num,
        "recordsFiltered" => $num,
        "data" => $OpDat_arr
    );

    print_r(json_encode($return_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
