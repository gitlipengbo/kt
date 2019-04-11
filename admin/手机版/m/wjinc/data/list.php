<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '开奖历史'); ?>
</head> 
 
<body>
<div id="mainbody"> 
<?php $this->display('inc_header.php'); ?>
<div class="pagetop"></div>
<div class="pagemain">
    <div class="display biao-cont">
    
     <table class="table_b">
        <thead>
            <thead>
            <tr class="table_b_th">
                <td>彩种</td>
                <td>期号</td>
                <td>开奖号码</td>
                <td>时间</td>
            </tr>
            </thead>
            <tbody class="table_b_tr">
           <?php
		   if(!$args[0]) $args[0]=1;
			$sql="select id, type, time, number, data from {$this->prename}data where type=?";
			
			$sql.=" order by number desc limit 30";
			$list=$this->getRows($sql, $args[0]);
			$typename=$this->getValue("select title from {$this->prename}type where id={$args[0]}");
			
			if($list) foreach($list as $var){
?>
           <tr>
                <td><?=$typename?></td>
                <td><?=$var['number']?></td>
                <td><?=$var['data']?></td>
                <td><?=date('H:i', $var['time'])?></td>
			</tr>
            <?php }else{ ?>
            <tr>
                <td colspan="4" align="center">没有数据</td>
            </tr>
            <?php } ?>
            </tbody>
            
        </table>
    </div>
<?php $this->display('inc_footer.php'); ?> 
</div>
<div class="pagebottom"></div>
</div>

</body>
</html>
  
   
 