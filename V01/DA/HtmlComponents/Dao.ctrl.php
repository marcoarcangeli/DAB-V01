<?php
namespace DA\HtmlComponents;

$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/mySqlComponents/Database.php');
include_once($BFD.'DA/Logs/LogManager.php');
// include_once($BFD.'DA/FsComponents/FsManager.php');

// use DA\FsComponents\FsManager as FSM;
use DA\Logs\LogManager as LM;
use DA\mySqlComponents\Database as DB;
use function DA\Common\emptyOrNull as EN;
use function DA\Common\verifyEmptyOrNullArr as VENA;
use function DA\Common\failResultArr as FRA;
use function DA\Common\successResultArr as SRA;
use \ReflectionMethod as RM;

// MUST BE PARAMETERIZED
// include_once($BFD.'DA/mySqlComponents/ProfileFeatureAuth.php');
include_once($BFD.'DA/mySqlComponents/Dao.php');
// use DA\mySqlComponents\ProfileFeatureAuth as DAO;
use DA\mySqlComponents\Dao as DAO;

class DaoCtrl
{
    // public $DAOClass= $_SESSION["DaoRdbClass"];
    // generalized params into $Params array
    // public $FE; // Fundamental Entity
    // public $FEFs; // Fundamental Entity Fields
    // public $VM; // Values Matrix 
    // public $FM; // Filters Matrix (only Ids in this version)

    // common params with deafaults;
    // public string $CompulsoryParamNams = 'IdProfileFeatureAuth';
    // public string $OptionalParamNams = ''; //'SearchIds';
    // // public string $ParamSource = 'PSV';
    // // public string $ParamSource2 = 'ASV';
    // // public string $SaveParamNams = "IdProfileFeatureAuth,IdProfileFeatureAuthState,IdProfileFeatureAuthCat,Nam,Descr,fileRefProc,CatTag";

    public function __construct(string $Param = "OK")    {
        // $this->SetDefaults($Param);
    }
    // Request manager (usually JS-AJAX Client) builds the FM array
    // $Results = $Dao->selectSearchIds();          >> $FM = json_encode(array("filterValues" => SearchIds));
    // $Results = $Dao->selectAllFeatureProfile();  >> $FM = json_encode(array("filterValues" => SearchIds));
    // $Results = $Dao->selectSingle();             >> $FM = json_encode(array("filterValues" => Id[FE]));
    
    // $Results = $Dao->selectProfile();            >> $FM = json_encode(array("filterValues" => IdProfile,"filterType" => NoN));
    // $Results = $Dao->selectProfileFeatureAuth(); >> $FM = json_encode(array("filterValues" => IdProfile,IdFeature,IdAuthLevel,"filterType" => AoN));
    // $Results = $Dao->selectAllFeatureProfile();  >> $FM = json_encode(array("filterValues" => IdProfile,"filterType" => NoN));

    // public function ReadDb(array $Params)
    public function SrvOpDb(array $Params)
    {
        $Result_arr = array();
        if (isset($Params[$_SESSION["SrvOpParamsArrNam"]])) {
            $P=$Params[$_SESSION["SrvOpParamsArrNam"]];
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - SrvOpParamsArr: ".json_encode($P)); }
            if(!EN($SrvOpNam=$P["SrvOpNam"])){  // Necessary . ex.'Read,Save,Delete, ...'
                // check necessary params from Dao method
                if(!EN($SrvOpParams=$this->getSrvOpParams($_SESSION["DaoRdbClass"], $SrvOpNam))){
                    if(!EN($SrvOpCompulsoryParams=$this->getSrvOpCompulsoryParams($SrvOpParams))){
                        if(!$this->checkParams($SrvOpCompulsoryParams,$P)){
                            // $Result_arr = FRA("Compulsory params (".$SrvOpCompulsoryParams.") are not set correctly !");
                            return FRA("Compulsory params (".$SrvOpCompulsoryParams.") are not set correctly !");
                        } // else the params are correct
                    } // else could be that there is no Compulsory param
                    if($Dao = new DAO('Ok')){   // ? could be passed the type of Dao: RDB, FS, Service
                        // if get result from query execution
                        $Results=null;
                        $evalString='$Results = $Dao->'.$SrvOpNam.'('.$this->getParamsPHP($SrvOpParams).');';
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - evalString: ".$evalString); }
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - P[FE]: ".$P['FE']); }
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - P[FEFs]: ".$P['FEFs']); }
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - P[DEs]: ".$P["DEs" ]); }
                        if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - P[DEFs]: ".$P["DEFs"]); }
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - P[EFs]: ".$P["EFs" ]); }
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - P[FM]: ".$P["FM" ]); }
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - P[VM]: ".$P["VM" ]); }
                        eval($evalString);
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Result_arr: ".json_encode($Result_arr)); }
                        if ($Results) {
                            switch($SrvOpNam){
                                case 'Read':
                                case 'Tlist':
                                    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - SrvOpNam: ".$SrvOpNam); }
                                    $Result_arr = SRA($Results->fetch_all(MYSQLI_ASSOC));
                                    break;
                                case 'Delete':
                                case 'Save':
                                    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - SrvOpNam: ".$SrvOpNam); }
                                    $Result_arr = SRA([],$SrvOpNam.' Executed!',$Dao->FirstId,$Dao->AffectedRows);
                                    break;
                                default:
                                    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - SrvOpNam: ".$SrvOpNam); }
                                    $Result_arr = FRA("SrvOpNam ('.$SrvOpNam.') is not correct!");
                                    break;
                            }

                        } else {
                            $Result_arr = FRA("No result!");
                        }
                    }else {
                        $Result_arr = FRA("Dao is not set!");
                    }
                } // else could be that there are no params
                //     $Result_arr = FRA("SrvOpParams are not set!");
                // }
            } else {
                $Result_arr = FRA("SrvOpNam is not set!");
            }
        } else {
            $Result_arr = FRA($_SESSION["SrvOpParamsArrNam"]." array is not set!");
        }
        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - SrvOpNam: ".json_encode($Result_arr)); }
        return $Result_arr;
    }

    // utility funcs
    public function getSrvOpParams(string $SrvClass,string $SrvOp)    {
        try {
            // ex: SrvClass     : DA\MySqlComponents\Dao
            //     SrvOp        : Tlist
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - SrvClass: ".$SrvClass); }
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - SrvOp: ".$SrvOp); }
            $f = new RM($SrvClass,$SrvOp);
            $argNams = implode(',',
                array_map( 
                function($v) { 
                    $compulsory=($v->isDefaultValueAvailable())? $_SESSION["CompulsoryPostfix"] : '';
                    return $v->getName().$compulsory; 
                }, 
                $f->getParameters()
                )
            );
            return $argNams;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    
    
    public function getSrvOpCompulsoryParams(string $SrvOpParams)    {
        try {
            $CompulsorySrvOpParamsArr = implode(',',
                array_filter( 
                    explode(',', $SrvOpParams), 
                    function( $v ) { 
                        return substr($v, -1) != $_SESSION["CompulsoryPostfix"]; 
                    } 
                )
            );
            return $CompulsorySrvOpParamsArr;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    
    public function getParamsPHP(string $SrvOpParams)    {
        try {
            $ParamsPHP = implode(',',
                array_map( 
                function($v) { 
                    // return '$'.$v; 
                    return '$P["'.$v.'"]'; 
                }, 
                explode(',',$SrvOpParams)
                )
            );
            $ParamsPHP = str_replace($_SESSION["CompulsoryPostfix"],'',$ParamsPHP); // eliminate Compulsory postfix chars
            return $ParamsPHP; 
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    
    public function checkParams(string $ParamNams,array $Params)
    {
        try {
            $Result=true;
            $ParamNams_Arr=explode(',',$ParamNams);
            foreach($ParamNams_Arr as $ParamNam){
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
}