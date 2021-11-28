<?php

namespace DA\HtmlComponents;

include_once('DA\HtmlComponents\IHtmlJsComponent.php');
include_once('DA\Logs\LogManager.php');

use DA\Logs\LogManager as LM;
use DA\HtmlComponents\IHtmlJsComponent as IHJC;

class SidebarMenu implements IHJC
{
  // protected string $HtmlPathFn;
  protected string $HtmlStream;

  public function __construct()
  {
    // $this->HtmlPathFn=get_class($this).'.Html';
    // $this->HtmlStream=file_get_contents($this->HtmlPathFn);
    // $this->BuildHtml('OK');
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

      include($_SESSION["ContentCodePath"] . "SidebarMenu.html.php"); // Include your template.
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

      include($_SESSION["ContentCodePath"] . "SidebarMenu.js.php"); // Include your template.
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
