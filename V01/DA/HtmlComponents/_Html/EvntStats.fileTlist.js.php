<script type="text/javascript" ref="da.EvntStats_FileTlist">
da.EvntStats_FileTlist = {

    whoIAm: "EvntStats_FileTlist",
    Table: null,
    Mode: "<?php echo $this->Mode; ?>",
 // PageLength: "<?php echo $this->PageLength; ?>",
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
        if ($("#EvntStats_SelectedFile").val() == "") {
            $("#EvntStats_FileTlistBtns #btnDownload").attr("disabled", true);
            $("#EvntStats_FileTlistBtns #btnDelete").attr("disabled", true);
        } else {
            $("#EvntStats_FileTlistBtns #btnDownload").attr("disabled", false);
            $("#EvntStats_FileTlistBtns #btnDelete").attr("disabled", false);
        }
    },

    SetParamsFromPrjState: function() {
        prjState = da.PrjView.Get();

        da.EvntStats_FileTlist.FolderAbsPath =
            '<?php echo $_SESSION["PrjAbsPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
            (prjState["EvntFolderNam"] ? prjState["EvntFolderNam"] :
                '<?php echo $_SESSION["PSV"]["EvntFolderNam"]; ?>') + '/';
        da.EvntStats_FileTlist.FolderRelPath =
            '<?php echo $_SESSION["PrjRelPath"].$_SESSION["PSV"]["PrjFolderNam"].'/'; ?>' +
            (prjState["EvntFolderNam"] ? prjState["EvntFolderNam"] :
                '<?php echo $_SESSION["PSV"]["EvntFolderNam"]; ?>') + '/';

        return prjState;
    },

    SetUploadfileParams: function() {
        prjState = da.EvntStats_FileTlist.SetParamsFromPrjState();
        data = {
            DstFolder: da.EvntStats_FileTlist.FolderAbsPath,
            UplName: da.EvntStats_FileTlist.UplName,
            AllowedUploadFileExt: da.EvntStats_FileTlist.AllowedUploadFileExt,
        };
        da.SetUploadfileParams(data, da.EvntStats_FileTlist.whoIAm);
        return prjState;
    },

    RefreshObj: function() {
        $("#EvntStatsList").DataTable().ajax.reload(null, false);
    },

    DeleteFile: function() {
        try {
            FilePath = da.EvntStats_FileTlist.FolderAbsPath;
            Fn = $("#EvntStats_SelectedFile").val();
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
                        da.UsrMsgShow(da.EvntStats_FileTlist.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["Msg"]);
                        // alert("refresh");
                        da.EvntStats_FileTlist.RefreshObj();
                        da.UsrMsgShow(da.EvntStats_FileTlist.SuccessMsg, "Info");
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },
    Get: function(obj) {
        prjState = da.EvntStats_FileTlist.SetParamsFromPrjState();

        data = {
            FileNam: $(obj).children(":nth-child(1)").text(),
            FileRef: da.EvntStats_FileTlist.FolderRelPath + $(obj).children(":nth-child(1)").text(),
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
            da.EvntStats_FileTlist.CleanSelectedRow();
        } else {
            da.EvntStats_FileTlist.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            data = da.EvntStats_FileTlist.Get(obj);
            da.EvntStats_FileTlist.SetSelectedRow(data);
        }
        da.EvntStats_FileTlist.btnControl();
    },
    SetSelectedRow: function(data) {
        if (da.EvntStats_FileTlist.Mode == "TlistRef") {
            da.RefreshDetailPanels(da.EvntStats_FileTlist.DetailPanels, "SetRef", data);
        }
        if (da.EvntStats_FileTlist.RefPanels && da.EvntStats_FileTlist.RefPanels != '') {
            da.RefreshDetailPanels(da.EvntStats_FileTlist.RefPanels, "SetFileRef", data);
        }
        $("#EvntStats_SelectedFile").val(data["FileNam"]);
        $('#EvntStats_FileViewer').attr('src', data["FileRef"]);
    },
    CleanSelectedRow: function() {
        if (da.EvntStats_FileTlist.Mode == "TlistRef") {
            da.RefreshDetailPanels(da.EvntStats_FileTlist.DetailPanels, "ClenRef");
        }
        if (da.EvntStats_FileTlist.RefPanels && da.EvntStats_FileTlist.RefPanels != '') {
            da.RefreshDetailPanels(da.EvntStats_FileTlist.RefPanels, "CleanFileRef");
        }
        $("#EvntStats_SelectedFile").val("");
        $('#EvntStats_FileViewer').attr('src', "");
    },

}

$(document).ready(function() {
    // alert($("#EvntStats_DstFolder").val());

    da.EvntStats_FileTlist.Table = $("#EvntStatsList").DataTable({
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
            "url": "DA/HtmlComponents/EvntStats/FileTlist.proxy.php",
            "type": "POST",
            "dataSrc": "data"
        },
        "columns": [{
            "data": "FileNam"
        }]
    });

    $("#EvntStatsList tbody").on("click", "tr", function() {
        da.EvntStats_FileTlist.ToggleRow(this);
    });

    $("#EvntStats_FileTlistBtns #btnRefresh").click(function() {
        // alert("Update tabella");
        da.EvntStats_FileTlist.RefreshObj();
    });

    $("#EvntStats_FileTlistBtns #btnDelete").click(function() {
        // alert("Update tabella");
        Fn = $("#EvntStats_SelectedFile").val();
        if (confirm("Confirm Delete of file (" + Fn + ") ?")) {
            da.EvntStats_FileTlist.DeleteFile();
        }
    });

    $("#EvntStats_FileTlistBtns #btnDownload").click(function(e) {
        e.preventDefault();
        // alert(da.EvntStats_FileTlist.FolderRelPath + $("#EvntStats_SelectedFile").val());
        window.open(da.EvntStats_FileTlist.FolderRelPath + $("#EvntStats_SelectedFile").val(),
            '_blank');
    });

    /* *************************************************************************** */
    // UploadFiles management 
    $('#EvntStats_FileTlist_DropFiles #dropFiles').click(function() {
        // Simulate a click on the file input button
        $("#EvntStats_FileTlist_UploadFiles #upl").click();
    });

    $('#EvntStats_FileTlist_UploadFiles #UploadFiles').fileupload({
        // This element will accept file drag/EvntStats_FileTlist_DropFiles uploading
        dropZone: $('#EvntStats_FileTlist_DropFiles #dropFiles'),
        Fn: "",
        fileSize: "",
        // This function is called when a file is added to the queue;
        add: function(e, data) {
            Fn = data.files[0].name;
            if (confirm("Confirm Upload of file (" + Fn + ") ?")) {
                prjState = da.EvntStats_FileTlist.SetUploadfileParams();
                // alert(Fn);
                fileSize = da.formatFileSize(data.files[0].size);
                // Automatically Upload the file once it is added to the queue
                var jqXHR = data.submit();
            } else {
                da.UsrMsgShow(da.EvntStats_FileTlist.FailMsg, "Info");
                return;
            }
        },
        success: function(e, data) {
            res = JSON.parse(e);
            // alert(res["State"]);
            if (res["State"]) {
                resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nexecuted !\n";
                da.EvntStats_FileTlist.RefreshObj();
            } else {
                resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nnot executed !\n";
            }
            // alert(resultMessage);
            da.CleanUploadfileParams(da.EvntStats_FileTlist.whoIAm);
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

