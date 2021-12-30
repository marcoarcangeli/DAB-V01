<script type="text/javascript" ref="<?php echo $this->JSPanelNamSpace; ?>">
<?php echo $this->JSPanelNamSpace; ?> = {
    // generalization step 2
    FE      : '<?php echo $this->FE; ?>', // FE: Fundamental Entity
    FEFs    : '<?php echo $this->FEFs; ?>',  
    DEs     : '<?php echo $this->DEs; ?>',
    DEFs    : '<?php echo $this->DEFs; ?>',  
    EFs     : '<?php echo $this->EFs; ?>',  
    FV      : '<?php echo $this->FV; ?>', //'IdProfile', // filter vector. CS list of fields and values to filter refresh and delete ops.

    // filters + InRef
    IdProfile: '',

    // panel specific params
    StateData: null,
    // std UI
    <?php echo $this->FEIdNam; ?>: '',
    Mode: '<?php echo $this->Mode; ?>',
    CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    // session params
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',
    
    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["ReadBtnControlJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["ReadGetFEFsJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["ReadSetFEFsJs"]); ?>

    <?php 
    if(isset($this->InRefs) && $this->InRefs !== ''){
        $InRefArr=explode(',',$this->InRefs);
        foreach ($InRefArr as $InRef) {
            include($_SESSION["ContentCommonRelPath"].$_SESSION["InRefJs"]); 
        }
    }
    ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["SrvOpParamsJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["ReadRefreshJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["ReadDeleteJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["ReadSaveJs"]); ?>

    <?php 
    if(isset($this->FSels) && $this->FSels !== ''){
        $FSelsArr=explode(',',$this->FSels);
        foreach ($FSelsArr as $FSel) {
            include($_SESSION["ContentCommonRelPath"].$_SESSION["FSelsJs"]); 
        }
    }
    ?>
}

$(document).ready(function() {

    //load select | tree ...
    <?php 
    if(isset($this->FSels) && $this->FSels !== ''){
        $FSelsArr=explode(',',$this->FSels);
        foreach ($FSelsArr as $FSel) {
            echo $this->JSPanelNamSpace.'.get'.$FSel.'select();';
        }
    }
    ?>

    // set defaults
    <?php echo $this->JSPanelNamSpace; ?>.Set(); //Clean();

    //btn events
    // can be generated server side having the info of 
    //     PanelType    BtnTools.
    // Ex: Read         Save,Refresh,Delete,New
    //     Tlist        Refresh
    // ClientOps='<?php echo $this->ClientOps; ?>';
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

    // $("#<?php echo $this->PanelBtnsNam; ?> #btnSave").click(function() {
    //     <?php echo $this->JSPanelNamSpace; ?>.Save();
    // });

    // $("#<?php echo $this->PanelBtnsNam; ?> #btnRefresh").click(function() {
    //     <?php echo $this->JSPanelNamSpace; ?>.Refresh();
    // });

    // $("#<?php echo $this->PanelBtnsNam; ?> #btnDelete").click(function() {
    //     <?php echo $this->JSPanelNamSpace; ?>.Delete();
    // });

    // $("#<?php echo $this->PanelBtnsNam; ?> #btnNew").click(function() {
    //     // <?php echo $this->JSPanelNamSpace; ?>.Clean();
    //     <?php echo $this->JSPanelNamSpace; ?>.Set();
    // });
    // change events
    // impact on User Interaction fields (UIFs): FEFs - InRefs - FEId = SetFs - FEId
    // UIFs='<?php echo $this->UIFs; ?>';
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

    // $("#<?php echo $this->PanelTag; ?>IdAuthLevel").change(function(event) {
    //     <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    // });
    // $("#<?php echo $this->PanelTag; ?>IdFeature").change(function(event) {
    //     <?php echo $this->JSPanelNamSpace; ?>.btnControl();
    // });

})
</script>