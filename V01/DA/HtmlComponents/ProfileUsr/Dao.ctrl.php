<?php
namespace DA\HtmlComponents\ProfileUsr;

$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/mySqlComponents/Database.php');
include_once($BFD.'DA/mySqlComponents/ProfileUsr.php');
include_once($BFD.'DA/Logs/LogManager.php');
// include_once($BFD.'DA/FsComponents/FsManager.php');

// use DA\FsComponents\FsManager as FSM;
use DA\Logs\LogManager as LM;
use DA\mySqlComponents\Database as DB;
use DA\mySqlComponents\ProfileUsr as DAO;

class DaoCtrl
{
    // common params with deafaults;
    public string $CompulsoryParamNams = 'IdProfileUsr';
    public string $OptionalParamNams = ''; //'SearchIds';
    // public string $ParamSource = 'PSV';
    // public string $ParamSource2 = 'ASV';
    // public string $SaveParamNams = "IdProfileUsr,IdProfileUsrState,IdProfileUsrCat,Nam,Descr,fileRefProc,CatTag";

    public function __construct(string $Param = "OK")    {
        // $this->SetDefaults($Param);
    }

    public function ReadDb(array $Params)
    {
        // $ParamSource = $this->ParamSource; //"PSV";
        // $ParamSource2 = $this->ParamSource2; //"PSV";
        $CompulsoryParamNams = $this->CompulsoryParamNams; //"IdPrj";
        try {
            // get Database connection
            $Db = new DB();
            $Db = $Db->getConnection();
            // prepara Prj object
            $Dao = new DAO($Db);

            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[".$CompulsoryParamNams."]: ".$Params[$CompulsoryParamNams]); }
            if (
                isset($Params[$CompulsoryParamNams])
                && trim($Params[$CompulsoryParamNams]) != ''
            ) {
                // set params
                $Dao->{$CompulsoryParamNams} = $Params[$CompulsoryParamNams]; 
                // seleziona la lista
                $Results = $Dao->selectSingle();
                // se l'Prj esiste
                $Result_arr = array();
                if ($Results) {
                    // conta le righe
                    // $num = $Results->num_rows;
                    $Fields=mysqli_fetch_fields($Results);
                    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","num records: ".$num); }
                    while ($Row = mysqli_fetch_assoc($Results)) {
                        // $Result_arr[] = $Row;
                        $Data = array();
                        // set Data: all fields
                        foreach ($Fields as $Field) {
                            $Data[$Field-> name] = $Row[$Field-> name];
                        }
                    }
                    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Data[Nam]: ".$Data["Nam"]); }
                    $Result_arr = array(
                        "State" => true,
                        "Msg" => "Ok !",
                        "Data" => $Data
                    );
                } else {
                    $Result_arr = array(
                        "State" => false,
                        "Msg" => "No result !"
                    );
                }
            } else {
                $Result_arr = array(
                    "State" => false,
                    "Msg" => $CompulsoryParamNams." is incorrect !"
                );
                LM::LogMessage("WARNING", $Result_arr["Msg"]);
            }
            // if($_SESSION["Debug"]>=3){ LM::LogMessage("DEBUG","json_encode(Result_arr): ".json_encode($Result_arr)); }

            return $Result_arr;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function DeleteDb(array $Params)
    {
        $CompulsoryParamNams = $this->CompulsoryParamNams; //"IdProfileUsr";
        try {
            // get Database connection
            $Db = new DB();
            $Db = $Db->getConnection();

            // prepare objs
            $Dao = new DAO($Db);
            // se l'Prj esiste
            if (
                isset($Params[$CompulsoryParamNams])
                && trim($Params[$CompulsoryParamNams]) != ''
            ) {
                $Dao->{$CompulsoryParamNams} = $Params[$CompulsoryParamNams]; 
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[".$CompulsoryParamNams."]: ".$Params[$CompulsoryParamNams]); }
                // delete 
                if ($Dao->delete()) {
                    $Result_arr = array(
                        "State" => true,
                        "Msg" => "Deleted !",
                        $CompulsoryParamNams => $Dao->{$CompulsoryParamNams} //,
                    );
                } else {
                    $Result_arr = array(
                        "State" => false,
                        "Msg" => "Not deleted !"
                    );
                }
            } else {
                $Result_arr = array(
                    "State" => false,
                    "Msg" => $CompulsoryParamNams." is incorrect !"
                );
                LM::LogMessage("WARNING", $Result_arr["Msg"]);
            }

            return $Result_arr;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function SaveDb(array $Params)
    {
        $CompulsoryParamNams = $this->CompulsoryParamNams; //"IdAn";
        // $SaveParamNams = $this->SaveParamNams; //"IdAn,IdPrj,IdAlg,IdAnState,Nam,Descr,Dttm";

        try {
            // get Database connection
            $Db = new DB();
            $Db = $Db->getConnection();

            // prepare objects
            $Dao = new DAO($Db);
            // $Fsm = new FSM();

            // set Params all params
            foreach($Params as $Param => $value){
                $Dao->{$Param} = $Params[$Param];
            }
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[IdUsr]: ".$Params["IdUsr"]); }
            // inizio transazione
            $Db->begin_transaction();
            $TransactionState=false;
            // se l'Prj esiste
            if (
                isset($Params[$CompulsoryParamNams])
                && trim($Params[$CompulsoryParamNams]) != ''
            ) {
                // update the Prj
                if ($Dao->update()) {
                    $TransactionState=true;
                }
            } else {
                // crea  An
                if ($Dao->insert()) {
                    $TransactionState=true;
                } 
            }

            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","TransactionState: ".$TransactionState); }
            if($TransactionState){
                $Db->commit();
                $Result_arr = array(
                    "State" => true,
                    "Msg" => "Executed !",
                    $CompulsoryParamNams => $Dao->{$CompulsoryParamNams}
                );
            }else{
                $Db->rollback();
                $Result_arr = array(
                    "State" => false,
                    "Msg" => "Not executed !"
                );
            }

            return $Result_arr;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function TlistDb(array $Params)
    {
        $CompulsoryParamNams = $this->CompulsoryParamNams; //"SearchIds";
        // $CompulsoryParamNams = $this->CompulsoryParamNams; //"SearchIds";
        try {
            // get Database connection
            $Db = new DB();
            $Db = $Db->getConnection();
            // prepara Prj object
            $Dao = new DAO($Db);

            $num = 0;
            // if params
            // if (
            //     isset($Params[$OptionalParamNams])
            //     && trim($Params[$OptionalParamNams]) != ''
            // ) {
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[".$OptionalParamNams."]: ".$Params[$OptionalParamNams]); }
                // set Params all params
                foreach($Params as $Param => $value){
                    $Dao->{$Param} = $Params[$Param];
                }
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[".$CompulsoryParamNams."]: ".$Params[$CompulsoryParamNams]); }
                // seleziona la lista
                if($Dao->{$CompulsoryParamNams} == ""){
                    // $Results = $Dao->selectAllProfile();
                    $Results = $Dao->selectAllProfileUsr();
                }else{
                    $Results = $Dao->selectSearchIds();
                }
                // if result exists
                $Result_arr = array();
                if ($Results) {
                    // conta le righe
                    $num = $Results->num_rows;
                    while($Row = mysqli_fetch_assoc($Results)) {
                        $Result_arr[] = $Row;
                    }
                } else {
                    $Result_arr = array(
                        "State" => false,
                        "Msg" => "No result !"
                    );
                }
            // } else {
            //     $Result_arr = array(
            //         "State" => false,
            //         "Msg" => $CompulsoryParamNams." is incorrect !"
            //     );
            //     LM::LogMessage("WARNING", $Result_arr["Msg"]);
            // }
            $Result_arr=array(
                "draw" => "1", 
                "recordsTotal"=> $num,
                "recordsFiltered"=> $num,
                "data"=> $Result_arr
            );

            return $Result_arr;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

}