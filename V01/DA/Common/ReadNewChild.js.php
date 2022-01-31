<?php 
echo'
    // Read panel New Child with Tree Panel
    // capture change events from UIFs
    // Dependencies: btnControl,
    NewChild: function() {
        New'.$this->FEIdNam.$_SESSION["DEFParent"].'=$("#'.$this->PanelTag.$this->FEIdNam.'").val();
        New'.$this->FE.$_SESSION["DEFParent"].$_SESSION["DEFNam"].'=$("#'.$this->PanelTag.$_SESSION["DEFNam"].'").val();
        '.$this->JSPanelNamSpace.'.Set();
        $("#'.$this->PanelTag.$this->FEIdNam.$_SESSION["DEFParent"].'").val(New'.$this->FEIdNam.$_SESSION["DEFParent"].');
        $("#'.$this->PanelTag.$this->FE.$_SESSION["DEFParent"].$_SESSION["DEFNam"].'").val(New'.$this->FE.$_SESSION["DEFParent"].$_SESSION["DEFNam"].');

        '.$this->JSPanelNamSpace.'.btnControl();
    },
';
?>
