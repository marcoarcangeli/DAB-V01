<?php
// namespace DA;
// Initialize the session
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
include_once('DA/logs/logManager.php');
use DA\Logs\LogManager as LM;

LM::LogMessage("INFO", "User [".$_SESSION["IdUsr"]."] Log-out.");

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();
 
// Redirect to logIn page
header("location: Index.php");
exit;
