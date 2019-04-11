<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>充值结果</title>
<?php
include '../config.php';

$_MerchantID=$_REQUEST['MerchantID'];//商户号
$_TransID =$_REQUEST['TransID'];//流水号
$_Result=$_REQUEST['Result'];//支付结果(1:成功,0:失败)
$_resultDesc=$_REQUEST['resultDesc'];//支付结果描述
$_factMoney=$_REQUEST['factMoney'];//实际成交金额
$_additionalInfo=$_REQUEST['additionalInfo'];//订单附加消息
$_SuccTime=$_REQUEST['SuccTime'];//交易成功时间
$_Md5Sign=$_REQUEST['Md5Sign'];//md5签名
$_Md5Key="kmu26ukyye9p78ep";   //记得此处配置密钥！！！！！！！
$_WaitSign=md5($_MerchantID.$_TransID.$_Result.$_resultDesc.$_factMoney.$_additionalInfo.$_SuccTime.$_Md5Key);
$_factMoney=$_factMoney/100;

if ($_Md5Sign == $_WaitSign) {
$conn = mysql_connect($dbhost,$conf['db']['user'],$conf['db']['password']);
if (!$conn)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($dbname,$conn);

$chaxun = mysql_query("SELECT state FROM ssc_order WHERE order_number = '".$_TransID."'");
$jiancha = mysql_result($chaxun,0);
$chaxun2 = mysql_query("select actionIP from ssc_member_recharge where rechargeid= '".$_TransID."'");
$actionIP = mysql_result($chaxun2,0);
$chaxun3 = mysql_query("select id from ssc_member_recharge where rechargeid= '".$_TransID."'");
$id = mysql_result($chaxun3,0);
$chaxun4 = mysql_query("select uid from ssc_member_recharge where rechargeid= '".$_TransID."'");
$uid = mysql_result($chaxun4,0);
$chaxun5 = mysql_query("select coin from ssc_members where uid= '".$uid."'");
$coin = mysql_result($chaxun5,0);
$chaxun6 = mysql_query("select value from ssc_params where name='czzs'");
$czzs = mysql_result($chaxun6,0);
if($czzs){
	$_factMoney=$_factMoney*(1+number_format($czzs/100,2,'.',''));
}
$inserts = "insert into ssc_coin_log (uid,type,playedId,coin,userCoin,fcoin,liqType,actionUID,actionTime,actionIP,info,extfield0,extfield1) values ('".$uid."',0,0,'".$_factMoney."','".$coin."'+'".$_factMoney."',0,1,0,UNIX_TIMESTAMP(),'".$actionIP."','baofoo','".$id."','".$uid."')";
$update1 = "UPDATE ssc_order SET state = 2 WHERE order_number = '".$_TransID."'";
$update2 = "UPDATE ssc_members SET coin = coin+'".$_factMoney."' WHERE username = '".$_additionalInfo."'";
$update3 = "update ssc_member_recharge set state=2,rechargeTime=UNIX_TIMESTAMP(),rechargeAmount='".$_factMoney."',coin='".$coin."', info='baofoo' where rechargeid='".$_TransID."'";

if($jiancha==0){
                if(mysql_query($update1,$conn)){
                mysql_query($update2,$conn);
                mysql_query($update3,$conn);
                mysql_query($inserts,$conn);
                echo "您已成功充值，请重新登陆平台界面查看,谢谢!";
				}else{
					echo "数据投递出错";
				}
    }else {
        echo "您已充值，请勿反复刷新,谢谢!";
  }
}else{
	echo "交易信息被篡改";
	exit;
     }
mysql_close($conn);
?>

</head>

<body>
<form id="form1">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td height="30" align="center">
				<h1>
					※ 宝付在线支付完成 ※
				</h1>
			</td>
		</tr>
	</table>
	<table bordercolor="#cccccc" cellspacing="5" cellpadding="0" width="400" align="center"
		border="0">		
		<tr>
			<td class="text_12" bordercolor="#ffffff" align="right" width="150" height="20">
				订单号：</td>
			<td class="text_12" bordercolor="#ffffff" align="left">
			<input  name='_TransID' value= "<?php echo $_TransID;?>" />
				</td>
		</tr>
		<tr>
			<td class="text_12" bordercolor="#ffffff" align="right" width="150" height="20">
				实际成功金额：</td>
			<td class="text_12" bordercolor="#ffffff" align="left">
			<input  name='_factMoney'  value= "<?php echo $_factMoney;?>"/>
				</td>
		</tr>		
		<tr>
			<td class="text_12" bordercolor="#ffffff" align="right" width="150" height="20">
				交易成功时间：</td>
			<td class="text_12" bordercolor="#ffffff" align="left">
			<input  name='_SuccTime' value= "<?php echo $_SuccTime;?>"/>
				</td>
		</tr>		
	</table> 

</form>
</body>
</html>
