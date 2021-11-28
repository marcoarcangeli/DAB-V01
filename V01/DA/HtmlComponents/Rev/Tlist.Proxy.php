<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// include Database Revd object files 
include_once($BFD.'DA/HtmlComponents/Rev/Dao.ctrl.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\Rev\DaoCtrl as DAO;

// $CompulsoryParamSources = "_SESSION["PSV"]"; // next version
$CompulsoryParamNams = "IdPrj";
$OptionalParamNams = "";
try {
    $Dao = new DAO();
    // prepare params
    $Params_arr = array();
    // optional params
    if (
        isset($_GET[$OptionalParamNams])
        // && trim($_GET[$OptionalParamNams]) != ''
    ) {
        if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","_GET[".$OptionalParamNams."]: ".$_GET[$OptionalParamNams]); }
        $Params_arr[$OptionalParamNams] = $_GET[$OptionalParamNams];
    } else {
        $Params_arr[$OptionalParamNams] = "";
    } 
    $Dao->OptionalParamNams = $OptionalParamNams;

    // compulsory params
    if (
        isset($_SESSION["PSV"][$CompulsoryParamNams])
        && trim($_SESSION["PSV"][$CompulsoryParamNams]) != ''
        // && trim($_GET[$CompulsoryParamNams]) != '__none'
    ) {
        $Params_arr[$CompulsoryParamNams] => $_SESSION["PSV"][$CompulsoryParamNams];
        if($_SESSION["Debug"] == -1){ LM::LogMessage("DEBUG","Params_arr[".$CompulsoryParamNams."]: ".$Params_arr[$CompulsoryParamNams]); }
        $Dao->CompulsoryParamNams = $CompulsoryParamNams;
        $Result_arr = $Dao->TlistDb($Params_arr);
    } else {
        $Result_arr = array(
            "State" => false,
            "Msg" => $CompulsoryParamNams." is incorrect !"
        );
        LM::LogMessage("WARNING", $Result_arr["Msg"]);
    }

    if($_SESSION["Debug"]>=3){ LM::LogMessage("DEBUG","json_encode(Result_arr): ".json_encode($Result_arr)); }
    print_r(json_encode($Result_arr));
    // get Database connection
    $Db = new DB();
    $Db = $Db->getConnection();
    // throw new exception("Connection DB.\n");

    // prepara Rev object
    $Rev = new Rev($Db);

    $Rev->IdPrj = $_SESSION["PSV"]['IdPrj'];
// seleziona la lista
    $Results = $Rev->selectPrj();

    //throw new exception("Dati post.\n");

    // se l'Rev esiste
        // json encode lista Rev
        $num = 0;
        $Rev_arr = array();
        if ($Results) {
            // conta le righe
            $num = $Results->num_rows;
            while($Row = mysqli_fetch_assoc($Results)) {
                $Rev_arr[] = $Row;
            }
        
        } else {
            $Rev_arr = array(
                "State" => false,
                "Msg" => "No result !"
            );
        
        }

        $return_arr=array(
            "draw" => "1", 
            "recordsTotal"=> $num,
            "recordsFiltered"=> $num,
            "data"=> $Rev_arr
        );

    print_r(json_encode($return_arr));

} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}