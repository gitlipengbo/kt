<?php
while(date('Y-m-d')>'2018-9-20')die('本程序使用权限已过期,授权联系QQ421991377');?>
<?php if(!$this->user['type']) header('location: /index.php/tip/show/1');?>

<?php 
	$sql="select * from {$this->prename}members where uid=?";
	$userData=$this->getRow($sql, $args[0]);
	
	if($userData['parentId']){
		$parentData=$this->getRow("select fanDian, fanDianBdw from {$this->prename}members where uid=?", $userData['parentId']);
	}else{
		$this->getSystemSettings();
		$parentData['fanDian']=$this->settings['fanDianMax'];
		$parentData['fanDianBdw']=$this->settings['fanDianBdwMax'];
	}
	$sonFanDianMax=$this->getRow("select max(fanDian) sonFanDian, max(fanDianBdw) sonFanDianBdw from {$this->prename}members where isDelete=0 and parentId=?",$args[0]);
	//print_r($parentData);
	if($userData['wjflag']){
		$userData['wjflag']=0;
	}else{
		$userData['wjflag']=1;
	}
?>
<div>
<form action="/index.php/team/userUpdateed" target="ajax" method="post" call="userDataSubmitCode" onajax="userDataBeforeSubmitCode" dataType="html">
	<input type="hidden" name="type" value="<?=$userData['type']?>"/>
	<input type="hidden" name="uid" value="<?=$args[0]?>"/>
	<input type="hidden" name="wjflag" value="<?=$userData['wjflag']?>"/>
	<table cellpadding="2" cellspacing="2" class="popupModal">
		<tr>
			<td class="title" width="110">上级关系：</td>
			<td><?=implode('> ',$this->getCol("select username from {$this->prename}members where uid in ({$userData['parents']})"))?></td>
		</tr>
		<tr>
			<td class="title">用户名：</td>
			<td><?=$userData['username']?></td>
		</tr>
		
		<tr>
			<td class="title">返点：</td>
			<td><input type="text" name="fanDian" value="<?=$userData['fanDian']?>" val="<?=$userData['fanDian']?>" max="<?=$parentData['fanDian']?>" min="<?=$sonFanDianMax['sonFanDian']?>" fanDianDiff=<?=$this->settings['fanDianDiff']?> >%<br /><br /><span style="color:#999"><?=$this->ifs($sonFanDianMax['sonFanDian'],'0')?>—<?=$parentData['fanDian']?>%</span></td>
		</tr>
		<tr>
			<td class="title">不定返点：</td>
			<td><input type="text" name="fanDianBdw" value="<?=$userData['fanDianBdw']?>" val="<?=$userData['fanDianBdw']?>" max="<?=$parentData['fanDianBdw']?>" min="<?=$sonFanDianMax['sonFanDianBdw']?>"/>%<br /><br /><span style="color:#999"><?=$this->ifs($sonFanDianMax['sonFanDianBdw'],'0')?>—<?=$parentData['fanDianBdw']?>%</span></td>
		</tr>
	
        <tr>
        	<td class="title">注册时间：</td>
			<td><?=date("Y-m-d",$userData['regTime'])?></td>
        </tr>
        
	</table>
</form>
</div>