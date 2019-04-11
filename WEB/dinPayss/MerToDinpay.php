<? header("content-Type: text/html; charset=GBK");?>
<?php
		$input_charset = "GBK";
		$interface_version = "V3.0";
		$merchant_code = "1111130804";
		$notify_url = "http://42.51.153.185/dinpayss/DinpayToMer_notify.php";
		$order_amount = $_POST['order_amount'];
		$order_no = $_POST['order_no'];
		$order_time = $_POST['order_time'];
		$sign_type = "MD5";
		$product_code = "";
		$product_desc = "";
		$product_name = "用户充值";
		$product_num = "";
		$return_url = "";
		$service_type = "direct_pay";
		$show_url = "";
		$extend_param = "";
		$extra_return_param = $_POST['extra_return_param'];
		$bank_code = "";
		$client_ip = "";
	if($product_name != "") {
	  $product_name = mb_convert_encoding($product_name, "GBK", "GBK");
	}
	if($product_desc != "") {
	  $product_desc = mb_convert_encoding($product_desc, "GBK", "GBK");
	}
	if($extend_param != "") {
	  $extend_param = mb_convert_encoding($extend_param, "GBK", "GBK");
	}
	if($extra_return_param != "") {
	  $extra_return_param = mb_convert_encoding($extra_return_param, "GBK", "GBK");
	}
	if($product_code != "") {
	  $product_code = mb_convert_encoding($product_code, "GBK", "GBK");
	}
	if($return_url != "") {
	  $return_url = mb_convert_encoding($return_url, "GBK", "GBK");
	}
	if($show_url != "") {
	  $show_url = mb_convert_encoding($show_url, "GBK", "GBK");
	}
	$signSrc= "";
	if($bank_code != "") {
		$signSrc = $signSrc."bank_code=".$bank_code."&";
	}
	if($client_ip != "") {
                $signSrc = $signSrc."client_ip=".$client_ip."&";
	}
	if($extend_param != "") {
		$signSrc = $signSrc."extend_param=".$extend_param."&";
	}
	if($extra_return_param != "") {
		$signSrc = $signSrc."extra_return_param=".$extra_return_param."&";
	}
	if($input_charset != "") {
		$signSrc = $signSrc."input_charset=".$input_charset."&";
	}
	if($interface_version != "") {
		$signSrc = $signSrc."interface_version=".$interface_version."&";
	}
	if($merchant_code != "") {
		$signSrc = $signSrc."merchant_code=".$merchant_code."&";
	}
	if($notify_url != "") {
		$signSrc = $signSrc."notify_url=".$notify_url."&";
	}
	if($order_amount != "") {
		$signSrc = $signSrc."order_amount=".$order_amount."&";
	}
	if($order_no != "") {
		$signSrc = $signSrc."order_no=".$order_no."&";
	}
	if($order_time != "") {
		$signSrc = $signSrc."order_time=".$order_time."&";
	}
	if($product_code != "") {
		$signSrc = $signSrc."product_code=".$product_code."&";
	}
	if($product_desc != "") {
		$signSrc = $signSrc."product_desc=".$product_desc."&";
	}
	if($product_name != "") {
		$signSrc = $signSrc."product_name=".$product_name."&";
	}
	if($product_num != "") {
		$signSrc = $signSrc."product_num=".$product_num."&";
	}
	if($return_url != "") {
		$signSrc = $signSrc."return_url=".$return_url."&";
	}
	if($service_type != "") {
		$signSrc = $signSrc."service_type=".$service_type."&";
	}
	if($show_url != "") {
		$signSrc = $signSrc."show_url=".$show_url."&";
	}
	$key = "uuu9_syds_gd78_hs64j";
	$signSrc = $signSrc."key=".$key;
	$singInfo = $signSrc;
	$sign = md5($singInfo);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK">
</head>
<body onLoad="document.dinpayForm.submit();">
正在跳转 ...
<form name="dinpayForm" method="post" action="https://pay.dinpay.com/gateway?input_charset=GBK">
	<input type="hidden" name="sign" value="<? echo $sign?>" />
	<input type="hidden" name="merchant_code" value="<? echo $merchant_code?>" />
	<input type="hidden" name="bank_code" value="<? echo $bank_code?>"/>
	<input type="hidden" name="order_no" value="<? echo $order_no?>"/>
	<input type="hidden" name="order_amount" value="<? echo $order_amount?>"/>
	<input type="hidden" name="service_type" value="<? echo $service_type?>"/>
	<input type="hidden" name="input_charset" value="<? echo $input_charset?>"/>
	<input type="hidden" name="notify_url" value="<? echo $notify_url?>">
	<input type="hidden" name="interface_version" value="<? echo $interface_version?>"/>
	<input type="hidden" name="sign_type" value="<? echo $sign_type?>"/>
	<input type="hidden" name="order_time" value="<? echo $order_time?>"/>
	<input type="hidden" name="product_name" value="<? echo $product_name?>"/>
	<input Type="hidden" Name="client_ip" value="<? echo $client_ip?>"/>
	<input Type="hidden" Name="extend_param" value="<? echo $extend_param?>"/>
	<input Type="hidden" Name="extra_return_param" value="<? echo $extra_return_param?>"/>
	<input Type="hidden" Name="product_code" value="<? echo $product_code?>"/>
	<input Type="hidden" Name="product_desc" value="<? echo $product_desc?>"/>
	<input Type="hidden" Name="product_num" value="<? echo $product_num?>"/>
	<input Type="hidden" Name="return_url" value="<? echo $return_url?>"/>
	<input Type="hidden" Name="show_url" value="<? echo $show_url?>"/>
	</form>
</body>
</html>