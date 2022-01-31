<?php
echo'
    /**
    Download a selected file function for Std FileTlist/View/Edit panel
    TODO:
    - parameterize SelectedFile field in a common session definition
    */
    Download: function(obj) {
        // ex. window.location.href = $("#DstRelFolder").val() + $("#Proc_SelectedFile").val();
        window.open('.$this->JSPanelNamSpace.'.FolderRelPath + $("#'.$this->PanelTag.'SelectedFile").val(), "_blank");
    },
    ';
?>