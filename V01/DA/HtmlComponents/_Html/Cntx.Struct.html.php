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
                <div id="CntxStructBtns" class="row">
                    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxStructHtml"]); ?>
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- checkbox -->
                        <div class="form-group">
                            <!-- <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="CntxStruct_enum" value="">
                                <label for="CntxStruct_enum" class="custom-control-label">Enum</label>
                            </div> -->
                            <div id="CntxStructTlist">

                            </div>
                        </div>
                        <!-- <table id="CntxFileDatList" class="table table-bordered table-hover display"> -->
                        <!-- <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                </tr>
                            </thead> -->
                        <!-- <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                </tr>
                            </tfoot> -->
                        <!-- </table> -->

                    </div>
                </div>

                <!-- /.box-body -->
                <!-- .box-footer content -->
                <!-- /.box-footer -->
            </form>
            <!-- /.box -->

        </div>
    </div>
</div>