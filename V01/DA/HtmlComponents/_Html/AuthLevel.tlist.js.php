<script type="text/javascript" ref="da.AuthLevelTlist">
da.AuthLevelTlist = {

    Entity: 'AuthLevel',
    whoIAm: this.Entity + 'Tlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    IdAuthLevel: '',
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
        if (da.AuthLevelTlist.SearchIds != '') {
            $params = "?SearchIds=" + da.AuthLevelTlist.SearchIds;
        }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#AuthLevelList')) {
            $('#AuthLevelList').DataTable().destroy();
        }

        $('#AuthLevelList tbody').empty();

        da.AuthLevelTlist.Table = $("#AuthLevelList").DataTable({
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
                    "width": 20,
                    "targets": 0
                },
                {
                    "width": 100,
                    "targets": 1
                },
                {
                    "width": 20,
                    "targets": 3
                }
            ],
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": "DA/HtmlComponents/AuthLevel/Tlist.proxy.php",
                "type": "POST",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdAuthLevel"
                },
                {
                    "data": "Nam"
                },
                {
                    "data": "Descr"
                },
                {
                    "data": "AuthLevel"
                }
            ],
        });
        da.AuthLevelTlist.CleanSelectedRow();
    },
    Get: function(obj) {
        data = {
            IdAuthLevel: $(obj).children(":nth-child(1)").text(),
            Nam: $(obj).children(":nth-child(2)").text(),
            Descr: $(obj).children(":nth-child(3)").text(),
            AuthLevel: $(obj).children(":nth-child(4)").text(),
        }
        return data;
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.AuthLevelTlist.CleanSelectedRow();
        } else {
            da.AuthLevelTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.AuthLevelTlist.Get(obj);
            da.AuthLevelTlist.SetSelectedRow(data);
        }
        // da.AuthLevelTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.AuthLevelTlist.DetailPanels && da.AuthLevelTlist.DetailPanels != "") {
            da.AuthLevelRead.IdAuthLevel = data["IdAuthLevel"];
            da.RefreshDetailPanels(da.AuthLevelTlist.DetailPanels, "Refresh");
        }
        // alert(da.AuthLevelTlist.RefPanels);
        if (da.AuthLevelTlist.RefPanels && da.AuthLevelTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.AuthLevelTlist.RefPanels, "SetAuthLevel", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.AuthLevelTlist.DetailPanels && da.AuthLevelTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.AuthLevelTlist.DetailPanels, "Clean");
        }
        // alert(da.AuthLevelTlist.RefPanels);
        if (da.AuthLevelTlist.RefPanels && da.AuthLevelTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.AuthLevelTlist.RefPanels, "CleanAuthLevel");
        }
    },
}
$(document).ready(function() {
    da.AuthLevelTlist.Refresh();

    $("#AuthLevelList tbody").on("click", "tr", function() {
        da.AuthLevelTlist.ToggleRow(this);
    });

    $("#AuthLevelTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.AuthLevelTlist.Refresh();
    });

})
</script>