<script type="text/javascript" ref="da.FeatureCatTree">
    da.FeatureCatTree = {

        whoIAm: "FeatureCatTree",
        PanelTag: "FeatureCat_",
        DataArr: null,
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
                    url: "DA/HtmlComponents/FeatureCat/Tree.proxy.php",
                    dataType: "json",
                    error: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        da.UsrMsgShow(da.FeatureCatTree.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        da.FeatureCatTree.DataArr=data=result["Data"];    
                        // alert("success: "+data[0]["Nam"]);
                        html=da.getLevel(data,null,"IdFeatureCat","IdFeatureCatPar",da.FeatureCatTree.PanelTag)["html"];
                        // alert(html);
                        $('#FeatureCatTree').html(html);
                        if(da.FeatureCatTree.IdFeatureCat && da.FeatureCatTree.IdFeatureCat != ''){
                            $("#"+da.FeatureCatTree.IdFeatureCat).addClass("selected");
                        }
                        // da.FeatureCatRead.Set(data);
                        // da.UsrMsgShow(da.UsrRead.SuccessMsg, "Info");
                    },
                })
            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }

        }
        ,
        GetNodeIdByName: function(arr, Nam) {
            var Nodes = $.grep(arr, function (ar) {
                // alert(ar["IdFeatureCatPar"]);
                return ar["Nam"] == Nam;
            });
            // alert(Nodes.length);
            if(Nodes.length > 0){
                return Nodes[0]["IdFeatureCat"];
            }else{
                return false;
            }
        }
        ,
        SetNodeByName: function(Nam) {
            var NodeId=null;
            if(NodeId=da.FeatureCatTree.GetNodeIdByName(da.FeatureCatTree.DataArr, Nam)){
                // alert(NodeId);
                da.FeatureCatTree.Set($(this).attr('id'));
            }else{
                // alert("Node not found");
            }
        }
        ,
        Get: function(obj) {
            data= {
                IdNode          : $(obj).attr('id'),
                IdFeatureCat        : $(obj).attr('val'),
                FeatureCatNam       : $(obj).text(),
                IdFeatureCatPar     : $(obj).attr('idPar'),
                SearchIds       : $(obj).attr('searchIds'),
                ChangePar       : da.FeatureCatTree.ChangePar,
            };
            return data;
        }
        ,
        Set: function(objId) {
            // alert(objId);
            obj=$("#"+objId);

            // alert(da.FeatureCatTree.ChangePar);
            if(objId){
                if(da.FeatureCatTree.ChangePar){
                    data=da.FeatureCatTree.Get(obj);
                    da.RefreshDetailPanels(da.FeatureCatTree.DetailPanels, "SetFeatureCatPar", data);
                    da.FeatureCatTree.ChangePar=false;
                }else{
                    if ($(obj).hasClass("selected")) {
                        $(obj).removeClass("selected");
                        da.FeatureCatTree.IdFeatureCat='';
                        // alert("Not selected");
                        // da_dataTree.Clean();
                        if(da.FeatureCatTree.Mode=="TlistPar"){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.FeatureCatTree.DetailPanels, "CleanFeatureCat");
                        }else if(da.FeatureCatTree.RefPanels && da.FeatureCatTree.RefPanels != ''){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.FeatureCatTree.RefPanels, "CleanFeatureCat");
                        }else{
                            da.RefreshDetailPanels(da.FeatureCatTree.DetailPanels, "Clean");
                        }
                    } else {
                        $("#FeatureCatTree div.selected").removeClass("selected");
                        // alert("Selected");
                        $(obj).addClass("selected");
                        data=da.FeatureCatTree.Get(obj);
                        // alert($(obj).attr('searchIds'));
                        if(da.FeatureCatTree.Mode=="TlistPar"){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.FeatureCatTree.DetailPanels, "SetFeatureCat", data);
                        }else if(da.FeatureCatTree.RefPanels && da.FeatureCatTree.RefPanels != ''){
                            // alert(data["SearchIds"]);
                            da.RefreshDetailPanels(da.FeatureCatTree.RefPanels, "SetFeatureCat", data);
                        }else{
                            da.FeatureCatRead.IdFeatureCat=data["IdFeatureCat"];
                            // alert(data["IdFeatureCat"]);
                            da.RefreshDetailPanels(da.FeatureCatTree.DetailPanels, "Refresh");
                        }

                    }
                }
            }
        }
        ,
        ChangeParent: function() {
            if(da.FeatureCatTree.ChangePar){
                da.FeatureCatTree.ChangePar=false;
            }else{
                da.FeatureCatTree.ChangePar=true;
            }
        },

    }
    $(document).ready(function() {

        da.FeatureCatTree.Refresh();

        $("#FeatureCatTree").on("click", "div", function() {
            // alert("$(this).attr('idPar'): "+$(this).attr('idPar'));
            da.FeatureCatTree.Set($(this).attr('id'));
        });

        $("#FeatureCatTree").on("dblclick", "div", function() {
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