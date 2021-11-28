<script type="text/javascript" ref="da.SplitTypeTlist">
    da.SplitTypeTlist = {

        SearchIds: '',     
        Table: null,     
        Mode: "<?php echo $this->Mode; ?>",
        PageLength: "<?php echo $this->PageLength; ?>",
        DetailPanels: "<?php echo $this->DetailPanels; ?>",
        RefPanels: "<?php echo $this->RefPanels; ?>",
        ParentObj: '<?php echo $this->ParentObj; ?>',
        ParentObjType: '<?php echo $this->ParentObjType; ?>',
        
        SetSplitCat: function(data) {
            // alert(data["IdSplitCat"]);
            // alert(data["SplitCatNam"]);
            da.SplitTypeTlist.IdSplitCat=data["IdSplitCat"];
            $("#SplitTypeTlist_IdSplitCat").val(data["IdSplitCat"]);
            $("#SplitTypeTlist_SplitCatNam").val(data["SplitCatNam"]);
            da.SplitTypeTlist.SearchIds=data["SearchIds"];
            da.SplitTypeTlist.Refresh();

            // if(da.SplitTypeTlist.Mode=="TlistPar"){
            //     da.RefreshDetailPanels(da.SplitTypeTlist.DetailPanels, "SetSplitCat", data);
            // }else{
            if(da.SplitTypeTlist.Mode=="Tlist"){
                da.SplitTypeRead.IdSplitCat=data["IdSplitCat"];
                da.RefreshDetailPanels(da.SplitTypeTlist.DetailPanels, "SetSplitCat", data);
            }
        }
        ,
        CleanSplitCat: function() {
            // alert(data["IdSplitCat"]);
            // alert(data["SplitCatNam"]);
            da.SplitTypeTlist.IdSplitCat='';
            $("#SplitTypeTlist_IdSplitCat").val('');
            $("#SplitTypeTlist_SplitCatNam").val('');
            da.SplitTypeTlist.SearchIds="";
            // da.RefreshObj("SplitTypeList");
            da.SplitTypeTlist.Refresh();

            if(da.SplitTypeTlist.Mode=="Tlist"){
                da.SplitTypeRead.IdSplitCat='';
                da.RefreshDetailPanels(da.SplitTypeTlist.DetailPanels, "CleanSplitCat");
            }
        }
        ,
        Refresh: function() {
            $params="";
            if(da.SplitTypeTlist.SearchIds != ''){
                $params="?SearchIds=" + da.SplitTypeTlist.SearchIds;
            }
            if ( $.fn.DataTable.isDataTable('#SplitTypeList') ) {
                $('#SplitTypeList').DataTable().destroy();
            }

            $('#SplitTypeList tbody').empty();

            // alert($params);
            da.SplitTypeTlist.Table = $("#SplitTypeList").DataTable({
                "paging": true,
                "lengthChange": false,
                "pageLength": da.SplitTypeTlist.PageLength,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "scrollX": true,
                "columnDefs": [
                    { "width": 10, "targets": 0 },
                    { "width": 10, "targets": 1 },
                    { "width": 50, "targets": 2 },
                    { "width": 100, "targets": 3 },
                    { "width": 50, "targets": 4 }
                ],
                "fixedColumns": true,
                "processing": true,
                "serverSide": false,
                "ajax": {
                    "url": "DA/HtmlComponents/SplitType/Tlist.proxy.php" + $params,
                    "type": "GET",
                    "dataSrc": "data"
                },
                "columns": [
                    { "data": "IdSplitType" },
                    { "data": "IdSplitCat" },
                    { "data": "SplitCatNam" },
                    { "data": "Nam" },
                    { "data": "Descr" },
                    { "data": "Perc" }
                ],

            });


        }
        ,
        Get: function(obj) {
            data= {
                IdSplitType     : $(obj).children(":nth-child(1)").text(),
                IdSplitCat  : $(obj).children(":nth-child(2)").text(),
                SplitCatNam : $(obj).children(":nth-child(3)").text(),
                Nam             : $(obj).children(":nth-child(4)").text(),
                Descr           : $(obj).children(":nth-child(5)").text(),
                Perc       : $(obj).children(":nth-child(6)").text(),
            };
            return data;
        },

        SelectRow: function(obj) {
            if ($(obj).hasClass("selected")) {
                $(obj).removeClass("selected");
                if(da.SplitTypeTlist.Mode=="TlistPar"){
                    da.RefreshDetailPanels(da.SplitTypeTlist.DetailPanels, "CleanSplitType");
                    da.RefreshDetailPanels(da.SplitTypeTlist.RefPanels, "CleanDefaults");
                }else{
                    da.RefreshDetailPanels(da.SplitTypeTlist.DetailPanels, "Clean");
                }

            } else {
                da.SplitTypeTlist.Table.$("tr.selected").removeClass("selected");
                $(obj).addClass("selected");
                
                data=da.SplitTypeTlist.Get(obj);

                if(da.SplitTypeTlist.Mode=="TlistPar"){
                    da.RefreshDetailPanels(da.SplitTypeTlist.DetailPanels, "SetSplitType", data);
                    da.RefreshDetailPanels(da.SplitTypeTlist.RefPanels, "SetDefaults", data);
                }else{
                    da.SplitTypeRead.IdSplitType=data["IdSplitType"];
                    da.RefreshDetailPanels(da.SplitTypeTlist.DetailPanels, "Refresh");
                }
            }

        }
        ,
    }

    $(document).ready(function() {
        da.SplitTypeTlist.Refresh();
        $(function() {
            $("#SplitTypeList tbody").on("click", "tr", function() {
                da.SplitTypeTlist.SelectRow(this);
            });

        });


    })
</script>