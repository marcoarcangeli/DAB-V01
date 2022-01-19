    <?php 
    //btn events
    // can be generated server side having the info of ClientOps
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
