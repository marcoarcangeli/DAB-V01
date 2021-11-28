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
                <div id="CntxBtns" class="row">
                    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxReadHtml"]); ?>
                    <button id="btnComputeStruct" type="button" class="btn btn-outline-danger btn-xs daBtnToolLarge"
                        data-toggle="tooltip" data-placement="bottom" title="Compute Struct" value="Compute Struct"
                        disabled><i class="fas fa-user-cog"></i> Structure</button>
                    <button id="btnComputeStVars" type="button" class="btn btn-outline-danger btn-xs daBtnToolLarge"
                        data-toggle="tooltip" data-placement="bottom" title="Compute StVars" value="Compute StVars"
                        disabled><i class="fas fa-user-cog"></i> St.Vars</button>
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Cntx_Nam">Name</label>
                            <input type="text" class="form-control" id="Cntx_Nam" placeholder="Name ..." value="">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="Cntx_EvntNam">EvntNam</label>
                            <input type="text" class="form-control" id="Cntx_EvntNam" placeholder="EvntNam ..." value=""
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Cntx_fileRefDat">fileRefDat</label>
                            <input type="text" class="form-control" id="Cntx_fileRefDat" placeholder="fileRefDat ..."
                                value="" disabled>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="Cntx_fileRefCntxDat">File Cntx di Prj</label>
                            <input type="text" class="form-control" id="Cntx_fileRefCntxDat" placeholder="fileRefCntxDat ..." value="" disabled>
                        </div>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group w-100">
                            <label for="Cntx_Descr">Descr</label>
                            <textarea class="form-control form-control-sm" rows="3" id="Cntx_Descr"
                                placeholder="Descr ..." value=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Cntx_ctsd">ctsd</label>
                            <input type="text" class="form-control" id="Cntx_ctsd" placeholder="ctsd ..." value=""
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Cntx_cnsd">cnsd</label>
                            <input type="text" class="form-control" id="Cntx_cnsd" placeholder="cnsd ..." value=""
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Cntx_cusd">cusd</label>
                            <input type="text" class="form-control" id="Cntx_cusd" placeholder="cusd ..." value=""
                                readonly>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

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
                                        <label for="Cntx_IdCntx">IdCntx</label>
                                        <input type="text" class="form-control" id="Cntx_IdCntx"
                                            placeholder="IdCntx ..." value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Cntx_IdEvnt">IdEvnt</label>
                                        <input type="text" class="form-control" id="Cntx_IdEvnt"
                                            placeholder="IdEvnt ..." value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Cntx_IdPrj">IdPrj</label>
                                        <input type="text" class="form-control" id="Cntx_IdPrj" placeholder="IdPrj ..."
                                            value="" readonly>
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