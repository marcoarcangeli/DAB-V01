<script type="text/javascript" ref="da.EvntStruct">
da.EvntStruct = {
    whoIAm: "EvntStruct",
    PanelTag: this.whoIAm + "_",
    FsManagerCntx: "Prjs",
    Struct: [],
    NamArr: [],
    TypeArr: [],
    UnitArr: [],
    FilterArr: [],
    CheckedArr: [],
    NewNam: "",
    NewType: "",
    NewUnit: "",
    NewCheck: "",
    NumCol: 0,
    RColTypesSelectHtml: '',
    FileNamRepoDat: '<?php echo $_SESSION["PSV"]["FileNamRepoDat"] ?>',
    StructBaseNam: '<?php echo $_SESSION["PSV"]["FileNamRepoDat"].$_SESSION["AnTypeStruct"].$_SESSION["DatCSVFile"] ?>',
    StructDirNam: '<?php echo $_SESSION["PrjAbsPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'.$_SESSION["PSV"]["EvntFolderNam"].'/'; ?>',
    Mode: "<?php echo $this->Mode; ?>",
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    // not necessary cause btns are always enabled
    // btnControl: function() {
    //     if ($("#EvntStruct_SelectedFile").val() == "") {
    //         $("#EvntStructBtns #btnDownload").attr("disabled", true);
    //         $("#EvntStructBtns #btnDelete").attr("disabled", true);
    //     } else {
    //         $("#EvntStructBtns #btnDownload").attr("disabled", false);
    //         $("#EvntStructBtns #btnDelete").attr("disabled", false);
    //     }
    // },

    SetParamsFromPrjState: function() {
        prjState = da.PrjView.Get();

        da.EvntStruct.FileNamRepoDat = (prjState["FileNamRepoDat"] ? prjState["FileNamRepoDat"] :
            '<?php echo $_SESSION["PSV"]["FileNamRepoDat"]; ?>');
        da.EvntStruct.StructBaseNam = da.EvntStruct.FileNamRepoDat +
            '<?php echo $_SESSION["AnTypeStruct"].$_SESSION["DatCSVFile"] ?>';
        da.EvntStruct.StructDirNam =
            '<?php echo $_SESSION["PrjAbsPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
            (prjState["EvntFolderNam"] ? prjState["EvntFolderNam"] :
                '<?php echo $_SESSION["PSV"]["EvntFolderNam"]; ?>') + '/';

        return prjState;
    },

    getFilterCol: function() {
        // alert("getNewType")
        NewNam = "";
        NewType = "";
        NewUnit = "";
        // se Struct esiste
        for (let i = 0; i < da.EvntStruct.ColNum; ++i) {
            if ($("#EvntStructChk" + i).is(":checked")) {
                // alert(da.EvntStruct.NamArr[i]+',')
                NewNam += da.EvntStruct.NamArr[i] + ',';
                NewType += da.EvntStruct.TypeArr[i] + ',';
                NewUnit += da.EvntStruct.UnitArr[i] + ',';
            }
        }
        da.EvntStruct.NewNam = NewNam.slice(0, -1);
        da.EvntStruct.NewType = NewType.slice(0, -1);
        da.EvntStruct.NewUnit = NewUnit.slice(0, -1);
        // alert("NewNam "+da.EvntStruct.NewNam)
        // alert("NewType "+da.EvntStruct.NewType)
        // alert("NewUnit "+da.EvntStruct.NewUnit)
        // return FilterCol;
    },

    BuildStructList: function(data) {
        // alert("BuildStructList")
        NamArr = [];
        TypeArr = [];
        UnitArr = [];
        FilterArr = [];
        CheckedArr = [];
        ColNum = 0;
        // se Struct esiste
        if (data) {
            // estrai ColNam,ColType,ColNum,RowNum,Unit
            for (let i = 0; i < data.length; ++i) {
                // split ColNam,ColType,Unit
                // alert(data[i][0]);
                if (data[i][0] == 'ColNam') {
                    da.EvntStruct.NamArr = NamArr = data[i][1].split(',');
                    // alert(NamArr);
                } else if (data[i][0] == 'ColType') {
                    da.EvntStruct.TypeArr = TypeArr = data[i][1].split(',');
                    // alert(TypeArr);
                } else if (data[i][0] == 'Unit') {
                    da.EvntStruct.UnitArr = UnitArr = data[i][1].split(',');
                    // alert(UnitArr);
                } else if (data[i][0] == 'ColNum') {
                    da.EvntStruct.ColNum = ColNum = data[i][1];
                    // alert(ColNum);
                } else if (ColNum != 0) {
                    // alert(ColNum);
                    da.EvntStruct.FilterArr = FilterArr = ",".repeat(ColNum - 1).split(',');
                    // alert(FilterArr);
                }
            }

            if (cnsdString = $("#Clean_cnsd").val()) {
                if (cnsdString.trim() != '') {
                    da.EvntStruct.CheckedArr = CheckedArr = cnsdString.split(',');
                    // alert(ColNum);
                }
            }
            // alert('cnsdString '+cnsdString);
        }
        // var dims = da.EvntStruct.Struct;
        // todo: risolvere la dipendenza con i campi parametro del Clean
        // alert(dims.length);
        if (ColNum > 0) {
            Html = '<table class="table table-bordered table-hover display">';
            Html += '<tr>';
            Html += '<th>Chk</th>';
            Html += '<th>Nam</th>';
            Html += '<th>NewNam</th>';
            Html += '<th>Type</th>';
            Html += '<th>NewType</th>';
            Html += '<th>Unit</th>';
            Html += '<th>Filter</th>';
            Html += '</tr>';
            /*<option selected="selected">
            <option value='numeric'> numeric</option>
            <option value='integer'> integer</option>
            <option value='double'> double</option>
            <option value='factor'> factor</option>
            <option value='character'> character</option>
            */
            for (let i = 0; i < ColNum; ++i) {
                // alert('CheckedArr.length '+CheckedArr.length);
                chk = 'checked';
                if (CheckedArr.length > 0) {
                    if (jQuery.inArray(NamArr[i], CheckedArr) == -1) {
                        chk = '';
                    }
                }
                Html += '<tr>';
                Html += '<td>';
                Html +=
                    '<input class="form-check-input da-form-check-input" type="checkbox" id="EvntStructChk' +
                    i + '" value="" ' + chk + '>';
                Html += '</td>';
                Html += '<td>';
                Html += NamArr[i];
                Html += '</td>';
                Html += '<td>';
                Html += '<input type="text" class="form-control" id="EvntStructNewNam' + i +
                    '" placeholder="NewNam ..." value="' + NamArr[i] + '" >';
                Html += '</td>';
                Html += '<td>';
                Html += TypeArr[i];
                Html += '</td>';
                Html += '<td>';
                // Html += '<input type="text" class="form-control" id="EvntStructNewType' + i + '" placeholder="NewType ..." value="'+TypeArr[i]+'" >';
                Html += '<select class="form-control form-control-sm" id="EvntStructNewType' + i +
                    '" placeholder="NewType ..." value="' + TypeArr[i] + '" >';
                Html += da.EvntStruct.RColTypesSelectHtml.replace("value='" + TypeArr[i] + "'", "value='" +
                    TypeArr[i] + "' selected='selected'");
                // alert(da.EvntStruct.RColTypesSelectHtml.replace("value='"+TypeArr[i]+"'","value='"+TypeArr[i]+"' selected='selected'"));
                Html += '</select>';
                Html += '</td>';
                Html += '<td>';
                Html += '<input type="text" class="form-control" id="EvntStructNewUnit' + i +
                    '" placeholder="Unit ..." value="' + UnitArr[i] + '" >';
                Html += '</td>';
                Html += '<td>';
                Html += '<input type="text" class="form-control" id="EvntStructFilter' + i +
                    '" placeholder="Filter ..." value="' + FilterArr[i] + '" >';
                Html += '</td>';
                Html += '</tr>';
            }
            Html += '</table>';
            $("#EvntStructTlist").html(Html);
        }
    },

    // not completed
    // Apply: function() {
    //     // $("#Evnt_IdEvnt").val("");
    //     if (da.Evnt.dati.Tlist.cols.length > 0) {
    //         da.EvntStruct.Struct = da.Evnt.dati.Tlist.cols;
    //         da.EvntStruct.BuildStructList();

    //         if (typeof da.EvntDatiPulitiTlist !== "undefined") {
    //             if ($.isFunction(da.EvntDatiPulitiTlist.Update)) {
    //                 da.EvntDatiPulitiTlist.RefreshObj();
    //             }
    //         }
    //     }
    // },

    // Clean: function() {
    //     // $("#Evnt_IdEvnt").val("");
    //     if (da.Evnt.dati.Tlist.cols.length > 0) {
    //         da.EvntStruct.Struct = da.Evnt.dati.Tlist.cols;
    //         da.EvntStruct.BuildStructList();

    //         if (typeof da.EvntDatiPulitiTlist !== "undefined") {
    //             if ($.isFunction(da.EvntDatiPulitiTlist.Update)) {
    //                 da.EvntDatiPulitiTlist.RefreshObj();
    //             }
    //         }
    //     }
    // },

    Refresh: function() {
        try {
            prjState = da.EvntStruct.SetParamsFromPrjState();

            // alert(da.EvntStruct.StructDirNam+da.EvntStruct.StructBaseNam);
            if (da.EvntStruct.FileNamRepoDat && da.EvntStruct.FileNamRepoDat != '') {
                // var Delimiter = ";";
                // alert(FilePath);
                return $.ajax({
                    type: "POST",
                    url: "DA/FsComponents/CSVToFromJSON.proxy.php",
                    async: true,
                    dataType: "json",
                    data: {
                        FilePath: da.EvntStruct.StructDirNam,
                        FileNam: da.EvntStruct.StructBaseNam,
                        // FileString : "",
                        Delimiter: '<?php echo $_SESSION["CSVDefaultSep"]; ?>',
                        // Encoded    : "",
                        // DatArr     : null,
                        // ResultType : "",
                        Method: "CsvToJson"
                    },
                    error: function(result) {
                        da.UsrMsgShow(da.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert("ritorno : " + result);
                        // resultArray = JSON.parse(result);
                        // alert("ritorno status: " + resultArray["State"]);
                        data = result["Data"];
                        da.EvntStruct.BuildStructList(data);
                        // da.EvntStruct.BuildDataTable(data);
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    getRColTypeSelectHtml: function() {
        // if(selectCtrl){
        // alert(selectCtrl.attr("id"));
        $.ajax({
            url: "DA/HtmlComponents/RColType/Tlist.proxy.php",
            type: "POST",
            dataType: "json",
            async: true,
            data: "data",
            success: function(response) {
                // alert("popola select records: "+response.data.length);
                optionHtml = '';
                // optionHtml += "<option value='+item.Nam+'> " + item.Nam + "</option>";
                $.each(response.data, function(index, item) { // Iterates through a collection
                    optionHtml += "<option value='" + item.Nam + "'> " + item.Nam +
                        "</option>";
                });
                // alert(optionHtml);
                da.EvntStruct.RColTypesSelectHtml = optionHtml;
            }
        });
        // }
    },

}

$(document).ready(function() {
    //popola select ...
    da.EvntStruct.getRColTypeSelectHtml()

    // unit select

    if (da.EvntStruct.Mode = "alone") {
        da.EvntStruct.Refresh();
    }

    $("#EvntStructBtns #btnRefresh").click(function() {
        da.EvntStruct.Refresh();
    });

    // $("#EvntStructBtns #btnApply").click(function() {
    //     da.EvntStruct.Apply();
    // });

})
</script>