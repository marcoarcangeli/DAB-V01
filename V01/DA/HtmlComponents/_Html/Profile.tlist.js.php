<script type="text/javascript" ref="da.ProfilesTlist">
da.ProfilesTlist = {

    whoIAm: 'ProfilesTlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    IdProfile: '',
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
        if (da.ProfilesTlist.SearchIds != '') {
            $params = "?SearchIds=" + da.ProfilesTlist.SearchIds;
        }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#ProfilesList')) {
            $('#ProfilesList').DataTable().destroy();
        }

        $('#ProfilesList tbody').empty();

        da.ProfilesTlist.Table = $("#ProfilesList").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": da.ProfilesTlist.PageLength,
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
                "url": "DA/HtmlComponents/Profile/Tlist.proxy.php",
                "type": "POST",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdProfile"
                },
                {
                    "data": "Nam"
                },
                {
                    "data": "Descr"
                }
            ],
        });
    },
    Get: function(obj) {
        data = {
            IdProfile: $(obj).children(":nth-child(1)").text(),
            Nam: $(obj).children(":nth-child(2)").text(),
            Descr: $(obj).children(":nth-child(3)").text(),
        }
        return data;
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.ProfilesTlist.CleanSelectedRow();
        } else {
            da.ProfilesTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.ProfilesTlist.Get(obj);
            da.ProfilesTlist.SetSelectedRow(data);
        }
        // da.ProfilesTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.ProfilesTlist.DetailPanels && da.ProfilesTlist.DetailPanels != "") {
            da.ProfileRead.IdProfile = data["IdProfile"];
            da.RefreshDetailPanels(da.ProfilesTlist.DetailPanels, "Refresh");
        }
        // alert(da.ProfilesTlist.RefPanels);
        if (da.ProfilesTlist.RefPanels && da.ProfilesTlist.RefPanels != "") {
            // alert(da.ProfilesTlist.RefPanels);
            da.RefreshDetailPanels(da.ProfilesTlist.RefPanels, "SetProfile", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.ProfilesTlist.DetailPanels && da.ProfilesTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.ProfilesTlist.DetailPanels, "Clean");
        }
        // alert(da.ProfilesTlist.RefPanels);
        if (da.ProfilesTlist.RefPanels && da.ProfilesTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.ProfilesTlist.RefPanels, "CleanProfile");
        }
    },
}
$(document).ready(function() {
    da.ProfilesTlist.Refresh();

    $("#ProfilesList tbody").on("click", "tr", function() {
        da.ProfilesTlist.ToggleRow(this);
    });

    $("#ProfilesTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.ProfilesTlist.Refresh();
    });

})
</script>