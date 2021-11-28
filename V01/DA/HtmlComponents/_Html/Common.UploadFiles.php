<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
include_once($BFD.'DA/FsComponents/FsManager.php');

include_once($BFD.'DA/Logs/LogManager.php');
try {

	// A list of permitted file extensions
	// $allowed = array('pdf','csv', 'txt');
	$allowed = $_SESSION["allowedUploadFileExt"];
	// $DstFolder = $_SESSION["EvntAbsPath"];
	// $uplName = 'upl_repoDataEvntFilesTlist';

	if (isset($_POST["uplName"])) {
		if (trim($_POST["uplName"]) != '') {
			$uplName = $_POST["uplName"];
		}
	}
	if (isset($_POST["DstFolder"])) {
		if (trim($_POST["DstFolder"]) != '') {
			$DstFolder = $_POST["DstFolder"];
		}
	}

	//per implementazione con fs,Manager.importFile(array $p)
	// include_once('fsManager.php');
	// 
	// if ($fsManagerCntx === "Prjs") {
	// 	$p = [
	// 		"projectName"   => $projectName,
	// 		"analysisName"  => $analysisName,
	// 		"Fn"      => $Fn,
	// 		"fileContent"   => $fileContent,
	// 		"overWrite"     => $overWrite
	// 	];
	//  $FsManagerMethod=importFile;
	// 	$o = new fsManager();
	// 	if ($o->$FsManagerMethod($p)) {
	// 		$Result = "true";
	// 	} else {
	// 		$Result = "False";
	// 	}
	// }

	if (isset($_FILES[$uplName]) && $_FILES[$uplName]['error'] == 0) {

		$extension = pathinfo($_FILES[$uplName]['name'], PATHINFO_EXTENSION);

		if (!in_array(strtolower($extension), $allowed)) {
			// echo '{"State":"error"}';
			exit;
		}

		if (move_uploaded_file($_FILES[$uplName]['tmp_name'], $DstFolder . $_FILES[$uplName]['name'])) {
			// echo '{"State":"success"}';
			exit;
		}
	}

	// echo '{"State":"error"}';
	exit;
} catch (Exception $e) {
	LM::LogMessage("ERROR", $e);
	
	// throw new exception("Exception ".$e->getCode()." Msg: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine());
}
