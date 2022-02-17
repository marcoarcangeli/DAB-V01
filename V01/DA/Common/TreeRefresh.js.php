<?php
echo'
    /**
    Refresh function for Std Tree panel
    */

    // Refresh: function() {
    //     SrvOpNam = "Read"; 

    Refresh: function() {
        SrvOpNam = "Read"; 
        try {
            $.ajax({
                type: "POST",
                url: "'.$_SESSION["HtmlComponentsRelPath"].'UI.proxy.php",
                dataType: "json",
                "dataSrc": "data",
                "data": {
                    "SrvOpParams": '.$this->JSPanelNamSpace.'.GetSrvOpParams(SrvOpNam),
                },
                error: function(result) {
                    da.UsrMsgShow('.$this->JSPanelNamSpace.'.FailMsg, "Info");
                },
                success: function(result) {
                    // alert("success: "+result["State"]);
                    // alert("success: "+result["Msg"]);
                    if (result["State"]) {
                        '.$this->JSPanelNamSpace.'.DataArr = data = result["data"];
                        // alert("success: "+data[0]["Nam"]);
                        '.$this->JSPanelNamSpace.'.BuildTreeHTML(data);
                    } else {
                        da.UsrMsgShow('.$this->JSPanelNamSpace.'.FailMsg, "Info");
                    }
                },
            });
            '.$this->JSPanelNamSpace.'.Notify(null,"Set");
        } catch (e) {
            da.UsrMsgShow(e.message, "Exception");
        }
    },

    BuildTreeHTML: function(data) {
        // alert(Nodes.length);
        if (data) {
            html = da.getLevel(data, null, "'.$this->FEIdNam.'", "'.$this->FEIdNam.$_SESSION["DEFParent"].'",
                '.$this->JSPanelNamSpace.'.PanelTag)["html"];
            // alert(html);
            $("#'.$this->TreeObjNam.'").html(html);
            if ('.$this->JSPanelNamSpace.".".$this->FEIdNam.' &&
                '.$this->JSPanelNamSpace.".".$this->FEIdNam.' != "") {
                $("#" + '.$this->JSPanelNamSpace.".".$this->FEIdNam.').addClass("selected");
            }
        }
    },

    GetRowData: function() {
        obj = '.$this->JSPanelNamSpace.'.SelectedRow;
        data = '.$this->JSPanelNamSpace.'.DataArr.find(x => x.'.$this->FEIdNam.' === $(obj).attr("val"));
        data["SearchIds"] = $(obj).attr("searchIds");
        return data;
    },
';
?>
