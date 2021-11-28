<script type="text/javascript" ref="da.EvntRead">
da.EvntRead = {

    whoIAm: 'Evnt',
    PanelTag: this.whoIAm + '_',
    IdEvnt: '<?php echo $_SESSION["PSV"]["IdEvnt"]; ?>',
    PrjEvntAbsPath: '',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.EvntRead.Mode == 'alone') {
            $("#EvntBtns #btnNew").hide();
        }

        if ($("#Evnt_IdEvnt").val() == "") {
            $("#EvntBtns #btnRefresh").attr("disabled", true);
            $("#EvntBtns #btnDelete").attr("disabled", true);
        } else {
            $("#EvntBtns #btnRefresh").attr("disabled", false);
            $("#EvntBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#Evnt_Nam").val() == "" &&
            $("#Evnt_Descr").val() == ""
        ) {
            $("#EvntBtns #btnSave").attr("disabled", true);
        } else {
            $("#EvntBtns #btnSave").attr("disabled", false);
        }

        if (
            $("#Evnt_fileRefRepoDat").val() == "" ||
            $("#Evnt_IdEvnt").val() == ""
        ) {
            $("#EvntBtns #btnComputeStruct").attr("disabled", true);
        } else {
            $("#EvntBtns #btnComputeStruct").attr("disabled", false);
        }
    },

    SetParamsFromPrjState: function() {
        prjState = da.PrjView.Get();
        da.EvntRead.IdEvnt = (prjState["IdEvnt"] ? prjState["IdEvnt"] :
            '<?php echo $_SESSION["PSV"]["IdEvnt"]; ?>');

        da.EvntRead.PrjEvntAbsPath =
            '<?php echo $_SESSION["PrjAbsPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
            (prjState["EvntFolderNam"] ? prjState["EvntFolderNam"] :
                '<?php echo $_SESSION["PSV"]["EvntFolderNam"]; ?>') + '/';
        return prjState;
    },

    Get: function() {
        data = {
            IdEvnt: $("#Evnt_IdEvnt").val(),
            IdEvntCat: $("#Evnt_IdEvntCat").val(),
            EvntCatNam: $("#Evnt_EvntCatNam").val(),
            IdPrj: $("#Evnt_IdPrj").val(),
            Nam: $("#Evnt_Nam").val(),
            Descr: $("#Evnt_Descr").val(),
            fileRefRepoDat: $("#Evnt_fileRefRepoDat").val(),
            CatTag: $("#Evnt_CatTag").val()
            // fileRefEvntDat: $("#Evnt_fileRefEvntDat").val()
        };
        return data;
    },
    /** {"IdEvnt":"8","IdPrj":"23","IdEvntCat":null,"Nam":"eee","Descr":null,"fileRefRepoDat":"DA\/_FsBase\/Dat\/Evnt\/anscombe.csv_da","fileRefEvntDat":null}
     * 
     */
    Set: function(data) {
        $("#Evnt_IdEvnt").val(data["IdEvnt"]);
        $("#Evnt_IdEvntCat").val(data["IdEvntCat"]);
        $("#Evnt_EvntCatNam").val(data["EvntCatNam"]);
        $("#Evnt_IdPrj").val(data["IdPrj"]);
        $("#Evnt_Nam").val(data["Nam"]);
        $("#Evnt_Descr").val(data["Descr"]);
        $("#Evnt_fileRefRepoDat").val(data["fileRefRepoDat"]);
        $("#Evnt_CatTag").val(data["CatTag"]);
        // $("#Evnt_fileRefEvntDat").val(data["fileRefEvntDat"]);

        da.EvntRead.btnControl();
    },

    Clean: function() {
        prjState = da.EvntRead.SetParamsFromPrjState();

        $("#Evnt_IdEvnt").val(da.EvntRead.IdEvnt);
        $("#Evnt_IdEvntCat").val("");
        $("#Evnt_EvntCatNam").val("");
        $("#Evnt_IdPrj").val('<?php echo $_SESSION["PSV"]["IdPrj"]; ?>');
        $("#Evnt_Nam").val("");
        $("#Evnt_Descr").val("");
        $("#Evnt_fileRefRepoDat").val("");
        $("#Evnt_CatTag").val("");
        // $("#Evnt_fileRefEvntDat").val("");
        $("#Evnt_IdUsr").val('<?php echo $_SESSION["PSV"]["IdUsr"]; ?>');

        da.EvntRead.btnControl();
    },

    SetEvntCat: function(data) {
        $("#Evnt_IdEvntCat").val(data["IdEvntCat"]);
        $("#Evnt_EvntCatNam").val(data["EvntCatNam"]);

        da.EvntRead.btnControl();
    },

    CleanEvntCat: function() {
        $("#Evnt_IdEvntCat").val('');
        $("#Evnt_EvntCatNam").val('');

        da.EvntRead.btnControl();
    },

    SetFileRef: function(data) {
        $("#Evnt_fileRefRepoDat").val(data["FileRef"]);

        da.EvntRead.btnControl();
    },

    CleanFileRef: function() {
        $("#Evnt_fileRefRepoDat").val('');

        da.EvntRead.btnControl();
    },

    Refresh: function() {
        try {
            // alert("IdEvnt: "+ $("#Evnt_IdEvnt").val());
            if (da.EvntRead.IdEvnt && da.EvntRead.IdEvnt != '') {
                // alert("IdPrj: "+ $("#Evnt_IdPrj").val());
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/Evnt/Read.proxy.php?IdEvnt=" + da.EvntRead.IdEvnt,
                    dataType: "json",
                    error: function(result) {
                        // alert(result.resultMessage);
                        da.UsrMsgShow(da.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert('?php echo $_SESSION["PSV"]["PrjDatFileNam"]; ?>')
                        data = result["Data"];
                        da.EvntRead.Set(data);
                    },
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    Delete: function() {
        try {
            Id = $("#Evnt_IdEvnt").val();
            Nam = $("#Evnt_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Evnt/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdEvnt: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.EvntRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.EvntRead.ParentObj) {
                                da.RefreshObj(da.EvntRead.ParentObj);
                            }
                            if (da.EvntRead.RefPanels && da.EvntRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.EvntRead.RefPanels, "CleanEvnt");
                            }
                            da.UsrMsgShow(da.EvntRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.EvntRead.FailMsg, "Info");
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
            // alert("#EvntBtns #btnSave");
            if (da.verifyCompulsoryFields(da.EvntRead.CompulsoryFields, da.EvntRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Evnt/Save.proxy.php",
                    async: true,
                    dataType: "json",
                    data: da.EvntRead.Get(),
                    error: function(result) {
                        // alert(result);
                        da.UsrMsgShow(da.EvntRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#Evnt_IdEvnt").val(da.EvntRead.IdEvnt = result["IdEvnt"]);
                            da.EvntRead.btnControl();
                            // alert(da.EvntRead.ParentObj);
                            if (da.EvntRead.ParentObj) {
                                da.RefreshObj(da.EvntRead.ParentObj, da.EvntRead.ParentObjType,
                                    fun = "Refresh", data = null);
                            }
                            if (da.EvntRead.RefPanels && da.EvntRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.EvntRead.RefPanels, "SetEvnt", da.EvntRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.EvntRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.EvntRead.FailMsg, "Info");
                        }
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    BuildProcParams: function() {
        try {
            // alert("BuildProcParams"); 
            DecSep = $("#Evnt_DecSep").val();
            CsvSep = $("#Evnt_CsvSep").val();
            CsvHeader = ($("#Evnt_CsvHeader").is(":checked") ? 'TRUE' : 'FALSE');
            FileRefRepoDat = $("#Evnt_fileRefRepoDat").val();

            CSVDataFullPath = '<?php echo $_SESSION["BaseFolderDyn"]; ?>' + FileRefRepoDat;
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

    ComputeStruct: function() {
        try {
            prjState = da.EvntRead.SetParamsFromPrjState();

            // alert(da.EvntRead.BuildProcParams()); 
            // $("#result").html("In esecuzione ...<br>");
            da.ContentShow("<br><br>Executing ...<br><br><br>", "Elaboration");
            prjState = da.PrjView.Get();
            return $.ajax({
                type: "POST",
                url: "DA/PhpRComponents/PhpR.Proxy.php",
                async: true,
                dataType: "json",
                data: {
                    ProcAbsPath: '<?php echo $_SESSION["ProcAbsPath"]?>',
                    ProcNam: 'analisiStruttura.R',
                    OutputAbsPath: da.EvntRead.PrjEvntAbsPath,
                    ProcParams: da.EvntRead.BuildProcParams(),
                },
                error: function(result) {
                    // $("#result").html("Info: <br>"+result.responseText);
                    // alert(result.responseText, "Error");
                    da.ContentShow(result.responseText, "Result");
                    if (da.EvntRead.ParentObj) {
                        da.RefreshObj(da.EvntRead.ParentObj);
                    }
                    // alert("Errore<br>"+result.responseText, "Errore");
                    return false;
                },
                success: function(result) {
                    // $("#result").html("Informazione<br>"+result.responseText);
                    da.UsrMsgShow(result.responseText, "Info");
                    if (result["State"] == true) {
                        return true;
                    } else {
                        return false;
                    }
                }
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },
}

$(document).ready(function() {
    //popola select ...
    //  ...
    // set defaults
    da.EvntRead.Clean();

    if (da.EvntRead.Mode == "alone") {
        da.EvntRead.Refresh();
    }

    $("#EvntBtns #btnSave").click(function() {
        da.EvntRead.Save();
    });

    $("#EvntBtns #btnRefresh").click(function() {
        da.EvntRead.Refresh();
    });

    // elimina solo DB: FS persiste
    $("#EvntBtns #btnDelete").click(function() {
        da.EvntRead.Delete();
    });

    $("#EvntBtns #btnNew").click(function() {
        da.EvntRead.Clean();
    });

    $("#Evnt_Nam").keyup(function(event) {
        da.EvntRead.btnControl();
    });
    $("#Evnt_Descr").keyup(function(event) {
        da.EvntRead.btnControl();
    });

    $("#EvntBtns #btnComputeStruct").click(function() {
        da.EvntRead.ComputeStruct();
    });
})
</script>