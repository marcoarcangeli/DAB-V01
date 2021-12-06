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
    public $VM; // Values Matrix 
    public $FM; // Filters Matrix (only Ids in this version)
    public $OFs; // Ordering Fields
    // derived params strings
    public $DEs; // Descriptive Entities
    public $EFs; //  Entity Fields
    public $EntitySql; // Entity
    public $FilterSql; // Filter Sql 
    public $LUSql; // List for Update Sql

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
    public function select()
    {
        try {

            $query = "
            SELECT ".$this->EFs."
            FROM ".getEntitySql($FE, $FEFs)."
            WHERE ".getFilterIdsSql($FE, $FM)."
            ORDER BY ".$this->OFs."
            ";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query statement
            $Stmt = mysqli_query($this->conn, $query);

            return $Stmt;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

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
            VALUES " . getVMSql($FEFs, $VM) . "
            ON DUPLICATE KEY UPDATE
            ".getLUSql($FEFs)."
            ";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
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
            $query = "
            DELETE from ".$this->FE." fe 
                WHERE ".getIdFilterSql($FE, $FilterIds,$FilterType);
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
     *     public $EFs; //  Entity Fields
     *     public $DEs; // Descriptive Entities
     *     public $EntitySql; // Entity
     *     public $VM; // Values Matrix 
     *     public $FilterSql; // Filter
     *     public $LU; // List for Update 

     */
    // get Descriptive Entities comma separated list 
    public function getDEs(string $FEFs)
        try {
            // query to insert record
            $DEs=array();
            if(!EN($FEFs)){
                $DEs=
                array_map( 
                  function( $v ) { 
                    return substr($v, 2, -1); // conventionally remove the first 2 characters 'Id'
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
            $EntitySql=$FE.' '.$_SESSION["FEAlias"];
            // $mapped = array_map('func', $values, array_keys($values));
            if(!is_null($DEs=getDEs($FEFs))){
              $DesArr=explode(',',$DEs);
              $EntitySql .= implode(' ',
                array_map( 
                  function($v, $k) { 
                    return ' LEFT OUTER JOIN '.$v.' '.$_SESSION["DEAlias"].$k.' ON '.$_SESSION["DEAlias"].$k.'.'.$v.'='.$_SESSION["FEAlias"].'.'.$v; 
    
                    // return ' LEFT OUTER JOIN '.$v.' de'.$k.' ON de'.$k.'.'.$v.'='.'fe'.'.'.$v; 
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

    // get List for Insert/Update sql 
    public function getVMSql(string $FEFs, array $VM)
    {
        try {
            // query to insert record
            $FEFsArr=explode(',',$FEFs);
            $VMSql = '';
            if(!EN($VM)){
                // echo 'count($VM): ', count($VM),'<br>';
                if(count($VM)>0){
                    // echo 'count($VM[0]): ', count($VM[0]),'<br>';
                    // echo 'count($FEFsArr): ', count($FEFsArr),'<br>';
                    if(count($FEFsArr)==count($VM[0])){
                        foreach ($VM as $VMRow) {
                            // echo 'VMRow: ', implode(',',$VMRow),'<br>';
                            if(!EN($FEFs)){
                                $VMSql .= '('. implode(',',$VMRow ) .'),';
                            }
                        }
                    }
                }
            }

            return substr($VMSql,0, -1);
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    // get Filter sql 
    /**
     * ex:
     * $FMIds = array("filterType" => 'NoN', "filterValues" => '1,6,16');
     * $FMIds = array("filterValues" => '1,6,16');
     */
    public function getFilterIdsSql(string $FE, array $FMIds)
    {
        try {
            // query to insert record
            $FilterSql='';
            if(!EN($FE) 
                && !EN($FMIds)
            ){
                $Type=(isset($FMIds['filterType']))? $FMIds['filterType'] : $_SESSION["FilterTypeStrict"];
                if(!EN($FMIds['filterValues'])){
                    switch($Type) {
                        case $_SESSION["FilterTypeStrict"]: // None on Null > '=' (Single or Multiple)
                            $FilterSql = 'fe.Id'.$FE.' IN ('.$FMIds['filterValues'].')';
                            break;
                        case $_SESSION["FilterTypeApprox"]: // All on Null > 'LIKE %' (Single)
                            $FilterSql = 'fe.Id'.$FE." LIKE '".$FMIds['filterValues']."%'";
                            break;
                        default:
                            LM::LogMessage("WARNING", "FilterSql Type (".$Type.") is not correct!");
                            break;
                    }
                } // else continue filter values are empty
            }
            return $FilterSql;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // get List for Update sql 
    public function getLUSql(string $FEFs)
    {
        try {
            // query to insert record
            // idT1=VALUES(idT1), nam=VALUES(nam), descr=VALUES(descr)
            $LUSql = '';
            if(!EN($FEFs)){
                $LUSql = implode(',',
                    array_map( 
                        function($v) { 
                            return $v.' = VALUES('.$v.')'; 
                        }, 
                        explode(',',str_replace($_SESSION["FKPostfix"],'',$FEFs))
                    )
                );
            }
            return $LUSql;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    // *****************
    // CODE BUILDER could be the destination of this function
    // *****************
    // - FilterType: 
    //  NoN: None on Null       > '=' (Single or Multiple Values);  Precise match
    //  AoN: All on Null        > 'LIKE %' (Single Value);           Partial match
    //  Min: Minimum            > >= (Single Value);
    //  Max: Maximum            > <= (Single Value);
    //  Rng: Range              > BETWEEN min an max (Multiple Values);
    // Type modificator     
    //  X: exclude              > NOT
    //  C(dt): Cast as Datatype > CAST($var AS $dt)
    //******************
    // examples
    // NoNX; AoNX;0

    // FilterMatrix: array 2d : FieldNam: filterType, filterValues
    // - $FilterMatrix = array(
    //     "IdAlg"   => array("filterRel" => ''    , "filterType" => 'NoN', "filterValues" => '1,6,16'),
    //     "Nam"     => array("filterRel" => 'AND' , "filterType" => 'AoN', "filterValues" => 'alg'),
    //     "Dt"      => array("filterRel" => 'OR'  , "filterType" => 'NoN', "filterValues" => '2021-11-20'),
    //   );

    public function getFilterSql(array $FilterMatrix)
    {
        try {
            // ex.
            // IdProfile = " . $this->IdProfile."
            // IdProfile like '" . $this->IdProfile."%'
            // where idprj IN (1,3);
            $FilterSql='';
            $FilterMatrixKeys=array_keys($FilterMatrix);
            echo "Fields:",implode(',',$FilterMatrixKeys),"<br>";

            foreach ($FilterMatrixKeys as $FilterVar) {
                $FilterRel=$FilterMatrix[$FilterVar]["filterRel"];
                $FilterType=$FilterMatrix[$FilterVar]["filterType"];
                $FilterVarValues=$FilterMatrix[$FilterVar]["filterValues"];
                // echo "FilterVar       :",$FilterVar,"<br>";
                // echo "FilterRel       :",$FilterRel,"<br>";
                // echo "FilterType      :",$FilterType,"<br>";
                // echo "FilterVarValues :",$FilterVarValues,"<br>";

                $FilterSql .=' '.$FilterRel.' ';

                if(!EN($FilterVar)){
                    // $FilterSql='Id'.$FE;
                    switch($FilterType) {
                        case 'NoN': // None on Null > '=' (Single or Multiple)
                            // $FilterSql .= ' = '.$IdFE;
                            $FilterSql .= $FilterVar.' IN ('.$FilterVarValues.')';
                            break;
                        case 'AoN': // All on Null > 'LIKE %' (Single)
                            $FilterSql .= $FilterVar." LIKE '".$FilterVarValues."%'";
                            break;
                        default:
                            LM::LogMessage("WARNING", "FilterSql Type (".$Type.") is not correct!");
                            break;
                    }
                }
            }
            
            return $FilterSql;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    
}