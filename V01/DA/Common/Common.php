<?php

namespace DA\Common;

use DA\Logs\LogManager as LM;
use function DA\Common\emptyOrNull as EN;

// includi componenti utili
// include_once('DA\HtmlComponents\card.php');

function verifyNulls($value)
{
    try {
        $value = ($value != '') ? "'" . $value . "'" : "NULL";
        return $value;
    } catch (Exception $e) {
        LM::LogMessage("ERROR", $e);
        return false;
    }

}

function verifyEmptyOrNullArr(array $ValuesArr)
{
    try {
        foreach($ValuesArr as $ValueArr => $value){
            if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - RequestParams[ValueArr]: ".$RequestParams[$ValueArr]); }
            if(EN($RequestParams[$ValueArr])){
                return false;
            }
        }
        return true;
    } catch (Exception $e) {
        LM::LogMessage("ERROR", $e);
        return false;
    }

}

function emptyOrNull($Obj=NULL)
{
    // model: ERROR [2021-05-24 23:08:56] Error: You have an error in your SQL syntax; 
    try {
        return (!isset($Obj) || trim($Obj)==="");
    } catch (Exception $e) {
        LM::LogMessage("ERROR", $e);
        return false;
    }
}

// MESSAGES
function failResultArr(string $Msg)
{
    try {
        $Result_arr = array(
            "State" => false,
            "Msg" => $Msg
        );
        LM::LogMessage("WARNING", $Msg);

        return $Result_arr;
    } catch (Exception $e) {
        LM::LogMessage("ERROR", $e);
        return false;
    }
}
