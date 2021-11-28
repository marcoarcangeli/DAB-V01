<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/HtmlComponents/An/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\An\DaoCtrl as DAO;

// $CompulsoryParamSources = "_SESSION"; // next version
$CompulsoryParamSources = 'PSV';
$CompulsoryParamNams = "IdPrj";
try {
    // prepare params
    if (
        isset($_SESSION[$CompulsoryParamSources][$CompulsoryParamNams])
        && trim($_SESSION[$CompulsoryParamSources][$CompulsoryParamNams]) != ''
    ) {
        $Params_arr = array(
            $CompulsoryParamNams => $_SESSION[$CompulsoryParamSources][$CompulsoryParamNams] //,
        );
        $Dao = new DAO();
        $Dao->CompulsoryParamNams = $CompulsoryParamNams;
        $Result_arr = $Dao->TlistDb($Params_arr);
    } else {
        $Result_arr = array(
            "State" => false,
            "Msg" => $CompulsoryParamNams." is incorrect !"
        );
        LM::LogMessage("WARNING", $Result_arr["Msg"]);
    }

    if($_SESSION["Debug"]>=3){ LM::LogMessage("DEBUG","json_encode(Result_arr): ".json_encode($Result_arr)); }
    print_r(json_encode($Result_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
