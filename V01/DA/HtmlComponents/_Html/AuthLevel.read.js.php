<script type="text/javascript" ref="readAuthLevel">
da.AuthLevelRead = {

    PanelTag: 'AuthLevel_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdAuthLevel: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.AuthLevelRead.Mode == 'alone') {
            $("#AuthLevelBtns #btnNew").hide();
        }

        if ($("#AuthLevel_IdAuthLevel").val() == "") {
            $("#AuthLevelBtns #btnRefresh").attr("disabled", true);
            $("#AuthLevelBtns #btnDelete").attr("disabled", true);
        } else {
            $("#AuthLevelBtns #btnRefresh").attr("disabled", false);
            $("#AuthLevelBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#AuthLevel_Nam").val() == "" &&
            $("#AuthLevel_Descr").val() == "" &&
            $("#AuthLevel_AuthLevel").val() == ""
        ) {
            $("#AuthLevelBtns #btnSave").attr("disabled", true);
        } else {
            $("#AuthLevelBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdAuthLevel: $("#AuthLevel_IdAuthLevel").val(),
            Nam: $("#AuthLevel_Nam").val(),
            Descr: $("#AuthLevel_Descr").val(),
            AuthLevel: $("#AuthLevel_AuthLevel").val()
        };
        return data;
    },


    Set: function(data) {
        $("#AuthLevel_IdAuthLevel").val(data["IdAuthLevel"]);
        $("#AuthLevel_Nam").val(data["Nam"]);
        $("#AuthLevel_Descr").val(data["Descr"]);
        $("#AuthLevel_AuthLevel").val(data["AuthLevel"]);

        da.AuthLevelRead.btnControl();
    },

    Clean: function() {
        $("#AuthLevel_IdAuthLevel").val("");
        $("#AuthLevel_Nam").val("");
        $("#AuthLevel_Descr").val("");
        $("#AuthLevel_AuthLevel").val('0'); // default

        da.AuthLevelRead.btnControl();
    },

    Refresh: function() {
        try {
            // alert("IdAuthLevel: "+ da.AuthLevelRead.IdAuthLevel);
            if (da.AuthLevelRead.IdAuthLevel && da.AuthLevelRead.IdAuthLevel != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/AuthLevel/Read.proxy.php?IdAuthLevel=" + da.AuthLevelRead
                        .IdAuthLevel,
                    dataType: "json",
                    error: function(result) {
                        da.UsrMsgShow(da.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            data = result["Data"];
                            da.AuthLevelRead.Set(data);
                        } else {
                            da.UsrMsgShow(da.AuthLevelRead.FailMsg, "Info");
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
            Id = $("#AuthLevel_IdAuthLevel").val();
            Nam = $("#AuthLevel_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/AuthLevel/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdAuthLevel: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.AuthLevelRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.AuthLevelRead.ParentObj) {
                                da.RefreshObj(da.AuthLevelRead.ParentObj);
                            }
                            da.UsrMsgShow(da.AuthLevelRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.AuthLevelRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.AuthLevelRead.CompulsoryFields, da.AuthLevelRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/AuthLevel/Save.proxy.php",
                    dataType: "json",
                    data: da.AuthLevelRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.AuthLevelRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#AuthLevel_IdAuthLevel").val(result["IdAuthLevel"]);
                            if (da.AuthLevelRead.ParentObj) {
                                da.RefreshObj(da.AuthLevelRead.ParentObj);
                            }
                            da.UsrMsgShow(da.AuthLevelRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.AuthLevelRead.FailMsg, "Info");
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
    da.AuthLevelRead.Clean();

    $("#AuthLevelBtns #btnSave").click(function() {
        da.AuthLevelRead.Save();
    });

    $("#AuthLevelBtns #btnRefresh").click(function() {
        da.AuthLevelRead.Refresh();
    });

    $("#AuthLevelBtns #btnDelete").click(function() {
        da.AuthLevelRead.Delete();
    });

    $("#AuthLevelBtns #btnNew").click(function() {
        da.AuthLevelRead.Clean();
    });

    $("#AuthLevel_Nam").keyup(function(event) {
        da.AuthLevelRead.btnControl();
    });
    $("#AuthLevel_Descr").keyup(function(event) {
        da.AuthLevelRead.btnControl();
    });
    $("#AuthLevel_AuthLevel").keyup(function(event) {
        da.AuthLevelRead.btnControl();
    });

})
</script>