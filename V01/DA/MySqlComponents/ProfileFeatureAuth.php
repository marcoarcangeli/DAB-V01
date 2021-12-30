<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class ProfileFeatureAuth
{

    // database connection and table IdProfilee
    private $Conn;

    // object properties
    /*  
    IdProfile int not null primary key auto_increment,
	UsrIdProfile varchar(30) not null,
	Pwd varchar(30) not null,
	idProfilo int not null
    */
    // public $IdUsr;
    public $IdProfileFeatureAuths;
    public $IdProfileFeatureAuth;
    public $IdProfile;
    public $IdFeature;
    public $IdAuthLevel;

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
                pfa.IdProfileFeatureAuth,
                p.IdProfile,
                p.Nam as ProfileNam,
                fc.IdFeatureCat,
                fc.Nam as FeatureCatNam,
                f.IdFeature,
                f.Nam as FeatureNam,
                a.IdAuthLevel,
                a.Nam as AuthLevelNam,
                a.AuthLevel as AuthLevel
            FROM
                profilefeatureauth pfa
                LEFT OUTER JOIN profile p on pfa.IdProfile=p.IdProfile
                LEFT OUTER JOIN feature f on pfa.IdFeature=f.IdFeature    
                LEFT OUTER JOIN authLevel a on pfa.IdAuthLevel=a.IdAuthLevel    
                LEFT OUTER JOIN featureCat fc on f.IdFeatureCat=fc.IdFeatureCat    
            ORDER BY
                p.Nam,fc.Nam,f.Nam,a.AuthLevel
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

    // get single testEntity data
    public function selectSingle()
    {
        try {
            // select all query
            $query = "
            SELECT
                pfa.IdProfileFeatureAuth,
                p.IdProfile,
                p.Nam as ProfileNam,
                fc.IdFeatureCat,
                fc.Nam as FeatureCatNam,
                f.IdFeature,
                f.Nam as FeatureNam,
                a.IdAuthLevel,
                a.Nam as AuthLevelNam,
                a.AuthLevel as AuthLevel
            FROM
                profilefeatureauth pfa
                LEFT OUTER JOIN profile p on pfa.IdProfile=p.IdProfile
                LEFT OUTER JOIN feature f on pfa.IdFeature=f.IdFeature    
                LEFT OUTER JOIN authLevel a on pfa.IdAuthLevel=a.IdAuthLevel    
                LEFT OUTER JOIN featureCat fc on f.IdFeatureCat=fc.IdFeatureCat    
            WHERE
                pfa.IdProfileFeatureAuth = " . $this->IdProfileFeatureAuth." 
            ";
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
        public function selectProfileFeatureAuth()
        {
            //throw new exception("this->idVideo: ".$this->idVideo."\n");
            try {
                // select all query
                $query = "
                SELECT
                    pfa.IdProfileFeatureAuth,
                    p.IdProfile,
                    p.Nam as ProfileNam,
                    fc.IdFeatureCat,
                    fc.Nam as FeatureCatNam,
                    f.IdFeature,
                    f.Nam as FeatureNam,
                    a.IdAuthLevel,
                    a.Nam as AuthLevelNam,
                    a.AuthLevel as AuthLevel
                FROM
                    profilefeatureauth pfa
                    LEFT OUTER JOIN profile p on pfa.IdProfile=p.IdProfile
                    LEFT OUTER JOIN feature f on pfa.IdFeature=f.IdFeature    
                    LEFT OUTER JOIN authLevel a on pfa.IdAuthLevel=a.IdAuthLevel    
                    LEFT OUTER JOIN featureCat fc on f.IdFeatureCat=fc.IdFeatureCat    
                WHERE
                    pfa.IdProfile     LIKE '" . $this->IdProfile   . "%' OR
                    pfa.IdFeature     LIKE '" . $this->IdFeature   . "%' OR
                    pfa.IdAuthLevel   LIKE '" . $this->IdAuthLevel . "%' 
                ORDER BY
                    p.Nam,fc.Nam,f.Nam,a.AuthLevel
                ";
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
        public function selectProfile()
        {
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - this->IdProfile: ".$this->IdProfile); }
            try {
                // select all query
                $query = "
                SELECT
                    pfa.IdProfileFeatureAuth,
                    p.IdProfile,
                    p.Nam as ProfileNam,
                    fc.IdFeatureCat,
                    fc.Nam as FeatureCatNam,
                    f.IdFeature,
                    f.Nam as FeatureNam,
                    a.IdAuthLevel,
                    a.Nam as AuthLevelNam,
                    a.AuthLevel as AuthLevel
                FROM
                    profilefeatureauth pfa
                    LEFT OUTER JOIN profile p on pfa.IdProfile=p.IdProfile
                    LEFT OUTER JOIN feature f on pfa.IdFeature=f.IdFeature    
                    LEFT OUTER JOIN authLevel a on pfa.IdAuthLevel=a.IdAuthLevel    
                    LEFT OUTER JOIN featureCat fc on f.IdFeatureCat=fc.IdFeatureCat    
                WHERE
                    pfa.IdProfile     = '" . $this->IdProfile   . "'  
                ORDER BY
                    p.Nam,fc.Nam,f.Nam,a.AuthLevel
                ";
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
                // prepare query statement
                $Stmt = mysqli_query($this->conn, $query);
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - Stmt->num_rows: ".$Stmt->num_rows); }
                // execute query
                return $Stmt;
            } catch (Exception $e) {
                LM::LogMessage("ERROR", $e);
                return false;
            }
        }
    
        // get single testEntity data
        public function selectAllFeatureProfile()
        {
            //throw new exception("this->idVideo: ".$this->idVideo."\n");
            try {
                // select all query
                $query = "
                SELECT
                    pfa.IdProfileFeatureAuth,
                    fc.IdFeatureCat,
                    fc.Nam AS FeatureCatNam,
                    f.IdFeature,
                    f.Nam AS FeatureNam,
                    pfa.IdAuthLevel,
                    pfa.Ck
                FROM
                    feature f
                JOIN featureCat fc ON
                    f.IdFeatureCat = fc.IdFeatureCat
                LEFT OUTER JOIN(
                    SELECT pfa.IdProfileFeatureAuth,
                        fc.IdFeatureCat,
                        fc.Nam AS FeatureCatNam,
                        f.IdFeature,
                        f.Nam AS FeatureNam,
                        a.IdAuthLevel,
                        p.IdProfile AS Ck
                    FROM
                        profilefeatureauth pfa
                    JOIN feature f ON
                        f.IdFeature = pfa.IdFeature
                    JOIN PROFILE p ON
                        pfa.IdProfile = p.IdProfile and p.IdProfile = '" . $this->IdProfile . "'
                    JOIN authLevel a ON
                        pfa.IdAuthLevel = a.IdAuthLevel
                    JOIN featureCat fc ON
                        f.IdFeatureCat = fc.IdFeatureCat
                ) pfa
                ON
                    f.IdFeature = pfa.IdFeature
                ORDER BY
                    fc.Nam,
                    f.Nam
                ";
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
    
    // create testEntity
    public function insert()
    {
        try {
            //if ($this->alreadyExist()) {
            //    return false;
            //}

            // query to insert record
            $query = "
            INSERT INTO  profilefeatureauth
                    (IdProfile,IdFeature,IdAuthLevel)
            VALUES (
                " . VN($this->IdProfile) . ",
                " . VN($this->IdFeature) . ",
                " . VN($this->IdAuthLevel) . "
            )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->IdProfileFeatureAuth = $this->conn->insert_id;
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
            $query = "
            UPDATE
                profilefeatureauth
            SET
                IdProfile="     . VN($this->IdProfile) . ",
                IdFeature="     . VN($this->IdFeature) . ",
                IdAuthLevel="   . VN($this->IdAuthLevel) . "
            WHERE
                IdProfileFeatureAuth='" . $this->IdProfileFeatureAuth . "'
            ";
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
            $query = "DELETE from profilefeatureauth 
                WHERE IdProfileFeatureAuth = '" . $this->IdProfileFeatureAuth . "'";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
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

    // create testEntity
    public function insertProfile()
    {
        try {
            // inizio transazione
            $mysqli = $this->conn;
            $transactionState=false;
            $mysqli->begin_transaction();
            // query to delete profile
            if($this->deleteProfile($this->IdProfile)){
                // query to insert record
                $query = "
                INSERT INTO  profilefeatureauth
                        (IdProfile,IdFeature,IdAuthLevel)
                VALUES ";
                // per ogni riga di IdProfileFeatureAuths
                foreach ($this->IdProfileFeatureAuths as $Row) {
                    $Params[$Param] = isset($_POST[$Param])    ? $_POST[$Param]    : null;
                    $query .= "
                    (
                        " . VN($Row["IdProfile"]) . ",
                        " . VN($Row["IdFeature"]) . ",
                        " . VN($Row["IdAuthLevel"]) . "
                    ),";
                }
                $query=rtrim($query, ", ");
                if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG", __CLASS__."->". __FUNCTION__." - query: ".$query); }
                // prepare query
                $Stmt = mysqli_query($this->conn, $query);

                // execute query
                if ($Stmt) {
                    $transactionState=true;
                }else{
                    $transactionState=false;
                }
            }else{
                $transactionState=false;
            }

            if($transactionState){
                $mysqli->rollback();
                // $mysqli->commit();
            }else{
                $mysqli->rollback();
            }
            return $transactionState;

        } catch (mysqli_sql_exception $e) {
            // $mysqli->rollback();
            LM::LogMessage("ERROR", $e);
            return false;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            return false;
        }
    }

    // delete testEntity
    public function deleteProfile()
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
            $query = "DELETE from profilefeatureauth 
                WHERE IdProfile = '" . $this->IdProfile . "'";
            if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG", __CLASS__."->". __FUNCTION__." - query: ".$query); }
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