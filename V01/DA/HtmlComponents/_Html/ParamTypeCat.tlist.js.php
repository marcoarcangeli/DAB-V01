<script type="text/javascript" ref="da.ParamTypeCatTlist">
da.ParamTypeCatTlist = {
    Entity: 'ParamTypeCat',
    whoIAm: this.Entity + 'Tlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    IdParamTypeCat: '',
    Table: null,
    Mode: "<?php echo $this->Mode; ?>",
    PageLength: "<?php echo $this->PageLength; ?>",
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',
    
    Refresh: function() {
        $params = "";
        if (da.ParamTypeCatTlist.SearchIds != '') {
            $params = "?SearchIds=" + da.ParamTypeCatTlist.SearchIds;
        }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#ParamTypeList')) {
            $('#ParamTypeList').DataTable().destroy();
        }

        $('#ParamTypeList tbody').empty();

        da.ParamTypeCatTlist.Table = $("#ParamTypeCatList").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": da.ParamTypeCatTlist.PageLength,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "scrollX": true,
            "columnDefs": [{
                    "width": 10,
                    "targets": 0
                },
                {
                    "width": 10,
                    "targets": 1
                },
                {
                    "width": 100,
                    "targets": 2
                }
            ],
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": "DA/HtmlComponents/ParamTypeCat/Tlist.proxy.php",
                "type": "POST",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdParamTypeCat"
                },
                {
                    "data": "IdParamTypeCatPar"
                },
                {
                    "data": "Nam"
                },
                {
                    "data": "Descr"
                }
            ],
        });
        da.ParamTypeCatTlist.CleanSelectedRow();
    },
    Get: function(obj) {
        data = {
            IdParamTypeCat: $(this).children(":nth-child(1)").text(),
            IdParamTypeCatPar: $(this).children(":nth-child(2)").text(),
            Nam: $(this).children(":nth-child(3)").text(),
            Descr: $(this).children(":nth-child(4)").text(),
        }
        return data;
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.ParamTypeCatTlist.CleanSelectedRow();
        } else {
            da.ParamTypeCatTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.ParamTypeCatTlist.Get(obj);
            da.ParamTypeCatTlist.SetSelectedRow(data);
        }
        da.AnCntx_FileTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.ParamTypeCatTlist.DetailPanels && da.ParamTypeCatTlist.DetailPanels != "") {
            da.ParamTypeCatRead.IdParamTypeCat = data["IdParamTypeCat"];
            da.RefreshDetailPanels(da.ParamTypeCatTlist.DetailPanels, "Refresh");
        }
        // alert(da.ParamTypeCatTlist.RefPanels);
        if (da.ParamTypeCatTlist.RefPanels && da.ParamTypeCatTlist.RefPanels != "") {
            // alert(da.ParamTypeCatTree.DetailPanels);
            da.RefreshDetailPanels(da.ParamTypeCatTlist.RefPanels, "SetParamTypeCat", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.ParamTypeCatTlist.DetailPanels && da.ParamTypeCatTlist.DetailPanels != "") {
            $fun=(da.ParamTypeCatTlist.Mode=="TlistPar") ? "CleanSelectedRow" : "Clean";
            da.RefreshDetailPanels(da.ParamTypeCatTlist.DetailPanels, $fun);
        }
        // alert(da.ParamTypeCatTlist.RefPanels);
        if (da.ParamTypeCatTlist.RefPanels && da.ParamTypeCatTlist.RefPanels != "") {
            // alert(da.ParamTypeCatTree.DetailPanels);
            da.RefreshDetailPanels(da.ParamTypeCatTlist.RefPanels, "CleanParamTypeCat");
        }
    },

}
$(document).ready(function() {
    da.ParamTypeCatTlist.Refresh();

    $("#ParamTypeCatList tbody").on("click", "tr", function() {
        da.ParamTypeCatTlist.ToggleRow(this);
    });

    $("#ParamTypeCatTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.ParamTypeCatTlist.Refresh();
    });
})
</script>