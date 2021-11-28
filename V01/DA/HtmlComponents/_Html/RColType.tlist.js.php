<script type="text/javascript" ref="da.RColTypeTlist">
    da.RColTypeTlist = {

        Mode: "<?php echo $this->Mode; ?>",
        PageLength: "<?php echo $this->PageLength; ?>",
        DetailPanels: "<?php echo $this->DetailPanels; ?>",

        Get: function(obj) {
            data= {
                IdRColType  : $(obj).children(":nth-child(1)").text(),
                Nam         : $(obj).children(":nth-child(2)").text(),
                Descr       : $(obj).children(":nth-child(3)").text(),
            };
            return data;
        },

    }

    $(document).ready(function() {

        $(function() {
            var table = $("#RColTypeList").DataTable({
                "paging": true,
                "lengthChange": false,
                "pageLength": da.RColTypeTlist.PageLength,
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
                    "url": "DA/HtmlComponents/RColType/Tlist.proxy.php",
                    "type": "POST",
                    "dataSrc": "data"
                },
                "columns": [
                    { "data": "IdRColType" },
                    { "data": "Nam" },
                    { "data": "Descr" }
                ],

            });

            $("#RColTypeList tbody").on("click", "tr", function() {
                if ($(this).hasClass("selected")) {
                    $(this).removeClass("selected");
                    da.RefreshDetailPanels(da.RColTypeTlist.DetailPanels, "Clean");
                } else {
                    table.$("tr.selected").removeClass("selected");
                    $(this).addClass("selected");
                    data = da.RColTypeTlist.Get(this);

                    da.RColTypeRead.IdRColType=data["IdRColType"];
                    da.RefreshDetailPanels(da.RColTypeTlist.DetailPanels, "Refresh");
                }

            });

        });
    })
</script>