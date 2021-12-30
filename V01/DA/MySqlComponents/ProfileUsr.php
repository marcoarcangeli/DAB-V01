<?php // TO DO
namespace DA\MySqlComponents;

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class ProfileUsr
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
    public $IdProfileUsr;
    public $IdProfile;
    public $IdUsr;

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
                pu.IdProfileUsr,
                pu.IdProfile,
                p.Nam as ProfileNam,
                pu.IdUsr,
                u.UsrNam
            FROM
                profileusr pu
                LEFT OUTER JOIN profile p on pu.IdProfile=p.IdProfile
                LEFT OUTER JOIN usr u on pu.IdUsr=u.IdUsr    
            ORDER BY
                p.Nam,u.Nam
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
                pu.IdProfileUsr,
                pu.IdProfile,
                p.Nam as ProfileNam,
                pu.IdUsr,
                u.UsrNam
            FROM
                profileusr pu
                LEFT OUTER JOIN profile p on pu.IdProfile=p.IdProfile
                LEFT OUTER JOIN usr u on pu.IdUsr=u.IdUsr   
            WHERE
                pu.IdProfileUsr = " . $this->IdProfileUsr." 
            ORDER BY
                p.Nam,u.Nam
            ";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","query: ".$query); }
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
        public function selectAllProfileUsr()
        {
            //throw new exception("this->idVideo: ".$this->idVideo."\n");
            try {
                // select all query
                $query = "
                SELECT
                    pu.IdProfileUsr,
                    pu.IdProfile,
                    p.Nam as ProfileNam,
                    pu.IdUsr,
                    u.UsrNam
                FROM
                    profileusr pu
                    LEFT OUTER JOIN profile p on pu.IdProfile=p.IdProfile
                    LEFT OUTER JOIN usr u on pu.IdUsr=u.IdUsr   
                WHERE
                pu.IdProfile like '" . $this->IdProfile."%' and
                pu.IdUsr like '" . $this->IdUsr."%'
                ORDER BY
                    p.Nam,u.Nam
                ";
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","query: ".$query); }
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
        public function selectAllProfile()
        {
            //throw new exception("this->idVideo: ".$this->idVideo."\n");
            try {
                // select all query
                $query = "
                SELECT
                    pu.IdProfileUsr,
                    pu.IdProfile,
                    p.Nam as ProfileNam,
                    pu.IdUsr,
                    u.UsrNam
                FROM
                    profileusr pu
                    LEFT OUTER JOIN profile p on pu.IdProfile=p.IdProfile
                    LEFT OUTER JOIN usr u on pu.IdUsr=u.IdUsr   
                WHERE
                    pu.IdProfile = " . $this->IdProfile." 
                ORDER BY
                    p.Nam,u.Nam
                ";
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","query: ".$query); }
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
        public function selectAllUsr()
        {
            //throw new exception("this->idVideo: ".$this->idVideo."\n");
            try {
                // select all query
                $query = "
                SELECT
                    pu.IdProfileUsr,
                    pu.IdProfile,
                    p.Nam as ProfileNam,
                    pu.IdUsr,
                    u.UsrNam
                FROM
                    profileusr pu
                    LEFT OUTER JOIN profile p on pu.IdProfile=p.IdProfile
                    LEFT OUTER JOIN usr u on pu.IdUsr=u.IdUsr   
                WHERE
                    pu.IdUsr = " . $this->IdUsr." 
                ORDER BY
                    p.Nam,u.Nam
                ";
                // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","query: ".$query); }
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
            $query = "INSERT INTO  profileusr
                        (IdProfile,IdUsr)
                  VALUES
                        (" . VN($this->IdProfile) . ",
                         " . VN($this->IdUsr) . "
                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","query: ".$query); }
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
                    profileusr
                SET
                    IdProfile ="    .VN($this->IdProfile)   . ",
                    IdUsr ="        .VN($this->IdUsr)       . "
                WHERE
                IdProfileUsr='"    . $this->IdProfileUsr . "'";

            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","query: ".$query); }
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
                WHERE IdProfileUsr = '" . $this->IdProfileUsr . "'";
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