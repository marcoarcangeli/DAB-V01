<script type="text/javascript" ref="da.ParamTypeCatRead">
da.ParamTypeCatRead = {

    whoIAm: 'ParamTypeCat',
    PanelTag: this.whoIAm + '_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdParamTypeCat: '',
    ChangePar: false,
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.ParamTypeCatRead.Mode == 'alone') {
            $("#ParamTypeCatBtns #btnNew").hide();
        }

        if ($("#ParamTypeCat_IdParamTypeCat").val() == "") {
            $("#ParamTypeCatBtns #btnRefresh").attr("disabled", true);
            $("#ParamTypeCatBtns #btnDelete").attr("disabled", true);
            $("#ParamTypeCatBtns #btnNewChild").attr("disabled", true);
            $("#ParamTypeCatBtns #btnChangeParent").attr("disabled", true);
        } else {
            $("#ParamTypeCatBtns #btnRefresh").attr("disabled", false);
            $("#ParamTypeCatBtns #btnDelete").attr("disabled", false);
            $("#ParamTypeCatBtns #btnNewChild").attr("disabled", false);
            $("#ParamTypeCatBtns #btnChangeParent").attr("disabled", false);
        }

        if (
            $("#ParamTypeCat_Nam").val() == "" &&
            $("#ParamTypeCat_Descr").val() == ""
        ) {
            $("#ParamTypeCatBtns #btnSave").attr("disabled", true);
        } else {
            $("#ParamTypeCatBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdParamTypeCat: $("#ParamTypeCat_IdParamTypeCat").val(),
            IdParamTypeCatPar: $("#ParamTypeCat_IdParamTypeCatPar").val(),
            Nam: $("#ParamTypeCat_Nam").val(),
            Descr: $("#ParamTypeCat_Descr").val()
        };
        return data;
    },

    Set: function(data) {
        $("#ParamTypeCat_IdParamTypeCat").val(data["IdParamTypeCat"]);
        $("#ParamTypeCat_IdParamTypeCatPar").val(data["IdParamTypeCatPar"]);
        $("#ParamTypeCat_ParamTypeCatParNam").val(data["ParamTypeCatParNam"]);
        $("#ParamTypeCat_Nam").val(data["Nam"]);
        $("#ParamTypeCat_Descr").val(data["Descr"]);

        da.ParamTypeCatRead.btnControl();
    },

    SetParamTypeCatPar: function(data) {
        $("#ParamTypeCat_IdParamTypeCatPar").val(data["IdParamTypeCat"]);
        $("#ParamTypeCat_ParamTypeCatParNam").val(data["ParamTypeCatNam"]);

        $("#ParamTypeCatBtns #btnChangeParent").removeClass("btn-danger")
        $("#ParamTypeCatBtns #btnChangeParent").addClass("btn-outline-primary");
        
        da.ParamTypeCatRead.btnControl();
    },

    Clean: function() {
        $("#ParamTypeCat_IdParamTypeCat").val("");
        $("#ParamTypeCat_IdParamTypeCatPar").val("");
        $("#ParamTypeCat_ParamTypeCatParNam").val("");
        $("#ParamTypeCat_Nam").val("");
        $("#ParamTypeCat_Descr").val("");

        da.ParamTypeCatRead.btnControl();
    },

    ChangeParent: function() {
        if (da.ParamTypeCatRead.ParentObj) {
            // alert("ChangeParent")
            //change 
            if (da.ParamTypeCatRead.ChangePar) {
                da.ParamTypeCatRead.ChangePar = false;
                $("#ParamTypeCatBtns #btnChangeParent").removeClass("btn-danger")
                $("#ParamTypeCatBtns #btnChangeParent").addClass("btn-outline-primary");
            } else {
                da.ParamTypeCatRead.ChangePar = true;
                $("#ParamTypeCatBtns #btnChangeParent").removeClass("btn-outline-primary")
                $("#ParamTypeCatBtns #btnChangeParent").addClass("btn-danger");
                alert("Select a new Parent in the left tree.");
            }
            da.RefreshObj(da.ParamTypeCatRead.ParentObj, da.ParamTypeCatRead.ParentObjType, "ChangeParent");
            da.ParamTypeCatRead.btnControl();
        }
    },

    CleanParent: function() {
        $("#ParamTypeCat_IdParamTypeCatPar").val($("#ParamTypeCat_IdParamTypeCat").val());
        $("#ParamTypeCat_IdParamTypeCat").val("");
        $("#ParamTypeCat_Nam").val("");
        $("#ParamTypeCat_Descr").val("");

        da.ParamTypeCatRead.btnControl();
    },

    Refresh: function() {
        // alert(da.ParamTypeCatRead.IdParamTypeCat);
        try {
            if (da.ParamTypeCatRead.IdParamTypeCat && da.ParamTypeCatRead.IdParamTypeCat != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/ParamTypeCat/read.proxy.php?IdParamTypeCat=" + da
                        .ParamTypeCatRead.IdParamTypeCat,
                    dataType: "json",
                    error: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        da.UsrMsgShow(da.ParamTypeCatRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data = result["Data"];
                        // alert("success: "+data["IdUsr"]);
                        da.ParamTypeCatRead.Set(data);
                        // da.UsrMsgShow(da.UsrRead.SuccessMsg, "Info");
                    },
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#ParamTypeCat_IdParamTypeCat").val();
            Nam = $("#ParamTypeCat_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/ParamTypeCat/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdParamTypeCat: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.ParamTypeCatRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.ParamTypeCatRead.ParentObj) {
                                da.RefreshObj(da.ParamTypeCatRead.ParentObj, da.ParamTypeCatRead
                                    .ParentObjType, "Refresh");
                            }
                            if (da.ParamTypeCatRead.RefPanels && da.ParamTypeCatRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.ParamTypeCatRead.RefPanels, "CleanParamTypeCat");
                            }
                            da.UsrMsgShow(da.ParamTypeCatRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.ParamTypeCatRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.ParamTypeCatRead.CompulsoryFields, da.ParamTypeCatRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/ParamTypeCat/Save.proxy.php",
                    dataType: "json",
                    data: da.ParamTypeCatRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.ParamTypeCatRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["Msg"]);
                        if (result["State"]) {
                            $("#ParamTypeCat_IdParamTypeCat").val(result["IdParamTypeCat"]);
                            // alert(da.ParamTypeCatRead.ParentObj);
                            if (da.ParamTypeCatRead.ParentObj) {
                                //ParentObj: "ParamTypeCatTree", ParentObjType: "Tree"
                                //ObjNam, ObjType="Tlist", fun, data=null
                                da.RefreshObj(da.ParamTypeCatRead.ParentObj, da.ParamTypeCatRead
                                    .ParentObjType, "Refresh");
                            }
                            if (da.ParamTypeCatRead.RefPanels && da.ParamTypeCatRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.ParamTypeCatRead.RefPanels, "SetParamTypeCat", da.ParamTypeCatRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.ParamTypeCatRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.ParamTypeCatRead.FailMsg, "Info");
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
    da.ParamTypeCatRead.Clean();

    $("#ParamTypeCatBtns #btnSave").click(function() {
        da.ParamTypeCatRead.Save();
    });

    $("#ParamTypeCatBtns #btnRefresh").click(function() {
        da.ParamTypeCatRead.Refresh();
    });

    $("#ParamTypeCatBtns #btnDelete").click(function() {
        da.ParamTypeCatRead.Delete();
    });

    $("#ParamTypeCatBtns #btnNew").click(function() {
        da.ParamTypeCatRead.Clean();
    });

    $("#ParamTypeCatBtns #btnNewChild").click(function() {
        da.ParamTypeCatRead.CleanParent();
    });

    $("#ParamTypeCatBtns #btnChangeParent").click(function() {
        da.ParamTypeCatRead.ChangeParent();
    });

    $("#ParamTypeCat_Nam").keyup(function(event) {
        da.ParamTypeCatRead.btnControl();
    });
    $("#ParamTypeCat_Descr").keyup(function(event) {
        da.ParamTypeCatRead.btnControl();
    });

})
</script>