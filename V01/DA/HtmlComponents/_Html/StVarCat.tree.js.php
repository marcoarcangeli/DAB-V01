<script type="text/javascript" ref="da.StVarCatTree">
    da.StVarCatTree = {

        whoIAm: "StVarCatTree",
        PanelTag: "StVarCat_",
        IdStVarCat: '',
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
                    url: "DA/HtmlComponents/StVarCat/Tree.proxy.php",
                    dataType: "json",
                    error: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        da.UsrMsgShow(da.StVarCatTree.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data=result["Data"];    
                        // alert("success: "+data[0]["Nam"]);
                        html=da.getLevel(data,null,'IdStVarCat','IdStVarCatPar', da.StVarCatTree.PanelTag)["html"];
                        // alert(html);
                        $('#StVarCatTree').html(html);
                        if(da.StVarCatTree.IdStVarCat && da.StVarCatTree.IdStVarCat != ''){
                            $("#"+da.StVarCatTree.IdStVarCat).addClass("selected");
                        }
                        // da.StVarCatRead.Set(data);
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
                IdStVarCat      : $(obj).attr('val'),
                StVarCatNam     : $(obj).text(),
                IdStVarCatPar   : $(obj).attr('idPar'),
                SearchIds           : $(obj).attr('searchIds'),
                ChangePar           : da.StVarCatTree.ChangePar,
            };
            return data;
        }
        ,

        Set: function(objId) {
            // alert(objId);
            obj=$("#"+objId);

            // alert(da.StVarCatTree.ChangePar);
            if(objId){
                if(da.StVarCatTree.ChangePar){
                    data=da.StVarCatTree.Get(obj);
                    da.RefreshDetailPanels(da.StVarCatTree.DetailPanels, "SetStVarCatPar", data);
                    da.StVarCatTree.ChangePar=false;
                }else{
                    if ($(obj).hasClass("selected")) {
                        $(obj).removeClass("selected");
                        da.StVarCatTree.IdStVarCat='';
                        // alert("Not selected");
                        // da_dataTree.Clean();
                        if(da.StVarCatTree.Mode=="TlistPar"){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.StVarCatTree.DetailPanels, "CleanStVarCat");
                        }else if(da.StVarCatTree.RefPanels && da.StVarCatTree.RefPanels != ''){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.StVarCatTree.RefPanels, "CleanStVarCat");
                        }else{
                            da.RefreshDetailPanels(da.StVarCatTree.DetailPanels, "Clean");
                        }
                    } else {
                        $("#StVarCatTree div.selected").removeClass("selected");
                        // alert("Selected");
                        $(obj).addClass("selected");
                        data=da.StVarCatTree.Get(obj);
                        da.StVarCatTree.IdStVarCat=data["IdStVarCat"];
                        // alert($(obj).attr('searchIds'));
                        if(da.StVarCatTree.Mode=="TlistPar"){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.StVarCatTree.DetailPanels, "SetStVarCat", data);
                        }else if(da.StVarCatTree.RefPanels && da.StVarCatTree.RefPanels != ''){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.StVarCatTree.RefPanels, "SetStVarCat", data);
                        }else{
                            da.StVarCatRead.IdStVarCat=data["IdStVarCat"];
                            // alert(data["IdStVarCat"]);
                            da.RefreshDetailPanels(da.StVarCatTree.DetailPanels, "Refresh");
                        }

                    }
                }
            }
        }
        ,
        ChangeParent: function() {
            if(da.StVarCatTree.ChangePar){
                da.StVarCatTree.ChangePar=false;
            }else{
                da.StVarCatTree.ChangePar=true;
            }
        },

    }
    $(document).ready(function() {

        da.StVarCatTree.Refresh();

        $("#StVarCatTree").on("click", "div", function() {
            // alert("$(this).attr('idPar'): "+$(this).attr('idPar'));
            da.StVarCatTree.Set($(this).attr('id'));
        });

        $("#StVarCatTree").on("dblclick", "div", function() {
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

            // $("#btnRefreshProgetti").click(function() {
            //     // alert("Update tabella");
            // });
        // });
    })
</script>