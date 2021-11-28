<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class ParamType
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
    IdParamTypeCat int not null primary key auto_increment,
	UsrNam varchar(30) not null,
	Pwd varchar(30) not null,
	idProfilo int not null
ParamType(IdParamType, IdParamTypeCat, Nam, Descr, Unit, timestamp, IdUsr)

    */
    public $IdParamType;
    public $IdParamTypeCat;
    public $Nam;
    public $Descr;
    public $Unit;
    public $vlDefault;
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
                e.IdParamType,
                e.IdParamTypeCat,
                c.Nam as ParamTypeCatNam,
                e.Nam,
                e.Descr,
                e.Unit,
                e.vlDefault
            FROM
                ParamType e
                LEFT OUTER JOIN ParamTypeCat c on e.IdParamTypeCat=c.IdParamTypeCat
            ORDER BY
                e.Nam
            ";
            // throw new exception($query."\n");
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
                e.IdParamType,
                e.IdParamTypeCat,
                c.Nam as ParamTypeCatNam,
                e.Nam,
                e.Descr,
                e.Unit,
                e.vlDefault
            FROM
                ParamType e
                LEFT OUTER JOIN ParamTypeCat c on e.IdParamTypeCat=c.IdParamTypeCat
            WHERE 
                IFNULL(e.IdParamTypeCat, '') LIKE '" . $this->IdParamTypeCat . "%'
            ORDER BY
                e.Nam
            ";
            // throw new exception($query."\n");
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
                e.IdParamType,
                e.IdParamTypeCat,
                c.Nam as ParamTypeCatNam,
                e.Nam,
                e.Descr,
                e.Unit,
                e.vlDefault
            FROM
                ParamType e
                LEFT OUTER JOIN ParamTypeCat c on e.IdParamTypeCat=c.IdParamTypeCat
            WHERE 
                e.IdParamTypeCat IN (" . $this->SearchIds . ")
            ORDER BY
                e.Nam
            ";
            // throw new exception($query."\n");
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
                e.IdParamType,
                e.IdParamTypeCat,
                c.Nam as ParamTypeCatNam,
                e.Nam,
                e.Descr,
                e.Unit,
                e.vlDefault
            FROM
                ParamType e
                LEFT OUTER JOIN ParamTypeCat c on e.IdParamTypeCat=c.IdParamTypeCat
            WHERE
                IdParamType = '"
                . $this->IdParamType
                . "'";
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
            // ParamType(IdParamType, IdParamTypeCat, Nam, Descr, Unit, fileRefDatiParamType)

            // query to insert record
            $query = "INSERT INTO  ParamType
                        (IdParamTypeCat, Nam, Descr, Unit, vlDefault)
                  VALUES
                        (" . VN($this->IdParamTypeCat) . ",
                         " . VN($this->Nam) . ",
                         " . VN($this->Descr) . ",
                         " . VN($this->Unit) . ",
                         " . VN($this->vlDefault) . "
                         )";
            // throw new exception($query."\n");
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->IdParamType = $this->conn->insert_id;
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
                    ParamType
                SET
                    IdParamTypeCat=" .VN($this->IdParamTypeCat) . ", 
                    Nam="           .VN($this->Nam) . ",
                    Descr="         .VN($this->Descr) . ",
                    Unit="          .VN($this->Unit) . ",
                    vlDefault="          .VN($this->vlDefault) . "
                WHERE
                    IdParamType = " . $this->IdParamType;
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
            $query = "DELETE from ParamType 
                WHERE IdParamType = '" . $this->IdParamType . "'";
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
