<?php 
    // Read panel Change Events 
    // capture change events from UIFs
    // Dependencies: btnControl
    if(isset($this->UIFs) && $this->UIFs !== ''){
        $UIFsArr=explode(',',$this->UIFs);
        foreach ($UIFsArr as $UIF) {
            $evnt="";
            if(str_starts_with($UIF, $_SESSION["IdPrfx"]) // select dropdown list
                    ){
                $evnt="change";
            } else {    // no dropdown list
                // numeric field with step up/down
                if(str_starts_with($UIF, $_SESSION["DEFNum"])   
                || str_ends_with($UIF, $_SESSION["DEFNum"])
                || str_ends_with($UIF, $_SESSION["DEFLevel"])
                || str_ends_with($UIF, $_SESSION["DEFVal"])
                        ){
                    $evnt="keyup mouseup";
                } else { // others
                    $evnt="keyup";
                }
            }
            if($evnt !== ""){
                echo '
                $("#'.$this->PanelTag.$UIF.'").bind("'.$evnt.'", function (event) {
                    '. $this->JSPanelNamSpace.'.btnControl();
                });
                ';
            }
        }
    }
?>
