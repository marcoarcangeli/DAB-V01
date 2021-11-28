<?php

namespace DA\HtmlComponents;

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\IHtmlJsComponent as IHJC;

class GridAccordion implements IHJC
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
        $ContentHeaderParams = $_SESSION["ContentHeaderParams"];
        $ContentHeaders1matrix = $_SESSION["ContentHeaders1matrix"];
        $ContentClass2matrix = $_SESSION["ContentClass2matrix"];
        $ContentHeaders2matrix = $_SESSION["ContentHeaders2matrix"];

        foreach ($ContentClass2matrix as $Row) {
            $RowObjs = array();
            foreach ($Row as $Field) {
                include_once($Field . '.php');
                $Obj = new $Field();
                array_push($RowObjs, $Obj);
            }
            array_push($this->Objs, $RowObjs);
        }

        $this->ObjsHeader2 = $ContentHeaders2matrix;
        $this->ObjsHeader1 = $ContentHeaders1matrix;
        $this->ObjsHeader = $ContentHeaderParams;
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
            // throw new exception("Exception ".$e->getCode()." Msg: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine());

            ob_start(); // Start output buffer capture.
            // include($_SESSION["ContentCodePath"]."Prj.read.html.php"); // Include your template.
            if ($_SESSION["Cache"] == "False") {ob_clean();}

            include($_SESSION["ContentCodePath"] . "GridAccordion.html.php"); // Include your template.
            // ob_clean ();

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
            if ($_SESSION["Cache"] == "False") {ob_clean();}

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
