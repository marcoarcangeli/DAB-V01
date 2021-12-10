<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');
include_once($BFD.'DA/MySqlComponents/Dao.php');

use DA\Logs\LogManager as LM;
use DA\MySqlComponents\Dao as DAO;
use function DA\Common\verifyNulls as VN;

class Alg extends DAO
{

    // constructor with $db as database connection
    public function __construct($db)
    {
        // $this->conn = $db;
    }

    /**
     * EXTENDED METHODS FOR ENTITY Alg
     */
    // // read all testEntitys
    // public function selectAll()
    // {
    //     try {

    //         $query = "
    //         SELECT
    //             t.IdAlg,
    //             t.IdAlgState,
    //             s.Nam as AlgStateNam,
    //             t.IdAlgCat,
    //             c.Nam as AlgCatNam,
    //             t.Nam,
    //             t.Descr,
    //             t.fileRefProc,
    //             t.CatTag
    //         FROM
    //             Alg t
    //             LEFT OUTER JOIN AlgCat c on t.IdAlgCat=c.IdAlgCat
    //             LEFT OUTER JOIN AlgState s on t.IdAlgState=s.IdAlgState
    //         ORDER BY
    //             t.Nam
    //         ";
    //         //throw new exception($query."\n");
    //         // prepare query statement
    //         $Stmt = mysqli_query($this->conn, $query);

    //         return $Stmt;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    // public function selectCat()
    // {
    //     try {

    //         $query = "
    //         SELECT
    //             t.IdAlg,
    //             t.IdAlgState,
    //             s.Nam as AlgStateNam,
    //             t.IdAlgCat,
    //             c.Nam as AlgCatNam,
    //             t.Nam,
    //             t.Descr,
    //             t.fileRefProc,
    //             t.CatTag
    //         FROM
    //             Alg t
    //             LEFT OUTER JOIN AlgCat c on t.IdAlgCat=c.IdAlgCat
    //             LEFT OUTER JOIN AlgState s on t.IdAlgState=s.IdAlgState
    //         WHERE 
    //             IFNULL(t.IdAlgCat, '') LIKE '" . $this->IdAlgCat . "%'
    //         ORDER BY
    //             t.Nam
    //         ";
    //         // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
    //         // prepare query statement
    //         $Stmt = mysqli_query($this->conn, $query);

    //         return $Stmt;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    // public function selectSearchIds()
    // {
    //     try {

    //         $query = "
    //         SELECT
    //             t.IdAlg,
    //             t.IdAlgState,
    //             s.Nam as AlgStateNam,
    //             t.IdAlgCat,
    //             c.Nam as AlgCatNam,
    //             t.Nam,
    //             t.Descr,
    //             t.fileRefProc,
    //             t.CatTag
    //         FROM
    //             Alg t
    //             LEFT OUTER JOIN AlgCat c on t.IdAlgCat=c.IdAlgCat
    //             LEFT OUTER JOIN AlgState s on t.IdAlgState=s.IdAlgState
    //         WHERE 
    //             t.IdAlgCat IN (" . $this->SearchIds . ")
    //         ORDER BY
    //             t.Nam
    //         ";
    //         // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
    //         // prepare query statement
    //         $Stmt = mysqli_query($this->conn, $query);

    //         return $Stmt;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    // // get single testEntity data
    // public function selectSingle()
    // {
    //     //throw new exception("this->idVideo: ".$this->idVideo."\n");
    //     try {
    //         // select all query
    //         $query = "
    //         SELECT
    //             t.IdAlg,
    //             t.IdAlgState,
    //             s.Nam as AlgStateNam,
    //             t.IdAlgCat,
    //             c.Nam as AlgCatNam,
    //             t.Nam,
    //             t.Descr,
    //             t.fileRefProc,
    //             t.CatTag
    //         FROM
    //             Alg t
    //             LEFT OUTER JOIN AlgCat c on t.IdAlgCat=c.IdAlgCat
    //             LEFT OUTER JOIN AlgState s on t.IdAlgState=s.IdAlgState
    //         WHERE
    //             t.IdAlg = '"
    //             . $this->IdAlg
    //             . "'";
    //         // echo $query."\n";
    //         //throw new exception($query."\n");
    //         // prepare query statement
    //         $Stmt = mysqli_query($this->conn, $query);
    //         //throw new exception("righe trovate ".$Stmt->num_rows."\n");
    //         // execute query
    //         return $Stmt;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    // create testEntity
    // public function insert()
    // {
    //     try {
    //         //if ($this->alreadyExist()) {
    //         //    return false;
    //         //}
    //         // Alg(IdAlg, IdAlgState, IdAlgCat, Nam, Descr, fileRefProc, timestamp, IdUsr)

    //         // query to insert record
    //         $query = "INSERT INTO  Alg
    //                     (IdAlgState, IdAlgCat, Nam, Descr, fileRefProc,CatTag)
    //               VALUES
    //                     (" . VN($this->IdAlgState) . ",
    //                      " . VN($this->IdAlgCat) . ",
    //                      " . VN($this->Nam) . ",
    //                      " . VN($this->Descr) . ",
    //                      " . VN($this->fileRefProc) . ",
    //                      " . VN($this->CatTag) . "
    //                      )";
    //         // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
    //         // prepare query
    //         $Stmt = mysqli_query($this->conn, $query);

    //         // execute query
    //         if ($Stmt) {
    //             $this->IdAlg = $this->conn->insert_id;
    //             return true;
    //         }
    //         return false;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    // update testEntity 
    // public function update()
    // {
    //     try {
    //         // query to insert record
    //         $query = "UPDATE
    //                 Alg
    //             SET
    //                 IdAlgState=" .VN($this->IdAlgState) . ", 
    //                 IdAlgCat=" .VN($this->IdAlgCat) . ",
    //                 Nam=" .VN($this->Nam) . ",
    //                 Descr=" .VN($this->Descr) . ",
    //                 fileRefProc=" .VN($this->fileRefProc) . ",
    //                 CatTag=" .VN($this->CatTag) . "
    //             WHERE
    //                 IdAlg = " . $this->IdAlg;
    //         // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }

    //         // prepare query
    //         $Stmt = mysqli_query($this->conn, $query);
    //         //throw new exception($Stmt."\n");

    //         // execute query
    //         if ($Stmt) {
    //             return true;
    //         }
    //         return false;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    // delete testEntity
    // public function delete()
    // {
    //     try {
    //         // inizio transazione
    //         $mysqli = $this->conn;
    //         // $mysqli->begin_transaction();
    //         // //update pp1_video flags
    //         // $numPrefileRefProczioni = $this->numPrefileRefProczioni();
    //         // $numNoleggi = $this->numNoleggi();
    //         // if ($numNoleggi != '0' || $numPrefileRefProczioni != '0') {
    //         //     throw new exception("Cliente non cancellabile. Almeno una PrefileRefProczione o un Noleggio effettuato.\n");
    //         // } 
    //         // query to delete record profilo 
    //         // $query = "DELETE from profilo 
    //         //     WHERE idProfilo = '" . $this->idProfilo . "'";
    //         // //throw new exception($query."\n");
    //         // // prepare query statement
    //         // $Stmt = mysqli_query($this->conn, $query);
    //         // //throw new exception("righe trovate ".$Stmt->num_rows."\n");

    //         // query to delete record usr
    //         $query = "DELETE from Alg 
    //             WHERE IdAlg = '" . $this->IdAlg . "'";
    //         //throw new exception($query."\n");
    //         // prepare query statement
    //         $Stmt = mysqli_query($this->conn, $query);
    //         //throw new exception("righe trovate ".$Stmt->num_rows."\n");
    //         // execute query
    //         // $mysqli->rollback();
    //         // $mysqli->commit();

    //         if ($Stmt) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } catch (mysqli_sql_exception $e) {
    //         // $mysqli->rollback();
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }   
    // }

}
