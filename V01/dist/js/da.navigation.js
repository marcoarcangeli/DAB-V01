da.navigation = {
    Home: function () {
        try {
            da.cleanSessionNavigationParams;

            $("#ContentClass").val("DA\\HtmlComponents\\App\\Welcome");

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    About: function () {
        try {
            da.cleanSessionNavigationParams;

            $("#ContentClass").val("DA\\HtmlComponents\\App\\About");

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,

    Algs: function (UsrMsg, UsrMsgTitle) {
        try {
            da.cleanSessionNavigationParams;
            // container
            $("#ContentClass").val("DA\\HtmlComponents\\GridAccordion2D");
            // parametri per container
            // ContentHeaderParams = "Algs: " + $("#Alg_IdAlg").val() + " - " + $("#Alg_Nam").val();
            ContentHeaderParams = "Algorithms";
            $("#ContentHeaderParams").val(ContentHeaderParams);
            // linee
            var ContentHeaders1matrix = ["Algorithm", "Algorithm Procedure", "Algorithm Params Type"];
            // alert(JSON.stringify(ContentHeaders1matrix));
            $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // Intestazioni per ciascuna linea orizzontale
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0]  = ["AlgCats", "Algs","AlgRead"];
            ContentHeaders2matrix[1]  = ["ProcsRepo", "ProcFileView"];
            ContentHeaders2matrix[2]  = ["ParamTypeCats","ParamTypes","AlgParamTypes", "AlgParamTypeRead"];
            // alert(JSON.stringify(ContentHeaders2matrix));
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // classi per ciascuna linea orizzontale
            var ContentClass2matrix = [];
            ContentClass2matrix[0]  = ["DA\\HtmlComponents\\AlgCat\\Tree", "DA\\HtmlComponents\\Alg\\Tlist","DA\\HtmlComponents\\Alg\\Read"];
            ContentClass2matrix[1]  = ["DA\\HtmlComponents\\Proc\\FileTlist", "DA\\HtmlComponents\\Proc\\FileView"];
            ContentClass2matrix[2]  = ["DA\\HtmlComponents\\ParamTypeCat\\Tree","DA\\HtmlComponents\\ParamType\\Tlist","DA\\HtmlComponents\\AlgParamType\\Tlist","DA\\HtmlComponents\\AlgParamType\\Read"];
            // alert(JSON.stringify(ContentClass2matrix));OpDatTlist
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));
            
            // altri parametri per livello di Detail accordion2D
            var ContentParams2matrix = {};
            //[0]  = ["AlgCats", "Algs","AlgRead"];
            ContentParams2matrix["AlgCats"] = {
                Header: "Algorithm Category", Col_Lg: "2", Mode: "TlistPar", HtmlFn: "AlgCat.Tree.html.php", JsFn: "AlgCat.Tree.js.php",
                DetailPanels: "AlgTlist"
            };
            ContentParams2matrix["Algs"] = {
                Header: "Algorithms", Col_Lg: "3", Mode: "Tlist", HtmlFn: "Alg.Tlist.html.php", JsFn: "Alg.Tlist.js.php",
                DetailPanels: "AlgRead", ParentObj: "AlgCatTree", ParentObjType: "Tree", RefPanels: "AlgParamTypeTlist"
            };
            ContentParams2matrix["AlgRead"] = {
                Header: "Algorithm", Col_Lg: "7", Mode: "Tlist", HtmlFn: "Alg.Read.html.php", JsFn: "Alg.Read.js.php",
                ParentObj: "AlgList", CompulsoryFields: "Nam,IdAlgState,IdAlgCat",
                FE: "Alg", PanelType: "Read"
            };
            //[1]  = ["ProcsRepo", "ProcFileView", "ProcView"];
            ContentParams2matrix["ProcsRepo"] = {
                Header: "Procedures Repository", Col_Lg: "4", Mode: "FileTlist", HtmlFn: "Proc.FileTlist.html.php", JsFn: "Proc.FileTlist.js.php", 
                DetailPanels: "ProcFileView", DetailPanelsType: "FileView", RefPanels: "AlgRead"
            };
            ContentParams2matrix["ProcFileView"] = {
                Header: "Procedure Viewer", Col_Lg: "8", Mode: "alone", HtmlFn: "Proc.FileView.html.php", JsFn: "Proc.FileView.js.php", 
                ParentObj: "ProcsRepo", ParentObjType: "FileTlist"
            };
            //[2]  = ["ParamTypeCats","ParamTypes","AlgParamTypes", "AlgParamTypeRead"];
            ContentParams2matrix["ParamTypeCats"] = {
                Header: "Param Type Categories", Col_Lg: "2", Mode: "TlistPar", HtmlFn: "ParamTypeCat.Tree.html.php", JsFn: "ParamTypeCat.Tree.js.php",
                DetailPanels: "ParamTypeTlist", DetailPanelsType: "TlistPar"
            };
            ContentParams2matrix["ParamTypes"] = {
                Header: "Param Types", Col_Lg: "3", Mode: "TlistPar", HtmlFn: "ParamType.Tlist.html.php", JsFn: "ParamType.Tlist.js.php",
                DetailPanels: "AlgParamTypeTlist", DetailPanelsType: "TlistPar", RefPanels: "AlgParamTypeRead"
            };
            ContentParams2matrix["AlgParamTypes"] = {
                Header: "Algorithm Param Types", Col_Lg: "3", Mode: "Tlist", HtmlFn: "AlgParamType.Tlist.html.php", JsFn: "AlgParamType.Tlist.js.php",
                DetailPanels: "AlgParamTypeRead", DetailPanelsType: "Tlist"
            };
            ContentParams2matrix["AlgParamTypeRead"] = {
                Header: "Algorithm Param Type Detail", Col_Lg: "4",  Mode: "Tlist", HtmlFn: "AlgParamType.Read.html.php", JsFn: "AlgParamType.Read.js.php", 
                ParentObj: "AlgParamTypeList"
            };

            // alert(JSON.stringify(ContentParams2matrix));
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    AlgCat: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\AlgCat\\Tree", "DA\\HtmlComponents\\AlgCat\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["AlgCats", "AlgCatRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["AlgCats"] = {
                Header: "AlgCats", Col_Lg: "4", Mode: "Tlist", HtmlFn: "AlgCat.Tree.html.php", JsFn: "AlgCat.Tree.js.php",
                DetailPanels: "AlgCatRead",
                FE:"AlgCat", FV:"", PanelType:"Tree", InRefs: ""
            };
            ContentParams2matrix["AlgCatRead"] = {
                Header: "AlgCat", Col_Lg: "8", Mode: "Tlist", HtmlFn: "AlgCat.Read.html.php", JsFn: "AlgCat.Read.js.php",
                ParentObj: "AlgCatTree", ParentObjType: "Tree", CompulsoryFields: "Nam",
                FE:"AlgCat", PanelType:"Read", InRefs: "", FSels:""
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    AlgCatTlist: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridVertical");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\AlgCat\\Tlist", "DA\\HtmlComponents\\AlgCat\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["AlgCats", "AlgCatRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["AlgCats"] = {
                Header: "AlgCats", Col_Lg: "12", Mode: "Tlist", HtmlFn: "AlgCat.Tlist.html.php", JsFn: "AlgCat.Tlist.js.php",
                DetailPanels: "AlgCatRead"
            };
            ContentParams2matrix["AlgCatRead"] = {
                Header: "AlgCat", Col_Lg: "12", Mode: "Tlist", HtmlFn: "AlgCat.Read.html.php", JsFn: "AlgCat.Read.js.php",
                ParentObj: "AlgCatList"
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    AlgStates: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\AlgState\\Tlist", "DA\\HtmlComponents\\AlgState\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["AlgStates", "AlgStateRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["AlgStates"] = {
                Header: "AlgStates", Col_Lg: "4", Mode: "Tlist", HtmlFn: "Common.Tlist.html.php", JsFn: "Common.Tlist.js.php",
                DetailPanels: "AlgStateRead",
                FE:"AlgState", FV:"", PanelType:"Tlist", InRefs: ""
            };
            ContentParams2matrix["AlgStateRead"] = {
                Header: "AlgState", Col_Lg: "8", Mode: "Tlist", HtmlFn: "Common.Read.html.php", JsFn: "Common.Read.js.php",
                ParentObj: "AlgStateList",
                FE:"AlgState", PanelType:"Read", InRefs: "", FSels:""
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    AnStates: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\AnState\\Tlist", "DA\\HtmlComponents\\AnState\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["AnStates", "AnStateRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["AnStates"] = {
                Header: "Analysis States", Col_Lg: "4", Mode: "Tlist", HtmlFn: "Common.Tlist.html.php", JsFn: "Common.Tlist.js.php",
                DetailPanels: "AnStateRead",
                FE:"AnState", FV:"", PanelType:"Tlist", InRefs: ""
            };
            ContentParams2matrix["AnStateRead"] = {
                Header: "Analysis State", Col_Lg: "8",  Mode: "Tlist", HtmlFn: "Common.Read.html.php", JsFn: "Common.Read.js.php", 
                ParentObj: "AnStateList",
                FE:"AnState", PanelType:"Read", InRefs: "", FSels:""
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    AuthLevels: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\AuthLevel\\Tlist", "DA\\HtmlComponents\\AuthLevel\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["AuthLevels", "AuthLevelRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["AuthLevels"] = {
                Header: "AuthLevels", Col_Lg: "4", Mode: "Tlist", HtmlFn: "Common.Tlist.html.php", JsFn: "Common.Tlist.js.php",
                DetailPanels: "AuthLevelRead",
                FE:"AuthLevel", FV:"", PanelType:"Tlist", InRefs: ""
            };
            ContentParams2matrix["AuthLevelRead"] = {
                Header: "AuthLevel", Col_Lg: "8", Mode: "Tlist", HtmlFn: "Common.Read.html.php", JsFn: "Common.Read.js.php",
                ParentObj: "AuthLevelList",
                FE:"AuthLevel", PanelType:"Read", InRefs: "", FSels:""
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    Dat_Evnts: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\Dat_Evnt\\FileTlist", "DA\\HtmlComponents\\Dat_Evnt\\FileView"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["Dat_Evnts", "Dat_EvntView"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["Dat_Evnts"] = {
                Header: "Dat_Evnts", Col_Lg: "4", Mode: "FileTlist", HtmlFn: "Dat_Evnt.FileTlist.html.php", JsFn: "Dat_Evnt.FileTlist.js.php",
                DetailPanels: "Dat_EvntView"
            };
            ContentParams2matrix["Dat_EvntView"] = {
                Header: "Dat_EvntView", Col_Lg: "8", Mode: "FileTlist", HtmlFn: "Dat_Evnt.FileView.html.php", JsFn: "Dat_Evnt.FileView.js.php",
                ParentObj: "Dat_EvntList"
            };

            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    EvntCat: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\EvntCat\\Tree", "DA\\HtmlComponents\\EvntCat\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["EvntCats", "EvntCatRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["EvntCats"] = {
                Header: "EvntCats", Col_Lg: "3", Mode: "Tlist", HtmlFn: "EvntCat.Tree.html.php", JsFn: "EvntCat.Tree.js.php",
                DetailPanels: "EvntCatRead"
            };
            ContentParams2matrix["EvntCatRead"] = {
                Header: "EvntCat", Col_Lg: "9", Mode: "Tlist", HtmlFn: "EvntCat.Read.html.php", JsFn: "EvntCat.Read.js.php",
                ParentObj: "EvntCatTree", ParentObjType: "Tree"
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    FeatureCat: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\FeatureCat\\Tree", "DA\\HtmlComponents\\FeatureCat\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["FeatureCats", "FeatureCatRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["FeatureCats"] = {
                Header: "FeatureCats", Col_Lg: "3", Mode: "Tlist", HtmlFn: "FeatureCat.Tree.html.php", JsFn: "FeatureCat.Tree.js.php",
                DetailPanels: "FeatureCatRead"
            };
            ContentParams2matrix["FeatureCatRead"] = {
                Header: "FeatureCat", Col_Lg: "9", Mode: "Tlist", HtmlFn: "FeatureCat.Read.html.php", JsFn: "FeatureCat.Read.js.php",
                ParentObj: "FeatureCatTree", ParentObjType: "Tree"
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    Features: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\FeatureCat\\Tree","DA\\HtmlComponents\\Feature\\Tlist", "DA\\HtmlComponents\\Feature\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["FeatureCats","Features", "FeatureRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["FeatureCats"] = {
                Header: "FeatureCats", Col_Lg: "2", Mode: "TlistPar", HtmlFn: "FeatureCat.Tree.html.php", JsFn: "FeatureCat.Tree.js.php",
                DetailPanels: "FeatureTlist"
            };
            ContentParams2matrix["Features"] = {
                Header: "Features", Col_Lg: "5", Mode: "Tlist", HtmlFn: "Feature.Tlist.html.php", JsFn: "Feature.Tlist.js.php",
                DetailPanels: "FeatureRead", ParentObj: "FeatureCatTree", ParentObjType: "Tree"
            };
            ContentParams2matrix["FeatureRead"] = {
                Header: "Feature", Col_Lg: "5",  Mode: "Tlist", HtmlFn: "Feature.Read.html.php", JsFn: "Feature.Read.js.php", 
                ParentObj: "FeatureList"
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    Logs: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\Log\\FileTlist", "DA\\HtmlComponents\\Log\\FileView"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["Logs", "LogView"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["Logs"] = {
                Header: "Logs", Col_Lg: "4", Mode: "FileTlist", HtmlFn: "Log.FileTlist.html.php", JsFn: "Log.FileTlist.js.php",
                DetailPanels: "LogView", PageLength: "15", AllowedUploadFileExt: "log"
            };
            ContentParams2matrix["LogView"] = {
                Header: "LogView", Col_Lg: "8", Mode: "FileTlist", HtmlFn: "Log.FileView.html.php", JsFn: "Log.FileView.js.php",
                ParentObj: "LogList"
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    OpDatCat: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\OpDatCat\\Tree", "DA\\HtmlComponents\\OpDatCat\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["OpDatCats", "OpDatCatRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["OpDatCats"] = {
                Header: "OpDatCats", Col_Lg: "3", Mode: "Tlist", HtmlFn: "OpDatCat.Tree.html.php", JsFn: "OpDatCat.Tree.js.php",
                DetailPanels: "OpDatCatRead",
                FE:"OpDatCat", FV:"", PanelType:"Tlist", InRefs: ""
            };
            ContentParams2matrix["OpDatCatRead"] = {
                Header: "OpDatCat", Col_Lg: "9", Mode: "Tlist", HtmlFn: "OpDatCat.Read.html.php", JsFn: "OpDatCat.Read.js.php",
                ParentObj: "OpDatCatTree", ParentObjType: "Tree",
                FE:"Profile", PanelType:"Read", InRefs: "", FSels:""
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    Organizations: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\Organization\\Tlist", "DA\\HtmlComponents\\Organization\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["Organizations", "OrganizationRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["Organizations"] = {
                Header: "Organizations", Col_Lg: "4", Mode: "Tlist", HtmlFn: "Common.Tlist.html.php", JsFn: "Common.Tlist.js.php",
                DetailPanels: "OrganizationRead",
                FE:"Organization", FV:"", PanelType:"Tlist", InRefs: ""
            };
            ContentParams2matrix["OrganizationRead"] = {
                Header: "Organization", Col_Lg: "8", Mode: "Tlist", HtmlFn: "Common.Read.html.php", JsFn: "Common.Read.js.php",
                ParentObj: "OrganizationsList",
                FE:"Organization", PanelType:"Read", InRefs: "", FSels:""
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    ParamTypes: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\ParamTypeCat\\Tree","DA\\HtmlComponents\\ParamType\\Tlist", "DA\\HtmlComponents\\ParamType\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["ParamTypeCats","ParamTypes", "ParamTypeRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["ParamTypeCats"] = {
                Header: "ParamTypeCats", Col_Lg: "2", Mode: "TlistPar", HtmlFn: "ParamTypeCat.Tree.html.php", JsFn: "ParamTypeCat.Tree.js.php",
                DetailPanels: "ParamTypeTlist"
            };
            ContentParams2matrix["ParamTypes"] = {
                Header: "ParamTypes", Col_Lg: "5", Mode: "Tlist", HtmlFn: "ParamType.Tlist.html.php", JsFn: "ParamType.Tlist.js.php",
                DetailPanels: "ParamTypeRead", ParentObj: "ParamTypeCatTree", ParentObjType: "Tree"
            };
            ContentParams2matrix["ParamTypeRead"] = {
                Header: "ParamType", Col_Lg: "5",  Mode: "Tlist", HtmlFn: "ParamType.Read.html.php", JsFn: "ParamType.Read.js.php", 
                ParentObj: "ParamTypeList"
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    ParamTypeCat: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\ParamTypeCat\\Tree", "DA\\HtmlComponents\\ParamTypeCat\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["ParamTypeCats", "ParamTypeCatRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["ParamTypeCats"] = {
                Header: "ParamTypeCats", Col_Lg: "3", Mode: "Tlist", HtmlFn: "ParamTypeCat.Tree.html.php", JsFn: "ParamTypeCat.Tree.js.php",
                DetailPanels: "ParamTypeCatRead"
            };
            ContentParams2matrix["ParamTypeCatRead"] = {
                Header: "ParamTypeCat", Col_Lg: "9", Mode: "Tlist", HtmlFn: "ParamTypeCat.Read.html.php", JsFn: "ParamTypeCat.Read.js.php",
                ParentObj: "ParamTypeCatTree", ParentObjType: "Tree"
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    PrjCompleteBoard: function (UsrMsg, UsrMsgTitle) {
        try {
            da.cleanSessionNavigationParams;
            // container
            $("#ContentClass").val("DA\\HtmlComponents\\GridAccordion2D");
            // parametri per container
            ContentHeaderParams = "Project: " + $("#Prj_Nam").val();
            $("#ContentHeaderParams").val(ContentHeaderParams);
            // linee
            var ContentHeaders1matrix = ["Project", "Event", "Event Stats","Clean", "Context", "Analysis","Analysis Context", "Review"];//, "Train", "Test", "Comp", "Rank"];
            // alert(JSON.stringify(ContentHeaders1matrix));
            $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // Intestazioni per ciascuna linea orizzontale
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0]  = ["PrjView"];
            ContentHeaders2matrix[1]  = ["EvntDetail", "EvntCats",  "Dat_Evnts", "Dat_EvntView"];
            ContentHeaders2matrix[2]  = ["EvntStatsFileList", "EvntStatsFileView"];
            ContentHeaders2matrix[3]  = ["CleanDetail", "EvntStruct"];//, "Anom", "PotentialOutliers", "Ops", "Op"];
            ContentHeaders2matrix[4]  = ["CntxDetail", "CntxStruct", "CntxStatsFileList", "CntxStatsFileView"];//,"CntxGraphFileList", "CntxGraphView"];
            ContentHeaders2matrix[5]  = ["AnTlist", "AnRead", "Algs"]; //"AlgCats","AlgRead", "An", 
            ContentHeaders2matrix[6]  = ["AnCntx","AnCntxStatsFileList", "AnCntxStatsFileView"];//, "Split" ,"AnCntxGraphFileList", "AnCntxGraphView"];
            // ContentHeaders2matrix[6]  = ["Train", "TrainDat","TrainResFileList", "TrainResView","TrainStatsFileList", "TrainStatsFileView","TrainGraphFileList", "TrainGraphFileView"];
            // ContentHeaders2matrix[7]  = ["Test", "TestDat","TestResFileList", "TestResFileView","TestStatsFileList", "TestStatsFileView","TestGraphFileList", "TestGraphFileView"];
            // ContentHeaders2matrix[8]  = ["CompResFileList", "CompResFileView","CompStatsFileList", "CompStatsFileView","CompGraphFileList", "CompGraphFileView"];
            ContentHeaders2matrix[7]  = ["Rev"]; //, "AlgsCntxSpace"];
            // ContentHeaders2matrix[10] = ["Rnk", "AlgsCntxsSpace"];
            // alert(JSON.stringify(ContentHeaders2matrix));
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // classi per ciascuna linea orizzontale
            var ContentClass2matrix = [];
            ContentClass2matrix[0]  = ["DA\\HtmlComponents\\Prj\\View"];
            ContentClass2matrix[1]  = ["DA\\HtmlComponents\\Evnt\\Read", "DA\\HtmlComponents\\EvntCat\\Tlist", "DA\\HtmlComponents\\Dat_Evnt\\FileTlist", "DA\\HtmlComponents\\Dat_Evnt\\FileView"];
            ContentClass2matrix[2]  = ["DA\\HtmlComponents\\EvntStats\\FileTlist", "DA\\HtmlComponents\\EvntStats\\FileView"];
            ContentClass2matrix[3]  = ["DA\\HtmlComponents\\Clean\\Read", "DA\\HtmlComponents\\Evnt\\Struct"];//, "DA\\HtmlComponents\\Evnt\\Anom", "DA\\HtmlComponents\\Evnt\\Outliers", "DA\\HtmlComponents\\OpDat\\Tlist", "DA\\HtmlComponents\\OpDat\\Read"];
            ContentClass2matrix[4]  = ["DA\\HtmlComponents\\Cntx\\Read", "DA\\HtmlComponents\\Cntx\\Struct", "DA\\HtmlComponents\\Cntx\\FileTlist", "DA\\HtmlComponents\\Cntx\\FileView"];//, "DA\\HtmlComponents\\Common\\FileTlist", "DA\\HtmlComponents\\Common\\HtmlViewer"];
            ContentClass2matrix[5]  = ["DA\\HtmlComponents\\An\\Tlist", "DA\\HtmlComponents\\An\\Read", "DA\\HtmlComponents\\Alg\\Tlist"]; //, "DA\\HtmlComponents\\AlgCat\\Tree","DA\\HtmlComponents\\Alg\\Read", "DA\\HtmlComponents\\An\\Tlist", 
            ContentClass2matrix[6]  = ["DA\\HtmlComponents\\AnCntx\\Read", "DA\\HtmlComponents\\AnCntx\\FileTlist", "DA\\HtmlComponents\\AnCntx\\FileView"]; //, "DA\\HtmlComponents\\AnCntx\\split" , "DA\\HtmlComponents\\Common\\DatTlist" , "DA\\HtmlComponents\\Common\\FileTlist", "DA\\HtmlComponents\\Common\\HtmlViewer"];
            // ContentClass2matrix[6]  = ["DA\\HtmlComponents\\Train\\Read", "DA\\HtmlComponents\\Common\\DatTlist", "DA\\HtmlComponents\\Common\\FileTlist", "DA\\HtmlComponents\\Common\\FileView", "DA\\HtmlComponents\\Common\\FileTlist", "DA\\HtmlComponents\\Common\\FileView", "DA\\HtmlComponents\\Common\\FileTlist", "DA\\HtmlComponents\\Common\\HtmlViewer"];
            // ContentClass2matrix[7]  = ["DA\\HtmlComponents\\Test\\Read", "DA\\HtmlComponents\\Common\\DatTlist", "DA\\HtmlComponents\\Common\\FileTlist", "DA\\HtmlComponents\\Common\\FileView", "DA\\HtmlComponents\\Common\\FileTlist", "DA\\HtmlComponents\\Common\\FileView", "DA\\HtmlComponents\\Common\\FileTlist", "DA\\HtmlComponents\\Common\\HtmlViewer"];
            // ContentClass2matrix[8]  = ["DA\\HtmlComponents\\Common\\FileTlist", "DA\\HtmlComponents\\Common\\FileView", "DA\\HtmlComponents\\Common\\FileTlist", "DA\\HtmlComponents\\Common\\FileView", "DA\\HtmlComponents\\Common\\FileTlist", "DA\\HtmlComponents\\Common\\HtmlViewer"];
            ContentClass2matrix[7]  = ["DA\\HtmlComponents\\Rev\\Read"]; //, "DA\\HtmlComponents\\Common\\Pivot"];
            // ContentClass2matrix[10] = ["DA\\HtmlComponents\\Rnk\\Read", "DA\\HtmlComponents\\Common\\Pivot"];
            // alert(JSON.stringify(ContentClass2matrix));OpDatTlist
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));
            
            // altri parametri per livello di Detail accordion2D
            var ContentParams2matrix = {};
            // [0]  = ["Prj Detail"];
            ContentParams2matrix["PrjView"] = {
                Header: "Projects", Col_Lg: "12", Mode: "alone", HtmlFn: "Prj.View.html.php", JsFn: "Prj.View.js.php"
            };
            //[1]  = [""EvntDetail", EvntCat", "Dat_Evnts", "Dat_EvntView"];
            ContentParams2matrix["EvntDetail"] = {
                Header: "Event", Col_Lg: "4", Mode: "alone", HtmlFn: "Evnt.Read.html.php", JsFn: "Evnt.Read.js.php",
                RefPanels: "CntxRead", ParentObj: "PrjView", ParentObjType:"Refresh"

            };
            ContentParams2matrix["EvntCats"] = {
                Header: "Event Category", Col_Lg: "2", Mode: "Tlist", HtmlFn: "EvntCat.Tree.html.php", JsFn: "EvntCat.Tree.js.php",
                RefPanels: "EvntRead" //DetailPanels: "EvntRead", 
            };
            ContentParams2matrix["Dat_Evnts"] = {
                Header: "Event Data and Graphs", Col_Lg: "2", Mode: "FileTlist", HtmlFn: "Dat_Evnt.FileTlist.html.php", JsFn: "Dat_Evnt.FileTlist.js.php",
                RefPanels: "EvntRead", AllowedUploadFileExt: "csv_da"
                // DetailPanels: "Dat_EvntView", 
            };
            ContentParams2matrix["Dat_EvntView"] = {
                Header: "Event Viewer", Col_Lg: "4", Mode: "FileTlist", HtmlFn: "Dat_Evnt.FileView.html.php", JsFn: "Dat_Evnt.FileView.js.php",
                ParentObj: "Dat_EvntList"
            };
            //[2]  = ["EvntStatsFileList", "EvntStatsFileView"];
            ContentParams2matrix["EvntStatsFileList"] = {
                Header: "Event Stats File List", Col_Lg: "4", Mode: "FileTlist", HtmlFn: "EvntStats.FileTlist.html.php", JsFn: "EvntStats.FileTlist.js.php", 
                DetailPanels: "EvntStatsFileView", AllowedUploadFileExt: "csv_da"
            };
            ContentParams2matrix["EvntStatsFileView"] = {
                Header: "Event Stats File Viewer", Col_Lg: "8", Mode: "FileTlist", HtmlFn: "EvntStats.FileView.html.php", JsFn: "EvntStats.FileView.js.php", 
                ParentObj: "EvntStatsList"
            };
            //[3]  = ["CleanDetail", "EvntStruct"];//, "Anom", "PotentialOutliers", "Ops", "Op"];
            ContentParams2matrix["CleanDetail"] = {
                Header: "Clean", Col_Lg: "4", Mode: "alone", HtmlFn: "Clean.Read.html.php", JsFn: "Clean.Read.js.php",
                StructPanelFlag: "true", ParentObj: "PrjView", ParentObjType:"Refresh"
            };
            ContentParams2matrix["EvntStruct"] = {
                Header: "Event Structure", Col_Lg: "8", Mode: "alone", HtmlFn: "Evnt.Struct.html.php", JsFn: "Evnt.Struct.js.php"
            };
            // ContentParams2matrix["Anom"] = {
            //     Header: "Anom", Col_Lg: "1", Mode: "alone", HtmlFn: "Evnt.Anom.Tlist.html.php", JsFn: "Evnt.Anom.Tlist.js.php",
            // };
            // ContentParams2matrix["PotentialOutliers"] = {
            //     Header: "PotentialOutliers", Col_Lg: "1", Mode: "alone", HtmlFn: "Evnt.Outliers.Tlist.html.php", JsFn: "Evnt.Outliers.Tlist.js.php",
            // };
            // ContentParams2matrix["Ops"] = {
            //     Header: "Ops", Col_Lg: "2",Mode: "Tlist", HtmlFn: "OpsDat.Tlist.html.php", JsFn: "OpsDat.Tlist.js.php",
            //     IdClean: $("#Prj_IdClean").val()
            // };
            // ContentParams2matrix["Op"] = {
            //     Header: "Op", Col_Lg: "2", Mode: "alone", HtmlFn: "OpDat.Read.html.php", JsFn: "OpDat.Read.js.php",
            //     IdClean: $("#Prj_IdClean").val()
            // };
            //[4]  = ["CntxDetail", "CntxStruct", "CntxStatsFileList", "CntxStatsFileView"];//,"CntxGraphFileList", "CntxGraphView"];
            ContentParams2matrix["CntxDetail"] = {
                Header: "Context", Col_Lg: "3", Mode: "alone", HtmlFn: "Cntx.Read.html.php", JsFn: "Cntx.Read.js.php",
                RefPanels: "AnCntxRead", ParentObj: "PrjView", ParentObjType:"Refresh"
            };
            // ContentParams2matrix["CntxDat"] = {
            //     Header: "CntxDat", Col_Lg: "4", Mode: "alone", HtmlFn: "Cntx.Dat.Tlist.html.php",
            //     JsFn: "Cntx.Dat.Tlist.js.php"
            // };
            ContentParams2matrix["CntxStruct"] = {
                Header: "Context Structure", Col_Lg: "3", Mode: "alone", HtmlFn: "Cntx.Struct.html.php", JsFn: "Cntx.Struct.js.php"
            };
            ContentParams2matrix["CntxStatsFileList"] = {
                Header: "Context Stats File List", Col_Lg: "2", Mode: "Tlist", HtmlFn: "Cntx.FileTlist.html.php", JsFn: "Cntx.FileTlist.js.php", Filter: "_Cntx_stats", 
                DetailPanels: "CntxStatsFileView", AllowedUploadFileExt: "csv_da"
            };
            ContentParams2matrix["CntxStatsFileView"] = {
                Header: "Context Stats File Viewer", Col_Lg: "4", Mode: "alone", HtmlFn: "Cntx.FileView.html.php", JsFn: "Cntx.FileView.js.php"
            };
            // ContentParams2matrix["CntxGraphFileList"] = {
            //     Header: "CntxStatsFileList", Col_Lg: "2", Mode: "Tlist", HtmlFn: "Common.FileTlist.html.php",
            //     JsFn: "Common.FileTlist.js.php", Filter: "_Cntx_graph", 
            //     DetailPanels: "CntxGraphView"
            // };
            // ContentParams2matrix["CntxGraphView"] = {
            //     Header: "CntxStatsFileView", Col_Lg: "4", Mode: "alone", HtmlFn: "Common.FileView.html.php",
            //     JsFn: "Common.FileView.js.php"
            // };
            //[5]  = ["AnTlist", "AnRead", "AlgCats", "Algs","AlgRead"];
            ContentParams2matrix["AnTlist"] = {
                Header: "Analysis", Col_Lg: "2",Mode: "Tlist", HtmlFn: "An.Tlist.html.php", JsFn: "An.Tlist.js.php",
                DetailPanels: "AnRead", //"AnRead, AnCntx, AnCntxStatsFileList, AnCntxStatsFileView, Rev"
                ParentObj: "PrjView", ParentObjType:"Tlist", ParentObjFun:"Refresh"
            };
            ContentParams2matrix["AnRead"] = {
                Header: "Analysis", Col_Lg: "4", Mode: "Tlist", HtmlFn: "An.Read.html.php", JsFn: "An.Read.js.php",
                RefPanels: "AnCntxRead, RevRead", ParentObj: "AnTlist", ParentObjType:"Tlist2", ParentObjFun:"RefreshObj"
            };
            // ContentParams2matrix["AlgCats"] = {
            //     Header: "AlgCats", Col_Lg: "2", Mode: "TlistPar", HtmlFn: "AlgCat.Tree.html.php", JsFn: "AlgCat.Tree.js.php",
            //     DetailPanels: "AlgTlist"
            // };
            ContentParams2matrix["Algs"] = {
                Header: "Analysis Algorithms", Col_Lg: "6", Mode: "Tlist", HtmlFn: "Alg.Tlist.html.php", JsFn: "Alg.Tlist.js.php",
                ParentObj: "AlgCatTree", ParentObjType: "Tree", RefPanels: "AnRead"
            };
            // ContentParams2matrix["AlgRead"] = {
            //     Header: "Alg", Col_Lg: "5", Mode: "Tlist", HtmlFn: "Alg.View.html.php", JsFn: "Alg.View.js.php",
            //     ParentObj: "AlgList"
            // };
            //[6]  = ["AnCntx", "Split","AnCntxStatsFileList", "AnCntxStatsFileView"];//,"AnCntxGraphFileList", "AnCntxGraphView"];
            ContentParams2matrix["AnCntx"] = {
                Header: "Analysis Context", Col_Lg: "3", Mode: "alone", HtmlFn: "AnCntx.Read.html.php", JsFn: "AnCntx.Read.js.php",
                ParentObj: "PrjView", ParentObjType:"Refresh"
            };
            // ContentParams2matrix["AnCntxDat"] = {
            //     Header: "AnCntxDat", Col_Lg: "4", Mode: "alone", HtmlFn: "AnCntx.Dat.Tlist.html.php",
            //     JsFn: "AnCntx.Dat.Tlist.js.php"
            // };
            // ContentParams2matrix["Split"] = {
            //     Header: "Split CntxDat", Col_Lg: "2", Mode: "alone", HtmlFn: "AnCntx.Split.html.php", JsFn: "AnCntx.Split.js.php",
            // };
            ContentParams2matrix["AnCntxStatsFileList"] = {
                Header: "Analysis Context Stats File List", Col_Lg: "3", Mode: "Tlist", HtmlFn: "AnCntx.FileTlist.html.php", JsFn: "AnCntx.FileTlist.js.php", 
                DetailPanels: "AnCntxStatsFileView", AllowedUploadFileExt: "csv_da"
            };
            ContentParams2matrix["AnCntxStatsFileView"] = {
                Header: "Analysis Context Stats File Viewer", Col_Lg: "6", Mode: "alone", HtmlFn: "AnCntx.FileView.html.php", JsFn: "AnCntx.FileView.js.php"
            };
            // ContentParams2matrix["AnCntxGraphFileList"] = {
            //     Header: "AnCntxStatsFileList", Col_Lg: "2", Mode: "Tlist", HtmlFn: "Common.FileTlist.html.php",
            //     JsFn: "Common.FileTlist.js.php", DetailPanels: "AnCntxGraphView"
            // };
            // ContentParams2matrix["AnCntxGraphView"] = {
            //     Header: "AnCntxStatsFileView", Col_Lg: "4", Mode: "alone", HtmlFn: "Common.FileView.html.php",
            //     JsFn: "Common.FileView.js.php"
            // };
            // // [6]  = ["Train", "TrainDat","TrainResFileList", "TrainResView","TrainStatsFileList", "TrainStatsFileView","TrainGraphFileList", "TrainGraphFileView"];
            // ContentParams2matrix["Train"] = {
            //     Header: "Train", Col_Lg: "2", Mode: "alone", HtmlFn: "Train.Read.html.php", JsFn: "Train.Read.js.php",
                
            // };
            // ContentParams2matrix["TrainDat"] = {
            //     Header: "TrainDat", Col_Lg: "4", Mode: "alone", HtmlFn: "Train.Dat.Tlist.html.php",
            //     JsFn: "Train.Dat.Tlist.js.php"
            // };
            // ContentParams2matrix["TrainResFileList"] = {
            //     Header: "TrainResFileList", Col_Lg: "2", Mode: "Tlist", HtmlFn: "Common.FileTlist.html.php",
            //     JsFn: "Common.FileTlist.js.php", Filter: "_Train_result", DetailPanels: "TrainResView"
            // };
            // ContentParams2matrix["TrainResView"] = {
            //     Header: "TrainResView", Col_Lg: "4", Mode: "alone", HtmlFn: "Common.FileView.html.php",
            //     JsFn: "Common.FileView.js.php"
            // };
            // ContentParams2matrix["TrainStatsFileList"] = {
            //     Header: "TrainStatsFileList", Col_Lg: "2", Mode: "Tlist", HtmlFn: "Common.FileTlist.html.php",
            //     JsFn: "Common.FileTlist.js.php", Filter: "_Train_stats", DetailPanels: "TrainStatsFileView"
            // };
            // ContentParams2matrix["TrainStatsFileView"] = {
            //     Header: "TrainStatsFileView", Col_Lg: "4", Mode: "alone", HtmlFn: "Common.FileView.html.php",
            //     JsFn: "Common.FileView.js.php"
            // };
            // ContentParams2matrix["TrainGraphFileList"] = {
            //     Header: "TrainStatsFileList", Col_Lg: "2", Mode: "Tlist", HtmlFn: "Common.FileTlist.html.php",
            //     JsFn: "Common.FileTlist.js.php", Filter: "_Train_graph", DetailPanels: "TrainGraphFileView"
            // };
            // ContentParams2matrix["TrainGraphFileView"] = {
            //     Header: "TrainStatsFileView", Col_Lg: "4", Mode: "alone", HtmlFn: "Common.FileView.html.php",
            //     JsFn: "Common.FileView.js.php"
            // };
            // // [7]  = ["Test", "TestDat","TestResFileList", "TestResFileView","TestStatsFileList", "TestStatsFileView","TestGraphFileList", "TestGraphFileView"];
            // ContentParams2matrix["Test"] = {
            //     Header: "Test", Col_Lg: "2", Mode: "alone", HtmlFn: "Test.Read.html.php", JsFn: "Test.Read.js.php",
            // };
            // ContentParams2matrix["TestDat"] = {
            //     Header: "TestDat", Col_Lg: "4", Mode: "alone", HtmlFn: "Test.Dat.Tlist.html.php",
            //     JsFn: "Test.Dat.Tlist.js.php"
            // };
            // ContentParams2matrix["TestResFileList"] = {
            //     Header: "TestResFileList", Col_Lg: "2", Mode: "Tlist", HtmlFn: "Common.FileTlist.html.php",
            //     JsFn: "Common.FileTlist.js.php", Filter: "_test_result", DetailPanels: "TestResFileView"
            // };
            // ContentParams2matrix["TestResFileView"] = {
            //     Header: "TestResFileView", Col_Lg: "4", Mode: "alone", HtmlFn: "Common.FileView.html.php",
            //     JsFn: "Common.FileView.js.php"
            // };
            // ContentParams2matrix["TestStatsFileList"] = {
            //     Header: "TestStatsFileList", Col_Lg: "2", Mode: "Tlist", HtmlFn: "Common.FileTlist.html.php",
            //     JsFn: "Common.FileTlist.js.php", Filter: "_test_stats", DetailPanels: "TestStatsFileView"
            // };
            // ContentParams2matrix["TestStatsFileView"] = {
            //     Header: "TestStatsFileView", Col_Lg: "4", Mode: "alone", HtmlFn: "Common.FileView.html.php",
            //     JsFn: "Common.FileView.js.php"
            // };
            // ContentParams2matrix["TestGraphFileList"] = {
            //     Header: "TestStatsFileList", Col_Lg: "2", Mode: "Tlist", HtmlFn: "Common.FileTlist.html.php",
            //     JsFn: "Common.FileTlist.js.php", Filter: "_test_graph", DetailPanels: "TestGraphFileView"
            // };
            // ContentParams2matrix["TestGraphFileView"] = {
            //     Header: "TestStatsFileView", Col_Lg: "4", Mode: "alone", HtmlFn: "Common.FileView.html.php",
            //     JsFn: "Common.FileView.js.php"
            // };
            // // [8]  = ["CompResFileList", "CompResFileView","CompStatsFileList", "CompStatsFileView","CompGraphFileList", "CompGraphFileView"];
            // ContentParams2matrix["CompResFileList"] = {
            //     Header: "CompResFileList", Col_Lg: "2", Mode: "Tlist", HtmlFn: "Common.FileTlist.html.php",
            //     JsFn: "Common.FileTlist.js.php", Filter: "_compare_result", DetailPanels: "CompResFileView"
            // };
            // ContentParams2matrix["CompResFileView"] = {
            //     Header: "CompResFileView", Col_Lg: "4", Mode: "alone", HtmlFn: "Common.FileView.html.php",
            //     JsFn: "Common.FileView.js.php"
            // };
            // ContentParams2matrix["CompStatsFileList"] = {
            //     Header: "CompStatsFileList", Col_Lg: "2", Mode: "Tlist", HtmlFn: "Common.FileTlist.html.php",
            //     JsFn: "Common.FileTlist.js.php", Filter: "_compare_stats", DetailPanels: "CompStatsFileView"
            // };
            // ContentParams2matrix["CompStatsFileView"] = {
            //     Header: "CompStatsFileView", Col_Lg: "4", Mode: "alone", HtmlFn: "Common.FileView.html.php",
            //     JsFn: "Common.FileView.js.php"
            // };
            // ContentParams2matrix["CompGraphFileList"] = {
            //     Header: "CompStatsFileList", Col_Lg: "2", Mode: "Tlist", HtmlFn: "Common.FileTlist.html.php",
            //     JsFn: "Common.FileTlist.js.php", Filter: "_compare_graph", DetailPanels: "CompGraphFileView"
            // };
            // ContentParams2matrix["CompGraphFileView"] = {
            //     Header: "CompStatsFileView", Col_Lg: "4", Mode: "alone", HtmlFn: "Common.FileView.html.php",
            //     JsFn: "Common.FileView.js.php"
            // };
            //[7]  = ["Rev"]; //, "AlgsCntxSpace"];
            ContentParams2matrix["Rev"] = {
                Header: "Review", Col_Lg: "6", Mode: "alone", HtmlFn: "Rev.Read.html.php", JsFn: "Rev.Read.js.php",
                ParentObj: "PrjView", ParentObjType:"Refresh"
            };
            // ContentParams2matrix["AlgsCntxSpace"] = {
            //     Header: "AlgsCntxSpace", Col_Lg: "4", Mode: "alone", HtmlFn: "Common.Pivot.html.php", JsFn: "Common.Pivot.js.php",
            //     Space: "AlgsCntx"
            // };
            // // [10] = ["Rnk", "AlgsCntxsSpace"];
            // ContentParams2matrix["Rnk"] = {
            //     Header: "Rnk", Col_Lg: "2", Mode: "alone", HtmlFn: "Rnk.Read.html.php", JsFn: "Rnk.Read.js.php",
            // };
            // ContentParams2matrix["AlgsCntxsSpace"] = {
            //     Header: "AlgsCntxsSpace", Col_Lg: "4", Mode: "alone", HtmlFn: "Common.Pivot.html.php", JsFn: "Common.Pivot.js.php",
            //     Space: "AlgsCntxs"
            // };

            // alert(JSON.stringify(ContentParams2matrix));
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    // predisposto per V.1
    PrjCompleteBoardV2: function (UsrMsg, UsrMsgTitle) {
        try {
            da.cleanSessionNavigationParams;

            // $("#ContentClass").val("DA\\HtmlComponents\\GridAccordion2D");
            $("#ContentClass").val("DA\\HtmlComponents\\ContainerBuilder");

            //  parametri per accordion2D
            var ContainerParams = {};
            ContainerParams["GridAccordion2D"] = {
                containerClass: "DA\\HtmlComponents\\ContainerBuilder",
                containerHtml: "GridAccordion2D.html.php",
                containerJs: "_multiJs2D.js.php"
            };
            $("#ContainerParams").val(JSON.stringify(ContainerParams));

            ContentHeaderParams = "Prj: " + $("#Prj_IdPrj").val() + " - " + $("#Prj_nam").val();
            $("#ContentHeaderParams").val(ContentHeaderParams);

            // livelli di accordion2D
            var ContentHeaders1matrix = ["Prj", "Evnt", "Clean", "Cntx"];
            // alert(JSON.stringify(ContentHeaders1matrix));
            $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // Intestazioni per livello di Accordion2D
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["Prj"];
            ContentHeaders2matrix[1] = ["RepoEvents", "Evnt", "EvntDat"];
            ContentHeaders2matrix[2] = ["Clean", "Ops Dat", "Op Dat", "Dimensioni Evnt", "Dat Puliti Evnt"];
            // alert(JSON.stringify(ContentHeaders2matrix));
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\Prj\\Read"];
            ContentClass2matrix[1] = ["DA\\HtmlComponents\\repo\\DataEventFileTlist", "DA\\HtmlComponents\\Evnt\\Read", "DA\\HtmlComponents\\Evnt\\Common\\DatTlist"];
            ContentClass2matrix[2] = ["DA\\HtmlComponents\\Clean\\Read", "DA\\HtmlComponents\\OpDat\\Tlist", "DA\\HtmlComponents\\OpDat\\Read", "DA\\HtmlComponents\\Evnt\\dimensioni", "DA\\HtmlComponents\\Evnt\\DatPulitiTlist"];
            // alert(JSON.stringify(ContentClass2matrix));OpDatTlist
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));
            
            // altri parametri per livello di Detail accordion2D
            var ContentParams2matrix = {};
            ContentParams2matrix["Prj"] = {
                Header: "Prj",
                Mode: "alone",
                HtmlFn: "Prj.Read.html.php",
                JsFn: "Prj.Read.js.php",
                IdPrj: $("#Prj_IdPrj").val(),
                IdPrjState: $("#Prj_IdPrjState").val(),
            };
            ContentParams2matrix["RepoEvents"] = {
                Header: "RepoEvents",
                Col_Lg: "2",
                Mode: "Tlist",
                HtmlFn: "repo.Data.event.Files.Tlist.html.php",
                JsFn: "repo.Data.event.Files.Tlist.js.php",
            };
            ContentParams2matrix["Evnt"] = {
                Header: "Evnt",
                Mode: "alone",
                HtmlFn: "Evnt.Read.html.php",
                JsFn: "Evnt.Read.js.php",
                IdPrj: $("#Prj_IdPrj").val(),
            };
            ContentParams2matrix["EvntDat"] = {
                Header: "EvntDat",
                Col_Lg: "4",
                Mode: "alone",
                HtmlFn: "Evnt.Dat.Tlist.html.php",
                JsFn: "Evnt.Dat.Tlist.js.php",
                IdPrj: $("#Prj_IdPrj").val(),
            };
            ContentParams2matrix["Clean"] = {
                Header: "Clean",
                Col_Lg: "2",
                Mode: "alone",
                HtmlFn: "Clean.Read.html.php",
                JsFn: "Clean.Read.js.php",
                IdEvnt: $("#Evnt_IdEvnt").val(),
            };
            ContentParams2matrix["Ops Dat"] = {
                Header: "Ops",
                Mode: "alone",
                HtmlFn: "OpDat.Tlist.html.php",
                JsFn: "OpDat.Tlist.js.php",
                IdClean: $("#Prj_IdClean").val(),
                IdPrj: $("#Prj_IdPrj").val(),
            };
            ContentParams2matrix["Op Dat"] = {
                Header: "Op",
                Mode: "alone",
                HtmlFn: "OpDat.Read.html.php",
                JsFn: "OpDat.Read.js.php",
                IdClean: $("#Prj_IdClean").val(),
                IdPrj: $("#Prj_IdPrj").val(),
            };
            ContentParams2matrix["Dimensioni Evnt"] = {
                Header: "Dimensioni Evnt",
                Col_Lg: "1",
                Mode: "alone",
                HtmlFn: "Evnt.dimensioni.html.php",
                JsFn: "Evnt.dimensioni.js.php",
                IdPrj: $("#Prj_IdPrj").val(),
            };
            ContentParams2matrix["Dat Puliti Evnt"] = {
                Header: "Dat Puliti Evnt",
                Mode: "alone",
                HtmlFn: "Evnt.DatPuliti.Tlist.html.php",
                JsFn: "Evnt.DatPuliti.Tlist.js.php",
                IdPrj: $("#Prj_IdPrj").val(),
            };

            // alert(JSON.stringify(ContentParams2matrix));
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    Prjs: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\Prj\\Tlist", "DA\\HtmlComponents\\Prj\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["PrjTlist", "PrjRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["PrjTlist"] = {
                Header: "Projects", Col_Lg: "6", Mode: "Tlist", HtmlFn: "Prj.Tlist.html.php", JsFn: "Prj.Tlist.js.php",
                DetailPanels: "PrjRead"
            };
            ContentParams2matrix["PrjRead"] = {
                Header: "Project", Col_Lg: "6", Mode: "Tlist", HtmlFn: "Prj.Read.html.php", JsFn: "Prj.Read.js.php", 
                ParentObj: "PrjTlist", ParentObjType:"Tlist2", ParentObjFun:"RefreshObj"
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    PrjStates: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\PrjState\\Tlist", "DA\\HtmlComponents\\PrjState\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["PrjStates", "PrjStateRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["PrjStates"] = {
                Header: "Project States", Col_Lg: "4", Mode: "Tlist", HtmlFn: "Common.Tlist.html.php", JsFn: "Common.Tlist.js.php",
                DetailPanels: "PrjStateRead",
                FE:"PrjState", FV:"", PanelType:"Tlist", InRefs: ""
            };
            ContentParams2matrix["PrjStateRead"] = {
                Header: "Project State", Col_Lg: "8",  Mode: "Tlist", HtmlFn: "Common.Read.html.php", JsFn: "Common.Read.js.php", 
                ParentObj: "PrjStateList",
                FE:"PrjState", PanelType:"Read", InRefs: "", FSels:""
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    Procs: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\Proc\\FileTlist", "DA\\HtmlComponents\\Proc\\FileView"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["Procs", "ProcView"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["Procs"] = {
                Header: "Processes", Col_Lg: "4", Mode: "FileTlist", HtmlFn: "Proc.FileTlist.html.php", JsFn: "Proc.FileTlist.js.php",
                DetailPanels: "ProcView", AllowedUploadFileExt: "R"
            };
            ContentParams2matrix["ProcView"] = {
                Header: "Process", Col_Lg: "8", Mode: "FileTlist", HtmlFn: "Proc.FileView.html.php", JsFn: "Proc.FileView.js.php",
                ParentObj: "ProcList"
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    Profiles: function (UsrMsg, UsrMsgTitle) {
        try {
            da.cleanSessionNavigationParams;
            // container
            $("#ContentClass").val("DA\\HtmlComponents\\GridAccordion2D");
            // parametri per container
            // ContentHeaderParams = "Profiles: " + $("#Profile_IdProfile").val() + " - " + $("#Profile_Nam").val();
            ContentHeaderParams = "Profiles";
            $("#ContentHeaderParams").val(ContentHeaderParams);
            // linee
            var ContentHeaders1matrix = ["Profile", "Profile Features", "Profile Usrs"]; //[suspended: next release] , "Profile Features 2"
            // alert(JSON.stringify(ContentHeaders1matrix));
            $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // Intestazioni per ciascuna linea orizzontale
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0]  = ["Profiles","ProfileRead"];
            ContentHeaders2matrix[1]  = ["ProfileFeatureAuths", "ProfileFeatureAuthRead"];
            //[suspended: next release]ContentHeaders2matrix[2]  = ["ProfileFeatureAuthTlistRead"];
            ContentHeaders2matrix[2]  = ["ProfileUsrs","ProfileUsrRead"];
            // alert(JSON.stringify(ContentHeaders2matrix));
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // classi per ciascuna linea orizzontale
            var ContentClass2matrix = [];
            ContentClass2matrix[0]  = ["DA\\HtmlComponents\\Profile\\Tlist","DA\\HtmlComponents\\Profile\\Read"];
            ContentClass2matrix[1]  = ["DA\\HtmlComponents\\ProfileFeatureAuth\\Tlist", "DA\\HtmlComponents\\ProfileFeatureAuth\\Read"];
            //[suspended: next release]ContentClass2matrix[2]  = ["DA\\HtmlComponents\\ProfileFeatureAuth\\TlistRead"];
            ContentClass2matrix[2]  = ["DA\\HtmlComponents\\ProfileUsr\\Tlist","DA\\HtmlComponents\\ProfileUsr\\Read"];
            // alert(JSON.stringify(ContentClass2matrix));OpDatTlist
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));
            
            // altri parametri per livello di Detail accordion2D
            var ContentParams2matrix = {};
            //[0]  = ["Profiles","ProfileRead"];
            ContentParams2matrix["Profiles"] = {
                Header: "Profiles", Col_Lg: "4", Mode: "Tlist", HtmlFn: "Common.Tlist.html.php", JsFn: "Common.Tlist.js.php", // Profile.Tlist.js.php
                DetailPanels: "ProfileRead", RefPanels: "ProfileFeatureAuthTlist,ProfileUsrTlist,ProfileFeatureAuthRead,ProfileUsrRead", //,ProfileFeatureAuthTlistRead
                FE:"Profile", FV:"", PanelType:"Tlist", InRefs: ""
            };
            ContentParams2matrix["ProfileRead"] = {
                Header: "Profile", Col_Lg: "8", Mode: "Tlist", HtmlFn: "Common.Read.html.php", JsFn: "Common.Read.js.php", // Profile.Read.js.php
                ParentObj: "ProfilesTlist" , ParentObjType:"Tlist", CompulsoryFields: "Nam",
                FE:"Profile", PanelType:"Read", InRefs: "", FSels:""
            };
            // [1]  = ["DA\\HtmlComponents\\ProfileFeatureAuth\\Tlist", "DA\\HtmlComponents\\ProfileFeatureAuth\\Read"];
            ContentParams2matrix["ProfileFeatureAuths"] = {
                Header: "ProfileFeatureAuths", Col_Lg: "8", Mode: "Tlist", HtmlFn: "Common.Tlist.html.php", JsFn: "Common.Tlist.js.php", 
                DetailPanels: "ProfileFeatureAuthRead", 
                FE:"ProfileFeatureAuth", FV:"IdProfile", PanelType:"Tlist", InRefs: "Profile"
            };
            //CompulsoryParamNams: "IdProfileFeatureAuth",// ParamNams: "SearchIds,IdProfile,IdFeature,IdAuthLevel", SaveParamNams: "IdProfileFeatureAuth,IdProfile,IdFeature,IdAuthLevel",
            ContentParams2matrix["ProfileFeatureAuthRead"] = {
                Header: "ProfileFeatureAuth", Col_Lg: "4", Mode: "Tlist", HtmlFn: "Common.Read.html.php", JsFn: "Common.Read.js.php", 
                ParentObj: "ProfileFeatureAuthTlist" , ParentObjType:"Tlist", CompulsoryFields: "IdProfile", 
                FE:"ProfileFeatureAuth", PanelType:"Read", InRefs: "Profile", FSels:"Feature,AuthLevel"
            };
            //[suspended: next release][2]  = ["DA\\HtmlComponents\\ProfileFeatureAuth\\TlistRead"];
            // ContentParams2matrix["ProfileFeatureAuthTlistRead"] = { 
            //     Header: "ProfileFeatureAuthTlistRead", Col_Lg: "12", Mode: "alone", HtmlFn: "ProfileFeatureAuth.TlistRead.html.php", JsFn: "ProfileFeatureAuth.TlistRead.js.php",
            //     PageLength: "15", CompulsoryFields: "IdProfile"
            // };
            //[2]  = ["DA\\HtmlComponents\\ProfileUsr\\Tlist","DA\\HtmlComponents\\ProfileUsr\\Read"];
            ContentParams2matrix["ProfileUsrs"] = {
                Header: "ProfileUsrs", Col_Lg: "8", Mode: "Tlist", HtmlFn: "Common.Tlist.html.php", JsFn: "Common.Tlist.js.php", 
                DetailPanels: "ProfileUsrRead",
                FE:"ProfileUsr", FV:"IdProfile", PanelType:"Tlist", InRefs: "Profile"

            };
            ContentParams2matrix["ProfileUsrRead"] = {
                Header: "ProfileUsr", Col_Lg: "4", Mode: "Tlist", HtmlFn: "Common.Read.html.php", JsFn: "Common.Read.js.php", 
                ParentObj: "ProfileUsrTlist" , ParentObjType:"Refresh", CompulsoryFields: "IdProfile",
                FE:"ProfileUsr", PanelType:"Read", InRefs: "Profile", FSels:"Usr"
            };

            // alert(JSON.stringify(ContentParams2matrix));
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    RColTypes: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\RColType\\Tlist", "DA\\HtmlComponents\\RColType\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["RColTypes", "RColTypeRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["RColTypes"] = {
                Header: "R Column Types", Col_Lg: "4", Mode: "Tlist", HtmlFn: "Common.Tlist.html.php", JsFn: "Common.Tlist.js.php",
                DetailPanels: "RColTypeRead",
                FE:"RColType", FV:"", PanelType:"Tlist", InRefs: ""
            };
            ContentParams2matrix["RColTypeRead"] = {
                Header: "R Column Type", Col_Lg: "8",  Mode: "Tlist", HtmlFn: "Common.Read.html.php", JsFn: "Common.Read.js.php", 
                ParentObj: "RColTypeList",
                FE:"RColType", PanelType:"Read", InRefs: "", FSels:""
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    SplitCat: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\SplitCat\\Tree", "DA\\HtmlComponents\\SplitCat\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["SplitCats", "SplitCatRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["SplitCats"] = {
                Header: "Split Categories", Col_Lg: "3", Mode: "Tlist", HtmlFn: "SplitCat.Tree.html.php", JsFn: "SplitCat.Tree.js.php",
                DetailPanels: "SplitCatRead"
            };
            ContentParams2matrix["SplitCatRead"] = {
                Header: "Split Category", Col_Lg: "9", Mode: "Tlist", HtmlFn: "SplitCat.Read.html.php", JsFn: "SplitCat.Read.js.php",
                ParentObj: "SplitCatTree", ParentObjType: "Tree"
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    SplitType: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\SplitCat\\Tree","DA\\HtmlComponents\\SplitType\\Tlist", "DA\\HtmlComponents\\SplitType\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["SplitCats","SplitTypes", "SplitTypeRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["SplitCats"] = {
                Header: "Split Categories", Col_Lg: "2", Mode: "TlistPar", HtmlFn: "SplitCat.Tree.html.php", JsFn: "SplitCat.Tree.js.php",
                DetailPanels: "SplitTypeTlist"
            };
            ContentParams2matrix["SplitTypes"] = {
                Header: "Split Types", Col_Lg: "5", Mode: "Tlist", HtmlFn: "SplitType.Tlist.html.php", JsFn: "SplitType.Tlist.js.php",
                DetailPanels: "SplitTypeRead", ParentObj: "SplitCatTree", ParentObjType: "Tree"
            };
            ContentParams2matrix["SplitTypeRead"] = {
                Header: "Split Type", Col_Lg: "5",  Mode: "Tlist", HtmlFn: "SplitType.Read.html.php", JsFn: "SplitType.Read.js.php", 
                ParentObj: "SplitTypeList"
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    StVarCat: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridHorizontal");
            // $("#ContentHeaderParams").val("Progetti e Stati Prj 2D");

            // // livelli di accordion2D
            // var ContentHeaders1matrix = [];
            // $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\StVarCat\\Tree", "DA\\HtmlComponents\\StVarCat\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["StVarCats", "StVarCatRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            ContentParams2matrix["StVarCats"] = {
                Header: "Stat.Var. Categories", Col_Lg: "3", Mode: "Tlist", HtmlFn: "StVarCat.Tree.html.php", JsFn: "StVarCat.Tree.js.php",
                DetailPanels: "StVarCatRead"
            };
            ContentParams2matrix["StVarCatRead"] = {
                Header: "Stat.Var. Category", Col_Lg: "9", Mode: "Tlist", HtmlFn: "StVarCat.Read.html.php", JsFn: "StVarCat.Read.js.php",
                ParentObj: "StVarCatTree", ParentObjType: "Tree"
            };
            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
    Usrs: function () {
        try {
            da.cleanSessionNavigationParams;

            // classe contenitore
            $("#ContentClass").val("DA\\HtmlComponents\\GridAccordion2D");
            // parametri per container
            // ContentHeaderParams = "Profiles: " + $("#Profile_IdProfile").val() + " - " + $("#Profile_Nam").val();
            ContentHeaderParams = "Users";
            $("#ContentHeaderParams").val(ContentHeaderParams);
            // linee
            var ContentHeaders1matrix = ["User", "User Profiles"]; //[suspended: next release] , "Profile Features 2"
            $("#ContentHeaders1matrix").val(JSON.stringify(ContentHeaders1matrix));

            // classi per ciascun livello di accordion2D
            var ContentClass2matrix = [];
            ContentClass2matrix[0] = ["DA\\HtmlComponents\\Usr\\Tlist", "DA\\HtmlComponents\\Usr\\Read"];
            ContentClass2matrix[1]  = ["DA\\HtmlComponents\\ProfileUsr\\Tlist", "DA\\HtmlComponents\\ProfileUsr\\Read"];
            $("#ContentClass2matrix").val(JSON.stringify(ContentClass2matrix));

            // Intestazioni per livello 2 
            var ContentHeaders2matrix = [];
            ContentHeaders2matrix[0] = ["Usrs", "UsrRead"];
            ContentHeaders2matrix[1]  = ["ProfilesUsr", "ProfileUsrRead"];
            $("#ContentHeaders2matrix").val(JSON.stringify(ContentHeaders2matrix));

            // altri parametri per livello 2
            var ContentParams2matrix = {};
            //[0] = ["DA\\HtmlComponents\\Usr\\Tlist", "DA\\HtmlComponents\\Usr\\Read"];
            ContentParams2matrix["Usrs"] = {
                Header: "Users", Col_Lg: "6", Mode: "Tlist", HtmlFn: "Common.Tlist.html.php", JsFn: "Common.Tlist.js.php",
                DetailPanels: "UsrRead", RefPanels: "ProfileUsrTlist,ProfileUsrRead",
                FE:"Usr", FV:"", PanelType:"Tlist", InRefs: ""
            };
            ContentParams2matrix["UsrRead"] = {
                Header: "User", Col_Lg: "6", Mode: "Tlist", HtmlFn: "Common.Read.html.php", JsFn: "Common.Read.js.php", 
                ParentObj: "UsrTlist" , ParentObjType:"Refresh", CompulsoryFields: "Nam",
                FE:"Usr", PanelType:"Read", InRefs: "", FSels:"Organization"
            };
            //[1]  = ["ProfilesUsr", "ProfileUsrRead"];
            ContentParams2matrix["ProfilesUsr"] = {
                Header: "User Profiles", Col_Lg: "6", Mode: "Tlist", HtmlFn: "Common.Tlist.html.php", JsFn: "Common.Tlist.js.php", 
                DetailPanels: "ProfileUsrRead",
                FE:"ProfileUsr", FV:"", PanelType:"Tlist", InRefs: "Usr"
            };
            ContentParams2matrix["ProfileUsrRead"] = {
                Header: "User Profile", Col_Lg: "6", Mode: "Tlist", HtmlFn: "Common.Read.html.php", JsFn: "Common.Read.js.php", 
                ParentObj: "ProfileUsrTlist" , ParentObjType:"Refresh", CompulsoryFields: "IdUsr",
                FE:"ProfileUsr", PanelType:"Read", InRefs: "Usr", FSels:"Profile"
            };

            $("#ContentParams2matrix").val(JSON.stringify(ContentParams2matrix));

            document.contentInfo.submit();
        } catch (e) {
            da.UsrMsgShow(e.message, "Error");
        }
    }
    ,
}

