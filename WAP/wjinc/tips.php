<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php',0,'温馨提示'); ?>
</head> 
 
<body>
<div id="mainbody"> 
<?php $this->display('inc_header.php'); ?>
<div class="pagetop"></div>
<div class="pagemain">
	<?php 
	switch($args[0]){ 
	case 1:  //权限
	?>	
     <div class="tips">
        <dl>
            <dt>温馨提示：</dt>
            <dd>您暂无权限操作！</dd>
        </dl>
    </div>
   <?php 
   break;
   case 2:?>
     <div class="tips">
        <dl>
            <dt>温馨提示：</dt>
            <dd>数据提交成功</dd>
        </dl>
    </div>
   <?php 
   break;
   default: ?>
     <div class="tips">
        <dl>
            <dt>温馨提示：</dt>
            <dd>欢迎来到这里！--万金娱乐游戏开发中心</dd>
        </dl>
    </div>
   <?php break; }?>
<?php $this->display('inc_footer.php'); ?> 
</div>
<div class="pagebottom"></div>
</div>

</body>
</html>
  
   
 