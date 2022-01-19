<script type="text/javascript" ref="da.ProfileTlist">
da.ProfileTlist = {

    // filters
    SearchIds: '',
    // InRefs + filters
    IdProfile: '',
    // Tlist std params
    Table: null,
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

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["SrvOpParamsJs"]); ?>

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["TlistToggleJs"]); ?>

     Refresh: function() {
        $params = "";
        if (da.ProfileTlist.SearchIds != '') {
            $params = "?SearchIds=" + da.ProfileTlist.SearchIds;
        }
        // alert($params);
        if ($.fn.DataTable.isDataTable('#ProfileList')) {
            $('#ProfileList').DataTable().destroy();
        }

        $('#ProfileList tbody').empty();

        da.ProfileTlist.Table = $("#ProfileList").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": da.ProfileTlist.PageLength,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "scrollX": true,
            "columnDefs": [
                <?php echo $this->TlistColumnDefsJS; ?>

            ],
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": "DA/HtmlComponents/Profile/Tlist.proxy.php",
                "type": "POST",
                "dataSrc": "data"
            },
            "columns": [
                <?php echo $this->TlistColumnsJS; ?>
            ],
        });
    },

}
$(document).ready(function() {

    <?php echo $this->JSPanelNamSpace; ?>.Refresh();

    // Tlist events
    $("#<?php echo $this->TlistDataTblNam; ?> tbody").on("click", "tr", function() {
        <?php echo $this->JSPanelNamSpace; ?>.ToggleRow(this);
    });
    // Btn Events
    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["BtnEventsJs"]); ?>

})
</script>