<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class statDatiEvntVarMappaAnomalie 
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
statDatiEvntVarMappaAnomalie(idStatDatiEvntVariabiliMappaAnomalie, idStatDatiEvntVar, nMancanze, nErrori, nAltreAnomalie
    */
    
    public $idStatDatiEvntVariabiliMappaAnomalie;
    public $idStatDatiEvntVar;
    public $nAnomalie;
    public $nMancanze;
    public $nErrori;
    public $nAltreAnomalie;
    public $mappaMancanze;
    public $mappaErrori;
    public $mappaAltreAnomalie;
    public $nCorrezioni;
    public $mappaCorrezioni;
    
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
                t.idStatDatiEvntVariabiliMappaAnomalie,
                t.idStatDatiEvntVar,
                t.nAnomalie,
                t.nMancanze,
                t.nErrori,
                t.nAltreAnomalie,
                t.mappaMancanze,
                t.mappaErrori,
                t.mappaAltreAnomalie,
                t.varCoef,
                t.mappaCorrezioni
            FROM
                statDatiEvntVarMappaAnomalie t
            ORDER BY
                t.idStatDatiEvntVar
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
                t.idStatDatiEvntVariabiliMappaAnomalie,
                t.idStatDatiEvntVar,
                t.nAnomalie,
                t.nMancanze,
                t.nErrori,
                t.nAltreAnomalie,
                t.mappaMancanze,
                t.mappaErrori,
                t.mappaAltreAnomalie,
                t.varCoef,
                t.mappaCorrezioni
            FROM
                statDatiEvntVarMappaAnomalie t
            WHERE
                idStatDatiEvntVariabiliMappaAnomalie = '"
                . $this->idStatDatiEvntVariabiliMappaAnomalie
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
            // statDatiEvntVarMappaAnomalie(t.idStatDatiEvntVariabiliMappaAnomalie,t.idStatDatiEvntVar,t.nAnomalie,t.nMancanze,
            // t.nErrori,t.nAltreAnomalie,t.mappaMancanze,t.mappaErrori,t.mappaAltreAnomalie,t.varCoef
            // query to insert record
            $query = "INSERT INTO  statDatiEvntVarMappaAnomalie t
                        (t.idStatDatiEvntVar, t.nMancanze, t.nErrori, t.nAltreAnomalie, t.mappaMancanze, t.mappaErrori, t.mappaAltreAnomalie, t.varCoef)
                  VALUES
                        (" . VN($this->idStatDatiEvntVar) . ",
                         " . VN($this->nAnomalie) . ",
                         " . VN($this->nMancanze) . ",
                         " . VN($this->nErrori) . ",
                         " . VN($this->nAltreAnomalie) . ",
                         " . VN($this->mappaMancanze) . ",
                         " . VN($this->mappaErrori) . ",
                         " . VN($this->mappaAltreAnomalie) . ",
                         " . VN($this->varCoef) . ",
                         " . VN($this->mappaCorrezioni) . ",
                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->idStatDatiEvntVariabiliMappaAnomalie = $this->conn->insert_id;
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
                    statDatiEvntVarMappaAnomalie
                SET
                    idStatDatiEvntVar=" .    VN($this->idStatDatiEvntVar) . ", 
                    nAnomalie=" .    VN($this->nAnomalie) . ", 
                    nMancanze=" .        VN($this->nMancanze) . ",
                    nErrori=" . VN($this->nErrori) . ",
                    nAltreAnomalie=" .     VN($this->nAltreAnomalie) . ",
                    mappaMancanze=" .     VN($this->mappaMancanze) . ",
                    mappaErrori=" .     VN($this->mappaErrori) . ",
                    mappaAltreAnomalie=" .     VN($this->mappaAltreAnomalie) . ",
                    varCoef=" .     VN($this->varCoef) . ",
                    varCoef=" .     VN($this->mappaCorrezioni) . ",
                WHERE
                    idStatDatiEvntVariabiliMappaAnomalie = " . $this->idStatDatiEvntVariabiliMappaAnomalie;
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
            $query = "DELETE from statDatiEvntVarMappaAnomalie 
                WHERE idStatDatiEvntVariabiliMappaAnomalie = '" . $this->idStatDatiEvntVariabiliMappaAnomalie . "'";
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
