<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class parametroAlg
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
    idopDat int not null primary key auto_increment,
	UsrNam varchar(30) not null,
	Pwd varchar(30) not null,
	idProfilo int not null
ParametroAlg(idParametroAlg, valore, idParametroAlgCat, timestamp, IdUsr)

    */

    public $idParametroAlg;
    public $idParametroAlgCat;
    public $idAlg;
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
                p.idParametroAlg,
                p.idParametroAlgCat,
                p.idAlg,
                tod.Nam ,
                tod.unit ,
                p.valore
            FROM
                parametroAlg p
            JOIN parametroAlgCat tod ON
                p.idParametroAlgCat = tod.idParametroAlgCat
            ORDER BY
                p.idParametroAlg
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
                p.idParametroAlg,
                p.idParametroAlgCat,
                p.idAlg,
                tod.Nam ,
                tod.unit ,
                p.valore
            FROM
                parametroAlg p
            JOIN parametroAlgCat tod ON
                p.idParametroAlgCat = tod.idParametroAlgCat
            WHERE
                idParametroAlg = '"
                . $this->idParametroAlg
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
            // ParametroAlg(idParametroAlg, valore, idParametroAlgCat, timestamp, IdUsr)

            // query to insert record
            $query = "INSERT INTO  parametroAlg
                        (valore, idParametroAlgCat, idAlg)
                  VALUES
                        (" . VN($this->valore) . ",
                         " . VN($this->idParametroAlgCat) . ",
                         " . VN($this->idAlg) . "
                         )";
            // throw new exception($query."\n");
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->idParametroAlg = $this->conn->insert_id;
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
                    parametroAlg
                SET
                    valore=" .                      VN($this->valore) . ",
                    idAlg=" .                 VN($this->idAlg) . ",
                    idParametroAlgCat=" .    VN($this->idParametroAlgCat) . "
                WHERE
                    idParametroAlg = " . $this->idParametroAlg;
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
            $query = "DELETE from parametroAlg 
                WHERE idParametroAlg = '" . $this->idParametroAlg . "'";
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
