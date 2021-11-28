<?php

namespace DA\PhpRComponents;

use DA\PhpRComponents;
use DA\FsComponents;

// 
// includi componenti utili
// . DAO per leggere menu da db
// . menu item tesiTerzoAnno\DAB\DA\FsComponents\CSVToFromJSON.php
include_once('..\FsComponents\CSVToFromJSON.php');
include_once('..\FsComponents\fsManager.php');

class phpRController
{
    public string $params; // JSON of all params
    public string $paramsArray; // array of all params

    public string $rScriptAbsPath;
    public string $rScriptOutputAbsPath;
    public string $rScriptName;
    public string $rScriptParams;

    public string $rScriptPathFileName;
    public string $rScriptParamsCSVPathFilename;
    public string $rScriptOutputsCSVPathFilename;
    public  $rScriptParamsArray;
    // public string $rScriptParamsArrayJSON;

    public string $execOutput;
    public array $output;
    public int $execStatus;

    /* $param json array
    */

    public function __construct(string $params = "OK")
    {
        $this->params=$params;
        // $this->mainControl();
    }

    public function mainControl()
    {
        try {
            if($this->verifyParams()){
                if($this->prepareParamsCSV()){
                    // $this->cleanOutputFolder();

                    // es Rscript /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/rScriptPrototype_json.R params
                    $commandLine='Rscript ' . $this->rScriptPathFileName . ' ' . $this->rScriptParamsCSVPathFilename;
                    echo "commandLine: ".$commandLine. "<br>";

                    // $this->output=array();
                    // $this->execStatus=0;
                    // exec($commandLine, $this->output,  $this->execStatus);

                    $this->execOutput=shell_exec($commandLine);

                    // $this->execOutput=system($commandLine, $this->execStatus);

                    // exec('Rscript ' . $this->rScriptAbsPath . '/' . $this->rScript . ' ' . $this->rScriptParams, $this->output,  $this->execStatus);
                    $this->verifyOutputs();
                    // $this->updateRDBMS();
                }
            }else{
                return FALSE;
            }
            return true;
        } catch (Exception $e) {
            // log errore
            return FALSE;
            // throw new exception("Exception ".$e->getCode()." Msg: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine());
        }

        // $this->htmlStream ='<div>'.$param.'</div>';
    }

    public function verifyParams()
    {
        /**
         * $params = '
         * {
         *  "rScriptName": "scriptName",
         *  "rScriptParams":{"param1":"...","param2":"...","param3": " ..."}}';
         * }
        */
        
        try {

            // verifica parametri operazione
            // rScriptAbsPath
            if (isset($this->rScriptAbsPath)){
                // R script output path esistenza  
                if(!file_exists($this->rScriptAbsPath) || !is_dir($this->rScriptAbsPath)){
                    $this->rScriptAbsPath=$_SESSION["rScriptAbsPath"]; //default
                    echo "r Script Path non corretto. Impostato default. ", $this->rScriptAbsPath, "<br>";
                }else{
                    $this->rScriptAbsPath=$this->rScriptAbsPath; 
                    echo "r Script Path verificato. ", $this->rScriptAbsPath, "<br>";
                }
            }else{
                $this->rScriptAbsPath=$_SESSION["rScriptAbsPath"]; //default
                echo "r Script Path non corretto. Impostato default. ", $this->rScriptAbsPath, "<br>";
            }
  
            // rScriptOutputAbsPath
            if (isset($this->rScriptOutputAbsPath)){
                // R script output path esistenza  
                if(!file_exists($this->rScriptOutputAbsPath) || !is_dir($this->rScriptOutputAbsPath)){
                    $fsManager = new \DA\FsComponents\fsManager();
                    if($fsManager->makeFolder($this->rScriptOutputAbsPath)){
                        echo "r Script output Path creato.", "<br>";
                    }else{
                        $this->rScriptOutputAbsPath=$_SESSION["rScriptOutputAbsPath"]; //default
                        echo "r Script output Path non creato correttamente. Impostato default.", "<br>";
                        }
                }else{
                    $this->rScriptOutputAbsPath=$this->rScriptOutputAbsPath; 
                    echo "r Script Output Path verificato.", $this->rScriptOutputAbsPath, "<br>";
                }
            }else{
                $this->rScriptOutputAbsPath=$_SESSION["rScriptOutputAbsPath"]; //default
                echo "r Script output Path non corretto. Impostato default.", "<br>";
            }

            // rScriptName
            if (isset($this->rScriptName)){
                // R script esistenza leggibile 
                $this->rScriptPathFileName=$this->rScriptAbsPath . '/' . $this->rScriptName;
                if(!file_exists($this->rScriptPathFileName) || !is_readable($this->rScriptPathFileName)){
                    // log R script name non impostato correttamente.
                    echo "R script Path Filename non disponibile.","<br>";
                    return FALSE;
                }else{
                    $this->rScriptName=$this->rScriptName; 
                    echo "r Script Path Filename verificato. ",$this->rScriptPathFileName, "<br>";
                }
            }else{
                // log script name non impostato correttamente.
                echo "script name non impostato.","<br>";
                return FALSE;
            }
            
            // rScriptParams
            if (isset($this->rScriptParams)){
                echo "script params impostati.","<br>";
            }else{
                // log script params non impostati correttamente.
                echo "script params non impostati.","<br>";
                return FALSE;
            }
        
            return TRUE;

        } catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function prepareParamsCSV()
    {
        /**
        */
        
        try {
            $this->rScriptParamsArray=array(
                "colNames"  => array("rScriptName","rScriptAbsPath","rScriptOutputAbsPath","rScriptParams"),
                "values"    => array($this->rScriptName,$this->rScriptAbsPath,$this->rScriptOutputAbsPath,$this->rScriptParams)
            );
            
            echo "numero righe rScriptParamsArray: ", count($this->rScriptParamsArray), "<br>";
            $CSVToFromJSON = new \DA\FsComponents\CSVToFromJSON();
            $outFilename = str_ireplace(".R", "_params.csv" ,$this->rScriptName);
            $this->rScriptParamsCSVPathFilename =$this->rScriptOutputAbsPath.$outFilename;
            $CSVToFromJSON->arrayToCsv($this->rScriptParamsArray, $this->rScriptParamsCSVPathFilename, $delimiter = ';');
            // $cJ->csvFilePath=$this->rScriptOutputAbsPath;
            // $cJ->JsonToCsv(json_encode($rScriptParamsArray));
            // $this->rScriptParamsArrayJSON->json_encode($rScriptParamsArray);
            echo "Parametri salvati: ". $this->rScriptParamsCSVPathFilename . "<br>";

            return true;
        } catch (Exception $e) {
            // throw new exception("Exception ".$e->getCode()." Msg: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine());
            // log errore in phpRController->prepareParamsCSV: $e->getMessage() . "\n"
            echo "errore in phpRController->prepareParamsCSV: ". $e->getMessage() . "\n";
            return FALSE;
        }
    }

    public function verifyOutputs()
    {
        /**
         * verifica che nel rScriptOutputAbsPath vi sia:
         * 1) <rScriptName>Outputs.csv : tabella elenco file output prodotti in rScriptOutputAbsPath
         *          ??? Interpretata anche come segnale che l'elaborazione è terminata.
         *          outputFile: percorso assoluto del file output.
         * 2) verifica presenza degli output elencati in <rScriptName>Outputs.csv
         *          Se qualcuno non presente log e informazione utente (no errore).
         * 3) ritorno all'interfaccia utente.
        */
        
        try {
            // echo gettype($this->output);
            // echo $this->output;

            // echo gettype($this->execStatus);
            // echo $this->execStatus;

            echo "execOutput: <br>".$this->execOutput."<br>";

            //verifica <rScriptName>Outputs.csv
            // $outFilename = str_ireplace(".R", "_outputs.csv" ,$this->rScriptName);
            // es rScriptPrototype_Sample01.R_outputs.csv
            //    rScriptPrototype_Sample01.R_outputs.csv
            $outFilename = $this->rScriptName. "_outputs.csv";
            $this->rScriptOutputsCSVPathFilename=$this->rScriptOutputAbsPath . $outFilename;
            echo "outFilename: ".$this->rScriptOutputsCSVPathFilename."<br>";
            if(!file_exists($this->rScriptOutputsCSVPathFilename) || !is_readable($this->rScriptOutputsCSVPathFilename)){
                // log outputFile non trovato: outputFile.
                echo "elenco outputFile non trovato: ", $this->rScriptOutputsCSVPathFilename, "<br>";
            }else{
                echo "elenco outputFile presente: ", $this->rScriptOutputsCSVPathFilename, "<br>";
                // converti in array
                $CSVToFromJSON = new \DA\FsComponents\CSVToFromJSON();
                $outputsFiles=$CSVToFromJSON->csvToArray($this->rScriptOutputsCSVPathFilename, $delimiter = ';');
                $y=0;
                foreach($outputsFiles as $outputFile){
                    echo"riga: ".$y."<br>";
                    $of=(string)$outputFile[2];
                    if($of!=="url"){
                        echo "outputFile[2]: ".$of."<br>";

                        if(!file_exists($of) || !is_readable($of)){
                            // log outputFile non trovato: outputFile.
                            $outputsFiles[$y][3]="NO";
                            echo "outputFile non trovato: ", $of, "<br>";
                        }else{
                            // log outputFile presente: outputFile.
                            $outputsFiles[$y][3]="YES";
                            echo "outputFile presente: ", $of, "<br>";
                        }
                    }
                    $y=$y+1;
                }
                // echo "verifica variazioni: ", $outputsFiles[2][3], "<br>";
                if($CSVToFromJSON->arrayToCsv($outputsFiles, $this->rScriptOutputsCSVPathFilename, $delimiter = ';')){
                    // log rScriptOutputsCSVPathFilename aggiornato: 
                    echo "rScriptOutputsCSVPathFilename aggiornato", "<br>";
                }else{
                    // log rScriptOutputsCSVPathFilename NON aggiornato: 
                    echo "rScriptOutputsCSVPathFilename NON aggiornato", "<br>";
                }
            }
    } catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // public function execRScript()
    // {
    //     // $this->buildRScriptParams($rScriptParams);
    //     // $this->cleanOutputFolder('OK');
    //     // exec('Rscript ' . $this->rScriptPath . '/' . $this->rScript . $this->rScriptParams, $this->output, $this->execStatus);
    //     // exec($this->rScriptAbsPath . '/' . $this->rScriptName , $this->output, $this->execStatus);
    //     exec($this->rScriptAbsPath . '/' . $this->rScriptName);

    //     // exec('Rscript ' . $this->rScriptAbsPath . '/' . $this->rScriptName);
    //     // $this->buildHtml($rScriptParams);
    //     // return $this->htmlStream;
    // }

    // public function buildRScriptParams(string $rScriptParams)
    // {
    //     $this->rScriptParams = ' '
    //     . $this->outputFolder . ' '
    //     . $this->rScriptsFolder . ' '
    //     ;
    //     // se $rScriptParams non nullo, non vuoto
    //     // split su carattere ''
    //     return $this->rScriptParams;
    // }

    // public function buildHtml(string $param)
    // {
    //     $this->htmlStream = '
    //             <div class="content">
    //                 <div class="container-fluid">
    //                     <div class="row">
    //                         <div class="col-lg-6">
    //                             <div><img src="output/test.png"></div>
    //                             <div><img src="output/test01.png"></div>
    //                         </div>
    //                         <!-- /.col-md-6 -->
    //                         <div class="col-lg-6">';
    //     // elenco file di output
    //     $files = scandir('./output/');
    //     sort($files);
    //     foreach ($files as $file) {
    //         $this->htmlStream .= '<a href="output/' . $file . '">' . $file . '</a><br>';
    //     }

    //     $this->htmlStream .= '
    //                         </div>
    //                         <!-- /.col-md-6 -->
    //                     </div>
    //                     <!-- /.row -->
    //                     </div><!-- /.container-fluid -->
    //                 </div>
    //             <!-- /.content -->
    //         ';
    // }

    // public function cleanOutputFolder(string $param)
    // {
    //     // elimina i file nel outputPath
    //     $files = glob($this->outputFolder . '/' . $this->rScriptName . '*');
    //     foreach ($files as $file) {
    //         if (is_file($file)) {
    //             unlink($file);
    //         }
    //     }
    // }


}
