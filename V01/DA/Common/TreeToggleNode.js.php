<?php
echo'
    /**
    Toggle, set and clean functions for Std Tlist panel
    */
    ToggleNode: function(obj) {
        // alert($(obj).attr("id"));
        ulId = $(obj).attr("id");
        ulIdPar = $(obj).attr("idPar");
        // if ($(obj).hasClass("hidden")) {
        //     $(obj).removeClass("hidden");
        if ($("#parUl" + ulIdPar).hasClass("hidden")) {
            $("#parUl" + ulIdPar).removeClass("hidden");
            // alert("Not hidden");
            // da_dataTree.Clean();
            $("#parUl" + ulId).slideToggle();
            $("#" + ulId + " i").removeClass("fa-chevron-right");
            $("#" + ulId + " i").addClass("fa-chevron-down");
        } else {
            // alert("hidden");
            // table.$("tr.selected").removeClass("selected");
            $("#parUl" + ulIdPar).addClass("hidden");
            // $("#parUl"+parUlId).hide();
            $("#parUl" + ulId).slideToggle();
            $("#" + ulId + " i").removeClass("fa-chevron-down");
            $("#" + ulId + " i").addClass("fa-chevron-right");
        }
    },
';
?>