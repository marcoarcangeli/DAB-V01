<script type="text/javascript" ref="da.OrganizationTlist">
da.OrganizationTlist = {
    Entity: 'Organization',
    whoIAm: this.Entity + 'Tlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    IdOrganization: '',
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
        if (da.OrganizationTlist.SearchIds != '') {
            $params = "?SearchIds=" + da.OrganizationTlist.SearchIds;
        }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#OrganizationList')) {
            $('#OrganizationList').DataTable().destroy();
        }

        $('#OrganizationList tbody').empty();

        da.OrganizationTlist.Table = $("#OrganizationList").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": da.OrganizationTlist.PageLength,
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
                "url": "DA/HtmlComponents/Organization/Tlist.proxy.php",
                "type": "POST",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdOrganization"
                },
                {
                    "data": "Nam"
                },
                {
                    "data": "Descr"
                },
                {
                    "data": "Dttm"
                }
            ],
        });
        da.OrganizationTlist.CleanSelectedRow();
    },
    Get: function(obj) {
        data = {
            IdOrganization: $(obj).children(":nth-child(1)").text(),
            Nam: $(obj).children(":nth-child(2)").text(),
            Descr: $(obj).children(":nth-child(3)").text(),
            Dttm: $(obj).children(":nth-child(4)").text(),
        }
        return data;
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.OrganizationTlist.CleanSelectedRow();
        } else {
            da.OrganizationTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.OrganizationTlist.Get(obj);
            da.OrganizationTlist.SetSelectedRow(data);
        }
        // da.OrganizationTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.OrganizationTlist.DetailPanels && da.OrganizationTlist.DetailPanels != "") {
            da.OrganizationRead.IdOrganization = data["IdOrganization"];
            da.RefreshDetailPanels(da.OrganizationTlist.DetailPanels, "Refresh");
        }
        // alert(da.OrganizationTlist.RefPanels);
        if (da.OrganizationTlist.RefPanels && da.OrganizationTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.OrganizationTlist.RefPanels, "SetOrganization", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.OrganizationTlist.DetailPanels && da.OrganizationTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.OrganizationTlist.DetailPanels, "Clean");
        }
        // alert(da.OrganizationTlist.RefPanels);
        if (da.OrganizationTlist.RefPanels && da.OrganizationTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.OrganizationTlist.RefPanels, "CleanOrganization");
        }
    },
}
$(document).ready(function() {
    da.OrganizationTlist.Refresh();

    $("#OrganizationList tbody").on("click", "tr", function() {
        da.OrganizationTlist.ToggleRow(this);
    });

    $("#OrganizationTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.OrganizationTlist.Refresh();
    });

})
</script>