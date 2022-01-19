<?php
echo'
    /**
    New function for Std Read panel
    */
    New: function() {
        SrvOpNam = "";
        try {
            '.$this->JSPanelNamSpace.'.Set();
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },
';
?>