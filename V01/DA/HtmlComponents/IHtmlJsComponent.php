<?php

namespace DA\HtmlComponents;

include_once('DA/HtmlComponents/IHtmlComponent.php');

interface IHtmlJsComponent extends IHtmlComponent
{
    // protected string $HtmlPathFn;
    // protected string $HtmlStream;

    public function Js(string $Param);
    
    
}

?>

