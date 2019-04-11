$(function(){
	//登录按钮
	$("#top_login_btn").click(function(){
		alertdiv.login(default_login);
		
	})
	//登出按钮
	$("#logoutLink").click(function(){
		loginstatus.logout(default_logout);
	})
	
	
	//账户下拉列表
	$("li.my_account").mouseover(function(){
		$(this).addClass("c_btn");
		$(this).children("div").show();
	}).mouseout(function(){
		$(this).removeClass("c_btn");
		$(this).children("div").hide();
	})
	
	
	//网站导航列表
	$("li.site_nav").mouseover(function(){
		$(this).children("a").addClass("hover").find("b").removeClass("c_down").addClass("c_up");
		$(this).children("div").show();
	}).mouseout(function(){
		$(this).children("a").removeClass("hover").find("b").removeClass("c_up").addClass("c_down");
		$(this).children("div").hide();
	})
	
	
	//奖金列表
	$("#priz_show").mouseover(function(){
		$("#priz_table").show();
	}).mouseout(function(){
		$("#priz_table").hide();
	})
	
	//分享下拉列表
	$("#bdshell_js").attr("src","http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours())
	
})

function default_login(){}
function default_logout(){}

//说明提示
function helpTipEven(ojb)
{
	$(ojb).mouseover(function(){
		var offset = $(this).offset();
		var t = offset.top+15;
		var l = offset.left-15;
		var txt =$(this).attr("data-help");
		//txt = txt.replace(/&lt/g,"<").replace(/&gt/g,">");
		$("div.notifyicon").css({"left":l,"top":t});
		$("div.notifyicon > div.notifyicon_content").html(txt);
		$("div.notifyicon > div.notifyicon_content > h5").attr("style","background-position:0px -48px");
	}).mouseout(function(){
		$("div.notifyicon").css("left","-9999px");
	})
}

//投注列表选中事件
function SelBetListEven(obj)
{
	$("ul#code_list > li").removeClass("list-Selected");
	$(obj).addClass("list-Selected");
}