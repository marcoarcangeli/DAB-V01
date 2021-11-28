<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class SplitCat
{
    // database connection and table name
    private $Conn;

    // object properties
    /*  
SplitCat(IdSplitCat, Nam, Descr, timestamp, IdUsr)
    */
    public $IdSplitCat;
    public $IdSplitCatPar;
    public $Nam;
    public $Descr;
    
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
                p.IdSplitCat,
                p.IdSplitCatPar,
                pp.Nam AS SplitCatParNam,
                p.Nam,
                p.Descr
            FROM
                SplitCat p
                LEFT OUTER JOIN SplitCat pp ON p.IdSplitCatPar = pp.IdSplitCat
            ORDER BY
                pp.Nam,p.Nam
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
                p.IdSplitCat,
                p.IdSplitCatPar,
                pp.Nam AS SplitCatParNam,
                p.Nam,
                p.Descr
            FROM
                SplitCat p
                LEFT OUTER JOIN SplitCat pp ON p.IdSplitCatPar = pp.IdSplitCat
            where p.IdSplitCat=" 
                . $this->IdSplitCat;
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
    /*  SplitCat(IdSplitCat, Nam, Descr, timestamp, IdUsr)

    */

    // create testEntity
    public function insert()
    {
        try {
            //if ($this->alreadyExist()) {
            //    return false;
            //}

            // query to insert record
            $query = "INSERT INTO  SplitCat
                        (IdSplitCatPar, Nam, Descr)
                  VALUES
                        (
                         " . VN($this->IdSplitCatPar) . ",
                         " . VN($this->Nam) . ",
                         " . VN($this->Descr) . "
                         )";
            // throw new exception($query."\n");
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->IdSplitCat = $this->conn->insert_id;
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
                    SplitCat
                SET
                    IdSplitCatPar="   .VN($this->IdSplitCatPar) . ",
                    Nam="           .VN($this->Nam) . ",
                    Descr="         .VN($this->Descr) . "
                WHERE
                    IdSplitCat='" . $this->IdSplitCat . "'";
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
            $query = "DELETE from SplitCat 
                WHERE IdSplitCat = '" . $this->IdSplitCat . "'";
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
