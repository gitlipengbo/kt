 <?php
	$lastNo=$this->getGameLastNo($this->type);
	$kjHao=$this->getValue("select data from {$this->prename}data where type={$this->type} and number='{$lastNo['actionNo']}'");
	if($kjHao) $kjHao=explode(',', $kjHao);
	
	$actionNo=$this->getGameNo($this->type);
	$types=$this->getTypes();
	$kjdTime=$types[$this->type]['data_ftime'];
	$diffTime=strtotime($actionNo['actionTime'])-$this->time-$kjdTime;
	$kjDiffTime=strtotime($lastNo['actionTime'])-$this->time;
	$surTime=date('Y-m-d h:i:s',strtotime($actionNo['actionTime'])-$kjdTime);
	//$kjHaoS=explode("|",$kjHao[19]);
	//$kjHao[19]=$kjHaoS[0];
	//$feipan=$kjHaoS[1];
?>
    <div class="bd" id="kaijiang" type="<?=$this->type?>" ctype="<?=$types[$this->type]['type']?>">
    
    	<div class="lastGame">
        	<div class="lastGame-tit">
            	<span class="tit"><span class="gamename"><?=$types[$this->type]['title']?></span> 第 <span class="last_issues"><?=$lastNo['actionNo']?></span> 期  <span id="kjsay">开奖倒计时：<em class="kjtips">00:00</em></span></span><img id="voice" class="voice-on"  title="声音开启，点击关闭" onclick="voiceKJ()">
            	<div class="clear"></div>
            </div>
            <div class="wjkjData" >
              <p class="hide"><img src="/images/common/kjts.png" /></p>
              <?php 
			  switch($types[$this->type]['type']){
				case 2: //11选5
					
			?>
            <ul class="kj-hao" ctype="g3"  cnum="11">
                <li id="span_lot_0" class="gr_s gr_s<?=$kjHao[0]?>"> </li>
                <li id="span_lot_1" class="gr_s gr_s<?=$kjHao[1]?>"> </li>
                <li id="span_lot_2" class="gr_s gr_s<?=$kjHao[2]?>"> </li>
                <li id="span_lot_3" class="gr_s gr_s<?=$kjHao[3]?>"> </li>
                <li id="span_lot_4" class="gr_s gr_s<?=$kjHao[4]?>"> </li>
                <div class="clear"></div>
              </ul>
             <?php
			 break;
			 case 3: //3D
			 ?>
            <ul class="kj-hao" ctype="g0"  cnum="10">
                <li id="span_lot_0" class="gr_s gr_s<?=intval($kjHao[0])?>"> </li>
                <li id="span_lot_1" class="gr_s gr_s<?=intval($kjHao[1])?>"> </li>
                <li id="span_lot_2" class="gr_s gr_s<?=intval($kjHao[2])?>"> </li>
                <div class="clear"></div>
            </ul>
            <?php
			 break;
			 case 4: //快乐十分
			 ?>
            <ul class="kj-hao" ctype="g1" cnum="20">
                <li id="span_lot_0" class="gr_s gr_s020"> <?=$kjHao[0]?> </li>
                <li id="span_lot_1" class="gr_s gr_s020"> <?=$kjHao[1]?> </li>
                <li id="span_lot_2" class="gr_s gr_s020"> <?=$kjHao[2]?> </li>
                <li id="span_lot_3" class="gr_s gr_s020"> <?=$kjHao[3]?> </li>
                <li id="span_lot_4" class="gr_s gr_s020"> <?=$kjHao[4]?> </li>
                <li id="span_lot_5" class="gr_s gr_s020"> <?=$kjHao[5]?> </li>
                <li id="span_lot_6" class="gr_s gr_s020"> <?=$kjHao[6]?> </li>
                <li id="span_lot_7" class="gr_s gr_s020"> <?=$kjHao[7]?> </li>
                <div class="clear"></div>
              </ul>
             <?php
			 break;
			 case 6: //PK10
			 ?>
            <ul class="kj-hao" ctype="g1" cnum="10">
                <li id="span_lot_0" class="gr_s gr_s020"> <?=$kjHao[0]?> </li>
                <li id="span_lot_1" class="gr_s gr_s020"> <?=$kjHao[1]?> </li>
                <li id="span_lot_2" class="gr_s gr_s020"> <?=$kjHao[2]?> </li>
                <li id="span_lot_3" class="gr_s gr_s020"> <?=$kjHao[3]?> </li>
                <li id="span_lot_4" class="gr_s gr_s020"> <?=$kjHao[4]?> </li>
                <li id="span_lot_5" class="gr_s gr_s020"> <?=$kjHao[5]?> </li>
                <li id="span_lot_6" class="gr_s gr_s020"> <?=$kjHao[6]?> </li>
                <li id="span_lot_7" class="gr_s gr_s020"> <?=$kjHao[7]?> </li>
                <li id="span_lot_8" class="gr_s gr_s020"> <?=$kjHao[8]?> </li>
                <li id="span_lot_9" class="gr_s gr_s020"> <?=$kjHao[9]?> </li>
                <div class="clear"></div>
              </ul>
             
              <?php
			 break;
			 case 9: //快3
			 ?>
            <ul class="kj-hao k3" ctype="g2" cnum="6" >
                <li id="span_lot_0" class="gr_ks gr_ks<?=intval($kjHao[0])?>"> </li>
                <li id="span_lot_1" class="gr_ks gr_ks<?=intval($kjHao[1])?>"> </li>
                <li id="span_lot_2" class="gr_ks gr_ks<?=intval($kjHao[2])?>"> </li>
           		<div class="clear"></div>
            </ul>
             <?php
				break;
				default:
			?>
            <ul class="kj-hao" ctype="g0"  cnum="10">
                <li id="span_lot_0" class="gr_s gr_s<?=intval($kjHao[0])?>"> </li>
                <li id="span_lot_1" class="gr_s gr_s<?=intval($kjHao[1])?>"> </li>
                <li id="span_lot_2" class="gr_s gr_s<?=intval($kjHao[2])?>"> </li>
                <li id="span_lot_3" class="gr_s gr_s<?=intval($kjHao[3])?>"> </li>
                <li id="span_lot_4" class="gr_s gr_s<?=intval($kjHao[4])?>"> </li>
                <div class="clear"></div>
            </ul>
			<?php
				break;
			  }
			  ?>
              
              
            </div>   
        </div>
        <div class="thisGame">
            <ul> 
                <li class="ni kj-title"><p class="i2">第<span class="i1"><?=$actionNo['actionNo']?></span> 期  <em class="wjtips">正在销售中</em></p></li>
                <li class="tm"><span id='current_titles'>截止时间</span><span id="current_endtime"><?=$surTime?></span></li>
                <li class="tb"><em>剩余</em><span class="i2" action="/index.php/display/freshKanJiang/<?=$this->type?>" id="pre-kanjiang">00:00:00</span>
                </li>
            </ul>
        </div>
        
    </div> 
    
<script type="text/javascript">
$(function(){
	window.S=<?=json_encode($diffTime>0)?>;
	window.KS=<?=json_encode($kjDiffTime>0)?>;
	window.kjTime=parseInt(<?=json_encode($kjdTime)?>);
	
	if($.browser.msie){
		//window.diffTime=<?=$diffTime?>;
		setTimeout(function(){
			gameKanJiangDataC(<?=$diffTime?>);
		}, 1000);
	}else{
		setTimeout(gameKanJiangDataC, 1000, <?=$diffTime?>);
	}
	<?php if($kjDiffTime>0){ ?> 
		if($.browser.msie){
		setTimeout(function(){
			setKJWaiting(<?=$kjDiffTime?>);
		}, 1000);
		}else{
			setTimeout(setKJWaiting, 1000, <?=$kjDiffTime?>);
		}
	<?php } ?> 
	
	<?php if(!$kjHao){ ?> 
		loadKjData();
	<?php } ?> 
});
</script>