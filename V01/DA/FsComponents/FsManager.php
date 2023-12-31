<?php

// FsManager Class
namespace DA\FsComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');

use DA\FsComponents as FSC;
use DA\Logs\LogManager as LM;

class FsManager
{
    // protected string $htmlPathFileNam;
    protected string $PrjAbsPath = '';
    //Prjs  $Params = [$p["PrjNam"], $p["AnNam"], $p["FileNam"], $p["FileContent"], $p["OverWrite"]];

    public function __construct(string $Param = "OK")    {
        // Html file is included for editing purpose in Html editors
        // $this->htmlPathFileNam=get_class($this).'.html';
        // $this->htmlStream=file_get_contents($this->htmlPathFileNam);

        $this->PrjAbsPath = $_SESSION["PrjAbsPath"];
    }

    public function MakeFolder(string $FolderPathNam)
    {
        try {
            if (!is_dir($FolderPathNam)) {
                // throw new Exception("MakeFolder: ".$FolderPathNam . "\n");
                // echo dirNam(__FILE__);
                mkdir($FolderPathNam, 0777, true); 

                // if (mkdir($FolderPathNam, 0777, true)) {
                //     return true;
                // }else{
                //     LM::LogMessage("WARNING", "The folder () cannot be created");
                //     return false;
                // }
            } 
            // se esiste comunque ritorna vero
            return true;

        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function RemoveFolder(string $FolderPathNam)
    {
        try {
            // echo (" - " . $FolderPathNam . " - ");
            if (is_dir($FolderPathNam)) {
                rmdir($FolderPathNam);
                return true;
            } else {
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - The folder (".$FolderPathNam.") cannot be removed!");
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    protected function CopyFile(string $SrcPathFileNam, string $DstPathFileNam, string $OverWrite)
    {
        try {
            if (!file_exists($DstPathFileNam) || (file_exists($DstPathFileNam) && $OverWrite == "true")) {
                Copy($SrcPathFileNam, $DstPathFileNam);
            } else {
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - The folder (".$SrcPathFileNam.") cannot be copied!");
                return false;
            }
            return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function CopySingleFile(array $p)
    {
        try {
            $SrcPathFileNam =  $p["FilePath"] . $p["FileNam"];
            $DstPathFileNam = $p["FilePathNew"] . $p["FileNam"];

            $this->CopyFile($SrcPathFileNam,  $DstPathFileNam, $p["OverWrite"]);
            return true;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function SaveFile(string $PathFileNam, string $FileContent, string $OverWrite)
    {
        try {
            if (file_exists($PathFileNam)) {
                if ($OverWrite == "true") {
                    $this->DeleteFile($PathFileNam);
                } else {
                    LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - The file (".$PathFileNam.") already exists.");
                    return false;
                }
            }
            if ($File = fopen($PathFileNam, "w")) {
                // a different way to write content into
                ;
                if (fwrite($File, $FileContent)) {
                    fclose($File);
                    return true;
                } else {
                    LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - Cannot write to file (".$PathFileNam.")!");
                    return false;
                }
                // closes the file
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - Cannot open file (".$PathFileNam.")!");
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    protected function DeleteFile(string $PathFileNam)
    {
        try {
            if (!file_exists($PathFileNam)) {
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - The file (".$PathFileNam.") do not exists!");
                return false;
            } else {
                // throw new exception($PathFileNam . "\n");

                if (unlink($PathFileNam)) {
                    return true;
                } else {
                    LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - The file (".$PathFileNam.") cannot be deleted!");
                    return false;
                }
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function RemoveFile(array $p)
    {
        try {
            $PathFileNam = $p["FilePath"] . $p["FileNam"];
            // throw new exception($PathFileNam . "\n");
            $Result = $this->DeleteFile($PathFileNam);
            if ($Result) {
                return true;
            } else {
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - The file (".$PathFileNam.") cannot be removed!");
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function RemoveFiles(array $p)
    {
        try {
            if(isset($p["FileNam"]) && trim($p["FileNam"])!=""){
                $NotDeletedFiles="";
                $PathFileNams = explode(",",$p["FileNam"]);
                foreach ($PathFileNams as $FileNam)
                {
                    $PathFileNam = $p["FilePath"] . $FileNam;
                    // throw new exception($PathFileNam . "\n");
                    $Result = $this->DeleteFile($PathFileNam);
                    if (!$Result) {
                        $NotDeletedFiles .=$PathFileNam.",";
                        return true;
                    }
                }
                echo $NotDeletedFiles;
                return true;
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - FileNam is not set!");
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    protected function RenFile(string $PathFileNamOld, string $PathFileNamNew)
    {
        try {
            if (!file_exists($PathFileNamOld)) {
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - The file (".$PathFileNamOld.") does not exist!");
                return false;
            } else {
                // throw new exception($PathFileNam . "\n");

                if (renam($PathFileNamOld, $PathFileNamNew)) {
                    return true;
                } else {
                    LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - The file (".$PathFileNamOld.") cannot renamed as (".$PathFileNamNew.")!");
                    return false;
                }
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function RenFile2(array $p)
    {
        try {
            $PathFileNamOld = $p["FilePath"] . $p["FileNam"];
            $PathFileNamNew = $p["FilePath"] . $p["FileNamNew"];
            // throw new exception($PathFileNam . "\n");
            $Result = $this->RenFile($PathFileNamOld, $PathFileNamNew);
            if ($Result) {
                return true;
            } else {
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - Files cannot be renamed!");
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function MultiFileFilter(string $File='', string $FileFilter='')
    {
        try {
            // throw new exception("MultiFileFilter:".$File ." - " . $FileFilter. "\n");
            // se esiste il filtro
            if($File != ''){
                if ($FileFilter != '') {
                    // ---
                    $filter_arr=explode(",", $FileFilter);
                    $n=sizeof($filter_arr);
                    // throw new exception("n:". $n. "\n");
                    if($n>0){
                        // se trova almeno un filtro ...
                        for($i = 0; $i < $n;$i++)
                        {
                            // if($_SESSION["Debug"]>=3){ LM::LogMessage("DEBUG","strtolower(File) ".strtolower($File). " - strtolower(filter_arr[i]): ".strtolower($filter_arr[$i])); }
                            if(strripos(strtolower($File), strtolower($filter_arr[$i])) !== false){
                                return true;
                            }
                        }
                    }
                    // LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__." - No File Filter available!");
                    return false;
                }else{
                    return true;
                }
            }else{
                LM::LogMessage("WARNING", "File is not set!");
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function FolderFileList(array $p)
    {
        // if($_SESSION["Debug"]>=1){ LM::LogMessage("DEBUG","function: ".__FUNCTION__); }
        // if($_SESSION["Debug"]>=1){ LM::LogMessage("DEBUG","call: ".__METHOD__); }

        try {
            $FolderPath = $p["FolderPath"];
            $FileFilter = $p["FileFilter"];

            // throw new exception("FolderFileList:".$FolderPath ." - " . $FileFilter. "\n");
            // $PathFileNam = $FolderPathNam . "/" . $p["FileNam"];
            // $Deleted = $this->DeleteFile($PathFileNam);
            if (file_exists($FolderPath)) {
                // ---
                // $FolderPath  = '../';
                if ($Handle = opendir($FolderPath)) {
                    // echo "Directory handle: $Handle\n";
                    // echo "Entries:\n";
                    $Files = array();
                    $FileInfo = array();
                    /* This is the correct way to loop over the directory. */
                    while (false !== ($File = readdir($Handle))) {
                        if (
                            $File == '.'
                            || $File == '..'
                            || is_dir($FolderPath . $File)
                            || $this->MultiFileFilter($File, $FileFilter) === false
                            // || strripos($File, $FileFilter) === false
                        ) {
                            continue;
                        }
                        $FileInfo["FileNam"] = $File;
                        $Files[]  = $FileInfo;
                        // echo "$File \n";
                    }
                    // echo "nume files: " . count($Files);
                    closedir($Handle);
                }
                // rsort($Files);
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","Files List: ".$jsonString=json_encode($Files)); }

                // ---
                return $Files;
            }else{
                return null;
            }
            // if ($Files) {
            // } else {
            //     return $Files;
            // }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

}
