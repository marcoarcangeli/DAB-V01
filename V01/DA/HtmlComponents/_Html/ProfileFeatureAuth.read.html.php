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
                <div id="ProfileFeatureAuthBtns" class="row">
                    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxReadHtml"]); ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="ProfileFeatureAuth_ProfileNam">ProfileNam</label>
                            <input type="text" class="form-control" id="ProfileFeatureAuth_ProfileNam" placeholder="ProfileNam ..."
                                value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" id="IdFeatureselect">
                            <label for="ProfileFeatureAuth_IdFeature">IdFeature</label>
                            <select class="form-control" id="ProfileFeatureAuth_IdFeature" placeholder="IdFeature ..." value="">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                   <div class="col-md-12">
                        <div class="form-group" id="IdAuthLevelselect">
                            <label for="ProfileFeatureAuth_IdAuthLevel">IdAuthLevel</label>
                            <select class="form-control" id="ProfileFeatureAuth_IdAuthLevel" placeholder="IdAuthLevel ..." value="">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ProfileFeatureAuth_IdProfileFeatureAuth">IdProfileFeatureAuth</label>
                                    <input type="text" class="form-control" id="ProfileFeatureAuth_IdProfileFeatureAuth"
                                        placeholder="IdProfileFeatureAuth ..." value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ProfileFeatureAuth_IdProfile">IdProfile</label>
                                    <input type="text" class="form-control" id="ProfileFeatureAuth_IdProfile"
                                        placeholder="IdProfile ..." value="" readonly>
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