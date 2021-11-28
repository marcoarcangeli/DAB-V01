<script type="text/javascript" ref="da.AnCntxRead">
    da.AnCntxRead = {
        // FsManagerAnCntx: "Prjs",
        PanelTag: 'AnCntx_',
        CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
        IdAnCntx: '', // '?php echo $_SESSION["ASV"]["IdAnCntx"]; ?>',
        IdAn: '<?php echo $_SESSION["PSV"]["IdAn"]; ?>',
        IdCntx: '<?php echo $_SESSION["PSV"]["IdCntx"]; ?>',
        PrjEvntRelPath: '',
        AnCntxFileRefDatNam: '',
        PrjAnAbsPath: '',
        TrainFileRefDatNam: '',
        TestFileRefDatNam:  '',
        Mode: '<?php echo $this->Mode; ?>',
        ParentObj: '<?php echo $this->ParentObj; ?>',
        ParentObjType: '<?php echo $this->ParentObjType; ?>',
        RefPanels: "<?php echo $this->RefPanels; ?>",
        SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
        FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

        btnControl: function() {
            if(da.AnCntxRead.Mode == 'alone'){
                $("#AnCntxBtns #btnNew").hide();
            }
            
            if($("#AnCntx_IdAnCntx").val()==""){
                $("#AnCntxBtns #btnRefresh").attr("disabled", true);
                $("#AnCntxBtns #btnDelete").attr("disabled", true);
            }else{
                $("#AnCntxBtns #btnRefresh").attr("disabled", false);
                $("#AnCntxBtns #btnDelete").attr("disabled", false);
            }

            if(
                $("#AnCntx_Nam").val()=="" &&
                $("#AnCntx_Descr").val()==""
            ){
                $("#AnCntxBtns #btnSave").attr("disabled", true);
            }else{
                $("#AnCntxBtns #btnSave").attr("disabled", false);
            }

            if(
                $("#AnCntx_IdAnCntx").val()==""
            ){
                $("#AnCntxBtns #btnComputeSplit").attr("disabled", true);
            }else{
                $("#AnCntxBtns #btnComputeSplit").attr("disabled", false);
            }
            if(
                $("#AnCntx_fileRefTrainDat").val()=="" ||
                $("#AnCntx_fileRefTestDat").val()=="" 
            ){
                $("#AnCntxBtns #btnComputeRegression").attr("disabled", true);
            }else{
                $("#AnCntxBtns #btnComputeRegression").attr("disabled", false);
            }

        },

        SetParamsFromPrjState: function(){

            prjState=da.PrjView.Get();
            da.AnCntxRead.IdAnCntx= (prjState["IdAnCntx"]? prjState["IdAnCntx"] : '<?php echo $_SESSION["ASV"]["IdAnCntx"]; ?>'); 
            da.AnCntxRead.IdAn= (prjState["IdAn"]? prjState["IdAn"] : '<?php echo $_SESSION["PSV"]["IdAn"]; ?>'); 
            da.AnCntxRead.IdCntx= (prjState["IdCntx"]? prjState["IdCntx"] : '<?php echo $_SESSION["PSV"]["IdCntx"]; ?>'); 

            da.AnCntxRead.PrjEvntRelPath= '<?php echo $_SESSION["PrjRelPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' 
                + prjState["EvntFolderNam"] +'/';
            da.AnCntxRead.PrjAnAbsPath= '<?php echo $_SESSION["PrjAbsPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' 
                + prjState["AnFolderNam"] + '/';
            da.AnCntxRead.AnCntxFileRefDatNam= prjState["FileNamRepoDat"] 
                + '<?php echo $_SESSION["AutoCleanDatFile"].$_SESSION["DatCSVFile"]; ?>';
            da.AnCntxRead.TrainFileRefDatNam= prjState["FileNamRepoDat"] 
                + '<?php echo $_SESSION["AutoCleanDatFile"].$_SESSION["TrainDatFile"].$_SESSION["DatCSVFile"]; ?>';
            da.AnCntxRead.TestFileRefDatNam=  prjState["FileNamRepoDat"] 
                + '<?php echo $_SESSION["AutoCleanDatFile"].$_SESSION["TestDatFile"].$_SESSION["DatCSVFile"]; ?>';
            return prjState;
        },
        // AnCntx (IdAnCntx, IdAn, IdCntx, IdSplitType, nam, Descr, fileRefTrainDat, fileRefTestDat)
        Get: function() {
            data= {
                IdAnCntx:           $("#AnCntx_IdAnCntx").val(),
                IdAn:               $("#AnCntx_IdAn").val(),
                IdCntx:             $("#AnCntx_IdCntx").val(),
                IdSplitType:        $("#AnCntx_IdSplitType").val(),
                // AnNam:        $("#AnCntx_AnNam").val(),
                IdPrj:              $("#AnCntx_IdPrj").val(),
                // PrjNam:         $("#AnCntx_PrjNam").val(),
                Nam:                $("#AnCntx_Nam").val(),
                Descr:              $("#AnCntx_Descr").val(),
                fileRefTrainDat:    $("#AnCntx_fileRefTrainDat").val(),
                fileRefTestDat:     $("#AnCntx_fileRefTestDat").val(),
                Regr_Outcome       : $("#AnCntx_Regr_Outcome").val(),
                Regr_Vars          : $("#AnCntx_Regr_Vars").val(),
                Regr_CtrlMethod    : $("#AnCntx_Regr_CtrlMethod").val(),
                Regr_ModelMethods  : $("#AnCntx_Regr_ModelMethods").val()
            };
            // alert(data["IdSplitType"]);
            return data;
        },

        Set: function(data) {
            $("#AnCntx_IdAnCntx").val(data["IdAnCntx"]);
            $("#AnCntx_IdAn").val(data["IdAn"]);
            $("#AnCntx_AnNam").val(data["AnNam"]);
            $("#AnCntx_IdCntx").val(data["IdCntx"]);
            $("#AnCntx_CntxNam").val(data["CntxNam"]);
            // $("#AnCntx_IdSplitType").val(data["IdSplitType"]);
            $("#AnCntx_IdSplitType").val("1"); // limitazione ver.0
            // $("#AnCntx_SplitTypeNam").val(data["SplitTypeNam"]);
            $("#AnCntx_IdPrj").val(data["IdPrj"]);
            // $("#AnCntx_PrjNam").val(data["PrjNam"]);
            $("#AnCntx_Nam").val(data["Nam"]);
            $("#AnCntx_Descr").val(data["Descr"]);
            $("#AnCntx_fileRefTrainDat").val(data["fileRefTrainDat"]);
            $("#AnCntx_fileRefTestDat").val(data["fileRefTestDat"]);
            $("#AnCntx_Regr_Outcome").val(data["Regr_Outcome"]);
            $("#AnCntx_Regr_Vars").val(data["Regr_Vars"]);
            // $("#AnCntx_Regr_CtrlMethod").val(data["Regr_CtrlMethod"]);
            // $("#AnCntx_Regr_ModelMethods").val(data["Regr_ModelMethods"]);
            $("#AnCntx_Regr_CtrlMethod").val("repeatedcv"); // limitazione ver.0
            $("#AnCntx_Regr_ModelMethods").val("lm,svmRadial"); // limitazione ver.0

            da.AnCntxRead.btnControl();
        },

        Clean: function() {
            prjState=da.AnCntxRead.SetParamsFromPrjState();

            // prjState=da.PrjView.Get();
            $("#AnCntx_IdAnCntx").val((prjState["IdAnCntx"]? prjState["IdAnCntx"] : '<?php echo $_SESSION["ASV"]["IdAnCntx"]; ?>'));
            $("#AnCntx_IdAn").val((prjState["IdAn"]? prjState["IdAn"] : '<?php echo $_SESSION["PSV"]["IdAn"]; ?>'));
            $("#AnCntx_AnNam").val("");
            $("#AnCntx_IdCntx").val((prjState["IdCntx"]? prjState["IdCntx"] : '<?php echo $_SESSION["PSV"]["IdCntx"]; ?>'));
            $("#AnCntx_CntxNam").val("");
            $("#AnCntx_IdSplitType").val("1"); // limitazione ver.0
            // $("#AnCntx_SplitTypeNam").val("");
            $("#AnCntx_IdPrj").val('<?php echo $_SESSION["PSV"]["IdPrj"]; ?>');
            // $("#AnCntx_PrjNam").val(data["PrjNam"]);
            $("#AnCntx_Nam").val("");
            $("#AnCntx_Descr").val("");
            $("#AnCntx_fileRefTrainDat").val("");
            $("#AnCntx_fileRefTestDat").val("");
            $("#AnCntx_Regr_Outcome").val("y");
            $("#AnCntx_Regr_Vars").val("x");
            // $("#AnCntx_Regr_CtrlMethod").val("");
            // $("#AnCntx_Regr_ModelMethods").val("");
            $("#AnCntx_Regr_CtrlMethod").val("repeatedcv"); // limitazione ver.0
            $("#AnCntx_Regr_ModelMethods").val("lm,svmRadial"); // limitazione ver.0

            da.AnCntxRead.btnControl();
        },

        SetCntx: function(data) {
            $("#AnCntx_IdCntx").val(data["IdCntx"]);
            $("#AnCntx_CntxNam").val(data["CntxNam"]);

            da.AnCntxRead.btnControl();
        },

        CleanCntx: function() {
            $("#AnCntx_IdCntx").val('<?php echo $_SESSION["PSV"]["IdCntx"]; ?>');
            $("#AnCntx_CntxNam").val("");

            da.AnCntxRead.btnControl();
        },

        SetAn: function(data) {
            $("#AnCntx_IdAn").val(data["IdAn"]);
            $("#AnCntx_AnNam").val(data["AnNam"]);

            da.AnCntxRead.btnControl();
        },

        CleanAn: function() {
            $("#AnCntx_IdAn").val('<?php echo $_SESSION["PSV"]["IdAn"]; ?>');
            $("#AnCntx_AnNam").val("");

            da.AnCntxRead.btnControl();
        },

        Refresh: function() {
            try {
                // alert("IdAnCntx: "+ $("#AnCntx_IdAnCntx").val());
                if(da.AnCntxRead.IdAnCntx && da.AnCntxRead.IdAnCntx != ''){
                    // alert("IdPrj: "+ $("#AnCntx_IdPrj").val());
                    return $.ajax({
                        type: "GET",
                        url: "DA/HtmlComponents/AnCntx/Read.proxy.php?IdAnCntx=" + da.AnCntxRead.IdAnCntx,
                        dataType: "json",
                        error: function(result) {
                            da.UsrMsgShow(da.FailMsg, "Error");
                        },
                        success: function(result) {
                            // alert('?php echo $_SESSION["PSV"]["PrjDatFileNam"]; ?>')
                            data=result["Data"];
                            da.AnCntxRead.Set(data);
                        },
                    })
                }
            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }

        },

        Delete: function() {
            try {
                Id=$("#AnCntx_IdAnCntx").val();
                Nam=$("#AnCntx_Nam").val();
                if (confirm("Confirm Delete of (" + Id + " - "+ Nam +") ?")) {
                    return $.ajax({
                        type: "POST",
                        url: "DA/HtmlComponents/AnCntx/Delete.proxy.php",
                        dataType: "json",
                        data: {
                            IdAnCntx: Id
                        },
                        error: function(result) {
                            // alert("error: "+result["State"]);
                            da.UsrMsgShow(da.FailMsg, "Info");
                        },
                        success: function(result) {
                            // alert("success: "+result["State"]);
                            if(result["State"]){
                                da.AnCntxRead.Clean();
                                // da.UsrTlist.RefreshObj();
                                if(da.AnCntxRead.ParentObj){
                                    da.RefreshObj(da.AnCntxRead.ParentObj);
                                }
                                if(da.AnCntxRead.RefPanels && da.AnCntxRead.RefPanels!=""){
                                // alert(da.AlgCatTree.DetailPanels);
                                    da.RefreshDetailPanels(da.AnCntxRead.RefPanels, "CleanAnCntx");
                                }
                                da.UsrMsgShow(da.AnCntxRead.SuccessMsg, "Info");
                            }else{
                                da.UsrMsgShow(da.AnCntxRead.FailMsg, "Info");
                            }
                        }
                    })
                }
            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }
        },

        Save: function() {
            try {
                // alert("#AnCntxBtns #btnSave");
                if (da.verifyCompulsoryFields(da.AnCntxRead.CompulsoryFields, da.AnCntxRead.PanelTag)) {
                    return $.ajax({
                        type: "POST",
                        url: "DA/HtmlComponents/AnCntx/Save.proxy.php",
                        async: true,
                        dataType: "json",
                        data: da.AnCntxRead.Get(),
                        error: function(result) {
                            // alert(result);
                            da.UsrMsgShow(da.AnCntxRead.FailMsg, "Error");
                        },
                        success: function(result) {
                            if(result["State"]){
                                $("#AnCntx_IdAnCntx").val(da.AnCntxRead.IdAnCntx=result["IdAnCntx"]);
                                da.AnCntxRead.btnControl();
                                if(da.AnCntxRead.ParentObj){
                                    da.RefreshObj(da.AnCntxRead.ParentObj,da.AnCntxRead.ParentObjType, fun="Refresh",data=null);
                                }
                                if(da.AnCntxRead.RefPanels && da.AnCntxRead.RefPanels!=""){
                                    // alert(da.AlgCatTree.DetailPanels);
                                    da.RefreshDetailPanels(da.AnCntxRead.RefPanels, "SetAnCntx",da.AnCntxRead.Get());
                                }
                                da.UsrMsgShow(da.AnCntxRead.SuccessMsg, "Info");
                            }else{
                                da.UsrMsgShow(da.AnCntxRead.FailMsg, "Info");
                            }
                        }
                    })
                }
            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }
        },

        checkFieldsForAutoSave: function() {
            try {
                autoSave=false;
                // check Cntx_fileRefDat field
                splitTypeOld = $("#AnCntx_IdSplitType").val(); //'codice';
                // alert("splitTypeOld: "+splitTypeOld);
                splitTypeNew = '1'; //'costante in V.0';
                if(splitTypeOld !== splitTypeNew){
                    $("#AnCntx_IdSplitType").val(splitTypeNew);
                    autoSave=true;
                }

                // per V.1
                // OutcomeOld             = $("#AnCntx_Regr_Outcome").val(); //'DAX';
                // OutcomeNew             = $("#AnCntx_Regr_Outcome").val(); //'DAX';
                // Vars                = $("#AnCntx_Regr_Vars").val(); //'SMI,CAC,FTSE';
                // Vars                = $("#AnCntx_Regr_Vars").val(); //'SMI,CAC,FTSE';
                // CtrlMethod          = $("#AnCntx_Regr_CtrlMethod").val(); //'repeatedcv'
                // CtrlMethod          = $("#AnCntx_Regr_CtrlMethod").val(); //'repeatedcv'
                // ModelMethods        = $("#AnCntx_Regr_ModelMethods").val(); //'lm,svmRadial'
                // ModelMethods        = $("#AnCntx_Regr_ModelMethods").val(); //'lm,svmRadial'
                
                if(autoSave){
                    da.CntxRead.Save();
                }

            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }
        },

        BuildSplitParams: function() {
            try {
                // alert("BuildProcParams"); 
                prjState=da.AnCntxRead.SetParamsFromPrjState();
                da.AnCntxRead.checkFieldsForAutoSave();

                DecSep          = '<?php echo $_SESSION["DecDefaultSep"]; ?>';
                CsvSep          = '<?php echo $_SESSION["CSVDefaultSep"]; ?>';
                CsvHeader       = 'TRUE';
                fileRefDat      = da.AnCntxRead.PrjEvntRelPath + da.AnCntxRead.AnCntxFileRefDatNam;

                splitType       = $("#AnCntx_IdSplitType option:selected").attr('SplitType'); //'percentage';
                splitConditionVect = '1,'+ $("#AnCntx_IdSplitType option:selected").attr('Perc'); //'1,60'

                CSVDataFullPath = '<?php echo $_SESSION["BaseFolderDyn"]; ?>'+fileRefDat;
                CSVDataPath=da.dirname(CSVDataFullPath);
                CSVDataFilename=da.basename(CSVDataFullPath);

                ProcParams= "CSVDataPath="+CSVDataPath;
                ProcParams+="&CSVDataFilename="+CSVDataFilename;
                ProcParams+="&decSep="+DecSep;
                ProcParams+="&csvSep="+CsvSep;
                ProcParams+="&csvHeader="+CsvHeader;
                ProcParams+="&splitType="+splitType;
                ProcParams+="&splitConditionVect="+splitConditionVect;

                // alert(ProcParams);
                return ProcParams;
            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }
        },

        BuildRegrParams: function() {
            try {
                // alert("BuildProcParams"); 
                /**
                 * CSVTrainDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/
                 * &CSVTestDataPath=/xampp/htdocs/PHPTemplate/PHPTemplatesAndTests/scriptTests/output/split/
                 * &CSVTrainDataFilename=EuStockMarkets2_training.csv
                 * &CSVTestDataFilename=EuStockMarkets2_test.csv
                 * &decSep=,&csvSep=;&csvHeader=T
                 * &outcome=DAX
                 * &variables=SMI,CAC,FTSE
                 * &controlMethod=repeatedcv
                 * &modelMethods=lm,svmRadial */
                da.AnCntxRead.SetParamsFromPrjState();

                DecSep              = '<?php echo $_SESSION["DecDefaultSep"]; ?>';
                CsvSep              = '<?php echo $_SESSION["CSVDefaultSep"]; ?>';
                CsvHeader           = 'TRUE';
                // fileRefDat      = da.AnCntxRead.PrjEvntRelPath+da.AnCntxRead.AnCntxFileRefDatNam;
                PrjAnAbsPath        = da.AnCntxRead.PrjAnAbsPath;
                TrainFileRefDatNam  = da.AnCntxRead.TrainFileRefDatNam;
                TestFileRefDatNam   = da.AnCntxRead.TestFileRefDatNam;
                Outcome             = $("#AnCntx_Regr_Outcome").val(); //'DAX';
                Vars                = $("#AnCntx_Regr_Vars").val(); //'SMI,CAC,FTSE';
                CtrlMethod          = $("#AnCntx_Regr_CtrlMethod").val(); //'repeatedcv'
                ModelMethods        = $("#AnCntx_Regr_ModelMethods").val(); //'lm,svmRadial'

                // CSVTrainDataPath = PrjAnAbsPath;
                // CSVTrainDataPath = PrjAnAbsPath;
                // CSVTrainDataFilename = TrainFileRefDatNam;
                // CSVTestDataFilename = TestFileRefDatNam;
                // CSVDataPath=da.dirname(CSVDataFullPath);
                // CSVDataFilename=da.basename(CSVDataFullPath);

                ProcParams= "CSVTrainDataPath="+PrjAnAbsPath;
                ProcParams+="&CSVTestDataPath="+PrjAnAbsPath;
                ProcParams+="&CSVTrainDataFilename="+TrainFileRefDatNam;
                ProcParams+="&CSVTestDataFilename="+TestFileRefDatNam;
                ProcParams+="&decSep="+DecSep;
                ProcParams+="&csvSep="+CsvSep;
                ProcParams+="&csvHeader="+CsvHeader;
                ProcParams+="&outcome="+Outcome;
                ProcParams+="&variables="+Vars;
                ProcParams+="&controlMethod="+CtrlMethod;
                ProcParams+="&modelMethods="+ModelMethods;

                da.ContentShow(ProcParams, "Result")
                return ProcParams;
            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }
        },

        Compute: function(data) {
            try {
                // alert(da.AnomRead.BuildProcParams()); 
                da.ContentShow("<br><br>Executing ...<br><br><br>", "Elaboration")
                return $.ajax({
                    type: "POST",
                    url: "DA/PhpRComponents/PhpR.Proxy.php",
                    async: true,
                    dataType: "json",
                    data: data,
                    error: function(result) {
                        da.ContentShow(result.responseText, "Result")
                        if(da.AnCntxRead.ParentObj){
                            da.RefreshObj(da.AnCntxRead.ParentObj);
                        }
                        return true;
                    },
                    success: function(result) {
                        // $("#result").html("Informazione<br>"+result.responseText);
                        return false;
                    }
                })
            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }
        },

        ComputeSplit: function() {
            da.AnCntxRead.SetParamsFromPrjState();

            data= {
                ProcAbsPath     : '<?php echo $_SESSION["ProcAbsPath"]?>',
                ProcNam         : 'splitTrainTest.R',
                OutputAbsPath   : da.AnCntxRead.PrjAnAbsPath,
                ProcParams      : da.AnCntxRead.BuildSplitParams(),
            };
            // alert(OutputAbsPath);
            if(da.AnCntxRead.Compute(data)){
                $("#AnCntx_fileRefTrainDat").val(da.AnCntxRead.TrainFileRefDatNam);
                $("#AnCntx_fileRefTestDat").val(da.AnCntxRead.TestFileRefDatNam);
            }else{
                $("#AnCntx_fileRefTrainDat").val("");
                $("#AnCntx_fileRefTestDat").val("");
            }
            da.AnCntxRead.Save();
            da.AnCntxRead.btnControl();
        },

        ComputeRegression: function() {
            da.AnCntxRead.SetParamsFromPrjState();

            data= {
                ProcAbsPath     : '<?php echo $_SESSION["ProcAbsPath"]?>',
                ProcNam         : 'regressioneLineare.R',
                OutputAbsPath   : da.AnCntxRead.PrjAnAbsPath,
                ProcParams      : da.AnCntxRead.BuildRegrParams(),
            };

            da.AnCntxRead.Compute(data);
            da.AnCntxRead.Save();
            da.AnCntxRead.btnControl();

        },

        getSplitTypeSelect: function() {
            $.ajax({
                url: "DA/HtmlComponents/SplitType/Tlist.proxy.php",
                type: "POST",
                dataType: "json",
                async: true,
                data: "data",
                success: function(response) {
                    // alert("popola select records: "+response.data.length);
                    $("#AnCntx_IdSplitType").empty();
                    $("#AnCntx_IdSplitType").append(
                        $("<option></option>") // Yes you can do this.
                        .text("Select an Item ...")
                        .val("")
                    );
                    $.each(response.data, function(index, item) { // Iterates through a collection
                        $("#AnCntx_IdSplitType").append( // Append an object to the inside of the select box
                            $("<option></option>") // Yes you can do this.
                            .text(item.IdSplitType + " - " + item.Nam)
                            .val(item.IdSplitType)
                            .attr('SplitType','percentage')
                            .attr('Perc',item.Perc)
                        );
                    });
                    // $("#Prj_IdPrjState").val( php echo $this->IdPrjState; ?>);
                }
            });
        },
    }

    $(document).ready(function() {
        //popola select ...
        da.AnCntxRead.getSplitTypeSelect();

        da.AnCntxRead.Clean();

        if (da.AnCntxRead.Mode == "alone") {
            da.AnCntxRead.Refresh();
        }

        $("#AnCntxBtns #btnSave").click(function() {
            da.AnCntxRead.Save();
        });

        $("#AnCntxBtns #btnRefresh").click(function() {
            da.AnCntxRead.Refresh();
        });

        // elimina solo DB: FS persiste
        $("#AnCntxBtns #btnDelete").click(function() {
            da.AnCntxRead.Delete();
        });

        $("#AnCntxBtns #btnNew").click(function() {
            da.AnCntxRead.Clean();
        });

        $("#AnCntx_Nam").keyup(function(event) {
            da.AnCntxRead.btnControl();
        });
        $("#AnCntx_Descr").keyup(function(event) {
            da.AnCntxRead.btnControl();
        });

        $("#AnCntxBtns #btnComputeSplit").click(function() {
            da.AnCntxRead.ComputeSplit();
        });
        $("#AnCntxBtns #btnComputeRegression").click(function() {
            da.AnCntxRead.ComputeRegression();
        });
    })
</script>