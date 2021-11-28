<?php

namespace DA\HtmlComponents\Cntx;

use DA\HtmlComponents\ContentBuilder;

include_once("DA/HtmlComponents/ContentBuilder.php");

class Read extends ContentBuilder
{
    // parametri specifici
    // protected string $IdCntx = '';

    public function __construct(string $Param = "OK")    {
        $this->SetDefaults($Param);
    }

    protected function SetDefaults(string $Param)
    {
        try {
            // default parametri specifici
            // $this->IdCntx = '';
        
            // set contentParams
            $this->SetBasicParams($Param);

            // parametri specifici
            // if (isset($_SESSION["ContentParams2matrix"])) {
            //     $ContentParams = $_SESSION["ContentParams2matrix"];
            //     $this->IdCntx = isset($ContentParams[$Param]["IdCntx"]) ? $ContentParams[$Param]["IdCntx"] : "";
            // }
            // echo $this->IdPrj;
             return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
}
