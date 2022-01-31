<script type="text/javascript" ref="<?php echo $this->JSPanelNamSpace; ?>">
<?php echo $this->JSPanelNamSpace; ?> = {
    // generalization step 3
    // filters + InRef
    // IdProfile: '',
    <?php echo $this->FVJsDecl; ?>
    // FileTlist std params
    Table: null,
    SelectedRow: null,
    PageLength: "<?php echo $this->PageLength; ?>",
    FolderAbsPath: '<?php echo $_SESSION["ProcAbsPath"]; ?>',
    FolderRelPath: '<?php echo $_SESSION["ProcRelPath"]; ?>',
    AllowedUploadFileExt: "<?php echo $this->AllowedUploadFileExt; ?>",
    UplName: '<?php echo $_SESSION["UploadFileBufferName"]; ?>', //'upl'
    // std UI params
    Mode: "<?php echo $this->Mode; ?>",
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    // session params
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["FileTlistBtnControlJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["SetUploadfileParamsJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["FileTlistRefreshJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["FileTlistDeleteJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["FileTlistDownloadJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["FileTlistToggleJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["NotifyJs"]); ?>

}
$(document).ready(function() {
    // alert($("#dstFolder").val());
    <?php echo $this->JSPanelNamSpace; ?>.Refresh();

    $("#<?php echo $this->TlistDataTblNam; ?> tbody").on("click", "tr", function() {
        <?php echo $this->JSPanelNamSpace; ?>.SelectedRow=this;
        <?php echo $this->JSPanelNamSpace; ?>.ToggleRow();
    });

    //btn events
    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["ClientOpsEventsJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["UploadFilesJs"]); ?>

})
</script>

