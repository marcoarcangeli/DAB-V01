<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class Evnt
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
    Evnt (IdEvnt, IdPrj, IdEvntCat, nam, Descr, fileRefRepoDat, fileRefEvntDat)
    */
    public $IdEvnt;
    public $IdPrj;
    public $IdEvntCat;
    public $Nam;
    public $Descr;
    public $fileRefRepoDat;
    public $CatTag;
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
                e.IdEvnt,
                e.IdPrj,
                e.IdEvntCat,
                c.Nam as EvntCatNam,
                e.Nam,
                e.Descr,
                e.fileRefRepoDat,
                e.CatTag
            FROM
                Evnt e
                LEFT JOIN EvntCat c ON e.IdEvntCat = c.IdEvntCat
            ORDER BY
                e.Nam
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
                e.IdEvnt,
                e.IdPrj,
                e.IdEvntCat,
                c.Nam as EvntCatNam,
                e.Nam,
                e.Descr,
                e.fileRefRepoDat,
                e.CatTag
            FROM
                Evnt e
                LEFT JOIN EvntCat c ON e.IdEvntCat = c.IdEvntCat
            WHERE
                IdEvnt = '"
                . $this->IdEvnt
                // . "' or IdPrj = '"
                // . $this->IdPrj
                . "'";
            // echo $query."\n";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
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
            // Evnt(IdEvnt, IdPrj, Nam, Descr, fileRefRepoDat, fileRefEvntDat)

            // query to insert record
            $query = "INSERT INTO  Evnt
                        (IdPrj, IdEvntCat,Nam, Descr, fileRefRepoDat,CatTag)
                  VALUES
                        (" . VN($this->IdPrj) . ",
                         " . VN($this->IdEvntCat) . ",
                         " . VN($this->Nam) . ",
                         " . VN($this->Descr) . ",
                         " . VN($this->fileRefRepoDat) . ",
                         " . VN($this->CatTag) . "
                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->IdEvnt = $this->conn->insert_id;
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
                    Evnt
                SET
                    IdPrj="             . VN($this->IdPrj) . ", 
                    IdEvntCat="         . VN($this->IdEvntCat) . ",
                    Nam="               . VN($this->Nam) . ",
                    Descr="             . VN($this->Descr) . ",
                    fileRefRepoDat="    . VN($this->fileRefRepoDat) . ",
                    CatTag="            .VN($this->CatTag) . "
                WHERE
                    IdEvnt = " . $this->IdEvnt;
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
            $query = "DELETE from Evnt 
                WHERE IdEvnt = '" . $this->IdEvnt . "'";
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
