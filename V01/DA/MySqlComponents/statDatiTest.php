<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class statDatiTest 
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
StatDatiTest(idStatDatiTest, idTest, note, nDimensioni, nMisure
    */
    
    public $idStatDatiTest;
    public $IdTest;
    public $note;
    public $nDimensioni;
    public $nMisure;
    
    public $timestamp;
    public $IdUsr;

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
                t.idStatDatiTest,
                t.idTest,
                t.note,
                t.nDimensioni,
                t.nMisure
            FROM
                StatDatiTest t
            ORDER BY
                t.idTest
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
                t.idStatDatiTest,
                t.idTest,
                t.note,
                t.nDimensioni,
                t.nMisure
            FROM
                StatDatiTest t
            WHERE
                idStatDatiTest = '"
                . $this->idStatDatiTest
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

    // create testEntity
    public function insert()
    {
        try {
            //if ($this->alreadyExist()) {
            //    return false;
            //}
            // StatDatiTest(idStatDatiTest, idTest, note, nDimensioni
            // query to insert record
            $query = "INSERT INTO  StatDatiTest
                        (idTest, note, nDimensioni, nMisure)
                  VALUES
                        (" . VN($this->idTest) . ",
                         " . VN($this->note) . ",
                         " . VN($this->nDimensioni) . ",
                         " . VN($this->nMisure) . ",
                         )";
            // throw new exception($query."\n");
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->idStatDatiTest = $this->conn->insert_id;
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
                    StatDatiTest
                SET
                    idTest=" .    VN($this->idTest) . ", 
                    note=" .        VN($this->note) . ",
                    nDimensioni=" . VN($this->nDimensioni) . ",
                    nMisure=" .     VN($this->nMisure) . ",
                WHERE
                    idStatDatiTest = " . $this->idStatDatiTest;
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
            // $numPrenDimensionizioni = $this->numPrenDimensionizioni();
            // $numNoleggi = $this->numNoleggi();
            // if ($numNoleggi != '0' || $numPrenDimensionizioni != '0') {
            //     throw new exception("Cliente non cancellabile. Almeno una PrenDimensionizione o un Noleggio effettuato.\n");
            // } 
            // query to delete record profilo 
            // $query = "DELETE from profilo 
            //     WHERE idProfilo = '" . $this->idProfilo . "'";
            // //throw new exception($query."\n");
            // // prepare query statement
            // $Stmt = mysqli_query($this->conn, $query);
            // //throw new exception("righe trovate ".$Stmt->num_rows."\n");

            // query to delete record usr
            $query = "DELETE from StatDatiTest 
                WHERE idStatDatiTest = '" . $this->idStatDatiTest . "'";
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
