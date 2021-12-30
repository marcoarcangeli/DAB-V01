<?php

namespace DA\mySqlComponents;

use DA\Logs\LogManager as LM;
use function DA\Common\emptyOrNull as EN;

class Database
{
    // specify your own database credentials
    private $Host = ''; //'localhost';
    private $DbNam = ''; //'dadb';
    private $UsrNam = ''; //'m.arcangeli';
    private $Pwd = ''; //'Pa$$w0rd_';
    private $ConnJsonPathFn = ''; 
    
    public $Conn;

    // constructor with $db as database connection
    public function __construct($ConnJsonPathFn=NULL)
    {
        // if(!is_null($ConnJsonPathFn)){
        //     $this->ConnJsonPathFn = $ConnJsonPathFn;
        // }elseif(isset($_SESSION["MySqlConnJsonAbsPathFilename"])){
        //     $this->ConnJsonPathFn = $_SESSION["MySqlConnJsonAbsPathFilename"];
        // }else{
        //     $this->Conn=NULL;
        // }
        $this->createConnection();

    }
    
    // get the database connection
    protected function createConnection()
    {
        try {
                //
            // if($this->GetConnectionParams()){
                // $this->Conn = new PDO("mysql:host=" . $this->Host . ";dbname=" . $this->DbNam, $this->UsrNam, $this->Pwd);
                // $this->Conn = new \mysqli($this->Host, $this->UsrNam, $this->Pwd, $this->DbNam);
                $this->Conn = new \mysqli($_SESSION["DbHost"], $_SESSION["DbUsrNam"], $_SESSION["DbPwd"], $_SESSION["DbNam"]);
            // }else{
            //     $this->Conn = NULL;
            // };

            //???/*  */ mysqli_query($this->Conn,"set names utf8");
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function getConnection()
    {
        try {
            //
            return $this->Conn;
            //???/*  */ mysqli_query($this->Conn,"set names utf8");
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    
    public function getRDBMSInfoSchema(string $DbNam){
        try {
            if($DbNam){
                /* Tell mysqli to throw an exception if an error occurs */
                $Conn = mysqli_connect($_SESSION["DbHost"], $_SESSION["DbUsrNam"], $_SESSION["DbPwd"], $_SESSION["SchemaDbNam"]);
        
                /* Insert some values */
                $query = "
                    SELECT c.TABLE_NAME as TNam ,
                        GROUP_CONCAT(DISTINCT c.COLUMN_NAME ORDER BY c.ORDINAL_POSITION) as CSCols
                        FROM COLUMNS c 
                    where c.TABLE_SCHEMA = '".$DbNam."' 
                    group by c.TABLE_NAME
                    order by c.TABLE_NAME
                ";
        
                /* Try to exec  */
                if ($Stmt = mysqli_query($Conn, $query)) {
                    $Result_arr = $Stmt->fetch_all(MYSQLI_ASSOC);
                    return $Result_arr;
                }else{
                    LM::LogMessage("ERROR", 'No result!');
                    return false;
                }
            }else{
                LM::LogMessage("ERROR", 'DbNam not defined!');
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    
    // move this function to CSV TO JSON specialized component
    public function GetArrayFromJsonFile(string $JsonPathFn)
    {
        try {
            if(!EN($JsonPathFn)){
                if(!EN($Encoded=file_get_contents($JsonPathFn))){
                    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Encoded: ".$Encoded); }
                    if(!is_null($Decoded = json_decode($Encoded, true))){
                        // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Decoded length: ".count($Decoded)); }
                        return $Decoded;
                    }else{
                        LM::LogMessage("WARNING", 'Decoded JSON file ('.$JsonPathFn.') is not set!');
                        return false;
                    }    
                }else{
                    LM::LogMessage("WARNING", 'Encoded JSON file ('.$JsonPathFn.') is not set!');
                    return false;
                }
            }else{
                LM::LogMessage("WARNING", 'JsonPathFn param is not set!');
                return false;
            }
            //
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
        
    // OBSOLETE: get the database connection
    protected function SetConnParamsFromJson(string $JsonPathFn)
    {
        try {
            if(!EN($JsonPathFn)){
                if(!EN($Decoded = $this->GetArrayFromJsonFile($JsonPathFn))){
                    $this->Host=$Decoded["mySqlConn"]["Host"];
                    $this->DbNam=$Decoded["mySqlConn"]["DbNam"];
                    $this->UsrNam=$Decoded["mySqlConn"]["UsrNam"];
                    $this->Pwd=$Decoded["mySqlConn"]["Pwd"];
                    return true;
                }else{
                    LM::LogMessage("WARNING", 'Decoded JSON file ('.$JsonPathFn.') is not set!');
                    return false;
                }
            }else{
                LM::LogMessage("WARNING", 'JsonPathFn param is not set!');
                return false;
            }
            //
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    
}