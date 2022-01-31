<?php
echo'
    /**
    Toggle, set and clean functions for Std Tlist panel
    */
    /* *************************************************************************** */
    // UploadFiles management 
    $("#'.$this->PanelTag.'DropFiles #dropFiles").click(function() {
        // Simulate a click on the file input button
        $("#'.$this->PanelTag.'UploadFiles #upl").click();
    });

    $("#'.$this->PanelTag.'UploadFiles #UploadFiles").fileupload({
        // This element will accept file drag/Proc_FileTlist_DropFiles uploading
        dropZone: $("#'.$this->PanelTag.'DropFiles #dropFiles"),
        Fn: "",
        fileSize: "",
        // This function is called when a file is added to the queue;
        add: function(e, data) {
            Fn = data.files[0].name;
            if (confirm("Confirm Upload of file (" + Fn + ") ?")) {
                prjState = '.$this->JSPanelNamSpace.'.SetUploadfileParams();
                // alert(Fn);
                fileSize = da.formatFileSize(data.files[0].size);
                // Automatically Upload the file once it is added to the queue
                var jqXHR = data.submit();
            } else {
                da.UsrMsgShow('.$this->JSPanelNamSpace.'.FailMsg, "Info");
                return;
            }
        },
        success: function(e, data) {
            res = JSON.parse(e);
            // alert(res["State"]);
            if (res["State"]) {
                resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nexecuted !\n";
                '.$this->JSPanelNamSpace.'.Refresh();
            } else {
                resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nnot executed !\n";
            }
            // alert(e);
            // alert(data);
            '.$this->JSPanelNamSpace.'.Refresh();
            da.CleanUploadfileParams('.$this->WhoIAm.');
            da.UsrMsgShow(resultMessage, "Info");
        },
        fail: function(e, data) {
            // alert(data.jqXHR.responseText);
            resultMessage = "File load \n" + Fn + " (" + fileSize + ") \nnot executed !\n";
            da.UsrMsgShow(resultMessage, "Info");
        }
    });
';
?>