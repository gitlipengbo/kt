<?php
include("xy.php");
$now = date('Y-m-d H:i:s');
$src =  "$ur" .'xj.php';
//防止GET本地缓存，增加随机数
$src .= (strpos($src,'?')>0 ? '&':'?').'_='.time();
$html = file_get_contents($src);
$xml = json_decode(json_encode(simplexml_load_string($html)),true);
if (isset($xml['@attributes']['rows'])){
	foreach($xml['row'] as $r){
	}
}else{	
	echo $html;
}
/////////////////////////////////////////////////////////////////////////////
?>
