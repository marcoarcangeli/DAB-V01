<?php

namespace DA\HtmlComponents\Common;

use DA\HtmlComponents\ContentBuilder;

include_once("DA/HtmlComponents/ContentBuilder.php");

class toDo extends ContentBuilder
{
    // parametri specifici
    // protected string $IdPrj = '';
    // protected string $IdUsr = '';
    // protected string $PrjAbsPath = '';
    // protected string $CntxAbsPath = '';

    public function __construct(string $Param = "OK")    {
        // $this->SetDefaults($Param);
    }

    public function hello(){
        echo("Hello!<br>");
    }

}
