<?php

namespace DA\HtmlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

// include Database and object files 
include_once($BFD.'DA/HtmlComponents/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\DaoCtrl as DAO;
use function DA\Common\failResultArr as FRA;
use function DA\Common\emptyOrNull as EN;


class UIProxy
{
    // common params with deafaults; $_SESSION["SrvOpParamsArrNam"]
    public string $SrvOpParamNam;
    public string $SrvOpNams;
    public string $SrvOpParamsArrNam;
    
    public function __construct(string $Param = "OK")    {
        // ...
    }

    public function opCtrl(array $Params)
    {
        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - call."); }
        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Params: ".json_encode($Params)); }
        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->SrvOpParamsArrNam: ".$_SESSION["SrvOpParamsArrNam"]); }
        try {
            // if params 
            $Result_arr=NULL;
            if(isset($Params[$_SESSION["SrvOpParamsArrNam"]])){
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Params[this->SrvOpParamsArrNam]: ".json_encode($Params[$_SESSION["SrvOpParamsArrNam"]])); }
                $P=$Params[$_SESSION["SrvOpParamsArrNam"]];
                if(isset($P[$_SESSION["SrvOpParamNam"]])){
                    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - P[this->SrvOpParamNam]: ".$P[$_SESSION["SrvOpParamNam"]]); }
                    $SrvOpParamNam=$P[$_SESSION["SrvOpParamNam"]];
                    // check allowed SrvOpParamNam
                    if(
                        str_contains($_SESSION["SrvOpNams"], $SrvOpParamNam)
                        // && isset($P['data']) // could be NULL or empty
                    ){
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->SrvOpNams: ".$_SESSION["SrvOpNams"]); }
                        // $evalString='$Result_arr=$this->'.$SrvOpParamNam.'Proxy($Params["RequestParams"]);';
                        // GENERALIZED step 1
                        // $evalString='$Result_arr=$this->'.$SrvOpParamNam.'Proxy($Params);';
                        // eval($evalString);
                        // GENERALIZED step 2 and 3
                        $Dao = new DAO();
                        // $Result_arr=$Dao->opCtrl($Params);
                        $Result_arr=$Dao->SrvOpDb($Params);
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Result_arr: ".json_encode($Result_arr)); }
                    }else{
                        $Result_arr = FRA($SrvOpParamNam." not allowed !");
                    }
                }else{
                    $Result_arr = FRA($_SESSION["SrvOpParamNam"]." not set !");
                }
            }else{
                $Result_arr = FRA("Params are not set !");
            }
            return $Result_arr;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

}