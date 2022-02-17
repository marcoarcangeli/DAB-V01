<script type="text/javascript" ref="da.Proc_FileTlist">
da.Proc_FileTlist = {

    whoIAm: "Proc_FileTlist", 
    Table: null,
 // PageLength: "<?php echo $this->PageLength; ?>",
    FolderAbsPath: '<?php echo $_SESSION["ProcAbsPath"]; ?>',
    FolderRelPath: '<?php echo $_SESSION["ProcRelPath"]; ?>',
    AllowedUploadFileExt: "<?php echo $this->AllowedUploadFileExt; ?>",
    UplName: '<?php echo $_SESSION["UploadFileBufferName"]; ?>', //'upl'
    
    Mode: '<?php echo $this->Mode; ?>',
    DetailPanels: '<?php echo $this->DetailPanels; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: '<?php echo $this->RefPanels; ?>',
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    btnControl: function() {
        if ($("#Proc_SelectedFile").val() == "") {
            $("#Proc_FileTlistBtns #btnDownload").attr("disabled", true);
            $("#Proc_FileTlistBtns #btnDelete").attr("disabled", true);
        } else {
            $("#Proc_FileTlistBtns #btnDownload").attr("disabled", false);
            $("#Proc_FileTlistBtns #btnDelete").attr("disabled", false);
        }
    },

    // not necessary cause values are in session
    // SetParamsFromPrjState: function() {
    //     prjState = da.PrjView.Get();

    //     da.Proc_FileTlist.FolderAbsPath =
    //         '?php echo $_SESSION["PrjAbsPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
    //         (prjState["AnFolderNam"] ? prjState["AnFolderNam"] :
    //             '?php echo $_SESSION["PSV"]["AnFolderNam"]; ?>') + '/';
    //     da.Proc_FileTlist.FolderRelPath =
    //         '?php echo $_SESSION["PrjRelPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
    //         (prjState["AnFolderNam"] ? prjState["AnFolderNam"] :
    //             '?php echo $_SESSION["PSV"]["AnFolderNam"]; ?>') + '/';
    //     return prjState;
    // },

    SetUploadfileParams: function() {
        // prjState = da.Proc_FileTlist.SetParamsFromPrjState();
        data = {
            DstFolder: da.Proc_FileTlist.FolderAbsPath,
            UplName: da.Proc_FileTlist.UplName,
            AllowedUploadFileExt: da.Proc_FileTlist.AllowedUploadFileExt,
        };
        da.SetUploadfileParams(data, da.Proc_FileTlist.whoIAm);
        // return prjState;
    },

    RefreshObj: function() {
        $("#ProcList").DataTable().ajax.reload(null, false);
    },

    DeleteFile: function() {
        try {
            FilePath = da.Proc_FileTlist.FolderAbsPath;
            Fn = $("#Proc_SelectedFile").val();
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
                        da.UsrMsgShow(da.Proc_FileTlist.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["Msg"]);
                        da.Proc_FileTlist.CleanSelectedRow();
                        da.Proc_FileTlist.RefreshObj();
                        da.UsrMsgShow(da.Proc_FileTlist.SuccessMsg, "Info");
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    Get: function(obj) {
        // prjState = da.Proc_FileTlist.SetParamsFromPrjState();

        data = {
            FileNam: $(obj).children(":nth-child(1)").text(),
            FileRef: da.Proc_FileTlist.FolderRelPath + $(obj).children(":nth-child(1)").text(),
        };
        return data;
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.Proc_FileTlist.CleanSelectedRow();
        } else {
            da.Proc_FileTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.Proc_FileTlist.Get(obj);
            da.Proc_FileTlist.SetSelectedRow(data);
        }
        da.Proc_FileTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.Proc_FileTlist.Mode == "TlistRef") {
            da.RefreshDetailPanels(da.Proc_FileTlist.DetailPanels, "SetRef", data);
        }
        if (da.Proc_FileTlist.RefPanels && da.Proc_FileTlist.RefPanels != '') {
            da.RefreshDetailPanels(da.Proc_FileTlist.RefPanels, "SetFileRef", data);
        }
        $("#Proc_SelectedFile").val(data["FileNam"]);
        $('#Proc_FileViewer').attr('src', data["FileRef"]);
    },
    CleanSelectedRow: function() {
        if (da.Proc_FileTlist.RefPanels && da.Proc_FileTlist.RefPanels != '') {
            da.RefreshDetailPanels(da.Proc_FileTlist.RefPanels, "CleanFileRef");
        }
        $("#Proc_SelectedFile").val("");
        $('#Proc_FileViewer').attr('src', "");
    },

}
$(document).ready(function() {
    // alert($("#dstFolder").val());

    da.Proc_FileTlist.Table = $("#ProcList").DataTable({
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
            "url": "DA/HtmlComponents/Proc/FileTlist.proxy.php",
            "type": "POST",
            "dataSrc": "data"
        },
        "columns": [{
            "data": "FileNam"
        }]

    });

    $("#ProcList tbody").on("click", "tr", function() {
        da.Proc_FileTlist.ToggleRow(this);
    });

    $("#Proc_FileTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.Proc_FileTlist.RefreshObj();
    });

    $("#Proc_FileTlistBtns #btnDelete").click(function() {
        // alert("Update tabella");
        Fn = $("#Proc_SelectedFile").val();
        if (confirm("Confirm Delete of file (" + Fn + ") ?")) {
            da.Proc_FileTlist.DeleteFile();
        }
    });

    $("#Proc_FileTlistBtns #btnDownload").click(function(e) {
        e.preventDefault();
        // window.location.href = $("#DstRelFolder").val() + $("#Proc_SelectedFile").val();
        window.open(da.Proc_FileTlist.FolderRelPath + $("#Proc_SelectedFile").val(), '_blank');
    });

    /* *************************************************************************** */
    // UploadFiles management 
    $('#Proc_FileTlist_DropFiles #dropFiles').click(function() {
        // Simulate a click on the file input button
        $("#Proc_FileTlist_UploadFiles #upl").click();
    });

    $('#Proc_FileTlist_UploadFiles #UploadFiles').fileupload({
        // This element will accept file drag/Proc_FileTlist_DropFiles uploading
        dropZone: $('#Proc_FileTlist_DropFiles #dropFiles'),
        Fn: "",
        fileSize: "",
        // This function is called when a file is added to the queue;
        add: function(e, data) {
            Fn = data.files[0].name;
            if (confirm("Confirm Upload of file (" + Fn + ") ?")) {
                prjState = da.Proc_FileTlist.SetUploadfileParams();
                // alert(Fn);
                fileSize = da.formatFileSize(data.files[0].size);
                // Automatically Upload the file once it is added to the queue
                var jqXHR = data.submit();
            } else {
                da.UsrMsgShow(da.Proc_FileTlist.FailMsg, "Info");
                return;
            }
        },
        success: function(e, data) {
            res = JSON.parse(e);
            // alert(res["State"]);
            if (res["State"]) {
                resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nexecuted !\n";
                da.Proc_FileTlist.RefreshObj();
            } else {
                resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nnot executed !\n";
            }
            // alert(e);
            // alert(data);
            da.Proc_FileTlist.RefreshObj();
            da.CleanUploadfileParams(da.Proc_FileTlist.whoIAm);
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

