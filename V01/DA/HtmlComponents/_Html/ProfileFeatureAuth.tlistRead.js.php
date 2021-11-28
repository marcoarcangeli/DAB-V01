<script type="text/javascript" ref="da.ProfileFeatureAuthTlistRead">
da.ProfileFeatureAuthTlistRead = {
    Entity: 'ProfileFeatureAuth',
    whoIAm: this.Entity + 'TlistRead',
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
    AuthLevels: null, // array of AuthLevels types

    btnControl: function() {
        if (da.ProfileFeatureAuthTlistRead.Mode == 'alone') {
            $("#ProfileFeatureAuthTlistReadBtns #btnNew").hide();
        }

        // if ($("#ProfileFeatureAuthTlistRead_IdProfileFeatureAuth").val() == "") {
        //     $("#ProfileFeatureAuthTlistReadBtns #btnRefresh").attr("disabled", true);
        //     // $("#ProfileFeatureAuthTlistReadBtns #btnDelete").attr("disabled", true);
        // } else {
        //     $("#ProfileFeatureAuthTlistReadBtns #btnRefresh").attr("disabled", false);
        //     // $("#ProfileFeatureAuthTlistReadBtns #btnDelete").attr("disabled", false);
        // }

        // if (
        //     da.ProfileFeatureAuthTlistRead.... //&&
        // ) {
        //     $("#ProfileFeatureAuthTlistReadBtns #btnSave").attr("disabled", true);
        // } else {
        //     $("#ProfileFeatureAuthTlistReadBtns #btnSave").attr("disabled", false);
        // }
    },

    SetProfile: function(data) {
        da.ProfileFeatureAuthTlistRead.IdProfile = data["IdProfile"];
        $("#ProfileFeatureAuthTlistRead_IdProfile").val(data["IdProfile"]);
        $("#ProfileFeatureAuthTlistRead_ProfileNam").val(data["Nam"]);
        da.ProfileFeatureAuthTlistRead.SearchIds = (data["SearchIds"]) ? data["SearchIds"] : null;
        da.ProfileFeatureAuthTlistRead.Refresh();
        // da.ProfileFeatureAuthTlistRead.IdProfile=data["IdProfile"];
        // alert(da.ProfileFeatureAuthTlistRead.DetailPanels);
        da.RefreshDetailPanels(da.ProfileFeatureAuthTlistRead.DetailPanels, "SetProfile", data);
    },

    CleanProfile: function() {
        da.ProfileFeatureAuthTlistRead.IdProfile = '';
        $("#ProfileFeatureAuthTlistRead_IdProfile").val('');
        $("#ProfileFeatureAuthTlistRead_ProfileNam").val('');
        da.ProfileFeatureAuthTlistRead.SearchIds = "";
        // da.RefreshObj("ProfileFeatureAuthListRead");
        da.ProfileFeatureAuthTlistRead.Refresh();

        // da.ProfileFeatureAuthTlistRead.IdProfile='';
        da.RefreshDetailPanels(da.ProfileFeatureAuthTlistRead.DetailPanels, "CleanProfile");
    },

    Get: function() {
        Data = da.ProfileFeatureAuthTlistRead.Table.data();
        pfa = [];
        // alert(Data.length);
        $.each(Data, function(index, item) { // Iterates through a collection
            // alert(index);
            if ($("#ProfileFeatureAuthChk"+index).is(":checked")) {
                // alert("IdProfileFeatureAuth: "+Data[index]["IdProfileFeatureAuth"]);
                // alert("IdProfile: "+$("#ProfileFeatureAuthTlistRead_IdProfile").val());
                // alert("IdFeature: "+Data[index]["IdFeature"]);
                // alert("IdAuthLevel: "+$("#ProfileFeatureAuthSel"+index).val());
                pfa.push({
                    IdProfileFeatureAuth: (Data[index]["IdProfileFeatureAuth"])?Data[index]["IdProfileFeatureAuth"]:'',
                    IdProfile: $("#ProfileFeatureAuthTlistRead_IdProfile").val(),
                    IdFeature: Data[index]["IdFeature"],
                    IdAuthLevel: $("#ProfileFeatureAuthSel"+index).val(),
                });
            }
        });
        // alert(pfa.length);
        return pfa;
    },

    Refresh: function() {
        $params = "?";
        if (da.ProfileFeatureAuthTlistRead.SearchIds && da.ProfileFeatureAuthTlistRead.SearchIds !=
            '') {
            $params += "SearchIds=" + da.ProfileFeatureAuthTlistRead.SearchIds;
        }
        if (da.ProfileFeatureAuthTlistRead.IdProfile && da.ProfileFeatureAuthTlistRead.IdProfile !=
            '') {
            $params += "IdProfile=" + da.ProfileFeatureAuthTlistRead.IdProfile;
        }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#ProfileFeatureAuthListRead')) {
            $('#ProfileFeatureAuthListRead').DataTable().destroy();
        }

        $('#ProfileFeatureAuthListRead tbody').empty();

        da.ProfileFeatureAuthTlistRead.Table = $("#ProfileFeatureAuthListRead").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": da.ProfileFeatureAuthTlistRead.PageLength,
            "searching": true,
            "ordering": true,
            "order": [[ 2, "asc" ], [ 4, "asc" ]],
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
                },
                {
                    "width": 100,
                    "targets": 4
                },
                {
                    "width": 70,
                    "targets": 5,
                    "orderable": false,
                    "render": function(data, type, row, meta) {
                        Id = da.ProfileFeatureAuthTlistRead.Entity + 'Sel' + meta["row"];
                        Value = data;
                        Data = da.ProfileFeatureAuthTlistRead.AuthLevels;
                        return da.ProfileFeatureAuthTlistRead.builtAuthLevelDropDownHtml(Id,
                            Value, Data);
                    }
                },
                {
                    "width": 20,
                    "targets": 6,
                    "orderable": false,
                    "render": function(data, type, row, meta) {
                        Id = da.ProfileFeatureAuthTlistRead.Entity + 'Chk' + meta["row"];
                        Value = checked = (data) ? 'checked' : '';
                        return da.ProfileFeatureAuthTlistRead.buildCheckBoxHtml(Id, Value);
                    }
                }
            ],
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": "DA/HtmlComponents/ProfileFeatureAuth/TlistRead.proxy.php" + $params,
                "type": "GET",
                "dataSrc": "data"
            },
            "columns": [{
                    "data": "IdProfileFeatureAuth"
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
                    "data": "Ck"
                },
            ],
        });
        // da.ProfileFeatureAuthTlistRead.CleanSelectedRow();
    },
    // Get: function(obj) {
    //     data = {
    //         IdProfileFeatureAuth: data['IdProfileFeatureAuth'],
    //         IdFeatureCat: data['IdFeatureCat'],
    //         FeatureCatNam: data['FeatureCatNam'],
    //         IdFeature: data['IdFeature'],
    //         FeatureNam: data['FeatureNam'],
    //         IdAuthLevel: data['IdAuthLevel'],
    //         Ck: data['Ck'],
    //         key: data['IdFeature'] + data['IdAuthLevel']
    //     };
    //     return data;
    // },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            // $(obj).removeClass("selected");
            da.ProfileFeatureAuthTlistRead.CleanSelectedRow();
        } else {
            // multiple selection
            // da.ProfileFeatureAuthTlistRead.Table.$("tr.selected").removeClass("selected");
            // $(obj).addClass("selected");
            // data = da.ProfileFeatureAuthTlistRead.Get(obj);
            // data = da.ProfileFeatureAuthTlistRead.Table.row($(obj)).data();
            da.ProfileFeatureAuthTlistRead.SetSelectedRow(data);
        }
        // da.ProfileFeatureAuthTlistRead.btnControl();
    },
    SetSelectedRow: function(data) {
        //details
        if (da.ProfileFeatureAuthTlistRead.DetailPanels && da.ProfileFeatureAuthTlistRead.DetailPanels != "") {
            da.ProfileFeatureAuthTlistRead.IdProfileFeatureAuth = data["IdProfileFeatureAuth"];
            da.RefreshDetailPanels(da.ProfileFeatureAuthTlistRead.DetailPanels, "Refresh");
        }
        // refs;
        if (da.ProfileFeatureAuthTlistRead.RefPanels && da.ProfileFeatureAuthTlistRead.RefPanels != "") {
            // alert(da.ProfileCatTree.DetailPanels);
            da.RefreshDetailPanels(da.ProfileFeatureAuthTlistRead.RefPanels, "SetProfileFeatureAuth", data);
        }
    },
    CleanSelectedRow: function() {
        if (da.ProfileFeatureAuthTlistRead.DetailPanels && da.ProfileFeatureAuthTlistRead.DetailPanels != "") {
            da.RefreshDetailPanels(da.ProfileFeatureAuthTlistRead.DetailPanels, "Clean");
        }
        // alert(da.ProfileFeatureAuthTlistRead.RefPanels);
        if (da.ProfileFeatureAuthTlistRead.RefPanels && da.ProfileFeatureAuthTlistRead.RefPanels != "") {
            // alert(da.ProfileCatTree.DetailPanels);
            da.RefreshDetailPanels(da.ProfileFeatureAuthTlistRead.RefPanels, "CleanProfileFeatureAuth");
        }
    },
    getAuthLevel: function(Id, Value) {
        $.ajax({
            url: "DA/HtmlComponents/AuthLevel/Tlist.proxy.php",
            type: "POST",
            dataType: "json",
            async: true,
            data: "data",
            success: function(response) {
                // alert("popola select records: "+response.data.length);
                da.ProfileFeatureAuthTlistRead.AuthLevels = response.data;
            }
        });
    },

    builtAuthLevelDropDownHtml: function(Id, Value, Data) {
        Html = '<div class="form-group"><select class="form-group form-control" id="' + Id + '" placeholder="' +
            Id + ' ..." value="' + Value + '">';
        Html += '<option value="">Select an Item ...</option>';
        $.each(Data, function(index, item) { // Iterates through a collection
            Html += '<option value="' + item.IdAuthLevel + '"';
            if (Value == item.IdAuthLevel) {
                Html += ' selected="selected"';
            }
            Html += '>' + item.Nam + ' (' + item.IdAuthLevel + ')</option>';
        });
        Html += '</select></div>';
        // alert("builtDropDownHtmlelect: "+Html);
        return Html;
    },

    buildCheckBoxHtml: function(Id, Value) {
        Html = '<input class="form-check-input da-form-check-input" type="checkbox" id="' + Id + '" value="" ' +
            Value + '>';

        return Html; //'<a href="'+data+'">Download</a>';
    },

    Save: function() {
        try {
            // alert(da.ProfileFeatureAuthTlistRead.Get().length);
            if (da.verifyCompulsoryFields(da.ProfileFeatureAuthTlistRead.CompulsoryFields, da
                    .ProfileFeatureAuthTlistRead.PanelTag)) {
                data=JSON.stringify(da.ProfileFeatureAuthTlistRead.Get());
                // alert(data);
                return $.ajax({
                    type: "POST",
                    url: "DA/HtmlComponents/ProfileFeatureAuth/TlistSave.proxy.php",
                    dataType: "json",
                    data: data,
                    error: function(result) {
                        // alert(result["State"]);
                        da.UsrMsgShow(da.ProfileFeatureAuthTlistRead.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["State"]);
                        if (result["State"]) {
                            // $("#ProfileFeatureAuth_IdProfileFeatureAuth").val(result["IdProfileFeatureAuth"]);
                            // alert(da.ProfileFeatureAuthTlistRead.ParentObj);
                            if (da.ProfileFeatureAuthTlistRead.ParentObj) {
                                // alert(da.ProfileFeatureAuthTlistRead.ParentObjType);
                                da.RefreshObj(da.ProfileFeatureAuthTlistRead.ParentObj, da
                                    .ProfileFeatureAuthTlistRead.ParentObjType, "Refresh", null);
                            }
                            da.UsrMsgShow(da.ProfileFeatureAuthTlistRead.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(da.ProfileFeatureAuthTlistRead.FailMsg, "Info");
                        }
                    }
                })
            }else{
                Msg="CompulsoryFields: " + da.ProfileFeatureAuthTlistRead.CompulsoryFields + " not set!<br>";
                da.UsrMsgShow(Msg + da.ProfileFeatureAuthTlistRead.FailMsg, "Info");
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

}


$(document).ready(function() {
    // for row dropdown
    da.ProfileFeatureAuthTlistRead.getAuthLevel();
    //
    da.ProfileFeatureAuthTlistRead.Refresh();

    // $("#ProfileFeatureAuthListRead tbody").on("click", "tr", function() {
    //     da.ProfileFeatureAuthTlistRead.ToggleRow(this);
    // });

    $("#ProfileFeatureAuthTlistReadBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.ProfileFeatureAuthTlistRead.Refresh();
    });

    $("#ProfileFeatureAuthTlistReadBtns #btnSave").click(function() {
        da.ProfileFeatureAuthTlistRead.Save();
    });

})
</script>