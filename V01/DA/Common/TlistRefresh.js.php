<?php
echo'
    /**
    Refresh function for Std Tlist panel
    */
    Refresh: function() {
        SrvOpNam = "Read"; 

        if ($.fn.DataTable.isDataTable("#'.$this->TlistDataTblNam.'")) {
            $("#'.$this->TlistDataTblNam.'").DataTable().destroy();
        }

        $("#'.$this->TlistDataTblNam.' tbody").empty();

        '.$this->JSPanelNamSpace.'.Table = $("#'.$this->TlistDataTblNam.'").DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": '.$this->JSPanelNamSpace.'.PageLength,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "scrollX": true,
            "columnDefs": [
                '.$this->TlistColumnDefsJS.'
            ],
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": "'.$_SESSION["HtmlComponentsRelPath"].'UI.proxy.php",
                "type": "POST",
                "dataSrc": "data",
                "data": {
                    "SrvOpParams": '.$this->JSPanelNamSpace.'.GetSrvOpParams(SrvOpNam),
                },
            },
            "columns": [
                '.$this->TlistColumnsJS.'
            ],
        });
        '.$this->JSPanelNamSpace.'.Notify(null,"Set");
    },
';
?>
