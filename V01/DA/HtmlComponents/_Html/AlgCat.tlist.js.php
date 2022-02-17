<script type="text/javascript" ref="da.AlgCatTlist">
da.AlgCatTlist = {
    Entity: 'AlgCat',
    whoIAm: this.Entity + 'Tlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    IdAlgCat: '',
    Table: null,
    Mode: "<?php echo $this->Mode; ?>",
 // PageLength: "<?php echo $this->PageLength; ?>",
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    Refresh: function() {
        $params = "";
        if (da.AlgCatTlist.SearchIds != '') {
            $params = "?SearchIds=" + da.AlgCatTlist.SearchIds;
        }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#AlgList')) {
            $('#AlgList').DataTable().destroy();
        }

        $('#AlgList tbody').empty();

        da.AlgCatTlist.Table = $("#AlgCatList").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": <?php echo $this->PageLength; ?>,
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
                "url": "DA/HtmlComponents/AlgCat/Tlist.proxy.php",
                "type": "POST",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdAlgCat"
                },
                {
                    "data": "IdAlgCatPar"
                },
                {
                    "data": "Nam"
                },
                {
                    "data": "Descr"
                }
            ],

        });
        da.AlgCatTlist.CleanSelectedRow();
    },
    Get: function(obj) {
        data = {
            IdAlgCat: $(obj).children(":nth-child(1)").text(),
            IdAlgCatPar: $(obj).children(":nth-child(2)").text(),
            Nam: $(obj).children(":nth-child(3)").text(),
            Descr: $(obj).children(":nth-child(4)").text(),
        }
        return data;
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.AlgCatTlist.CleanSelectedRow();
        } else {
            da.AlgCatTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.AlgCatTlist.Get(obj);
            da.AlgCatTlist.SetSelectedRow(data);
        }
        da.AnCntx_FileTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.AlgCatTlist.DetailPanels && da.AlgCatTlist.DetailPanels != "") {
            da.AlgCatRead.IdAlgCat = data["IdAlgCat"];
            da.RefreshDetailPanels(da.AlgCatTlist.DetailPanels, "Refresh");
        }
        // alert(da.AlgCatTlist.RefPanels);
        if (da.AlgCatTlist.RefPanels && da.AlgCatTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.AlgCatTlist.RefPanels, "SetAlgCat", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.AlgCatTlist.DetailPanels && da.AlgCatTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.AlgCatTlist.DetailPanels, "Clean");
        }
        // alert(da.AlgCatTlist.RefPanels);
        if (da.AlgCatTlist.RefPanels && da.AlgCatTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.AlgCatTlist.RefPanels, "CleanAlgCat");
        }
    },

}
$(document).ready(function() {
    da.AlgCatTlist.Refresh();

    $("#AlgCatList tbody").on("click", "tr", function() {
        da.AlgCatTlist.ToggleRow(this);
    });

    $("#AlgCatTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.AlgCatTlist.Refresh();
    });

})
</script>