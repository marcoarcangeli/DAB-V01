<?php
echo'
    Notify: function(Data=null,Fun="Refresh", ParFun="Refresh") {
        if ('.$this->JSPanelNamSpace.'.ParentObj) {
            da.NotifyObjs('.$this->JSPanelNamSpace.'.ParentObj, ParFun, null);
        }

        if ('.$this->JSPanelNamSpace.'.DetailPanels && '.$this->JSPanelNamSpace.'.DetailPanels != "") {
            // if ('.$this->JSPanelNamSpace.'.Mode == "TlistPar") {
            //     da.NotifyObjs('.$this->JSPanelNamSpace.'.DetailPanels, "Set'.$this->FE.'", Data);
            // } else {
                da.NotifyObjs('.$this->JSPanelNamSpace.'.DetailPanels, Fun, Data);
            // }
        }

        if ('.$this->JSPanelNamSpace.'.RefPanels && '.$this->JSPanelNamSpace.'.RefPanels != "") {
            if ('.$this->JSPanelNamSpace.'.Mode == "TlistPar") {
                da.NotifyObjs('.$this->JSPanelNamSpace.'.DetailPanels, "Set'.$this->FE.$_SESSION["DEFParent"].'", Data);
            } else {
                da.NotifyObjs('.$this->JSPanelNamSpace.'.RefPanels, "Set'.$this->FE.'", Data);
            }
        }
    },
';
?>