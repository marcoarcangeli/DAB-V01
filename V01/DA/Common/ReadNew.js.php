<?php
echo'
    /**
    New function for Std Read panel
    */
    New: function() {
        SrvOpNam = "";
        try {
            '.$this->JSPanelNamSpace.'.Set();
            '.$this->JSPanelNamSpace.'.Notify(null,"Refresh","DeselectRow");
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },
';
?>