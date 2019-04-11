<?php
header("Content-type:text/html; charset=GB2312");
include '../config.php'; 

$billno = $_GET['billno'];
$amount = $_GET['amount'];
$mydate = $_GET['date'];
$succ = $_GET['succ'];
$msg = $_GET['msg'];
$attach = $_GET['attach'];
$ipsbillno = $_GET['ipsbillno'];
$retEncodeType = $_GET['retencodetype'];
$currency_type = $_GET['Currency_type'];
$signature = $_GET['signature'];

$content = 'billno'.$billno.'currencytype'.$currency_type.'amount'.$amount.'date'.$mydate.'succ'.$succ.'ipsbillno'.$ipsbillno.'retencodetype'.$retEncodeType;
$cert = 'VZ5ovT3gESegmj0BEp2tBy4ua0A0oDwcUV8RsEJKun3H407PZEqJr5nXVACuJ2s1V1BGZYKzVhzPumqZslQYNdmOhavg2O0ru1n3prp0vqn85NckKc1XbJdsEoYzddx7';//正式
//$cert = 'GDgLwwdK270Qj1w4xho8lyTpRQZV9Jm5x4NwWOTThUa4fMhEBK9jOXFrKRT6xhlJuU2FEa89ov0ryyjfJuuPkcGzO5CeVx5ZIrkkt1aBlZV36ySvHOMcNv8rncRiy3DQ';//测试
$signature_1ocal = md5($content . $cert);

if ($signature_1ocal == $signature){
$conn = mysql_connect($dbhost,$conf['db']['user'],$conf['db']['password']);
if (!$conn)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($dbname,$conn);

//$chaxun = mysql_query("SELECT state FROM ssc_member_recharge WHERE order_number = '".$billno."'");
$chaxun2 = mysql_query("select id,actionIP,uid,state from ssc_member_recharge where rechargeid= '".$billno."'");
$info=mysql_fetch_row($chaxun2); 
$actionIP =$info[1];
$id =$info[0];
$uid =$info[2];
$jiancha=$info[3];

$chaxun7 = mysql_query("select parentId,coin from ssc_members where uid= ".$uid);
$uinfo=mysql_fetch_row($chaxun7); 
$coin = $uinfo[1];

if ($uinfo[0] == "")
	{
	$suid=0;
    $ssuid=0;
    }
else
	{
    $suid = $uinfo[0];

    $chaxun8 = mysql_query("select parentId,username,coin from ssc_members where uid= ".$suid);
    $sinfo=mysql_fetch_row($chaxun8); 
	$sname=$sinfo[1];
    $scoin=$sinfo[2];
     if ($sinfo[0] == "")
	     {
          $ssuid=0;
         }
     else
	     {
          $ssuid=$sinfo[0];
		  $chaxun25 = mysql_query("select coin from ssc_members where uid= '".$ssuid."'");
          $sscoin = mysql_result($chaxun25,0);
          }

    }

$chaxun9 = mysql_query("select value from ssc_params where name='rechargeCommissionAmount'");
$czxz = mysql_result($chaxun9,0);

$chaxun10 = mysql_query("select value from ssc_params where name='rechargeCommission'");
$syj = mysql_result($chaxun10,0);

$chaxun11 = mysql_query("select value from ssc_params where name='rechargeCommission2'");
$ssyj = mysql_result($chaxun11,0);

$a=strtotime('00:00');
$sql="select id from ssc_member_recharge where rechargeTime >= ".$a." and uid = ".$uid." limit 1";
$chaxun12=mysql_query($sql);
//$sfsc = mysql_fetch_array($chaxun12); 
$sfsc = mysql_result($chaxun12,0);; 

$chaxun6 = mysql_query("select value from ssc_params where name='czzs'");
$czzs = mysql_result($chaxun6,0);
if($czzs){
	$amountall=$amount*(1+number_format($czzs/100,2,'.',''));
	$amountzs=$amount*(number_format($czzs/100,2,'.',''));
    }
else
	{
$amountall=$amount;
$amountzs=0;
	}
$inserts = "insert into ssc_coin_log (uid,type,playedId,coin,userCoin,fcoin,liqType,actionUID,actionTime,actionIP,info,extfield0,extfield1) values ('".$uid."',0,0,'".$amount."','".$coin."'+'".$amount."',0,1,0,UNIX_TIMESTAMP(),'".$actionIP."','环讯充值自动到账','".$id."','".$billno."')";

$insertszs = "insert into ssc_coin_log (uid,type,playedId,coin,userCoin,fcoin,liqType,actionUID,actionTime,actionIP,info,extfield0,extfield1) values ('".$uid."',0,0,'".$amountzs."','".$coin."'+'".$amountzs."',0,52,0,UNIX_TIMESTAMP(),'".$actionIP."','系统赠送','".$id."','".$billno."')";

$insertssj = "insert into ssc_coin_log (uid,type,playedId,coin,userCoin,fcoin,liqType,actionUID,actionTime,actionIP,info,extfield0,extfield1) values ('".$suid."',0,0,'".$syj."','".$scoin."'+'".$syj."',0,52,0,UNIX_TIMESTAMP(),'".$actionIP."','下级[".$attach."]充值佣金','".$id."','".$billno."')";

$insertsssj = "insert into ssc_coin_log (uid,type,playedId,coin,userCoin,fcoin,liqType,actionUID,actionTime,actionIP,info,extfield0,extfield1) values ('".$ssuid."',0,0,'".$ssyj."','".$sscoin."'+'".$ssyj."',0,52,0,UNIX_TIMESTAMP(),'".$actionIP."','下级[".$attach."<=".$sname."]充值佣金','".$id."','".$billno."')";

$update1 = "UPDATE ssc_order SET state = 2 WHERE order_number = '".$billno."'";
$update2 = "UPDATE ssc_members SET coin = coin+'".$amountall."' WHERE username = '".$attach."'";
$update3 = "update ssc_member_recharge set state=2,rechargeTime=UNIX_TIMESTAMP(),rechargeAmount='".$amount."',coin='".$coin."',info='环讯充值自动到账' where rechargeid='".$billno."'";
$update4 = "UPDATE ssc_members SET coin = coin+'".$syj."' WHERE uid = ".$suid;
$update5 = "UPDATE ssc_members SET coin = coin+'".$ssyj."' WHERE uid = ".$ssuid;
//$jiancha = mysql_result($chaxun,0);

if($jiancha==0){
	if ($succ == 'Y')
	{
                if(mysql_query($update1,$conn)){
                mysql_query($update2,$conn);
                mysql_query($update3,$conn);
                mysql_query($inserts,$conn);
                                               if($sfsc==""){
				                                                 if($czzs){
				                                                          mysql_query($insertszs,$conn);
				                                                           }
                                                                 if($amount >=$czxz)
	                                                                       {
                                                                             if($suid>0)
					                                                                    {
                                                                                          mysql_query($insertssj,$conn);
                                                                                           mysql_query($update4,$conn);
					                                                                      }
					                                                          if($ssuid>0)
					                                                                     {
                                                                                          mysql_query($insertsssj,$conn);
                                                                                           mysql_query($update5,$conn);
					                                                                        }
				                                                                }
											   }
											   echo "<script> alert('您已成功充值，请重新登陆平台界面查看,谢谢!');window.opener=null;window.close(); </script>"; 

               
				}else{
					echo "数据投递出错";
				}
	    }else{
	       echo "交易失败";
             }
}else{
    echo "<script> alert('您已充值，请勿反复刷新,谢谢!');window.opener=null;window.close(); </script>";
}
}else{
	echo '签名不正确！';
	exit;
     }
mysql_close($conn);
?>
