<?php
echo'
    /**
    Delete function for Std Read panel
    */
    Delete: function() {
        SrvOpNam = "Delete";
        try {
            Id= '.$this->JSPanelNamSpace.'.'.$this->FEIdNam.' = $("#'.$this->PanelTag.$this->FEIdNam.'").val();
            // must be generalized with a function ex. getNam().
            // or Nam MUST BE a panel field = Nam or a concatenation of other fields.
            // or remove Nam from the msg.
            // Nam = $("#'.$this->PanelTag.'IdProfile").val() + " - " + 
            //       $("#'.$this->PanelTag.'IdFeature").val() + " - " + 
            //       $("#'.$this->PanelTag.'IdAuthLevel").val();
            // if (confirm("Confirm Delete of (" + Id + " - " + Nam + ") ?")) {
            if (confirm("Confirm Delete of the item (" + Id + ") ?")) {
                return $.ajax({
                    type: "POST",
                    url: "'.$_SESSION["HtmlComponentsRelPath"].'/UI.proxy.php",
                    dataType: "json",
                    "data": {
                        "SrvOpParams": '.$this->JSPanelNamSpace.'.GetSrvOpParams(SrvOpNam),
                    },
                    error: function(result) {
                        // alert("error: "+result["State"]);
                        da.UsrMsgShow('.$this->JSPanelNamSpace.'.FailMsg, "Error");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        if (result["State"]) {
                            '.$this->JSPanelNamSpace.'.Set();
                            if ('.$this->JSPanelNamSpace.'.ParentObj) {
                                da.RefreshObj('.$this->JSPanelNamSpace.'.ParentObj);
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