    /**
    Refresh function for Std Tlist panel
    */
    Refresh: function() {
        SrvOpNam = "Read"; 

        if ($.fn.DataTable.isDataTable('#<?php echo $this->FE; ?>List')) {
            $('#<?php echo $this->FE; ?>List').DataTable().destroy();
        }

        $('#<?php echo $this->FE; ?>List tbody').empty();

        <?php echo $this->JSPanelNamSpace; ?>.Table = $("#<?php echo $this->FE; ?>List").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": <?php echo $this->JSPanelNamSpace; ?>.PageLength,
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
                "url": '<?php echo $_SESSION["HtmlComponentsRelPath"].$this->FE; ?>/UI.proxy.php',
                "type": "POST",
                "dataSrc": "data",
                "data": {
                    "SrvOpParams": <?php echo $this->JSPanelNamSpace; ?>.GetSrvOpParams(SrvOpNam),
                },
            },
            "columns": [
                <?php echo $this->TlistColumnsJS; ?>

            ],
        });
        <?php echo $this->JSPanelNamSpace; ?>.CleanSelectedRow();
    },
