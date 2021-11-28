<?php

namespace DA\PhpRComponents;

$BFD=$_SESSION["BaseFolderDyn"];

// includi componenti utili
include_once($BFD.'DA\FsComponents\CSVToFromJSON.php');
include_once($BFD.'DA\FsComponents\FsManager.php');

use DA\FsComponents\FsManager as FSM;

class PhpRController
{
    public string $params; // JSON of all params
    public string $paramsArray; // array of all params

    public string $ProcAbsPath;
    public string $OutputAbsPath;
    public string $ProcNam;
    public string $ProcParams;

    public string $ProcPathFileName;
    public string $ProcParamsCSVPathFilename;
    public string $ProcOutputsCSVPathFilename;
    public  $ProcParamsArray;
    // public string $ProcParamsArrayJSON;

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
                    $commandLine='Rscript ' . $this->ProcPathFileName . ' ' . $this->ProcParamsCSVPathFilename;
                    echo "commandLine: ".$commandLine. "<br>";

                    // $this->output=array();
                    // $this->execStatus=0;
                    // exec($commandLine, $this->output,  $this->execStatus);

                    $this->execOutput=shell_exec($commandLine);

                    // $this->execOutput=system($commandLine, $this->execStatus);

                    // exec('Rscript ' . $this->ProcAbsPath . '/' . $this->rScript . ' ' . $this->ProcParams, $this->output,  $this->execStatus);
                    $this->verifyOutputs();
                    // $this->updateRDBMS();
                }
            }else{
                return false;
            }
            return true;
        } catch (Exception $e) {
            // log errore
            echo "errore in PhpRController->mainControl: ". $e->getMessage() . "\n";
            LM::LogMessage("ERROR", $e);
            return false;
            // throw new exception("Exception ".$e->getCode()." Msg: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine());
        }

        // $this->htmlStream ='<div>'.$param.'</div>';
    }

    public function verifyParams()
    {
        /**
         * $params = '
         * {
         *  "ProcNam": "scriptName",
         *  "ProcParams":{"param1":"...","param2":"...","param3": " ..."}}';
         * }
        */
        
        try {

            // verifica parametri operazione
            // ProcAbsPath
            if (isset($this->ProcAbsPath)){
                // R script output path esistenza  
                if(!file_exists($this->ProcAbsPath) || !is_dir($this->ProcAbsPath)){
                    $this->ProcAbsPath=$_SESSION["ProcAbsPath"]; //default
                    echo "r Script Path non corretto. Impostato default. ", $this->ProcAbsPath, "<br>";
                }else{
                    $this->ProcAbsPath=$this->ProcAbsPath; 
                    echo "r Script Path verificato. ", $this->ProcAbsPath, "<br>";
                }
            }else{
                $this->ProcAbsPath=$_SESSION["ProcAbsPath"]; //default
                echo "r Script Path non corretto. Impostato default. ", $this->ProcAbsPath, "<br>";
            }
  
            // OutputAbsPath
            if (isset($this->OutputAbsPath)){
                // R script output path esistenza  
                if(!file_exists($this->OutputAbsPath) || !is_dir($this->OutputAbsPath)){
                    $FsManager = new FSM();
                    if($FsManager->makeFolder($this->OutputAbsPath)){
                        echo "r Script output Path creato.", "<br>";
                    }else{
                        $this->OutputAbsPath=$_SESSION["OutputAbsPath"]; //default
                        echo "r Script output Path non creato correttamente. Impostato default.", "<br>";
                        }
                }else{
                    $this->OutputAbsPath=$this->OutputAbsPath; 
                    echo "r Script Output Path verificato.", $this->OutputAbsPath, "<br>";
                }
            }else{
                $this->OutputAbsPath=$_SESSION["OutputAbsPath"]; //default
                echo "r Script output Path non corretto. Impostato default.", "<br>";
            }

            // ProcNam
            if (isset($this->ProcNam)){
                // R script esistenza leggibile 
                $this->ProcPathFileName=$this->ProcAbsPath . $this->ProcNam;
                if(!file_exists($this->ProcPathFileName) || !is_readable($this->ProcPathFileName)){
                    // log R script name non impostato correttamente.
                    echo "R script Path Filename non disponibile.","<br>";
                    return FALSE;
                }else{
                    // $this->ProcNam=$this->ProcNam; 
                    echo "r Script Path Filename verificato. ",$this->ProcPathFileName, "<br>";
                }
            }else{
                // log script name non impostato correttamente.
                echo "script name non impostato.","<br>";
                return FALSE;
            }
            
            // ProcParams
            if (isset($this->ProcParams)){
                echo "script params impostati.","<br>";
            }else{
                // log script params non impostati correttamente.
                echo "script params non impostati.","<br>";
                return FALSE;
            }
        
            return TRUE;

        } catch (Exception $e) {
            // LM::LogMessage("ERROR", $e);
            echo "errore in PhpRController->verifyParams: ". $e->getMessage() . "\n";
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function prepareParamsCSV()
    {
        /**
        */
        // throw new exception("prepareParamsCSV");
        try {
            $this->ProcParamsArray=array(
                "colNames"  => array("ProcNam","ProcAbsPath","OutputAbsPath","ProcParams"),
                "values"    => array($this->ProcNam,$this->ProcAbsPath,$this->OutputAbsPath,$this->ProcParams)
            );
            
            echo "numero righe ProcParamsArray: ", count($this->ProcParamsArray), "<br>";
            $CSVToFromJSON = new \DA\FsComponents\CSVToFromJSON();
            $outFilename = str_ireplace(".R", $_SESSION["fctParams"].$_SESSION["DatCSVFile"] ,$this->ProcNam);
            $this->ProcParamsCSVPathFilename =$this->OutputAbsPath.$outFilename;
            $CSVToFromJSON->arrayToCsv($this->ProcParamsArray, $this->ProcParamsCSVPathFilename, $delimiter = ';');
            // $cJ->csvFilePath=$this->OutputAbsPath;
            // $cJ->JsonToCsv(json_encode($ProcParamsArray));
            // $this->ProcParamsArrayJSON->json_encode($ProcParamsArray);
            echo "Parametri salvati: ". $this->ProcParamsCSVPathFilename . "<br>";

            return true;
        } catch (Exception $e) {
            // LM::LogMessage("ERROR", $e);
            // throw new exception("Exception ".$e->getCode()." Msg: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine());
            // log errore in PhpRController->prepareParamsCSV: $e->getMessage() . "\n"
            echo "errore in PhpRController->prepareParamsCSV: ". $e->getMessage() . "\n";
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function verifyOutputs()
    {
        /**
         * verifica che nel OutputAbsPath vi sia:
         * 1) <ProcNam>Outputs.csv_da" : tabella elenco file output prodotti in OutputAbsPath
         *          ??? Interpretata anche come segnale che l'elaborazione è terminata.
         *          outputFile: percorso assoluto del file output.
         * 2) verifica presenza degli output elencati in <ProcNam>Outputs.csv_da"
         *          Se qualcuno non presente log e informazione utente (no errore).
         * 3) ritorno all'interfaccia utente.
        */
        
        try {
            // echo gettype($this->output);
            // echo $this->output;

            // echo gettype($this->execStatus);
            // echo $this->execStatus;

            echo "execOutput: <br>".$this->execOutput."<br>";

            //verifica <ProcNam>Outputs.csv_da"
            // $outFilename = str_ireplace(".R", "_outputs.csv_da"" ,$this->ProcNam);
            // es rScriptPrototype_Sample01.R_outputs.csv_da"
            //    rScriptPrototype_Sample01.R_outputs.csv_da"
            // $outFilename = $this->ProcNam. "_outputs.csv_da"";
            $outFilename = $this->ProcNam. $_SESSION["fctOutput"].$_SESSION["DatCSVFile"];
            $this->ProcOutputsCSVPathFilename=$this->OutputAbsPath . $outFilename;
            echo "outFilename: ".$this->ProcOutputsCSVPathFilename."<br>";
            if(!file_exists($this->ProcOutputsCSVPathFilename) || !is_readable($this->ProcOutputsCSVPathFilename)){
                // log outputFile non trovato: outputFile.
                echo "elenco outputFile non trovato: ", $this->ProcOutputsCSVPathFilename, "<br>";
            }else{
                echo "elenco outputFile presente: ", $this->ProcOutputsCSVPathFilename, "<br>";
                // converti in array
                $CSVToFromJSON = new \DA\FsComponents\CSVToFromJSON();
                $outputsFiles=$CSVToFromJSON->csvToArray($this->ProcOutputsCSVPathFilename, $delimiter = ';');
                $y=0;
                foreach($outputsFiles as $outputFile){
                    echo"riga: ".$y."<br>";
                    $of=(string)$outputFile[1];
                    if($of!=="url"){
                        echo "outputFile[1]: ".$of."<br>";

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
                if($CSVToFromJSON->arrayToCsv($outputsFiles, $this->ProcOutputsCSVPathFilename, $delimiter = ';')){
                    // log ProcOutputsCSVPathFilename aggiornato: 
                    echo "ProcOutputsCSVPathFilename aggiornato", "<br>";
                }else{
                    // log ProcOutputsCSVPathFilename NON aggiornato: 
                    echo "ProcOutputsCSVPathFilename NON aggiornato", "<br>";
                }
            }
        } catch (Exception $e) {
            echo "errore in PhpRController->verifyOutputs: ". $e->getMessage() . "\n";
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // public function execRScript()
    // {
    //     // $this->buildProcParams($ProcParams);
    //     // $this->cleanOutputFolder('OK');
    //     // exec('Rscript ' . $this->rScriptPath . '/' . $this->rScript . $this->ProcParams, $this->output, $this->execStatus);
    //     // exec($this->ProcAbsPath . '/' . $this->ProcNam , $this->output, $this->execStatus);
    //     exec($this->ProcAbsPath . '/' . $this->ProcNam);

    //     // exec('Rscript ' . $this->ProcAbsPath . '/' . $this->ProcNam);
    //     // $this->buildHtml($ProcParams);
    //     // return $this->htmlStream;
    // }

    // public function buildProcParams(string $ProcParams)
    // {
    //     $this->ProcParams = ' '
    //     . $this->outputFolder . ' '
    //     . $this->rScriptsFolder . ' '
    //     ;
    //     // se $ProcParams non nullo, non vuoto
    //     // split su carattere ''
    //     return $this->ProcParams;
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
    //     $files = glob($this->outputFolder . '/' . $this->ProcNam . '*');
    //     foreach ($files as $file) {
    //         if (is_file($file)) {
    //             unlink($file);
    //         }
    //     }
    // }


}
