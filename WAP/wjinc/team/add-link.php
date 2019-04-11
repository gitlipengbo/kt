<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '添加链接－代理中心'); ?>
<?php if(!$this->user['type']) header('location: /index.php/tip/show/1');?>
</head> 
 
<body>
<div id="mainbody"> 
<?php $this->display('inc_header.php'); ?>
<div class="pagetop"></div>
<div class="pagemain">
	
    <div class="display biao-cont">
    <form action="/index.php/team/insertLink" method="post" target="ajax" onajax="teamBeforeAddLink" call="teamAddLink">
	<input name="uid" type="hidden" id="uid" value="<?=$this->user['uid']?>" />
    <h3>新增注册链接</h3>
    <dl class="wjform">
        <dt>账号类型：</dt>
        <dd><label><input type="radio" name="type" value="1" title="代理" style="width:auto;" />代理</label><label><input name="type"  type="radio" value="0" title="会员" style="margin-left:30px;width:auto;" checked="checked" />会员</label></dd>
    </dl>
    <dl class="wjform">
        <dt>返点：</dt>
        <dd><input name="fanDian" max="<?=$this->user['fanDian']?>" value=""  fanDianDiff=<?=$this->settings['fanDianDiff']?> /><span style="color:#CCC; margin-left:10px;">0-<?=$this->user['fanDian']?>%</span></dd>
    </dl>
    <dl class="wjform">
        <dt>不定位返点：</dt>
        <dd><input name="fanDianBdw" max="<?=$this->user['fanDianBdw']?>" value="" /><span style="color:#CCC; margin-left:10px;">0-<?=$this->user['fanDianBdw']?>%</span></dd>
    </dl>
    <dl class="wjform">
        <dt>&nbsp;</dt>
        <dd><input type="submit" id='put_button_pass' class="btn addbtn" value="增加链接" >
        <input type="reset" value="重置" class="btn"/></dd>
    </dl>

</form>
    </div>
<?php $this->display('inc_footer.php'); ?> 
</div>
<div class="pagebottom"></div>
</div>

</body>
</html>
  
   
 