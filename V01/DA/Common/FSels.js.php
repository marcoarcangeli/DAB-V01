<?php 
    // FSels Js
    // Fields select drop-down boxes
    // Dependencies: 
    //      - ...
    // recursive: FSelNam == FE -> prepare srvOpParams; get list; remove current FE from the list
    // standard:  FSelNam != FE -> prepare srvOpParams; get list;

    if(isset($this->FSels) && $this->FSels !== ''){
        $FSelsArr=explode(',',$this->FSels);
        foreach ($FSelsArr as $FSel) {
            // recursion case
            if($FSel == $this->FE){
                $FSelNam=$FSel.$_SESSION["DEFParent"];
            }else{
                $FSelNam=$FSel;
            }
echo '
    get'.$FSelNam.'select: function() {
        SrvOpNam = "Read";
        $.ajax({
            url: "'.$_SESSION["HtmlComponentsRelPath"].'UI.proxy.php",
            type: "POST",
            dataType: "json",
            async: true,
            "data": {
                "SrvOpParams": '.$this->JSPanelNamSpace.'.GetSrvOpParams'.$FSel.'(SrvOpNam),
            },
            error: function(result) {
                da.UsrMsgShow('.$this->JSPanelNamSpace.'.FailMsg, "Error");
            },
            success: function(result) {
                if (result["State"]) {
                    data = result["data"];
                    '.$this->JSPanelNamSpace.'.BuildFSelHtml'.$FSel.'(data);
                } else {
                    da.UsrMsgShow('.$this->JSPanelNamSpace.'.FailMsg, "Info");
                }
            },
        });
    },
    // prepare the SrvOpParams'.$FSel.'
    // Dependencies: 
    //      - GetFMJson: if necessary or empty string
    //      - GetFEFsJson: for Save op
    GetSrvOpParams'.$FSel.': function(SrvOpNam) {
        data = {
            "SrvOpNam"  : SrvOpNam, 
            "FE"        : "'.$this->FSelsSrvOpParams[$FSel]["FE"]  .'", 
            "FEFs"      : "'.$this->FSelsSrvOpParams[$FSel]["FEFs"].'",
            "DEs"       : "'.$this->FSelsSrvOpParams[$FSel]["DEs"] .'",
            "DEFs"      : "'.$this->FSelsSrvOpParams[$FSel]["DEFs"].'",  
            "EFs"       : "'.$this->FSelsSrvOpParams[$FSel]["EFs"] .'",  
            "FM"        : null, 
            "VM"        : null,
        };

        return data;
    },

    // prepare the SrvOpParams'.$FSel.'
    // Dependencies: 
    //      - GetFMJson: if necessary or empty string
    //      - GetFEFsJson: for Save op
    BuildFSelHtml'.$FSel.': function(data) {
        $("#'.$this->PanelTag.$_SESSION["IdPrfx"].$FSelNam.'").empty();
        $("#'.$this->PanelTag.$_SESSION["IdPrfx"].$FSelNam.'").append(
            $("<option></option>") // Yes you can do this.
            .text("Select an Item ...")
            .val("")
        );
        $.each(data, function(index, item) { // Iterates through a collection
            // if cathegory is present
            CatTxt=(item.'.$FSel.'CatNam)? item.'.$FSel.'CatNam + "/" : "";
            $("#'.$this->PanelTag.$_SESSION["IdPrfx"].$FSelNam.'")
                .append( // Append an object to the inside of the select box
                    $("<option></option>") // Yes you can do this.
                    .text(CatTxt + item.Nam + " (" + item.'.$_SESSION["IdPrfx"].$FSel.' + ")")
                    .val(item.'.$_SESSION["IdPrfx"].$FSel.')
                );
        });
    },

';
        }
    }
?>

