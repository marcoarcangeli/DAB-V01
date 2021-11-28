<script type="text/javascript" ref="da.AnTlist">
da.AnTlist = {

    whoIAm: 'AnTlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    Table: null,
    Mode: "<?php echo $this->Mode; ?>",
    PageLength: "<?php echo $this->PageLength; ?>",
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    RefreshObj: function() {
        // alert('RefreshObj');
        $("#AnList").DataTable().ajax.reload(null, false);
    },

    Get: function(obj) {
        data = {
            IdAn: $(obj).children(":nth-child(1)").text(),
            Nam: $(obj).children(":nth-child(2)").text(),
            Descr: $(obj).children(":nth-child(3)").text(),
            IdAlg: $(obj).children(":nth-child(4)").text(),
            AlgNam: $(obj).children(":nth-child(5)").text(),
        };

        return data;
    },
    ToggleRow: function(obj) {
        // alert('ToggleRow');
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.AnTlist.CleanSelectedRow();
        } else {
            da.AnTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.AnTlist.Get(obj);
            da.AnTlist.SetSelectedRow(data);
        }
        // da.AnTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        // alert(da.AnTlist.DetailPanels);
        if (da.AnTlist.DetailPanels && da.AnTlist.DetailPanels != "") {
            da.AnRead.IdAn = data["IdAn"];
            da.RefreshDetailPanels(da.AnTlist.DetailPanels, "Refresh");
        }
        // alert(da.AnTlist.RefPanels);
        if (da.AnTlist.RefPanels && da.AnTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.AnTlist.RefPanels, "SetAn", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.AnTlist.DetailPanels && da.AnTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.AnTlist.DetailPanels, "Clean");
        }
        // alert(da.AnTlist.RefPanels);
        if (da.AnTlist.RefPanels && da.AnTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.AnTlist.RefPanels, "CleanAn");
        }
    },
    SelectRow: function(rowNumber) {
        // alert('SelectRow: '+rowNumber);
        if(rowNumber > 0){
            obj=da.AnTlist.Table.row(rowNumber - 1).node();
            if(obj){
                // alert('obj: '+obj);
                da.AnTlist.ToggleRow(obj);
            }
        }
    },

}
$(document).ready(function() {
    // alert(da.AnTlist.PageLength);
    da.AnTlist.Table = $("#AnList").DataTable({
        "paging": true,
        "lengthChange": false,
        "pageLength": da.AnTlist.PageLength,
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
                "width": 100,
                "targets": 1
            },
            {
                "width": 100,
                "targets": 2
            },
            {
                "width": 10,
                "targets": 3
            }
        ],
        "fixedColumns": true,
        "processing": true,
        "serverSide": false,
        "ajax": {
            "url": "DA/HtmlComponents/An/Tlist.proxy.php",
            "type": "POST",
            "dataSrc": "data"
        },
        "columns": [{
                "data": "IdAn"
            },
            {
                "data": "Nam"
            },
            {
                "data": "Descr"
            },
            {
                "data": "IdAlg"
            },
            {
                "data": "AlgNam"
            }
        ],
    });

    $("#AnList tbody").on("click", "tr", function() {
        da.AnTlist.ToggleRow(this);
    });

})
</script>