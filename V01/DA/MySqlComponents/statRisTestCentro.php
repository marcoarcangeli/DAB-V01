<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class statRisTestCentro 
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
StatRisTestCentro(idStatRisTestCentro, idStatRisTest, note, aritmetica, geometrica
    */
    
    public $idStatRisTestCentro;
    public $idStatRisTest;
    public $idStVar;
    public $note;
    public $aritmetica;
    public $geometrica;
    public $quadratica;
    public $armonica;
    public $moda;
    public $mediana;
    
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
                t.idStatRisTestCentro,
                t.idStatRisTest,
                t.idStVar,
                t.note,
                t.aritmetica,
                t.geometrica,
                t.quadratica,
                t.armonica,
                t.moda,
                t.mediana
            FROM
                StatRisTestCentro t
            ORDER BY
                t.idStatRisTest
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
                t.idStatRisTestCentro,
                t.idStatRisTest,
                t.idStVar,
                t.note,
                t.aritmetica,
                t.geometrica,
                t.quadratica,
                t.armonica,
                t.moda,
                t.mediana
            FROM
                StatRisTestCentro t
            WHERE
                idStatRisTestCentro = '"
                . $this->idStatRisTestCentro
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
            // StatRisTestCentro(t.idStatRisTestCentro,t.idStatRisTest,t.idStVar,t.note,
            // t.aritmetica,t.geometrica,t.quadratica,t.armonica,t.moda,t.mediana
            // query to insert record
            $query = "INSERT INTO  StatRisTestCentro
                        (idStatRisTest, note, aritmetica, geometrica, quadratica, armonica, moda, mediana)
                  VALUES
                        (" . VN($this->idStatRisTest) . ",
                         " . VN($this->idStVar) . ",
                         " . VN($this->note) . ",
                         " . VN($this->aritmetica) . ",
                         " . VN($this->geometrica) . ",
                         " . VN($this->quadratica) . ",
                         " . VN($this->armonica) . ",
                         " . VN($this->moda) . ",
                         " . VN($this->mediana) . ",
                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->idStatRisTestCentro = $this->conn->insert_id;
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
                    StatRisTestCentro
                SET
                    idStatRisTest=" .    VN($this->idStatRisTest) . ", 
                    idStVar=" .    VN($this->idStVar) . ", 
                    note=" .        VN($this->note) . ",
                    aritmetica=" . VN($this->aritmetica) . ",
                    geometrica=" .     VN($this->geometrica) . ",
                    quadratica=" .     VN($this->quadratica) . ",
                    armonica=" .     VN($this->armonica) . ",
                    moda=" .     VN($this->moda) . ",
                    mediana=" .     VN($this->mediana) . ",
                WHERE
                    idStatRisTestCentro = " . $this->idStatRisTestCentro;
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }

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
            // $numPreminzioni = $this->numPreminzioni();
            // $numNoleggi = $this->numNoleggi();
            // if ($numNoleggi != '0' || $numPreminzioni != '0') {
            //     throw new exception("Cliente non cancellabile. Almeno una Preminzione o un Noleggio effettuato.\n");
            // } 
            // query to delete record profilo 
            // $query = "DELETE from profilo 
            //     WHERE idProfilo = '" . $this->idProfilo . "'";
            // //throw new exception($query."\n");
            // // prepare query statement
            // $Stmt = mysqli_query($this->conn, $query);
            // //throw new exception("righe trovate ".$Stmt->num_rows."\n");

            // query to delete record usr
            $query = "DELETE from StatRisTestCentro 
                WHERE idStatRisTestCentro = '" . $this->idStatRisTestCentro . "'";
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
