<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class opDat
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
    idPrj int not null primary key auto_increment,
	UsrNam varchar(30) not null,
	Pwd varchar(30) not null,
	idProfilo int not null
opDat(idopDat, IdClean, idOpDatCat, execOr, descr, timestamp, IdUsr)

    */
    
    public $idopDat;
    public $IdClean;
    public $IdPrj;
    public $Nam;
    public $idOpDatCat;
    public $opDatCat;
    public $execOr;
    public $Descr;
    
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
                t.idopDat,
                t.IdClean,
                t.idOpDatCat,
                t.Nam,
                tod.Nam as opDatCat,
                t.execOr,
                t.descr
            FROM
                opDat t
            JOIN OpDatCat tod ON
                t.idOpDatCat = tod.idOpDatCat
            ORDER BY
                t.execOr
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
                t.idopDat,
                t.IdClean,
                t.idOpDatCat,
                t.Nam,
                tod.Nam as OpDatCat,
                t.execOr,
                t.descr
            FROM
                opDat t
            JOIN OpDatCat tod ON
                t.idOpDatCat = tod.idOpDatCat
            WHERE
                idopDat = '"
                . $this->idopDat
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
            // opDat(idopDat, IdClean, Nam,idOpDatCat, execOr, descr, timestamp, IdUsr)

            // query to insert record
            $query = "INSERT INTO  opDat
                        (IdClean, Nam,idOpDatCat, execOr, descr)
                  VALUES
                        (" . VN($this->IdClean) . ",
                         " . VN($this->Nam) . ",
                         " . VN($this->idOpDatCat) . ",
                         " . VN($this->execOr) . ",
                         " . VN($this->descr) . ",
                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->idopDat = $this->conn->insert_id;
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
                    opDat
                SET
                    IdClean="               .VN($this->IdClean) . ", 
                    Nam="                   .VN($this->Nam) . ",
                    idOpDatCat="            .VN($this->idOpDatCat) . ",
                    execOr="                .VN($this->execOr) . ",
                    descr="                 .VN($this->descr) . ",
                WHERE
                    idopDat = " . $this->idopDat;
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
            $query = "DELETE from opDat 
                WHERE idopDat = '" . $this->idopDat . "'";
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
