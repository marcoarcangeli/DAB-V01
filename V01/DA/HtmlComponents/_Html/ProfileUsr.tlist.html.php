<div class="da-column col-sm-<?php echo $this->Col_Lg; ?>">
    <div id="<?php echo $this->WhoIAm; ?>" class="card <?php echo $this->Col_H; ?>">
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
                        <div id="ProfileUsrTlistBtns" class="row">
                            <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxHtml"]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["InRefsNamsHTML"]); ?>
                    </div>
                    <!-- /.row -->
                    <div class="box-body">
                        <table id="<?php echo $this->TlistDataTblNam; ?>"
                            class="table table-bordered table-hover display">
                            <thead>
                                <tr>
                                    <?php echo $this->TlistColumnsHTML; ?>
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
                        <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["InRefsIdsHTML"]); ?>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!--/.tech-info -->

        </div>
    </div>
</div>