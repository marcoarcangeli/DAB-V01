<script type="text/javascript" ref="da.PrjView">
da.PrjView = {

    whoIAm: 'Prj',
    PanelTag: this.whoIAm + '_',
    IdPrj: <?php echo $_SESSION["PSV"]["IdPrj"]; ?>,
    PrjFolderPrfx: '<?php echo $_SESSION["PrjFolderPrfx"]; ?>',
    EvntFolderPrfx: '<?php echo $_SESSION["EvntFolderPrfx"]; ?>',
    CntxFolderPrfx: '<?php echo $_SESSION["CntxFolderPrfx"]; ?>',
    AnFolderPrfx: '<?php echo $_SESSION["AnFolderPrfx"]; ?>',
    // TrainFolderPrfx  :'?php echo $_SESSION["TrainFolderPrfx"]; ?>',
    // TestFolderPrfx   :'?php echo $_SESSION["TestFolderPrfx"]; ?>',
    RnkFolderPrfx: '<?php echo $_SESSION["RnkFolderPrfx"]; ?>',
    PrjFolderName: '',
    Mode: '<?php echo $this->Mode; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    ParentObjFun: '<?php echo $this->ParentObjFun; ?>',
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    Get: function() {
        data = {
            IdPrj: $("#Prj_IdPrj").val(),
            Nam: $("#Prj_Nam").val(),
            Descr: $("#Prj_Descr").val(),
            // folderRef:   $("#Prj_folderRef").val(),
            IdUsr: $("#Prj_IdUsr").val(),
            IdPrjState: $("#Prj_IdPrjState").val(),
            // PrjStateNam:    $("#Prj_PrjStateNam").val(),
            IdEvnt: $("#Prj_IdEvnt").val(),
            FileNamRepoDat: $("#Prj_FileNamRepoDat").val(),
            IdClean: $("#Prj_IdClean").val(),
            IdCntx: $("#Prj_IdCntx").val(),
            IdAn: $("#Prj_IdAn").val(),
            // IdAnCntx:       $("#Prj_IdAnCntx").val(),
            // IdTrain:        $("#Prj_IdTrain").val(),
            // IdTest:         $("#Prj_IdTest").val(), 
            // IdRev:          $("#Prj_IdRev").val(),
            IdRnk: $("#Prj_IdRnk").val(),
            IdPrjStateCalc: $("#Prj_IdPrjStateCalc").val(),
            PrjFolderNam: $("#Prj_PrjFolderNam").val(),
            EvntFolderNam: $("#Prj_EvntFolderNam").val(),
            CntxFolderNam: $("#Prj_CntxFolderNam").val(),
            AnFolderNam: $("#Prj_AnFolderNam").val(),
            // TrainFolderNam: $("#Prj_TrainFolderNam").val(),
            // TestFolderNam:  $("#Prj_TestFolderNam").val(),
            // RevFolderNam:   $("#Prj_RevFolderNam").val()
            RevFolderNam: $("#Prj_RevFolderNam").val()
        };
        return data;
    },

    Set: function(data) {
        $("#Prj_IdPrj").val(data["IdPrj"]);
        $("#Prj_Nam").val(data["Nam"]);
        $("#Prj_Descr").val(data["Descr"]);
        // $("#Prj_folderRef").val(data["folderRef"]);
        $("#Prj_IdUsr").val(data["IdUsr"]);
        $("#Prj_IdPrjState").val(data["IdPrjStateCalc"]); // for autosave
        // $("#Prj_PrjStateNam").val(data["PrjStateNam"]);
        $("#Prj_IdEvnt").val(data["IdEvnt"]);
        $("#Prj_FileNamRepoDat").val(data["FileNamRepoDat"]);
        $("#Prj_IdClean").val(data["IdClean"]);
        $("#Prj_IdCntx").val(data["IdCntx"]);
        $("#Prj_IdAn").val(data["IdAn"]);
        $("#Prj_AnNum").val(data["AnNum"]),
        // $("#Prj_IdAnCntx").val(data["IdAnCntx"]);
        // $("#Prj_IdTrain").val(data["IdTrain"]);
        // $("#Prj_IdTest").val(data["IdTest"]);
        // $("#Prj_IdRev").val(data["IdRev"]);
        $("#Prj_IdRnk").val(data["IdRnk"]);
        $("#Prj_IdPrjStateCalc").val(data["IdPrjStateCalc"]);
        $("#Prj_PrjFolderNam").val(data["PrjFolderNam"]);
        $("#Prj_EvntFolderNam").val(data["EvntFolderNam"]);
        $("#Prj_CntxFolderNam").val(data["CntxFolderNam"]);
        $("#Prj_AnFolderNam").val(data["AnFolderNam"]);
        // $("#Prj_TrainFolderNam").val(data["TrainFolderNam"]);
        // $("#Prj_TestFolderNam").val(data["TestFolderNam"]);
        // $("#Prj_RevFolderNam").val(data["RevFolderNam"]);
        $("#Prj_RnkFolderNam").val(data["RnkFolderNam"]);
        // line info
        da.PrjView.SetInfo();
        // if(daLI){
        //     daLI.text(info);
        //     daCI.text(info);
        // }
        // da.PrjView.btnControl();+ " - " + $("#Prj_IdPrjState option:selected").text()
    },

    SetInfo: function() {
        // line info
        daGI = $("#gridInfo");
        daLI = $("#Prj_IdPrj").closest(".da-line").find(".da-line-info");
        daCI = $("#Prj_IdPrj").closest(".da-column").find(".da-card-info");
        // alert(daLI.attr("id"));
        infoG = 'State: ' + $("#Prj_IdPrjState option:selected").text();
        infoL = 'Id: ' + $("#Prj_IdPrj").val();
        infoC = 'Id: ' + $("#Prj_IdPrj").val() +
            ' | State: ' + $("#Prj_IdPrjState option:selected").text();

        (daGI ? daGI.text(infoG) : daGI.text());
        (daLI ? daLI.text(infoL) : daLI.text());
        (daCI ? daCI.text(infoC) : daCI.text());
        // if(daLI){
        //     daLI.text(info);
        //     daCI.text(info);
        // }
        // da.PrjView.btnControl();+ " - " + $("#Prj_IdPrjState option:selected").text()
    },

    Clean: function() {
        $("#Prj_IdPrj").val("");
        $("#Prj_Nam").val("");
        $("#Prj_Descr").val("");
        // $("#Prj_folderRef").val("");
        $("#Prj_IdUsr").val(<?php echo $this->IdUsr; ?>);
        $("#Prj_IdPrjState").val("1");
        // $("#Prj_PrjStateNam").val("New");
        $("#Prj_IdEvnt").val("");
        $("#Prj_FileNamRepoDat").val("");
        $("#Prj_IdClean").val("");
        $("#Prj_IdCntx").val("");
        $("#Prj_IdAn").val("");
        $("#Prj_AnNum").val(''),
        // $("#Prj_IdAnCntx").val("");
        // $("#Prj_IdTrain").val("");
        // $("#Prj_IdTest").val("");
        // $("#Prj_IdRev").val("");
        $("#Prj_IdRnk").val("");
        $("#Prj_IdPrjStateCalc").val("");
        $("#Prj_PrjFolderNam").val("");
        $("#Prj_EvntFolderNam").val("");
        $("#Prj_CntxFolderNam").val("");
        $("#Prj_AnFolderNam").val("");
        // $("#Prj_TrainFolderNam").val("");
        // $("#Prj_TestFolderNam").val("");
        // $("#Prj_RevFolderNam").val("");
        $("#Prj_RnkFolderNam").val("");

        // da.PrjView.btnControl();
    },

    SetEvnt: function(data) {
        $("#Prj_IdEvnt").val(data["IdEvnt"]);
        $("#Prj_FileNamRepoDat").val(data["FileNamRepoDat"]);
        $("#Prj_EvntFolderNam").val(da.PrjView.EvntFolderPrfx + data["IdEvnt"]);
    },
    SetClean: function(data) {
        $("#Prj_IdClean").val(data["IdClean"]);
    },
    SetCntx: function(data) {
        $("#Prj_IdCntx").val(data["IdCntx"]);
        $("#Prj_CntxFolderNam").val(da.PrjView.CntxFolderPrfx + data["IdCntx"]);
    },
    SetAn: function(data) {
        $("#Prj_IdAn").val(data["IdAn"]);
        $("#Prj_AnFolderNam").val(da.PrjView.AnFolderPrfx + data["IdAn"]);
    },
    // SetAnCntx: function(data) {
    //     $("#Prj_IdAnCntx").val(data["IdAnCntx"]);
    // },
    // SetTrain: function(data) {
    //     $("#Prj_IdTrain").val(data["IdTrain"]);
    //     $("#Prj_TrainFolderNam").val(da.PrjView.TrainFolderPrfx + data["IdTrain"]);
    // },
    // SetTest: function(data) {
    //     $("#Prj_IdTest").val(data["IdTest"]);
    //     $("#Prj_TestFolderNam").val(da.PrjView.TestFolderPrfx + data["IdTest"]);
    // },
    // SetRev: function(data) {
    //     $("#Prj_IdRev").val(data["IdRev"]);
    //     $("#Prj_RevFolderNam").val(da.PrjView.RevFolderPrfx + data["IdRev"]);
    // },
    SetRnk: function(data) {
        $("#Prj_IdRnk").val(data["IdRnk"]);
    },

    CleanEvnt: function() {
        $("#Prj_IdEvnt").val("");
        $("#Prj_FileNamRepoDat").val("");
        $("#Prj_EvntFolderNam").val(da.PrjView.EvntFolderPrfx);
    },
    CleanClean: function() {
        $("#Prj_IdClean").val("");
    },
    CleanCntx: function() {
        $("#Prj_IdCntx").val("");
        $("#Prj_CntxFolderNam").val(da.PrjView.CntxFolderPrfx);
    },
    CleanAn: function() {
        $("#Prj_IdAn").val("");
        $("#Prj_AnFolderNam").val(da.PrjView.AnFolderPrfx);
    },
    // CleanAnCntx: function() {
    //     $("#Prj_IdAnCntx").val("");
    // },
    // CleanTrain: function() {
    //     $("#Prj_IdTrain").val("");
    //     $("#Prj_TrainFolderNam").val(da.PrjView.TrainFolderPrfx);
    // },
    // CleanTest: function() {
    //     $("#Prj_IdTest").val("");
    //     $("#Prj_TestFolderNam").val(da.PrjView.TestFolderPrfx);
    // },
    // Cleanrev: function() {
    //     $("#Prj_IdRev").val("");
    //     $("#Prj_RevFolderNam").val(da.PrjView.RevFolderPrfx);
    // },
    CleanRnk: function() {
        $("#Prj_IdRnk").val("");
    },

    Refresh: function() {
        try {
            // alert("IdPrj: "+ da.PrjView.IdPrj);
            beforePrjState = $("#Prj_IdPrjStateCalc").val("");
            if (da.PrjView.IdPrj && da.PrjView.IdPrj != '') {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/Prj/Read.proxy.php?IdPrj=" + da.PrjView.IdPrj,
                    // url: "DA/HtmlComponents/Prj/View.proxy.php",
                    dataType: "json",
                    error: function(result) {
                        da.UsrMsgShow(da.PrjView.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(data.IdPrj);
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data = result["Data"];
                        da.PrjView.Set(data);

                        if (data["IdPrjState"] != data["IdPrjStateCalc"]) {
                            // da.UsrMsgShow("Update Project State ...", "Info");
                            da.PrjView.Save();
                        }
                        // // analysis refresh
                        // if (data["IdAn"] && data["IdAn"] != '') {
                        //     // alert(data["IdAn"]);
                        //     da.AnRead.IdAn=data["IdAn"];
                        //     da.AnRead.Refresh();

                        //     // da.AnTlist.RefreshObj();
                        //     da.AnTlist.SelectRow(2);
                        // }
                    },
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }

    },

    Save: function() {
        try {
            // alert("#Prj_btnSave");
            return $.ajax({
                type: "POST",
                url: "DA/HtmlComponents/Prj/Save.proxy.php",
                async: true,
                dataType: "json",
                data: da.PrjView.Get(),
                error: function(result) {
                    // alert(result);
                    da.UsrMsgShow(da.PrjView.FailMsg, "Error");
                },
                success: function(result) {
                    // alert(result);
                    if (result["State"]) {
                        $("#Prj_IdPrj").val(result["IdPrj"]);
                        if (da.PrjView.ParentObj) {
                            da.RefreshObj(da.PrjView.ParentObj);
                        }
                        da.UsrMsgShow(da.PrjView.SuccessMsg+'<br>Save '+da.PrjView.whoIAm, "Info");
                    } else {
                        da.UsrMsgShow(da.PrjView.FailMsg, "Info");
                    }
                }
            })
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    getPrjStateselect: function() {
        $.ajax({
            url: "DA/HtmlComponents/PrjState/Tlist.proxy.php",
            type: "POST",
            dataType: "json",
            async: true,
            data: "data",
            success: function(response) {
                // alert("popola select records: "+response.data.length);
                $("#Prj_IdPrjState").empty();
                $("#Prj_IdPrjState").append(
                    $("<option></option>") // Yes you can do this.
                    .text("Select an Item ...")
                    .val("")
                );
                $.each(response.data, function(index, item) { // Iterates through a collection
                    $("#Prj_IdPrjState")
                    .append( // Append an object to the inside of the select box
                        $("<option></option>") // Yes you can do this.
                        .text(item.IdPrjState + " - " + item.Nam)
                        .val(item.IdPrjState)
                    );
                });
                // $("#Prj_IdPrjState").val(? php echo $this->IdPrjState; ?>);
            }
        });
    },

}

$(document).ready(function() {
    // alert(da.readPrj.Mode);
    // var readPrjFields = array("IdPrj", "IdUsr", "Nam", "Descr", "folderRef", "IdPrjState");

    // contentParams

    //popola select IdPrjState
    da.PrjView.getPrjStateselect();

    // da.PrjView.Refresh();
    if (da.PrjView.Mode == "alone") {
        da.PrjView.Refresh();
    }

})
</script>