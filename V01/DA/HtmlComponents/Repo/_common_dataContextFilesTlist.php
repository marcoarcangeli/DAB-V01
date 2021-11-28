<?php

namespace DA\HtmlComponents\repo;

use DA\HtmlComponents\ContentBuilder;

include_once("DA/HtmlComponents/ContentBuilder.php");

class dataCntxFilesTlist extends ContentBuilder
{
    // parametri specifici
    protected string $IdPrj;
    protected string $CntxAbsPath;
    protected string $CntxRelPath;
    protected string $RelBaseFolder;

    public function __construct(string $Param = "OK")    {
        $this->SetDefaults($Param);
    }

    protected function SetDefaults(string $Param)
    {
        try {
            // default parametri specifici
            $this->CntxAbsPath=$_SESSION["CntxAbsPath"];
            $this->RelBaseFolder=$_SESSION["RelBaseFolder"];
            $this->CntxRelPath=$_SESSION["CntxRelPath"];

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
