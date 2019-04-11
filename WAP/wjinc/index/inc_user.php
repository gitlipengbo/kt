<?php 
$this->freshSession(); 
$date=strtotime('00:00:00');
?>
<span>用户：<em><?=$this->user['username']?></em></span>
<span class="ml10">余额：<strong><?=number_format($this->user['coin'],2)?><a href="#"  onclick="reloadMemberInfo()"><img src="/images/common/ref.png" alt="刷新余额"></a></strong></span><span class="score"></span>
<span class="ml10"><a href="/index.php/cash/recharge">充值</a></span>
<span class="ml10"><a href="/index.php/cash/toCash">提款</a></span>
<span class="ml10"><a href="/index.php/user/logout">退出</a></span>
<span class="ml10"><a href="<?=$this->settings['kefuGG']?>" class="b" target="_blank">在线客服</a></span>