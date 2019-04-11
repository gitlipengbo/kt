<?php
header("Content-type: text/html; charset=utf-8");
require("info.php");

//$type = $_POST['issuerId'];
$type=$_POST['issuerId'];
$value = $_POST['p3_Amt'];
$orderid = $_POST['p2_Order'];
$payerIp="127.0.0.1";
$attach="±¸×¢ÏûÏ¢";
$md5String="parter={$parter}&type={$type}&value={$value}&orderid={$orderid}&callbackurl={$callbackurl}$key";
$sign=md5($md5String);
//http_redirect($gatewayUrl);
?>
<!DOCTYPE html>
<html>
<head>
    <title>gotopay</title>
</head>
<body>
    <form action="<?=$submit_url?>" method="get" >
        <input type="hidden" name="parter" value="<?=$parter?>"/>
		<input type="hidden" name="type" value="<?=$type?>"/>
		<input type="hidden" name="value" value="<?=$value?>"/>
		<input type="hidden" name="orderid" value="<?=$orderid?>"/>
		<input type="hidden" name="callbackurl" value="<?=$callbackurl?>"/>
		<input type="hidden" name="hrefbackurl" value="<?=$hrefbackurl?>"/>
		<input type="hidden" name="payerIp" value="<?=$payerIp?>"/>
		<input type="hidden" name="sign" value="<?=$sign?>"/>
    </form>
    <script type="text/javascript">
        document.forms[0].submit();
    </script>
</body>
</html>