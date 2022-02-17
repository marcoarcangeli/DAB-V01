<script type="text/javascript" ref="da.AlgStateTlist">
da.AlgStateTlist = {
    Entity: 'AlgState',
    whoIAm: this.Entity + 'Tlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    IdAlgState: '',
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
        if (da.AlgStateTlist.SearchIds != '') {
            $params = "?SearchIds=" + da.AlgStateTlist.SearchIds;
        }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#AlgStateList')) {
            $('#AlgStateList').DataTable().destroy();
        }

        $('#AlgStateList tbody').empty();

        da.AlgStateTlist.Table = $("#AlgStateList").DataTable({
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
                    "width": 100,
                    "targets": 1
                }
            ],
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": "DA/HtmlComponents/AlgState/Tlist.proxy.php",
                "type": "POST",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdAlgState"
                },
                {
                    "data": "Nam"
                },
                {
                    "data": "Descr"
                }
            ],
        });
        da.AlgStateTlist.CleanSelectedRow();
    },
    Get: function(obj) {
        data = {
            IdAlgState  : $(obj).children(":nth-child(1)").text(),
            Nam         : $(obj).children(":nth-child(2)").text(),
            Descr       : $(obj).children(":nth-child(3)").text(),
        }
        return data;
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.AlgStateTlist.CleanSelectedRow();
        } else {
            da.AlgStateTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.AlgStateTlist.Get(obj);
            da.AlgStateTlist.SetSelectedRow(data);
        }
        // da.AlgStateTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.AlgStateTlist.DetailPanels && da.AlgStateTlist.DetailPanels != "") {
            da.AlgStateRead.IdAlgState = data["IdAlgState"];
            da.RefreshDetailPanels(da.AlgStateTlist.DetailPanels, "Refresh");
        }
        // alert(da.AlgStateTlist.RefPanels);
        if (da.AlgStateTlist.RefPanels && da.AlgStateTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.AlgStateTlist.RefPanels, "SetAlgState", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.AlgStateTlist.DetailPanels && da.AlgStateTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.AlgStateTlist.DetailPanels, "Clean");
        }
        // alert(da.AlgStateTlist.RefPanels);
        if (da.AlgStateTlist.RefPanels && da.AlgStateTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.AlgStateTlist.RefPanels, "CleanAlgState");
        }
    },
}
$(document).ready(function() {
    da.AlgStateTlist.Refresh();

    $("#AlgStateList tbody").on("click", "tr", function() {
        da.AlgStateTlist.ToggleRow(this);
    });

    $("#AlgStateTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.AlgStateTlist.Refresh();
    });

})
</script>