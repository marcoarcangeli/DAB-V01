<?php

namespace DA\FsComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/FsComponents/CSVToFromJSON.php');
include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;
use DA\FsComponents\CSVToFromJSON as CSVJ;

class CSVCleaner 
{

    // database connection and table Nam
    // private $Conn;

    // object properties
    public $Fn;
    public $Delimiter = ';';
    public $CsvDat=array();
    public $Field;
    
    public $Ops=array();
    public $Op=array();
    public $ParamsOp=array();
    public $OpType=array();
    public $PosToFind= array();
    public $VlToFind= array("");
    public $Max= NULL;
    public $Min= NULL;
    public $Range= array();
    public $ReplaceVl= "NA";
    public $RefC= 0; // Column di ref per interpolazione lineare
    public $NDecs=2; // numero di decimali di approssimazione dei risultati finali 

    // constructor with $db as database connection
    public function __construct($Params=array(""))
    {
        // $this->conn = $db;
    }

  /*
  ## riempire i vuoti con NA o una costante
  ## riempire con Prev o Next
  ## riempire con una funzione altro
    1) interpolazione lineare fra Prev e Next -> media aritmetica fra i valori
        Se non c'è un Prev o un Next, sostituisce con il Vl esistente (Next o Prev)
        Se non esistono ne Prev ne Next non esistono valori validi e non si fa nulla.
  ## eliMinare righe con vuoti

  */
  public function CleanCSV($Ops ,$Fn, $Delimiter= ';')
  {
    try {

      $CSVJ=new CSVJ();

      if (($NOp=count($Ops)) == 0){
        // Log No operation to execute
        echo "No operation to execute", "<br>";
        return FALSE;
      }else{
        $this->Ops=$Ops;
        echo "N Operations: ", $NOp, "<br>";
      }

      if (!file_exists($Fn) || !is_readable($Fn)){
        return FALSE;
      }else{
        $this->Fn=$Fn;
        $this->CsvDat=$CSVJ->CsvToArray($this->Fn, $Delimiter = ';');
        //per visualizzare il flusso letto 
        //csv to json
        // $p = [
        //   "FilePath"      => '/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/',
        //   "Fn"      => 'EuStockMarkets2.csv',
        //   "Delimiter"     => ';'
        // ];
        // $JsonData=CsvToJson($p);
        echo "File CSV checked.", "<br>";
      }
      
      // per ciascuna operazione
      foreach ($this->Ops as $Op) {
        // Set proprietà
        $this->Op = $Op;
        // verifica parametri operazione
        if(!$this->CheckOpParams()){
          //Log Op params check not correct
          echo "Op params check not correct", "<br>";
          return FALSE;
        }
        echo "<br>", "Op params  checked.", "<br>";

        if(count($this->PosToFind) > 0){
          ////////////////////////////////////////////
          // cleaning per Pos
          // per ogni Pos: formato: "row-Column", es. "1-3", "10-2", "23-1", "35-4"
          echo "Operation Mode: Pos.", "<br>";

          foreach ($this->PosToFind as $Pos) {
            $p=explode('-',$Pos);
            $r=$p[0]; //row
            $c=$p[1]; //Column
            // in base al tipo di operazione

            echo "Found Vl(" , $r , "," , $c , "): ", $this->CsvDat[$r][$c], "<br>";
            exit; //  test
            $this->ExecOp($r,$c);

            echo "Operation Terminated Vl(" , $r , "," , $c , "): ", $this->CsvDat[$r][$c], "<br>";
          }
        }elseif(count($this->VlsToFind) > 0){
        //////////////////////////////////////////////
        // cleaning per Vl

          echo "Operation Mode: Value.", "<br>";

          $r=0;
          foreach ($this->CsvDat as $Row) {
            $c=0;
            // echo count($Row), "<br>";
            foreach ($Row as $Field) {
              // echo $Field," ";
              //      se il Field è nei valori da cercare (anche vuoto -> "")
              if (in_array($Field, $this->VlsToFind)) {

                echo "Found Vl(" , $r , "," , $c , "): ", $this->CsvDat[$r][$c], "<br>";

                $this->ExecOp($r,$c);

                echo "Operation Terminated Vl(" , $r , "," , $c , "): ", $this->CsvDat[$r][$c], "<br>";

              }
              $c=$c+1;
            }
            $r=$r+1;
          }
        }elseif(!is_null($this->Max)){
        //////////////////////////////////////////////
        // cleaning per Cond: Max

          echo "Conditional operation: Max.", $this->Max,  "<br>";

          $r=0;
          foreach ($this->CsvDat as $Row) {
            $c=0;
            // echo count($Row), "<br>";
            foreach ($Row as $Field) {
              // echo $Field," ";
              //      se il Field è maggiore del massimo impostato 
              if ($Field > $this->Max) {

                echo "Found Vl(" , $r , "," , $c , "): ", $this->CsvDat[$r][$c], "<br>";

                $this->ExecOp($r,$c);

                echo "Operation Terminated Vl(" , $r , "," , $c , "): ", $this->CsvDat[$r][$c], "<br>";

              }
              $c=$c+1;
            }
            $r=$r+1;
          }
        }elseif(!is_null($this->Min)){
        //////////////////////////////////////////////
        // cleaning per Cond: Min

          echo "Conditional operation: Min.", $this->Min, "<br>";

          $r=0;
          foreach ($this->CsvDat as $Row) {
            $c=0;
            // echo count($Row), "<br>";
            foreach ($Row as $Field) {
              // echo $Field," ";
              //      se il Field è Minore del Minimo impostato 
              if ($Field < $this->Min) {

                echo "Found Vl(" , $r , "," , $c , "): ", $this->CsvDat[$r][$c], "<br>";

                $this->ExecOp($r,$c);

                echo "Operation Terminated Vl(" , $r , "," , $c , "): ", $this->CsvDat[$r][$c], "<br>";

              }
              $c=$c+1;
            }
            $r=$r+1;
          }
        }elseif(!is_null($this->Range)){
        //////////////////////////////////////////////
        // cleaning per Cond: Range

          echo "Conditional operation: Range.", $this->Range, "<br>";

          $r=0;
          foreach ($this->CsvDat as $Row) {
            $c=0;
            // echo count($Row), "<br>";
            foreach ($Row as $Field) {
              // echo $Field," ";
              //      se il Field è maggiore del massimo o Minire del Minimo impostati
              if (($Field > $this->Max)||($Field < $this->Min)) {

                echo "Found Vl(" , $r , "," , $c , "): ", $this->CsvDat[$r][$c], "<br>";

                $this->ExecOp($r,$c);

                echo "Operation Terminated Vl(" , $r , "," , $c , "): ", $this->CsvDat[$r][$c], "<br>";

              }
              $c=$c+1;
            }
            $r=$r+1;
          }
        }else{
          // Log "Conditional operation: Range.", $this->Range, "<br>";
          echo "Operation mode not set correctly.", "<br>";
        }

      }
      //visualizza nuovo array
      // foreach ($this->CsvDat as $Row) {
      //   // echo count($Row);
      //   echo "<br>";
      //   foreach ($Row as $Field) {
      //     echo $Field," ";
      //   }
      // }

      // echo "salvataggio ...","<br>";
      // ## es outFn = 'C:/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/EuStockMarkets2_clean.csv'
      // DA MIGLIORARE
      $OutFn = str_ireplace(".csv", "_clean.csv" ,$Fn);
      if($Res=$CSVJ->ArrayToCsv($this->CsvDat, $OutFn, $this->delimiter = ';') == TRUE){
        echo "Saved","<br>";
        return $OutFn;
      } else{
        echo "Not Saved","<br>";
        return FALSE;
      }
      echo "end","<br>";
    } catch (Exception $e) {
      LM::LogMessage("ERROR", $e);
      return false;
      }
  }

  /*
    $r: row
    $c: Column
    $v: Direction [p: Prev; s: Next]
  */
  protected function FindPrevNext($r, $c, $v="p")
  {
    try {
      // per ogni i=[r-1,0] 
      if($v=="p"){
        if($r-1 > 0){
          $Range=range($r-1,0);
        }
      }elseif($v=="s"){
        if($f=(count($this->CsvDat)-1) > $r+1){
          $Range=range($r+1,$f);
        }
      }else{
        //Log Direction FindPrevNext not valid.
        echo "Direction FindPrevNext not valid.", "<br>";

        return NULL;
      }
      foreach($Range as $r){
      //  se Field(r, c) esiste
        if(isset($this->CsvDat[$r][$c])){
          //    se il Field(r, c) NON è nei valori da cercare (anche vuoto -> "")
          if (!in_array($this->CsvDat[$r][$c], $this->VlsToFind)) {
            //    return Field()
            $Result=array(
              "Vl" => $this->CsvDat[$r][$c], 
              "Row"=> $r,
              "Column"=> $c
            );
            return $Result;
          }
        }
      }
      return NULL;

    } catch (Exception $e) {
      LM::LogMessage("ERROR", $e);
      return false;
      }
  }

  protected function PrevOrNext($r, $c)
  {
    try {
      // ## riempire con Prev o Next
      //        se cerca_Prev(c) esiste
      //          Field(r,c) = Prev(p,c), dove p <= r
      //        altrimenti se cerca_Next(c) esiste
      //          Field(r,c) = Next(s,c), dove s >= r
      if(count($p=$this->FindPrevNext($r, $c, $v="p"))!==0){
        return $p;
      }elseif(count($s=$this->FindPrevNext($r, $c, $v="s"))!==0){
        return $s;
      }else{
        // Log Field(r,c) not replaced
        echo "Field(",$r,",",$c,") not replaced.", "<br>";
        return array(); 
      }

    } catch (Exception $e) {
      LM::LogMessage("ERROR", $e);
      return false;
      }
  }

  /*
    $r: row
    $c: Column
    $RefC: Column di ref come ascissa per interpolazione default = 0
  */
  protected function LinearInterp($r, $c)
  {
    try {
      // ## riempire con una funzione altro
      //        1) interpolazione lineare fra Prev e Next -> media aritmetica fra i valori
      //          se cerca_Prev(c) esiste && cerca_Next(c) esiste
      //            dy=Field(s,c) - Field(p,c)
      //            dx=FieldRef(s) - FieldRef(p) , dove FieldRef: altra Column di ref (es tempo o enumerazione o altro)
      //            CoeffAng=dy/dx
      //            per ogni row r fra p e s (della Column c; p ed s esclusi)
      //              dxx=dx=FieldRef(r) - FieldRef(p)
      //              Field(r,c) = dxx * CoeffAng + Field(p,c)
      //          altrimenti
      //            Log operazione non eseguita su Field(r,c)
      //            continua
      //-----------------------------------------------------------------------------
      //        $RefC: Column di ref come asse x di interpolazione.
      //                  Default è Column 0.
      //
      //  Per i calcoli i numeri devono essere convertiti in formato anglosassone
      //  sostituendo "." -> ","

      if(($p=$this->FindPrevNext($r, $c, $v="p"))!==FALSE){
        if(($s=$this->FindPrevNext($r, $c, $v="s"))!==FALSE){
          // attenzione al simbolo decimale. "." per i calcoli
          $vSucc=str_replace(",",".",$s["Vl"]);
          $vPrec=str_replace(",",".",$p["Vl"]);
          echo "Vl Next: ",$s["Vl"],">>", $vSucc," Prev value: ",$p["Vl"],">>", $vPrec, "<br>";
          $dy=$vSucc-$vPrec;
          echo "dy=vSucc-vPrec= ",$dy, "<br>";

          echo "Column ref x: ", $this->RefC, "<br>";
          // $xSucc=str_replace(",",".",$this->CsvDat[$s["Row"]][$this->RefC]);
          // $xPrec=str_replace(",",".",$this->CsvDat[$p["Row"]][$this->RefC]);
          // echo "x Next: ",$s["Vl"],">>", $xSucc," x Prev: ",$p["Vl"],">>", $xPrec, "<br>";
          $xSucc=$this->CsvDat[$s["Row"]][$this->RefC];
          $xPrec=$this->CsvDat[$p["Row"]][$this->RefC];
          echo "x Next: ", $xSucc," x Prev: ", $xPrec, "<br>";
          $dx= $xSucc - $xPrec;
          echo "dx=xSucc-xPrec= ",$dx, "<br>";

          $CoeffAng=$dy/$dx;
          echo "CoeffAng: ",$CoeffAng, "<br>";

          $vNoto=str_replace(",",".",$this->CsvDat[$p["Row"]][$c]);
          echo "vNoto: ",$vNoto, "<br>";

          echo "row inizio: ", $p["Row"]+1," row fine: ", $s["Row"]-1, "<br>";
          $Range=range($p["Row"]+1,$s["Row"]-1);

          foreach($Range as $rr){
            $xxSucc=str_replace(",",".",$this->CsvDat[$rr][$this->RefC]);
            // echo "x Next: ",$s["Vl"],">>", $xSucc," x Prev: ",$p["Vl"],">>", $xPrec, "<br>";
            echo "x Next: ", $xSucc," x Prev: ", $xPrec, "<br>";
            $dxx= $xxSucc - $xPrec;
            echo "dxx=xxSucc-xPrec= ",$dxx, "<br>";
  
            // Log Prev value, current value arrotondato a 2 decimali
            $Result=round(($dxx * $CoeffAng) + $vNoto, $this->NDecimals);
            echo "Result: ",$Result, "<br>";
            echo "Result string: ",str_replace(".",",",(string)$Result), "<br>";

            // $this->CsvDat[$r][$c] = str_replace(".",",",(string)$Result);
            return str_replace(".",",",(string)$Result);

          }
        }else{
          // Log Linear Interp not executed; Prev value not found.
          echo "Linear Interp not executed; Prev Value not found.", "<br>";

          return NULL;
        }
      }else{
        // Log operazione Linear Interp not executed; Vl Next not found.
        echo "Linear Interp not executed; Next Value not found.", "<br>";

        return NULL;
      }

    } catch (Exception $e) {
      LM::LogMessage("ERROR", $e);
      return false;
      }
  }

  protected function ExecOp($r,$c)
  {
    try {
      switch($this->OpType){
        case "costante";
          // ## substitute with a const; ex NA for Not Available
          // Log Prev value, current value
          echo "Prev value: ", $this->CsvDat[$r][$c],"current value: ", $this->ReplaceVl, "<br>";

          $this->CsvDat[$r][$c]=$this->ReplaceVl;

          break;
        case "prec-succ";
          // ## riempire con Prev o Next
          if(count($Pos=$this->PrevOrNext($r,$c))!== 0){
            // Log Prev value, current value
            $v=$Pos["Vl"];
            echo "Prev value: ", $this->CsvDat[$r][$c],"current value: ", $v, "<br>";

            $this->CsvDat[$r][$c]=$v;
          }else{
            // Log Prev value o Next not found per Pos r, c
          }

          // echo "<-", $ReplaceVl,$r," ", $c," ", $this->CsvDat[$r][$c], " ";
          break;
        case "LinearInterp";

          if(($v=$this->LinearInterp($r,$c))!== NULL){
            // Log Prev value, current value
            echo "Prev value: ", $this->CsvDat[$r][$c],"current value: ", $v, "<br>";

            $this->CsvDat[$r][$c]=$v;
          }else{
            // Log Prev value o Next not found per Pos r, c
          }
          break;
        case "eliMina";
          // ## eliMinare righe con valori da cercare
          //          se eliMina_row(r) è ok
          //            Log Deleting row r
          //          altrimenti
          //            continua.

          //Log Deleting row
          unset($this->CsvDat[$r]);
          echo "Deleting row: ", $r, "<br>";

          break;
        default:
          // Log operation not recognized
      }

    } catch (Exception $e) {
      LM::LogMessage("ERROR", $e);
      return false;
      }
  }

  protected function CheckOpParams()
  {
    try {
        // verifica parametri operazione
        //tipo operazione
        if (array_key_exists('OpType', $this->Op)){
          $this->OpType=$this->Op["OpType"]; 
          // valori: costante, prec-succ, LinearInterp, eliMina, 
          //         perequazioneMaxMin, perequazioneScartoMediaMaxMin
        }else{
          // Log Operation not set
          echo "Operation not set", "<br>";

          $this->OpType="";
          return FALSE;
        }
        //parametri operazione
        if (array_key_exists('ParamsOp', $this->Op)){
          $this->ParamsOp=$this->Op["ParamsOp"]; // 
        }else{
          // Log Op params not set
          echo "Op params not set", "<br>";

          $this->ParamsOp=array();
          return FALSE;
        }

        // Working mode on CSV: Pos, Vl, Cond
        // Clean
        $this->PosToFind=array();
        $this->VlsToFind=array();
        $this->Max=NULL;
        $this->Min=NULL;
        $this->Range=array();
        // Set
        if (array_key_exists('PosToFind', $this->ParamsOp)){
          $this->PosToFind=$this->ParamsOp["PosToFind"];

        }elseif(array_key_exists('VlsToFind', $this->ParamsOp)){
          $this->VlsToFind=$this->ParamsOp["VlsToFind"];

        }elseif(array_key_exists('Max', $this->ParamsOp)){
          $this->Max=$this->ParamsOp["Max"];

        }elseif(array_key_exists('Min', $this->ParamsOp)){
          $this->Min=$this->ParamsOp["Min"];

        }elseif(array_key_exists('Range', $this->ParamsOp)){
          $Range=$this->ParamsOp["Range"];
          // verifica contenuto parametro Range
          $this->Range= explode('-',$this->Range);
          // solo 2 valori numerici dove Min<Max : es: 800-1800
          if(count($this->Range)!==2){
            // Log numero parametri Range non corretto: count(Range)
            echo "numero parametri Range non corretto: ", count($this->Range), "<br>";
            return FALSE;
          }
          $this->Min=$this->Range[0];
          if(is_nan($this->Min)){
            // Log parametro Range.Min non numerico: Min
            echo "parametro Range.Min non numerico: ", $Min, "<br>";
            return FALSE;
          }
          $this->Max=$this->Range[1];
          if(is_nan($this->Max)){
            // Log parametro Range.Min non numerico: Min
            echo "parametro Range.Max non numerico: ", $Max, "<br>";
            return FALSE;
          }

        }else{
          // Log Operation mode not set
          echo "Operation mode not set.", "<br>";

          return FALSE;
        }

        //ReplaceVl: default "NA"
        if (array_key_exists('ReplaceVl', $this->ParamsOp)){
          $this->ReplaceVl=$this->ParamsOp["ReplaceVl"];
        }else{
          $this->ReplaceVl="NA"; // default
        }
        
        //RefC: default 0
        if (array_key_exists('RefC', $this->ParamsOp)){
          $this->RefC=$this->ParamsOp["RefC"];
        }else{
          $this->RefC=0; // default
        }

        //NDecimals: default 2
        if (array_key_exists('RefC', $this->ParamsOp)){
          if(is_integer($this->ParamsOp["NDecimals"])){
            $this->NDecimals=$this->ParamsOp["NDecimals"];
          }else{
            // Log warning Operation mode not set
            echo "N Decim approximation param not correct.", "<br>";
            echo "Set default: 2 decimal figures.", "<br>";
            $this->NDecimals=2; // default
          }
        }else{
          $this->NDecimals=2; // default
        }
        
        return TRUE;

    } catch (Exception $e) {
      LM::LogMessage("ERROR", $e);
      return false;
      }
  }
}