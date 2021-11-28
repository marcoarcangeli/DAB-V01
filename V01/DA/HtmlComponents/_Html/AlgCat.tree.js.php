<script type="text/javascript" ref="da.AlgCatTree">
da.AlgCatTree = {
    Entity: 'AlgCat',
    whoIAm: this.Entity + "Tree",
    PanelTag: this.whoIAm + "_",
    DataArr: null,
    ChangePar: false,
    Mode: "<?php echo $this->Mode; ?>",
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    RefPanels: "<?php echo $this->RefPanels; ?>",
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    Refresh: function() {
        try {
            return $.ajax({
                type: "GET",
                url: "DA/HtmlComponents/AlgCat/Tree.proxy.php",
                dataType: "json",
                error: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    da.UsrMsgShow(da.AlgCatTree.FailMsg, "Info");
                },
                success: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    da.AlgCatTree.DataArr = data = result["Data"];
                    // alert("success: "+data[0]["Nam"]);
                    html = da.getLevel(data, null, "IdAlgCat", "IdAlgCatPar", da.AlgCatTree
                        .PanelTag)["html"];
                    // alert(html);
                    $('#AlgCatTree').html(html);
                    if (da.AlgCatTree.IdAlgCat && da.AlgCatTree.IdAlgCat != '') {
                        $("#" + da.AlgCatTree.IdAlgCat).addClass("selected");
                    }
                    // da.AlgCatRead.Set(data);
                    // da.UsrMsgShow(da.UsrRead.SuccessMsg, "Info");
                },
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },
    GetNodeIdByName: function(arr, Nam) {
        var Nodes = $.grep(arr, function(ar) {
            // alert(ar["IdAlgCatPar"]);
            return ar["Nam"] == Nam;
        });
        // alert(Nodes.length);
        if (Nodes.length > 0) {
            return Nodes[0]["IdAlgCat"];
        } else {
            return false;
        }
    },
    SetNodeByName: function(Nam) {
        var NodeId = null;
        if (NodeId = da.AlgCatTree.GetNodeIdByName(da.AlgCatTree.DataArr, Nam)) {
            // alert(NodeId);
            da.AlgCatTree.Set($(this).attr('id'));
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
            ChangePar: da.AlgCatTree.ChangePar,
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

        // alert(da.AlgCatTree.ChangePar);
        if (objId) {
            if (da.AlgCatTree.ChangePar) {
                data = da.AlgCatTree.Get(obj);
                da.RefreshDetailPanels(da.AlgCatTree.DetailPanels, "SetAlgCatPar", data);
                da.AlgCatTree.ChangePar = false;
            } else {
                da.AlgCatTree.ToggleRow(obj);
            }
        }
    },
    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            data = da.AlgCatTree.Clean();
            // da.AlgCatTree.CleanSelectedRow(data);
            da.AlgCatTree.SetSelectedRow(data,fun='Clean');
        } else {
            $("#AlgCatTree div.selected").removeClass("selected");
            // alert("Selected");
            $(obj).addClass("selected");
            data = da.AlgCatTree.Get(obj);
            da.AlgCatTree.SetSelectedRow(data,fun='Refresh');
        }
    },
    SetSelectedRow: function(data,fun) {
        // alert(da.AlgCatTree.DetailPanels);
        if (da.AlgCatTree.DetailPanels && da.AlgCatTree.DetailPanels != "") {
            if (da.AlgCatTree.Mode == "TlistPar") {
                da.RefreshDetailPanels(da.AlgCatTree.DetailPanels, "SetAlgCat", data);
            } else {
                da.AlgCatRead.IdAlgCat = data["IdAlgCat"];
                // da.RefreshDetailPanels(da.AlgCatTree.DetailPanels, "Refresh");
                da.RefreshDetailPanels(da.AlgCatTree.DetailPanels, fun);
            }
        }
        // alert(da.AlgCatTree.RefPanels);
        if (da.AlgCatTree.RefPanels && da.AlgCatTree.RefPanels != '') {
            da.RefreshDetailPanels(da.AlgCatTree.RefPanels, "SetAlgCat", data);
        }
    },
    ChangeParent: function() {
        if (da.AlgCatTree.ChangePar) {
            da.AlgCatTree.ChangePar = false;
        } else {
            da.AlgCatTree.ChangePar = true;
        }
    },

}
$(document).ready(function() {

    da.AlgCatTree.Refresh();

    $("#AlgCatTree").on("click", "div", function() {
        // alert("$(this).attr('idPar'): "+$(this).attr('idPar'));
        da.AlgCatTree.Set($(this).attr('id'));
    });

    $("#AlgCatTree").on("dblclick", "div", function() {
        // alert($(this).attr('id'));
        ulId = $(this).attr('id');
        ulIdPar = $(this).attr('idPar');
        // if ($(this).hasClass("hidden")) {
        //     $(this).removeClass("hidden");
        if ($('#parUl' + ulIdPar).hasClass("hidden")) {
            $('#parUl' + ulIdPar).removeClass("hidden");
            // alert("Not hidden");
            // da_dataTree.Clean();
            $('#parUl' + ulId).slideToggle();
            $('#' + ulId + ' i').removeClass("fa-chevron-right");
            $('#' + ulId + ' i').addClass("fa-chevron-down");
        } else {
            // alert("hidden");
            // table.$("tr.selected").removeClass("selected");
            $('#parUl' + ulIdPar).addClass("hidden");
            // $('#parUl'+parUlId).hide();
            $('#parUl' + ulId).slideToggle();
            $('#' + ulId + ' i').removeClass("fa-chevron-down");
            $('#' + ulId + ' i').addClass("fa-chevron-right");
        }
    });

    $("#AlgCatTreeBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.AlgCatTree.Refresh();
    });

})
</script>