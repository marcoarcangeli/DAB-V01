<script type="text/javascript" ref="da.UsrProfileRead">
da.UsrProfileRead = {

    PanelTag: 'UsrProfile_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdProfileUsr: '',
    IdUsr: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.UsrProfileRead.Mode == 'alone') {
            $("#UsrProfileBtns #btnNew").hide();
        }

        if ($("#UsrProfile_IdProfileUsr").val() == "") {
            $("#UsrProfileBtns #btnRefresh").attr("disabled", true);
            $("#UsrProfileBtns #btnDelete").attr("disabled", true);
        } else {
            $("#UsrProfileBtns #btnRefresh").attr("disabled", false);
            $("#UsrProfileBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#UsrProfile_IdUsr").val() == "" //&&
        ) {
            $("#UsrProfileBtns #btnSave").attr("disabled", true);
        } else {
            $("#UsrProfileBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdProfileUsr: $("#UsrProfile_IdProfileUsr").val(),
            IdProfile: $("#UsrProfile_IdProfile").val(),
            ProfileNam: $("#UsrProfile_ProfileNam").val(),
            IdUsr: $("#UsrProfile_IdUsr").val(),
            UsrNam: $("#UsrProfile_UsrNam").val()
        };
        return data;
    },

    Set: function(data) {
        $("#UsrProfile_IdProfileUsr").val(data["IdProfileUsr"]);
        $("#UsrProfile_IdProfile").val(data["IdProfile"]);
        $("#UsrProfile_ProfileNam").val(data["ProfileNam"]);
        $("#UsrProfile_IdUsr").val(data["IdUsr"]);
        $("#UsrProfile_UsrNam").val(data["UsrNam"]);

        da.UsrProfileRead.btnControl();
    },

    Clean: function() {
        $("#UsrProfile_IdProfileUsr").val("");
        if (da.UsrProfileRead.IdProfile == '') {
            $("#UsrProfile_IdProfile").val("");
            $("#UsrProfile_ProfileNam").val("");
        }
        $("#UsrProfile_IdUsr").val("");
        $("#UsrProfile_UsrNam").val("");

        da.UsrProfileRead.btnControl();

    },

    SetUsr: function(data) {
        $("#UsrProfile_IdUsr").val(data["IdUsr"]);
        $("#UsrProfile_UsrNam").val(data["Nam"]);
        da.UsrProfileRead.IdUsr = data["IdUsr"];

        da.UsrProfileRead.btnControl();
    },

    CleanUsr: function() {
        $("#UsrProfile_IdUsr").val('');
        $("#UsrProfile_UsrNam").val('');
        da.UsrProfileRead.IdUsr = '';

        da.UsrProfileRead.btnControl();
    },

    Refresh: function() {
        try {
            if (da.UsrProfileRead.IdProfileUsr && da.UsrProfileRead.IdProfileUsr != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/ProfileUsr/read.proxy.php?IdProfileUsr=" + da.UsrProfileRead.IdProfileUsr,
                    dataType: "json",
                    error: function(result) {
                        da.UsrMsgShow(da.UsrProfileRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data = result["Data"];
                        da.UsrProfileRead.Set(data);
                    },
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    Delete: function() {
        try {
            Id = $("#UsrProfile_IdProfileUsr").val();
            Nam = $("#UsrProfile_ProfileNam").val() + " - " + " - " + $("#UsrProfile_UsrNam").val();
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
                        da.UsrMsgShow(da.UsrProfileRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.UsrProfileRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.UsrProfileRead.ParentObj) {
                                da.RefreshObj(da.UsrProfileRead.ParentObj);
                            }
                            da.UsrMsgShow(da.UsrProfileRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.UsrProfileRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.UsrProfileRead.CompulsoryFields, da.UsrProfileRead
                    .PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/ProfileUsr/Save.proxy.php",
                    dataType: "json",
                    data: da.UsrProfileRead.Get(),
                    error: function(result) {
                        // alert(result["State"]);
                        da.UsrMsgShow(da.UsrProfileRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["State"]);
                        if (result["State"]) {
                            $("#UsrProfile_IdProfileUsr").val(result["IdProfileUsr"]);
                            // alert(da.UsrProfileRead.ParentObj);
                            if (da.UsrProfileRead.ParentObj) {
                                // alert(da.UsrProfileRead.ParentObjType);
                                da.RefreshObj(da.UsrProfileRead.ParentObj, da.UsrProfileRead
                                    .ParentObjType, "Refresh", null);
                            }
                            da.UsrMsgShow(da.UsrProfileRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.UsrProfileRead.FailMsg, "Info");
                        }
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },
    getProfileselect: function() {
        $.ajax({
            url: "DA/HtmlComponents/Profile/Tlist.proxy.php",
            type: "POST",
            dataType: "json",
            async: true,
            data: "data",
            error: function(result) {
                // alert(result["State"]);
                da.UsrMsgShow(da.UsrProfileRead.FailMsg, "Error");
            },
            success: function(response) {
                // alert("popola select records: " + response.data.length);
                $("#UsrProfile_IdProfile").empty();
                $("#UsrProfile_IdProfile").append(
                    $("<option></option>") // Yes you can do this.
                    .text("Select an Item ...")
                    .val("")
                );
                $.each(response.data, function(index, item) { // Iterates through a collection
                    $("#UsrProfile_IdProfile")
                        .append( // Append an object to the inside of the select box
                            $("<option></option>") // Yes you can do this.
                            .text(item.Nam  + " (" + item.IdProfile + ")")
                            .val(item.IdProfile)
                        );
                });
                // $("#An_IdPrjState").val( php echo $this->IdPrjState; ?>);
            }
        });
    },


}
$(document).ready(function() {

    //popola select | tree ...
    da.UsrProfileRead.getProfileselect();

    // set defaults
    da.UsrProfileRead.Clean();

    $("#UsrProfileBtns #btnSave").click(function() {
        da.UsrProfileRead.Save();
    });

    $("#UsrProfileBtns #btnRefresh").click(function() {
        da.UsrProfileRead.Refresh();
    });

    $("#UsrProfileBtns #btnDelete").click(function() {
        da.UsrProfileRead.Delete();
    });

    $("#UsrProfileBtns #btnNew").click(function() {
        da.UsrProfileRead.Clean();
    });

    $("#UsrProfile_IdUsr").change(function(event) {
        da.UsrProfileRead.btnControl();
    });

})
</script>