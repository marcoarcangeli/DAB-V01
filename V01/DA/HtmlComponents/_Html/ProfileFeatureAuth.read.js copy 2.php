<script type="text/javascript" ref="da.ProfileFeatureAuthRead">
da.ProfileFeatureAuthRead = {
    Entity: 'ProfileFeatureAuth',
    PanelTag: 'ProfileFeatureAuth_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    CompulsoryParamNams: '<?php echo $this->CompulsoryParamNams; ?>',
    ParamNams: '<?php echo $this->ParamNams; ?>',
    SaveParamNams: '<?php echo $this->SaveParamNams; ?>',
    IdProfileFeatureAuth: '',
    IdProfile: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.ProfileFeatureAuthRead.Mode == 'alone') {
            $("#ProfileFeatureAuthBtns #btnNew").hide();
        }

        if ($("#ProfileFeatureAuth_IdProfileFeatureAuth").val() == "") {
            $("#ProfileFeatureAuthBtns #btnRefresh").attr("disabled", true);
            $("#ProfileFeatureAuthBtns #btnDelete").attr("disabled", true);
        } else {
            $("#ProfileFeatureAuthBtns #btnRefresh").attr("disabled", false);
            $("#ProfileFeatureAuthBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#ProfileFeatureAuth_IdAuthLevel").val() == "" &&
            $("#ProfileFeatureAuth_IdFeature").val() == "" &&
            $("#ProfileFeatureAuth_AuthLevel").val() == "" //&&
        ) {
            $("#ProfileFeatureAuthBtns #btnSave").attr("disabled", true);
        } else {
            $("#ProfileFeatureAuthBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdProfileFeatureAuth: $("#ProfileFeatureAuth_IdProfileFeatureAuth").val(),
            IdProfile: $("#ProfileFeatureAuth_IdProfile").val(),
            ProfileNam: $("#ProfileFeatureAuth_ProfileNam").val(),
            IdFeature: $("#ProfileFeatureAuth_IdFeature").val(),
            // FeatureNam: $("#ProfileFeatureAuth_FeatureNam").val(),
            IdAuthLevel: $("#ProfileFeatureAuth_IdAuthLevel").val(),
            
        };
        return data;
    },

    /*  SrvOpParams = { array of Server Operation Params
     *      SrvOpNam: es.'Read'
     *      FE; string // Fundamental Entity
     *      FEFs; CS string// Fundamental Entity Fields
     *      VM; JSON string// Values Matrix 
     *      FM; JSON string// Filters Matrix (only Ids in this version)
     * },
    */
    GetSrvOpParams: function(SrvOpNam) {
        SrvOpParams = {
            SrvOpNam: SrvOpNam,
            CompulsoryFields: da.ProfileFeatureAuthRead.CompulsoryFields,
            CompulsoryParamNams: da.ProfileFeatureAuthRead.CompulsoryParamNams,
            ParamNams: da.ProfileFeatureAuthRead.ParamNams,
            SaveParamNams: da.ProfileFeatureAuthRead.SaveParamNams,
        };
        return SrvOpParams;
    },

    Set: function(data) {
        $("#ProfileFeatureAuth_IdProfileFeatureAuth").val(data["IdProfileFeatureAuth"]);
        $("#ProfileFeatureAuth_IdProfile").val(data["IdProfile"]);
        $("#ProfileFeatureAuth_ProfileNam").val(data["ProfileNam"]);
        $("#ProfileFeatureAuth_IdFeature").val(data["IdFeature"]);
        // $("#ProfileFeatureAuth_FeatureNam").val(data["FeatureNam"]);
        $("#ProfileFeatureAuth_IdAuthLevel").val(data["IdAuthLevel"]);

        da.ProfileFeatureAuthRead.btnControl();
    },

    Clean: function() {
        $("#ProfileFeatureAuth_IdProfileFeatureAuth").val("");
        if (da.ProfileFeatureAuthRead.IdProfile == '') {
            $("#ProfileFeatureAuth_IdProfile").val("");
            $("#ProfileFeatureAuth_ProfileNam").val("");
        }
        $("#ProfileFeatureAuth_IdFeature").val("");
        $("#ProfileFeatureAuth_IdAuthLevel").val("");

        da.ProfileFeatureAuthRead.btnControl();

    },

    SetProfile: function(data) {
        $("#ProfileFeatureAuth_IdProfile").val(data["IdProfile"]);
        $("#ProfileFeatureAuth_ProfileNam").val(data["Nam"]);
        da.ProfileFeatureAuthRead.IdProfile = data["IdProfile"];

        da.ProfileFeatureAuthRead.btnControl();
    },

    CleanProfile: function() {
        $("#ProfileFeatureAuth_IdProfile").val('');
        $("#ProfileFeatureAuth_ProfileNam").val('');
        da.ProfileFeatureAuthRead.IdProfile = '';

        da.ProfileFeatureAuthRead.btnControl();
    },

    Refresh: function() {
        try {
            if (da.ProfileFeatureAuthRead.IdProfileFeatureAuth && da.ProfileFeatureAuthRead.IdProfileFeatureAuth != '') {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/ProfileFeatureAuth/Read.proxy.php",
                    dataType: "json",
                    "data": {
                        "SrvOpParams": da.ProfileFeatureAuthRead.GetSrvOpParams('Read'),
                        "IdProfileFeatureAuth": da.ProfileFeatureAuthRead.IdProfileFeatureAuth,
                    },
                    error: function(result) {
                        da.UsrMsgShow(da.ProfileFeatureAuthRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data = result["Data"][0];
                        da.ProfileFeatureAuthRead.Set(data);
                    },
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    Delete: function() {
        try {
            Id = $("#ProfileFeatureAuth_IdProfileFeatureAuth").val();
            Nam = $("#ProfileFeatureAuth_IdProfile").val() + " - " + $("#ProfileFeatureAuth_IdFeature")
                .val() + " - " + $("#ProfileFeatureAuth_IdAuthLevel").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/ProfileFeatureAuth/delete.proxy.php",
                    dataType: "json",
                    data: {
                        "SrvOpParams": da.ProfileFeatureAuthRead.GetSrvOpParams('Delete'),
                        'IdProfileFeatureAuth': Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.ProfileFeatureAuthRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.ProfileFeatureAuthRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.ProfileFeatureAuthRead.ParentObj) {
                                da.RefreshObj(da.ProfileFeatureAuthRead.ParentObj);
                            }
                            da.UsrMsgShow(da.ProfileFeatureAuthRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.ProfileFeatureAuthRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.ProfileFeatureAuthRead.CompulsoryFields, da.ProfileFeatureAuthRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/ProfileFeatureAuth/Save.proxy.php",
                    dataType: "json",
                    data: {
                        "SrvOpParams": da.ProfileFeatureAuthRead.GetSrvOpParams('Save'),
                        "data": da.ProfileFeatureAuthRead.Get(),
                    },
                    error: function(result) {
                        // alert(result["State"]);
                        da.UsrMsgShow(da.ProfileFeatureAuthRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["State"]);
                        if (result["State"]) {
                            $("#ProfileFeatureAuth_IdProfileFeatureAuth").val(result[
                                "IdProfileFeatureAuth"]);
                            // alert(da.ProfileFeatureAuthRead.ParentObj);
                            if (da.ProfileFeatureAuthRead.ParentObj) {
                                // alert(da.ProfileFeatureAuthRead.ParentObjType);
                                da.RefreshObj(da.ProfileFeatureAuthRead.ParentObj, da
                                    .ProfileFeatureAuthRead.ParentObjType, "Refresh", null);
                            }
                            da.UsrMsgShow(da.ProfileFeatureAuthRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.ProfileFeatureAuthRead.FailMsg, "Info");
                        }
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },
    getFeatureselect: function() {
        $.ajax({
            url: "DA/HtmlComponents/Feature/Tlist.proxy.php",
            type: "POST",
            dataType: "json",
            async: true,
            data: "data",
            success: function(response) {
                // alert("popola select records: "+response.data.length);
                $("#ProfileFeatureAuth_IdFeature").empty();
                $("#ProfileFeatureAuth_IdFeature").append(
                    $("<option></option>") // Yes you can do this.
                    .text("Select an Item ...")
                    .val("")
                );
                $.each(response.data, function(index, item) { // Iterates through a collection
                    $("#ProfileFeatureAuth_IdFeature")
                        .append( // Append an object to the inside of the select box
                            $("<option></option>") // Yes you can do this.
                            .text(item.FeatureCatNam + "/" + item.Nam + " (" + item
                                .IdFeature + ")")
                            .val(item.IdFeature)
                        );
                });
                // $("#An_IdPrjState").val( php echo $this->IdPrjState; ?>);
            }
        });
    },

    getAuthLevelselect: function() {
        $.ajax({
            url: "DA/HtmlComponents/AuthLevel/Tlist.proxy.php",
            type: "POST",
            dataType: "json",
            async: true,
            data: "data",
            success: function(response) {
                // alert("popola select records: "+response.data.length);
                $("#ProfileFeatureAuth_IdAuthLevel").empty();
                $("#ProfileFeatureAuth_IdAuthLevel").append(
                    $("<option></option>") // Yes you can do this.
                    .text("Select an Item ...")
                    .val("")
                );
                $.each(response.data, function(index, item) { // Iterates through a collection
                    $("#ProfileFeatureAuth_IdAuthLevel")
                        .append( // Append an object to the inside of the select box
                            $("<option></option>") // Yes you can do this.
                            .text(item.Nam + " (" + item.IdAuthLevel + ")")
                            .val(item.IdAuthLevel)
                        );
                });
                // $("#An_IdPrjState").val( php echo $this->IdPrjState; ?>);
            }
        });
    },

}
$(document).ready(function() {

    //popola select | tree ...
    da.ProfileFeatureAuthRead.getFeatureselect();
    da.ProfileFeatureAuthRead.getAuthLevelselect();

    // set defaults
    da.ProfileFeatureAuthRead.Clean();

    $("#ProfileFeatureAuthBtns #btnSave").click(function() {
        da.ProfileFeatureAuthRead.Save();
    });

    $("#ProfileFeatureAuthBtns #btnRefresh").click(function() {
        da.ProfileFeatureAuthRead.Refresh();
    });

    $("#ProfileFeatureAuthBtns #btnDelete").click(function() {
        da.ProfileFeatureAuthRead.Delete();
    });

    $("#ProfileFeatureAuthBtns #btnNew").click(function() {
        da.ProfileFeatureAuthRead.Clean();
    });

    $("#ProfileFeatureAuth_IdAuthLevel").change(function(event) {
        da.ProfileFeatureAuthRead.btnControl();
    });
    $("#ProfileFeatureAuth_IdFeature").change(function(event) {
        da.ProfileFeatureAuthRead.btnControl();
    });

})
</script>