<?
include '../config.php';
include_once("inc.php");

$UserId=$_REQUEST["P_UserId"];
$OrderId=$_REQUEST["P_OrderId"];
$CardId=$_REQUEST["P_CardId"];
$CardPass=$_REQUEST["P_CardPass"];
$FaceValue=$_REQUEST["P_FaceValue"];
$ChannelId=$_REQUEST["P_ChannelId"];

$subject=$_REQUEST["P_Subject"];
$description=$_REQUEST["P_Description"]; 
$price=$_REQUEST["P_Price"];
$quantity=$_REQUEST["P_Quantity"];
$notic=$_REQUEST["P_Notic"];
$ErrCode=$_REQUEST["P_ErrCode"];
$PostKey=$_REQUEST["P_PostKey"];
$FaceValue=$_REQUEST["P_PayMoney"];

$preEncodeStr=$UserId."|".$OrderId."|".$CardId."|".$CardPass."|".$FaceValue."|".$ChannelId."|".$SalfStr;

$encodeStr=md5($preEncodeStr);

if($PostKey==$encodeStr){
        if($ErrCode=="0"){
		echo "errCode=0";
$conn = mysql_connect($dbhost,$conf['db']['user'],$conf['db']['password']);
if (!$conn)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($dbname,$conn);

$chaxun = mysql_query("SELECT state FROM ssc_order WHERE order_number = '".$OrderId."'");
$jiancha = mysql_result($chaxun,0);
$chaxun2 = mysql_query("select actionIP from ssc_member_recharge where rechargeid= '".$OrderId."'");
$actionIP = mysql_result($chaxun2,0);
$chaxun3 = mysql_query("select id from ssc_member_recharge where rechargeid= '".$OrderId."'");
$id = mysql_result($chaxun3,0);
$chaxun4 = mysql_query("select uid from ssc_member_recharge where rechargeid= '".$OrderId."'");
$uid = mysql_result($chaxun4,0);
$chaxun5 = mysql_query("select coin from ssc_members where uid= '".$uid."'");
$coin = mysql_result($chaxun5,0);
$chaxun6 = mysql_query("select value from ssc_params where name='czzs'");
$czzs = mysql_result($chaxun6,0);
if($czzs){
	$FaceValue=$FaceValue*(1+number_format($czzs/100,2,'.',''));
}
$inserts = "insert into ssc_coin_log (uid,type,playedId,coin,userCoin,fcoin,liqType,actionUID,actionTime,actionIP,info,extfield0,extfield1) values ('".$uid."',0,0,'".$FaceValue."','".$coin."'+'".$FaceValue."',0,1,0,UNIX_TIMESTAMP(),'".$actionIP."','OK','".$id."','".$uid."')";
$update1 = "UPDATE ssc_order SET state = 2 WHERE order_number = '".$OrderId."'";
$update2 = "UPDATE ssc_members SET coin = coin+'".$FaceValue."' WHERE username = '".$notic."'";
$update3 = "update ssc_member_recharge set state=2,rechargeTime=UNIX_TIMESTAMP(),rechargeAmount='".$FaceValue."',coin='".$coin."', info='OK' where rechargeid='".$OrderId."'";

if($jiancha==0){
                mysql_query($update1,$conn);
                mysql_query($update2,$conn);
                mysql_query($update3,$conn);
                mysql_query($inserts,$conn);
                echo "您已成功充值，请重新登陆平台界面查看,谢谢!";
}else{
    echo "您已充值，请勿反复刷新,谢谢!";
}
	}else{
		//支付失败
		echo "交易失败";
      }
   }else{
	echo "数据被被篡改，校验失败";
  }
mysql_close($conn);
?>