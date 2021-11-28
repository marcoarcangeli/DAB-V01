<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        &emsp;<h3 class="box-title">Welcome</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="text-center fonts">
                            <div class="card <?php echo $this->Col_H; ?>">
                                <div class="card-header">
                                    <img src="dist/img/<?php echo $_SESSION["Logo"]; ?>" class="img-circle" style="width: 50px;" alt="User Image">
                                    <h6><strong><a href="#" target="_blank"><?php echo $_SESSION["OrgNam"]; ?></a></strong></h6>
                                    <h4 class="m-0"><strong><?php echo $_SESSION["App"]; ?></strong><i style="font-size: 14px;"> V.<?php echo $_SESSION["Version"]; ?></i></h4>
                                    <h5 class="m-0"><?php echo $_SESSION["Title"]; ?></h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="text-center "><?php echo $_SESSION["OrgDttm"]; ?></h6>
                                    <h5><?php echo $_SESSION["OrgDescr"]; ?></h5>
                                    <i>by <?php echo $_SESSION["Author"]; ?></i>
                                    <p><?php echo $_SESSION["Description"]; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->
                    <div class="box-footer" style="font-size: 16px; text-align:center;">
                        <div class="text-center fonts">
                            <div class="row">
                                <!-- <div class="card col-md-8">
                                    <div class="card-header">
                                        <h5 class="m-0">Docs</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                        </div>
                                    </div>
                                </div> -->
                                <div class="card col-md-12">
                                    <div class="card-header">
                                        <h5 class="m-0">Downloads & Source Code Access</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div><a href="./DA/_FsBase/Download/" target="_blank">Source Code (Source Code,FS, DB)</a>
                                                <span class="float-right text-muted text-sm">HTML</span></div>
                                                <div><a href="./DA/" target="_blank">Current Site (HTML access)</a>
                                                <span class="float-right text-muted text-sm">HTML</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.box-primary -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->