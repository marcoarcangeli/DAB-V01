    /**
    Delete function for Std Read panel
    */
    Delete: function() {
        SrvOpNam = 'Delete';
        try {
            Id= <?php echo $this->JSPanelNamSpace; ?>.<?php echo $this->FEIdNam; ?> = $("#<?php echo $this->PanelTag; ?><?php echo $this->FEIdNam; ?>").val();
            Nam = $("#<?php echo $this->PanelTag; ?>IdProfile").val() + " - " + $(
                    "#<?php echo $this->PanelTag; ?>IdFeature")
                .val() + " - " + $("#<?php echo $this->PanelTag; ?>IdAuthLevel").val();
            if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: '<?php echo $_SESSION["HtmlComponentsRelPath"].$this->FE; ?>' + '/' + "UI.proxy.php",
                    dataType: "json",
                    "data": {
                        "SrvOpParams": <?php echo $this->JSPanelNamSpace; ?>.GetSrvOpParams(SrvOpNam),
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow(<?php echo $this->JSPanelNamSpace; ?>.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            <?php echo $this->JSPanelNamSpace; ?>.Clean();
                            // da.UsrTlist.RefreshObj();
                            if (<?php echo $this->JSPanelNamSpace; ?>.ParentObj) {
                                da.RefreshObj(<?php echo $this->JSPanelNamSpace; ?>.ParentObj);
                            }
                            da.UsrMsgShow(<?php echo $this->JSPanelNamSpace; ?>.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(<?php echo $this->JSPanelNamSpace; ?>.FailMsg, "Info");
                        }
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },
