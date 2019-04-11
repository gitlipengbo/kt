<?php
include_once("inc.php");
include '../config.php';

$P_UserId=$UserId;
$P_CardId="";
$P_CardPass="";
$P_FaceValue=$_REQUEST["FaceValue"].".00";
$P_ChannelId=1;
$P_Subject="用户充值";  
$P_Price=$_REQUEST["FaceValue"].".00";
$P_Quantity=1;
$P_Description=time();
//$e_paytype =  trim($_POST['paytype']);   
$P_Notic=$_REQUEST["Notic"];
$P_Result_url=$result_url;
$P_Notify_url=$notify_url;

$P_OrderId=intval($_REQUEST["OrderId"]);
$preEncodeStr=$P_UserId."|".$P_OrderId."|".$P_CardId."|".$P_CardPass."|".$P_FaceValue."|".$P_ChannelId."|".$SalfStr;

$P_PostKey=md5($preEncodeStr);

$params="P_UserId=".$P_UserId;
$params.="&P_OrderId=".$P_OrderId;
$params.="&P_CardId=".$P_CardId;
$params.="&P_CardPass=".$P_CardPass;
$params.="&P_FaceValue=".$P_FaceValue;
$params.="&P_ChannelId=".$P_ChannelId;
$params.="&P_Subject=".$P_Subject;
$params.="&P_Price=".$P_Price;
$params.="&P_Quantity=".$P_Quantity;
$params.="&P_Description=".$P_Description;
$params.="&P_Notic=".$P_Notic;
$params.="&P_Result_url=".$P_Result_url;
$params.="&P_Notify_url=".$P_Notify_url;
$params.="&P_PostKey=".$P_PostKey;

//在这里对订单进行入库保存

$time = date("Y-m-d H:i:s",time()+28800-date("Z",time()));

$conn = mysql_connect($dbhost,$conf['db']['user'],$conf['db']['password']);
if (!$conn)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($dbname,$conn);

$P_Notic = mysql_escape_string($P_Notic);

$info = "INSERT INTO ssc_order(order_number, username, recharge_amount, state, time)
VALUES('".$OrderId."', '".$Notic."', '".$FaceValue."', '0', '".$time."')";

mysql_query($info);

mysql_close($conn);

//下面这句是提交到API
header("location:$gateWary?$params");

?>