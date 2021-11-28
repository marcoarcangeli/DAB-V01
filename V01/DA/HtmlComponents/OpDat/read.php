<?php

namespace DA\HtmlComponents\OpDat;

use DA\HtmlComponents\ContentBuilder;

include_once("DA/HtmlComponents/ContentBuilder.php");

class read extends ContentBuilder
{
    // parametri specifici
    protected string $IdClean = '';
    protected string $PrjAbsPath = '';
    protected string $IdOpDat = '';
    protected string $IdOpDatCat = '';

    public function __construct(string $Param = "OK")
    {
        $this->SetDefaults($Param);
    }

    protected function SetDefaults(string $Param)
    {
        try {
            // default parametri specifici
            // $this->contentParam1 = '...';
            $this->IdClean = '';
            $this->PrjAbsPath = $_SESSION["PrjAbsPath"];
            $this->IdOpDat = '';
            $this->IdOpDatCat = '';

            // set contentParams
            $this->SetBasicParams($Param);

            if (isset($_SESSION["ContentParams2matrix"])) {
                $ContentParams = $_SESSION["ContentParams2matrix"];
                $this->IdClean = isset($ContentParams[$Param]["IdClean"]) ? $ContentParams[$Param]["IdClean"] : "";
            }
            // echo $this->IdClean;
             return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
}
