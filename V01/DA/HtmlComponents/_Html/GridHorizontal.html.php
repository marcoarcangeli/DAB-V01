<?php
/* gridHorizontal Container */
echo '
<div class="row">
    ';
    $i = 0;
    foreach ($this->ObjsHeader2[0] as $title) {
        echo  $this->Objs[0][$i]->Html("OK");
        $i += 1;
    }
    //---
    echo '
</div>
';
