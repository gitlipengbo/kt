<!--//复制程序 flash+js------end-->

<?php
$mBankId=$args[0]['mBankId'];
$sql="select mb.*, b.name bankName, b.logo bankLogo, b.home bankHome from {$this->prename}sysadmin_bank mb, {$this->prename}bank_list b where mb.bankId=$mBankId and b.isDelete=0 and mb.bankId=b.id";
$memberBank=$this->getRow($sql);
if($memberBank['bankId']==12){
?>
<!--左边栏body-->
<style type="text/css">
<!--
.banklogo input{
height:15px; width:15px
}
.banklogo{}
-->
</style>

<table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
    <tr class='table_b_th'>
      <td align="left" style="font-weight:bold;padding-left:10px;" colspan=2>充值信息</td> 
    </tr>
    <tr height=25 class='table_b_tr_b' >
      <td align="right" height="80" class="copys">充值银行：</td>
      <td align="left" ><img id="bank-type-icon" class="bankimg" src="/<?=$memberBank['bankLogo']?>" title="<?=$memberBank['bankName']?>" /></td> 
    </tr>
     <tr height=25 class='table_b_tr_b'>
      <td align="right" class="copys">充值金额：</td>
      <td align="left" ><?=$args[0]['amount']?>    </td>
    </tr>
     <tr height=25 class='table_b_tr_b'>
      <td align="right" class="copys"> 充值编号 ：</td>
      <td align="left"><?=$args[0]['rechargeId']?>
         		</td> 
    </tr>
	<tr height=25 class='table_b_tr_h'>
    <td colspan="2" align="right" class="copyss">
	  <form action="/pay/babaozf/paybabao.php" method="POST" name="a32" target="_blank">
	    <table width="414" border="0" align="center"  cellpadding="2" cellspacing="0" id="banklist" >
	      <tr>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="967" class="banking" id="bank_icbc" 
                                            checked="checked" />
                <img src="/pay/babaozf/bank/bank_icbc.gif" alt="icbc" width="107" height="20" /> </td>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="964" class="banking" id="bank_abc" />
                <img src="/pay/babaozf/bank/bank_abc.gif" alt="abc" width="107" height="20" /> </td>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="963" class="banking" id="bank_boc" />
                <img src="/pay/babaozf/bank/bank_boc.gif" alt="boc" width="107" height="20" /> </td>
			<td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="981" class="banking" id="bank_comm" />
              <img src="/pay/babaozf/bank/bank_comm.gif" alt="comm" width="107" height="20" /> </td>
          </tr>
          <tr>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="965" class="banking" id="bank_ccb" />
                <img src="/pay/babaozf/bank/bank_ccb.gif" alt="ccb" width="107" height="20" /></td>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="970" class="banking" id="bank_cmb" />
                <img src="/pay/babaozf/bank/bank_cmb.gif" alt="cmb" width="107" height="20" /> </td>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="977" class="banking" id="bank_spdb" />
                <img src="/pay/babaozf/bank/bank_spdb.gif" alt="spdb" width="107" height="20" /> </td>
			<td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="980" class="banking" id="bank_cmbc" />
                <img src="/pay/babaozf/bank/bank_cmbc.gif" alt="cmbc" width="107" height="20" /></td>
          </tr>
          <tr>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="972" class="banking" id="bank_cib" />
                <img src="/pay/babaozf/bank/bank_cib.gif" alt="cib" width="107" height="20" /> </td>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="986" class="banking" id="bank_ceb" />
                <img src="/pay/babaozf/bank/bank_ceb.gif" alt="ceb" width="107" height="20" /> </td>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="985" class="banking" id="bank_cgb" />
                <img src="/pay/babaozf/bank/bank_cgb.gif" alt="cgb" width="107" height="20" /> </td>
			 <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="990" class="banking" id="bank_psbc" />
                <img src="/pay/babaozf/bank/BJRCB_OUT.gif" alt="psbc" width="100" height="20" /></td>
          </tr>
          <tr>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="962" class="banking" id="bank_citic" />
                <img src="/pay/babaozf/bank/bank_citic.gif" alt="citic" width="107" height="20" /> </td>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="975" class="banking" id="bank_psbc" />
                <img src="/pay/babaozf/bank/bank_bos.gif" alt="psbc" width="107" height="20" /></td>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="978" class="banking" id="radio" />
                <img src="/pay/babaozf/bank/bank_pingan.gif" alt="psbc" width="107" height="20" /></td>
			<td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="970" class="banking" id="bank_citic" />
                <img src="/pay/babaozf/bank/NBBANK_OUT.gif" alt="citic" width="100" height="20" /> </td>
          </tr>
          <tr>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="989" class="banking" id="bank_citic" />
                <img src="/pay/babaozf/bank/beijing.gif" alt="citic" width="107" height="21" /> </td>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="979" class="banking" id="bank_psbc" />
                <img src="/pay/babaozf/bank/nanjing.gif" alt="psbc" width="95" height="24" /></td>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="988" class="banking" id="radio" />
                <img src="/pay/babaozf/bank/bank_bh.gif" alt="psbc" width="107" height="20" /></td>
			<td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="987" class="banking" id="radio3" />
                <img src="/pay/babaozf/bank/bank_dy.gif" alt="psbc" width="107" height="20" /></td>
          </tr>
          <tr>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="974" class="banking" id="bank_hxb" />
                <img src="/pay/babaozf/bank/bank_sdb.gif" alt="hxb" width="121" height="21" /></td>
            <td height="35" bgcolor="#ffffff"><input type="radio" style="width:12px;height:12px" name="issuerId" value="971" class="banking" id="radio2" />
                <img src="/pay/babaozf/bank/bank_psbc.gif" alt="psbc" width="107" height="20" /></td>
            <td height="35" bgcolor="#ffffff">&nbsp;</td>
            <td height="35" bgcolor="#ffffff">&nbsp;</td>
          </tr>
	      <tr>
	        <td height="40">&nbsp;</td>
            <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
	      <tr>
	          <td height="40" colspan="4" align="center"><input name="submit" type="submit"   style="height:40px; line-height:20px; font-weight:bold" value="确认充值" /></td>
          </tr>
        </table>
	    <input name="p2_Order" type="hidden" value="<?=$args[0]['rechargeId']?>" />
	    <input name="p3_Amt" type="hidden" value="<?=$args[0]['amount']?>" />
	    <input name="Attach" type="hidden" value="<?=$this->user['username']?>" />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<div style="display:inline">*注意：在线充值付款成功后，请等待30s后再关闭充值的窗口，以防资金不到账。若付款后未到账，请联系客服。
      </form></td>
	</td>
   </tr>
</table>
    <!--左边栏body结束-->
<?
}else if($memberBank['bankId']==2){
?>
<!--左边栏body-->
<style type="text/css">
<!--
.banklogo input{
height:15px; width:15px
}
.banklogo{}
-->
</style>

<table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
    <tr class='table_b_th'>
      <td align="left" style="font-weight:bold;padding-left:10px;" colspan=2>充值信息</td> 
    </tr>
    <tr height=25 class='table_b_tr_b' >
      <td align="right" height="80" class="copys">充值银行：</td>
      <td align="left" ><img id="bank-type-icon" class="bankimg" src="/<?=$memberBank['bankLogo']?>" title="<?=$memberBank['bankName']?>" /></td> 
    </tr>
     <tr height=25 class='table_b_tr_b'>
      <td align="right" class="copys">充值金额：</td>
      <td align="left" ><?=$args[0]['amount']?>    </td>
    </tr>
     <tr height=25 class='table_b_tr_b'>
      <td align="right" class="copys"> 充值编号 ：</td>
      <td align="left"><?=$args[0]['rechargeId']?>
         		</td> 
    </tr>
	<tr height=25 class='table_b_tr_b'>
      <td align="right" class="copys"> 充值方式 ：</td>
      <td align="left">支付宝支付
         		</td> 
    </tr>
	<tr height=25 class='table_b_tr_h'>
    <td colspan="2" align="right" class="copyss">
	  <form action="/pay/babaozf/paybabao.php" method="POST" name="a32" target="_blank">
	    <table width="414" border="0" align="center"  cellpadding="0" cellspacing="0" > 
	      <tr>
	        <td height="40">&nbsp;</td>
            <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
	      <tr>
	          <td height="40" colspan="4" align="center"><input name="submit" type="submit"   style="height:40px; line-height:20px; font-weight:bold" value="确认充值" /></td>
          </tr>
        </table>
	    <input name="p2_Order" type="hidden" value="<?=$args[0]['rechargeId']?>" />
	    <input name="issuerId" type="hidden" value="992" />
	    <input name="p3_Amt" type="hidden" value="<?=$args[0]['amount']?>" />
	    <input name="Attach" type="hidden" value="<?=$this->user['username']?>" />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<div style="display:inline">*注意：在线充值付款成功后，请等待30s后再关闭充值的窗口，以防资金不到账。若付款后未到账，请联系客服。
      </form></td>
	</td>
   </tr>
</table>
    <!--左边栏body结束-->
<?
}else if($memberBank['bankId']==1){
?>
<!--左边栏body-->
<style type="text/css">
<!--
.banklogo input{
height:15px; width:15px
}
.banklogo{}
-->
</style>

<table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
    <tr class='table_b_th'>
      <td align="left" style="font-weight:bold;padding-left:10px;" colspan=2>充值信息</td> 
    </tr>
    <tr height=25 class='table_b_tr_b' >
      <td align="right" height="80" class="copys">充值银行：</td>
      <td align="left" ><img id="bank-type-icon" class="bankimg" src="/<?=$memberBank['bankLogo']?>" title="<?=$memberBank['bankName']?>" /></td> 
    </tr>
     <tr height=25 class='table_b_tr_b'>
      <td align="right" class="copys">充值金额：</td>
      <td align="left" ><?=$args[0]['amount']?>    </td>
    </tr>
     <tr height=25 class='table_b_tr_b'>
      <td align="right" class="copys"> 充值编号 ：</td>
      <td align="left"><?=$args[0]['rechargeId']?>
         		</td> 
    </tr>
	<tr height=25 class='table_b_tr_b'>
      <td align="right" class="copys"> 充值方式 ：</td>
      <td align="left">微信支付
         		</td> 
    </tr>
	<tr height=25 class='table_b_tr_h'>
    <td colspan="2" align="right" class="copyss">
	  <form action="/pay/babaozf/paybabao.php" method="POST" name="a32" target="_blank">
	    <table width="414" border="0" align="center"  cellpadding="0" cellspacing="0" > 
	      <tr>
	        <td height="40">&nbsp;</td>
            <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
	      <tr>
	          <td height="40" colspan="4" align="center"><input name="submit" type="submit"   style="height:40px; line-height:20px; font-weight:bold" value="确认充值" /></td>
          </tr>
        </table>
	    <input name="p2_Order" type="hidden" value="<?=$args[0]['rechargeId']?>" />
	    <input name="issuerId" type="hidden" value="1004" />
	    <input name="p3_Amt" type="hidden" value="<?=$args[0]['amount']?>" />
	    <input name="Attach" type="hidden" value="<?=$this->user['username']?>" />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<div style="display:inline">*注意：在线充值付款成功后，请等待30s后再关闭充值的窗口，以防资金不到账。若付款后未到账，请联系客服。
      </form></td>
	</td>
   </tr>
</table>
    <!--左边栏body结束-->
<?
}else{
?>
<!--左边栏body-->
<table width="100%" border="0" cellspacing="1" cellpadding="4" class='table_b'>
    <tr class='table_b_th'>
      <td align="left" style="font-weight:bold;padding-left:10px;" colspan=2>充值信息</td> 
    </tr>
    
    <tr height=25 class='table_b_tr_b' >
      <td align="right" class="copys">充值银行：</td>
      <td align="left" ><img id="bank-type-icon" class="bankimg" src="/<?=$memberBank['bankLogo']?>" title="<?=$memberBank['bankName']?>" />
            <a id="bank-link" target="_blank" href="<?=$memberBank['bankHome']?>" class="spn11" style="margin-left:50px;">进入银行网站>></a>
      </td> 
    </tr>
	<tr height=25 class='table_b_tr_b'>
      <td align="right" class="copys">收款户名：</td>
      <td align="left" ><input id="bank-username" readonly value="<?=$memberBank["username"]?>" />
	  <div class="btn-a copy" for="bank-username">
	  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="62" height="23" id="copy-bankuser" align="top">
                <param name="allowScriptAccess" value="always" />
                <param name="movie" value="/skin/js/copy.swf?movieID=copy-bankuser&inputID=bank-username" />
                <param name="quality" value="high" />
				<param name="wmode" value="transparent">
                <param name="bgcolor" value="#ffffff" />
                <param name="scale" value="noscale" /><!-- FLASH原始像素显示-->
                <embed src="/skin/js/copy.swf?movieID=copy-bankuser&inputID=bank-username" width="62" height="23" name="copy-bankuser" align="top" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" />
        </object> 
	  </div></td> 
    </tr>
    <tr height=25 class='table_b_tr_b' >
      <td align="right" class="copys" >收款账号：</td>
      <td align="left" ><input id="bank-account" readonly value="<?=$memberBank["account"]?>" />
	  <div class="btn-a copy" for="bank-account">
	  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="62" height="23" id="copy-account" align="top">
                <param name="allowScriptAccess" value="always" />
                <param name="movie" value="/skin/js/copy.swf?movieID=copy-account&inputID=bank-account" />
                <param name="quality" value="high" />
				<param name="wmode" value="transparent">
                <param name="bgcolor" value="#ffffff" />
                <param name="scale" value="noscale" /><!-- FLASH原始像素显示-->
                <embed src="/skin/js/copy.swf?movieID=copy-account&inputID=bank-account" width="62" height="23" name="copy-account" align="top" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" />
        </object>
		</div>
	  </td> 
    </tr>
     <tr height=25 class='table_b_tr_b'>
      <td align="right" class="copys">充值金额：</td>
      <td align="left" ><input id="recharg-amount" readonly value="<?=$args[0]['amount']?>" />
      <div class="btn-a copy" for="recharg-amount"><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="62" height="23" id="copy-recharg" align="top">
                <param name="allowScriptAccess" value="always" />
                <param name="movie" value="/skin/js/copy.swf?movieID=copy-recharg&inputID=recharg-amount" />
                <param name="quality" value="high" />
				<param name="wmode" value="transparent">
                <param name="bgcolor" value="#ffffff" />
                <param name="scale" value="noscale" /><!-- FLASH原始像素显示-->
                <embed src="/skin/js/copy.swf?movieID=copy-recharg&inputID=recharg-amount" width="62" height="23" name="copy-recharg" align="top" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" />
            </object>
	 </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<div class="spn12" style="display:inline;">*网银充值金额必须与网站填写金额一致方能到账！</div>
      </td>
    </tr>
     <tr height=25 class='table_b_tr_b'>
      <td align="right" class="copys">充值编号：</td>
      <td align="left"><input id="username" readonly value="<?=$args[0]['rechargeId']?>" />
         <div class="btn-a copy" for="username">
            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="62" height="23" id="copy-username" align="top">
                <param name="allowScriptAccess" value="always" />
                <param name="movie" value="/skin/js/copy.swf?movieID=copy-username&inputID=username" />
                <param name="quality" value="high" />
				<param name="wmode" value="transparent">
                <param name="bgcolor" value="#ffffff" />
                <param name="scale" value="noscale" /><!-- FLASH原始像素显示-->
                <embed src="/skin/js/copy.swf?movieID=copy-username&inputID=username" width="62" height="23" name="copy-username" align="top" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" />
            </object> 
        </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<div class="spn12"  style="display:inline;">*网银充值请务必将此编号填写到汇款“附言”里，每个充值编号仅用于一笔充值，重复使用将不能到账！</div>
	   </td> 
    </tr>
<!--左边栏body结束-->
<?php if($memberBank["rechargeDemo"]){?>
   <tr height=25 class='table_b_tr_b'>
      <td align="right" style="font-weight:bold;"></td>
      <td align="left" > <div class="example">充值图示：<div class="example2" rel="<?=$memberBank["rechargeDemo"]?>">查看</div></div></td> 
  </tr>
<? }?>
<tr>
<div class="tips">
	<dl>
        <dt>充值说明：</dt>
        <dd>1.每次"充值编号"均不相同,务必将"充值编号"正确复制填写到引号汇款页面的"附言"栏目中;</dd>
        <dd>2.帐号不固定，转帐前请仔细核对该帐号;</dd>
        <dd>3.充值金额与网友转账金额不符，充值将无法到账;</dd>
        <dd>4.转账后如10分钟未到账，请联系客服，告知您的充值编号和您的充值金额及你的银行用户姓名。</dd>
    </dl>
</div>
</tr>
</table> 
<?php }?>