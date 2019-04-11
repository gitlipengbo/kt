<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '会员中心 - 在线充值'); ?>
<script type="text/javascript">
$(function(){
	$('form').trigger('reset');
	$(':radio').click(function(){
		var data=$(this).data('bank'),
		box=$('#display-dom');
		
		$('#bank-type-icon', box).attr('src', '/'+data.logo);

		if($.cookie('rechargeBank')!=data.id) $.cookie('rechargeBank', data.id, 360*24);
	});
	
	var bankId=$.cookie('rechargeBank')||$(':radio').attr('value');
	$(':radio[value='+bankId+']').click();
	
	$('.copy').click(function(){
		var text=document.getElementById($(this).attr('for')).value;
		if(!CopyToClipboard(text, function(){
			alert('复制成功');
		}));
	});
	
	$('.example2').click(function(){
		var src='/'+$(this).attr('rel');
		if(src) $('<div>').append($('<img>',{src:src,width:'640px',height:'480px'})).dialog({width:630,height:500,title:'充值演示'});
	});
	
	$('input[name=mBankId]').click(function(){
		var bname=$(this).attr("cname");
		$("#bank-type-name").text(bname);	
	});
});

function checkRecharge(){
	if(!this.amount.value) throw('请填写充值金额');
	//if(isNaN(amount)) throw('充值金额错误');
	if(!this.amount.value.match(/^\d+(\.\d{0,2})?$/)) throw('充值金额错误');
	var amount=parseInt(this.amount.value),
	$this=$('input[name=amount]',this),
	$bname=$('input[name=mBankId]:checked',this),
	min=parseInt($this.attr('min')),
	max=parseInt($this.attr('max'));
	min1=parseInt($this.attr('min1')),
	max1=parseInt($this.attr('max1'));
	
	if(!$bname) throw('请选择充值银行');
	if($('input[name=mBankId]').val()==2||$('input[name=mBankId]').val()==3){
		if(amount<min1) throw('支付宝/财付通充值金额最小为'+min1+'元');
		if(amount>max1) throw('支付宝/财付通充值金额最多限额为'+max1+'元');
	}else{
		if(amount<min) throw('充值金额最小为'+min+'元');
		if(amount>max) throw('充值金额最多限额为'+max+'元');
	}
	
	
	if(!this.coinpwd.value) throw('请输入资金密码');
	if(this.coinpwd.value<6) throw('资金密码至少6位');
	
}
function toCash(err, data){
	//console.log(err);
	if(err){
		alert(err)
	}else{
		$(':password').val('');
		$('input[name=amount]').val('');
		$('.biao-cont').html(data);
	}
}
$(function(){
	$('input[name=amount]').keypress(function(event){
		//console.log(event);
		event.keyCode=event.keyCode || event.charCode;
		return !!(
			// 数字键
			(event.keyCode>=48 && event.keyCode<=57)
			|| event.keyCode==13
			|| event.keyCode==8
			|| event.keyCode==9
			|| event.keyCode==46
		)
	});
});
</script>
<script type="text/javascript">
$(function(){
	$('.example2').click(function(){
		var src='/'+$(this).attr('rel');
		if(src) $('<img>',{src:src}).css({width:'640px',height:'480px'}).dialog({width:660,height:500,title:'充值演示'});
	});
	
	$('.copy').click(function(){
		var text=document.getElementById($(this).attr('for')).value;
		if(!CopyToClipboard(text, function(){
			alert('复制成功');
		}));
	});
});
</script>

<!--//复制程序 flash+js-->

<script language="JavaScript">
function Alert(msg) {
	alert(msg);
}
function thisMovie(movieName) {
	 if (navigator.appName.indexOf("Microsoft") != -1) {   
		 return window[movieName];   
	 } else {   
		 return document[movieName];   
	 }   
 } 
function copyFun(ID) {
	thisMovie(ID[0]).getASVars($("#"+ID[1]).attr('value'));
}
</script>
<script type="text/javascript" src="/skin/js/swfobject.js"></script>
</head> 
 
<body>
<div id="mainbody"> 
<?php $this->display('inc_header.php'); ?>
<div class="pagetop"></div>
<div class="pagemain">
	
    <div class="display biao-cont">
        <?php
				$this->freshSession();
    $sql="select b.id,b.name,b.logo,b.home,m.username,m.account,m.rechargeDemo from {$this->prename}bank_list b, {$this->prename}admin_bank m where m.enable=1 and b.id=m.bankId";
    $banks=$this->getRows($sql);
        
    if($banks){
    if($this->user['coinPassword']){
					
				?>
        <form action="/index.php/cash/inRecharge" method="post" target="ajax" onajax="checkRecharge" call="toCash" dataType="html">

        <h3>在线充值</h3>
       
        <dl class="wjform">
        	<dt>选择充值银行：</dt>
            <dd>
				<?php
                    
				$set=$this->getSystemSettings();
				$count=0;
				if($banks) foreach($banks as $bank){
				$count++;
				if($count==1){$cStr="checked";$bName=$bank['name'];}else{$cStr="";}
                ?>
                <div class="bankchoice">
                    <label><input style="width:auto;" type="radio" class="xuan" name="mBankId" value="<?=$bank['id']?>" cname="<?=$bank['name']?>" <?=$cStr?> data-bank="<?=json_encode($bank)?>"><img src="<?=$GLOBALS['siteUrl']?>/<?=$bank['logo']?>" width="100" alt="" /></label>
                </div>
                <?php } ?>
            </dd>
        </dl>
        <dl class="wjform" id="display-dom">
        	<dt>银行类型：</dt>
            <dd><b id="bank-type-name"><?=$bName?></b></dd>
        </dl>
       <dl class="wjform">
        	<dt>充值金额：</dt>
            <dd><input name="amount" min="<?=$set['rechargeMin']?>" max="<?=$set['rechargeMax']?>" min1="<?=$set['rechargeMin1']?>" max1="<?=$set['rechargeMax1']?>" value="" /></dd>
        </dl>
        <dl class="wjform">
        	<dt>&nbsp;</dt>
            <dd  class="red">[*请一次性充值<?=$set['rechargeMin']?>元以上金额！]</dd>
        </dl>
        <dl class="wjform">
        	<dt>资金密码：</dt>
            <dd><input name="coinpwd" type="password" value="" /></dd>
        </dl>
        <dl class="wjform">
        	<dt>&nbsp;</dt>
            <dd><input type="button" id='put_button_pass' class="btn darwingbtn" value="进入充值"  onclick="$(this).closest('form').submit()">
        <input type="reset" value="重置" class="btn"/></dd>
        </dl>
</form>
  <?php
	}else{
	?>
	<div style=" margin-top:30px; text-align:center;">尚未设置您的资金管理密码！<a href="/index.php/safe/passwd" style="color:#F00; text-decoration:none;">马上设置>></a></div>
	<?php
	}
	?>
	<?php }else{ ?>
	<div style=" margin-top:30px; text-align:center;color:#F00;">
		充值暂停！
	</div>
	<?php }?>

    </div>
<?php $this->display('inc_footer.php'); ?> 
</div>
<div class="pagebottom"></div>
</div>

</body>
</html>
  
   
 