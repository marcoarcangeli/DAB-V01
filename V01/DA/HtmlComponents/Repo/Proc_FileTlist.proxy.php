<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/FsComponents/FsManager.php');
// include_once($BFD.'DA/mySqlComponents/Evnt.php');

use DA\FsComponents\FsManager as FSM;

try {
    // set Prjproperty values
    // $Evnt->idPrj = $_POST['idPrj'];
    //throw new exception("Dati post.\n");
    // get manager object
    $Dir  = $_SESSION["ProcAbsPath"];
    $Files = array();
    $Fsm = new FSM();
    // $Db = $Fsm->folderFilesList(array($_POST['projectFolder']));
    $Files = $Fsm->FolderFileList(array("FolderPath" => $Dir, "FileFilter" => '.csv'));
    // throw new exception("Connection DB.\n");

    // conta le righe
    $num = count($Files);
    // echo "nume files: " . count($Files);
    $Result_arr = array();
    $Result_arr = $Files;

    $return_arr = array(
        "draw" => "1",
        "recordsTotal" => $num,
        "recordsFiltered" => $num,
        "State" => true,
        "Msg" => "Success.",
        "data" => $Result_arr
    );

    // json encode 
    print_r(json_encode($return_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    $return_arr = array(
        "draw" => "1",
        "recordsTotal" => 0,
        "recordsFiltered" => 0,
        "State" => false,
        "Msg" => "No result !",
        "data" => array()
    );
    print_r(json_encode($return_arr));
    // throw new exception("Exception ".$e->getCode()." Msg: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine());
}

