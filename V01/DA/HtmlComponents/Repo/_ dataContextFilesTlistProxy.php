<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/FsComponents/fsManager.php');
// include_once($BFD.'DA/mySqlComponents/Cntxo.php');
use DA\FsComponents\FsManager as FSM;
use DA\Logs\LogManager as LM;

try {

    // set Prjproperty values
    // $Cntx->idPrj = $_POST['idPrj'];
    //throw new exception("Dati post.\n");
    // get manager object
    $dir  = '/xampp/htdocs/tesiTerzoAnno/DAB/DA/_fsBase/Data/Cntx/';
    $files = array();
    $fsm = new FSM();
    // $Db = $fsm->folderFilesList(array($_POST['projectFolder']));
    $files = $fsm->folderFilesList(array("folderPath" => $dir, "fileFilter" => $_SESSION["CntxDataFile"]));
    // throw new exception("Connection DB.\n");

    // conta le righe
    // $num = $Results->num_rows;

    // $num = $Result_arr->length;
    $num = count($files);
    // echo "nume files: " . count($files);


    $Result_arr = array();
    $Result_arr = $files;

    // se l'Cntxo esiste
    // if ($Result_arr) {
    //     while ($Row = mysqli_fetch_assoc($Results)) {
    //         $Prj_arr[] = $Row;
    //     }
    // } else {
    //     $Result_arr = array(
    //         "State" => false,
    //         "Msg" => "No result !"
    //     );
    // }

    $return_arr = array(
        "draw" => "1",
        "recordsTotal" => $num,
        "recordsFiltered" => $num,
        "data" => $Result_arr
    );

    // json encode 
    print_r(json_encode($return_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}

