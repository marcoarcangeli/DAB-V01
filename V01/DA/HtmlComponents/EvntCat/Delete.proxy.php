<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/HtmlComponents/EvntCat/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\EvntCat\DaoCtrl as DAO;

// $CompulsoryParamSources = "_GET"; // next version
$CompulsoryParamNams = "IdEvntCat";
try {
    // prepare params
    if (
        isset($_POST[$CompulsoryParamNams])
        && trim($_POST[$CompulsoryParamNams]) != ''
    ) {
        $Params_arr = array(
            $CompulsoryParamNams => $_POST[$CompulsoryParamNams] //,
        );

        $Dao = new DAO();
        $Dao->CompulsoryParamNams = $CompulsoryParamNams;
        $Result_arr = $Dao->DeleteDb($Params_arr);
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
