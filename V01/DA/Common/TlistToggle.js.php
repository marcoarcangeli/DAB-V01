<?php
echo'
    /**
    Toggle, set and clean functions for Std Tlist panel
    */
    ToggleRow: function() {
        // alert("ToggleRow");
        obj = '.$this->JSPanelNamSpace.'.SelectedRow;
        if ($(obj).hasClass("selected")) {
            '.$this->JSPanelNamSpace.'.DeselectRow();
        } else {
            '.$this->JSPanelNamSpace.'.SelectRow();
        }
    },
    DeselectRow: function() {
        // alert("DeselectRow");
        obj = '.$this->JSPanelNamSpace.'.SelectedRow;
        $(obj).removeClass("selected");
        Data = null;
        Fun="Set";
        '.$this->JSPanelNamSpace.'.SelectedRow = null;
        '.$this->JSPanelNamSpace.'.Notify(Data, Fun);
    },
    SelectRow: function() {
        // alert("SelectRow");
        obj = '.$this->JSPanelNamSpace.'.SelectedRow;
        '.$this->JSPanelNamSpace.'.Table.$("tr.selected").removeClass("selected");
        $(obj).addClass("selected");
        Data = '.$this->JSPanelNamSpace.'.Table.row($(obj)).data();
        Fun="Refresh";
        '.$this->JSPanelNamSpace.'.Notify(Data, Fun);
    },

';
?>