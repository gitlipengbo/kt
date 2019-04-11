<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '添加会员－代理中心'); ?>
<?php if(!$this->user['type']) header('location: /index.php/tip/show/1');?>
</head> 
 
<body>
<div id="mainbody"> 
<?php $this->display('inc_header.php'); ?>
<div class="pagetop"></div>
<div class="pagemain">
	
    <div class="display biao-cont">
		<form action="/index.php/team/insertMember" method="post" target="ajax" onajax="teamBeforeAddMember" call="teamAddMember">

<table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
    <tr class='table_b_th'>
      <td align="left" style="font-weight:bold;padding-left:10px;" colspan=2>新增成员</td> 
    </tr>
    
    <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;">账号类型：</td>
      <td align="left" ><label><input type="radio" name="type" value="1" title="代理" checked="checked" style="width:auto;" />代理</label><label><input name="type" type="radio" value="0" title="会员" style="margin-left:30px;width:auto;"  />会员</label></td> 
    </tr>  
    <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;">用户名：</td>
      <td align="left" ><input name="username"  value="" /></td> 
    </tr> 
     <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;">密码：</td>
      <td align="left" ><input name="password" type="password"  value="" /></td> 
    </tr>  
     <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;">确认密码：</td>
      <td align="left" ><input id="cpasswd" type="password" value="" /></td> 
    </tr> 
     <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;">联系 Q Q：</td>
      <td align="left" ><input name="qq" value="" /></td> 
    </tr>  
    <!-- <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;">人数配额：</td>
      <td align="left" ><input name="subCount"  value="" /></td> 
    </tr>-->
    <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;">返点%：</td>
      <td align="left" ><input name="fanDian" max="<?=$this->user['fanDian']?>" value=""  fanDianDiff=<?=$this->settings['fanDianDiff']?> /></td> 
    </tr>
     <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;">不定位返点%：</td>
      <td align="left" ><input name="fanDianBdw" max="<?=$this->user['fanDianBdw']?>" value=""  /></td> 
    </tr>
     <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;"></td>
      <td align="left"><input type="submit" id='put_button_pass' class="btn addbtn" value="增加成员" >
        <input type="reset" value="重置" class="btn"/> </td> 
    </tr> 
     
   
</table> 
</form>
    </div>
<?php $this->display('inc_footer.php'); ?> 
</div>
<div class="pagebottom"></div>
</div>

</body>
</html>
  
   
 