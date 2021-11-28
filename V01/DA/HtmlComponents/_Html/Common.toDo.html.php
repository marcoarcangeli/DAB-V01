<!-- <div class="col-lg-8"> -->
<div class="da-column col-sm-<?php echo $this->Col_Lg; ?>">
    <div class="card <?php echo $this->Col_H; ?>">
        <div class="card-header">
            <h6 class="card-title">Pannello da implementare ...</h6>
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
                    <!-- <input id="btnOpenPrj" type="button" class="btn btn-outline-success btn-xs" value="Open" disabled></input>
                    <input id="btnNewPrj" type="button" class="btn btn-outline-primary btn-xs" value="New"></input>
                    <input id="btnSavePrj" type="button" class="btn btn-outline-primary btn-xs" value="Save"></input>
                    <input id="btnRefreshPrj" type="button" class="btn btn-default btn-xs " value="Refresh" disabled></input>
                    <input id="btnDeletePrj" type="button" class="btn btn-default btn-xs" value="Delete" disabled></input> -->
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-11">
                        <div class="form-group">
                            <label for="Prj_Nam">Pannello da implementare ...</label>
                            <!-- <input type="text" class="form-control" id="Prj_Nam" placeholder="Name ..." value=""> -->
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="form-group w-100">
                            <label for="Prj_Descr">Description</label>
                            <textarea class="form-control form-control-sm" rows="3" id="Prj_Descr" placeholder="Description ..." value=""></textarea>
                        </div>
                    </div>
                </div> -->
            </form>
            <!-- /.box -->
        </div>
    </div>
</div>