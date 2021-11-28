<!-- <div class="col-lg-8"> -->
<div id="PrjViewPanel" name="PrjViewPanel" class="da-column col-sm-<?php echo $this->Col_Lg; ?>">
    <div class="card <?php echo $this->Col_H; ?>">
        <div class="card-header">
            <h6 class="card-title"><?php echo $this->Header; ?></h6>
            &emsp;<i class="badge badge-warning left da-card-info"></i>
            <div class="card-tools">
                <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["cardToolsHtml"]); ?>
            </div>
        </div>
        <div class="card-body">
            <!-- <h6 class="card-title">Special title treatment</h6> -->

            <!-- general form elements -->
            <!-- form start -->
            <form role="form" method="POST">
                <div class="row">
                    <!-- <input id="btnOpenPrj" type="button" class="btn btn-outline-success btn-xs" value="Open" disabled></input>
                    <input id="btnNewPrj" type="button" class="btn btn-outline-primary btn-xs" value="New"></input>
                    <input id="btnSavePrj" type="button" class="btn btn-outline-primary btn-xs" value="Save"></input>
                    <input id="btnRefreshPrj" type="button" class="btn btn-default btn-xs " value="Refresh" disabled></input>
                    <input id="btnDeletePrj" type="button" class="btn btn-default btn-xs" value="Delete" disabled></input> -->
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Prj_Nam">Name</label>
                            <input type="text" class="form-control" id="Prj_Nam" placeholder="Name ..." value=""
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="IdPrjStateselect">
                            <label for="Prj_IdPrjState">Project State</label>
                            <select class="form-control form-control-sm" id="Prj_IdPrjState"
                                placeholder="IdPrjState ..." value="" disabled>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group w-100">
                            <label for="Prj_Descr">Description</label>
                            <textarea class="form-control form-control-sm" rows="3" id="Prj_Descr"
                                placeholder="Description ..." value="" disabled></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <!-- TECH INFO -->
                    <div class="card collapsed-card ">
                        <div class="card-header">
                            <p class="card-title">Tech Info</p>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Prj_IdUsr">IdUsr</label>
                                        <input type="text" class="form-control" id="Prj_IdUsr" placeholder="IdUsr ..."
                                            value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Prj_IdPrj">IdPrj</label>
                                        <input type="text" class="form-control" id="Prj_IdPrj" placeholder="IdPrj ..."
                                            value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Prj_PrjFolderNam">PrjFolderNam</label>
                                        <input type="text" class="form-control" id="Prj_PrjFolderNam"
                                            placeholder="PrjFolderNam ..." value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Prj_EvntFolderNam">EvntFolderNam</label>
                                        <input type="text" class="form-control" id="Prj_EvntFolderNam"
                                            placeholder="EvntFolderNam ..." value="" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Prj_CntxFolderNam">CntxFolderNam</label>
                                        <input type="text" class="form-control" id="Prj_CntxFolderNam"
                                            placeholder="CntxFolderNam ..." value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Prj_AnFolderNam">AnFolderNam</label>
                                        <input type="text" class="form-control" id="Prj_AnFolderNam"
                                            placeholder="AnFolderNam ..." value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Prj_RnkFolderNam">RnkFolderNam</label>
                                        <input type="text" class="form-control" id="Prj_RnkFolderNam"
                                            placeholder="RnkFolderNam ..." value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Prj_FileNamRepoDat">FileNamRepoDat</label>
                                        <input type="text" class="form-control" id="Prj_FileNamRepoDat"
                                            placeholder="FileNamRepoDat ..." value="" readonly>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- - PrjState: new, Evnt, cntx, an, rev, rank(standardize)
                                        - anPhase: an, AnCntx, train, test, comp, rev, rank -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Prj_IdUsr">IdUsr</label>
                                            <table class="table table-striped table-valign-middle">
                                                <thead>
                                                    <tr>
                                                        <th>IdEvnt</th>
                                                        <th>IdClean</th>
                                                        <th>IdCntx</th>
                                                        <th>IdAn</th>
                                                        <th>AnNum</th>
                                                        <!-- <th>IdTrain</th> -->
                                                        <!-- <th>IdTest</th> -->
                                                        <!-- <th>IdRev</th> -->
                                                        <th>IdRnk</th>
                                                        <!-- <th>IdPrjState</th> -->
                                                        <th>IdPrjStateCalc</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control" id="Prj_IdEvnt"
                                                                placeholder="IdEvnt ..." value="" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="Prj_IdClean"
                                                                placeholder="IdClean ..." value="" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="Prj_IdCntx"
                                                                placeholder="IdCntx ..." value="" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="Prj_IdAn"
                                                                placeholder="IdAn ..." value="" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="Prj_AnNum"
                                                                placeholder="AnNum ..." value="" readonly>
                                                        </td>
                                                        <!-- <td>
                                                            <input type="text" class="form-control" id="Prj_IdTrain"
                                                                placeholder="IdTrain ..." value="" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="Prj_IdTest"
                                                                placeholder="IdTest ..." value="" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="Prj_IdRev"
                                                                placeholder="IdRev ..." value="" readonly>
                                                        </td> -->
                                                        <td>
                                                            <input type="text" class="form-control" id="Prj_IdRnk"
                                                                placeholder="IdRnk ..." value="" readonly>
                                                        </td>
                                                        <!-- <td>
                                                            <input type="text" class="form-control" id="Prj_IdPrjState" placeholder="IdPrjState ..." value="" readonly>
                                                        </td> -->
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                id="Prj_IdPrjStateCalc" placeholder="IdPrjStateCalc ..."
                                                                value="" readonly>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!--/.tech-info -->
                </div>
                <!-- /.col -->

                <!-- /.box-body -->
                <!-- .box-footer content -->
                <!-- /.box-footer -->
            </form>
            <!-- /.box -->

        </div>
    </div>
</div>