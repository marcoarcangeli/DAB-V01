<?php

namespace DA\HtmlComponents;

include_once("DA/HtmlComponents/ContentBuilder.php");

use DA\HtmlComponents\ContentBuilder as CB;
use DA\Logs\LogManager as LM;


class contentHeader extends CB
{
    // parametri specifici
    // protected string $IdPrj = '';

    public function __construct(string $Param = "OK")
    {
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

            //     $this->IdPrj =     $ContentParams[$Param]["IdPrj"];
            // }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
}


?>

