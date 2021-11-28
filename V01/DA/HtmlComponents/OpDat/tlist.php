<?php

namespace DA\HtmlComponents\OpDat;

use DA\HtmlComponents\ContentBuilder;

include_once("DA/HtmlComponents/ContentBuilder.php");

class Tlist extends ContentBuilder
{
    // parametri specifici
    protected string $IdUsr = '';
    protected string $IdClean = '';

    public function __construct(string $Param = "OK")    {
        $this->SetDefaults($Param);
    }

    protected function SetDefaults(string $Param)
    {
        try {
            //valori di default 
            $this->IdUsr = $_SESSION["IdUsr"];

            // set contentParams
            $this->SetBasicParams($Param);

            // parametri specifici
            if (isset($_SESSION["ContentParams2matrix"])) {
                $ContentParams = $_SESSION["ContentParams2matrix"];

                $this->IdClean = isset($ContentParams[$Param]["IdClean"]) ? $ContentParams[$Param]["IdClean"] : "";
            }
            // echo $this->Mode;
             return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
}
