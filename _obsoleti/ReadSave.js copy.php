    /**
    Save function for Std Read panel
    */
    Save: function() {
        SrvOpNam = 'Save';
        try {
            // alert("#btnSave");
            if (da.verifyCompulsoryFields(<?php echo $this->JSPanelNamSpace; ?>.CompulsoryFields,
                    <?php echo $this->JSPanelNamSpace; ?>.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: '<?php echo $_SESSION["HtmlComponentsRelPath"].$this->FE; ?>' + '/' + "UI.proxy.php",
                    dataType: "json",
                    "data": {
                        "SrvOpParams": <?php echo $this->JSPanelNamSpace; ?>.GetSrvOpParams(SrvOpNam),
                    },
                    error: function(result) {
                        // alert(result["State"]);
                        da.UsrMsgShow(<?php echo $this->JSPanelNamSpace; ?>.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert(result["State"]);
                        if (result["State"]) {
                            $("#<?php echo $this->PanelTag; ?><?php echo $this->FEIdNam; ?>").val(result["<?php echo $this->FEIdNam; ?>"]);
                            // alert(<?php echo $this->JSPanelNamSpace; ?>.ParentObj);
                            if (<?php echo $this->JSPanelNamSpace; ?>.ParentObj) {
                                // alert(<?php echo $this->JSPanelNamSpace; ?>.ParentObjType);
                                da.RefreshObj(<?php echo $this->JSPanelNamSpace; ?>.ParentObj, <?php echo $this->JSPanelNamSpace; ?>.ParentObjType, "Refresh", null);
                            }
                            da.UsrMsgShow(<?php echo $this->JSPanelNamSpace; ?>.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow(<?php echo $this->JSPanelNamSpace; ?>.FailMsg, "Info");
                        }
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.stack, "Exception");
        }
    },
