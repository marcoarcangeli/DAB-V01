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
    protected string $TlistOrder                    = 'asc'; //default for Tlists
    protected string $CompulsoryFields              = '';
    protected string $InRefs                        = '';
    protected string $FSels                         = '';
    protected array  $FSelsSrvOpParams              = array();
    protected array  $VParams                       = array(); // View Params optional
    protected string $SetFs                         = '';
    protected string $UIFs                          = '';
    // SrvOp params
    protected string $FE                            = '';
    protected string $FV                            = '';
    protected string $VNam                          = '';
    protected string $FEFs                          = '';
    protected string $DEs                           = '';
    protected string $DEsA                          = ''; // Descriptive Entities Alias
    protected string $DEFs                          = '';
    protected string $EFs                           = '';
    // DbView Params
    protected string $VEs                           = '';
    protected string $VCSCols                       = '';
    protected string $VEFs                          = '';
    protected string $GroupBy                       = '';
    protected string $GFs                           = '';
    // code derived 
    protected string $FVJsDecl                      = '';
    protected string $FMJs                          = '';
    // others
    protected string $PanelType                     = '';
    // calculated params
    protected string $FEIdNam                       = '';
    protected string $WhoIAm                        = '';
    protected string $PanelTag                      = '';
    protected string $PanelBtnsNam                  = '';
    protected string $JSPanelNamSpace               = '';
    protected string $ClientOps                     = '';
    protected string $InRefsJs                      = '';
    protected string $InRefsNamsHTML                = '';
    protected string $InRefsIdsHTML                 = '';
    // paneltype specific params 
    protected string $TlistDataTblNam               = '';
    protected string $TlistColumnsJS                = '';
    protected string $TlistColumnsHTML              = '';
    protected string $TlistColumnDefsJS             = '';
    protected string $TreeObjNam                    = '';
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
                $this->TlistOrder           = isset($ContentParams[$Param]["TlistOrder"])           ? $ContentParams[$Param]["TlistOrder"]              : $this->TlistOrder;
                $this->CompulsoryFields     = isset($ContentParams[$Param]["CompulsoryFields"])     ? $ContentParams[$Param]["CompulsoryFields"]        : $this->CompulsoryFields;
                $this->PanelType            = isset($ContentParams[$Param]["PanelType"])            ? $ContentParams[$Param]["PanelType"]               : $this->PanelType;
                // InRefs: Input References - Coming References from other panels
                $this->InRefs               = isset($ContentParams[$Param]["InRefs"])               ? $ContentParams[$Param]["InRefs"]                  : $this->InRefs;
                // FSels: Fields Select - UI Fields edited as select drop-down box
                $this->FSels                = isset($ContentParams[$Param]["FSels"])                ? $ContentParams[$Param]["FSels"]                   : $this->FSels;
                $this->FSelsSrvOpParams     = !EN($FSelsSrvOpParams=$this->setFSelsSrvOpParams($this->FSels))   ? $FSelsSrvOpParams                     : $this->FSelsSrvOpParams;
                // SrvOp params
                $this->FE                   = isset($ContentParams[$Param]["FE"])                   ? $ContentParams[$Param]["FE"]                      : $this->FE;
                $this->FV                   = isset($ContentParams[$Param]["FV"])                   ? $ContentParams[$Param]["FV"]                      : $this->FV;
                // View Params 
                $this->VNam                 = isset($ContentParams[$Param]["VNam"])                 ? $ContentParams[$Param]["VNam"]                    : $this->VNam;
                $this->setVParams($this->VNam);
                // calculated client params
                $this->FEIdNam              = !EN($this->FE)                                        ? $_SESSION["IdPrfx"].$this->FE                     : $this->FEIdNam;
                $this->WhoIAm               = $this->FE.$this->PanelType;
                $this->PanelTag             = $this->WhoIAm.$_SESSION["NamDefaultSep"];
                $this->PanelBtnsNam         = $this->WhoIAm.$_SESSION["PanelBtnsPostfix"];
                $this->JSPanelNamSpace      = $_SESSION["JSRootNamSpace"].$_SESSION["NamSpaceDefaultSep"].$this->WhoIAm;
                $this->ClientOps            = !EN($ClientOps=$this->getClientOps($this->PanelType, $this->ParentObjType)) ? $ClientOps                  : $this->ClientOps;
                // Calculated SrvOp params
                $this->FEFs                 = !EN($FEFs=$this->getFEFs($this->FE))                  ? $FEFs                                             : $this->FEFs;
                $this->DEs                  = !EN($DEs=$this->getDEs($this->FEFs,$this->FE,$this->VEs)) ? $DEs                                          : $this->DEs;
                $this->DEFs                 = !EN($DEFs=$this->getDEFs($this->DEs))                 ? $DEFs                                             : $this->DEFs;
                $this->VEFs                 = !EN($VEFs=$this->getVEFs($this->VEs,$this->DEFs))     ? $VEFs                                             : $this->VEFs;
                // $this->EFs                  = !EN($this->DEFs)                                      ? $this->FEFs.','.$this->DEFs                       : $this->FEFs;
                $this->EFs                  = !EN($EFs=$this->getEFs($FEFs,$VEFs,$VFs))             ? $EFs                                              : $this->EFs;
                $this->SetFs                = !EN($SetFs=$this->getSetFs($this->FEFs,$this->InRefs))? $SetFs                                            : $this->SetFs;
                $this->UIFs                 = !EN($UIFs=$this->getUIFs($this->SetFs,$this->FEIdNam))? $UIFs                                             : $this->UIFs;
                // panel type params
                $this->setPanelSpecificParams($this->PanelType);
                // code building
                $this->FVJsDecl             = !EN($FVJsDecl=$this->getFVJsDecl($this->FV))          ? $FVJsDecl                                         : $this->FVJsDecl;
                $this->FMJs                 = !EN($FMJs=$this->getFMJs($this->FV))                  ? $FMJs                                             : $this->FMJs;
                $this->InRefsNamsHTML       = !EN($InRefsNamsHTML=$this->getInRefsNamsHTML($this->InRefs)) ? $InRefsNamsHTML                            : $this->InRefsNamsHTML;
                $this->InRefsIdsHTML        = !EN($InRefsIdsHTML=$this->getInRefsIdsHTML($this->InRefs))   ? $InRefsIdsHTML                             : $this->InRefsIdsHTML;
                $this->InRefsJs             = !EN($InRefsJs=$this->getInRefsJs($this->InRefs))      ? $InRefsJs                                         : $this->InRefsJs;
                
                // OBSOLETE params Generalization step 1
                $this->CompulsoryParamNams  = isset($ContentParams[$Param]["CompulsoryParamNams"])  ? $ContentParams[$Param]["CompulsoryParamNams"]     : $this->CompulsoryParamNams;
                $this->ParamNams            = isset($ContentParams[$Param]["ParamNams"])            ? $ContentParams[$Param]["ParamNams"]               : $this->ParamNams;
                $this->SaveParamNams        = isset($ContentParams[$Param]["SaveParamNams"])        ? $ContentParams[$Param]["SaveParamNams"]           : $this->SaveParamNams;
                /*DEBUG*/
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->VNam       : ".$this->VNam   ); }
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->VEs        : ".$this->VEs    ); }
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->VCSCols    : ".$this->VCSCols   ); }
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->GroupBy   : ".$this->GroupBy); }
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->FEFs      : ".$this->FEFs); }
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->DEs       : ".$this->DEs ); }
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->DEFs      : ".$this->DEFs); }
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->VEFs      : ".$this->VEFs); }
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->EFs       : ".$this->EFs  ); }
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->SetFs     : ".$this->SetFs); }
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->UIFs      : ".$this->UIFs ); }
            }
            return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    //***************************************** */
    // PARAMS BUILDING
    //***************************************** */
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
    // list of UIFs that could be set by the user
    public function getSetFs(string $FEFs,string $InRefs){
        try {
            if(!EN($FEFs)){
                $SetFs=$FEFs;
                if(!EN($InRefs)){
                    $InRefsArr=explode($_SESSION["DefaultSep"], $InRefs);
                    foreach($InRefsArr as $InRef){
                        // verify InRef and PanelType 
                        // next version: should be found in the navigation array
                        // try to split $InRef es: Proc;FileTlist
                        $InRefArr=explode(';',$InRef);
                        if(count($InRefArr)==2){
                            $InRef      = $InRefArr[0];
                            $PanelType  = $InRefArr[1];
                        }else{
                            $PanelType = "";
                        }
                        // filter FEFs
                        $_SESSION['tmp_InRef']=$InRef;
                        // eliminate the conventionally InRefs fields
                        $SetFsArr = array_filter( 
                            explode($_SESSION["DefaultSep"], $SetFs), 
                            function( $v ) { 
                                return (
                                    $v != $_SESSION["IdPrfx"].$_SESSION['tmp_InRef'] 
                                &&  $v != $_SESSION['tmp_InRef'].$_SESSION["DEFNam"]
                                &&  $v != $_SESSION["FileRefPrfx"].$_SESSION['tmp_InRef']
                            ); 
                            } 
                        );
                        $SetFs=implode($_SESSION["DefaultSep"], $SetFsArr);
                    }
                    $_SESSION['tmp_InRef']=null;
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
                // find the index
                $i=array_search(strtolower($TNam), array_column($_SESSION["FEsA"], 'TNam'));
                if($i >= 0){
                    return $_SESSION["FEsACSCols"][$i];
                }else{
                    return "";
                }
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - TNam not defined!");
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    
    // VParams are optional 
    /*
     EFs=FEFs(FE)+DEFs+VEFs+VFs 
        - VFs=SFs+CFs
            - check if it substitute  
        - VEFs= IDs(VEs)+DEFs(VEs)
     */
    public function setVParams(string $VNam){
        try {
            if($VNam){
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - VNam: ".$VNam); }
                // find the index. the search is case sensitive 
                $i=array_search($VNam, array_column($_SESSION["DbViews"], 'VNam'));
                if($i>=0){
                    // get View basic params
                    $this->VEs      = !EN($VEs     = $_SESSION["DbViews"][$i]["VEs"    ]) ? $VEs      : $this->VEs    ;
                    $this->VCSCols  = !EN($VCSCols = $_SESSION["DbViews"][$i]["VCSCols"]) ? $VCSCols  : $this->VCSCols;
                    // $this->GroupBy  = !EN($GroupBy = $_SESSION["DbViews"][$i]["GroupBy"]) ? $GroupBy  : $this->GroupBy;
                    // get View Computed Params 
                    // get VEFs = IDs + DEFs($VEs)
                    // $this->VEFs     = !EN($VIDs   = $this->getIDs($this->VEs))      ? $VIDs                     : ""; 
                    // $this->VEFs    .= !EN($VDEFs = $this->getDEFs($this->VEs))      ? $this->VEFs.",".$VDEFs    : $this->VEFs; 
                    // $this->VEFs    .= !EN($VCSCols)                                 ? $this->VEFs.",".$VCSCols  : $this->VEFs; 
                    // $this->VEFs    .= checkFields($VEFs); 
                    // View Fields
                    $this->VFs      = !EN($VFs  = $this->getVFs($VCSCols)) ? $VFs : ""; 
                    // check group by fields GFs
                    // $this->GFs      = !EN($GFs  = $this->getGFs($GroupBy))      ? $GFs   : $this->GFs;
                } /// else empty value are returned
            }else{
                // LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - VNam not defined!");
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    
    // $VEFs = VIDs + DEFs
    // $VIDs = "IdEvnt,IdCntx,IdClean,IdAn,IdRnk";  
    // $DEFs = "UsrNam,PrjStateNam,EvntNam,CntxNam,CleanNam,AnNam,RnkNam";  
    public function getVEFs(string $VEs, string $DEFs=null)
    {
        try {
            // $VEFs .= $VIDs.",".$DEFs;
            $VEFs="";
            if(!EN($VEs)){
                // ex. $VIDs = "IdEvnt,IdCntx,IdClean,IdAn,IdRnk";  
                $VEFs .= $this->getIDs($VEs);
                echo "VIDs:<br>",$VEFs,'<br><br>';

            }else{
                // warning
                return false;
            }
            if(!EN($DEFs)){
                $VEFs .= ",".$DEFs;
            }
            return $VEFs;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // get Entities Names from a E list 
    // syntax <ENami>[;<JoinType>][;<FENami>], ...
    // ex. "Evnt,Cntx,Clean,An,Rnk;IdAn",
    // returns a string 
    public function getENams(string $Es){
        try {
            if(!EN($Es)){
                $EsArr=explode(',',$Es);
                // Field Names list
                $ENames=implode(',',
                    array_map( 
                        function($v) { 
                            // echo $v."<br>";
                            $TmpArr=explode(";", $v);
                            // echo $TmpArr[0]."<br>";
                            return $TmpArr[0];
                        }, 
                        $EsArr
                    )
                );
            }
            return $ENames;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function getFNamsArr(string $Fs){
        try {
            $FNames=";"
            if(!EN($Fs)){
                $FsArr=explode(',',$Fs);
                // Field Names list
                $FNames=array_map( 
                    function($v) { 
                        // - map field names
                        // if(!exists($FN=explode(" AS ", $v)[1])){    // alias
                        if(count($TmpArr=explode(" AS ", $v)) > 1){    // alias
                                return $TmpArr[1];
                        // }else if(!exists($FN=explode(".", $v)[1])){ //<entity>.<field>
                        }else if(count($TmpArr=explode(".", $v)) > 1){ //<entity>.<field>
                            return $TmpArr[1];
                        }else{
                            return $v;  // simple FN
                        }
                    }, 
                    $FsArr
                );
            }
            return $FNames;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // EFs=FEFs+VEFs+VFs 
    // where VFs=SFs+CFs
    //       VEFs = VIDs + DEFs
    public function getEFs(string $FEFs, string $VEFs=null, string $VFs=null){
        try {
            if(EN($FEFs)){
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - FEFs param is not defined!");
                return false;
            }
            $EFs=$FEFs;
            // check VEFs
            if(!EN($VEFs)){
                $EFs .= ",".$VEFs;
            }
            // check VFs
            if(EN($VFs)){
                return $EFs;
            }
            // union VFs -> EFs, based on field names, in a more complex syntax
            $EFsArr = explode(",",$EFs);
            $VFsArr = explode(",",$VFs);
            // get EFsFNams
            $EFsFNams = $this->getFNamsArr($EFs);
            // get VFsFNams
            $VFsFNams = $this->getFNamsArr($VFs);
            // intersect and get cross coordinates
            $EFsVFs=array_intersect($EFsFNams, $VFsFNams);
            $VFsEFs=array_intersect($VFsFNams, $EFsFNams);
            krsort($VFsEFs);
            // replace duplicates VFs -> EFs and 
            // remove them from VFs
            foreach ($VFsEFs as $key => $val) {
                $EFsKey=key($EFsVFs);
                $EFsArr[$EFsKey]=$VFsArr[$key];
                next($EFsVFs);
                unset($VFsArr[$key]);
            }
            // final result
            $NewEFs=implode(",",$EFsArr);
            if(!EN($NewVFs=implode(",",$VFsArr))){
                $NewEFs .= ",".$NewVFs;
            }
            return $NewEFs;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // IDs are considered compulsory fields of entities
    public function getIDs(string $Es)
    {
        try {
            $IDs='';
            // $mapped = array_map('func', $values, array_keys($values));
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - DEs: ".$DEs); }
            if(!EN($Es)){
                // get entity list names from a more complex syntax list
                $Es=getENams($Es);
                $EsArr=explode(',',$Es);
                $IDs .= implode(',',
                array_map( 
                    function($v) { 
                        // map ids
                        return  $_SESSION["IdPrfx"].$v; 
                    }, 
                    $EsArr
                    )
                );
            }
            return $IDs;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // 
    public function getClientOps(string $PanelType, string $ParentObjType){
        try {
            if($PanelType){
                // es. ReadTree, oppure TlistTree
                if (!EN($ParentObjType)){
                    if($ParentObjType != "Tlist"){ // Tlist is the default parent type
                        $PanelType = $PanelType.$ParentObjType;
                    }
                }
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
    
    // get Descriptive entities from FE and VEs
    public function getDEs(string $FEFs, string $FE, string $VEs=null)
    {
        try {
            // query to insert record
            if(!is_null($FE)){
                $_SESSION['tmp_FE']=$FE;
                $DEs = "";
                if(!EN($FEFs)){
                    $DEs = implode(",",
                        array_map( 
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
                        )
                    );
                    // union VEs
                    if(!EN($VEs)){
                        $DEs .= ",".$VEs;
                    }
                }else{
                    LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - FEFs not set!");
                    return false;
                }
                $_SESSION['tmp_FE']=null;
                return $DEs;
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
                    // get the entity fields array
                    $FEFsArr=explode(',',$this->getFEFs($v));
                    // check if "Nam" is an entity field map ... else null
                    return  (in_array($_SESSION["DEFNam"], $FEFsArr))? $v.$_SESSION["DEFNam"] : null; 
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

    // parseFFInfo: paese single FFInfo in the FV string
    // - [Filter] WHERE or HAVING conditions, are the most complex part to generalize
    // It can be done adding Filter Types when necessary. For ex. :
    // Filter Type: 
    //     NoN: None on Null       > '=' (Single or Multiple Values);  Precise match
    //     AoN: All on Null        > 'LIKE %' (Single Value);           Partial match
    //     Min: Minimum            > >= (Single Value);
    //     Max: Maximum            > <= (Single Value);
    //     Rng: Range              > BETWEEN min an max (Multiple Values);
    //  Type modificators:    
    //     -: exclude              > NOT
    //     C(dt): Cast as Datatype > CAST($var AS $dt)
    // ******************
    //  examples
    //  -NoN; -AoN;0
	//  *****
	//  complete examples
	//  IdAlg;NoN AND Nam;AoN OR otherE.Dt;-NoN
    // IdAlg;NoN & Nam;AoN | Dt;-NoN
    public function parseFFInfo(string $FFInfo)
    {
        try {
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - EFs: ".$EFs); }
            $FFInfoArr=explode(";",$FFInfo); // FFInfo: Filter Field Info 
            // verify filterType
            $FT="NoN"; // default value
            $FF=""; // starting but not valid value
            if(count($FFInfoArr)==2){
                if(!EN($FFInfoArr[1])){
                    $FT=$FFInfoArr[1];
                }else{
                    LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": FilterType is empty.");
                }
            } // else default
            // verify filter field and entity
            if(!EN($FFInfoArr[0])){
                $FFE=$FFInfoArr[0];
                $FFEArr=explode(".",$FFE); // FFE: Filter Field and Entity 
                // verify Entity setting
                $FE=$this->FE; // Filter entity Default value
                if(count($FFEArr)==2){
                    // filter field setting
                    if(!EN($FFEArr[1])){
                        $FF=$FFEArr[1]; 
                    }else{
                        LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": Filter Field is empty.");
                        return null;
                    }
                    // filter entity setting
                    if(!EN($FFEArr[0])){
                        $FE=$FFEArr[0]; 
                    }else{
                        LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": Filter Field Entity is empty.");
                    }
                }else{ //count($FFEArr)==1
                    $FF=$FFEArr[0]; // only filter field is set
                }
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": FilterType is empty.");
                return null;
            }
            $ResultArr = array(
                "FT" => $FT,
                "FE" => $FE,
                "FF" => $FF
            );
    
            return $ResultArr;
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
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - PanelType: ".$PanelType); }
                switch($PanelType){
                    case 'Tlist':
                        //  Tlist
                        $this->TlistDataTblNam      = !EN($this->FE)                                            ? $this->FE.$_SESSION["DataTblNamPsfx"]       : $this->TlistDataTblNam;
                        $this->TlistColumnsJS       = !EN($TlistColumnsJS=$this->getTlistColumnsJS($this->EFs)) ? $TlistColumnsJS                             : $this->TlistColumnsJS;
                        $this->TlistColumnsHTML     = !EN($TlistColumnsHTML=$this->getTlistColumnsHTML($this->EFs)) ? $TlistColumnsHTML                       : $this->TlistColumnsHTML;
                        $this->TlistColumnDefsJS    = !EN($TlistColumnDefsJS=$this->getTlistColumnDefsJS($this->EFs)) ? $TlistColumnDefsJS                    : $this->TlistColumnDefsJS;
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->TlistColumnsHTML: ".$this->TlistColumnsHTML); }
                        break;
                    case 'Tree':
                        $this->TreeObjNam           = !EN($this->FE)                                            ? $this->FE.$_SESSION["TreeNamPsfx"]          : $this->TreeObjNam;
                        break;
                    case 'FileTlist':
                        $this->TlistDataTblNam      = !EN($this->FE)                                            ? $this->FE.$_SESSION["DataTblNamPsfx"]       : $this->TlistDataTblNam;
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

    public function setFSelsSrvOpParams(string $FSels)
    {
        try {
            $FSelsSrvOpParams=null;
            if(!EN($FSels)){
                $FSelsArr=explode(',',$FSels);
                $FSelsSrvOpParams =  array_combine($FSelsArr,
                    array_map( 
                        function($FSel) { 
                            $FE   = isset($FSel)                        ? $FSel                 : "";
                            $FEFs = !EN($FE)                            ? $this->getFEFs($FE)   : "";
                            $DEs  = !EN($DEs=$this->getDEs($FEFs,$FE))  ? $DEs                  : "";
                            $DEFs = !EN($DEFs=$this->getDEFs($DEs))     ? $DEFs                 : "";
                            $EFs  = !EN($DEFs)                          ? $FEFs.','.$DEFs       : "";

                            $FSelArr=array(
                                "FE"      => $FE  ,
                                "FEFs"    => $FEFs,
                                "DEs"     => $DEs ,
                                "DEFs"    => $DEFs,
                                "EFs"     => $EFs 
                            );
                            return  $FSelArr; 
                        }, 
                        $FSelsArr
                    )
                )
                ;
            }
            if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - json_encode(FSelsSrvOpParams): ".json_encode($FSelsSrvOpParams)); }
            return $FSelsSrvOpParams;
            // return $result;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    //********************************** */
    //CODE BUILDING
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
    
    //  ex:
    //  <th>Id</th>
    //  <th>IdProfile</th>
    //  <!-- <th>IdFeatureCat</th> -->
    //  <th>IdFeature</th>
    //  <th>IdAuth</th>
    //  <th>Profile</th>
    //  <!-- <th>FeatureCat</th> -->
    //  <th>Feature</th>
    //  <th>Auth</th>

    public function getTlistColumnsHTML(string $EFs)
    {
        try {
            $TlistColumnsHTML='';
            // $mapped = array_map('func', $values, array_keys($values));
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - DEs: ".$DEs); }
            if(!EN($EFs)){
              $EFsArr=explode(',',$EFs);
              $TlistColumnsHTML .= implode(' ',
                array_map( 
                  function($v) { 
                    return  '<th>'.$v.'</th>'; 
                  }, 
                  $EFsArr
                )
              );
            }
            return $TlistColumnsHTML;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function getFVJsDecl(string $FV)
    {
        try {
            $FVJsDecl="";
            if(!EN($FV)){
                // FV: Filter Vector; space seperator
                // IdAlg;NoN AND Nam;AoN OR otherE.Dt;-NoN
                $FVArr=explode(" ",$this->FV); 
                for ($n = 0; $n <= count($FVArr); $n+=2) {
                    // get FFInfo ex. "otherEntity.IdAlg;-NoN"
                    $FFInfo=$FVArr[$n];
                    $FFIArr=$this->ParseFFInfo($FFInfo);
                    if(str_starts_with($FFIArr["FF"], "SearchIds")){
                        $FFIArr["FF"] = "SearchIds"; 
                    }
                    // build JS code
                    // set FF Declarations code
                    $FVJsDecl .= $FFIArr["FF"].':   "",'.$_SESSION["PHPEoL"]; 
                }
            }
            return $FVJsDecl;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // FM Filter Matrix 
    // return json string
    // this is specific for this Tlist panel of ProfileFeatureAuth
    // Filters are dependent from References, Parent entities, specific settings for the panel.
    // A FV (Filter vector) has to be placed in the navigation data
    // FV should be composed, once and for all, out of run time.
    // FM is dependent from interaction data, so it canNOT be moved to the PHP content builder
    // code chunk could be field by the php Content Builder
    // Simple logic operations OR, AND: ex. "a OR b AND c"

    // ******************
    // FVJsDecl: Filter Values Js Declaration
    // ex. SearchIds:   "",
    // ******************
    // $FMArr = array(
    //     "fe.IdAlg"   => array("filterRel" => ''    , "filterType" => 'NoN', "filterValues" => '1,6,16'),
    //     "fe.Nam"     => array("filterRel" => 'AND' , "filterType" => 'AoN', "filterValues" => 'alg'),
    //     "fd.Dt"      => array("filterRel" => 'OR'  , "filterType" => 'NoN', "filterValues" => '2021-11-20'),
    // );

    public function getFMJs(string $FV)
    {
        try {
            $FMJs="";
            if(!EN($FV)){
                // FV: Filter Vector; space seperator
                // IdAlg;NoN AND Nam;AoN OR otherE.Dt;-NoN
                $FVArr=explode(" ",$FV); 
                for ($n = 0; $n <= count($FVArr); $n+=2) {
                    // get FFInfo ex. "otherEntity.IdAlg;-NoN"
                    $FFInfo=$FVArr[$n];
                    $FFIArr=$this->ParseFFInfo($FFInfo);
                    // verify filterRel
                    $FR = "";
                    if($n > 1){ 
                        $LOP=$FVArr[$n-1];
                        if($LOP == "|"
                        || $LOP == "&"){
                            $FR=$LOP;
                        }
                    }
                    // build JS code
                    // set FM structure code
                    if(str_starts_with($FFIArr["FF"], "SearchIds")){
                        $FFArr=explode("<",$FFIArr["FF"]); 
                        $FMJs .= '"'.$FFIArr["FE"].'.'.$FFArr[1].'": {"filterRel":"'.$FR.'", "filterType" : "'.$FFIArr["FT"].'", "filterValues" : '.$this->JSPanelNamSpace.'.'.$FFArr[0].' },'.$_SESSION["PHPEoL"];
                    }else{
                        $FMJs .= '"'.$FFIArr["FE"].'.'.$FFIArr["FF"].'": {"filterRel":"'.$FR.'", "filterType" : "'.$FFIArr["FT"].'", "filterValues" : '.$this->JSPanelNamSpace.'.'.$FFIArr["FF"].' },'.$_SESSION["PHPEoL"];
                    }
                }
            }else if($this->PanelType == 'Read'
                  || $this->PanelType == 'ReadOpen'
            ){
                // build JS code
                $FMJs .= '"'.$this->FE.'.'.$this->FEIdNam.'": {"filterRel":"", "filterType" : "NoN", "filterValues" : '.$this->JSPanelNamSpace.'.'.$this->FEIdNam.' },'.$_SESSION["PHPEoL"];
            }
            if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - FMJs: ".$FMJs); }
            return $FMJs;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // Set and Clean a Ref param
    // Dependencies: btnControl
    /*  ex:
    // <div class="row">
    //     <div class="col-md-9">
    //         <div class="form-group">
    //             <label for="<?php echo $this->PanelTag; ?>ProfileNam">ProfileNam</label>
    //             <input type="text" class="form-control" id="<?php echo $this->PanelTag; ?>ProfileNam" placeholder="ProfileNam ..."
    //                 value="" readonly>
    //         </div>
    //     </div>
    // </div>
    */
    public function getInRefsNamsHTML(string $InRefs)
    {
        try {
            $InRefsNamsHTML='';

            if(!EN($InRefs)){
                $InRefsArr=explode(',',$this->InRefs);
                foreach ($InRefsArr as $InRef) {
                    // verify InRef and PanelType 
                    // next version: should be found in the navigation array
                    // try to split $InRef es: Proc;FileTlist
                    $InRefArr=explode(';',$InRef);
                    if(count($InRefArr)==2){
                        $InRef      = $InRefArr[0];
                        $PanelType  = $InRefArr[1];
                    }else{
                        $PanelType = "";
                    }
                    // Panel Specific PArt
                    if($PanelType == "FileTlist"){
                        $InRefsNamsHTML .= '
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="'.$this->PanelTag.$_SESSION["FileRefPrfx"].$InRef.'">'.$_SESSION["FileRefPrfx"].$InRef.'</label>
                                <input type="text" class="form-control" id="'.$this->PanelTag.$_SESSION["FileRefPrfx"].$InRef.'" placeholder="'.$_SESSION["FileRefPrfx"].$InRef.' ..."
                                    value="" readonly>
                            </div>
                        </div>
                        ';
                    }else{
                        $InRefsNamsHTML .= '
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="'.$this->PanelTag.$InRef.$_SESSION["DEFNam"].'">'.$InRef.$_SESSION["DEFNam"].'</label>
                                <input type="text" class="form-control" id="'.$this->PanelTag.$InRef.$_SESSION["DEFNam"].'" placeholder="'.$InRef.$_SESSION["DEFNam"].' ..."
                                    value="" readonly>
                            </div>
                        </div>
                        ';
                    }
                }
            }
            return $InRefsNamsHTML;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // Set and Clean a Ref param
    // Dependencies: btnControl
    /*  ex:
    // <div class="row">
    //     <div class="col-md-3">
    //         <div class="form-group">
    //             <label for="<?php echo $this->PanelTag; ?>IdProfile">IdProfile</label>
    //             <input type="text" class="form-control" id="<?php echo $this->PanelTag; ?>IdProfile" placeholder="IdProfile ..."
    //                 value="" readonly>
    //         </div>
    //     </div>
    // </div>
    */
    public function getInRefsIdsHTML(string $InRefs)
    {
        try {
            $InRefsIdsHTML='';
            if(!EN($InRefs)){
                $InRefsArr=explode(',',$this->InRefs);
                foreach ($InRefsArr as $InRef) {
                    // verify PanelType 
                    // next version: should be found in the navigation array
                    // try to split $InRef es: Proc;FileTlist
                    $InRefArr=explode(';',$InRef);
                    if(count($InRefArr)==2){
                        $InRef      = $InRefArr[0];
                        $PanelType  = $InRefArr[1];
                    }else{
                        $PanelType = "";
                    }
                    // 
                    if($PanelType == "FileTlist"){
                        $InRefsIdsHTML .= '';
                    }else{
                        $InRefsIdsHTML .= '
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="'.$this->PanelTag.$_SESSION["IdPrfx"].$InRef.'">'.$_SESSION["IdPrfx"].$InRef.'</label>
                                <input type="text" class="form-control" id="'.$this->PanelTag.$_SESSION["IdPrfx"].$InRef.'" placeholder="'.$_SESSION["IdPrfx"].$InRef.' ..."
                                    value="" readonly>
                            </div>
                        </div>
                        ';
                    }
                }
            }
            return $InRefsIdsHTML;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // Set and Clean a Ref param
    // Dependencies: btnControl
    /* ex.
    SetAlgCatPar: function(data=null) {
        da.AlgCatRead.IdAlgCatPar = (data)?data["IdAlgCatPar"]:"";
        $("#AlgCatRead_IdAlgCatPar").val((data)?data["IdAlgCatPar"]:"");
        NamField = (da.AlgCatRead.Mode == "TlistPar") ? "AlgCatParNam" : "Nam";
        $("#AlgCatRead_AlgCatParNam").val((data)?data[NamField]:"");
        
        if("Read" == "Tlist"){
            // PanelType: Tlist
            da.AlgCatRead.SearchIds = (data) ? data["SearchIds"] : "";
            da.AlgCatRead.Refresh();
        }else{ 
            // rx: PanelType: Read
            if ( $.isFunction(da.AlgCatRead.btnControl) ) {
                da.AlgCatRead.btnControl();
            }
        }
    },
    */
    public function getInRefsJs(string $InRefs)
    {
        try {
            $InRefsJs="";
            if(!EN($InRefs)){
                $InRefArr=explode(',',$this->InRefs);
                foreach ($InRefArr as $InRef) {
                    // verify PanelType 
                    // next version: should be found in the navigation array
                    // try to split $InRef es: Proc;FileTlist
                    $InRefArr=explode(';',$InRef);
                    if(count($InRefArr)==2){
                        $InRef      = $InRefArr[0];
                        $PanelType  = $InRefArr[1];
                    }else{
                        $PanelType = "";
                    }
                    // Build JS code
                    $InRefsJs .= '
    Set'.$InRef.': function(data=null) {
                    ';
                    // panel specific part
                    if($PanelType == "FileTlist"){
                        $InRefsJs .= '
        $("#'.$this->PanelTag.'FileRef'.$InRef.'").val((data)?data["FileNam"]:"");
                        ';
                    }else{
                        $InRefsJs .= '
        '.$this->JSPanelNamSpace.'.'.$_SESSION["IdPrfx"].$InRef.' = (data)?data["'.$_SESSION["IdPrfx"].$InRef.'"]:"";
        $("#'.$this->PanelTag.''.$_SESSION["IdPrfx"].$InRef.'").val((data)?data["'.$_SESSION["IdPrfx"].$InRef.'"]:"");
        $("#'.$this->PanelTag.$InRef.$_SESSION["DEFNam"].'").val((data)?data["'.$_SESSION["DEFNam"].'"]:"");
                        ';
                    }
                    //common part
                    $InRefsJs .= '
        if("'.$this->PanelType.'" == "Tlist"){
            // PanelType: Tlist
            '.$this->JSPanelNamSpace.'.SearchIds = (data) ? data["SearchIds"] : "";
            '.$this->JSPanelNamSpace.'.Refresh();
        }else{ 
            // rx: PanelType: Read
            if ( $.isFunction('.$this->JSPanelNamSpace.'.btnControl) ) {
                '.$this->JSPanelNamSpace.'.btnControl();
            }
        }
    },
                ';
                }
            }
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - FMJs: ".$FMJs); }
            return $InRefsJs;
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
            $TlistColumnsJS='';
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
                $TlistColumnsJS=implode(',',$TlistColumnsJSArr);
            }
            return $TlistColumnsJS;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

}