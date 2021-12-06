<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class Prj
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
    IdPrj int not null primary key auto_increment,
	UsrNam varchar(30) not null,
	Pwd varchar(30) not null,
	idProfilo int not null
    */
    public $IdPrj;
    public $IdUsr;
    public $Nam;
    public $Descr;
    public $FolderRef;
    public $IdPrjState;
    public $PrjState;

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
            select 
                p.IdPrj ,
                p.Nam,
                p.Descr,
                p.FolderRef, 
                p.IdPrjState,
                sp.Nam as PrjStateNam
                p.IdUsr,
                u.Nam as UsrNam,
            from prj p
            left join PrjState sp on p.IdPrjState=sp.IdPrjState
            left join Usr u on p.IdUsr=u.IdUsr
            order by p.Nam
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

    // read all testEntitys
    public function selectUsrAll()
    {
        try {

            $query = "
            select 
                p.IdPrj ,
                p.Nam,
                p.Descr,
                p.FolderRef, 
                p.IdPrjState,
                sp.Nam as PrjStateNam,
                p.IdUsr,
                u.Nam as UsrNam
            from prj p
            left join PrjState sp on p.IdPrjState=sp.IdPrjState
            left join Usr u on p.IdUsr=u.IdUsr
            where p.IdUsr=" . $this->IdUsr."
            order by p.Nam
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
            select 
                p.IdPrj ,
                p.IdUsr,
                p.Nam,
                p.Descr,
                p.FolderRef,
                p.IdPrjState,
                sp.Nam as PrjStateNam
            from prj p
            join PrjState sp on p.IdPrjState=sp.IdPrjState
            where IdPrj=" . $this->IdPrj;
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
    public function PrjStateCalcAll()
    {
        //throw new exception("this->idVideo: ".$this->idVideo."\n");
        try {
            // select all query
            $query = "
            SELECT
                p.IdPrj,
                p.IdUsr,
                p.Nam,
                p.Descr,
                p.FolderRef,
                p.IdPrjState,
                sp.Nam as PrjStateNam,
                e.IdEvnt,
                e.fileRefRepoDat,
                c.IdCntx,
                cl.IdClean,
                a.IdAn,
                rn.IdRnk,
                (not isnull(p.IdPrj)) + 
                (not isnull(e.IdEvnt)) +
                (not isnull(cl.IdClean)) +
                (not isnull(c.IdCntx)) +
                (not isnull(a.IdAn)) +
                (not isnull(rn.IdRnk))
                as IdPrjStateCalc
            FROM
                Prj p
                LEFT JOIN PrjState   sp  ON p.IdPrjState = sp.IdPrjState
                LEFT JOIN evnt       e   ON p.IdPrj      = e.IdPrj
                LEFT JOIN cntx       c   ON p.IdPrj      = c.IdPrj
                LEFT JOIN clean      cl  ON p.IdPrj      = cl.IdPrj
                LEFT JOIN an         a   ON p.IdPrj      = a.IdPrj
                LEFT JOIN rnk        rn  ON a.IdPrj      = rn.IdPrj
            order by p.Nam
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
    
    public function PrjStateCalcSingle()
    {
        //throw new exception("this->idVideo: ".$this->idVideo."\n");
        try {
            // select all query
            $query = "
            SELECT
                p.IdPrj,
                p.IdUsr,
                p.Nam,
                p.Descr,
                p.FolderRef,
                p.IdPrjState,
                sp.Nam as PrjStateNam,
                e.IdEvnt,
                e.fileRefRepoDat,
                cl.IdClean,
                c.IdCntx,
                MIN(a.IdAn) AS IdAn,
                COUNT(a.IdAn) AS AnNum,
                rn.IdRnk,
                (not isnull(p.IdPrj)) + 
                (not isnull(e.IdEvnt)) +
                (not isnull(cl.IdClean)) +
                (not isnull(c.IdCntx)) +
                (not isnull(a.IdAn)) +
                (not isnull(rn.IdRnk))
                as IdPrjStateCalc
            FROM
                Prj p
                LEFT JOIN PrjState   sp  ON p.IdPrjState = sp.IdPrjState
                LEFT JOIN evnt       e   ON p.IdPrj      = e.IdPrj
                LEFT JOIN cntx       c   ON p.IdPrj      = c.IdPrj
                LEFT JOIN clean      cl  ON p.IdPrj      = cl.IdPrj
                LEFT JOIN an         a   ON p.IdPrj      = a.IdPrj
                LEFT JOIN rnk        rn  ON a.IdPrj      = rn.IdPrj
            WHERE
                p.IdPrj = " . $this->IdPrj."
            GROUP BY
                p.IdPrj
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

            // query to insert record
            $query = "INSERT INTO  prj
                        (IdUsr,Nam,Descr,FolderRef,IdPrjState)
                  VALUES
                        (" . VN($this->IdUsr) . ",
                         " . VN($this->Nam) . ",
                         " . VN($this->Descr) . ",
                         " . VN($this->FolderRef) . ",
                         " . VN($this->IdPrjState) . "
                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->IdPrj = $this->conn->insert_id;
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
                    prj
                SET
                    IdUsr=" .       VN($this->IdUsr) . ", 
                    Nam=" .         VN($this->Nam) . ",
                    Descr=" .       VN($this->Descr) . ",
                    FolderRef=" .   VN($this->FolderRef) . ",
                    IdPrjState=" .  VN($this->IdPrjState) . "
                WHERE
                    IdPrj='" . $this->IdPrj . "'";
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
            // $mysqli = $this->conn;
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
            $query = "DELETE from prj 
                WHERE IdPrj = '" . $this->IdPrj . "'";
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