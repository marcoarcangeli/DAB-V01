<script type="text/javascript" ref="da.CleanRead">
    da.CleanRead = {

        whoIAm: 'Clean',
        PanelTag: this.whoIAm + '_',
        CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',

        IdClean: '<?php echo $_SESSION["PSV"]["IdClean"]; ?>',
        PrjEvntAbsPath: '',

        Mode: '<?php echo $this->Mode; ?>',
        ParentObj: '<?php echo $this->ParentObj; ?>',
        ParentObjType: '<?php echo $this->ParentObjType; ?>',
        RefPanels: "<?php echo $this->RefPanels; ?>",
        StructPanelFlag: "<?php echo $this->StructPanelFlag; ?>",
        SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
        FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

        // Clean(IdClean, IdPrj, IdClean, note, timestamp, IdUsr)
        btnControl: function() {
            if(da.CleanRead.Mode == 'alone'){
                $("#CleanBtns #btnNew").hide();
            }

            if($("#Clean_IdClean").val()==""){
                $("#CleanBtns #btnRefresh").attr("disabled", true);
                $("#CleanBtns #btnDelete").attr("disabled", true);
            }else{
                $("#CleanBtns #btnRefresh").attr("disabled", false);
                $("#CleanBtns #btnDelete").attr("disabled", false);
            }

            if(
                $("#Clean_Nam").val()=="" &&
                $("#Clean_Descr").val()==""
            ){
                $("#CleanBtns #btnSave").attr("disabled", true);
            }else{
                $("#CleanBtns #btnSave").attr("disabled", false);
            }

            if(
                // $("#Clean_fileRefRepoDat").val()=="" ||
                $("#Clean_IdClean").val()==""
            ){
                $("#CleanBtns #btnComputeAnom").attr("disabled", true);
                // $("#CleanBtns #btnComputeClean").attr("disabled", true);
            }else{
                $("#CleanBtns #btnComputeAnom").attr("disabled", false);
                // $("#CleanBtns #btnComputeClean").attr("disabled", false);
            }

        },

        SetParamsFromPrjState: function(){
            prjState=da.PrjView.Get();

            da.CleanRead.IdClean= (prjState["IdClean"]? prjState["IdClean"]: '<?php echo $_SESSION["PSV"]["IdClean"]; ?>'); 
            da.CleanRead.PrjEvntAbsPath= '<?php echo $_SESSION["PrjAbsPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' 
            + (prjState["EvntFolderNam"]? prjState["EvntFolderNam"]: '<?php echo $_SESSION["PSV"]["EvntFolderNam"]; ?>') + '/';
            return prjState;
        },

        Get: function() {
            data= {
                IdClean:        $("#Clean_IdClean").val(),
                IdPrj:          $("#Clean_IdPrj").val(),
                ctsd:           $("#Clean_ctsd").val(),
                cnsd:           $("#Clean_cnsd").val(),
                cusd:           $("#Clean_cusd").val(),
                filters:        $("#Clean_filters").val(),
                Note:           $("#Clean_Note").val()
            };
            return data;
            // alert(data);
        },

        Set: function(data) {
            $("#Clean_IdClean").val(data["IdClean"]);
            $("#Clean_IdPrj").val(data["IdPrj"]);
            // $("#Clean_PrjNam").val(data["PrjNam"]);
            $("#Clean_ctsd").val(data["ctsd"]);
            $("#Clean_cnsd").val(data["cnsd"]);
            $("#Clean_cusd").val(data["cusd"]);
            $("#Clean_filters").val(data["filters"]);
            $("#Clean_Note").val(data["Note"]);

            da.CleanRead.btnControl();
        },

        Clean: function() {
            prjState=da.CleanRead.SetParamsFromPrjState();

            $("#Clean_IdClean").val(da.CleanRead.IdClean); 

            $("#Clean_IdPrj").val('<?php echo $_SESSION["PSV"]["IdPrj"]; ?>'); 
            // $("#Clean_PrjNam").val("");
            if(da.CleanRead.StructPanelFlag){
                $("#Clean_ctsd").val(da.EvntStruct.NewType);
                $("#Clean_cnsd").val(da.EvntStruct.NewNam);
                $("#Clean_cusd").val(da.EvntStruct.NewUnit);
                $("#Clean_filters").val(da.EvntStruct.FilterArr);
            }else{
                $("#Clean_ctsd").val("");
                $("#Clean_cnsd").val("");
                $("#Clean_cusd").val("");
                $("#Clean_filters").val("");
            }
            $("#Clean_Note").val("");

            da.CleanRead.btnControl();
        },

        Refresh: function() {
            try {
                // alert("IdClean: "+ da.CleanRead.IdClean);
                if(da.CleanRead.IdClean && da.CleanRead.IdClean != ''){
                    return $.ajax({
                        type: "GET",
                        url: "DA/HtmlComponents/Clean/Read.proxy.php?IdClean=" + da.CleanRead.IdClean,
                        dataType: "json",
                        error: function(result) {
                            da.UsrMsgShow(da.FailMsg, "Error");
                        },
                        success: function(result) {
                            // alert(data.IdClean);
                            data=result["Data"];
                            da.CleanRead.Set(data);
                        },
                    })
                }
            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }

        },

        Delete: function() {
            try {
                Id=$("#Clean_IdClean").val();
                Nam=$("#Clean_Nam").val();
                if (confirm("Confirm Delete of (" + Id + " - "+ Nam +") ?")) {
                    return $.ajax({
                        type: "POST",
                        url: "DA/HtmlComponents/Clean/Delete.proxy.php",
                        dataType: "json",
                        data: {
                            IdClean: Id
                        },
                        error: function(result) {
                            // alert("error: "+result["State"]);
                            da.UsrMsgShow(da.FailMsg, "Info");
                        },
                        success: function(result) {
                            // alert("success: "+result["State"]);
                            if(result["State"]){
                                da.CleanRead.Clean();
                                // da.UsrTlist.RefreshObj();
                                if(da.CleanRead.ParentObj){
                                    da.RefreshObj(da.CleanRead.ParentObj);
                                }
                                if(da.CleanRead.RefPanels && da.CleanRead.RefPanels!=""){
                                    // alert(da.AlgCatTree.DetailPanels);
                                    da.RefreshDetailPanels(da.CleanRead.RefPanels, "CleanClean");
                                }
                                da.UsrMsgShow(da.CleanRead.SuccessMsg, "Info");
                            }else{
                                da.UsrMsgShow(da.CleanRead.FailMsg, "Info");
                            }
                        }
                    })
                }
            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }
        },

        Save: function() {
            try {
                // alert("#CleanBtns #btnSave");
                if (da.verifyCompulsoryFields(da.CleanRead.CompulsoryFields, da.CleanRead.PanelTag)) {
                    return $.ajax({
                        type: "POST",
                        url: "DA/HtmlComponents/Clean/Save.proxy.php",
                        // async: false,
                        dataType: "json",
                        data: da.CleanRead.Get(),
                        error: function(result) {
                            // alert(result);
                            da.UsrMsgShow(da.CleanRead.FailMsg, "Error");
                        },
                        success: function(result) {
                            // alert(result);
                            if(result["State"]){
                                $("#Clean_IdClean").val(da.CleanRead.IdClean=result["IdClean"]);
                                da.CleanRead.btnControl();
                                if(da.CleanRead.ParentObj){
                                    da.RefreshObj(da.CleanRead.ParentObj,da.CleanRead.ParentObjType,fun="Refresh",data=null);
                                }
                                if(da.CleanRead.RefPanels && da.CleanRead.RefPanels!=""){
                                    // alert(da.AlgCatTree.DetailPanels);
                                    da.RefreshDetailPanels(da.CleanRead.RefPanels, "SetClean",da.CleanRead.Get());
                                }
                                da.UsrMsgShow(da.CleanRead.SuccessMsg, "Info");
                            }else{
                                da.UsrMsgShow(da.CleanRead.FailMsg, "Info");
                            }
                        }
                    })
                }
            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }
        },

        checkFieldsForAutoSave: function() {
            try {
                autoSave=false;
                //
                da.EvntStruct.getFilterCol();
                CtsdOld=$("#Clean_ctsd").val();
                CtsdNew=da.EvntStruct.NewType;
                if(CtsdOld !== CtsdNew){
                    $("#Clean_ctsd").val(CtsdNew);
                    autoSave=true;
                }
                CnsdOld=$("#Clean_cnsd").val();
                CnsdNew=da.EvntStruct.NewNam;
                if(CnsdOld !== CnsdNew){
                    $("#Clean_cnsd").val(CnsdNew);
                    autoSave=true;
                }
                CusdOld=$("#Clean_cusd").val();
                CusdNew=da.EvntStruct.NewUnit;
                if(CusdOld !== CusdNew){
                    $("#Clean_cusd").val(CusdNew);
                    autoSave=true;
                }

                FiltersOld=$("#Clean_filters").val();
                FiltersNew=da.EvntStruct.FilterArr;
                if(CusdOld !== CusdNew){
                    $("#Clean_filters").val(FiltersNew);
                    autoSave=true;
                }
                // check Cntx_fileRefDat field
                if(autoSave){
                    da.CleanRead.Save();
                }

            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }
        },

        BuildAnomParams: function() {
            try {
                da.CntxRead.checkFieldsForAutoSave();
                // alert("BuildProcParams"); 
                DecSep          = '<?php echo $_SESSION["DecDefaultSep"]; ?>';
                CsvSep          = '<?php echo $_SESSION["CSVDefaultSep"]; ?>';
                CsvHeader       = 'TRUE';
                if(da.CleanRead.StructPanelFlag){
                    // alert(da.AlgCatTree.DetailPanels);
                    // if($("#Clean_ctsd").val() !=''){
                    //     Cnsd=$("#Clean_ctsd").val();
                    //     Ctsd=$("#Clean_cnsd").val();
                    //     Cusd=$("#Clean_cusd").val();
                    // }else{
                        da.EvntStruct.getFilterCol();
                        Ctsd=da.EvntStruct.NewType;
                        Cnsd=da.EvntStruct.NewNam;
                        Cusd=da.EvntStruct.NewUnit;
                        // Filters=da.EvntStruct.FIlter;
                        $("#Clean_ctsd").val(Ctsd);
                        $("#Clean_cnsd").val(Cnsd);
                        $("#Clean_cusd").val(Cusd);
                    // }
                }else{
                    Ctsd="";
                    Cnsd="";
                    Cusd="";
                }
                // aggiorna parametri di compute

                FileRefRepoDat  = $("#Evnt_fileRefRepoDat").val();

                CSVDataFullPath = '<?php echo $_SESSION["BaseFolderDyn"]; ?>'+FileRefRepoDat;
                CSVDataPath=da.dirname(CSVDataFullPath);
                CSVDataFilename=da.basename(CSVDataFullPath);

                ProcParams= "CSVDataPath="+CSVDataPath;
                ProcParams+="&CSVDataFilename="+CSVDataFilename;
                ProcParams+="&decSep="+DecSep;
                ProcParams+="&csvSep="+CsvSep;
                ProcParams+="&csvHeader="+CsvHeader;
                ProcParams+="&ctsd="+Ctsd;
                ProcParams+="&cnsd="+Cnsd;
                // ProcParams+="&cusd="+Cusd;

                // alert(ProcParams);
                return ProcParams;
            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }
        },

        Compute: function(data) {
            try {
                // alert(da.AnomRead.BuildProcParams()); 
                da.ContentShow("<br><br>Executing ...<br><br><br>", "Elaboration")
                return $.ajax({
                    type: "POST",
                    url: "DA/PhpRComponents/PhpR.Proxy.php",
                    async: true,
                    dataType: "json",
                    data: data,
                    error: function(result) {
                        if(da.CleanRead.ParentObj){
                            da.RefreshObj(da.CleanRead.ParentObj);
                        }
                        da.ContentShow(result.responseText, "Result");
                    },
                    success: function(result) {
                        if(da.CleanRead.ParentObj){
                            da.RefreshObj(da.CleanRead.ParentObj);
                        }
                        da.ContentShow(result.responseText, "Result");
                    }
                })
            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }
        },

        ComputeAnom: function() {
            da.CleanRead.SetParamsFromPrjState();

            data= {
                ProcAbsPath     : '<?php echo $_SESSION["ProcAbsPath"]?>',
                ProcNam         : 'anomaliesAuto.R',
                OutputAbsPath   : da.CleanRead.PrjEvntAbsPath,
                ProcParams      : da.CleanRead.BuildAnomParams(),
            };
            da.CleanRead.Compute(data);
        },

    }

    $(document).ready(function() {
        da.CleanRead.Clean();
        // Clean(IdClean, IdPrj, IdClean, note, fileRefRepoDat, fileRefCleanDat)
        // var CleanReadFields = array("IdClean", "IdUsr", "IdClean", "note", "folderRef", "IdStatoClean");
        // contentParams e defaults
        // da.CleanRead.contentParams();

        //popola select ...
        // $.ajax({ ...

        if (da.CleanRead.Mode == "alone") {
            da.CleanRead.Refresh();
        }

        $("#CleanBtns #btnSave").click(function() {
            da.CleanRead.Save();
        });

        $("#CleanBtns #btnRefresh").click(function() {
            da.CleanRead.Refresh();
        });

        // Deletezione Clean
        // elimina solo DB: FS persiste
        $("#CleanBtns #btnDelete").click(function() {
            da.CleanRead.Delete();
        });

        $("#CleanBtns #btnNew").click(function() {
            da.CleanRead.Clean();
        });

        $("#Clean_Note").keyup(function(event) {
            da.CleanRead.btnControl();
        });

        $("#CleanBtns #btnComputeStats").click(function() {
            da.CleanRead.ComputeClean();
        });

        $("#CleanBtns #btnComputeAnom").click(function() {
            da.CleanRead.ComputeAnom();
        });

    })
</script>