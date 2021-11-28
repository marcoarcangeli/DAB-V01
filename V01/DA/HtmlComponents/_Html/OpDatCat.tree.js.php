<script type="text/javascript" ref="da.OpDatCatTree">
    da.OpDatCatTree = {

        whoIAm: "OpDatCatTree",
        PanelTag: "OpDatCat_",
        IdOpDatCat: '',
        ChangePar: false,
        Mode: "<?php echo $this->Mode; ?>",
        DetailPanels: "<?php echo $this->DetailPanels; ?>",
        RefPanels: "<?php echo $this->RefPanels; ?>",
        SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
        FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

        Refresh: function() {
            try {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/OpDatCat/Tree.proxy.php",
                    dataType: "json",
                    error: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        da.UsrMsgShow(da.OpDatCatTree.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data=result["Data"];    
                        // alert("success: "+data[0]["Nam"]);
                        html=da.getLevel(data,null,'IdOpDatCat','IdOpDatCatPar', da.OpDatCatTree.PanelTag)["html"];
                        // alert(html);
                        $('#OpDatCatTree').html(html);
                        if(da.OpDatCatTree.IdOpDatCat && da.OpDatCatTree.IdOpDatCat != ''){
                            $("#"+da.OpDatCatTree.IdOpDatCat).addClass("selected");
                        }
                        // da.OpDatCatRead.Set(data);
                        // da.UsrMsgShow(da.UsrRead.SuccessMsg, "Info");
                    },
                })
            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }

        }
        ,
        Get: function(obj) {
            data= {
                IdNode              : $(obj).attr('id'),
                IdOpDatCat      : $(obj).attr('val'),
                OpDatCatNam     : $(obj).text(),
                IdOpDatCatPar   : $(obj).attr('idPar'),
                SearchIds           : $(obj).attr('searchIds'),
                ChangePar           : da.OpDatCatTree.ChangePar,
            };
            return data;
        }
        ,

        Set: function(objId) {
            // alert(objId);
            obj=$("#"+objId);

            // alert(da.OpDatCatTree.ChangePar);
            if(objId){
                if(da.OpDatCatTree.ChangePar){
                    data=da.OpDatCatTree.Get(obj);
                    da.RefreshDetailPanels(da.OpDatCatTree.DetailPanels, "SetOpDatCatPar", data);
                    da.OpDatCatTree.ChangePar=false;
                }else{
                    if ($(obj).hasClass("selected")) {
                        $(obj).removeClass("selected");
                        da.OpDatCatTree.IdOpDatCat='';
                        // alert("Not selected");
                        // da_dataTree.Clean();
                        if(da.OpDatCatTree.Mode=="TlistPar"){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.OpDatCatTree.DetailPanels, "CleanOpDatCat");
                        }else if(da.OpDatCatTree.RefPanels && da.OpDatCatTree.RefPanels != ''){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.OpDatCatTree.RefPanels, "CleanOpDatCat");
                        }else{
                            da.RefreshDetailPanels(da.OpDatCatTree.DetailPanels, "Clean");
                        }
                    } else {
                        $("#OpDatCatTree div.selected").removeClass("selected");
                        // alert("Selected");
                        $(obj).addClass("selected");
                        data=da.OpDatCatTree.Get(obj);
                        da.OpDatCatTree.IdOpDatCat=data["IdOpDatCat"];
                        // alert($(obj).attr('searchIds'));
                        if(da.OpDatCatTree.Mode=="TlistPar"){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.OpDatCatTree.DetailPanels, "SetOpDatCat", data);
                        }else if(da.OpDatCatTree.RefPanels && da.OpDatCatTree.RefPanels != ''){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.OpDatCatTree.RefPanels, "SetOpDatCat", data);
                        }else{
                            da.OpDatCatRead.IdOpDatCat=data["IdOpDatCat"];
                            // alert(data["IdOpDatCat"]);
                            da.RefreshDetailPanels(da.OpDatCatTree.DetailPanels, "Refresh");
                        }

                    }
                }
            }
        }
        ,
        ChangeParent: function() {
            if(da.OpDatCatTree.ChangePar){
                da.OpDatCatTree.ChangePar=false;
            }else{
                da.OpDatCatTree.ChangePar=true;
            }
        },
    }
    $(document).ready(function() {

        da.OpDatCatTree.Refresh();

        $("#OpDatCatTree").on("click", "div", function() {
            // alert("$(this).attr('idPar'): "+$(this).attr('idPar'));
            da.OpDatCatTree.Set($(this).attr('id'));
        });

        $("#OpDatCatTree").on("dblclick", "div", function() {
            // alert($(this).attr('id'));
            ulId=$(this).attr('id');
            ulIdPar=$(this).attr('idPar');
            // if ($(this).hasClass("hidden")) {
            //     $(this).removeClass("hidden");
            if ($('#parUl'+ulIdPar).hasClass("hidden")) {
                $('#parUl'+ulIdPar).removeClass("hidden");
                // alert("Not hidden");
                // da_dataTree.Clean();
                $('#parUl'+ulId).slideToggle();
                $('#'+ulId +' i').removeClass("fa-chevron-right");
                $('#'+ulId +' i').addClass("fa-chevron-down");
            } else {
                // alert("hidden");
                // table.$("tr.selected").removeClass("selected");
                $('#parUl'+ulIdPar).addClass("hidden");
                // $('#parUl'+parUlId).hide();
                $('#parUl'+ulId).slideToggle();
                $('#'+ulId +' i').removeClass("fa-chevron-down");
                $('#'+ulId +' i').addClass("fa-chevron-right");
            }
        });

    })
</script>