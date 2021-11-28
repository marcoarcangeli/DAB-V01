<script type="text/javascript" ref="da.FeatureCatRead">
da.FeatureCatRead = {

    PanelTag: 'FeatureCat_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdFeatureCat: '',
    ChangePar: false,
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.FeatureCatRead.Mode == 'alone') {
            $("#FeatureCatBtns #btnNew").hide();
        }

        if ($("#FeatureCat_IdFeatureCat").val() == "") {
            $("#FeatureCatBtns #btnRefresh").attr("disabled", true);
            $("#FeatureCatBtns #btnDelete").attr("disabled", true);
            $("#FeatureCatBtns #btnNewChild").attr("disabled", true);
            $("#FeatureCatBtns #btnChangeParent").attr("disabled", true);
        } else {
            $("#FeatureCatBtns #btnRefresh").attr("disabled", false);
            $("#FeatureCatBtns #btnDelete").attr("disabled", false);
            $("#FeatureCatBtns #btnNewChild").attr("disabled", false);
            $("#FeatureCatBtns #btnChangeParent").attr("disabled", false);
        }

        if (
            $("#FeatureCat_Nam").val() == "" &&
            $("#FeatureCat_Descr").val() == ""
        ) {
            $("#FeatureCatBtns #btnSave").attr("disabled", true);
        } else {
            $("#FeatureCatBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdFeatureCat: $("#FeatureCat_IdFeatureCat").val(),
            IdFeatureCatPar: $("#FeatureCat_IdFeatureCatPar").val(),
            Nam: $("#FeatureCat_Nam").val(),
            Descr: $("#FeatureCat_Descr").val()
        };
        return data;
    },


    Set: function(data) {
        $("#FeatureCat_IdFeatureCat").val(data["IdFeatureCat"]);
        $("#FeatureCat_IdFeatureCatPar").val(data["IdFeatureCatPar"]);
        $("#FeatureCat_FeatureCatParNam").val(data["FeatureCatParNam"]);
        $("#FeatureCat_Nam").val(data["Nam"]);
        $("#FeatureCat_Descr").val(data["Descr"]);

        da.FeatureCatRead.btnControl();
    },

    SetFeatureCatPar: function(data) {
        $("#FeatureCat_IdFeatureCatPar").val(data["IdFeatureCat"]);
        $("#FeatureCat_FeatureCatParNam").val(data["FeatureCatNam"]);

        $("#FeatureCatBtns #btnChangeParent").removeClass("btn-danger")
        $("#FeatureCatBtns #btnChangeParent").addClass("btn-outline-primary");

    },

    Clean: function() {
        $("#FeatureCat_IdFeatureCat").val("");
        $("#FeatureCat_IdFeatureCatPar").val("");
        $("#FeatureCat_FeatureCatParNam").val("");
        $("#FeatureCat_Nam").val("");
        $("#FeatureCat_Descr").val("");

        da.FeatureCatRead.btnControl();
    },

    ChangeParent: function() {
        if (da.FeatureCatRead.ParentObj) {
            // alert("ChangeParent")
            //change 
            if (da.FeatureCatRead.ChangePar) {
                da.FeatureCatRead.ChangePar = false;
                $("#FeatureCatBtns #btnChangeParent").removeClass("btn-danger")
                $("#FeatureCatBtns #btnChangeParent").addClass("btn-outline-primary");
            } else {
                da.FeatureCatRead.ChangePar = true;
                $("#FeatureCatBtns #btnChangeParent").removeClass("btn-outline-primary")
                $("#FeatureCatBtns #btnChangeParent").addClass("btn-danger");
                alert("Select a new Parent in the left tree.");
            }
            da.RefreshObj(da.FeatureCatRead.ParentObj, da.FeatureCatRead.ParentObjType, "ChangeParent");
            da.FeatureCatRead.btnControl();
        }
    },

    CleanParent: function() {
        $("#FeatureCat_IdFeatureCatPar").val($("#FeatureCat_IdFeatureCat").val());
        $("#FeatureCat_IdFeatureCat").val("");
        $("#FeatureCat_Nam").val("");
        $("#FeatureCat_Descr").val("");

        da.FeatureCatRead.btnControl();
    },

    Refresh: function() {
        try {
            return $.ajax({
                type: "GET",
                url: "DA/HtmlComponents/FeatureCat/read.proxy.php?IdFeatureCat=" + da.FeatureCatRead.IdFeatureCat,
                dataType: "json",
                error: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    da.UsrMsgShow(da.FeatureCatRead.FailMsg, "Info");
                },
                success: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    data = result["Data"];
                    // alert("success: "+data["IdUsr"]);
                    da.FeatureCatRead.Set(data);
                    // da.UsrMsgShow(da.UsrRead.SuccessMsg, "Info");
                },
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#FeatureCat_IdFeatureCat").val();
            Nam = $("#FeatureCat_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/FeatureCat/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdFeatureCat: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.FeatureCatRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.FeatureCatRead.ParentObj) {
                                da.RefreshObj(da.FeatureCatRead.ParentObj, da.FeatureCatRead.ParentObjType,
                                    "Refresh");
                            }
                            da.UsrMsgShow(da.FeatureCatRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.FeatureCatRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.FeatureCatRead.CompulsoryFields, da.FeatureCatRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/FeatureCat/Save.proxy.php",
                    dataType: "json",
                    data: da.FeatureCatRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.FeatureCatRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["Msg"]);
                        if (result["State"]) {
                            $("#FeatureCat_IdFeatureCat").val(result["IdFeatureCat"]);
                            // alert(da.FeatureCatRead.ParentObj);
                            if (da.FeatureCatRead.ParentObj) {
                                //ParentObj: "FeatureCatTree", ParentObjType: "Tree"
                                //ObjNam, ObjType="Tlist", fun, data=null
                                da.RefreshObj(da.FeatureCatRead.ParentObj, da.FeatureCatRead.ParentObjType,
                                    "Refresh");
                            }
                            da.UsrMsgShow(da.FeatureCatRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.FeatureCatRead.FailMsg, "Info");
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
    da.FeatureCatRead.Clean();

    $("#FeatureCatBtns #btnSave").click(function() {
        da.FeatureCatRead.Save();
    });

    $("#FeatureCatBtns #btnRefresh").click(function() {
        da.FeatureCatRead.Refresh();
    });

    $("#FeatureCatBtns #btnDelete").click(function() {
        da.FeatureCatRead.Delete();
    });

    $("#FeatureCatBtns #btnNew").click(function() {
        da.FeatureCatRead.Clean();
    });

    $("#FeatureCatBtns #btnNewChild").click(function() {
        da.FeatureCatRead.CleanParent();
    });

    $("#FeatureCatBtns #btnChangeParent").click(function() {
        da.FeatureCatRead.ChangeParent();
    });

    $("#FeatureCat_Nam").keyup(function(event) {
        da.FeatureCatRead.btnControl();
    });
    $("#FeatureCat_Descr").keyup(function(event) {
        da.FeatureCatRead.btnControl();
    });

})
</script>