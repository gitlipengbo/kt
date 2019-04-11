<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '团队统计－代理中心'); ?>
<?php if(!$this->user['type']) header('location: /index.php/tip/show/1');?>
<?php 
$teamAll=$this->getRow("select sum(u.coin) coin, count(u.uid) count from {$this->prename}members u where u.isDelete=0 and concat(',', u.parents, ',') like '%,{$this->user['uid']},%'");
$teamAll2=$this->getRow("select count(u.uid) count from {$this->prename}members u where u.isDelete=0 and u.parentId={$this->user['uid']}");
?>

</head> 
 
<body>
<div id="mainbody"> 
<?php $this->display('inc_header.php'); ?>
<div class="pagetop"></div>
<div class="pagemain">
	
    <div class="display biao-cont">
    <h3>团队统计</h3>
    <dl class="wjform">
        <dt>账号类型：</dt>
        <dd><?=$this->iff($this->user['type'], '代理', '会员')?></dd>
    </dl>
    <dl class="wjform">
        <dt>我的账号：</dt>
        <dd><?=$this->user['username']?></dd>
    </dl>
     <dl class="wjform">
        <dt>可用余额：</dt>
        <dd><?=$this->user['coin']?> 元</dd>
    </dl>
    <dl class="wjform">
        <dt>团队余额：</dt>
        <dd><?=$teamAll['coin']?> 元</dd>
    </dl>
    <dl class="wjform">
        <dt>直属下级：</dt>
        <dd><?=$teamAll2['count']?> 个</dd>
    </dl>
    <dl class="wjform">
        <dt>所有下级：</dt>
        <dd><?=($teamAll['count']-1)?> 个</dd>
    </dl>

 </div>
<?php $this->display('inc_footer.php'); ?> 
</div>
<div class="pagebottom"></div>
</div>

</body>
</html>
  
   
 