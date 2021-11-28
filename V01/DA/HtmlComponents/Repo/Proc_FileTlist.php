<?php

namespace DA\HtmlComponents\Repo;

use DA\HtmlComponents\ContentBuilder;

include_once("DA/HtmlComponents/ContentBuilder.php");

class Proc_FileTlist extends ContentBuilder
{
    // parametri specifici
    protected string $IdPrj;
    protected string $ProcAbsPath;
    protected string $ProcRelPath;
    protected string $RelBaseFolder;

    public function __construct(string $Param = "OK")    {
        $this->SetDefaults($Param);
    }

    protected function SetDefaults(string $Param)
    {
        try {
            // default parametri specifici
            $this->ProcAbsPath  =$_SESSION["ProcAbsPath"];
            $this->RelBaseFolder=$_SESSION["RelBaseFolder"];
            $this->ProcRelPath  =$_SESSION["ProcRelPath"];

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
