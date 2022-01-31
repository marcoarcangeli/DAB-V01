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
        '.$this->JSPanelNamSpace.'.btnControl();
    },
    DeselectRow: function() {
        // alert("DeselectRow");
        obj = '.$this->JSPanelNamSpace.'.SelectedRow;
        $(obj).removeClass("selected");
        Data = null;
        Fun="Refresh";
        $("#'.$this->PanelTag.'SelectedFile").val("");
        '.$this->JSPanelNamSpace.'.SelectedRow = null;
        '.$this->JSPanelNamSpace.'.Notify(Data, Fun);
    },
    SelectRow: function() {
        // alert("SelectRow");
        obj = '.$this->JSPanelNamSpace.'.SelectedRow;
        '.$this->JSPanelNamSpace.'.Table.$("tr.selected").removeClass("selected");
        $(obj).addClass("selected");
        Data = '.$this->JSPanelNamSpace.'.Get();
        Fun="Refresh";
        $("#'.$this->PanelTag.'SelectedFile").val(Data["FileNam"]);
        '.$this->JSPanelNamSpace.'.Notify(Data, Fun);
    },
    /**TODO
     * Get should be equivalent to le Read GetFEFs with a json return
     * it must be implemented inside the context of the SrvOpParams
     */
    Get: function() {
        obj = '.$this->JSPanelNamSpace.'.SelectedRow;

        // prjState = '.$this->JSPanelNamSpace.'.SetParamsFromPrjState();
        data = {
            FileNam: $(obj).children(":nth-child(1)").text(),
            FileRef: '.$this->JSPanelNamSpace.'.FolderRelPath + $(obj).children(":nth-child(1)").text(),
        };
        return data;
    },


';
?>