<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/HtmlComponents/An/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\An\DaoCtrl as DAO;

$CompulsoryParamSources = "_POST";  // next version: eval + multivalue
$CompulsoryParamNams = "IdAn";     // next version: multivalue
$ParamNams="IdAn,IdPrj,IdAlg,IdAnState,Nam,Descr,Dttm";
try {
    // prepare params
    $Params = array();
    $PostedParams_Arr = explode(",", $ParamNams);
    foreach ($PostedParams_Arr as $Param) {
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
