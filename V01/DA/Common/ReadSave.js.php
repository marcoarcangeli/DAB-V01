<?php
echo'
    /**
    Save function for Std Read panel
    */
    Save: function() {
        SrvOpNam = "Save";
        try {
            if (da.verifyCompulsoryFields('.$this->JSPanelNamSpace.'.CompulsoryFields,
                '.$this->JSPanelNamSpace.'.PanelTag)) {
                return $.ajax({
                    type: "POST",
                    url: "'.$_SESSION["HtmlComponentsRelPath"].'/UI.proxy.php",
                    dataType: "json",
                    "data": {
                        "SrvOpParams": '.$this->JSPanelNamSpace.'.GetSrvOpParams(SrvOpNam),
                    },
                    error: function(result) {
                        da.UsrMsgShow('.$this->JSPanelNamSpace.'.FailMsg, "Error");
                    },
                    success: function(result) {
                        if (result["State"]) {
                            $("#'.$this->PanelTag.$this->FEIdNam.'").val(result["'.$this->FEIdNam.'"]);
                            if ('.$this->JSPanelNamSpace.'.ParentObj) {
                                da.NotifyObjs('.$this->JSPanelNamSpace.'.ParentObj, "Refresh", null);
                            }
                            da.UsrMsgShow('.$this->JSPanelNamSpace.'.SuccessMsg, "Info");
                        } else {
                            da.UsrMsgShow('.$this->JSPanelNamSpace.'.FailMsg, "Info");
                        }
                    }
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.stack, "Exception");
        }
    },
';
?>
    