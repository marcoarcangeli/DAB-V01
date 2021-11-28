<script type="text/javascript" ref="da.RColTypeRead">
da.RColTypeRead = {

    whoIAm: 'RColType',
    PanelTag: this.whoIAm + '_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdRColType: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.RColTypeRead.Mode == 'alone') {
            $("#RColTypeBtns #btnNew").hide();
        }

        if ($("#RColType_IdRColType").val() == "") {
            $("#RColTypeBtns #btnRefresh").attr("disabled", true);
            $("#RColTypeBtns #btnDelete").attr("disabled", true);
        } else {
            $("#RColTypeBtns #btnRefresh").attr("disabled", false);
            $("#RColTypeBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#RColType_Nam").val() == "" &&
            $("#RColType_Descr").val() == ""
        ) {
            $("#RColTypeBtns #btnSave").attr("disabled", true);
        } else {
            $("#RColTypeBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdRColType: $("#RColType_IdRColType").val(),
            Nam: $("#RColType_Nam").val(),
            Descr: $("#RColType_Descr").val()
        };
        return data;
    },

    Set: function(data) {
        $("#RColType_IdRColType").val(data["IdRColType"]);
        $("#RColType_Nam").val(data["Nam"]);
        $("#RColType_Descr").val(data["Descr"]);

        da.RColTypeRead.btnControl();
    },

    Clean: function() {
        $("#RColType_IdRColType").val("");
        $("#RColType_Nam").val("");
        $("#RColType_Descr").val("");

        da.RColTypeRead.btnControl();
    },

    Refresh: function() {
        try {
            return $.ajax({
                type: "GET",
                url: "DA/HtmlComponents/RColType/Read.proxy.php?IdRColType=" + da.RColTypeRead
                    .IdRColType,
                dataType: "json",
                error: function(result) {
                    da.UsrMsgShow(da.RColTypeRead.FailMsg, "Error");
                },
                success: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    data = result["Data"];
                    da.RColTypeRead.Set(data);
                },
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#RColType_IdRColType").val();
            Nam = $("#RColType_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/RColType/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdRColType: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.RColTypeRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.RColTypeRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.RColTypeRead.ParentObj) {
                                da.RefreshObj(da.RColTypeRead.ParentObj);
                            }
                            if (da.RColTypeRead.RefPanels && da.RColTypeRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.RColTypeRead.RefPanels, "CleanRColType");
                            }
                            da.UsrMsgShow(da.RColTypeRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.RColTypeRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.RColTypeRead.CompulsoryFields, da.RColTypeRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/RColType/Save.proxy.php",
                    dataType: "json",
                    data: da.RColTypeRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.RColTypeRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#RColType_IdRColType").val(result["IdRColType"]);
                            if (da.RColTypeRead.ParentObj) {
                                da.RefreshObj(da.RColTypeRead.ParentObj);
                            }
                            if (da.RColTypeRead.RefPanels && da.RColTypeRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.RColTypeRead.RefPanels, "SetRColType", da.RColTypeRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.RColTypeRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.RColTypeRead.FailMsg, "Info");
                        }
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

}
$(document).ready(function() {

    //popola select ...

    // set defaults
    da.RColTypeRead.Clean();

    $("#RColTypeBtns #btnSave").click(function() {
        da.RColTypeRead.Save();
    });

    $("#RColTypeBtns #btnRefresh").click(function() {
        da.RColTypeRead.Refresh();
    });

    $("#RColTypeBtns #btnDelete").click(function() {
        da.RColTypeRead.Delete();
    });

    $("#RColTypeBtns #btnNew").click(function() {
        da.RColTypeRead.Clean();
    });

    $("#RColType_Nam").keyup(function(event) {
        da.RColTypeRead.btnControl();
    });
    $("#RColType_Descr").keyup(function(event) {
        da.RColTypeRead.btnControl();
    });

})
</script>