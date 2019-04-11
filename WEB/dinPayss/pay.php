<?php

include '../config.php';
header("content-Type: text/html; charset=gb2132");

$order_no = intval($_POST['order_no']);    //接收平台传递过来的订单号，重要,所有订单号必需唯一,绝不可重复
$order_amount = floatval($_POST['order_amount']);       //接收平台传递过来的充值金额,重要
$extra_return_param = $_POST['extra_return_param'];        //接收平台传递过来的用户名，重要
$time = date("Y-m-d H:i:s");             //时间参数

$conn = mysql_connect($dbhost,$conf['db']['user'],$conf['db']['password']);
if (!$conn)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($dbname,$conn);

$extra_return_param = mysql_escape_string($extra_return_param);

$info = "INSERT INTO ssc_order(order_number, username, recharge_amount, state, time)
VALUES('".$order_no."', '".$extra_return_param."', '".$order_amount."', '0', '".$time."')";

mysql_query($info);

mysql_close($conn);

?>

<form action="http://42.51.153.185/dinpayss/MerToDinpay.php" method="post" name="a32" target="_top" >
<input name="order_no" type="hidden" value="<?php echo $order_no;?>" />
<input name="order_amount" type="hidden" value="<?php echo $order_amount;?>" />
<input name="extra_return_param" type="hidden" value="<?php echo $extra_return_param;?>" />
<input name="order_time" type="hidden" value="<?php echo $time;?>" />


 <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
 	   <tr width="600" align="center">
          <td height="80" valign="top"><img src="/img/bank-icons/bank-khb.jpg" width="139" height="38" style="float:center; margin-top:8px;"></td>
       </tr>
  <tr>
    <td>    <div class="heng heng-w">
            <div class="aq-txt">充值金额：
            <SPAN style="font-size:15px;color:#ff0000;padding-top:6px"><?php echo $order_amount;?>元</SPAN>
            
           
        </div>

    <div class="heng heng-w">
            <div class="aq-txt">选择银行：</div>
            <div  ><table  border="0" cellpadding="5" cellspacing="2" bgcolor="#ffffff">
                            <tbody>
                                <tr>
                                    <td height="35" bgcolor="#ffffff">
                                        <input type="radio" name="bank_code" value="ICBC" class="banking" id="bank_icbc" 
                                            checked="checked" >
                                  <img src="/dinpay/bank/bank_icbc.gif" alt="icbc" width="107" height="20">                                    </td>
                                    <td height="35" bgcolor="#ffffff">
                                        <input type="radio" name="bank_code" value="ABC" class="banking" id="bank_abc" >
                                  <img src="/dinpay/bank/bank_abc.gif" alt="abc" width="107" height="20">                                    </td>
                                    <td height="35" bgcolor="#ffffff">
                                        <input type="radio" name="bank_code" value="BOC" class="banking" id="bank_boc" >
                                  <img src="/dinpay/bank/bank_boc.gif" alt="boc" width="107" height="20">                                    </td>
                                </tr>
                                <tr>
                                    <td height="35" bgcolor="#ffffff">
                                        <input type="radio" name="bank_code" value="BOOM" class="banking" id="bank_comm" >
                                  <img src="/dinpay/bank/bank_comm.gif" alt="comm" width="107" height="20">                                    </td>
								    <td height="35" bgcolor="#ffffff"><input type="radio" name="bank_code" value="CCB" class="banking" id="bank_ccb">
                                  <img src="/dinpay/bank/bank_ccb.gif" alt="ccb" width="107" height="20" /></td>
                                    <td height="35" bgcolor="#ffffff">
                                        <input type="radio" name="bank_code" value="CMB" class="banking" id="bank_cmb" >
                                  <img src="/dinpay/bank/bank_cmb.gif" alt="cmb" width="107" height="20">                                    </td>
                                </tr>
                                <tr>
                                    <td height="35" bgcolor="#ffffff">
                                        <input type="radio" name="bank_code" value="CIB" class="banking" id="bank_cib" >
                                  <img src="/dinpay/bank/bank_cib.gif" alt="cib" width="107" height="20">                                    </td>
                                    <td height="35" bgcolor="#ffffff">
                                        <input type="radio" name="bank_code" value="CEBB" class="banking" id="bank_ceb" >
                                  <img src="/dinpay/bank/bank_ceb.gif" alt="ceb" width="107" height="20">                                    </td>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="bank_code" value="GDB" class="banking" id="bank_cgb">
                                  <img src="/dinpay/bank/bank_cgb.gif" alt="cgb" width="107" height="20" /> </td>
                                </tr>
                                <tr>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="bank_code" value="ECITIC" class="banking" id="bank_citic">
                                  <img src="/dinpay/bank/bank_citic.gif" alt="citic" width="107" height="20" /> </td>

                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="bank_code" value="SPABANK" class="banking" id="radio" />
                                  <img src="/dinpay/bank/bank_pingan.gif" alt="psbc" width="107" height="20" /></td>
								  <td height="35" bgcolor="#ffffff"><input type="radio" name="bank_code" value="CMBC" class="banking" id="bank_cmbc">
                                  <img src="/dinpay/bank/bank_cmbc.gif" alt="cmbc" width="107" height="20" /></td>
                                </tr>
                                <tr>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="bank_code" value="SDB" class="banking" id="bank_hxb" />
                                  <img src="/dinpay/bank/bank_sdb.gif" alt="hxb" width="121" height="21" /></td>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="bank_code" value="PSBC" class="banking" id="radio2" />
                                  <img src="/dinpay/bank/bank_psbc.gif" alt="psbc" width="107" height="20" /></td>
                                </tr>       
                                <tr>
                                  <td height="35" bgcolor="#ffffff">&nbsp;</td>
                                  <td height="35" bgcolor="#ffffff">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td height="35" bgcolor="#ffffff"><input name="Inputaa" type="submit" value="马上提交充值" /></td>
                                  <td height="35" bgcolor="#ffffff"><a href="htt;//www.baidu.com/" target="_blank"> </a></td>
                                  <td height="35" bgcolor="#ffffff">&nbsp;</td>
                                </tr>
                            </tbody>
      </table>
            </div>
            
      </div></td>
  </tr>
</table>
</form>