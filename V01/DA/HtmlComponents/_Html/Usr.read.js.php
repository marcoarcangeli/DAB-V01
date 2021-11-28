<script type="text/javascript" ref="Usr.Read">
da.UsrRead = {

    whoIAm: 'Usr',
    PanelTag: this.whoIAm + '_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdUsr: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.UsrRead.Mode == 'alone') {
            $("#UsrBtns #btnNew").hide();
        }

        if ($("#Usr_IdUsr").val() == "") {
            $("#UsrBtns #btnRefresh").attr("disabled", true);
            $("#UsrBtns #btnDelete").attr("disabled", true);
        } else {
            $("#UsrBtns #btnRefresh").attr("disabled", false);
            $("#UsrBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#Usr_UsrNam").val() == "" &&
            $("#Usr_Pwd").val() == "" &&
            $("#Usr_FirstNam").val() == "" &&
            $("#Usr_Nam").val() == "" &&
            $("#Usr_EMail").val() == "" &&
            ($("#Usr_IdOrganization").val() == "" ||
                $("#Usr_IdOrganization").val() == "1")
        ) {
            $("#UsrBtns #btnSave").attr("disabled", true);
        } else {
            $("#UsrBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdUsr           :   $("#Usr_IdUsr").val(),
            IdOrganization  :   $("#Usr_IdOrganization").val(),
            UsrNam          :   $("#Usr_UsrNam").val(),
            Pwd             :   $("#Usr_Pwd").val(),
            FirstNam        :   $("#Usr_FirstNam").val(),
            Nam             :   $("#Usr_Nam").val(),
            EMail           :   $("#Usr_EMail").val()
        };
        return data;
    },


    Set: function(data) {
        $("#Usr_IdUsr").val(data["IdUsr"]);
        $("#Usr_IdOrganization").val(data["IdOrganization"]);
        $("#Usr_UsrNam").val(data["UsrNam"]);
        $("#Usr_Pwd").val(data["Pwd"]);
        $("#Usr_FirstNam").val(data["FirstNam"]);
        $("#Usr_Nam").val(data["Nam"]);
        $("#Usr_EMail").val(data["EMail"]);

        da.UsrRead.btnControl();
    },

    Clean: function() {
        $("#Usr_IdUsr").val("");
        $("#Usr_IdOrganization").val("1");
        $("#Usr_UsrNam").val("");
        $("#Usr_Pwd").val("");
        $("#Usr_FirstNam").val("");
        $("#Usr_Nam").val("");
        $("#Usr_EMail").val("");

        da.UsrRead.btnControl();
    },

    Refresh: function() {
        try {
            return $.ajax({
                type: "GET",
                url: "DA/HtmlComponents/Usr/Read.proxy.php?IdUsr=" + da.UsrRead.IdUsr,
                dataType: "json",
                error: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    da.UsrMsgShow(da.UsrRead.FailMsg, "Info");
                },
                success: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    data = result["Data"];
                    // alert("success: "+data["IdUsr"]);
                    da.UsrRead.Set(data);
                    // da.UsrMsgShow(da.UsrRead.SuccessMsg, "Info");
                },
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#Usr_IdUsr").val();
            Nam = $("#Usr_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Usr/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdUsr: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.UsrRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.UsrRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.UsrRead.ParentObj) {
                                da.RefreshObj(da.UsrRead.ParentObj);
                            }
                            if (da.UsrRead.RefPanels && da.UsrRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.UsrRead.RefPanels, "CleanUsr");
                            }
                            da.UsrMsgShow(da.UsrRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.UsrRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.UsrRead.CompulsoryFields, da.UsrRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Usr/Save.proxy.php",
                    dataType: "json",
                    data: da.UsrRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.UsrRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#Usr_IdUsr").val(result["IdUsr"]);
                            if (da.UsrRead.ParentObj) {
                                da.RefreshObj(da.UsrRead.ParentObj);
                            }
                            if (da.UsrRead.RefPanels && da.UsrRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.UsrRead.RefPanels, "SetUsr", da.UsrRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.UsrRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.UsrRead.FailMsg, "Info");
                        }
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    IdOrganization_Select: function() {
        return $.ajax({
            url: "DA/HtmlComponents/Organization/Tlist.proxy.php",
            type: "POST",
            dataType: "json",
            async: true,
            data: "data",
            success: function(response) {
                // alert("popola select records: "+response.data.length);
                $("#Usr_IdOrganization").empty();
                $("#Usr_IdOrganization").append(
                    $("<option></option>")
                    .text("Select an Item ...")
                    .val("")
                );
                $.each(response.data, function(index, item) { // Iterates through a collection
                    $("#Usr_IdOrganization")
                        .append( // Append an object to the inside of the select box
                            $("<option></option>") // Yes you can do this.
                            .text(item.IdOrganization + " - " + item.Nam)
                            .val(item.IdOrganization)
                        );
                });
            }
        });
    },


}

$(document).ready(function() {
    //popola select ...
    da.UsrRead.IdOrganization_Select();

    // set defaults
    da.UsrRead.Clean();

    $("#UsrBtns #btnSave").click(function() {
        da.UsrRead.Save();
    });

    $("#UsrBtns #btnRefresh").click(function() {
        da.UsrRead.Refresh();
    });

    $("#UsrBtns #btnDelete").click(function() {
        da.UsrRead.Delete();
    });

    $("#UsrBtns #btnNew").click(function() {
        da.UsrRead.Clean();
    });

    $("#Usr_UsrNam").keyup(function(event) {
        da.UsrRead.btnControl();
    });
    $("#Usr_Pwd").keyup(function(event) {
        da.UsrRead.btnControl();
    });
    $("#Usr_FirstNam").keyup(function(event) {
        da.UsrRead.btnControl();
    });
    $("#Usr_Nam").keyup(function(event) {
        da.UsrRead.btnControl();
    });
    $("#Usr_EMail").keyup(function(event) {
        da.UsrRead.btnControl();
    });
    $("#Usr_IdOrganization").change(function(event) {
        // alert("Usr_IdOrganization.change");
        da.UsrRead.btnControl();
    });

})
</script>