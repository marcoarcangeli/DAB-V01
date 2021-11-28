<script type="text/javascript" ref="da.Cntx_FileTlist">
da.Cntx_FileTlist = {

    whoIAm: "Cntx_FileTlist",
    Table: null,
    Mode: "<?php echo $this->Mode; ?>",
    PageLength: "<?php echo $this->PageLength; ?>",
    FolderAbsPath: '',
    FolderRelPath: '',
    AllowedUploadFileExt: "<?php echo $this->AllowedUploadFileExt; ?>",
    UplName: '<?php echo $_SESSION["UploadFileBufferName"]; ?>', //'upl'
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    RefPanels: "<?php echo $this->RefPanels; ?>",
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if ($("#Cntx_SelectedFile").val() == "") {
            $("#Cntx_FileTlistBtns #btnDownload").attr("disabled", true);
            $("#Cntx_FileTlistBtns #btnDelete").attr("disabled", true);
        } else {
            $("#Cntx_FileTlistBtns #btnDownload").attr("disabled", false);
            $("#Cntx_FileTlistBtns #btnDelete").attr("disabled", false);
        }
    },

    SetParamsFromPrjState: function() {
        prjState = da.PrjView.Get();

        da.Cntx_FileTlist.FolderAbsPath =
            '<?php echo $_SESSION["PrjAbsPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
            (prjState["CntxFolderNam"] ? prjState["CntxFolderNam"] :
                '<?php echo $_SESSION["PSV"]["CntxFolderNam"]; ?>') + '/';
        da.Cntx_FileTlist.FolderRelPath =
            '<?php echo $_SESSION["PrjRelPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
            (prjState["CntxFolderNam"] ? prjState["CntxFolderNam"] :
                '<?php echo $_SESSION["PSV"]["CntxFolderNam"]; ?>') + '/';
        return prjState;
    },

    SetUploadfileParams: function() {
        prjState = da.Cntx_FileTlist.SetParamsFromPrjState();
        // alert(da.Cntx_FileTlist.FolderAbsPath);
        data = {
            DstFolder: da.Cntx_FileTlist.FolderAbsPath,
            UplName: da.Cntx_FileTlist.UplName,
            AllowedUploadFileExt: da.Cntx_FileTlist.AllowedUploadFileExt,
        };
        // alert(data["DstFolder"]);
        da.SetUploadfileParams(data, da.Cntx_FileTlist.whoIAm);
        return prjState;
    },

    RefreshObj: function() {
        $("#CntxList").DataTable().ajax.reload(null, false);
    },

    DeleteFile: function() {
        try {
            // FilePath= $("#Cntx_DstFolder").val();
            FilePath = da.Cntx_FileTlist.FolderAbsPath;
            Fn = $("#Cntx_SelectedFile").val();
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
                        // fsManagerCntx: "repoCntxs",
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
                        da.UsrMsgShow(da.Cntx_FileTlist.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["Msg"]);
                        da.Cntx_FileTlist.RefreshObj();
                        da.UsrMsgShow(da.Cntx_FileTlist.SuccessMsg, "Info");
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },
    Get: function(obj) {
        prjState = da.Cntx_FileTlist.SetParamsFromPrjState();

        data = {
            FileNam: $(obj).children(":nth-child(1)").text(),
            FileRef: da.Cntx_FileTlist.FolderRelPath + $(obj).children(":nth-child(1)").text(),
        };
        return data;
    },

    Set: function(data) {
        $("#Clean_IdClean").val(data["IdClean"]);
        $("#Clean_IdPrj").val(data["IdPrj"]);
        // $("#Clean_PrjNam").val(data["PrjNam"]);
        $("#Clean_Note").val(data["Note"]);

        da.CleanRead.btnControl();
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.Cntx_FileTlist.CleanSelectedRow();
        } else {
            da.Cntx_FileTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.Cntx_FileTlist.Get(obj);
            da.Cntx_FileTlist.SetSelectedRow(data);
        }
        da.Cntx_FileTlist.btnControl();
    },

    SetSelectedRow: function(data) {
        if (da.Cntx_FileTlist.Mode == "TlistRef") {
            // alert(data["FileRef"]);
            da.RefreshDetailPanels(da.Cntx_FileTlist.DetailPanels, "SetRef", data);
        }
        if (da.Cntx_FileTlist.RefPanels && da.Cntx_FileTlist.RefPanels != '') {
            // alert(data["FileRef"]);
            da.RefreshDetailPanels(da.Cntx_FileTlist.RefPanels, "SetFileRef", data);
        }
        $("#Cntx_SelectedFile").val(data["FileNam"]);
        // alert(data["FileRef"]);
        // $("#Cntx_FileViewer").IFrame('createTab', Namfile, da.Cntx_FileTlist.FolderRelPath + Namfile, 'index', true);
        $('#Cntx_FileViewer').attr('src', data["FileRef"]);
    },
    CleanSelectedRow: function() {
        if (da.Cntx_FileTlist.RefPanels && da.Cntx_FileTlist.RefPanels != '') {
            // alert(da.Cntx_FileTlist.DetailPanels);
            da.RefreshDetailPanels(da.Cntx_FileTlist.RefPanels, "CleanFileRef");
        }
        $("#Cntx_SelectedFile").val("");
        // alert(data["FileRef"]);
        // $("#Cntx_FileViewer").IFrame('createTab', Namfile, da.Cntx_FileTlist.FolderRelPath + Namfile, 'index', true);
        $('#Cntx_FileViewer').attr('src', "");
    },

}

$(document).ready(function() {
    // alert($("#Cntx_DstFolder").val());

    da.Cntx_FileTlist.Table = $("#CntxList").DataTable({
        "dom": "<'myfilter'f>t ip",
        "paging": true,
        "lengthChange": false,
        "pageLength": da.Cntx_FileTlist.PageLength,
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
            "url": "DA/HtmlComponents/Cntx/FileTlist.proxy.php",
            "type": "POST",
            "dataSrc": "data"
        },
        "columns": [{
            "data": "FileNam"
        }]

    });

    $("#CntxList tbody").on("click", "tr", function() {
        da.Cntx_FileTlist.ToggleRow(this);
    });

    $("#Cntx_FileTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.Cntx_FileTlist.RefreshObj();
    });

    $("#Cntx_FileTlistBtns #btnDelete").click(function() {
        // alert("Update tabella");
        Fn = $("#Cntx_SelectedFile").val();
        if (confirm("Confirm Delete of file (" + Fn + ") ?")) {
            da.Cntx_FileTlist.DeleteFile();
        }
    });

    $("#Cntx_FileTlistBtns #btnDownload").click(function(e) {
        e.preventDefault();
        // window.location.href = $("#Cntx_DstRelFolder").val() + $("#Cntx_SelectedFile").val();
        // alert(da.Cntx_FileTlist.FolderRelPath + $("#Cntx_SelectedFile").val());
        window.open(da.Cntx_FileTlist.FolderRelPath + $("#Cntx_SelectedFile").val(),
            '_blank');
    });


/* *************************************************************************** */
    // UploadFiles management 
    $('#Cntx_FileTlist_DropFiles #dropFiles').click(function() {
        // Simulate a click on the file input button
        // to show the file browser diaEvntStats
        // $("#Cntx_FileTlist_UploadFiles #upl").click();
        $("#Cntx_FileTlist_UploadFiles #upl").click();
    });

    $('#Cntx_FileTlist_UploadFiles #UploadFiles').fileupload({
        // This element will accept file drag/Cntx_FileTlist_DropFiles uploading
        dropZone: $('#Cntx_FileTlist_DropFiles #dropFiles'),
        Fn: "",
        fileSize: "",
        // This function is called when a file is added to the queue;
        add: function(e, data) {
            Fn = data.files[0].name;
            if (confirm("Confirm Upload of file (" + Fn + ") ?")) {
                prjState = da.Cntx_FileTlist.SetUploadfileParams();
                // alert(Fn);
                fileSize = da.formatFileSize(data.files[0].size);
                // Automatically Upload the file once it is added to the queue
                var jqXHR = data.submit();
            } else {
                da.UsrMsgShow(da.Cntx_FileTlist.FailMsg, "Info");
                return;
            }
        },
        success: function(e, data) {
            res = JSON.parse(e);
            // alert(res["State"]);
            if (res["State"]) {
                resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nexecuted !\n";
                da.Cntx_FileTlist.RefreshObj();
            } else {
                resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nnot executed !\n";
            }
            // alert(resultMessage);
            da.CleanUploadfileParams(da.Cntx_FileTlist.whoIAm);
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