<script type="text/javascript" ref="da.RevRead">
da.RevRead = {

    whoIAm: 'Rev',
    PanelTag: this.whoIAm + '_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdRev: '<?php echo $_SESSION["ASV"]["IdRev"]; ?>',
    IdAn: '<?php echo $_SESSION["PSV"]["IdAn"]; ?>',
    RevFolderName: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.RevRead.Mode == 'alone') {
            $("#RevBtns #btnNew").hide();
        }

        if ($("#Rev_IdRev").val() == "") {
            // $("#RevBtns #btnOpen").attr("disabled", true);
            $("#RevBtns #btnRefresh").attr("disabled", true);
            $("#RevBtns #btnDelete").attr("disabled", true);
        } else {
            // $("#RevBtns #btnOpen").attr("disabled", false);
            $("#RevBtns #btnRefresh").attr("disabled", false);
            $("#RevBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#Rev_Note").val() == ""
        ) {
            $("#RevBtns #btnSave").attr("disabled", true);
        } else {
            $("#RevBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdRev: $("#Rev_IdRev").val(),
            IdAn: $("#Rev_IdAn").val(),
            // Nam:    $("#Rev_Nam").val(),
            Note: $("#Rev_Note").val(),
        };
        return data;
    },

    Set: function(data) {
        $("#Rev_IdRev").val(data["IdRev"]);
        $("#Rev_IdAn").val(data["IdAn"]);
        // $("#Rev_AnNam").val(data["AnNam"]);
        $("#Rev_Note").val(data["Note"]);

        da.RevRead.btnControl();
    },

    Clean: function() {
        $("#Rev_IdRev").val('<?php echo $_SESSION["ASV"]["IdRev"]; ?>');
        $("#Rev_IdAn").val('<?php echo $_SESSION["PSV"]["IdAn"]; ?>');
        // $("#Rev_AnNam").val(""); /DAB/V01/DA/HtmlComponents/Common/RevBaseText.txt
        // "Valutazione di\nMAE:\nRMSE:\nR2:\n ----------------------------------------------\n Valutazione della qualità di previsione\n Outcome:\n rispetto alla variabile:\n Var1:\n Var2:\n Var3:"
        // alert('?php echo $_SESSION["ContentCommonRelPath"].$_SESSION["RevBaseTextFile"]; ?>');
        $("#Rev_Note").val('<?php include($_SESSION["ContentCommonRelPath"].$_SESSION["RevBaseTextFile"]); ?> ');

        da.RevRead.btnControl();
    },

    SetAn: function(data) {
        $("#Rev_IdAn").val(data["IdAn"]);
        // $("#Rev_AnNam").val(data["Nam"]);

        da.RevRead.btnControl();
    },

    CleanAn: function() {
        $("#Rev_IdAn").val("");
        // $("#Rev_AnNam").val("");

        da.RevRead.btnControl();
    },

    Refresh: function() {
        try {
            // alert("IdRev: "+ da.RevRead.IdRev);
            if (da.RevRead.IdRev && da.RevRead.IdRev != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/Rev/Read.proxy.php?IdRev=" + da.RevRead.IdRev,
                    dataType: "json",
                    error: function(result) {
                        // alert(result);
                        da.UsrMsgShow(da.RevRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result);
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data = result["Data"];
                        da.RevRead.Set(data);
                    },
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#Rev_IdRev").val();
            Nam = $("#Rev_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Rev/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdRev: Id
                    },
                    error: function(result) {
                        da.UsrMsgShow(da.RevRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.RevRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.RevRead.ParentObj) {
                                da.RefreshObj(da.RevRead.ParentObj);
                            }
                            if (da.RevRead.RefPanels && da.RevRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.RevRead.RefPanels, "CleanRev");
                            }
                            da.UsrMsgShow(da.RevRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.RevRead.FailMsg, "Info");
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
            // alert("#RevBtns #btnSave");
            if (da.verifyCompulsoryFields(da.RevRead.CompulsoryFields, da.RevRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Rev/Save.proxy.php",
                    async: true,
                    dataType: "json",
                    data: da.RevRead.Get(),
                    error: function(result) {
                        // alert(result);
                        da.UsrMsgShow(da.RevRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result);
                        if (result["State"]) {
                            $("#Rev_IdRev").val(da.RevRead.IdRev = result["IdRev"]);
                            da.RevRead.btnControl();
                            if (da.RevRead.ParentObj) {
                                da.RefreshObj(da.RevRead.ParentObj, da.RevRead.ParentObjType, fun =
                                    "Refresh", data = null);
                            }
                            if (da.RevRead.RefPanels && da.RevRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.RevRead.RefPanels, "SetRev", da.RevRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.RevRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.RevRead.FailMsg, "Info");
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
            da.UsrMsgShow(da.RevRead.FailMsg, "Error");
        }
    },

}

$(document).ready(function() {
    da.RevRead.Clean();

    //popola select ...
    //  ...

    if (da.RevRead.Mode == "alone") {
        da.RevRead.Refresh();
    }


    /**************
     * TODO da trasferire al php proxy
     */
    $("#RevBtns #btnSave").click(function() {
        da.RevRead.Save();
    });

    $("#RevBtns #btnRefresh").click(function() {
        da.RevRead.Refresh();
    });

    // Deletezione An
    // elimina solo DB: FS persiste
    $("#RevBtns #btnDelete").click(function() {
        da.RevRead.Delete();
    });

    $("#RevBtns #btnNew").click(function() {
        //alert("RevBtns #btnNew")
        da.RevRead.Clean();
    });

    // $("#RevBtns #btnOpen").click(function() {
    //     //alert("RevBtns #btnOpen")
    //     da.RevRead.Open()
    // });

    $("#Rev_Note").keyup(function(event) {
        da.RevRead.btnControl();
    });

})
</script>