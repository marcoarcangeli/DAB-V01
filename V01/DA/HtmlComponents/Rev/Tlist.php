<?php

namespace DA\HtmlComponents\Rev;

use DA\HtmlComponents\ContentBuilder as CB;
use DA\Logs\LogManager as LM;


include_once("DA/HtmlComponents/ContentBuilder.php");

class Tlist extends CB
{
    // parametri specifici
    // protected string $IdRev = '';

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

            //     $this->IdRev = isset($ContentParams[$Param]["IdRev"]) ? $ContentParams[$Param]["IdRev"] : "";
            // }
             return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

}
