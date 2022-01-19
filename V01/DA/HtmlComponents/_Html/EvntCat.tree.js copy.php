<script type="text/javascript" ref="da.EvntCatTree">
da.EvntCatTree = {
    Entity: 'EvntCat',
    whoIAm: this.Entity + "Tree",
    PanelTag: this.whoIAm + "_",
    IdEvntCat: '',
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
                url: "DA/HtmlComponents/EvntCat/Tree.proxy.php",
                dataType: "json",
                error: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    da.UsrMsgShow(da.EvntCatTree.FailMsg, "Error");
                },
                success: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    data = result["Data"];
                    // alert("success: "+data[0]["Nam"]);
                    html = da.getLevel(data, null, 'IdEvntCat', 'IdEvntCatPar', da.EvntCatTree
                        .PanelTag)["html"];
                    // alert(html);
                    $('#EvntCatTree').html(html);
                    if (da.EvntCatTree.IdEvntCat && da.EvntCatTree.IdEvntCat != '') {
                        $("#" + da.EvntCatTree.IdEvntCat).addClass("selected");

                    }
                    // da.EvntCatRead.Set(data);
                    // da.UsrMsgShow(da.UsrRead.SuccessMsg, "Info");
                },
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },
    Get: function(obj) {
        data = {
            IdNode: $(obj).attr('id'),
            IdEvntCat: $(obj).attr('val'),
            EvntCatNam: $(obj).text(),
            IdEvntCatPar: $(obj).attr('idPar'),
            SearchIds: $(obj).attr('searchIds'),
            ChangePar: da.EvntCatTree.ChangePar,
        };
        return data;
    },
    Clean: function(obj) {
        data = {
            IdNode: '',
            IdEvntCat: '',
            EvntCatNam: '',
            IdEvntCatPar: '',
            SearchIds: '',
            ChangePar: '',
        };
        return data;
    },

    Set: function(objId) {
        // alert(objId);
        obj = $("#" + objId);

        // alert(da.EvntCatTree.ChangePar);
        if (objId) {
            if (da.EvntCatTree.ChangePar) {
                data = da.EvntCatTree.Get(obj);
                da.RefreshDetailPanels(da.EvntCatTree.DetailPanels, "SetEvntCatPar", data);
                da.EvntCatTree.ChangePar = false;
            } else {
                da.EvntCatTree.ToggleRow(obj);
            }
        }
    },
    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            data = da.EvntCatTree.Clean();
            // da.EvntCatTree.CleanSelectedRow(data);
            da.EvntCatTree.SetSelectedRow(data,fun='Clean');
        } else {
            $("#EvntCatTree div.selected").removeClass("selected");
            // alert("Selected");
            $(obj).addClass("selected");
            data = da.EvntCatTree.Get(obj);
            da.EvntCatTree.SetSelectedRow(data,fun='Refresh');
        }
    },
    SetSelectedRow: function(data,fun) {
        // alert(da.EvntCatTree.DetailPanels);
        if (da.EvntCatTree.DetailPanels && da.EvntCatTree.DetailPanels != "") {
            if (da.EvntCatTree.Mode == "TlistPar") {
                da.RefreshDetailPanels(da.EvntCatTree.DetailPanels, "SetEvntCat", data);
            } else {
                da.EvntCatRead.IdEvntCat = data["IdEvntCat"];
                // da.RefreshDetailPanels(da.EvntCatTree.DetailPanels, "Refresh");
                da.RefreshDetailPanels(da.EvntCatTree.DetailPanels, fun);
            }
        }
        // alert(da.EvntCatTree.RefPanels);
        if (da.EvntCatTree.RefPanels && da.EvntCatTree.RefPanels != '') {
            da.RefreshDetailPanels(da.EvntCatTree.RefPanels, "SetEvntCat", data);
        }
    },

    ChangeParent: function() {
        if (da.EvntCatTree.ChangePar) {
            da.EvntCatTree.ChangePar = false;
        } else {
            da.EvntCatTree.ChangePar = true;
        }
    },
}
$(document).ready(function() {

    da.EvntCatTree.Refresh();

    $("#EvntCatTree").on("click", "div", function() {
        // alert("$(this).attr('idPar'): "+$(this).attr('idPar'));
        da.EvntCatTree.Set($(this).attr('id'));
    });

    $("#EvntCatTree").on("dblclick", "div", function() {
        // alert($(this).attr('id'));
        ulId = $(this).attr('id');
        ulIdPar = $(this).attr('idPar');
        if ($('#parUl' + ulIdPar).hasClass("hidden")) {
            $('#parUl' + ulIdPar).removeClass("hidden");
            $('#parUl' + ulId).slideToggle();
            $('#' + ulId + ' i').removeClass("fa-chevron-right");
            $('#' + ulId + ' i').addClass("fa-chevron-down");
        } else {
            // alert("hidden");
            $('#parUl' + ulIdPar).addClass("hidden");
            $('#parUl' + ulId).slideToggle();
            $('#' + ulId + ' i').removeClass("fa-chevron-down");
            $('#' + ulId + ' i').addClass("fa-chevron-right");
        }
    });

    $("#EvntCatTreeBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.EvntCatTree.Refresh();
    });

})
</script>