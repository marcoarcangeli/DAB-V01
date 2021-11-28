<script type="text/javascript" ref="da.ProfileUsrRead">
da.ProfileUsrRead = {

    PanelTag: 'ProfileUsr_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdProfileUsr: '',
    IdProfile: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.ProfileUsrRead.Mode == 'alone') {
            $("#ProfileUsrBtns #btnNew").hide();
        }

        if ($("#ProfileUsr_IdProfileUsr").val() == "") {
            $("#ProfileUsrBtns #btnRefresh").attr("disabled", true);
            $("#ProfileUsrBtns #btnDelete").attr("disabled", true);
        } else {
            $("#ProfileUsrBtns #btnRefresh").attr("disabled", false);
            $("#ProfileUsrBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#ProfileUsr_IdUsr").val() == "" //&&
        ) {
            $("#ProfileUsrBtns #btnSave").attr("disabled", true);
        } else {
            $("#ProfileUsrBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdProfileUsr: $("#ProfileUsr_IdProfileUsr").val(),
            IdProfile: $("#ProfileUsr_IdProfile").val(),
            ProfileNam: $("#ProfileUsr_ProfileNam").val(),
            IdUsr: $("#ProfileUsr_IdUsr").val(),
            UsrNam: $("#ProfileUsr_UsrNam").val()
        };
        return data;
    },

    Set: function(data) {
        $("#ProfileUsr_IdProfileUsr").val(data["IdProfileUsr"]);
        $("#ProfileUsr_IdProfile").val(data["IdProfile"]);
        $("#ProfileUsr_ProfileNam").val(data["ProfileNam"]);
        $("#ProfileUsr_IdUsr").val(data["IdUsr"]);
        $("#ProfileUsr_UsrNam").val(data["UsrNam"]);

        da.ProfileUsrRead.btnControl();
    },

    Clean: function() {
        $("#ProfileUsr_IdProfileUsr").val("");
        if (da.ProfileUsrRead.IdProfile == '') {
            $("#ProfileUsr_IdProfile").val("");
            $("#ProfileUsr_ProfileNam").val("");
        }
        $("#ProfileUsr_IdUsr").val("");
        $("#ProfileUsr_UsrNam").val("");

        da.ProfileUsrRead.btnControl();

    },

    SetProfile: function(data) {
        $("#ProfileUsr_IdProfile").val(data["IdProfile"]);
        $("#ProfileUsr_ProfileNam").val(data["Nam"]);
        da.ProfileUsrRead.IdProfile = data["IdProfile"];

        da.ProfileUsrRead.btnControl();
    },

    CleanProfile: function() {
        $("#ProfileUsr_IdProfile").val('');
        $("#ProfileUsr_ProfileNam").val('');
        da.ProfileUsrRead.IdProfile = '';

        da.ProfileUsrRead.btnControl();
    },

    Refresh: function() {
        try {
            if (da.ProfileRead.IdProfile && da.ProfileRead.IdProfile != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/ProfileUsr/read.proxy.php?IdProfileUsr=" + da.ProfileUsrRead
                        .IdProfileUsr,
                    dataType: "json",
                    error: function(result) {
                        da.UsrMsgShow(da.ProfileUsrRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data = result["Data"];
                        da.ProfileUsrRead.Set(data);
                    },
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    Delete: function() {
        try {
            Id = $("#ProfileUsr_IdProfileUsr").val();
            Nam = $("#ProfileUsr_ProfileNam").val() + " - " + " - " + $("#ProfileUsr_UsrNam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/ProfileUsr/delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdProfileUsr: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.ProfileUsrRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.ProfileUsrRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.ProfileUsrRead.ParentObj) {
                                da.RefreshObj(da.ProfileUsrRead.ParentObj);
                            }
                            da.UsrMsgShow(da.ProfileUsrRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.ProfileUsrRead.FailMsg, "Info");
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
            // alert("#btnSave");
            if (da.verifyCompulsoryFields(da.ProfileUsrRead.CompulsoryFields, da.ProfileUsrRead
                    .PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/ProfileUsr/Save.proxy.php",
                    dataType: "json",
                    data: da.ProfileUsrRead.Get(),
                    error: function(result) {
                        // alert(result["State"]);
                        da.UsrMsgShow(da.ProfileUsrRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["State"]);
                        if (result["State"]) {
                            $("#ProfileUsr_IdProfileUsr").val(result["IdProfileUsr"]);
                            // alert(da.ProfileUsrRead.ParentObj);
                            if (da.ProfileUsrRead.ParentObj) {
                                // alert(da.ProfileUsrRead.ParentObjType);
                                da.RefreshObj(da.ProfileUsrRead.ParentObj, da.ProfileUsrRead
                                    .ParentObjType, "Refresh", null);
                            }
                            da.UsrMsgShow(da.ProfileUsrRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.ProfileUsrRead.FailMsg, "Info");
                        }
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },
    getUsrselect: function() {
        $.ajax({
            url: "DA/HtmlComponents/Usr/Tlist.proxy.php",
            type: "POST",
            dataType: "json",
            async: true,
            data: "data",
            error: function(result) {
                // alert(result["State"]);
                da.UsrMsgShow(da.ProfileUsrRead.FailMsg, "Error");
            },
            success: function(response) {
                // alert("popola select records: " + response.data.length);
                $("#ProfileUsr_IdUsr").empty();
                $("#ProfileUsr_IdUsr").append(
                    $("<option></option>") // Yes you can do this.
                    .text("Select an Item ...")
                    .val("")
                );
                $.each(response.data, function(index, item) { // Iterates through a collection
                    $("#ProfileUsr_IdUsr")
                        .append( // Append an object to the inside of the select box
                            $("<option></option>") // Yes you can do this.
                            .text(item.FirstNam + " " + item.Nam + " (" + item.IdUsr + " - " + item.UsrNam + ")")
                            .val(item.IdUsr)
                        );
                });
                // $("#An_IdPrjState").val( php echo $this->IdPrjState; ?>);
            }
        });
    },


}
$(document).ready(function() {

    //popola select | tree ...
    da.ProfileUsrRead.getUsrselect();

    // set defaults
    da.ProfileUsrRead.Clean();

    $("#ProfileUsrBtns #btnSave").click(function() {
        da.ProfileUsrRead.Save();
    });

    $("#ProfileUsrBtns #btnRefresh").click(function() {
        da.ProfileUsrRead.Refresh();
    });

    $("#ProfileUsrBtns #btnDelete").click(function() {
        da.ProfileUsrRead.Delete();
    });

    $("#ProfileUsrBtns #btnNew").click(function() {
        da.ProfileUsrRead.Clean();
    });

    $("#ProfileUsr_IdUsr").change(function(event) {
        da.ProfileUsrRead.btnControl();
    });

})
</script>