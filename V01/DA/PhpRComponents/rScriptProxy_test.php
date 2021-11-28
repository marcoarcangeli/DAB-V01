<?php
session_start();
$BFD=$_SESSION["BaseFolderDyn"];
// impostazioni di test
$IdUsr  ="1";
$UsrNam  = "dev";
$FirstNam  = "dev";
$Nam  ="dev";
$EMail  ="dev@dev.com";

include_once("\\xampp\htdocs\\tesiTerzoAnno\DAB\sessionInitParams.php");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Test</title>
    <link rel="stylesheet" href="/tesiTerzoAnno/DAB/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/tesiTerzoAnno/DAB/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="/tesiTerzoAnno/DAB/dist/css/css.css">

</head>
<!--
    // public string $rScriptAbsPath;
    // public string $rScriptOutputAbsPath;
    // public string $rScriptName;
    // public string $rScriptParams;
 \xampp\htdocs\PHPTemplate/PHPTemplatesAndTests/scriptTests/output/esempio1rScriptPrototype_Sample01_params.csv

casi di test          
------------                                                                                                                                                                
 $rScriptName;                  $rScriptAbsPath;                                           $rScriptOutputAbsPath;                                                     $rScriptParams;
 -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 rScriptPrototype_Sample01.R    /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/     /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/esempio1/                 par1=Progetto&par2=alone&par3=2
 analisiStruttura.R             /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/     /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/analisiStruttura/         CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv&decSep=,&csvSep=;&csvHeader=T" 
 splitTrainingTest.R            /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/     /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/                    CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&CSVDataFilename=EuStockMarkets2.csv&decSep=,&csvSep=;&csvHeader=T&splitType=percentuale&splitConditionVect=1,55
 analisiSingolaVariabile.R      /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/     /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/analisiSingolaVariabile/  CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv&decSep=,&csvSep=;&csvHeader=T" 
 regressioneLineare.R           /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/     /xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/regressioneLineare/       CSVTrainDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/&CSVTestDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/&CSVTrainDataFilename=EuStockMarkets2_training.csv&CSVTestDataFilename=EuStockMarkets2_test.csv&decSep=,&csvSep=;&csvHeader=T&outcome=DAX&variables=SMI,CAC,FTSE" 
-->
<body>
    <form role="form" method="POST" >
        <p>Parametri di Test.</p>
        <div class="form-group >
            <label for="rScriptAbsPath">rScriptAbsPath</label>
            <input type="text" id="rScriptAbsPath" name="rScriptAbsPath" class="form-control" placeholder="rScriptAbsPath ..." value="/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/">
        </div>
        <div class="form-group >
            <label for="rScriptOutputAbsPath">rScriptOutputAbsPath</label>
            <input type="text" id="rScriptOutputAbsPath" name="rScriptOutputAbsPath" class="form-control" placeholder="rScriptOutputAbsPath ..." value="/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/esempio1/">
        </div>
        <div class="form-group >
            <label for="rScriptName">rScriptName</label>
            <input type="text" id="rScriptName" name="rScriptName" class="form-control" placeholder="rScriptName ..." value="rScriptPrototype_Sample01.R">
        </div>
        <div class="form-group">
            <label for="rScriptParams">rScriptParams</label>
            <input type="text" class="form-control" id="rScriptParams" placeholder="rScriptParams ..." value="par1=Progetto&par2=alone&par3=2">
        </div>
        <!--
        <div class="form-group">
            <label for="par1">par1</label>
            <input type="text" class="form-control" id="par1" placeholder="par1 ..." value="Progetto">
        </div>
        <div class="form-group">
            <label for="par2">par2</label>
            <input type="text" class="form-control" id="par2" placeholder="par2 ..." value="alone">
        </div>
        <div class="form-group">
            <label for="par3">par3</label>
            <input type="text" class="form-control" id="par3" placeholder="par3 ..." value="2">
        </div>
        -->
        <div class="form-group">
            <input id="btnrScriptPrototype_Sample01" type="button" class="btn btn-outline-primary btn-xs" value="rScriptPrototype_Sample01.R"></input>
        </div>
        <div class="form-group">
            <input id="btnanomaliesAuto" type="button" class="btn btn-outline-primary btn-xs" value="btnanomaliesAuto.R"></input>
        </div>
        <div class="form-group">
            <input id="btnsplitTrainingTest" type="button" class="btn btn-outline-primary btn-xs" value="splitTrainingTest.R"></input>
        </div>
        <div class="form-group">
            <input id="btnanalisiSingolaVariabile" type="button" class="btn btn-outline-primary btn-xs" value="analisiSingolaVariabile.R"></input>
        </div>
        <div class="form-group">
            <input id="btnanalisiStruttura" type="button" class="btn btn-outline-primary btn-xs" value="analisiStruttura.R"></input>
        </div>
        <div class="form-group">
            <input id="btnregressioneLineare" type="button" class="btn btn-outline-primary btn-xs" value="regressioneLineare.R"></input>
        </div>


        <div class="form-group">
            <!-- <input type="submit" class="btn btn-primary" value="Log In"> -->
            <input id="btnTest" type="button" class="btn btn-outline-primary btn-xs" value="Test"></input>
        </div>

        <div class="form-group">
            <label for="result">result</label>
            <div id="result" value=""></div>
        </div>

    </form>

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery tesiTerzoAnno\DAB\plugins\jquery\jquery.min.js
                tesiTerzoAnno\DAB\DA\PhpRComponents\rScriptProxy_test.php -->
    <script src="/tesiTerzoAnno/DAB/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/tesiTerzoAnno/DAB/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/tesiTerzoAnno/DAB/dist/js/adminlte.min.js"></script>


<script type="text/javascript" ref="da.Test">

    $(document).ready(function() {
        // alert(da.Test.Mode);
        // var TestFields = array("idProgetto", "idUtente", "nome", "descrizione", "folderRef", "idStatoProgetto");

        // contentParams C:\xampp\htdocs\tesiTerzoAnno\DAB\dist
        $("#btnTest").click(function() {
            // alert("#btnTest"); 
            $("#result").html("In esecuzione ...<br>");
            // prepara parametri specifici dello script
            // rScriptParams="par1="+$("#par1").val();
            // rScriptParams+="&par2="+$("#par2").val();
            // rScriptParams+="&par3="+$("#par3").val();
            // alert(rScriptParams);
            return $.ajax({
                type: "POST",
                url: "rScriptProxy.php",
                async: true,
                dataType: "json",
                data: {
                    rScriptAbsPath: $("#rScriptAbsPath").val(),
                    rScriptOutputAbsPath: $("#rScriptOutputAbsPath").val(),
                    rScriptName: $("#rScriptName").val(),
                    // rScriptParams: rScriptParams
                    rScriptParams: $("#rScriptParams").val()
                },
                error: function(result) {
                    $("#result").html("Info: <br>"+result.responseText);
                    // alert("Errore<br>"+result.responseText, "Errore");
                    return "false";
                },
                success: function(result) {
                    $("#result").html("Informazione<br>"+result.responseText);
                    // alert("Success.", "Informazione");
                    if (result["State"] == true) {
                        return "true";
                    } else {
                        return "false";
                    }
                }
            })
        });

        $("#btnrScriptPrototype_Sample01").click(function() {
            // alert("#btnrScriptPrototype_Sample01"); 
            $("#rScriptAbsPath").val("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/");
            $("#rScriptOutputAbsPath").val("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/esempio1/");
            $("#rScriptName").val("rScriptPrototype_Sample01.R");
            $("#rScriptParams").val("par1=Progetto&par2=alone&par3=2");
        });

        $("#btnanalisiStruttura").click(function() {
            // alert("#btnanalisiStruttura"); 
            $("#rScriptName").val("analisiStruttura.R");
            $("#rScriptAbsPath").val("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/");
            $("#rScriptOutputAbsPath").val("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/analisiStruttura/");
            $("#rScriptParams").val("CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv&decSep=,&csvSep=;&csvHeader=TRUE");
        });

        $("#btnanomaliesAuto").click(function() {
            // alert("#btnsplitTrainingTest"); 
            $("#rScriptAbsPath").val("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/");
            $("#rScriptOutputAbsPath").val("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/anomalies/");
            $("#rScriptName").val("anomaliesAuto.R");
            $("#rScriptParams").val("CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&CSVDataFilename=EuStockMarkets2.csv&decSep=,&csvSep=;&csvHeader=T&splitType=percentuale&splitConditionVect=1,55");
        });

        $("#btnsplitTrainingTest").click(function() {
            // alert("#btnsplitTrainingTest"); 
            $("#rScriptAbsPath").val("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/");
            $("#rScriptOutputAbsPath").val("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/");
            $("#rScriptName").val("splitTrainingTest.R");
            $("#rScriptParams").val("CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/&CSVDataFilename=EuStockMarkets2.csv&decSep=,&csvSep=;&csvHeader=T&splitType=percentuale&splitConditionVect=1,55");
        });

        $("#btnanalisiSingolaVariabile").click(function() {
            // alert("#btnanalisiSingolaVariabile"); 
            $("#rScriptAbsPath").val("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/");
            $("#rScriptOutputAbsPath").val("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/analisiSingolaVariabile/");
            $("#rScriptName").val("analisiSingolaVariabile.R");
            $("#rScriptParams").val("CSVDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/dati/Adults/&CSVDataFilename=adults2.csv&decSep=,&csvSep=;&csvHeader=T");
        });

        $("#btnregressioneLineare").click(function() {
            // alert("#btnregressioneLineare"); 
            $("#rScriptName").val("regressioneLineare.R");
            $("#rScriptAbsPath").val("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/");
            $("#rScriptOutputAbsPath").val("/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/regressioneLineare/");
            $("#rScriptParams").val("CSVTrainDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/&CSVTestDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/&CSVTrainDataFilename=EuStockMarkets2_training.csv&CSVTestDataFilename=EuStockMarkets2_test.csv&decSep=,&csvSep=;&csvHeader=T&outcome=DAX&variables=SMI,CAC,FTSE&controlMethod=repeatedcv&modelMethods=lm,svmRadial");
        });

    })

</script>

</body>

</html>

