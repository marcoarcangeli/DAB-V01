<?php

namespace DA\HtmlComponents\Log;

use DA\HtmlComponents\ContentBuilder;

include_once("DA/HtmlComponents/ContentBuilder.php");

class FileTlist extends ContentBuilder
{
    // parametri specifici
    protected string $IdPrj;
    protected string $LogAbsPath;
    protected string $LogRelPath;
    protected string $RelBaseFolder;

    public function __construct(string $Param = "OK")    {
        $this->SetDefaults($Param);
    }

    protected function SetDefaults(string $Param)
    {
        try {
            // default parametri specifici
            $this->LogAbsPath  =$_SESSION["LogAbsPath"];
            $this->RelBaseFolder=$_SESSION["RelBaseFolder"];
            $this->LogRelPath  =$_SESSION["LogRelPath"];

            // set contentParams
            $this->SetBasicParams($Param);
            
            // parametri specifici
            if (isset($_SESSION["ContentParams2matrix"])) {
                $ContentParams = $_SESSION["ContentParams2matrix"];

                $this->IdPrj = isset($ContentParams[$Param]["IdPrj"]) ? $ContentParams[$Param]["IdPrj"] : "";
            }
            return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

}
