<script type="text/javascript" ref="da.ProfileUsrTlist">
da.ProfileUsrTlist = {

    whoIAm: 'ProfileUsrTlist',
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
        if(data){
            da.ProfileUsrTlist.IdProfile = data["IdProfile"];
            $("#ProfileUsrTlist_IdProfile").val(data["IdProfile"]);
            $("#ProfileUsrTlist_ProfileNam").val(data["Nam"]);
            da.ProfileUsrTlist.SearchIds = (data["SearchIds"]) ? data["SearchIds"] : null;
            
        }else{
            da.ProfileUsrTlist.CleanProfile; 
        }

        da.ProfileUsrTlist.Refresh();

        // da.ProfileUsrRead.IdProfile=data["IdProfile"];
        // alert(da.ProfileUsrTlist.DetailPanels);
        da.RefreshDetailPanels(da.ProfileUsrTlist.DetailPanels, "SetProfile", data);
    },

    CleanProfile: function() {
        da.ProfileUsrTlist.IdProfile = '';
        $("#ProfileUsrTlist_IdProfile").val('');
        $("#ProfileUsrTlist_ProfileNam").val('');
        da.ProfileUsrTlist.SearchIds = "";
        // da.RefreshObj("ProfileUsrList");
        da.ProfileUsrTlist.Refresh();

        // da.ProfileUsrRead.IdProfile='';
        da.RefreshDetailPanels(da.ProfileUsrTlist.DetailPanels, "CleanProfile");
    },

    Refresh: function() {
        $params = "?";
        if (da.ProfileUsrTlist.SearchIds && da.ProfileUsrTlist.SearchIds != '') {
            $params += "SearchIds=" + da.ProfileUsrTlist.SearchIds;
        }
        // idProfile is compulsory
        if (da.ProfileUsrTlist.IdProfile && da.ProfileUsrTlist.IdProfile != '') {
            $params += "IdProfile=" + da.ProfileUsrTlist.IdProfile;
        }

        // alert($params);
        if ($.fn.DataTable.isDataTable('#ProfileUsrList')) {
            $('#ProfileUsrList').DataTable().destroy();
        }

        $('#ProfileUsrList tbody').empty();

        da.ProfileUsrTlist.Table = $("#ProfileUsrList").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": da.ProfileUsrTlist.PageLength,
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
                    "data": "IdProfile"
                },
                {
                    "data": "ProfileNam"
                },
                {
                    "data": "IdUsr"
                },
                {
                    "data": "UsrNam"
                }
            ],

        });
        da.ProfileUsrTlist.CleanSelectedRow();
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
            da.ProfileUsrTlist.CleanSelectedRow();
        } else {
            da.ProfileUsrTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            // data = da.ProfileUsrTlist.Get(obj);
            data = da.ProfileUsrTlist.Table.row($(obj)).data();
            da.ProfileUsrTlist.SetSelectedRow(data);
        }
        // da.ProfileUsrTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        // if (da.AnCntx_FileTlist.Mode == "TlistRef") {
        //     da.RefreshDetailPanels(da.AnCntx_FileTlist.DetailPanels, "SetRef", data);
        // }
        // if (da.AnCntx_FileTlist.RefPanels && da.AnCntx_FileTlist.RefPanels != '') {
        //     da.RefreshDetailPanels(da.AnCntx_FileTlist.RefPanels, "SetFileRef", data);
        // }
        if (da.ProfileUsrTlist.DetailPanels && da.ProfileUsrTlist.DetailPanels != "") {
            da.ProfileUsrRead.IdProfileUsr = data["IdProfileUsr"];
            da.RefreshDetailPanels(da.ProfileUsrTlist.DetailPanels, "Refresh");
        }
        // alert(da.ProfileUsrTlist.RefPanels);
        if (da.ProfileUsrTlist.RefPanels && da.ProfileUsrTlist.RefPanels != "") {
            // alert(da.ProfileCatTree.DetailPanels);
            da.RefreshDetailPanels(da.ProfileUsrTlist.RefPanels, "SetProfileUsr", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.ProfileUsrTlist.DetailPanels && da.ProfileUsrTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.ProfileUsrTlist.DetailPanels, "Clean");
        }
        // alert(da.ProfileUsrTlist.RefPanels);
        if (da.ProfileUsrTlist.RefPanels && da.ProfileUsrTlist.RefPanels != "") {
            // alert(da.ProfileCatTree.DetailPanels);
            da.RefreshDetailPanels(da.ProfileUsrTlist.RefPanels, "CleanProfileUsr");
        }
    },
}

$(document).ready(function() {

    da.ProfileUsrTlist.Refresh();

    $("#ProfileUsrList tbody").on("click", "tr", function() {
        // alert("ProfileUsrList tbody");
        da.ProfileUsrTlist.ToggleRow(this);
    });

    $("#ProfileUsrTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.ProfileUsrTlist.Refresh();
    });
})
</script>