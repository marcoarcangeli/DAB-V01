    /**
    New function for Std Read panel
    */
    New: function() {
        SrvOpNam = '';
        try {
            <?php echo $this->JSPanelNamSpace; ?>.Set();
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },
