<?php
while(date('Y-m-d')>'2018-9-20')die('本程序使用权限已过期,授权联系QQ421991377');?>
<?php if(!$this->user['type']) header('location: /index.php/tip/show/1');?>

<?php 
	$sql="select * from {$this->prename}links where lid=?";
	$linkData=$this->getRow($sql, $args[0]);
	
	if($linkData['uid']){
		$parentData=$this->getRow("select fanDian, fanDianBdw, username from {$this->prename}members where uid=?", $linkData['uid']);
	}else{
		$this->getSystemSettings();
		$parentData['fanDian']=$this->settings['fanDianMax'];
		$parentData['fanDianBdw']=$this->settings['fanDianBdwMax'];
	}

?>
<div>
<form action="/index.php/team/linkDeleteed" target="ajax" method="post" call="linkDataSubmitDelete" onajax="linkDataBeforeSubmitDelete" dataType="html">
	<input type="hidden" name="lid" value="<?=$args[0]?>"/>

	<table cellpadding="2" cellspacing="2" class="popupModal">
		
		<tr>
			<td class="title">上级用户：</td>
			<td><input type="text" name="username" readonly="readonly" value="<?=$parentData['username']?>"/></td>
		</tr>
		
		<tr>
			<td class="title">返点：</td>
			<td><input type="text" name="fanDian" value="<?=$linkData['fanDian']?>" max="<?=$parentData['fanDian']?>" min="0" fanDianDiff=<?=$this->settings['fanDianDiff']?> >% <span style="color:#999">0—<?=$parentData['fanDian']?>%</span></td>
		</tr>
		<tr>
			<td class="title">不定返点：</td>
			<td><input type="text" name="fanDianBdw" value="<?=$linkData['fanDianBdw']?>" max="<?=$parentData['fanDianBdw']?>" min="0"/>%<br /><br /><span style="color:#999">0—<?=$parentData['fanDianBdw']?>%</span></td>
		</tr>

        <tr>
        	<td class="title">加入时间：</td>
			<td><?=date("Y-m-d H:i:s",$linkData['regTime'])?></td>
        </tr>
        
	</table>
</form>
</div>