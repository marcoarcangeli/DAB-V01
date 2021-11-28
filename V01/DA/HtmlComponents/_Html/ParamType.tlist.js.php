<script type="text/javascript" ref="da.ParamTypeTlist">
da.ParamTypeTlist = {
    Entity: 'ParamType',
    whoIAm: this.Entity + 'Tlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    IdParamType: '',
    Table: null,
    Mode: "<?php echo $this->Mode; ?>",
    PageLength: "<?php echo $this->PageLength; ?>",
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',
    Data: null,

    SetParamTypeCat: function(data) {
        // alert(data["IdParamTypeCat"]);
        // alert(data["ParamTypeCatNam"]);
        da.ParamTypeTlist.IdParamTypeCat = data["IdParamTypeCat"];
        $("#ParamTypeTlist_IdParamTypeCat").val(data["IdParamTypeCat"]);
        $("#ParamTypeTlist_ParamTypeCatNam").val(data["ParamTypeCatNam"]);
        da.ParamTypeTlist.SearchIds = data["SearchIds"];
        // data=da.ParamTypeTlist.Get();
        data=da.ParamTypeTlist.Data;
        da.ParamTypeTlist.Refresh(data);

        if (da.ParamTypeTlist.Mode == "Tlist") {
            da.ParamTypeRead.IdParamTypeCat = data["IdParamTypeCat"];
            da.RefreshDetailPanels(da.ParamTypeTlist.DetailPanels, "SetParamTypeCat", data);
        }
    },
    CleanParamTypeCat: function() {
        // alert(data["IdParamTypeCat"]);
        // alert(data["ParamTypeCatNam"]);
        data=da.ParamTypeTlist.Clean();
        // da.ParamTypeTlist.IdParamTypeCat = data['IdParamTypeCat'];
        $("#ParamTypeTlist_IdParamTypeCat").val(da.ParamTypeTlist.IdParamTypeCat = '');
        $("#ParamTypeTlist_ParamTypeCatNam").val('');
        da.ParamTypeTlist.SearchIds = '';
        // da.RefreshObj("ParamTypeList");
        da.ParamTypeTlist.Refresh(data);

        if (da.ParamTypeTlist.Mode == "Tlist") {
            da.ParamTypeRead.IdParamTypeCat = '';
            da.RefreshDetailPanels(da.ParamTypeTlist.DetailPanels, "CleanParamTypeCat");
        }
    },
    Refresh: function(data) {
        if(data){
            da.ParamTypeTlist.IdParamType   = (data['IdParamType']) ? data['IdParamType']   : '';
            // da.ParamTypeTlist.SearchIds     = (data['SearchIds'])   ? data['SearchIds']     : '';
            // alert(da.AlgParamTypeTlist.IdParamType);
        }
        $params = "?";
        if (da.ParamTypeTlist.IdParamType && da.ParamTypeTlist.IdParamType != '') {
            $params += "IdParamType=" + da.ParamTypeTlist.IdParamType;
        }
        // for Categorized entities
        if (da.ParamTypeTlist.SearchIds && da.ParamTypeTlist.SearchIds != '') {
            $params += "SearchIds=" + da.ParamTypeTlist.SearchIds;
        }
        // as Ref
        // if (da.ParamTypeTlist.IdAlg && da.ParamTypeTlist.IdAlg != '') {
        //     $params += "IdAlg=" + da.ParamTypeTlist.IdAlg;
        // }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#ParamTypeList')) {
            $('#ParamTypeList').DataTable().destroy();
        }

        $('#ParamTypeList tbody').empty();

        da.ParamTypeTlist.Table = $("#ParamTypeList").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": da.ParamTypeTlist.PageLength,
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
                },
                {
                    "width": 50,
                    "targets": 5
                }
            ],
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": "DA/HtmlComponents/ParamType/Tlist.proxy.php" + $params,
                "type": "GET",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdParamType"
                },
                {
                    "data": "IdParamTypeCat"
                },
                {
                    "data": "ParamTypeCatNam"
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
        da.ParamTypeTlist.CleanSelectedRow(data);
    },
    Get: function(obj) {
        data = {
            IdParamType: $(obj).children(":nth-child(1)").text(),
            IdParamTypeCat: $(obj).children(":nth-child(2)").text(),
            ParamTypeCatNam: $(obj).children(":nth-child(3)").text(),
            Nam: $(obj).children(":nth-child(4)").text(),
            Descr: $(obj).children(":nth-child(5)").text(),
            Unit: $(obj).children(":nth-child(6)").text(),
            vlDefault: $(obj).children(":nth-child(7)").text(),
        };
        return data;
    },

    Clean: function() {
        data = {
            IdParamType: '',
            IdParamTypeCat: '',
            ParamTypeCatNam: '',
            Nam: '',
            Descr: '',
            Unit: '',
            vlDefault: '',
        };
        return data;
    },
    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            data =da.ParamTypeTlist.Data= da.ParamTypeTlist.Clean();
            da.ParamTypeTlist.CleanSelectedRow(data);
        } else {
            da.ParamTypeTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            // data = da.ParamTypeTlist.Get(obj);
            data=da.ParamTypeTlist.Data=da.ParamTypeTlist.Table.row($(obj)).data();
            da.ParamTypeTlist.SetSelectedRow(data);
        }
        // da.ParamTypeTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.ParamTypeTlist.DetailPanels && da.ParamTypeTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.ParamTypeTlist.DetailPanels, "Refresh", data);
        }
        // alert(da.ParamTypeTlist.RefPanels);
        if (da.ParamTypeTlist.RefPanels && da.ParamTypeTlist.RefPanels != "") {
            // alert(data['IdParamType']);
            da.RefreshDetailPanels(da.ParamTypeTlist.RefPanels, "SetParamType", data);
        }
    },
    CleanSelectedRow: function(data) {
        if (da.ParamTypeTlist.DetailPanels && da.ParamTypeTlist.DetailPanels != "") {
            if (da.ParamTypeTlist.Mode == "TlistPar") {
                // for Tlist panels
                da.RefreshDetailPanels(da.ParamTypeTlist.DetailPanels, "Refresh",data);
            } else {
                // for read panels
                da.RefreshDetailPanels(da.ParamTypeTlist.DetailPanels, "Clean");
            }
        }
        // alert(da.ParamTypeTlist.RefPanels);
        if (da.ParamTypeTlist.RefPanels && da.ParamTypeTlist.RefPanels != "") {
            // alert(da.ParamTypeCatTree.DetailPanels);
            da.RefreshDetailPanels(da.ParamTypeTlist.RefPanels, "CleanParamType");
        }
    },
}

$(document).ready(function() {
    da.ParamTypeTlist.Refresh();

    $("#ParamTypeList tbody").on("click", "tr", function() {
        da.ParamTypeTlist.ToggleRow(this);
    });

    $("#ParamTypeTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.ParamTypeTlist.Refresh();
    });


})
</script>