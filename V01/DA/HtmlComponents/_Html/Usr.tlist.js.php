<script type="text/javascript" ref="da.UsrTlist">
da.UsrTlist = {
    Entity: 'Usr',
    whoIAm: this.Entity + 'Tlist',
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

    Refresh: function() {
        $params = "?";
        if (da.UsrTlist.SearchIds && da.UsrTlist.SearchIds != '') {
            $params += "SearchIds=" + da.UsrTlist.SearchIds;
        }
        if (da.UsrTlist.IdUsr && da.UsrTlist.IdUsr != '') {
            $params += "IdUsr=" + da.UsrTlist.IdUsr;
        }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#UsrList')) {
            $('#UsrList').DataTable().destroy();
        }

        $('#UsrList tbody').empty();

        da.UsrTlist.Table = $("#UsrList").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": da.UsrTlist.PageLength,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "scrollX": true,
            "columnDefs": [{
                    "width": 100,
                    "targets": 0
                },
                {
                    "width": 100,
                    "targets": 1
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
                    "width": 100,
                    "targets": 6
                }
            ],
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": "DA/HtmlComponents/Usr/Tlist.proxy.php",
                "type": "POST",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdUsr"
                },
                {
                    "data": "UsrNam"
                },
                {
                    "data": "Pwd"
                },
                {
                    "data": "FirstNam"
                },
                {
                    "data": "Nam"
                },
                {
                    "data": "EMail"
                },
                {
                    "data": "IdOrganization"
                },
                {
                    "data": "OrganizationNam"
                },
            ],
        });
        da.UsrTlist.CleanSelectedRow();
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.UsrTlist.CleanSelectedRow();
        } else {
            da.UsrTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            // data = da.UsrTlist.Get(obj);
            data = da.UsrTlist.Table.row($(obj)).data();
            da.UsrTlist.SetSelectedRow(data);
        }
        // da.UsrTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        // if (da.AnCntx_FileTlist.Mode == "TlistRef") {
        //     da.RefreshDetailPanels(da.AnCntx_FileTlist.DetailPanels, "SetRef", data);
        // }
        // if (da.AnCntx_FileTlist.RefPanels && da.AnCntx_FileTlist.RefPanels != '') {
        //     da.RefreshDetailPanels(da.AnCntx_FileTlist.RefPanels, "SetFileRef", data);
        // }
        if (da.UsrTlist.DetailPanels && da.UsrTlist.DetailPanels != "") {
            da.UsrRead.IdUsr = data["IdUsr"];
            da.RefreshDetailPanels(da.UsrTlist.DetailPanels, "Refresh");
        }
        // alert(da.UsrTlist.RefPanels);
        if (da.UsrTlist.RefPanels && da.UsrTlist.RefPanels != "") {
            // alert(da.ProfileCatTree.DetailPanels);
            da.RefreshDetailPanels(da.UsrTlist.RefPanels, "SetUsr", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.UsrTlist.DetailPanels && da.UsrTlist.DetailPanels != "") {
            da.RefreshDetailPanels(da.UsrTlist.DetailPanels, "Clean");
        }
        // alert(da.UsrTlist.RefPanels);
        if (da.UsrTlist.RefPanels && da.UsrTlist.RefPanels != "") {
            // alert(da.ProfileCatTree.DetailPanels);
            da.RefreshDetailPanels(da.UsrTlist.RefPanels, "CleanUsr");
        }
    },

}

$(document).ready(function() {
    da.UsrTlist.Refresh();

    $("#UsrList tbody").on("click", "tr", function() {
        da.UsrTlist.ToggleRow(this);
    });

    $("#UsrTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.UsrTlist.Refresh();
    });

    // $(function() {
    //     var table = $("#UsrList").DataTable({
    //         "paging": true,
    //         "lengthChange": false,
    //         "pageLength": da.UsrTlist.PageLength,
    //         "searching": true,
    //         "ordering": true,
    //         "info": true,
    //         "autoWidth": false,
    //         "responsive": true,
    //         "scrollX": true,
    //         "columnDefs": [{
    //                 "width": 100,
    //                 "targets": 0
    //             },
    //             {
    //                 "width": 100,
    //                 "targets": 1
    //             },
    //             {
    //                 "width": 100,
    //                 "targets": 3
    //             },
    //             {
    //                 "width": 100,
    //                 "targets": 4
    //             },
    //             {
    //                 "width": 100,
    //                 "targets": 6
    //             }
    //         ],
    //         "fixedColumns": true,
    //         "processing": true,
    //         "serverSide": false,
    //         "ajax": {
    //             "url": "DA/HtmlComponents/Usr/Tlist.proxy.php",
    //             "type": "POST",
    //             "dataSrc": "data"
    //         },
    //         "columns": [{
    //                 "data": "IdUsr"
    //             },
    //             {
    //                 "data": "UsrNam"
    //             },
    //             {
    //                 "data": "Pwd"
    //             },
    //             {
    //                 "data": "FirstNam"
    //             },
    //             {
    //                 "data": "Nam"
    //             },
    //             {
    //                 "data": "EMail"
    //             },
    //             {
    //                 "data": "IdOrganization"
    //             },
    //             {
    //                 "data": "OrganizationNam"
    //             },
    //         ],
    //     });

    //     $("#UsrList tbody").on("click", "tr", function() {
    //         if ($(this).hasClass("selected")) {
    //             $(this).removeClass("selected");
    //             da.RefreshDetailPanels(da.UsrTlist.DetailPanels, "Clean");
    //         } else {
    //             table.$("tr.selected").removeClass("selected");
    //             $(this).addClass("selected");
    //             data = {
    //                 IdUsr: $(this).children(":nth-child(1)").text(),
    //                 UsrNam: $(this).children(":nth-child(2)").text(),
    //                 Pwd: $(this).children(":nth-child(3)").text(),
    //                 FirstNam: $(this).children(":nth-child(4)").text(),
    //                 Nam: $(this).children(":nth-child(5)").text(),
    //                 EMail: $(this).children(":nth-child(6)").text(),
    //             }
    //             da.UsrRead.IdUsr = data["IdUsr"];
    //             da.RefreshDetailPanels(da.UsrTlist.DetailPanels, "Refresh");
    //         }

    //     });

    //     // $("#btnRefreshUsrs").click(function() {
    //     //     // alert("Update tabella");
    //     // });

    // });


})
</script>