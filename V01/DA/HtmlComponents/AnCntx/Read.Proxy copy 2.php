<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/HtmlComponents/AnCntx/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\AnCntx\DaoCtrl as DAO;

// $CompulsoryParamSources = "_GET"; // next version
$CompulsoryParamNams = "IdAnCntx";
try {
    // get Database connection
    $Db = new DB();
    $Db = $Db->getConnection();
    // throw new exception("Connection DB.\n");

    // prepara AnCntx object
    $AnCntx = new AnCntx($Db);

    if (isset($_GET["IdAnCntx"])) {
        if (trim($_GET["IdAnCntx"]) != '') {
            $AnCntx->IdAnCntx = $_GET['IdAnCntx']; //"2"; //$_POST['IdAnCntx'];
        }
    } 
    // if (isset($_SESSION["PSV"]["IdPrj"])) {
    //     if ($_SESSION["PSV"]["IdPrj"] != '') {
    //         $AnCntx->IdPrj = $_SESSION["PSV"]["IdPrj"]; //"2"; //$_POST['IdAnCntx'];
    //     }
    // }

    // seleziona la lista
    $Results = $AnCntx->selectSingle();
    //throw new exception("Dati post.\n");

    // se l'AnCntx esiste
    // json encode lista AnCntx
    $AnCntx_arr = array();
    if ($Results) {
        // conta le righe
        // $num = $Results->num_rows;
        $Data=array();
        // throw new exception("Results->num_rows ".$num);
        // AnCntx (IdAnCntx, IdAn, IdCntx, idSplitRule, nam, descr, fileRefTrainDat, fileRefTestDat)
        while ($Row = mysqli_fetch_assoc($Results)) {
            // $AnCntx_arr[] = $Row;
            $Data = array(
                "IdAnCntx"          => $Row['IdAnCntx'],
                "IdCntx"            => $Row['IdCntx'],
                "CntxNam"           => $Row['CntxNam'],
                "IdAn"              => $Row['IdAn'],
                "AnNam"             => $Row['AnNam'],
                "IdPrj"             => $Row['IdPrj'],
                "IdSplitType"       => $Row['IdSplitType'],
                "SplitTypeNam"      => $Row['SplitTypeNam'],
                "Nam"               => $Row['Nam'],
                "Descr"             => $Row['Descr'],
                "fileRefTrainDat"   => $Row['fileRefTrainDat'],
                "fileRefTestDat"    => $Row['fileRefTestDat'],
                "Regr_Outcome"      => $Row['Regr_Outcome'],
                "Regr_Vars"         => $Row['Regr_Vars'],
                "Regr_CtrlMethod"   => $Row['Regr_CtrlMethod'],
                "Regr_ModelMethods" => $Row['Regr_ModelMethods']
            );
        }
        $AnCntx_arr = array(
            "State" => true,
            "Msg" => "Ok !",
            "Data" => $Data
        );
    } else {
        $AnCntx_arr = array(
            "State" => false,
            "Msg" => "No result !"
        );
    }

    // throw new exception(json_encode($AnCntx_arr));
    print_r(json_encode($AnCntx_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
    // throw new exception("Exception ".$e->getCode()." Msg: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine());
}
