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
                <div id="StVarCatBtns" class="row">
                    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxCatReadHtml"]); ?>
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="StVarCat_Nam">Name</label>
                                    <input type="text" class="form-control" id="StVarCat_Nam"
                                        placeholder="StVarCat_Nam ..." value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="StVarCat_StVarCatParNam">StVarCatParNam</label>
                                    <input type="text" class="form-control" id="StVarCat_StVarCatParNam"
                                        placeholder="StVarCatParNam ..." value="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group w-100">
                                    <label for="StVarCat_Descr">Description</label>
                                    <textarea class="form-control" rows="3" id="StVarCat_Descr"
                                        placeholder="StVarCat_Descr ..." value=""></textarea>
                                </div>
                            </div>
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="StVarCat_IdStVarCat">IdStVarCat</label>
                                    <input type="text" class="form-control" id="StVarCat_IdStVarCat"
                                        placeholder="StVarCat_IdStVarCat ..." value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="StVarCat_IdStVarCatPar">IdStVarCatPar</label>
                                    <input type="text" class="form-control" id="StVarCat_IdStVarCatPar"
                                        placeholder="StVarCat_IdStVarCatPar ..." value="" readonly>
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