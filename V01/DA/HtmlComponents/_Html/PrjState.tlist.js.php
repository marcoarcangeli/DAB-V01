<script type="text/javascript" ref="da.PrjStateTlist">
    da.PrjStateTlist = {

        Mode: "<?php echo $this->Mode; ?>",
        PageLength: "<?php echo $this->PageLength; ?>",
        DetailPanels: "<?php echo $this->DetailPanels; ?>",

        Get: function(obj) {
            data= {
                IdPrjState  : $(obj).children(":nth-child(1)").text(),
                Nam         : $(obj).children(":nth-child(2)").text(),
                Descr       : $(obj).children(":nth-child(3)").text(),
            };
            return data;
        },

    }

    $(document).ready(function() {

        $(function() {
            var table = $("#PrjStateList").DataTable({
                "paging": true,
                "lengthChange": false,
                "pageLength": da.PrjStateTlist.PageLength,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "scrollX": true,
                "columnDefs": [
                    { "width": 10, "targets": 0 },
                    { "width": 100, "targets": 1 }
                ],
                "fixedColumns": true,
                "processing": true,
                "serverSide": false,
                "ajax": {
                    "url": "DA/HtmlComponents/PrjState/Tlist.proxy.php",
                    "type": "POST",
                    "dataSrc": "data"
                },
                "columns": [
                    { "data": "IdPrjState" },
                    { "data": "Nam" },
                    { "data": "Descr" }
                ],

            });

            $("#PrjStateList tbody").on("click", "tr", function() {
                if ($(this).hasClass("selected")) {
                    $(this).removeClass("selected");
                    da.RefreshDetailPanels(da.PrjStateTlist.DetailPanels, "Clean");
                } else {
                    table.$("tr.selected").removeClass("selected");
                    $(this).addClass("selected");
                    data = da.PrjStateTlist.Get(this);

                    da.PrjStateRead.IdPrjState=data["IdPrjState"];
                    da.RefreshDetailPanels(da.PrjStateTlist.DetailPanels, "Refresh");
                }

            });

        });
    })
</script>