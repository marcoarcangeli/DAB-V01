    // Set and Clean a FEFs UI fields
    // Dependencies: 
    //      - btnControl
    Set: function(data=null) {
        EFs='<?php echo $this->EFs; ?>';
        InRefs='<?php echo $this->InRefs; ?>';
        SetFs='<?php echo $this->SetFs; ?>';
        // SetFs: EFs - Fields(InRefs);
        // Fields(InRefs): foreach InRef ('Id'+item || element==item+'Nam')
        if (EFs) {
            InRefArr = InRefs.split(',');
            SetArr = SetFs.split(',');
            // exclude InRefs Fields
            // It should be performed server side in ContentBuilder OR, once and for all, before that.
            // $.each(InRefArr, function(index, item) { // Iterates through a collection
            //     SetArr= $.grep(SetArr, function (element, index) {
            //         // return !(element.includes('Id'+item) || element.includes(item+'Nam');
            //         return !(element=='Id'+item || element==item+'Nam');
            //     });
            // });
            $.each(SetArr, function(index, item) { // Iterates through a collection
                // alert('EFsArr item: '+"#<?php echo $this->PanelTag; ?>"+item);
                if($("#<?php echo $this->PanelTag; ?>"+item)){ $("#<?php echo $this->PanelTag; ?>"+item).val((data)?data[item]:''); }
            });

            <?php echo $this->JSPanelNamSpace; ?>.StateData=(data)?data:null;
            <?php echo $this->JSPanelNamSpace; ?>.btnControl();
        }
    },

