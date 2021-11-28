<?php

namespace DA\HtmlComponents;

include_once("DA/HtmlComponents/IHtmlJsComponent.php");
include_once('DA/Common/Common.php');

use DA\HtmlComponents\IHtmlJsComponent as IHJC;
use DA\Logs\LogManager as LM;
use function DA\Common\emptyOrNull as EN;

class ContentBuilder implements IHJC
{
    // protected string $HtmlPathFn;
    protected string $IdUsr = '';

    protected string $HtmlStream;
    protected string $JsStream;

    protected string $ContentTitle                  = '';
    protected string $Header                        = '';
    protected string $Col_Lg                        = '3';
    protected string $Col_H                         = 'h-100';
    protected string $Mode                          = '';
    protected string $Id                            = '';
    protected string $DetailPanels                  = '';
    protected string $RefPanels                     = '';
    protected string $ParentObj                     = '';
    protected string $ParentObjType                 = '';
    protected string $ParentObjFun                  = '';
    protected string $HtmlFn                        = '';
    protected string $JsFn                          = '';
    protected string $StructPanelFlag               = '';
    protected string $AllowedUploadFileExt          = '';
    protected string $PageLength                    = '20';
    protected string $CompulsoryFields              = '';
    protected string $CompulsoryParamNams           = '';
    protected string $ParamNams                     = '';
    protected string $SaveParamNams                 = '';
    protected string $Entity                        = '';
    protected string $PanelType                     = '';
    protected string $WhoIAm                        = '';
    protected string $PanelTag                      = '';
    protected string $PanelBtnsNam                  = '';
    protected string $JSPanelNamSpace               = '';

    public function __construct()
    {
        // Html file is included for editing purpose in Html editors
        // $this->HtmlPathFn=get_class($this).".Html";
        // $this->HtmlStream=file_get_contents($this->HtmlPathFn);
        // $this->SetDefaults("OK");
    }

    public function Html(string $Param)
    {
        try {
            $this->BuildHtml($Param);
            return $this->HtmlStream;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function Js(string $Param)
    {
        $this->BuildJs($Param);
        return $this->JsStream;
    }

    protected function BuildHtml(string $Param = "")
    {
        try {
            ob_start(); // Start output buffer capture.
            //valori di default
            // LM::LogMessage("INFO", $_SESSION["ContentCodePath"] . $this->HtmlFn);
            // if(!\DA\emptyOrNull($this->HtmlFn)){
            if(!EN($this->HtmlFn)){
                include($_SESSION["ContentCodePath"] . $this->HtmlFn); // Include your template.
                // include($_SESSION["ContentCodePath"] . "OpDatCat.Tlist.html.php"); // Include your template.
                $this->HtmlStream = ob_get_contents(); // This contains the output of yourtemplate.php
            }else{
                throw new exception("HtmlFn not set." . "\n");
            }
            ob_end_clean(); // Clear the buffer.
            // ob_clean ();
            // echo $output; // Print everything.
            return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    protected function BuildJs(string $Param = "")
    {
        try {
            ob_start(); // Start output buffer capture.
            //valori di default
            // LM::LogMessage("INFO", $_SESSION["ContentCodePath"] . $this->JsFn);
            // if(!\DA\emptyOrNull($this->JsFn)){
            if(!EN($this->JsFn)){
                include($_SESSION["ContentCodePath"] . $this->JsFn); // Include your template.
                // include($_SESSION["ContentCodePath"] . "OpDatCat.Tlist.js.php"); // Include your template.
                $this->JsStream = ob_get_contents(); // This contains the output of yourtemplate.php
            }else{
                throw new exception("JsFn not set." . "\n");
            }
            ob_end_clean(); // Clear the buffer.
            // ob_clean ();

            // echo $output; // Print everything.
            return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    protected function SetBasicParams(string $Param)
    {
        try {
            // default parametri specifici
            // $this->contentParam1 = '...';
            $this->IdUsr = $_SESSION["IdUsr"];

            // set contentParams from daNavigation.js
            if (isset($_SESSION["ContentParams2matrix"])) {
                $ContentParams = $_SESSION["ContentParams2matrix"];

                $this->IdUsr                = isset($ContentParams[$Param]["IdUsr"])                ? $ContentParams[$Param]["IdUsr"]                   : $this->IdUsr;
                $this->Header               = isset($ContentParams[$Param]["Header"])               ? $ContentParams[$Param]["Header"]                  : $this->Header;
                $this->Col_Lg               = isset($ContentParams[$Param]["Col_Lg"])               ? $ContentParams[$Param]["Col_Lg"]                  : $this->Col_Lg;
                $this->Col_H                = isset($ContentParams[$Param]["Col_H"])                ? $ContentParams[$Param]["Col_H"]                   : $this->Col_H;
                $this->Mode                 = isset($ContentParams[$Param]["Mode"])                 ? $ContentParams[$Param]["Mode"]                    : $this->Mode;
                $this->HtmlFn               = isset($ContentParams[$Param]["HtmlFn"])               ? $ContentParams[$Param]["HtmlFn"]                  : $this->HtmlFn;
                $this->JsFn                 = isset($ContentParams[$Param]["JsFn"])                 ? $ContentParams[$Param]["JsFn"]                    : $this->JsFn;
                $this->Id                   = isset($ContentParams[$Param]["Id"])                   ? $ContentParams[$Param]["Id"]                      : $this->Id;
                $this->DetailPanels         = isset($ContentParams[$Param]["DetailPanels"])         ? $ContentParams[$Param]["DetailPanels"]            : $this->DetailPanels;
                $this->RefPanels            = isset($ContentParams[$Param]["RefPanels"])            ? $ContentParams[$Param]["RefPanels"]               : $this->RefPanels;
                $this->ParentObj            = isset($ContentParams[$Param]["ParentObj"])            ? $ContentParams[$Param]["ParentObj"]               : $this->ParentObj;
                $this->ParentObjType        = isset($ContentParams[$Param]["ParentObjType"])        ? $ContentParams[$Param]["ParentObjType"]           : $this->ParentObjType;
                $this->ParentObjFun         = isset($ContentParams[$Param]["ParentObjFun"])         ? $ContentParams[$Param]["ParentObjFun"]            : $this->ParentObjFun;
                $this->StructPanelFlag      = isset($ContentParams[$Param]["StructPanelFlag"])      ? $ContentParams[$Param]["StructPanelFlag"]         : $this->StructPanelFlag;
                $this->AllowedUploadFileExt = isset($ContentParams[$Param]["AllowedUploadFileExt"]) ? $ContentParams[$Param]["AllowedUploadFileExt"]    : $this->AllowedUploadFileExt;
                $this->PageLength           = isset($ContentParams[$Param]["PageLength"])           ? $ContentParams[$Param]["PageLength"]              : $this->PageLength;
                $this->CompulsoryFields     = isset($ContentParams[$Param]["CompulsoryFields"])     ? $ContentParams[$Param]["CompulsoryFields"]        : $this->CompulsoryFields;
                $this->CompulsoryParamNams  = isset($ContentParams[$Param]["CompulsoryParamNams"])  ? $ContentParams[$Param]["CompulsoryParamNams"]     : $this->CompulsoryParamNams;
                $this->ParamNams            = isset($ContentParams[$Param]["ParamNams"])            ? $ContentParams[$Param]["ParamNams"]               : $this->ParamNams;
                $this->SaveParamNams        = isset($ContentParams[$Param]["SaveParamNams"])        ? $ContentParams[$Param]["SaveParamNams"]           : $this->SaveParamNams;
                $this->Entity               = isset($ContentParams[$Param]["Entity"])               ? $ContentParams[$Param]["Entity"]                  : $this->Entity;
                $this->PanelType            = isset($ContentParams[$Param]["PanelType"])            ? $ContentParams[$Param]["PanelType"]               : $this->PanelType;
                // calculated params
                $this->WhoIAm               = $this->Entity.$this->PanelType;
                $this->PanelTag             = $this->WhoIAm.$_SESSION["NamDefaultSep"];
                $this->PanelBtnsNam         = $this->WhoIAm.$_SESSION["PanelBtnsPostfix"];
                $this->JSPanelNamSpace      = $_SESSION["JSRootNamSpace"].$_SESSION["NamSpaceDefaultSep"].$this->WhoIAm;
                // $this->ClientOps            = getClientOps($this->PanelType);
                /*DEBUG*/

            }
            return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    // select Client ops according to PanelType: Tlist,FileTlist,Struct,Read,FileView,FileEdit		
    protected function getClientOps(string $PanelType)
    {
        try {
            $ClientOps='';
            if(!emptyOrNull($PanelType)){
                switch($PanelType){
                    case 'Tlist':
                        $ClientOps='';
                        break;
                    case 'Tree':
                        $ClientOps='';
                        break;
                    case 'FileTlist':
                        $ClientOps='';
                        break;
                    case 'Struct':
                        $ClientOps='';
                        break;
                    case 'Read':
                        $ClientOps='';
                        break;
                    case 'CatRead':
                        $ClientOps='';
                        break;
                    case 'FileView':
                        $ClientOps='';
                        break;
                    default:
                        $ClientOps='';
                        break;
                }
            }
            // echo $output; // Print everything.
            return ClientOps;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }


}
