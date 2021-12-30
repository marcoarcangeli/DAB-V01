    // FSels Js
    // Fields select drop-down boxes
    // Dependencies: 
    //      - ...
    get<?php echo $FSel; ?>select: function() {
        $.ajax({
            url: "<?php echo $_SESSION["HtmlComponentsRelPath"]; ?><?php echo $FSel; ?>/Tlist.proxy.php",
            type: "POST",
            dataType: "json",
            async: true,
            data: "data",
            success: function(response) {
                // alert("popola select records: "+response.data.length);
                $("#<?php echo $this->PanelTag; ?>Id<?php echo $FSel; ?>").empty();
                $("#<?php echo $this->PanelTag; ?>Id<?php echo $FSel; ?>").append(
                    $("<option></option>") // Yes you can do this.
                    .text("Select an Item ...")
                    .val("")
                );
                $.each(response.data, function(index, item) { // Iterates through a collection
                    // if cathegory is present
                    CatTxt=(item.<?php echo $FSel; ?>CatNam)? item.<?php echo $FSel; ?>CatNam + "/" : '';
                    $("#<?php echo $this->PanelTag; ?>Id<?php echo $FSel; ?>")
                        .append( // Append an object to the inside of the select box
                            $("<option></option>") // Yes you can do this.
                            .text(CatTxt + item.Nam + " (" + item.Id<?php echo $FSel; ?> + ")")
                            .val(item.Id<?php echo $FSel; ?>)
                        );
                });
                // $("#An_IdPrjState").val( php echo $this->IdPrjState; ?>);
            }
        });
    },
