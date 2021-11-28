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
                <div class="row">
                    <!-- <button id="btnBack" type="button" class="btn btn-default btn-xs">&lt;</button> -->
                    <!-- <button id="btnModal" type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-xl">Zoom</button> -->
                    <!-- <button id="btnModal" type="button" class="btn btn-default btn-xs">Zoom</button> -->
                    <input id="btnNewOpDatCat" type="button" class="btn btn-outline-primary btn-xs" value="New"></input>
                    <input id="btnSaveOpDatCat" type="button" class="btn btn-outline-primary btn-xs"
                        value="Save"></input>
                    <input id="btnRefreshOpDatCat" type="button" class="btn btn-outline-secondary btn-xs "
                        value="Refresh" disabled></input>
                    <input id="btnDeleteOpDatCat" type="button" class="btn btn-outline-secondary btn-xs" value="Delete"
                        disabled></input>
                    <!-- /.box-header -->
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="OpDatCat_Nam">Name</label>
                            <input type="text" class="form-control" id="OpDatCat_Nam" placeholder="Name ..." value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group w-100">
                            <label for="OpDatCat_Descr">Description</label>
                            <textarea class="form-control" rows="3" id="OpDatCat_Descr" placeholder="Description ..."
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
                                    <label for="OpDatCat_idOpDatCat">idOpDatCat</label>
                                    <input type="text" class="form-control" id="OpDatCat_idOpDatCat"
                                        placeholder="IdOpDatCat ..." value="" readonly>
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