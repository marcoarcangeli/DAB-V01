<?php 
// Set and Clean a Ref param
// Dependencies: btnControl

    if(isset($this->InRefs) && $this->InRefs !== ''){
        $InRefArr=explode(',',$this->InRefs);
        foreach ($InRefArr as $InRef) {
            // include($_SESSION["ContentCommonRelPath"].$_SESSION["InRefJs"]); 
            echo'
            Set'.$InRef.': function(data=null) {
                '.$this->JSPanelNamSpace.'.'.$_SESSION["IdPrfx"].$InRef.' = (data)?data["'.$_SESSION["IdPrfx"].$InRef.'"]:"";
                $("#'.$this->PanelTag.''.$_SESSION["IdPrfx"].$InRef.'").val((data)?data["'.$_SESSION["IdPrfx"].$InRef.'"]:"");
                $("#'.$this->PanelTag.$InRef.$_SESSION["DEFNam"].'").val((data)?data["'.$_SESSION["DEFNam"].'"]:"");
                
                if("'.$this->PanelType.'" == "Tlist"){
                    // PanelType: Tlist
                    '.$this->JSPanelNamSpace.'.SearchIds = (data) ? data["SearchIds"] : "";
                    '.$this->JSPanelNamSpace.'.Refresh();
                }else{ 
                    // rx: PanelType: Read
                    if ( $.isFunction('.$this->JSPanelNamSpace.'.btnControl) ) {
                        '.$this->JSPanelNamSpace.'.btnControl();
                    }
                }
            },
            ';
        }
    }
?>

