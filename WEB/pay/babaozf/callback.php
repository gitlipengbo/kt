<?php
header("Content-type: text/html; charset=utf-8");
require("info.php");
		$orderid=$_GET['orderid'];//商户订单号
		$opstate=$_GET['opstate']; //0表示支付成功
		$ovalue=$_GET['ovalue'];//订单金额
		$sysorderid=$_GET['sysorderid'];//八宝订单号
		$systime=$_GET['systime'];//八宝处理完时间
		$attach=$_GET['attach'];//备注消息
		$sign=$_GET['sign'];//加密密文
		
		//准备加密字符串
		$signStr="orderid={$orderid}&opstate={$opstate}&ovalue={$ovalue}$key";
		//加密
		$mysign=md5($signStr);
		if($mysign==$sign){
			
				if($opstate==0){
					//支付成功，请处理订单
					echo "opstate=0";
	include '../../config.php';
	$conn = mysql_connect('localhost',$conf['db']['user'],$conf['db']['password']);
if (!$conn)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db('kt1',$conn);
mysql_query("SET NAMES UTF8");
//r6_Order 订单id
$r6_Order=$orderid;
//r3_Amt 订单金额
$r3_Amt=$ovalue;
//数据库前缀

$chaxun = mysql_query("SELECT state from ssc_member_recharge where rechargeId='{$r6_Order}'");
$jiancha = mysql_result($chaxun,0);
$chaxun2 = mysql_query("select actionIP from ssc_member_recharge where rechargeid= '".$r6_Order."'");
$actionIP = mysql_result($chaxun2,0);
$chaxun3 = mysql_query("select id from ssc_member_recharge where rechargeid= '".$r6_Order."'");
$id = mysql_result($chaxun3,0);
$chaxun4 = mysql_query("select uid from ssc_member_recharge where rechargeid= '".$r6_Order."'");
$uid = mysql_result($chaxun4,0);
$chaxun5 = mysql_query("select coin from ssc_members where uid= '".$uid."'");
$coin = mysql_result($chaxun5,0);
$chaxun6 = mysql_query("select value from ssc_params where name='czzs'");
$czzs = mysql_result($chaxun6,0);
if($czzs){
	$r3_Amt=$r3_Amt*(1+number_format($czzs/100,2,'.',''));
}
$inserts = "insert into ssc_coin_log (uid,type,playedId,coin,userCoin,fcoin,liqType,actionUID,actionTime,actionIP,info,extfield0,extfield1) values ('".$uid."',0,0,'".$r3_Amt."','".$coin."'+'".$r3_Amt."',0,1,0,UNIX_TIMESTAMP(),'".$actionIP."','在线支付自动到账','".$id."','".$uid."')";
$update2 = "UPDATE ssc_members SET coin = coin+'".$r3_Amt."' WHERE uid={$uid}";
$update3 = "update ssc_member_recharge set state=2,rechargeTime=UNIX_TIMESTAMP(),rechargeAmount='".$r3_Amt."',coin='".$coin."', info='在线支付自动到账' where rechargeid='".$r6_Order."'";

if($jiancha==0){
               
                mysql_query($update2,$conn);
                mysql_query($update3,$conn);
                mysql_query($inserts,$conn);
				echo 'success';
                echo "您已成功充值，请重新登陆平台界面查看,谢谢!";
	   
}else{
    echo "您已充值，请勿反复刷新,谢谢!";
	exit;
}
mysql_close($conn);




					
				}else if($opstate==-1){
					echo "请求参数无效";
					
				}else if($opstate==-2){
					echo "签名错误";
				}
				exit;
			
		}else{
			echo "交易数据被串改";
		}
?>
