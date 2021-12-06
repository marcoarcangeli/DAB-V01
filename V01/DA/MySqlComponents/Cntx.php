<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class Cntx
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
    IdPrj int not null primary key auto_increment,
	UsrNam varchar(30) not null,
	Pwd varchar(30) not null,
	idProfilo int not null
cntx (IdCntx, IdPrj, IdEvnt, nam, Descr, fileRefDat

    */
    public $IdCntx;
    public $IdPrj;
    public $IdEvnt;
    public $Nam;
    public $Descr;
    public $fileRefDat;
    public $ctsd;
    public $cnsd;
    public $cusd; // da ver 1

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
                c.IdCntx,
                c.IdPrj,
                p.Nam as PrjNam,
                c.IdEvnt,
                e.Nam as EvntNam,
                c.Nam,
                c.Descr,
                c.fileRefDat,
                c.ctsd,
                c.cnsd,
                c.cusd
            FROM
                Cntx c
                join evnt e on c.IdEvnt=e.IdEvnt
                join prj p on c.IdPrj=p.IdPrj
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
                c.IdCntx,
                c.IdPrj,
                p.Nam as PrjNam,
                c.IdEvnt,
                e.Nam as EvntNam,
                c.Nam,
                c.Descr,
                c.fileRefDat,
                c.ctsd,
                c.cnsd,
                c.cusd
            FROM
                Cntx c
                join evnt e on c.IdEvnt=e.IdEvnt
                join prj p on c.IdPrj=p.IdPrj
            WHERE
                IdCntx = '"
                . $this->IdCntx
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
            // Cntx(IdCntx, IdPrj, IdEvnt, Nam, Descr, fileRefDat, timestamp, IdUsr)


            // query to insert record
            $query = "INSERT INTO  Cntx
                        (IdPrj, IdEvnt, Nam, Descr, fileRefDat,ctsd,cnsd,cusd)
                  VALUES
                        (
                         " . VN($this->IdPrj) . ",
                         " . VN($this->IdEvnt) . ",
                         " . VN($this->Nam) . ",
                         " . VN($this->Descr) . ",
                         " . VN($this->fileRefDat) . ",
                         " . VN($this->ctsd) . ",
                         " . VN($this->cnsd) . ",
                         " . VN($this->cusd) . "

                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->IdCntx = $this->conn->insert_id;
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
                    Cntx
                SET
                    IdPrj="             . VN($this->IdPrj) . ", 
                    IdEvnt="            . VN($this->IdEvnt) . ",
                    Nam="               . VN($this->Nam) . ",
                    Descr="             . VN($this->Descr) . ",
                    fileRefDat="        . VN($this->fileRefDat) . ",
                    ctsd="              . VN($this->ctsd) . ",
                    cnsd="              . VN($this->cnsd) . ",
                    cusd="              . VN($this->cusd) . "
                WHERE
                    IdCntx = " . $this->IdCntx;
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
            $query = "DELETE from Cntx 
                WHERE IdCntx = '" . $this->IdCntx . "'";
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
