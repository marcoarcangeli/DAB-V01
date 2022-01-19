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
                        <div id="<?php echo $this->PanelBtnsNam; ?>" class="row">
                            <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxHtml"]); ?>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="<?php echo $this->TlistDataTblNam; ?>"
                            class="table table-bordered table-hover display">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
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