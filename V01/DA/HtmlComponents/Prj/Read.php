<?php

namespace DA\HtmlComponents\Prj;

use DA\HtmlComponents\ContentBuilder;

include_once("DA/HtmlComponents/ContentBuilder.php");

class read extends ContentBuilder
{
    // protected string $IdPrj = '';
    // protected string $PrjFullPath = '';

    public function __construct(string $Param = "OK")    {
        $this->SetDefaults($Param);
    }

    protected function SetDefaults(string $Param)
    {
        try {
            // default parametri specifici
            // $this->IdPrj = '';
            // $this->IdPrjState = "Usr_" . $_SESSION("#IdUsr").val() + "_Prj_" + $("#Prj_IdPrj").val();

            // set contentParams
            $this->SetBasicParams($Param);

            // parametri specifici
            // if (isset($_SESSION["ContentParams2matrix"])) {
            //     $ContentParams = $_SESSION["ContentParams2matrix"];

            //     $this->IdPrj        = isset($ContentParams[$Param]["IdPrj"])        ? $ContentParams[$Param]["IdPrj"] : "";
            //     $this->IdPrjState   = isset($ContentParams[$Param]["IdPrjState"])   ? $ContentParams[$Param]["IdPrjState"] : "";
            // }
             return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
}
