<?php
// namespace DA\FsComponents;
// use DA\FsComponents;
include_once('../Logs/LogManager.php');
include_once('../FsComponents/CSVToFromJSON.php');

// $CSVJ=new CSVJ();
// csv to json C:\xampp\htdocs\PHPTemplate\PHPTemplatesAndTests\dati

// $FilePath      = '/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/';
// $FileNam      = 'ability.cov.csv';
// $Delimiter     = ';';

// $PathFileNam =  $FilePath . $FileNam;

// $Encoded = CsvToJson($p);
// $Encoded = $CSVJ->CsvToJson($PathFileNam , $Delimiter );
// echo $Encoded , "<br>";
// echo getType($Encoded) , "<br>";

// // json to csv
// $FileNam      = 'ability.cov.new.csv';

// $Decoded = $CSVJ->JsonToCsv($PathFileNam , $Delimiter , $Encoded);
// echo $Decoded , "<br>";
// exit;


// use DA\FsComponents;
use DA\Logs\LogManager as LM;

use DA\FsComponents\CSVToFromJSON as CSVJ;


try {

    // definizione e istanza variabili
    // throw new exception("FsManagerProxy\n");C:\xampp\htdocs\tesiTerzoAnno\DAB\DA\_FsBase\Prj\Usr_1_Prj_23\Evnt_15\airmiles_struct.csv_da

    // $FilePath   = '/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/';
    // $FileNam    = 'ability.cov.csv';
    $FilePath   = '/xampp/htdocs/tesiTerzoAnno/DAB/DA/_FsBase/Prj/Usr_1_Prj_23/Evnt_15/';
    $FileNam    = 'airmiles_struct.csv_da';
    $PathFileNam =  $FilePath . $FileNam;

    $Delimiter  = ';';
    $FileString = "";
    $Encoded    = "";
    $DatArr     = array();
    $Method     = "CsvToJson";

    $Result     = null;
    $ResultType = "";
    // Prjs, fsBase
    // if (isset($_POST["FilePath"])) {
    //     if (trim($_POST["FilePath"]) != '') {
    //         $FilePath = $_POST["FilePath"];
    //     }
    // }
    // if (isset($_POST["FileNam"])) {
    //     if (trim($_POST["FileNam"]) != '') {
    //         $FileNam = $_POST["FileNam"];
    //     }
    // }
    // if (isset($_POST["FileString"])) {
    //     if (trim($_POST["FileString"]) != '') {
    //         $FileString = $_POST["FileString"];
    //     }
    // }
    // if (isset($_POST["Delimiter"])) {
    //     if (trim($_POST["Delimiter"]) != '') {
    //         $Delimiter = $_POST["Delimiter"];
    //     }
    // }
    // if (isset($_POST["Encoded"])) {
    //     if (trim($_POST["Encoded"]) != '') {
    //         $Encoded = $_POST["Encoded"];
    //     }
    // }
    // if (isset($_POST["DatArr"])) {
    //     if (trim($_POST["DatArr"]) != '') {
    //         $DatArr = $_POST["DatArr"];
    //     }
    // }
    // if (isset($_POST["Method"])) {
    //     if (trim($_POST["Method"]) != '') {
    //         $Method = $_POST["Method"];
    //     }
    // }

    // $p = [
    //     "PrjNam"        => $PrjNam,
    //     "AnNam"         => $AnNam,
    //     "FilePath"      => $FilePath,
    //     "FilePathNew"   => $FilePathNew,
    //     "FileNam"       => $FileNam,
    //     "FileNamNew"    => $FileNamNew,
    //     "FileContent"   => $FileContent,
    //     "OverWrite"     => $OverWrite,
    //     "Delimiter"     => $Delimiter,
    //     "ResultType"    => $ResultType
    // ];

    // throw new exception(json_encode($p) . "\n");

    $CSVJ=new CSVJ();
    // if ($o->$Method($p)) {
    //     $Result = "true";
    // } else {
    //     if ($ResultType == "data") {
    //         exit;
    //     }
    //     $Result = "false";
    // }
    // throw new exception($Result . "\n");

    switch ($Method) {
        case "CsvToArray":
            $Result=$CSVJ->CsvToArray($PathFileNam, $Delimiter);
            break;
        case "JsonToCsv":
            $Result=$CSVJ->JsonToCsv($PathFileNam, $Delimiter, $Encoded);
            break;
        case "CsvToJson":
            $Result=$CSVJ->CsvToJson($PathFileNam, $Delimiter);
            if($Result){
                $Result=json_decode($Result);
            }
            break;
        case "ArrayToCsv":
            $Result=$CSVJ->ArrayToCsv($DatArr, $PathFileNam, $Delimiter);
            break;
        case "SaveFile":
            $Result=$CSVJ->SaveFile($PathFileNam, $FileString);
            break;
        default:
            $Result=false;
    }
    if($Result){
        $Ret_arr = array(
            "State" => true,
            "Msg" => "Ok !",
            "Data" => $Result
        );
    } else {
        $Ret_arr = array(
            "State" => false,
            "Msg" => "No result !"
        );
    }

    print_r(json_encode($Ret_arr));
} catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
    return false;
}
