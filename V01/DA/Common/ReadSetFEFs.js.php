<?php
echo'
    // Set and Clean a FEFs UI fields
    // Dependencies: btnControl [weak]
    Set: function(data=null) {
        SetFs="'.$this->SetFs.'";
        if (SetFs) {
            SetArr = SetFs.split(",");
            $.each(SetArr, function(index, item) { // Iterates through a collection
                if($("#'.$this->PanelTag.'"+item)){ $("#'.$this->PanelTag.'"+item).val((data)?data[item]:""); }
            });

            '.$this->JSPanelNamSpace.'.StateData=(data)?data:null;
            if ( $.isFunction('.$this->JSPanelNamSpace.'.btnControl) ) {
                '.$this->JSPanelNamSpace.'.btnControl();
            }
        }
    },
';
?>
    
