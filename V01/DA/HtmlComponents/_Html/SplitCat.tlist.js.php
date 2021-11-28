<script type="text/javascript" ref="da.SplitCatTlist">
    da.SplitCatTlist = {

        Mode: "<?php echo $this->Mode; ?>",
        PageLength: "<?php echo $this->PageLength; ?>",
        DetailPanels: "<?php echo $this->DetailPanels; ?>",

    }
    $(document).ready(function() {

        $(function() {
            var table = $("#SplitCatList").DataTable({
                "paging": true,
                "lengthChange": false,
                "pageLength": da.SplitCatTlist.PageLength,
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
                    "url": "DA/HtmlComponents/SplitCat/Tlist.proxy.php",
                    "type": "POST",
                    "dataSrc": "data"
                },
                "columns": [
                    { "data": "IdSplitCat" },
                    { "data": "IdSplitCatPar" },
                    { "data": "Nam" },
                    { "data": "Descr" }
                ],

            });

            $("#SplitCatList tbody").on("click", "tr", function() {
                if ($(this).hasClass("selected")) {
                    $(this).removeClass("selected");
                    da.RefreshDetailPanels(da.SplitCatTlist.DetailPanels, "Clean");
                } else {
                    table.$("tr.selected").removeClass("selected");
                    $(this).addClass("selected");
                    data={
                        IdSplitCat    : $(this).children(":nth-child(1)").text(),
                        IdSplitCatPar : $(this).children(":nth-child(2)").text(),
                        Nam         : $(this).children(":nth-child(3)").text(),
                        Descr       : $(this).children(":nth-child(4)").text(),
                    }
                    da.SplitCatRead.IdSplitCat=data["IdSplitCat"];
                    da.RefreshDetailPanels(da.SplitCatTlist.DetailPanels, "Refresh");
                }

            });

            // $("#btnRefreshProgetti").click(function() {
            //     // alert("Update tabella");
            // });
        });
    })
</script>