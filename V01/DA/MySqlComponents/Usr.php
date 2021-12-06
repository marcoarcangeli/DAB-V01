<?php
namespace DA\MySqlComponents;

// include_once('/xampp/htdocs/tesiTerzoAnno/DAB/DA/Logs/LogManager.php');
$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');
include_once($BFD.'DA/Common/Common.php');

use DA\Logs\LogManager as LM;
use function DA\Common\verifyNulls as VN;

class Usr
{
    // database connection and table name
    private $Conn;

    // object properties
    /*  
    IdUsr int not null primary key auto_increment,
	UsrNam varchar(30) not null,
	Pwd varchar(30) not null,
	idProfilo int not null
    */
    public $IdUsr;
    public $IdOrganization;
    public $UsrNam;
    public $Pwd;
    public $FirstNam;
    public $Nam;
    public $EMail;
    
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
                    u.IdUsr, 
                    u.UsrNam, 
                    u.Pwd, 
                    u.FirstNam,
                    u.Nam,
                    u.EMail,
                    o.IdOrganization,
                    o.Nam as OrganizationNam
                from usr u
                LEFT OUTER JOIN Organization o on o.IdOrganization = u.IdOrganization
                order by 
                    u.UsrNam
                ";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query statement
            $Stmt = mysqli_query($this->conn, $query);

            return $Stmt;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            // throw new exception($e->getMessage()."\n");
        }
    }

    // read all testEntitys
    public function selectAllOrganization()
    {
        try {

            $query = "
                select 
                    u.IdUsr, 
                    u.UsrNam, 
                    u.Pwd, 
                    u.FirstNam,
                    u.Nam,
                    u.EMail,
                    o.IdOrganization,
                    o.Nam as OrganizationNam
                from usr u
                LEFT OUTER JOIN Organization o on o.IdOrganization = u.IdOrganization
                WHERE
                    u.IdOrganization='" . $this->IdOrganization . "'
                order by 
                    u.UsrNam
                ";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query statement
            $Stmt = mysqli_query($this->conn, $query);

            return $Stmt;
        } catch (Exception $e) {
            LM::LogMessage("ERROR", $e);
            // throw new exception($e->getMessage()."\n");
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
                u.IdUsr, 
                u.UsrNam, 
                u.Pwd, 
                u.FirstNam,
                u.Nam,
                u.EMail,
                o.IdOrganization,
                o.Nam as OrganizationNam
            from usr u
            LEFT OUTER JOIN Organization o on o.IdOrganization = u.IdOrganization
            where u.IdUsr=" . $this->IdUsr;
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
    /*  IdUsr, 
        UsrNam, Nam, Pwd, idProfilo, citta, nazione, telCell, EMail, dataIscrizione, scontoPercentuale
    */

    // create testEntity
    public function insert()
    {
        try {
            //if ($this->alreadyExist()) {
            //    return false;
            //}

            // query to insert record
            $query = "INSERT INTO  usr
                        (UsrNam,Pwd,FirstNam,Nam,EMail,IdOrganization)
                  VALUES
                        (" . VN($this->UsrNam). ",
                         " . VN($this->Pwd). ",
                         " . VN($this->FirstNam). ",
                         " . VN($this->Nam). ",
                         " . VN($this->EMail). ",
                         " . VN($this->IdOrganization). "
                         )";
            // if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG",__CLASS__."->". __FUNCTION__." - query: ".$query); }
            // prepare query
            $Stmt = mysqli_query($this->conn, $query);

            // execute query
            if ($Stmt) {
                $this->IdUsr = $this->conn->insert_id;
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
                    usr
                SET
                    UsrNam=" .          VN($this->UsrNam). ", 
                    Pwd=" .             VN($this->Pwd). ",
                    FirstNam=" .        VN($this->FirstNam). ",
                    Nam=" .             VN($this->Nam). ",
                    EMail=" .           VN($this->EMail). ",
                    IdOrganization=" .  VN($this->IdOrganization). "
                WHERE
                    IdUsr='" . $this->IdUsr . "'";
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
            $query = "DELETE from usr 
                WHERE IdUsr = '" . $this->IdUsr . "'";
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
