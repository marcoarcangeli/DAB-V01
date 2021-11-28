<?php
// FsManager Class
// session_start();
include_once('FsManager.php');

use DA\FsComponents\FsManager as FSM;

// definizione e istanza variabili
$FsManagerMethod = "";
$AnNam = "";
$FileNam = "";
$FileContent = "";
$OverWrite = "";

// unit test params
// $_SESSION["baseFolder"] = "/xampp/htdocs/tesiTerzoAnno/DAB/"; //dirNam(__DIR__);
// $_SESSION["relativeBaseFolder"] = "/tesiTerzoAnno/DAB/";
// $_SESSION["fsRelativePath"] = "DA/_fsBase/";
// $_SESSION["PrjsRelativePath"] = "DA/_Prjs/";
// $_SESSION["PrjAbsPath"] = $_SESSION["baseFolder"] . $_SESSION["PrjsRelativePath"];
// $_SESSION["fsAbsPath"] = $_SESSION["baseFolder"] . $_SESSION["fsRelativePath"];

// if (isset($_GET["PrjNam"])) {
//     if (trim($_GET["PrjNam"]) != '') {
//         $PrjNam = $_GET["PrjNam"];
//     }
// }

// if (isset($_GET["AnNam"])) {
//     if (trim($_GET["AnNam"]) != '') {
//         $AnNam = $_GET["AnNam"];
//     }
// }
// if (isset($_GET["FileNam"])) {
//     if (trim($_GET["FileNam"]) != '') {
//         $FileNam = $_GET["FileNam"];
//     }
// }
// if (isset($_GET["FileContent"])) {
//     if (trim($_GET["FileContent"]) != '') {
//         $FileContent = $_GET["FileContent"];
//     }
// }
// if (isset($_GET["OverWrite"])) {
//     if (trim($_GET["OverWrite"]) != '') {
//         $OverWrite = $_GET["OverWrite"];
//     }
// }
// // Prjs, fsBase
// if (isset($_GET["FsManagerCntx"])) {
//     if (trim($_GET["FsManagerCntx"]) != '') {
//         $FsManagerCntx = $_GET["FsManagerCntx"];
//     }
// }
// if (isset($_GET["FsManagerMethod"])) {
//     if (trim($_GET["FsManagerMethod"]) != '') {
//         $FsManagerMethod = $_GET["FsManagerMethod"];
//     }
// }

if (isset($_GET["PrjNam"])) {
    if (trim($_GET["PrjNam"]) != '') {
        $PrjNam = $_GET["PrjNam"];
    }
}

if (isset($_GET["AnNam"])) {
    if (trim($_GET["AnNam"]) != '') {
        $AnNam = $_GET["AnNam"];
    }
}
if (isset($_GET["FileNam"])) {
    if (trim($_GET["FileNam"]) != '') {
        $FileNam = $_GET["FileNam"];
    }
}
if (isset($_GET["FileContent"])) {
    if (trim($_GET["FileContent"]) != '') {
        $FileContent = $_GET["FileContent"];
    }
}
if (isset($_GET["OverWrite"])) {
    if (trim($_GET["OverWrite"]) != '') {
        $OverWrite = $_GET["OverWrite"];
    }
}
// Prjs, fsBase
if (isset($_GET["FsManagerCntx"])) {
    if (trim($_GET["FsManagerCntx"]) != '') {
        $FsManagerCntx = $_GET["FsManagerCntx"];
    }
}
if (isset($_GET["FsManagerMethod"])) {
    if (trim($_GET["FsManagerMethod"]) != '') {
        $FsManagerMethod = $_GET["FsManagerMethod"];
    }
}
$FsManagerCntx= "Prj";
$FsManagerMethod= "CopySingleFile";
$FileNam= ""; //$("#evento_fileRefDatiRepo").val();
$FilePath= "<?php echo $this->eventAbsPath; ?>";
$FilePathNew= filePathNew;
$OverWrite= ""; //$('#evento_overwright').is(":checked");


if ($FsManagerCntx === "Prjs") {
    $p = [
        "PrjNam"   => $PrjNam,
        "AnNam"  => $AnNam,
        "FileNam"      => $FileNam,
        "FileContent"   => $FileContent,
        "OverWrite"     => $OverWrite
    ];
    echo ($p["PrjNam"]);
    $o = new FSM();
    if ($o->$FsManagerMethod($p)) {
        echo ("ok");
    } else {
        echo ("ko");
    }
} elseif ($FsManagerCntx === "fsBase") {
    echo ($FsManagerMethod . " " . $PrjNam);
    $p = [
        "PrjNam"   => $PrjNam,
        "AnNam"  => $AnNam,
        "FileNam"      => $FileNam,
        "FileContent"   => $FileContent,
        "OverWrite"     => $OverWrite
    ];
    $o = new FSM();
    if ($o->$FsManagerMethod($p)) {
        echo ("ok");
    } else {
        echo ("ko");
    }
} else {
    echo ("Richiesta non corretta;");
}
