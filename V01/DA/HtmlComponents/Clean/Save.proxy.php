<?php

session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/HtmlComponents/Clean/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\Clean\DaoCtrl as DAO;

// $CompulsoryParamSources = "_POST";  // next version: eval + multivalue
$CompulsoryParamNams = "IdClean";     // next version: multivalue
$SaveParamNams="IdClean,IdPrj,ctsd,cnsd,cusd,Note";
try {
    // prepare params
    $Params = array(); // usefull cause from _POST
    $PostedParams_Arr = explode(",", $SaveParamNams);
    foreach ($PostedParams_Arr as $Param) {
        $Params[$Param] = isset($_POST[$Param])    ? $_POST[$Param]    : null;
    }
    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[Nam]: ".$Params["Nam"]); }

    $Dao = new DAO();
    $Dao->CompulsoryParamNams = $CompulsoryParamNams;
    // $Dao->SaveParamNams = $SaveParamNams;
    $Result_arr = $Dao->SaveDb($Params);

    print_r(json_encode($Result_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
    // header("location: ../ricetta/index.php");
    // throw new exception("Exception ".$e->getCode()." Msg: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine());

}
