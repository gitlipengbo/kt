<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->display('inc_skin_index.php',0,''); ?>

</head>
<body >
<?php $this->display('inc_header_index.php'); ?>
<script type='text/javascript'>
function wjkf168(){
	<?php if($this->settings['kefuStatus']){ ?>
	var newWin=window.open("<?=$this->settings['kefuGG']?>","","height=600, width=800, top=0, left=0,toolbar=no, menubar=no, scrollbars=no, resizable=no, location=n o, status=no");
	if(!newWin||!newWin.open||newWin.closed){newWin=window.open('about:blank');}else{return false;}
	<?php }else{?>
	alert("暂时还没开通");
	<?php }?>
	return false;
}
</script> 	
    
<div id="wanjinDialog"></div>

    <div class="bottom"></div>
<script type="text/javascript">      
$(function(){
	$(".suspend").mouseover(function() {
        $(this).stop();
        $(this).animate({width: 160}, 220);
    });
    $(".suspend").mouseout(function() {
        $(this).stop();
        $(this).animate({width: 40}, 220);
    });
});
</script>
<div class="container-top">
		<div class="g_33">
			<div class="user-tools">
				<h2 class="user-name">欢迎你,<strong><?=$this->user['username']?></strong></h2>
				<div class="user-info clearfix">
					<!--  -->
						<span class="user-head user-head-normal" ></span>
					<!--  --> 
					<div class="user-balance">
						<div class="user-balance-title">可用余额</div>
						<div class="user-balance-number" name="spanBall"><?=$this->user['coin']?></div>
					</div>
				</div>
					
				<div class="safe-info">
					<div class="safe-info-title">安全等级：
					中					</div>
					<div class="safe-info-progress ">
						<div class="progress-wapper progress-middle"><div class="progress-inner" style="width:80%"></div></div>
					</div>
					<div class="safe-info-ip">
					<?php
            $data=$this->getRows("select loginTime,loginIP from {$this->prename}member_session where isOnLine=0 and uid={$this->user['uid']} order by id desc limit 1");
            if($data) foreach($data as $var){ 
           echo "上次登录：".date("Y-m-d H:i:s",$var['loginTime']);
		   echo "</br>".$this->convertip(long2ip($var['loginIP']));
            } 
			else{
echo "首次登录";
			}
  ?>
						
					
						<!--  -->
						
					</div>
				</div>
				<div class="account-info">
					<a  href="/index.php/cash/recharge" class="btn-recharge">充值</a>
					
						<a href="/index.php/cash/toCash" class="btn-recharge">提现</a>
						
					
					
				</div>
			</div>
			<div id="focus"
				data-cycle-slides="> .item"
				data-cycle-pager="> .cycle-pager-wrap .cycle-pager"
				data-cycle-prev="> .prev"
				data-cycle-next="> .next"
				data-cycle-fx="scrollHorz"
				data-cycle-timeout="4000"
				data-cycle-loader="wait"
				data-cycle-speed="800"
				data-pause-on-hover="true">
				<script language="JavaScript1.1">
<!--
var slidespeed=3000
var slideimages=new Array("/upload/UploadFile/2015-02/1423740343.jpg","/upload/UploadFile/2015-02/1423740359.jpg")


var imageholder=new Array()
var ie55=window.createPopup
for (i=0;i<slideimages.length;i++){
imageholder[i]=new Image()
imageholder[i].src=slideimages[i]
}

function gotoshow(){
window.location=slidelinks[whichlink]
}
//-->
</script>
<img src="/upload/UploadFile/2015-02/1423740343.jpg" name="slide" border=0 style="FILTER: revealTrans(duration=2,transition=1)" width=760 height="360">
<script language="JavaScript1.1">
<!--
var whichlink=0
var whichimage=0
var pixeldelay=(ie55)? document.images.slide.filters[0].duration*1000 : 0
function slideit(){
if (!document.images) return
if (ie55) {document.images.slide.filters[0].Transition=30
document.images.slide.filters[0].apply()}
document.images.slide.src=imageholder[whichimage].src
if (ie55) document.images.slide.filters[0].play()
whichlink=whichimage
whichimage=(whichimage<slideimages.length-1)? whichimage+1 : 0
setTimeout("slideit()",slidespeed+pixeldelay)
}
slideit()
//-->
</script>
				<div class="cycle-pager-wrap">

					<div class="cycle-pager"></div>
				</div>
				<span class="prev_next prev">&#9664;</span>
				<span class="prev_next next">&#9654;</span>
			</div>
		</div>
	</div>
	<div class="container-body">
		<div class="g_33">
			<div class="col-main">
				<div class="lottery-main">
					<div class="lottery-main-hd">
						<DIV class=bd>
<?php $this->display('inc_data_history.php', 0,1); ?></DIV>
						<a href="/index.php/index/game/1/2" class="deadline-btn">立即投注</a>
					</div>
					<div class="lottery-main-bd">
						<a href="/index.php/index/game/7/77" class="lottery-main-pic1"><span></span></a>
						<a href="/index.php/index/game/3/2" class="lottery-main-pic2"><span></span></a>
						<a href="/index.php/index/game/6/77" class="lottery-main-pic3"><span></span></a>
						<a href="/index.php/index/game/15/77" class="lottery-main-pic4"><span></span></a>
						<a href="/index.php/index/game/16/77" class="lottery-main-pic5"><span></span></a>
						<a href="/index.php/index/game/9/16" class="lottery-main-pic6"><span></span></a>
						<a href="/index.php/index/game/12/2" class="lottery-main-pic7"><span></span></a>
						<a href="/index.php/index/game/10/16" class="lottery-main-pic8"><span></span></a>
					</div>
				</div>
				<div class="lottery-sub">
		
					<div class="lottery-sub-hd">
							
						<a href="/index.php/index/game/9/16" class="omit-btn"></a>

					</div>
					<div class="lottery-sub-bd">
						<div class="p35">
							<a href="/index.php/index/game/10/16" class="p35-btn"></a>
													
						</div>
						<div class="ssq">
							<a href="index.php/index/game/25/39" class="p35-btn"></a>
							
						</div>
					</div>
				</div>			
					
				
				<div class="lottery-extra">
					<div class="lottery-extra-hd">
						
						<DIV class=bd>
<?php $this->display('inc_data_history.php', 0,14); ?></DIV>									
													
						<a href="/index.php/index/game/14/59" class="mmc-btn">立即投注</a>
					</div>
					<div class="lottery-extra-bd">
						<a class="lottery-extra-pic1" href="/index.php/index/game/14/59"></a>
						<a class="lottery-extra-pic2" href="/index.php/index/game/26/59"></a>
						<a class="lottery-extra-pic3" href="/index.php/index/game/5/59"></a>
						<div class="lottery-extra-bd-text">
							<ul class="lelicai-animate">
																
														</ul>
							<ul class="n115-animate">
																
														</ul>
							<ul class="jili-animate">
																
														</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sub">
				<div class="news-list">
					<div class="news-list-hd">平台动态<a style="overflow:hidden;padding-left:80px;color:#FFF;" href="/index.php/notice/info/1" >更多</a></div>
					<ul class="news-list-bd">

					<?php
            $data=$this->getRows("select id,title,content,addtime from {$this->prename}content where nodeId=1 and enable=1 and typeid=1 order by id desc limit 5");
            if($data) foreach($data as $var){ 
            echo "<li><a target=\"modal\" button=\"关闭:defaultModalCloase\" href=\"/index.php/notice/viewinfo/".$var['id']."\"  title=\"".$var['title']."\" width=600  >{$var['title']}</a><SPAN class=time>".date('Y-m-d H:i:s',$var['addtime'])."</SPAN></li>";
            } 
  ?>
						
					</ul>
				</div>
               <div class="news-list">
					<div class="news-list-hd">最新中奖</div>
					<ul class="news-list-bd" id="slider">

					
<?php
     $this->getSystemSettings();
     $this->getTypes();
	 $types=array(1,3,5,6,9,10,12,14,26,15,16,17,20,24,7,18);
	 $name=explode('|',$this->settings['paihangsjnr']);
	 $name2=explode('|',$this->settings['paihangsjje']);
     $gg=$this->getRows("select * from {$this->prename}bets where zjCount=1 and bonus>? order by id desc limit 10",$this->settings['sbje']);
	 $count=count($name); 
	 for($i=0;$i<$count;$i++) 
{ 
echo '<li><B>',$name2[rand(0,count($name2)-1)],'元</B>【***',substr($name[rand(0,count($name)-1)],-3),'】喜中&nbsp</li>';
}
     if($gg) foreach($gg as $var){
		$gg=$this->getRows("select * from {$this->prename}bets where zjCount=1 and bonus>? order by id desc limit 10",$this->settings['sbje']);
		switch($var['type']){
			case 1:
		            echo '<li><B>',$var['bonus'],'元</B>【***',substr($var['username'],-3),'】喜中&nbsp</li>';
			break;
			case 3:
		            echo '<li><b>',$var['bonus'],'元</b>【***',substr($var['username'],-3),'】喜中&nbsp</li>';
			break;
			case 6:
		            echo '<li><b>',$var['bonus'],'元</b>【***',substr($var['username'],-3),'】喜中&nbsp</li>';
			break;
			case 9:
		            echo '<li><b>',$var['bonus'],'元</b>【***',substr($var['username'],-3),'】喜中&nbsp</li>';
			break;
			case 10:
		            echo '<li><b>',$var['bonus'],'元</b>【***',substr($var['username'],-3),'】喜中&nbsp</li>';
			break;
			case 12:
		            echo '<li><b>',$var['bonus'],'元</b>【***',substr($var['username'],-3),'】喜中&nbsp</li>';
			break;
			case 14:
		            echo '<li><b>',$var['bonus'],'元</b>【***',substr($var['username'],-3),'】喜中&nbsp</li>';
			break;
			case 26:
		            echo '<li><b>',$var['bonus'],'元</b>【***',substr($var['username'],-3),'】喜中&nbsp</li>';
			break;
			case 15:
		            echo '<li><b>',$var['bonus'],'元</b>【***',substr($var['username'],-3),'】喜中&nbsp</li>';
			break;
			case 16:
		            echo '<li><b>',$var['bonus'],'元</b>【***',substr($var['username'],-3),'】喜中&nbsp</li>';
			break;
			case 17:
		            echo '<li><b>',$var['bonus'],'元</b>【***',substr($var['username'],-3),'】喜中&nbsp</li>';
			break;
			case 20:
		            echo '<li><b>',$var['bonus'],'元</b>【***',substr($var['username'],-3),'】喜中&nbsp</li>';
			break;
			case 24:
		            echo '<li><b>',$var['bonus'],'元</b>【***',substr($var['username'],-3),'】喜中&nbsp</li>';
			break;
			case 7:
		            echo '<li><b>',$var['bonus'],'元</b>【***',substr($var['username'],-3),'】喜中&nbsp</li>';
			break;
			case 18:
		            echo '<li><b>',$var['bonus'],'元</b>【***',substr($var['username'],-3),'】喜中&nbsp</li>';

		}
	}
	?>


						
					</ul>
				</div>
				
			</div>
		</div>
	</div>
	<!--  --><script type="text/javascript" src="/style/Index.js"></script>
<script language="javascript" type="text/javascript"> 
new slider({id:'slider'})
</script>
	<div class="footer">
		<div class="footer-help">
			<div class="g_33">
				<div class="footer-help-link">
					<a href="/index.php/notice/info/5">玩法介绍</a>
					<a href="/index.php/notice/info/3">如何充值</a>
					<a href="/index.php/notice/info/4">提现须知</a>
				</div>
			</div>
		</div>
		<div class="footer-link">

			<div class="g_33">
		        <a href=#>关于我们</a><span></span>
               	<a href=#>合作机会</a><span></span>
                <a href=#>安全中心</a><span></span>
		         <a href="http://api.pop800.com/chat/222637" title="在线客服"  target="_blank">在线客服</a>
                <p class="footer-copyright">&copy;2003-2018 盛彩彩票 All Rights Reserved</p>
             </div>
		</div>
		
	</div>
	<!-- 浮动广告
	<div class="slider-bar" id="sliderBar">
		<div class="hd"><a href="javascript:void(0);" id='sliderBar_close' class="close"></a>联系上级</div>
		<div class="bd">
			
			<a href="/Service/servicesup?unread=2" target="_blank" class="letters"></a>
		</div>
	</div> 
	 -->


</body>
</html>