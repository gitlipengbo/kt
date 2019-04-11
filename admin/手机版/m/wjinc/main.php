<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<?php $this->display('inc_skin.php',0,'首页'); ?>
<link href="/skin/main/skins.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/skin/main/game.js"></script>
<script type="text/javascript" src="/skin/js/jquery.simplemodal.src.js"></script>
</head> 
 
<body>
<div id="mainbody">  
<?php $this->display('index/inc_header.php'); ?>
<!--中奖公告-->
<?php if($this->settings['webGG']){ ?>
<div class="zjnotice">
	<marquee behavior="scroll" direction="left" height="30" style="line-height:30px;" loop="-1" scrollamount="2" scrolldelay="100" onMouseOut="this.start()" onMouseOver="this.stop()">
		 <?=$this->settings['webGG']?>
        
    </marquee>
</div>
 <?php } ?>
<!--中奖公告结束-->
<div class="gamemain"> 
    <!-- 开奖信息 -->
    <?php $this->display('index/inc_data_current.php'); ?>
    <!-- 开奖信息 end -->
    <div class="game">
    <!--游戏body-->
    <?php $this->display('index/inc_game.php'); ?>
    <!--游戏body  end-->
    </div>
    <?php $this->display('inc_footer.php'); ?>
</div>

</div> 

<script type="text/javascript">
var game={
	type:<?=json_encode($this->type)?>,
	played:<?=json_encode($this->played)?>,
	groupId:<?=json_encode($this->groupId)?>
},
user="<?=$this->user['username']?>",
aflag=<?=json_encode($this->user['admin']==1)?>;
</script>

</body>
</html>
  
   
 