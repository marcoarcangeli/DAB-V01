<script type="text/javascript" ref="da.ProfileFeatureAuthTlist">
da.ProfileFeatureAuthTlist = {
    Entity: 'ProfileFeatureAuth',
    whoIAm: this.Entity+'Tlist',
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

    SetProfile: function(data) {
        da.ProfileFeatureAuthTlist.IdProfile = data["IdProfile"];
        $("#ProfileFeatureAuthTlist_IdProfile").val(data["IdProfile"]);
        $("#ProfileFeatureAuthTlist_ProfileNam").val(data["Nam"]);
        da.ProfileFeatureAuthTlist.SearchIds = (data["SearchIds"]) ? data["SearchIds"] : null;

        da.ProfileFeatureAuthTlist.Refresh();

        // da.ProfileFeatureAuthRead.IdProfile=data["IdProfile"];
        // alert(da.ProfileFeatureAuthTlist.DetailPanels);
        da.RefreshDetailPanels(da.ProfileFeatureAuthTlist.DetailPanels, "SetProfile", data);
    },

    CleanProfile: function() {
        da.ProfileFeatureAuthTlist.IdProfile = '';
        $("#ProfileFeatureAuthTlist_IdProfile").val('');
        $("#ProfileFeatureAuthTlist_ProfileNam").val('');
        da.ProfileFeatureAuthTlist.SearchIds = "";
        // da.RefreshObj("ProfileFeatureAuthList");
        da.ProfileFeatureAuthTlist.Refresh();

        // da.ProfileFeatureAuthRead.IdProfile='';
        da.RefreshDetailPanels(da.ProfileFeatureAuthTlist.DetailPanels, "CleanProfile");
    },

    Refresh: function() {
        // $params = "?";
        // if (da.ProfileFeatureAuthTlist.SearchIds && da.ProfileFeatureAuthTlist.SearchIds != '') {
        //     $params += "SearchIds=" + da.ProfileFeatureAuthTlist.SearchIds;
        // }
        // if (da.ProfileFeatureAuthTlist.IdProfile && da.ProfileFeatureAuthTlist.IdProfile != '') {
        //     $params += "IdProfile=" + da.ProfileFeatureAuthTlist.IdProfile;
        // }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#ProfileFeatureAuthList')) {
            $('#ProfileFeatureAuthList').DataTable().destroy();
        }

        $('#ProfileFeatureAuthList tbody').empty();

        da.ProfileFeatureAuthTlist.Table = $("#ProfileFeatureAuthList").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": da.ProfileFeatureAuthTlist.PageLength,
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
                    "width": 10,
                    "targets": 2
                },
                {
                    "width": 10,
                    "targets": 3
                },
                {
                    "width": 10,
                    "targets": 4
                },
                {
                    "width": 10,
                    "targets": 5
                },
                {
                    "width": 10,
                    "targets": 7
                },
                {
                    "width": 20,
                    "targets": 8
                }
            ],
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                // "url": "DA/HtmlComponents/ProfileFeatureAuth/Tlist.proxy.php",
                "url": "DA/HtmlComponents/ProfileFeatureAuth/UI.proxy.php",
                "type": "POST",
                "dataSrc": "data",
                "data": {
                    "SrvOpParams": {
                        "SrvOpNam"  : "Tlist",
                        "Entity"    : da.ProfileFeatureAuthTlist.Entity,
                        "CompulsoryParamNams":    "SearchIds",
                    },
                    "RequestParams" : {
                        "IdProfile" : da.ProfileFeatureAuthTlist.IdProfile,
                        "SearchIds" : da.ProfileFeatureAuthTlist.SearchIds,
                    },
                    // "ResposeParams" : {
                    //     "IdProfile" : da.ProfileFeatureAuthTlist.IdProfile,
                    //     "SearchIds" : da.ProfileFeatureAuthTlist.SearchIds,
                    // },
                },
            },
            "columns": [
                {
                    "data": "IdProfileFeatureAuth"
                },
                {
                    "data": "IdProfile"
                },
                {
                    "data": "ProfileNam"
                },
                {
                    "data": "IdFeatureCat"
                },
                {
                    "data": "FeatureCatNam"
                },
                {
                    "data": "IdFeature"
                },
                {
                    "data": "FeatureNam"
                },
                {
                    "data": "IdAuthLevel"
                },
                {
                    "data": "AuthLevelNam"
                },
            ],
        });
        da.ProfileFeatureAuthTlist.CleanSelectedRow();
    },
    // Get: function(obj) {
    //     data = {
    //         IdProfileFeatureAuth: $(obj).children(":nth-child(1)").text(),
    //         IdProfile: $(obj).children(":nth-child(2)").text(),
    //         ProfileNam: $(obj).children(":nth-child(3)").text(),
    //         IdFeatureCat: $(obj).children(":nth-child(4)").text(),
    //         FeatureCatNam: $(obj).children(":nth-child(5)").text(),
    //         IdFeature: $(obj).children(":nth-child(6)").text(),
    //         FeatureNam: $(obj).children(":nth-child(7)").text(),
    //         IdAuthLevel: $(obj).children(":nth-child(8)").text(),
    //         AuthLevelNam: $(obj).children(":nth-child(9)").text(),
    //     };
    //     return data;
    // },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.ProfileFeatureAuthTlist.CleanSelectedRow();
        } else {
            da.ProfileFeatureAuthTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            // data = da.ProfileFeatureAuthTlist.Get(obj);
            data = da.ProfileFeatureAuthTlist.Table.row($(obj)).data();
            da.ProfileFeatureAuthTlist.SetSelectedRow(data);
        }
        // da.ProfileFeatureAuthTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        // if (da.AnCntx_FileTlist.Mode == "TlistRef") {
        //     da.RefreshDetailPanels(da.AnCntx_FileTlist.DetailPanels, "SetRef", data);
        // }
        // if (da.AnCntx_FileTlist.RefPanels && da.AnCntx_FileTlist.RefPanels != '') {
        //     da.RefreshDetailPanels(da.AnCntx_FileTlist.RefPanels, "SetFileRef", data);
        // }
        if (da.ProfileFeatureAuthTlist.DetailPanels && da.ProfileFeatureAuthTlist.DetailPanels != "") {
            da.ProfileFeatureAuthRead.IdProfileFeatureAuth = data["IdProfileFeatureAuth"];
            da.RefreshDetailPanels(da.ProfileFeatureAuthTlist.DetailPanels, "Refresh");
        }
        // alert(da.ProfileFeatureAuthTlist.RefPanels);
        if (da.ProfileFeatureAuthTlist.RefPanels && da.ProfileFeatureAuthTlist.RefPanels != "") {
            // alert(da.ProfileCatTree.DetailPanels);
            da.RefreshDetailPanels(da.ProfileFeatureAuthTlist.RefPanels, "SetProfileFeatureAuth", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.ProfileFeatureAuthTlist.DetailPanels && da.ProfileFeatureAuthTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.ProfileFeatureAuthTlist.DetailPanels, "Clean");
        }
        // alert(da.ProfileFeatureAuthTlist.RefPanels);
        if (da.ProfileFeatureAuthTlist.RefPanels && da.ProfileFeatureAuthTlist.RefPanels != "") {
            // alert(da.ProfileCatTree.DetailPanels);
            da.RefreshDetailPanels(da.ProfileFeatureAuthTlist.RefPanels, "CleanProfileFeatureAuth");
        }
    },
}

$(document).ready(function() {

    da.ProfileFeatureAuthTlist.Refresh();

    $("#ProfileFeatureAuthList tbody").on("click", "tr", function() {
        da.ProfileFeatureAuthTlist.ToggleRow(this);
    });

    $("#ProfileFeatureAuthTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.ProfileFeatureAuthTlist.Refresh();
    });
})
</script>