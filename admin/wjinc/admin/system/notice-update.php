<?php 
	$sql="select * from {$this->prename}content where id=?";
	$info=$this->getRow($sql, $args[0]);
	
?>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
<header><h3 class="tabs_involved">修改内容</h3></header>
<table>
<tr><td>
	<form action="/admin778899.php/system/doUpdateNotice/<?=$info['id']?>" method="post" target="ajax" onajax="beforeUpdateNotice" call="doUpdateNotice" name="form1">
		<table class="tablesorter table2" cellspacing="0" width="100%">
			
			<tr>
				<td><span class="aq-txt">标题：</span></td>
				<td align="left"><input type="text" name="title" style="width:550px;" value="<?=$info['title']?>" /></td>
			</tr>
			<tr> 
			<td>类别：</td> 
			<td align="left">
				<select name="typeid">
				<?php 
				$infotypes=$this->getRows("select * from {$this->prename}info_type  order by id");
				if($infotypes) foreach($infotypes as $var){ ?>
					<option value="<?=$var['id']?>" <?=$this->iff($info['typeid']==$var['id'], 'selected')?>><?=$var['typename']?></option>
				<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
				<td><span class="aq-txt">图片：</span></td>
				<td align="left">

<input name="imagesurl" type="hidden"  id="imagesurl" value="<?=$info['imagesurl']?>" />  
<iframe src="/upload/upload.php?action=edit&img=<?=$info['imagesurl']?>&imgsize=0&img_w=100&img_h=100" width="100%" height="43" scrolling="No" frameborder="0" style="border:0px;"></iframe></td>
			</tr>
			<tr>
				<td><span class="aq-txt">内容：</span></td>
				<td align="left">
                <textarea rows="10" name="content" id="content" boxid="content" style="width:550px;"><?=$info['content']?></textarea>
            
                </td>
			</tr>
			<tr>
				<td><span class="aq-txt">发布日期：</span></td>
				<td align="left" style="text-align:left;"><input type="text" name="addTime" style="width:150px;" value="<?=date('Y-m-d', $info['addTime'])?>" /></td>
			</tr>
            <tr>
				<td><span class="aq-txt">是否显示：</span></td>
				<td align="left" style="text-align:left;"><input type="radio" name="enable" value="1" <?=$this->iff($info['enable'], 'checked')?>/>显示  <input type="radio" name="enable" value="0" <?=$this->iff($info['enable'], '', 'checked')?>/>隐藏</td>
			</tr>
            
			<tr>
				<td>&nbsp;</td>
				<td align="left"><input type="submit" class="alt_btn" value="确定修改"/></td>
			</tr>
		</table>
	</form>
	</td>
	
</tr>
</table>
</article>
