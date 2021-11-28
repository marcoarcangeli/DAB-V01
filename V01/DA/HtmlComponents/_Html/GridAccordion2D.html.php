<?php
/* gridAccordion2D Container */
echo '
<div class="col-md-12">
    <div class="card <?php echo $this->Col_H; ?>">
        <div class="card-header">
            <h3 class="card-title">'.$this->ObjsHeader[0].'&emsp;</h3><i id="gridInfo" class="badge badge-primary left da-grid-info"></i>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="accordion">';
    $i = 0;
    foreach ($this->ObjsHeader2 as $RowHeaders) {
    echo '
                <div class="da-line card card-default">
                    <div class="card-header ">
                        <h4 class="card-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'">';
                        echo $this->ObjsHeader1[$i];
                        echo '</a>
                        </h4>&emsp;<i class="badge badge-info left da-line-info"></i>
                        <div class="card-tools">
                            <!-- <button type="button" class="btn btn-tool da-collapse-horizontal" da-col-sm="col-sm-<?php echo $this->Col_Lg; ?>"><i class="fas fa-arrow-left"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button> -->
                            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                        </div>
                    </div>
                    <div id="collapse'.$i.'" class="panel-collapse collapse in">
                        <div class="card-body">
                        <!-- <h6 class="card-title">Special title treatment</h6> -->
                        <div class="row mt-4 md-4">

                        ';
                        $j = 0;
                        foreach ($RowHeaders as $title) {
                            echo $this->Objs[$i][$j]->Html("OK");
                            $j += 1;
                        }
                        //---
                        echo '
                        
                        </div>
                        </div>
                    </div>
                </div>
               <!-- / accordion row -->
               ';
    $i += 1;
}
               //---
echo '
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>';