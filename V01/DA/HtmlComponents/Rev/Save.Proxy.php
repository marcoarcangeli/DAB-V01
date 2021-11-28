<?php

session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database Revd object files 
include_once($BFD.'DA/HtmlComponents/Rev/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\Rev\DaoCtrl as DAO;

// $CompulsoryParamSources = "_GET"; // next version
$CompulsoryParamNams = "IdRev";
$ParamNams="IdRev,IdAn,Note";
try {
    // prepare params
    $Params = array();
    $ParamNams_Arr = explode(",", $ParamNams);
    foreach ($ParamNams_Arr as $Param) {
        $Params[$Param] = isset($_POST[$Param])    ? $_POST[$Param]    : null;
    }
    if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[Nam]: ".$Params["Nam"]); }

    $Dao = new DAO();
    $Dao->CompulsoryParamNams = $CompulsoryParamNams;
    $Dao->ParamNams = $ParamNams;
    $Result_arr = $Dao->SaveDb($Params);

    print_r(json_encode($Result_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
