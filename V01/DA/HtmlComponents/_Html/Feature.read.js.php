<script type="text/javascript" ref="da.FeatureRead">
da.FeatureRead = {

    PanelTag: 'Feature_',
    whoIAm: 'Feature',
    PanelTag: this.whoIAm + '_',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdFeature: '',
    IdFeatureCat: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (da.FeatureRead.Mode == 'alone') {
            $("#FeatureBtns #btnNew").hide();
        }

        if ($("#Feature_IdFeature").val() == "") {
            $("#FeatureBtns #btnRefresh").attr("disabled", true);
            $("#FeatureBtns #btnDelete").attr("disabled", true);
        } else {
            $("#FeatureBtns #btnRefresh").attr("disabled", false);
            $("#FeatureBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#Feature_Nam").val() == "" &&
            $("#Feature_Descr").val() == "" &&
            $("#Feature_CodeParams").val() == "" &&
            $("#Feature_Profile").val() == "" &&
            $("#Feature_vlDefault").val() == ""
        ) {
            $("#FeatureBtns #btnSave").attr("disabled", true);
        } else {
            $("#FeatureBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdFeature: $("#Feature_IdFeature").val(),
            IdFeatureCat: $("#Feature_IdFeatureCat").val(),
            FeatureCatNam: $("#Feature_FeatureCatNam").val(),
            Nam: $("#Feature_Nam").val(),
            Descr: $("#Feature_Descr").val(),
            CodeParams: $("#Feature_CodeParams").val(),
            Profile: $("#Feature_Profile").val(),
            vlDefault: $("#Feature_vlDefault").val()
        };
        return data;
    },


    Set: function(data) {
        $("#Feature_IdFeature").val(data["IdFeature"]);
        $("#Feature_IdFeatureCat").val(data["IdFeatureCat"]);
        $("#Feature_FeatureCatNam").val(data["FeatureCatNam"]);
        $("#Feature_Nam").val(data["Nam"]);
        $("#Feature_Descr").val(data["Descr"]);
        $("#Feature_CodeParams").val(data["CodeParams"]);

        da.FeatureRead.btnControl();
    },

    SetFeatureCat: function(data) {
        $("#Feature_IdFeatureCat").val(data["IdFeatureCat"]);
        $("#Feature_FeatureCatNam").val(data["FeatureCatNam"]);

        // da.FeatureRead.btnControl();
    },

    CleanFeatureCat: function() {
        $("#Feature_IdFeatureCat").val('');
        $("#Feature_FeatureCatNam").val('');
        // da.FeatureRead.btnControl();
    },

    Clean: function() {
        $("#Feature_IdFeature").val("");
        if (da.FeatureRead.IdFeatureCat == '') {
            $("#Feature_IdFeatureCat").val("");
            $("#Feature_FeatureCatNam").val("");
        }
        $("#Feature_Nam").val("");
        $("#Feature_Descr").val("");
        $("#Feature_CodeParams").val("");
    },

    Refresh: function() {
        try {
            return $.ajax({
                type: "GET",
                url: "DA/HtmlComponents/Feature/read.proxy.php?IdFeature=" + da.FeatureRead
                    .IdFeature,
                dataType: "json",
                error: function(result) {
                    da.UsrMsgShow(da.FeatureRead.FailMsg, "Info");
                },
                success: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    data = result["Data"];
                    da.FeatureRead.Set(data);
                },
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#Feature_IdFeature").val();
            Nam = $("#Feature_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Feature/delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdFeature: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.FeatureRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.FeatureRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.FeatureRead.ParentObj) {
                                da.RefreshObj(da.FeatureRead.ParentObj);
                            }
                            if (da.FeatureRead.RefPanels && da.FeatureRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.FeatureRead.RefPanels, "CleanFeature");
                            }
                            da.UsrMsgShow(da.FeatureRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.FeatureRead.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(da.FeatureRead.CompulsoryFields, da.FeatureRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Feature/Save.proxy.php",
                    dataType: "json",
                    data: da.FeatureRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.FeatureRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#Feature_IdFeature").val(result["IdFeature"]);
                            if (da.FeatureRead.ParentObj) {
                                // alert(da.FeatureRead.ParentObj);
                                da.RefreshObj(da.FeatureRead.ParentObj);
                            }
                            if (da.FeatureRead.RefPanels && da.FeatureRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.FeatureRead.RefPanels, "SetFeature", da.FeatureRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.FeatureRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.FeatureRead.FailMsg, "Info");
                        }
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

}
$(document).ready(function() {

    //popola select | tree ...
    // da.FeatureRead.IdFeatureCat_Select();

    // set defaults
    da.FeatureRead.Clean();

    $("#FeatureBtns #btnSave").click(function() {
        da.FeatureRead.Save();
    });

    $("#FeatureBtns #btnRefresh").click(function() {
        da.FeatureRead.Refresh();
    });

    $("#FeatureBtns #btnDelete").click(function() {
        da.FeatureRead.Delete();
    });

    $("#FeatureBtns #btnNew").click(function() {
        da.FeatureRead.Clean();
    });

    $("#Feature_Nam").keyup(function(event) {
        da.FeatureRead.btnControl();
    });
    $("#Feature_Descr").keyup(function(event) {
        da.FeatureRead.btnControl();
    });
    $("#Feature_CodeParams").keyup(function(event) {
        da.FeatureRead.btnControl();
    });

})
</script>