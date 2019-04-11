
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


	include_once $_SERVER['DOCUMENT_ROOT'].'/lib/classes/Xxtea.class';
	$key=Xxtea::encrypt($args[0].",".$args[1], $args[2]);
	$key=base64_encode($key);
	$key=str_replace(array('+','/','='), array('-','*',''), $key);
	
?><div>

	<table cellpadding="2" cellspacing="2" class="popupModal">
		
         <tr>
        	<td class="title">上级会员：</td>
			<td><?=$parentData['username']?></td>
        </tr>
		<tr>
			<td class="title">返点：</td>
			<td><input type="text" name="fanDian" value="<?=$linkData['fanDian']?>" max="<?=$parentData['fanDian']?>" min="0" fanDianDiff=<?=$this->settings['fanDianDiff']?> >%<br /><br /><span style="color:#999">0—<?=$parentData['fanDian']?>%</span></td>
		</tr>
		<tr>
			<td class="title">不定返点：</td>
			<td><input type="text" name="fanDianBdw" value="<?=$linkData['fanDianBdw']?>" max="<?=$parentData['fanDianBdw']?>" min="0"/>%<br /><br /><span style="color:#999">0—<?=$parentData['fanDianBdw']?>%</span></td>
		</tr>

        <tr>
        	<td class="title">注册推广链接：</td>
			<td><input class="t-c t-c-w1" id="adv-url" readonly="readonly" value="http://<?=$_SERVER['HTTP_HOST']?>/index.php/user/register/<?=$key?>" /></td>
        </tr>
        <tr>
        	<td class="title">&nbsp;</td>
			<td><div class="btn-a copy1">
                            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="62" height="23" id="copy-advlink" align="top">
                                <param name="allowScriptAccess" value="always" />
                                <param name="movie" value="/skin/js/copy.swf?movieID=copy-advlink&inputID=adv-url" />
                                <param name="quality" value="high" />
                                <param name="bgcolor" value="#ffffff" />
                                <param name="scale" value="noscale" /><!-- FLASH原始像素显示-->
                                <embed src="/skin/js/copy.swf?movieID=copy-advlink&inputID=adv-url" width="62" height="23" name="copy-advlink" align="top" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                            </object>
                            </div></td>
        </tr>
        
        
	</table>

</div>

