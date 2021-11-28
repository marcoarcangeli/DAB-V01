<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/HtmlComponents/ProfileUsr/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\ProfileUsr\DaoCtrl as DAO;

// $CompulsoryParamSources = "_GET"; // next version
$ParamNams = "SearchIds,IdProfile,IdUsr";
$CompulsoryParamNams = "SearchIds"; // could be =''
// service functions

try {
    // prepare params
    $Params = array(); // usefull cause from _POST
    $PostedParams_Arr = explode(",", $ParamNams);
    foreach ($PostedParams_Arr as $Param) {
        $Params[$Param] = isset($_GET[$Param])    ? $_GET[$Param]    : null;
    }
    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[".$Param."]: ".$Params[$Param]); }

    $Dao = new DAO();
    $Dao->CompulsoryParamNams = $CompulsoryParamNams;
    $Dao->ParamNams = $ParamNams;
    $Result_arr = $Dao->TlistDb($Params);

    print_r(json_encode($Result_arr));
} catch (Exception $e) {
    return false;
}
