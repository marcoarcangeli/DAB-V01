<script type="text/javascript" ref="da.AlgCatRead">
da.AlgCatRead = {

    PanelTag: 'AlgCat_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdAlgCat: '',
    ChangePar: false,
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.AlgCatRead.Mode == 'alone') {
            $("#AlgCatBtns #btnNew").hide();
        }

        if ($("#AlgCat_IdAlgCat").val() == "") {
            $("#AlgCatBtns #btnRefresh").attr("disabled", true);
            $("#AlgCatBtns #btnDelete").attr("disabled", true);
            $("#AlgCatBtns #btnNewChild").attr("disabled", true);
            $("#AlgCatBtns #btnChangeParent").attr("disabled", true);
        } else {
            $("#AlgCatBtns #btnRefresh").attr("disabled", false);
            $("#AlgCatBtns #btnDelete").attr("disabled", false);
            $("#AlgCatBtns #btnNewChild").attr("disabled", false);
            $("#AlgCatBtns #btnChangeParent").attr("disabled", false);
        }

        if (
            $("#AlgCat_Nam").val() == "" &&
            $("#AlgCat_Descr").val() == ""
        ) {
            $("#AlgCatBtns #btnSave").attr("disabled", true);
        } else {
            $("#AlgCatBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdAlgCat: $("#AlgCat_IdAlgCat").val(),
            IdAlgCatPar: $("#AlgCat_IdAlgCatPar").val(),
            Nam: $("#AlgCat_Nam").val(),
            Descr: $("#AlgCat_Descr").val()
        };
        return data;
    },


    Set: function(data) {
        $("#AlgCat_IdAlgCat").val(data["IdAlgCat"]);
        $("#AlgCat_IdAlgCatPar").val(data["IdAlgCatPar"]);
        $("#AlgCat_AlgCatParNam").val(data["AlgCatParNam"]);
        $("#AlgCat_Nam").val(data["Nam"]);
        $("#AlgCat_Descr").val(data["Descr"]);

        da.AlgCatRead.btnControl();
    },

    SetAlgCatPar: function(data) {
        $("#AlgCat_IdAlgCatPar").val(data["IdAlgCat"]);
        $("#AlgCat_AlgCatParNam").val(data["AlgCatNam"]);

        $("#AlgCatBtns #btnChangeParent").removeClass("btn-danger")
        $("#AlgCatBtns #btnChangeParent").addClass("btn-outline-primary");

    },

    Clean: function() {
        $("#AlgCat_IdAlgCat").val("");
        $("#AlgCat_IdAlgCatPar").val("");
        $("#AlgCat_AlgCatParNam").val("");
        $("#AlgCat_Nam").val("");
        $("#AlgCat_Descr").val("");

        da.AlgCatRead.btnControl();
    },

    ChangeParent: function() {
        if (da.AlgCatRead.ParentObj) {
            // alert("ChangeParent")
            //change 
            if (da.AlgCatRead.ChangePar) {
                da.AlgCatRead.ChangePar = false;
                $("#AlgCatBtns #btnChangeParent").removeClass("btn-danger")
                $("#AlgCatBtns #btnChangeParent").addClass("btn-outline-primary");
            } else {
                da.AlgCatRead.ChangePar = true;
                $("#AlgCatBtns #btnChangeParent").removeClass("btn-outline-primary")
                $("#AlgCatBtns #btnChangeParent").addClass("btn-danger");
                alert("Select a new Parent in the left tree.");
            }
            da.RefreshObj(da.AlgCatRead.ParentObj, da.AlgCatRead.ParentObjType, "ChangeParent");
            da.AlgCatRead.btnControl();
        }
    },

    CleanParent: function() {
        $("#AlgCat_IdAlgCatPar").val($("#AlgCat_IdAlgCat").val());
        $("#AlgCat_IdAlgCat").val("");
        $("#AlgCat_Nam").val("");
        $("#AlgCat_Descr").val("");

        da.AlgCatRead.btnControl();
    },

    Refresh: function() {
        try {
            return $.ajax({
                type: "GET",
                url: "DA/HtmlComponents/AlgCat/read.proxy.php?IdAlgCat=" + da.AlgCatRead.IdAlgCat,
                dataType: "json",
                error: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    da.UsrMsgShow(da.AlgCatRead.FailMsg, "Info");
                },
                success: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    data = result["Data"];
                    // alert("success: "+data["IdUsr"]);
                    da.AlgCatRead.Set(data);
                    // da.UsrMsgShow(da.UsrRead.SuccessMsg, "Info");
                },
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#AlgCat_IdAlgCat").val();
            Nam = $("#AlgCat_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/AlgCat/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdAlgCat: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.AlgCatRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.AlgCatRead.ParentObj) {
                                da.RefreshObj(da.AlgCatRead.ParentObj, da.AlgCatRead.ParentObjType,
                                    "Refresh");
                            }
                            da.UsrMsgShow(da.AlgCatRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.AlgCatRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.AlgCatRead.CompulsoryFields, da.AlgCatRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/AlgCat/Save.proxy.php",
                    dataType: "json",
                    data: da.AlgCatRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.AlgCatRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["Msg"]);
                        if (result["State"]) {
                            $("#AlgCat_IdAlgCat").val(result["IdAlgCat"]);
                            // alert(da.AlgCatRead.ParentObj);
                            if (da.AlgCatRead.ParentObj) {
                                //ParentObj: "AlgCatTree", ParentObjType: "Tree"
                                //ObjNam, ObjType="Tlist", fun, data=null
                                da.RefreshObj(da.AlgCatRead.ParentObj, da.AlgCatRead.ParentObjType,
                                    "Refresh");
                            }
                            da.UsrMsgShow(da.AlgCatRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.AlgCatRead.FailMsg, "Info");
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
    da.AlgCatRead.Clean();

    $("#AlgCatBtns #btnSave").click(function() {
        da.AlgCatRead.Save();
    });

    $("#AlgCatBtns #btnRefresh").click(function() {
        da.AlgCatRead.Refresh();
    });

    $("#AlgCatBtns #btnDelete").click(function() {
        da.AlgCatRead.Delete();
    });

    $("#AlgCatBtns #btnNew").click(function() {
        da.AlgCatRead.Clean();
    });

    $("#AlgCatBtns #btnNewChild").click(function() {
        da.AlgCatRead.CleanParent();
    });

    $("#AlgCatBtns #btnChangeParent").click(function() {
        da.AlgCatRead.ChangeParent();
    });

    $("#AlgCat_Nam").keyup(function(event) {
        da.AlgCatRead.btnControl();
    });
    $("#AlgCat_Descr").keyup(function(event) {
        da.AlgCatRead.btnControl();
    });

})
</script>