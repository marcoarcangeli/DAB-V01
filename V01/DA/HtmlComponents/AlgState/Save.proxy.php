<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/HtmlComponents/AlgState/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\AlgState\DaoCtrl as DAO;

// $CompulsoryParamSources = "_GET"; // next version
$CompulsoryParamNams = "IdAlgState";
$SaveParamNams="IdAlgState,Nam,Descr";
try {
    // prepare params
    $Params = array(); // usefull cause from _POST
    $PostedParams_Arr = explode(",", $SaveParamNams);
    foreach ($PostedParams_Arr as $Param) {
        $Params[$Param] = isset($_POST[$Param])    ? $_POST[$Param]    : null;
    }
    if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[Nam]: ".$Params["Nam"]); }

    $Dao = new DAO();
    $Dao->CompulsoryParamNams = $CompulsoryParamNams;
    // $Dao->SaveParamNams = $SaveParamNams;
    $Result_arr = $Dao->SaveDb($Params);

    print_r(json_encode($Result_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
