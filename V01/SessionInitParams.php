<?php
// Store Dat in session variables
$_SESSION["LoggedIn"]       = true;
$_SESSION["IdUsr"]          = $IdUsr;
$_SESSION["UsrNam"]         = $UsrNam;
$_SESSION["FirstNam"]       = $FirstNam;
$_SESSION["Nam"]            = $Nam;
$_SESSION["EMail"]          = $EMail;
// org params
$_SESSION["IdOrg"]          = $IdOrg;      
$_SESSION["OrgNam"]         = $OrgNam;     
$_SESSION["OrgDescr"]       = $OrgDescr;   
$_SESSION["OrgCodeParams"]  = $OrgCodeParams;
$_SESSION["OrgDttm"]        = $OrgDttm;    
$_SESSION["Logo"]           = $Logo;
// app params
$_SESSION["App"]            = $App;
$_SESSION["Title"]          = $Title;
$_SESSION["Version"]        = $Version;
$_SESSION["License"]        = $License;
$_SESSION["Author"]         = $Author;
$_SESSION["Description"]    = $Description;
// db connection
$_SESSION["DbHost"]         = "localhost";
$_SESSION["DbNam"]          = "dadbv01";
$_SESSION["SchemaDbNam"]    = "information_schema";
$_SESSION["DbUsrNam"]       = "DABUser";
$_SESSION["DbPwd"]          = "DABUser";
// conventional params
$_SESSION["SrvOpParamNam"]      = "SrvOpNam";
$_SESSION["SrvOpParamsArrNam"]  = "SrvOpParams";
$_SESSION["SrvOpNams"]          = "Tlist,Read,Delete,Save,Tree";
// messages

// set Paths Relative
$_SESSION["BaseFolderDyn"]  = explode(":",str_replace( '\\', '/', __DIR__))[1]."/";                     // BaseFolderDyn: /xampp/htdocs/DAB/V01/
$_SESSION["SrvDocRoot"]     = explode(":",str_replace( '\\', '/', $_SERVER['DOCUMENT_ROOT']))[1];       // SrvDocRoot: /xampp/htdocs
$_SESSION["RelBaseFolder"]  = str_replace( $_SESSION["SrvDocRoot"], '', $_SESSION["BaseFolderDyn"]);    // RelBaseFolder: /tesiTerzoAnno/DAB/

//************************* */
// administrable params
//************************* */
// default values
//************************* */
// debug levels: 
//    <0: none; (default)
//     0: method method namespace ex. DA\FsComponents\FsManager::FolderFileList
//     1: call; only method entry point
//     2: vars; all vars no loops
//     3: loop; (full) all vars with loops
//     4: all
$_SESSION["phpMyAdminUrl"] = "http://" . $_SESSION["DbHost"] . "/phpmyadmin/";
$_SESSION["RScriptExeAbsPath"] = "/Program Files/RStudio/bin/";
$_SESSION["Debug"] = 2; 
// System Params
$_SESSION["Cache"]                  = 'False';  // utilizzo Cache
$_SESSION["GETNavigation"]          = 'False';  // utilizzo Cache
$_SESSION["UsrMsg"]                 = '';       // pulizia messaggio Usr
$_SESSION["UploadFileBufferName"]   = 'upl';    // Buffer for Html to PHP Files Upload
// standard user msgs
$_SESSION["SuccessMsg"] = "Operation executed";
$_SESSION["FailMsg"]    = "Operation not executed";
$_SESSION["ChangeParMsg"] ="Select a new Parent node in the parent tree!";

//- elType: common, alg, Prj, Evnt, cntx, anCntx, train, test, comp, rev, rank, space, ...

// set constants file type 
$_SESSION["AllowedUploadFileExt"] = 'csv_da,txt,R,log';
//- fileExt (fe): csv, html, R, txt, log, ...

//- anType: struct, fp, centers, asim, qtl, corr, MAE, RMSE, Rsq, lev-Res, q-qPlot, scLoc, k-fold, anov, moments, ...
$_SESSION["AnTypeStruct"]    = "_struct";

//- regrType: lm, glm, pol(ord)
//- spaceType: algsCntx, algsCntxs
//- procType: clean, split, regr, an, anom, struct
//- PrjState: new, evnt, cntx, an, rev, rank(standardize)
//- anPhase: an, anCntx, train, test, comp, rev, rank
//- algState: new, build, ready, ???(anPhase)???
//- valueType: Abs (omitted), std
//- sourceCodeType: class (omitted), fun, proxy, viewer, pivot, tlist, read, view, ...

//- panelType: Tlist, Details, View, FileView, ...

// files std postfix   
$_SESSION["EvntDatFile"]                = "_evnt";
$_SESSION["AutoCleanDatFile"]           = "_autoclean";
$_SESSION["CleanDatFile"]               = "_clean";
$_SESSION["CntxDatFile"]                = "_cntx";
$_SESSION["TrainDatFile"]               = "_train";
$_SESSION["TestDatFile"]                = "_test";
$_SESSION["StandardizedDatFile"]        = "_std";
$_SESSION["NormalizedDatFile"]          = "_nrm";
$_SESSION["StVarMtxDatFile"]            = "_stvarmtx";
$_SESSION["EvntVecDatFile"]             = "_evntvec";
$_SESSION["DataTblNamPsfx"]             = "List";
$_SESSION["TreeNamPsfx"]                = "Tree";
$_SESSION["DEFNam"]                     = 'Nam';            // Description Field Single Line
$_SESSION["DEFDescr"]                   = 'Descr';          // Description Field Multi Line
$_SESSION["DEFNote"]                    = 'Note';           // Description Field Multi Line
$_SESSION["DEFNum"]                     = 'Num';           // Numeric integer Field Multi Line
$_SESSION["DEFVal"]                     = 'Vl';           // Numeric Field Multi Line
$_SESSION["DEFLevel"]                   = 'Level';           // Numeric Integer Field Multi Line
$_SESSION["DEFParams"]                  = 'Params';           // Description Field Multi Line
$_SESSION["DEFParent"]                  = 'Par';           // Description Field Multi Line
$_SESSION["DEFPwd"]                     = 'Pwd';           // Password Field Multi Line

// folder standard prefix
$_SESSION["UsrFolderPrfx"]              = "Usr_";
$_SESSION["PrjFolderPrfx"]              = "Prj_";
$_SESSION["EvntFolderPrfx"]             = "Evnt_";
$_SESSION["CleanFolderPrfx"]            = "Clean_";
$_SESSION["CntxFolderPrfx"]             = "Cntx_";
$_SESSION["AnFolderPrfx"]               = "An_";
$_SESSION["AnCntxFolderPrfx"]           = "AnCntx_";
$_SESSION["TrainFolderPrfx"]            = "Train_";
$_SESSION["TestFolderPrfx"]             = "Test_";
$_SESSION["CompareFolderPrfx"]          = "Compare_";
$_SESSION["RevFolderPrfx"]              = "Rev_";
$_SESSION["RnkFolderPrfx"]              = "Rnk_";
$_SESSION["IdPrfx"]                     = 'Id';

//- filecontentType (fct): stats, graph, dat, params, log, output, el (omitted)
$_SESSION["fctStats"]   = "_stats";
$_SESSION["fctGraph"]   = "_graph";
$_SESSION["fctDat"]     = "_dat";
$_SESSION["fctParams"]  = "_params";
$_SESSION["fctLog"]     = "_log";
$_SESSION["fctOutput"]  = "_output";

// file extentions Attention!!! Mime types management
$_SESSION["DatCSVFile"] = ".csv_da";
$_SESSION["RFile"]      = ".R";
$_SESSION["AlgRFile"]   = ".alg.R";
$_SESSION["SplitRFile"] = ".split.R";
$_SESSION["OpRFile"]    = ".op.R";
$_SESSION["HtmlFile"]   = ".html";
$_SESSION["LogFile"]    = ".log";
$_SESSION["JsonFile"]   = ".json";

// nomi standard
$_SESSION["DefaultSep"]         = ",";
$_SESSION["EnumColStdName"]     = "_n";
$_SESSION["StringParamsSep"]    = "|";
$_SESSION["CSVDefaultSep"]      = ";";
$_SESSION["DecDefaultSep"]      = ",";
$_SESSION["NamDefaultSep"]      = "_";
$_SESSION["NamSpaceDefaultSep"] = ".";
$_SESSION["PanelBtnsPostfix"]   = "Btns";
$_SESSION["FKPostfix"]          ='&';
$_SESSION["CompulsoryPostfix"]  ='*';
// namespaces
$_SESSION["RootNamSpace"]       = "DA";
$_SESSION["JSRootNamSpace"]     = "da";
$_SESSION["FEAlias"]            = 'fe';
$_SESSION["DEAlias"]            = 'de';
 
$_SESSION["FilterTypeStrict"]   = 'NoN'; // None On Null filter
$_SESSION["FilterTypeApprox"]   = 'AoN'; // All On Null filter

// RelPaths
//    $dir  = '/xampp/htdocs/tesiTerzoAnno/DAB/DA/_FsBase/Procs/';
$_SESSION["FsRelPath"]      = "DA/_FsBase/";
$_SESSION["PrjRelPath"]     = "DA/_FsBase/Prj/";
$_SESSION["EvntRelPath"]    = "DA/_FsBase/Dat/Evnt/";
$_SESSION["ProcRelPath"]    = "DA/_FsBase/Proc/";
$_SESSION["SpaceRelPath"]   = "DA/_FsBase/Space/";

// site folders
$_SESSION["LogRelPath"]                     = "DA/Logs/";
$_SESSION["ContentCommonRelPath"]           = "DA/Common/";
$_SESSION["FsComponentsRelPath"]            = "DA/FsComponents/";
$_SESSION["HtmlComponentsRelPath"]          = "DA/HtmlComponents/";
$_SESSION["HtmlComponentsCommonRelPath"]    = "DA/HtmlComponents/Common/";
$_SESSION["MySqlComponentsRelPath"]         = "DA/MySqlComponents/";
$_SESSION["PhpRComponentsRelPath"]          = "DA/PhpRComponents/";
$_SESSION["ContentCodePath"]                = $_SESSION["HtmlComponentsRelPath"] . "_Html/";

$_SESSION["RScriptRelPath"]                 = "DA/PhpRComponents/RScripts/";
$_SESSION["RScriptOutputRelPath"]           = "DA/PhpRComponents/Output/";

// set Paths Absolute
$_SESSION["FsAbsPath"]              = $_SESSION["BaseFolderDyn"] . $_SESSION["FsRelPath"];
$_SESSION["LogAbsPath"]             = $_SESSION["BaseFolderDyn"] . $_SESSION["LogRelPath"];

$_SESSION["PrjAbsPath"]             = $_SESSION["BaseFolderDyn"] . $_SESSION["PrjRelPath"]; 
$_SESSION["EvntAbsPath"]            = $_SESSION["BaseFolderDyn"] . $_SESSION["EvntRelPath"];
$_SESSION["ProcAbsPath"]            = $_SESSION["BaseFolderDyn"] . $_SESSION["ProcRelPath"];
$_SESSION["SpaceAbsPath"]           = $_SESSION["BaseFolderDyn"] . $_SESSION["SpaceRelPath"];

$_SESSION["RScriptAbsPath"]         = $_SESSION["BaseFolderDyn"] . $_SESSION["RScriptRelPath"];
$_SESSION["RScriptOutputAbsPath"]   = $_SESSION["BaseFolderDyn"] . $_SESSION["RScriptOutputRelPath"];

// standard Path Filenames
// $_SESSION["MySqlConnJsonAbsPathFilename"] = $_SESSION["BaseFolderDyn"]."MySqlConn.json";

// standard classes 
$_SESSION["toDoClass"]                  = "DA\\HtmlComponents\\Common\\toDo";
$_SESSION["DaoRdbClass"]                = "DA\\MySqlComponents\\Dao";
$_SESSION["DaoCtrlRdbClass"]            = "DA\\HtmlComponents\\DaoCtrl";
$_SESSION["UIProxyClass"]               = "DA\\HtmlComponents\\UIProxy";
$_SESSION["UIProxyClass"]               = "DA\\HtmlComponents\\UIProxy";
// standard code chunks and contents
$_SESSION["RevBaseTextFile"]            = "RevBaseText.txt";
$_SESSION["cardToolsHtml"]              = "card-tools.html.php";
$_SESSION["btnToolboxHtml"]             = "btnToolbox.html.php";
$_SESSION["TlistRefreshJs"]             = "TlistRefresh.js.php";
$_SESSION["ReadGetFEFsJs"]              = "ReadGetFEFs.js.php";
$_SESSION["ReadSetFEFsJs"]              = "ReadSetFEFs.js.php";
$_SESSION["ReadBtnControlJs"]           = "ReadBtnControl.js.php";
$_SESSION["FileTlistBtnControlJs"]      = "FileTlistBtnControl.js.php";
$_SESSION["ReadNewJs"]                  = "ReadNew.js.php";
$_SESSION["ReadNewChildJs"]             = "ReadNewChild.js.php";
$_SESSION["ReadRefreshJs"]              = "ReadRefresh.js.php";
$_SESSION["ReadDeleteJs"]               = "ReadDelete.js.php";
$_SESSION["ReadSaveJs"]                 = "ReadSave.js.php";
$_SESSION["ReadChangeEventsJs"]         = "ReadChangeEvents.js.php";
$_SESSION["ReadChangeParentJs"]         = "ReadChangeParent.js.php";
$_SESSION["NotifyJs"]                   = "Notify.js.php";
$_SESSION["TlistToggleJs"]              = "TlistToggle.js.php";
$_SESSION["FileTlistToggleJs"]          = "FileTlistToggle.js.php";
$_SESSION["FileTlistRefreshJs"]         = "FileTlistRefresh.js.php";
$_SESSION["FileTlistDeleteJs"]          = "FileTlistDelete.js.php";
$_SESSION["FileTlistDownloadJs"]        = "FileTlistDownload.js.php";
$_SESSION["FileViewRefreshJs"]          = "FileViewRefresh.js.php";
$_SESSION["TreeToggleJs"]               = "TreeToggle.js.php";
$_SESSION["TreeRefreshJs"]              = "TreeRefresh.js.php";
$_SESSION["TreeToggleNodeJs"]           = "TreeToggleNode.js.php";
$_SESSION["SrvOpParamsJs"]              = "SrvOpParams.js.php";
$_SESSION["InRefsJs"]                   = "InRefs.js.php";
$_SESSION["InRefsIdsHTML"]              = "InRefsIds.html.php";
$_SESSION["InRefsNamsHTML"]             = "InRefsNams.html.php";
$_SESSION["LoadSelsJs"]                 = "LoadSels.js.php";
$_SESSION["FSelsJs"]                    = "FSels.js.php";
$_SESSION["FSelsHTML"]                  = "FSels.html.php";
$_SESSION["UIFsHTML"]                   = "UIFs.html.php";
$_SESSION["ClientOpsEventsJs"]          = "ClientOpsEvents.js.php";
$_SESSION["BtnEventsJs"]                = "BtnEvents.js.php";
$_SESSION["UploadFilesJs"]              = "UploadFiles.js.php";
$_SESSION["SetUploadfileParamsJs"]      = "SetUploadfileParams.js.php";

// standard components 
$_SESSION["UploadFilesPhp"]             = "UploadFiles.php";
$_SESSION["FsManagerProxyPhp"]          = "FsManager.proxy.php";
// coding common building blocks
$_SESSION["PHPEoL"]="\r\n";


// obsolete
$_SESSION["btnToolboxReadHtml"]         = "btnToolboxRead.html.php";
$_SESSION["btnToolboxCatReadHtml"]      = "btnToolboxCatRead.html.php";
$_SESSION["btnToolboxFileTlistHtml"]    = "btnToolboxFileTlist.html.php";
$_SESSION["btnToolboxTlistHtml"]        = "btnToolboxTlist.html.php";
$_SESSION["btnToolboxTlistReadHtml"]    = "btnToolboxTlistRead.html.php";
$_SESSION["btnToolboxTreeHtml"]         = "btnToolboxTree.html.php";
$_SESSION["btnToolboxStructHtml"]       = "btnToolboxStruct.html.php";
