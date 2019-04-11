<?php
class Index extends WebLoginBase{
	public $pageSize=15;
	
	public final function game($type=null, $groupId=null, $played=null){
		if($type) $this->type=$type;
		if($groupId){
			$this->groupId=$groupId;
		}else{
			// 默认进入三星玩法
			$this->groupId=2;
		}
		if($played) $this->played=$played;
		$this->getSystemSettings();
				
		$this->display('main.php');
	}
	
  //平台首页
	public final function main(){
		$this->controller='Main';	
		$this->display('index.php');
	}
	
	public final function znz($type=null, $groupId=null, $played=null){
		if($type) $this->type=$type;
		if($groupId) $this->groupId=$groupId;
		if($played) $this->played=$played;
		
		$this->getTypes();
		$this->getPlayeds();
		
		$this->display('index/inc_game_znz.php');
	}
	
	public final function group($type, $groupId){
		$this->type=$type;
		$this->groupId=$groupId;
		$this->display('index/load_tab_group.php');
	}
	
	public final function played($type,$playedId){
		$sql="select type, groupId, playedTpl from {$this->prename}played where android=1 and id=?";
		$data=$this->getRow($sql, $playedId);
		$this->type=$type;
		if($data['playedTpl']){
			$this->groupId=$data['groupId'];
			//$this->type=$data['type'];
			$this->played=$playedId;
			$this->display("index/game-played/{$data['playedTpl']}.php");
		}else{
			$this->display('index/game-played/un-open.php');
		}
	}
	
	// 加载玩法介绍信息
	public final function playTips($playedId){
		$this->display('index/inc_game_tips.php', 0, $playedId);
	}
	
	public final function getQiHao($type){
		//$thisNo=$this->getGameNo($this);
		$thisNo=$this->getGameNo($type);
		$kjdTime=$this->getTypeFtime($type);
		return array(
			'lastNo'=>$this->getGameLastNo($type),
			'thisNo'=>$this->getGameNo($type),
			'diffTime'=>strtotime($thisNo['actionTime'])-$this->time,
			'validTime'=>date('Y-m-d h:i:s',strtotime($thisNo['actionTime'])-$kjdTime),
			'kjdTime'=>$kjdTime
		);
	}
	
	// 弹出追号层HTML
	public final function zhuiHaoModal($type){
		$this->display('index/game-zhuihao-modal.php');
	}
	
	// 追号层加载期号
	public final function zhuiHaoQs($type, $mode, $count){
		$this->type=$type;
		$this->display('index/game-zhuihao-qs.php', 0, $mode, $count);
	}
	
	// 加载历史开奖数据
	public final function getHistoryData($type){
		$this->type=$type;
		$this->display('index/inc_data_history.php');
	}
	
	public final function getLastKjData($type){
		$ykMoney=0;
		$czName='重庆时时彩';
		$this->type=$type;
		if(!$lastNo=$this->getGameLastNo($this->type)) throw new Exception('查找最后开奖期号出错');
		if(!$lastNo['data']=$this->getValue("select data from {$this->prename}data where type={$this->type} and number='{$lastNo['actionNo']}'"))
		//echo "select data from {$this->prename}data where type={$this->type} and number='{$lastNo['actionNo']}'";
		throw new Exception('获取数据出错');
		
		$thisNo=$this->getGameNo($this->type);
		$lastNo['actionName']=$czName;
		$lastNo['thisNo']=$thisNo['actionNo'];
		$lastNo['diffTime']=strtotime($thisNo['actionTime'])-$this->time;
		$lastNo['kjdTime']=$this->getTypeFtime($type);
		return $lastNo;
	}
	
	// 加载人员信息框
	public final function userInfo(){
		$this->display('index/inc_user.php');
	}
	
	// 开奖历史
	public final function kjdata($type=1){
		$this->controller='KJdata';
		$this->display('data/list.php', 0, $type);
	}
	
	
}