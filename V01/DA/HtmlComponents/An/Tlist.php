<?php

namespace DA\HtmlComponents\An;

use DA\HtmlComponents\ContentBuilder;
use DA\Logs\LogManager as LM;


include_once("DA/HtmlComponents/ContentBuilder.php");

class Tlist extends ContentBuilder
{
    // parametri specifici
    // protected string $IdAn = '';

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

            //     $this->IdAn = isset($ContentParams[$Param]["IdAn"]) ? $ContentParams[$Param]["IdAn"] : "";
            // }
             return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

}
