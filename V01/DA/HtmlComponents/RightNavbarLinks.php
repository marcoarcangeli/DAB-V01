<?php

namespace DA\HtmlComponents;

// include_once('DA\HtmlComponents\IHtmlComponent.php');
include_once('DA\HtmlComponents\IHtmlJsComponent.php');

use DA\Logs\LogManager as LM;
// use DA\HtmlComponents\IHtmlComponent as IHC;
use DA\HtmlComponents\IHtmlJsComponent as IHJC;


class RightNavbarLinks implements IHJC
{
    protected string $HtmlPathFn;
    protected string $HtmlStream;

    public function __construct(string $Param = "OK")    {
        // costruttore    
    }

    public function Html(string $Param)
    {
        try {
            $this->BuildHtml($Param);
            return $this->HtmlStream;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function Js(string $Param)
    {
      try {
        $this->BuildJs($Param);
        return $this->JsStream;
      } catch (Exception $e) {
        LM::LogMessage("ERROR", $e);
        return false;
      }
    }
  
    protected function BuildHtml(string $Param)
    {
        try {

            ob_start(); // Start output buffer capture.
            if ($_SESSION["Cache"] == "False") {
                ob_clean();
            }

            //valori di default

            include($_SESSION["ContentCodePath"] . "RightNavbarLinks.Html.php"); // Include your template.
            $this->HtmlStream = ob_get_contents(); // This contains the output of yourtemplate.php
            ob_end_clean(); // Clear the buffer.
            // ob_clean ();

            // echo $output; // Print everything.
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    protected function BuildJs(string $Param)
    {
      // $this->HtmlStream ='<div>'.$Param.'</div>';
      try {
  
        ob_start(); // Start output buffer capture.
        if ($_SESSION["Cache"] == "False") {
          ob_clean();
        }
        //valori di default
  
        include($_SESSION["ContentCodePath"] . "RightNavbarLinks.js.php"); // Include your template.
        $this->JsStream = ob_get_contents(); // This contains the output of yourtemplate.php
        ob_end_clean(); // Clear the buffer.
        // ob_clean ();
  
        // echo $output; // Print everything.
      } catch (Exception $e) {
        LM::LogMessage("ERROR", $e);
        return false;
      }
    }
  
}
