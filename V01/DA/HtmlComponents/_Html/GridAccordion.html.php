<?php

echo '
<div class="col-md-6">
    <div class="card <?php echo $this->Col_H; ?>">
        <div class="card-header">
            <h3 class="card-title">'.$this->ObjsHeader[0].'</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="accordion">';
$i = 0;
foreach ($this->ObjsHeader2[0] as $title) {
    echo '
                <div class="da-line card card-default">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'">'
                                .$title 
                          .'</a>
                        </h4>
                    </div>
                    <div id="collapse'.$i.'" class="panel-collapse collapse in">
                        <div class="card-body">
                        <!-- <h6 class="card-title">Special title treatment</h6> -->'
                        . $this->Objs[0][$i]->Html("OK")
                        . '
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
?>

