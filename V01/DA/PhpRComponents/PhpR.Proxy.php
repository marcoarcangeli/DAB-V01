<?php

// namespace DA\PhpRComponents;
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/PhpRComponents/PhpR.Controller.php');

use DA\Logs\LogManager as LM;
use DA\PhpRComponents\PhpRController as PHPRC;

// // include database and object files. tesiTerzoAnno/DAB/DA/
// tesiTerzoAnno\DAB\DA\PhpRComponents\PhpRController.php
/// C:\xampp\htdocs\tesiTerzoAnno\DAB\DA\PhpRComponents\PhpRController.php
// include_once('\xampp\htdocs\tesiTerzoAnno\DAB\DA\PhpRComponents\PhpRController.php');

try {
    // prepara parametri
    // public string $ProcAbsPath;
    // public string $OutputAbsPath;
    // public string $ProcNam;
    // public string $ProcParams;
    // if(isset($_POST["ProcParamsJSON"])){
    //     $ProcParamsJSON = $_POST["ProcParamsJSON"];
    //     echo
    // }

    // crea PhpRController 
    $PhpRController = new PHPRC();
    // set parametri

    if (isset($_POST["ProcAbsPath"])
        && trim($_POST["ProcAbsPath"]) != ''
    ) {
        $PhpRController->ProcAbsPath = $_POST["ProcAbsPath"];
        echo "ProcAbsPath: ", $PhpRController->ProcAbsPath,"<br>";
    }

    // $PhpRController->OutputAbsPath = $_SESSION["PrjAbsPath"].$_SESSION["PrjStateVec"]["PrjFolderNam"].$_SESSION["PrjStateVec"]["EvntFolderNam"].'/';
    // echo "OutputAbsPath", $PhpRController->OutputAbsPath,"<br>";

    if (isset($_POST['OutputAbsPath'])
        && trim($_POST['OutputAbsPath']) != ''
    ) {
        $PhpRController->OutputAbsPath = $_POST["OutputAbsPath"];
        echo "OutputAbsPath: ", $PhpRController->OutputAbsPath,"<br>";
    }else{
        // log ProcNam non impostato
        echo "OutputAbsPath: non impostato","<br>";
    }

    if (isset($_POST['ProcNam'])
        && trim($_POST['ProcNam']) != ''
    ) {
        $PhpRController->ProcNam = $_POST["ProcNam"];
        echo "ProcNam: ", $PhpRController->ProcNam,"<br>";
    }else{
        // log ProcNam non impostato
        echo "ProcNam: non impostato","<br>";
    }

    if (isset($_POST['ProcParams'])
        && trim($_POST['ProcParams']) != ''
    ) {
        $PhpRController->ProcParams = $_POST["ProcParams"];
        echo "ProcParams: ", $PhpRController->ProcParams,"<br>";
    }else{
        // log ProcNam non impostato
        echo "ProcParams: non impostato","<br>";
    }

    // exit;

    // gestione ritorni script R

    // throw new exception("ProcParams: ".$PhpRController->ProcParams."\n");

    // json encode result
    $result = array();
    if ($PhpRController->mainControl()) {
        $result = array(
            "State" => TRUE ,
            "Msg" => "Executed !"
        );
    } else {
        $result = array(
            "State" => FALSE,
            "Msg" => "Not executed !"
        );
    }

    print_r(json_encode($result));

} catch (Exception $e){
    LM::LogMessage("ERROR", $e);
    return false;
}
