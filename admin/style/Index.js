$(function(){
	//登出按钮
	$("#logoutLink").click(function(){
		loginstatus.logout(default_logout);
	})
	
	
	$("#lott_news").mouseover(function(){
		$(this).children("a").addClass("hover").next().show();
	}).mouseout(function(){
		$(this).children("a").removeClass("hover").next().hide();
	})
	$("#jrkj_dl > ul.kj_tabs > li").mouseover(function(){
		$("#jrkj_dl > ul.kj_tabs > li").removeClass("cur");
		$(this).addClass("cur");
		$("#jrkj_dl > div.kj_con").hide();
		$("#jrkj_dl > div.kj_con").eq($(this).index()).show();
	})
	
	$("#notice > ul.notice_nav > li").mouseover(function(){
		$("#notice > ul.notice_nav > li").removeClass("cur");
		$(this).addClass("cur");
		$("#notice > div.notice_cont").hide();
		$("#notice > div.notice_cont").eq($(this).index()).show();
	})
	$("#intro_tips > a").mouseover(function(){
		$(this).addClass("hover");
		$(this).next().show();
	}).mouseout(function(){
		$(this).removeClass("hover");
		$(this).next().hide();
	})
	
	$("#kaijiang > ul  > li").mouseover(function(){
		$("#kaijiang > ul  > li").removeClass("cur")
		$(this).addClass("cur")
		var index = $(this).index();
		$("#scroll_box0,#scroll_box1").hide();
		$("#scroll_box"+index).show()
		$("div.scroll_btn").hide();
		$("div#scroll_btn"+index).show()
		
	})
	var fq_height = $("#scroll_con").height()
	var scroll_box0_height = $("#scroll_box0").height()
	var scroll_box1_height = $("#scroll_box1").height()
	$("#scroll_up_0").click(function(){
		var top = $("#scroll_box0").css("margin-top")
		top = top.replace("px","")
		if(top =="auto")
		{
			top = 0
		}
		
		top = top * -1
		if (top+fq_height < scroll_box0_height)
		{
			if (scroll_box0_height - (fq_height+top) > 118)
			{
				top = top + 118
			}
			else
			{
				top = scroll_box0_height - fq_height
			}
			$("#scroll_box0").css("margin-top",top * -1)
		}
	})
	$("#scroll_down_0").click(function(){
		var top = $("#scroll_box0").css("margin-top")
		top = top.replace("px","")
		if(top =="auto")
		{
			top = 0
		}
		top = top * -1
		if (top > 0)
		{
			if (top > 118)
			{
				top = top - 118
			}
			else
			{
				top = 0
			}
			$("#scroll_box0").css("margin-top",top * -1)
		}
	})
	$("#scroll_up_1").click(function(){
		var top = $("#scroll_box1").css("margin-top")
		top = top.replace("px","")
		if(top =="auto")
		{
			top = 0
		}
		top = top * -1
		if (top+fq_height < scroll_box1_height)
		{
			if (scroll_box1_height - (fq_height+top) > 118)
			{
				top = top + 118
			}
			else
			{
				top = scroll_box1_height - fq_height
			}
			$("#scroll_box1").css("margin-top",top * -1)
		}
	})
	$("#scroll_down_1").click(function(){
		var top = $("#scroll_box1").css("margin-top")
		top = top.replace("px","")
		if(top =="auto")
		{
			top = 0
		}
		top = top * -1
		if (top > 0)
		{
			if (top > 118)
			{
				top = top - 118
			}
			else
			{
				top = 0
			}
			$("#scroll_box1").css("margin-top",top * -1)
		}
	})
	
	$("ul#hmcase > li").click(function(){
		$("ul#hmcase > li").removeClass("cur")
		$(this).addClass("cur")
		var index = $(this).index();
		CheckHM(index, $(this).attr("lotid"), $(this).attr("lotname"),"load")
	})
	$("ul#hmcase > li").eq(2).click()
	
	//刷新合买列表
	$("#shuaxin").click(function(){
		var div = $("ul#hmcase > li.cur");
		CheckHM($(div).index(),$(div).attr("lotid"),$(div).attr("lotname"),"refresh");
	})
	
	$("#ranking > ul  > li").mouseover(function(){
		$("#ranking > ul  > li").removeClass("cur")
		$(this).addClass("cur")
		var index = $(this).index();
		$("#ranking>div").hide();
		$("#ranking>div").eq(index).show()
		
	})
})

/*
function RefreshMoney(){
	if($("#top_user_info").is(":hidden"))
	{
		$("#mainLoginBefore").show();
		$("#mainLoginAfter").hide();
		$("#mainNotJieSuan,#mainGuanzhuHemai,#mainZhuihao").text(0)
	}
	else
	{
		$("#mainLoginBefore").hide();
		$("#mainLoginAfter").show();
		$("#mainNotJieSuan").text($("#money").text())
		$("#mainGuanzhuHemai").text($("#tmppay").text())
		$("#mainZhuihao").text($("#packs").text())
	}
}

function default_logout(){
	$("#mainLoginBefore").show();
	$("#mainLoginAfter").hide();
	$("#mainNotJieSuan,#mainGuanzhuHemai,#mainZhuihao").text(0)
}
*/

$(function(){
	window.setInterval("daojishi()",1000);//倒计时
})

//倒计时
function daojishi(){
	servertime = servertime + 1000
	var arr = $("#countDownData").val().split(",");
	for(var i=0; i<arr.length;i++)
	{
		var classarr = arr[i].split("#")
		var endtime = Date.parse(classarr[0].replace(/-/g,"/"))
		var surplussecond = Math.round((endtime-servertime)/1000);
		if(surplussecond>0)
		{
			var h = Math.floor(surplussecond/3600);
			var d = parseInt(h/24);
			h = h%24;
			if (h < 10)
			{
				h = "0"+h;
			}
			var syms = Math.floor(surplussecond%3600);
			var m = Math.floor(syms/60);
			if (m<10)
			{
				m = "0"+m;
			}
			var s = Math.floor(syms%60);
			if(s<10)
			{
				s = "0"+s;
			}
			if (d>0)
			{
				$("#"+classarr[1]).text(d+"天"+h+"小时"+m+"分")
			}
			else
			{
				$("#"+classarr[1]).text(h+"小时"+m+"分"+s+"秒")
			}
		}
		else
		{
			$("#"+classarr[1]).html("<span class='red'>已截止</span>")
		}
	}
}


//选择合买列表
function CheckHM(num,lotid,lotname,ac)
{
	$("ul#hmcase").parent().find("div.tabs-cnt").hide();
	var div = $("ul#hmcase").parent().find("div.tabs-cnt").eq(num);
	
	$(div).show();
	
	if($(div).html().length > 0 ) 
	{
		if(ac=="refresh")
		{
			$(div).text("正在载入...")
			LoadHM(div,lotid,lotname)
		}
	}
	else
	{
		LoadHM(div,lotid,lotname)
	/*返回继续购买*/
	$("#aContinue").click(function(){
		alertdiv.close('_ajax_common_div5');
		LoadHM(div,lotid,lotname)
	})
	
	/*关闭购买成功提示*/
	$("#_ajax_common_btn5").click(function(){
		alertdiv.close('_ajax_common_div5');
		LoadHM(div,lotid,lotname)
	})
	}
	
}


//载入合买列表
function LoadHM(id,lotid,lotname)
{
	$.ajax({
		type: "POST",
		url: "/Trade/Ajax_Trade.html",
		data: {
			action:"hmlist",
			lotid:lotid,
			pagesize:10
		},
		dataType:"xml",
		success: function(data){
			
			var err = $(data).find("err");
			if($(err).attr("type")=="1")
			{
				
				var str = "<table class='tb' width='100%' cellspacing='0' cellpadding='0' border='0'>"
				str += "<colgroup><col width='10%'><col width='10%'><col width='15%'><col width='10%'><col width='10%'><col width='13%'><col width='11%'><col width='11%'><col width='11%'></colgroup>"
				str += "<thead><tr class=''><th>发起人</th><th>战绩</th><th class='fa_money'>方案金额</th><th>提成</th><th>详细</th><th>方案进度</th><th>剩余份数</th><th>认购份数</th><th>合买</th></tr></thead>"
				str += "<tbody>"
					
				$(data).find("row").each(function(index){
					if(index > 9)
					{
						return false
					}
					str += "<tr>"
					//str += "<td class=splittd>"+$(this).attr("num")+"</td>"
                    //str += "<td><a href='/trade/viewpath.asp?pid="+$(this).attr("pid")+"'>"+$(this).attr("pid")+"</a></td>"
					str += "<td class=splittd>"+unescape($(this).attr("user"))+"</td>"
					//str += "<td class=splittd>"+$(this).attr("images")+"&nbsp;</td>"					
						str += "<td><a href='javascript:void(0)' onclick=vipcp.OpenHistory("+$(this).attr("Lottery_ID")+","+$(this).attr("userid")+")>"
						var am = $(this).attr("amoney")
						var ar = Math.floor(am / 10000000)
						if (ar > 0 )
						{
						    str += "<img src='../../Images/y4.gif' />";
						    str += "<img src='../../Images/s" + ar + ".png' />";
						    am = am - 10000000 * ar
						}
						var ar = Math.floor(am / 1000000)
						if (ar > 0) {
						    str += "<img src='../../Images/y3.gif' />";
						    str += "<img src='../../Images/s" + ar + ".png' />";
						    am = am - 1000000 * ar
						}
						var ar = Math.floor(am / 100000)
						if (ar > 0) {
						    str += "<img src='../../Images/y2.gif' />";
						    str += "<img src='../../Images/s" + ar + ".png' />";
						    am = am - 100000 * ar
						}
						var ar = Math.floor(am / 10000)
						if (ar > 0) {
						    str += "<img src='../../Images/y1.gif' />";
						    str += "<img src='../../Images/s" + ar + ".png' />";
						    am = am - 10000 * ar
						}
						if ($(this).attr("amoney") > 1000 && $(this).attr("amoney") < 10000)
						{ str += "<img src='../../Images/y1.gif' />" }		
						str +="</a>&nbsp;</td>"
                    str += "<td class='fa_money'>"+$(this).attr("allmoney")+"元</td>"
					str += "<td>"+$(this).attr("tc")+"%</td>"
					//str += "<td>￥"+$(this).attr("mfje")+"元</td>"
                    str += "<td><a href='/Trade/"+lotname+"/Project_Info-"+$(this).attr("cid")+"'>查看</a></td></td>"
						if($(this).attr("bd")!="0.00")
						{
							str += "<td style='text-align:left;'><span style='margin-left:0px;;color:000'>"+$(this).attr("jd")+"%</span> + <span style='margin-left:0px;color:#fff;background:#b90000;'>"+$(this).attr("bd")+"%保</span><BR><div style='width:100px;height:6px; font-size:0px; line-height:0px;border:1px solid #b90000;background:#fff;'><img src='/images/bar_space.gif' width='"+$(this).attr("jd")+"' height='6'></div></td>"
						}
						else
						{
							str += "<td style='text-align:left;'><span style='margin-left:0px;color:000'>"+$(this).attr("jd")+"%</span><BR><div style='width:100px;height:6px; font-size:0px; line-height:0px;border:1px solid #b90000;'><img src='/images/bar_space.gif' width='"+$(this).attr("jd")+"' height='6'></div></td>"
						}
						str += "<td>"+$(this).attr("sy")+"份</td>"
						if($(this).attr("state")=="1")
						{
							str += "<td>--</td>"
							str += "<td>流产</td>"
						}
						else if($(this).attr("state")=="2")
						{
							str += "<td>--</td>"
							str += "<td>撤单</td>"
						}
						else if($(this).attr("state")=="3")
						{
							str += "<td>--</td>"
							str += "<td>满员</td>"
						}
						else if($(this).attr("state")=="4")
						{
							str += "<td>--</td>"
							str += "<td>完成</td>"
						}
						else if($(this).attr("state")=="5")
						{
							str += "<td>--</td>"
							str += "<td>截止</td>"
						}
						else if($(this).attr("state")=="6")
						{
							str += "<td>"
						str += "<input type='text' class='rec_text' value='1' style='width: 38px;' name='buynum'  onkeyup='FormatNum(this)' />"
						str += "<input type='hidden' name='pid' value='"+$(this).attr("pid")+"' />"
						str += "<input type='hidden' name='senumber' value='"+$(this).attr("sy")+"' />"
						str += "<input type='hidden' name='onemoney' value='"+$(this).attr("mfje")+"' />"
						str += "</td>"
						str += "<td><a class='public_Dora' title='' href='javascript:;' onclick='AddProject(this)'><b>购买</b></a></td>"
					}
					str += "</tr>"
				})
				
				/*var num = $(data).find("row").length;
				if(num<10)
				{
					num = 10 - num;
					for(var i=0; i<num; i++ )
					{
						str += "<tr><td colspan='9'></td></tr>"
					}
				}*/
				str = str + "</tbody>"
				str = str + "</table>"
				str = str + "<div class='table_intr'>"
				str = str + "<span></span>"
				str = str + "<a target='_blank' title='' href='/Trade/"+lotname+"/Project_List.html'>查看更多合买&gt;&gt;</a>"
				str = str + "</div>"
				
				$(id).html(str)
			}
			else
			{
				if($(err).attr("msg").length>0)
				{
					alertdiv.alert($(err).attr("msg"));
				}
				if($(err).attr("url").length>0)
				{
					location.href = $(err).attr("url");
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
		},
		complete: function (jqXHR, textStatus) {
		}
	});
}

//购买按钮事件
function AddProject(obj)
{
	var td = $(obj).parent().prev();
	var buynum = $(td).find("input[name=buynum]").val();
	var pid = $(td).find("input[name=pid]").val();
	var senumber = $(td).find("input[name=senumber]").val();
	var onemoney = $(td).find("input[name=onemoney]").val();
	if (buynum=="")
	{
		alertdiv.alert("认购份数不能为空！");
		$(td).find("buynum").focus();
		return;
	}
	else if (Number(buynum) <= 0)
	{
		alertdiv.alert("认购份数不能为空！");
		$(td).find("buynum").focus();
		return;
	}
	else if (Number(buynum) > Number(senumber))
	{
		alertdiv.alert("您认购份数不能大于剩余份数！");
		$("#buynum").focus();
		return;
	}
	var msg = "<p style='text-align:left;text-indent:2em;'>您好，请您确认</p>";
	msg = msg + "<p style='text-align:left;text-indent:2em;'>认购份数：<font color='red' style='font-weight:bold'>"+buynum+"</font>份</p>";
	msg = msg + "<p style='text-align:left;text-indent:2em;'>认购金额：<font color='red' style='font-weight:bold'>￥"+formatCurrency2(Number(buynum)*onemoney)+"元</font></p>";
	alertdiv.confirm(msg,function(){add_project(buynum,pid,onemoney)});
}


//参加合买
function add_project(buynum,pid,onemoney){
	$.ajax({
		type: "POST",
		url: "/Trade/Include/KR.HeMai.Buy.html",
		data: {
			action:"add",
			pid:pid,
			buynum:buynum,
			onemoney:onemoney
		},
		dataType:"xml",
		success: function(data){
			var err = $(data).find("err");
			if($(err).attr("type")=="-1") //未登录
			{
				alertdiv.login(function(){add_project(buynum,pid,onemoney)})
			}
			else if($(err).attr("type")=="0")
			{
			alertdiv.alert("对不起您的余额不足！");
			return ;
			}
			else if($(err).attr("type")=="2")
			{
			alertdiv.alert("对不起当前期已经截止认购！");
			return ;
			}
			else if($(err).attr("type")=="3")
			{
			alertdiv.confirm2("对不起，该方案已撤单!",default_login)
			return ;
			}
			else if($(err).attr("type")=="4")
			{
			alertdiv.confirm2("对不起，该方案已停止追号!",default_login)
			}
			else if($(err).attr("type")=="6")
			{
			alertdiv.confirm2("对不起，该方案已满员!",default_login)
			}
			else if($(err).attr("type")=="5")
			{
			alertdiv.confirm2("参与金额已经超过最大限额！",default_login)
			}
			else if($(err).attr("type")=="-2")
			{
			alertdiv.alert("对不起您购买的份大于当前份数！");
			return ;
			}
			else if($(err).attr("type")=="1")
			{
				/*查看方案*/
				$("#aViewPro").attr("href","/Trade/Project_Info.html?id="+pid)
				alertdiv.showBox("_ajax_common_div5", "温馨提示", null, 400, null,null) 
				ColseCountdownWin('_ajax_common_div5','sytime2','sytime2_second',null,LoadHM)
			}
			else
			{
				if($(err).attr("msg").length>0)
				{
					alertdiv.alert($(err).attr("msg"));
				}
				if($(err).attr("url").length>0)
				{
					location.href = $(err).attr("url");
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alertdiv.alert("交易失败,请重新提交！");
		},
		complete: function (jqXHR, textStatus) {
		}
	});	
}


function H$(i) {return document.getElementById(i)}
function H$$(c, p) {return p.getElementsByTagName(c)}
var slider = function () {
 function init (o) {
  this.id = o.id;
  this.at = o.auto ? o.auto : 3;
  this.o = 0;
  this.pos();
 }
 init.prototype = {
  pos : function () {
   clearInterval(this.__b);
   this.o = 0;
   var el = H$(this.id), li = H$$('li', el), l = li.length;
   var _t = li[l-1].offsetHeight;
   var cl = li[l-1].cloneNode(true);
   cl.style.opacity = 0; cl.style.filter = 'alpha(opacity=0)';
   el.insertBefore(cl, el.firstChild);
   el.style.top = -_t + 'px';
   this.anim();
  },
  anim : function () {
   var _this = this;
   this.__a = setInterval(function(){_this.animH()}, 20);
  },
  animH : function () {
   var _t = parseInt(H$(this.id).style.top), _this = this;
   if (_t >= -1) {
    clearInterval(this.__a);
    H$(this.id).style.top = 0;
    var list = H$$('li',H$(this.id));
    H$(this.id).removeChild(list[list.length-1]);
    this.__c = setInterval(function(){_this.animO()}, 20);
    //this.auto();
   }else {
    var __t = Math.abs(_t) - Math.ceil(Math.abs(_t)*.07);
    H$(this.id).style.top = -__t + 'px';
   }
  },
  animO : function () {
   this.o += 2;
   if (this.o == 100) {
    clearInterval(this.__c);
    H$$('li',H$(this.id))[0].style.opacity = 1;
    H$$('li',H$(this.id))[0].style.filter = 'alpha(opacity=100)';
    this.auto();
   }else {
    H$$('li',H$(this.id))[0].style.opacity = this.o/100;
    H$$('li',H$(this.id))[0].style.filter = 'alpha(opacity='+this.o+')';
   }
  },
  auto : function () {
   var _this = this;
   this.__b = setInterval(function(){_this.pos()}, this.at*1000);
  }
 }
 return init;
}();


//选择器
function $a(id,tag){var re=(id&&typeof id!="string")?id:document.getElementById(id);if(!tag){return re;}else{return re.getElementsByTagName(tag);}}