<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<?php 	$codeNum=$this->getValue("select codeNum from {$this->prename}played where android=1 and id={$this->played}"); ?>

<?php foreach(array('十','个') as $var){ ?>
<div maxlen="<?=$codeNum?>" class="pp" action="tzDXDS" length="2" random="sscRandom">
	<div class="title"><?=$var?>位</div> 

    <input type="button" value="大" class="code" />
	<input type="button" value="小" class="code" />
	<input type="button" value="单" class="code" />
	<input type="button" value="双" class="code" />

</div>
<?php
	}
	$maxPl=$this->getPl($this->type, $this->played);
?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?=json_encode($maxPl)?>,false,<?=$this->user['fanDianBdw']?>);
})
</script>