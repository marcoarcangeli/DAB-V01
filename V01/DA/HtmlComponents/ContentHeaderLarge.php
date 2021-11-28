<?php

namespace DA\HtmlComponents;

include_once('DA\HtmlComponents\IHtmlComponent.php');

use DA\Logs\LogManager as LM;

class contentHeaderLarge implements IHtmlComponent
{
    // protected string $HtmlPathFn;
    protected string $HtmlStream;

    public function __construct(string $Param = "OK")    {
        // $this->HtmlPathFn=get_class($this).'.Html';
        // $this->HtmlStream=file_get_contents($this->HtmlPathFn);
        $this->BuildHtml($Param);

    }
    
    public function Html(string $Params)
    {
        // $this->HtmlStream ='<div>'.$Param.'</div>';
        return $this->HtmlStream;
    }
    
    protected function BuildHtml(string $Params)
    {
        $ParamsArray=explode($_SESSION["StringParamsSep"], $_SESSION["ContentHeaderParams"]);

        $this->HtmlStream='
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">'.$ParamsArray[0].'</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">link1</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        ';
    }
}


?>

