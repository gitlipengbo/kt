<div style="clear:both"></div>
<div class="footer_bj">
<div class="footer">
<ul class="fo1">
<h1><img alt="KT彩娱乐城" src="/img/fo1.png" /></h1>
 <?php
            $data=$this->getRows("select id,title,content,addtime from {$this->prename}content where nodeId=1 and enable=1 and typeid=2 order by id desc limit 4");
            if($data) foreach($data as $var){ 
            echo "<li>·<a target=\"modal\" button=\"关闭:defaultModalCloase\" href=\"/index.php/notice/viewinfo/".$var['id']."\"  title=\"".$var['title']."\"  width=600  >{$var['title']}</a></li>";
            } 
  ?>
</ul>
<ul class="fo2">
<h1><img alt="KT彩娱乐城" src="/img/fo2.png" /></h1>
 <?php
            $data=$this->getRows("select id,title,content,addtime from {$this->prename}content where nodeId=1 and enable=1 and typeid=3 order by id desc limit 4");
            if($data) foreach($data as $var){ 
            echo "<li>·<a target=\"modal\" button=\"关闭:defaultModalCloase\" href=\"/index.php/notice/viewinfo/".$var['id']."\"  title=\"".$var['title']."\" width=600   >{$var['title']}</a></li>";
            } 
  ?>
</ul>
<ul class="fo3">
<h1><img alt="KT彩娱乐城" src="/img/fo3.png" /></h1>
 <?php
            $data=$this->getRows("select id,title,content,addtime from {$this->prename}content where nodeId=1 and enable=1 and typeid=4 order by id desc limit 4");
            if($data) foreach($data as $var){ 
            echo "<li>·<a target=\"modal\" button=\"关闭:defaultModalCloase\" href=\"/index.php/notice/viewinfo/".$var['id']."\"  title=\"".$var['title']."\" width=600   >{$var['title']}</a></li>";
            } 
  ?>
</ul>
<ul class="fo4">
<h1><img alt="KT彩娱乐城" src="/img/fo4.png" /></h1>
 <?php
            $data=$this->getRows("select id,title,content,addtime from {$this->prename}content where nodeId=1 and enable=1 and typeid=5 order by id desc limit 4");
            if($data) foreach($data as $var){ 
            echo "<li>·<a target=\"modal\" button=\"关闭:defaultModalCloase\" href=\"/index.php/notice/viewinfo/".$var['id']."\"  title=\"".$var['title']."\"  width=600  >{$var['title']}</a></li>";
            } 
  ?>
</ul>
<ul class="fo5">
<h1><img alt="KT彩娱乐城" src="/img/fo5.png" /></h1>
<li><img alt="KT彩娱乐城" src="/img/tel.png" /></li>
<li>服务时间</li>
<li>10：00——02:00</li>
<li></li>
</ul>
</div>
</div>

<div class="copy_new">
<p><img src="/img/wljc.gif"><img src="/img/wangan.gif"><img src="/img/wsjy.gif"><img src="/img/xylh.gif"><img src="/img/kxwz.gif"></p>
<p><span class="red">KT彩娱乐城郑重提示：彩票有风险，投注需谨慎</span> 不向未满18周岁的青少年出售彩票</p>
</div>

<!--网站底部结束-->


