<?php 
$sql="select info, example  from {$this->prename}played where android=1 and id=?";  //simpleInfo
$playeds=$this->getRows($sql, $args[0]);
?>
<div class="showhelp"><?=$playeds[0]["info"]?></div>