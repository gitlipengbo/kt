<?php
@session_start();
class Cash extends WebLoginBase{
	public $pageSize=20;
	private $vcodeSessionName='ssc_vcode_session_name';

	public final function toCash(){
		$this->display('cash/to-cash.php');
	}
	
	public final function toCashLog(){
		$this->display('cash/to-cash-log.php');
	}
	
	public final function toCashResult(){
		$this->display('cash/cash-result.php');
	}
	
	public final function recharge(){
		$this->display('cash/recharge.php');
	}
	
	public final function rechargeLog(){
		$this->display('cash/recharge-log.php');
	}
	
	/**
	 * 提现申请
	 */
	public final function ajaxToCash(){
		$urlshang = $_SERVER['HTTP_REFERER']; //上一页URL
		$urldan = $_SERVER['SERVER_NAME']; //本站域名
		$urlcheck=substr($urlshang,7,strlen($urldan));
		if($urlcheck<>$urldan)  throw new Exception('数据被篡改，请重新操作');
		if(!$_POST) throw new Exception('参数出错');

		$para['amount']=$_POST['amount'];
		$para['coinpwd']=$_POST['coinpwd'];
		$bank=$this->getRow("select username,account,bankId from {$this->prename}member_bank where uid=? limit 1",$this->user['uid']);
		$para['username']=$bank['username'];
		$para['account']=$bank['account'];
		$para['bankId']=$bank['bankId'];
		if($para['amount']<=0) throw new Exception("提现金额只能为正整数");
        if(!ctype_digit($para['amount'])) throw new Exception('提现金额包含非法字符');
		
		//提示时间检查
		$baseTime=strtotime(date('Y-m-d',$this->time).'06:00');
		$fromTime=strtotime(date('Y-m-d',$this->time).$this->settings['cashFromTime'].':00');
		$toTime=strtotime(date('Y-m-d',$this->time).$this->settings['cashToTime'].':00');
		if($toTime<$baseTime) $toTime.=24*3600;
		if($this->time < $fromTime || $this->time > $toTime ) throw new Exception("提现时间：从".$this->settings['cashFromTime']."到".$this->settings['cashToTime']);

		//消费判断
		$cashAmout=0;
		$rechargeAmount=0;
		//$rechargeTime=strtotime('00:00')-2*24*3600;
		$rechargeTime=strtotime('00:00');
		if($this->settings['cashMinAmount']){
			$cashMinAmount=$this->settings['cashMinAmount']/100;
			$gRs=$this->getRow("select sum(case when rechargeAmount>0 then rechargeAmount else amount end) as rechargeAmount from {$this->prename}member_recharge where  uid={$this->user['uid']} and state in (1,2,9) and isDelete=0 and rechargeTime>=".$rechargeTime);
			if($gRs){
				$rechargeAmount=$gRs["rechargeAmount"]*$cashMinAmount;
			}
			if($rechargeAmount){
				//消费总额
				$cashAmout=$this->getValue("select sum(mode*beiShu*actionNum) from {$this->prename}bets where actionTime>={$rechargeTime} and uid={$this->user['uid']} and isDelete=0");
				if(floatval($cashAmout)<floatval($rechargeAmount)) throw new Exception("消费满".$this->settings['cashMinAmount']."%才能提现");
			}
		}//消费判断结束
		$this->beginTransaction();
		try{
			$this->freshSession();
			if($this->user['coinPassword']!=md5($para['coinpwd'])) throw new Exception('资金密码不正确');
			unset($para['coinpwd']);
			
			if($this->user['coin']<$para['amount']) throw new Exception('你帐户资金不足');
		
			// 查询最大提现次数与已经提现次数
			$time=strtotime(date('Y-m-d', $this->time));
			if($times=$this->getValue("select count(*) from {$this->prename}member_cash where actionTime>=$time and uid=?", $this->user['uid'])){
				$cashTimes=$this->getValue("select maxToCashCount from {$this->prename}member_level where level=?", $this->user['grade']);
				if($times>=$cashTimes) throw new Exception('对不起，今天你提现次数已达到最大限额，请明天再来');
			}
			
			// 插入提现请求表
			$para['actionTime']=$this->time;
			$para['uid']=$this->user['uid'];
			if(!$this->insertRow($this->prename .'member_cash', $para)) throw new Exception('提交提现请求出错');
			$id=$this->lastInsertId();
			
			// 流动资金
			$this->addCoin(array(
				'coin'=>0-$para['amount'],
				'fcoin'=>$para['amount'],
				'uid'=>$para['uid'],
				'liqType'=>106,
				'info'=>"提现[$id]资金冻结",
				'extfield0'=>$id
			));

			$this->commit();
			  return '申请提现成功，提现将在10分钟内到帐，如未到账请联系在线客服。';
		}catch(Exception $e){
			$this->rollBack();
			//return 9999;
			throw $e;
		}
	}
	
	/**
	 * 确认提现到帐
	 */
	public final function toCashSure($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		
		$this->beginTransaction();
		try{
			
			// 查找提现请求信息
			if(!$cash=$this->getRow("select * from {$this->prename}member_cash where id=$id"))
			throw new Exception('参数出错');
			
			if($cash['uid']!=$this->user['uid']) throw new Exception('您不能代别人确认');
			switch($cash['state']){
				case 0:
					throw new Exception('提现已经确认过了');
				break;
				case 1:
					throw new Exception("提现请求正在处理中...");
				break;
				case 2:
					throw new Exception("该提现请求已经取消，冻结资金已经解除冻结\r\n如需要提现请重新申请");
				break;
				case 3:
					
				break;
				case 4:
					throw new Exception("该提现请求已经失败，冻结资金已经解除冻结\r\n如需要提现请重新申请");
				break;
				default:
					throw new Exception('系统出错');
				break;
			}
			
			if($this->update("update {$this->prename}member_cash set state=0 where id=$id"))
			$this->addCoin(array(
				'liqType'=>12,
				'uid'=>$this->user['uid'],
				'info'=>"提现[$id]资金确认",
				'extfield0'=>$id
			));
			
		}catch(Exception $e){
			$this->rollBack();
			throw $e;
		}
	}
	/* 第三方支付返回 */	
public final function OrderReturn(){
		
		//----------------------------------------------------
//  接收数据
//  Receive the data
//----------------------------------------------------
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

//'----------------------------------------------------
//'   Md5摘要认证
//'   verify  md5
//'----------------------------------------------------

//RetEncodeType设置为17（MD5摘要数字签名方式）
//交易返回接口MD5摘要认证的明文信息如下：
//billno+【订单编号】+currencytype+【币种】+amount+【订单金额】+date+【订单日期】+succ+【成功标志】+ipsbillno+【IPS订单编号】+retencodetype +【交易返回签名方式】+【商户内部证书】
//例:(billno000001000123currencytypeRMBamount13.45date20031205succYipsbillnoNT2012082781196443retencodetype17GDgLwwdK270Qj1w4xho8lyTpRQZV9Jm5x4NwWOTThUa4fMhEBK9jOXFrKRT6xhlJuU2FEa89ov0ryyjfJuuPkcGzO5CeVx5ZIrkkt1aBlZV36ySvHOMcNv8rncRiy3DQ)

//返回参数的次序为：
//billno + mercode + amount + date + succ + msg + ipsbillno + Currecny_type + retencodetype + attach + signature + bankbillno
//注2：当RetEncodeType=17时，摘要内容已全转成小写字符，请在验证的时将您生成的Md5摘要先转成小写后再做比较
$content = 'billno'.$billno.'currencytype'.$currency_type.'amount'.$amount.'date'.$mydate.'succ'.$succ.'ipsbillno'.$ipsbillno.'retencodetype'.$retEncodeType;
//请在该字段中放置商户登陆merchant.ips.com.cn下载的证书
$cert = 'VZ5ovT3gESegmj0BEp2tBy4ua0A0oDwcUV8RsEJKun3H407PZEqJr5nXVACuJ2s1V1BGZYKzVhzPumqZslQYNdmOhavg2O0ru1n3prp0vqn85NckKc1XbJdsEoYzddx7';//正式
//$cert = "GDgLwwdK270Qj1w4xho8lyTpRQZV9Jm5x4NwWOTThUa4fMhEBK9jOXFrKRT6xhlJuU2FEa89ov0ryyjfJuuPkcGzO5CeVx5ZIrkkt1aBlZV36ySvHOMcNv8rncRiy3DQ";//测试
$signature_1ocal = md5($content . $cert);

if ($signature_1ocal == $signature)
{
	//----------------------------------------------------
	//  判断交易是否成功
	//  See the successful flag of this transaction
	//----------------------------------------------------

	if ($succ == 'Y')
	{
			$sql="select * from {$this->prename}member_recharge where rechargeid={$billno} and amount={$amount}";
		if($data=$this->getRow($sql)){
$para=array_merge(array('rechargeAmount'=>$amount, 'state'=>2, 'info'=>'自动充值', 'rechargeTime'=>$this->time), $this->getRow("select coin, fcoin from {$this->prename}members where uid={$data['uid']}"));
$this->updateRows($this->prename .'member_recharge', $para, 'rechargeid='. $billno);
if($this->updateRows($this->prename .'member_recharge', $para, 'rechargeid='. $billno)){
		
$this->addCoin(array(
					'uid'=>$data['uid'],
					'coin'=>$amount,
					'liqType'=>1,
					'extfield0'=>$data['id'],
					'extfield1'=>$data['rechargeId'],
					'info'=>'自动充值'
				));
}
}
else{
	echo '参数不正确！';
	exit;
	}
	
		//echo '交易成功';
		$this->display('cash/recharge-log.php');
	}
	else
	{
		$this->display('cash/recharge-log.php');
		exit;
	}
}
else
{
	echo '签名不正确！';
	exit;
}
		
		

	}
/* 重新充值 */
public final function repay($id){
	$sql="select * from {$this->prename}member_recharge where id=?";
		$data=$this->getRow($sql, $id);
$this->display('cash/rerecharge.php',0,$data);
}
	/* 进入充值，生产充值订单 */
	public final function inRecharge(){

		if(!$_POST) throw new Exception('参数出错');
		$para['mBankId']=intval($_POST['mBankId']);
		$para['amount']=floatval($_POST['amount']);

		if($para['amount']<=0) throw new Exception('充值金额错误，请重新操作');
			if($this->getRow("select bankId from {$this->prename}sysadmin_bank where bankId=?",$para['mBankId'])){
			if($para['mBankId']==2 || $para['mBankId']==3){
				if($para['amount']<$this->settings['rechargeMin1'] || $para['amount']>$this->settings['rechargeMax1']) throw new Exception('支付宝/财付通充值最低'.$this->settings['rechargeMin1'].'元，最高'.$this->settings['rechargeMax1'].'元');
			}else{
				if($para['amount']<$this->settings['rechargeMin'] || $para['amount']>$this->settings['rechargeMax']) throw new Exception('银行卡充值最低'.$this->settings['rechargeMin1'].'元，最高'.$this->settings['rechargeMax1'].'元');
			}
		}else{
				throw new Exception('充值银行不存在，请重新选择');
			}
		if(strtolower($_POST['vcode'])!=$_SESSION[$this->vcodeSessionName]){
			throw new Exception('验证码不正确。'.$_SESSION[$this->vcodeSessionName]);
		}else{
			
			// 插入提现请求表
			unset($para['coinpwd']);
			$para['rechargeId']=$this->getRechId();
			$para['actionTime']=$this->time;
			$para['uid']=$this->user['uid'];
			$para['username']=$this->user['username'];
			$para['actionIP']=$this->ip(true);
			//$mBankId=$para['mBankId'];

			$para['info']='用户充值';
			
			if($this->insertRow($this->prename .'member_recharge', $para)){
				//if($para['mBankId']==12){
				//$this->display('http://www.3033shop.cn/ips/recharge-pay.php?Billno='.$para['rechargeId'].'&Amount='.$para['amount']);
				//header("location:http://www.3033shop.cn/ips/recharge-pay.php");
//echo "<script>location.href='http://www.3033shop.cn/ips/recharge-pay.php?Billno=".$para['rechargeId']."&Amount=".$para['amount']."';</script>";   
				//}
				//else{
					$this->display('cash/recharge-copy.php',0,$para);
					//}
			}else{
				throw new Exception('充值订单生产请求出错');
			}
			
		}


		//清空验证码session
	    unset($_SESSION[$this->vcodeSessionName]);
	}
	
	public final function getRechId(){
		$rechargeId=mt_rand(100000,999999);
		if($this->getRow("select id from {$this->prename}member_recharge where rechargeId=$rechargeId")){
			getRechId();
		}else{
			return $rechargeId;
		}
	}
	
	//充值提现详细信息弹出
	public final function rechargeModal($id){
		$this->getTypes();
		$this->getPlayeds();
		$this->display('cash/recharge-modal.php', 0 , $id);
	}
	public final function cashModal($id){
		$this->getTypes();
		$this->getPlayeds();
		$this->display('cash/cash-modal.php', 0 , $id);
	}
	
	//充值演示
	public final function paydemo($id){
		$this->display('cash/paydemo.php', 0 , $id);
	}
}