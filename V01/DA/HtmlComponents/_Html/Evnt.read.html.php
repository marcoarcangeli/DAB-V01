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
                <div id="EvntBtns" class="row">
                    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxReadHtml"]); ?>
                    <button id="btnComputeStruct" type="button" class="btn btn-outline-danger btn-xs daBtnToolLarge"
                        data-toggle="tooltip" data-placement="bottom" title="Compute Struct" value="Compute Struct" disabled><i
                            class="fas fa-user-cog"></i> Structure</button>
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Evnt_Nam">Name</label>
                            <input type="text" class="form-control" id="Evnt_Nam" placeholder="Name ..." value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Evnt_EvntCatNam">EvntCatNam</label>
                            <input type="text" class="form-control" id="Evnt_EvntCatNam" placeholder="EvntCatNam ..."
                                value="" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Evnt_CatTag">EvntCatTag</label>
                            <input type="text" class="form-control" id="Evnt_CatTag" placeholder="CatTag ..." value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Evnt_fileRefRepoDat">fileRefRepoDat</label>
                            <input type="text" class="form-control" id="Evnt_fileRefRepoDat"
                                placeholder="fileRefRepoDat ..." value="" disabled>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="Evnt_fileRefEvntDat">File Evnt di Prj</label>
                            <input type="text" class="form-control" id="Evnt_fileRefEvntDat" placeholder="fileRefEvntDat ..." value="" disabled>
                        </div>
                    </div> -->
                </div>
                <div class="row">
                    <!-- <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Evnt_Overwrite">
                            <label for="Evnt_Overwrite" class="form-check-label">Overwrite Evnt File on Save</label>
                        </div>
                    </div> -->
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Evnt_CsvHeader" checked>
                            <label for="Evnt_CsvHeader" class="form-check-label">CsvHeaders</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Evnt_DecSep">DecSep</label>
                            <input type="text" class="form-control" id="Evnt_DecSep" placeholder="DecSep ..." value=",">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="Evnt_CsvSep">CsvSep</label>
                            <input type="text" class="form-control" id="Evnt_CsvSep" placeholder="CsvSep ..." value=";">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group w-100">
                            <label for="Evnt_Descr">Descr</label>
                            <textarea class="form-control form-control-sm" rows="3" id="Evnt_Descr"
                                placeholder="Descr ..." value=""></textarea>
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
                                        <label for="Evnt_IdEvnt">IdEvnt</label>
                                        <input type="text" class="form-control" id="Evnt_IdEvnt"
                                            placeholder="IdEvnt ..." value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Evnt_IdEvntCat">IdEvntCat</label>
                                        <input type="text" class="form-control" id="Evnt_IdEvntCat"
                                            placeholder="IdEvntCat ..." value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Evnt_IdPrj">IdPrj</label>
                                        <input type="text" class="form-control" id="Evnt_IdPrj" placeholder="IdPrj ..."
                                            value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Evnt_IdUsr">IdUsr</label>
                                        <input type="text" class="form-control" id="Evnt_IdUsr" placeholder="IdUsr ..."
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