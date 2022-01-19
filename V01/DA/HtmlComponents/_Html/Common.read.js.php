<script type="text/javascript" ref="<?php echo $this->JSPanelNamSpace; ?>">
<?php echo $this->JSPanelNamSpace; ?> = {
    // generalization step 3
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
    
    // in this code section the code chuncks Order is NOT Mandatory
    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["ReadBtnControlJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["ReadGetFEFsJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["ReadSetFEFsJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["InRefsJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["SrvOpParamsJs"]); ?>

    //btn events
    <?php 
    if(isset($this->ClientOps) && $this->ClientOps !== ''){
        $ClientOpsArr=explode(',',$this->ClientOps);
        foreach ($ClientOpsArr as $ClientOp) {
            include($_SESSION["ContentCommonRelPath"].$_SESSION["Read".$ClientOp."Js"]);
        }
    }
    ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["FSelsJs"]); ?>

}

$(document).ready(function() {
    // in this code section the code chuncks Order is MANDATORY

    //load select | tree ...
    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["LoadSelsJs"]); ?>

    // set defaults
    <?php echo $this->JSPanelNamSpace; ?>.Set(); //Clean();

    //btn events
    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["ClientOpsEventsJs"]); ?>

    // change events
    // impact on User Interaction fields (UIFs): FEFs - InRefs - FEId = SetFs - FEId
    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["ReadChangeEventsJs"]); ?>

})
</script>