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
                <!-- <div class="box box-primary"> -->
                <div class="card <?php echo $this->Col_H; ?>">
                    <div id="<?php echo $this->PanelBtnsNam; ?>" class="row">
                        <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxHtml"]); ?>
                    </div>
                </div>
                <!-- UPLOAD AREA -->
                <div id="<?php echo $this->PanelTag; ?>UploadFiles" class="daHidden">
                    <form id="UploadFiles" method="POST" 
                        action="<?php echo $_SESSION["HtmlComponentsCommonRelPath"].$_SESSION["UploadFilesPhp"]; ?>"
                        enctype="multipart/form-data">
                        <input type="file" class="custom-file-input" id="upl" name="upl">
                        </input>
                        <input id="AllowedUploadFileExt" type="hidden" name="AllowedUploadFileExt">
                        <input id="uplName" type="hidden" name="uplName">
                        <input id="dstFolder" type="hidden" name="dstFolder">
                    </form>
                </div>
                <div id="<?php echo $this->PanelTag; ?>DropFiles" class="form-group">
                    <div class="btn btn-outline-primary btn-xs daDropFilesArea" id="dropFiles">
                        Click or Drop Here
                    </div>
                </div>
                <!-- /UPLOAD AREA -->
                <div class="card-body">
                    <table id="<?php echo $this->TlistDataTblNam; ?>" 
                        class="table table-bordered table-hover display">
                        <thead>
                            <tr>
                                <th>File Nam</th>
                                <!-- <th>Stato</th> -->
                            </tr>
                        </thead>
                        <!-- <tfoot>
                                <tr>
                        <th>Nam File</th>
                        <th>Stato</th>
                                </tr>
                            </tfoot> -->
                    </table>
                </div>
                <!-- /.box -->
                <div class="box-footer">
                    <!--div>Numero di Elementi: </div -->
                    <input id="<?php echo $this->PanelTag; ?>SelectedFile" type="hidden" name="<?php echo $this->PanelTag; ?>SelectedFile" value="">
                </div>
                <!-- </div> -->
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
                        <!-- <php include($_SESSION["ContentCommonRelPath"].$_SESSION["InRefsIdsHTML"]); ?> -->
                        <?php echo $this->InRefsIdsHTML; ?>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!--/.tech-info -->
        </div>
    </div>
</div>