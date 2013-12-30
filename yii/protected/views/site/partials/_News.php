<div class="middle-block">
    <div class="text-block">
    	<div class="paragraph">
    		<?php foreach ($page as $pkey => $p) { ?>
    		<h2><?=$p->title?></h2>
    			<?=$p->text?>
    		<?php } ?>
    	</div>
    	<?php $this->widget('CLinkPager', array(
		    'pages' => $pages,
		)) ?>
    </div>
</div>