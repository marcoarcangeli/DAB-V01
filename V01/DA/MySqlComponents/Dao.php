<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/mySqlComponents/Database.php');
include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\mySqlComponents\Database as DB;
use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;
use function DA\Common\emptyOrNull as EN;

class Dao
{

    // database connection and table name
    private $Conn;

    public $FirstId;         // first Id Inserted by a srvOp
    public $AffectedRows;   // number of rows affected by a srvOp

    // object properties
    // basic params strings
    // public string $FE;     // string; Fundamental Entity
    // public string $FEFs;   // CS string; Fundamental Entity Fields
    // public array $VM;     // array; Values Matrix 
    // public array $FM;     // array; Filters Matrix (only Ids in this version)
    // derived params strings
    // public $DEs; // Descriptive Entities
    // public $DEFs; // Descriptive Entities Fields: Nam
    // public $EFs; //  Entity Fields
    // public $EntitySql; // Entity
    // public $FilterSql; // Filter Sql 
    // public $LUSql; // List for Update Sql
    // public $OFs; // Ordering Fields
    
    // DEPRECATED params
    // public $IdFE;
    // public $Nam;
    // public $IdProfile;
    // public $Descr;

    // constructor with $db as database connection
    // public function __construct($db)
    public function __construct($Params='Ok')
    {
        // get new rdb connection
        $Db = new DB();
        $this->conn = $Db->getConnection();
    }

    // read all testEntitys
    public function read(string $FE, string $FEFs, string $FM='')
    {
        try {
            $query ='';

            if(!EN($FE)){
                if(!EN($FEFs)){
                    if(!EN($EFsSql=getEFsSql($FE, $FEFs))
                    && !EN($EntitySql=getEntitySql($FE, $FEFs))){
                            $query .="
                            SELECT ".$EFsSql."
                            FROM ".$EntitySql;
                            if(!EN($FilterIdsSql=getFilterIdsSql($FE, $FM))){
                                $query .=" WHERE ".$FilterIdsSql;
                            } // else continue: optional sql part
                            $query .=" ORDER BY fe.Nam"; // Standard order fields is FE Nam Field.
                        }else{
                        LM::LogMessage("ERROR", 'Fundamental Entity SQL not built!');
                        return false;
                    }
                }else{
                    LM::LogMessage("ERROR", 'Fundamental Entity Fields not defined!');
                    return false;
                }
            }else{
                LM::LogMessage("ERROR", 'Fundamental Entity not defined!');
                return false;
            }
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query statement
            if ($Stmt = mysqli_query($this->conn, $query)) {
                $this->FirstId      = '';
                $this->AffectedRows = $this->conn->affected_rows;
                return $Stmt;
            }else{
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // create testEntity
    public function save(string $FE, string $FEFs, string $VM)
    {
        try {
            //if ($this->alreadyExist()) {
            //    return false;
            //}
            $query = '';

            if(!EN($FE)){
                if(!EN($FEFs)){
                    if(!EN($VM)){
                        if(!EN($VMSql=getVMSql($FEFs, $VM))
                        && !EN($LUSql=getLUSql($FEFs))){
                            $query .= "
                            INSERT INTO ".$FE."
                            (".$FEFs.")
                            VALUES " . $VMSql . "
                            ON DUPLICATE KEY UPDATE
                            ".$LUSql."
                            ";
                        }else{
                            LM::LogMessage("ERROR", 'VMSql or LUSql not correct!');
                            return false;
                        }
                    }else{
                        LM::LogMessage("ERROR", 'Values Matrix not defined!');
                        return false;
                    }
                }else{
                    LM::LogMessage("ERROR", 'Fundamental Entity Fields not defined!');
                    return false;
                }
            }else{
                LM::LogMessage("ERROR", 'Fundamental Entity not defined!');
                return false;
            }
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // execute query
            if ($Stmt = mysqli_query($this->conn, $query)) {
                $this->FirstId      = $this->conn->insert_id;
                $this->AffectedRows = $this->conn->affected_rows;
                return true;
            }else{
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }


    // delete testEntity
    public function delete(string $FE, string $FM='')
    {
        try {
            $query = '';

            if(!EN($FE)){
                $query .= "
                DELETE from ".$FE." fe ";
    
                if(!EN($FM)){
                    if(!EN($EFsSql=getFilterIdsSql($FE, $FM))){
                        $query .=" WHERE ".$EFsSql;
                    } // else continue: optional sql part
                }
            }else{
                LM::LogMessage("ERROR", 'Fundamental Entity not defined!');
                return false;
            }
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query statement
            if ($Stmt = mysqli_query($this->conn, $query)) {
                $this->FirstId      = '';
                $this->AffectedRows = $this->conn->affected_rows;
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // update testEntity 
    public function clean(string $FE)
    {
        try {
            $query = '';

            if(!EN($FE)){
                // query to insert record
                $query .= "
                TRUNCATE TABLE  ".$FE."
                ";
            }else{
                LM::LogMessage("ERROR", 'Fundamental Entity not defined!');
                return false;
            }
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // execute query
            if ($Stmt = mysqli_query($this->conn, $query)) {
                return true;
            }else{
                return false;
            }
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

    // get Complete Entity sql 
    function getDEFsSql(string $FE, string $FEFs)
    {
        try {
            $Sql='';
            // $mapped = array_map('func', $values, array_keys($values));
            if(!EN($DEs=getDEs($FEFs))){
            $DesArr=explode(',',$DEs);
                $Sql .= implode(',',
                    array_map( 
                    function($v, $k) { 
                        return $_SESSION["DEAlias"].$k.'.Nam'; 
                    }, 
                    $DesArr,
                    array_keys($DesArr)
                    )
                );
            }

            return $Sql;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // get Complete Entity sql 
    function getEFsSql(string $FE, string $FEFs)
    {
        try {
            $Sql='';
            // $mapped = array_map('func', $values, array_keys($values));
            if(!EN($DEFs=getDEFsSql($FE, $FEFs))){
                $Sql .= $FEFs.','.$DEFs;
            }
            return $Sql;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // get List for Insert/Update sql 
    public function getVMSql(string $FEFs, string $VM)
    {
        try {
            // query to insert record
            $VMSql = '';
            if(!EN($VM)
                && !EN($FEFs)){
                $VMArr=JSON_decode($VM, true);
                $FEFsArr=explode(',',$FEFs);
                // echo 'count($VM): ', count($VM),'<br>';
                if(count($VMArr)>0){
                    // echo 'count($VM[0]): ', count($VM[0]),'<br>';
                    // echo 'count($FEFsArr): ', count($FEFsArr),'<br>';
                    if(count($FEFsArr)==count($VMArr[0])){
                        foreach ($VMArr as $VMRow) {
                            // echo 'VMRow: ', implode(',',$VMRow),'<br>';
                            $VMSql .= '('. implode(',',$VMRow ) .'),';
                        }
                    }else{
                        LM::LogMessage("ERROR", 'Values number not coherent with column number!');
                        return false;
                    }
                }else{
                    LM::LogMessage("ERROR", 'No values to process!');
                    return false;
                }
            }else{
                LM::LogMessage("ERROR", 'Parameters Values Matrix and/or Fundamental Entity Fields not set!');
                return false;
            }

            return substr($VMSql,0, -1); // cut last comma character
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    // get Filter sql 
    /**
     * ex:
     * $FMArr = array("filterType" => 'NoN', "filterValues" => '1,6,16');
     * $FMArr = array("filterValues" => '1,6,16');
     */
    public function getFilterIdsSql(string $FE, string $FM)
    {
        try {
            // query to insert record
            $FilterSql='';
            if(!EN($FE) 
                && !EN($FM)
            ){
                $FMArr=json_decode($FM,true);
                $Type=(isset($FMArr['filterType']))? $FMArr['filterType'] : $_SESSION["FilterTypeStrict"];
                if(!EN($FMArr['filterValues'])){
                    switch($Type) {
                        case $_SESSION["FilterTypeStrict"]: // None on Null > '=' (Single or Multiple)
                            $FilterSql = 'fe.Id'.$FE.' IN ('.$FMArr['filterValues'].')';
                            break;
                        case $_SESSION["FilterTypeApprox"]: // All on Null > 'LIKE %' (Single)
                            $FilterSql = 'fe.Id'.$FE." LIKE '".$FMArr['filterValues']."%'";
                            break;
                        default:
                            LM::LogMessage("ERROR", "FilterSql Type (".$Type.") is not correct!");
                            break;
                    }
                } // else continue filter values are empty
            }else{
                LM::LogMessage("ERROR", 'Parameters Filters Matrix and/or Fundamental Entity Fields not set!');
                return false;
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
            }else{
                LM::LogMessage("ERROR", 'Parameters Fundamental Entity Fields not set!');
                return false;
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