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
                        <!-- button id="btnBack" type="button" class="btn btn-default btn-xs">&lt;</button -->
                        <!-- button id="btnRefreshProgetti" type="button" class="btn btn-outline-primary btn-xs" >Update</button -->
                    </div>
                    <div class="box-body">
                        <table id="EvntCatList" class="table table-bordered table-hover display">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>ParentId</th>
                                    <th>Name</th>
                                    <th>Descr</th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>ParentId</th>
                                    <th>Name</th>
                                    <th>Descr</th>
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