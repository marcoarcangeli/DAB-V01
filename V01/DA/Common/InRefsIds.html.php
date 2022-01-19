<?php 
// Set and Clean a Ref param
// Dependencies: btnControl
/*  ex:
// <div class="row">
//     <div class="col-md-3">
//         <div class="form-group">
//             <label for="<?php echo $this->PanelTag; ?>IdProfile">IdProfile</label>
//             <input type="text" class="form-control" id="<?php echo $this->PanelTag; ?>IdProfile" placeholder="IdProfile ..."
//                 value="" readonly>
//         </div>
//     </div>
// </div>
*/

    if(isset($this->InRefs) && $this->InRefs !== ''){
        $InRefArr=explode(',',$this->InRefs);
        foreach ($InRefArr as $InRef) {
            // include($_SESSION["ContentCommonRelPath"].$_SESSION["InRefJs"]); 
            echo'
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="'.$this->PanelTag.$_SESSION["IdPrfx"].$InRef.'">'.$_SESSION["IdPrfx"].$InRef.'</label>
                        <input type="text" class="form-control" id="'.$this->PanelTag.$_SESSION["IdPrfx"].$InRef.'" placeholder="'.$_SESSION["IdPrfx"].$InRef.' ..."
                            value="" readonly>
                    </div>
                </div>
            ';
        }
    }
?>

