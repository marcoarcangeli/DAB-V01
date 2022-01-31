<script type="text/javascript" ref="<?php echo $this->JSPanelNamSpace; ?>">
<?php echo $this->JSPanelNamSpace; ?> = {

    PanelTag: '<?php echo $this->PanelTag; ?>',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    IdAlgCat: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if (<?php echo $this->JSPanelNamSpace; ?>.Mode == 'alone') {
            $("#<?php echo $this->PanelBtnsNam; ?> #btnNew").hide();
        }

        if ($("#<?php echo $this->PanelTag; ?>IdAlgCat").val() == "") {
            $("#<?php echo $this->PanelBtnsNam; ?> #btnRefresh").attr("disabled", true);
            $("#<?php echo $this->PanelBtnsNam; ?> #btnDelete").attr("disabled", true);
            $("#<?php echo $this->PanelBtnsNam; ?> #btnNewChild").attr("disabled", true);
        } else {
            $("#<?php echo $this->PanelBtnsNam; ?> #btnRefresh").attr("disabled", false);
            $("#<?php echo $this->PanelBtnsNam; ?> #btnDelete").attr("disabled", false);
            $("#<?php echo $this->PanelBtnsNam; ?> #btnNewChild").attr("disabled", false);
        }

        if (
            $("#<?php echo $this->PanelTag; ?>Nam").val() == "" &&
            $("#<?php echo $this->PanelTag; ?>Descr").val() == ""
        ) {
            $("#<?php echo $this->PanelBtnsNam; ?> #btnSave").attr("disabled", true);
        } else {
            $("#<?php echo $this->PanelBtnsNam; ?> #btnSave").attr("disabled", false);
        }
    },

    Get: function() {
        data = {
            IdAlgCat: $("#<?php echo $this->PanelTag; ?>IdAlgCat").val(),
            IdAlgCatPar: $("#<?php echo $this->PanelTag; ?>IdAlgCatPar").val(),
            Nam: $("#<?php echo $this->PanelTag; ?>Nam").val(),
            Descr: $("#<?php echo $this->PanelTag; ?>Descr").val()
        };
        return data;
    },


    Set: function(data) {
        $("#<?php echo $this->PanelTag; ?>IdAlgCat").val(data["IdAlgCat"]);
        $("#<?php echo $this->PanelTag; ?>IdAlgCatPar").val(data["IdAlgCatPar"]);
        $("#<?php echo $this->PanelTag; ?>AlgCatParNam").val(data["AlgCatParNam"]);
        $("#<?php echo $this->PanelTag; ?>Nam").val(data["Nam"]);
        $("#<?php echo $this->PanelTag; ?>Descr").val(data["Descr"]);

        <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    },

    SetAlgCatPar: function(data) {
        $("#<?php echo $this->PanelTag; ?>IdAlgCatPar").val(data["IdAlgCat"]);
        $("#<?php echo $this->PanelTag; ?>AlgCatParNam").val(data["AlgCatNam"]);
    },

    Clean: function() {
        $("#<?php echo $this->PanelTag; ?>IdAlgCat").val("");
        $("#<?php echo $this->PanelTag; ?>IdAlgCatPar").val("");
        $("#<?php echo $this->PanelTag; ?>AlgCatParNam").val("");
        $("#<?php echo $this->PanelTag; ?>Nam").val("");
        $("#<?php echo $this->PanelTag; ?>Descr").val("");

        <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    },

    NewChild: function() {
        NewIdAlgCat=$("#<?php echo $this->PanelTag; ?>IdAlgCat").val();
        NewAlgCatParNam=$("#<?php echo $this->PanelTag; ?>Nam").val();
        da.ParamTypeCatRead.Clean();
        $("#<?php echo $this->PanelTag; ?>IdAlgCatPar").val(NewIdAlgCat);
        $("#<?php echo $this->PanelTag; ?>AlgCatParNam").val(NewAlgCatParNam);

        da.ParamTypeCatRead.btnControl();
    },

    // CleanParent: function() {
    //     $("#<?php echo $this->PanelTag; ?>IdAlgCatPar").val($("#<?php echo $this->PanelTag; ?>IdAlgCat").val());
    //     $("#<?php echo $this->PanelTag; ?>IdAlgCat").val("");
    //     $("#<?php echo $this->PanelTag; ?>Nam").val("");
    //     $("#<?php echo $this->PanelTag; ?>Descr").val("");

    //     <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    // },

    // Notify: function(data = null) {
    //     if (<?php echo $this->JSPanelNamSpace; ?>.ParentObj) {
    //         da.RefreshObj(<?php echo $this->JSPanelNamSpace; ?>.ParentObj, <?php echo $this->JSPanelNamSpace; ?>.ParentObjType,
    //             "Refresh");
    //     }
    // },
    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["NotifyJs"]); ?>

    Refresh: function(data = null) {
        try {
            if(data["<?php echo $this->FEIdNam; ?>"]){
                <?php echo $this->JSPanelNamSpace; ?>.<?php echo $this->FEIdNam; ?>=data["<?php echo $this->FEIdNam; ?>"];
            }
            alert(<?php echo $this->JSPanelNamSpace; ?>.<?php echo $this->FEIdNam; ?>);
            return $.ajax({
                type: "GET",
                url: "DA/HtmlComponents/AlgCat/read.proxy.php?IdAlgCat=" + <?php echo $this->JSPanelNamSpace; ?>.<?php echo $this->FEIdNam; ?>,
                dataType: "json",
                // "data": {
                //     "SrvOpParams": '.$this->JSPanelNamSpace.'.GetSrvOpParams(SrvOpNam),
                // },
                error: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    da.UsrMsgShow(<?php echo $this->JSPanelNamSpace; ?>.FailMsg, "Info");
                },
                success: function(result) {
                    alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    data = result["Data"];
                    // alert("success: "+data["IdUsr"]);
                    <?php echo $this->JSPanelNamSpace; ?>.Set(data);
                    // da.UsrMsgShow(da.UsrRead.SuccessMsg, "Info");
                },
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#<?php echo $this->PanelTag; ?>IdAlgCat").val();
            Nam = $("#<?php echo $this->PanelTag; ?>Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/AlgCat/Delete.proxy.php",
                    dataType: "json",
                    data: {
                        IdAlgCat: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            <?php echo $this->JSPanelNamSpace; ?>.Clean();
                            <?php echo $this->JSPanelNamSpace; ?>.Notify();
                            // da.UsrTlist.RefreshObj();
                            // if (<?php echo $this->JSPanelNamSpace; ?>.ParentObj) {
                            //     da.RefreshObj(<?php echo $this->JSPanelNamSpace; ?>.ParentObj, <?php echo $this->JSPanelNamSpace; ?>.ParentObjType,
                            //         "Refresh");
                            // }
                            da.UsrMsgShow(<?php echo $this->JSPanelNamSpace; ?>.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(<?php echo $this->JSPanelNamSpace; ?>.FailMsg, "Info");
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
            if (da.verifyCompulsoryFields(<?php echo $this->JSPanelNamSpace; ?>.CompulsoryFields, <?php echo $this->JSPanelNamSpace; ?>.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/AlgCat/Save.proxy.php",
                    dataType: "json",
                    data: <?php echo $this->JSPanelNamSpace; ?>.Get(),
                    error: function(result) {
                        da.UsrMsgShow(<?php echo $this->JSPanelNamSpace; ?>.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["Msg"]);
                        if (result["State"]) {
                            $("#<?php echo $this->PanelTag; ?>IdAlgCat").val(result["IdAlgCat"]);
                            // alert(<?php echo $this->JSPanelNamSpace; ?>.ParentObj);
                            <?php echo $this->JSPanelNamSpace; ?>.Notify();
                            // if (<?php echo $this->JSPanelNamSpace; ?>.ParentObj) {
                            //     //ParentObj: "AlgCatTree", ParentObjType: "Tree"
                            //     //ObjNam, ObjType="Tlist", fun, data=null
                            //     da.RefreshObj(<?php echo $this->JSPanelNamSpace; ?>.ParentObj, <?php echo $this->JSPanelNamSpace; ?>.ParentObjType,
                            //         "Refresh");
                            // }
                            da.UsrMsgShow(<?php echo $this->JSPanelNamSpace; ?>.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(<?php echo $this->JSPanelNamSpace; ?>.FailMsg, "Info");
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
    <?php echo $this->JSPanelNamSpace; ?>.Clean();

    $("#<?php echo $this->PanelBtnsNam; ?> #btnSave").click(function() {
        <?php echo $this->JSPanelNamSpace; ?>.Save();
    });

    $("#<?php echo $this->PanelBtnsNam; ?> #btnRefresh").click(function() {
        <?php echo $this->JSPanelNamSpace; ?>.Refresh();
    });

    $("#<?php echo $this->PanelBtnsNam; ?> #btnDelete").click(function() {
        <?php echo $this->JSPanelNamSpace; ?>.Delete();
    });

    $("#<?php echo $this->PanelBtnsNam; ?> #btnNew").click(function() {
        <?php echo $this->JSPanelNamSpace; ?>.Clean();
    });

    $("#<?php echo $this->PanelBtnsNam; ?> #btnNewChild").click(function() {
        <?php echo $this->JSPanelNamSpace; ?>.NewChild();
    });

    $("#<?php echo $this->PanelTag; ?>Nam").keyup(function(event) {
        <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    });
    $("#<?php echo $this->PanelTag; ?>Descr").keyup(function(event) {
        <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    });

})
</script>