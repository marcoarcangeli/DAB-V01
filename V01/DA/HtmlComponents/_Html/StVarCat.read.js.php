<script type="text/javascript" ref="da.StVarCatRead">
da.StVarCatRead = {

    whoIAm: 'StVarCat',
    PanelTag: this.whoIAm + '_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdStVarCat: '',
    ChangePar: false,
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.StVarCatRead.Mode == 'alone') {
            $("#StVarCatBtns #btnNew").hide();
        }

        if ($("#StVarCat_IdStVarCat").val() == "") {
            $("#StVarCatBtns #btnRefresh").attr("disabled", true);
            $("#StVarCatBtns #btnDelete").attr("disabled", true);
            $("#StVarCatBtns #btnNewChild").attr("disabled", true);
            $("#StVarCatBtns #btnChangeParent").attr("disabled", true);
        } else {
            $("#StVarCatBtns #btnRefresh").attr("disabled", false);
            $("#StVarCatBtns #btnDelete").attr("disabled", false);
            $("#StVarCatBtns #btnNewChild").attr("disabled", false);
            $("#StVarCatBtns #btnChangeParent").attr("disabled", false);
        }

        if (
            $("#StVarCat_Nam").val() == "" &&
            $("#StVarCat_Descr").val() == ""
        ) {
            $("#StVarCatBtns #btnSave").attr("disabled", true);
        } else {
            $("#StVarCatBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdStVarCat: $("#StVarCat_IdStVarCat").val(),
            IdStVarCatPar: $("#StVarCat_IdStVarCatPar").val(),
            Nam: $("#StVarCat_Nam").val(),
            Descr: $("#StVarCat_Descr").val()
        };
        return data;
    },


    Set: function(data) {
        $("#StVarCat_IdStVarCat").val(data["IdStVarCat"]);
        $("#StVarCat_IdStVarCatPar").val(data["IdStVarCatPar"]);
        $("#StVarCat_StVarCatParNam").val(data["StVarCatParNam"]);
        $("#StVarCat_Nam").val(data["Nam"]);
        $("#StVarCat_Descr").val(data["Descr"]);

        da.StVarCatRead.btnControl();
    },

    SetStVarCatPar: function(data) {
        $("#StVarCat_IdStVarCatPar").val(data["IdStVarCat"]);
        $("#StVarCat_StVarCatParNam").val(data["StVarCatNam"]);

        $("#StVarCatBtns #btnChangeParent").removeClass("btn-danger")
        $("#StVarCatBtns #btnChangeParent").addClass("btn-outline-primary");

    },

    Clean: function() {
        $("#StVarCat_IdStVarCat").val("");
        $("#StVarCat_IdStVarCatPar").val("");
        $("#StVarCat_StVarCatParNam").val("");
        $("#StVarCat_Nam").val("");
        $("#StVarCat_Descr").val("");

        da.StVarCatRead.btnControl();
    },

    ChangeParent: function() {
        if (da.StVarCatRead.ParentObj) {
            // alert("ChangeParent")
            //change 
            if (da.StVarCatRead.ChangePar) {
                da.StVarCatRead.ChangePar = false;
                $("#StVarCatBtns #btnChangeParent").removeClass("btn-danger")
                $("#StVarCatBtns #btnChangeParent").addClass("btn-outline-primary");
            } else {
                da.StVarCatRead.ChangePar = true;
                $("#StVarCatBtns #btnChangeParent").removeClass("btn-outline-primary")
                $("#StVarCatBtns #btnChangeParent").addClass("btn-danger");
                alert("Select a new Parent in the left tree.");
            }
            da.RefreshObj(da.StVarCatRead.ParentObj, da.StVarCatRead.ParentObjType, "ChangeParent");
            da.StVarCatRead.btnControl();
        }
    },

    CleanParent: function() {
        $("#StVarCat_IdStVarCatPar").val($("#StVarCat_IdStVarCat").val());
        $("#StVarCat_IdStVarCat").val("");
        $("#StVarCat_Nam").val("");
        $("#StVarCat_Descr").val("");

        da.StVarCatRead.btnControl();
    },

    Refresh: function() {
        try {
            if (da.StVarCatRead.IdStVarCat && da.StVarCatRead.IdStVarCat != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/StVarCat/read.proxy.php?IdStVarCat=" + da.StVarCatRead
                        .IdStVarCat,
                    dataType: "json",
                    error: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        da.UsrMsgShow(da.StVarCatRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data = result["Data"];
                        // alert("success: "+data["IdUsr"]);
                        da.StVarCatRead.Set(data);
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
            Id = $("#StVarCat_IdStVarCat").val();
            Nam = $("#StVarCat_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/StVarCat/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdStVarCat: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.StVarCatRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.StVarCatRead.ParentObj) {
                                da.RefreshObj(da.StVarCatRead.ParentObj, da.StVarCatRead
                                    .ParentObjType, "Refresh");
                            }
                            if (da.StVarCatRead.RefPanels && da.StVarCatRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.StVarCatRead.RefPanels, "CleanStVarCat");
                            }
                            da.UsrMsgShow(da.StVarCatRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.StVarCatRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.StVarCatRead.CompulsoryFields, da.StVarCatRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/StVarCat/Save.proxy.php",
                    dataType: "json",
                    data: da.StVarCatRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.StVarCatRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["Msg"]);
                        if (result["State"]) {
                            $("#StVarCat_IdStVarCat").val(result["IdStVarCat"]);
                            // alert(da.StVarCatRead.ParentObj);
                            if (da.StVarCatRead.ParentObj) {
                                //ParentObj: "StVarCatTree", ParentObjType: "Tree"
                                //ObjNam, ObjType="Tlist", fun, data=null
                                da.RefreshObj(da.StVarCatRead.ParentObj, da.StVarCatRead
                                    .ParentObjType, "Refresh");
                            }
                            if (da.StVarCatRead.RefPanels && da.StVarCatRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.StVarCatRead.RefPanels, "SetStVarCat", da.StVarCatRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.StVarCatRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.StVarCatRead.FailMsg, "Info");
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
    da.StVarCatRead.Clean();

    $("#StVarCatBtns #btnSave").click(function() {
        da.StVarCatRead.Save();
    });

    $("#StVarCatBtns #btnRefresh").click(function() {
        da.StVarCatRead.Refresh();
    });

    $("#StVarCatBtns #btnDelete").click(function() {
        da.StVarCatRead.Delete();
    });

    $("#StVarCatBtns #btnNew").click(function() {
        da.StVarCatRead.Clean();
    });

    $("#StVarCatBtns #btnNewChild").click(function() {
        da.StVarCatRead.CleanParent();
    });

    $("#StVarCatBtns #btnChangeParent").click(function() {
        da.StVarCatRead.ChangeParent();
    });

    $("#StVarCat_Nam").keyup(function(event) {
        da.StVarCatRead.btnControl();
    });
    $("#StVarCat_Descr").keyup(function(event) {
        da.StVarCatRead.btnControl();
    });

})
</script>