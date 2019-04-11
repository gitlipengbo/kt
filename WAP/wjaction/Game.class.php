<?php
include_once 'Bet.class.php';
class Game extends WebLoginBase{

    //验证是否开始投注
	public final function checkBuy(){
		$actionNo="";

		if($this->settings['switchBuy']==0){
			$actionNo['flag']=1;
		}
		echo json_encode($actionNo);
		
		}
	//{{{ 投注
	public final function postCode(){
		
		$urlshang = $_SERVER['HTTP_REFERER']; //上一页URL     
		$urldan = $_SERVER['SERVER_NAME']; //本站域名
		$urlcheck=substr($urlshang,7,strlen($urldan));
		if($urlcheck<>$urldan)  throw new Exception('万金娱乐技术郑重警告：提交数据出错，请重新投注');
		
		$codes=$_POST['code'];
		$amount=0;   
		//print_r($_POST);
		if(!$this->getValue("select enable from {$this->prename}played where id=?",$codes[0]['playedId'])) throw new Exception('游戏玩法已停,请刷新再投');
		
		if($this->settings['switchBuy']==0) throw new Exception('本期投注已截止，请下一期再投注');
		if(count($codes)==0) throw new Exception('请先选择号码再提交投注');
		
		
		//$actionNo=$this->getGameNo($code['type']);
		
		// 查检每注的赔率是否正常
		$this->getPlayeds();
		foreach($codes as $code){
			$played=$this->playeds[$code['playedId']];
			if(!$played['enable']) throw new Exception('游戏玩法组已停,请刷新再投');
			
			//throw new Exception(intval($code['bonusProp']).'|'.intval($played['bonusPropBase']).'|'.intval($played['bonusProp']));
			
			if($code['bonusProp']>$played['bonusProp']) throw new Exception('提交数据出错，请重新投注');
			if($code['bonusProp']<$played['bonusPropBase']) throw new Exception('提交数据出错，请重新投注');
			//检查返点
			if(floatval($code['fanDian'])>floatval($this->user['fanDian']) || floatval($code['fanDian'])>floatval($this->settings['fanDianMax'])) throw new Exception('提交数据出错，请重新投注');
			//检查倍数
			if(intval($code['beiShu'])<1) throw new Exception('倍数只能为大于1正整数');
			// 检查注数
			if($betCountFun=$played['betCountFun']){
				if($played['betCountFun']=='descar'){
					if($code['actionNum']>Bet::$betCountFun($code['actionData'])) throw new Exception('提交数据出错，请重新投注');
				}else{
					if($code['actionNum']!=Bet::$betCountFun($code['actionData'])) throw new Exception('提交数据出错，请重新投注');
				}
			}///end

		}
		
		
		$code=current($codes);
		
		$para=$_POST['para'];
		if(!isset($_POST['para']['qzEnable'])) $_POST['para']['qzEnable']=0;
		
		$para=array_merge($_POST['para'], array(
			'actionTime'=>$this->time,
			//'actionNo'=>$actionNo['actionNo'],
			//'kjTime'=>strtotime($actionNo['actionTime']),
			'actionIP'=>$this->ip(true),
			'uid'=>$this->user['uid'],
			'username'=>$this->user['username'],
			'betType'=>1, //手机端
			'serializeId'=>uniqid()
		));
		//print_r($para);exit;
		
		$code=array_merge($code, $para);
		
		//include_once 'Cai.class.php';
		
		//获取封单延迟时间
		$ftime=$this->getTypeFtime($code['type']);

		if($zhuihao=$_POST['zhuiHao']){
			$liqType=31;
			$codes=array();
			$info='追号投注';
			
			unset($para['kjTime']);
			
			foreach(explode(';', $zhuihao) as $var){
				list($code['actionNo'], $code['beiShu'], $code['kjTime'])=explode('|', $var);
				
				$code['kjTime']=strtotime($code['kjTime']);

				if($code['kjTime']-$ftime<$this->time) throw new Exception('投注失败：你追投注第'.$code['actionNo'].'已经过购买时间');
				$codes[]=$code;
				$amount+=abs($code['actionNum']*$code['mode']*$code['beiShu']);
			}
		}else{
			$liqType=30;
			$info='投注';
			//重新获取时间
			$para['kjTime']=$this->getGameActionTime($code['type'],$para['kjTime']);
			if($para['kjTime']-$ftime<$this->time) throw new Exception('投注失败：你投注第'.$para['actionNo'].'已经过购买时间');
			foreach($codes as $i=>$code){
				$codes[$i]=array_merge($code, $para);
				$amount+=abs($code['actionNum']*$code['mode']*$code['beiShu']);
			}
		}

		// 开始事物处理
		$this->beginTransaction();
		try{
			// 查询用户可用资金
			$userAmount=$this->getValue("select coin from {$this->prename}members where uid={$this->user['uid']}");
			if($userAmount < $amount) throw new Exception('您的可用资金不足，是否充值？');
			
			foreach($codes as $code){
				//$wjstr=$code['type'].$code['playedId'].'000';
				//$wjstr=substr($wjstr, 0, 3);
				//$code['wjorderId']=$wjstr.$this->randomkeys(5);
				$code['wjorderId']=$code['type'].$code['playedId'].$this->randomkeys(8-strlen($code['type'].$code['playedId']));
				// 插入投注表
				$amount=abs($code['actionNum']*$code['mode']*$code['beiShu']);
				$this->insertRow($this->prename .'bets', $code);
	
				// 添加用户资金流动日志
				$this->addCoin(array(
					'typea'=>3,
					'liqType'=>$liqType,
					'uid'=>$this->user['uid'],
					'type'=>$code['type'],
					//'playedId'=>$para['playedId'],
					'info'=>$info,
					'extfield0'=>$this->lastInsertId(),
					'extfield1'=>$para['serializeId'],
					//'extfield2'=>$data['orderId'],
					'coin'=>-$amount,
					//'fcoin'=>$amount
				));
			}
			// 返点与积分等开奖时结算

			$this->commit();
			return '投注成功';
		}catch(Exception $e){
			$this->rollBack();
			throw $e;
		}
	}
	//}}}

	public final function getNo($type){
		$actionNo=$this->getGameNo($type);
		
		if($type==1 && $actionNo['actionTime']=='00:00'){
			$actionNo['actionTime']=strtotime($actionNo['actionTime'])+24*3600;
		}else{
			$actionNo['actionTime']=strtotime($actionNo['actionTime']);
		}

		echo json_encode($actionNo);
	}
	
	
	
	public function calcCount($codeList, $codeLen=1){
		if(!$codeList) return 0;
		$len=0;
		
		foreach(explode('|', $codeList) as $codes){
			$len+=$this->_calcCount($codes, $codeLen);
		}
		
		return $len;
	}
	
	private function _calcCount($codeList, $codeLen=1){
		if(!$codeList) return 0;
		$len=1;
		foreach(explode(',', $codeList) as $code){
			$len*=strlen($code)/$codeLen;
		}
		return $len;
	}
	
	/**
	 * ajax取定单列表
	 */
	public final function getOrdered($type=null){
		if(!$this->type) $this->type=$type;
		$this->display('index/inc_game_order_history.php');
	}
	
	/**
	 * {{{ ajax撤单
	 */
	public final function deleteCode($id){
		
		$this->beginTransaction();
		try{
			$sql="select * from {$this->prename}bets where id=?";
			if(!$data=$this->getRow($sql, $id)) throw new Exception('找不到定单。');
			if($data['isDelete']) throw new Exception('这单子已经撤单过了。');
			if($data['uid']!=$this->user['uid']) throw new Exception('这单子不是您的，您不能撤单。');		// 可考虑管理员能给用户撤单情况
			if($data['kjTime']<=$this->time) throw new Exception('已经开奖，不能撤单');
			if($data['lotteryNo']) throw new Exception('已经开奖，不能撤单');
			if($data['qz_uid']) throw new Exception('单子已经被人抢庄，不能撤单');

			// 冻结时间后不能撤单
			$this->getTypes();
			$ftime=$this->getTypeFtime($data['type']);
			if($data['kjTime']-$ftime<$this->time) throw new Exception('这期已经结冻，不能撤单');

			$amount=$data['beiShu'] * $data['mode'] * $data['actionNum'];
			$amount=abs($amount);
			if($data['wjflag']){
				$wjflag=0;
			}else{
				$wjflag=1;
			}
			// 更改定单为已经删除状态
			$sql="update {$this->prename}bets set isDelete=1,wjflag=$wjflag,delTime=".$this->time." where id=?";
			$this->update($sql, $id);
			// 添加用户资金变更日志
			$this->addCoin(array(
				'typea'=>4,
				'liqType'=>4,
				'uid'=>$data['uid'],
				'type'=>$data['type'],
				'playedId'=>$data['playedId'],
				'info'=>"撤单",
				'extfield0'=>$id,
				'coin'=>$amount,
				//'fcoin'=>-$amount
			));

			$this->commit();
		}catch(Exception $e){
			$this->rollBack();
			throw $e;
		}
	}
	//}}}
	
	
}
