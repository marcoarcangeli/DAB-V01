<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class An
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
    An (IdAn, IdPrj, IdAlg, nam, Descr)

    */
    public $IdAn;
    public $IdPrj;
    public $IdAlg;
    public $IdAnState;
    public $AlgNam;
    public $Nam;
    public $Descr;
    public $Dttm;

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
                e.IdAn,
                e.IdPrj,
                p.Nam AS PrjNam,
                e.IdAlg,
                e.IdAnState,
                sa.Nam  as AnStateNam,
                a.Nam AS AlgNam,
                e.Nam,
                e.Descr,
                e.Dttm
            FROM
                An e
                JOIN Prj p ON p.IdPrj = e.IdPrj
                LEFT JOIN Alg a ON a.IdAlg = e.IdAlg
                LEFT JOIN AnState sa ON sa.IdAnState = e.IdAnState
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

    public function selectPrj()
    {
        //throw new exception("this->idVideo: ".$this->idVideo."\n");
        try {
            // select all query
            $query = "
            SELECT
                e.IdAn,
                e.IdPrj,
                p.Nam AS PrjNam,
                e.IdAlg,
                e.IdAnState,
                sa.Nam  as AnStateNam,
                a.Nam AS AlgNam,
                e.Nam,
                e.Descr,
                e.Dttm
            FROM
                An e
                JOIN Prj p ON p.IdPrj = e.IdPrj
                LEFT JOIN Alg a ON a.IdAlg = e.IdAlg
                LEFT JOIN AnState sa ON sa.IdAnState = e.IdAnState
            WHERE
                e.IdPrj = '"
                . $this->IdPrj
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

    // get single testEntity data
    public function selectSingle()
    {
        //throw new exception("this->idVideo: ".$this->idVideo."\n");
        try {
            // select all query
            $query = "
            SELECT
                e.IdAn,
                e.IdPrj,
                p.Nam AS PrjNam,
                e.IdAlg,
                e.IdAnState,
                sa.Nam  as AnStateNam,
                a.Nam AS AlgNam,
                e.Nam,
                e.Descr,
                e.Dttm
            FROM
                An e
                JOIN Prj p ON p.IdPrj = e.IdPrj
                LEFT JOIN Alg a ON a.IdAlg = e.IdAlg
                LEFT JOIN AnState sa ON sa.IdAnState = e.IdAnState
            WHERE
                IdAn = '"
                . $this->IdAn
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

    /*  IdPrjState, 
- PrjState: new, event, cntx, an, rev, rank(standardize)
- anPhase: an, AnCntx, train, test, comp, rev, rank
    */
    public function AnStateCalcAll()
    {
        //throw new exception("this->idVideo: ".$this->idVideo."\n");
        try {
            // select all query
            $query = "
            SELECT
                a.IdAn,
                a.IdPrj,
                p.Nam AS PrjNam,
                a.IdAlg,
                l.Nam AS AlgNam,
                a.IdAnState,
                sa.Nam AS AnStateNam,
                a.Nam,
                a.Descr,
                a.Dttm,
                ca.IdAnCntx,
                t.IdTrain,
                te.IdTest,
                c.IdCompare,
                r.IdRev,
                (NOT ISNULL(a.IdAn)) 
                +(NOT ISNULL(ca.IdAnCntx)) 
                +(NOT ISNULL(t.IdTrain)) 
                +(NOT ISNULL(te.IdTest)) 
                +(NOT ISNULL(c.IdCompare)) 
                +(NOT ISNULL(r.IdRev)) AS IdAnStateCalc
            FROM
                Prj p
            LEFT JOIN an a ON
                p.IdPrj = a.IdPrj
            LEFT JOIN AnState sa ON
                a.IdAnState = sa.IdAnState
            LEFT JOIN Alg l ON
                a.IdAlg = l.IdAlg
            LEFT JOIN AnCntx ca ON
                a.IdAn = ca.IdAn
            LEFT JOIN train t ON
                a.IdAn = t.IdAn
            LEFT JOIN test te ON
                a.IdAn = te.IdAn
            LEFT JOIN compare c ON
                a.IdAn = c.IdAn
            LEFT JOIN rev r ON
                a.IdAn = r.IdAn
            ORDER BY
                a.Nam
                ";
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
    
    public function AnStateCalcSingle()
    {
        //throw new exception("this->idVideo: ".$this->idVideo."\n");
        try {
            // select all query
            $query = "
            SELECT
                a.IdAn,
                a.IdPrj,
                p.Nam AS PrjNam,
                a.IdAlg,
                l.Nam AS AlgNam,
                a.IdAnState,
                sa.Nam AS AnStateNam,
                a.Nam,
                a.Descr,
                a.Dttm,
                ca.IdAnCntx,
                t.IdTrain,
                te.IdTest,
                c.IdCompare,
                r.IdRev,
                (NOT ISNULL(a.IdAn)) 
                +(NOT ISNULL(ca.IdAnCntx)) 
                +(NOT ISNULL(t.IdTrain)) 
                +(NOT ISNULL(te.IdTest)) 
                +(NOT ISNULL(c.IdCompare)) 
                +(NOT ISNULL(r.IdRev)) AS IdAnStateCalc
            FROM
                Prj p
            LEFT JOIN an a ON
                p.IdPrj = a.IdPrj
            LEFT JOIN AnState sa ON
                a.IdAnState = sa.IdAnState
            LEFT JOIN Alg l ON
                a.IdAlg = l.IdAlg
            LEFT JOIN AnCntx ca ON
                a.IdAn = ca.IdAn
            LEFT JOIN train t ON
                a.IdAn = t.IdAn
            LEFT JOIN test te ON
                a.IdAn = te.IdAn
            LEFT JOIN compare c ON
                a.IdAn = c.IdAn
            LEFT JOIN rev r ON
                a.IdAn = r.IdAn
            WHERE
                a.IdAn = " . $this->IdAn."
            ";
            if($_SESSION["Debug"]>=3){ LM::LogMessage("DEBUG","query: ".$query); }
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
            //     An (IdAn, IdPrj, IdAlg, nam, Descr)
            // query to insert record
            $query = "INSERT INTO  An
                        (IdPrj, IdAlg, IdAnState, Nam, Descr, Dttm)
                  VALUES
                        (
                         " . VN($this->IdPrj) . ",
                         " . VN($this->IdAlg) . ",
                         " . VN($this->IdAnState) . ",
                         " . VN($this->Nam) . ",
                         " . VN($this->Descr) . ",
                         " . VN($this->Dttm) . "
                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->IdAn = $this->conn->insert_id;
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
                    An
                SET
                    IdPrj="     . VN($this->IdPrj) . ", 
                    IdAlg="     . VN($this->IdAlg) . ",
                    IdAnState=" . VN($this->IdAnState) . ",
                    Nam="       . VN($this->Nam) . ",
                    Descr="     . VN($this->Descr) . ",
                    Dttm="      . VN($this->Dttm) . "
                WHERE
                    IdAn = " . $this->IdAn;
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
            $query = "DELETE from An 
                WHERE IdAn = '" . $this->IdAn . "'";
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