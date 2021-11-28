<?php

namespace DA\PhpRComponents;

use DA\PhpRComponents;

// includi componenti utili
// . DAO per leggere menu da db
// . menu item
// include_once('DA\HtmlComponents\card.php');

class samplePhpRClass
{
    protected string $rScriptPath;
    protected string $rScriptName;
    protected string $rScriptParams;
    protected string $outputFolder;
    protected array $output;
    protected array $execStatus;

    public function __construct(string $param = "OK")    {
        $this->rScriptFolder = 'rScripts';
        $this->rScriptParams = '';
        $this->rScriptName = get_class($this) . 'R';
        $this->outputFolder = 'output';
        $this->output = array();
        $this->execStatus = "OK";

    }

    public function html(string $param)
    {
        // $this->htmlStream ='<div>'.$param.'</div>';
        return $this->htmlStream;
    }

    public function execRScript(string $rScriptParams)
    {
        $this->buildRScriptParams($rScriptParams);
        $this->cleanOutputFolder('OK');
        exec('Rscript ' . $this->rScriptPath . '/' . $this->rScript . $this->rScriptParams, $this->output,  $this->execStatus);
        $this->buildHtml($rScriptParams);
        // return $this->htmlStream;
    }

    public function buildRScriptParams(string $rScriptParams)
    {
        $this->rScriptParams = ' '
        . $this->outputFolder . ' '
        . $this->rScriptsFolder . ' '
        ;
        // se $rScriptParams non nullo, non vuoto
        // split su carattere ''
        return $this->rScriptParams;
    }

    protected function buildHtml(string $param)
    {
        $this->htmlStream = '
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div><img src="output/test.png"></div>
                                <div><img src="output/test01.png"></div>
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-lg-6">';
        // elenco file di output
        $files = scandir('./output/');
        sort($files);
        foreach ($files as $file) {
            $this->htmlStream .= '<a href="output/' . $file . '">' . $file . '</a><br>';
        }

        $this->htmlStream .= '
                            </div>
                            <!-- /.col-md-6 -->
                        </div>
                        <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                <!-- /.content -->
            ';
    }

    protected function cleanOutputFolder(string $param)
    {
        // elimina i file nel outputPath
        $files = glob($this->outputFolder . '/' . $this->rScriptName . '*');
        foreach ($files as $file) {
            if (is_file($file))
                unlink($file);
        }
    }
}
