<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class rnk
{

    // database connection Prjd table name
    private $Conn;

    // object properties
    /*  
    IdPrj int not null primary key auto_increment,
	UsrNam varchar(30) not null,
	Pwd varchar(30) not null,
	idProfilo int not null
rnk(idRnk, IdPrj, note, timestamp, IdUsr)

    */

    public $IdRnk;
    public $IdPrj;
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
                p.idRnk,
                e.IdPrj,
                e.Nam AS PrjNam,
                p.note
            FROM
                rnk p
            JOIN Prj e ON
                p.IdPrj = e.IdPrj
            ORDER BY
                p.idRnk
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
                p.idRnk,
                e.IdPrj,
                e.Nam AS PrjNam,
                p.note
            FROM
                rnk p
            JOIN Prj e ON
                p.IdPrj = e.IdPrj
            WHERE
                p.idRnk = '"
                . $this->idRnk
                . "'OR  p.IdPrj = '"
                . $this->IdPrj
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
            // rnk(idRnk, IdPrj, note, timestamp, IdUsr)
            // query to insert record
            $query = "INSERT INTO  rnk
                        (IdPrj, note)
                  VALUES
                        (" . VN($this->IdPrj) . ",
                         " . VN($this->note) . "
                         )";
            // throw new exception($query."\n");
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->idRnk = $this->conn->insert_id;
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
                    rnk
                SET
                    IdPrj=" .    VN($this->IdPrj) . ",
                    note=" .        VN($this->note) . "
                WHERE
                    idRnk = " . $this->idRnk;
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
            // inizio trPrjsazione
            $mysqli = $this->conn;
            // $mysqli->begin_trPrjsaction();
            // //update pp1_video flags
            // $numPrenotazioni = $this->numPrenotazioni();
            // $numNoleggi = $this->numNoleggi();
            // if ($numNoleggi != '0' || $numPrenotazioni != '0') {
            //     throw new exception("Cliente non cPrjcellabile. Almeno una Prenotazione o un Noleggio effettuato.\n");
            // } 
            // query to delete record profilo 
            // $query = "DELETE from profilo 
            //     WHERE idProfilo = '" . $this->idProfilo . "'";
            // //throw new exception($query."\n");
            // // prepare query statement
            // $Stmt = mysqli_query($this->conn, $query);
            // //throw new exception("righe trovate ".$Stmt->num_rows."\n");

            // query to delete record usr
            $query = "DELETE from rnk 
                WHERE idRnk = '" . $this->idRnk . "'";
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
