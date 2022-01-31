<?php
echo'
    /**
        Refresh function for Std FileView panel
    */
    Refresh: function(data=null) {
        SrvOpNam = "Read"; 
        if(data){
            $("#'.$this->PanelTag.'FileNam").val(data["FileNam"]);
            $("#'.$this->PanelTag.'FileRef").val(data["FileRef"]);
            $("#'.$this->PanelTag.'FileViewer").attr("src", data["FileRef"]);
        }else{
            $("#'.$this->PanelTag.'FileNam").val("");
            $("#'.$this->PanelTag.'FileRef").val("");
            $("#'.$this->PanelTag.'FileViewer").attr("src", "");
        }
    },
';
?>
