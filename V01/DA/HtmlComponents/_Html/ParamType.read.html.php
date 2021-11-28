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
                <div id="ParamTypeBtns"class="row">
                    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxReadHtml"]); ?>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ParamType_Nam">Name</label>
                            <input type="text" class="form-control" id="ParamType_Nam" placeholder="Name ..." value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ParamType_ParamTypeCatNam">ParamTypeCatNam</label>
                            <input type="text" class="form-control" id="ParamType_ParamTypeCatNam"
                                placeholder="ParamTypeCatNam ..." value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group w-100">
                            <label for="ParamType_Descr">Description</label>
                            <textarea class="form-control" rows="3" id="ParamType_Descr" placeholder="Description ..."
                                value=""></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ParamType_Unit">Unit</label>
                            <input type="text" class="form-control" id="ParamType_Unit" placeholder="Unit ..." value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ParamType_vlDefault">vlDefault</label>
                            <input type="text" class="form-control" id="ParamType_vlDefault" placeholder="vlDefault ..."
                                value="">
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="ParamType_IdParamTypeCat">IdParamTypeCat</label>
                            <select class="form-control form-control-sm" id="ParamType_IdParamTypeCat" placeholder="IdParamTypeCat ..." value="">
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
                                    <label for="ParamType_IdParamType">IdParamType</label>
                                    <input type="text" class="form-control" id="ParamType_IdParamType"
                                        placeholder="IdParamType ..." value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ParamType_IdParamTypeCat">IdParamTypeCat</label>
                                    <input type="text" class="form-control" id="ParamType_IdParamTypeCat"
                                        placeholder="IdParamTypeCat ..." value="" readonly>
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