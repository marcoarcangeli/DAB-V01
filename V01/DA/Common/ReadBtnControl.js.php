    // Read panel Btn ctrl
    // Dependencies: isChangedFEFs
    btnControl: function() {
        /**concept: when btnNew exists? When ther is no parent.*/
        if ('<?php echo $this->Mode; ?>' == 'alone') {
            $("#<?php echo $this->PanelBtnsNam; ?> #btnNew").hide();
        }
        // alert($("#<?php echo $this->PanelTag; ?><?php echo $this->FEIdNam; ?>").val());
        /**concept: when btnRefresh, btnDelete are enabled? */
        if ($("#<?php echo $this->PanelTag; ?><?php echo $this->FEIdNam; ?>").val() == "") {
            $("#<?php echo $this->PanelBtnsNam; ?> #btnRefresh").attr("disabled", true);
            $("#<?php echo $this->PanelBtnsNam; ?> #btnDelete").attr("disabled", true);
        } else {
            $("#<?php echo $this->PanelBtnsNam; ?> #btnRefresh").attr("disabled", false);
            $("#<?php echo $this->PanelBtnsNam; ?> #btnDelete").attr("disabled", false);
        }
        /**concept: when btnSave is enabled? */
        /**when input fields are changed
         * v think about comparing with starting values (on refresh);
         *      v on New, clean the start values too;
         */
        if (<?php echo $this->JSPanelNamSpace; ?>.isChangedFEFs()
            // OBSOLETE: it is generalized by isChangedFEFs()
            // $("#<?php echo $this->PanelTag; ?>IdAuthLevel").val() == ((<?php echo $this->JSPanelNamSpace; ?>.StateData)?<?php echo $this->JSPanelNamSpace; ?>.StateData["IdAuthLevel"]:'') &&
            // $("#<?php echo $this->PanelTag; ?>IdFeature").val() == ((<?php echo $this->JSPanelNamSpace; ?>.StateData)?<?php echo $this->JSPanelNamSpace; ?>.StateData["IdFeature"]:'') //&&
            // $("#<?php echo $this->PanelTag; ?>IdAuthLevel").val() == "" &&
            // $("#<?php echo $this->PanelTag; ?>IdFeature").val() == "" //&&
            // $("#<?php echo $this->PanelTag; ?>AuthLevel").val() == "" //&&
        ) {
            $("#<?php echo $this->PanelBtnsNam; ?> #btnSave").attr("disabled", false);
        } else {
            $("#<?php echo $this->PanelBtnsNam; ?> #btnSave").attr("disabled", true);
        }
    },

    isChangedFEFs: function() {
        FEFs='<?php echo $this->FEFs; ?>';
        isChanged=false;
        if (FEFs) {
            //alert('EFsArr : '+EFs);
            FEFsArr = FEFs.split(',');
            //alert('EFsArr length: '+EFsArr.length);
            $.each(FEFsArr, function(index, item) { // Iterates through a collection
                // alert('item: '+item);
                if($("#<?php echo $this->PanelTag; ?>"+item).val() !== ((<?php echo $this->JSPanelNamSpace; ?>.StateData)?<?php echo $this->JSPanelNamSpace; ?>.StateData[item]:'')){
                    isChanged= true; 
                    // return true;
                }
            });
            // alert('data : '+ data);
        }
        // alert(isChanged);

        return isChanged;
    },

