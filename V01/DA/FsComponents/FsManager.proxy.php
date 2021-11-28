<?php
// FsManager Class
session_start();
$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/FsComponents/FsManager.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\FsComponents\FsManager as FSM;


try {

    // definizione e istanza variabili
    // throw new exception("FsManagerProxy\n");

    $FsManagerCntx = "";
    $FsManagerMethod = "";
    $PrjNam = "";
    $AnNam = "";
    $FileNam = "";
    $FileNamNew = "";
    $FilePath = "";
    $FolderPath = "";
    $FilePathNew = "";
    $FileContent = "";
    $FileFilter = "";
    $OverWrite = "";
    $Delimiter = "";
    $ResultType = "";

    // Prjs, fsBase
    if (isset($_POST["FsManagerCntx"])) {
        if (trim($_POST["FsManagerCntx"]) != '') {
            $FsManagerCntx = $_POST["FsManagerCntx"];
        }
    }
    if (isset($_POST["FsManagerMethod"])) {
        if (trim($_POST["FsManagerMethod"]) != '') {
            $FsManagerMethod = $_POST["FsManagerMethod"];
        }
    }
    if (isset($_POST["PrjNam"])) {
        if (trim($_POST["PrjNam"]) != '') {
            $PrjNam = $_POST["PrjNam"];
        }
    }
    if (isset($_POST["AnNam"])) {
        if (trim($_POST["AnNam"]) != '') {
            $AnNam = $_POST["AnNam"];
        }
    }
    if (isset($_POST["FilePath"])) {
        if (trim($_POST["FilePath"]) != '') {
            $FilePath = $_POST["FilePath"];
        }
    }
    if (isset($_POST["FolderPath"])) {
        if (trim($_POST["FolderPath"]) != '') {
            $FolderPath = $_POST["FolderPath"];
        }
    }
    if (isset($_POST["FilePathNew"])) {
        if (trim($_POST["FilePathNew"]) != '') {
            $FilePathNew = $_POST["FilePathNew"];
        }
    }
    if (isset($_POST["FileNam"])) {
        if (trim($_POST["FileNam"]) != '') {
            $FileNam = $_POST["FileNam"];
        }
    }
    if (isset($_POST["FileNamNew"])) {
        if (trim($_POST["FileNamNew"]) != '') {
            $FileNamNew = $_POST["FileNamNew"];
        }
    }
    if (isset($_POST["FileContent"])) {
        if (trim($_POST["FileContent"]) != '') {
            $FileContent = $_POST["FileContent"];
        }
    }
    if (isset($_POST["FileFilter"])) {
        if (trim($_POST["FileFilter"]) != '') {
            $FileFilter = $_POST["FileFilter"];
        }
    }
    if (isset($_POST["OverWrite"])) {
        if (trim($_POST["OverWrite"]) != '') {
            $OverWrite = $_POST["OverWrite"];
        }
    }
    if (isset($_POST["Delimiter"])) {
        if (trim($_POST["Delimiter"]) != '') {
            $Delimiter = $_POST["Delimiter"];
        }
    }
    if (isset($_POST["ResultType"])) {
        if (trim($_POST["ResultType"]) != '') {
            $ResultType = $_POST["ResultType"];
        }
    }

    $p = [
        "PrjNam"        => $PrjNam,
        "AnNam"         => $AnNam,
        "FilePath"      => $FilePath,
        "FilePathNew"   => $FilePathNew,
        "FileNam"       => $FileNam,
        "FileNamNew"    => $FileNamNew,
        "FileContent"   => $FileContent,
        "OverWrite"     => $OverWrite,
        "Delimiter"     => $Delimiter,
        "ResultType"    => $ResultType
    ];

    // throw new exception(json_encode($p) . "\n");

    $o = new FSM();
    if ($o->$FsManagerMethod($p)) {
        $Result = "true";
    } else {
        if ($ResultType == "data") {
            exit;
        }
        $Result = "false";
    }
    // throw new exception($Result . "\n");

    print_r($Result);
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
