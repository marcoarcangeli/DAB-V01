    // Get FEFs UI fields values and return a json array
    // Dependencies: 
    //      - btnControl
    GetFEFsJson: function() {
        FEFs='<?php echo $this->FEFs; ?>';
        if (FEFs) {
            //alert('EFsArr : '+EFs);
            FEFsArr = FEFs.split(',');
            //alert('EFsArr length: '+EFsArr.length);
            data = jQuery.map(
                FEFsArr,
                function (vl, idx) {
                    //alert('vl: ' + vl);
                    v=eval('$("#<?php echo $this->PanelTag; ?>'+vl+'").val()');
                    
                    return ((v) ? v : 'null');
                }
            );
            data=[data];
            // alert('data : '+ data);
        }

        return JSON.stringify(data);
    },

