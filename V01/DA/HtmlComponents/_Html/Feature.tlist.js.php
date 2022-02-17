<script type="text/javascript" ref="da.FeatureTlist">
da.FeatureTlist = {

    whoIAm: 'FeatureTlist',
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

    SetFeatureCat: function(data) {
        // alert(data["IdFeatureCat"]);
        // alert(data["FeatureCatNam"]);
        da.FeatureTlist.IdFeatureCat = data["IdFeatureCat"];
        $("#FeatureTlist_IdFeatureCat").val(data["IdFeatureCat"]);
        $("#FeatureTlist_FeatureCatNam").val(data["FeatureCatNam"]);
        da.FeatureTlist.SearchIds = data["SearchIds"];
        da.FeatureTlist.Refresh();

        if (da.FeatureTlist.Mode == "Tlist") {
            da.FeatureRead.IdFeatureCat = data["IdFeatureCat"];
            da.RefreshDetailPanels(da.FeatureTlist.DetailPanels, "SetFeatureCat", data);
        }
    },
    CleanFeatureCat: function() {
        // alert(data["IdFeatureCat"]);
        // alert(data["FeatureCatNam"]);
        da.FeatureTlist.IdFeatureCat = '';
        $("#FeatureTlist_IdFeatureCat").val('');
        $("#FeatureTlist_FeatureCatNam").val('');
        da.FeatureTlist.SearchIds = "";
        // da.RefreshObj("FeatureList");
        da.FeatureTlist.Refresh();

        if (da.FeatureTlist.Mode == "Tlist") {
            da.FeatureRead.IdFeatureCat = '';
            da.RefreshDetailPanels(da.FeatureTlist.DetailPanels, "CleanFeatureCat");
        }
    },
    Refresh: function() {
        $params = "";
        if (da.FeatureTlist.SearchIds != '') {
            $params = "?SearchIds=" + da.FeatureTlist.SearchIds;
        }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#FeatureList')) {
            $('#FeatureList').DataTable().destroy();
        }

        $('#FeatureList tbody').empty();

        da.FeatureTlist.Table = $("#FeatureList").DataTable({
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
                    "width": 50,
                    "targets": 2
                },
                {
                    "width": 100,
                    "targets": 3
                },
                {
                    "width": 100,
                    "targets": 4
                }
            ],
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": "DA/HtmlComponents/Feature/Tlist.proxy.php" + $params,
                "type": "GET",
                // "dataSrc": "data"
                "dataSrc": function ( json ) {
                    // alert("State! "+json.State);
                    // alert("Msg! "+json.Msg);
                    // alert("FirstId! "+json.FirstId);
                    return json.data;
                }    
            },
            "columns": [{
                    "data": "IdFeature"
                },
                {
                    "data": "IdFeatureCat"
                },
                {
                    "data": "FeatureCatNam"
                },
                {
                    "data": "Nam"
                },
                {
                    "data": "Descr"
                },
                {
                    "data": "CodeParams"
                }
            ],
        });
        da.FeatureTlist.CleanSelectedRow();
    },
    Get: function(obj) {
        data = {
            IdFeature: $(obj).children(":nth-child(1)").text(),
            IdFeatureCat: $(obj).children(":nth-child(2)").text(),
            FeatureCatNam: $(obj).children(":nth-child(3)").text(),
            Nam: $(obj).children(":nth-child(4)").text(),
            Descr: $(obj).children(":nth-child(5)").text(),
            Unit: $(obj).children(":nth-child(6)").text(),
            vlDefault: $(obj).children(":nth-child(7)").text(),
        };
        return data;
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.FeatureTlist.CleanSelectedRow();
        } else {
            da.FeatureTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");

            data = da.FeatureTlist.Get(obj);
            da.FeatureTlist.SetSelectedRow(data);
        }

    },
    SetSelectedRow: function(data) {
        if (da.FeatureTlist.Mode == "TlistPar") {
            da.RefreshDetailPanels(da.FeatureTlist.DetailPanels, "SetFeature", data);
            da.RefreshDetailPanels(da.FeatureTlist.RefPanels, "SetDefaults", data);
        } else {
            da.FeatureRead.IdFeature = data["IdFeature"];
            da.RefreshDetailPanels(da.FeatureTlist.DetailPanels, "Refresh");
        }

        if (da.FeatureTlist.DetailPanels && da.FeatureTlist.DetailPanels != "") {
            da.FeatureRead.IdFeature = data["IdFeature"];
            da.RefreshDetailPanels(da.FeatureTlist.DetailPanels, "Refresh");
        }
        // alert(da.FeatureTlist.RefPanels);
        if (da.FeatureTlist.RefPanels && da.FeatureTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.FeatureTlist.RefPanels, "SetFeature", data);
        }
    },
    CleanSelectedRow: function() {
        // if (da.FeatureTlist.Mode == "TlistPar") {
        //     da.RefreshDetailPanels(da.FeatureTlist.DetailPanels, "CleanFeature");
        //     da.RefreshDetailPanels(da.FeatureTlist.RefPanels, "CleanDefaults");
        // } else {
        //     da.RefreshDetailPanels(da.FeatureTlist.DetailPanels, "Clean");
        // }

        if (da.FeatureTlist.DetailPanels && da.FeatureTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.FeatureTlist.DetailPanels, "Clean");
        }
        // alert(da.FeatureTlist.RefPanels);
        if (da.FeatureTlist.RefPanels && da.FeatureTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.FeatureTlist.RefPanels, "CleanFeature");
        }
    },

}

$(document).ready(function() {
    da.FeatureTlist.Refresh();

    $("#FeatureList tbody").on("click", "tr", function() {
        da.FeatureTlist.ToggleRow(this);
    });

    $("#FeatureTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.FeatureTlist.Refresh();
    });

})
</script>