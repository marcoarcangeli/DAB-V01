<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class test
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
Test(idTest, idStatisticaDatiTest, idStatisticaRisultatiTest, fileRefTestDat, fileRefTestResDat, note, timestamp, IdUsr)
    */

    public $IdTest;
    public $IdAnCntx;
    public $note;
    public $fileRefTestDat;
    public $fileRefTestResDat;

    public $timestamp;
    public $IdUsr;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read all TestEntitys
    public function selectAll()
    {
        try {

            $query = "
            SELECT
                p.idTest,
                p.IdAnCntx,
                p.fileRefTestDat ,
                p.fileRefTestResDat ,
                p.note
            FROM
                Test p
            ORDER BY
                p.idTest
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

    // get single TestEntity data
    public function selectSingle()
    {
        //throw new exception("this->idVideo: ".$this->idVideo."\n");
        try {
            // select all query
            $query = "
            SELECT
                p.idTest,
                p.IdAnCntx,
                p.fileRefTestDat ,
                p.fileRefTestResDat ,
                p.note
            FROM
                Test p
            WHERE
                idTest = '"
                . $this->idTest
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

    // create TestEntity
    public function insert()
    {
        try {
            //if ($this->alreadyExist()) {
            //    return false;
            //}
            // Test(idTest, idStatisticaDatiTest, idStatisticaRisultatiTest, fileRefTestDat, fileRefTestResDat, note, timestamp, IdUsr)

            // query to insert record
            $query = "INSERT INTO  Test
                        (IdAnCntx, fileRefTestDat, fileRefTestResDat, note)
                  VALUES
                        (" . VN($this->IdAnCntx) . ",
                         " . VN($this->fileRefTestDat) . ",
                         " . VN($this->fileRefTestResDat) . ",
                         " . VN($this->note) . "
                         )";
            // throw new exception($query."\n");
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->idTest = $this->conn->insert_id;
                return true;
            }
            return false;
        } catch (Exception $e) {
    LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // update TestEntity 
    public function update()
    {
        try {
            // query to insert record
            $query = "UPDATE
                    Test
                SET
                    IdAnCntx=" .        VN($this->IdAnCntx) . ",
                    fileRefTestDat=" .             VN($this->fileRefTestDat) . ",
                    fileRefTestResDat=" .    VN($this->fileRefTestResDat) . ",
                    note=" .                        VN($this->note) . ",
                WHERE
                    idTest = " . $this->idTest;
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

    // delete TestEntity
    public function delete()
    {
        try {
            // inizio transazione
            $mysqli = $this->conn;
            // $mysqli->begin_transaction();
            // //update pp1_video flags
            // $numPrenotezioni = $this->numPrenotezioni();
            // $numNoleggi = $this->numNoleggi();
            // if ($numNoleggi != '0' || $numPrenotezioni != '0') {
            //     throw new exception("Cliente non cancellabile. Almeno una Prenotezione o un Noleggio effettuato.\n");
            // } 
            // query to delete record profilo 
            // $query = "DELETE from profilo 
            //     WHERE idProfilo = '" . $this->idProfilo . "'";
            // //throw new exception($query."\n");
            // // prepare query statement
            // $Stmt = mysqli_query($this->conn, $query);
            // //throw new exception("righe trovate ".$Stmt->num_rows."\n");

            // query to delete record usr
            $query = "DELETE from Test 
                WHERE idTest = '" . $this->idTest . "'";
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
