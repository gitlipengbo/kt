<script>
$(document).ready(function () {
    $('ul li').has('div').append("<img class='navarrow' src='/images/common/arrow.png' />");
    $("ul li").click(
     function(){
		  $(this).find("div").slideToggle(100);
          $(this).toggleClass("navtionhover");
		  $(this).siblings("li").removeClass("navtionhover").find(".subnav").hide();
		 } 
    );
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	jQuery.navlevel2 = function(level1,dytime) {
		
	  $(level1).mouseenter(function(){
		  varthis = $(this);
		  delytime=setTimeout(function(){
			varthis.find('div').slideDown();
		},dytime);
		
	  });
	  $(level1).mouseleave(function(){
		 clearTimeout(delytime);
		 $(this).find('div').slideUp();
	  });
	  
	};
  $.navlevel2("li.mainlevel",100);
});

</script>


<div class="bg-toolbar"></div>
	<div class="toolbar">
	<?php $this->display('index/inc_user.php'); ?>
	</div>
    
	<div class="header-info">
		<div class="g_33">
			<div class="logo-info"></div>
			<div class="service">
				<a href="http://api.pop800.com/chat/207842" title="在线客服"  target="_blank" class="link-service" >联系客服</a>
				<a href="/QGYL.rar"  target="_blank" class="link-help">客户端</a>
			</div>
		</div>
	</div>

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

	