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
    // this is specific for this Tlist panel of ProfileFeatureAuth
    // Filters are dependent from References, Parent entities, specific settings for the panel.
    // A FV (Filter vector) has to be placed in the navigation data
    // FV should be composed, once and for all, out of run time.
    // FM is dependent from interaction data, so it canNOT be moved to the PHP content builder
    // code chunk could be field by the php Content Builder
    GetFMJson: function() {
        data = {
            '; //<?php 
            if(isset($this->FV) && $this->FV !== ""){
                $FVArr=explode(",",$this->FV); // FV: Filter Vector
                foreach ($FVArr as $FF) { // FF: Filter Field
                    if($FF == "SearchIds"){
                        echo '"'.$_SESSION["IdPrfx"].$this->FE.'": {"filterRel":"OR", "filterType" : "NoN", "filterValues" : "\'"+'.$this->JSPanelNamSpace.'.'.$FF.'+"\'"},'.$_SESSION["PHPEoL"];
                    }else{
                        echo '"'.$this->FE.'.'.$FF.'": {"filterRel":"", "filterType" : "NoN", "filterValues" : "\'"+'.$this->JSPanelNamSpace.'.'.$FF.'+"\'"},'.$_SESSION["PHPEoL"];
                    }
                }
            }else if($this->PanelType == 'Read'
                  || $this->PanelType == 'ReadOpen'
            ){
                echo '"'.$this->FE.'.'.$this->FEIdNam.'": {"filterRel":"", "filterType" : "NoN", "filterValues" : "\'"+'.$this->JSPanelNamSpace.'.'.$this->FEIdNam.'+"\'"},'.$_SESSION["PHPEoL"];
            }
            echo' //?>
        };
        return JSON.stringify(data);
    },
';
?>
    
