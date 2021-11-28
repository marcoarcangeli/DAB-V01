<!-- <div class="col-lg-8"> -->
<div class="da-column col-sm-<?php echo $this->Col_Lg; ?>">
    <div class="card <?php echo $this->Col_H; ?>">
        <div class="card-header">
            <h6 class="card-title"><?php echo $this->Header; ?></h6>
            <div class="card-tools">
                <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["cardToolsHtml"]); ?>
            </div>
        </div>
        <div class="card-body">
            <!-- <h6 class="card-title">Special title treatment</h6> -->

            <!-- general form elements -->
            <!-- form start -->
            <form role="form" method="POST">
                <div id="AnCntxBtns" class="row">
                    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxReadHtml"]); ?>
                    <button id="btnComputeSplit" type="button" class="btn btn-outline-danger btn-xs daBtnToolLarge"
                        data-toggle="tooltip" data-placement="bottom" title="Compute Struct" value="Compute Struct"
                        disabled><i class="fas fa-user-cog"></i> Split</button>
                    <button id="btnComputeRegression" type="button" class="btn btn-outline-danger btn-xs daBtnToolLarge"
                        data-toggle="tooltip" data-placement="bottom" title="Compute Struct" value="Compute Struct"
                        disabled><i class="fas fa-user-cog"></i> Regression</button>
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="AnCntx_Nam">Name</label>
                            <input type="text" class="form-control" id="AnCntx_Nam" placeholder="Name ..." value="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="AnCntx_AnNam">AnNam</label>
                            <input type="text" class="form-control" id="AnCntx_AnNam" placeholder="AnNam ..." value=""
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="AnCntx_CntxNam">CntxNam</label>
                            <input type="text" class="form-control" id="AnCntx_CntxNam" placeholder="CntxNam ..."
                                value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="IdSplitTypeSelect">
                            <label for="AnCntx_IdSplitType">IdSplitType</label>
                            <select class="form-control form-control-sm" id="AnCntx_IdSplitType"
                                placeholder="IdSplitType ..." value="">
                            </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-3">
                        <div class="form-group">
                            <label for="AnCntx_SplitTypeNam">SplitTypeNam</label>
                            <input type="text" class="form-control" id="AnCntx_SplitTypeNam" placeholder="SplitTypeNam ..." value="" readonly>
                        </div>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="AnCntx_fileRefTrainDat">fileRefTrainDat</label>
                            <input type="text" class="form-control" id="AnCntx_fileRefTrainDat"
                                placeholder="fileRefTrainDat ..." value="" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="AnCntx_fileRefTestDat">fileRefTestDat</label>
                            <input type="text" class="form-control" id="AnCntx_fileRefTestDat"
                                placeholder="fileRefTestDat ..." value="" disabled>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="AnCntx_fileRefAnCntxDat">File AnCntx di Prj</label>
                            <input type="text" class="form-control" id="AnCntx_fileRefAnCntxDat" placeholder="fileRefAnCntxDat ..." value="" disabled>
                        </div>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group w-100">
                            <label for="AnCntx_Descr">Descr</label>
                            <textarea class="form-control form-control-sm" rows="3" id="AnCntx_Descr"
                                placeholder="Descr ..." value=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- REGRESSION INFO -->
                    <div class="card ">
                        <div class="card-header">
                            <p class="card-title">Regression Params. <small>Look at the script heading for params
                                    details.</small></p><br>
                            <!-- <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div> -->
                        </div>
                        <!-- /.card-header -->
                        <!-- outcome=DAX
                            * &variables=SMI,CAC,FTSE
                            * &controlMethod=repeatedcv
                            * &modelMethods=lm,svmRadial -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="AnCntx_Regr_Outcome">Outcome</label>
                                        <input type="text" class="form-control" id="AnCntx_Regr_Outcome"
                                            placeholder="Outcome ..." value="y">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="AnCntx_Regr_Vars">Vars</label>
                                        <input type="text" class="form-control" id="AnCntx_Regr_Vars"
                                            placeholder="Vars ..." value="x">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="AnCntx_Regr_CtrlMethod">CtrlMethod</label>
                                        <input type="text" class="form-control" id="AnCntx_Regr_CtrlMethod"
                                            placeholder="CtrlMethod ..." value="" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="AnCntx_Regr_ModelMethods">ModelMethods</label>
                                        <input type="text" class="form-control" id="AnCntx_Regr_ModelMethods"
                                            placeholder="ModelMethods ..." value="" disabled>
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
                                        <label for="AnCntx_IdAnCntx">IdAnCntx</label>
                                        <input type="text" class="form-control" id="AnCntx_IdAnCntx"
                                            placeholder="IdAnCntx ..." value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="AnCntx_IdAn">IdAn</label>
                                        <input type="text" class="form-control" id="AnCntx_IdAn" placeholder="IdAn ..."
                                            value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="AnCntx_IdCntx">IdCntx</label>
                                        <input type="text" class="form-control" id="AnCntx_IdCntx"
                                            placeholder="IdCntx ..." value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="AnCntx_IdPrj">IdPrj</label>
                                        <input type="text" class="form-control" id="AnCntx_IdPrj"
                                            placeholder="IdPrj ..." value="" readonly>
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