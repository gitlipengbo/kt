function _alertdiv() {
    this.success = 1;
    this.error = 0;
}
var alertdiv = new _alertdiv();

$(document).ready(function () {
	
	//登录
	$('#_login_common').dialog( {
		autoOpen :false,
		modal :true,
		width :360,
		resizable :false,
		title :'用户登录'
	});
	
	//普通提示
    $('#_box_common').dialog({
        modal: true,
        autoOpen: false,
        width: 360,
        resizable: false,
        buttons: {
            '关闭': function () {
                $(this).dialog('close');
            }
        }
    });
    //确认提示
    $('#_config_common').dialog({
        modal: true,
        autoOpen: false,
        width: 360,
        resizable: false,
        title: '确认提示'
    });
	
	
});
/**
* 调用登录对话窗口
* 登录之前清除对话框中数据
*/
_alertdiv.prototype.login = function (fun) {
    //清除数据
    $("#login_tip").html("");
    $("#username_common").val("");
    $("#password_common").val("");
    $("#verifycode").val("");
    $("#_login_common").dialog("open");
    $("#login_tip").hide();
	$("#commonLoginButton").unbind()
	$("#commonLoginButton").click(function(){
		alertdiv.commonLogin(fun)
	})
}

/**
* 登录提交
* @return
*/
_alertdiv.prototype.commonLogin = function (fun) {
    if (loginstatus.login()) {
        $('#_login_common').dialog('close');
        if (fun) {
         	fun();
        }
    }
}

//确定框提示
_alertdiv.prototype.confirm = function (msg, trueFunc, falseFunc, title) {
    if (typeof (title) == "undefined") {
        title = "确认提示";
    }
    $('#_config_common font.t_weight').html(msg);
    $('#_config_common').dialog({
        title: title,
        position:"center",
        buttons: {
			 '取消': function () {
                if (falseFunc) {
                    falseFunc();
                }
                $(this).dialog('close');
            },
			 '确定': function () {
                if (trueFunc) {
                    trueFunc();
                }
                $(this).dialog('close');
            }
			
       }
    }).dialog('open');
}

//确定框提示 只有确定，没有取消的
_alertdiv.prototype.confirm2 = function (msg, trueFunc, title) {
    if (typeof (title) == "undefined") {
        title = "确认提示";
    }
    $('#_config_common font.t_weight').html(msg);
    $('#_config_common').dialog({
        title: title,
        position: "center",
        buttons: {
            '确定': function () {
                if (trueFunc) {
                    trueFunc();
                }
                $(this).dialog('close');
            }
        }
    }).dialog('open');
}
_alertdiv.prototype.loading = function () {
    $('#_box_loading').ajaxSend(function () {
        $(this).dialog('open');
    }).ajaxComplete(function () {
        $(this).dialog('close');
    });
}

/**
* 提示窗口
*
* @param str
* 提示信息
* @return
*/
_alertdiv.prototype.alert = function (msg) {
    alertdiv.box(alertdiv.success, msg);
}

/**
* 购买成功
*
* @return
*/
_alertdiv.prototype.buySeccess = function () {
    var title = "温馨提示";
    $('#_ajax_common_div4').dialog({
        title: "温馨提示",
        resizable: false,
        modal: true,
        height: 'auto',
        width: '490px'
    });
}

/**
* 购买成功
*
* @return
*/
_alertdiv.prototype.showBox = function (divId, title, height, width, modal,resizable) {
    if (!title || title == null)
        title = "提示";
    if (!height || height == null)
        height = 'auto';
    if (!width || width == null)
        width = 'auto';
    if (!modal || modal == null)
        modal = true;
    if (!resizable || resizable == null)
        resizable = false;
    var p = {
        title: title,
        height: height,
        width: width,
        modal: modal,
        resizable: resizable
    };
    $("#" + divId).dialog(p).dialog('open');
}

/**
* 弹出信息
*
* @param type
* 类型
* @param msg
* 显示内容
* @return
*/

_alertdiv.prototype.box = function (type, msg) {
    var title;
    if (type == alertdiv.success) {
        title = "温馨提示";
    } else {
        title = "错误提示";
    }
    $('#_box_common font.t_weight').html(msg);
    var p = {
        title: title,
        position: 'center'
    };
    $('#_box_common').dialog(p).dialog('open');
}

/**
* 关闭层
* divId 层ID名称
* @return
*/
_alertdiv.prototype.close = function (divId) {
    $('#' + divId).dialog('close');
}

/**
* 关闭层
* @index 层索引(可选参数) 可选值为1,2,3
* @return
*/
_alertdiv.prototype.closeAjaxLayer = function (index) {
    if (!index) {
        index = 1;
    }
    $('#_ajax_common_div' + index).dialog('close');
}
 

//显示选择彩种(28)下拉菜单
function showMenuDownPanel(val, span) {
    var div = $cailele_index_fid("downpanelDIV");
    var _bgdiv = $cailele_index_fid("downpanelbgDIV");
    if (!span)
        span = $cailele_index_fid("menuDownBtn");

    if (val == 1) {
        div.style.display = "inline-block";
        span.className = "menuhover";
        try{_bgdiv.style.display = "inline-block";}catch(e){}
        try{showHideSelect(0);}catch(e){}
    }
    else {
        div.style.display = "none";
        span.className = "menu";
        try{_bgdiv.style.display = "none";}catch(e){}
        try{showHideSelect(1);}catch(e){}
    }
    return;
}
/*--导航"选择彩种"下拉框隐藏与显示---*/
function menuShower(){
	document.getElementById("menuBox").style.display = "block";
	document.getElementById("selectMenuTxt").className = "txt hover";
}
 
function menuHider(){
	document.getElementById("menuBox").style.display = "none";
	document.getElementById("selectMenuTxt").className = "txt";
}

var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?381450dfdb0c66d3b6db264900f302c0";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();

//加入收藏 
function AddFavorite(sURL, sTitle) { 
sURL = encodeURI(sURL);
 try{
window.external.addFavorite(sURL, sTitle);
}catch(e) {
try{
window.sidebar.addPanel(sTitle, sURL, "");
}catch (e) {   
alert("加入收藏失败，请使用Ctrl+D进行添加,或手动在浏览器里进行设置."); 
}
} 
} 
//设为首页 
function SetHome(url){ 
if (document.all) { 
document.body.style.behavior='url(#default#homepage)'; 
   document.body.setHomePage(url); 
}else{ 
alert("您好,您的浏览器不支持自动设置页面为首页功能,请您手动在浏览器里设置该页面为首页!"); 
} 
} 