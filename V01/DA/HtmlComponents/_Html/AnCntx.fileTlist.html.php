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
            <!-- <div class="row"> -->
            <div class="col-md-12">
                <!-- general form elements -->
                <!-- <div class="box box-primary"> -->
                <div class="card <?php echo $this->Col_H; ?>">
                    <div id="AnCntx_FileTlistBtns" class="row">
                        <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxFileTlistHtml"]); ?>
                    </div>
                </div>
                <div id="AnCntx_FileTlist_UploadFiles" class="daHidden">
                    <form id="UploadFiles" method="POST" action="DA/HtmlComponents/Common/UploadFiles.php"
                        enctype="multipart/form-data">
                        <input type="file" class="custom-file-input" id="upl" name="upl">
                        </input>
                        <input id="AllowedUploadFileExt" type="hidden" name="AllowedUploadFileExt">
                        <input id="uplName" type="hidden" name="uplName">
                        <input id="dstFolder" type="hidden" name="dstFolder">
                    </form>
                </div>
                <div id="AnCntx_FileTlist_DropFiles" class="form-group">
                    <div class="btn btn-outline-primary btn-xs daDropFilesArea" id="dropFiles">
                        Click or Drop Here
                    </div>
                </div>
                <div class="card-body">
                    <table id="AnCntxList" class="table table-bordered table-hover display">
                        <thead>
                            <tr>
                                <th>File Nam</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.box -->
                <div class="box-footer">
                    <!--div>Numero di Elementi: </div -->
                    <input id="AnCntx_SelectedFile" type="hidden" name="AnCntx_SelectedFile" value="">
                </div>
                <!-- </div> -->
                <!-- /div -->
            </div>
            <!-- /.col-md-8 -->
            <!-- </div> -->
            <!-- /.row -->

        </div>
    </div>
</div>