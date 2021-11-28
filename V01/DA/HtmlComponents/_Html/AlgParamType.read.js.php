<script type="text/javascript" ref="da.AlgParamTypeRead">
da.AlgParamTypeRead = {

    PanelTag: 'AlgParamType_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdAlgParamType: '',
    IdParamType: '',
    IdAlg: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.AlgParamTypeRead.Mode == 'alone') {
            $("#AlgParamTypeBtns #btnNew").hide();
        }

        if ($("#AlgParamType_IdAlgParamType").val() == "") {
            $("#AlgParamTypeBtns #btnRefresh").attr("disabled", true);
            $("#AlgParamTypeBtns #btnDelete").attr("disabled", true);
        } else {
            $("#AlgParamTypeBtns #btnRefresh").attr("disabled", false);
            $("#AlgParamTypeBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#AlgParamType_Nam").val() == "" &&
            $("#AlgParamType_Descr").val() == "" &&
            $("#AlgParamType_Unit").val() == "" &&
            $("#AlgParamType_vlDefault").val() == ""
        ) {
            $("#AlgParamTypeBtns #btnSave").attr("disabled", true);
        } else {
            $("#AlgParamTypeBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdAlgParamType: $("#AlgParamType_IdAlgParamType").val(),
            IdParamType: $("#AlgParamType_IdParamType").val(),
            ParamTypeNam: $("#AlgParamType_ParamTypeNam").val(),
            IdAlg: $("#AlgParamType_IdAlg").val(),
            AlgNam: $("#AlgParamType_AlgNam").val(),
            Nam: $("#AlgParamType_Nam").val(),
            Descr: $("#AlgParamType_Descr").val(),
            Unit: $("#AlgParamType_Unit").val(),
            vlDefault: $("#AlgParamType_vlDefault").val()
        };
        return data;
    },

    Set: function(data) {
        $("#AlgParamType_IdAlgParamType").val(data["IdAlgParamType"]);
        $("#AlgParamType_IdParamType").val(data["IdParamType"]);
        $("#AlgParamType_ParamTypeNam").val(data["ParamTypeNam"]);
        $("#AlgParamType_IdAlg").val(data["IdAlg"]);
        $("#AlgParamType_AlgNam").val(data["AlgNam"]);
        $("#AlgParamType_Nam").val(data["Nam"]);
        $("#AlgParamType_Descr").val(data["Descr"]);
        $("#AlgParamType_Unit").val(data["Unit"]);
        $("#AlgParamType_vlDefault").val(data["vlDefault"]);

        da.AlgParamTypeRead.btnControl();
    },

    Clean: function() {
        $("#AlgParamType_IdAlgParamType").val("");
        if (da.AlgParamTypeRead.IdParamType == '') {
            $("#AlgParamType_IdParamType").val("");
            $("#AlgParamType_ParamTypeNam").val("");
        }
        if (da.AlgParamTypeRead.IdAlg == '') {
            $("#AlgParamType_IdAlg").val("");
            $("#AlgParamType_AlgNam").val("");
        }
        $("#AlgParamType_Nam").val("");
        $("#AlgParamType_Descr").val("");
        $("#AlgParamType_Unit").val("");
        $("#AlgParamType_vlDefault").val("");
    },

    SetParamType: function(data) {
        $("#AlgParamType_IdParamType").val(data["IdParamType"]);
        $("#AlgParamType_ParamTypeNam").val(data["Nam"]);
        da.AlgParamTypeRead.IdParamType = data["IdParamType"];
        // da.AlgParamTypeRead.btnControl();
    },

    CleanParamType: function() {
        $("#AlgParamType_IdParamType").val('');
        $("#AlgParamType_ParamTypeNam").val('');
        da.AlgParamTypeRead.IdParamType = '';
        // da.AlgParamTypeRead.btnControl();
    },

    SetAlg: function(data) {
        // alert("AlgParamType_IdAlg");
        $("#AlgParamType_IdAlg").val(data["IdAlg"]);
        $("#AlgParamType_AlgNam").val(data["Nam"]);
        da.AlgParamTypeRead.IdAlg = data["IdAlg"];
        // da.AlgParamTypeRead.btnControl();
    },

    CleanAlg: function() {
        $("#AlgParamType_IdAlg").val('');
        $("#AlgParamType_AlgNam").val('');
        da.AlgParamTypeRead.IdAlg = '';

        // da.AlgParamTypeRead.btnControl();
    },

    SetDefaults: function(data) {
        // $("#AlgParamType_IdAlgParamType").val(data["IdAlgParamType"]);
        // $("#AlgParamType_IdParamType").val(data["IdParamType"]);
        // $("#AlgParamType_ParamTypeNam").val(data["ParamTypeNam"]);
        // $("#AlgParamType_IdAlg").val(data["IdAlg"]);
        // $("#AlgParamType_AlgNam").val(data["AlgNam"]);
        // $("#AlgParamType_Nam").val(data["Nam"]);
        // $("#AlgParamType_Descr").val(data["Descr"]);
        $("#AlgParamType_Unit").val(data["Unit"]);
        $("#AlgParamType_vlDefault").val(data["vlDefault"]);

        da.AlgParamTypeRead.btnControl();
    },

    CleanDefaults: function() {
        // $("#AlgParamType_IdAlgParamType").val("");
        // if(da.AlgParamTypeRead.IdParamType == ''){
        //     $("#AlgParamType_IdParamType").val("");
        //     $("#AlgParamType_ParamTypeNam").val("");
        // }
        // if(da.AlgParamTypeRead.IdAlg == ''){
        //     $("#AlgParamType_IdAlg").val("");
        //     $("#AlgParamType_AlgNam").val("");
        // }
        // $("#AlgParamType_Nam").val("");
        // $("#AlgParamType_Descr").val("");
        $("#AlgParamType_Unit").val("");
        $("#AlgParamType_vlDefault").val("");
    },

    Refresh: function() {
        try {
            return $.ajax({
                type: "GET",
                url: "DA/HtmlComponents/AlgParamType/read.proxy.php?IdAlgParamType=" + da
                    .AlgParamTypeRead.IdAlgParamType,
                dataType: "json",
                error: function(result) {
                    da.UsrMsgShow(da.AlgParamTypeRead.FailMsg, "Info");
                },
                success: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    data = result["Data"];
                    da.AlgParamTypeRead.Set(data);
                },
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#AlgParamType_IdAlgParamType").val();
            Nam = $("#AlgParamType_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/AlgParamType/delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdAlgParamType: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.AlgParamTypeRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.AlgParamTypeRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.AlgParamTypeRead.ParentObj) {
                                da.RefreshObj(da.AlgParamTypeRead.ParentObj);
                            }
                            da.UsrMsgShow(da.AlgParamTypeRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.AlgParamTypeRead.FailMsg, "Info");
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
            // alert("#btnSave");
            if (da.verifyCompulsoryFields(da.AlgParamTypeRead.CompulsoryFields, da.AlgParamTypeRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/AlgParamType/Save.proxy.php",
                    dataType: "json",
                    data: da.AlgParamTypeRead.Get(),
                    error: function(result) {
                        // alert(result["State"]);

                        da.UsrMsgShow(da.AlgParamTypeRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["State"]);
                        if (result["State"]) {
                            $("#AlgParamType_IdAlgParamType").val(result["IdAlgParamType"]);
                            if (da.AlgParamTypeRead.ParentObj) {
                                // alert(da.AlgParamTypeRead.ParentObj);
                                da.RefreshObj(da.AlgParamTypeRead.ParentObj);
                            }
                            da.UsrMsgShow(da.AlgParamTypeRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.AlgParamTypeRead.FailMsg, "Info");
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
    // da.AlgParamTypeRead.IdParamType_Select();

    // set defaults
    da.AlgParamTypeRead.Clean();

    $("#AlgParamTypeBtns #btnSave").click(function() {
        da.AlgParamTypeRead.Save();
    });

    $("#AlgParamTypeBtns #btnRefresh").click(function() {
        da.AlgParamTypeRead.Refresh();
    });

    $("#AlgParamTypeBtns #btnDelete").click(function() {
        da.AlgParamTypeRead.Delete();
    });

    $("#AlgParamTypeBtns #btnNew").click(function() {
        da.AlgParamTypeRead.Clean();
    });

    $("#AlgParamType_Nam").keyup(function(event) {
        da.AlgParamTypeRead.btnControl();
    });
    $("#AlgParamType_Descr").keyup(function(event) {
        da.AlgParamTypeRead.btnControl();
    });
    $("#AlgParamType_Unit").keyup(function(event) {
        da.AlgParamTypeRead.btnControl();
    });
    $("#AlgParamType_vlDefault").keyup(function(event) {
        da.AlgParamTypeRead.btnControl();
    });

})
</script>