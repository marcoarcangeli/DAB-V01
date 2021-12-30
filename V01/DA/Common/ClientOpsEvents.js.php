    // ClientOpsEvents Js
    // capture events from panel btnTools
    // Dependencies: 
    //      - ...
    //btn events
    <?php 
    if(isset($this->ClientOps) && $this->ClientOps !== ''){
        $ClientOpsArr=explode(',',$this->ClientOps);
        foreach ($ClientOpsArr as $ClientOp) {
            echo '
            $("#'.$this->PanelBtnsNam.' #btn'.$ClientOp.'").click(function() {
                '.$this->JSPanelNamSpace.'.'.$ClientOp.'();
            });
            ';
        }
    }
    ?>

