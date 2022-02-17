<?php
echo'
    /**
    Refresh function for Std FileTlist panel
    */
    Refresh: function() {
        SrvOpNam = "Read"; 

        if ($.fn.DataTable.isDataTable("#'.$this->TlistDataTblNam.'")) {
            $("#'.$this->TlistDataTblNam.'").DataTable().destroy();
        }

        $("#'.$this->TlistDataTblNam.' tbody").empty();

        '.$this->JSPanelNamSpace.'.Table = $("#'.$this->TlistDataTblNam.'").DataTable({
            "dom": "<\'myfilter\'f>t ip",
            "paging": true,
            "lengthChange": false,
            "pageLength": '.$this->PageLength.', 
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "scrollX": true,
            "columnDefs": [
                // '.$this->TlistColumnDefsJS.'
            ],
            "fixedColumns": true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": "'.$_SESSION["HtmlComponentsRelPath"].$this->FE.'/FileTlist.proxy.php",
                "type": "POST",
                "dataSrc": "data",
                "data": {
                    // "SrvOpParams": '.$this->JSPanelNamSpace.'.GetSrvOpParams(SrvOpNam),
                },
            },
            "columns": [{
                "data": "FileNam"
            }],
            "order": [
                [0, "'.$this->TlistOrder.'"]
            ],
        });
        '.$this->JSPanelNamSpace.'.Notify(null,"Refresh");
    },
';
?>
