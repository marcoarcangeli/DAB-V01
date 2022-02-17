<script type="text/javascript" ref="da.Dat_Evnt_FileTlist">
da.Dat_Evnt_FileTlist = {

    whoIAm: "Dat_Evnt_FileTlist",
    PanelTag: this.whoIAm+"_",
    Table: null,
    Mode: "<?php echo $this->Mode; ?>",
 // PageLength: "<?php echo $this->PageLength; ?>",
    FolderAbsPath: "<?php echo $_SESSION["Dat_EvntAbsPath"]; ?>",
    FolderRelPath: "<?php echo $_SESSION["Dat_EvntRelPath"]; ?>",
    AllowedUploadFileExt: "<?php echo $this->AllowedUploadFileExt; ?>",
    UplName: '<?php echo $_SESSION["UploadFileBufferName"]; ?>', //'upl'
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    RefPanels: "<?php echo $this->RefPanels; ?>",
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if ($("#Dat_Evnt_SelectedFile").val() == "") {
            $("#Dat_Evnt_FileTlistBtns #btnDownload").attr("disabled", true);
            $("#Dat_Evnt_FileTlistBtns #btnDelete").attr("disabled", true);
        } else {
            $("#Dat_Evnt_FileTlistBtns #btnDownload").attr("disabled", false);
            $("#Dat_Evnt_FileTlistBtns #btnDelete").attr("disabled", false);
        }
    },

    // not necessary cause values are in session
    // SetParamsFromPrjState: function() {
    //     prjState = da.PrjView.Get();

    //     da.Dat_Evnt_FileTlist.PrjAnCntxAbsPath =
    //         '?php echo $_SESSION["PrjAbsPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
    //         (prjState["AnFolderNam"] ? prjState["AnFolderNam"] :
    //             '?php echo $_SESSION["PSV"]["AnFolderNam"]; ?>') + '/';
    //     da.Dat_Evnt_FileTlist.PrjAnCntxRelPath =
    //         '?php echo $_SESSION["PrjRelPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
    //         (prjState["AnFolderNam"] ? prjState["AnFolderNam"] :
    //             '?php echo $_SESSION["PSV"]["AnFolderNam"]; ?>') + '/';
    //     return prjState;
    // },

    SetUploadfileParams: function() {
        // prjState = da.Dat_Evnt_FileTlist.SetParamsFromPrjState();
        data = {
            DstFolder: da.Dat_Evnt_FileTlist.FolderAbsPath,
            UplName: da.Dat_Evnt_FileTlist.UplName,
            AllowedUploadFileExt: da.Dat_Evnt_FileTlist.AllowedUploadFileExt,
        };
        da.SetUploadfileParams(data, da.Dat_Evnt_FileTlist.whoIAm);
        return prjState;
    },

    RefreshObj: function() {
        $("#Dat_EvntList").DataTable().ajax.reload(null, false);
    },

    DeleteFile: function() {
        try {
            // FilePath= $("#Dat_Evnt_DstFolder").val();
            FilePath = da.Dat_Evnt_FileTlist.FolderAbsPath;
            Fn = $("#Dat_Evnt_SelectedFile").val();
            // alert(FilePath);
            // alert(Fn);

            if (FilePath && FilePath != '' &&
                Fn && Fn != ''
            ) {
                return $.ajax({
                    type: "POST",
                    url: "DA/FsComponents/FsManager.proxy.php",
                    async: true,
                    // dataType: "json",
                    data: {
                        // fsManagerCntx: "repoEvnts",
                        FsManagerMethod: "RemoveFile",
                        // projectName: "",
                        // analysisName: "",
                        FilePath: FilePath,
                        FileNam: Fn,
                        // fileContent: "",
                        // overWrite: ""
                    },
                    error: function(result) {
                        // alert(result["Msg"]);
                        da.UsrMsgShow(da.Dat_Evnt_FileTlist.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["Msg"]);
                        da.Dat_Evnt_FileTlist.RefreshObj();
                        da.UsrMsgShow(da.Dat_Evnt_FileTlist.SuccessMsg, "Info");
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },
    Get: function(obj) {
        data = {
            FileNam: $(obj).children(":nth-child(1)").text(),
            FileRef: da.Dat_Evnt_FileTlist.FolderRelPath + $(obj).children(":nth-child(1)").text(),
        };
        return data;
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.Dat_Evnt_FileTlist.CleanSelectedRow();
        } else {
            da.Dat_Evnt_FileTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.Dat_Evnt_FileTlist.Get(obj);
            da.Dat_Evnt_FileTlist.SetSelectedRow(data);
        }
        da.Dat_Evnt_FileTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.Dat_Evnt_FileTlist.DetailPanels && da.Dat_Evnt_FileTlist.DetailPanels != '') {
            // alert(da.Dat_Evnt_FileTlist.DetailPanels);
            da.RefreshDetailPanels(da.Dat_Evnt_FileTlist.DetailPanels, "Set", data);
        }
        if (da.Dat_Evnt_FileTlist.RefPanels && da.Dat_Evnt_FileTlist.RefPanels != '') {
            // alert(da.Dat_Evnt_FileTlist.DetailPanels);
            da.RefreshDetailPanels(da.Dat_Evnt_FileTlist.RefPanels, "SetFileRef", data);
        }
        $("#Dat_Evnt_SelectedFile").val(data["FileNam"]);
        // alert(da.Dat_Evnt_FileTlist.FolderRelPath + Namfile);
        // $("#Dat_Evnt_FileViewer").IFrame('createTab', Namfile, da.Dat_Evnt_FileTlist.FolderRelPath + Namfile, 'index', true);
        $('#Dat_Evnt_FileViewer').attr('src', data["FileRef"]);
    },
    CleanSelectedRow: function() {
        if (da.Dat_Evnt_FileTlist.DetailPanels && da.Dat_Evnt_FileTlist.DetailPanels != '') {
            da.RefreshDetailPanels(da.Dat_Evnt_FileTlist.DetailPanels, "Clean");
        }
        if (da.Dat_Evnt_FileTlist.RefPanels && da.Dat_Evnt_FileTlist.RefPanels != '') {
            da.RefreshDetailPanels(da.Dat_Evnt_FileTlist.RefPanels, "CleanFileRef");
        }
        $("#Dat_Evnt_SelectedFile").val("");
        // alert(da.Dat_Evnt_FileTlist.FolderRelPath + Namfile);
        // $("#Dat_Evnt_FileViewer").IFrame('createTab', Namfile, da.Dat_Evnt_FileTlist.FolderRelPath + Namfile, 'index', true);
        $('#Dat_Evnt_FileViewer').attr('src', "");
    },


}

$(document).ready(function() {
    // alert($("#Dat_Evnt_DstFolder").val());

    da.Dat_Evnt_FileTlist.Table = $("#Dat_EvntList").DataTable({
        "dom": "<'myfilter'f>t ip",
        "paging": true,
        "lengthChange": false,
        "pageLength": <?php echo $this->PageLength; ?>,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "scrollX": true,
        // "columnDefs": [
        // { "width": 10,"targets": 0 },
        // { "width": 100, "targets": 2 }
        // ],
        "fixedColumns": true,
        "processing": true,
        "serverSide": false,
        "ajax": {
            "url": "DA/HtmlComponents/Dat_Evnt/FileTlist.proxy.php",
            "type": "POST",
            "dataSrc": "data"
        },
        "columns": [{
            "data": "FileNam"
        }]

    });

    $("#Dat_EvntList tbody").on("click", "tr", function() {
        da.Dat_Evnt_FileTlist.ToggleRow(this);
    });

    $("#Dat_Evnt_FileTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.Dat_Evnt_FileTlist.RefreshObj();
    });

    $("#Dat_Evnt_FileTlistBtns #btnDelete").click(function() {
        Fn = $("#Dat_Evnt_SelectedFile").val();
        if (confirm("Confirm Delete of file (" + Fn + ") ?")) {
            da.Dat_Evnt_FileTlist.DeleteFile();
        }
    });

    $("#Dat_Evnt_FileTlistBtns #btnDownload").click(function(e) {
        e.preventDefault();
        // window.location.href = $("#DstRelFolder").val() + $("#Dat_Evnt_SelectedFile").val();
        window.open(da.Dat_Evnt_FileTlist.FolderRelPath + $("#Dat_Evnt_SelectedFile").val(), '_blank');
    });

    /* *************************************************************************** */
    // UploadFiles management 
    $('#Dat_Evnt_FileTlist_DropFiles #dropFiles').click(function() {
        // Simulate a click on the file input button
        $("#Dat_Evnt_FileTlist_UploadFiles #upl").click();
    });

    $('#Dat_Evnt_FileTlist_UploadFiles #UploadFiles').fileupload({
        // This element will accept file drag/Dat_Evnt_FileTlist_DropFiles uploading
        dropZone: $('#Dat_Evnt_FileTlist_DropFiles #dropFiles'),
        Fn: "",
        fileSize: "",
        // This function is called when a file is added to the queue;
        add: function(e, data) {
            Fn = data.files[0].name;
            if (confirm("Confirm Upload of file (" + Fn + ") ?")) {
                prjState = da.Dat_Evnt_FileTlist.SetUploadfileParams();
                // alert(Fn);
                fileSize = da.formatFileSize(data.files[0].size);
                // Automatically Upload the file once it is added to the queue
                var jqXHR = data.submit();
            } else {
                da.UsrMsgShow(da.Dat_Evnt_FileTlist.FailMsg, "Info");
                return;
            }
        },
        success: function(e, data) {
            res = JSON.parse(e);
            // alert(res["State"]);
            if (res["State"]) {
                resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nexecuted !\n";
                da.Dat_Evnt_FileTlist.RefreshObj();
            } else {
                resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nnot executed !\n";
            }
            // alert(resultMessage);
            da.CleanUploadfileParams(da.Dat_Evnt_FileTlist.whoIAm);
            da.UsrMsgShow(resultMessage, "Info");
        },
        fail: function(e, data) {
            // alert(data.jqXHR.responseText);
            resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nnot executed !\n";
            da.UsrMsgShow(resultMessage, "Info");
        }
    });

})
</script>