<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class AnCntx
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
    IdPrj int not null primary key auto_increment,
	UsrNam varchar(30) not null,
	Pwd varchar(30) not null,
	idProfilo int not null
AnCntx (IdAnCntx, IdAn, IdCntx, IdSplitType, nam, Descr, fileRefTrainDat, fileRefTestDat)

    */
    
    public $IdPrj;

    public $IdAnCntx;
    public $IdAn;
    public $IdCntx;
    public $IdSplitType;
    public $Nam;
    public $Descr;
    public $fileRefTrainDat;
    public $fileRefTestDat;
    public $Regr_Outcome;
    public $Regr_Vars;
    public $Regr_CtrlMethod;
    public $Regr_ModelMethods;

    
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
                p.IdAnCntx,
                p.IdCntx,
                c.Nam AS CntxNam,
                p.IdAn,
                a.Nam AS AnNam,
                a.IdPrj,
                st.IdSplitType,
                st.Nam AS SplitTypeNam,
                p.Nam,
                p.Descr,
                p.fileRefTrainDat,
                p.fileRefTestDat,
                p.Regr_Outcome,
                p.Regr_Vars,
                p.Regr_CtrlMethod,
                p.Regr_ModelMethods
            FROM
                AnCntx p
            JOIN Cntx c ON
                p.IdCntx = c.IdCntx
            JOIN An a ON
                a.IdAn = p.IdAn
            LEFT JOIN SplitType st ON
                st.IdSplitType = p.IdSplitType
            ORDER BY
                p.Nam
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
                p.IdAnCntx,
                p.IdCntx,
                c.Nam AS CntxNam,
                p.IdAn,
                a.Nam AS AnNam,
                a.IdPrj,
                st.IdSplitType,
                st.Nam AS SplitTypeNam,
                p.Nam,
                p.Descr,
                p.fileRefTrainDat,
                p.fileRefTestDat,
                p.Regr_Outcome,
                p.Regr_Vars,
                p.Regr_CtrlMethod,
                p.Regr_ModelMethods
            FROM
                AnCntx p
            JOIN Cntx c ON
                p.IdCntx = c.IdCntx
            JOIN An a ON
                a.IdAn = p.IdAn
            LEFT JOIN SplitType st ON
                st.IdSplitType = p.IdSplitType
            WHERE
                IdAnCntx = '"
                . $this->IdAnCntx
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
            // AnCntx(IdAnCntx, IdAn, IdCntx, IdSplitType, Nam, Descr, fileRefTrainDat, fileRefTestDat, timestamp, IdUsr)

            // query to insert record
            $query = "INSERT INTO  AnCntx
                        (IdAnCntx, IdAn, IdCntx, IdSplitType, Nam, Descr, fileRefTrainDat, fileRefTestDat,
                        Regr_Outcome,Regr_Vars,Regr_CtrlMethod,Regr_ModelMethods)
                  VALUES
                        (" . VN($this->IdAnCntx)        . ",
                         " . VN($this->IdAn)            . ",
                         " . VN($this->IdCntx)          . ",
                         " . VN($this->IdSplitType)     . ",
                         " . VN($this->Nam)             . ",
                         " . VN($this->Descr)           . ",
                         " . VN($this->fileRefTrainDat) . ",
                         " . VN($this->fileRefTestDat)  . ",
                         " . VN($this->Regr_Outcome)    . ",
                         " . VN($this->Regr_Vars)       . ",
                         " . VN($this->Regr_CtrlMethod) . ",
                         " . VN($this->Regr_ModelMethods) . "
                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->IdAnCntx = $this->conn->insert_id;
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
                    AnCntx
                SET
                    IdAnCntx="          . VN($this->IdAnCntx)          . ", 
                    IdCntx="            . VN($this->IdCntx)            . ",
                    IdAn="              . VN($this->IdAn)              . ",
                    IdSplitType="       . VN($this->IdSplitType)       . ",
                    Nam="               . VN($this->Nam)               . ",
                    Descr="             . VN($this->Descr)             . ",
                    fileRefTrainDat="   . VN($this->fileRefTrainDat)   . ",
                    fileRefTestDat="    . VN($this->fileRefTestDat)    . ",
                    Regr_Outcome="      . VN($this->Regr_Outcome)      . ",
                    Regr_Vars="         . VN($this->Regr_Vars)         . ",
                    Regr_CtrlMethod="   . VN($this->Regr_CtrlMethod)   . ",
                    Regr_ModelMethods=" . VN($this->Regr_ModelMethods) . "
                WHERE
                    IdAnCntx = " . $this->IdAnCntx;
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
            // $numPreidSplitTypezioni = $this->numPreidSplitTypezioni();
            // $numNoleggi = $this->numNoleggi();
            // if ($numNoleggi != '0' || $numPreidSplitTypezioni != '0') {
            //     throw new exception("Cliente non cancellabile. Almeno una PreidSplitTypezione o un Noleggio effettuato.\n");
            // } 
            // query to delete record profilo 
            // $query = "DELETE from profilo 
            //     WHERE idProfilo = '" . $this->idProfilo . "'";
            // //throw new exception($query."\n");
            // // prepare query statement
            // $Stmt = mysqli_query($this->conn, $query);
            // //throw new exception("righe trovate ".$Stmt->num_rows."\n");

            // query to delete record usr
            $query = "DELETE from AnCntx 
                WHERE IdAnCntx = '" . $this->IdAnCntx . "'";
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
