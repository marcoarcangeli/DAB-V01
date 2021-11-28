<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class Clean
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
clean (IdClean, idPrj, Note)

    */

    public $IdClean;
    public $IdPrj;
    public $Note;
    public $ctsd;
    public $cnsd;
    public $cusd; // da ver 1
    public $filters; // da ver 1

    // public $timestamp;
    // public $IdUsr;

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
                p.IdClean,
                p.IdPrj,
                c.Nam AS PrjNam,
                p.Note,
                p.ctsd,
                p.cnsd,
                p.cusd,
                p.filters
            FROM
                Clean p
                left JOIN Prj c ON p.IdPrj = c.IdPrj
            ORDER BY
                p.IdClean
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
        // throw new exception("selectSingle ".$this->IdClean."\n");
        try {
            // select all query
            $query = "
            SELECT
                p.IdClean,
                p.IdPrj,
                c.Nam AS PrjNam,
                p.Note,
                p.ctsd,
                p.cnsd,
                p.cusd,
                p.filters
            FROM
                Clean p
                left JOIN Prj c ON p.IdPrj = c.IdPrj
            WHERE
                p.IdClean = '"
                . $this->IdClean
                ."'";
            // echo $query."\n";
            // throw new exception($query."\n");
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
            // Clean(IdClean,  Note, timestamp, IdUsr)
            // query to insert record
            $query = "INSERT INTO  Clean
                        (IdPrj,ctsd,cnsd,cusd,filters,Note)
                  VALUES
                        (
                         " . VN($this->IdPrj) . ",
                         " . VN($this->ctsd) . ",
                         " . VN($this->cnsd) . ",
                         " . VN($this->cusd) . ",
                         " . VN($this->filters) . ",
                         " . VN($this->Note) . "
                         )";
            // throw new exception($query."\n");
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->IdClean = $this->conn->insert_id;
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
                    Clean
                SET
                    IdPrj="     . VN($this->IdPrj) . ",
                    Note="      . VN($this->Note) . ",
                    ctsd="      . VN($this->ctsd) . ",
                    cnsd="      . VN($this->cnsd) . ",
                    cusd="      . VN($this->cusd) . ",
                    filters="   . VN($this->filters) . "
                    WHERE
                    IdClean = " . $this->IdClean;
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
            // $numPrenotazioni = $this->numPrenotazioni();
            // $numNoleggi = $this->numNoleggi();
            // if ($numNoleggi != '0' || $numPrenotazioni != '0') {
            //     throw new exception("Cliente non cancellabile. Almeno una Prenotazione o un Noleggio effettuato.\n");
            // } 
            // query to delete record profilo 
            // $query = "DELETE from profilo 
            //     WHERE idProfilo = '" . $this->idProfilo . "'";
            // //throw new exception($query."\n");
            // // prepare query statement
            // $Stmt = mysqli_query($this->conn, $query);
            // //throw new exception("righe trovate ".$Stmt->num_rows."\n");

            // query to delete record usr
            $query = "DELETE from Clean 
                WHERE IdClean = '" . $this->IdClean . "'";
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
        // } catch (mysqli_sql_exception $e) {
        //     // $mysqli->rollback();
        //     LM::LogMessage("ERROR", $e);
            return false;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

}
