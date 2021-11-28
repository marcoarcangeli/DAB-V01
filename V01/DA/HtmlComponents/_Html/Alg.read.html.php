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
                <div id="AlgReadBtns" class="row">
                    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxReadHtml"]); ?>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="AlgRead_Nam">Nam</label>
                            <input type="text" class="form-control" id="AlgRead_Nam" placeholder="Name ..." value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="AlgRead_AlgCatNam">AlgCatNam</label>
                            <input type="text" class="form-control" id="AlgRead_AlgCatNam" placeholder="AlgCatNam ..." value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="AlgRead_CatTag">AlgCatTag</label>
                            <input type="text" class="form-control" id="AlgRead_CatTag" placeholder="AlgCatTag ..." value="" >
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group" id="IdAlgStateselect">
                            <label for="AlgRead_IdAlgState">IdAlgState</label>
                            <select class="form-control" id="AlgRead_IdAlgState" placeholder="IdAlgState ..." value="">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group w-100">
                            <label for="AlgRead_Descr">Description</label>
                            <textarea class="form-control" rows="3" id="AlgRead_Descr" placeholder="Description ..." value=""></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="AlgRead_fileRefProc">fileRefProc</label>
                            <input type="text" class="form-control" id="AlgRead_fileRefProc" placeholder="fileRefProc ..." value="">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <!-- TECH INFO -->
                <div class="card collapsed-card ">
                    <div class="card-header">
                        <p class="card-title">Tech Info</p>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="AlgRead_IdAlg">IdAlg</label>
                                    <input type="text" class="form-control" id="AlgRead_IdAlg" placeholder="IdAlg ..." value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="AlgRead_IdAlgCat">IdAlgCat</label>
                                    <input type="text" class="form-control" id="AlgRead_IdAlgCat" placeholder="IdAlgCat ..." value="" readonly>
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