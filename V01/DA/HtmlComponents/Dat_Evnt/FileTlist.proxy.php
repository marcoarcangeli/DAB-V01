<?php

session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
// include_once('/xampp/htdocs/TesiTerzoAnno/DAB/SessionInitParams.php');
include_once($BFD.'DA/HtmlComponents/Dat_Evnt/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\Dat_Evnt\DaoCtrl as DAO;

// $CompulsoryParamSources = "_GET"; // next version
// $CompulsoryParamNams = "IdDat_Evnt";
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

