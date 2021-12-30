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
    public function Read(string $FE, string $FEFs, string $DEs, string $DEFs, string $EFs, string $FM='')
    {
        try {
            $query ='';
            if(!EN($FE)){
                if(!EN($FEFs)){
                    $EFsSql=$this->getEFsSql($FE, $DEs, $FEFs, $DEFs);
                    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": EFsSql: ".$EFsSql); }
                    $EntitySql=$this->getEntitySql($FE, $DEs);
                    // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": EntitySql: ".$EntitySql); }
                    if(!EN($EFsSql)
                    && !EN($EntitySql)){
                        $query .="
                        SELECT ".$EFsSql."
                        FROM ".$EntitySql;
                        if(!EN($FilterSql=$this->getFMSql($FM))){
                            $query .=" WHERE ".$FilterSql;
                        } // else continue: optional sql part
                        if (in_array($FE.".Nam", explode(',',$EFsSql))) {
                            $query .=" ORDER BY ".$FE.".Nam"; // Standard order fields is FE Nam Field.
                        }
                        
                    }else{
                        LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.': Fundamental Entity SQL not built!');
                        return false;
                    }
                }else{
                    LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.': Fundamental Entity Fields not defined!');
                    return false;
                }
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.': Fundamental Entity not defined!');
                return false;
            }
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": query: ".$query); }
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
    public function Save(string $FE, string $FEFs, string $VM)
    {
        try {
            $query = '';

            if(!EN($FE)){
                if(!EN($FEFs)){
                    if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": FE: ".$FE); }
                    if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": FEFs: ".$FEFs); }
                    if(!EN($VM)){
                        if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": VM: ".$VM); }
                        $VMSql=$this->getVMSql($FEFs, $VM);
                        if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": VMSql: ".$VMSql); }
                        $LUSql=$this->getLUSql($FEFs);
                        if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": LUSql: ".$LUSql); }
                        if(!EN($VMSql)
                        && !EN($LUSql)){
                            $query .= "
                            INSERT INTO ".$FE."
                            (".$FEFs.")
                            VALUES " . $VMSql . "
                            ON DUPLICATE KEY UPDATE
                            ".$LUSql."
                            ";
                        }else{
                            LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.': VMSql or LUSql not correct!');
                            return false;
                        }
                    }else{
                        LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.': Values Matrix not defined!');
                        return false;
                    }
                }else{
                    LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.': Fundamental Entity Fields not defined!');
                    return false;
                }
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.': Fundamental Entity not defined!');
                return false;
            }
            if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // execute query
            if ($Stmt = mysqli_query($this->conn, $query)) {
                $this->FirstId      = $this->conn->insert_id;
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->FirstId: ".$this->FirstId); }
                $this->AffectedRows = $this->conn->affected_rows;
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->AffectedRows: ".$this->AffectedRows); }
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
    public function Delete(string $FE, string $FM='')
    {
        try {
            $query = '';

            if(!EN($FE)){
                $query .= "
                DELETE from ".$FE;
                if(!EN($FM)){
                    if(!EN($FilterSql=$this->getFMSql($FM))){
                        $query .=" WHERE ".$FilterSql;
                    } // else continue: optional sql part
                }
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.': Fundamental Entity not defined!');
                return false;
            }
            if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            return false; // forced exit

            // prepare query statement
            if ($Stmt = mysqli_query($this->conn, $query)) {
                $this->FirstId      = '';
                $this->AffectedRows = $this->conn->affected_rows;
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->AffectedRows: ".$this->AffectedRows); }
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
    public function Clean(string $FE)
    {
        try {
            $query = '';

            if(!EN($FE)){
                // query to insert record
                $query .= "
                TRUNCATE TABLE  ".$FE."
                ";
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.': Fundamental Entity not defined!');
                return false;
            }
            if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
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
    // obsolete: responsibility passed to the Content builder
    // public function getDEs(string $FEFs)
    // {
    //     try {
    //         // query to insert record
    //         $DEs=array();
    //         if(!EN($FEFs)){
    //             $DEs=
    //             array_map( 
    //               function( $v ) { 
    //                 return substr($v, 2, -1); // conventionally remove the first 2 characters 'Id'
    //             }, 
    //               array_filter( 
    //                 explode($_SESSION["DefaultSep"], $FEFs), 
    //                 function( $v ) { 
    //                     return substr($v, -1)==$_SESSION["FKPostfix"]; 
    //                 } 
    //               )
    //             );
    //         }
    //         return implode(',',$DEs);
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    // obsolete changed params passed; responsibility passed to the Content builder
    // public function getEntitySql(string $FE, string $FEFs)
    // {
    //     try {
    //         $EntitySql=$FE.' '.$_SESSION["FEAlias"];
    //         // $mapped = array_map('func', $values, array_keys($values));
    //         if(!EN($DEs=$this->getDEs($FEFs))){
    //           $DesArr=explode(',',$DEs);
    //           $EntitySql .= implode(' ',
    //             array_map( 
    //               function($v, $k) { 
    //                 return ' LEFT OUTER JOIN '.$v.' '.$_SESSION["DEAlias"].$k.' ON '.$_SESSION["DEAlias"].$k.'.'.$v.'='.$_SESSION["FEAlias"].'.'.$v; 
    
    //                 // return ' LEFT OUTER JOIN '.$v.' de'.$k.' ON de'.$k.'.'.$v.'='.'fe'.'.'.$v; 
    //               }, 
    //               $DesArr,
    //               array_keys($DesArr)
    //             )
    //           );
    //         }
    //         return $EntitySql;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    // generalization step 2
    // function getEntitySql(string $FE, string $DEs)
    // {
    //     try {
    //         $EntitySql=$FE.' '.$_SESSION["FEAlias"];
    //         // $mapped = array_map('func', $values, array_keys($values));
    //         if(!EN($DEs)){
    //           $DesArr=explode(',',$DEs);
    //           $EntitySql .= implode(' ',
    //             array_map( 
    //                 function($v, $k) { 
    //                     return ' LEFT OUTER JOIN '.$v.' '.$_SESSION["DEAlias"].$k.' ON '.$_SESSION["DEAlias"].$k.'.'.$_SESSION["IdPrfx"].$v.'='.$_SESSION["FEAlias"].'.'.$_SESSION["IdPrfx"].$v; 
    //                 }, 
    //                 $DesArr,
    //                 array_keys($DesArr)
    //             )
    //           );
    //         }
    //         return $EntitySql;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }
    
    function getEntitySql(string $FE, string $DEs)
    {
        try {
            if(!EN($FE)){
                $_SESSION['tmp_FE']=$FE;
                $EntitySql=$FE;
                // $mapped = array_map('func', $values, array_keys($values));
                if(!EN($DEs)){
                $DesArr=explode(',',$DEs);
                $EntitySql .= implode(' ',
                    array_map( 
                        function($v) { 
                            return ' LEFT OUTER JOIN '.$v.' ON '.$v.'.'.$_SESSION["IdPrfx"].$v.'='.$_SESSION['tmp_FE'].'.'.$_SESSION["IdPrfx"].$v; 
                        }, 
                        $DesArr
                    )
                );
                }else{
                    LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": DEs is not set!");
                    return false;
                }
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": DEs is not set!");
                return false;
            }
            $_SESSION['tmp_FE']=null;
            return $EntitySql;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // obsolete changed params passed; responsibility passed to the Content builder
    // function getDEFsSql(string $FE, string $FEFs)
    // {
    //     try {
    //         $Sql='';
    //         // $mapped = array_map('func', $values, array_keys($values));
    //         $DEs=$this->getDEs($FEFs);
    //         if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": DEs: ".$DEs); }
    //         if(!EN($DEs)){
    //             $DesArr=explode(',',$DEs);
    //             $Sql .= implode(',',
    //                 array_map( 
    //                 function($v, $k) { 
    //                     return $_SESSION["DEAlias"].$k.'.Nam'; 
    //                 }, 
    //                 $DesArr,
    //                 array_keys($DesArr)
    //                 )
    //             );
    //         }

    //         return $Sql;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    // generalization step 2
    // ex: sp.Nam as PrjStateNam,
    // function getDEFsSql(string $DEFs)
    // {
    //     try {
    //         $Sql='';
    //         // $mapped = array_map('func', $values, array_keys($values));
    //         if(!EN($DEFs)){
    //         $DEFsArr=explode(',',$DEFs);
    //         $Sql .= implode(',',
    //             array_map( 
    //             function($v, $k) { 
    //                 return $_SESSION["DEAlias"].$k.'.'.$_SESSION["DEFNam"].' as '.$v; 
    //             }, 
    //             $DEFsArr,
    //             array_keys($DEFsArr)
    //             )
    //         );
    //         }
    //         return $Sql;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    // ex: PrjState.Nam as PrjStateNam,
    function getDEFsSql(string $DEs,string $DEFs)
    {
        try {
            $Sql='';
            if(!EN($DEFs)){
                $DEFsArr=explode(',',$DEFs);
                if(!EN($DEs)){
                    $DEsArr=explode(',',$DEs);
                    $Sql .= implode(',',
                        array_map( 
                        function($v, $k) { 
                            return $k.'.'.$_SESSION["DEFNam"].' as '.$v; 
                        }, 
                        $DEFsArr,
                        $DEsArr
                        )
                    );
                }else{
                    LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": DEs is not set!");
                    return false;
                }
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": DEFs is not set!");
                return false;
            }
            return $Sql;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // generalization step 2
    // ex: fe.idPrjState as PrjStateNam,
    // function getFEFsSql(string $FEFs)
    // {
    //     try {
    //         $Sql='';
    //         // $mapped = array_map('func', $values, array_keys($values));
    //         if(!EN($FEFs)){
    //         $FEFsArr=explode(',',$FEFs);
    //         $Sql .= implode(',',
    //             array_map( 
    //             function($v, $k) { 
    //                 return $_SESSION["FEAlias"].'.'.$v; 
    //             }, 
    //             $FEFsArr,
    //             array_keys($FEFsArr)
    //             )
    //         );
    //         }
    //         return $Sql;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    function getFEFsSql(string $FE,string $FEFs)
    {
        try {
            $Sql='';
            if(!EN($FE)){
                $_SESSION['tmp_FE']=$FE;

                // $mapped = array_map('func', $values, array_keys($values));
                if(!EN($FEFs)){
                    $FEFsArr=explode(',',$FEFs);
                    $Sql .= implode(',',
                        array_map( 
                        function($v) { 
                            return $_SESSION["tmp_FE"].'.'.$v; 
                        }, 
                        $FEFsArr
                        )
                    );
                }else{
                    LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": FEFs is not set!");
                    return false;
                }
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": FE is not set!");
                return false;
            }
            $_SESSION['tmp_FE']=null;
            return $Sql;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // obsolete changed params passed; responsibility passed to the Content builder
    // function getEFsSql(string $FE, string $FEFs)
    // {
    //     try {
    //         $Sql='';
    //         // $mapped = array_map('func', $values, array_keys($values));
    //         $DEFsSql=$this->getDEFsSql($FE, $FEFs);
    //         if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": DEFsSql: ".$DEFsSql); }
    //         if(!EN($DEFsSql)){
    //             $Sql .= $FEFs.','.$DEFsSql;
    //         }
    //         return $Sql;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    // generalization step 2
    // function getEFsSql(string $FEFs, string $DEFs)
    // {
    //     try {
    //         $Sql='';
    //         // $mapped = array_map('func', $values, array_keys($values));
    //         if(!EN($FEFs)){
    //             $Sql = $this->getFEFsSql($FEFs);
    //             if(!EN($DEFs)) {
    //                 $Sql .= ','.$this->getDEFsSql($DEFs);
    //             }// else - DEFs could be undefined
    //         }else{
    //             echo "WARNING", __CLASS__."->". __FUNCTION__.": FEFs is not set!";
    //             return false;
    //         }
    //         return $Sql;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }
    
    function getEFsSql(string $FE, string $DEs, string $FEFs, string $DEFs)
    {
        try {
            $Sql='';
            // $mapped = array_map('func', $values, array_keys($values));
            if(!EN($FEFs)){
                $Sql = $this->getFEFsSql($FE,$FEFs);
                if(!EN($DEFs)) {
                    $Sql .= ','.$this->getDEFsSql($DEs, $DEFs);
                }// else - DEFs could be undefined
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": FEFs is not set!");
                return false;
            }
            return $Sql;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
    
    // OBSOLETE
    // get Filter sql 
    /**
     * ex:
     * $FMArr = array("filterType" => 'NoN', "filterValues" => '1,6,16');
     * $FMArr = array("filterValues" => '1,6,16');
     */
    // public function getFMIdsSql(string $FE, string $FM)
    // {
    //     try {
    //         // query to insert record
    //         $FilterSql='';
    //         if(!EN($FE) 
    //             && !EN($FM)
    //         ){
    //             $FMArr=json_decode($FM,true);
    //             $Type=(isset($FMArr['filterType']))? $FMArr['filterType'] : $_SESSION["FilterTypeStrict"];
    //             if(!EN($FMArr['filterValues'])){
    //                 switch($Type) {
    //                     case $_SESSION["FilterTypeStrict"]: // None on Null > '=' (Single or Multiple)
    //                         $FilterSql = 'fe.Id'.$FE.' IN ('.$FMArr['filterValues'].')';
    //                         break;
    //                     case $_SESSION["FilterTypeApprox"]: // All on Null > 'LIKE %' (Single)
    //                         $FilterSql = 'fe.Id'.$FE." LIKE '".$FMArr['filterValues']."%'";
    //                         break;
    //                     default:
    //                         LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": FilterSql Type (".$Type.") is not correct!");
    //                         break;
    //                 }
    //             } // else continue filter values are empty
    //         }else{
    //             LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.': Parameters Filters Matrix and/or Fundamental Entity Fields not set!');
    //             return false;
    //         }
    //         return $FilterSql;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    // Type: 
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
    // *****************
    // CODE BUILDER could be the destination of this function

    public function getFMSql(string $FM)
    {
        try {
            // ex.
            // IdProfile = " . $this->IdProfile."
            // IdProfile like '" . $this->IdProfile."%'
            // where idprj IN (1,3);
            if(!EN($FM)){
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": FM: ".$FM); }
                $FMArr=json_decode($FM,true);
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": FM not set!");
                return false;
            }
            $FilterSql='';
            $FMKeys=array_keys($FMArr);
            if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": Fields:",implode(',',$FMKeys)); }

            foreach ($FMKeys as $FilterVar) {
                $FilterRel=$FMArr[$FilterVar]["filterRel"];
                $FilterType=$FMArr[$FilterVar]["filterType"];
                $FilterVarValues=$FMArr[$FilterVar]["filterValues"];
                // LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": FilterVar       :",$FilterVar);
                // LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": FilterRel       :",$FilterRel);
                // LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": FilterType      :",$FilterType);
                // LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": FilterVarValues :",$FilterVarValues);
                $FilterSql .=' '.$FilterRel.' ';

                if(!EN($FilterVar)){
                    // $FilterSql='Id'.$FE;
                    switch($FilterType) {
                        case 'NoN': // None on Null > '=' (Single or Multiple)
                            // $FilterSql .= ' = '.$IdFE;
                            $FilterSql .= $FilterVar." IN (".$FilterVarValues.")";
                            break;
                        case 'AoN': // All on Null > 'LIKE %' (Single)
                            $FilterSql .= $FilterVar." LIKE '".$FilterVarValues."%'";
                            break;
                        default:
                            LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.": FilterSql Type (".$Type.") is not correct!");
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

    // obsolete: changed method for fks
    // public function getLUSql(string $FEFs)
    // {
    //     try {
    //         // query to insert record
    //         // idT1=VALUES(idT1), nam=VALUES(nam), descr=VALUES(descr)
    //         $LUSql = '';
    //         if(!EN($FEFs)){
    //             $LUSql = implode(',',
    //                 array_map( 
    //                     function($v) { 
    //                         return $v.' = VALUES('.$v.')'; 
    //                     }, 
    //                     explode(',',str_replace($_SESSION["FKPostfix"],'',$FEFs))
    //                 )
    //             );
    //         }else{
    //             LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.': Parameters Fundamental Entity Fields not set!');
    //             return false;
    //         }
    //         return $LUSql;
    //     } catch (Exception $e) {
    //         LM::LogMessage("ERROR", $e);
    //         return false;
    //     }
    // }

    function getLUSql(string $FEFs)
    {
        try {
            $LUSql = '';
            if(!EN($FEFs)){
                $LUSql = implode(',',
                    array_map( 
                        function($v) { 
                            return $v.' = VALUES('.$v.')'; 
                        }, 
                        explode(',',$FEFs)
                    )
                );
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.': Parameters Fundamental Entity Fields not set!');
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
    // get List for Insert/Update sql 
    public function getVMSql(string $FEFs, string $VM)
    {
        try {

            // query to insert record
            $VMSql = '';
            if(!EN($VM)
            && !EN($FEFs)){
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": FEFs: ".$FEFs); }
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": VM: ".$VM); }
                $VMArr=JSON_decode($VM, true);
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": count(VMArr): ".count($VMArr[0])); }
                $FEFsArr=explode(',',$FEFs);
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__.": count(FEFsArr): ".count($FEFsArr)); }
                if(count($VMArr) > 0){
                    if(count($FEFsArr) == count($VMArr[0])){
                        foreach ($VMArr as $VMRow) {
                            $VMSql .= '('. implode(',',$VMRow ) .'),';
                        }
                    }else{
                        LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.': Values number not coherent with column number!');
                        return false;
                    }
                }else{
                    LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.': No values to process!');
                    return false;
                }
            }else{
                LM::LogMessage("WARNING", __CLASS__."->". __FUNCTION__.': Parameters Values Matrix and/or Fundamental Entity Fields not set!');
                return false;
            }

            return substr($VMSql,0, -1); // cut last comma character
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }
        
}