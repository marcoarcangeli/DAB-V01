<?php
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class Profile
{

    // database connection and table name
    private $Conn;

    // object properties
    /*  
    IdProfile int not null primary key auto_increment,
	UsrNam varchar(30) not null,
	Pwd varchar(30) not null,
	idProfilo int not null
    */
    public $IdUsr;
    public $IdProfile;
    public $Nam;
    public $Descr;

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
                p.IdProfile,
                p.Nam,
                p.Descr
            FROM
                Profile p
            ORDER BY
                p.IdProfile
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
            SELECT
                p.IdProfile,
                p.Nam,
                p.Descr
            FROM
                Profile p
            WHERE
                IdProfile = " . $this->IdProfile."
            ORDER BY
                p.IdProfile
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

        // get single testEntity data
        public function selectAllFeatureAuth()
        {
            //throw new exception("this->idVideo: ".$this->idVideo."\n");
            try {
                // select all query
                $query = "
                SELECT
                    p.IdProfile,
                    p.Nam,
                    p.Descr,
                    fc.IdFeatureCat,
                    fc.Nam as FeatureCatNam,
                    f.IdFeature,
                    f.Nam as FeatureNam,
                    f.Descr as FeatureDescr,
                    f.CodeParams as FeatureCodeParams,
                    a.IdAuthLevel,
                    a.Nam as AuthLevelNam,
                    a.AuthLevel as AuthLevel
                FROM
                    Profile p
                    LEFT OUTER JOIN profile_feature_auth pfa on pfa.IdProfile=p.IdProfile
                    LEFT OUTER JOIN feature f on pfa.IdFeature=f.IdFeature    
                    LEFT OUTER JOIN authLevel a on pfa.IdAuthLevel=a.IdAuthLevel    
                    LEFT OUTER JOIN featureCat fc on f.IdFeatureCat=fc.IdFeatureCat    
                WHERE
                    p.IdProfile = " . $this->IdProfile."
                ORDER BY
                    fc.Nam, f.Nam
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
    
        // get single testEntity data
        public function selectAllUsrProfileFeatureAuth()
        {
            //throw new exception("this->idVideo: ".$this->idVideo."\n");
            try {
                // select all query
                $query = "
                SELECT
                    u.IdUsr,
                    u.usrNam,
                    count(p.IdProfile),
                    fc.IdFeatureCat,
                    fc.Nam as FeatureCatNam,
                    f.IdFeature,
                    f.Nam as FeatureNam,
                    f.Descr as FeatureDescr,
                    f.CodeParams as FeatureCodeParams,
                    a.IdAuthLevel,
                    a.Nam as AuthLevelNam,
                    max(a.AuthLevel) as AuthLevel
                FROM
                    usr u
                    LEFT OUTER JOIN profile_usr pu on pu.IdUsr=u.IdUsr
                    LEFT OUTER JOIN Profile p on pu.IdProfile=p.IdProfile
                    LEFT OUTER JOIN profile_feature_auth pfa on pfa.IdProfile=p.IdProfile
                    LEFT OUTER JOIN feature f on pfa.IdFeature=f.IdFeature    
                    LEFT OUTER JOIN authLevel a on pfa.IdAuthLevel=a.IdAuthLevel    
                    LEFT OUTER JOIN featureCat fc on f.IdFeatureCat=fc.IdFeatureCat    
                GROUP BY
                    u.IdUsr,
                    fc.IdFeatureCat,
                    f.IdFeature
                HAVING
                    u.IdUsr = " . $this->IdUsr."
                ORDER BY
                    fc.IdFeatureCat,
                    f.IdFeature
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

        // get single testEntity data
        public function selectAllUsrProfile()
        {
            //throw new exception("this->idVideo: ".$this->idVideo."\n");
            try {
                // select all query
                $query = "
                SELECT
                    u.IdUsr,
                    u.usrNam,
                    p.IdProfile,
                    p.Nam,
                    p.Descr
                FROM
                    usr u
                    LEFT OUTER JOIN profile_usr pu on pu.IdUsr=u.IdUsr
                    LEFT OUTER JOIN Profile p on pu.IdProfile=p.IdProfile
                WHERE
                    u.IdUsr = " . $this->IdUsr."
                ORDER BY
                    p.Nam
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
    public function insert()
    {
        try {
            //if ($this->alreadyExist()) {
            //    return false;
            //}

            // query to insert record
            $query = "INSERT INTO  Profile
                        (Nam,Descr)
                  VALUES
                        (" . VN($this->Nam) . ",
                         " . VN($this->Descr) . "
                         )";
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

    // update testEntity 
    public function update()
    {
        try {
            // query to insert record
            $query = "UPDATE
                    Profile
                SET
                    Nam="   .VN($this->Nam) . ",
                    Descr=" .VN($this->Descr) . "
                WHERE
                    IdProfile='" . $this->IdProfile . "'";
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
            $query = "DELETE from Profile 
                WHERE IdProfile = '" . $this->IdProfile . "'";
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
