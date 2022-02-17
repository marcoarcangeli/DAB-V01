<script type="text/javascript" ref="<?php echo $this->JSPanelNamSpace; ?>">
<?php echo $this->JSPanelNamSpace; ?> = {
    // filters - should be code generated
    // SearchIds: '',
    <?php echo $this->FVJsDecl; ?>
    // InRefs + filters
    // Id<E>: '',
    // Tree std params
    DataArr: null,
    SelectedRow: null,
    // std UI params
    Mode: "<?php echo $this->Mode; ?>",
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    // session params
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    <?php echo $this->InRefsJs; ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["SrvOpParamsJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["TreeRefreshJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["TreeToggleNodeJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["TreeToggleJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["NotifyJs"]); ?>

}
$(document).ready(function() {

    <?php echo $this->JSPanelNamSpace; ?>.Refresh();

    $("#<?php echo $this->TreeObjNam; ?>").on("click", "div", function() {
        <?php echo $this->JSPanelNamSpace; ?>.SelectedRow = $(this);
        <?php echo $this->JSPanelNamSpace; ?>.ToggleRow();
    });

    $("#<?php echo $this->TreeObjNam; ?>").on("dblclick", "div", function() {
        <?php echo $this->JSPanelNamSpace; ?>.ToggleNode(this);
    });

    // Btn Events
    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["BtnEventsJs"]); ?>

})
</script>