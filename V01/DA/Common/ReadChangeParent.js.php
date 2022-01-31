<?php 
echo'
    // Read panel Change Parent with Tree Panel
    // capture change events from UIFs
    // Dependencies: btnControl,
    ChangeParent: function() {
        if ('.$this->JSPanelNamSpace.'.ParentObj) {
            // alert("ChangeParent")
            if ('.$this->JSPanelNamSpace.'.ChangePar) {
                '.$this->JSPanelNamSpace.'.ChangePar = false;
                $("#'.$this->PanelBtnsNam.' #btnChangeParent").removeClass("btn-danger")
                $("#'.$this->PanelBtnsNam.' #btnChangeParent").addClass("btn-outline-primary");
            } else {
                '.$this->JSPanelNamSpace.'.ChangePar = true;
                $("#'.$this->PanelBtnsNam.' #btnChangeParent").removeClass("btn-outline-primary")
                $("#'.$this->PanelBtnsNam.' #btnChangeParent").addClass("btn-danger");
                Msg = "Select a new Parent node in the parent tree!";
                da.UsrMsgShow("'.$_SESSION["ChangeParMsg"].'", "To Do");
                // alert("Select a new Parent node in the parent tree!");
            }
            // should be notify
            da.RefreshObj('.$this->JSPanelNamSpace.'.ParentObj, '.$this->JSPanelNamSpace.'.ParentObjType, "ChangeParent");
            '.$this->JSPanelNamSpace.'.btnControl();
        }
    },
';
?>
