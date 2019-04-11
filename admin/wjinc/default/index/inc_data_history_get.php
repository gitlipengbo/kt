<table border='0' cellspacing='0' cellpadding='0' width=100%>
<tr align=center>
<td>期号</td><td>开奖号码</td></tr>
<?php
	$sql="select time, number, data from {$this->prename}data where type={$this->type} order by number desc,time desc limit 10";
	if($data=$this->getRows($sql)) foreach($data as $var){
	  if($this->type==24){ //快乐8
	  $datan=explode("|",$var['data']);
?>



<tr align=cente ><td><?=$var['number']?></td><td title='<?=$datan[0]?>'><?=$datan[0]?></td><td title='<?=$datan[1]?>'><?=$datan[1]?></td></tr>
<?php }else{ ?>
	<tr align=center><td width=35% height=35><?=$var['number']?></td><td ><?$shuzu=explode(",",$var['data']); 
$count=count($shuzu); 
for($i=0;$i<$count;$i++) 
{ 
echo "<B class=b-red-20>".$shuzu[$i]."</B>"; 
}?></td></tr> 
<?php } } ?>
</table>