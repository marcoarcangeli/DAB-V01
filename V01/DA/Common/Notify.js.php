<?php
echo'
    Notify: function(data,fun) {
        if ('.$this->JSPanelNamSpace.'.ParentObj) {
            da.NotifyObjs('.$this->JSPanelNamSpace.'.ParentObj, "Refresh", null);
        }

        if ('.$this->JSPanelNamSpace.'.DetailPanels && '.$this->JSPanelNamSpace.'.DetailPanels != "") {
            if ('.$this->JSPanelNamSpace.'.Mode == "TlistPar") {
                da.NotifyObjs('.$this->JSPanelNamSpace.'.DetailPanels, "Set'.$this->FE.'", data);
            } else {
                da.NotifyObjs('.$this->JSPanelNamSpace.'.DetailPanels, fun, data);
            }
        }
        if ('.$this->JSPanelNamSpace.'.RefPanels && '.$this->JSPanelNamSpace.'.RefPanels != "") {
            da.NotifyObjs('.$this->JSPanelNamSpace.'.RefPanels, "Set'.$this->FE.'", data);
        }
    },
';
?>