<?php
	$this->getTypes();
	$this->getPlayeds();
	
	// 日期限制
	if($_REQUEST['fromTime'] && $_REQUEST['toTime']){
		$timeWhere=' and l.actionTime between '. strtotime($_REQUEST['fromTime']).' and '.strtotime($_REQUEST['toTime']);
	}elseif($_REQUEST['fromTime']){
		$timeWhere=' and l.actionTime >='. strtotime($_REQUEST['fromTime']);
	}elseif($_REQUEST['toTime']){
		$timeWhere=' and l.actionTime <'. strtotime($_REQUEST['toTime']);
	}else{
		
		if($GLOBALS['fromTime'] && $GLOBALS['toTime']) $timeWhere=' and l.actionTime between '.$GLOBALS['fromTime'].' and '.$GLOBALS['toTime'].' ';
	}
	
	// 帐变类型限制
	if($_REQUEST['liqType']){
		$liqTypeWhere=' and liqType='.$_REQUEST['liqType'];
		if($_REQUEST['liqType']==2) $liqTypeWhere=' and liqType between 2 and 3';
	}
	

	//用户限制
	$userWhere=" and u.uid={$this->user['uid']}";
	
	// 冻结查询
	if($this->action=='fcoinModal'){
		$fcoinModalWhere='and l.fcoin!=0';
	}
	
	$sql="select b.type, b.playedId, b.actionNo, b.mode, l.liqType, l.coin, l.fcoin, l.userCoin, l.actionTime, l.extfield0, l.extfield1, l.info, u.username from {$this->prename}members u, {$this->prename}coin_log l left join {$this->prename}bets b on b.id=extfield0 where l.uid=u.uid $liqTypeWhere $timeWhere $userWhere $typeWhere $fcoinModalWhere and l.liqType not in(4,11,104) order by l.id desc";
	//echo $sql;
	
	$list=$this->getPage($sql, $this->page, $this->pageSize);
	$params=http_build_query($_REQUEST, '', '&');
	$modeName=array('2.00'=>'元', '0.20'=>'角', '0.02'=>'分');
	$liqTypeName=array(
		1=>'账户充值',
		2=>'游戏返点',
		6=>'奖金派送',
		7=>'撤单返款',
		8=>'提现失败',
		9=>'系统充值',
		51=>'活动礼金',
		53=>'消费佣金',
		101=>'投注扣款',
		102=>'追号扣款',
		106=>'账户提现',
		107=>'提现成功',
		108=>'开奖扣除冻结金额'
	);
	
?>
<div>
<table width="100%" class='table_b'>
	<thead>
		<tr class="table_b_th">
			<td>时间</td>
			<td>用户名</td>
			<td>帐变类型</td>
			<td>单号</td>
			<td>游戏</td>
			<td>玩法</td>
			<td>期号</td>
			<td>模式</td>
			<td>资金</td>
			<td>余额</td>
		</tr>
	</thead>
	<tbody class="table_b_tr">
		<?php if($list['data']) foreach($list['data'] as $var){ ?>
		<tr>
			<td><?php echo substr(date('Y-m-d H:i:s', $var['actionTime']),2)?></td>
			<td><?=$var['username']?></td>
			<td><?=$liqTypeName[$var['liqType']]?></td>
			<!-- <td><?//=$var['info']?></td> -->
			
			<?php if($var['extfield0'] && in_array($var['liqType'], array(2,3,4,5,6,7,10,11,100,101,102,103,104,105,108))){ ?>
                <td><a href="/index.php/record/betInfo2/<?=$var['extfield0']?>" width="300" title="投注信息" target="modal"><?=$var['extfield0']?></a>
                </td>
                <td><?=$this->types[$var['type']]['shortName']?></td>
                <td><?=$this->playeds[$var['playedId']]['name']?></td>
                <td><?=$var['actionNo']?></td>
                <td><?=$modeName[$var['mode']]?></td>
			<?php }elseif(in_array($var['liqType'], array(1,9,52))){?>
                <td><a href="/index.php/cash/rechargeModal/<?=$var['extfield0']?>" width="300" title="充值信息" target="modal"><?=$var['extfield1']?></a></td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
			<?php }elseif(in_array($var['liqType'], array(8,106,107))){?>
                <td><a href="/index.php/cash/cashModal/<?=$var['extfield0']?>" width="500" title="提现信息" target="modal"><?=$var['extfield0']?></a></td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                
            <?php }else{ ?>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
            <?php } ?>
            
            <td><?=number_format($var['coin'],2)?></td>
			<td><?=$var['userCoin']?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php 
	$this->display('inc_page.php',0,$list['total'],$this->pageSize, "/index.php/{$this->controller}/{$this->action}-{page}/{$this->type}?$params");
?>
</div>