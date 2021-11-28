<?php
include_once("CSVCleaner.php");

use DA\FsComponents;

// test function cleanNA($csvData, $valoriDaCercare = array(""), $valoreSostitutivo = "")
$FileNam = 'C:/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/EuStockMarkets2.csv';
$Delimiter = ';';

// su valore
$valoriDaCercare1=array("", "--", "----", "hlkjh");
$valoriDaCercare2=array("XXXXXXX");
$valoriDaCercare3=array("1613,42","1723,1","1688,5");
// paramsOperazione1 costante
// $ParamsOperazione1 = array(
//   "valoriDaCercare" => $valoriDaCercare1,
//   "valoreSostitutivo" => "XXXXXXX"
// );
// // paramsOperazione2 prec-succ
// $ParamsOperazione2 = array(
//   "valoriDaCercare" => $valoriDaCercare2,
// );
// paramsOperazione3 interpLin
$ParamsOperazione3 = array(
  "valoriDaCercare" => $valoriDaCercare1,
  "nDecimali" => "3",
);
// // paramsOperazione4 elimina
// $ParamsOperazione4 = array(
//   "valoriDaCercare" => $valoriDaCercare2,
// );

// su posizione
// $posizioniDaCercare1=array("1-3", "10-2", "23-1", "35-4");
// // paramsOperazione5
// $ParamsOperazione5 = array(
//   "posizioniDaCercare" => $posizioniDaCercare1, // riga-colonna
//   "valoreSostitutivo" => "NAN"
// );
// // paramsOperazione6
// $ParamsOperazione6 = array(
//   "posizioniDaCercare" => $posizioniDaCercare1, // riga-colonna
// );
// // paramsOperazione7
// $ParamsOperazione7 = array(
//   "posizioniDaCercare" => $posizioniDaCercare1, // riga-colonna
// );
// $ParamsOperazione8 = array(
//   "posizioniDaCercare" => $posizioniDaCercare1, // riga-colonna
// );

// su condizione
// $max1=array("1900");
// $min1=array("900");
// $range1=array("800-1800");

// 
// // paramsOperazione9 sostituzione costante
// $ParamsOperazione9 = array(
//   "valoreSostitutivo" => "NAN",
//   "max" => $max1
// );
// // paramsOperazione10 sostituzione prec-succ
// $ParamsOperazione10 = array(
//   "min" => $min1
// );
// // paramsOperazione11 sostituzione interpolazione lineare
// $ParamsOperazione11 = array(
//   "range" => $range1
// );
// // paramsOperazione12 elinimazione 
// $ParamsOperazione12 = array(
//   "range" => $range1
// );


// tipi: costante, prec-succ, interpolazioneLineare, elimina, 

//per valore
//operazione1
// $operazione1 = array(
//   "tipoOperazione" => "costante",
//   "paramsOperazione" => $ParamsOperazione1
// );
// //operazione2
// $operazione2 = array(
//   "tipoOperazione" => "prec-succ",
//   "paramsOperazione" => $ParamsOperazione2
// );
//operazione3
$operazione3 = array(
  "tipoOperazione" => "interpolazioneLineare",
  "paramsOperazione" => $ParamsOperazione3
);
// //operazione4
// $operazione4 = array(
//   "tipoOperazione" => "elimina",
//   "paramsOperazione" => $ParamsOperazione4
// );

// // per posizione
// //operazione5
// $operazione5 = array(
//   "tipoOperazione" => "costante",
//   "paramsOperazione" => $ParamsOperazione5
// );
// //operazione6
// $operazione6 = array(
//   "tipoOperazione" => "prec-succ",
//   "paramsOperazione" => $ParamsOperazione6
// );
// //operazione7
// $operazione7 = array(
//   "tipoOperazione" => "interpolazioneLineare",
//   "paramsOperazione" => $ParamsOperazione7
// );
// //operazione8
// $operazione8 = array(
//   "tipoOperazione" => "elimina",
//   "paramsOperazione" => $ParamsOperazione8
// );

// // su condizione
// //operazione9
// $operazione9 = array(
//   "tipoOperazione" => "costante",
//   "paramsOperazione" => $ParamsOperazione9
// );
// //operazione10
// $operazione10 = array(
//   "tipoOperazione" => "prec-succ",
//   "paramsOperazione" => $ParamsOperazione10
// );
// //operazione11
// $operazione11 = array(
//   "tipoOperazione" => "interpolazioneLineare",
//   "paramsOperazione" => $ParamsOperazione11
// );
// //operazione12
// $operazione12 = array(
//   "tipoOperazione" => "elimina",
//   "paramsOperazione" => $ParamsOperazione12
// );


// array operazioni
$operazioni=array(
  // $operazione1 , 
  //  $operazione2, 
  $operazione3//, 
  // $operazione4, 
  // $operazione5, 
  // $operazione6, 
  // $operazione7, 
  // $operazione8, 
);

echo "numero operazioni: ", count($operazioni),"<br>";
echo "tipo operazione: ", count($operazione3),"<br>";
echo "params operazione: ", count($ParamsOperazione3),"<br>";

$csvCleaner = new DA\FsComponents\CSVCleaner();
// exit;

// cleanCSV($operazioni = array(),$FileNam, $Delimiter = ';')
if($outFile=$csvCleaner->cleanCSV($operazioni, $FileNam, $Delimiter)){
  echo "OK";
}else{
  echo "KO";
}


