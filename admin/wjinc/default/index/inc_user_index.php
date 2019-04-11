<?php $this->freshSession(); 
		//更新级别
		$ngrade=$this->getValue("select max(level) from {$this->prename}member_level where minScore <= {$this->user['scoreTotal']}");
		if($ngrade>$this->user['grade']){
			$sql="update ssc_members set grade={$ngrade} where uid=?";
			$this->update($sql, $this->user['uid']);
		}else{$ngrade=$this->user['grade'];}
		
		$date=strtotime('00:00:00');
?>

		<div class="g_33">
			<div class="game-menu" id="J-top-game-menu">
            <span class="game-menu-text dropdown-menu-btn"  onclick="mySwitch('game-menu');">彩票大厅</span>
				<div class="game-menu-panel" id="game-menu" style="display:none;" >
					<span class="triangle game-menu-triangle"><span></span></span>
					<div class="game-menu-inner">
					<?php 
$hh=1;
echo"<div class='game-menu-box'>";
echo"<div class='game-menu-title'>".$this->cpcont($hh)."</div>";
echo"<div class='game-menu-list'>";
							$sql="select id,type,title,shortName,defaultViewGroup from {$this->prename}type where isDelete=0 and enable=1 order by sort , type";
							if($types=$this->getRows($sql))
							foreach($types as $key=>$var){
							if(!$this->type) $this->type=$var['id'];
							
								if($hh!=$var['type']){
echo"</div>  </div>";
echo"<div class='game-menu-box'>";
echo"<div class='game-menu-title'>".$this->cpcont($var['type'])."</div>";
echo"<div class='game-menu-list'>";
$hh=$var['type'];
								}
								
								
echo" <a href='/index.php/index/game/".$var['id']."/".$var['defaultViewGroup']."'>".$var['title']."</a>";
}
					
echo"</div>  </div>";
					?>
						
						
						
						
					</div>
				</div>
			</div>
 


            <a href="/index.php" class="back-top-home">返回首页</a>
			<ul class="menu">
				<li class="username">您好，<?=$this->user['username']?></li>
				<li class="user" >我的账户
					<span onclick="mySwitch('menu');"></span>
					<div class="menu-nav" id="menu">
						<i class="tri"></i>
                       
                              <a href="/index.php/record/search" >游戏记录</a>
        <a href="/index.php/report/count" >盈亏报表</a>        

		<a href="/index.php/safe/info" >会员中心</a>		
        <?php if($this->user['type']){ ?>
        		<a href="/index.php/team/memberList" >代理中心</a>		   
        <?php } ?>   
  <a href="/index.php/notice/info/1" >系统公告</a>   
		
                             <!--  -->
					</div>
				</li>
				
				<li class="balance">
					<span  >余额：<span id="spanBall" name="spanBall"><?=$this->user['coin']?></span><i class="refreshBall"></i></span>
					
				</li>
				<li class="recharge"> <A  href="/index.php/cash/recharge">充值</A></li>
				<li class="withdrawals"><A href="/index.php/cash/toCash">提款</A></li>
				<li class="quit"><A href="/index.php/user/logout">退出</A></li>
			</ul>
		</div>
			<script language="javascript"> 
function mySwitch(id){ 
    document.getElementById(id).style.display = document.getElementById(id).style.display=='none'?'block':'none'; 
} 
</script> 