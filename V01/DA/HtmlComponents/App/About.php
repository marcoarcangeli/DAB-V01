<?php

namespace DA\HtmlComponents\App;

use DA\Logs\LogManager as LM;

class About 
{
    // protected string $HtmlPathFn;
    protected string $HtmlStream = "";
    protected string $JsStream = "";
    protected array $Objs = array();
    protected array $ObjsHeader = array();
    protected array $ObjsHeader1 = array();
    protected array $ObjsHeader2 = array();

    public function __construct(string $Param = "OK")    {

    }

    public function Html(string $Param)
    {
        try {
            // throw new exception("App Exception in ". __CLASS__."->". __FUNCTION__);

            if($this->BuildHtml($Param)){
                return $this->HtmlStream;
            }else{
                throw new exception("App Exception in ". __CLASS__."->". __FUNCTION__);
            }

        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function Js(string $Param)
    {
        try {
            if($this->BuildJs($Param)){
                return $this->JsStream;
            }else{
                throw new exception("App Exception in ". __CLASS__."->". __FUNCTION__);
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }

    }

    protected function BuildHtml(string $ClassName)
    {
        try {
            ob_start(); // Start output buffer capture.
            // include($_SESSION["ContentCodePath"]."Prj.read.html.php"); // Include your template.

            include($_SESSION["ContentCodePath"] . "About.html.php"); // Include your template.
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
            include($_SESSION["ContentCodePath"] . "About.js.php"); // Include your template.
            $this->JsStream = ob_get_contents(); // This contains the output of yourtemplate.php
            ob_end_clean(); // Clear the buffer.
            return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }

    }
}
