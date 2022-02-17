<script type="text/javascript" ref="da.Log_FileTlist">
da.Log_FileTlist = {

    whoIAm: "Log_FileTlist",
    Table: null,
    Mode: "<?php echo $this->Mode; ?>",
 // PageLength: "<?php echo $this->PageLength; ?>",
    FolderAbsPath: "<?php echo $_SESSION["LogAbsPath"]; ?>", //$_SESSION["LogAbsPath"]    = "DA/Logs/";
    FolderRelPath: "<?php echo $_SESSION["LogRelPath"]; ?>", //$_SESSION["LogRelPath"]    = "DA/Logs/";
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
            $("#Log_FileTlistBtns #btnDownload").attr("disabled", true);
            $("#Log_FileTlistBtns #btnDelete").attr("disabled", true);
        } else {
            $("#Log_FileTlistBtns #btnDownload").attr("disabled", false);
            $("#Log_FileTlistBtns #btnDelete").attr("disabled", false);
        }
    },

    // not necessary cause values are in session
    // SetParamsFromPrjState: function() {
    //     prjState = da.PrjView.Get();

    //     da.Log_FileTlist.FolderAbsPath =
    //         '?php echo $_SESSION["PrjAbsPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
    //         (prjState["AnFolderNam"] ? prjState["AnFolderNam"] :
    //             '?php echo $_SESSION["PSV"]["AnFolderNam"]; ?>') + '/';
    //     da.Log_FileTlist.FolderRelPath =
    //         '?php echo $_SESSION["PrjRelPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
    //         (prjState["AnFolderNam"] ? prjState["AnFolderNam"] :
    //             '?php echo $_SESSION["PSV"]["AnFolderNam"]; ?>') + '/';
    //     return prjState;
    // },

    SetUploadfileParams: function() {
        // prjState = da.Log_FileTlist.SetParamsFromPrjState();
        data = {
            DstFolder: da.Log_FileTlist.FolderAbsPath,
            UplName: da.Log_FileTlist.UplName,
            AllowedUploadFileExt: da.Log_FileTlist.AllowedUploadFileExt,
        };
        da.SetUploadfileParams(data, da.Log_FileTlist.whoIAm);
        // return prjState;
    },

    RefreshObj: function() {
        $("#LogList").DataTable().ajax.reload(null, false);
    },

    DeleteFile: function() {
        try {
            FilePath = da.Log_FileTlist.FolderAbsPath;
            Fn = $("#Log_SelectedFile").val();
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
                        da.UsrMsgShow(da.Log_FileTlist.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["Msg"]);
                        da.Log_FileTlist.CleanSelectedRow();
                        da.Log_FileTlist.RefreshObj();
                        da.UsrMsgShow(da.Log_FileTlist.SuccessMsg, "Info");
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },
    Get: function(obj) {
        // prjState = da.Log_FileTlist.SetParamsFromPrjState();

        data = {
            FileNam: $(obj).children(":nth-child(1)").text(),
            FileRef: da.Log_FileTlist.FolderRelPath + $(obj).children(":nth-child(1)").text(),
        };
        return data;
    },

    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            da.Log_FileTlist.CleanSelectedRow();
        } else {
            da.Log_FileTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.Log_FileTlist.Get(obj);
            da.Log_FileTlist.SetSelectedRow(data);
        }
        da.Log_FileTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.Log_FileTlist.Mode == "TlistRef") {
            da.RefreshDetailPanels(da.Log_FileTlist.DetailPanels, "SetRef", data);
        }
        if (da.Log_FileTlist.RefPanels && da.Log_FileTlist.RefPanels != '') {
            da.RefreshDetailPanels(da.Log_FileTlist.RefPanels, "SetFileRef", data);
        }
        $("#Log_SelectedFile").val(data["FileNam"]);
        $('#Log_FileViewer').attr('src', data["FileRef"]);
    },
    CleanSelectedRow: function() {
        if (da.Log_FileTlist.RefPanels && da.Log_FileTlist.RefPanels != '') {
            da.RefreshDetailPanels(da.Log_FileTlist.RefPanels, "CleanFileRef");
        }
        $("#Log_SelectedFile").val("");
        $('#Log_FileViewer').attr('src', "");
    },


}

$(document).ready(function() {
    // alert($("#Log_DstFolder").val());

    da.Log_FileTlist.Table = $("#LogList").DataTable({
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
            "url": "DA/HtmlComponents/Log/FileTlist.proxy.php",
            "type": "POST",
            "dataSrc": "data"
        },
        "columns": [{
            "data": "FileNam"
        }],
        "order": [
            [0, "desc"]
        ]
    });

    // $("#LogList tbody").on("dblclick", "tr", function() {
    //     var IdUsr = $(this).children(":nth-child(1)").text();
    //     alert(IdUsr);
    //     // window.location = "../ingrediente/viewPubbliche.php?IdUsr=" + IdUsr;
    //     Evnt.stopImmediatePropagation();
    // });

    $("#LogList tbody").on("click", "tr", function() {
        da.Log_FileTlist.ToggleRow(this);
    });

    $("#Log_FileTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.Log_FileTlist.RefreshObj();
    });

    $("#Log_FileTlistBtns #btnDelete").click(function() {
        Fn = $("#Log_SelectedFile").val();
        if (confirm("Confirm Delete of file (" + Fn + ") ?")) {
            da.Log_FileTlist.DeleteFile();
        }
    });

    $("#Log_FileTlistBtns #btnDownload").click(function(e) {
        e.preventDefault();
        // window.location.href = $("#DstRelFolder").val() + $("#Log_SelectedFile").val();
        window.open(da.Log_FileTlist.FolderRelPath + $("#Log_SelectedFile").val(), '_blank');
    });
    /* *************************************************************************** */
    // UploadFiles management 
    $('#Log_FileTlist_DropFiles #dropFiles').click(function() {
        // Simulate a click on the file input button
        $("#Log_FileTlist_UploadFiles #upl").click();
    });

    $('#Log_FileTlist_UploadFiles #UploadFiles').fileupload({
        // This element will accept file drag/Log_FileTlist_DropFiles uploading
        dropZone: $('#Log_FileTlist_DropFiles #dropFiles'),
        Fn: "",
        fileSize: "",
        // This function is called when a file is added to the queue;
        add: function(e, data) {
            Fn = data.files[0].name;
            if (confirm("Confirm Upload of file (" + Fn + ") ?")) {
                prjState = da.Log_FileTlist.SetUploadfileParams();
                // alert(Fn);
                fileSize = da.formatFileSize(data.files[0].size);
                // Automatically Upload the file once it is added to the queue
                var jqXHR = data.submit();
            } else {
                da.UsrMsgShow(da.Log_FileTlist.FailMsg, "Info");
                return;
            }
        },
        success: function(e, data) {
            res = JSON.parse(e);
            // alert(res["State"]);
            if (res["State"]) {
                resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nexecuted !\n";
                da.Log_FileTlist.RefreshObj();
            } else {
                resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nnot executed !\n";
            }
            // alert(e);
            // alert(data);
            da.Log_FileTlist.RefreshObj();
            da.CleanUploadfileParams(da.Log_FileTlist.whoIAm);
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