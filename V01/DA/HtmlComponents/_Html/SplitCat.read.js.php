<script type="text/javascript" ref="da.SplitCatRead">
da.SplitCatRead = {

    whoIAm: 'SplitCat',
    PanelTag: this.whoIAm + '_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdSplitCat: '',
    ChangePar: false,
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.SplitCatRead.Mode == 'alone') {
            $("#SplitBtns #btnNew").hide();
        }

        if ($("#SplitCat_IdSplitCat").val() == "") {
            $("#SplitCatBtns #btnRefresh").attr("disabled", true);
            $("#SplitCatBtns #btnDelete").attr("disabled", true);
            $("#SplitCatBtns #btnNewChild").attr("disabled", true);
            $("#SplitCatBtns #btnChangeParent").attr("disabled", true);
        } else {
            $("#SplitCatBtns #btnRefresh").attr("disabled", false);
            $("#SplitCatBtns #btnDelete").attr("disabled", false);
            $("#SplitCatBtns #btnNewChild").attr("disabled", false);
            $("#SplitCatBtns #btnChangeParent").attr("disabled", false);
        }

        if (
            $("#SplitCat_Nam").val() == "" &&
            $("#SplitCat_Descr").val() == ""
        ) {
            $("#SplitCatBtns #btnSave").attr("disabled", true);
        } else {
            $("#SplitCatBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdSplitCat: $("#SplitCat_IdSplitCat").val(),
            IdSplitCatPar: $("#SplitCat_IdSplitCatPar").val(),
            Nam: $("#SplitCat_Nam").val(),
            Descr: $("#SplitCat_Descr").val()
        };
        return data;
    },


    Set: function(data) {
        $("#SplitCat_IdSplitCat").val(data["IdSplitCat"]);
        $("#SplitCat_IdSplitCatPar").val(data["IdSplitCatPar"]);
        $("#SplitCat_SplitCatParNam").val(data["SplitCatParNam"]);
        $("#SplitCat_Nam").val(data["Nam"]);
        $("#SplitCat_Descr").val(data["Descr"]);

        da.SplitCatRead.btnControl();
    },

    SetSplitCatPar: function(data) {
        $("#SplitCat_IdSplitCatPar").val(data["IdSplitCat"]);
        $("#SplitCat_SplitCatParNam").val(data["SplitCatNam"]);

        $("#SplitCatBtns #btnChangeParent").removeClass("btn-danger")
        $("#SplitCatBtns #btnChangeParent").addClass("btn-outline-primary");

    },

    Clean: function() {
        $("#SplitCat_IdSplitCat").val("");
        $("#SplitCat_IdSplitCatPar").val("");
        $("#SplitCat_SplitCatParNam").val("");
        $("#SplitCat_Nam").val("");
        $("#SplitCat_Descr").val("");

        da.SplitCatRead.btnControl();
    },

    ChangeParent: function() {
        if (da.SplitCatRead.ParentObj) {
            // alert("ChangeParent")
            //change 
            if (da.SplitCatRead.ChangePar) {
                da.SplitCatRead.ChangePar = false;
                $("#SplitCatBtns #btnChangeParent").removeClass("btn-danger")
                $("#SplitCatBtns #btnChangeParent").addClass("btn-outline-primary");
            } else {
                da.SplitCatRead.ChangePar = true;
                $("#SplitCatBtns #btnChangeParent").removeClass("btn-outline-primary")
                $("#SplitCatBtns #btnChangeParent").addClass("btn-danger");
                alert("Select a new Parent in the left tree.");
            }
            da.RefreshObj(da.SplitCatRead.ParentObj, da.SplitCatRead.ParentObjType, "ChangeParent");
            da.SplitCatRead.btnControl();
        }
    },

    CleanParent: function() {
        $("#SplitCat_IdSplitCatPar").val($("#SplitCat_IdSplitCat").val());
        $("#SplitCat_IdSplitCat").val("");
        $("#SplitCat_Nam").val("");
        $("#SplitCat_Descr").val("");

        da.SplitCatRead.btnControl();
    },

    Refresh: function() {
        try {
            if (da.SplitCatRead.IdSplitCat && da.SplitCatRead.IdSplitCat != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/SplitCat/read.proxy.php?IdSplitCat=" + da.SplitCatRead
                        .IdSplitCat,
                    dataType: "json",
                    error: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        da.UsrMsgShow(da.SplitCatRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data = result["Data"];
                        // alert("success: "+data["IdUsr"]);
                        da.SplitCatRead.Set(data);
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
            Id = $("#SplitCat_IdSplitCat").val();
            Nam = $("#SplitCat_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/SplitCat/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdSplitCat: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.SplitCatRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.SplitCatRead.ParentObj) {
                                da.RefreshObj(da.SplitCatRead.ParentObj, da.SplitCatRead
                                    .ParentObjType, "Refresh");
                            }
                            if (da.SplitCatRead.RefPanels && da.SplitCatRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.SplitCatRead.RefPanels, "CleanSplitCat");
                            }
                            da.UsrMsgShow(da.SplitCatRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.SplitCatRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.SplitCatRead.CompulsoryFields, da.SplitCatRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/SplitCat/Save.proxy.php",
                    dataType: "json",
                    data: da.SplitCatRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.SplitCatRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["Msg"]);
                        if (result["State"]) {
                            $("#SplitCat_IdSplitCat").val(result["IdSplitCat"]);
                            // alert(da.SplitCatRead.ParentObj);
                            if (da.SplitCatRead.ParentObj) {
                                //ParentObj: "SplitCatTree", ParentObjType: "Tree"
                                //ObjNam, ObjType="Tlist", fun, data=null
                                da.RefreshObj(da.SplitCatRead.ParentObj, da.SplitCatRead
                                    .ParentObjType, "Refresh");
                            }
                            if (da.SplitCatRead.RefPanels && da.SplitCatRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.SplitCatRead.RefPanels, "SetSplitCat", da.SplitCatRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.SplitCatRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.SplitCatRead.FailMsg, "Info");
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
    da.SplitCatRead.Clean();

    $("#SplitCatBtns #btnSave").click(function() {
        da.SplitCatRead.Save();
    });

    $("#SplitCatBtns #btnRefresh").click(function() {
        da.SplitCatRead.Refresh();
    });

    $("#SplitCatBtns #btnDelete").click(function() {
        da.SplitCatRead.Delete();
    });

    $("#SplitCatBtns #btnNew").click(function() {
        da.SplitCatRead.Clean();
    });

    $("#SplitCatBtns #btnNewChild").click(function() {
        da.SplitCatRead.CleanParent();
    });

    $("#SplitCatBtns #btnChangeParent").click(function() {
        da.SplitCatRead.ChangeParent();
    });

    $("#SplitCat_Nam").keyup(function(event) {
        da.SplitCatRead.btnControl();
    });
    $("#SplitCat_Descr").keyup(function(event) {
        da.SplitCatRead.btnControl();
    });

})
</script>