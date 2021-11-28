<?php

namespace DA\HtmlComponents;

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\IHtmlJsComponent as IHJC;

class GridVertical implements IHJC
{
    // protected string $HtmlPathFn;
    protected string $HtmlStream = "";
    protected string $JsStream = "";
    protected array $Objs = array();
    protected array $ObjsHeader = array();
    protected array $ObjsHeader1 = array();
    protected array $ObjsHeader2 = array();

    public function __construct(string $Param = "OK")    {
        // Html file is included for editing purpose in Html editors
        // $this->HtmlPathFn=get_class($this).'.Html';
        // $this->HtmlStream=file_get_contents($this->HtmlPathFn);

        // $ContentHeaderParams = $_SESSION["ContentHeaderParams"];
        // $ContentHeaders1matrix = $_SESSION["ContentHeaders1matrix"];
        $ContentClass2matrix = $_SESSION["ContentClass2matrix"];
        $ContentHeaders2matrix = $_SESSION["ContentHeaders2matrix"];

        $this->ObjsHeader2 = $ContentHeaders2matrix;

        $i=0;
        foreach ($ContentClass2matrix as $Row) {
            $RowObjs = array();
            $j=0;
            foreach ($Row as $Field) {
                include_once($Field . '.php');
                $Obj = new $Field($this->ObjsHeader2[$i][$j]);
                array_push($RowObjs, $Obj);
                $j+=1;
            }
            array_push($this->Objs, $RowObjs);
            $i+=1;
        }

        // LM::LogMessage("INFO", "var_dump: ",var_dump($this->Objs)); 

        // $this->ObjsHeader1 = $ContentHeaders1matrix;
        // $this->ObjsHeader = $ContentHeaderParams;

    }

    public function Html(string $ClassName)
    {
        $this->BuildHtml($ClassName);
        return $this->HtmlStream;
    }

    public function Js(string $Param)
    {
        $this->BuildJs($Param);
        return $this->JsStream;
    }

    protected function BuildHtml(string $ClassName)
    {
        try {
            ob_start(); // Start output buffer capture.
            // include($_SESSION["ContentCodePath"]."Prj.read.html.php"); // Include your template.
            // LM::LogMessage("INFO", $_SESSION["ContentCodePath"] . "GridVertical.html.php");

            include($_SESSION["ContentCodePath"] . "GridVertical.html.php"); // Include your template.
            $this->HtmlStream = ob_get_contents(); // This contains the output of yourtemplate.php
            ob_end_clean(); // Clear the buffer.
            
             return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    protected function BuildJs(string $Param)
    {
        try {
            ob_start(); // Start output buffer capture.
            // include($_SESSION["ContentCodePath"]."Prj.read.html.php"); // Include your template.
            // $this->JsStream="";
            include($_SESSION["ContentCodePath"] . "Common.MultiJs2D.js.php"); // Include your template.
            $this->JsStream = ob_get_contents(); // This contains the output of yourtemplate.php
            ob_end_clean(); // Clear the buffer.
            
             return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

}
