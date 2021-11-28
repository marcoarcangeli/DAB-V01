<?php
/* gridVertical Container */
echo '
<div class="row">
    <div class="col-md-12">';
//---
$i = 0;
foreach ($this->ObjsHeader2[0] as $title) {
    echo  $this->Objs[0][$i]->Html("OK");
    $i += 1;
}
//---
echo '
    </div>
    <!-- /.col- -->
</div>
<!-- /.row -->
<!-- /.content -->
';

