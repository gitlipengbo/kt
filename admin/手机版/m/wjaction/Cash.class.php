<?php

class Cash extends WebLoginBase{
	public $pageSize=20;

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
		if(!$para=$_POST) throw new Exception('参数出错');
		$bank=$this->getRow("select * from {$this->prename}member_bank where uid=? limit 1",$this->user['uid']);
		$para['username']=$bank['username'];
		$para['account']=$bank['account'];
		$para['bankId']=$bank['bankId'];
		
		//提示时间检查
		$baseTime=strtotime(date('Y-m-d ',$this->time).'06:00');
		$fromTime=strtotime(date('Y-m-d ',$this->time).$this->settings['cashFromTime'].':00');
		$toTime=strtotime(date('Y-m-d ',$this->time).$this->settings['cashToTime'].':00');
		if($toTime<$baseTime) $toTime.=24*3600;
		if($this->time < $fromTime || $this->time > $toTime ) throw new Exception("提现时间：从".$this->settings['cashFromTime']."到".$this->settings['cashToTime']);

		//根据最后充值来的消费判断
		$betAmout=0;
		$rechargeAmount=0;
		//最后充值
		$recharge=$this->getRow("select rechargeTime,(case when rechargeAmount>0 then rechargeAmount else amount end) rechargeAmount from {$this->prename}member_recharge where  uid={$this->user['uid']} and isDelete=0 and state in (1,2,9) order by id desc limit 1");
		if($recharge && $this->settings['cashMinAmount']){
			$rechargeTime=$recharge['rechargeTime'];
			$rechargeAmount=floatval($recharge['rechargeAmount']);
			$cashMinAmount=floatval($this->settings['cashMinAmount'])/100;
			$rechargeAmount=$rechargeAmount*$cashMinAmount;

			//消费总额
			$betAmout=$this->getValue("select sum(mode*beiShu*actionNum) from {$this->prename}bets where uid={$this->user['uid']} and isDelete=0 and actionTime>={$rechargeTime} and lotteryNo<>''");
			
			if(!$betAmout || floatval($betAmout)<floatval($rechargeAmount)) throw new Exception("消费满".$this->settings['cashMinAmount']."%才能提现");	
		
		}/////消费判断结束
		
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
				'typea'=>0,
				'liqType'=>50,
				'coin'=>0-$para['amount'],
				'fcoin'=>$para['amount'],
				'uid'=>$para['uid'],
				'info'=>"提现[$id]资金冻结",
				'extfield0'=>$id
			));

			$this->commit();

			  return '申请提现成功，提现将在10分钟内到帐，如未到账请联系在线客服。';
			?>
            
			<?php
		}catch(Exception $e){
			$this->rollBack();
			//return 9999;
			throw $e;
		}
	}
	
	
	/* 进入充值，生产充值订单 */
	public final function inRecharge(){

		if(!$para=$_POST) throw new Exception('参数出错');

		if($this->user['coinPassword']!=md5($para['coinpwd'])){
			throw new Exception('资金密码不正确');
		}else{
			// 插入提现请求表
			unset($para['coinpwd']);
			$para['rechargeId']=$this->getRechId();
			$para['actionTime']=$this->time;
			$para['uid']=$this->user['uid'];
			$para['username']=$this->user['username'];
			$para['actionIP']=$this->ip(true);
			$mBankId=$para['mBankId'];
			$para['info']='用户充值';
			$para['wjflag']=1;
			
			if($this->insertRow($this->prename .'member_recharge', $para)){
				$this->display('cash/recharge-copy.php',0,$para);
			}else{
				throw new Exception('充值订单生产请求出错');
			}
		}
		
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