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

    /** DEPRECATED
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
    /**
     * $SrvOpParamsArrNam: ex. SrvOpParams
     * ********************
     * $Params: {
     *  SrvOpParams = { array of Server Operation Params
     *      SrvOpNam: es.'Read'
     *      $FE; string // Fundamental Entity
     *      $FEFs; CS string// Fundamental Entity Fields
     *      $VM; JSON string// Values Matrix 
     *      $FM; JSON string// Filters Matrix (only Ids in this version)
     * },
     *  "data": array specific by entity and operation,
     */

    public function opCtrl(array $Params)
    {
        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - call."); }
        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Params: ".json_encode($Params)); }
        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->SrvOpParamsArrNam: ".$_SESSION["SrvOpParamsArrNam"]); }
        try {
            // if params 
            $Result_arr=NULL;
            if(isset($Params[$_SESSION["SrvOpParamsArrNam"]])){
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Params[this->SrvOpParamsArrNam]: ".json_encode($Params[$_SESSION["SrvOpParamsArrNam"]])); }
                $P=$Params[$_SESSION["SrvOpParamsArrNam"]];
                if(isset($P[$_SESSION["SrvOpParamNam"]])){
                    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - P[this->SrvOpParamNam]: ".$P[$_SESSION["SrvOpParamNam"]]); }
                    $SrvOpParamNam=$P[$_SESSION["SrvOpParamNam"]];
                    if(
                        // check allowed SrvOpParamNam
                        str_contains($_SESSION["SrvOpNams"], $SrvOpParamNam)
                        // && isset($P['data']) // could be NULL or empty
                    ){
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->SrvOpNams: ".$_SESSION["SrvOpNams"]); }
                        // $evalString='$Result_arr=$this->'.$SrvOpParamNam.'Proxy($Params["RequestParams"]);';
                        // GENERALIZED step 1
                        // $evalString='$Result_arr=$this->'.$SrvOpParamNam.'Proxy($Params);';
                        // eval($evalString);
                        // GENERALIZED step 2
                        $Dao = new DAO();
                        $Result_arr=$Dao->opCtrl($Params);
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

        // DEPRECATED code
    //     public function TlistProxy(array $Params)
    // {
    //     try {
    //         $Dao = new DAO();
    //         $Result_arr = $Dao->TlistDb($Params); // could be eval on SrvOp
        
    //         // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - json_encode(Result_arr): ".json_encode($Result_arr)); }
    //         return $Result_arr;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

        // DEPRECATED code
    //     public function ReadProxy(array $Params)
    // {
    //     try {
    //         // prepare params
    //         // if (
    //         //     isset($Params['CompulsoryParamNams'])
    //         //     && trim($Params['CompulsoryParamNams']) != ''
    //         // ) {
    //             // $ParamNams_Arr = explode(",", $Params['CompulsoryParamNams']);
    //             // if($this->checkParams($ParamNams_Arr,$Params)){
    //                 $Dao = new DAO();
    //                 // $Dao->CompulsoryParamNams = $Params['CompulsoryParamNams'];
    //                 // $P=$Params[$_SESSION["SrvOpParamsArrNam"]];
    //                 // // set Params all params
    //                 // foreach($P as $Param => $value){
    //                 //     $Dao->{$Param} = $Params[$Param];
    //                 // }
        
    //                 //  $FE; string // Fundamental Entity
    //                 //  $FEFs; CS string// Fundamental Entity Fields
    //                 //  $VM; JSON string// Values Matrix 
    //                 //  $FM; JSON string// Filters Matrix (only Ids in this version)
               
    //                 // $Result_arr = $Dao->ReadDb($Params);
    //                 $evalString='$Result_arr=$Dao->'.$SrvOpParamNam.'Db($Params);';
    //                 // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - evalString: ".$evalString); }

    //                 eval($evalString);

    //             // } else {
    //             //     $Result_arr = FRA("CompulsoryParamNams is incorrect !");
    //             // }
    //         // }else{
    //         //     $Result_arr = FRA("CompulsoryParamNams is incorrect !");
    //         // }
        
    //         return $Result_arr;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

        // DEPRECATED code
    // public function SaveProxy(string $CompulsoryParamNams,array $Params)
    // {
    //     try {
    //         // prepare params
    //         $Params = array(); // usefull cause from Post arr
    //         $PostedParams_Arr = explode(",", $Params['SaveParamNams'] );
    //         foreach ($PostedParams_Arr as $Param) {
    //             $Params[$Param] = isset($Params[$Param])    ? $Params[$Param]    : null;
    //         }
    //         // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[IdFeature]: ".$Params["IdFeature"]); }
    //         // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[IdAuthLevel]: ".$Params["IdAuthLevel"]); }
        
    //         $Dao = new DAO();
    //         $Dao->CompulsoryParamNams = $Params['CompulsoryParamNams'];
    //         // $Dao->SaveParamNams = $SaveParamNams;
    //         $Result_arr = $Dao->SaveDb($Params);
        
    //         return $Result_arr;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

        // DEPRECATED code
    // public function DeleteProxy(array $Params)
    // {
    //     try {
    //         // prepare params
    //         $ParamNams_Arr = explode(",", $Params['CompulsoryParamNams']);
    //         if($this->checkParams($ParamNams_Arr,$Params)){
    //             $Params_arr = array(
    //                 $CompulsoryParamNams => $Params[$Params['CompulsoryParamNams']] //,
    //             );
        
    //             $Dao = new DAO();
    //             $Dao->CompulsoryParamNams = $CompulsoryParamNams;
    //             $Result_arr = $Dao->DeleteDb($Params_arr);
    //         } else {
    //             $Result_arr = FRA("CompulsoryParamNams is incorrect !");
    //         }
        
    //         return $Result_arr;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    // public function checkParams(array $ParamNams,array $Params)
    // {
    //     try {
    //         $Result=true;
    //         foreach($ParamNams as $ParamNam){
    //             if (
    //                 !(
    //                     isset($Params[$ParamNam])
    //                     // && trim($Params[$Param]) != ''
    //                 )
    //             ) {
    //                 $Result=false;
    //                 break;
    //             }
    //         }
    //         return $Result;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    // ???
    // public function setParams(string $ParamNams, array $Params, object $Dao)
    // {
    //     try {
    //         $Result=true;
    //         // if params 

    //         if(trim($ParamNams) != ''
    //             && isset($ParamNams)
    //             && isset($Params)
    //         ){
    //             $ParamNams_Arr = explode(",", $ParamNams);
    //             foreach($ParamNams_Arr as $ParamNam => $value){
    //                 // if param is correct
    //                 if (
    //                     isset($Params[$ParamNam])
    //                     // && trim($Params[$ParamNam]) != ''
    //                 ) {
    //                     $Dao->{$ParamNam} = $Params[$ParamNam]; 
    //                 } else {
    //                     $Result=false;
    //                     $Msg=$ParamNam." is incorrect !";
    //                     LM::LogMessage("WARNING", $Msg);
    //                     break;
    //                 }
    //             }
    //         }

    //         return $Result;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    }

}