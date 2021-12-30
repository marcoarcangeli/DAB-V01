<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
// include_once($BFD.'DA/HtmlComponents/ProfileFeatureAuth/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/HtmlComponents/UIProxy.php');

use DA\Logs\LogManager as LM;
// use DA\HtmlComponents\ProfileFeatureAuth\DaoCtrl as DAO;
use DA\HtmlComponents\UIProxy as UIP;

try {
    // POST is the standard for client-server communications
    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Call."); }

    $UIP = new UIP();
    $Result_Arr=$UIP->opCtrl($_POST);
    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - json_encode(Result_Arr): ".json_encode($Result_Arr)); }
    // print_r(json_encode($UIP->opCtrl($_POST)));
    print_r(json_encode($Result_Arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
