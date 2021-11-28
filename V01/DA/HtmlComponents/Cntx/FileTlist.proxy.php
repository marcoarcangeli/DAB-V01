<?php

session_start();
$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/HtmlComponents/Cntx/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\Cntx\DaoCtrl as DAO;

// $CompulsoryParamSources = "_GET"; // next version
// $CompulsoryParamNams = "IdCntx";
try {
    $Params_arr = array();
    //     $CompulsoryParamNams => $_POST[$CompulsoryParamNams] //,
    // );
    $Dao = new DAO();
    // $Dao->CompulsoryParamNams = $CompulsoryParamNams;
    $Result_arr = $Dao->FileTlistFs($Params_arr);

    print_r(json_encode($Result_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}

