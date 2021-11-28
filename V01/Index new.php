<?php
session_start();

include_once("SessionBootParams.php");
include_once("DA/Logs/LogManager.php");
include_once("DA/mySqlComponents/Database.php");
include_once("DA/mySqlComponents/ProfileFeatureAuth.php");
include_once('DA/Common/Common.php');
include_once('DA/HtmlComponents/ProfileFeatureAuth/Dao.ctrl.php');
// Initialize the session
use DA\HtmlComponents as HC;
use DA\mySqlComponents\Database as DB;
use DA\Logs\LogManager as LM;
use DA\HtmlComponents\ProfileFeatureAuth\DaoCtrl as DAO;

// get Org and App params
$Db = new DB();
$Conn = $Db->getConnection();
$Sql = "
    SELECT
        t.IdOrganization,
        t.Nam,
        t.Descr,
        t.CodeParams,
        t.Dttm
    FROM
        Organization t
    WHERE
        t.Dttm <= NOW()
    order by 
        t.Dttm desc
    limit 1
";
if ($Stmt = mysqli_prepare($Conn, $Sql)) {
    // Bind variables to the prepared statement as parameters
    // mysqli_stmt_bind_param($Stmt, "s", $param_UsrNam);
    // // Set parameters
    // $param_UsrNam = $UsrNam;
    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($Stmt)) {
        // Store result
        mysqli_stmt_store_result($Stmt);
        // Check if UsrNam exists, if yes then verify password
        if (mysqli_stmt_num_rows($Stmt) == 1) {
            // Bind result variables
            mysqli_stmt_bind_result(
                $Stmt,
                $IdOrganization,
                $Nam,
                $Descr,
                $CodeParams,
                $Dttm
            );

            if (mysqli_stmt_fetch($Stmt)) {
                $IdOrg         = (isset($IdOrganization) && trim($IdOrganization)!='') ? $IdOrganization : "";
                $OrgNam        = (isset($Nam) && trim($Nam)!='') ? $Nam : "(Organization name)";
                $OrgDescr      = (isset($Descr) && trim($Descr)!='') ? $Descr : "(Organization description)";
                $OrgCodeParams = (isset($CodeParams) && trim($CodeParams)!='') ? $CodeParams : "";
                $OrgDttm       = (isset($Dttm) && trim($Dttm)!='') ? $Dttm : "";
            }
            // set parametri aggiuntivi organizzazione salvati in formato json
            if(isset($OrgCodeParams) && trim($OrgCodeParams) != ''){
                if($decoded=json_decode($OrgCodeParams,true)){
                    $Logo        = $decoded["Logo"];
                    $App         = $decoded["App"];
                    $Title       = $decoded["Title"];
                    $Version     = $decoded["Version"];
                    $License     = $decoded["License"];
                    $Author      = $decoded["Author"];
                    $Description = $decoded["Description"];
                } else { // defaults
                    $Logo        = "DAB_Logo.png";
                    $App         = "App Name";
                    $Title       = "App Title";
                    $Version     = "--";
                    $License     = "MIT";
                    $Author      = "MA";
                    $Description = "App Description";
                }
            }
            // $LogoRelPathfn = explode(";", $OrgCodeParams);
        } else {
            // Display an error message if UsrNam doesn't exist
            echo "Organization not found.";
        }
    } else {
        echo "Organization not available. Try later.";
    }
    // Close statement
    mysqli_stmt_close($Stmt);
} else {
    echo "Connection not available. Try later.";
}
// Close connection
mysqli_close($Conn);

// // Check if the user is already logged in, if yes then redirect him to Welcome page
if (isset($_SESSION["LoggedIn"]) && $_SESSION["LoggedIn"] === true) {
    header("location: LogOut.php");
    exit;
}


// // Define variables and initialize with empty values
$UsrNam = $Password = "";
$UsrNam_err = $PasswordErr = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
        // Check if UsrNam is empty
    // if (empty(trim($_POST["UsrNam"]))) {
    if (trim($_POST["UsrNam"]) == '') {
        $UsrNam_err = "Enter the UsrNam.";
    } else {
        $UsrNam = trim($_POST["UsrNam"]);
    }

    // // Check if password is empty
    // if (empty(trim($_POST["password"]))) {
    if (trim($_POST["password"]) == '') {
        $PasswordErr = "Enter the Password.";
    } else {
        $Password = trim($_POST["password"]);
    }

    // Validate credentials
    // if (empty($UsrNam_err) && empty($PasswordErr)) {
    if (($UsrNam_err == '') && ($PasswordErr  == '')) {
        // /* Attempt to connect to MySQL Database */
        $Db = new DB();
        $Conn = $Db->getConnection();
        // Prepare a select statement
        // commentato per test
        //$Sql = "SELECT IdUsr, UsrNam, Pwd FROM pp1_Usr WHERE UsrNam = ?";
        $Sql = "
            SELECT 
                u.IdUsr, 
                u.UsrNam, 
                u.Pwd, 
                u.FirstNam,
                u.Nam,
                u.EMail
            FROM Usr u
            WHERE u.UsrNam = ?
        ";

        if ($Stmt = mysqli_prepare($Conn, $Sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($Stmt, "s", $param_UsrNam);

            // Set parameters
            $param_UsrNam = $UsrNam;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($Stmt)) {
                // Store result
                mysqli_stmt_store_result($Stmt);

                // Check if UsrNam exists, if yes then verify password
                if (mysqli_stmt_num_rows($Stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result(
                        $Stmt,
                        $IdUsr,
                        $UsrNam,
                        $Pwd,
                        $FirstNam,
                        $Nam,
                        $EMail
                    );

                    if (mysqli_stmt_fetch($Stmt)) {
                        //if (password_verify($Password, $Pwd)) {
                        if ($Password == $Pwd) {
                            // load profile
                            $Dao = new DAO();
                            $Dao->CompulsoryParamNams = $CompulsoryParamNams;
                            $Dao->ParamNams = $ParamNams;
                            $Result_arr = $Dao->TlistDb($Params);
                        
                            // Password is correct, so start a new session
                            include_once("SessionInitParams.php");
                            // \DA\LogMessage("INFO", "User [".$_SESSION["IdUsr"]."] Log-in.");
                            LM::LogMessage("INFO", "User [".$_SESSION["IdUsr"]."] Log-in.");

                            // set navigation
                            $_SESSION["ContentClass"] = $ContentClass= "DA\HtmlComponents\App\Welcome";
                            header("location: Master.php");
                            // header("location: " . $_SESSION["baseFolder"] . "Master.php");
                        } else {
                            // Display an error message if password is not valid
                            $PasswordErr = "Password incorrect." . $IdUsr;
                        }
                    }
                } else {
                    // Display an error message if UsrNam doesn't exist
                    $UsrNam_err = "Username not found.";
                }
            } else {
                echo "Authentication not executed. Try later.";
            }
            // Close statement
            mysqli_stmt_close($Stmt);
        } else {
            echo "Connection not available. Try later.";
        }
        // Close connection
        mysqli_close($Conn);
    } 
} 

?>

<!DOCTYPE html>
<html style="height: auto;background-color: darkseagreen;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>logIn</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="dist/css/css.css">

    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }

        .center {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
    </style>

</head>

<body>
    <div class="center">
        <div class="wrapper card bg-green">
            <div class="panel panel-info">
                <div class="panel-heading text-center fonts" style="padding-top: 30px; padding-bottom: 30px;">
                    <div style="margin-top: 7px; font-size: 15px;">
                        <img id="OrgLogo" src="dist/img/<?php echo $Logo; ?>" class="img-circle" style="width: 50px;" alt="User Image">
                        <strong><a id="OrgNam" href="#" target="_blank" class="badge badge-warning"><?php echo $OrgNam; ?></a></strong>
                    </div>
                    <div style="margin-top: 7px; font-size: 30px;"><strong><?php echo $App; ?></strong><i style="font-size: 14px;"> V<?php echo $Version; ?></i></div>
                    <div style="margin-top: 7px; font-size: 24px;"><?php echo $Title; ?></div>
                    <div style="margin-top: 7px; font-size: 14px;"><i>by <?php echo $Author; ?></i></div>
                    <div style="margin-top: 7px; font-size: 10px;"><i>License <?php echo $License; ?></i></div>
                </div>
            </div>
        </div>
        <div class="wrapper card" style="background-color: #28a745;">
            <!-- <h2>Log In</h2> -->
            <p>Enter credentials.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo ($UsrNam_err != '') ? 'has-error' : ''; ?>">
                    <label>Username</label>
                    <input type="text" name="UsrNam" class="form-control" value="<?php echo $UsrNam; ?>">
                    <span class="help-block  text-danger"><i><?php echo $UsrNam_err; ?></i></span>
                </div>
                <div class="form-group <?php echo ($PasswordErr != '') ? 'has-error' : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    <span class="help-block text-danger"><i><?php echo $PasswordErr; ?></i></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-warning" value="Log In">
                </div>
                <!-- <p>Don't have an account? <a href="register.php">Sign up now</a>.</p> -->
                <!-- <a href="../documentazione/UtenzeComplete.pdf" target="_blank">Utenze Complete</a> -->
            </form>
        </div>
    </div>

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>

</html>