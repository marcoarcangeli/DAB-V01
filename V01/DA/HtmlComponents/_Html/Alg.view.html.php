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
                <div class="row">
                    <input id="Alg_btnRefresh" type="button" class="btn btn-outline-secondary btn-xs " value="Refresh"
                        disabled></input>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Alg_Nam">Nam</label>
                            <input type="text" class="form-control" id="Alg_Nam" placeholder="Name ..." value=""
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Alg_AlgCatNam">AlgCatNam</label>
                            <input type="text" class="form-control" id="Alg_AlgCatNam" placeholder="AlgCatNam ..."
                                value="" readonly>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="Alg_AlgStateNam">AlgStateNam</label>
                            <input type="text" class="form-control" id="Alg_AlgStateNam" placeholder="AlgStateNam ..." value=""  readonly>
                        </div>
                    </div> -->
                    <div class="col-md-3">
                        <div class="form-group" id="IdAlgStateselect">
                            <label for="Alg_IdAlgState">IdAlgState</label>
                            <select class="form-control" id="Alg_IdAlgState" placeholder="IdAlgState ..." value=""
                                readonly>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group w-100">
                            <label for="Alg_Descr">Description</label>
                            <textarea class="form-control" rows="3" id="Alg_Descr" placeholder="Description ..."
                                value="" readonly>
                            </textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Alg_fileRefProc">fileRefProc</label>
                            <input type="text" class="form-control" id="Alg_fileRefProc" placeholder="fileRefProc ..."
                                value="" readonly>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
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
                                    <label for="Alg_IdAlg">IdAlg</label>
                                    <input type="text" class="form-control" id="Alg_IdAlg" placeholder="IdAlg ..."
                                        value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Alg_IdAlgCat">IdAlgCat</label>
                                    <input type="text" class="form-control" id="Alg_IdAlgCat" placeholder="IdAlgCat ..."
                                        value="" readonly>
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Alg_IdAlgState">IdAlgState</label>
                                    <input type="text" class="form-control" id="Alg_IdAlgState" placeholder="IdAlgState ..." value="" readonly>
                                </div>
                            </div> -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!--/.tech-info -->
            </form>
            <!-- /.box -->

        </div>
    </div>
</div>