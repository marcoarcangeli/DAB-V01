<script type="text/javascript" ref="da.AlgParamTypeTlist">
da.AlgParamTypeTlist = {

    whoIAm: 'AlgParamTypeTlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    IdParamType: '',
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

    SetParamType: function(data) {
        // alert(data["IdParamType"]);
        // alert(data["ParamTypeNam"]);
        da.AlgParamTypeTlist.IdParamType = data["IdParamType"];
        $("#AlgParamTypeTlist_IdParamType").val(data["IdParamType"]);
        $("#AlgParamTypeTlist_ParamTypeNam").val(data["Nam"]);
        da.AlgParamTypeTlist.SearchIds = data["SearchIds"];
        da.AlgParamTypeTlist.Refresh();

        // alert(data["IdParamType"]);
        da.RefreshDetailPanels(da.AlgParamTypeTlist.DetailPanels, "SetParamType", data);
    },
    CleanParamType: function() {
        // alert(data["IdParamType"]);
        // alert(data["ParamTypeNam"]);
        da.AlgParamTypeTlist.IdParamType = '';
        $("#AlgParamTypeTlist_IdParamType").val('');
        $("#AlgParamTypeTlist_ParamTypeNam").val('');
        da.AlgParamTypeTlist.SearchIds = "";
        // da.RefreshObj("AlgParamTypeList");
        da.AlgParamTypeTlist.Refresh();

        // da.AlgParamTypeRead.IdParamType='';
        da.RefreshDetailPanels(da.AlgParamTypeTlist.DetailPanels, "CleanParamType");
    },
    SetAlg: function(data) {
        da.AlgParamTypeTlist.IdAlg = data["IdAlg"];
        $("#AlgParamTypeTlist_IdAlg").val(data["IdAlg"]);
        $("#AlgParamTypeTlist_AlgNam").val(data["Nam"]);
        da.AlgParamTypeTlist.SearchIds = data["SearchIds"];
        da.AlgParamTypeTlist.Refresh();

        // da.AlgParamTypeRead.IdAlg=data["IdAlg"];
        // alert(da.AlgParamTypeTlist.DetailPanels);
        da.RefreshDetailPanels(da.AlgParamTypeTlist.DetailPanels, "SetAlg", data);
    },

    CleanAlg: function() {
        da.AlgParamTypeTlist.IdAlg = '';
        $("#AlgParamTypeTlist_IdAlg").val('');
        $("#AlgParamTypeTlist_AlgNam").val('');
        da.AlgParamTypeTlist.SearchIds = "";
        // da.RefreshObj("AlgParamTypeList");
        da.AlgParamTypeTlist.Refresh();

        // da.AlgParamTypeRead.IdAlg='';
        da.RefreshDetailPanels(da.AlgParamTypeTlist.DetailPanels, "CleanAlg");
    },

    Refresh: function(data) {
        if(data){
            da.AlgParamTypeTlist.IdParamType= (data['IdParamType']) ? data['IdParamType'] : '';
            // alert(da.AlgParamTypeTlist.IdParamType);
        }
        $params = "?";
        if (da.AlgParamTypeTlist.IdParamType && da.AlgParamTypeTlist.IdParamType != '') {
            $params += "IdParamType=" + da.AlgParamTypeTlist.IdParamType;
        }
        // for Categorized entities
        if (da.AlgParamTypeTlist.SearchIds && da.AlgParamTypeTlist.SearchIds != '') {
            $params += "SearchIds=" + da.AlgParamTypeTlist.SearchIds;
        }
        // as Ref
        if (da.AlgParamTypeTlist.IdAlg && da.AlgParamTypeTlist.IdAlg != '') {
            $params += "IdAlg=" + da.AlgParamTypeTlist.IdAlg;
        }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#AlgParamTypeList')) {
            $('#AlgParamTypeList').DataTable().destroy();
        }

        $('#AlgParamTypeList tbody').empty();

        da.AlgParamTypeTlist.Table = $("#AlgParamTypeList").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": da.AlgParamTypeTlist.PageLength,
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
                    "width": 10,
                    "targets": 3
                },
                {
                    "width": 50,
                    "targets": 4
                },
                {
                    "width": 100,
                    "targets": 5
                },
                {
                    "width": 50,
                    "targets": 6
                },
                {
                    "width": 50,
                    "targets": 7
                }
            ],
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": "DA/HtmlComponents/AlgParamType/Tlist.proxy.php" + $params,
                "type": "GET",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdAlgParamType"
                },
                {
                    "data": "IdParamType"
                },
                {
                    "data": "ParamTypeNam"
                },
                {
                    "data": "IdAlg"
                },
                {
                    "data": "AlgNam"
                },
                {
                    "data": "Nam"
                },
                {
                    "data": "Descr"
                },
                {
                    "data": "Unit"
                },
                {
                    "data": "vlDefault"
                }
            ],
        });
        da.AlgParamTypeTlist.CleanSelectedRow();
    },
    // Get: function(obj) {
    Get: function(data) {
        data = {
            // IdAlgParamType: $(obj).children(":nth-child(1)").text(),
            // IdParamType: $(obj).children(":nth-child(2)").text(),
            // ParamTypeNam: $(obj).children(":nth-child(3)").text(),
            // IdAlg: $(obj).children(":nth-child(4)").text(),
            // AlgNam: $(obj).children(":nth-child(5)").text(),
            // Nam: $(obj).children(":nth-child(6)").text(),
            // Descr: $(obj).children(":nth-child(7)").text(),
            // Unit: $(obj).children(":nth-child(8)").text(),
            // vlDefault: $(obj).children(":nth-child(9)").text(),
            IdAlgParamType  : data['IdAlgParamType'],
            IdParamType     : data['IdParamType'],
            ParamTypeNam    : data['ParamTypeNam'],
            IdAlg           : data['IdAlg'],
            AlgNam          : data['AlgNam'],
            Nam             : data['Nam'],
            Descr           : data['Descr'],
            Unit            : data['Unit'],
            vlDefault       : data['vlDefault'],

        };
        return data;
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.AlgParamTypeTlist.CleanSelectedRow();
        } else {
            da.AlgParamTypeTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            // data = da.AlgParamTypeTlist.Get(obj);
            data=da.AlgParamTypeTlist.Table.row($(obj)).data();
            da.AlgParamTypeTlist.SetSelectedRow(data);
        }
        // da.AlgParamTypeTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.AlgParamTypeTlist.DetailPanels && da.AlgParamTypeTlist.DetailPanels != "") {
            da.AlgParamTypeRead.IdAlgParamType = data["IdAlgParamType"];
            da.RefreshDetailPanels(da.AlgParamTypeTlist.DetailPanels, "Refresh");
        }
        // alert(da.AlgParamTypeTlist.RefPanels);
        if (da.AlgParamTypeTlist.RefPanels && da.AlgParamTypeTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.AlgParamTypeTlist.RefPanels, "SetAlgParamType", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.AlgParamTypeTlist.DetailPanels && da.AlgParamTypeTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.AlgParamTypeTlist.DetailPanels, "Clean");
        }
        // alert(da.AlgParamTypeTlist.RefPanels);
        if (da.AlgParamTypeTlist.RefPanels && da.AlgParamTypeTlist.RefPanels != "") {
            // alert(da.AlgCatTree.DetailPanels);
            da.RefreshDetailPanels(da.AlgParamTypeTlist.RefPanels, "CleanAlgParamType");
        }
    },
}

$(document).ready(function() {

    da.AlgParamTypeTlist.Refresh();

    $("#AlgParamTypeList tbody").on("click", "tr", function() {
        // alert(da.AlgParamTypeTlist.Table.row(this).data()['IdAlgParamType']);
        da.AlgParamTypeTlist.ToggleRow(this);
    });

    $("#AlgParamTypeTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.AlgParamTypeTlist.Refresh();
    });
})
</script>