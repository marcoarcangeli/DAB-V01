<?php

namespace DA\HtmlComponents\AlgState;

use DA\HtmlComponents\ContentBuilder;

include_once("DA/HtmlComponents/ContentBuilder.php");

class read extends ContentBuilder
{
    // parametri specifici
    // protected string $IdPrj = '';

    public function __construct(string $Param = "OK")    {
        $this->SetDefaults($Param);
    }

    protected function SetDefaults(string $Param)
    {
        try {
            // default parametri specifici
            // $this->contentParam1 = '...';

            // set contentParams
            $this->SetBasicParams($Param);

            // parametri specifici
            // if (isset($_SESSION["ContentParams2matrix"])) {
            //     $ContentParams = $_SESSION["ContentParams2matrix"];

            //     $this->IdPrj =     $ContentParams[$Param]["IdPrj"];
            // }
             return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
}
