<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
<header><h3 class="tabs_involved">添加公告</h3></header>
<table>
<tr><td>
<form action="/admin778899.php/system/doAddNotice" method="post" target="ajax" call="sysReloadNotice" name="form1">
		<table class="tablesorter table2" cellspacing="0" width="100%">
			
			<tr>
				<td><span class="aq-txt">标题：</span></td>
				<td align="left"><input type="text" name="title" style="width:550px;" value="" /></td>
			</tr>
			<tr> 
			<td>类别：</td> 
			<td align="left">
				<select name="typeid">
				<?php 
				$infotypes=$this->getRows("select * from {$this->prename}info_type  order by id");
				if($infotypes) foreach($infotypes as $var){ ?>
					<option value="<?=$var['id']?>" ><?=$var['typename']?></option>
				<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
				<td><span class="aq-txt">图片：</span></td>
				<td align="left">

<input name="imagesurl" type="hidden"  id="imagesurl" value="" />  
<iframe src="/upload/upload.php?action=add&imgsize=0&img_w=100&img_h=100" width="100%" height="43" scrolling="No" frameborder="0" style="border:0px;"></iframe></td>
			</tr>
			<tr>
				<td><span class="aq-txt">内容：</span></td>
				<td align="left">
                <textarea rows="10" name="content" id="content" boxid="content" style="width:550px;" ></textarea>
                </td>
			</tr>
			
			<tr>
				<td></td>
				<td><input type="submit" class="alt_btn" value="添加公告"/></td>
			</tr>
		</table>
	</form>
	</td>
	
</tr>
</table>
</article>
