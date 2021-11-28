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
                <div id="SplitTypeBtns" class="row">
                    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxReadHtml"]); ?>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="SplitType_Nam">Name</label>
                            <input type="text" class="form-control" id="SplitType_Nam" placeholder="Name ..." value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="SplitType_SplitCatNam">SplitCatNam</label>
                            <input type="text" class="form-control" id="SplitType_SplitCatNam"
                                placeholder="SplitCatNam ..." value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group w-100">
                            <label for="SplitType_Descr">Description</label>
                            <textarea class="form-control" rows="3" id="SplitType_Descr" placeholder="Description ..."
                                value=""></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="SplitType_Perc">Perc</label>
                            <input type="text" class="form-control" id="SplitType_Perc" placeholder="Perc ..." value="">
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="SplitType_IdSplitCat">IdSplitCat</label>
                            <select class="form-control form-control-sm" id="SplitType_IdSplitCat" placeholder="IdSplitCat ..." value="">
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
                                    <label for="SplitType_IdSplitType">IdSplitType</label>
                                    <input type="text" class="form-control" id="SplitType_IdSplitType"
                                        placeholder="IdSplitType ..." value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="SplitType_IdSplitCat">IdSplitCat</label>
                                    <input type="text" class="form-control" id="SplitType_IdSplitCat"
                                        placeholder="IdSplitCat ..." value="" readonly>
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