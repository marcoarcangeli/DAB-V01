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
    protected string $PageLength                    = '20'; //default for Tlists
    protected string $CompulsoryFields              = '';
    protected string $InRefs                        = '';
    protected string $FSels                         = '';
    protected string $SetFs                         = '';
    protected string $UIFs                          = '';
    // SrvOp params
    protected string $FE                            = '';
    protected string $FV                            = '';
    protected string $FEFs                          = '';
    protected string $DEs                           = '';
    protected string $DEsA                          = ''; // Descriptive Entities Alias
    protected string $DEFs                          = '';
    protected string $EFs                           = '';
      
    protected string $PanelType                     = '';
    // calculated params
    protected string $FEIdNam                       = '';
    protected string $WhoIAm                        = '';
    protected string $PanelTag                      = '';
    protected string $PanelBtnsNam                  = '';
    protected string $JSPanelNamSpace               = '';
    protected string $ClientOps                     = '';
    // paneltype specific params
    protected string $TlistColumnsJS                = '';
    protected string $TlistColumnDefsJS             = '';
    //OBSOLETE
    protected string $CompulsoryParamNams           = '';
    protected string $ParamNams                     = '';
    protected string $SaveParamNams                 = '';

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
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - SESSION[ContentCodePath] . this->HtmlFn: ".$_SESSION["ContentCodePath"] . $this->HtmlFn); }
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

                // Client params
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
                $this->PanelType            = isset($ContentParams[$Param]["PanelType"])            ? $ContentParams[$Param]["PanelType"]               : $this->PanelType;
                // InRefs: Input References - Coming References from other panels
                $this->InRefs               = isset($ContentParams[$Param]["InRefs"])               ? $ContentParams[$Param]["InRefs"]                  : $this->InRefs;
                // FSels: Fields Select - UI Fields edited as select drop-down box
                $this->FSels                = isset($ContentParams[$Param]["FSels"])                ? $ContentParams[$Param]["FSels"]                   : $this->FSels;
                // SrvOp params
                $this->FE                   = isset($ContentParams[$Param]["FE"])                   ? $ContentParams[$Param]["FE"]                      : $this->FE;
                $this->FV                   = isset($ContentParams[$Param]["FV"])                   ? $ContentParams[$Param]["FV"]                      : $this->FV;
                // calculated client params
                $this->FEIdNam              = !EN($this->FE)                                        ? $_SESSION["IdPrfx"].$this->FE                     : $this->FEIdNam;
                $this->WhoIAm               = $this->FE.$this->PanelType;
                $this->PanelTag             = $this->WhoIAm.$_SESSION["NamDefaultSep"];
                $this->PanelBtnsNam         = $this->WhoIAm.$_SESSION["PanelBtnsPostfix"];
                $this->JSPanelNamSpace      = $_SESSION["JSRootNamSpace"].$_SESSION["NamSpaceDefaultSep"].$this->WhoIAm;
                $this->ClientOps            = !EN($ClientOps=$this->getClientOps($this->PanelType)) ? $ClientOps                                        : $this->ClientOps;
                // Calculated SrvOp params
                $this->FEFs                 = !EN($this->FE)                                        ? $this->getFEFs($this->FE)                         : $this->FEFs;
                $this->DEs                  = !EN($DEs=$this->getDEs($this->FEFs,$this->FE))        ? $DEs                                              : $this->DEs;
                $this->DEFs                 = !EN($DEFs=$this->getDEFs($this->DEs))                 ? $DEFs                                             : $this->DEFs;
                $this->EFs                  = $this->FEFs.','.$this->DEFs;
                $this->SetFs                = !EN($SetFs=$this->getSetFs($this->FEFs,$this->InRefs))? $SetFs                                            : $this->SetFs;
                $this->UIFs                 = !EN($UIFs=$this->getUIFs($this->SetFs,$this->FEIdNam))? $UIFs                                             : $this->UIFs;
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->SetFs: ".$this->SetFs); }
                // panel type params
                $this->setPanelSpecificParams($this->PanelType);
                // OBSOLETE params Generalization step 1
                $this->CompulsoryParamNams  = isset($ContentParams[$Param]["CompulsoryParamNams"])  ? $ContentParams[$Param]["CompulsoryParamNams"]     : $this->CompulsoryParamNams;
                $this->ParamNams            = isset($ContentParams[$Param]["ParamNams"])            ? $ContentParams[$Param]["ParamNams"]               : $this->ParamNams;
                $this->SaveParamNams        = isset($ContentParams[$Param]["SaveParamNams"])        ? $ContentParams[$Param]["SaveParamNams"]           : $this->SaveParamNams;
                /*DEBUG*/

            }
            return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function getUIFs(string $SetFs,string $FEIdNam){
        try {
            if(!EN($SetFs)){
                $UIFs=$SetFs;
                if(!EN($FEIdNam)){
                    $_SESSION['tmp_FEIdNam']=$FEIdNam;
                    $UIFsArr = array_filter( 
                        explode($_SESSION["DefaultSep"], $SetFs), 
                        function( $v ) { 
                            return $v !== $_SESSION['tmp_FEIdNam']; 
                        } 
                    );
                    $_SESSION['tmp_FEIdNam']=null;
                    $UIFs=implode($_SESSION["DefaultSep"], $UIFsArr);
                } // else could be not defined and SetFs = FEFs
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - SetFs: ".$SetFs); }
                return $UIFs;
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - SetFs not defined!");
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function getSetFs(string $FEFs,string $InRefs){
        try {
            if(!EN($FEFs)){
                $SetFs=$FEFs;
                if(!EN($InRefs)){
                    $InRefsArr=explode($_SESSION["DefaultSep"], $InRefs);
                    foreach($InRefsArr as $InRef){
                        $_SESSION['tmp_InRef']=$InRef;
                        $SetFsArr = array_filter( 
                            explode($_SESSION["DefaultSep"], $SetFs), 
                            function( $v ) { 
                                return !($v==$_SESSION["IdPrfx"].$_SESSION['tmp_InRef'] || $v==$_SESSION['tmp_InRef'].$_SESSION["DEFNam"]); 
                            } 
                        );
                    }
                    $_SESSION['tmp_InRef']=null;
                    $SetFs=implode($_SESSION["DefaultSep"], $SetFsArr);
                } // else could be not defined and SetFs = FEFs
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - SetFs: ".$SetFs); }
                return $SetFs;
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - FEFs not defined!");
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    // from $_SESSION["FEsA"]; FEsA: Fundamental Entities Array
    /**
     *  FEsA = array(
     *     "alg"        => 'idAlg,idAlgState,idAlgCat,nam,descr,fileRefProc,CatTag'
     *     "algCat"     => 'idAlgCat,idAlgCatPar,nam,descr',
     *     ...    
     * );
     */
    public function getFEFs(string $TNam){
        try {
            if($TNam){
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - TNam: ".$TNam); }
                return $_SESSION["FEsACSCols"][array_search(strtolower($TNam), array_column($_SESSION["FEsA"], 'TNam'))];
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - TNam not defined!");
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    
    // 
    public function getClientOps(string $PanelType){
        try {
            if($PanelType){
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - PanelType: ".$PanelType); }
                return $_SESSION["KPTsClientOps"][array_search($PanelType, array_column($_SESSION["KPTs"], 'PanelType'))];
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - PanelType not defined!");
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    
    public function getDEs(string $FEFs, string $FE)
    {
        try {
            // query to insert record
            if(!is_null($FE)){
                $_SESSION['tmp_FE']=$FE;
                $DEs=array();
                if(!EN($FEFs)){
                    $DEs = array_map( 
                        function( $v ) { 
                            // return substr($v, 2, -1); // conventionally remove the first 2 characters 'Id'
                            return substr($v, 2); // conventionally remove the first 2 characters 'Id'
                        }, 
                        array_filter( 
                            explode($_SESSION["DefaultSep"], $FEFs), 
                            function( $v ) { 
                                return strtolower(substr($v, 0,2)) == strtolower($_SESSION["IdPrfx"]) 
                                && strtolower(substr($v, 2)) != strtolower($_SESSION['tmp_FE']); 
                            } 
                        )
                    );
                }else{
                    LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - FEFs not set!");
                    return false;
                }
                $_SESSION['tmp_FE']=null;
                return implode(',',$DEs);
            }else{
                LM::LogMessage("WARNING", 'FE not set!');
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    
    public function getDEFs(string $DEs)
    {
        try {
            $DEFs='';
            // $mapped = array_map('func', $values, array_keys($values));
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - DEs: ".$DEs); }
            if(!EN($DEs)){
              $DEsArr=explode(',',$DEs);
              $DEFs .= implode(',',
                array_map( 
                  function($v) { 
                    return  (in_array($_SESSION["DEFNam"], explode(',',$this->getFEFs($v))))? $v.$_SESSION["DEFNam"] : null; 
                  }, 
                  $DEsArr
                )
              );
            }
            return $DEFs;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    //  ex:
    // {"data": "IdProfileFeatureAuth"},
    // {"data": "IdProfile"},
    // {"data": "ProfileNam"},
    public function getTlistColumnsJS(string $EFs)
    {
        try {
            $TlistColumnsJS='';
            // $mapped = array_map('func', $values, array_keys($values));
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - DEs: ".$DEs); }
            if(!EN($EFs)){
              $EFsArr=explode(',',$EFs);
              $TlistColumnsJS .= implode(',',
                array_map( 
                  function($v) { 
                    return  '{"data": "'.$v.'"}'; 
                  }, 
                  $EFsArr
                )
              );
            }
            return $TlistColumnsJS;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    
    // STDs for column defs
    // ids      >> {"width": 7,"targets": 0},
    // *Nams    >> {"width": 20,"targets": 1},
    // others types and last col  >> none
    public function getTlistColumnDefsJS(string $EFs)
    {
        try {
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - EFs: ".$EFs); }
            if(!EN($EFs)){
                $EFsArr=explode(',',$EFs);
                $TlistColumnsJSArr =  
                    array_map( 
                        function($v,$k) { 
                            $w='';
                            if(substr($v, 0,2) == $_SESSION["IdPrfx"]){
                                $w='10';
                            }else if(substr($v, -3) == $_SESSION["DEFNam"]){
                                $w='150';
                            }
                            return  ($w!=='')?    '{"width": "'.$w.'","targets": '.$k.'}': null; 
                        }, 
                        $EFsArr,
                        array_keys($EFsArr)
                );
                $TlistColumnsJSArr = array_filter($TlistColumnsJSArr); // remove empty items
                if(count($TlistColumnsJSArr) == count($EFsArr)){
                    array_pop($TlistColumnsJSArr);  //remove the last element of the array
                }
            }
            return implode(',',$TlistColumnsJSArr);
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function setPanelSpecificParams(string $PanelType)
    {
        try {
            $result=true;
            if(!EN($PanelType)){
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - PanelType: ".$PanelType); }
                switch($PanelType){
                    case 'Tlist':
                        //  Tlist
                        $this->TlistColumnsJS       = !EN($TlistColumnsJS=$this->getTlistColumnsJS($this->EFs)) ? $TlistColumnsJS                              : $this->TlistColumnsJS;
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->TlistColumnsJS: ".$this->TlistColumnsJS); }
                        $this->TlistColumnDefsJS    = !EN($TlistColumnDefsJS=$this->getTlistColumnDefsJS($this->EFs)) ? $TlistColumnDefsJS                        : $this->TlistColumnDefsJS;
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->TlistColumnDefsJS: ".$this->TlistColumnDefsJS); }
                        break;
                    case 'Tree':

                        break;
                    case 'FileTlist':

                        break;
                    case 'Struct':

                        break;
                    case 'Read':

                        break;
                    case 'CatRead':

                        break;
                    case 'FileView':

                        break;
                    default:

                        break;
                }
            }
            // echo $output; // Print everything.
            return $result;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // obsolete
    // select Client ops according to PanelType: Tlist,FileTlist,Struct,Read,FileView,FileEdit		
    // protected function getClientOps(string $PanelType)
    // {
    //     try {
    //         $ClientOps='';
    //         if(!EN($PanelType)){
    //             switch($PanelType){
    //                 case 'Tlist':
    //                     $ClientOps='';
    //                     break;
    //                 case 'Tree':
    //                     $ClientOps='';
    //                     break;
    //                 case 'FileTlist':
    //                     $ClientOps='';
    //                     break;
    //                 case 'Struct':
    //                     $ClientOps='';
    //                     break;
    //                 case 'Read':
    //                     $ClientOps='';
    //                     break;
    //                 case 'CatRead':
    //                     $ClientOps='';
    //                     break;
    //                 case 'FileView':
    //                     $ClientOps='';
    //                     break;
    //                 default:
    //                     $ClientOps='';
    //                     break;
    //             }
    //         }
    //         // echo $output; // Print everything.
    //         return ClientOps;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

}