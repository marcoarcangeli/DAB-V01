<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class Organization 
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
    */
    
    public $IdOrganization;
    public $Nam;
    public $Descr;
    public $CodeParams;
    public $Dttm;
    
    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read all testEntitys
    public function selectAll()
    {
        try {

            $query = "
            SELECT
                t.IdOrganization,
                t.Nam,
                t.Descr,
                t.CodeParams,
                t.Dttm
            FROM
                Organization t
            ORDER BY
                t.Dttm desc
            ";
            //throw new exception($query."\n");
            // prepare query statement
            $Stmt = mysqli_query($this->conn, $query);

            return $Stmt;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // get single testEntity data
    public function selectSingle()
    {
        //throw new exception("this->idVideo: ".$this->idVideo."\n");
        try {
            // select all query
            $query = "
            SELECT
                t.IdOrganization,
                t.Nam,
                t.Descr,
                t.CodeParams,
                t.Dttm
            FROM
                Organization t
            WHERE
                t.IdOrganization = '"
                . $this->IdOrganization
                . "'";
            // echo $query."\n";
            //throw new exception($query."\n");
            // prepare query statement
            $Stmt = mysqli_query($this->conn, $query);
            //throw new exception("righe trovate ".$Stmt->num_rows."\n");
            // execute query
            return $Stmt;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // get single testEntity data
    public function selectSingleActual()
    {
        //throw new exception("this->idVideo: ".$this->idVideo."\n");
        try {
            // select all query
            $query = "
            SELECT
                t.IdOrganization,
                t.Nam,
                t.Descr,
                t.CodeParams,
                t.Dttm
            FROM
                Organization t
            WHERE
                t.Dttm <= NOW()
            order by 
                t.Dttm desc
            limit 1
            ";
            // echo $query."\n";
            //throw new exception($query."\n");
            // prepare query statement
            $Stmt = mysqli_query($this->conn, $query);
            //throw new exception("righe trovate ".$Stmt->num_rows."\n");
            // execute query
            return $Stmt;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // create testEntity
    public function insert()
    {
        try {
            //if ($this->alreadyExist()) {
            //    return false;
            //}
            // Organization(IdOrganization, IdOrganizationState, IdOrganizationCat, Nam, Descr, CodeParams, timestamp, IdUsr)

            // query to insert record
            $query = "INSERT INTO  Organization
                        (Nam, Descr, Dttm, CodeParams)
                  VALUES (
                         " . VN($this->Nam) . ",
                         " . VN($this->Descr) . ",
                         " . VN($this->Dttm) . ",
                         " . VN($this->CodeParams) . "
                         )";
            if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","query: ".$query); }
            // throw new exception($query."\n");
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->IdOrganization = $this->conn->insert_id;
                return true;
            }
            return false;
        } catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // update testEntity 
    public function update()
    {
        try {
            // query to insert record
            $query = "UPDATE
                    Organization
                SET
                    Nam=" .VN($this->Nam) . ",
                    Descr=" .VN($this->Descr) . ",
                    Dttm=" .VN($this->Dttm) . ",
                    CodeParams=" .VN($this->CodeParams) . "
                WHERE
                    IdOrganization = " . $this->IdOrganization;
            // throw new exception($query."\n");

            // prepare query
            $Stmt = mysqli_query($this->conn, $query);
            //throw new exception($Stmt."\n");

            // execute query
            if ($Stmt) {
                return true;
            }
            return false;
        } catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // delete testEntity
    public function delete()
    {
        try {
            // inizio transazione
            $mysqli = $this->conn;
            // $mysqli->begin_transaction();
            // //update pp1_video flags
            // $numPreCodeParamszioni = $this->numPreCodeParamszioni();
            // $numNoleggi = $this->numNoleggi();
            // if ($numNoleggi != '0' || $numPreCodeParamszioni != '0') {
            //     throw new exception("Cliente non cancellabile. Almeno una PreCodeParamszione o un Noleggio effettuato.\n");
            // } 
            // query to delete record profilo 
            // $query = "DELETE from profilo 
            //     WHERE idProfilo = '" . $this->idProfilo . "'";
            // //throw new exception($query."\n");
            // // prepare query statement
            // $Stmt = mysqli_query($this->conn, $query);
            // //throw new exception("righe trovate ".$Stmt->num_rows."\n");

            // query to delete record usr
            $query = "DELETE from Organization 
                WHERE IdOrganization = '" . $this->IdOrganization . "'";
            //throw new exception($query."\n");
            // prepare query statement
            $Stmt = mysqli_query($this->conn, $query);
            //throw new exception("righe trovate ".$Stmt->num_rows."\n");
            // execute query
            // $mysqli->rollback();
            // $mysqli->commit();

            if ($Stmt) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $e) {
            // $mysqli->rollback();
            LM::LogMessage("ERROR", $e);
            return false;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }   
    }

}
