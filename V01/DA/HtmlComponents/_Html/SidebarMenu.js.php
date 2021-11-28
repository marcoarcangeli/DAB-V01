<script type="text/javascript" ref="SidebarMenu">
    $(document).ready(function() {

        $("#sbiAlgs").click(function() {
            da.navigation.Algs();
        })
        
        $("#sbiCntxsAlgs").click(function() {
            alert("Feature not available in DAB v0.");
        })

        $("#sbiPrjs").click(function() {
            da.navigation.Prjs();
        })

    })
</script>