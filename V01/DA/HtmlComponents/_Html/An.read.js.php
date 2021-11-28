<script type="text/javascript" ref="da.AnRead">
da.AnRead = {

    whoIAm: 'An',
    PanelTag: this.whoIAm + '_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdAn: '<?php echo $_SESSION["PSV"]["IdAn"]; ?>',
    AnFolderName: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    ParentObjFun: '<?php echo $this->ParentObjFun; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.AnRead.Mode == 'alone') {
            $("#AnBtns #btnNew").hide();
        }

        if ($("#An_IdAn").val() == "") {
            // $("#AnBtns #btnOpen").attr("disabled", true);
            $("#AnBtns #btnRefresh").attr("disabled", true);
            $("#AnBtns #btnDelete").attr("disabled", true);
        } else {
            // $("#AnBtns #btnOpen").attr("disabled", false);
            $("#AnBtns #btnRefresh").attr("disabled", false);
            $("#AnBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#An_Nam").val() == "" &&
            $("#An_Descr").val() == ""
        ) {
            $("#AnBtns #btnSave").attr("disabled", true);
        } else {
            $("#AnBtns #btnSave").attr("disabled", false);
        }
    },

    SetParamsFromPrjState: function() {
        prjState = da.PrjView.Get();
        da.AnRead.IdAn = (prjState["IdAn"] ? prjState["IdAn"] : '<?php echo $_SESSION["PSV"]["IdAn"]; ?>');
        // alert('da.AnRead.IdAn: '+da.AnRead.IdAn);
        return prjState;
    },

    Get: function() {
        data = {
            IdAn: $("#An_IdAn").val(),
            IdPrj: $("#An_IdPrj").val(),
            IdAlg: $("#An_IdAlg").val(),
            IdAnState: $("#An_IdAnState").val(),
            Nam: $("#An_Nam").val(),
            Descr: $("#An_Descr").val(),
            Dttm: $("#An_Dttm").val(),
            IdAnCntx: $("#An_IdAnCntx").val(),
            IdTrain: $("#An_IdTrain").val(),
            IdTest: $("#An_IdTest").val(),
            IdCompare: $("#An_IdCompare").val(),
            IdRev: $("#An_IdRev").val(),
            IdAnStateCalc: $("#An_IdAnStateCalc").val(),
            AnCntxFolderNam: $("#An_AnCntxFolderNam").val(),
            TrainFolderNam: $("#An_TrainFolderNam").val(),
            TestFolderNam: $("#An_TestFolderNam").val(),
            CompareFolderNam: $("#An_CompareFolderNam").val(),
            RevFolderNam: $("#An_RevFolderNam").val(),
        };
        return data;
    },

    Set: function(data) {
        $("#An_IdAn").val(data["IdAn"]);
        $("#An_IdAlg").val(data["IdAlg"]);
        $("#An_AlgNam").val(data["AlgNam"]);
        $("#An_IdAnState").val(data["IdAnStateCalc"]); // for autosave
        $("#An_AnStateNam").val(data["AnStateNam"]);
        $("#An_IdPrj").val(data["IdPrj"]);
        // $("#An_PrjNam").val(data["PrjNam"]);
        $("#An_Nam").val(data["Nam"]);
        $("#An_Descr").val(data["Descr"]);
        $("#An_Dttm").val(new Date(data["Dttm"]).toJSON().slice(0,16));
        $("#An_IdAnCntx").val(data["IdAnCntx"]);
        $("#An_IdTrain").val(data["IdTrain"]);
        $("#An_IdTest").val(data["IdTest"]);
        $("#An_IdCompare").val(data["IdCompare"]);
        $("#An_IdRev").val(data["IdRev"]);
        $("#An_IdAnStateCalc").val(data["IdAnStateCalc"]);
        $("#An_AnCntxFolderNam").val(data["AnCntxFolderNam"]);
        $("#An_TrainFolderNam").val(data["TrainFolderNam"]);
        $("#An_TestFolderNam").val(data["TestFolderNam"]);
        $("#An_CompareFolderNam").val(data["CompareFolderNam"]);
        $("#An_RevFolderNam").val(data["RevFolderNam"]);

        da.AnRead.btnControl();
    },

    Clean: function() {
        prjState = da.AnRead.SetParamsFromPrjState();

        // $("#An_IdAn").val(da.AnRead.IdCntx);
        $("#An_IdAn").val('');
        $("#An_IdPrj").val('<?php echo $_SESSION["PSV"]["IdPrj"]; ?>');
        // $("#An_PrjNam").val(data["PrjNam"]);
        $("#An_IdAlg").val("");
        $("#An_AlgNam").val("");
        $("#An_IdAnState").val('');
        $("#An_AnStateNam").val('');
        $("#An_Nam").val("");
        $("#An_Descr").val('');
        $("#An_Dttm").val(new Date($.now()).toJSON().slice(0,16)); // default datetime 
        $("#An_IdAnCntx").val('');
        $("#An_IdTrain").val('');
        $("#An_IdTest").val('');
        $("#An_IdCompare").val('');
        $("#An_IdRev").val('');
        $("#An_IdAnStateCalc").val('');
        $("#An_AnCntxFolderNam").val('');
        $("#An_TrainFolderNam").val('');
        $("#An_TestFolderNam").val('');
        $("#An_CompareFolderNam").val('');
        $("#An_RevFolderNam").val('');

        da.AnRead.btnControl();
        // if (da.AnRead.ParentObj) {
        //     // alert(da.AnRead.ParentObj);
        //     da.RefreshObj(da.AnRead.ParentObj, da.AnRead.ParentObjType, da.AnRead.ParentObjFun);
        // }

    },

    SetAlg: function(data) {
        $("#An_IdAlg").val(data["IdAlg"]);
        $("#An_AlgNam").val(data["Nam"]);
        // $("#An_IdAlg").val("1");
        // $("#An_AlgNam").val("Linear Regression");
        da.AnRead.btnControl();
    },

    CleanAlg: function() {
        $("#An_IdAlg").val("");
        $("#An_AlgNam").val("");

        da.AnRead.btnControl();
    },

    SetAnCntx: function(data) {
        $("#An_IdAnCntx").val(data["IdAnCntx"]);
    },
    SetTrain: function(data) {
        $("#An_IdTrain").val(data["IdTrain"]);
        $("#An_TrainFolderNam").val(da.AnRead.TrainFolderPrfx + data["IdTrain"]);
    },
    SetTest: function(data) {
        $("#An_IdTest").val(data["IdTest"]);
        $("#An_TestFolderNam").val(da.AnRead.TestFolderPrfx + data["IdTest"]);
    },
    SetRev: function(data) {
        $("#An_IdRev").val(data["IdRev"]);
        $("#An_RevFolderNam").val(da.AnRead.RevFolderPrfx + data["IdRev"]);
    },
    CleanAnCntx: function() {
        $("#An_IdAnCntx").val("");
    },
    CleanTrain: function() {
        $("#An_IdTrain").val("");
        $("#An_TrainFolderNam").val(da.AnRead.TrainFolderPrfx);
    },
    CleanTest: function() {
        $("#An_IdTest").val("");
        $("#An_TestFolderNam").val(da.AnRead.TestFolderPrfx);
    },
    Cleanrev: function() {
        $("#An_IdRev").val("");
        $("#An_RevFolderNam").val(da.AnRead.RevFolderPrfx);
    },
    Refresh: function() {
        try {
            // alert("IdAn: "+ da.AnRead.IdAn);
            if (da.AnRead.IdAn && da.AnRead.IdAn != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/An/Read.proxy.php?IdAn=" + da.AnRead.IdAn,
                    dataType: "json",
                    error: function(result) {
                        // alert(result);
                        da.UsrMsgShow(da.AnRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result);
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data = result["Data"];
                        da.AnRead.Set(data);

                        if (data["IdAnState"] != data["IdAnStateCalc"]) {
                            da.UsrMsgShow("Update Analysis State ...", "Info");
                            da.AnRead.Save();
                        }
                    },
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    Delete: function() {
        try {
            Id = $("#An_IdAn").val();
            Nam = $("#An_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/An/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdAn: Id
                    },
                    error: function(result) {
                        da.UsrMsgShow(da.AnRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.AnRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.AnRead.ParentObj) {
                                da.RefreshObj(da.AnRead.ParentObj);
                            }
                            if (da.AnRead.RefPanels && da.AnRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.AnRead.RefPanels, "CleanAn");
                            }
                            da.UsrMsgShow(da.AnRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.AnRead.FailMsg, "Info");
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
            // alert("#AnBtns #btnSave");
            if (da.verifyCompulsoryFields(da.AnRead.CompulsoryFields, da.AnRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/An/Save.proxy.php",
                    async: true,
                    dataType: "json",
                    data: da.AnRead.Get(),
                    error: function(result) {
                        // alert(result);
                        da.UsrMsgShow(da.AnRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result);
                        if (result["State"]) {
                            $("#An_IdAn").val(da.AnRead.IdAn = result["IdAn"])
                            da.AnRead.btnControl();

                            if (da.AnRead.ParentObj) {
                                // da.RefreshObj(da.AnRead.ParentObj, da.AnRead.ParentObjType, fun =
                                //     "Refresh", data = null);
                                da.RefreshObj(da.AnRead.ParentObj, da.AnRead.ParentObjType, da
                                    .AnRead.ParentObjFun, data = null);
                            }
                            if (da.AnRead.RefPanels && da.AnRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.AnRead.RefPanels, "SetAn", da.AnRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.AnRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.AnRead.FailMsg, "Info");
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
            da.navigation.AnCompleteBoard();
        } catch (e) {
            da.UsrMsgShow(da.AnRead.FailMsg, "Error");
        }
    },
    getAnStateselect: function() {
        $.ajax({
            url: "DA/HtmlComponents/AnState/Tlist.proxy.php",
            type: "POST",
            dataType: "json",
            async: true,
            data: "data",
            success: function(response) {
                // alert("popola select records: "+response.data.length);
                $("#An_IdAnState").empty();
                $("#An_IdAnState").append(
                    $("<option></option>") // Yes you can do this.
                    .text("Select an Item ...")
                    .val("")
                );
                $.each(response.data, function(index, item) { // Iterates through a collection
                    $("#An_IdAnState")
                        .append( // Append an object to the inside of the select box
                            $("<option></option>") // Yes you can do this.
                            .text(item.IdAnState + " - " + item.Nam)
                            .val(item.IdAnState)
                        );
                });
                // $("#An_IdPrjState").val( php echo $this->IdPrjState; ?>);
            }
        });
    },
}

$(document).ready(function() {
    // ??? rivedere sequenze clean>select>refresh
    da.AnRead.Clean();

    //popola select ...
    da.AnRead.getAnStateselect();

    if (da.AnRead.Mode == "alone" ||
        da.AnRead.IdAn) {
        // alert(da.AnRead.IdAn);
        da.AnRead.Refresh();
    }


    /**************
     * TODO da trasferire al php proxy
     */
    $("#AnBtns #btnSave").click(function() {
        da.AnRead.Save();
    });

    $("#AnBtns #btnRefresh").click(function() {
        da.AnRead.Refresh();
    });

    // Deletezione An
    // elimina solo DB: FS persiste
    $("#AnBtns #btnDelete").click(function() {
        da.AnRead.Delete();
    });

    $("#AnBtns #btnNew").click(function() {
        //alert("AnBtns #btnNew")
        da.AnRead.Clean();
    });

    // $("#AnBtns #btnOpen").click(function() {
    //     //alert("AnBtns #btnOpen")
    //     da.AnRead.Open()
    // });

    $("#An_Nam").keyup(function(event) {
        da.AnRead.btnControl();
    });

    $("#An_Descr").keyup(function(event) {
        da.AnRead.btnControl();
    });

})
</script>