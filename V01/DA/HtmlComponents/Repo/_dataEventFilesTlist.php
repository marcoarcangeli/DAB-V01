<?php

namespace DA\HtmlComponents\repo;

use DA\HtmlComponents\ContentBuilder;

include_once("DA/HtmlComponents/ContentBuilder.php");

class dataEvntFilesTlist extends ContentBuilder
{
    // parametri specifici
    protected string $IdPrj;
    protected string $Dat_EvntAbsPath;
    protected string $Dat_EvntRelPath;
    protected string $RelBaseFolder;

    public function __construct(string $Param = "OK")    {
        $this->SetDefaults($Param);
    }

    protected function SetDefaults(string $Param)
    {
        try {
            // default parametri specifici
            $this->Dat_EvntAbsPath=$_SESSION["Dat_EvntAbsPath"];
            $this->RelBaseFolder=$_SESSION["RelBaseFolder"];
            $this->Dat_EvntRelPath=$_SESSION["Dat_EvntRelPath"];

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
