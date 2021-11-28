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
                <div id="CleanBtns" class="row">
                    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxReadHtml"]); ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group w-100">
                            <label for="Clean_Note">Note</label>
                            <textarea class="form-control form-control-sm" rows="3" id="Clean_Note"
                                placeholder="Note ..." value=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Clean_ctsd">ctsd</label>
                            <input type="text" class="form-control" id="Clean_ctsd" placeholder="ctsd ..." value=""
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Clean_cnsd">cnsd</label>
                            <input type="text" class="form-control" id="Clean_cnsd" placeholder="cnsd ..." value=""
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Clean_cusd">cusd</label>
                            <input type="text" class="form-control" id="Clean_cusd" placeholder="cusd ..." value=""
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Clean_filters">filters</label>
                            <input type="text" class="form-control" id="Clean_filters" placeholder="filters ..."
                                value="" readonly>
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
                                        <label for="Clean_IdClean">IdClean</label>
                                        <input type="text" class="form-control" id="Clean_IdClean"
                                            placeholder="IdClean ..." value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Clean_IdPrj">IdPrj</label>
                                        <input type="text" class="form-control" id="Clean_IdPrj" placeholder="IdPrj ..."
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