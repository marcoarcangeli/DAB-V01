<script type="text/javascript" ref="da.PrjTlist">
da.PrjTlist = {

    whoIAm: 'PrjTlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    Table: null,
    Mode: "<?php echo $this->Mode; ?>",
 // PageLength: "<?php echo $this->PageLength; ?>",
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    RefreshObj: function() {
        // alert('RefreshObj PrjList');
        $("#PrjList").DataTable().ajax.reload(null, false);
    },

    Get: function(obj) {
        data = {
            IdPrj: $(obj).children(":nth-child(1)").text(),
            Nam: $(obj).children(":nth-child(2)").text(),
            // Descr       : $(obj).children(":nth-child(3)").text(),
            // IdPrjState  : $(obj).children(":nth-child(4)").text(),
            PrjStateNam: $(obj).children(":nth-child(5)").text(),
        };

        return data;
    },
    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.PrjTlist.CleanSelectedRow();
        } else {
            da.PrjTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.PrjTlist.Get(obj);
            da.PrjTlist.SetSelectedRow(data);
        }
        // da.AnCntx_FileTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.PrjTlist.DetailPanels && da.PrjTlist.DetailPanels != "") {
            da.PrjRead.IdPrj = data["IdPrj"];
            da.RefreshDetailPanels(da.PrjTlist.DetailPanels, "Refresh");
        }
        // alert(da.PrjTlist.RefPanels);
        if (da.PrjTlist.RefPanels && da.PrjTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.PrjTlist.RefPanels, "SetAn", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.PrjTlist.DetailPanels && da.PrjTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.PrjTlist.DetailPanels, "Clean");
        }
        // alert(da.PrjTlist.RefPanels);
        if (da.PrjTlist.RefPanels && da.PrjTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.PrjTlist.RefPanels, "CleanAn");
        }
    },

}
$(document).ready(function() {

    da.PrjTlist.Table = $("#PrjList").DataTable({
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
                "width": 50,
                "targets": 0
            },
            {
                "width": 300,
                "targets": 1
            },
        ],
        "fixedColumns": true,
        "processing": true,
        "serverSide": false,
        "ajax": {
            "url": "DA/HtmlComponents/Prj/Tlist.proxy.php",
            "type": "POST",
            "dataSrc": "data"
        },
        "columns": [{
                "data": "IdPrj"
            },
            {
                "data": "Nam"
            },
            // { "data" : "Descr" },
            // { "data" : "IdPrjState" },
            {
                "data": "PrjStateNam"
            }
        ],
    });

    $("#PrjList tbody").on("click", "tr", function() {
        da.PrjTlist.ToggleRow(this);
    });
})
</script>