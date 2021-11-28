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
        $this->SrvOpParamNam        =   $_SESSION["SrvOpParamNam"]; // es. SrvOpNam
        $this->SrvOpNams            =   $_SESSION["SrvOpNams"]; // es. Tlist,Read,Delete,Save
        $this->SrvOpParamsArrNam    =   $_SESSION["SrvOpParamsArrNam"]; // es. SrvOpParams
    }

    /**
     * $Params: {
     *  SrvOpParams = { array of Server Operation Params
     *     SrvOpNam: es.'Read'
     *     CompulsoryFields: string list of UI field names that must be set and must have a value != ''
     *     CompulsoryParamNams: string list of UI field names that must be passed for server ops,
     *     ParamNams: string list of all UI field names,
     *     SaveParamNams: string list of UI field names that must be passed for server save ops,
     * },
     *  "data": array specific by entity and operation,

     */
    public function opCtrl(array $Params)
    {
        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - call."); }
        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Params: ".json_encode($Params)); }
        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->SrvOpParamsArrNam: ".$this->SrvOpParamsArrNam); }
        try {
            // if params 
            $Result_arr=NULL;
            if(isset($Params[$this->SrvOpParamsArrNam])){
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Params[this->SrvOpParamsArrNam]: ".json_encode($Params[$this->SrvOpParamsArrNam])); }
                $P=$Params[$this->SrvOpParamsArrNam];
                if(isset($P[$this->SrvOpParamNam])){
                    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - P[this->SrvOpParamNam]: ".$P[$this->SrvOpParamNam]); }
                    $SrvOpParamNam=$P[$this->SrvOpParamNam];
                    if(
                        str_contains($this->SrvOpNams, $SrvOpParamNam)
                        // && isset($P['data']) // could be NULL or empty
                    ){
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->SrvOpNams: ".$this->SrvOpNams); }
                        // $evalString='$Result_arr=$this->'.$SrvOpParamNam.'Proxy($Params["RequestParams"]);';
                        $evalString='$Result_arr=$this->'.$SrvOpParamNam.'Proxy($Params);';
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - evalString: ".$evalString); }

                        eval($evalString);
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Result_arr: ".json_encode($Result_arr)); }

                    }else{
                        $Result_arr = FRA($SrvOpParamNam." not allowed !");
                    }
                }else{
                    $Result_arr = FRA($this->SrvOpParamNam." not set !");
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

    public function TlistProxy(array $Params)
    {
        try {
            $Dao = new DAO();
            $Result_arr = $Dao->TlistDb($Params); // could be eval on SrvOp
        
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - json_encode(Result_arr): ".json_encode($Result_arr)); }
            return $Result_arr;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function ReadProxy(array $Params)
    {
        try {
            // prepare params
            if (
                isset($Params['CompulsoryParamNams'])
                && trim($Params['CompulsoryParamNams']) != ''
            ) {
                $ParamNams_Arr = explode(",", $Params['CompulsoryParamNams']);
                if($this->checkParams($ParamNams_Arr,$Params)){
                    $Dao = new DAO();
                    $Dao->CompulsoryParamNams = $Params['CompulsoryParamNams'];
                    $Result_arr = $Dao->ReadDb($Params);
                } else {
                    $Result_arr = FRA("CompulsoryParamNams is incorrect !");
                }
            }else{
                $Result_arr = FRA("CompulsoryParamNams is incorrect !");
            }
        
            return $Result_arr;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function SaveProxy(string $CompulsoryParamNams,array $Params)
    {
        try {
            // prepare params
            $Params = array(); // usefull cause from Post arr
            $PostedParams_Arr = explode(",", $Params['SaveParamNams'] );
            foreach ($PostedParams_Arr as $Param) {
                $Params[$Param] = isset($Params[$Param])    ? $Params[$Param]    : null;
            }
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[IdFeature]: ".$Params["IdFeature"]); }
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[IdAuthLevel]: ".$Params["IdAuthLevel"]); }
        
            $Dao = new DAO();
            $Dao->CompulsoryParamNams = $Params['CompulsoryParamNams'];
            // $Dao->SaveParamNams = $SaveParamNams;
            $Result_arr = $Dao->SaveDb($Params);
        
            return $Result_arr;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function DeleteProxy(array $Params)
    {
        try {
            // prepare params
            $ParamNams_Arr = explode(",", $Params['CompulsoryParamNams']);
            if($this->checkParams($ParamNams_Arr,$Params)){
                $Params_arr = array(
                    $CompulsoryParamNams => $Params[$Params['CompulsoryParamNams']] //,
                );
        
                $Dao = new DAO();
                $Dao->CompulsoryParamNams = $CompulsoryParamNams;
                $Result_arr = $Dao->DeleteDb($Params_arr);
            } else {
                $Result_arr = FRA("CompulsoryParamNams is incorrect !");
            }
        
            return $Result_arr;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function checkParams(array $ParamNams,array $Params)
    {
        try {
            $Result=true;
            foreach($ParamNams as $ParamNam){
                if (
                    !(
                        isset($Params[$ParamNam])
                        // && trim($Params[$Param]) != ''
                    )
                ) {
                    $Result=false;
                    break;
                }
            }
            return $Result;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function setParams(string $ParamNams, array $Params, object $Dao)
    {
        try {
            $Result=true;
            // if params 

            if(trim($ParamNams) != ''
                && isset($ParamNams)
                && isset($Params)
            ){
                $ParamNams_Arr = explode(",", $ParamNams);
                foreach($ParamNams_Arr as $ParamNam => $value){
                    // if param is correct
                    if (
                        isset($Params[$ParamNam])
                        // && trim($Params[$ParamNam]) != ''
                    ) {
                        $Dao->{$ParamNam} = $Params[$ParamNam]; 
                    } else {
                        $Result=false;
                        $Msg=$ParamNam." is incorrect !";
                        LM::LogMessage("WARNING", $Msg);
                        break;
                    }
                }
            }

            return $Result;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

}