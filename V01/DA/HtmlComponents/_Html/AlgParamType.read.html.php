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
                <div id="AlgParamTypeBtns" class="row">
                    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxReadHtml"]); ?>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="AlgParamType_Nam">Name</label>
                            <input type="text" class="form-control" id="AlgParamType_Nam" placeholder="Name ..."
                                value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="AlgParamType_ParamTypeNam">ParamTypeNam</label>
                            <input type="text" class="form-control" id="AlgParamType_ParamTypeNam"
                                placeholder="ParamTypeNam ..." value="" readonly>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="AlgParamType_AlgNam">AlgNam</label>
                            <input type="text" class="form-control" id="AlgParamType_AlgNam" placeholder="AlgNam ..."
                                value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group w-100">
                            <label for="AlgParamType_Descr">Description</label>
                            <textarea class="form-control" rows="3" id="AlgParamType_Descr"
                                placeholder="Description ..." value=""></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="AlgParamType_Unit">Unit</label>
                            <input type="text" class="form-control" id="AlgParamType_Unit" placeholder="Unit ..."
                                value="" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="AlgParamType_vlDefault">vlDefault</label>
                            <input type="text" class="form-control" id="AlgParamType_vlDefault"
                                placeholder="vlDefault ..." value="">
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="AlgParamType_IdAlg">IdAlg</label>
                            <select class="form-control form-control-sm" id="AlgParamType_IdAlg" placeholder="IdAlg ..." value="">
                            </select>
                        </div>
                    </div> -->
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
                                    <label for="AlgParamType_IdAlgParamType">IdAlgParamType</label>
                                    <input type="text" class="form-control" id="AlgParamType_IdAlgParamType"
                                        placeholder="IdAlgParamType ..." value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="AlgParamType_IdParamType">IdParamType</label>
                                    <input type="text" class="form-control" id="AlgParamType_IdParamType"
                                        placeholder="IdParamType ..." value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="AlgParamType_IdAlg">IdAlg</label>
                                    <input type="text" class="form-control" id="AlgParamType_IdAlg"
                                        placeholder="IdAlg ..." value="" readonly>
                                </div>
                            </div>
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