	<div class="game-maina"><div class="game-btn">
	<?php
		if($_COOKIE['mode']){
			$mode=$_COOKIE['mode'];
		}else{
			$mode=2.00;
		}
		$this->getSystemSettings();
		$this->getTypes();
		$sql="select id, groupName, enable from {$this->prename}played_group where enable=1 and type=? order by sort";
		$groups=$this->getObject($sql, 'id', $this->types[$this->type]['type']);
		if($this->groupId && !$groups[$this->groupId]) unset($this->groupId);
		
		if($groups) foreach($groups as $key=>$group){
			if(!$this->groupId) $this->groupId=$group['id'];
	?>
		
        	<a class="<?=($this->groupId==$group['id'])?'current':''?>" href="/index.php/index/group/<?=$this->type .'/'.$group['id']?>"><em><?=$group['groupName']?></em></a>
		
	<?php } ?>
    <div class="clear"></div>
	</div></div>

<div class="game-main">
<div id="bet-game">
	
	<div class="game-cont">
		<?php $this->display('index/inc_game_played.php'); ?>
		<div class="num-table" style="height:auto;" id="game-dom" >
			<div class="fandian" >
				<div class="fandian-k">
					<span class="spn8">奖金/返点：</span>
					<div class="fandian-box">
						<input type="button" class="min" value="" step="-0.1"/>
						<div id="slider" class="slider" value="<?=$this->ifs($_COOKIE['fanDian'], 0)?>" data-bet-count="<?=$this->settings['betMaxCount']?>" data-bet-zj-amount="<?=$this->settings['betMaxZjAmount']?>" max="<?=$this->user['fanDian']?>" game-fan-dian="<?=$this->settings['fanDianMax']?>" fan-dian="<?=$this->user['fanDian']?>" game-fan-dian-bdw="<?=$this->settings['fanDianBdwMax']?>" fan-dian-bdw="<?=$this->user['fanDianBdw']?>" min="0" step="0.1" slideCallBack="gameSetFanDian"></div>
						<input type="button" class="max" value="" step="0.1"/>
					</div>
					<span id="fandian-value" class="fdmoney"><?=$maxPl?>/0%</span>
				</div>
				<div class="danwei">
					<span class="spn8">模式：</span>
					<label>元<input type="radio" value="2.00" data-max-fan-dian="<?=$this->settings['betModeMaxFanDian0']?>" name="danwei" <?=$this->iff($mode=='2.00','checked')?> /></label>
					<label>角<input type="radio" value="0.20" data-max-fan-dian="<?=$this->settings['betModeMaxFanDian1']?>" name="danwei" <?=$this->iff($mode=='0.20','checked')?> /></label>
					<?php if($this->settings['fenmosi']==1){?>
					<label>分<input type="radio" value="0.02" data-max-fan-dian="<?=$this->settings['betModeMaxFanDian2']?>" name="danwei" <?=$this->iff($mode=='0.02','checked')?> /></label>
					<?}?>
				</div>
				<div class="beishu">
                <span class="spn8">倍数：</span><input type="button" class="surbeishu" value=""/><input id="beishu" value="<?=$this->ifs($_COOKIE['beishu'],1)?>" class="txt"/><input type="button" class="addbeishu" value=""/></div>
                </div>
				<div class="tz-tongji">【您选择了<span id="all-count">0</span>注，&nbsp;&nbsp;&nbsp;&nbsp;共￥：<span id="all-amount">0.00</span>元】</div>
			<div class="clear"></div>
		</div>
        <div class="line"></div>
		<div class="touzhu">
        	
			<div class="touzhu-top">
				<!--<button class="tz-top-btn" onclick="gameActionRandom(1)">机选一注</button>
				<button class="tz-top-btn" onclick="gameActionRandom(5)" >机选五注</button>-->
                <div class="tztj-btn" onclick="gameActionAddCode()"></div>
				
				
			</div>
			<!--<select size="7" class="touzhu-cont" id="select-code" ></select>-->
            <div class="line"></div>
			<div class="touzhu-cont" >
				<table width="95%">
					
				</table>
			</div>
<div class="line"></div>
            
			<div class="touzhu-bottom" >
			<div class="tz-buytype" >
                	<?php if($this->types[$this->type]['type']==8){?>
                    <!--<label><input type="checkbox" value="1"  name="fpEnable" />&nbsp;快乐飞盘&nbsp;</label>-->
                    <?php } ?>
					<!--<label><input type="checkbox" name="qzEnable" value="1" <?//=$this->iff($this->settings['switchMaster'],'checked="checked"')?>/>&nbsp;庄内庄&nbsp;</label>-->
					<div class="lred1" onclick="gameActionRemoveCode()"  >清空号码</div>
					<label class="zh-true-btn" style="float:none"><input type="checkbox" name="zhuiHao" value="1" /></label>
					
				</div>
				
			</div>
			<div class="clear"></div>
			<div class="tz-true-btn" id="btnPostBet">确定投注</div>
		</div>
		<?php if($this->settings['tzjl']==1){?>
		<div class="touzhu-true">
			<table width="100%">
				<thead>
					<tr>
					    <td>单号</td><td>投注时间</td><td>彩种</td><td>玩法</td><td>期号</td><td>投注号码</td><td>倍数</td><td>模式</td><td>金额(元)</td><td>奖金(元)</td>
						<td>操作</td>
					</tr>
				</thead>
				<tbody id="order-history"><?php $this->display('index/inc_game_order_history.php'); ?></tbody>
			</table>
		</div>
		<?}?>
	</div>
</div>
<div id="znz-game" style="display:none;"></div>
</div>

	<div class="clear"></div>