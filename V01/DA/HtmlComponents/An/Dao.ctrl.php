<?php
namespace DA\HtmlComponents\An;

$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/mySqlComponents/Database.php');
include_once($BFD.'DA/mySqlComponents/An.php');
include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/FsComponents/FsManager.php');

use DA\FsComponents\FsManager as FSM;
use DA\Logs\LogManager as LM;
use DA\mySqlComponents\Database as DB;
use DA\mySqlComponents\An as DAO;

class DaoCtrl
{
    // common params with deafaults;
    public string $CompulsoryParamNams = 'IdAn';
    public string $ParamSource = 'PSV';
    public string $ParamSource2 = 'ASV';
    // public string $ParamNams = "IdAn,IdPrj,IdAlg,IdAnState,Nam,Descr,Dttm";

    public function __construct(string $Param = "OK")    {
        // $this->SetDefaults($Param);
    }

    public function ReadDb(array $Params)
    {
        $ParamSource = $this->ParamSource; //"PSV";
        $ParamSource2 = $this->ParamSource2; //"PSV";
        $CompulsoryParamNams = $this->CompulsoryParamNams; //"IdPrj";
        try {
            // get Database connection
            $Db = new DB();
            $Db = $Db->getConnection();
            // prepara Prj object
            $Dao = new DAO($Db);

            if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[".$CompulsoryParamNams."]: ".$Params[$CompulsoryParamNams]); }
            if (
                isset($Params[$CompulsoryParamNams])
                && trim($Params[$CompulsoryParamNams]) != ''
            ) {
                // set params
                $Dao->{$CompulsoryParamNams} = $Params[$CompulsoryParamNams]; 
                // seleziona la lista
                $Results = $Dao->AnStateCalcSingle();
                // se l'Prj esiste
                $Result_arr = array();
                if ($Results) {
                    // conta le righe
                    // $num = $Results->num_rows;
                    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","num records: ".$num); }
                    while ($Row = mysqli_fetch_assoc($Results)) {
                        // $Result_arr[] = $Row;
                        $Data = array(
                            "IdAn"              => $Row['IdAn'],
                            "IdPrj"             => $Row['IdPrj'],
                            "PrjNam"            => $Row['PrjNam'],
                            "IdAlg"             => $Row['IdAlg'],
                            "AlgNam"            => $Row['AlgNam'],
                            "IdAnState"         => $Row['IdAnState'],
                            "AnStateNam"        => $Row['AnStateNam'],
                            "Nam"               => $Row['Nam'],
                            "Descr"             => $Row['Descr'],
                            "Dttm"              => $Row['Dttm'],
                            "IdAnCntx"          => $Row['IdAnCntx'],
                            "IdTrain"           => $Row['IdTrain'],
                            "IdTest"            => $Row['IdTest'],
                            "IdCompare"         => $Row['IdCompare'],
                            "IdRev"             => $Row['IdRev'],
                            "IdAnStateCalc"     => $Row['IdAnStateCalc'],
                            "AnCntxFolderNam"   => $_SESSION["AnCntxFolderPrfx"]    . $Row['IdAnCntx'],
                            "TrainFolderNam"    => $_SESSION["TrainFolderPrfx"]     . $Row['IdTrain'],
                            "TestFolderNam"     => $_SESSION["TestFolderPrfx"]      . $Row['IdTest'],
                            "CompareFolderNam"  => $_SESSION["CompareFolderPrfx"]   . $Row['IdCompare'],
                            "RevFolderNam"      => $_SESSION["RevFolderPrfx"]       . $Row['IdRev']
                        );
                    }
                    if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Row['AlgNam']: ".$Data['AlgNam']); }
                    $Result_arr = array(
                        "State" => true,
                        "Msg" => "Ok !",
                        "Data" => $Data
                    );

                    /* SET THE PSV SESSION VARIABLE */
                    $_SESSION[$ParamSource][$CompulsoryParamNams]=$Data[$CompulsoryParamNams];
                    $_SESSION[$ParamSource]["AnFolderNam"]=$_SESSION["AnFolderPrfx"].$Data[$CompulsoryParamNams];

                    /* SET THE ASV SESSION VARIABLE */
                    $_SESSION[$ParamSource2]=$Data;
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
            if($_SESSION["Debug"]>=3){ LM::LogMessage("DEBUG","json_encode(Result_arr): ".json_encode($Result_arr)); }

            return $Result_arr;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function DeleteDb(array $Params)
    {
        $CompulsoryParamNams = $this->CompulsoryParamNams; //"IdAn";
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
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[".$CompulsoryParamNams."]: ".$Params[$CompulsoryParamNams]); }
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
        // $ParamNams = $this->ParamNams; //"IdAn,IdPrj,IdAlg,IdAnState,Nam,Descr,Dttm";

        try {
            // get Database connection
            $Db = new DB();
            $Db = $Db->getConnection();

            // prepare objects
            $Dao = new DAO($Db);
            $Fsm = new FSM();

            // set Params
            foreach($Params as $Param => $value){
                $Dao->{$Param} = $Params[$Param];
            }
            if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[Nam]: ".$Params["Nam"]); }
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
                    // aggiorna FS MakeAnFolder(array $p)
                    $_SESSION["PSV"]["AnFolderNam"] = $AnFolderNam = $_SESSION["AnFolderPrfx"] . $Dao->{$CompulsoryParamNams};
                    $AnFolderPathNam = $_SESSION["PrjAbsPath"] . $_SESSION["PSV"]["PrjFolderNam"] . "/" . $AnFolderNam;

                    if($Fsm->MakeFolder($AnFolderPathNam)){
                        // throw new exception("MakeAnFolder false\n");
                        $TransactionState=true;
                    }
                } 
            }

            if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","TransactionState: ".$TransactionState); }
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
        $CompulsoryParamNams = $this->CompulsoryParamNams; //"IdPrj";
        try {
            // get Database connection
            $Db = new DB();
            $Db = $Db->getConnection();
            // prepara Prj object
            $Dao = new DAO($Db);

            $num = 0;
            // if params
            if (
                isset($Params[$CompulsoryParamNams])
                && trim($Params[$CompulsoryParamNams]) != ''
            ) {
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Params[".$CompulsoryParamNams."]: ".$Params[$CompulsoryParamNams]); }
                // set params
                $Dao->{$CompulsoryParamNams} = $Params[$CompulsoryParamNams]; 
                // seleziona la lista
                $Results = $Dao->selectPrj();
                // se l'Prj esiste
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
            } else {
                $Result_arr = array(
                    "State" => false,
                    "Msg" => $CompulsoryParamNams." is incorrect !"
                );
                LM::LogMessage("WARNING", $Result_arr["Msg"]);
            }
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
