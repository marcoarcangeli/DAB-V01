    // Set and Clean a FEFs UI fields
    // Dependencies: 
    //      - btnControl [weak]
    Set: function(data=null) {
        SetFs='<?php echo $this->SetFs; ?>';
        if (SetFs) {
            SetArr = SetFs.split(',');
            $.each(SetArr, function(index, item) { // Iterates through a collection
                if($("#<?php echo $this->PanelTag; ?>"+item)){ $("#<?php echo $this->PanelTag; ?>"+item).val((data)?data[item]:''); }
            });

            <?php echo $this->JSPanelNamSpace; ?>.StateData=(data)?data:null;
            if ( $.isFunction(<?php echo $this->JSPanelNamSpace; ?>.btnControl) ) {
                <?php echo $this->JSPanelNamSpace; ?>.btnControl();
            }
        }
    },

