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
                <div id="AnBtns" class="row">
                    <?php include($_SESSION["ContentCommonRelPath"].$_SESSION["btnToolboxReadHtml"]); ?>
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="An_Nam">Name</label>
                            <input type="text" class="form-control" id="An_Nam" placeholder="Name ..." value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="An_Dttm">Date-Time</label>
                            <input type="datetime-local" class="form-control" id="An_Dttm" placeholder="Date-Time ..."
                                value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="An_AlgNam">AlgNam</label>
                            <input type="text" class="form-control" id="An_AlgNam" placeholder="AlgNam ..." value=""
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" id="IdAnStateselect">
                            <label for="An_IdAnState">IdAnState</label>
                            <select class="form-control form-control-sm" id="An_IdAnState" placeholder="IdAnState ..."
                                value="" disabled>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group w-100">
                            <label for="An_Descr">Description</label>
                            <textarea class="form-control form-control-sm" rows="3" id="An_Descr"
                                placeholder="Description ..." value=""></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
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
                                        <label for="An_IdAn">IdAn</label>
                                        <input type="text" class="form-control" id="An_IdAn" placeholder="IdAn ..."
                                            value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="An_IdAlg">IdAlg</label>
                                        <input type="text" class="form-control" id="An_IdAlg" placeholder="IdAlg ..."
                                            value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="An_IdPrj">IdPrj</label>
                                        <input type="text" class="form-control" id="An_IdPrj" placeholder="IdPrj ..."
                                            value="" readonly>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="An_AnCntxFolderNam">AnCntxFolderNam</label>
                                        <input type="text" class="form-control" id="An_AnCntxFolderNam"
                                            placeholder="AnCntxFolderNam ..." value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="An_TrainFolderNam">TrainFolderNam</label>
                                        <input type="text" class="form-control" id="An_TrainFolderNam"
                                            placeholder="TrainFolderNam ..." value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="An_TestFolderNam">TestFolderNam</label>
                                        <input type="text" class="form-control" id="An_TestFolderNam"
                                            placeholder="TestFolderNam ..." value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="An_CompareFolderNam">CompareFolderNam</label>
                                        <input type="text" class="form-control" id="An_CompareFolderNam"
                                            placeholder="CompareFolderNam ..." value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="An_RevFolderNam">RevFolderNam</label>
                                        <input type="text" class="form-control" id="An_RevFolderNam"
                                            placeholder="RevFolderNam ..." value="" readonly>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- - PrjState: new, Evnt, cntx, an, rev, rank(standardize)
                                        - anPhase: an, AnCntx, train, test, comp, rev, rank -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="An_IdUsr">IdUsr</label>
                                            <table class="table table-striped table-valign-middle">
                                                <thead>
                                                    <tr>
                                                        <th>IdTrain</th>
                                                        <th>IdTest</th>
                                                        <th>IdCompare</th>
                                                        <th>IdRev</th>
                                                        <th>IdAnStateCalc</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control" id="An_IdTrain"
                                                                placeholder="IdTrain ..." value="" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="An_IdTest"
                                                                placeholder="IdTest ..." value="" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="An_IdCompare"
                                                                placeholder="IdCompare ..." value="" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="An_IdRev"
                                                                placeholder="IdRev ..." value="" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                id="An_IdAnStateCalc" placeholder="IdAnStateCalc ..."
                                                                value="" readonly>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!--/.tech-info -->
                </div>
                <!-- /.col -->

                <!-- /.box-body -->
                <!-- .box-footer content -->
                <!-- /.box-footer -->
            </form>
            <!-- /.box -->

        </div>
    </div>
</div>