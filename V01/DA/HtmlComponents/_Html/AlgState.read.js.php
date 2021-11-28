<script type="text/javascript" ref="readAlgState">
da.AlgStateRead = {

    PanelTag: 'AlgState_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdAlgState: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.AlgStateRead.Mode == 'alone') {
            $("#AlgStateBtns #btnNew").hide();
        }

        if ($("#AlgState_IdAlgState").val() == "") {
            $("#AlgStateBtns #btnRefresh").attr("disabled", true);
            $("#AlgStateBtns #btnDelete").attr("disabled", true);
        } else {
            $("#AlgStateBtns #btnRefresh").attr("disabled", false);
            $("#AlgStateBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#AlgState_Nam").val() == "" &&
            $("#AlgState_Descr").val() == ""
        ) {
            $("#AlgStateBtns #btnSave").attr("disabled", true);
        } else {
            $("#AlgStateBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdAlgState: $("#AlgState_IdAlgState").val(),
            Nam: $("#AlgState_Nam").val(),
            Descr: $("#AlgState_Descr").val()
        };
        return data;
    },


    Set: function(data) {
        $("#AlgState_IdAlgState").val(data["IdAlgState"]);
        $("#AlgState_Nam").val(data["Nam"]);
        $("#AlgState_Descr").val(data["Descr"]);

        da.AlgStateRead.btnControl();
    },

    Clean: function() {
        $("#AlgState_IdAlgState").val("");
        $("#AlgState_Nam").val("");
        $("#AlgState_Descr").val("");

        da.AlgStateRead.btnControl();
    },

    CleanParent: function() {
        $("#AlgState_IdAlgState").val("");
        $("#AlgState_Nam").val("");
        $("#AlgState_Descr").val("");

        da.AlgStateRead.btnControl();
    },

    Refresh: function() {
        try {
            // alert("IdAlgState: "+ da.AlgStateRead.IdAlgState);
            if (da.AlgStateRead.IdAlgState && da.AlgStateRead.IdAlgState != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/AlgState/Read.proxy.php?IdAlgState=" + da.AlgStateRead
                        .IdAlgState,
                    dataType: "json",
                    error: function(result) {
                        da.UsrMsgShow(da.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            data = result["Data"];
                            da.AlgStateRead.Set(data);
                        } else {
                            da.UsrMsgShow(da.AlgStateRead.FailMsg, "Info");
                        }
                    },
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#AlgState_IdAlgState").val();
            Nam = $("#AlgState_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/AlgState/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdAlgState: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.AlgStateRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.AlgStateRead.ParentObj) {
                                da.RefreshObj(da.AlgStateRead.ParentObj);
                            }
                            da.UsrMsgShow(da.AlgStateRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.AlgStateRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.AlgStateRead.CompulsoryFields, da.AlgStateRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/AlgState/Save.proxy.php",
                    dataType: "json",
                    data: da.AlgStateRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.AlgStateRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#AlgState_IdAlgState").val(result["IdAlgState"]);
                            if (da.AlgStateRead.ParentObj) {
                                da.RefreshObj(da.AlgStateRead.ParentObj);
                            }
                            da.UsrMsgShow(da.AlgStateRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.AlgStateRead.FailMsg, "Info");
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
    da.AlgStateRead.Clean();

    $("#AlgStateBtns #btnSave").click(function() {
        da.AlgStateRead.Save();
    });

    $("#AlgStateBtns #btnRefresh").click(function() {
        da.AlgStateRead.Refresh();
    });

    $("#AlgStateBtns #btnDelete").click(function() {
        da.AlgStateRead.Delete();
    });

    $("#AlgStateBtns #btnNew").click(function() {
        da.AlgStateRead.Clean();
    });

    $("#AlgState_Nam").keyup(function(event) {
        da.AlgStateRead.btnControl();
    });
    $("#AlgState_Descr").keyup(function(event) {
        da.AlgStateRead.btnControl();
    });

})
</script>