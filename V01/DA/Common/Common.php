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
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - RequestParams[ValueArr]: ".$RequestParams[$ValueArr]); }
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

// spaces only strongs are consodered EMPTY
function emptyOrNull($Obj=null)
{
    try {
        $isEmptyString=false;
        if(is_string($Obj)){
            $isEmptyString = trim($Obj)==="";
        }
        return (empty($Obj) || $isEmptyString);
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
            "Msg"   => $Msg
        );
        LM::LogMessage("WARNING", $Msg);

        return $Result_arr;
    } catch (Exception $e) {
        LM::LogMessage("ERROR", $e);
        return false;
    }
}
function successResultArr(array $Result_arr,string $Msg='Ok', string $FirstId='', string $AffectedRows='')
{
    try {
        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Msg: ".$Msg); }

        $Result_arr=array(
            "State"             => true,
            "Msg"               => $Msg,
            "FirstId"           => $FirstId,
            // tlist params
            "draw"              => "1", // constant for Datatables
            "recordsTotal"      => $AffectedRows,
            "recordsFiltered"   => $AffectedRows,
            "data"              => $Result_arr
        );

        // LM::LogMessage("WARNING", $Msg);

        return $Result_arr;
    } catch (Exception $e) {
        LM::LogMessage("ERROR", $e);
        return false;
    }
}

