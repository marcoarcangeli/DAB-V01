<script type="text/javascript" ref="<?php echo $this->JSPanelNamSpace; ?>">
<?php echo $this->JSPanelNamSpace; ?> = {
    // filters
    SearchIds: '',
    // InRefs + filters
    <?php echo $this->FVJsDecl; ?>
    // IdProfile: '',
    // Tlist std params
    Table: null,
    SelectedRow: null,
    PageLength: "<?php echo $this->PageLength; ?>",
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

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["NotifyJs"]); ?>

}

$(document).ready(function() {

    <?php echo $this->JSPanelNamSpace; ?>.Refresh();

    // Tlist events
    $("#<?php echo $this->TlistDataTblNam; ?> tbody").on("click", "tr", function() {
        <?php echo $this->JSPanelNamSpace; ?>.SelectedRow = this;
        <?php echo $this->JSPanelNamSpace; ?>.ToggleRow();
    });
    // Btn Events
    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["BtnEventsJs"]); ?>
    
})
</script>