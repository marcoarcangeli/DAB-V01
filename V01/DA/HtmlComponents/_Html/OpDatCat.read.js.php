<script type="text/javascript" ref="da.OpDatCatRead">
da.OpDatCatRead = {

    whoIAm: 'OpDatCat',
    PanelTag: this.whoIAm + '_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdOpDatCat: '',
    ChangePar: false,
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.OpDatCatRead.Mode == 'alone') {
            $("#OpDatCatBtns #btnNew").hide();
        }

        if ($("#OpDatCat_IdOpDatCat").val() == "") {
            $("#OpDatCatBtns #btnRefresh").attr("disabled", true);
            $("#OpDatCatBtns #btnDelete").attr("disabled", true);
            $("#OpDatCatBtns #btnChangeParent").attr("disabled", true);
        } else {
            $("#OpDatCatBtns #btnRefresh").attr("disabled", false);
            $("#OpDatCatBtns #btnDelete").attr("disabled", false);
            $("#OpDatCatBtns #btnNewChild").attr("disabled", false);
            $("#OpDatCatBtns #btnChangeParent").attr("disabled", false);
        }

        if (
            $("#OpDatCat_Nam").val() == "" &&
            $("#OpDatCat_Descr").val() == ""
        ) {
            $("#OpDatCatBtns #btnSave").attr("disabled", true);
        } else {
            $("#OpDatCatBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdOpDatCat: $("#OpDatCat_IdOpDatCat").val(),
            IdOpDatCatPar: $("#OpDatCat_IdOpDatCatPar").val(),
            Nam: $("#OpDatCat_Nam").val(),
            Descr: $("#OpDatCat_Descr").val()
        };
        return data;
    },


    Set: function(data) {
        $("#OpDatCat_IdOpDatCat").val(data["IdOpDatCat"]);
        $("#OpDatCat_IdOpDatCatPar").val(data["IdOpDatCatPar"]);
        $("#OpDatCat_Nam").val(data["Nam"]);
        $("#OpDatCat_Descr").val(data["Descr"]);

        da.OpDatCatRead.btnControl();
    },

    SetOpDatCatPar: function(data) {
        $("#OpDatCat_IdOpDatCatPar").val(data["IdOpDatCat"]);
        $("#OpDatCat_OpDatCatParNam").val(data["OpDatCatNam"]);

        $("#OpDatCatBtns #btnChangeParent").removeClass("btn-danger")
        $("#OpDatCatBtns #btnChangeParent").addClass("btn-outline-primary");

    },

    Clean: function() {
        $("#OpDatCat_IdOpDatCat").val("");
        $("#OpDatCat_IdOpDatCatPar").val("");
        $("#OpDatCat_OpDatCatParNam").val('');
        $("#OpDatCat_Nam").val("");
        $("#OpDatCat_Descr").val("");

        da.OpDatCatRead.btnControl();
    },

    ChangeParent: function() {
        if (da.OpDatCatRead.ParentObj) {
            // alert("ChangeParent")
            //change 
            if (da.OpDatCatRead.ChangePar) {
                da.OpDatCatRead.ChangePar = false;
                $("#OpDatCatBtns #btnChangeParent").removeClass("btn-danger")
                $("#OpDatCatBtns #btnChangeParent").addClass("btn-outline-primary");
            } else {
                da.OpDatCatRead.ChangePar = true;
                $("#OpDatCatBtns #btnChangeParent").removeClass("btn-outline-primary")
                $("#OpDatCatBtns #btnChangeParent").addClass("btn-danger");
                alert("Select a new Parent in the left tree.");
            }
            da.RefreshObj(da.OpDatCatRead.ParentObj, da.OpDatCatRead.ParentObjType, "ChangeParent");
            da.OpDatCatRead.btnControl();
        }
    },

    CleanParent: function() {
        $("#OpDatCat_IdOpDatCatPar").val($("#OpDatCat_IdOpDatCat").val());
        $("#OpDatCat_IdOpDatCat").val("");
        $("#OpDatCat_Nam").val("");
        $("#OpDatCat_Descr").val("");

        da.OpDatCatRead.btnControl();
    },

    Refresh: function() {
        try {
            return $.ajax({
                type: "GET",
                url: "DA/HtmlComponents/OpDatCat/read.proxy.php?IdOpDatCat=" + da.OpDatCatRead
                    .IdOpDatCat,
                dataType: "json",
                error: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    da.UsrMsgShow(da.OpDatCatRead.FailMsg, "Info");
                },
                success: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    data = result["Data"];
                    // alert("success: "+data["IdUsr"]);
                    da.OpDatCatRead.Set(data);
                    // da.UsrMsgShow(da.UsrRead.SuccessMsg, "Info");
                },
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#OpDatCat_IdOpDatCat").val();
            Nam = $("#OpDatCat_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/OpDatCat/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdOpDatCat: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.OpDatCatRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.OpDatCatRead.ParentObj) {
                                da.RefreshObj(da.OpDatCatRead.ParentObj, da.OpDatCatRead
                                    .ParentObjType, "Refresh");
                            }
                            if (da.OpDatCatRead.RefPanels && da.OpDatCatRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.OpDatCatRead.RefPanels, "CleanOpDatCat");
                            }
                            da.UsrMsgShow(da.OpDatCatRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.OpDatCatRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.OpDatCatRead.CompulsoryFields, da.OpDatCatRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/OpDatCat/Save.proxy.php",
                    dataType: "json",
                    data: da.OpDatCatRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.OpDatCatRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["Msg"]);
                        if (result["State"]) {
                            $("#OpDatCat_IdOpDatCat").val(result["IdOpDatCat"]);
                            // alert(da.OpDatCatRead.ParentObj);
                            if (da.OpDatCatRead.ParentObj) {
                                //ParentObj: "OpDatCatTree", ParentObjType: "Tree"
                                //ObjNam, ObjType="Tlist", fun, data=null
                                da.RefreshObj(da.OpDatCatRead.ParentObj, da.OpDatCatRead
                                    .ParentObjType, "Refresh");
                            }
                            if (da.OpDatCatRead.RefPanels && da.OpDatCatRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.OpDatCatRead.RefPanels, "SetOpDatCat", da.OpDatCatRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.OpDatCatRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.OpDatCatRead.FailMsg, "Info");
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
    da.OpDatCatRead.Clean();

    $("#OpDatCatBtns #btnSave").click(function() {
        da.OpDatCatRead.Save();
    });

    $("#OpDatCatBtns #btnRefresh").click(function() {
        da.OpDatCatRead.Refresh();
    });

    $("#OpDatCatBtns #btnDelete").click(function() {
        da.OpDatCatRead.Delete();
    });

    $("#OpDatCatBtns #btnNew").click(function() {
        da.OpDatCatRead.Clean();
    });

    $("#OpDatCatBtns #btnNewChild").click(function() {
        da.OpDatCatRead.CleanParent();
    });

    $("#OpDatCatBtns #btnChangeParent").click(function() {
        da.OpDatCatRead.ChangeParent();
    });

    $("#OpDatCat_Nam").keyup(function(event) {
        da.OpDatCatRead.btnControl();
    });
    $("#OpDatCat_Descr").keyup(function(event) {
        da.OpDatCatRead.btnControl();
    });

})
</script>