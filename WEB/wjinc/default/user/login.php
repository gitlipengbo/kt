<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->display('inc_skin_lr.php',0,''); ?>

</head>
<body class="bg-content new-login">
<div class="wrap-login">
		 <div class="logo">
		 	<a herf="javascript:void(0);"></a>
		 </div>
		 <div class="nav-wrap clearfix">
			<div class="guest-point guest-area">
				<span class="help-icon">有问题咨询在线客服？</span><a  href="http://api.pop800.com/chat/207842" target="_blank">点击此处</a>
			</div>
			 <ul class="nav">
			 	
<li class="current">
			 		<a href="#">新平台登陆</a>
		 	   </li>			
 </ul>
		 </div>
		 <div class="info-panel clearfix">
		 	<div class="left-shadow"></div>
		 	<div class="login-info-area">
		 		<form action="/index.php/user/loginedto" method="post" onajax="userBeforeLoginto" enter="true" call="userLoginto" target="ajax">
		 			<div class="user-info clearfix">
		 				<input type="text" id="username"  name="username" class="user-name" onfocus="if(this.value==defaultValue) {this.value='';}" onblur="if(!value) {value=defaultValue;}"  value="用户名">
		 				<div class="line"></div>
		 				<input  type="password"  onfocus="mmshow.style.display='none'" onblur="if(this.value=='') { mmshow.style.display='block';}"   id="password" data-name="password" name="password" class="user-password">
		 				<span class="forget-password" tabindex="-1" id="mmshow" style="display:block">密码</span>
		 				
		 			</div>
		 			
		 			<div id="J-msg-show" data-display="hide" class="msg-show"></div>
		 			<input id="J-form-submit" class="submit-btn" type="submit" value="登 录">
		 			<div class="login-tips">彩票有风险，投资需谨慎</div>
		 		</form>
		 	</div>

<div class="banner-area">
		 		<div id="focus" class="cycle-slideshow"
					data-cycle-slides="> .item"
					data-cycle-pager="> .cycle-pager-wrap .cycle-pager"
					data-cycle-fx="scrollHorz"
					data-cycle-timeout="4000"
					data-cycle-loader="wait"
					data-cycle-speed="800"
					data-pause-on-hover="true">
					<div class="cycle-pager-wrap">
					
									<script language="JavaScript1.1">
<!--
var slidespeed=2000
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
<img src="/upload/UploadFile/2015-02/1423740343.jpg" name="slide" border=0 style="FILTER: revealTrans(duration=2,transition=1)" width=500 height="288">
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
						<div class="cycle-pager"></div>
					</div>
                  
				</div>
			</div>
		 	<div class="right-shadow"></div>
		 </div>
		 <div class="shadow-bottom"></div>
	</div>
	<div class="supper-bowser"></div>
	



            <!--内容结束-->
</BODY>



</HTML>
