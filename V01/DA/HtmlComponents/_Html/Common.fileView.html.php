<!-- <div class="col-lg-8"> -->
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
            <!-- general form elements -->
            <!-- form start -->
            <form role="form" method="POST" class="h-75">
                <div id="<?php echo $this->PanelBtnsNam; ?>" class="row">
                    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxHtml"]); ?>
                </div>
                <!-- <div class="row">
                    ?php include($_SESSION["ContentCommonRelPath"].$_SESSION["InRefsNamsHTML"]); ?>
                </div>
                ?php include($_SESSION["ContentCommonRelPath"].$_SESSION["UIFsHTML"]); ?> -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="<?php echo $this->PanelTag; ?>FileNam">Name</label>
                            <input type="text" class="form-control" id="<?php echo $this->PanelTag; ?>FileNam"
                                placeholder="FileNam ..." value="" readonly>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="<?php echo $this->PanelTag; ?>FileRef">Name</label>
                            <input type="text" class="form-control" id="<?php echo $this->PanelTag; ?>FileRef"
                                placeholder="FileRef ..." value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="tab-content h-100">
                    <iframe class="w-100 h-100" id="<?php echo $this->PanelTag; ?>FileViewer" style="border:0; "
                        allowfullscreen></iframe>
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
                            <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["InRefsIdsHTML"]); ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label
                                        for="<?php echo $this->PanelTag; ?><?php echo $this->FEIdNam; ?>"><?php echo $this->FEIdNam; ?></label>
                                    <input type="text" class="form-control"
                                        id="<?php echo $this->PanelTag; ?><?php echo $this->FEIdNam; ?>"
                                        placeholder="<?php echo $this->FEIdNam; ?> ..." value="" readonly>
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
        <!-- /.card-body -->

    </div>
</div>