<script type="text/javascript" ref="<?php echo $this->JSPanelNamSpace; ?>">
<?php echo $this->JSPanelNamSpace; ?> = {
    // generalization step 3
    // filters
    SearchIds: '',
    // InRefs + filters
    IdProfile: '',
    // Tlist std params
    Table: null,
 // PageLength: "<?php echo $this->PageLength; ?>",
    // std UI params
    Mode: "<?php echo $this->Mode; ?>",
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    // session params
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["InRefsJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["SrvOpParamsJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["TlistRefreshJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["TlistToggleJs"]); ?>

}

$(document).ready(function() {

    <?php echo $this->JSPanelNamSpace; ?>.Refresh();

    // Tlist events
    $("#<?php echo $this->TlistDataTblNam; ?> tbody").on("click", "tr", function() {
        <?php echo $this->JSPanelNamSpace; ?>.ToggleRow(this);
    });
    //btn events
    // can be generated server side having the info of ClientOps
    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["BtnEventsJs"]); ?>

})
</script>