<script type="text/javascript" ref="TlistOpDatCat">
    da.TlistOpDatCat = {
        Mode: "<?php echo $this->Mode; ?>",

        RefreshObj: function() {
            $("#elencoOpDatTypes").DataTable().ajax.reload(null, false);
        },
        
    }
    $(document).ready(function() {

        $(function() {
            var table = $("#elencoOpDatTypes").DataTable({
                "paging": true,
                "lengthChange": false,
                "pageLength": da.TlistOpDatCat.PageLength,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "scrollX": true,
                "columnDefs": [{
                        "width": 10,
                        "targets": 0
                    },
                    {
                        "width": 100,
                        "targets": 1
                    }
                ],
                "fixedColumns": true,
                "processing": true,
                "serverSide": false,
                "ajax": {
                    "url": "DA/HtmlComponents/OpDatCat/Tlist.proxy.php",
                    "type": "POST",
                    "dataSrc": "data"
                },
                "columns": [{
                        "data": "IdOpDatCat"
                    },
                    {
                        "data": "Nam"
                    },
                    {
                        "data": "Descr"
                    }
                ],

            });

            // $("#elencoOpDatTypes tbody").on("dblclick", "tr", function() {
            //     var idOpDatCat = $(this).children(":nth-child(1)").text();
            //     alert(idOpDatCat);
            //     // window.location = "../ingrediente/viewPubbliche.php?idOpDatCat=" + idOpDatCat;
            //     Evnt.stopImmediatePropagation();
            // });

            $("#elencoOpDatTypes tbody").on("click", "tr", function() {
                if ($(this).hasClass("selected")) {
                    $(this).removeClass("selected");
                    $("#OpDatCat_idOpDatCat").val("");
                    $("#OpDatCat_Nam").val("");
                    $("#OpDatCat_Descr").val("");

                    $("#btnDeleteOpDatCat").attr("disabled", true);
                    $("#btnRefreshOpDatCat").attr("disabled", true);
                } else {
                    table.$("tr.selected").removeClass("selected");
                    $(this).addClass("selected");

                    var idOpDatCat = $(this).children(":nth-child(1)").text();
                    var Nam = $(this).children(":nth-child(2)").text();
                    var Descr = $(this).children(":nth-child(3)").text();

                    $("#OpDatCat_idOpDatCat").val(idOpDatCat);
                    $("#OpDatCat_Nam").val(Nam);
                    $("#OpDatCat_Descr").val(Descr);

                    $("#btnDeleteOpDatCat").attr("disabled", false);
                    $("#btnRefreshOpDatCat").attr("disabled", false);

                    // $("#btnRefreshOpDatCat").click();
                }

            });

            // $("#btnRefreshProgetti").click(function() {
            //     // alert("Update tabella");
            // });

        });


    })
</script>