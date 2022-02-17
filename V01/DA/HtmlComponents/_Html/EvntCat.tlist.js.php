<script type="text/javascript" ref="da.EvntCatTlist">
da.EvntCatTlist = {
    Entity: 'EvntCat',
    whoIAm: this.Entity + 'Tlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    IdEvntCat: '',
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
        if (da.EvntCatTlist.SearchIds != '') {
            $params = "?SearchIds=" + da.EvntCatTlist.SearchIds;
        }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#EvntCatList')) {
            $('#EvntCatList').DataTable().destroy();
        }

        $('#EvntCatList tbody').empty();

        da.EvntCatTlist.Table = $("#EvntCatList").DataTable({
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
                "url": "DA/HtmlComponents/EvntCat/Tlist.proxy.php",
                "type": "POST",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdEvntCat"
                },
                {
                    "data": "IdEvntCatPar"
                },
                {
                    "data": "Nam"
                },
                {
                    "data": "Descr"
                }
            ],

        });
        da.EvntCatTlist.CleanSelectedRow();
    },
    Get: function(obj) {
        data = {
            IdEvntCat: $(this).children(":nth-child(1)").text(),
            IdEvntCatPar: $(this).children(":nth-child(2)").text(),
            Nam: $(this).children(":nth-child(3)").text(),
            Descr: $(this).children(":nth-child(4)").text(),
        };
        return data;
    },
    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.EvntCatTlist.CleanSelectedRow();
        } else {
            da.EvntCatTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.EvntCatTlist.Get(obj);
            da.EvntCatTlist.SetSelectedRow(data);
        }
        // da.EvntCatTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.EvntCatTlist.RefPanels) {
            da.RefreshDetailPanels(da.EvntCatTlist.RefPanels, "SetEvntCat", data);
        } 

        if (da.EvntCatTlist.DetailPanels && da.EvntCatTlist.DetailPanels != "") {
            da.EvntCatRead.IdEvntCat = data["IdEvntCat"];
            da.RefreshDetailPanels(da.EvntCatTlist.DetailPanels, "Refresh");
        }
        // alert(da.EvntCatTlist.RefPanels);
        if (da.EvntCatTlist.RefPanels && da.EvntCatTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.EvntCatTlist.RefPanels, "SetEvntCat", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.EvntCatTlist.DetailPanels && da.EvntCatTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.EvntCatTlist.DetailPanels, "Clean");
        }
        // alert(da.EvntCatTlist.RefPanels);
        if (da.EvntCatTlist.RefPanels && da.EvntCatTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.EvntCatTlist.RefPanels, "CleanEvntCat");
        }
    },

}
$(document).ready(function() {
    da.EvntCatTlist.Refresh();

    $("#EvntCatList tbody").on("click", "tr", function() {
        da.EvntCatTlist.ToggleRow(this);
    });

    $("#EvntCatTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.EvntCatTlist.Refresh();
    });

})
</script>