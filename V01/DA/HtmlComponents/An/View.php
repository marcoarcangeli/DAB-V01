<?php

namespace DA\HtmlComponents\An;

use DA\HtmlComponents\ContentBuilder;

include_once("DA/HtmlComponents/ContentBuilder.php");

class View extends ContentBuilder
{
    // protected string $IdAn = '';
    // protected string $IdAnState = '';

    public function __construct(string $Param = "OK")    {
        $this->SetDefaults($Param);
    }

    protected function SetDefaults(string $Param)
    {
        try {
            // default parametri specifici
            // $this->IdAn = '';
            // $this->IdAnState = '';

            // set contentParams
            $this->SetBasicParams($Param);

            // parametri specifici
            // if (isset($_SESSION["ContentParams2matrix"])) {
            //     $ContentParams = $_SESSION["ContentParams2matrix"];

            //     $this->IdAn        = isset($ContentParams[$Param]["IdAn"])        ? $ContentParams[$Param]["IdAn"] : "";
            //     $this->IdAnState   = isset($ContentParams[$Param]["IdAnState"])   ? $ContentParams[$Param]["IdAnState"] : "";
            // }
             return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
}
