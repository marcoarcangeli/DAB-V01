<?php
echo'
    /**
    Delete function for Std FileTlist panel
    */
    SetDeleteFileParams: function() {
        data = {
            // fsManagerCntx: "repoEvnts",
            FsManagerMethod: "RemoveFile",
            // projectName: "",
            // analysisName: "",
            FilePath: '.$this->JSPanelNamSpace.'.FolderAbsPath,
            FileNam: $(obj).children(":nth-child(1)").text(),
            // fileContent: "",
            // overWrite: "",
        };
        return data;
    },

    Delete: function() {
        SrvOpNam = "RemoveFile";

        try {
            FilePath = '.$this->JSPanelNamSpace.'.FolderAbsPath;
            Fn = $("#'.$this->PanelTag.'SelectedFile").val();
            // alert(FilePath);
            // alert(Fn);
            if (
                FilePath && FilePath != "" &&
                Fn && Fn != ""
            ){
                if (confirm("Confirm Delete of the item (" + Fn + ") ?")) {
                    $.ajax({
                        type: "POST",
                        url: "'.$_SESSION["FsComponentsRelPath"].$_SESSION["FsManagerProxyPhp"].'",
                        async: true,
                        dataType: "json",
                        data: '.$this->JSPanelNamSpace.'.SetDeleteFileParams(),
                        error: function(result) {
                            // alert(result["Msg"]);
                            da.UsrMsgShow('.$this->JSPanelNamSpace.'.FailMsg, "Error");
                        },
                        success: function(result) {
                            // alert(result["Msg"]);
                            '.$this->JSPanelNamSpace.'.CleanSelectedRow();
                            '.$this->JSPanelNamSpace.'.Refresh();
                            da.UsrMsgShow('.$this->JSPanelNamSpace.'.SuccessMsg, "Info");
                        }
                    })
                }
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },
';
?>