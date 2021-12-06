<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class SplitType
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
    IdSplitCat int not null primary key auto_increment,
	UsrNam varchar(30) not null,
	Pwd varchar(30) not null,
	idProfilo int not null
splittype (idSplitType, idSplitCat, nam, descr, perc)

    */
    public $IdSplitType;
    public $IdSplitCat;
    public $Nam;
    public $Descr;
    public $Perc;
    public $SearchIds;

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
                e.IdSplitType,
                e.IdSplitCat,
                c.Nam as SplitCatNam,
                e.Nam,
                e.Descr,
                e.Perc
            FROM
                SplitType e
                LEFT OUTER JOIN SplitCat c on e.IdSplitCat=c.IdSplitCat
            ORDER BY
                e.Nam
            ";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query statement
            $Stmt = mysqli_query($this->conn, $query);

            return $Stmt;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function selectCat()
    {
        try {

            $query = "
            SELECT
                e.IdSplitType,
                e.IdSplitCat,
                c.Nam as SplitCatNam,
                e.Nam,
                e.Descr,
                e.Perc
            FROM
                SplitType e
                LEFT OUTER JOIN SplitCat c on e.IdSplitCat=c.IdSplitCat
            WHERE 
                IFNULL(e.IdSplitCat, '') LIKE '" . $this->IdSplitCat . "%'
            ORDER BY
                e.Nam
            ";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query statement
            $Stmt = mysqli_query($this->conn, $query);

            return $Stmt;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    public function selectSearchIds()
    {
        try {

            $query = "
            SELECT
                e.IdSplitType,
                e.IdSplitCat,
                c.Nam as SplitCatNam,
                e.Nam,
                e.Descr,
                e.Perc
            FROM
                SplitType e
                LEFT OUTER JOIN SplitCat c on e.IdSplitCat=c.IdSplitCat
            WHERE 
                e.IdSplitCat IN (" . $this->SearchIds . ")
            ORDER BY
                e.Nam
            ";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
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
                e.IdSplitType,
                e.IdSplitCat,
                c.Nam as SplitCatNam,
                e.Nam,
                e.Descr,
                e.Perc
            FROM
                SplitType e
                LEFT OUTER JOIN SplitCat c on e.IdSplitCat=c.IdSplitCat
            WHERE
                IdSplitType = '"
                . $this->IdSplitType
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
            // SplitType(IdSplitType, IdSplitCat, Nam, Descr,fileRefDatiSplitType)

            // query to insert record
            $query = "INSERT INTO  SplitType
                        (IdSplitCat, Nam, Descr, Perc)
                  VALUES
                        (" . VN($this->IdSplitCat) . ",
                         " . VN($this->Nam) . ",
                         " . VN($this->Descr) . ",
                         " . VN($this->Perc) . "
                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->IdSplitType = $this->conn->insert_id;
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
                    SplitType
                SET
                    IdSplitCat=" .VN($this->IdSplitCat) . ", 
                    Nam="           .VN($this->Nam) . ",
                    Descr="         .VN($this->Descr) . ",
                    Perc="          .VN($this->Perc) . "
                WHERE
                    IdSplitType = " . $this->IdSplitType;
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
            $query = "DELETE from SplitType 
                WHERE IdSplitType = '" . $this->IdSplitType . "'";
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
