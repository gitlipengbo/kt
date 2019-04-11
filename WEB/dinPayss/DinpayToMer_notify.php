<? header("content-Type: text/html; charset=GBK");?>
<?php
include '../config.php';
	$merchant_code	= $_POST["merchant_code"];
	$notify_type = $_POST["notify_type"];
	$notify_id = $_POST["notify_id"];
	$interface_version = $_POST["interface_version"];
	$sign_type = $_POST["sign_type"];
	$dinpaySign = $_POST["sign"];
	$order_no = $_POST["order_no"];
	$order_time = $_POST["order_time"];
	$order_amount = $_POST["order_amount"];
	$extra_return_param = $_POST["extra_return_param"];
	$trade_no = $_POST["trade_no"];
	$trade_time = $_POST["trade_time"];
	$trade_status = $_POST["trade_status"];
	$bank_seq_no = $_POST["bank_seq_no"];
	$signStr = "";
	if($bank_seq_no != "") {
		$signStr = $signStr."bank_seq_no=".$bank_seq_no."&";
	}
	if($extra_return_param != "") {
	    $signStr = $signStr."extra_return_param=".$extra_return_param."&";
	}
	$signStr = $signStr."interface_version=V3.0&";
	$signStr = $signStr."merchant_code=".$merchant_code."&";
	if($notify_id != "") {
	    $signStr = $signStr."notify_id=".$notify_id."&notify_type=".$notify_type."&";
	}
        $signStr = $signStr."order_amount=".$order_amount."&";
        $signStr = $signStr."order_no=".$order_no."&";
        $signStr = $signStr."order_time=".$order_time."&";
        $signStr = $signStr."trade_no=".$trade_no."&";
        $signStr = $signStr."trade_status=".$trade_status."&";

	if($trade_time != "") {
	     $signStr = $signStr."trade_time=".$trade_time."&";
	}
	$key="uuu9_syds_gd78_hs64j";
	$signStr = $signStr."key=".$key;
	$signInfo = $signStr;
	$sign = md5($signInfo);

if($dinpaySign==$sign) {
$conn = mysql_connect($dbhost,$conf['db']['user'],$conf['db']['password']);
if (!$conn)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($dbname,$conn);

$chaxun = mysql_query("SELECT state FROM ssc_order WHERE order_number = '".$order_no."'");
$jiancha = mysql_result($chaxun,0);
$chaxun2 = mysql_query("select actionIP from ssc_member_recharge where rechargeid= '".$order_no."'");
$actionIP = mysql_result($chaxun2,0);
$chaxun3 = mysql_query("select id from ssc_member_recharge where rechargeid= '".$order_no."'");
$id = mysql_result($chaxun3,0);
$chaxun4 = mysql_query("select uid from ssc_member_recharge where rechargeid= '".$order_no."'");
$uid = mysql_result($chaxun4,0);
$chaxun5 = mysql_query("select coin from ssc_members where uid= '".$uid."'");
$coin = mysql_result($chaxun5,0);
$chaxun6 = mysql_query("select value from ssc_params where name='czzs'");
$czzs = mysql_result($chaxun6,0);
if($czzs){
	$order_amount=$order_amount*(1+number_format($czzs/100,2,'.',''));
}
$inserts = "insert into ssc_coin_log (uid,type,playedId,coin,userCoin,fcoin,liqType,actionUID,actionTime,actionIP,info,extfield0,extfield1) values ('".$uid."',0,0,'".$order_amount."','".$coin."'+'".$order_amount."',0,1,0,UNIX_TIMESTAMP(),'".$actionIP."','OK','".$id."','".$uid."')";
$update1 = "UPDATE ssc_order SET state = 2 WHERE order_number = '".$order_no."'";
$update2 = "UPDATE ssc_members SET coin = coin+'".$order_amount."' WHERE username = '".$extra_return_param."'";
$update3 = "UPDATE ssc_member_recharge SET state = 2, rechargeAmount = '".$order_amount."',rechargeTime=UNIX_TIMESTAMP(),coin='".$coin."', info='OK' WHERE rechargeId = '".$order_no."'";

if($jiancha==0){
	   if($trade_status=="SUCCESS"){
                if(mysql_query($update1,$conn)){
                mysql_query($update2,$conn);
                mysql_query($update3,$conn);
		        mysql_query($inserts,$conn);
                echo "您已成功充值，请重新登陆平台界面查看,谢谢!";
				}
	    }else{
	       echo "失败，信息可能被篡改";
        }
}else{
    echo "您已充值，请勿反复刷新,谢谢!";
}
mysql_close($conn);
		echo "SUCCESS";
		exit;
	}else
        {
		echo "交易被非法篡改";
		exit;
	}

?>
