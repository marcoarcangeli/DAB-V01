da = {
    Wait: false,

    sortArray: function (arr, prop, asc) {
        arr.sort(function (a, b) {
            if (asc) {
                return (a[prop] > b[prop]) ? 1 : ((a[prop] < b[prop]) ? -1 : 0);
            } else {
                return (b[prop] > a[prop]) ? 1 : ((b[prop] < a[prop]) ? -1 : 0);
            }
        });
    }
    ,
    UsrMsgShow: function (UsrMsg, UsrMsgTitle) {
        // $("#UsrMsg").val(UsrMsg);
        // $("#UsrMsgTitle").html(UsrMsgTitle);
        // $("#UsrMsg").html(UsrMsg);
        // $("#modal-info").modal("show");
        $("#UsrMsgTitlePrime").html(UsrMsgTitle);
        $("#UsrMsgPrime").html(UsrMsg);
        $("#modal-primary").modal("show");
    }
    ,
    // WaitToggle: function (UsrMsg='Wait ...', UsrMsgTitle='Operation execution ...') {
    //     if(da.Wait){
    //         da.Wait=false;
    //         $('#modal-spin').modal('hide');
    //     }else{
    //         da.Wait=true;
    //         $('#modal-spin').modal('show');
    //     }
    // }
    // ,
    ContentShow: function (UsrMsg, UsrMsgTitle) {
        // $("#UsrMsg").val(UsrMsg);
        // $("#UsrMsgTitle").html(UsrMsgTitle);
        // $("#UsrMsg").html(UsrMsg);
        // $("#modal-info").modal("show");
        $("#UsrMsgTitleXl").html(UsrMsgTitle);
        $("#UsrMsgXl").html(UsrMsg);
        $("#modal-xl").modal("show");
    }
    ,
    contentToModal: function () {
        // $("#UsrMsg").val(UsrMsg);
        $("#modalContent").html($("#contentWrapper").html());
        $("#modal-xl").modal("show");
    }
    ,
    cleanMasterNavigationParams: function () {
        // $("#UsrMsg").val(UsrMsg);
        $("#ContentClass").val("");
        $("#ContentHeaderParams2").val("");
        $("#ContentHeaders1matrix").val("");
        $("#ContentClass2matrix").val("");
        $("#ContentHeaders2matrix").val("");
        $("#ContentParams2matrix").val("");
    }
    ,
    cleanSessionNavigationParams: function () {
        $_SESSION["ContentClass"] = "";
        $_SESSION["ContentHeaderParams2"] = array();
        $_SESSION["ContentHeaders1matrix"] = array();
        $_SESSION["ContentClass2matrix"] = array();
        $_SESSION["ContentHeaders2matrix"] = array();
        $_SESSION["ContentParams2matrix"] = array();
        // $_SESSION["#UsrMsg"] = "";
    }
    ,
    formatFileSize: function (bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }
    ,
    // multiple Objs: string lists; 
    // only 1 Function string, data array
    NotifyObjs: function (Objs, Fun, data = null) {
        if (Objs != "") {
            var ObjsArr = Objs.split(',');
            d = (data) ? "data" : "";

            var strFunsArr = $.map( ObjsArr, function( Obj, index ) {
                return "da." + Obj + "." + Fun + "("+d+")";
            });
            // alert(JSON.stringify(strFunsArr));
            // the following for could be parallel
            for (const strFun of strFunsArr) {
                // alert(strFun);
                eval(strFun);
            }
        }
    }
    ,
    // OBSOLETE
    RefreshDetailPanels: function (DetailPanels, fun, data = null) {
        if (DetailPanels != "") {
            var PanelArr = DetailPanels.split(',');

            for (const Panel of PanelArr) {
                // ex, da.UsrRead.Set(data)
                if (data) {
                    strFun = "da." + Panel + "." + fun + "(data)";
                } else {
                    strFun = "da." + Panel + "." + fun + "()";
                }
                // alert(strFun);
                eval(strFun);
            }
        }
    }
    ,
    /**
     * OBSOLETE
     * ObjType: Tlist, Tree, ...
     */
    RefreshObj: function (ObjsNam, ObjType = "Tlist", ObjFun = "reload", data = null) {
        // alert(ObjsNam);
        // alert(ObjType);
        if (ObjsNam != "") {
            var PanelArr = ObjsNam.split(',');
            var TypeArr = ObjType.split(',');
            var FunArr = ObjFun.split(',');
            i=0;
            for (const Panel of PanelArr) {
                Type = TypeArr[i];
                Fun  = FunArr[i];
                // alert('TypeArr: '+TypeArr[i]);
                // alert('FunArr: '+FunArr[i]);
                if (ObjType == "Tlist") {
                    // alert(ObjsNam);
                    $("#" + ObjsNam).DataTable().ajax.reload(null, false);
                } else {
                    if (data) {
                        strFun = "da." + Panel + "." + Fun + "(data)";
                    } else {
                        strFun = "da." + Panel + "." + Fun + "()";
                    }
                    // alert(strFun);
                    eval(strFun);
                }
                // ex, da.UsrRead.Set(data)
                i++;
            }
        }

    }
    ,
    /*
        CompulsoryFieldsList: list of comma separated panel field names, with or without panel Tag
            ex. without PanelTag:   "Nam,IdAlgState,IdAlgCat"
            ex. with PanelTag:      "Alg_Nam,Alg_IdAlgState,Alg_IdAlgCat"
        PanelTag: prefix for names disambiguation in a multipanel page. Default is empty string.
            ex. "Alg_"
        return: True: all compulsory fields are filled; False: at least one compulsory field is not filled.
     */
    verifyCompulsoryFields: function (CompulsoryFields, PanelTag = '') {
        // alert(CompulsoryFields);
        // alert(PanelTag);
        var msg = '';
        if (CompulsoryFields && CompulsoryFields != "") {
            var Fields = CompulsoryFields.split(',');
            for (var Field of Fields) {
                var FieldName = PanelTag + Field;
                // alert($("#"+FieldName).val());
                if ($("#" + FieldName).val() == '') {
                    // alert(ObjsNam);
                    msg += Field + ', ';
                }
            }
        }
        if (msg == '') {
            return true;
        } else {
            msg = "Compulsory Fields (" + msg.substr(0, msg.length - 2) + ") must be filled !";
            da.UsrMsgShow(msg, "Info");
            return false;
        }
    }
    ,
    getLevel: function (arr, ParentNodeId, IdNam, ParIdNam, PanelTag = '') {

        var html = '';
        // alert("Parent id: "+ParentNodeId)

        var searchIds = '';
        if (ParentNodeId != null) {
            searchIds = ParentNodeId;
        }

        var children = $.grep(arr, function (ar) {
            // alert(ar["IdParamTypeCatPar"]);
            // s='IdParamTypeCatPar';
            return ar[ParIdNam] == ParentNodeId;
        });
        // alert("n children: "+children.length);
        da.sortArray(children, "Nam", true);
        // alert("children: "+children);
        if (children.length > 0) {
            // render livello
            html += '<ul class="daTree" id="parUl' + PanelTag + ParentNodeId + '">';
            for (var c in children) {
                // alert(children[c]["IdParamTypeCat"]);
                childArr = da.getLevel(arr, children[c][IdNam], IdNam, ParIdNam, PanelTag);
                // alert(childArr["html"]);
                // alert(childArr["searchIds"]);

                searchIds += ", " + children[c][IdNam];
                // alert("c: "+c);
                // alert('id='+children[c]["IdParamTypeCat"] + '">'+children[c]["Nam"]+" parent: "+children[c]["IdParamTypeCatPar"]+" Descr: "+children[c]["Descr"]);
                html += '<li ><a href="#" ><div id="' + PanelTag + children[c][IdNam]
                    + '" val="' + children[c][IdNam]
                    + '" idPar="' + PanelTag + children[c][ParIdNam]
                    + '" searchIds="' + returnArr["searchIds"] + '">';
                html += '<i class="fas fa-chevron-down"></i>';
                html += children[c]["Nam"];
                html += '</div></a>';
                html += childArr["html"];
                html += '</li>';
            }
            html += '</ul>';
        }
        returnArr = { "html": html, "searchIds": searchIds };
        // alert(returnArr["html"]);
        // alert(returnArr["searchIds"]);

        return returnArr;
    }
    ,
    basename: function (path) {
        return path.replace(/.*\//, '');
    }
    ,
    dirname: function (path) {
        return path.match(/.*\//);
    }
    ,
    /*
    dependencies.
    - specific structure of card from AdminLTE
    - da-col-sm attributi in button element
    - css vertical-text class settings
    - button element structure
    - da-column class in card container parent
    */
    CardCollapseHorizontal: function (event) {
        o = $(event.target).parent();
        if (!o.is("button")) {
            o = $(event.target).closest("button");
        }
        myCard = o.closest(".card");
        //cleaning display style param
        myCard.find(".card-body").css('display', '');
        myCard.find(".card-body").toggleClass('daHidden');
        // managing card display
        // cardH=myCard.find(".card-header");
        myCard.find(".card-header").toggleClass('da-min-width');
        myCard.find(".card-tools").toggleClass('da-min-width');
        // card-tools width 20px
        // vertical-text left=-140px
        myCard.find(".da-card-info").toggleClass('daHidden');
        myCard.find(".card-title").toggleClass('daHidden');
        // myCard.find(".card-tools").toggleClass('da-min-width');
        t = myCard.find(".card-title").first().text();
        myCard.find("[data-card-widget='collapse']").toggleClass('daHidden');
        myCard.find("[data-card-widget='maximize']").toggleClass('daHidden');

        // gestione colonna
        myCol = myCard.closest(".da-column");
        daColSm = o.attr("da-col-sm");
        //alert(daColSm);
        myCol.toggleClass(daColSm + ' col-sm-0');
        //myCard.find(".da-collapse-horizontal").toggleClass('vertical-text');
        o.toggleClass('vertical-text');
        currentHtml = o.html();
        defaultHtml = '<i class="fas fa-arrow-left"></i>';
        if (currentHtml == defaultHtml) {
            o.html('<i>' + t.substring(0, 48) + '</i>');
        } else {
            o.html(defaultHtml);
        }
    }
    ,
    /* to test */
    GetCurrentDaColSmWidth: function (daCol) {
        daColSm = daCol.attr("class").match(/col-sm-(.*)/g);
        alert(daColSm);
        // save original daColSm
        daColSmWidth = daColSm.replace("col-sm-", "");
        alert(daColSmWidth);
        return daColSmWidth;
    }
    ,
    LineActiveCols: null,
    LineStdWidth: 12,

    /* to test */
    GetDaLineFreeWidth: function (daCols) {
        daLineFreeWidth = da.LineStdWidth;
        da.LineActiveCols = daCols;
        for (daCol in daCols) {
            daColSmWidth = da.GetCurrentDaColSmWidth(daCol); // numero intero
            if (daColSmWidth > 0) {
                daCol.attr("da-col-sm-orig", daColSmWidth);
                daLineFreeWidth -= daColSm;
            } else {
                i = daCols.indexOf(daCol);
                //alert(i);
                da.LineActiveCols.splice(i, 1);
            }
        }

        return daLineFreeWidth;
    }
    ,
    /* to test */
    SetDaLineOriginalWidth: function (daCols) {
        for (daCol in daCols) {
            daColSmWidthNew = daCol.attr("da-col-sm-orig"); // numero intero
            if (daColSmWidthNew > 0) {
                daColSmWidth = da.GetCurrentDaColSmWidth(daCol); // numero intero
                daCol.toggleClass(' col-sm-' + daColSmWidth + ' col-sm-' + daColSmWidthNew);
            }
        }
        return true;
    }
    ,
    /* to test
     daCols: array of daLine cols
     lastIndex: index in the daCol array of the last modified daCol
    */
    SetDaLineWidths: function (daLineFreeWidth) {
        daLineFreeWidthCheck = da.LineStdWidth;
        daCols = da.LineActiveColsCols; // active cols only
        //daLineFreeWidth=da.GetDaLineFreeWidth(daCols);
        lastIndex = -1; // arrays are zero based
        // calc scaling factor
        //sf=Math.abs(daLineFreeWidth/daCols.length);
        sf = daLineFreeWidth / daCols.length; // must be positive

        for (daCol in daCols) {
            // get daColSmWidth original
            daColSmWidth = daCol.attr("da-col-sm-orig"); // numero intero
            // if = 0
            if (daColSmWidth == 0) {
                // get current
                daColSmWidth = da.GetCurrentDaColSmWidth(daCol); // numero intero
            }
            lastIndex = daCols.indexOf(daCol);

            if (daColSmWidth > 0) {
                // new da col width
                daColSmWidthNew = round(daColSmWidth * sf);
                if (daColSmWidthNew == 0) {
                    daColSmWidthNew = 1;
                }
                daLineFreeWidthCheck -= daColSmWidthNew;
                // se vi è uno scarto negativo : dovrebbe sempre essere l'ultimo
                if (daLineFreeWidthCheck < 0) {
                    // scarto complemento a 12
                    daColSmWidthNew = da.LineStdWidth + daColSmWidthNew - daLineFreeWidthCheck;
                }
                //swap da col width
                daColSm = daCol.attr("class").match(/col-sm-(.*)/g);
                daCol.toggleClass(daColSm + ' col-sm-' + daColSmWidthNew);
                alert(daColSm + ' col-sm-' + daColSmWidthNew);

            } else {
                alert("daColSmWidth errato alla colonna " + lastIndex);
            }

        }
        // normalize to 12
        if (daLineFreeWidth > 0) {
            if (lastIndex > -1) {
                daColSmWidthNew = daLineFreeWidth;
                daColSm = daCols[lastIndex].attr("class").match(/col-sm-(.*)/g);
                daCols[lastIndex].toggleClass(daColSm + ' col-sm-' + daColSmWidthNew);
            }

        }

        return true;
    }
    ,
    /* to test
    dependencies.
    - da-line su linea accordion
    */
    DistributeLineWidth: function (event) {
        o = $(event.target);
        // find current da-column
        daColumn = o.closest(".da-column");
        // find da-line
        daLine = o.closest(".da-line");
        // find all da-columns
        daCols = daLine.find(".da-column");
        alert(daCols.length);
        // verify line state
        daLineFreeWidth = da.GetDaLineFreeWidth(daCols);
        // if positive free width
        if (daLineFreeWidth != 0) {
            da.SetDaLineWidths(daLineFreeWidth);
        } else {
            // if negative free width
            da.SetDaLineOriginalWidth(daCols);
            // set originals
            // for(daCol in daCols){
            //     daColSmWidth=daCol.attr("da-col-sm-orig");

            //     if(daColSmWidth > 0){
            //         daColSmWidth=daCol.attr("da-col-sm-orig");
            //         // new da col width
            //         daColSmWidthNew=round(daColSmWidth*sf);
            //         daLineBusyWidth -= daColSmWidthNew;
            //         // se vi è uno scarto negativo : dovrebbe sempre essere l'ultimo
            //         if(daLineBusyWidth < 0){
            //             // scarto complemento a 12
            //             daColSmWidthNew = da.LineStdWidth + daColSmWidthNew - daLineBusyWidth;
            //         }
            //         //swap da col width
            //         daColSm=daCol.attr("class").match(/col-sm-(.*)/g);
            //         daCol.toggleClass(daColSm +' col-sm-' + daColSmWidthNew);
            //         alert(daColSm +' col-sm-' + daColSmWidthNew);
            //         lastIndex = daCols.indexOf(daCol);
            //     }
            // }

        }
        daColSm = o.attr("da-col-sm");
        //alert(daColSm);
        myCol.toggleClass(daColSm + ' col-sm-0');
        //myCard.find(".da-collapse-horizontal").toggleClass('vertical-text');
        o.toggleClass('vertical-text');
        currentHtml = o.html();
        defaultHtml = '<i class="fas fa-arrow-left"></i>';
        if (currentHtml == defaultHtml) {
            o.html('<i>' + t.substring(0, 48) + '</i>');
        } else {
            o.html(defaultHtml);
        }
    }
    ,
    SetUploadfileParams: function (data, panelName) {
        $("#"+panelName+"_UploadFiles #dstFolder").val(data["DstFolder"]);
        $("#"+panelName+"_UploadFiles #uplName").val(data["UplName"]);
        $("#"+panelName+"_UploadFiles #AllowedUploadFileExt").val(data["AllowedUploadFileExt"]);
        // alert($("#"+panelName+"_UploadFiles #dstFolder").val());
    }
    ,
    CleanUploadfileParams: function (panelName) {
        $("#"+panelName+"_UploadFiles #dstFolder").val('');
        $("#"+panelName+"_UploadFiles #uplName").val('');
        $("#"+panelName+"_UploadFiles #AllowedUploadFileExt").val('');
        // alert($("#"+panelName+"_UploadFiles #uplName").val());
    }
    ,

}

$(".da-collapse-horizontal").click(function (event) {
    //alert('collapse');
    da.CardCollapseHorizontal(event);
});

