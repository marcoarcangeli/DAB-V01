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
';
?>