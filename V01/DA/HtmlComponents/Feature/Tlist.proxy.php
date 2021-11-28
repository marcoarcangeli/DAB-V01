<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/HtmlComponents/Feature/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\Feature\DaoCtrl as DAO;

// $CompulsoryParamSources = "_GET"; // next version
$CompulsoryParamNams = "";
$OptionalParamNams = "SearchIds";
try {
    $Dao = new DAO();
    // prepare params
    $Params_arr = array();
    // optional params
    if (
        isset($_GET[$OptionalParamNams])
        // && trim($_GET[$OptionalParamNams]) != ''
    ) {
        if($_SESSION["Debug"] == 0){ LM::LogMessage("DEBUG","_GET[".$OptionalParamNams."]: ".$_GET[$OptionalParamNams]); }
        $Params_arr[$OptionalParamNams] = $_GET[$OptionalParamNams];
    } else {
        $Params_arr[$OptionalParamNams] = "";
    }

    // compulsory params
    // if (
    //     isset($_GET[$CompulsoryParamNams])
    //     && trim($_GET[$CompulsoryParamNams]) != ''
    //     && trim($_GET[$CompulsoryParamNams]) != '__none'
    // ) {
        if($_SESSION["Debug"] == 0){ LM::LogMessage("DEBUG","Params_arr[".$OptionalParamNams."]: ".$Params_arr[$OptionalParamNams]); }
    //     $Params_arr[$CompulsoryParamNams] => $_GET[$CompulsoryParamNams];
        $Dao->OptionalParamNams = $OptionalParamNams;
        $Result_arr = $Dao->TlistDb($Params_arr);
    // } else {
    //     $Result_arr = array(
    //         "State" => false,
    //         "Msg" => $CompulsoryParamNams." is incorrect !"
    //     );
    //     LM::LogMessage("WARNING", $Result_arr["Msg"]);
    // }

    if($_SESSION["Debug"]>=3){ LM::LogMessage("DEBUG","json_encode(Result_arr): ".json_encode($Result_arr)); }
    print_r(json_encode($Result_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
