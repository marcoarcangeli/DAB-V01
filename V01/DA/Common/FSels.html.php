    <?php 
    // obsoletye: integrated into the UIFs HTML
    // FSels HTML
    // Fields select drop-down boxes
    // Dependencies: 
    //      - ...
    /*<div class="row">
            <div class="col-md-12">
                <div class="form-group" id="IdAuthLevelselect">
                    <label for="<?php echo $this->PanelTag; ?>IdAuthLevel">IdAuthLevel</label>
                    <select class="form-control" id="<?php echo $this->PanelTag; ?>IdAuthLevel"
                        placeholder="IdAuthLevel ..." value="">
                    </select>
                </div>
            </div>
        </div>
    */

    if(isset($this->FSels) && $this->FSels !== ''){
        $FSelsArr=explode(',',$this->FSels);
        foreach ($FSelsArr as $FSel) {
        echo '
        <div class="row">
            <div class="col-md-12">
                <div class="form-group" id="'.$_SESSION["IdPrfx"].$FSel.'select">
                    <label for="'.$this->PanelTag.$_SESSION["IdPrfx"].$FSel.'">'.$_SESSION["IdPrfx"].$FSel.'</label>
                    <select class="form-control" id="'.$this->PanelTag.$_SESSION["IdPrfx"].$FSel.'"
                        placeholder="'.$_SESSION["IdPrfx"].$FSel.' ..." value="">
                    </select>
                </div>
            </div>
        </div>
        ';
        }
    }
    ?>

