<?php
namespace DA\Logs;

session_start();
$IdUsr="1";
$UsrNam="dev";
$FirstNam="dev";
$Nam="dev";
$eMail="dev@dab.it";

include_once('..\..\SessionInitParams.php');
include_once('LogManager.php');

use DA\Logs\LogManager as LM;
use DA\Logs;

$Result = LM::LogMessage();
echo $Result;
LM::LogMessage("ERROR", "This is a test error message.");
$Result = LM::LogMessage("ERROR", "This is a test error message with result.");
echo $Result;
$Result = LM::LogMessage("WARN", "This is a test warning message.");
echo $Result;
$Result = LM::LogMessage("INFO", "This is a test information message.");
echo $Result;


