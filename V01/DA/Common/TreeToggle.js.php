<?php
echo'
    /**
    Toggle, set and clean functions for Std Tlist panel
    */
    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            data = '.$this->JSPanelNamSpace.'.Clean();
            '.$this->JSPanelNamSpace.'.SetSelectedRow(data,fun="Clean");
        } else {
            $("#AlgCatTree div.selected").removeClass("selected");
            // alert("Selected");
            $(obj).addClass("selected");
            data = '.$this->JSPanelNamSpace.'.Get(obj);
            '.$this->JSPanelNamSpace.'.SetSelectedRow(data,fun="Refresh");
        }
    },
    SetSelectedRow: function(data,fun) {
        if ('.$this->JSPanelNamSpace.'.DetailPanels && '.$this->JSPanelNamSpace.'.DetailPanels != "") {
            if ('.$this->JSPanelNamSpace.'.Mode == "TlistPar") {
                da.RefreshDetailPanels('.$this->JSPanelNamSpace.'.DetailPanels, "Set'.$this->FE.'", data);
            } else {
                '.$this->JSPanelNamSpace.$this->FEIdNam.' = data["'.$this->FEIdNam.'"];
                da.RefreshDetailPanels('.$this->JSPanelNamSpace.'.DetailPanels, fun);
            }
        }
        if ('.$this->JSPanelNamSpace.'.RefPanels && '.$this->JSPanelNamSpace.'.RefPanels != "") {
            da.RefreshDetailPanels('.$this->JSPanelNamSpace.'.RefPanels, "Set'.$this->FE.'", data);
        }
    },
';
?>