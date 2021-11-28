<script type="text/javascript" ref="OpDatCatRead">
da.OpDatCatRead = {
    Mode: "<?php echo $this->Mode; ?>",

    Clean: function() {
        $("#OpDatCat_idOpDatCat").val("");
        $("#OpDatCat_Nam").val("");
        $("#OpDatCat_Descr").val("");
    },

    Refresh: function() {
        try {
            return $.ajax({
                type: "GET",
                url: "DA/HtmlComponents/OpDatCat/read.proxy.php?idOpDatCat=" + $("#OpDatCat_idOpDatCat")
                    .val(),
                dataType: "json",
                success: function(data) {
                    // alert(data.idOpDatCat);
                    $("#OpDatCat_Nam").val(data["Nam"]);
                    $("#OpDatCat_Descr").val(data["Descr"]);
                },
                error: function(result) {
                    resultMessage = "<h4>Operation not executed !</h4>";
                    resultMessage += result.responseText;
                    da.UsrMsgShow(resultMessage, "Info");
                }
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Delete: function() {
        try {
            Id = $("#OpDatCat_idOpDatCat").val();
            Nam = $("#OpDatCat_Nam").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/OpDatCat/delete.proxy.php",
                    dataType: "json",
                    data: {
                        idOpDatCat: Id
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(da.OpDatCatRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            da.OpDatCatRead.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (da.OpDatCatRead.ParentObj) {
                                da.RefreshObj(da.OpDatCatRead.ParentObj);
                            }
                            if (da.OpDatCatRead.RefPanels && da.OpDatCatRead.RefPanels != "") {
                                // alert(da.AlgCatTree.DetailPanels);
                                da.RefreshDetailPanels(da.OpDatCatRead.RefPanels, "CleanOpDatCat");
                            }
                            da.UsrMsgShow(da.OpDatCatRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.OpDatCatRead.FailMsg, "Info");
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
            return $.ajax({
                type: "POST",
                url: "DA/HtmlComponents/OpDatCat/save.proxy.php",
                dataType: "json",
                data: {
                    idOpDatCat: $("#OpDatCat_idOpDatCat").val(),
                    Nam: $("#OpDatCat_Nam").val(),
                    Descr: $("#OpDatCat_Descr").val()
                },
                error: function(result) {
                    da.UsrMsgShow(da.OpDatCatRead.FailMsg, "Error");
                },
                success: function(result) {
                    if (result["State"]) {
                        $("#OpDatCat_idOpDatCat").val(da.OpDatCatRead.IdAlg = result["IdAlg"])
                        da.OpDatCatRead.btnControl();
                        if (da.OpDatCatRead.ParentObj) {
                            // alert(da.OpDatCatRead.ParentObj);
                            da.RefreshObj(da.OpDatCatRead.ParentObj);
                        }
                        if (da.OpDatCatRead.RefPanels && da.OpDatCatRead.RefPanels != "") {
                            // alert(da.AlgCatTree.DetailPanels);
                            da.RefreshDetailPanels(da.OpDatCatRead.RefPanels, "SetOpDatCat", da.OpDatCatRead
                                .Get());
                        }
                        da.UsrMsgShow(da.OpDatCatRead.SuccessMsg, "Info");
                    } else {
                        da.UsrMsgShow(da.OpDatCatRead.FailMsg, "Info");
                    }
                }
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    }

}
$(document).ready(function() {

    //popola select ...

    // set defaults
    da.OpDatCatRead.Clean();

    $("#btnSaveOpDatCat").click(function() {
        try {
            da.OpDatCatRead.Save().then(function(result) {
                resultMessage = "<h4>Operation Executed !</h4>";
                da.UsrMsgShow(resultMessage, "Info");

                $("#OpDatCat_idOpDatCat").val(result["IdOpDatCat"]);
                da.TlistOpDatCat.RefreshObj();
            }).catch(function(result) {
                resultMessage = "<h4>Operation not executed ! Problema on DB.</h4>";
                resultMessage += "<p>Problema on DB.</p>";
                da.UsrMsgShow(resultMessage, "Info");
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    });

    $("#btnRefreshOpDatCat").click(function() {
        da.OpDatCatRead.refresh();
    });

    $("#btnDeleteOpDatCat").click(function() {
        try {
            da.OpDatCatRead.Delete().then(function(result) {
                da.OpDatCatRead.Clean();
                da.TlistOpDatCat.RefreshObj();
                $("#btnDeleteOpDatCat").attr("disabled", true);
                $("#btnRefreshOpDatCat").attr("disabled", true);

                resultMessage = "<h4>Operation Executed !</h4>";
                da.UsrMsgShow(resultMessage, "Info");
            }).catch(function(result) {
                resultMessage = "<h4>Operation not executed ! Problema on DB.</h4>";
                resultMessage += "<p>Problema on DB.</p>";
                da.UsrMsgShow(resultMessage, "Info");
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    });


    $("#btnNewOpDatCat").click(function() {
        //alert("btnNewOpDatCat")
        da.OpDatCatRead.Clean();
        $("#btnDeleteOpDatCat").attr("disabled", true);
        $("#btnRefreshOpDatCat").attr("disabled", true);
    });

    // $("#btnModal").click(function () {
    //     //alert("btnModal")
    //     da.contentToModal();
    // })

})
</script>