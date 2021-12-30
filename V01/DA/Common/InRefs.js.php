// Set and Clean a Ref param
// Dependencies: btnControl
<?php 
    if(isset($this->InRefs) && $this->InRefs !== ''){
        $InRefArr=explode(',',$this->InRefs);
        foreach ($InRefArr as $InRef) {
            // include($_SESSION["ContentCommonRelPath"].$_SESSION["InRefJs"]); 
            echo'
            Set'.$InRef.': function(data=null) {
                '.$this->JSPanelNamSpace.'.Id'.$InRef.' = (data)?data["Id'.$InRef.'"]:"";
                $("#'.$this->PanelTag.'Id'.$InRef.'").val((data)?data["Id'.$InRef.'"]:"");
                $("#'.$this->PanelTag.$InRef.'Nam").val((data)?data["Nam"]:"");
                
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

