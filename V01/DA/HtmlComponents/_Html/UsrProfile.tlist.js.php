<script type="text/javascript" ref="da.UsrProfileTlist">
da.UsrProfileTlist = {
    Entity: 'UsrProfile',
    whoIAm: this.Entity + 'Tlist',
    PanelTag: this.whoIAm + '_',
    SearchIds: '',
    IdUsr: '',
    Table: null,
    Mode: "<?php echo $this->Mode; ?>",
    PageLength: "<?php echo $this->PageLength; ?>",
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    SetUsr: function(data) {
        da.UsrProfileTlist.IdUsr = data["IdUsr"];
        $("#UsrProfileTlist_IdUsr").val(data["IdUsr"]);
        $("#UsrProfileTlist_UsrNam").val(data["Nam"]);
        da.UsrProfileTlist.SearchIds = (data["SearchIds"]) ? data["SearchIds"] : null;

        da.UsrProfileTlist.Refresh();

        // da.UsrProfileRead.IdProfile=data["IdProfile"];
        // alert(da.UsrProfileTlist.DetailPanels);
        da.RefreshDetailPanels(da.UsrProfileTlist.DetailPanels, "SetUsr", data);
    },

    CleanUsr: function() {
        da.UsrProfileTlist.IdUsr = '';
        $("#UsrProfileTlist_IdUsr").val('');
        $("#UsrProfileTlist_UsrNam").val('');
        da.UsrProfileTlist.SearchIds = "";
        // da.RefreshObj("UsrProfileList");
        da.UsrProfileTlist.Refresh();

        // da.UsrProfileRead.IdProfile='';
        da.RefreshDetailPanels(da.UsrProfileTlist.DetailPanels, "CleanUsr");
    },

    Refresh: function() {
        $params = "?";
        if (da.UsrProfileTlist.SearchIds && da.UsrProfileTlist.SearchIds != '') {
            $params += "SearchIds=" + da.UsrProfileTlist.SearchIds;
        }
        if (da.UsrProfileTlist.IdUsr && da.UsrProfileTlist.IdUsr != '') {
            $params += "IdUsr=" + da.UsrProfileTlist.IdUsr;
        } 
        // alert($params);
        if ($.fn.DataTable.isDataTable('#UsrProfileList')) {
            $('#UsrProfileList').DataTable().destroy();
        }

        $('#UsrProfileList tbody').empty();

        da.UsrProfileTlist.Table = $("#UsrProfileList").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": da.UsrProfileTlist.PageLength,
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
                    "width": 150,
                    "targets": 2
                },
                {
                    "width": 10,
                    "targets": 3
                }
            ],
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": "DA/HtmlComponents/ProfileUsr/Tlist.proxy.php" + $params,
                "type": "GET",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdProfileUsr"
                },
                {
                    "data": "IdUsr"
                },
                {
                    "data": "UsrNam"
                },
                {
                    "data": "IdProfile"
                },
                {
                    "data": "ProfileNam"
                }
            ],

        });
        da.UsrProfileTlist.CleanSelectedRow();
    },
    // Get: function(obj) {
    //     data = {
    //         IdProfileUsr: $(obj).children(":nth-child(1)").text(),
    //         IdProfile: $(obj).children(":nth-child(2)").text(),
    //         ProfileNam: $(obj).children(":nth-child(3)").text(),
    //         IdUsr: $(obj).children(":nth-child(4)").text(),
    //         UsrNam: $(obj).children(":nth-child(5)").text(),
    //     };
    //     return data;
    // },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.UsrProfileTlist.CleanSelectedRow();
        } else {
            da.UsrProfileTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            // data = da.UsrProfileTlist.Get(obj);
            data = da.UsrProfileTlist.Table.row($(obj)).data();
            da.UsrProfileTlist.SetSelectedRow(data);
        }
        // da.UsrProfileTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        // if (da.AnCntx_FileTlist.Mode == "TlistRef") {
        //     da.RefreshDetailPanels(da.AnCntx_FileTlist.DetailPanels, "SetRef", data);
        // }
        // if (da.AnCntx_FileTlist.RefPanels && da.AnCntx_FileTlist.RefPanels != '') {
        //     da.RefreshDetailPanels(da.AnCntx_FileTlist.RefPanels, "SetFileRef", data);
        // }
        // alert(da.UsrProfileTlist.DetailPanels);
        if (da.UsrProfileTlist.DetailPanels && da.UsrProfileTlist.DetailPanels != "") {
            // alert(data["IdProfileUsr"]);
            da.UsrProfileRead.IdProfileUsr = data["IdProfileUsr"];
            da.RefreshDetailPanels(da.UsrProfileTlist.DetailPanels, "Refresh");
        }
        // alert(da.UsrProfileTlist.RefPanels);
        if (da.UsrProfileTlist.RefPanels && da.UsrProfileTlist.RefPanels != "") {
            // alert(da.ProfileCatTree.DetailPanels);
            da.RefreshDetailPanels(da.UsrProfileTlist.RefPanels, "SetUsrProfile", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.UsrProfileTlist.DetailPanels && da.UsrProfileTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.UsrProfileTlist.DetailPanels, "Clean");
        }
        // alert(da.UsrProfileTlist.RefPanels);
        if (da.UsrProfileTlist.RefPanels && da.UsrProfileTlist.RefPanels != "") {
            // alert(da.ProfileCatTree.DetailPanels);
            da.RefreshDetailPanels(da.UsrProfileTlist.RefPanels, "CleanUsrProfile");
        }
    },
}

$(document).ready(function() {

    da.UsrProfileTlist.Refresh();

    $("#UsrProfileList tbody").on("click", "tr", function() {
        // alert("#UsrProfileList tbody");
        da.UsrProfileTlist.ToggleRow(this);
    });

    $("#UsrProfileTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.UsrProfileTlist.Refresh();
    });
})
</script>