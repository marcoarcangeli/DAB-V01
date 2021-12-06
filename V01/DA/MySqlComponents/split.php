<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class split
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
Split(idSplit, idSplitCat, IdAnCntx, note, timestamp, IdUsr)

    */

    public $idSplit;
    public $idSplitCat;
    public $IdAnCntx;
    public $note;

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
                p.idSplit,
                e.idSplitCat,
                e.Nam AS splitCatNam,
                p.IdAnCntx,
                c.Nam AS AnCntxNam,
                p.note
            FROM
                Split p
            JOIN AnCntx c ON
                p.IdAnCntx = c.IdAnCntx
            JOIN splitCat e ON
                p.idSplitCat = e.idSplitCat
            ORDER BY
                p.idSplit
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
                p.idSplit,
                e.idSplitCat,
                e.Nam AS splitCatNam,
                p.IdAnCntx,
                c.Nam AS AnCntxNam,
                p.note
            FROM
                Split p
            JOIN Cntx c ON
                p.IdAnCntx = c.IdAnCntx
            JOIN splitCat e ON
                p.idSplitCat = e.idSplitCat
            WHERE
                p.idSplit = '"
                . $this->idSplit
                . "'OR  p.IdAnCntx = '"
                . $this->IdAnCntx
                . "'
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
            // Split(idSplit, idSplitCat, IdAnCntx, note, timestamp, IdUsr)
            // query to insert record
            $query = "INSERT INTO  Split
                        (idSplitCat, IdAnCntx, note)
                  VALUES
                        (" . VN($this->idSplitCat) . ",
                         " . VN($this->IdAnCntx) . ",
                         " . VN($this->note) . "
                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->idSplit = $this->conn->insert_id;
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
                    Split
                SET
                    idSplitCat="    .VN($this->idSplitCat) . ",
                    IdAnCntx="      .VN($this->IdAnCntx) . ",
                    note="          .VN($this->note) . "
                WHERE
                    idSplit = " . $this->idSplit;
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
            $query = "DELETE from Split 
                WHERE idSplit = '" . $this->idSplit . "'";
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
