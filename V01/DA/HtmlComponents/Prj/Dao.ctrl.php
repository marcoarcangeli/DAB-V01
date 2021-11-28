<?php
namespace DA\HtmlComponents\Prj;

$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
include_once($BFD.'DA/mySqlComponents/Database.php');
include_once($BFD.'DA/mySqlComponents/Prj.php');
include_once($BFD.'DA/HtmlComponents/An/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/FsComponents/FsManager.php');

use DA\FsComponents\FsManager as FSM;
use DA\Logs\LogManager as LM;
use DA\mySqlComponents\Database as DB;
use DA\mySqlComponents\Prj as DAO;
use DA\HtmlComponents\An\DaoCtrl as DAO2;

class DaoCtrl
{
    // common params with deafaults;
    public string $CompulsoryParamNams = 'IdUsr';
    // public string $CompulsoryParamNams = "IdPrj";
    public string $ParamSource = 'PSV';
    public string $ParamSource2 = 'ASV';
    public string $ParamNam2 = 'IdAn';
    // public string $ParamNams = "IdPrj,IdUsr,Nam,Descr,IdPrjState";

    public function __construct(string $Param = "OK")    {
        // $this->SetDefaults($Param);
    }

    public function ReadDb(array $Params)
    {
        $ParamSource = $this->ParamSource; //"PSV";
        $CompulsoryParamNams = $this->CompulsoryParamNams; //"IdPrj";
        $ParamNam2 = $this->ParamNam2; //"IdAn";
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
                $Results = $Dao->PrjStateCalcSingle();
                // se l'Prj esiste
                $Result_arr = array();
                if ($Results) {
                    // conta le righe
                    // $num = $Results->num_rows;
                    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","num records: ".$num); }
                    while ($Row = mysqli_fetch_assoc($Results)) {
                        // $Result_arr[] = $Row;
                        $Data = array(
                            "IdPrj"             => $Row['IdPrj'],
                            "IdUsr"             => $Row['IdUsr'],
                            "Nam"               => $Row['Nam'],
                            "Descr"             => $Row['Descr'],
                            "IdPrjState"        => $Row['IdPrjState'],
                            "PrjStateNam"       => $Row['PrjStateNam'],
                            "IdEvnt"            => $Row['IdEvnt'],
                            "FileNamRepoDat"    => pathinfo($Row['fileRefRepoDat'])['filename'],
                            "IdClean"           => $Row['IdClean'],
                            "IdCntx"            => $Row['IdCntx'],
                            "IdAn"              => $Row['IdAn'],
                            "AnNum"             => $Row['AnNum'],
                            "IdRnk"             => $Row['IdRnk'],
                            "IdPrjStateCalc"    => $Row['IdPrjStateCalc'],
                            "PrjFolderNam"      => $_SESSION["UsrFolderPrfx"]   . $Row['IdUsr']     . "_"   . $_SESSION["PrjFolderPrfx"]    . $Row['IdPrj'],
                            "EvntFolderNam"     => $_SESSION["EvntFolderPrfx"]  . $Row['IdEvnt'],
                            "CntxFolderNam"     => $_SESSION["CntxFolderPrfx"]  . $Row['IdCntx'],
                            "AnFolderNam"       => $_SESSION["AnFolderPrfx"]    . $Row['IdAn'],
                            "RnkFolderNam"      => $_SESSION["RnkFolderPrfx"]   . $Row['IdRnk']
                        );
                    }
                    $Result_arr = array(
                        "State" => true,
                        "Msg" => "Ok !",
                        "Data" => $Data
                    );

                    /* SET THE PSV SESSION VARIABLE */
                    $_SESSION[$ParamSource]=$Data;

                    if (
                        isset($Data[$ParamNam2])
                        && trim($Data[$ParamNam2]) != ''
                    ) {
                        // get ASV
                        $Params_arr = array(
                            $ParamNam2 => $Data[$ParamNam2] //,
                        );
                        $Dao2 = new DAO2();
                        $ASV_arr = $Dao2->ReadDb($Params_arr);
                        /* SET THE ASV SESSION VARIABLE */
                        $_SESSION[$this->ParamSource2]=$ASV_arr;

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
            if($_SESSION["Debug"]>=3){ LM::LogMessage("DEBUG","json_encode(Result_arr): ".json_encode($Result_arr)); }

            return $Result_arr;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function DeleteDb(array $Params)
    {
        $CompulsoryParamNams = $this->CompulsoryParamNams; //"IdPrj";
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
        $CompulsoryParamNams = $this->CompulsoryParamNams; //"IdPrj";
        // $ParamNams = $this->ParamNams; //"IdPrj,IdUsr,Nam,Descr,IdPrjState";

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
                // crea  Prj
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Insert."); }
                if ($Dao->insert()) {
                    $_SESSION["PSV"]["PrjFolderNam"] = $PrjFolderNam = $_SESSION["UsrFolderPrfx"] . $_SESSION["IdUsr"] . "_" . $_SESSION["PrjFolderPrfx"] . $Dao->{$CompulsoryParamNams};
                    if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","_SESSION[PSV][PrjFolderNam]: ".$_SESSION["PSV"]["PrjFolderNam"]); }
                    $FolderPathNam = $_SESSION["PrjAbsPath"] . $PrjFolderNam; //PrjNam;
                    if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","FolderPathNam: ".$FolderPathNam); }

                    if($Fsm->MakeFolder($FolderPathNam)){
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
        $CompulsoryParamNams = $this->CompulsoryParamNams; //"IdUsr";
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
                $Results = $Dao->selectUsrAll();
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
