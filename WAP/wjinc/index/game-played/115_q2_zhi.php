<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<?php 	$codeNum=$this->getValue("select codeNum from {$this->prename}played where android=1 and id={$this->played}"); ?>

<div class="zhixu115 unique">
	<?php foreach(array('一','二') as $var){ ?>
    <div maxlen="<?=$codeNum?>" class="pp pp11" action="tzAllSelect" length="2" delimiter=" ">
        <div class="title"><?=$var?>位</div>
		<div class="codes">
        <input type="button" value="01" class="code d min" />
        <input type="button" value="02" class="code s min" />
        <input type="button" value="03" class="code d min" />
        <input type="button" value="04" class="code s min" />
        <input type="button" value="05" class="code d min" />
        <input type="button" value="06" class="code s max" />
        <input type="button" value="07" class="code d max" />
        <input type="button" value="08" class="code s max" />
        <input type="button" value="09" class="code d max" />
        <input type="button" value="10" class="code s max" />
        <input type="button" value="11" class="code d max" />
        <div class="clear"></div>
   		</div>  
        <input type="button" value="全" action="uniqueSelect" class="action all" />
        <input type="button" value="大" action="uniqueSelect" class="action large" />
        <input type="button" value="小" action="uniqueSelect" class="action small" />
        <input type="button" value="单" action="uniqueSelect" class="action odd" />
        <input type="button" value="双" action="uniqueSelect" class="action even" />
        <input type="button" value="清" class="action none" />
    </div>
<?php
	}
	$maxPl=$this->getPl($this->type, $this->played);
?>
</div>

<script type="text/javascript">
$(function(){
	gameSetPl(<?=json_encode($maxPl)?>);
})
</script>
