<?php

namespace DA\mySqlComponents;

use DA\Logs\LogManager as LM;

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
        } catch (mysqli_sql_exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
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
        } catch (mysqli_sql_exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    // OBSOLETE: get the database connection
    protected function GetConneParamsFromJson()
    {
        try {
            if(!is_null($this->ConnJsonPathFn)){
                $Encoded=file_get_contents($this->ConnJsonPathFn);
                $Decoded = json_decode($Encoded, true);
                $this->Host=$Decoded["mySqlConn"]["Host"];
                $this->DbNam=$Decoded["mySqlConn"]["DbNam"];
                $this->UsrNam=$Decoded["mySqlConn"]["UsrNam"];
                $this->Pwd=$Decoded["mySqlConn"]["Pwd"];
                return true;
            }else{
                return false;
            }
            //
        } catch (mysqli_sql_exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
}