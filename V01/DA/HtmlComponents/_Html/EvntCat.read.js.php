<script type="text/javascript" ref="da.EvntCatRead">
da.EvntCatRead = {

    PanelTag: 'EvntCat_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdEvntCat: '',
    ChangePar: false,
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.EvntCatRead.Mode == 'alone') {
            $("#EvntCatBtns #btnNew").hide();
        }

        if ($("#EvntCat_IdEvntCat").val() == "") {
            $("#EvntCatBtns #btnRefresh").attr("disabled", true);
            $("#EvntCatBtns #btnDelete").attr("disabled", true);
            $("#EvntCatBtns #btnNewChild").attr("disabled", true);
            $("#EvntCatBtns #btnChangeParent").attr("disabled", true);
        } else {
            $("#EvntCatBtns #btnRefresh").attr("disabled", false);
            $("#EvntCatBtns #btnDelete").attr("disabled", false);
            $("#EvntCatBtns #btnNewChild").attr("disabled", false);
            $("#EvntCatBtns #btnChangeParent").attr("disabled", false);
        }

        if (
            $("#EvntCat_Nam").val() == "" &&
            $("#EvntCat_Descr").val() == ""
        ) {
            $("#EvntCatBtns #btnSave").attr("disabled", true);
        } else {
            $("#EvntCatBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdEvntCat: $("#EvntCat_IdEvntCat").val(),
            IdEvntCatPar: $("#EvntCat_IdEvntCatPar").val(),
            Nam: $("#EvntCat_Nam").val(),
            Descr: $("#EvntCat_Descr").val()
        };
        return data;
    },

    Set: function(data) {
        $("#EvntCat_IdEvntCat").val(data["IdEvntCat"]);
        $("#EvntCat_IdEvntCatPar").val(data["IdEvntCatPar"]);
        $("#EvntCat_EvntCatParNam").val(data["EvntCatParNam"]);
        $("#EvntCat_Nam").val(data["Nam"]);
        $("#EvntCat_Descr").val(data["Descr"]);

        da.EvntCatRead.btnControl();
    },

    SetEvntCatPar: function(data) {
        $("#EvntCat_IdEvntCatPar").val(data["IdEvntCat"]);
        $("#EvntCat_EvntCatParNam").val(data["EvntCatNam"]);

        $("#EvntCatBtns #btnChangeParent").removeClass("btn-danger")
        $("#EvntCatBtns #btnChangeParent").addClass("btn-outline-primary");

    },

    Clean: function() {
        $("#EvntCat_IdEvntCat").val("");
        $("#EvntCat_IdEvntCatPar").val("");
        $("#EvntCat_EvntCatParNam").val("");
        $("#EvntCat_Nam").val("");
        $("#EvntCat_Descr").val("");

        da.EvntCatRead.btnControl();
    },

    ChangeParent: function() {
        if (da.EvntCatRead.ParentObj) {
            // alert("ChangeParent")
            //change 
            if (da.EvntCatRead.ChangePar) {
                da.EvntCatRead.ChangePar = false;
                $("#EvntCatBtns #btnChangeParent").removeClass("btn-danger")
                $("#EvntCatBtns #btnChangeParent").addClass("btn-outline-primary");
            } else {
                da.EvntCatRead.ChangePar = true;
                $("#EvntCatBtns #btnChangeParent").removeClass("btn-outline-primary")
                $("#EvntCatBtns #btnChangeParent").addClass("btn-danger");
                alert("Select a new Parent in the left tree.");
            }
            da.RefreshObj(da.EvntCatRead.ParentObj, da.EvntCatRead.ParentObjType, "ChangeParent");
            da.EvntCatRead.btnControl();
        }
    },

    CleanParent: function() {
        $("#EvntCat_IdEvntCatPar").val($("#EvntCat_IdEvntCat").val());
        $("#EvntCat_IdEvntCat").val("");
        $("#EvntCat_Nam").val("");
        $("#EvntCat_Descr").val("");

        da.EvntCatRead.btnControl();
    },

    Refresh: function() {
        try {
            if (da.EvntCatRead.IdEvntCat && da.EvntCatRead.IdEvntCat != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/EvntCat/read.proxy.php?IdEvntCat=" + da.EvntCatRead
                        .IdEvntCat,
                    dataType: "json",
                    error: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        da.UsrMsgShow(da.EvntCatRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data = result["Data"];
                        // alert("success: "+data["IdUsr"]);
                        da.EvntCatRead.Set(data);
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
            Id = $("#EvntCat_IdEvntCat").val();
            Nam = $("#EvntCat_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/EvntCat/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdEvntCat: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.EvntCatRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.EvntCatRead.ParentObj) {
                                da.RefreshObj(da.EvntCatRead.ParentObj, da.EvntCatRead
                                    .ParentObjType, "Refresh");
                            }
                            if (da.EvntCatRead.RefPanels && da.EvntCatRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.EvntCatRead.RefPanels, "CleanEvntCat");
                            }
                            da.UsrMsgShow(da.EvntCatRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.EvntCatRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.EvntCatRead.CompulsoryFields, da.EvntCatRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/EvntCat/Save.proxy.php",
                    dataType: "json",
                    data: da.EvntCatRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.EvntCatRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["Msg"]);
                        if (result["State"]) {
                            $("#EvntCat_IdEvntCat").val(result["IdEvntCat"]);
                            // alert(da.EvntCatRead.ParentObj);
                            if (da.EvntCatRead.ParentObj) {
                                //ParentObj: "EvntCatTree", ParentObjType: "Tree"
                                //ObjNam, ObjType="Tlist", fun, data=null
                                da.RefreshObj(da.EvntCatRead.ParentObj, da.EvntCatRead
                                    .ParentObjType, "Refresh");
                            }
                            if (da.EvntCatRead.RefPanels && da.EvntCatRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.EvntCatRead.RefPanels, "SetEvntCat", da.EvntCatRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.EvntCatRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.EvntCatRead.FailMsg, "Info");
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
    da.EvntCatRead.Clean();

    $("#EvntCatBtns #btnSave").click(function() {
        da.EvntCatRead.Save();
    });

    $("#EvntCatBtns #btnRefresh").click(function() {
        da.EvntCatRead.Refresh();
    });

    $("#EvntCatBtns #btnDelete").click(function() {
        da.EvntCatRead.Delete();
    });

    $("#EvntCatBtns #btnNew").click(function() {
        da.EvntCatRead.Clean();
    });

    $("#EvntCatBtns #btnNewChild").click(function() {
        da.EvntCatRead.CleanParent();
    });

    $("#EvntCatBtns #btnChangeParent").click(function() {
        da.EvntCatRead.ChangeParent();
    });

    $("#EvntCat_Nam").keyup(function(event) {
        da.EvntCatRead.btnControl();
    });
    $("#EvntCat_Descr").keyup(function(event) {
        da.EvntCatRead.btnControl();
    });

})
</script>