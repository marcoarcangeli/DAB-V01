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

    // public function opCtrl(array $Params)
    // {
    //     // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - call."); }
    //     // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Params: ".json_encode($Params)); }
    //     // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->SrvOpParamsArrNam: ".$_SESSION["SrvOpParamsArrNam"]); }
    //     try {
    //         // if params 
    //         $Result_arr=NULL;
    //         if(isset($Params[$_SESSION["SrvOpParamsArrNam"]])){
    //             // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Params[this->SrvOpParamsArrNam]: ".json_encode($Params[$_SESSION["SrvOpParamsArrNam"]])); }
    //             $P=$Params[$_SESSION["SrvOpParamsArrNam"]];
    //             if(isset($P[$_SESSION["SrvOpParamNam"]])){
    //                 // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - P[this->SrvOpParamNam]: ".$P[$_SESSION["SrvOpParamNam"]]); }
    //                 $SrvOpParamNam=$P[$_SESSION["SrvOpParamNam"]];
    //                 if(
    //                     // check allowed SrvOpParamNam
    //                     str_contains($_SESSION["SrvOpNams"], $SrvOpParamNam)
    //                     // && isset($P['data']) // could be NULL or empty
    //                 ){
    //                     // GENERALIZZATION Step 1
    //                     // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->SrvOpNams: ".$_SESSION["SrvOpNams"]); }
    //                     // $evalString='$Result_arr=$this->'.$SrvOpParamNam.'Db($Params);';
    //                     // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - evalString: ".$evalString); }
    //                     // eval($evalString);
    //                     // GENERALIZZATION Step 2
    //                     $Result_arr=$this->SrvOpDb($Params);
    //                     // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Result_arr: ".json_encode($Result_arr)); }

    //                 }else{
    //                     $Result_arr = FRA($SrvOpParamNam." not allowed !");
    //                 }
    //             }else{
    //                 $Result_arr = FRA($_SESSION["SrvOpParamNam"]." not set !");
    //             }
    //         }else{
    //             $Result_arr = FRA("Params are not set !");
    //         }
    //         return $Result_arr;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

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
            if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - SrvOpParamsArr: ".json_encode($P)); }
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
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - P[DEFs]: ".$P["DEFs"]); }
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - P[EFs]: ".$P["EFs" ]); }
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - P[FM]: ".$P["FM" ]); }
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - P[VM]: ".$P["VM" ]); }
                        eval($evalString);
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Result_arr: ".json_encode($Result_arr)); }
                        if ($Results) {
                            switch($SrvOpNam){
                                case 'Read':
                                case 'Tlist':
                                    if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - SrvOpNam: ".$SrvOpNam); }
                                    $Result_arr = SRA($Results->fetch_all(MYSQLI_ASSOC));
                                    break;
                                case 'Delete':
                                case 'Save':
                                    if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - SrvOpNam: ".$SrvOpNam); }
                                    $Result_arr = SRA([],$SrvOpNam.' Executed!',$Dao->FirstId,$Dao->AffectedRows);
                                    break;
                                default:
                                    if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - SrvOpNam: ".$SrvOpNam); }
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
        if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - SrvOpNam: ".json_encode($Result_arr)); }
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

    
    // public function SelectDb(array $Params)
    // {
        // $FE; string // Fundamental Entity
        // $FEFs; CS string// Fundamental Entity Fields
        // $VM; JSON string// Values Matrix 
        // $FM; JSON string// Filters Matrix (only Ids in this version)
   
         // public function DeleteDb(array $Params)
    // {
    //     $CompulsoryParamNams = $this->CompulsoryParamNams; //"IdProfileFeatureAuth";
    //     try {
    //         // get Database connection
    //         $Db = new DB();
    //         $Db = $Db->getConnection();

    //         // prepare objs
    //         $Dao = new DAO($Db);
    //         // se l'Prj esiste
    //         if (
    //             isset($Params[$CompulsoryParamNams])
    //             && trim($Params[$CompulsoryParamNams]) != ''
    //         ) {
    //             $Dao->{$CompulsoryParamNams} = $Params[$CompulsoryParamNams]; 
    //             // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[".$CompulsoryParamNams."]: ".$Params[$CompulsoryParamNams]); }
    //             // delete 
    //             if ($Dao->delete()) {
    //                 $Result_arr = array(
    //                     "State" => true,
    //                     "Msg" => "Deleted !",
    //                     "FirstId"       => $Dao->FirstId //,
    //                     "AffectedRows"  => $Dao->AffectedRows //,
    //                 );
    //             } else {
    //                 $Result_arr = FRA("Not deleted !");
    //             }
    //         } else {
    //             $Result_arr = FRA($CompulsoryParamNams." is incorrect !");
    //         }

    //         return $Result_arr;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    // public function SaveDb(array $Params)
    // {
    //     $CompulsoryParamNams = $this->CompulsoryParamNams; //"IdAn";
    //     // $SaveParamNams = $this->SaveParamNams; //"IdAn,IdPrj,IdAlg,IdAnState,Nam,Descr,Dttm";

    //     try {
    //         // get Database connection
    //         $Db = new DB();
    //         $Db = $Db->getConnection();

    //         // prepare objects
    //         $Dao = new DAO($Db);
    //         // $Fsm = new FSM();

    //         // set Params all params
    //         foreach($Params as $Param => $value){
    //             $Dao->{$Param} = $Params[$Param];
    //         }
    //         if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG", __CLASS__."->". __FUNCTION__." - Params[Param]: ".$Params[$Param]); }
    //         // inizio transazione
    //         $Db->begin_transaction();
    //         $TransactionState=false;
    //         // se l'Prj esiste
    //         if (
    //             isset($Params[$CompulsoryParamNams])
    //             && trim($Params[$CompulsoryParamNams]) != ''
    //         ) {
    //             // update the Prj
    //             if ($Dao->save()) {
    //                 $TransactionState=true;
    //             }
    //         }
    //         // ) {
    //         //     // update the Prj
    //         //     if ($Dao->update()) {
    //         //         $TransactionState=true;
    //         //     }
    //         // } else {
    //         //     // crea  An
    //         //     if ($Dao->insert()) {
    //         //         $TransactionState=true;
    //         //     } 
    //         // }

    //         // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - TransactionState: ".$TransactionState); }
    //         if($TransactionState){
    //             $Db->commit();
    //             $Result_arr = array(
    //                 "State" => true,
    //                 "Msg" => "Executed !",
    //                 "FirstId"       => $Dao->FirstId //,
    //                 "AffectedRows"  => $Dao->AffectedRows //,
    //         );
    //         }else{
    //             $Db->rollback();
    //             $Result_arr = array(
    //                 "State" => false,
    //                 "Msg" => "Not executed !"
    //             );
    //         }

    //         return $Result_arr;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

   // DEPRECATED code
        // $ParamSource = $this->ParamSource; //"PSV";
        // $ParamSource2 = $this->ParamSource2; //"PSV";
        // $CompulsoryParamNams = $this->CompulsoryParamNams; //"IdPrj";
        // try {
        //     // get Database connection
        //     $Db = new DB();
        //     $Db = $Db->getConnection();
        //     // prepara Prj object
        //     $Dao = new DAO($Db);

        //     // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[".$CompulsoryParamNams."]: ".$Params[$CompulsoryParamNams]); }

        //     if (
        //         isset($P)
        //         // isset($Params[$CompulsoryParamNams])
        //         // && trim($Params[$CompulsoryParamNams]) != ''
        //     ) {
        //         // set params
        //         // $Dao->{$CompulsoryParamNams} = $Params[$CompulsoryParamNams]; 
        //         // set Params all params
        //         foreach($P as $Param => $value){
        //             $Dao->{$Param} = $Params[$Param];
        //         }

        //         // seleziona la lista
        //         // $Results = $Dao->selectSingle();
        //         // se l'Prj esiste
        //         $Result_arr = array();
        //         // if ($Results = $Dao->selectSingle()) {
        //         if ($Results = $Dao->select()) {
        //             $Result_arr = $Results->fetch_all(MYSQLI_ASSOC);
        //             // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Data[Nam]: ".$Data["Nam"]); }
        //             $Result_arr = array(
        //                 "State" => true,
        //                 "Msg" => "Ok !",
        //                 "Data" => $Result_arr
        //             );
        //         } else {
        //             $Result_arr = FRA("No result !");
        //         }
        //     } else {
        //         $Result_arr = FRA($CompulsoryParamNams." is incorrect !");
        //     }
        //     // if($_SESSION["Debug"]>=3){ LM::LogMessage("DEBUG","json_encode(Result_arr): ".json_encode($Result_arr)); }

        //     return $Result_arr;
        // } catch (Exception $e) {
        //     LM::LogMessage("ERROR", $e);
        //     return false;
        // }
    // }

    //[DEPRECATED: see read]
    // public function TlistDb(array $Params)
    // {
    //     // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Params: ".json_encode($Params)); }
    //     $CompulsoryParamNams = array(); //$this->CompulsoryParamNams; //"SearchIds";
    //     if(!EN($Params["SrvOpParams"]["CompulsoryParamNams"])){
    //         // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." -Params[SrvOpParams][CompulsoryParamNams]: ".$Params["SrvOpParams"]["CompulsoryParamNams"]); }
    //         $CompulsoryParamNams = explode(",",$Params["SrvOpParams"]["CompulsoryParamNams"]);
    //     }
    //     // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - CompulsoryParamNams: ".json_encode($CompulsoryParamNams)); }
    //     try {
    //         // get Database connection
    //         $Db = new DB();
    //         $Db = $Db->getConnection();
    //         // prepara Prj object
    //         $Dao = new DAO($Db);
    //         $num = 0;
    //         // if params
    //         // if (
    //         //     isset($Params[$OptionalParamNams])
    //         //     && trim($Params[$OptionalParamNams]) != ''
    //         // ) {
    //             // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[".$OptionalParamNams."]: ".$Params[$OptionalParamNams]); }
    //             // set Params all params
    //             $RequestParams=$Params["RequestParams"];
    //             foreach($RequestParams as $RequestParam => $value){
    //                 $Dao->{$RequestParam} = $RequestParams[$RequestParam];
    //                 // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." -RequestParams[Param]: ".$RequestParams[$RequestParam]); }
    //             }
    //             // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - json_encode(Params): ".json_encode($Params)); }
    //             // seleziona la lista
    //             // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." -Dao->IdProfile: ".$Dao->IdProfile); }
    //             // if($Dao->{$CompulsoryParamNams} == ""){
    //             if(VENA($CompulsoryParamNams)){
    //                 $Results = $Dao->selectProfile();
    //                 // $FM = json_encode(array("filterValues" => Id[FE]));
    //             }else{
    //                 $Results = $Dao->selectSearchIds();
    //                 // $FM = json_encode(array("filterValues" => SearchIds));
    //             }
    //             // if result exists
    //             $Result_arr = array();
    //             $num = $Results->num_rows;
    //             // if ($Results) {
    //             if ($num>0) {
    //                     // conta le righe
    //                 // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." -num: ".$num); }
    //                 while($Row = mysqli_fetch_assoc($Results)) {
    //                     $Result_arr[] = $Row;
    //                 }
    //             } else {
    //                 // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." -No result !: "); }
    //                 $Result_arr = array(
    //                     "State" => false,
    //                     "Msg" => "No result !"
    //                 );
    //             }
    //         // } else {
    //         //     $Result_arr = array(
    //         //         "State" => false,
    //         //         "Msg" => $CompulsoryParamNams." is incorrect !"
    //         //     );
    //         //     LM::LogMessage("WARNING", $Result_arr["Msg"]);
    //         // }
    //         $Result_arr=array(
    //             "draw" => "1", 
    //             "recordsTotal"=> $num,
    //             "recordsFiltered"=> $num,
    //             "data"=> $Result_arr
    //         );

    //         // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." -Result_arr: ".json_encode($Result_arr)); }
    //         return $Result_arr;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    //[DEPRECATED: see read]
    //[SUSPENDED: side effect in ids]
    // public function TlistSaveDb(array $Params)
    // {
    //     $CompulsoryParamNams = $this->CompulsoryParamNams; //"IdAn";
    //     // $SaveParamNams = $this->SaveParamNams; //"IdAn,IdPrj,IdAlg,IdAnState,Nam,Descr,Dttm";

    //     try {
    //         // get Database connection
    //         $Db = new DB();
    //         $Db = $Db->getConnection();

    //         // prepare objects
    //         $Dao = new DAO($Db);
    //         // $Fsm = new FSM();

    //         // set Params all params
    //         foreach($Params as $Param => $value){
    //             $Dao->{$Param} = $Params[$Param];
    //         }
    //         // inizio transazione
    //         $Db->begin_transaction();
    //         $TransactionState=false;
    //         // se l'Prj esiste
    //         if (
    //             isset($Params[$CompulsoryParamNams])
    //             // && trim($Params[$CompulsoryParamNams]) != ''
    //         ) {
    //             // insert multiple rows
    //             // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG", __CLASS__."->". __FUNCTION__." - json_encode(Params[".$CompulsoryParamNams."]): ".json_encode($Params[$CompulsoryParamNams])); }
  
    //             if ($Dao->insertProfile()) {
    //                 $TransactionState=true;
    //             } 
    //         }

    //         // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - TransactionState: ".$TransactionState); }
    //         if($TransactionState){
    //             $Db->commit();
    //             $Result_arr = array(
    //                 "State" => true,
    //                 "Msg" => "Executed !",
    //                 $CompulsoryParamNams => $Dao->{$CompulsoryParamNams}
    //             );
    //         }else{
    //             $Db->rollback();
    //             $Result_arr = array(
    //                 "State" => false,
    //                 "Msg" => "Not executed !"
    //             );
    //         }

    //         return $Result_arr;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    //[DEPRECATED: see read]
    //[SUSPENDED: side effect in ids]
    // public function TlistReadDb(array $Params)
    // {
    //     $CompulsoryParamNams = $this->CompulsoryParamNams; //"SearchIds";
    //     // $CompulsoryParamNams = $this->CompulsoryParamNams; //"SearchIds";
    //     try {
    //         // get Database connection
    //         $Db = new DB();
    //         $Db = $Db->getConnection();
    //         // prepara Prj object
    //         $Dao = new DAO($Db);

    //         $num = 0;
    //         // if params
    //         // if (
    //         //     isset($Params[$OptionalParamNams])
    //         //     && trim($Params[$OptionalParamNams]) != ''
    //         // ) {
    //             // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[".$OptionalParamNams."]: ".$Params[$OptionalParamNams]); }
    //             // set Params all params
    //             foreach($Params as $Param => $value){
    //                 $Dao->{$Param} = $Params[$Param];
    //             }
    //             // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Params[".$CompulsoryParamNams."]: ".$Params[$CompulsoryParamNams]); }
    //             // seleziona la lista
    //             if($Dao->{$CompulsoryParamNams} == ""){
    //                 $Results = $Dao->selectAllFeatureProfile();
    //             }else{
    //                 $Results = $Dao->selectSearchIds();
    //             }
    //             // if result exists
    //             $Result_arr = array();
    //             if ($Results) {
    //                 // conta le righe
    //                 $num = $Results->num_rows;
    //                 while($Row = mysqli_fetch_assoc($Results)) {
    //                     $Result_arr[] = $Row;
    //                 }
    //             } else {
    //                 $Result_arr = array(
    //                     "State" => false,
    //                     "Msg" => "No result !"
    //                 );
    //             }
    //         // } else {
    //         //     $Result_arr = array(
    //         //         "State" => false,
    //         //         "Msg" => $CompulsoryParamNams." is incorrect !"
    //         //     );
    //         //     LM::LogMessage("WARNING", $Result_arr["Msg"]);
    //         // }
    //         $Result_arr=array(
    //             "draw" => "1", 
    //             "recordsTotal"=> $num,
    //             "recordsFiltered"=> $num,
    //             "data"=> $Result_arr
    //         );

    //         if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","num: ".$num); }
    //         return $Result_arr;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

}