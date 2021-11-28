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
            <!-- <div class="row"> -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div id="AlgTlistBtns" class="row">
                            <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxTlistHtml"]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="AlgTlist_IdAlgCat">IdAlgCat</label>
                                <input type="text" class="form-control" id="AlgTlist_IdAlgCat" placeholder="IdAlgCat ..."
                                    value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="AlgTlist_AlgCatNam">AlgCatNam</label>
                                <input type="text" class="form-control" id="AlgTlist_AlgCatNam" placeholder="AlgCatNam ..."
                                    value="" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="box-body">
                        <table id="AlgList" class="table table-bordered table-hover display">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>IdCat</th>
                                    <th>Cat</th>
                                    <th>IdState</th>
                                    <th>State</th>
                                    <th>Name</th>
                                    <th>Descr</th>
                                    <th>FileRefProc</th>
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