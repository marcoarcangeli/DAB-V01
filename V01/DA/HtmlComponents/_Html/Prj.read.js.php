<script type="text/javascript" ref="da.PrjRead">
da.PrjRead = {

    whoIAm: 'Prj',
    PanelTag: this.whoIAm + '_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdPrj: '',
    PrjFolderName: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    ParentObjFun: '<?php echo $this->ParentObjFun; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.PrjRead.Mode == 'alone') {
            $("#PrjBtns #btnNew").hide();
        }

        if ($("#Prj_IdPrj").val() == "") {
            $("#PrjBtns #btnOpen").attr("disabled", true);
            $("#PrjBtns #btnRefresh").attr("disabled", true);
            $("#PrjBtns #btnDelete").attr("disabled", true);
        } else {
            $("#PrjBtns #btnOpen").attr("disabled", false);
            $("#PrjBtns #btnRefresh").attr("disabled", false);
            $("#PrjBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#Prj_Nam").val() == "" &&
            $("#Prj_Descr").val() == ""
        ) {
            $("#PrjBtns #btnSave").attr("disabled", true);
        } else {
            $("#PrjBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdPrj: $("#Prj_IdPrj").val(),
            Nam: $("#Prj_Nam").val(),
            Descr: $("#Prj_Descr").val(),
            // folderRef:   $("#Prj_folderRef").val(),
            IdUsr: $("#Prj_IdUsr").val(),
            IdPrjState: $("#Prj_IdPrjState").val(),
            // PrjStateNam:    $("#Prj_PrjStateNam").val(),
            IdEvnt: $("#Prj_IdEvnt").val(),
            FileNamRepoDat: $("#Prj_FileNamRepoDat").val(),
            IdClean: $("#Prj_IdClean").val(),
            IdCntx: $("#Prj_IdCntx").val(),
            IdAn: $("#Prj_IdAn").val(),
            AnNum: $("#Prj_AnNum").val(),
            // IdAnCntx: $("#Prj_IdAnCntx").val(),
            // IdTrain: $("#Prj_IdTrain").val(),
            // IdTest: $("#Prj_IdTest").val(),
            // IdRev: $("#Prj_IdRev").val(),
            IdRnk: $("#Prj_IdRnk").val(),
            IdPrjStateCalc: $("#Prj_IdPrjStateCalc").val(),
            PrjFolderNam: $("#Prj_PrjFolderNam").val(),
            EvntFolderNam: $("#Prj_EvntFolderNam").val(),
            CntxFolderNam: $("#Prj_CntxFolderNam").val(),
            AnFolderNam: $("#Prj_AnFolderNam").val(),
            // TrainFolderNam: $("#Prj_TrainFolderNam").val(),
            // TestFolderNam: $("#Prj_TestFolderNam").val(),
            // RevFolderNam: $("#Prj_RevFolderNam").val()
            RevFolderNam: $("#Prj_RnkFolderNam").val()
        };
        return data;
    },

    Set: function(data) {
        $("#Prj_IdPrj").val(data["IdPrj"]);
        $("#Prj_Nam").val(data["Nam"]);
        $("#Prj_Descr").val(data["Descr"]);
        // $("#Prj_folderRef").val(data["folderRef"]);
        $("#Prj_IdUsr").val(data["IdUsr"]);
        $("#Prj_IdPrjState").val(data["IdPrjStateCalc"]); // for autosave
        // $("#Prj_PrjStateNam").val(data["PrjStateNam"]);
        $("#Prj_IdEvnt").val(data["IdEvnt"]);
        $("#Prj_FileNamRepoDat").val(data["FileNamRepoDat"]);
        $("#Prj_IdClean").val(data["IdClean"]);
        $("#Prj_IdCntx").val(data["IdCntx"]);
        $("#Prj_IdAn").val(data["IdAn"]);
        $("#Prj_AnNum").val(data["AnNum"]),
        // $("#Prj_IdAnCntx").val(data["IdAnCntx"]);
        // $("#Prj_IdTrain").val(data["IdTrain"]);
        // $("#Prj_IdTest").val(data["IdTest"]);
        // $("#Prj_IdRev").val(data["IdRev"]);
        $("#Prj_IdRnk").val(data["IdRnk"]);
        $("#Prj_IdPrjStateCalc").val(data["IdPrjStateCalc"]);
        $("#Prj_PrjFolderNam").val(data["PrjFolderNam"]);
        $("#Prj_EvntFolderNam").val(data["EvntFolderNam"]);
        $("#Prj_CntxFolderNam").val(data["CntxFolderNam"]);
        $("#Prj_AnFolderNam").val(data["AnFolderNam"]);
        // $("#Prj_TrainFolderNam").val(data["TrainFolderNam"]);
        // $("#Prj_TestFolderNam").val(data["TestFolderNam"]);
        // $("#Prj_RevFolderNam").val(data["RevFolderNam"]);
        $("#Prj_RnkFolderNam").val(data["RnkFolderNam"]);

        da.PrjRead.btnControl();
    },

    Clean: function() {
        $("#Prj_IdPrj").val("");
        $("#Prj_Nam").val("");
        $("#Prj_Descr").val("");
        // $("#Prj_folderRef").val("");
        $("#Prj_IdUsr").val(<?php echo $this->IdUsr; ?>);
        $("#Prj_IdPrjState").val("1");
        // $("#Prj_PrjStateNam").val("New");
        $("#Prj_IdEvnt").val("");
        $("#Prj_FileNamRepoDat").val("");
        $("#Prj_IdClean").val("");
        $("#Prj_IdCntx").val("");
        $("#Prj_IdAn").val("");
        $("#Prj_AnNum").val(''),
        // $("#Prj_IdAnCntx").val("");
        // $("#Prj_IdTrain").val("");
        // $("#Prj_IdTest").val("");
        // $("#Prj_IdRev").val("");
        $("#Prj_IdRnk").val("");
        $("#Prj_IdPrjStateCalc").val("");
        $("#Prj_PrjFolderNam").val("");
        $("#Prj_EvntFolderNam").val("");
        $("#Prj_CntxFolderNam").val("");
        $("#Prj_AnFolderNam").val("");
        // $("#Prj_TrainFolderNam").val("");
        // $("#Prj_TestFolderNam").val("");
        // $("#Prj_RevFolderNam").val("");
        $("#Prj_RnkFolderNam").val("");

        da.PrjRead.btnControl();

        if (da.PrjRead.ParentObj) {
            // alert(da.PrjRead.ParentObj);
            da.RefreshObj(da.PrjRead.ParentObj, da.PrjRead.ParentObjType, da.PrjRead.ParentObjFun);
        }

    },

    Refresh: function() {
        try {
            // alert("IdPrj: "+ da.PrjRead.IdPrj);
            if (da.PrjRead.IdPrj && da.PrjRead.IdPrj != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/Prj/Read.proxy.php?IdPrj=" + da.PrjRead.IdPrj,
                    dataType: "json",
                    error: function(result) {
                        // alert(result);
                        da.UsrMsgShow(da.PrjRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result);
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data = result["Data"];
                        da.PrjRead.Set(data);
                        // autosave stato
                        if (data["IdPrjState"] != data["IdPrjStateCalc"]) {
                            da.UsrMsgShow("Update Project State ...", "Info");
                            da.PrjRead.Save();
                        }
                        // carica stato analisi
                        
                    },
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    Delete: function() {
        try {
            Id = $("#Prj_IdPrj").val();
            Nam = $("#Prj_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Prj/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdPrj: Id
                    },
                    error: function(result) {
                        da.UsrMsgShow(da.PrjRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.PrjRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.PrjRead.ParentObj) {
                                da.RefreshObj(da.PrjRead.ParentObj);
                            }
                            if (da.PrjRead.RefPanels && da.PrjRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.PrjRead.RefPanels, "CleanPrj");
                            }
                            da.UsrMsgShow(da.PrjRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.PrjRead.FailMsg, "Info");
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
            // alert("#PrjBtns #btnSave");
            if (da.verifyCompulsoryFields(da.PrjRead.CompulsoryFields, da.PrjRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Prj/Save.proxy.php",
                    async: true,
                    dataType: "json",
                    data: da.PrjRead.Get(),
                    error: function(result) {
                        // alert(result);
                        da.UsrMsgShow(da.PrjRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result);
                        if (result["State"]) {
                            $("#Prj_IdPrj").val(da.PrjRead.IdPrj = result["IdPrj"]);
                            if (da.PrjRead.ParentObj) {
                                da.RefreshObj(da.PrjRead.ParentObj, da.PrjRead.ParentObjType, da.PrjRead.ParentObjFun);
                            }
                            if (da.PrjRead.RefPanels && da.PrjRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.PrjRead.RefPanels, "SetPrj", da.PrjRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.PrjRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.PrjRead.FailMsg, "Info");
                        }
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    Open: function() {
        try {
            da.navigation.PrjCompleteBoard();
        } catch (e) {
            da.UsrMsgShow(da.PrjRead.FailMsg, "Error");
        }
    },

    getPrjStateselect: function() {
        $.ajax({
            url: "DA/HtmlComponents/PrjState/Tlist.proxy.php",
            type: "POST",
            dataType: "json",
            async: true,
            data: "data",
            success: function(response) {
                // alert("popola select records: "+response.data.length);
                $("#Prj_IdPrjState").empty();
                $("#Prj_IdPrjState").append(
                    $("<option></option>") // Yes you can do this.
                    .text("Select an Item ...")
                    .val("")
                );
                $.each(response.data, function(index, item) { // Iterates through a collection
                    $("#Prj_IdPrjState")
                        .append( // Append an object to the inside of the select box
                            $("<option></option>") // Yes you can do this.
                            .text(item.IdPrjState + " - " + item.Nam)
                            .val(item.IdPrjState)
                        );
                });
                // $("#Prj_IdPrjState").val( php echo $this->IdPrjState; ?>);
            }
        });
    },

}

$(document).ready(function() {
    // alert(da.PrjRead.Mode);
    // var PrjReadFields = array("IdPrj", "IdUsr", "Nam", "Descr", "folderRef", "IdPrjState");

    // contentParams
    // da.PrjRead.contentParams();

    //popola select IdPrjState
    da.PrjRead.getPrjStateselect();

    /**************
     * TODO da trasferire al php proxy
     */
    $("#PrjBtns #btnSave").click(function() {
        da.PrjRead.Save();
    });

    $("#PrjBtns #btnRefresh").click(function() {
        da.PrjRead.Refresh();
    });

    // Deletezione Prj
    // elimina solo DB: FS persiste
    $("#PrjBtns #btnDelete").click(function() {
        da.PrjRead.Delete();
    });

    $("#PrjBtns #btnNew").click(function() {
        //alert("PrjBtns #btnNew")
        da.PrjRead.Clean();
    });

    $("#PrjBtns #btnOpen").click(function() {
        //alert("PrjBtns #btnOpen")
        da.PrjRead.Open()
    });

    $("#Prj_Nam").keyup(function(event) {
        da.PrjRead.btnControl();
    });

    $("#Prj_Descr").keyup(function(event) {
        da.PrjRead.btnControl();
    });


})
</script>