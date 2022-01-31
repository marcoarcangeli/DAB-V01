<?php
echo'
    // Read panel Btn ctrl
    // Dependencies: isChangedFEFs
    btnControl: function() {
        /**concept paneltype: Filetlist */
        if ($("#'.$this->PanelTag.'SelectedFile").val() == "") {
            $("#'.$this->PanelBtnsNam.' #btnDownload").attr("disabled", true);
            $("#'.$this->PanelBtnsNam.' #btnDelete").attr("disabled", true);
        } else {
            $("#'.$this->PanelBtnsNam.' #btnDownload").attr("disabled", false);
            $("#'.$this->PanelBtnsNam.' #btnDelete").attr("disabled", false);
        }
    },

';
?>
