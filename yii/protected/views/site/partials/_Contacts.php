<div class="middle-block">
    <div class="text-block">
    	<div class="paragraph">
    		<?php foreach ($page as $pkey => $p) { ?>
    		<h2><?=$p->title?></h2>
    			<?=$p->text?>
    		<?php } ?>
            <br />
    		<?php if(!empty($yandex_map)) ?>
    		<h2><?=Yii::t('main', 'Схема проезда')?></h2>
    			<?=$yandex_map?>
    		<?php ?>
    	</div>
    </div>
</div>