<script type="text/javascript" ref="da.PrjStateRead">
da.PrjStateRead = {

    whoIAm: 'PrjState',
    PanelTag: this.whoIAm + '_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdPrjState: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.PrjStateRead.Mode == 'alone') {
            $("#PrjStateBtns #btnNew").hide();
        }

        if ($("#PrjState_IdPrjState").val() == "") {
            $("#PrjStateBtns #btnRefresh").attr("disabled", true);
            $("#PrjStateBtns #btnDelete").attr("disabled", true);
        } else {
            $("#PrjStateBtns #btnRefresh").attr("disabled", false);
            $("#PrjStateBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#PrjState_Nam").val() == "" &&
            $("#PrjState_Descr").val() == ""
        ) {
            $("#PrjStateBtns #btnSave").attr("disabled", true);
        } else {
            $("#PrjStateBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdPrjState: $("#PrjState_IdPrjState").val(),
            Nam: $("#PrjState_Nam").val(),
            Descr: $("#PrjState_Descr").val()
        };
        return data;
    },

    Set: function(data) {
        $("#PrjState_IdPrjState").val(data["IdPrjState"]);
        $("#PrjState_Nam").val(data["Nam"]);
        $("#PrjState_Descr").val(data["Descr"]);

        da.PrjStateRead.btnControl();
    },

    Clean: function() {
        $("#PrjState_IdPrjState").val("");
        $("#PrjState_Nam").val("");
        $("#PrjState_Descr").val("");

        da.PrjStateRead.btnControl();
    },

    Refresh: function() {
        try {
            return $.ajax({
                type: "GET",
                url: "DA/HtmlComponents/PrjState/Read.proxy.php?IdPrjState=" + da.PrjStateRead
                    .IdPrjState,
                dataType: "json",
                error: function(result) {
                    da.UsrMsgShow(da.PrjStateRead.FailMsg, "Error");
                },
                success: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    data = result["Data"];
                    da.PrjStateRead.Set(data);
                },
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#PrjState_IdPrjState").val();
            Nam = $("#PrjState_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/PrjState/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdPrjState: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.PrjStateRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.PrjStateRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.PrjStateRead.ParentObj) {
                                da.RefreshObj(da.PrjStateRead.ParentObj);
                            }
                            if (da.PrjStateRead.RefPanels && da.PrjStateRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.PrjStateRead.RefPanels, "CleanPrjState");
                            }
                            da.UsrMsgShow(da.PrjStateRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.PrjStateRead.FailMsg, "Info");
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
            // alert("#btnSavePrj");
            if (da.verifyCompulsoryFields(da.PrjStateRead.CompulsoryFields, da.PrjStateRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/PrjState/Save.proxy.php",
                    dataType: "json",
                    data: da.PrjStateRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.PrjStateRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#PrjState_IdPrjState").val(result["IdPrjState"]);
                            if (da.PrjStateRead.ParentObj) {
                                da.RefreshObj(da.PrjStateRead.ParentObj);
                            }
                            if (da.PrjStateRead.RefPanels && da.PrjStateRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.PrjStateRead.RefPanels, "SetPrjState", da.PrjStateRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.PrjStateRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.PrjStateRead.FailMsg, "Info");
                        }
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    }

}
$(document).ready(function() {

    //popola select ...

    // set defaults
    da.PrjStateRead.Clean();

    $("#PrjStateBtns #btnSave").click(function() {
        da.PrjStateRead.Save();
    });

    $("#PrjStateBtns #btnRefresh").click(function() {
        da.PrjStateRead.Refresh();
    });

    $("#PrjStateBtns #btnDelete").click(function() {
        da.PrjStateRead.Delete();
    });

    $("#PrjStateBtns #btnNew").click(function() {
        da.PrjStateRead.Clean();
    });

    $("#PrjState_Nam").keyup(function(event) {
        da.PrjStateRead.btnControl();
    });
    $("#PrjState_Descr").keyup(function(event) {
        da.PrjStateRead.btnControl();
    });

})
</script>