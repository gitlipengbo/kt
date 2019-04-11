<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->display('inc_skin_lr.php',0,'新用户注册'); ?>
</head>

<body>
<div class="mb5"><img src="/images/common/logo.png" /></div>
<div id="header">
    <div class="logo">新用户注册</div> 
</div>
<div id="content">
    <div class="form">
        <div class="form-inner">
         <?php if($args[0] && $args[1]){
        
		$sql="select * from {$this->prename}links where lid=?";
		$linkData=$this->getRow($sql, $args[1]);
		$sql="select * from {$this->prename}members where uid=?";
		$userData=$this->getRow($sql, $args[0]);
	
		?>

		<form action="/index.php/user/registered" method="post" onajax="registerBeforSubmit" enter="true" call="registerSubmit" target="ajax">
        	<input type="hidden" name="parentId" value="<?=$args[0]?>" />
            <input type="hidden" name="type" value="<?=$linkData['type']?>" />
            <input type="hidden" name="fanDian" value="<?=$linkData['fanDian']?>"  />
            <input type="hidden" name="fanDianBdw" value="<?=$linkData['fanDianBdw']?>"  />
          	<dl>
            	<dt>用户名：</dt>
                <dd><input name="username" type="text" id="username" class="login-text" /></dd>
            </dl>
            <dl>
            	<dt>密  码：</dt>
                <dd><input name="password" type="password" id="password" class="login-text" /></dd>
            </dl>
             <dl>
            	<dt>确认密码：</dt>
                <dd><input name="cpasswd" type="password" id="cpasswd" class="login-text" /></dd>
            </dl>
             <dl>
            	<dt>Q  Q：</dt>
                <dd><input name="qq" type="test" id="qq" class="login-text" /></dd>
            </dl>
            <dl>
            	<dt>验证码：</dt>
                <dd class="yzm"><input name="vcode" type="text" id="vcode" class="login-text" /><img width="72" height="24" border="0" style="cursor:pointer;" align="absmiddle" src="/index.php/user/vcode/<?=$this->time?>" class="ml10" title="看不清楚，换一张图片" onclick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/></dd>
            </dl>
            <div class="clear"></div>
             <dl>
            	<dt class="hide"><input type="submit" value=""/></dt>
                <dd><button class="login-btn" tabindex="5" type="button" onclick="$(this).closest('form').submit()">注　册</button></dd>
            </dl>
          </form>
           <?php }else{?>
           <div style="text-align:center; line-height:50px; color:#FF0; font-size:20px; font-weight:bold;">链接失效！</div>
           <?php }?>
        </div>
    </div>
    
</div>
<div id="footer">Copyright &copy; 彩票频道</div>
</body>
</html>
