    // LoadSels Js
    // call FSels functions to load data in drop down boxes
    // it is used in Read panels
    // Dependencies: 
    //      - ...
    <?php 
    if(isset($this->FSels) && $this->FSels !== ''){
        $FSelsArr=explode(',',$this->FSels);
        foreach ($FSelsArr as $FSel) {
            echo $this->JSPanelNamSpace.'.get'.$FSel.'select();';
        }
    }
    ?>

