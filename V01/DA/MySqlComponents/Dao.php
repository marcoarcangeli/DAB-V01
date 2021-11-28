<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;
use function DA\Common\emptyOrNull as EN;

class Dao
{

    // database connection and table name
    private $Conn;

    // object properties
    // basic params strings
    public $FE; // Fundamental Entity
    public $FEFs; // Fundamental Entity Fields
    // derived params strings
    public $DEs; // Descriptive Entities
    public $EntitySql; // Entity
    public $FilterSql; // Filter
    public $EFs; //  Entity Fields
    public $OFs; // Ordering  Fields
    public $VM; // Values Matrix 
    public $LU; // List for Update 
    public $DI; // Delete Ids 

    public $IdFE;
    public $Nam;
    // public $IdProfile;
    // public $Descr;

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
            SELECT ".$EFs."
            FROM ".$EntitySql."
            ORDER BY ".$OFs."
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
        try {
            // select all query
            $query = "
            SELECT ".$FEFs."
            FROM ".$EntitySql."
            WHERE
                IdProfile = " . $this->IdProfile."
            ORDER BY ".$OFs."
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

    /*  IdProfile, 
    */

    // create testEntity
    public function save()
    {
        try {
            //if ($this->alreadyExist()) {
            //    return false;
            //}

            // query to insert record
            $query = "
            INSERT INTO ".$FE."
            ".$FEFs."
            VALUES " . $VM . "
            ON DUPLICATE KEY UPDATE
            ".$LU."
            ";
            // throw new exception($query."\n");
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->IdProfile = $this->conn->insert_id;
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
            $query = "DELETE from ".$FE." fe 
                WHERE fe.".$FE." IN '" . $this->IdProfile . "'";
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

    // update testEntity 
    public function clean()
    {
        try {
            // query to insert record
            $query = "TRUNCATE TABLE  ".$FE."
            ";
            //throw new exception($query."\n");

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

    /**
     *     public $DEs; // Descriptive Entities
     *     public $EntitySql; // Entity
     *     public $FilterSql; // Filter
     *     public $EFs; //  Entity Fields
     *     public $OFs; // Ordering  Fields
     *     public $VM; // Values Matrix 
     *     public $LU; // List for Update 

     */
    // get Descriptive Entities comma separated list 
    public function getDEs(string $FEFs)
    {
        try {
            // query to insert record
            $DEs=array();
            if(!EN($FEFs)){
                $DEs=
                array_map( 
                  function( $v ) { 
                    return substr($v, 0, -1); 
                  }, 
                  array_filter( 
                    explode($_SESSION["DefaultSep"], $FEFs), 
                    function( $v ) { 
                        return substr($v, -1)==$_SESSION["FKPostfix"]; 
                    } 
                  )
                );
            }
            return implode(',',$DEs);
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // get Complete Entity sql 
    public function getEntitySql(string $FE, string $FEFs)
    {
        try {
            // query to insert record
            $EntitySql=$FE.' fe';
            // $mapped = array_map('func', $values, array_keys($values));
            if(!EN($DEs=getDEs($FEFs))){
              $DesArr=explode(',',$DEs);
              $EntitySql .= implode(' ',
                array_map( 
                  function($v, $k) { 
                    return ' LEFT OUTER JOIN '.$v.' de'.$k.' ON de'.$k.'.'.$v.'='.'fe'.'.'.$v; 
                  }, 
                  $DesArr,
                  array_keys($DesArr)
                )
              );
            }
            return $EntitySql;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // get Filter sql 
    /**
     * Type: none on null (NoN > '='), all on null (AoN > 'like')
     */
    public function getFilterSql(string $Entity, string $Type='NoN')
    {
        try {
            // query to insert record
            // $mapped = array_map('func', $values, array_keys($values));
            if(!EN($Entity)){
                $FilterSql='Id'.$Entity;

                
            }
            return $FilterSql;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }


}