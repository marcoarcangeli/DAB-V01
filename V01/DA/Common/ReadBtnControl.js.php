<?php
echo'
    // Read panel Btn ctrl
    // Dependencies: isChangedFEFs
    btnControl: function() {
        /**concept: when btnNew exists? When ther is no parent.*/
        if ("'.$this->Mode.'" == "alone") {
            $("#'.$this->PanelBtnsNam.' #btnNew").hide();
        }
        /**concept: when btnRefresh, btnDelete are enabled? */
        if ($("#'.$this->PanelTag.$this->FEIdNam.'").val() == "") {
            $("#'.$this->PanelBtnsNam.' #btnOpen").attr("disabled", true);
            $("#'.$this->PanelBtnsNam.' #btnRefresh").attr("disabled", true);
            $("#'.$this->PanelBtnsNam.' #btnDelete").attr("disabled", true);
            $("#'.$this->PanelBtnsNam.' #btnNewChild").attr("disabled", true);
            $("#'.$this->PanelBtnsNam.' #btnChangeParent").attr("disabled", true);

        } else {
            $("#'.$this->PanelBtnsNam.' #btnOpen").attr("disabled", false);
            $("#'.$this->PanelBtnsNam.' #btnRefresh").attr("disabled", false);
            $("#'.$this->PanelBtnsNam.' #btnDelete").attr("disabled", false);
            $("#'.$this->PanelBtnsNam.' #btnNewChild").attr("disabled", false);
            $("#'.$this->PanelBtnsNam.' #btnChangeParent").attr("disabled", false);
        }
        /**concept: when btnSave is enabled? */
        /**when input fields are changed
         * v think about comparing with starting values (on refresh);
         *      v on New, clean the start values too;
         */
        if ('.$this->JSPanelNamSpace.'.isChangedFEFs()
        ) {
            $("#'.$this->PanelBtnsNam.' #btnSave").attr("disabled", false);
        } else {
            $("#'.$this->PanelBtnsNam.' #btnSave").attr("disabled", true);
        }
    },

    isChangedFEFs: function() {
        FEFs="'.$this->FEFs.'";
        isChanged=false;
        if (FEFs) {
            FEFsArr = FEFs.split(",");
            $.each(FEFsArr, function(index, item) { // Iterates through a collection
                if($("#'.$this->PanelTag.'"+item).val() !== (('.$this->JSPanelNamSpace.'.StateData)?'.$this->JSPanelNamSpace.'.StateData[item]:"")){
                    isChanged= true; 
                }
            });
        }
        return isChanged;
    },
';
?>
