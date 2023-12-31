<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class parametroOpDatCat
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
    idOpDatCat int not null primary key auto_increment,
	UsrNam varchar(30) not null,
	Pwd varchar(30) not null,
	idProfilo int not null
ParametroOpDatCat(idParametroOpDatCat, idOpDatCat, Nam, descr, unit, timestamp, IdUsr)

    */
    public $idParametroOpDatCat;
    public $idOpDatCat;
    public $Nam;
    public $Descr;
    public $unit;

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
                e.idParametroOpDatCat,
                e.idOpDatCat,
                e.Nam,
                e.descr,
                e.unit
            FROM
                parametroOpDatCat e
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
                e.idParametroOpDatCat,
                e.idOpDatCat,
                e.Nam,
                e.descr,
                e.unit
            FROM
                parametroOpDatCat e
            WHERE
                idParametroOpDatCat = '"
                . $this->idParametroOpDatCat
                . "' or idOpDatCat = '"
                . $this->idOpDatCat
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
            // parametroOpDatCat(idParametroOpDatCat, idOpDatCat, Nam, descr, unit, fileRefDatiparametroOpDatCat)

            // query to insert record
            $query = "INSERT INTO  parametroOpDatCat
                        (idOpDatCat, Nam, descr, unit)
                  VALUES
                        (" . VN($this->idOpDatCat) . ",
                         " . VN($this->Nam) . ",
                         " . VN($this->descr) . ",
                         " . VN($this->unit) . "
                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->idParametroOpDatCat = $this->conn->insert_id;
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
                    parametroOpDatCat
                SET
                    idOpDatCat=" .    VN($this->idOpDatCat) . ", 
                    Nam=" .                    VN($this->Nam) . ",
                    descr=" .             VN($this->descr) . ",
                    unit=" .             VN($this->unit) . "
                WHERE
                    idParametroOpDatCat = " . $this->idParametroOpDatCat;
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
            $query = "DELETE from parametroOpDatCat 
                WHERE idParametroOpDatCat = '" . $this->idParametroOpDatCat . "'";
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
