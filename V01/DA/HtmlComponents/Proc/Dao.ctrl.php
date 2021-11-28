<?php
namespace DA\HtmlComponents\Proc;

$BFD=$_SESSION["BaseFolderDyn"];
// include Database and object files 
// include_once($BFD.'DA/mySqlComponents/Database.php');
// include_once($BFD.'DA/mySqlComponents/Proc.php');
include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/FsComponents/FsManager.php');

use DA\FsComponents\FsManager as FSM;
use DA\Logs\LogManager as LM;
// use DA\mySqlComponents\Database as DB;
// use DA\mySqlComponents\Proc as DAO;

class DaoCtrl
{
    // common params with deafaults;
    // public string $CompulsoryParamNams = 'IdLog';
    // public string $OptionalParamNams = ''; //'SearchIds';
    // public string $ParamSource = 'PSV';
    // public string $ParamSource2 = 'ASV';
    // public string $SaveParamNams = "IdLog,IdLogState,IdLogCat,Nam,Descr,fileRefProc,CatTag";

    public function __construct(string $Param = "OK")    {
        // $this->SetDefaults($Param);
    }

    public function FileTlistFs(array $Params)
    {
        // $OptionalParamNams = $this->OptionalParamNams; //"SearchIds";
        // $CompulsoryParamNams = $this->CompulsoryParamNams; //"SearchIds";
        try {
            // set Prjproperty values
            // $Proc->idPrj = $_POST['idPrj'];
            // get manager object
            $Dir  = $_SESSION["ProcAbsPath"];
            $Ext  = $_SESSION["RFile"];
            $Files = array();
            $Fsm = new FSM();
            // $Db = $Fsm->folderFilesList(array($_POST['projectFolder']));
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Dir: ".$Dir); }
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Ext: ".$Ext); }
            $Files = $Fsm->FolderFileList(array("FolderPath" => $Dir, "FileFilter" => $Ext));

            if($Files){
                $num = count($Files);
                // echo "nume files: " . count($Files);
                // $Ext  = $_SESSION["DatCSVFile"].",".$_SESSION["HtmlFile"];
                $Result_arr = array();
                $Result_arr = $Files;
                $Result_arr = array(
                    "draw" => "1",
                    "recordsTotal" => $num,
                    "recordsFiltered" => $num,
                    "data" => $Result_arr
                );
            }else{
                $Result_arr = array(
                    "draw" => "1",
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => array()
                );
            }

            return $Result_arr;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

}