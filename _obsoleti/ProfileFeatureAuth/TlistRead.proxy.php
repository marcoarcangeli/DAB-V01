<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/HtmlComponents/ProfileFeatureAuth/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\ProfileFeatureAuth\DaoCtrl as DAO;

// $CompulsoryParamSources = "_GET"; // next version
$ParamNams = "SearchIds,IdProfile,IdFeature,IdAuthLevel";
$CompulsoryParamNams = "SearchIds"; // could be =''
// service functions

try {
    if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","call TlistRead."); }
    // prepare params
    $Params = array(); // usefull cause from _POST
    $PostedParams_Arr = explode(",", $ParamNams);
    foreach ($PostedParams_Arr as $Param) {
        $Params[$Param] = isset($_GET[$Param])    ? $_GET[$Param]    : null;
    }
    if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","TlistRead Params[".$Param."]: ".$Params[$Param]); }

    $Dao = new DAO();
    $Dao->CompulsoryParamNams = $CompulsoryParamNams;
    $Dao->ParamNams = $ParamNams;
    $Result_arr = $Dao->TlistReadDb($Params);

    if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","TlistRead json_encode(Result_arr): ".json_encode($Result_arr)); }
    print_r(json_encode($Result_arr));
} catch (Exception $e) {
    return false;
}
