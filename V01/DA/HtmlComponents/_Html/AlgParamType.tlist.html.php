<div class="da-column col-sm-<?php echo $this->Col_Lg; ?>">
    <div id="AlgParamTypeTlist" class="card <?php echo $this->Col_H; ?>">
        <div class="card-header">
            <h6 class="card-title"><?php echo $this->Header; ?></h6>
            <div class="card-tools">
                <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["cardToolsHtml"]); ?>
            </div>
        </div>
        <div class="card-body">
            <!-- <h6 class="card-title">Special title treatment</h6> -->
            <!-- <div class="row"> -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div id="AlgParamTypeTlistBtns" class="row">
                            <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxTlistHtml"]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="AlgParamTypeTlist_IdParamType">IdParamType</label>
                                <input type="text" class="form-control" id="AlgParamTypeTlist_IdParamType"
                                    placeholder="IdParamType ..." value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="AlgParamTypeTlist_ParamTypeNam">ParamTypeNam</label>
                                <input type="text" class="form-control" id="AlgParamTypeTlist_ParamTypeNam"
                                    placeholder="ParamTypeNam ..." value="" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="AlgParamTypeTlist_IdAlg">IdAlg</label>
                                <input type="text" class="form-control" id="AlgParamTypeTlist_IdAlg" placeholder="IdAlg ..."
                                    value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="AlgParamTypeTlist_AlgNam">AlgNam</label>
                                <input type="text" class="form-control" id="AlgParamTypeTlist_AlgNam" placeholder="AlgNam ..."
                                    value="" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="box-body">
                        <table id="AlgParamTypeList" class="table table-bordered table-hover display">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>IdCat</th>
                                    <th>Cat</th>
                                    <th>IdType</th>
                                    <th>TypeNam</th>
                                    <th>Nam</th>
                                    <th>Descr</th>
                                    <th>Unit</th>
                                    <th>Default</th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Unità di Misura</th>
                        <th>Description</th>
                    </tr>
                </tfoot> -->
                        </table>
                    </div>
                    <!-- /.box -->
                    <div class="box-footer">
                        <!--div>Numero di Elementi: </div -->
                    </div>
                </div>
                <!-- /div -->
            </div>
            <!-- /.col-md-8 -->
            <!-- </div> -->
            <!-- /.row -->

        </div>
    </div>
</div>