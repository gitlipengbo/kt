<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->display('inc_skin.php',0,'首页'); ?>
<link href="/skin/main/home.css" rel="stylesheet" type="text/css">
</head>
<body ondrag="return false;">
<div id="mainbody"> 
<?php $this->display('inc_header.php'); ?>
<div class="pagetop"></div>
<div class="pagemain">
    <div class="homelayout">
        <div class="homelist">
            <ul class="clist">
                <li><a href="/index.php/index/game/1/2">
                    <img alt="" src="/images/index/c1.png"><span>重庆时时彩</span></a></li>  
                <li><a href="/index.php/index/game/3/2">
                    <img alt="" src="/images/index/c1.png"><span>江西时时彩</span></a></li>
                <li><a href="/index.php/index/game/12/2">
                    <img alt="" src="/images/index/c1.png"><span>新疆时时彩</span></a></li>                       
                <li><a href="/index.php/index/game/6/10">
                    <img alt="" src="/images/index/c4.png"><span>广东11选5</span></a></li>
                <li><a href="/index.php/index/game/15/10">
                    <img alt="" src="/images/index/c4.png"><span>重庆11选5</span></a></li>
                <li><a href="/index.php/index/game/16/10">
                    <img alt="" src="/images/index/c4.png"><span>江西多乐彩</span></a></li>
                <li><a href="/index.php/index/game/9/12">
                    <img alt="" src="/images/index/c5.png"><span>福彩3D</span></a></li>
                <li><a href="/index.php/index/game/10/12">
                    <img alt="" src="/images/index/c6.png"><span>排列3</span></a></li>
                <li><a href="/index.php/index/game/18/26">
                    <img alt="" src="/images/index/c8.png"><span>北京PK10</span></a></li>
                <li><a href="/index.php/index/game/14/59">
                    <img alt="" src="/images/index/c7.png"><span>五分彩</span></a></li>  
            </ul>
            <div class="clear"></div>
        </div>
		
        <div class="homebox">
            
           
                
<h3 class="hometitle" id="tips"><a href="/index.php/notice/info">更多&gt;&gt;</a>通知公告</h3>
<ul class="tipslist">
  <?php
            $data=$this->getRows("select id,title,content,addtime from {$this->prename}content where nodeId=1 and enable=1 order by id desc limit 10");
            if($data) foreach($data as $var){ 
            echo "<li><em>".date('Y-m-d',$var['addtime'])."</em><a href=\"/index.php/notice/view/{$var['id']}\">{$var['title']}</a></li>";
            } 
            ?>
       
        </ul>

        </div>
    </div>
    <?php $this->display('inc_footer.php'); ?> 
 </div>
<div class="pagebottom"></div>
</div>

</body>
</html>
