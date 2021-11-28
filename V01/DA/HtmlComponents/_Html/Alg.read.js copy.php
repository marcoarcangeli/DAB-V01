<script type="text/javascript" ref="da.AlgRead">
da.AlgRead = {
    Entity: 'Alg',
    whoIAm: this.Entity, // + 'Read',
    PanelTag: this.whoIAm + '_',
    IdAlg: '',
    IdAlgCat: '',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        // alert(this.Mode);
        if (da.AlgRead.Mode == 'alone') {
            $("#AlgBtns #btnNew").hide();
        }
        // alert($("#Alg_IdAlg").val());
        if ($("#Alg_IdAlg").val() == "") {
            $("#AlgBtns #btnRefresh").attr("disabled", true);
            $("#AlgBtns #btnDelete").attr("disabled", true);
        } else {
            $("#AlgBtns #btnRefresh").attr("disabled", false);
            $("#AlgBtns #btnDelete").attr("disabled", false);
        }

        if (
            $("#Alg_Nam").val() == "" &&
            $("#Alg_Descr").val() == "" &&
            $("#Alg_fileRefProc").val() == "" &&
            $("#Alg_IdAlgCat").val() == "" &&
            ($("#Alg_IdAlgState").val() == "" ||
                $("#Alg_IdAlgState").val() == "1")
        ) {
            $("#AlgBtns #btnSave").attr("disabled", true);
        } else {
            $("#AlgBtns #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdAlg: $("#Alg_IdAlg").val(),
            IdAlgCat: $("#Alg_IdAlgCat").val(),
            AlgCatNam: $("#Alg_AlgCatNam").val(),
            IdAlgState: $("#Alg_IdAlgState").val(),
            // AlgStateNam : $("#Alg_AlgStateNam").val(),
            Nam: $("#Alg_Nam").val(),
            Descr: $("#Alg_Descr").val(),
            fileRefProc: $("#Alg_fileRefProc").val(),
            CatTag: $("#Alg_CatTag").val()
        };
        return data;
    },


    Set: function(data) {
        $("#Alg_IdAlg").val(data["IdAlg"]);
        $("#Alg_IdAlgCat").val(data["IdAlgCat"]);
        $("#Alg_AlgCatNam").val(data["AlgCatNam"]);
        $("#Alg_IdAlgState").val(data["IdAlgState"]);
        // $("#Alg_AlgStateNam").val(data["AlgStateNam"]);
        $("#Alg_Nam").val(data["Nam"]);
        $("#Alg_Descr").val(data["Descr"]);
        $("#Alg_fileRefProc").val(data["fileRefProc"]);
        $("#Alg_CatTag").val(data["CatTag"]);

        da.AlgRead.btnControl();
    },

    Clean: function() {
        $("#Alg_IdAlg").val("");
        if (this.IdAlgCat == '') {
            $("#Alg_IdAlgCat").val("");
            $("#Alg_AlgCatNam").val("");
        }
        $("#Alg_IdAlgState").val("1");
        // $("#Alg_AlgStateNam").val("");
        $("#Alg_Nam").val("");
        $("#Alg_Descr").val("");
        $("#Alg_fileRefProc").val("");
        $("#Alg_CatTag").val("");

        da.AlgRead.btnControl();
    },

    SetAlgCat: function(data) {
        $("#Alg_IdAlgCat").val(data["IdAlgCat"]);
        $("#Alg_AlgCatNam").val(data["AlgCatNam"]);

        da.AlgRead.btnControl();
    },

    CleanAlgCat: function() {
        $("#Alg_IdAlgCat").val('');
        $("#Alg_AlgCatNam").val('');
        da.AlgRead.btnControl();
    },

    SetFileRef: function(data) {
        $("#Alg_fileRefProc").val(data["FileRef"]);
        da.AlgRead.btnControl();
    },

    CleanFileRef: function() {
        $("#Alg_fileRefProc").val('');
        da.AlgRead.btnControl();
    },

    Refresh: function() {
        // alert(da.AlgRead.IdAlg);
        try {
            if (da.AlgRead.IdAlg && da.AlgRead.IdAlg != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/Alg/Read.proxy.php?IdAlg=" + da.AlgRead.IdAlg,
                    dataType: "json",
                    error: function(result) {
                        da.UsrMsgShow(da.AlgRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        data = result["Data"][0];
                        da.AlgRead.Set(data);
                    },
                })
            }

        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#Alg_IdAlg").val();
            Nam = $("#Alg_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Alg/delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdAlg: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.AlgRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.AlgRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.AlgRead.ParentObj) {
                                da.RefreshObj(da.AlgRead.ParentObj);
                            }
                            if (da.AlgRead.RefPanels && da.AlgRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.AlgRead.RefPanels, "CleanAlg");
                            }
                            da.UsrMsgShow(da.AlgRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.AlgRead.FailMsg, "Info");
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
            // alert("#btnSaveAlg");
            if (da.verifyCompulsoryFields(da.AlgRead.CompulsoryFields, da.AlgRead.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Alg/Save.proxy.php",
                    dataType: "json",
                    data: da.AlgRead.Get(),
                    error: function(result) {
                        da.UsrMsgShow(da.AlgRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#Alg_IdAlg").val(da.AlgRead.IdAlg = result["IdAlg"])
                            da.AlgRead.btnControl();
                            if (da.AlgRead.ParentObj) {
                                // alert(da.AlgRead.ParentObj);
                                da.RefreshObj(da.AlgRead.ParentObj);
                            }
                            if (da.AlgRead.RefPanels && da.AlgRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.AlgRead.RefPanels, "SetAlg", da.AlgRead
                                    .Get());
                            }
                            da.UsrMsgShow(da.AlgRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.AlgRead.FailMsg, "Info");
                        }
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    IdAlgState_Select: function() {
        return $.ajax({
            url: "DA/HtmlComponents/AlgState/Tlist.proxy.php",
            type: "POST",
            dataType: "json",
            async: true,
            data: "data",
            success: function(response) {
                // alert("popola select records: "+response.data.length);
                $("#Alg_IdAlgState").empty();
                $("#Alg_IdAlgState").append(
                    $("<option></option>")
                    .text("Select an Item ...")
                    .val("")
                );
                $.each(response.data, function(index, item) { // Iterates through a collection
                    $("#Alg_IdAlgState")
                        .append( // Append an object to the inside of the select box
                            $("<option></option>") // Yes you can do this.
                            .text(item.IdAlgState + " - " + item.Nam)
                            .val(item.IdAlgState)
                        );
                });
            }
        });
    },

}

$(document).ready(function() {

    //popola select | tree ...
    da.AlgRead.IdAlgState_Select();

    // set defaults
    da.AlgRead.Clean();

    $("#AlgBtns #btnSave").click(function() {
        da.AlgRead.Save();
    });

    $("#AlgBtns #btnRefresh").click(function() {
        da.AlgRead.Refresh();
    });

    $("#AlgBtns #btnDelete").click(function() {
        da.AlgRead.Delete();
    });

    $("#AlgBtns #btnNew").click(function() {
        da.AlgRead.Clean();
    });

    $("#Alg_Nam").keyup(function(event) {
        da.AlgRead.btnControl();
    });
    $("#Alg_Descr").keyup(function(event) {
        da.AlgRead.btnControl();
    });
    $("#Alg_fileRefProc").keyup(function(event) {
        da.AlgRead.btnControl();
    });
    $("#Alg_IdAlgState").change(function(event) {
        // alert("Alg_IdAlgState.change");
        da.AlgRead.btnControl();
    });

})
</script>