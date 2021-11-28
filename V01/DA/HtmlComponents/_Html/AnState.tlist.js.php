<script type="text/javascript" ref="da.AnStateTlist">
da.AnStateTlist = {
    Entity: 'AnState',
    whoIAm: this.Entity + 'Tlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    IdAnState: '',
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
        if (da.AnStateTlist.SearchIds != '') {
            $params = "?SearchIds=" + da.AnStateTlist.SearchIds;
        }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#AnStateList')) {
            $('#AnStateList').DataTable().destroy();
        }

        $('#AnStateList tbody').empty();

        da.AnStateTlist.Table = $("#AnStateList").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": da.AnStateTlist.PageLength,
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
                "url": "DA/HtmlComponents/AnState/Tlist.proxy.php",
                "type": "POST",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdAnState"
                },
                {
                    "data": "Nam"
                },
                {
                    "data": "Descr"
                }
            ],

        });
        da.AnStateTlist.CleanSelectedRow();
    },
    Get: function(obj) {
        data = {
            IdAnState: $(obj).children(":nth-child(1)").text(),
            Nam: $(obj).children(":nth-child(2)").text(),
            Descr: $(obj).children(":nth-child(3)").text(),
        };
        return data;
    },
    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.AnStateTlist.CleanSelectedRow();
        } else {
            da.AnStateTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.AnStateTlist.Get(obj);
            da.AnStateTlist.SetSelectedRow(data);
        }
        // da.AnStateTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.AnStateTlist.DetailPanels && da.AnStateTlist.DetailPanels != "") {
            da.AnStateRead.IdAnState = data["IdAnState"];
            da.RefreshDetailPanels(da.AnStateTlist.DetailPanels, "Refresh");
        }
        // alert(da.AnStateTlist.RefPanels);
        if (da.AnStateTlist.RefPanels && da.AnStateTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.AnStateTlist.RefPanels, "SetAnState", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.AnStateTlist.DetailPanels && da.AnStateTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.AnStateTlist.DetailPanels, "Clean");
        }
        // alert(da.AnStateTlist.RefPanels);
        if (da.AnStateTlist.RefPanels && da.AnStateTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.AnStateTlist.RefPanels, "CleanAnState");
        }
    },
}

$(document).ready(function() {
    da.AnStateTlist.Refresh();

    $("#AnStateList tbody").on("click", "tr", function() {
        da.AnStateTlist.ToggleRow(this);
    });

    $("#AnStateTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.AnStateTlist.Refresh();
    });

})
</script>