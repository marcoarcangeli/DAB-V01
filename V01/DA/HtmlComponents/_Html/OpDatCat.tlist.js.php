<script type="text/javascript" ref="da.OpDatCatTlist">
da.OpDatCatTlist = {
    whoIAm: 'OpDatCatTlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    IdOpDatCat: '',
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
        // if (da.OpDatCatTlist.SearchIds != '') {
        $params = "?SearchIds=" + da.OpDatCatTlist.SearchIds;
        // }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#OpDatCatList')) {
            $('#OpDatCatList').DataTable().destroy();
        }

        $('#OpDatCatList tbody').empty();

        da.OpDatCatTlist.Table = $("#OpDatCatList").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": da.OpDatCatTlist.PageLength,
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
                "url": "DA/HtmlComponents/OpDatCat/Tlist.proxy.php",
                "type": "POST",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdOpDatCat"
                },
                {
                    "data": "IdOpDatCatPar"
                },
                {
                    "data": "Nam"
                },
                {
                    "data": "Descr"
                }
            ],

        });
        da.OpDatCatTlist.CleanSelectedRow();
    },
    Get: function(obj) {
        data = {
            IdOpDatCat: $(this).children(":nth-child(1)").text(),
            IdOpDatCatPar: $(this).children(":nth-child(2)").text(),
            Nam: $(this).children(":nth-child(3)").text(),
            Descr: $(this).children(":nth-child(4)").text(),
        };
        return data;
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.OpDatCatTlist.CleanSelectedRow();
        } else {
            da.OpDatCatTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.OpDatCatTlist.Get(obj);
            da.OpDatCatTlist.SetSelectedRow(data);
        }
        // da.OpDatCatTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.OpDatCatTlist.DetailPanels && da.OpDatCatTlist.DetailPanels != "") {
            da.OpDatCatRead.IdOpDatCat = data["IdOpDatCat"];
            da.RefreshDetailPanels(da.OpDatCatTlist.DetailPanels, "Refresh");
        }
        // alert(da.OpDatCatTlist.RefPanels);
        if (da.OpDatCatTlist.RefPanels && da.OpDatCatTlist.RefPanels != "") {
            // alert(da.OpDatCatCatTree.DetailPanels);
            da.RefreshDetailPanels(da.OpDatCatTlist.RefPanels, "SetOpDatCat", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.OpDatCatTlist.DetailPanels && da.OpDatCatTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.OpDatCatTlist.DetailPanels, "Clean");
        }
        // alert(da.OpDatCatTlist.RefPanels);
        if (da.OpDatCatTlist.RefPanels && da.OpDatCatTlist.RefPanels != "") {
            // alert(da.OpDatCatCatTree.DetailPanels);
            da.RefreshDetailPanels(da.OpDatCatTlist.RefPanels, "CleanOpDatCat");
        }
    },

}
$(document).ready(function() {
    da.OpDatCatTlist.Refresh();

    $("#OpDatCatList tbody").on("click", "tr", function() {
        da.OpDatCatTlist.ToggleRow(this);
    });

    $("#OpDatCatTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.OpDatCatTlist.Refresh();
    });

})
</script>