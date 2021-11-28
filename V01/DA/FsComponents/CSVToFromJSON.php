<?php
namespace DA\FsComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;

class CSVToFromJSON 
{

  // database connection and table Nam
  // private $Conn;

  // object properties
  // public $FileNam;
  // public $Delimiter = ';';
  // public $csvData=array();
  // public $field;

  // constructor with $db as database connection
  public function __construct($Params=array())
  {
      // $this->conn = $db;
  }

    /*
    ["pathFileNam"]
    ["Delimiter"]
  */
  public function CsvToArray($PathFileNam = '', $Delimiter = ';')
  {
    try {

      if (!file_exists($PathFileNam) || !is_readable($PathFileNam)){
        // Log path FileNam CSV non corretto.
        // echo "path FileNam CSV non corretto.", "<br>";
        return NULL;
      }
      // $header = NULL;
      $Dat = array();
      if (($Handle = fopen($PathFileNam, 'r')) !== FALSE) {
        while (($Row = fgetcsv($Handle, 1000, $Delimiter)) !== FALSE) {
          // if(!$header)
          //     $header = $Row;
          // else
          //     $Dat[] = array_combine($header, $Row);
          array_push($Dat, $Row);
        }
        fclose($Handle);
      }
      return $Dat;
    } catch (Exception $e) {
      LM::LogMessage("ERROR", $e);
      return false;
    }
  }

  /*
    ["pathFileNam"]
    ["jsonEncoded"]: stringa in formato JSON
  */
  public function JsonToCsv($PathFileNam = '', $Delimiter = ';', string $JsonEncoded)
  {
    try {

      $Dat = json_decode($JsonEncoded, true);

      $Handle = fopen($PathFileNam, 'w');
      // $header = false;
      foreach ($Dat as $Row)
      {
          fputcsv($Handle, $Row, $Delimiter, $enclosure='"');
      }
      fclose($Handle);
      return true;

    } catch (Exception $e) {
      LM::LogMessage("ERROR", $e);
      return false;
    }
  }

    /*
        ["pathFileNam"]
        ["Delimiter"]
    */

  public function CsvToJson($PathFileNam = '', $Delimiter = ';')
  {
    try {
      if(!is_null($Res=$this->CsvToArray($PathFileNam, $Delimiter))){
        $Encoded = json_encode($Res);
        // echo gettype($Encoded), "<br>";
        return $Encoded;
      }else{
        return NULL;
      }
      
    } catch (Exception $e) {
      LM::LogMessage("ERROR", $e);
      return false;
    }
  }

  /*
    ["arrayData"] 
    ["pathFileNam"]
    ["Delimiter"]
  */

  public function ArrayToCsv($DatArr=array(), $PathFileNam = '', $Delimiter = ';')
  {
    try {
      if (count($DatArr)==0){
        return FALSE;
      }

      if (file_exists($PathFileNam) && !is_readable($PathFileNam))
        return FALSE;
      // $header = NULL;
      if (($Handle = fopen($PathFileNam, 'w')) !== FALSE) {
        foreach ($DatArr as $Row) {
          fputcsv($Handle, $Row, $Sep = $Delimiter);
        }
        fclose($Handle);
      }
      return TRUE;
    } catch (Exception $e) {
      LM::LogMessage("ERROR", $e);
      return false;
    }
  }

  /*
    $PathFileNam
    $FileString: stringa; es. in formato codificato json, o csv
  */
  public function SaveFile($PathFileNam, string $FileString)
  {
    try {

      $Handle = fopen($PathFileNam, 'w');
      fwrite($Handle, $FileString);
      fclose($Handle);
      return true;

    } catch (Exception $e) {
      LM::LogMessage("ERROR", $e);
      return false;
    }
  }


}
