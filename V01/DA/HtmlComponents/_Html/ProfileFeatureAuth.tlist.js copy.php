<script type="text/javascript" ref="<?php echo $this->JSPanelNamSpace; ?>">
<?php echo $this->JSPanelNamSpace; ?> = {
    FE      : '<?php echo $this->FE; ?>', // FE: Fundamental Entity
    FEFs    : '<?php echo $this->FEFs; ?>',  
    DEs     : '<?php echo $this->DEs; ?>',
    DEFs    : '<?php echo $this->DEFs; ?>',  
    EFs     : '<?php echo $this->EFs; ?>',  
    FV      : 'IdProfile', // filter vector. CS list of fields and values to filter refresh and delete ops.
    // whoIAm: this.FE+'Tlist',
    // PanelTag: this.whoIAm + '_',
    // filters
    SearchIds: '',
    IdProfile: '',
    // std UI
    Table: null,
    Mode: "<?php echo $this->Mode; ?>",
    PageLength: "<?php echo $this->PageLength; ?>",
    DetailPanels: "<?php echo $this->DetailPanels; ?>",
    ParentObj: '<?php echo $this->ParentObj; ?>',
    ParentObjType: '<?php echo $this->ParentObjType; ?>',
    RefPanels: "<?php echo $this->RefPanels; ?>",
    SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
    FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',

    <?php 
        $InRefArr=explode(',',$this->InRefs);
        foreach ($InRefArr as $InRef) {
            include($_SESSION["ContentCommonRelPath"].$_SESSION["InRefJs"]); 
        }
    ?>

    // obsolete: chuncked code
    // Set<?php echo $this->InRefs; ?>: function(data) {
    //     <?php echo $this->JSPanelNamSpace; ?>.Id<?php echo $this->InRefs; ?> = data["Id<?php echo $this->InRefs; ?>"];
    //     $("#<?php echo $this->PanelTag; ?>Id<?php echo $this->InRefs; ?>").val(data["Id<?php echo $this->InRefs; ?>"]);
    //     $("#<?php echo $this->PanelTag; ?><?php echo $this->InRefs; ?>Nam").val(data["Nam"]);
    //     <?php echo $this->JSPanelNamSpace; ?>.SearchIds = (data["SearchIds"]) ? data["SearchIds"] : null;

    //     <?php echo $this->JSPanelNamSpace; ?>.Refresh();

    //     // da.ProfileFeatureAuthRead.IdProfile=data["IdProfile"];
    //     // alert(da.ProfileFeatureAuthTlist.DetailPanels);
    //     da.RefreshDetailPanels(<?php echo $this->JSPanelNamSpace; ?>.DetailPanels, "Set<?php echo $this->InRefs; ?>", data);
    // },

    // Clean<?php echo $this->InRefs; ?>: function() {
    //     <?php echo $this->JSPanelNamSpace; ?>.Id<?php echo $this->InRefs; ?> = '';
    //     $("#<?php echo $this->PanelTag; ?>Id<?php echo $this->InRefs; ?>").val('');
    //     $("#<?php echo $this->PanelTag; ?><?php echo $this->InRefs; ?>Nam").val('');
    //     <?php echo $this->JSPanelNamSpace; ?>.SearchIds = "";
    //     // da.RefreshObj("<?php echo $this->FE; ?>List");
    //     <?php echo $this->JSPanelNamSpace; ?>.Refresh();

    //     // da.ProfileFeatureAuthRead.IdProfile='';
    //     da.RefreshDetailPanels(<?php echo $this->JSPanelNamSpace; ?>.DetailPanels, "Clean<?php echo $this->InRefs; ?>
    //     ");
    // },

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["TlistRefreshJs"]); ?>

    // FM Filter Matrix 
    // return json string
    // this is specific for this Tlist panel of ProfileFeatureAuth
    // Filters are dependent from References, Parent entities, specific settings for the panel.
    // A FV (Filter vector) should be placed in the navigation data
    // FV should be composed, once and for all, out of run time.
    // FM is dependent from interaction data, so it canNOT be moved to the PHP content builder
    // code chunk could be field by the php Content Builder
    GetFMJson: function(FV) {
        FVArr = FV.split(',');
        // DEPRECATED
        // data = $.map(FVArr, function(value, index) {
        //     FField='"<?php echo $this->FE; ?>.'+value+'"';
        //     // alert(FField);
        //     // FValueField="\"'\"+<?php echo $this->JSPanelNamSpace; ?>."+value+"+\"'\"";
        //     eval("FValueField=<?php echo $this->JSPanelNamSpace; ?>."+value+";");
        //     alert(FValueField);
        //     return FField+': {"filterRel":"", "filterType" : "NoN", "filterValues" : "'+FValueField+'"},';
        // });

        data = {
            "<?php echo $this->FE; ?>.IdProfile": {"filterRel":'', "filterType" : 'NoN', "filterValues" : "'"+<?php echo $this->JSPanelNamSpace; ?>.IdProfile+"'"},
        };
        // alert(JSON.stringify(data));
        // {"ProfileFeatureAuth.IdProfile":{"filterRel":"","filterType":"NoN","filterValues":""}}
        // {"ProfileFeatureAuth.IdProfile":{"filterRel":"","filterType":"NoN","filterValues":"''"}}
        // ["\"ProfileFeatureAuth.IdProfile\": {\"filterRel\":\"\", \"filterType\" : \"NoN\", \"filterValues\" : \"2\"},"]
        return JSON.stringify(data);
    },

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["SrvOpParamsJs"]); ?>

    // prepare the SrvOpParams
    // Dependent from 
    //      GetFMJson if necessary or empty string
    //      GetFMJson for Save op
    // GetSrvOpParams: function(SrvOpNam) {
    //     data = {
    //         "SrvOpNam"  : SrvOpNam, 
    //         "FE"        : '<?php echo $this->FE; ?>', 
    //         "FEFs"      : '<?php echo $this->FEFs; ?>',
    //         "DEs"       : '<?php echo $this->DEs; ?>',
    //         "DEFs"      : '<?php echo $this->DEFs; ?>',  
    //         "EFs"       : '<?php echo $this->EFs; ?>',  
    //         "FM"        : <?php echo $this->JSPanelNamSpace; ?>.GetFMJson(<?php echo $this->JSPanelNamSpace; ?>.FV),
    //         "VM"        : (SrvOpNam=="Save")? <?php echo $this->JSPanelNamSpace; ?>.GetFEFsJson() : null,
    //     };
    //     return data;
    // },

    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["TlistToggleJs"]); ?>

}

$(document).ready(function() {

    <?php echo $this->JSPanelNamSpace; ?>.Refresh();
    // Tlist events
    $("#<?php echo $this->FE; ?>List tbody").on("click", "tr", function() {
        <?php echo $this->JSPanelNamSpace; ?>.ToggleRow(this);
    });
    // btn events
    $("#<?php echo $this->PanelBtnsNam; ?> #btnRefresh").click(function() {
        // alert("Update tabella");
        <?php echo $this->JSPanelNamSpace; ?>.Refresh();
    });
})
</script>