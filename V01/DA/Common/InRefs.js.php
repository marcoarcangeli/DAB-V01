<?php 
// Set and Clean a Ref param
// Dependencies: btnControl
/* ex.
SetAlgCatPar: function(data=null) {
    da.AlgCatRead.IdAlgCatPar = (data)?data["IdAlgCatPar"]:"";
    $("#AlgCatRead_IdAlgCatPar").val((data)?data["IdAlgCatPar"]:"");
    NamField = (da.AlgCatRead.Mode == "TlistPar") ? "AlgCatParNam" : "Nam";
    $("#AlgCatRead_AlgCatParNam").val((data)?data[NamField]:"");
    
    if("Read" == "Tlist"){
        // PanelType: Tlist
        da.AlgCatRead.SearchIds = (data) ? data["SearchIds"] : "";
        da.AlgCatRead.Refresh();
    }else{ 
        // rx: PanelType: Read
        if ( $.isFunction(da.AlgCatRead.btnControl) ) {
            da.AlgCatRead.btnControl();
        }
    }
},
*/

    if(isset($this->InRefs) && $this->InRefs !== ''){
        $InRefArr=explode(',',$this->InRefs);
        foreach ($InRefArr as $InRef) {
            // include($_SESSION["ContentCommonRelPath"].$_SESSION["InRefJs"]); 
            echo'
    Set'.$InRef.': function(data=null) {
        if(data){
            if(typeof(data["FileNam"]) !== "undefined" && data["FileNam"]){
                // '.$this->JSPanelNamSpace.'.FileRef'.$_SESSION["IdPrfx"].$InRef.' = (data)?data["FileRef"]:"";
                $("#'.$this->PanelTag.$_SESSION["IdPrfx"].$InRef.'").val((data)?data["FileRef"]:"");
                $("#'.$this->PanelTag.'FileRef'.$InRef.'").val((data)?data["FileRef"]:"");
                $("#'.$this->PanelTag.$InRef.$_SESSION["DEFNam"].'").val((data)?data["FileNam"]:"");
            }else{
                '.$this->JSPanelNamSpace.'.'.$_SESSION["IdPrfx"].$InRef.' = (data)?data["'.$_SESSION["IdPrfx"].$InRef.'"]:"";
                $("#'.$this->PanelTag.''.$_SESSION["IdPrfx"].$InRef.'").val((data)?data["'.$_SESSION["IdPrfx"].$InRef.'"]:"");
                $("#'.$this->PanelTag.$_SESSION["DEFNam"].'").val((data)?data["'.$_SESSION["DEFNam"].'"]:"");
            }
        }

        if("'.$this->PanelType.'" == "Tlist"){
            // PanelType: Tlist
            '.$this->JSPanelNamSpace.'.SearchIds = (data) ? data["SearchIds"] : "";
            '.$this->JSPanelNamSpace.'.Refresh();
        }else{ 
            // rx: PanelType: Read
            if ( $.isFunction('.$this->JSPanelNamSpace.'.btnControl) ) {
                '.$this->JSPanelNamSpace.'.btnControl();
            }
        }
    },
            ';
        }
    }
?>

