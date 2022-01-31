<script type="text/javascript" ref="da.ProfileTlist">
da.ProfileTlist = {

    whoIAm: 'ProfileTlist',
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
        if (da.ProfileTlist.SearchIds != '') {
            $params = "?SearchIds=" + da.ProfileTlist.SearchIds;
        }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#ProfileList')) {
            $('#ProfileList').DataTable().destroy();
        }

        $('#ProfileList tbody').empty();

        da.ProfileTlist.Table = $("#ProfileList").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": da.ProfileTlist.PageLength,
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
            da.ProfileTlist.CleanSelectedRow();
        } else {
            da.ProfileTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.ProfileTlist.Get(obj);
            da.ProfileTlist.SetSelectedRow(data);
        }
        // da.ProfileTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.ProfileTlist.DetailPanels && da.ProfileTlist.DetailPanels != "") {
            da.ProfileRead.IdProfile = data["IdProfile"];
            da.RefreshDetailPanels(da.ProfileTlist.DetailPanels, "Refresh");
        }
        // alert(da.ProfileTlist.RefPanels);
        if (da.ProfileTlist.RefPanels && da.ProfileTlist.RefPanels != "") {
            // alert(da.ProfileTlist.RefPanels);
            da.RefreshDetailPanels(da.ProfileTlist.RefPanels, "SetProfile", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.ProfileTlist.DetailPanels && da.ProfileTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.ProfileTlist.DetailPanels, "Clean");
        }
        // alert(da.ProfileTlist.RefPanels);
        if (da.ProfileTlist.RefPanels && da.ProfileTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.ProfileTlist.RefPanels, "CleanProfile");
        }
    },
}
$(document).ready(function() {
    da.ProfileTlist.Refresh();

    $("#ProfileList tbody").on("click", "tr", function() {
        da.ProfileTlist.ToggleRow(this);
    });

    $("#ProfileTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.ProfileTlist.Refresh();
    });

})
</script>