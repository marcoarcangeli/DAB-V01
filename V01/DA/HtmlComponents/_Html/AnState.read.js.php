<script type="text/javascript" ref="da.AnStateRead">
da.AnStateRead = {

    whoIAm: 'AnState',
    PanelTag: this.whoIAm + '_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdAnState: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.AnStateRead.Mode == 'alone') {
            $("#AnStateBtns #btnNew").hide();
        }

        if ($("#AnState_IdAnState").val() == "") {
            $("#AnStateBtns #btnRefresh").attr("disabled", true);
            $("#AnStateBtns #btnDelete").attr("disabled", true);
        } else {
            $("#AnStateBtns #btnRefresh").attr("disabled", false);
            $("#AnStateBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#AnState_Nam").val() == "" &&
            $("#AnState_Descr").val() == ""
        ) {
            $("#AnStateBtns #btnSave").attr("disabled", true);
        } else {
            $("#AnStateBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdAnState: $("#AnState_IdAnState").val(),
            Nam: $("#AnState_Nam").val(),
            Descr: $("#AnState_Descr").val()
        };
        return data;
    },

    Set: function(data) {
        $("#AnState_IdAnState").val(data["IdAnState"]);
        $("#AnState_Nam").val(data["Nam"]);
        $("#AnState_Descr").val(data["Descr"]);

        da.AnStateRead.btnControl();
    },

    Clean: function() {
        $("#AnState_IdAnState").val("");
        $("#AnState_Nam").val("");
        $("#AnState_Descr").val("");

        da.AnStateRead.btnControl();
    },

    Refresh: function() {
        try {
            return $.ajax({
                type: "GET",
                url: "DA/HtmlComponents/AnState/Read.proxy.php?IdAnState=" + da.AnStateRead
                    .IdAnState,
                dataType: "json",
                error: function(result) {
                    da.UsrMsgShow(da.AnStateRead.FailMsg, "Error");
                },
                success: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    data = result["Data"];
                    da.AnStateRead.Set(data);
                },
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#AnState_IdAnState").val();
            Nam = $("#AnState_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/AnState/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdAnState: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.AnStateRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.AnStateRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.AnStateRead.ParentObj) {
                                da.RefreshObj(da.AnStateRead.ParentObj);
                            }
                            if (da.AnStateRead.RefPanels && da.AnStateRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.AnStateRead.RefPanels, "CleanAnState");
                            }
                            da.UsrMsgShow(da.AnStateRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.AnStateRead.FailMsg, "Info");
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
            // alert("Save");
            if (da.verifyCompulsoryFields(da.AnStateRead.CompulsoryFields, da.AnStateRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/AnState/Save.proxy.php",
                    dataType: "json",
                    data: da.AnStateRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.AnStateRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#AnState_IdAnState").val(result["IdAnState"]);
                            if (da.AnStateRead.ParentObj) {
                                da.RefreshObj(da.AnStateRead.ParentObj);
                            }
                            if (da.AnStateRead.RefPanels && da.AnStateRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.AnStateRead.RefPanels, "SetAnState", da.AnStateRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.AnStateRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.AnStateRead.FailMsg, "Info");
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
    da.AnStateRead.Clean();

    $("#AnStateBtns #btnSave").click(function() {
        da.AnStateRead.Save();
    });

    $("#AnStateBtns #btnRefresh").click(function() {
        da.AnStateRead.Refresh();
    });

    $("#AnStateBtns #btnDelete").click(function() {
        da.AnStateRead.Delete();
    });

    $("#AnStateBtns #btnNew").click(function() {
        da.AnStateRead.Clean();
    });

    $("#AnState_Nam").keyup(function(event) {
        da.AnStateRead.btnControl();
    });
    $("#AnState_Descr").keyup(function(event) {
        da.AnStateRead.btnControl();
    });

})
</script>