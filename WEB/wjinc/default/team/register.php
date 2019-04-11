<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->display('inc_skin_lr.php',0,'钱柜娱乐'); ?>

</head>
<body class="bg-content new-login">
<div class="wrap-login">
		 <div class="logo">
		 	<a herf="javascript:void(0);"></a>
		 </div>
		 <div class="nav-wrap clearfix">
			
			 <ul class="nav">
			 	
<li class="current">
			 		<a href="#">新用户注册</a>
		 	   </li>			
 </ul>
		 </div>
		 <div class="info-panel clearfix">
		 	<div class="left-shadow"></div>
		 	<div class="login-info-area">
 <?php if($args[0] && $args[1]){
        
		$sql="select * from {$this->prename}links where lid=?";
		$linkData=$this->getRow($sql, $args[1]);
		$sql="select * from {$this->prename}members where uid=?";
		$userData=$this->getRow($sql, $args[0]);
	
		?>
		 		<form action="/index.php/user/registered" method="post" onajax="registerBeforSubmit" enter="true" call="registerSubmit" target="ajax">
				<input type="hidden" name="parentId" value="<?=$args[0]?>" />
            <input type="hidden" name="lid" value="<?=$linkData['lid']?>"  />
		 			<div class="user-info clearfix">
		 				<input type="text" id="username"  name="username" class="user-name" onfocus="if(this.value==defaultValue) {this.value='';}" onblur="if(!value) {value=defaultValue;}"  value="用户名">
		 				<div class="newuserreg">
		 				<input  type="password"  onfocus="mmshow.style.display='none'" onblur="if(this.value=='') { mmshow.style.display='block';}"   id="password" data-name="password" name="password" class="user-password">
		 				<span class="forget-password" tabindex="-1" id="mmshow" style="display:block; bottom: 5px;">密码</span></div>
						<div class="newuserreg">
						
		 				<input  type="password"  onfocus="qrmmshow.style.display='none'" onblur="if(this.value=='') { qrmmshow.style.display='block';}"   id="cpasswd" data-name="password" name="cpasswd" class="user-password">
		 				<span class="forget-password" tabindex="-1" id="qrmmshow" style="display:block; bottom: 4px;">确认密码</span></div>

<div class="newuserreg">
<input type="text" id="vcode"  name="vcode" class="user-name" onfocus="if(this.value==defaultValue) {this.value='';}" onblur="if(!value) {value=defaultValue;}"  value="验证码"><div style="position: absolute; right:0; top:15px"><img width="72" height="24" border="0" id="vcode" style="cursor:pointer;" align="absmiddle" src="/index.php/user/vcode/<?=$this->time?>" title="看不清楚，换一张图片" onclick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/></div></div>
		 			</div>
		 			
		 			<div id="J-msg-show" data-display="hide" class="msg-show"></div>
		 			<input id="J-form-submit" class="submit-btn" type="submit" value="注 册">
		 			
		 		</form>
				<?php }else{?>
           <div style="text-align:center; line-height:50px; color:#FF0; font-size:20px; font-weight:bold;">链接失效！</div>
           <?php }?>
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
