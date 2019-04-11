<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<?php 	$codeNum=$this->getValue("select codeNum from {$this->prename}played where android=1 and id={$this->played}"); ?>

<div class="dantuo">
    <label><input type="radio" name="dantuo" value="" checked="checked"/>普通</label>
    <label><input type="radio" name="dantuo" value="1"/>胆拖</label>
</div>
<div>
<div maxlen="<?=$codeNum?>" class="pp pp11" action="tz11x5Select" length="3" >
	<input type="button" value="1" class="code" />
	<input type="button" value="2" class="code" />
    <input type="button" value="3" class="code" />
    <input type="button" value="4" class="code" />
    <input type="button" value="5" class="code" />
    <input type="button" value="6" class="code" />
</div>
</div>
<div class="dmtm unique" style="display:none;">
    <div maxlen="<?=$codeNum?>" class="pp pp11">
        <div class="title">胆码</div>
         <div class="codes">
        <input type="button" value="1" class="code" />
        <input type="button" value="2" class="code" />
        <input type="button" value="3" class="code" />
        <input type="button" value="4" class="code" />
        <input type="button" value="5" class="code" />
        <input type="button" value="6" class="code" />
         <div class="clear"></div>
		</div>
    </div>
    <div maxlen="<?=$codeNum?>" class="pp pp11">
        <div class="title">拖码</div>
         <div class="codes">
        <input type="button" value="1" class="code" />
        <input type="button" value="2" class="code" />
        <input type="button" value="3" class="code" />
        <input type="button" value="4" class="code" />
        <input type="button" value="5" class="code" />
        <input type="button" value="6" class="code" />
         <div class="clear"></div>
		</div>
    </div>
</div>
<?php
	
	$maxPl=$this->getPl($this->type, $this->played);
?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?=json_encode($maxPl)?>);
})
</script>