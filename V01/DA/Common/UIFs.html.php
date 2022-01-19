    <?php 
    // UIFs HTML
    // Fields select drop-down boxes
    // Dependencies: ...
    /** next step parametrization
     *  - if rowStart -> <div class="row"></div>
     *  - if fieldWidth -> <div class="col-md-[fieldWidth]">
     *  - if readOnly -> <... value="" readonly>
     * 
     *  */ 

    if(isset($this->UIFs) && $this->UIFs !== ''){
        $UIFsArr=explode(',',$this->UIFs);
        foreach ($UIFsArr as $UIF) {
            if(str_ends_with($UIF, $_SESSION["DEFNam"])){
                echo '
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="'.$this->PanelTag.$UIF.'">'.$UIF.'</label>
                            <input type="text" class="form-control" id="'.$this->PanelTag.$UIF.'"
                                placeholder="'.$UIF.' ..." value="">
                        </div>
                    </div>
                </div>
                ';
            } elseif(str_starts_with($UIF, $_SESSION["IdPrfx"]) // select dropdown list
                ){
                echo '
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" id="'.$UIF.'select">
                            <label for="'.$this->PanelTag.$UIF.'">'.$UIF.'</label>
                            <select class="form-control" id="'.$this->PanelTag.$UIF.'"
                                placeholder="'.$UIF.' ..." value="">
                            </select>
                        </div>
                    </div>
                </div>
                ';
            } elseif(str_ends_with($UIF, $_SESSION["DEFDescr"])
                    || str_ends_with($UIF, $_SESSION["DEFNote"])
                    || str_ends_with($UIF, $_SESSION["DEFParams"])
                ){
                echo '
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="'.$this->PanelTag.$UIF.'">'.$UIF.'</label>
                            <textarea class="form-control" rows="3" id="'.$this->PanelTag.$UIF.'"
                            placeholder="'.$UIF.' ..." value=""></textarea>
                        </div>
                    </div>
                </div>
                ';
            } elseif(str_starts_with($UIF, $_SESSION["DEFNum"])
                  || str_ends_with($UIF, $_SESSION["DEFLevel"])
                    ){
                echo '
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="'.$this->PanelTag.$UIF.'">'.$UIF.'</label>
                            <input type="number" min=0 step=1 class="form-control" id="'.$this->PanelTag.$UIF.'" placeholder="'.$UIF.' ..." value="">
                        </div>
                    </div>
                </div>
                ';
            } elseif (str_ends_with($UIF, $_SESSION["DEFVal"])
                    ){
                echo '
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="'.$this->PanelTag.$UIF.'">'.$UIF.'</label>
                            <input type="number" step=0.00001 class="form-control" id="'.$this->PanelTag.$UIF.'" placeholder="'.$UIF.' ..." value="">
                        </div>
                    </div>
                </div>
                ';
            } elseif (str_ends_with($UIF, $_SESSION["DEFPwd"])
                    ){
                echo '
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="'.$this->PanelTag.$UIF.'">'.$UIF.'</label>
                        <input type="password" class="form-control" id="'.$this->PanelTag.$UIF.'" placeholder="'.$UIF.' ..."
                            value="">
                    </div>
                </div>
                ';
            } else {
                echo '
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="'.$this->PanelTag.$UIF.'">'.$UIF.'</label>
                            <input type="text" class="form-control" id="'.$this->PanelTag.$UIF.'"
                                placeholder="'.$UIF.' ..." value="">
                        </div>
                    </div>
                </div>
                ';
            }
        } 
    } 
?>

