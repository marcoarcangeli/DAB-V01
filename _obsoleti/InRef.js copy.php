    // Set and Clean a Ref param
    // Dependencies: 
    //      - GetFMJson: if necessary or empty string
    //      - GetFEFsJson: for Save op
    Set<?php echo $InRef; ?>: function(data=null) {
        <?php echo $this->JSPanelNamSpace; ?>.Id<?php echo $InRef; ?> = (data)?data["Id<?php echo $InRef; ?>"]:'';
        $("#<?php echo $this->PanelTag; ?>Id<?php echo $InRef; ?>").val((data)?data["Id<?php echo $InRef; ?>"]:'');
        $("#<?php echo $this->PanelTag; ?><?php echo $InRef; ?>Nam").val((data)?data["Nam"]:'');
        
        if('<?php echo $this->PanelType; ?>' == 'Tlist'){
            // PanelType: Tlist
            <?php echo $this->JSPanelNamSpace; ?>.SearchIds = (data) ? data["SearchIds"] : '';
            <?php echo $this->JSPanelNamSpace; ?>.Refresh();
        }else{ 
            // PanelType: Read
            <?php echo $this->JSPanelNamSpace; ?>.btnControl();
        }
    },

    // obsolete: it is performed by Set without data param
    // Clean<?php echo $InRef; ?>: function() {
    //     <?php echo $this->JSPanelNamSpace; ?>.Id<?php echo $InRef; ?> = '';
    //     $("#<?php echo $this->PanelTag; ?>Id<?php echo $InRef; ?>").val('');
    //     $("#<?php echo $this->PanelTag; ?><?php echo $InRef; ?>Nam").val('');
    // 
    //     if('<?php echo $this->PanelType; ?>' == 'Tlist'){
    //         // PanelType: Tlist
    //         <?php echo $this->JSPanelNamSpace; ?>.SearchIds = "";
    //         <?php echo $this->JSPanelNamSpace; ?>.Refresh();
    //     }else{ 
    //         // PanelType: Read
    //         <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    //     }
    // 
    // },

