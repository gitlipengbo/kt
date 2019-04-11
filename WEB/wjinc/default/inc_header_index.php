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
	<?php $this->display('index/inc_user_index.php'); ?>
	</div>
    
	<div class="header">
		<div class="g_33">
			<img src="/image/loginlogo1.png" alt="" />
			<div class="service">
				<a href="http://api.pop800.com/chat/207842" title="在线客服"  target="_blank" class="link-service" >联系客服</a>
				<a href="/QGYL.rar"  target="_blank" class="link-help">客户端</a>
			</div>
		</div>
	</div>



	