<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<?php 	$codeNum=$this->getValue("select codeNum from {$this->prename}played where android=1 and id={$this->played}"); ?>


<div maxlen="<?=$codeNum?>" class="pp pp11" action="tz11x5Select" length="1" >
	<input type="button" value="111" class="code reset" />
	<input type="button" value="222" class="code reset" />
    <input type="button" value="333" class="code reset" />
    <input type="button" value="444" class="code reset" />
    <input type="button" value="555" class="code reset" />
    <input type="button" value="666" class="code reset" />
</div>
<?php
	
	$maxPl=$this->getPl($this->type, $this->played);
?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?=json_encode($maxPl)?>);
})
</script>