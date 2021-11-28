<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/HtmlComponents/ProfileUsr/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\ProfileUsr\DaoCtrl as DAO;

// $CompulsoryParamSources = "_GET"; // next version
$CompulsoryParamNams = "IdProfileUsr";
try {
    // prepare params
    if (
        isset($_GET[$CompulsoryParamNams])
        && trim($_GET[$CompulsoryParamNams]) != ''
    ) {
        $Params_arr = array(
            $CompulsoryParamNams => $_GET[$CompulsoryParamNams] //,
        );
        $Dao = new DAO();
        $Dao->CompulsoryParamNams = $CompulsoryParamNams;
        $Result_arr = $Dao->ReadDb($Params_arr);
    } else {
        $Result_arr = array(
            "State" => false,
            "Msg" => $CompulsoryParamNams." is incorrect !"
        );
        LM::LogMessage("WARNING", $Result_arr["Msg"]);
    }

    print_r(json_encode($Result_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
