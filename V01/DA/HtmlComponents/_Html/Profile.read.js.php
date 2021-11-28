<script type="text/javascript" ref="readProfile">
da.ProfileRead = {

    PanelTag: 'Profile_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdProfile: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.ProfileRead.Mode == 'alone') {
            $("#ProfileBtns #btnNew").hide();
        }

        if ($("#Profile_IdProfile").val() == "") {
            $("#ProfileBtns #btnRefresh").attr("disabled", true);
            $("#ProfileBtns #btnDelete").attr("disabled", true);
        } else {
            $("#ProfileBtns #btnRefresh").attr("disabled", false);
            $("#ProfileBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#Profile_Nam").val() == "" &&
            $("#Profile_Descr").val() == ""
        ) {
            $("#ProfileBtns #btnSave").attr("disabled", true);
        } else {
            $("#ProfileBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdProfile: $("#Profile_IdProfile").val(),
            Nam: $("#Profile_Nam").val(),
            Descr: $("#Profile_Descr").val()
        };
        return data;
    },


    Set: function(data) {
        $("#Profile_IdProfile").val(data["IdProfile"]);
        $("#Profile_Nam").val(data["Nam"]);
        $("#Profile_Descr").val(data["Descr"]);

        da.ProfileRead.btnControl();
    },

    Clean: function() {
        $("#Profile_IdProfile").val("");
        $("#Profile_Nam").val("");
        $("#Profile_Descr").val("");

        da.ProfileRead.btnControl();
    },

    CleanParent: function() {
        $("#Profile_IdProfile").val("");
        $("#Profile_Nam").val("");
        $("#Profile_Descr").val("");

        da.ProfileRead.btnControl();
    },

    Refresh: function() {
        try {
            // alert("IdProfile: "+ da.ProfileRead.IdProfile);
            if (da.ProfileRead.IdProfile && da.ProfileRead.IdProfile != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/Profile/Read.proxy.php?IdProfile=" + da.ProfileRead
                        .IdProfile,
                    dataType: "json",
                    error: function(result) {
                        da.UsrMsgShow(da.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            data = result["Data"];
                            da.ProfileRead.Set(data);
                        } else {
                            da.UsrMsgShow(da.ProfileRead.FailMsg, "Info");
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
            Id = $("#Profile_IdProfile").val();
            Nam = $("#Profile_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Profile/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdProfile: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.ProfileRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.ProfileRead.ParentObj) {
                                da.RefreshObj(da.ProfileRead.ParentObj);
                            }
                            da.UsrMsgShow(da.ProfileRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.ProfileRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.ProfileRead.CompulsoryFields, da.ProfileRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Profile/Save.proxy.php",
                    dataType: "json",
                    data: da.ProfileRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.ProfileRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#Profile_IdProfile").val(result["IdProfile"]);
                            if (da.ProfileRead.ParentObj) {
                                da.RefreshObj(da.ProfileRead.ParentObj,da.ProfileRead.ParentObjType, fun="Refresh",data=null);
                            }
                            da.UsrMsgShow(da.ProfileRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.ProfileRead.FailMsg, "Info");
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
    da.ProfileRead.Clean();

    $("#ProfileBtns #btnSave").click(function() {
        da.ProfileRead.Save();
    });

    $("#ProfileBtns #btnRefresh").click(function() {
        da.ProfileRead.Refresh();
    });

    $("#ProfileBtns #btnDelete").click(function() {
        da.ProfileRead.Delete();
    });

    $("#ProfileBtns #btnNew").click(function() {
        da.ProfileRead.Clean();
    });

    $("#Profile_Nam").keyup(function(event) {
        da.ProfileRead.btnControl();
    });
    $("#Profile_Descr").keyup(function(event) {
        da.ProfileRead.btnControl();
    });

})
</script>