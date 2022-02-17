<script type="text/javascript" ref="da.FeatureCatTlist">
da.FeatureCatTlist = {

    whoIAm: 'FeatureCatTlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    IdFeatureCat: '',
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
        if (da.FeatureCatTlist.SearchIds != '') {
            $params = "?SearchIds=" + da.FeatureCatTlist.SearchIds;
        }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#FeatureList')) {
            $('#FeatureList').DataTable().destroy();
        }

        $('#FeatureList tbody').empty();

        da.FeatureCatTlist.Table = $("#FeatureCatList").DataTable({
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
                "url": "DA/HtmlComponents/FeatureCat/Tlist.proxy.php",
                "type": "POST",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdFeatureCat"
                },
                {
                    "data": "IdFeatureCatPar"
                },
                {
                    "data": "Nam"
                },
                {
                    "data": "Descr"
                }
            ],

        });
        da.FeatureCatTlist.CleanSelectedRow();
    },
    Get: function(obj) {
        data = {
            IdFeatureCat: $(obj).children(":nth-child(1)").text(),
            IdFeatureCatPar: $(obj).children(":nth-child(2)").text(),
            Nam: $(obj).children(":nth-child(3)").text(),
            Descr: $(obj).children(":nth-child(4)").text(),
        }
        return data;
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.FeatureCatTlist.CleanSelectedRow();
        } else {
            da.FeatureCatTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.FeatureCatTlist.Get(obj);
            da.FeatureCatTlist.SetSelectedRow(data);
        }
        da.AnCntx_FileTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.FeatureCatTlist.DetailPanels && da.FeatureCatTlist.DetailPanels != "") {
            da.FeatureCatRead.IdFeatureCat = data["IdFeatureCat"];
            da.RefreshDetailPanels(da.FeatureCatTlist.DetailPanels, "Refresh");
        }
        // alert(da.FeatureCatTlist.RefPanels);
        if (da.FeatureCatTlist.RefPanels && da.FeatureCatTlist.RefPanels != "") {
            // alert(da.FeatureCatTree.DetailPanels);
            da.RefreshDetailPanels(da.FeatureCatTlist.RefPanels, "SetFeatureCat", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.FeatureCatTlist.DetailPanels && da.FeatureCatTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.FeatureCatTlist.DetailPanels, "Clean");
        }
        // alert(da.FeatureCatTlist.RefPanels);
        if (da.FeatureCatTlist.RefPanels && da.FeatureCatTlist.RefPanels != "") {
            // alert(da.FeatureCatTree.DetailPanels);
            da.RefreshDetailPanels(da.FeatureCatTlist.RefPanels, "CleanFeatureCat");
        }
    },

}
$(document).ready(function() {
    da.FeatureCatTlist.Refresh();

    $("#FeatureCatList tbody").on("click", "tr", function() {
        da.FeatureCatTlist.ToggleRow(this);
    });

    $("#FeatureCatTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.FeatureCatTlist.Refresh();
    });

})
</script>