    <?php 
    if(isset($this->ClientOps) && $this->ClientOps !== ''){
        $ClientOpsArr=explode(',',$this->ClientOps);
        foreach ($ClientOpsArr as $ClientOp) {
            // get btn attributes from ClientOps Knowledge
            $_SESSION["tmp_ClientOp"] = $ClientOp;
            $ClientOpArr = array_filter( 
                $_SESSION["KClientOps"], 
                function( $v ) { 
                    return $v["ClientOp"] == $_SESSION["tmp_ClientOp"]; 
                } 
            );
            $ClientOpArr = array_pop($ClientOpArr);
            $_SESSION["tmp_ClientOp"] = null;
            if(count($ClientOpArr) > 0){
                echo'
                <button id="btn'.$ClientOp.'" type="button" class="btn btn-outline-primary btn-xs daBtnTool" data-toggle="tooltip"
                data-placement="bottom" title="'.$ClientOpArr["Label"].'" value="'.$ClientOpArr["Label"].'" '.$ClientOpArr["DflState"].'>
                <i class="'.$ClientOpArr["Icon"].'"></i>
                </button>
                ';
            }else{ // empty, not defined button
                echo'
                <button id="btn'.$ClientOp.'" type="button" class="btn btn-outline-primary btn-xs daBtnTool" data-toggle="tooltip"
                data-placement="bottom" title="Not Defined" value="Not Defined" disabled>
                <i class=""></i>
                </button>
                ';
            }
        }
    }
    ?>
