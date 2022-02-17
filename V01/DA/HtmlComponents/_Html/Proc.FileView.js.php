<script type="text/javascript" ref="<?php echo $this->JSPanelNamSpace; ?>">
<?php echo $this->JSPanelNamSpace; ?> = {
    // generalization step 3
    // filters + InRef
    // IdProfile: '',
    <?php echo $this->FVJsDecl; ?>
    // FileTlist std params
    Table: null,
 // PageLength: "<?php echo $this->PageLength; ?>",
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

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["FileViewRefreshJs"]); ?>
    // Refresh: function(data=null) {
    //     SrvOpNam = "Read"; 
    //     if(data){
    //         $('#<?php echo $this->PanelTag; ?>FileNam').val(data["FileNam"]);
    //         $('#<?php echo $this->PanelTag; ?>FileRef').val(data["FileRef"]);
    //         $('#<?php echo $this->PanelTag; ?>FileViewer').attr('src', data["FileRef"]);
    //     }else{
    //         $('#<?php echo $this->PanelTag; ?>FileNam').val("");
    //         $('#<?php echo $this->PanelTag; ?>FileRef').val("");
    //         $('#<?php echo $this->PanelTag; ?>FileViewer').attr('src', "");
    //     }
    // },

}
$(document).ready(function() {

    //popola select ...

    // set defaults
    // $("#Proc_FileViewer").IFrame({
    //     onTabClick(item) {
    //         return item
    //     },
    //     onTabChanged(item) {
    //         return item
    //     },
    //     onTabCreated(item) {
    //         return item
    //     },
    //     autoIframeMode: true,
    //     autoItemActive: true,
    //     autoShowNewTab: true,
    //     allowDuplicates: true,
    //     loadingScreen: 750,
    //     useNavbarItems: true
    // })
})
</script>