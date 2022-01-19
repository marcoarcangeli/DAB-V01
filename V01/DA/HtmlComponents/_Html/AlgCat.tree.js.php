<script type="text/javascript" ref="<?php echo $this->JSPanelNamSpace; ?>">
<?php echo $this->JSPanelNamSpace; ?> = {
    // filters
    // SearchIds: '',
    // InRefs + filters
    // Id<E>: '',
    // Tree std params
    DataArr: null,
    ChangePar: false,
    // std UI params
    Mode: "<?php echo $this->Mode; ?>",
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    // session params
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    Refresh: function() {
        try {
            return $.ajax({
                type: "POST", 
                url: "DA/HtmlComponents/AlgCat/Tree.proxy.php",
                dataType: "json",
                "data": {
                },
                error: function(result) {
                    da.UsrMsgShow(<?php echo $this->JSPanelNamSpace; ?>.FailMsg, "Info");
                },
                success: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    <?php echo $this->JSPanelNamSpace; ?>.DataArr = data = result["Data"];
                    // alert("success: "+data[0]["Nam"]);
                    html = da.getLevel(data, null, "<?php echo $this->FEIdNam; ?>", "<?php echo $this->FEIdNam; ?>Par", <?php echo $this->JSPanelNamSpace; ?>
                        .PanelTag)["html"];
                    // alert(html);
                    $("#<?php echo $this->TreeObjNam; ?>").html(html);
                    if (<?php echo $this->JSPanelNamSpace; ?>.<?php echo $this->FEIdNam; ?> && <?php echo $this->JSPanelNamSpace; ?>.<?php echo $this->FEIdNam; ?> != "") {
                        $("#" + <?php echo $this->JSPanelNamSpace; ?>.<?php echo $this->FEIdNam; ?>).addClass("selected");
                    }
                },
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    GetNodeIdByName: function(arr, Nam) {
        var Nodes = $.grep(arr, function(ar) {
            // alert(ar["IdAlgCatPar"]);
            return ar["<?php echo $_SESSION["DEFNam"]; ?>"] == Nam;
        });
        // alert(Nodes.length);
        if (Nodes.length > 0) {
            return Nodes[0]["<?php echo $this->FEIdNam; ?>"];
        } else {
            return false;
        }
    },
    SetNodeByName: function(Nam) {
        var NodeId = null;
        if (NodeId = <?php echo $this->JSPanelNamSpace; ?>.GetNodeIdByName(<?php echo $this->JSPanelNamSpace; ?>.DataArr, Nam)) {
            // alert(NodeId);
            <?php echo $this->JSPanelNamSpace; ?>.Set($(this).attr('id'));
        } else {
            // alert("Node not found");
        }
    },
    Get: function(obj) {
        data = {
            IdNode: $(obj).attr('id'),
            IdAlgCat: $(obj).attr('val'),
            AlgCatNam: $(obj).text(),
            IdAlgCatPar: $(obj).attr('idPar'),

            SearchIds: $(obj).attr('searchIds'),
            ChangePar: <?php echo $this->JSPanelNamSpace; ?>.ChangePar,
        };
        return data;
    },
    Clean: function(obj) {
        data = {
            IdNode: '',
            IdAlgCat: '',
            AlgCatNam: '',
            IdAlgCatPar: '',

            SearchIds: '',
            ChangePar: '',
        };
        return data;
    },

    Set: function(objId) {
        // alert(objId);
        obj = $("#" + objId);

        // alert(<?php echo $this->JSPanelNamSpace; ?>.ChangePar);
        if (objId) {
            if (<?php echo $this->JSPanelNamSpace; ?>.ChangePar) {
                data = <?php echo $this->JSPanelNamSpace; ?>.Get(obj);
                da.RefreshDetailPanels(<?php echo $this->JSPanelNamSpace; ?>.DetailPanels, "Set<?php echo $this->FE; ?>Par", data);
                <?php echo $this->JSPanelNamSpace; ?>.ChangePar = false;
            } else {
                <?php echo $this->JSPanelNamSpace; ?>.ToggleRow(obj);
            }
        }
    },

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["TreeToggleNodeJs"]); ?>

    // ?php include($_SESSION["ContentCommonRelPath"].$_SESSION["TreeToggleJs"]); ?>
    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            data = <?php echo $this->JSPanelNamSpace; ?>.Clean();
            <?php echo $this->JSPanelNamSpace; ?>.Notify(data,fun="Clean");
        } else {
            $("#<?php echo $this->TreeObjNam; ?> div.selected").removeClass("selected");
            // alert("Selected");
            $(obj).addClass("selected");
            data = <?php echo $this->JSPanelNamSpace; ?>.Get(obj);
            <?php echo $this->JSPanelNamSpace; ?>.Notify(data,fun="Refresh");
        }
    },
    Notify: function(data,fun) {
        if (<?php echo $this->JSPanelNamSpace; ?>.ParentObj) {
            da.RefreshObj(<?php echo $this->JSPanelNamSpace; ?>.ParentObj, <?php echo $this->JSPanelNamSpace; ?>.ParentObjType,
                "Refresh");
        }

        if (<?php echo $this->JSPanelNamSpace; ?>.DetailPanels && <?php echo $this->JSPanelNamSpace; ?>.DetailPanels != "") {
            if (<?php echo $this->JSPanelNamSpace; ?>.Mode == "TlistPar") {
                da.RefreshDetailPanels(<?php echo $this->JSPanelNamSpace; ?>.DetailPanels, "Set<?php echo $this->FE; ?>", data);
            } else {
                // <?php echo $this->JSPanelNamSpace.$this->FEIdNam; ?> = data["<?php echo $this->FEIdNam; ?>"];
                da.RefreshDetailPanels(<?php echo $this->JSPanelNamSpace; ?>.DetailPanels, fun, data);
            }
        }
        if (<?php echo $this->JSPanelNamSpace; ?>.RefPanels && <?php echo $this->JSPanelNamSpace; ?>.RefPanels != "") {
            da.RefreshDetailPanels(<?php echo $this->JSPanelNamSpace; ?>.RefPanels, "Set<?php echo $this->FE; ?>", data);
        }
    },

    // ToggleRow: function(obj) {
    //     if ($(obj).hasClass("selected")) {
    //         $(obj).removeClass("selected");
    //         data = da.AlgCatTree.Clean();
    //         // da.AlgCatTree.CleanSelectedRow(data);
    //         da.AlgCatTree.Notify(data,fun='Clean');
    //     } else {
    //         $("#AlgCatTree div.selected").removeClass("selected");
    //         // alert("Selected");
    //         $(obj).addClass("selected");
    //         data = da.AlgCatTree.Get(obj);
    //         da.AlgCatTree.Notify(data,fun='Refresh');
    //     }
    // },
    // Notify: function(data,fun) {
    //     // alert(da.AlgCatTree.DetailPanels);
    //     if (da.AlgCatTree.DetailPanels && da.AlgCatTree.DetailPanels != "") {
    //         if (da.AlgCatTree.Mode == "TlistPar") {
    //             da.RefreshDetailPanels(da.AlgCatTree.DetailPanels, "SetAlgCat", data);
    //         } else {
    //             da.AlgCatRead.IdAlgCat = data["IdAlgCat"];
    //             // da.RefreshDetailPanels(da.AlgCatTree.DetailPanels, "Refresh");
    //             da.RefreshDetailPanels(da.AlgCatTree.DetailPanels, fun);
    //         }
    //     }
    //     // alert(da.AlgCatTree.RefPanels);
    //     if (da.AlgCatTree.RefPanels && da.AlgCatTree.RefPanels != '') {
    //         da.RefreshDetailPanels(da.AlgCatTree.RefPanels, "SetAlgCat", data);
    //     }
    // },
    ChangeParent: function() {
        if (<?php echo $this->JSPanelNamSpace; ?>.ChangePar) {
            <?php echo $this->JSPanelNamSpace; ?>.ChangePar = false;
        } else {
            <?php echo $this->JSPanelNamSpace; ?>.ChangePar = true;
        }
    },

}
$(document).ready(function() {

    <?php echo $this->JSPanelNamSpace; ?>.Refresh();

    $("#<?php echo $this->TreeObjNam; ?>").on("click", "div", function() {
        // alert("$(this).attr('idPar'): "+$(this).attr('idPar'));
        <?php echo $this->JSPanelNamSpace; ?>.Set($(this).attr('id'));
    });

    $("#<?php echo $this->TreeObjNam; ?>").on("dblclick", "div", function() {
        <?php echo $this->JSPanelNamSpace; ?>.ToggleNode(this);
    });

    // Btn Events
    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["BtnEventsJs"]); ?>

})
</script>