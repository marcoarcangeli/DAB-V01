<script type="text/javascript" ref="da.ParamTypeCatTree">
da.ParamTypeCatTree = {

    whoIAm: "ParamTypeCatTree",
    PanelTag: "ParamTypeCat_",
    IdParamTypeCat: '',
    ChangePar: false,
    Mode: "<?php echo $this->Mode; ?>",
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    Refresh: function() {
        try {
            return $.ajax({
                type: "GET",
                url: "DA/HtmlComponents/ParamTypeCat/Tree.proxy.php",
                dataType: "json",
                error: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    da.UsrMsgShow(da.ParamTypeCatTree.FailMsg, "Error");
                },
                success: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    data = result["Data"];
                    // alert("success: "+data[0]["Nam"]);
                    // html=da.ParamTypeCatTree.getLevel(data,null,da.ParamTypeCatTree.whoIAm);
                    html = da.getLevel(data, null, 'IdParamTypeCat', 'IdParamTypeCatPar', da
                        .ParamTypeCatTree.PanelTag)["html"];
                    // alert(html);
                    $('#ParamTypeCatTree').html(html);
                    if (da.ParamTypeCatTree.IdParamTypeCat && da.ParamTypeCatTree.IdParamTypeCat !=
                        '') {
                        $("#" + da.ParamTypeCatTree.IdParamTypeCat).addClass("selected");
                    }
                    // da.ParamTypeCatRead.ToggleRow(data);
                    // da.UsrMsgShow(da.UsrRead.SuccessMsg, "Info");
                },
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },
    Get: function(obj) {
        data = {
            IdNode              : $(obj).attr('id'),
            IdParamTypeCat      : $(obj).attr('val'),
            ParamTypeCatNam     : $(obj).text(),
            IdParamTypeCatPar   : $(obj).attr('idPar'),
            SearchIds           : $(obj).attr('searchIds'),
            ChangePar           : da.ParamTypeCatTree.ChangePar,
        };
        // alert($(obj).attr('searchIds'));
        return data;
    },
    Clean: function() {
        data = {
            IdNode: '',
            IdParamTypeCat: '',
            ParamTypeCatNam: '',
            IdParamTypeCatPar: '',
            SearchIds: '',
            ChangePar: '',
        };
        // alert($(obj).attr('searchIds'));
        return data;
    },

    ToggleRow: function(objId) {
        // alert(objId);
        obj = $("#" + objId);

        // alert(da.ParamTypeCatTree.ChangePar);
        if (objId) {
            if (da.ParamTypeCatTree.ChangePar) {
                data = da.ParamTypeCatTree.Get(obj);
                da.RefreshDetailPanels(da.ParamTypeCatTree.DetailPanels, "SetParamTypeCatPar", data);
                da.ParamTypeCatTree.ChangePar = false;
            } else {
                if ($(obj).hasClass("selected")) {
                    $(obj).removeClass("selected");
                    data = da.ParamTypeCatTree.Clean();
                    da.ParamTypeCatTree.IdParamTypeCat = '';
                    // alert("Not selected");
                    // da_dataTree.Clean();
                    if (da.ParamTypeCatTree.Mode == "TlistPar") { // for TlistPar panels
                        // alert(data["SearchIds"]);
                        // da.RefreshDetailPanels(da.ParamTypeCatTree.DetailPanels, "CleanParamTypeCat");
                        da.RefreshDetailPanels(da.ParamTypeCatTree.DetailPanels, "SetParamTypeCat", data);
                    } else if (da.ParamTypeCatTree.RefPanels && da.ParamTypeCatTree.RefPanels != '') {
                        // alert(data["SearchIds"]);
                        // da.RefreshDetailPanels(da.ParamTypeCatTree.RefPanels, "CleanParamTypeCat");
                        da.RefreshDetailPanels(da.ParamTypeCatTree.DetailPanels, "SetParamTypeCat", data);
                    } else { // for read panels
                        da.RefreshDetailPanels(da.ParamTypeCatTree.DetailPanels, "Clean");
                    }
                } else {
                    $("#ParamTypeCatTree div.selected").removeClass("selected");
                    // alert("Selected");
                    $(obj).addClass("selected");
                    data = da.ParamTypeCatTree.Get(obj);
                    da.ParamTypeCatTree.IdParamTypeCat = data["IdParamTypeCat"];
                    // alert($(obj).attr('searchIds'));
                    if (da.ParamTypeCatTree.Mode == "TlistPar") { // for TlistPar panels
                        // alert(data["SearchIds"]);
                        da.RefreshDetailPanels(da.ParamTypeCatTree.DetailPanels, "SetParamTypeCat", data);
                    } else if (da.ParamTypeCatTree.RefPanels && da.ParamTypeCatTree.RefPanels != '') {
                        // alert(data["SearchIds"]);
                        da.RefreshDetailPanels(da.ParamTypeCatTree.RefPanels, "SetParamTypeCat", data);
                    } else { // for read panels
                        // alert('da.ParamTypeCatTree.Mode: ' + da.ParamTypeCatTree.Mode);
                        da.ParamTypeCatRead.IdParamTypeCat = data["IdParamTypeCat"];
                        da.RefreshDetailPanels(da.ParamTypeCatTree.DetailPanels, "Refresh");
                    }

                }
            }
        }
    },
    ChangeParent: function() {
        if (da.ParamTypeCatTree.ChangePar) {
            da.ParamTypeCatTree.ChangePar = false;
        } else {
            da.ParamTypeCatTree.ChangePar = true;
        }
    },

}
$(document).ready(function() {

    da.ParamTypeCatTree.Refresh();

    $("#ParamTypeCatTree").on("click", "div", function() {
        // alert("$(this).attr('idPar'): "+$(this).attr('idPar'));
        da.ParamTypeCatTree.ToggleRow($(this).attr('id'));

    });

    $("#ParamTypeCatTree").on("dblclick", "div", function() {
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

})
</script>