<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/FsComponents/fsManager.php');
// include_once($BFD.'DA/mySqlComponents/Evnt.php');

use DA\FsComponents\FsManager as FSM;

try {

    // set Prjproperty values
    // $Evnt->idPrj = $_POST['idPrj'];
    //throw new exception("Dati post.\n");
    // get manager object
    $dir  = '/xampp/htdocs/tesiTerzoAnno/DAB/DA/_fsBase/Data/Evnt/';
    $files = array();
    $fsm = new FSM();
    // $Db = $fsm->folderFilesList(array($_POST['projectFolder']));
    $files = $fsm->folderFilesList(array("folderPath" => $dir, "fileFilter" => $_SESSION["EvntDataFile"]));
    // throw new exception("Connection DB.\n");

    // conta le righe
    $num = count($files);
    // echo "nume files: " . count($files);

    $Result_arr = array();
    $Result_arr = $files;

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

