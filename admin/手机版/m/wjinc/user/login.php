<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->display('inc_skin_lr.php',0,'用户登录'); ?>
</head>

<body>
<div class="mb5"><img src="/images/common/logo.png" /></div>
<div id="header">
    <div class="logo">用户登录</div>
    
</div>
<div id="content">
    <div class="form">
        <div class="form-inner">
        <form action="/index.php/user/logined" method="post" onajax="userBeforeLogin" enter="true" call="userLogin" target="ajax">
        	<dl>
            	<dt>用户名：</dt>
                <dd><input name="username" type="text" id="username" class="login-text" /></dd>
            </dl>
            <dl>
            	<dt>密  码：</dt>
                <dd><input name="password" type="password" id="password" class="login-text" /></dd>
            </dl>
            <dl>
            	<dt>验证码：</dt>
                <dd class="yzm"><input name="vcode" type="text" id="vcode" class="login-text" /><img width="72" height="24" border="0" style="cursor:pointer;" align="absmiddle" src="/index.php/user/vcode/<?=$this->time?>" class="ml10" title="看不清楚，换一张图片" onclick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/></dd>
            </dl>
            <div class="clear"></div>
             <dl>
            	<dt class="hide"><input type="submit" value=""/></dt>
                <dd><button class="login-btn" tabindex="5" type="button" onclick="$(this).closest('form').submit()">登　录</button></dd>
            </dl>
          </form>
        </div>
    </div>
  
</div>
<div id="footer">Copyright &copy; 彩票频道</div>
</body>
</html>
<SCRIPT>alert('近期发现有人盗用本站演示平台进行骗钱！  \n\n已经有几位客户受骗了,大家加以防范,否则被骗勿扰。\n\n购买前请致电:15500011186 确认你联系的QQ是否正确， 切记!！\n\n  ');</SCRIPT>
