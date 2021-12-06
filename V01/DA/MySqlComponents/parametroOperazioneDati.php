<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class parametroopDat
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
    idopDat int not null primary key auto_increment,
	UsrNam varchar(30) not null,
	Pwd varchar(30) not null,
	idProfilo int not null
ParametroopDat(idParametroopDat, idopDat, idParametroOpDatCat, valore, timestamp, IdUsr)

    */
    
    public $idParametroopDat;
    public $idopDat;
    public $idParametroOpDatCat;
    public $ParametroOpDatCat;
    public $valore;
    
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
                p.idParametroopDat,
                p.idParametroOpDatCat,
                tod.Nam AS Nam,
                tod.unit AS unit,
                p.valore,
                p.idopDat
            FROM
                parametroopDat p
            JOIN parametroOpDatCat tod ON
                p.idParametroOpDatCat = tod.idParametroOpDatCat
            ORDER BY
                p.idParametroopDat
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
                p.idParametroopDat,
                p.idParametroOpDatCat,
                tod.Nam AS Nam,
                tod.unit AS unit,
                p.valore,
                p.idopDat
            FROM
                parametroopDat p
            JOIN parametroOpDatCat tod ON
                p.idParametroOpDatCat = tod.idParametroOpDatCat
            WHERE
                idParametroopDat = '"
                . $this->idParametroopDat
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
            // ParametroopDat(idParametroopDat, idopDat, idParametroOpDatCat, valore, timestamp, IdUsr)
            // query to insert record
            $query = "INSERT INTO  parametroopDat
                        (idParametroOpDatCat, idopDat, valore)
                  VALUES
                        (" . VN($this->idParametroOpDatCat) . ",
                         " . VN($this->idopDat) . ",
                         " . VN($this->valore) . ",
                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->idParametroopDat = $this->conn->insert_id;
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
                    parametroopDat
                SET
                    idParametroOpDatCat=" .   VN($this->idParametroOpDatCat) . ",
                    idopDat=" .                VN($this->idopDat) . ",
                    valore=" .                          VN($this->valore) . ",
                WHERE
                    idParametroopDat = " . $this->idParametroopDat;
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
            // $numPrevalorezioni = $this->numPrevalorezioni();
            // $numNoleggi = $this->numNoleggi();
            // if ($numNoleggi != '0' || $numPrevalorezioni != '0') {
            //     throw new exception("Cliente non cancellabile. Almeno una Prevalorezione o un Noleggio effettuato.\n");
            // } 
            // query to delete record profilo 
            // $query = "DELETE from profilo 
            //     WHERE idProfilo = '" . $this->idProfilo . "'";
            // //throw new exception($query."\n");
            // // prepare query statement
            // $Stmt = mysqli_query($this->conn, $query);
            // //throw new exception("righe trovate ".$Stmt->num_rows."\n");

            // query to delete record usr
            $query = "DELETE from parametroopDat 
                WHERE idParametroopDat = '" . $this->idParametroopDat . "'";
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
