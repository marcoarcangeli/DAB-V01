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
                <div id="UsrBtns" class="row">
                    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxReadHtml"]); ?>
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Usr_UsrNam">UsrNam</label>
                            <input type="text" class="form-control" id="Usr_UsrNam" placeholder="UsrNam ..." value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Usr_Pwd">Password</label>
                            <input type="password" class="form-control" id="Usr_Pwd" placeholder="Password ..."
                                value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Usr_FirstNam">FirstNam</label>
                            <input type="text" class="form-control" id="Usr_FirstNam" placeholder="FirstName ..."
                                value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Usr_Nam">Name</label>
                            <input type="text" class="form-control" id="Usr_Nam" placeholder="Name ..." value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Usr_EMail">EMail</label>
                            <input type="text" class="form-control" id="Usr_EMail" placeholder="EMail ..." value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="IdOrganizationselect">
                            <label for="Usr_IdOrganization">IdOrganization</label>
                            <select class="form-control" id="Usr_IdOrganization" placeholder="IdOrganization ..." value="">
                            </select>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Usr_IdUsr">IdUsr</label>
                                    <input type="text" class="form-control" id="Usr_IdUsr" placeholder="IdUsr" value=""
                                        readonly>
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