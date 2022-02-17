<?php
echo'
    /**
    Open function for Std Read panel
    */
    Open: function() {
        SrvOpNam = "Open";
        try {
            da.navigation.PrjCompleteBoard();
        } catch (e) {
            da.UsrMsgShow(e.stack, "Exception");
        }
    },
';
?>
    