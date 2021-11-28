<script type="text/javascript" ref="da.SplitTypeRead">
da.SplitTypeRead = {

    whoIAm: 'SplitType',
    PanelTag: this.whoIAm + '_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdSplitType: '',
    IdSplitCat: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.SplitTypeRead.Mode == 'alone') {
            $("#SplitTypeBtns #btnNew").hide();
        }

        if ($("#SplitType_IdSplitType").val() == "") {
            $("#SplitTypeBtns #btnRefresh").attr("disabled", true);
            $("#SplitTypeBtns #btnDelete").attr("disabled", true);
        } else {
            $("#SplitTypeBtns #btnRefresh").attr("disabled", false);
            $("#SplitTypeBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#SplitType_Nam").val() == "" &&
            $("#SplitType_Descr").val() == "" &&
            $("#SplitType_Perc").val() == ""
        ) {
            $("#SplitTypeBtns #btnSave").attr("disabled", true);
        } else {
            $("#SplitTypeBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdSplitType: $("#SplitType_IdSplitType").val(),
            IdSplitCat: $("#SplitType_IdSplitCat").val(),
            SplitCatNam: $("#SplitType_SplitCatNam").val(),
            Nam: $("#SplitType_Nam").val(),
            Descr: $("#SplitType_Descr").val(),
            Perc: $("#SplitType_Perc").val()
        };
        return data;
    },


    Set: function(data) {
        $("#SplitType_IdSplitType").val(data["IdSplitType"]);
        $("#SplitType_IdSplitCat").val(data["IdSplitCat"]);
        $("#SplitType_SplitCatNam").val(data["SplitCatNam"]);
        $("#SplitType_Nam").val(data["Nam"]);
        $("#SplitType_Descr").val(data["Descr"]);
        $("#SplitType_Perc").val(data["Perc"]);

        da.SplitTypeRead.btnControl();
    },

    SetSplitCat: function(data) {
        $("#SplitType_IdSplitCat").val(data["IdSplitCat"]);
        $("#SplitType_SplitCatNam").val(data["SplitCatNam"]);

        da.SplitTypeRead.btnControl();
    },

    CleanSplitCat: function() {
        $("#SplitType_IdSplitCat").val('');
        $("#SplitType_SplitCatNam").val('');

        da.SplitTypeRead.btnControl();
    },

    Clean: function() {
        $("#SplitType_IdSplitType").val("");
        if (da.SplitTypeRead.IdSplitCat == '') {
            $("#SplitType_IdSplitCat").val("");
            $("#SplitType_SplitCatNam").val("");
        }
        $("#SplitType_Nam").val("");
        $("#SplitType_Descr").val("");
        $("#SplitType_Perc").val("");

        da.SplitTypeRead.btnControl();
    },

    Refresh: function() {
        try {
            if (da.SplitTypeRead.IdSplitType && da.SplitTypeRead.IdSplitType != '') {

            }
            return $.ajax({
                type: "GET",
                url: "DA/HtmlComponents/SplitType/Read.proxy.php?IdSplitType=" + da.SplitTypeRead
                    .IdSplitType,
                dataType: "json",
                error: function(result) {
                    da.UsrMsgShow(da.SplitTypeRead.FailMsg, "Info");
                },
                success: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    data = result["Data"];
                    da.SplitTypeRead.Set(data);
                },
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#SplitType_IdSplitType").val();
            Nam = $("#SplitType_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/SplitType/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdSplitType: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.SplitTypeRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.SplitTypeRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.SplitTypeRead.ParentObj) {
                                da.RefreshObj(da.SplitTypeRead.ParentObj);
                            }
                            if (da.SplitTypeRead.RefPanels && da.SplitTypeRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.SplitTypeRead.RefPanels, "CleanSplitType");
                            }
                            da.UsrMsgShow(da.SplitTypeRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.SplitTypeRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.SplitTypeRead.CompulsoryFields, da.SplitTypeRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/SplitType/Save.proxy.php",
                    dataType: "json",
                    data: da.SplitTypeRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.SplitTypeRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#SplitType_IdSplitType").val(result["IdSplitType"]);
                            if (da.SplitTypeRead.ParentObj) {
                                // alert(da.SplitTypeRead.ParentObj);
                                da.RefreshObj(da.SplitTypeRead.ParentObj);
                            }
                            if (da.SplitTypeRead.RefPanels && da.SplitTypeRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.SplitTypeRead.RefPanels, "SetSplitType", da.SplitTypeRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.SplitTypeRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.SplitTypeRead.FailMsg, "Info");
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

    //popola select | tree ...
    // da.SplitTypeRead.IdSplitCat_Select();

    // set defaults
    da.SplitTypeRead.Clean();

    $("#SplitTypeBtns #btnSave").click(function() {
        da.SplitTypeRead.Save();
    });

    $("#SplitTypeBtns #btnRefresh").click(function() {
        da.SplitTypeRead.Refresh();
    });

    $("#SplitTypeBtns #btnDelete").click(function() {
        da.SplitTypeRead.Delete();
    });

    $("#SplitTypeBtns #btnNew").click(function() {
        da.SplitTypeRead.Clean();
    });

    $("#SplitType_Nam").keyup(function(event) {
        da.SplitTypeRead.btnControl();
    });
    $("#SplitType_Descr").keyup(function(event) {
        da.SplitTypeRead.btnControl();
    });
    $("#SplitType_Perc").keyup(function(event) {
        da.SplitTypeRead.btnControl();
    });

})
</script>