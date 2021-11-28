<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/HtmlComponents/ProfileFeatureAuth/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/HtmlComponents/UIProxy.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\ProfileFeatureAuth\DaoCtrl as DAO;
use DA\HtmlComponents\UIProxy as UIP;

// $CompulsoryParamSources = "_GET"; // next version
$CompulsoryParamNams = "IdProfileFeatureAuth";

$UIP = new UIP();
print_r(json_encode($UIP->DeleteProxy($CompulsoryParamNams,$_POST)));

