<div class="middle-block">
    <div class="text-block">
    	<div class="paragraph">
    		<?php foreach ($page as $pkey => $p) { ?>
    		<h2><?=$p->title?></h2>
    			<?=$p->preview?>
    		<?php } ?>
    	</div>
    	<?php $this->widget('CLinkPager', array(
		    'pages' => $pages,
		)) ?>
    </div>
    <div class="right-bar">
        <div class="banners-block">
            <?php if(is_array($lastnews)): ?>
            <h2>Последние новости</h2>
            <?php foreach ($lastnews as $lkey => $l) { ?>
                <a href="<?=$this->createUrl('site/news',array('id'=>$lkey))?>"><?=$l?></a><br />
            <?php } ?>  
            <?php endif; ?>     
        </div>
    </div>
</div>