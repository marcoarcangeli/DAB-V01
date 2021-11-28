<?php
session_start();

include_once('\xampp\htdocs\tesiTerzoAnno\DAB\DA\PhpRComponents\phpRController.php');

namespace DA\PhpRComponents;

use DA\PhpRComponents;

// // include database and object files. tesiTerzoAnno/DAB/DA/
// tesiTerzoAnno\DAB\DA\PhpRComponents\phpRController.php
/// C:\xampp\htdocs\tesiTerzoAnno\DAB\DA\PhpRComponents\phpRController.php

use DA\Logs\LogManager as LM;

// try {

    // prepara parametri
    // public string $rScriptAbsPath;
    // public string $rScriptOutputAbsPath;
    // public string $rScriptName;
    // public string $rScriptParams;
    // if(isset($_POST["rScriptParamsJSON"])){
    //     $rScriptParamsJSON = $_POST["rScriptParamsJSON"];
    //     echo
    // }

    // crea phpRController 
    $phpRController = new phpRController();
    // set parametri

    if (isset($_POST['rScriptAbsPath'])
        && trim($_POST['rScriptAbsPath']) != ''
    ) {
        $phpRController->rScriptAbsPath = $_POST["rScriptAbsPath"];
        echo "rScriptAbsPath", $phpRController->rScriptAbsPath,"<br>";
    }

    if (isset($_POST['rScriptOutputAbsPath'])
        && trim($_POST['rScriptOutputAbsPath']) != ''
    ) {
        $phpRController->rScriptOutputAbsPath = $_POST["rScriptOutputAbsPath"];
        echo "rScriptOutputAbsPath", $phpRController->rScriptOutputAbsPath,"<br>";
    }

    if (isset($_POST['rScriptName'])
        && trim($_POST['rScriptName']) != ''
    ) {
        $phpRController->rScriptName = $_POST["rScriptName"];
        echo "rScriptName: ", $phpRController->rScriptName,"<br>";
    }else{
        // log rScriptName non impostato
        echo "rScriptName: non impostato","<br>";
    }

    if (isset($_POST['rScriptParams'])
        && trim($_POST['rScriptParams']) != ''
    ) {
        $phpRController->rScriptParams = $_POST["rScriptParams"];
        echo "phpRController: ", $phpRController->rScriptParams,"<br>";
    }else{
        $phpRController->rScriptParams = array("noParams");
        echo "phpRController: array('noParams')", "<br>";
    }

    //esecuzione script R
    // $phpRController->mainControl();

    // echo "uscita forzata di test";
    // exit;

    // gestione ritorni script R

        // json encode risposta
        $risposta = array();
        if ($phpRController->mainControl()) {
            $risposta = array(
                "State" => TRUE ,
                "Msg" => "Risultato !"
            );
        } else {
            $risposta = array(
                "State" => FALSE,
                "Msg" => "Nessun Risultato !"
            );
        }

    print_r(json_encode($risposta));

// } catch (Exception $e) {
//     LM::LogMessage("ERROR", $e);
    
//     // throw new exception("Exception ".$e->getCode()." Msg: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine());
// }
