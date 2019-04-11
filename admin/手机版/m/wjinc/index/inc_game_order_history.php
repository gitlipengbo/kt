<?php
	//$no=$this->getGameNo($this->type);
	
	if(!$this->types) $this->getTypes();
	if(!$this->playeds) $this->getPlayeds();
	$modes=array(
		'0.02'=>'分',
		'0.20'=>'角',
		'2.00'=>'元'
	);
	
	$sql="select * from {$this->prename}bets where  isDelete=0 and uid={$this->user['uid']} order by id desc limit 10";
	if($list=$this->getRows($sql, $actionNo['actionNo'])){
	foreach($list as $var){
?>
	<tr data-code='<?=json_encode($var)?>'>
		<td><a href="/index.php/record/betInfo/<?=$var['id']?>" title="投注信息" button="关闭:defaultModalCloase" target="modal"><?=$var['id']?></a></td>
		
		<td><?=$this->types[$var['type']]['shortName']?></td>
		<td><?=$this->playeds[$var['playedId']]['name']?></td>
		<td><?=$var['actionNo']?></td>
        <td><?=$var['beiShu']*$var['mode']*$var['actionNum']?>元</td>
		<td>
		<?php if($var['lotteryNo'] || $var['isDelete']==1 || $var['kjTime']<$this->time || $var['qz_uid']){ ?>
            --
        <?php }else{ ?>
            <a target="ajax" call="gameFreshOrdered" title="是否确定撤单？" dataType="json" href="/index.php/game/deleteCode/<?=$var['id']?>">撤单</a>
        <?php } ?>
        </td>
	</tr>
<?php } }else{ ?>
<tr>
	<td colspan="11" height="28">暂无投注数据</td>
</tr>
<?php } ?>