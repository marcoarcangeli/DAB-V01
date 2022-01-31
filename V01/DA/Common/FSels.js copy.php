    // FSels Js
    // Fields select drop-down boxes
    // Dependencies: 
    //      - ...
    <?php 
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
            $.ajax({
                url: "'.$_SESSION["HtmlComponentsRelPath"].$FSel.'/Tlist.proxy.php",
                type: "POST",
                dataType: "json",
                async: true,
                data: "data",
                success: function(response) {
                    $("#'.$this->PanelTag.$_SESSION["IdPrfx"].$FSelNam.'").empty();
                    $("#'.$this->PanelTag.$_SESSION["IdPrfx"].$FSelNam.'").append(
                        $("<option></option>") // Yes you can do this.
                        .text("Select an Item ...")
                        .val("")
                    );
                    $.each(response.data, function(index, item) { // Iterates through a collection
                        // if cathegory is present
                        CatTxt=(item.'.$FSel.'CatNam)? item.'.$FSel.'CatNam + "/" : "";
                        $("#'.$this->PanelTag.$_SESSION["IdPrfx"].$FSelNam.'")
                            .append( // Append an object to the inside of the select box
                                $("<option></option>") // Yes you can do this.
                                .text(CatTxt + item.Nam + " (" + item.'.$_SESSION["IdPrfx"].$FSel.' + ")")
                                .val(item.'.$_SESSION["IdPrfx"].$FSel.')
                            );
                    });
                }
            });
        },
        ';
        }
    }
    ?>

