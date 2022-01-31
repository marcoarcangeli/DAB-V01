    // LoadSels Js
    // call FSels functions to load data in drop down boxes
    // it is used in Read panels
    // Dependencies: 
    //      - ...
    <?php 
    if(isset($this->FSels) && $this->FSels !== ''){
        $FSelsArr=explode(',',$this->FSels);
        foreach ($FSelsArr as $FSel) {
            // recursion case
            if($FSel == $this->FE){
                $FSelNam=$FSel.$_SESSION["DEFParent"];
            }else{
                $FSelNam=$FSel;
            }
            
            echo $this->JSPanelNamSpace.'.get'.$FSelNam.'select();';
        }
    }
    ?>

