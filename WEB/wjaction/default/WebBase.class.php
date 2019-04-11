<?php
/**
 * 前台页面基类
 */
class WebBase extends Object{
	public $controller;
	public $action;

	public $memberSessionName='member-session-name';
	public $user;
	public $headers;

	public $page=1;
	public $title='顺丰国际';
	public $params=array();	// 系统配置参数

	public $types;			// 彩票种类信息数组
	public $playeds;		// 玩法信息数组
	private $expire=3600;	// 读取玩法、彩票缓存
	
	public $urlPasswordKey='abc';//推广链接加密

	function __construct($dsn, $user='', $password=''){
		session_start();

		try{
			parent::__construct($dsn, $user, $password);
			if($_SESSION[$this->memberSessionName]){
				$this->user=unserialize($_SESSION[$this->memberSessionName]);
				$this->updateSessionTime();
			}
		}catch(Exception $e){
			//print_r($e);
		}
	}
	
	public function getSystemSettings($expire=null){
		if($expire===null) $expire=$this->expire;
		$file=$this->cacheDir . '/systemSettings';
		if($expire && is_file($file) && filemtime($file)+$expire>$this->time){
			return $this->settings=unserialize(file_get_contents($file));
		}
		
		$sql="select * from {$this->prename}params";
		$this->settings=array();
		if($data=$this->getRows($sql)){
			foreach($data as $var){
				$this->settings[$var['name']]=$var['value'];
			}
		}
		
		file_put_contents($file, serialize($this->settings));
		return $this->settings;
	}
	
	public function getTypes(){
		if($this->types) return $this->types;
		$sql="select * from {$this->prename}type where isDelete=0 order by sort asc";
		return $this->types=$this->getObject($sql, 'id', null, $this->expire);
	}
	
	public function getPlayeds(){
		if($this->playeds) return $this->playeds;
		$sql="select * from {$this->prename}played ";
		return $this->playeds=$this->getObject($sql, 'id', null, $this->expire);
	}
	
	/**
	 * 读取系统配置参数
	 */
	public function getSystemConfig(){
		$file=$this->cacheDir .'FDJSALKFJSIDFJSKLJFFSJDafkljdasa5235465723';
		if(is_file($file) && filemtime($file)+$this->expire>$this->time){
			$this->params=unserialize(file_get_contents($file));
		}else{
			$sql="select name, value from {$this->prename}params";
			if($data=$this->getRows($sql)) foreach($data as $var){
				$this->params[$var['name']]=$var['value'];
			}
			//print_r($data);
			file_put_contents($file, serialize($this->params));
		}
	}
	
	public function getPl($type=null, $played=null){
		$type=intval($type);
		$played=intval($played);
		if($type==null) $type=$this->type;
		if($played==null) $played=$this->$played;
		
		$sql="select bonusProp, bonusPropBase from {$this->prename}played where id=?";
		//echo $sql;
		return $this->getRow($sql, $played);
	}
	
	/**
	 * 读取将要开奖期号
	 *
	 * @params $type		彩种ID
	 * @params $time		时间，如果没有，当默认当前时间
	 * @params $flag		如果为true，则返回最近过去的一期（一般是最近开奖的一期），如果为flase，则是将要开奖的一期
	 */
	public function getGameNo($type, $time=null){
		$type=intval($type);
		if($time===null) $time=$this->time;
		$kjTime=$this->getTypeFtime($type);
		$atime=date('H:i:s', $time+$kjTime);
		
		$sql="select actionNo, actionTime from {$this->prename}data_time where type=$type and actionTime>? order by actionTime limit 1";
		$return = $this->getRow($sql, $atime);
		
		if(!$return){
			$sql="select actionNo, actionTime from {$this->prename}data_time where type=$type order by actionTime limit 1";
			$return =$this->getRow($sql, $atime);
			$time=$time+24*3600;
		}
		
		$types=$this->getTypes();
		if(($fun=$types[$type]['onGetNoed']) && method_exists($this, $fun)){
			$this->$fun($return['actionNo'], $return['actionTime'], $time);
		}
		
		return $return;
	}
	
	public function getGameLastNo($type, $time=null){
		$type=intval($type);
		if($time===null) $time=$this->time;
		$kjTime=$this->getTypeFtime($type);
		$atime=date('H:i:s', $time+$kjTime);
		$sql="select actionNo, actionTime from {$this->prename}data_time where type=$type and actionTime<=? order by actionTime desc limit 1";
		$return = $this->getRow($sql, $atime);
		if(!$return){
			$sql="select actionNo, actionTime from {$this->prename}data_time where type=$type order by actionNo desc limit 1";
			$return =$this->getRow($sql, $atime);
			$time=$time-24*3600;
		}
		$types=$this->getTypes();
		if(($fun=$types[$type]['onGetNoed']) && method_exists($this, $fun)){
			$this->$fun($return['actionNo'], $return['actionTime'], $time);
		}
		return $return;
	}

	public function getGamenextNo($type, $time=null){
		$type=intval($type);
		if($time===null) $time=$this->time;
		$kjTime=$this->getTypeFtime($type);
		$atime=date('H:i:s', $time);
		$sql="select actionNo, actionTime from {$this->prename}data_time where type=$type and actionTime>? order by actionTime limit 1";
		$return = $this->getRow($sql, $atime);
		if(!$return){
			$sql="select actionNo, actionTime from {$this->prename}data_time where type=$type order by actionTime limit 1";
			$return =$this->getRow($sql, $atime);
			$time=$time+24*3600;
		}
		$types=$this->getTypes();
		if(($fun=$types[$type]['onGetNoed']) && method_exists($this, $fun)){
			$this->$fun($return['actionNo'], $return['actionTime'], $time);
		}
		return $return;
	}
	
	public function getGameNos($type, $num=0, $time=null){
		$type=intval($type);
		if($time===null) $time=$this->time;
		$ptime=date('H:i:s', $time);
		
		$sql="select actionNo, actionTime from {$this->prename}data_time where type=$type and actionTime>? order by actionTime";
		if($num) $sql.=" limit $num";
		$return = $this->getRows($sql, $ptime);
		$types=$this->getTypes();
		if(($fun=$types[$type]['onGetNoed']) && method_exists($this, $fun)){
			if($return) foreach($return as $i=>$var){
				$this->$fun($return[$i]['actionNo'], $return[$i]['actionTime'], $time);
				
				$return[$i]['actionTime']=strtotime($return[$i]['actionTime']);
			}
		}
		
		if(count($return)<$num){
			$sql="select actionNo, actionTime from {$this->prename}data_time where type=$type order by actionTime limit " . ($num-count($return));
			$return1=$this->getRows($sql);

			if(($fun=$types[$type]['onGetNoed']) && method_exists($this, $fun)){
				if($return1) foreach($return1 as $i=>$var){
					$this->$fun($return1[$i]['actionNo'], $return1[$i]['actionTime'], $time+24*3600);
					
					$return1[$i]['actionTime']=strtotime($return1[$i]['actionTime']);
				}
			}
			$return=array_merge($return, $return1);
		}
		
		return $return;
	}
	
	private function setTimeNo(&$actionTime, &$time=null){
		$actionTime=wjStrFilter($actionTime);
		//if(preg_match('/^\d{4}/', $actionTime)) return;
		if(!$time) $time=$this->time;
		$actionTime=date('Y-m-d ', $time).$actionTime;
	}
	
	public function noHdCQSSC(&$actionNo, &$actionTime, $time=null){
		$actionNo=wjStrFilter($actionNo);
		$this->setTimeNo($actionTime, $time);
		if($actionNo==0||$actionNo==120){
			//echo 999;
			$actionNo=date('Ymd-120', $time - 24*3600);
			$actionTime=date('Y-m-d 00:00', $time);
			//echo $actionTime;
		}else{
			$actionNo=date('Ymd-', $time).substr(1000+$actionNo,1);
		}
		//var_dump($actionNo);exit;
	}
	
	public function onHdXjSsc(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		if($actionNo>=84){
			$actionNo=date('Ymd-'.$actionNo, $time - 24*3600);
		}else{
			$actionNo=date('Ymd-', $time).substr(1000+$actionNo,1);
		}
	}
	
	public function noHd(&$actionNo, &$actionTime, $time=null){
		//echo $actionNo;
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('Ymd-', $time).substr(100+$actionNo,1);
	}
	
	public function noxHd(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		if($actionNo>=84){
			$time-=24*3600;
		}
		
		$actionNo=date('Ymd-', $time).substr(100+$actionNo,1);
	}

	public function no0Hd(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('Ymd-', $time).substr(1000+$actionNo,1);
	}

	public function no0Hdk3(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('md', $time).substr(100+$actionNo,1);
	}

	public function no0Hdf(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('Ymd-', $time).substr(10000+$actionNo,1);
	}
	
	public function pai3(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		//echo $actionTime,' ',date('Y-m-d H:i:s', $time);
		$actionNo=date('Yz', $time)-6;
		$actionNo=substr($actionNo,0,4).substr(substr($actionNo,4)+1000,1);
		if($actionTime >= date('Y-m-d H:i:s', $time)){
			
		}else{
			$actionTime=date('Y-m-d 18:30', $time);
		}
	}
	
	public function GXklsf(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('Yz', $time).substr(100+$actionNo,1)+100;
		$actionNo=substr($actionNo,0,4).substr(substr($actionNo,4)+100000,1);
	}
	
	public function BJpk10(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo = 179*(strtotime(date('Y-m-d', $time))-strtotime('2007-11-11'))/3600/24+$actionNo-14;
	}
	public function Kuai8(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo = 179*(strtotime(date('Y-m-d', $time))-strtotime('2004-09-19'))/3600/24+$actionNo-77;
	}
	/**
	 * 读取当前设置的赔率
	 *
	 * @params $type		彩种ID，
	 * @params $playedId	玩法ID
	 */
	public function getBonusProp($type, $playedId){
		$sql="select value from {$this->prename}pl where type=? and playedId=?";
		return $this->getValue($sql, array($type, $playedId));
	}
	
	public function updateSessionTime(){
		$sql="update ssc_member_session set accessTime={$this->time} where id=?";
		$this->update($sql, $this->user['sessionId'], $this->user['sessionId']);
	}

	public function checkLogin(){
		if($user=unserialize($_SESSION[$this->memberSessionName])) return $user;
		//header('X-Not-Login: ');
		header('location: /index.php/user/login');
		exit('您没有登录');
	}

	private function setClientMessage($message, $type='Info', $showTime=3000){
		$message=trim(rawurlencode($message), '"');
		header("X-$type-Message: $message");
		header("X-$type-Message-Times: $showTime");
	}
	
	protected function info($message, $showTime=3000){
		$this->setClientMessage($message, 'Info', $showTime);
	}
	protected function success($message, $showTime=3000){
		$this->setClientMessage($message, 'Success', $showTime);
	}
	protected function warning($message, $showTime=3000){
		$this->setClientMessage($message, 'Warning', $showTime);
	}
	public function error($message, $showTime=5000){
		$this->setClientMessage($message, 'Error', $showTime);
		exit;
	}
	//获取延迟时间
	public function getTypeFtime($type){
		
		if($type){
				$Ftime=$this->getValue("select data_ftime from {$this->prename}type where id = ? ", $type);
			}
			if(!$Ftime) $Ftime=0;
			return intval($Ftime);
	 }
	//获取该玩法最大注数
	public function getmaxcount($playedid){
		if($playedid){
				$maxcount=$this->getValue("select maxcount from {$this->prename}played where id = ? ", $playedid);
			}
			return intval($maxcount);
	 }
	 //////

function cpcont($id){		
		switch ($id)
{
case 1:
  $cpname="时时彩";
  break;  
case 2:
  $cpname="十一选五";
  break;
case 3:
  $cpname="低频彩";
  break;
case 4:
  $cpname="快乐彩";
  break;
case 5:
  $cpname="欢乐彩";
  break;
case 9:
  $cpname="快乐3";
  break;
}
return $cpname;
}
	//ip转地址
function convertip($ip) {
    //IP数据文件路径
    $dat_path = 'QQWry.Dat';
    //检查IP地址
    //if(!preg_match("/^d{1,3}.d{1,3}.d{1,3}.d{1,3}$/", $ip)) {
    //    return 'IP Address Error';
    //}
    //打开IP数据文件
    if(!$fd = @fopen($dat_path, 'rb')){
        return 'IP date file not exists or access denied';
    }
    //分解IP进行运算，得出整形数
    $ip = explode('.', $ip);
    $ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3];
    //获取IP数据索引开始和结束位置
    $DataBegin = fread($fd, 4);
    $DataEnd = fread($fd, 4);
    $ipbegin = implode('', unpack('L', $DataBegin));
    if($ipbegin < 0) $ipbegin += pow(2, 32);
    $ipend = implode('', unpack('L', $DataEnd));
    if($ipend < 0) $ipend += pow(2, 32);
    $ipAllNum = ($ipend - $ipbegin) / 7 + 1;
    $BeginNum = 0;
    $EndNum = $ipAllNum;
    //使用二分查找法从索引记录中搜索匹配的IP记录
    while($ip1num>$ipNum || $ip2num<$ipNum) {
        $Middle= intval(($EndNum + $BeginNum) / 2);
        //偏移指针到索引位置读取4个字节
        fseek($fd, $ipbegin + 7 * $Middle);
        $ipData1 = fread($fd, 4);
        if(strlen($ipData1) < 4) {
            fclose($fd);
            return 'System Error';
        }
        //提取出来的数据转换成长整形，如果数据是负数则加上2的32次幂
        $ip1num = implode('', unpack('L', $ipData1));
        if($ip1num < 0) $ip1num += pow(2, 32);
        //提取的长整型数大于我们IP地址则修改结束位置进行下一次循环
        if($ip1num > $ipNum) {
            $EndNum = $Middle;
            continue;
        }
        //取完上一个索引后取下一个索引
        $DataSeek = fread($fd, 3);
        if(strlen($DataSeek) < 3) {
            fclose($fd);
            return 'System Error';
        }
        $DataSeek = implode('', unpack('L', $DataSeek.chr(0)));
        fseek($fd, $DataSeek);
        $ipData2 = fread($fd, 4);
        if(strlen($ipData2) < 4) {
            fclose($fd);
            return 'System Error';
        }
        $ip2num = implode('', unpack('L', $ipData2));
        if($ip2num < 0) $ip2num += pow(2, 32);
        //没找到提示未知
        if($ip2num < $ipNum) {
            if($Middle == $BeginNum) {
                fclose($fd);
                return 'Unknown';
            }
            $BeginNum = $Middle;
        }
    }
    $ipFlag = fread($fd, 1);
    if($ipFlag == chr(1)) {
        $ipSeek = fread($fd, 3);
        if(strlen($ipSeek) < 3) {
            fclose($fd);
            return 'System Error';
        }
        $ipSeek = implode('', unpack('L', $ipSeek.chr(0)));
        fseek($fd, $ipSeek);
        $ipFlag = fread($fd, 1);
    }
    if($ipFlag == chr(2)) {
        $AddrSeek = fread($fd, 3);
        if(strlen($AddrSeek) < 3) {
            fclose($fd);
            return 'System Error';
        }
        $ipFlag = fread($fd, 1);
        if($ipFlag == chr(2)) {
            $AddrSeek2 = fread($fd, 3);
            if(strlen($AddrSeek2) < 3) {
                fclose($fd);
                return 'System Error';
            }
            $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
            fseek($fd, $AddrSeek2);
        } else {
            fseek($fd, -1, SEEK_CUR);
        }
        while(($char = fread($fd, 1)) != chr(0))
            $ipAddr2 .= $char;
        $AddrSeek = implode('', unpack('L', $AddrSeek.chr(0)));
        fseek($fd, $AddrSeek);
        while(($char = fread($fd, 1)) != chr(0))
            $ipAddr1 .= $char;
    } else {
        fseek($fd, -1, SEEK_CUR);
        while(($char = fread($fd, 1)) != chr(0))
            $ipAddr1 .= $char;
        $ipFlag = fread($fd, 1);
        if($ipFlag == chr(2)) {
            $AddrSeek2 = fread($fd, 3);
            if(strlen($AddrSeek2) < 3) {
                fclose($fd);
                return 'System Error';
            }
            $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
            fseek($fd, $AddrSeek2);
        } else {
            fseek($fd, -1, SEEK_CUR);
        }
        while(($char = fread($fd, 1)) != chr(0)){
            $ipAddr2 .= $char;
        }
    }
    fclose($fd);
    //最后做相应的替换操作后返回结果
    if(preg_match('/http/i', $ipAddr2)) {
        $ipAddr2 = '';
    }
    $ipaddr = "$ipAddr1 $ipAddr2";
    $ipaddr = preg_replace('/CZ88.Net/is', '', $ipaddr);
    $ipaddr = preg_replace('/^s*/is', '', $ipaddr);
    $ipaddr = preg_replace('/s*$/is', '', $ipaddr);
    if(preg_match('/http/i', $ipaddr) || $ipaddr == '') {
        $ipaddr = 'Unknown';
    }
 $ipaddr = iconv('gbk', 'utf-8//IGNORE', $ipaddr); //转换编码，如果网页的gbk可以删除此行
    return $ipaddr;
}

	 //获取当期时间
	public function getGameActionTime($type,$old=0){
		$actionNo=$this->getGameNo($type);
		
		if($type==1 && $actionNo['actionTime']=='00:00'){
			$actionTime=strtotime($actionNo['actionTime'])+24*3600;
		}else{
			$actionTime=strtotime($actionNo['actionTime']);
		}
		if(!$actionTime) $actionTime=$old;
		return $actionTime;
	}/////
	
	//获取当期期数
	public function getGameActionNo($type){
		$actionNo=$this->getGameNo($type);
		return $actionNo['actionNo'];
	}/////
	
	//随机函数
	public function randomkeys($length)
	{
	 $key = "";
	 $pattern='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	 $pattern1='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	 $pattern2='0123456789';
	 for($i=0;$i<$length;$i++)
	 {
	   $key .= $pattern{mt_rand(0,35)};
	 }

	 return $key;
	}
	
	//输出单号
	function formatwords($str){
		
	if($str){
		$len=strlen($str);  
		for($i=0;$i<$len;$i++){
			echo "<i>".substr($str, $i, 1)."</i>";
			
		}
	 }
	}/////
	

}