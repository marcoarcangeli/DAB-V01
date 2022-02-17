<?php
echo'
    // prepare the SrvOpParams
    // Dependencies: 
    //      - GetFMJson: if necessary or empty string
    //      - GetFEFsJson: for Save op

    GetSrvOpParams: function(SrvOpNam) {
        data = {
            "SrvOpNam"  : SrvOpNam, 
            "FE"        : "'.$this->FE.'", 
            "FEFs"      : "'.$this->FEFs.'",
            "DEs"       : "'.$this->DEs.'",
            "DEFs"      : "'.$this->DEFs.'",  
            "EFs"       : "'.$this->EFs.'",  
            "FM"        : '.$this->JSPanelNamSpace.'.GetFMJson(), 
            "VM"        : (SrvOpNam=="Save")? '.$this->JSPanelNamSpace.'.GetFEFsJson() : null,
        };

        return data;
    },

    // FM Filter Matrix 
    // return json string
    GetFMJson: function() {
        data = {
            '.$this->FMJs.'
        };
        return JSON.stringify(data);
    },
';
?>
    
