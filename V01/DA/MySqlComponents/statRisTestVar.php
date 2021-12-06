<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class statRisTestVar 
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
statRisTestVar(idStatRisTestVar, idStatRisTest, note, minimum, maximum
    */
    
    public $idStatRisTestVar;
    public $idStatRisTest;
    public $idStVar;
    public $note;
    public $minimum;
    public $maximum;
    public $mean;
    public $sd;
    public $variance;
    public $varCoeff;
    
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
                t.idStatRisTestVar,
                t.idStatRisTest,
                t.idStVar,
                t.note,
                t.minimum,
                t.maximum,
                t.mean,
                t.sd,
                t.variance,
                t.varCoeff
            FROM
                statRisTestVar t
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
                t.idStatRisTestVar,
                t.idStatRisTest,
                t.idStVar,
                t.note,
                t.minimum,
                t.maximum,
                t.mean,
                t.sd,
                t.variance,
                t.varCoeff
            FROM
                statRisTestVar t
            WHERE
                idStatRisTestVar = '"
                . $this->idStatRisTestVar
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
            // statRisTestVar(t.idStatRisTestVar,t.idStatRisTest,t.idStVar,t.note,
            // t.minimum,t.maximum,t.mean,t.sd,t.variance,t.varCoeff
            // query to insert record
            $query = "INSERT INTO  statRisTestVar
                        (idStatRisTest, note, minimum, maximum, mean, sd, variance, varCoeff)
                  VALUES
                        (" . VN($this->idStatRisTest) . ",
                         " . VN($this->idStVar) . ",
                         " . VN($this->note) . ",
                         " . VN($this->minimum) . ",
                         " . VN($this->maximum) . ",
                         " . VN($this->mean) . ",
                         " . VN($this->sd) . ",
                         " . VN($this->variance) . ",
                         " . VN($this->varCoeff) . ",
                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->idStatRisTestVar = $this->conn->insert_id;
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
                    statRisTestVar
                SET
                    idStatRisTest=" . VN($this->idStatRisTest) . ", 
                    idStVar=" .       VN($this->idStVar) . ", 
                    note=" .            VN($this->note) . ",
                    minimum=" .         VN($this->minimum) . ",
                    maximum=" .         VN($this->maximum) . ",
                    mean=" .            VN($this->mean) . ",
                    sd=" .              VN($this->sd) . ",
                    variance=" .        VN($this->variance) . ",
                    varCoeff=" .        VN($this->varCoeff) . ",
                WHERE
                    idStatRisTestVar = " . $this->idStatRisTestVar;
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
            $query = "DELETE from statRisTestVar 
                WHERE idStatRisTestVar = '" . $this->idStatRisTestVar . "'";
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
