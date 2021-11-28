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

    // prepara Prj object
    $OpDatCat = new OpDatCat($Db);
    // set Prjproperty values
    $OpDatCat->IdOpDatCat = $_GET['IdOpDatCat']; //"2"; //$_POST['IdOpDatCat'];
    // $Prj->NamPrj = $_POST['NamPrj'];
    // $Prj->Pwd = $_POST['Pwd']; //base64_encode($_POST['password'])
    // $Prj->idProfilo =  '';

    // seleziona la lista
    $Results = $OpDatCat->selectSingle();

    //throw new exception("Dati post.\n");

    // se l'Prj esiste
        // json encode lista Prj
        $OpDatCat_arr = array();
        if ($Results) {
            // conta le righe
            // $num = $Results->num_rows;
            while($Row = mysqli_fetch_assoc($Results)) {
                // $OpDatCat_arr[] = $Row;
                $Data=array(
                    "IdOpDatCat" => $Row['IdOpDatCat'],
                    "IdOpDatCatPar" => $Row['IdOpDatCatPar'],
                    "Nam" => $Row['Nam'],
                    "Descr" => $Row['Descr']
                );
            }
            $OpDatCat_arr = array(
                "State" => true,
                "Msg" => "Ok !",
                "Data" => $Data
            );

        } else {
            $OpDatCat_arr = array(
                "State" => false,
                "Msg" => "No result !"
            );
        }

    // $return_arr=array(
    //     "draw" => "1", 
    //     "recordsTotal"=> $num,
    //     "recordsFiltered"=> $num,
    //     "data"=> $OpDatCat_arr
    // );
    // print_r(json_encode("ciao"));

    print_r(json_encode($OpDatCat_arr));

} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
