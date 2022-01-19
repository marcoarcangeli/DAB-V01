    /**
    Toggle, set and clean functions for Std Tlist panel
    */
    ToggleRow: function(obj) {
        if ($(obj).hasClass("selected")) {
            $(obj).removeClass("selected");
            <?php echo $this->JSPanelNamSpace; ?>.CleanSelectedRow();
        } else {
            <?php echo $this->JSPanelNamSpace; ?>.Table.$("tr.selected").removeClass("selected");
            $(obj).addClass("selected");
            // data = <?php echo $this->JSPanelNamSpace; ?>.Get(obj);
            data = <?php echo $this->JSPanelNamSpace; ?>.Table.row($(obj)).data();
            <?php echo $this->JSPanelNamSpace; ?>.SetSelectedRow(data);
        }
        // <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    },
    SetSelectedRow: function(data) {
        // if (da.AnCntx_FileTlist.Mode == "TlistRef") {
        //     da.RefreshDetailPanels(da.AnCntx_FileTlist.DetailPanels, "SetRef", data);
        // }
        // if (da.AnCntx_FileTlist.RefPanels && da.AnCntx_FileTlist.RefPanels != '') {
        //     da.RefreshDetailPanels(da.AnCntx_FileTlist.RefPanels, "SetFileRef", data);
        // }
        if (<?php echo $this->JSPanelNamSpace; ?>.DetailPanels && <?php echo $this->JSPanelNamSpace; ?>.DetailPanels != "") {
            // da.ProfileFeatureAuthRead.<?php echo $this->FEIdNam; ?> = data["<?php echo $this->FEIdNam; ?>"];
            da.RefreshDetailPanels(<?php echo $this->JSPanelNamSpace; ?>.DetailPanels, "Refresh",data);
        }
        // alert(da.ProfileFeatureAuthTlist.RefPanels);
        if (<?php echo $this->JSPanelNamSpace; ?>.RefPanels && <?php echo $this->JSPanelNamSpace; ?>.RefPanels != "") {
            // alert(da.ProfileCatTree.DetailPanels);
            da.RefreshDetailPanels(<?php echo $this->JSPanelNamSpace; ?>.RefPanels, "Set<?php echo $this->FE; ?>", data);
        }
    },
    CleanSelectedRow: function() {
        if (<?php echo $this->JSPanelNamSpace; ?>.DetailPanels && <?php echo $this->JSPanelNamSpace; ?>.DetailPanels != "") {
            <!-- da.RefreshDetailPanels(<?php echo $this->JSPanelNamSpace; ?>.DetailPanels, "Clean"); -->
            da.RefreshDetailPanels(<?php echo $this->JSPanelNamSpace; ?>.DetailPanels, "Set");
        }
        // alert(<?php echo $this->JSPanelNamSpace; ?>.RefPanels);
        if (<?php echo $this->JSPanelNamSpace; ?>.RefPanels && <?php echo $this->JSPanelNamSpace; ?>.RefPanels != "") {
            // alert(da.ProfileCatTree.DetailPanels);
            da.RefreshDetailPanels(<?php echo $this->JSPanelNamSpace; ?>.RefPanels, "Set<?php echo $this->FE; ?>");
        }
    },
