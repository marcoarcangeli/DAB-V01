    /**
    Refresh function for Std Read panel
    */
    Refresh: function(data=null) {
        SrvOpNam = 'Read';
        try {
            if(data){
                <?php echo $this->JSPanelNamSpace; ?>.<?php echo $this->FEIdNam; ?> = data["<?php echo $this->FEIdNam; ?>"]
            }
            if (<?php echo $this->JSPanelNamSpace; ?>.<?php echo $this->FEIdNam; ?> &&
                <?php echo $this->JSPanelNamSpace; ?>.<?php echo $this->FEIdNam; ?> != '') {
                return $.ajax({
                    type: "POST",
                    // url: "DA/HtmlComponents/ProfileFeatureAuth/UI.proxy.php",
                    url: '<?php echo $_SESSION["HtmlComponentsRelPath"].$this->FE; ?>/UI.proxy.php',
                    dataType: "json",
                    "data": {
                        "SrvOpParams": <?php echo $this->JSPanelNamSpace; ?>.GetSrvOpParams(SrvOpNam),
                    },
                    error: function(result) {
                        da.UsrMsgShow(<?php echo $this->JSPanelNamSpace; ?>.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data = result["data"][0];
                        <?php echo $this->JSPanelNamSpace; ?>.Set(data);
                    },
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

