<script type="text/javascript" ref="da.ParamTypeRead">
da.ParamTypeRead = {

    PanelTag: 'ParamType_',
    whoIAm: 'ParamType',
    PanelTag: this.whoIAm + '_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdParamType: '',
    IdParamTypeCat: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.ParamTypeRead.Mode == 'alone') {
            $("#ParamTypeBtns #btnNew").hide();
        }

        if ($("#ParamType_IdParamType").val() == "") {
            $("#ParamTypeBtns #btnRefresh").attr("disabled", true);
            $("#ParamTypeBtns #btnDelete").attr("disabled", true);
        } else {
            $("#ParamTypeBtns #btnRefresh").attr("disabled", false);
            $("#ParamTypeBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#ParamType_Nam").val() == "" &&
            $("#ParamType_Descr").val() == "" &&
            $("#ParamType_Unit").val() == "" &&
            $("#ParamType_vlDefault").val() == ""
        ) {
            $("#ParamTypeBtns #btnSave").attr("disabled", true);
        } else {
            $("#ParamTypeBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdParamType: $("#ParamType_IdParamType").val(),
            IdParamTypeCat: $("#ParamType_IdParamTypeCat").val(),
            ParamTypeCatNam: $("#ParamType_ParamTypeCatNam").val(),
            Nam: $("#ParamType_Nam").val(),
            Descr: $("#ParamType_Descr").val(),
            Unit: $("#ParamType_Unit").val(),
            vlDefault: $("#ParamType_vlDefault").val()
        };
        return data;
    },


    Set: function(data) {
        $("#ParamType_IdParamType").val(data["IdParamType"]);
        $("#ParamType_IdParamTypeCat").val(data["IdParamTypeCat"]);
        $("#ParamType_ParamTypeCatNam").val(data["ParamTypeCatNam"]);
        $("#ParamType_Nam").val(data["Nam"]);
        $("#ParamType_Descr").val(data["Descr"]);
        $("#ParamType_Unit").val(data["Unit"]);
        $("#ParamType_vlDefault").val(data["vlDefault"]);

        da.ParamTypeRead.btnControl();
    },

    SetParamTypeCat: function(data) {
        $("#ParamType_IdParamTypeCat").val(data["IdParamTypeCat"]);
        $("#ParamType_ParamTypeCatNam").val(data["ParamTypeCatNam"]);

        // da.ParamTypeRead.btnControl();
    },

    CleanParamTypeCat: function() {
        $("#ParamType_IdParamTypeCat").val('');
        $("#ParamType_ParamTypeCatNam").val('');
        // da.ParamTypeRead.btnControl();
    },

    Clean: function() {
        $("#ParamType_IdParamType").val("");
        if (da.ParamTypeRead.IdParamTypeCat == '') {
            $("#ParamType_IdParamTypeCat").val("");
            $("#ParamType_ParamTypeCatNam").val("");
        }
        $("#ParamType_Nam").val("");
        $("#ParamType_Descr").val("");
        $("#ParamType_Unit").val("");
        $("#ParamType_vlDefault").val("");
    },

    Refresh: function(data) {
        try {
            if (data) {
                da.ParamTypeRead.IdParamType = (data['IdParamType']) ? data['IdParamType'] : '';
                // alert(da.ParamTypeRead.IdParamType);
            }

            if (da.ParamTypeRead.IdParamType && da.ParamTypeRead.IdParamType != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/ParamType/read.proxy.php?IdParamType=" + da.ParamTypeRead
                        .IdParamType,
                    dataType: "json",
                    error: function(result) {
                        da.UsrMsgShow(da.ParamTypeRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data = result["Data"];
                        da.ParamTypeRead.Set(data);
                    },
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#ParamType_IdParamType").val();
            Nam = $("#ParamType_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/ParamType/delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdParamType: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.ParamTypeRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.ParamTypeRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.ParamTypeRead.ParentObj) {
                                da.RefreshObj(da.ParamTypeRead.ParentObj);
                            }
                            if (da.ParamTypeRead.RefPanels && da.ParamTypeRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.ParamTypeRead.RefPanels,
                                "CleanParamType");
                            }
                            da.UsrMsgShow(da.ParamTypeRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.ParamTypeRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.ParamTypeRead.CompulsoryFields, da.ParamTypeRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/ParamType/Save.proxy.php",
                    dataType: "json",
                    data: da.ParamTypeRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.ParamTypeRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#ParamType_IdParamType").val(result["IdParamType"]);
                            if (da.ParamTypeRead.ParentObj) {
                                // alert(da.ParamTypeRead.ParentObj);
                                da.RefreshObj(da.ParamTypeRead.ParentObj);
                            }
                            if (da.ParamTypeRead.RefPanels && da.ParamTypeRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.ParamTypeRead.RefPanels, "SetParamType",
                                    da.ParamTypeRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.ParamTypeRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.ParamTypeRead.FailMsg, "Info");
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
    // da.ParamTypeRead.IdParamTypeCat_Select();

    // set defaults
    da.ParamTypeRead.Clean();

    $("#ParamTypeBtns #btnSave").click(function() {
        da.ParamTypeRead.Save();
    });

    $("#ParamTypeBtns #btnRefresh").click(function() {
        da.ParamTypeRead.Refresh();
    });

    $("#ParamTypeBtns #btnDelete").click(function() {
        da.ParamTypeRead.Delete();
    });

    $("#ParamTypeBtns #btnNew").click(function() {
        da.ParamTypeRead.Clean();
    });

    $("#ParamType_Nam").keyup(function(event) {
        da.ParamTypeRead.btnControl();
    });
    $("#ParamType_Descr").keyup(function(event) {
        da.ParamTypeRead.btnControl();
    });
    $("#ParamType_Unit").keyup(function(event) {
        da.ParamTypeRead.btnControl();
    });
    $("#ParamType_vlDefault").keyup(function(event) {
        da.ParamTypeRead.btnControl();
    });

})
</script>