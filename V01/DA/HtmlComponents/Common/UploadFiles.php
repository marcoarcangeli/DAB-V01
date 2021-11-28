<?php
session_start();

$BFD=$_SESSION["BaseFolderDyn"];

include_once($BFD.'DA/Logs/LogManager.php');

use DA\Logs\LogManager as LM;

try {
	if($_SESSION["Debug"]>=1){ LM::LogMessage("DEBUG","call: ".basename(__FILE__)); }

	// A list of permitted file extensions
	// $allowed = array('pdf','csv', 'txt');
	$allowed = explode(",",$_SESSION["AllowedUploadFileExt"]);
	$ResFlag=false;

	if (isset($_POST["AllowedUploadFileExt"])) {
		if (trim($_POST["AllowedUploadFileExt"]) != '') {
			$allowed = explode(",",$_POST["AllowedUploadFileExt"]);
		}
	}
	if (isset($_POST["uplName"])) {
		if (trim($_POST["uplName"]) != '') {
			$uplName = $_POST["uplName"];
		}
	}
	if (isset($_POST["dstFolder"])) {
		if (trim($_POST["dstFolder"]) != '') {
			$dstFolder = $_POST["dstFolder"];
		}
	}
	if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","AllowedUploadFileExt: ".$allowed[0]); }
	if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","uplName: ".$uplName); }
	if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","dstFolder: ".$dstFolder); }

	if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","count(_FILES): ".count($_FILES)); }
	if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","_FILES[upl][tmp_name]: ".$_FILES["upl"]['name']); }
	if (isset($_FILES[$uplName]) && $_FILES[$uplName]['error'] == 0) {

		$extension = pathinfo($_FILES[$uplName]['name'], PATHINFO_EXTENSION);
		if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","extension: ".$extension[0]); }

		// if (!in_array(strtolower($extension), $allowed)) {
		if (!in_array($extension, $allowed)) {
			if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","not allowed: ".$allowed[0]); }
			$ResFlag=false;
		}else{
			if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","allowed: ".$allowed[0]); }
			if (move_uploaded_file($_FILES[$uplName]['tmp_name'], $dstFolder . $_FILES[$uplName]['name'])) {
				if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","uploaded: ".$dstFolder . $_FILES[$uplName]['name']); }
				$ResFlag=true;
			}else{
				if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","not uploaded: ".$dstFolder . $_FILES[$uplName]['name']); }
				$ResFlag=false;
			}
		}
	}else{
		if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","uplName not set."); }
		$ResFlag=false;
	}
	if($ResFlag){
		if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","ResFlag true."); }
		$ret_arr = array(
			"State" => true,
			"Msg" => "Executed !"
		);
	}else{
		if($_SESSION["Debug"]>=2){ LM::LogMessage("DEBUG","ResFlag false."); }
		$ret_arr = array(
			"State" => false,
			"Msg" => "not executed !"
		);
	}
    print_r(json_encode($ret_arr));
} catch (Exception $e) {
	LM::LogMessage("ERROR", $e);
	return false;
}
