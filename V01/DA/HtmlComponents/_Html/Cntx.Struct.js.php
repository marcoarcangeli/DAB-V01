<script type="text/javascript" ref="da.CntxStruct">
da.CntxStruct = {
    whoIAm: "CntxStruct",
    PanelTag: this.whoIAm + "_",
    // FsManagerCntx: "Prjs",
    Struct: [],
    NamArr: [],
    TypeArr: [],
    UnitArr: [],
    NewNam: "",
    NewType: "",
    NewUnit: "",
    NumCol: 0,
    FileNamRepoDat: '<?php echo $_SESSION["PSV"]["FileNamRepoDat"] ?>',
    StructBaseNam: '<?php echo $_SESSION["PSV"]["FileNamRepoDat"].$_SESSION["AutoCleanDatFile"].$_SESSION["AnTypeStruct"].$_SESSION["DatCSVFile"] ?>',
    StructDirNam: '<?php echo $_SESSION["PrjAbsPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'.$_SESSION["PSV"]["CntxFolderNam"].'/'; ?>',
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

        da.CntxStruct.FileNamRepoDat = (prjState["FileNamRepoDat"] ? prjState["FileNamRepoDat"] :
            '<?php echo $_SESSION["PSV"]["FileNamRepoDat"]; ?>');
        da.CntxStruct.StructBaseNam = da.CntxStruct.FileNamRepoDat +
            '<?php echo $_SESSION["AutoCleanDatFile"].$_SESSION["AnTypeStruct"].$_SESSION["DatCSVFile"] ?>';
        da.CntxStruct.StructDirNam =
            '<?php echo $_SESSION["PrjAbsPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
            (prjState["CntxFolderNam"] ? prjState["CntxFolderNam"] :
                '<?php echo $_SESSION["PSV"]["CntxFolderNam"]; ?>') + '/';

        return prjState;
    },

    getFilterCol: function() {
        // alert("getNewType")
        NewNam = "";
        NewType = "";
        NewUnit = "";
        // se Struct esiste
        for (let i = 0; i < da.EvntStruct.ColNum; ++i) {
            if ($("#CntxStructChk" + i).is(":checked")) {
                // alert(da.EvntStruct.NamArr[i]+',')

                NewNam += da.CntxStruct.NamArr[i] + ',';
                NewType += da.CntxStruct.TypeArr[i] + ',';
                NewUnit += da.CntxStruct.UnitArr[i] + ',';
            }
        }
        da.CntxStruct.NewNam = NewNam.slice(0, -1);
        da.CntxStruct.NewType = NewType.slice(0, -1);
        da.CntxStruct.NewUnit = NewUnit.slice(0, -1);
        // alert("NewNam "+da.CntxStruct.NewNam)
        // alert("NewType "+da.CntxStruct.NewType)
        // alert("NewUnit "+da.CntxStruct.NewUnit)
        // return FilterCol;
    },

    BuildStructList: function(data) {
        // $("#Cntx_IdCntx").val("");
        NamArr = [];
        TypeArr = [];
        UnitArr = [];
        ColNum = 0;
        // se Struct esiste
        if (data) {
            // estrai ColNam,ColType,ColNum,RowNum,Unit
            for (let i = 0; i < data.length; ++i) {
                // split ColNam,ColType,Unit
                // alert(data[i][1]);
                if (data[i][0] == 'ColNam') {
                    da.CntxStruct.NamArr = NamArr = data[i][1].split(',');
                    // alert(NamArr);
                }
                if (data[i][0] == 'ColType') {
                    da.CntxStruct.TypeArr = TypeArr = data[i][1].split(',');
                    // alert(TypeArr);
                }
                if (data[i][0] == 'Unit') {
                    da.CntxStruct.UnitArr = UnitArr = data[i][1].split(',');
                    // alert(UnitArr);
                }
                if (data[i][0] == 'ColNum') {
                    da.CntxStruct.ColNum = ColNum = data[i][1];
                    // alert(ColNum);
                }
            }
        }
        // var dims = da.CntxStruct.Struct;
        // alert(dims.length);
        if (ColNum > 0) {
            var Html = '<table class="table table-bordered table-hover display">';
            Html += '<tr>';
            Html += '<th>Nam</th>';
            Html += '<th>NewNam</th>';
            Html += '<th>Type</th>';
            Html += '<th>NewType</th>';
            Html += '<th>Unit</th>';
            Html += '<th>NewUnit</th>';
            // Html += '<th>Chk</th>';
            Html += '</tr>';
            for (let i = 0; i < ColNum; ++i) {
                Html += '<tr>';
                Html += '<td>';
                Html += NamArr[i];
                Html += '</td>';
                Html += '<td>';
                Html += '<input type="text" class="form-control" id="CntxStructNewNam' + i +
                    '" placeholder="NewNam ..." value="' + NamArr[i] + '" >';
                Html += '</td>';
                Html += '<td>';
                Html += TypeArr[i];
                Html += '</td>';
                Html += '<td>';
                Html += '<input type="text" class="form-control" id="CntxStructNewType' + i +
                    '" placeholder="CntxCatType ..." value="' + TypeArr[i] + '" >';
                Html += '</td>';
                Html += '<td>';
                Html += UnitArr[i];
                Html += '</td>';
                Html += '<td>';
                Html += '<input type="text" class="form-control" id="CntxStructNewUnit' + i +
                    '" placeholder="CntxCatUnit ..." value="' + UnitArr[i] + '" >';
                Html += '</td>';
                // Html += '<td>';
                // Html += '<input class="form-check-input da-form-check-input" type="checkbox" id="CntxStructChk' + i + '" value="" checked>';
                // // Html += '<label for="CntxStruct' + i + '" class="custom-control-label">' + dims[i] + '</label>';
                // Html += '</td>';
                Html += '</tr>';
            }
            Html += '</table>';
            $("#CntxStructTlist").html(Html);
        }
    },

    // not completed
    // Apply: function() {
    //     // $("#Cntx_IdCntx").val("");
    //     if (da.Cntx.dati.Tlist.cols.length > 0) {
    //         da.CntxStruct.Struct = da.Cntx.dati.Tlist.cols;
    //         da.CntxStruct.BuildStructList();

    //         if (typeof da.CntxDatiPulitiTlist !== "undefined") {
    //             if ($.isFunction(da.CntxDatiPulitiTlist.Update)) {
    //                 da.CntxDatiPulitiTlist.RefreshObj();
    //             }
    //         }
    //     }
    // },

    // Clean: function() {
    //     // $("#Cntx_IdCntx").val("");
    //     if (da.Cntx.dati.Tlist.cols.length > 0) {
    //         da.CntxStruct.Struct = da.Cntx.dati.Tlist.cols;
    //         da.CntxStruct.BuildStructList();

    //         if (typeof da.CntxDatiPulitiTlist !== "undefined") {
    //             if ($.isFunction(da.CntxDatiPulitiTlist.Update)) {
    //                 da.CntxDatiPulitiTlist.RefreshObj();
    //             }
    //         }
    //     }
    // },

    Refresh: function() {
        try {
            prjState = da.CntxStruct.SetParamsFromPrjState();

            // alert(da.CntxStruct.StructDirNam+da.CntxStruct.StructBaseNam);
            if (da.CntxStruct.FileNamRepoDat && da.CntxStruct.FileNamRepoDat != '') {
                // var Delimiter = ";";
                // alert(FilePath);
                return $.ajax({
                    type: "POST",
                    url: "DA/FsComponents/CSVToFromJSON.proxy.php",
                    async: true,
                    dataType: "json",
                    data: {
                        FilePath: da.CntxStruct.StructDirNam,
                        FileNam: da.CntxStruct.StructBaseNam,
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
                        da.CntxStruct.BuildStructList(data);
                        // da.CntxStruct.BuildDataTable(data);
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

}

$(document).ready(function() {
    //popola select ...
    // unit select

    if (da.CntxStruct.Mode = "alone") {
        da.CntxStruct.Refresh();
    }

    $("#CntxStructBtns #btnRefresh").click(function() {
        da.CntxStruct.Refresh();
    });

    // $("#CntxStructBtns #btnApply").click(function() {
    //     da.CntxStruct.Apply();
    // });

})
</script>