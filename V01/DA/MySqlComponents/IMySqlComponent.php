<?php

namespace DA\mySqlComponents;

interface IMySqlComponent
{
    /*  

    */
    // read all testEntitys
    public function selectAll();
    // get single testEntity data
    public function selectSingle();
    // create testEntity
    public function insert();
    // update testEntity 
    public function update();
    // delete testEntity
    public function delete();

}

?>

