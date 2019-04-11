<script>
$(document).ready(function () {
    $('ul.nav li').has('div').append("<img class='navarrow' src='/images/common/arrow.png' />");
    $("ul.nav li").click(
     function(){
		  $(this).find("div").slideToggle(100);
          $(this).toggleClass("navtionhover");
		  $(this).siblings("li").removeClass("navtionhover").find(".subnav").hide();
		  
		 }
		 
    );

});
</script>
<?php 
	if($this->controller=='Index'){
		$wjControl="myIndex";
	}
	else if($this->controller=='Main'){
		$wjControl="myMain";
	}
	else if($this->controller=='Team'){
		$wjControl="myTeam";
	}
	else if($this->controller=='Notice'){
		$wjControl="myNotice";
	}
	else if($this->controller=='KJdata'){
		$wjControl="myKJdata";
	}
	else if($this->controller=='Score'){
		$wjControl="myScore";
	}
	else{
		$wjControl="myAcount";
	}
?>

<div id="header">
	
    <div id="page-header">
   <div class="logo"><img src="/images/common/logo.png" /></div>
   <div class="userInfo"><?php $this->display('index/inc_user.php'); ?></div>
  <div class="navtionbox">
    <ul class="nav">
    	<li <?=$this->iff($wjControl=='myMain', 'class="navtionhover"')?>><a href="/" >平台首页</a></li>
        <li <?=$this->iff($wjControl=='myIndex', 'class="navtionhover"')?>><a href="#" onclick="return false;">选择彩种</a>
            <div class="subnav reset">                
                <table>
                <?php 
				$sql="select id,defaultViewGroup,title from {$this->prename}type where android=1 and enable=1 and type=?";
				$games=$this->getRows($sql, 1);
				if($games) 
				{
					echo "<tr><th class=\"ssc\">时时彩：</th></tr><tr><td>";
					foreach($games as $game){ 
					echo "<a href=\"/index.php/index/game/{$game['id']}/{$game['defaultViewGroup']}\" >{$game['title']}</a>";

				}
				echo "</td></tr>";
				}

				$sql="select id,defaultViewGroup,title from {$this->prename}type where android=1 and enable=1 and type=?";
				$games=$this->getRows($sql, 2);
				if($games) 
				{
					echo "<tr><th class=\"x5\">11选5：</th></tr><tr><td>";
					foreach($games as $game){ 
					echo "<a href=\"/index.php/index/game/{$game['id']}/{$game['defaultViewGroup']}\" >{$game['title']}</a>";

				}
				echo "</td></tr>";
				}
				
				$sql="select id,defaultViewGroup,title from {$this->prename}type where android=1 and enable=1 and type=?";
				$games=$this->getRows($sql, 3);
				if($games) 
				{
					echo "<tr><th class=\"fc\">福彩体彩：</th></tr><tr><td>";
					foreach($games as $game){ 
					echo "<a href=\"/index.php/index/game/{$game['id']}/{$game['defaultViewGroup']}\" >{$game['title']}</a>";

				}
				echo "</td></tr>";
				}
				 
				$sql="select id,defaultViewGroup,title from {$this->prename}type where android=1 and enable=1 and type not in(1,2,3)";
				$games=$this->getRows($sql);
				if($games) 
				{
					echo "<tr><th class=\"ssc\">其它：</th></tr><tr><td>";
					foreach($games as $game){ 
					echo "<a href=\"/index.php/index/game/{$game['id']}/{$game['defaultViewGroup']}\" >{$game['title']}</a>";

				}
				echo "</td></tr>";
				}
				 ?>
                </table>                
            </div>
        </li>      
        <li <?=$this->iff($wjControl=='myAcount', 'class="navtionhover"')?>><a href="#" onclick="return false;">会员中心</a><div class="subnav"><a href="/index.php/safe/info" ><img alt="" src="/images/icon/icon (29).png" ></img>个人资料</a><a href="/index.php/safe/passwd" ><img alt="" src="/images/icon/icon (7).png" ></img>密码管理</a><a href="/index.php/record/search" ><img alt="" src="/images/icon/icon (10).png" ></img>游戏记录</a><a href="/index.php/report/count" ><img alt="" src="/images/icon/icon (19).png" ></img>盈亏报表</a><a href="/index.php/report/coin" ><img alt="" src="/images/icon/icon (14).png" ></img>帐变记录</a><a href="/index.php/cash/rechargeLog" ><img alt="" src="/images/icon/icon (18).png" ></img>充值记录</a><a href="/index.php/cash/toCashLog" ><img alt="" src="/images/icon/icon (8).png" ></img>提现记录</a></div></li>
        <?php if($this->user['type']){ ?>
        <li <?=$this->iff($wjControl=='myTeam', 'class="navtionhover"')?>><a href="#" onclick="return false;">代理中心</a><div class="subnav"><a href="/index.php/team/memberList" ><img alt="" src="/images/icon/icon (17).png" ></img>会员管理</a><a href="/index.php/team/gameRecord" ><img alt="" src="/images/icon/icon (32).png" ></img>游戏记录</a><a href="/index.php/team/report" ><img alt="" src="/images/icon/icon (19).png" ></img>盈亏报表</a><a href="/index.php/team/coinall" ><img alt="" src="/images/icon/icon (3).png" ></img>团队统计</a><a href="/index.php/team/coin" ><img alt="" src="/images/icon/icon (14).png" ></img>帐变记录</a><a href="/index.php/team/cashRecord" ><img alt="" src="/images/icon/icon (1).png" ></img>提现记录</a><a href="/index.php/team/linkList" ><img alt="" src="/images/icon/icon (33).png" ></img>推广链接</a></div></li>   
        <?php } ?>     
        <li <?=$this->iff($wjControl=='myNotice', 'class="navtionhover"')?>><a href="/index.php/notice/info" >系统公告</a></li>
        <li <?=$this->iff($wjControl=='myKJdata', 'class="navtionhover"')?>><a href="/index.php/index/kjdata/<?=$this->type?>" >开奖历史</a></li>
    </ul>
    <div class="clear"></div>
</div>
    </div>
    
</div>