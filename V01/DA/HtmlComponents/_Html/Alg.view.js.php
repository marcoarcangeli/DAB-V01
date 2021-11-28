<script type="text/javascript" ref="da.AlgRead">
    da.AlgRead = {

        PanelTag: 'Alg_',
        IdAlg: '',
        IdAlgCat: '',
        CompulsoryFields: '<?php echo $this->CompulsoryFields; ?>',
        Mode: '<?php echo $this->Mode; ?>',
        ParentObj: '<?php echo $this->ParentObj; ?>',
        SuccessMsg: '<?php echo $_SESSION["SuccessMsg"]; ?>',
        FailMsg: '<?php echo $_SESSION["FailMsg"]; ?>',
        
        btnControl: function() {
            if($("#Alg_IdAlg").val()==""){
                $("#Alg_btnRefresh").attr("disabled", true);
                // $("#Alg_btnDelete").attr("disabled", true);
            }else{
                $("#Alg_btnRefresh").attr("disabled", false);
                // $("#Alg_btnDelete").attr("disabled", false);
            }
        },

        Get: function() {
            data= {
                IdAlg       : $("#Alg_IdAlg").val(),
                IdAlgCat    : $("#Alg_IdAlgCat").val(),
                AlgCatNam   : $("#Alg_AlgCatNam").val(),
                IdAlgState  : $("#Alg_IdAlgState").val(),
                // AlgStateNam : $("#Alg_AlgStateNam").val(),
                Nam         : $("#Alg_Nam").val(),
                Descr       : $("#Alg_Descr").val(),
                fileRefProc : $("#Alg_fileRefProc").val()
            };
            return data;
        },


        Set: function(data) {
            $("#Alg_IdAlg").val(data["IdAlg"]);
            $("#Alg_IdAlgCat").val(data["IdAlgCat"]);
            $("#Alg_AlgCatNam").val(data["AlgCatNam"]);
            $("#Alg_IdAlgState").val(data["IdAlgState"]);
            // $("#Alg_AlgStateNam").val(data["AlgStateNam"]);
            $("#Alg_Nam").val(data["Nam"]);
            $("#Alg_Descr").val(data["Descr"]);
            $("#Alg_fileRefProc").val(data["fileRefProc"]);

            da.AlgRead.btnControl();
        },

        Clean: function() {
            $("#Alg_IdAlg").val("");
            if(da.AlgRead.IdAlgCat == ''){
                $("#Alg_IdAlgCat").val("");
                $("#Alg_AlgCatNam").val("");
            }
            $("#Alg_IdAlgState").val("1");
            // $("#Alg_AlgStateNam").val("");
            $("#Alg_Nam").val("");
            $("#Alg_Descr").val("");
            $("#Alg_fileRefProc").val("");

            da.AlgRead.btnControl();
        },

        SetAlgCat: function(data) {
            $("#Alg_IdAlgCat").val(data["IdAlgCat"]);
            $("#Alg_AlgCatNam").val(data["AlgCatNam"]);

            da.AlgRead.btnControl();
        },

        CleanAlgCat: function() {
            $("#Alg_IdAlgCat").val('');
            $("#Alg_AlgCatNam").val('');
            da.AlgRead.btnControl();
        },

        SetRef: function(data) {
            $("#Alg_fileRefProc").val(data["FileRef"]);
            da.AlgRead.btnControl();
        },

        CleanRef: function() {
            $("#Alg_fileRefProc").val('');
            da.AlgRead.btnControl();
        },

        Refresh: function() {
            try {
                return $.ajax({
                    type: "GET",
                    url: "DA/HtmlComponents/Alg/read.proxy.php?IdAlg=" + da.AlgRead.IdAlg,
                    dataType: "json",
                    error: function(result) {
                        da.UsrMsgShow(da.AlgRead.FailMsg, "Info");
                    },
                    success: function(result) {
                        // alert("success: "+result["State"]);
                        // alert("success: "+result["Msg"]);
                        data=result["Data"];
                        da.AlgRead.Set(data);
                    },
                })
            } catch (e) {
                da.UsrMsgShow(e.message, "Exception");
            }

        },

        IdAlgState_Select: function() {
            return $.ajax({
                url: "DA/HtmlComponents/AlgState/Tlist.proxy.php",
                type: "POST",
                dataType: "json",
                async: true,
                data: "data",
                success: function(response) {
                    // alert("popola select records: "+response.data.length);
                    $("#Alg_IdAlgState").empty();
                    $("#Alg_IdAlgState").append(
                        $("<option></option>") 
                        .text("Select an Item ...")
                        .val("")
                    );
                    $.each(response.data, function(index, item) { // Iterates through a collection
                        $("#Alg_IdAlgState").append( // Append an object to the inside of the select box
                            $("<option></option>") // Yes you can do this.
                            .text(item.IdAlgState + " - " + item.Nam)
                            .val(item.IdAlgState)
                        );
                    });
                }
            });
        },

    }
    $(document).ready(function() {

        //popola select | tree ...
        da.AlgRead.IdAlgState_Select();

        // set defaults
        da.AlgRead.Clean();

        $("#Alg_btnRefresh").click(function() {
            da.AlgRead.Refresh();
        });

    })
</script>