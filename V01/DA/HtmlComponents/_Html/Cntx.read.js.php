<script type="text/javascript" ref="da.CntxRead">
da.CntxRead = {

    whoIAm: 'Cntx',
    PanelTag: this.whoIAm + '_',
    IdCntx: '<?php echo $_SESSION["PSV"]["IdCntx"]; ?>',
    IdEvnt: '<?php echo $_SESSION["PSV"]["IdEvnt"]; ?>',
    PrjDat_EvntRelPath: '',
    CntxFileRefDatNam: '',
    PrjCntxAbsPath: '',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    StructPanelFlag: "<?php echo $this->StructPanelFlag; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.CntxRead.Mode == 'alone') {
            $("#CntxBtns #btnNew").hide();
        }

        if ($("#Cntx_IdCntx").val() == "") {
            $("#CntxBtns #btnRefresh").attr("disabled", true);
            $("#CntxBtns #btnDelete").attr("disabled", true);
        } else {
            $("#CntxBtns #btnRefresh").attr("disabled", false);
            $("#CntxBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#Cntx_Nam").val() == "" &&
            $("#Cntx_Descr").val() == ""
        ) {
            $("#CntxBtns #btnSave").attr("disabled", true);
        } else {
            $("#CntxBtns #btnSave").attr("disabled", false);
        }

        if (
            $("#Cntx_fileRefDat").val() == "" ||
            $("#Cntx_IdCntx").val() == ""
        ) {
            $("#CntxBtns #btnComputeStruct").attr("disabled", true);
            $("#CntxBtns #btnComputeStVars").attr("disabled", true);
        } else {
            $("#CntxBtns #btnComputeStruct").attr("disabled", false);
            $("#CntxBtns #btnComputeStVars").attr("disabled", false);
        }

    },

    SetParamsFromPrjState: function() {
        prjState = da.CntxRead.Get();
        da.CntxRead.IdCntx = (prjState["IdCntx"] ? prjState["IdCntx"] :
            '<?php echo $_SESSION["PSV"]["IdCntx"]; ?>');
        da.CntxRead.IdEvnt = (prjState["IdEvnt"] ? prjState["IdEvnt"] :
            '<?php echo $_SESSION["PSV"]["IdEvnt"]; ?>');

        da.CntxRead.PrjDat_EvntRelPath =
            '<?php echo $_SESSION["PrjRelPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
            (prjState["EvntFolderNam"] ? prjState["EvntFolderNam"] :
                '<?php echo $_SESSION["PSV"]["EvntFolderNam"]; ?>') + '/';
        da.CntxRead.PrjCntxAbsPath =
            '<?php echo $_SESSION["PrjAbsPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
            (prjState["CntxFolderNam"] ? prjState["CntxFolderNam"] :
                '<?php echo $_SESSION["PSV"]["CntxFolderNam"]; ?>') + '/';
        da.CntxRead.CntxFileRefDatNam = (prjState["FileNamRepoDat"] ? prjState["FileNamRepoDat"] :
                '<?php echo $_SESSION["PSV"]["FileNamRepoDat"]; ?>') +
            '<?php echo $_SESSION["AutoCleanDatFile"].$_SESSION["DatCSVFile"]; ?>';
        return prjState;
    },

    Get: function() {
        data = {
            IdCntx: $("#Cntx_IdCntx").val(),
            IdEvnt: $("#Cntx_IdEvnt").val(),
            // EvntNam:        $("#Cntx_EvntNam").val(),
            IdPrj: $("#Cntx_IdPrj").val(),
            // PrjNam:         $("#Cntx_PrjNam").val(),
            Nam: $("#Cntx_Nam").val(),
            Descr: $("#Cntx_Descr").val(),
            fileRefDat: $("#Cntx_fileRefDat").val(),
            ctsd: $("#Cntx_ctsd").val(),
            cnsd: $("#Cntx_cnsd").val(),
            cusd: $("#Cntx_cusd").val()
            // fileRefCntxDat: $("#Cntx_fileRefCntxDat").val()
        };
        return data;
    },

    Set: function(data) {
        $("#Cntx_IdCntx").val(data["IdCntx"]);
        $("#Cntx_IdEvnt").val(data["IdEvnt"]);
        $("#Cntx_EvntNam").val(data["EvntNam"]);
        $("#Cntx_IdPrj").val(data["IdPrj"]);
        $("#Cntx_PrjNam").val(data["PrjNam"]);
        $("#Cntx_Nam").val(data["Nam"]);
        $("#Cntx_Descr").val(data["Descr"]);
        $("#Cntx_fileRefDat").val(data["fileRefDat"]);
        // $("#Cntx_fileRefCntxDat").val(data["fileRefCntxDat"]);
        $("#Cntx_ctsd").val(data["ctsd"]);
        $("#Cntx_cnsd").val(data["cnsd"]);
        $("#Cntx_cusd").val(data["cusd"]);


        da.CntxRead.btnControl();
    },

    Clean: function() {
        prjState = da.CntxRead.SetParamsFromPrjState();

        $("#Cntx_IdCntx").val(da.CntxRead.IdCntx);
        $("#Cntx_IdEvnt").val(da.CntxRead.IdEvnt);

        $("#Cntx_IdPrj").val('<?php echo $_SESSION["PSV"]["IdPrj"]; ?>');
        $("#Cntx_Nam").val("");
        $("#Cntx_Descr").val("");
        if (da.CntxRead.StructPanelFlag) {
            $("#Cntx_ctsd").val(da.CntxStruct.NewNam);
            $("#Cntx_cnsd").val(da.CntxStruct.NewType);
            $("#Cntx_cusd").val(da.CntxStruct.NewUnit);
        } else {
            $("#Cntx_ctsd").val("");
            $("#Cntx_cnsd").val("");
            $("#Cntx_cusd").val("");
        }

        $("#Cntx_fileRefDat").val(da.CntxRead.PrjDat_EvntRelPath + da.CntxRead.CntxFileRefDatNam);
        // alert($("#Cntx_fileRefDat").val());
        da.CntxRead.btnControl();
    },

    SetEvnt: function(data) {
        $("#Cntx_IdEvnt").val(data["IdEvnt"]);
        $("#Cntx_EvntNam").val(data["EvntNam"]);

        da.CntxRead.btnControl();
    },

    CleanEvnt: function() {
        $("#Cntx_IdEvnt").val('<?php echo $_SESSION["PSV"]["IdEvnt"]; ?>');
        $("#Cntx_EvntNam").val("");

        da.CntxRead.btnControl();
    },

    Refresh: function() {
        try {
            // alert("IdCntx: "+ $("#Cntx_IdCntx").val());
            if (da.CntxRead.IdCntx && da.CntxRead.IdCntx != '') {
                // alert("IdPrj: "+ $("#Cntx_IdPrj").val());
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/Cntx/Read.proxy.php?IdCntx=" + da.CntxRead.IdCntx,
                    dataType: "json",
                    error: function(result) {
                        da.UsrMsgShow(da.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert('?php echo $_SESSION["PSV"]["PrjDatFileNam"]; ?>')
                        data = result["Data"];
                        da.CntxRead.Set(data);
                    },
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#Cntx_IdCntx").val();
            Nam = $("#Cntx_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Cntx/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdCntx: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.CntxRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.CntxRead.ParentObj) {
                                da.RefreshObj(da.CntxRead.ParentObj);
                            }
                            if (da.CntxRead.RefPanels && da.CntxRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.CntxRead.RefPanels, "CleanCntx");
                            }
                            da.UsrMsgShow(da.CntxRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.CntxRead.FailMsg, "Info");
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
            // alert("#CntxBtns #btnSave");
            if (da.verifyCompulsoryFields(da.CntxRead.CompulsoryFields, da.CntxRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Cntx/Save.proxy.php",
                    async: true,
                    dataType: "json",
                    data: da.CntxRead.Get(),
                    error: function(result) {
                        // alert(result);
                        da.UsrMsgShow(da.CntxRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#Cntx_IdCntx").val(da.CntxRead.IdCntx = result["IdCntx"])
                            da.CntxRead.btnControl();
                            if (da.CntxRead.ParentObj) {
                                da.RefreshObj(da.CntxRead.ParentObj, da.CntxRead.ParentObjType,
                                    fun = "Refresh", data = null);
                            }
                            if (da.CntxRead.RefPanels && da.CntxRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.CntxRead.RefPanels, "SetCntx", da.CntxRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.CntxRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.CntxRead.FailMsg, "Info");
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
            autoSave = false;
            // check Cntx_fileRefDat field
            fileRefDatOld = $("#Cntx_fileRefDat").val();
            fileRefDatNew = da.CntxRead.PrjDat_EvntRelPath + da.CntxRead.CntxFileRefDatNam;
            if (fileRefDatOld !== fileRefDatNew) {
                $("#Cntx_fileRefDat").val(fileRefDatNew);
                autoSave = true;
            }

            if (autoSave) {
                da.CntxRead.Save();
            }

        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    BuildStructParams: function() {
        try {
            prjState = da.CntxRead.SetParamsFromPrjState();
            da.CntxRead.checkFieldsForAutoSave();
            // alert("BuildProcParams"); 
            DecSep = '<?php echo $_SESSION["DecDefaultSep"]; ?>';
            CsvSep = '<?php echo $_SESSION["CSVDefaultSep"]; ?>';
            CsvHeader = 'TRUE';

            fileRefDat = $("#Cntx_fileRefDat").val();

            CSVDataFullPath = '<?php echo $_SESSION["BaseFolderDyn"]; ?>' + fileRefDat;
            CSVDataPath = da.dirname(CSVDataFullPath);
            CSVDataFilename = da.basename(CSVDataFullPath);

            ProcParams = "CSVDataPath=" + CSVDataPath;
            ProcParams += "&CSVDataFilename=" + CSVDataFilename;
            ProcParams += "&decSep=" + DecSep;
            ProcParams += "&csvSep=" + CsvSep;
            ProcParams += "&csvHeader=" + CsvHeader;
            // alert(ProcParams);
            return ProcParams;
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    BuildStVarParams: function() {
        try {
            prjState = da.CntxRead.SetParamsFromPrjState();
            da.CntxRead.checkFieldsForAutoSave();

            // alert("BuildProcParams"); 
            DecSep = '<?php echo $_SESSION["DecDefaultSep"]; ?>';
            CsvSep = '<?php echo $_SESSION["CSVDefaultSep"]; ?>';
            CsvHeader = 'TRUE';
            if (da.CntxRead.StructPanelFlag) {
                if ($("#Cntx_ctsd").val() != '') {
                    Cnsd = $("#Cntx_ctsd").val();
                    Ctsd = $("#Cntx_cnsd").val();
                    Cusd = $("#Cntx_cusd").val();
                } else {
                    da.CntxStruct.getFilterCol();
                    Cnsd = da.CntxStruct.NewNam;
                    Ctsd = da.CntxStruct.NewType;
                    Cusd = da.CntxStruct.NewUnit;
                    $("#Cntx_ctsd").val(Cnsd);
                    $("#Cntx_cnsd").val(Ctsd);
                    $("#Cntx_cusd").val(Cusd);
                }
            } else {
                Ctsd = "";
                Cnsd = "";
                Cusd = "";
            }
            // future implementation: aggiorna parametri di compute
            // da.CntxRead.Save();

            fileRefDat = $("#Cntx_fileRefDat").val();

            CSVDataFullPath = '<?php echo $_SESSION["BaseFolderDyn"]; ?>' + fileRefDat;
            CSVDataPath = da.dirname(CSVDataFullPath);
            CSVDataFilename = da.basename(CSVDataFullPath);

            ProcParams = "CSVDataPath=" + CSVDataPath;
            ProcParams += "&CSVDataFilename=" + CSVDataFilename;
            ProcParams += "&decSep=" + DecSep;
            ProcParams += "&csvSep=" + CsvSep;
            ProcParams += "&csvHeader=" + CsvHeader;
            ProcParams += "&ctsd=" + Ctsd;
            ProcParams += "&cnsd=" + Cnsd;
            // ProcParams+="&cusd="+Cusd;

            // alert(ProcParams);
            return ProcParams;
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    Compute: function(data) {
        try {
            // alert(da.AnomRead.BuildProcParams()); 

            da.ContentShow("<br><br>Executing ...<br><br><br>", "Elaboration");
            return $.ajax({
                type: "POST",
                url: "DA/PhpRComponents/PhpR.Proxy.php",
                async: true,
                dataType: "json",
                data: data,
                error: function(result) {
                    da.ContentShow(result.responseText, "Result")
                    if (da.CntxRead.ParentObj) {
                        da.RefreshObj(da.CntxRead.ParentObj);
                    }
                },
                success: function(result) {
                    // $("#result").html("Informazione<br>"+result.responseText);
                }
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    ComputeStruct: function() {
        prjState = da.CntxRead.SetParamsFromPrjState();
        data = {
            ProcAbsPath: '<?php echo $_SESSION["ProcAbsPath"]?>',
            ProcNam: 'analisiStruttura.R',
            OutputAbsPath: da.CntxRead.PrjCntxAbsPath,
            ProcParams: da.CntxRead.BuildStructParams(),
        };
        // alert(da.CntxRead.PrjCntxAbsPath);

        da.CntxRead.Compute(data);
    },

    ComputeStVars: function() {
        prjState = da.CntxRead.SetParamsFromPrjState();
        data = {
            ProcAbsPath: '<?php echo $_SESSION["ProcAbsPath"]?>',
            ProcNam: 'analisiSingolaVariabile.R',
            OutputAbsPath: da.CntxRead.PrjCntxAbsPath,
            ProcParams: da.CntxRead.BuildStVarParams(),
        };
        // alert(da.CntxRead.PrjCntxAbsPath);
        da.CntxRead.Compute(data);
    },
}

$(document).ready(function() {
    da.CntxRead.Clean();
    // Cntx(IdCntx, IdPrj, Nam, Descr, fileRefDat, fileRefCntxDat)
    //popola select ...
    // $.ajax({ ...

    if (da.CntxRead.Mode == "alone") {
        da.CntxRead.Refresh();
    }

    $("#CntxBtns #btnSave").click(function() {
        da.CntxRead.Save();
    });

    $("#CntxBtns #btnRefresh").click(function() {
        da.CntxRead.Refresh();
    });

    // elimina solo DB: FS persiste
    $("#CntxBtns #btnDelete").click(function() {
        da.CntxRead.Delete();
    });

    $("#CntxBtns #btnNew").click(function() {
        da.CntxRead.Clean();
    });

    $("#Cntx_Nam").keyup(function(event) {
        da.CntxRead.btnControl();
    });
    $("#Cntx_Descr").keyup(function(event) {
        da.CntxRead.btnControl();
    });

    $("#CntxBtns #btnComputeStruct").click(function() {
        da.CntxRead.ComputeStruct();
    });
    $("#CntxBtns #btnComputeStVars").click(function() {
        da.CntxRead.ComputeStVars();
    });
})
</script>