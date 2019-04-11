<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '服务中心 - 公告详情'); $info=$args[0];?>
</head> 
 
<body>
<?php $this->display('inc_header_info.php'); ?>
<div class="g_33">
<div class="infoleft"><?php $this->display('inc_info_menu.php'); ?></div>
<div class="inforight">
<div id="mainbody"> 
<div class="pagetop"></div>
<div class="pagemain">
    <div class="display biao-cont">
    	
        <div class="detail">
        	<h1><?=$info['title']?></h1>
            <div class="cont"><?=nl2br($info['content'])?></div>
        </div>
    </div>

</div>
<div class="pagebottom"></div>
</div>
</div></div>
</body>
</html>
  
   
 