<script type="text/javascript" ref="<?php echo $this->JSPanelNamSpace; ?>">
<?php echo $this->JSPanelNamSpace; ?> = {
    // refs
    IdAlg: '',
    IdAlgCat: '',
    // contentBuilder params
    // Entity              : '<?php echo $this->Entity; ?>',
    // PanelType           : '<?php echo $this->PanelType; ?>',
    // WhoIAm              : '<?php echo $this->WhoIAm; ?>',
    // PanelTag            : '<?php echo $this->PanelTag; ?>',
    // PanelBtnsNam        : '<?php echo $this->PanelBtnsNam; ?>',
    // JSPanelNamSpace     : '<?php echo $this->JSPanelNamSpace; ?>',
    // Mode                : '<?php echo $this->Mode; ?>',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    // session params
    NamDefaultSep: '<?php echo $_SESSION["NamDefaultSep"]; ?>',
    NamSpaceDefaultSep: '<?php echo $_SESSION["NamSpaceDefaultSep"]; ?>',
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',
    // background knowledge params
    // ClientOps: 'Refresh,Delete,Save'; // cause it is a PanelType 'Read'

    btnControl: function() {
        // alert(this.Mode);
        /**concept when btnNew exists? */
        if ('<?php echo $this->Mode; ?>' == 'alone') {
            $("#<?php echo $this->PanelBtnsNam; ?> #btnNew").hide();
        }
        // alert($("#<?php echo $this->PanelTag; ?>IdAlg").val());
        /**concept when btnRefresh, btnDelete are enabled? */
        if ($("#<?php echo $this->PanelTag; ?>IdAlg").val() == "") {
            $("#<?php echo $this->PanelBtnsNam; ?> #btnRefresh").attr("disabled", true);
            $("#<?php echo $this->PanelBtnsNam; ?> #btnDelete").attr("disabled", true);
        } else {
            $("#<?php echo $this->PanelBtnsNam; ?> #btnRefresh").attr("disabled", false);
            $("#<?php echo $this->PanelBtnsNam; ?> #btnDelete").attr("disabled", false);
        }
        /**concept when btnSave is enabled? */
        if (
            $("#<?php echo $this->PanelTag; ?>Nam").val() == "" &&
            $("#<?php echo $this->PanelTag; ?>Descr").val() == "" &&
            $("#<?php echo $this->PanelTag; ?>fileRefProc").val() == "" &&
            $("#<?php echo $this->PanelTag; ?>IdAlgCat").val() == "" &&
            ($("#<?php echo $this->PanelTag; ?>IdAlgState").val() == "" ||
                $("#<?php echo $this->PanelTag; ?>IdAlgState").val() == "1")
        ) {
            $("#<?php echo $this->PanelBtnsNam; ?> #btnSave").attr("disabled", true);
        } else {
            $("#<?php echo $this->PanelBtnsNam; ?> #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdAlg: $("#<?php echo $this->PanelTag; ?>IdAlg").val(),
            IdAlgCat: $("#<?php echo $this->PanelTag; ?>IdAlgCat").val(),
            AlgCatNam: $("#<?php echo $this->PanelTag; ?>AlgCatNam").val(),
            IdAlgState: $("#<?php echo $this->PanelTag; ?>IdAlgState").val(),
            // AlgStateNam : $("#<?php echo $this->PanelTag; ?>AlgStateNam").val(),
            Nam: $("#<?php echo $this->PanelTag; ?>Nam").val(),
            Descr: $("#<?php echo $this->PanelTag; ?>Descr").val(),
            fileRefProc: $("#<?php echo $this->PanelTag; ?>fileRefProc").val(),
            CatTag: $("#<?php echo $this->PanelTag; ?>CatTag").val()
        };
        return data;
    },


    Set: function(data) {
        $("#<?php echo $this->PanelTag; ?>IdAlg").val(data["IdAlg"]);
        $("#<?php echo $this->PanelTag; ?>IdAlgCat").val(data["IdAlgCat"]);
        $("#<?php echo $this->PanelTag; ?>AlgCatNam").val(data["AlgCatNam"]);
        $("#<?php echo $this->PanelTag; ?>IdAlgState").val(data["IdAlgState"]);
        // $("#<?php echo $this->PanelTag; ?>AlgStateNam").val(data["AlgStateNam"]);
        $("#<?php echo $this->PanelTag; ?>Nam").val(data["Nam"]);
        $("#<?php echo $this->PanelTag; ?>Descr").val(data["Descr"]);
        $("#<?php echo $this->PanelTag; ?>fileRefProc").val(data["fileRefProc"]);
        $("#<?php echo $this->PanelTag; ?>CatTag").val(data["CatTag"]);

        <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    },

    Clean: function() {
        $("#<?php echo $this->PanelTag; ?>IdAlg").val("");
        if (this.IdAlgCat == '') {
            $("#<?php echo $this->PanelTag; ?>IdAlgCat").val("");
            $("#<?php echo $this->PanelTag; ?>AlgCatNam").val("");
        }
        $("#<?php echo $this->PanelTag; ?>IdAlgState").val("1");
        // $("#<?php echo $this->PanelTag; ?>AlgStateNam").val("");
        $("#<?php echo $this->PanelTag; ?>Nam").val("");
        $("#<?php echo $this->PanelTag; ?>Descr").val("");
        $("#<?php echo $this->PanelTag; ?>fileRefProc").val("");
        $("#<?php echo $this->PanelTag; ?>CatTag").val("");

        <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    },

    SetAlgCat: function(data) {
        $("#<?php echo $this->PanelTag; ?>IdAlgCat").val(data["IdAlgCat"]);
        $("#<?php echo $this->PanelTag; ?>AlgCatNam").val(data["AlgCatNam"]);

        <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    },

    CleanAlgCat: function() {
        $("#<?php echo $this->PanelTag; ?>IdAlgCat").val('');
        $("#<?php echo $this->PanelTag; ?>AlgCatNam").val('');
        <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    },

    SetFileRef: function(data) {
        $("#<?php echo $this->PanelTag; ?>fileRefProc").val(data["FileRef"]);
        <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    },

    CleanFileRef: function() {
        $("#<?php echo $this->PanelTag; ?>fileRefProc").val('');
        <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    },

    Refresh: function() {
        // alert(<?php echo $this->JSPanelNamSpace; ?>.IdAlg);
        SrvOp = 'Read';
        try {
            if (<?php echo $this->JSPanelNamSpace; ?>.IdAlg && <?php echo $this->JSPanelNamSpace; ?>.IdAlg !=
                '') {
                Params = "?IdAlg=" + <?php echo $this->JSPanelNamSpace; ?>.IdAlg;
                return $.ajax({
                    type: "GET",
                    // url: "DA/HtmlComponents/Alg/Read.proxy.php?IdAlg=" + da.AlgRead.IdAlg,
                    url: '<?php echo $_SESSION["HtmlComponentsRelPath"].$this->Entity; ?>' + '/' + SrvOp + ".proxy.php" + Params,
                    dataType: "json",
                    error: function(result) {
                        da.UsrMsgShow('<?php echo $_SESSION["FailMsg"]; ?>', "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        data = result["Data"][0];
                        <?php echo $this->JSPanelNamSpace; ?>.Set(data);
                    },
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    Delete: function() {
        SrvOp = 'Delete';
        try {
            Id = $("#<?php echo $this->PanelTag; ?>IdAlg").val();
            Nam = $("#<?php echo $this->PanelTag; ?>Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    // url: "DA/HtmlComponents/Alg/delete.proxy.php",
                    url: '<?php echo $_SESSION["HtmlComponentsRelPath"].$this->Entity; ?>' + '/' + SrvOp + ".proxy.php",
                    dataType: "json",
                    data: {
                        IdAlg: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow('<?php echo $_SESSION["FailMsg"]; ?>', "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            <?php echo $this->JSPanelNamSpace; ?>.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (<?php echo $this->JSPanelNamSpace; ?>.ParentObj) {
                                da.RefreshObj(<?php echo $this->JSPanelNamSpace; ?>.ParentObj);
                            }
                            if (<?php echo $this->JSPanelNamSpace; ?>.RefPanels &&
                                <?php echo $this->JSPanelNamSpace; ?>.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(<?php echo $this->JSPanelNamSpace; ?>
                                    .RefPanels, "CleanAlg");
                            }
                            da.UsrMsgShow('<?php echo $_SESSION["SuccessMsg"]; ?>', "Info");
                        } else {
                            da.UsrMsgShow('<?php echo $_SESSION["FailMsg"]; ?>', "Info");
                        }
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    Save: function() {
        SrvOp = 'Save';
        try {
            // alert("#btnSaveAlg");
            if (da.verifyCompulsoryFields(<?php echo $this->JSPanelNamSpace; ?>.CompulsoryFields,
                    '<?php echo $this->PanelTag; ?>')) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/Alg/Save.proxy.php",
                    dataType: "json",
                    data: <?php echo $this->JSPanelNamSpace; ?>.Get(),
                    error: function(result) {
                        da.UsrMsgShow('<?php echo $_SESSION["FailMsg"]; ?>', "Error");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#<?php echo $this->PanelTag; ?>IdAlg").val(
                                <?php echo $this->JSPanelNamSpace; ?>.IdAlg = result["IdAlg"])
                            <?php echo $this->JSPanelNamSpace; ?>.btnControl();
                            if (<?php echo $this->JSPanelNamSpace; ?>.ParentObj) {
                                // alert(<?php echo $this->JSPanelNamSpace; ?>.ParentObj);
                                da.RefreshObj(<?php echo $this->JSPanelNamSpace; ?>.ParentObj);
                            }
                            if (<?php echo $this->JSPanelNamSpace; ?>.RefPanels &&
                                <?php echo $this->JSPanelNamSpace; ?>.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(<?php echo $this->JSPanelNamSpace; ?>
                                    .RefPanels, "SetAlg", <?php echo $this->JSPanelNamSpace; ?>
                                    .Get());
                            }
                            da.UsrMsgShow('<?php echo $_SESSION["SuccessMsg"]; ?>', "Info");
                        } else {
                            da.UsrMsgShow('<?php echo $_SESSION["FailMsg"]; ?>', "Info");
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
                $("#<?php echo $this->PanelTag; ?>IdAlgState").empty();
                $("#<?php echo $this->PanelTag; ?>IdAlgState").append(
                    $("<option></option>")
                    .text("Select an Item ...")
                    .val("")
                );
                $.each(response.data, function(index, item) { // Iterates through a collection
                    $("#<?php echo $this->PanelTag; ?>IdAlgState")
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
    <?php echo $this->JSPanelNamSpace; ?>.IdAlgState_Select();

    // set defaults
    <?php echo $this->JSPanelNamSpace; ?>.Clean();

    // btnTools [clientOp]: New,Save,Refresh,Delete
    // SrvOps:               - ,Save,Read   ,Delete
    $("#<?php echo $this->PanelBtnsNam; ?> #btnNew").click(function() {
        <?php echo $this->JSPanelNamSpace; ?>.Clean();
    });

    $("#<?php echo $this->PanelBtnsNam; ?> #btnSave").click(function() {
        <?php echo $this->JSPanelNamSpace; ?>.Save();
    });

    $("#<?php echo $this->PanelBtnsNam; ?> #btnRefresh").click(function() {
        <?php echo $this->JSPanelNamSpace; ?>.Refresh();
    });

    $("#<?php echo $this->PanelBtnsNam; ?> #btnDelete").click(function() {
        <?php echo $this->JSPanelNamSpace; ?>.Delete();
    });

    // user activity check
    $("#<?php echo $this->PanelTag; ?>Nam" +
        ", #<?php echo $this->PanelTag; ?>Descr" +
        ", #<?php echo $this->PanelTag; ?>fileRefProc" +
        ", #<?php echo $this->PanelTag; ?>IdAlgState"
    ).on('keyup change', function(e) {
        <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    });

})
</script>