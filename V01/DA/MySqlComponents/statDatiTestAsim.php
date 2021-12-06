<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class statDatiTestAsim 
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
StatDatiTestAsim(idStatDatiTestAsim, idStatDatiTest, note, mediaModa, coefPearson1
    */
    
    public $idStatDatiTestAsim;
    public $idStatDatiTest;
    public $idStVar;
    public $note;
    public $mediaModa;
    public $coefPearson1;
    public $coefPearson2;
    
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
                t.idStatDatiTestAsim,
                t.idStatDatiTest,
                t.idStVar,
                t.note,
                t.mediaModa,
                t.coefPearson1,
                t.coefPearson2
            FROM
                StatDatiTestAsim t
            ORDER BY
                t.idStatDatiTest
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
                t.idStatDatiTestAsim,
                t.idStatDatiTest,
                t.idStVar,
                t.note,
                t.mediaModa,
                t.coefPearson1,
                t.coefPearson2
            FROM
                StatDatiTestAsim t
            WHERE
                idStatDatiTestAsim = '"
                . $this->idStatDatiTestAsim
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
            // StatDatiTestAsim(t.idStatDatiTestAsim,t.idStatDatiTest,t.idStVar,t.note,
            // t.mediaModa,t.coefPearson1,t.coefPearson2,t.armonica,t.moda,t.mediana
            // query to insert record
            $query = "INSERT INTO  StatDatiTestAsim
                        (idStatDatiTest, note, mediaModa, coefPearson1, coefPearson2)
                  VALUES
                        (" . VN($this->idStatDatiTest) . ",
                         " . VN($this->idStVar) . ",
                         " . VN($this->note) . ",
                         " . VN($this->mediaModa) . ",
                         " . VN($this->coefPearson1) . ",
                         " . VN($this->coefPearson2) . ",
                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->idStatDatiTestAsim = $this->conn->insert_id;
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
                    StatDatiTestAsim
                SET
                    idStatDatiTest=" .    VN($this->idStatDatiTest) . ", 
                    idStVar=" .    VN($this->idStVar) . ", 
                    note=" .        VN($this->note) . ",
                    mediaModa=" . VN($this->mediaModa) . ",
                    coefPearson1=" .     VN($this->coefPearson1) . ",
                    coefPearson2=" .     VN($this->coefPearson2) . ",
                WHERE
                    idStatDatiTestAsim = " . $this->idStatDatiTestAsim;
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
            // $numPreminzioni = $this->numPreminzioni();
            // $numNoleggi = $this->numNoleggi();
            // if ($numNoleggi != '0' || $numPreminzioni != '0') {
            //     throw new exception("Cliente non cancellabile. Almeno una Preminzione o un Noleggio effettuato.\n");
            // } 
            // query to delete record profilo 
            // $query = "DELETE from profilo 
            //     WHERE idProfilo = '" . $this->idProfilo . "'";
            // //throw new exception($query."\n");
            // // prepare query statement
            // $Stmt = mysqli_query($this->conn, $query);
            // //throw new exception("righe trovate ".$Stmt->num_rows."\n");

            // query to delete record usr
            $query = "DELETE from StatDatiTestAsim 
                WHERE idStatDatiTestAsim = '" . $this->idStatDatiTestAsim . "'";
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
