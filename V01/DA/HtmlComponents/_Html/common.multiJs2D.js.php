<?php

foreach ($this->Objs as $RowObjs) {
    foreach ($RowObjs as $Obj) {
        echo $Obj->Js("OK");
    }
}
