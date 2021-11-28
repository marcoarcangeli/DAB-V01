<script type="text/javascript" ref="da.AnCntx_FileTlist">
da.AnCntx_FileTlist = {
    Entity: 'AnCntx',
    whoIAm: this.Entity+"_FileTlist",
    PanelTag: this.whoIAm+"_",
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
        if ($("#AnCntx_SelectedFile").val() == "") {
            $("#AnCntx_FileTlistBtns #btnDownload").attr("disabled", true);
            $("#AnCntx_FileTlistBtns #btnDelete").attr("disabled", true);
        } else {
            $("#AnCntx_FileTlistBtns #btnDownload").attr("disabled", false);
            $("#AnCntx_FileTlistBtns #btnDelete").attr("disabled", false);
        }
    },

    SetParamsFromPrjState: function() {
        prjState = da.PrjView.Get();

        da.AnCntx_FileTlist.FolderAbsPath =
            '<?php echo $_SESSION["PrjAbsPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
            (prjState["AnFolderNam"] ? prjState["AnFolderNam"] :
                '<?php echo $_SESSION["PSV"]["AnFolderNam"]; ?>') + '/';
        da.AnCntx_FileTlist.FolderRelPath =
            '<?php echo $_SESSION["PrjRelPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
            (prjState["AnFolderNam"] ? prjState["AnFolderNam"] :
                '<?php echo $_SESSION["PSV"]["AnFolderNam"]; ?>') + '/';
        return prjState;
    },

    SetUploadfileParams: function() {
        prjState = da.AnCntx_FileTlist.SetParamsFromPrjState();
        data = {
            DstFolder: da.AnCntx_FileTlist.FolderAbsPath,
            UplName: da.AnCntx_FileTlist.UplName,
            AllowedUploadFileExt: da.AnCntx_FileTlist.AllowedUploadFileExt,
        };
        da.SetUploadfileParams(data, da.AnCntx_FileTlist.whoIAm);
        return prjState;
    },

    RefreshObj: function() {
        $("#AnCntxList").DataTable().ajax.reload(null, false);
    },

    DeleteFile: function() {
        try {
            FilePath = da.AnCntx_FileTlist.FolderAbsPath;
            Fn = $("#AnCntx_SelectedFile").val();
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
                        // fsManagerAnCntx: "repoAnCntxs",
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
                        da.UsrMsgShow(da.AnCntx_FileTlist.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["Msg"]);
                        da.AnCntx_FileTlist.CleanSelectedRow();
                        da.AnCntx_FileTlist.RefreshObj();
                        da.UsrMsgShow(da.AnCntx_FileTlist.SuccessMsg, "Info");
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    Get: function(obj) {
        prjState = da.AnCntx_FileTlist.SetParamsFromPrjState();

        data = {
            FileNam: $(obj).children(":nth-child(1)").text(),
            FileRef: da.AnCntx_FileTlist.FolderRelPath + $(obj).children(":nth-child(1)").text(),
        };
        return data;
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.AnCntx_FileTlist.CleanSelectedRow();
        } else {
            da.AnCntx_FileTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.AnCntx_FileTlist.Get(obj);
            da.AnCntx_FileTlist.SetSelectedRow(data);
        }
        da.AnCntx_FileTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.AnCntx_FileTlist.Mode == "TlistRef") {
            da.RefreshDetailPanels(da.AnCntx_FileTlist.DetailPanels, "SetRef", data);
        }
        if (da.AnCntx_FileTlist.RefPanels && da.AnCntx_FileTlist.RefPanels != '') {
            da.RefreshDetailPanels(da.AnCntx_FileTlist.RefPanels, "SetFileRef", data);
        }
        $("#AnCntx_SelectedFile").val(data["FileNam"]);
        $('#AnCntx_FileViewer').attr('src', data["FileRef"]);
    },
    CleanSelectedRow: function() {
        if (da.AnCntx_FileTlist.RefPanels && da.AnCntx_FileTlist.RefPanels != '') {
            da.RefreshDetailPanels(da.AnCntx_FileTlist.RefPanels, "CleanFileRef");
        }
        $("#AnCntx_SelectedFile").val("");
        $('#AnCntx_FileViewer').attr('src', "");
    },

}

$(document).ready(function() {
    // alert($("#AnCntx_DstFolder").val());

    da.AnCntx_FileTlist.Table = $("#AnCntxList").DataTable({
        "dom": "<'myfilter'f>t ip",
        "paging": true,
        "lengthChange": false,
        "pageLength": da.AnCntx_FileTlist.PageLength,
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
            "url": "DA/HtmlComponents/AnCntx/FileTlist.proxy.php",
            "type": "POST",
            "dataSrc": "data"
        },
        "columns": [{
            "data": "FileNam"
        }]

    });

    $("#AnCntxList tbody").on("click", "tr", function() {
        da.AnCntx_FileTlist.ToggleRow(this);
    });

    $("#AnCntx_FileTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.AnCntx_FileTlist.RefreshObj();
    });

    $("#AnCntx_FileTlistBtns #btnDelete").click(function() {
        // alert("Update tabella");
        Fn = $("#AnCntx_SelectedFile").val();
        if (confirm("Confirm Delete of file (" + Fn + ") ?")) {
            da.AnCntx_FileTlist.DeleteFile();
        }
    });

    $("#AnCntx_FileTlistBtns #btnDownload").click(function(e) {
        e.preventDefault();
        // window.location.href = $("#AnCntx_DstRelFolder").val() + $("#AnCntx_SelectedFile").val();
        // alert($("#AnCntx_DstRelFolder").val() + $("#AnCntx_SelectedFile").val());
        window.open(da.AnCntx_FileTlist.FolderRelPath + $("#AnCntx_SelectedFile").val(),
            '_blank');
    });

    /* *************************************************************************** */
    // UploadFiles management 
    $('#AnCntx_FileTlist_DropFiles #dropFiles').click(function() {
        // Simulate a click on the file input button
        $("#AnCntx_FileTlist_UploadFiles #upl").click();
    });

    $('#AnCntx_FileTlist_UploadFiles #UploadFiles').fileupload({
        // This element will accept file drag/AnCntx_FileTlist_DropFiles uploading
        dropZone: $('#AnCntx_FileTlist_DropFiles #dropFiles'),
        Fn: "",
        fileSize: "",
        // This function is called when a file is added to the queue;
        add: function(e, data) {
            Fn = data.files[0].name;
            if (confirm("Confirm Upload of file (" + Fn + ") ?")) {
                prjState = da.AnCntx_FileTlist.SetUploadfileParams();
                // alert(Fn);
                fileSize = da.formatFileSize(data.files[0].size);
                // Automatically Upload the file once it is added to the queue
                var jqXHR = data.submit();
            } else {
                da.UsrMsgShow(da.AnCntx_FileTlist.FailMsg, "Info");
                return;
            }
        },
        success: function(e, data) {
            res = JSON.parse(e);
            // alert(res["State"]);
            if (res["State"]) {
                resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nexecuted !\n";
                da.AnCntx_FileTlist.RefreshObj();
            } else {
                resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nnot executed !\n";
            }
            // alert(resultMessage);
            da.CleanUploadfileParams(da.AnCntx_FileTlist.whoIAm);
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