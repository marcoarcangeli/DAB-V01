<?php
echo'
    /**
    Toggle, set and clean functions for Std Tlist panel
    */
    ToggleRow: function(obj) {
        // alert("ToggleRow");
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            Data = null;
            Fun="Set";
        } else {
            '.$this->JSPanelNamSpace.'.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            Data = '.$this->JSPanelNamSpace.'.Table.row($(obj)).data();
            Fun="Refresh";
        }
        '.$this->JSPanelNamSpace.'.Notify(Data, Fun);
    },
    // Notify: function(Data,Fun) {
    //     if ('.$this->JSPanelNamSpace.'.DetailPanels && '.$this->JSPanelNamSpace.'.DetailPanels != "") {
    //         da.NotifyObjs('.$this->JSPanelNamSpace.'.DetailPanels, Fun ,Data);
    //     }
    //     if ('.$this->JSPanelNamSpace.'.RefPanels && '.$this->JSPanelNamSpace.'.RefPanels != "") {
    //         da.NotifyObjs('.$this->JSPanelNamSpace.'.RefPanels, "Set'.$this->FE.'", Data);
    //     }
    // },
    // CleanSelectedRow: function() {
    //     if ('.$this->JSPanelNamSpace.'.DetailPanels && '.$this->JSPanelNamSpace.'.DetailPanels != "") {
    //         da.NotifyObjs('.$this->JSPanelNamSpace.'.DetailPanels, "Set");
    //     }
    //     if ('.$this->JSPanelNamSpace.'.RefPanels && '.$this->JSPanelNamSpace.'.RefPanels != "") {
    //         da.NotifyObjs('.$this->JSPanelNamSpace.'.RefPanels, "Set'.$this->FE.'");
    //     }
    // },
';
?>