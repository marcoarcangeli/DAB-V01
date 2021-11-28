<div class="da-column col-sm-<?php echo $this->Col_Lg; ?>">
    <div id="UsrProfileTlist" class="card <?php echo $this->Col_H; ?>">
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
                        <div id="UsrProfileTlistBtns" class="row">
                            <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxTlistHtml"]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="UsrProfileTlist_IdUsr">IdUsr</label>
                                <input type="text" class="form-control" id="UsrProfileTlist_IdUsr" placeholder="IdUsr ..."
                                    value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="UsrProfileTlist_UsrNam">UsrNam</label>
                                <input type="text" class="form-control" id="UsrProfileTlist_UsrNam" placeholder="UsrNam ..."
                                    value="" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="box-body">
                        <table id="UsrProfileList" class="table table-bordered table-hover display">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Id User</th>
                                    <th>User Name</th>
                                    <th>Id Profile</th>
                                    <th>Profile</th>
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

        </div>
    </div>
</div>