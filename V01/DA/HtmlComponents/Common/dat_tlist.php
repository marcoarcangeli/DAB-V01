<?php

namespace DA\HtmlComponents\Common;

use DA\HtmlComponents\ContentBuilder;

include_once("DA/HtmlComponents/ContentBuilder.php");

class dat_Tlist extends ContentBuilder
{
    // parametri specifici

    // set contentParams
    protected string $Fn = '';
    protected string $FileAbsPath;
    protected string $FileRelPath;
    protected string $RelBaseFolder;
    protected string $PrjAbsPath;

    public function __construct(string $Param = "OK")    {
        $this->SetDefaults($Param);
    }

    protected function SetDefaults(string $Param)
    {
        try {
            // default parametri specifici
            $this->Fn = '';
            $this->FileAbsPath=$_SESSION["FileAbsPath"];
            $this->RelBaseFolder=$_SESSION["RelBaseFolder"];
            $this->FileRelPath=$_SESSION["FileRelPath"];
            $this->PrjAbsPath=$_SESSION["PrjAbsPath"];

            // set contentParams
            $this->SetBasicParams($Param);

            // parametri specifici
            if (isset($_SESSION["ContentParams2matrix"])) {
                $ContentParams = $_SESSION["ContentParams2matrix"];

                $this->Fn = isset($ContentParams[$Param]["Fn"]) ? $ContentParams[$Param]["Fn"] : "";
            }
            // echo $this->Mode;
             return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
}
