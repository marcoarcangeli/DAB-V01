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
                <div id="PrjStateBtns" class="row">
                    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxReadHtml"]); ?>
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="PrjState_Nam">Name</label>
                            <input type="text" class="form-control" id="PrjState_Nam" placeholder="PrjState_Nam ..."
                                value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group w-100">
                            <label for="PrjState_Descr">Description</label>
                            <textarea class="form-control" rows="3" id="PrjState_Descr" placeholder="PrjState_Descr ..."
                                value=""></textarea>
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
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="PrjState_IdPrjState">IdPrjState</label>
                                    <input type="text" class="form-control" id="PrjState_IdPrjState"
                                        placeholder="IdPrjState ..." value="" readonly>
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