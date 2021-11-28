<script type="text/javascript" ref="readOrganization">
da.OrganizationRead = {

    PanelTag: 'Organization_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdOrganization: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.OrganizationRead.Mode == 'alone') {
            $("#OrganizationBtns #btnNew").hide();
        }

        if ($("#Organization_IdOrganization").val() == "") {
            $("#OrganizationBtns #btnRefresh").attr("disabled", true);
            $("#OrganizationBtns #btnDelete").attr("disabled", true);
        } else {
            $("#OrganizationBtns #btnRefresh").attr("disabled", false);
            $("#OrganizationBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#Organization_Nam").val() == "" &&
            $("#Organization_Descr").val() == "" &&
            $("#Organization_CodeParams").val() == "" 
        ) {
            $("#OrganizationBtns #btnSave").attr("disabled", true);
        } else {
            $("#OrganizationBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdOrganization: $("#Organization_IdOrganization").val(),
            Nam: $("#Organization_Nam").val(),
            Descr: $("#Organization_Descr").val(),
            Dttm: $("#Organization_Dttm").val(),
            CodeParams: $("#Organization_CodeParams").val()
        };
        return data;
    },


    Set: function(data) {
        $("#Organization_IdOrganization").val(data["IdOrganization"]);
        $("#Organization_Nam").val(data["Nam"]);
        $("#Organization_Descr").val(data["Descr"]);
        $("#Organization_Dttm").val(new Date(data["Dttm"]).toJSON().slice(0,16));
        $("#Organization_CodeParams").val(data["CodeParams"]);

        da.OrganizationRead.btnControl();
    },

    Clean: function() {
        $("#Organization_IdOrganization").val("");
        $("#Organization_Nam").val("");
        $("#Organization_Descr").val("");
        $("#Organization_Dttm").val(new Date($.now()).toJSON().slice(0,16));
        $("#Organization_CodeParams").val("");

        da.OrganizationRead.btnControl();
    },

    Refresh: function() {
        try {
            // alert("IdOrganization: "+ da.OrganizationRead.IdOrganization);
            if (da.OrganizationRead.IdOrganization && da.OrganizationRead.IdOrganization != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/Organization/Read.proxy.php?IdOrganization=" + da.OrganizationRead
                        .IdOrganization,
                    dataType: "json",
                    error: function(result) {
                        da.UsrMsgShow(da.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            data = result["Data"];
                            da.OrganizationRead.Set(data);
                        } else {
                            da.UsrMsgShow(da.OrganizationRead.FailMsg, "Info");
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
            Id = $("#Organization_IdOrganization").val();
            Nam = $("#Organization_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Organization/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdOrganization: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.OrganizationRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.OrganizationRead.ParentObj) {
                                da.RefreshObj(da.OrganizationRead.ParentObj);
                            }
                            da.UsrMsgShow(da.OrganizationRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.OrganizationRead.FailMsg, "Info");
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
            // alert(da.verifyCompulsoryFields(da.OrganizationRead.CompulsoryFields, da.OrganizationRead.PanelTag));
            if (da.verifyCompulsoryFields(da.OrganizationRead.CompulsoryFields, da.OrganizationRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Organization/Save.proxy.php",
                    dataType: "json",
                    data: da.OrganizationRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.OrganizationRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#Organization_IdOrganization").val(result["IdOrganization"]);
                            if (da.OrganizationRead.ParentObj) {
                                da.RefreshObj(da.OrganizationRead.ParentObj);
                            }
                            da.UsrMsgShow(da.OrganizationRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.OrganizationRead.FailMsg, "Info");
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
    da.OrganizationRead.Clean();

    $("#OrganizationBtns #btnSave").click(function() {
        da.OrganizationRead.Save();
    });

    $("#OrganizationBtns #btnRefresh").click(function() {
        da.OrganizationRead.Refresh();
    });

    $("#OrganizationBtns #btnDelete").click(function() {
        da.OrganizationRead.Delete();
    });

    $("#OrganizationBtns #btnNew").click(function() {
        da.OrganizationRead.Clean();
    });

    $("#Organization_Nam").keyup(function(event) {
        da.OrganizationRead.btnControl();
    });
    $("#Organization_Descr").keyup(function(event) {
        da.OrganizationRead.btnControl();
    });
    $("#Organization_CodeParams").keyup(function(event) {
        da.OrganizationRead.btnControl();
    });

})
</script>