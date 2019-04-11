<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转中...</title>
<?php
include '../config.php';

$conn = mysql_connect($dbhost,$conf['db']['user'],$conf['db']['password']);
if (!$conn)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($dbname,$conn);

$_MerchantID=125787;//商户号
$_Md5Key="kmu26ukyye9p78ep";//密钥

$_Amount=1;//数量
$_TransID=intval($_POST['_TransID']);//订单号
$_OrderMoney=get_str($_POST['_OrderMoney']*100);//订单金额，精确到分
$_AdditionalInfo=get_str($_POST['_AdditionalInfo']);//订单附加消息，用户名

$_NoticeType=1;//通知方式，1为页面重定向+服务器点对点混合通知，0为点对点通讯
$_PayID=1000;//支付方式，1000为网银

$_TradeDate=date("YmdHis",time()+28800-date("Z",time()));//交易时间

$_Merchant_url="http://42.51.153.185/baofooss/merchant_url.php";//商户通知地址 
$_Return_url="http://42.51.153.185/baofooss/return_url.php";//用户通知地址

$_ProductName="";//产品名称
$_ProductLogo="";//产品logo
$_Username="";//支付用户名
$_Email="";
$_Mobile="";
$_Md5Sign=md5($_MerchantID.$_PayID.$_TradeDate.$_TransID.$_OrderMoney.$_Merchant_url.$_Return_url.$_NoticeType.$_Md5Key);
//此处加入判断，如果前面出错了跳转到其他地方而不要进行提交

$info = "INSERT INTO ssc_order(order_number, username, recharge_amount, state, time)
VALUES('".$_TransID."', '".$_AdditionalInfo."', '".$_OrderMoney."', '0', '".$time."')";

mysql_query($info);

mysql_close($conn);

?>
</head>

<body onload="document.form1.submit()">
<form id="form1" name="form1" method="post" action="https://paygate.baofoo.com/PayReceive/payindex.aspx">   <!--此处修改正式地址或测试地址-->
        <input type='hidden' name='MerchantID' value="<?php echo $_MerchantID; ?>" />
        <input type='hidden' name='PayID' value="<?php echo $_PayID; ?>" />
        <input type='hidden' name='TradeDate' value="<?php echo $_TradeDate; ?>" />
        <input type='hidden' name='TransID' value="<?php echo $_TransID; ?>" />
        <input type='hidden' name='OrderMoney' value="<?php echo $_OrderMoney; ?>" />
        <input type='hidden' name='ProductName' value="<?php echo $_ProductName; ?>" />
        <input type='hidden' name='Amount' value="<?php echo $_Amount; ?>" />
        <input type='hidden' name='ProductLogo' value="<?php echo $_ProductLogo; ?>" />
        <input type='hidden' name='Username' value="<?php echo $_Username; ?>" />
        <input type='hidden' name='Email' value="<?php echo $_Email; ?>" />
        <input type='hidden' name='Mobile' value="<?php echo $_Mobile; ?>" />
        <input type='hidden' name='AdditionalInfo' value="<?php echo $_AdditionalInfo; ?>" />
        <input type='hidden' name='Merchant_url' value="<?php echo $_Merchant_url; ?>" />
        <input type='hidden' name='Return_url' value="<?php echo $_Return_url; ?>" />
        <input type='hidden' name='NoticeType' value="<?php echo $_NoticeType; ?>" />
        <input type='hidden' name='Md5Sign' value="<?php echo $_Md5Sign; ?>" />
</form>
</body>
</html>
