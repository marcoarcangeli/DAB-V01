<script type="text/javascript" ref="da.AlgTlist">
da.AlgTlist = {
    Entity: 'Alg',
    whoIAm: this.Entity + 'Tlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    IdAlg: '',
    Table: null,
    Mode: "<?php echo $this->Mode; ?>",
    PageLength: "<?php echo $this->PageLength; ?>",
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    SetAlgCat: function(data) {
        // alert(data["IdAlgCat"]);
        // alert(data["AlgCatNam"]);
        da.AlgTlist.IdAlgCat = data["IdAlgCat"];
        $("#AlgTlist_IdAlgCat").val(data["IdAlgCat"]);
        $("#AlgTlist_AlgCatNam").val(data["AlgCatNam"]);
        da.AlgTlist.SearchIds = data["SearchIds"];
        da.AlgTlist.Refresh();

        da.AlgRead.IdAlgCat = data["IdAlgCat"];
        da.RefreshDetailPanels(da.AlgTlist.DetailPanels, "SetAlgCat", data);
    },
    CleanAlgCat: function() {
        // alert(data["IdAlgCat"]);
        // alert(data["AlgCatNam"]);
        da.AlgTlist.IdAlgCat = '';
        $("#AlgTlist_IdAlgCat").val('');
        $("#AlgTlist_AlgCatNam").val('');
        da.AlgTlist.SearchIds = "";
        // da.RefreshObj("AlgList");
        da.AlgTlist.Refresh();

        da.AlgRead.IdAlgCat = '';
        da.RefreshDetailPanels(da.AlgTlist.DetailPanels, "CleanAlgCat");
    },
    Refresh: function() {
        $params = "";
        // if (da.AlgTlist.SearchIds != '') {
            $params = "?SearchIds=" + da.AlgTlist.SearchIds;
        // }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#AlgList')) {
            $('#AlgList').DataTable().destroy();
        }

        $('#AlgList tbody').empty();

        da.AlgTlist.Table = $("#AlgList").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": da.AlgTlist.PageLength,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "scrollX": true,
            "columnDefs": [{
                    "width": 100,
                    "targets": 2
                },
                {
                    "width": 100,
                    "targets": 4
                },
                {
                    "width": 100,
                    "targets": 5
                },
                {
                    "width": 100,
                    "targets": 6
                }
            ],
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": "DA/HtmlComponents/Alg/Tlist.proxy.php" + $params,
                "type": "GET",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdAlg"
                },
                {
                    "data": "IdAlgCat"
                },
                {
                    "data": "AlgCatNam"
                },
                {
                    "data": "IdAlgState"
                },
                {
                    "data": "AlgStateNam"
                },
                {
                    "data": "Nam"
                },
                {
                    "data": "Descr"
                },
                {
                    "data": "fileRefProc"
                }
            ],
        });
        da.AlgTlist.CleanSelectedRow();
    },
    Get: function(obj) {
        data = {
            IdAlg: $(obj).children(":nth-child(1)").text(),
            IdAlgCat: $(obj).children(":nth-child(2)").text(),
            AlgCatNam: $(obj).children(":nth-child(3)").text(),
            IdAlgState: $(obj).children(":nth-child(4)").text(),
            AlgStateNam: $(obj).children(":nth-child(5)").text(),
            Nam: $(obj).children(":nth-child(6)").text(),
            Descr: $(obj).children(":nth-child(7)").text(),
            fileRefProc: $(obj).children(":nth-child(8)").text(),
        };
        return data;
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.AlgTlist.CleanSelectedRow();
        } else {
            da.AlgTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.AlgTlist.Get(obj);
            da.AlgTlist.SetSelectedRow(data);
        }
        // da.AlgTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.AlgTlist.DetailPanels && da.AlgTlist.DetailPanels != "") {
            da.AlgRead.IdAlg = data["IdAlg"];
            da.RefreshDetailPanels(da.AlgTlist.DetailPanels, "Refresh");
        }
        // alert(da.AlgTlist.RefPanels);
        if (da.AlgTlist.RefPanels && da.AlgTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.AlgTlist.RefPanels, "SetAlg", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.AlgTlist.DetailPanels && da.AlgTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.AlgTlist.DetailPanels, "Clean");
        }
        // alert(da.AlgTlist.RefPanels);
        if (da.AlgTlist.RefPanels && da.AlgTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.AlgTlist.RefPanels, "CleanAlg");
        }
    },

}

$(document).ready(function() {

    da.AlgTlist.Refresh();

    $("#AlgList tbody").on("click", "tr", function() {
        da.AlgTlist.ToggleRow(this);
    });

    $("#AlgTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.AlgTlist.Refresh();
    });

})
</script>