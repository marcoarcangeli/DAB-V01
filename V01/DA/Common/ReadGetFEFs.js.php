<?php
echo'
    // Get FEFs UI fields values and return a json array
    // Dependencies: btnControl
    GetFEFsJson: function() {
        FEFs="'.$this->FEFs.'";
        if (FEFs) {
            FEFsArr = FEFs.split(",");
            data = jQuery.map(
                FEFsArr,
                function (vl, idx) {
                    // alert(\'$("#'.$this->PanelTag.'\'+vl+\'").val()\');
                    v=eval(\'$("#'.$this->PanelTag.'\'+vl+\'").val()\');
                    return ((v) ? v : "null");
                }
            );
            data=[data];
        }
        return JSON.stringify(data);
    },
';
?>
