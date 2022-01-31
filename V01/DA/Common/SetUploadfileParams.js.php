<?php
echo'
    /**
     SetUploadfileParams function for Std Uploadfile functionality panel
    */
    SetUploadfileParams: function() {
        data = {
            DstFolder: '.$this->JSPanelNamSpace.'.FolderAbsPath,
            UplName: '.$this->JSPanelNamSpace.'.UplName,
            AllowedUploadFileExt: '.$this->JSPanelNamSpace.'.AllowedUploadFileExt,
        };
        da.SetUploadfileParams(data, '.$this->WhoIAm.');
    },

    ';
?>