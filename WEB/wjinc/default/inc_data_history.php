<?php

$sql="select {$this->prename}data.time, {$this->prename}data.number, {$this->prename}data.data ,{$this->prename}type.title from {$this->prename}data INNER JOIN {$this->prename}type ON {$this->prename}data.type={$this->prename}type.id where {$this->prename}data.type={$args[0]} order by {$this->prename}data.number desc,{$this->prename}data.time desc limit 1";
	if($data=$this->getRows($sql)) foreach($data as $var){
	  


$shuzu=explode(",",$var['data']); 
$count=count($shuzu); 
for($i=0;$i<$count;$i++) 
{ 
echo "&nbsp;<B class=b-red-20>".$shuzu[$i]."</B>"; 
} 
echo"</P>";
echo"<P class=awards gray> 第 ".$var['number']." 期</P>";
echo"<P class=red>开奖时间：".date('H:i:s',$var['time'])."</P>";

}

?> 