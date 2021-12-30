<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
// DAB/V01/DA/HtmlComponents/UIProxy.php
// DAB\V01\DA\HtmlComponents\UI.proxy.php
include_once($BFD.'DA/HtmlComponents/ProfileFeatureAuth/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/HtmlComponents/UIProxy.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\ProfileFeatureAuth\DaoCtrl as DAO;
use DA\HtmlComponents\ProfileFeatureAuth\UIProxy as UIP;

// $CompulsoryParamSources = "_GET"; // next version
$ParamNams = "SearchIds,IdProfile,IdFeature,IdAuthLevel";
$CompulsoryParamNams = "SearchIds"; // could be =''

// 3
$UIP = new UIP();
// if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","json_encode(_POST): ".json_encode($_POST)); }
print_r(json_encode($UIP->TlistProxy($ParamNams,$CompulsoryParamNams,$_POST)));

