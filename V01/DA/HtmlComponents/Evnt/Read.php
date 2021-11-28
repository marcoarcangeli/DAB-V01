<?php

namespace DA\HtmlComponents\Evnt;

use DA\HtmlComponents\ContentBuilder;

include_once("DA/HtmlComponents/ContentBuilder.php");

class Read extends ContentBuilder
{
    // parametri specifici
    // protected string $IdEvnt = '';

    public function __construct(string $Param = "OK")    {
        $this->SetDefaults($Param);
    }

    protected function SetDefaults(string $Param)
    {
        try {
            // default parametri specifici
            // $this->IdEvnt = '';
        
            // set contentParams
            $this->SetBasicParams($Param);

            // parametri specifici
            // if (isset($_SESSION["ContentParams2matrix"])) {
            //     $ContentParams = $_SESSION["ContentParams2matrix"];
            //     $this->IdEvnt = isset($ContentParams[$Param]["IdEvnt"]) ? $ContentParams[$Param]["IdEvnt"] : "";
            // }
            // echo $this->IdPrj;
             return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
}
