    // Read panel Chenge Events 
    // capture change events from UIFields
    // Dependencies: btnControl
    <?php 
    if(isset($this->UIFs) && $this->UIFs !== ''){
        $UIFsArr=explode(',',$this->UIFs);
        foreach ($UIFsArr as $UIF) {
            echo '
            $("#'.$this->PanelTag.$UIF.'").change(function(event) {
                '. $this->JSPanelNamSpace.'.btnControl();
            });
            ';
        }
    }
    ?>
