 <?php
	$lastNo=$this->getGameLastNo($this->type);
	$kjHao=$this->getValue("select data from {$this->prename}data where type={$this->type} and number='{$lastNo['actionNo']}'");
	if($kjHao) $kjHao=explode(',', $kjHao);
	$actionNo=$this->getGameNo($this->type);
	$types=$this->getTypes();
	$kjdTime=$types[$this->type]['data_ftime'];
	$diffTime=strtotime($actionNo['actionTime'])-$this->time-$kjdTime;
	$kjDiffTime=strtotime($lastNo['actionTime'])-$this->time;
?>
<div class="bd" id="kaijiang" type="<?=$this->type?>" ctype="<?=$types[$this->type]['type']?>">


			<H1 class=logo<?=$this->type?>><?=$types[$this->type]['title']?></H1>
			<div  class="b-top-tips-notice">
<div class="b-top-tips-cur"><strong class="red"><span id="curExpectSpan"><?=$actionNo['actionNo']?></span>期</strong><br><strong id="kjinfo" >离投注截止还有</strong></div>
<div  class="b-top-tips-time" id="pre-kanjiang" action="/index.php/display/freshKanJiang/<?=$this->type?>"><span>0</span><span>0</span><em>:</em><span>0</span><span>0</span><em>:</em><span>0</span><span>0</span></div>
</div>
			



			


	<!-- header end -->
<DIV class=b-top-inner>
<DIV class="b-top-info">第 <span class=red><?=$lastNo['actionNo']?></span> 期<br> <span id="kjsay">开奖倒计时：<em class="kjtips">00:00</em></span><span id="lockgame"></span></DIV>
<?php if($types[$this->type]['type']==4) { //快乐十分?>


      	    
          <div class="grid_code_ssc wjkjData" style="margin-top:15px; ">
          	  <p class="hide"><img src="/images/common/kjts.png" /></p>
              <ul class="kj-hao" ctype="g1" cnum="20" style="position:absolute;left:125px; top:3px">
                <li id="span_lot_0" class="gr_s2"> <?=$kjHao[0]?> </li>
                <li id="span_lot_1" class="gr_s2"> <?=$kjHao[1]?> </li>
                <li id="span_lot_2" class="gr_s2"> <?=$kjHao[2]?> </li>
                <li id="span_lot_3" class="gr_s2"> <?=$kjHao[3]?> </li>
                <li id="span_lot_4" class="gr_s2"> <?=$kjHao[4]?> </li>
                <li id="span_lot_5" class="gr_s2"> <?=$kjHao[5]?> </li>
                <li id="span_lot_6" class="gr_s2"> <?=$kjHao[6]?> </li>
                <li id="span_lot_7" class="gr_s2"> <?=$kjHao[7]?> </li>

              </ul>
              <div class="clear"></div>
          </div>   
	
     <?php }else if($types[$this->type]['type']==6) { //PK10?>
      
	   

          <div class="grid_code_ssc wjkjData" style="margin-top:15px;">
          	  <p class="hide"><img src="/images/common/kjts.png" /></p>
              <ul class="kj-hao" ctype="g1" cnum="10">
                <li id="span_lot_0" class="gr_s"> <?=$kjHao[0]?> </li>
                <li id="span_lot_1" class="gr_s"> <?=$kjHao[1]?> </li>
                <li id="span_lot_2" class="gr_s"> <?=$kjHao[2]?> </li>
                <li id="span_lot_3" class="gr_s"> <?=$kjHao[3]?> </li>
                <li id="span_lot_4" class="gr_s"> <?=$kjHao[4]?> </li>
                <li id="span_lot_5" class="gr_s"> <?=$kjHao[5]?> </li>
                <li id="span_lot_6" class="gr_s"> <?=$kjHao[6]?> </li>
                <li id="span_lot_7" class="gr_s"> <?=$kjHao[7]?> </li>
                <li id="span_lot_8" class="gr_s"> <?=$kjHao[8]?> </li>
                <li id="span_lot_9" class="gr_s"> <?=$kjHao[9]?> </li>
              </ul>
              <div class="clear"></div>
          </div>   
	 
     <?php }else if($types[$this->type]['type']==9) { //快3?>
      

            <div class="grid_code_tl wjkjData" >
              <p class="hide"><img src="/images/common/kjtsk3.jpg" /></p>
              <ul class="kj-hao k3" ctype="g2"  cnum="6" style="margin-left:70px;">
                    <li id="span_lot_0" class="gr_s"><?=intval($kjHao[0])?> </li>
                    <li id="span_lot_1" class="gr_s"><?=intval($kjHao[1])?> </li>
                    <li id="span_lot_2" class="gr_s"><?=intval($kjHao[2])?> </li>
              </ul>
              <div class="clear"></div>
           </div>
    
     <?php }else if($types[$this->type]['type']==3) { //3D?>
    
	   

            <div class="grid_code_tl wjkjData" >
              	<p class="hide"><img src="/images/common/kjts.png" /></p>
              	<ul class="kj-hao" ctype="g0"  cnum="10" style="margin-left:30px;">
                    <li id="span_lot_0" class="gr_s"><?=intval($kjHao[0])?> </li>
                    <li id="span_lot_1" class="gr_s"><?=intval($kjHao[1])?> </li>
                    <li id="span_lot_2" class="gr_s"><?=intval($kjHao[2])?> </li>
              </ul>
              <div class="clear"></div>
           </div>
       
      <?php }else if($types[$this->type]['type']==2) { //11选5?>
       
        

              <div class="grid_code_ssc wjkjData" >
              	  <p class="hide"><img src="/images/common/kjts.png" /></p>
                  <ul class="kj-hao" ctype="g3" cnum="11" >
                    <li id="span_lot_0" class="gr_s1"><?=$kjHao[0]?> </li>
                    <li id="span_lot_1" class="gr_s1"><?=$kjHao[1]?> </li>
                    <li id="span_lot_2" class="gr_s1"><?=$kjHao[2]?> </li>
                    <li id="span_lot_3" class="gr_s1"><?=$kjHao[3]?> </li>
                    <li id="span_lot_4" class="gr_s1"><?=$kjHao[4]?> </li>
                  </ul>
                  <div class="clear"></div>
            </div>   
             

	 
 	<?php }else{  ?>
       

              <div class="grid_code_ssc wjkjData" >
              	  <p class="hide"><img src="/images/common/kjts.png" /></p>
                  <ul class="kj-hao" ctype="g0"  cnum="10">
                    <li id="span_lot_0" class="gr_s"><?=intval($kjHao[0])?> </li>
                    <li id="span_lot_1" class="gr_s"><?=intval($kjHao[1])?> </li>
                    <li id="span_lot_2" class="gr_s"><?=intval($kjHao[2])?> </li>
                    <li id="span_lot_3" class="gr_s"><?=intval($kjHao[3])?> </li>
                    <li id="span_lot_4" class="gr_s"><?=intval($kjHao[4])?> </li>
                  </ul>
                  <div class="clear"></div>
            </div>   
             
	      
       <?php }?>

<div class="zst"><a target="modal" button="关闭:defaultModalCloase" title="历史开奖" href="/index.php/index/historyList/<?=$this->type?>"></a></div>


</div></div>
<div class="clear"></div>

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