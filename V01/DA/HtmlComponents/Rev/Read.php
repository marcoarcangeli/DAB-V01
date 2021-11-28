<?php

namespace DA\HtmlComponents\Rev;

include_once("DA/HtmlComponents/ContentBuilder.php");

use DA\HtmlComponents\ContentBuilder as CB;

class Read extends CB
{
    // protected string $IdRev = '';
    // protected string $RevFullPath = '';

    public function __construct(string $Param = "OK")    {
        $this->SetDefaults($Param);
    }

    protected function SetDefaults(string $Param)
    {
        try {
            // default parametri specifici
            // $this->IdRev = '';
            // $this->IdRevState = "Usr_" . $_SESSION("#IdUsr").val() + "_Rev_" + $("#Rev_IdRev").val();

            // set contentParams
            $this->SetBasicParams($Param);

            // parametri specifici
            // if (isset($_SESSION["ContentParams2matrix"])) {
            //     $ContentParams = $_SESSION["ContentParams2matrix"];

            //     $this->IdRev        = isset($ContentParams[$Param]["IdRev"])        ? $ContentParams[$Param]["IdRev"] : "";
            //     $this->IdRevState   = isset($ContentParams[$Param]["IdRevState"])   ? $ContentParams[$Param]["IdRevState"] : "";
            // }
             return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
}
