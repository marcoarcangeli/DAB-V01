<?php
echo'
    /**
    Refresh function for Std Read panel
    Dependencies: GetSrvOpParams
    */
    Refresh: function(data=null) {
        SrvOpNam = "Read";
        try {
            if(data){
                '.$this->JSPanelNamSpace.'.'.$this->FEIdNam.' = data["'.$this->FEIdNam.'"]
            }
            if ('.$this->JSPanelNamSpace.'.'.$this->FEIdNam.' &&
                '.$this->JSPanelNamSpace.'.'.$this->FEIdNam.' != "") {
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
                            data = result["data"][0];
                            '.$this->JSPanelNamSpace.'.Set(data);
                        } else {
                            da.UsrMsgShow('.$this->JSPanelNamSpace.'.FailMsg, "Info");
                        }
                    },
                })
            }
        } catch (e) {
            da.UsrMsgShow(e.stack, "Exception");
        }
    },
';
?>
