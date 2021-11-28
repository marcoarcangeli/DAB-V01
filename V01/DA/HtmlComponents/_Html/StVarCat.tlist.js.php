<script type="text/javascript" ref="da.StVarCatTlist">
    da.StVarCatTlist = {

        Mode: "<?php echo $this->Mode; ?>",
        PageLength: "<?php echo $this->PageLength; ?>",
        DetailPanels: "<?php echo $this->DetailPanels; ?>",

    }
    $(document).ready(function() {

        $(function() {
            var table = $("#StVarCatList").DataTable({
                "paging": true,
                "lengthChange": false,
                "pageLength": da.StVarCatTlist.PageLength,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "scrollX": true,
                "columnDefs": [
                    { "width": 10, "targets": 0 },
                    { "width": 10, "targets": 1 },
                    { "width": 100, "targets": 2 }
                ],
                "fixedColumns": true,
                "processing": true,
                "serverSide": false,
                "ajax": {
                    "url": "DA/HtmlComponents/StVarCat/Tlist.proxy.php",
                    "type": "POST",
                    "dataSrc": "data"
                },
                "columns": [
                    { "data": "IdStVarCat" },
                    { "data": "IdStVarCatPar" },
                    { "data": "Nam" },
                    { "data": "Descr" }
                ],

            });

            $("#StVarCatList tbody").on("click", "tr", function() {
                if ($(this).hasClass("selected")) {
                    $(this).removeClass("selected");
                    da.RefreshDetailPanels(da.StVarCatTlist.DetailPanels, "Clean");
                } else {
                    table.$("tr.selected").removeClass("selected");
                    $(this).addClass("selected");
                    data={
                        IdStVarCat    : $(this).children(":nth-child(1)").text(),
                        IdStVarCatPar : $(this).children(":nth-child(2)").text(),
                        Nam         : $(this).children(":nth-child(3)").text(),
                        Descr       : $(this).children(":nth-child(4)").text(),
                    }
                    da.StVarCatRead.IdStVarCat=data["IdStVarCat"];
                    da.RefreshDetailPanels(da.StVarCatTlist.DetailPanels, "Refresh");
                }

            });

            // $("#btnRefreshProgetti").click(function() {
            //     // alert("Update tabella");
            // });
        });
    })
</script>