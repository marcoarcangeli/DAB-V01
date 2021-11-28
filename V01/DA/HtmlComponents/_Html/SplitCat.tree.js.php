<script type="text/javascript" ref="da.SplitCatTree">
    da.SplitCatTree = {

        whoIAm: "SplitCatTree",
        PanelTag: "SplitCat_",
        IdSplitCat: '',
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
                    url: "DA/HtmlComponents/SplitCat/Tree.proxy.php",
                    dataType: "json",
                    error: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        da.UsrMsgShow(da.SplitCatTree.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data=result["Data"];    
                        // alert("success: "+data[0]["Nam"]);
                        html=da.getLevel(data,null,'IdSplitCat','IdSplitCatPar', da.SplitCatTree.PanelTag)["html"];
                        // alert(html);
                        $('#SplitCatTree').html(html);
                        if(da.SplitCatTree.IdSplitCat && da.SplitCatTree.IdSplitCat != ''){
                            $("#"+da.SplitCatTree.IdSplitCat).addClass("selected");
                        }
                        // da.SplitCatRead.Set(data);
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
                IdSplitCat      : $(obj).attr('val'),
                SplitCatNam     : $(obj).text(),
                IdSplitCatPar   : $(obj).attr('idPar'),
                SearchIds           : $(obj).attr('searchIds'),
                ChangePar           : da.SplitCatTree.ChangePar,
            };
            return data;
        }
        ,

        Set: function(objId) {
            // alert(objId);
            obj=$("#"+objId);

            // alert(da.SplitCatTree.ChangePar);
            if(objId){
                if(da.SplitCatTree.ChangePar){
                    data=da.SplitCatTree.Get(obj);
                    da.RefreshDetailPanels(da.SplitCatTree.DetailPanels, "SetSplitCatPar", data);
                    da.SplitCatTree.ChangePar=false;
                }else{
                    if ($(obj).hasClass("selected")) {
                        $(obj).removeClass("selected");
                        da.SplitCatTree.IdSplitCat='';
                        // alert("Not selected");
                        // da_dataTree.Clean();
                        if(da.SplitCatTree.Mode=="TlistPar"){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.SplitCatTree.DetailPanels, "CleanSplitCat");
                        }else if(da.SplitCatTree.RefPanels && da.SplitCatTree.RefPanels != ''){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.SplitCatTree.RefPanels, "CleanSplitCat");
                        }else{
                            da.RefreshDetailPanels(da.SplitCatTree.DetailPanels, "Clean");
                        }
                    } else {
                        $("#SplitCatTree div.selected").removeClass("selected");
                        // alert("Selected");
                        $(obj).addClass("selected");
                        data=da.SplitCatTree.Get(obj);
                        da.SplitCatTree.IdSplitCat=data["IdSplitCat"];
                        // alert($(obj).attr('searchIds'));
                        if(da.SplitCatTree.Mode=="TlistPar"){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.SplitCatTree.DetailPanels, "SetSplitCat", data);
                        }else if(da.SplitCatTree.RefPanels && da.SplitCatTree.RefPanels != ''){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.SplitCatTree.RefPanels, "SetSplitCat", data);
                        }else{
                            da.SplitCatRead.IdSplitCat=data["IdSplitCat"];
                            // alert(data["IdSplitCat"]);
                            da.RefreshDetailPanels(da.SplitCatTree.DetailPanels, "Refresh");
                        }

                    }
                }
            }
        }
        ,
        ChangeParent: function() {
            if(da.SplitCatTree.ChangePar){
                da.SplitCatTree.ChangePar=false;
            }else{
                da.SplitCatTree.ChangePar=true;
            }
        },


    }
    $(document).ready(function() {

        da.SplitCatTree.Refresh();

        $("#SplitCatTree").on("click", "div", function() {
            // alert("$(this).attr('idPar'): "+$(this).attr('idPar'));
            da.SplitCatTree.Set($(this).attr('id'));
        });

        $("#SplitCatTree").on("dblclick", "div", function() {
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