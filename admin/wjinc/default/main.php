﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 

if($this->type){
	$row=$this->getRow("select enable,title from {$this->prename}type where id={$this->type}");
	if(!$row['enable']){
		echo $row['title'].'已经关闭';
		exit;
	}
}else{
	$this->type=1;
	$this->groupId=2;
	$this->played=10;
}
?>
<?php $this->display('inc_skin.php',0,'KT彩娱乐城'); ?>
<link href="/skin/main/skins.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/skin/main/game.js"></script>
<script type="text/javascript" src="/skin/js/jquery.simplemodal.src.js"></script>
</head> 
 
<body id="sd" >
<?php $this->display('index/inc_header.php'); ?>
<div class="g_33">
<div id="mainbody">  
<div class="gamemain"> 
    <!-- 开奖信息 -->
    <?php $this->display('index/inc_data_current.php'); ?>
    <!-- 开奖信息 end -->
    <div class="game">
    <!--游戏body-->
    <?php $this->display('index/inc_game.php'); ?>
    <!--游戏body  end-->
    </div>
	<?php if($this->settings['switchDLBuy']==0){ //代理不能买单?>
    <input name="wjdl" type="hidden" value="<?=$this->ifs($this->user['type'],1)?>" id="wjdl" />
    <?php } ?>
    
</div>
<div id="wanjinDialog"></div>

    <div class="bottom"></div>
</div> 
<?php 	// 图片公告
	if(!$_COOKIE['pic-gg'] && $this->settings['picGG']){
		$this->display('index/pic-gg.php');
	}
?>
<script type="text/javascript">
var game={
	type:<?=json_encode($this->type)?>,
	played:<?=json_encode($this->played)?>,
	groupId:<?=json_encode($this->groupId)?>
},
user="<?=$this->user['username']?>",
aflag=<?=json_encode($this->user['admin']==1)?>;
</script>
</div>
</body>
</html>